<?php

namespace App\Http\Controllers\Api;

use App\Province;
use App\District;
use Validator;
use App\Ward;
use App\Http\Controllers\Controller;
use App\Order;
use App\Address;
use App\Coupon;
use App\Http\Controllers\Api\BaseController as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderApiController extends BaseController
{
    public function getProvince(){
        $provinces = Province::orderBy('_name','asc')->get();
        return $this->sendResponse([
            'province' => $provinces,
        ], 'Lấy danh sách tỉnh thành công');
    }

    public function getDistrict($id){
        $provinces = Province::find($id);
        $districts = $provinces->districts;
        return $this->sendResponse([
            'district' => $districts,
        ], 'Lấy danh sách huyện theo tỉnh thành công');
    }
    public function getWard($id){
        $district = District::find($id);
        $ward = $district->wards;
        return $this->sendResponse([
            'ward' => $ward,
        ], 'Lấy danh sách xã theo huyện thành công');
    }
    public function checkValidCoupon($code, $arrCourse){
        // kiểm tra xem code này cho khóa học nào



        $coupon = Coupon::where('name', $code)->first();
        if(!$coupon){
            return [
                'status' => 'error',
                'code' => 2 ,
                'message' => 'mã giảm giá không tồn tại'
            ];
        }
        $arrCourseInCoupon = unserialize($coupon->course_id);

        $exitsted = false;
        foreach($arrCourse as $k => $id){
            if(in_array($id, $arrCourseInCoupon)){
                $exitsted = true;
            }
        }
        if(!$exitsted){
            return [
                'status' => 'error',
                'code' => 1,
                'message' => 'mã giảm giá này không dành cho những khóa học này'
            ];
        }


        if(!$coupon){
            return [
                'status' => 'error',
                'code' => 1,
                'message' => 'mã giảm giá này không tồn tại'
            ];
        }
        $current = \Carbon\Carbon::now();
        if($coupon->expire < $current){
            return [
                'status' => 'error',
                'code' => 2 ,
                'message' => 'mã giảm giá đã hết hạn'
            ];
        }
        if($coupon->status == "inactive"){
            return [
                'status' => 'error',
                'code' => 3 ,
                'message' => 'mã này chưa được kích hoạt'
            ];
        }

        $data = [
            'id' => $coupon->id,
            'code' => $coupon->name,
            'type' => $coupon->type,
            'typeName' => $coupon->type == 0 ? "giảm theo phần trăm" : "giảm tiền cụ thể",
            'value' => $coupon->value,
            'expire' => $coupon->expire
        ];
        return [
            'status' => 'success',
            'message' => 'mã đã được áp dụng',
            'data' => $data
        ];
    }
    public function checkCoupon(Request $request){
        $code = $request->code;
        $course_id = $request->course_id;
        return $this->checkValidCoupon($code,$course_id);
    }


    public function getShipping(Request $request){
        if($request->address_id){
            $address = Address::find($request->address_id);
            $to_province = $address->CityName;
            $to_district = $address->DistrictName;
            // $to_ward = $address->WardName;

            $ship_fee = $this->getKhoAddress($to_province, $to_district);
            return $ship_fee;
        }elseif($request->province_name && $request->district_name){
            $to_province = $request->province_name;
            $to_district = $request->district_name;
            $ship_fee = $this->getKhoAddress($to_province, $to_district);
            return $ship_fee;
        }
        return 0;

    }
    public function getKhoAddress($province_to, $district_to){
        $carts = \Cart::getContent();
        $arrKho = [];
        foreach($carts as $k => $cart){
            $type = $cart->attributes->type;
            if($type == "product"){
                $id = explode("-",$cart->id)[1];
                $product = Product_products::find($id);
                $warehouse = $product->warehouse;
                $product->quantity = $cart->quantity;
                $arrKho[$warehouse->id][] = $product;
            }elseif($type == "course"){
                $id = explode("-",$cart->id)[1];
                $course = Course_course::find($id);
                if(isset($cart->attributes['compo_id'])){
                    $compo_id = $cart->attributes['compo_id'];
                    $compo = Compo::find($compo_id);
                    if($compo){
                        // lấy kho hàng
                        $warehouse = $compo->warehouse;
                        $arrKho[$warehouse->id][] = $compo;
                    }
                }


            }
        }
        $totalShip = 0;
        // lấy kết quả theo kho
        foreach($arrKho as $k => $kho){
            $warehouse = Warehouse::find($k);
            $totalWeight = $this->getTotalWeight($kho);
            $from['CityName'] = $warehouse->CityName;
            $from['DistrictName'] = $warehouse->DistrictName;
            // $from['WardName'] = $warehouse->WardName;

            $to['CityName'] = $province_to;
            $to['DistrictName'] =  $district_to;
            //  $to['WardName'] =  $to_ward;

            $fee = $this->getFeeFromApi($from, $to, $totalWeight);
            $totalShip += $fee;

        }
        return $totalShip;
    }
    public function getFeeFromApi($from, $to, $weight){
        $config = config("edushop.ghtk");
        $data = array(
            "pick_province" => $from['CityName'],
            "pick_district" => $from['DistrictName'],
            //   "pick_ward" => $from['WardName'],

            "province" => $to['CityName'],
            "district" => $to['DistrictName'],
            //   "ward" => $to['WardName'],

            "weight" => $weight,
        );

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $config['link'] . "/services/shipment/fee?" . http_build_query($data),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_HTTPHEADER => array(
                "Token: " . $config['token'],
            ),
        ));
        $response = curl_exec($curl);

        curl_close($curl);

        $res = json_decode($response,true);
        if(isset($res['success']) && $res['success']){
            return $res['fee']['fee'];
        }else{
            return 0;
        }

    }
    public function getTotalWeight($products){
        $sum = 0;
        foreach($products as $k => $product){
            $className = get_class($product);
            if($className == "App\Compo"){
                $sum += $product->weight;
            }else{
                $sum += $product->weight * $product->quantity;
            }

        }
        return $sum;
    }
    public function getDonViTheoId($data, $id){
        foreach($data as $k => $item){
            if($item->carrierId == $id){
                return $item;
            }
        }
    }
    public function getDonViTheoTen($data, $name){
        foreach($data as $k => $item){
            if($item->carrierName == "Giaohangnhanh"){
                return $item;
            }
        }
    }
    public function getAddress(Request $request){
        $address_id = $request->address_id;
        $address = Address::find($address_id);
        if(!$address){
            return [ 'error' => 'Not found' ];
        }
        return $address;
    }
    public function postCheckout(Request $request){
        $order = new Order();
        $user = Auth::user();
        $coupon_code = $request->coupon_code;
        $order->coupon_code = $coupon_code;
        if($request->address_id){
            $validate = [
                'payment_method' => 'required|in:cod,bank',
                'address_id' => 'exists:address,id'
            ];
            if($request->payment_method == "bank"){
                $validate['bank_payment'] = 'required|exists:bank,id';
            }
            // sử dụng địa chỉ hiện tại
            $request->validate( $validate,[
                'required' => ':attribute không được rỗng',
                'in' => ':attribute không hợp lệ',
            ],[
                'payment_method' => 'Phương thức thanh toán',
                'bank_payment' => 'Ngân hàng'
            ]);


            // tạo địa chỉ cho đơn hàng
            $addressOld = Address::find($request->address_id);
            $address = new OrderAddress();
            $address->fullname = $addressOld->name;
            $address->email = $addressOld->email;
            $address->phone = $addressOld->phone;
            $address->address = $addressOld->address;
            $address->province_id = $addressOld->province_id;
            $address->district_id = $addressOld->district_id;
            $address->ward_id = $addressOld->ward_id;
            $address->CityName = $addressOld->CityName;
            $address->DistrictName = $addressOld->DistrictName;
            $address->WardName = $addressOld->WardName;
            $address->user_id = $user->id;
            $address->save();

            $order->address_id = $address->id;

        }else{
            $validate = [
                'name' => 'required',
                'email' => 'required|email',
                'phone' => 'required',
                'address' => 'required',
                'province_id' => 'required|exists:province,id',
                'district_id' => 'required|exists:district,id',
                'ward_id' => 'required|exists:ward,id',
                'payment_method' => 'required|in:cod,bank'
            ];
            if($request->payment_method == "bank"){
                $validate['bank_payment'] = 'required|exists:bank,id';
            }
            $request->validate( $validate,[
                'required' => ':attribute không được rỗng',
                'exists' => ':attribute không hợp lệ',
                'min' => ':attribute phải có ít nhất :min kí tự',
                'max' => ':attribute không vượt quá :max kí tự',
                'in' => ':attribute không hợp lệ',
            ],[
                'name' => 'Họ và tên',
                'phone' => 'Số điện thoại',
                'address' => 'Địa chỉ',
                'province_id' => 'Tỉnh/TP',
                'district_id' => 'Quận/Huyện',
                'ward_id' => 'Phường/xã',
                'payment_method' => 'Phương thức thanh toán',
                'bank_payment' => 'Ngân hàng'
            ]);
            // tạo địa chỉ cho đơn hàng
            $address = new OrderAddress();
            $address->fullname = $request->name;
            $address->email = $request->email;
            $address->phone = $request->phone;
            $address->address = $request->address;
            $address->province_id = $request->province_id;
            $address->district_id = $request->district_id;
            $address->ward_id = $request->ward_id;
            $address->CityName = $request->CityName;
            $address->DistrictName = $request->DistrictName;
            $address->WardName = $request->WardName;
            $address->user_id = $user->id;
            $address->save();
            $order->address_id = $address->id;
            // tạo địa chỉ giao hàng mới
            $address = new Address();
            $address->fullname = $request->name;
            $address->email = $request->email;
            $address->phone = $request->phone;
            $address->address = $request->address;
            $address->province_id = $request->province_id;
            $address->district_id = $request->district_id;
            $address->ward_id = $request->ward_id;
            $address->CityName = $request->CityName;
            $address->DistrictName = $request->DistrictName;
            $address->WardName = $request->WardName;
            $address->user_id = $user->id;
            $address->save();
        }




        $order->pay_method = $request->payment_method;
        if($request->payment_method == "bank"){
            $order->bank = $request->bank_payment;
        }
        $order->user_id = $user->id;
        $order->save();



        // $this->sendMail($order);


    }

}
