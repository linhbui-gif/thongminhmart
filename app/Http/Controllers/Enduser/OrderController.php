<?php

namespace App\Http\Controllers\Enduser;

use App\Address;
use App\Compo;
use App\Coupon;
use App\Course_course;
use App\Http\Controllers\Controller;
use App\Order;
use App\OrderAddress;
use App\OrderSub;
use App\Product_products;
use App\Warehouse;
use Illuminate\Http\Request;
use Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Session;
use Illuminate\Support\Str;
use App\OrderDetail;

class OrderController extends Controller
{

    public function __construct()
    {
        $_config = \App\Config::find(26);
        return view()->share('_config', $_config);
    }
    public function cart()
    {
        $cart = Cart::getContent();
        return view(config("edushop.end-user.pathView") . "cart", compact('cart'));
    }
    public function checkLearnNow($course)
    {
        if (Auth::check()) {
            $user = Auth::user();
            $user->courses()->sync([$course->id]);
            return true;
        }
        return false;
    }
    public function learnNow(Request $request)
    {
        $id = $request->id;
        $course = Course_course::find($id);
        if ($course->price_base <= 0) {
            $user = Auth::user();
            $checkCourse = $user->courses()->where('course_courses.id', $id)->first();
            if (!$checkCourse) {
                $user->courses()->attach([$id]);
            }
            return redirect()->route('course.postExam', ['slug_lesson' => $course->slug]);
        } else {
            return redirect()->route('home.index');
        }
    }
    public function addCart(Request $request)
    {
        $id = $request->id;
        $id_course = $id;
        $type = $request->type ? $request->type : "course";

        if ($type == "course") {
            $course = Course_course::find($id);
        } else {
            $course = Product_products::find($id);
        }

        $compo_id = 0;
        if ($request->compo_id) {
            $compo_id = $request->compo_id;
        }
        $user = Auth::user();
        if ($id) {

            $id = $type . "-" . $id;
            $price = $course->price_base;
            if ($course->price_base != $course->price_final) {
                if ($course->price_final != null) {
                    $price = $course->price_final;
                } else {
                    $price = $course->price_base;
                }
            }
            if ($type == "course") {

                $item = Cart::get($id);
                if ($item) {
                    Cart::remove($id);
                }
                $data = [
                    'id' => $id,
                    'name' => $course->name,
                    'price' => $price,
                    'quantity' => 1,
                    'attributes' => array(
                        'picture' => $course->url_picture,
                        'type' => $type,
                        'compo_id' => $compo_id
                    ),
                ];
                if (!empty($request->compo_id)) {
                    $compo = Compo::find($request->compo_id);
                    if ($compo) {
                        if ($type == "course") {
                            $data['attributes']['compo_id'] =  $request->compo_id;
                        }
                    }
                }
                if ($user) {
                    $checkCourse = $user->courses()->where('course_courses.id', $id_course)->first();
                    if ($checkCourse) {
                        Session::flash('cartError', 'Bạn đã mua khóa học này trước đó !');
                        return redirect()->back();
                    } else {
                        Cart::add($data);
                        Session::flash('cartSuccess', 'Thêm sản phẩm vào giỏ hàng thành công !');
                    }
                } else {
                    Cart::add($data);
                    Session::flash('cartSuccess', 'Thêm sản phẩm vào giỏ hàng thành công !');
                }
            } else {
                $data = [
                    'id' => $id,
                    'name' => $course->name,
                    'price' => $price,
                    'quantity' => 1,
                    'attributes' => array(
                        'picture' => $course->url_picture,
                        'type' => $type,
                        'compo_id' => $compo_id
                    ),
                ];
                Cart::add($data);
                Session::flash('cartSuccess', 'Thêm sản phẩm vào giỏ hàng thành công !!');
            }

            if ($request->action == "buynow") {
                return redirect()->route('order.cart');
            } else {
                return redirect()->back();
            }
        }
    }
    public  function deleteCart($id)
    {
        Cart::remove($id);
        Session::flash('cartRemove', 'Xóa giỏ hàng thành công !!');
        return redirect()->back();
    }
    public function updateCart(Request $request, $id)
    {
        if ($request->quantity <= 0) {
            Cart::remove($id);
        } else {

            Cart::update($id, array('quantity' => array(
                'relative' => false,
                'value' => $request->quantity
            ),));
        }

        Session::flash('cartUpdate', 'Cập nhật giỏ hàng thành công !!');
        return redirect()->back();
    }
    public function checkout()
    {
        $user = Auth::user();
        return view(config("edushop.end-user.pathView") . "checkout")->with("user", $user);
    }
    public function postCheckout(Request $request)
    {


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
//        if ($request->payment_method == "bank") {
//            $validate['bank_payment'] = 'required|exists:bank,id';
//        }
//        $request->validate($validate, [
//            'required' => ':attribute không được rỗng',
//            'exists' => ':attribute không hợp lệ',
//            'min' => ':attribute phải có ít nhất :min kí tự',
//            'max' => ':attribute không vượt quá :max kí tự',
//            'in' => ':attribute không hợp lệ',
//        ], [
//            'name' => 'Họ và tên',
//            'phone' => 'Số điện thoại',
//            'address' => 'Địa chỉ',
//            'province_id' => 'Tỉnh/TP',
//            'district_id' => 'Quận/Huyện',
//            'ward_id' => 'Phường/xã',
//            'payment_method' => 'Phương thức thanh toán',
//            'bank_payment' => 'Ngân hàng'
//        ]);
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
        $address->save();
    }

    public function createDataPostGTKT($order_id)
    {
        $config = config('edushop.status_gthk');
        $order = Order::find($order_id);

        $details = $order->details()->orderBy('kho_id', 'asc')->get();
        $arrKho = [];
        foreach ($details as $k => $detail) {
            if (!empty($detail->kho_id) && is_int($detail->kho_id)) {
                $arrKho[$detail->kho_id][] = $detail;
            }
        };
        if (count($arrKho) > 0) {
            $address = $order->address;
            $user = $order->user;
//            $thongtinnoinhan = [
//                'tel' => $address->phone,
//                'name' => !empty($address->fullname) ? $address->fullname : $user->fullname(),
//                'address' => $address->address,
//                'province' => $address->CityName,
//                'district' => $address->DistrictName,
//                'ward' => $address->WardName,
//                "hamlet" => "Khác",
//            ];
            $flag = true;
            $total_ship = 0;

            foreach ($arrKho as $kho_id => $kho) {

                //$data['products'] = [];
                $totalPriceInKho = 0;
//                foreach ($kho as $k => $detail) {
//                    $haveShip = false;
//                    if ($detail->type == "product") {
//                        $product = $detail->getProduct;
//                        $weight =  $product->weight / 1000; // chuyển sang KG
//                        $item = [
//                            'name' => $detail->product_name,
//                            'weight' => $weight,
//                            'quantity' => $detail->quantity,
//                            'product_code' => $product->id,
//                            'price' => (int)$detail->product_price
//                        ];
//                        $data['products'][] = $item;
//                        $totalPriceInKho += $detail->total;
//                        $haveShip = true;
//                    } else {
//                        if ($detail->compo_id) {
//                            $compo = Compo::find($detail->compo_id);
//                            if ($compo) {
//                                if($detail->type_shipping != 1){
//                                    $product = $detail->getProduct;
//                                    $weight =  $compo->weight / 1000;
//                                    $namecompo = $product->name . " | " . $compo->name;
//                                    $item = [
//                                        'name' => $namecompo,
//                                        'weight' => $weight,
//                                        'quantity' => 1,
//                                        'product_code' => $product->id . "-" . $compo->id,
//                                        'price' => (int)$compo->price
//                                    ];
//                                    $data['products'][] = $item;
//                                    $totalPriceInKho += $compo->price;
//                                    $haveShip = true;
//                                }
//                            }
//                        }
//                    }
//                }
                $khoObj = Warehouse::find($kho_id);
                $totalWeight = $this->getTotalWeightByWareHouse($kho);
                $ship_fee_by_ware_house  = 0;
                if($totalWeight > 0){
                    $from = [ 'CityName' => $khoObj->CityName, 'DistrictName' => $khoObj->DistrictName ];
                    $to = [ 'CityName' => $address->CityName, 'DistrictName' => $address->DistrictName ];
                    $ship_fee_by_ware_house = $this->getFeeFromApi($from , $to, $totalWeight);
                    $total_ship += $ship_fee_by_ware_house;
                }

                $madonhang = 'dh' . Str::random(6) . '_' . $order_id;
//                $noigui = [
//                    'id' => $madonhang,
//                    'pick_name' => $khoObj->contact_name,
//                    'pick_address' => $khoObj->address,
//                    'pick_province' => $khoObj->CityName,
//                    'pick_district' => $khoObj->DistrictName,
//                    'pick_ward' => $khoObj->WardName,
//                    'pick_tel' => $khoObj->phone,
//                    'value' => $totalPriceInKho
//                ];
//                $orderPost = $noigui + $thongtinnoinhan;
//                if ($order->pay_method == "cod") {
//                    $orderPost['pick_option'] = 'cod';
//                    $orderPost['pick_money'] = $totalPriceInKho;
//                } else {
//                    $orderPost['pick_money'] = 0;
//                }
                //$data['order'] = $orderPost;
                //dd($data);
                //$response = $this->postGHTK($data);
                //$response = json_decode($response, true);

                // tạo suborder

                $suborder = new OrderSub();
                $suborder->order_id = $order_id;
                $suborder->warehouse_id = $kho_id;
                $suborder->ship = $ship_fee_by_ware_house;
                $suborder->total = $totalPriceInKho;
                $suborder->madonhang = $madonhang;
                //$suborder->status_code = $response['order']['status_id'];
                //$suborder->mavandon = $response['order']['label'];
                //$suborder->status = $config[$suborder->status_code];
                $suborder->save();
                // cập nhật lại chi tiếc đơn hàng thuộc sub order nào
                OrderDetail::where('order_id', $order_id)->where('kho_id', $kho_id)->update(['sub_order_id' => $suborder->id]);

//                    if (!$response['success']) {
//
//                        $flag = false;
//                    }
            }
            $order->ship = $total_ship;
            $order->save();
            return $flag;
        }
        return true;
    }

    public function getTotalWeightByWareHouse($warehouses){
        $total = 0;
        foreach($warehouses as $k => $detail){
            if($detail->type_shipping != 1){
                $total += $detail->weight;
            }
        }

        return $total;
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

    public function postGHTK($data)
    {
        $config = config("edushop.ghtk");
        $curl = curl_init();
        //dd($data);
        $data = json_encode($data);

        curl_setopt_array($curl, array(
            CURLOPT_URL => $config['link'] . "/services/shipment/order",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => $data,
            CURLOPT_HTTPHEADER => array(
                "Content-Type: application/json",
                "Token: " . $config['token'],
                "Content-Length: " . strlen($data),
            ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);
        return $response;
    }
    public function returnSeller()
    {
        $carts = Cart::getContent();
        $arrUser = [];
        foreach ($carts as $k => $cart) {
            $pro = explode("-", $cart->id);
            $id = $pro[1];
            if ($pro[0] == "product") {
                $pro = Product_products::find($id);
            } elseif ($pro[0] == "course") {
                $pro = Course_course::find($id);
            }
            if ($pro->user) {
                $user_id = $pro->user->id;
                if (!in_array($user_id, $arrUser)) {
                    $arrUser[] = $user_id;
                }
            }
        }
        return $arrUser;
    }
    public function checkoutSuccess(Request $request)
    {
        $user = Auth::user();
        $order_id = $request->order_id;
        $order = $user->orders()->where('order.id', $order_id)->first();
        if (!$order) {
            return redirect()->back();
        }
        $data['user'] = $user;
        $data['order'] = $order;
        return view(config("edushop.end-user.pathView") . "checkoutSuccess")->with($data);
    }
    public function sendMail($order)
    {

        Mail::send('enduser.mail.checkout', ['order' => $order], function ($message) use ($order) {
            //$message->to('thanhphonglx98@gmail.com', 'Thanh phong')->bcc('phongprolx98@gmail.com','Thanh Phong')->subject('Đơn hàng thành công');
            $user = $order->user;
            $message->to($user->email, $user->fullname())->bcc('linhbq68@wru.vn','Linh')->subject('Đơn hàng thành công');
        });
    }

    public function checkValidCoupon($code)
    {
        // kiểm tra xem code này cho khóa học nào



        $coupon = Coupon::where('name', $code)->first();
        $arrCourseInCoupon = unserialize($coupon->course_id);
        if ($coupon->all_course == "yes") {
            $exitsted = true;
        } else {
            $exitsted = false;
            $carts = Cart::getContent();
            foreach ($carts as $k => $cart) {
                $idCourse = explode("-", $cart->id)[1];
                if (in_array($idCourse, $arrCourseInCoupon)) {
                    $exitsted = true;
                }
            }
        }

        if (!$exitsted) {
            return [
                'status' => 'error',
                'code' => 1,
                'message' => 'mã giảm giá này không dành cho những khóa học này'
            ];
        }


        if (!$coupon) {
            return [
                'status' => 'error',
                'code' => 1,
                'message' => 'mã giảm giá này không tồn tại'
            ];
        }
        $current = \Carbon\Carbon::now();
        if ($coupon->expire < $current) {
            return [
                'status' => 'error',
                'code' => 2,
                'message' => 'mã giảm giá đã hết hạn'
            ];
        }
        if ($coupon->status == "inactive") {
            return [
                'status' => 'error',
                'code' => 3,
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
    public function checkCoupon(Request $request)
    {
        $code = $request->code;
        return $this->checkValidCoupon($code);
    }
}
