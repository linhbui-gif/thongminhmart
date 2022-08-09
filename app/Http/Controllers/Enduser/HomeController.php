<?php

namespace App\Http\Controllers\Enduser;

use App\Address;
use App\Banner;
use App\Compo;
use App\Contact;
use App\Http\Controllers\Controller;
use App\Product_products;
use App\Product_category;
use App\Warehouse;
use Illuminate\Http\Request;
use App\Province;
use App\District;
use App\Course_course;
use App\Helper\NhanhService;
use Session;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{
    public function __construct()
    {
        $_config = \App\Config::find(26);
        return view()->share('_config', $_config);

    }

    public function index()
    {
        $data['products'] = Product_products::where('status', 'active')->orderBy('order_no', 'asc')->get();
        return view(config("edushop.end-user.pathView") . "index")->with($data);
    }

    public function lienhe()
    {

        return view(config("edushop.end-user.pathView") . "contact");
    }
    public function about()
    {

        return view(config("edushop.end-user.pathView") . "about");
    }

    public function chitietchungtoi()
    {
        return view('enduser.page.chitietchungtoi');
    }

    public function ajaxLoadProduct(Request $request)
    {
        if($request->ajax())
        {
            if($request->id > 0)
            {
                $data = \DB::table('product_products')
                    ->where('id', '>', $request->id)
                    ->orderBy('id', 'asc')
                    ->limit(5)
                    ->get();
            }
            else
            {
                $data = \DB::table('product_products')
                    ->orderBy('id', 'asc')
                    ->limit(5)
                    ->get();
            }
            $output = '';
            $htmlButton = '';
            $last_id = '';
            if(!$data->isEmpty()){
                foreach($data as $k => $product){
                    $output .= view('enduser.page.components.card-component', compact('product','htmlButton'))->render();
                    $last_id = $product->id;
                }
//                $output .= '<div class="col-12 text-center">
//                    <button class="btn btn-primary ajax-loading" data-id="'.$last_id.'" id="load_more_button">Xem thêm tin tức</button>
//                </div>';
                $htmlButton .= '
                              <button data-id="'.$last_id.'" class="Button-control ajax-loading flex items-center justify-center" type="button" id="load_more_button"><span class="Button-control-title">Xem thêm</span>
                                       </button>
                           ';
            }
            else
            {
                $output .= "";
            }
            return [$output,$htmlButton];
        }
    }

    public function ajaxContact(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:contact',
            'name' => 'required', // tesst
            'phone' => 'required|min:10',
        ],
            [
                'required' => ':attribute không được rỗng',
                'min' => ':attribute phải có ít nhất 10 kí tự',
                'email' => ':attribute chưa đúng định dạng',
                'unique' => ':attribute đã tồn tại',

            ],
            [
                'name' => 'Tên',
                'email' => 'Email',
                'phone' => 'Số điện thoại',
            ]);
        $data = [
            "email" => $request->email,
            "fullname" => $request->fullname,
            "phone" => $request->phone,
            "message" => $request->message,
        ];
//        $data->email = ;
//        $data->fullname = $request->name;
//        $data->phone = $request->phone;
//        $data->message = $request->message;
//        $data->save();
        \DB::table('contact')->insertOrIgnore($data);
        Session::flash('success', 'Gửi thông tin thành công,chúng tôi sẽ liên hệ với bạn sớm nhất !!');
        return redirect()->to('/lien-he');
    }

    public function getDistrict(Request $request)
    {
        $id_tinh = $request->id_tinh;

//        $service = new NhanhService();
//        $response = $service->sendRequest(NhanhService::URI_SHIPPING_LOCATION, [
//                "type" => "DISTRICT",
//                "parentId" => $id_tinh
//            ]  );
//        $districts = $response->data;
        $province = Province::find($id_tinh);
        $districts = $province->districts;
        $html = '<option value="default">Chọn Quận/Huyện</option>';
        foreach ($districts as $k => $district) {
            $html .= '<option value="' . $district->id . '">' . $district->_name . '</option>';
        }
        return $html;
    }

    public function getWard(Request $request)
    {
        $id_huyen = $request->id_huyen;
        $district = District::find($id_huyen);
        $wards = $district->wards;
//        $service = new NhanhService();
//        $response = $service->sendRequest(NhanhService::URI_SHIPPING_LOCATION, [
//            "type" => "WARD",
//            "parentId" => $id_huyen
//        ]  );

//        $wards = $response->data;
        $html = '<option value="default">Chọn Phường/Xã</option>';
        foreach ($wards as $k => $ward) {
            $html .= '<option value="' . $ward->id . '">' . $ward->_name . '</option>';
        }
        return $html;
    }

    public function addWishlist(Request $request, $id)
    {

        $item = Course_course::find($id);
        if (!$item) {
            return redirect()->back();
        }
        $ids = session()->get('items.wishlist');
        if (!$ids) {
            session()->push('items.wishlist', $id);
        } else {
            if (!in_array($id, $ids)) {
                session()->push('items.wishlist', $id);
            } else {
                // thông báo trùng
                \Session::flash('error', 'Đã tồn tại trong danh sách khóa học yêu thích');
                return redirect()->back();
            }
        }
        \Session::flash('success', 'Thêm khóa học vào danh sách yêu thích thành công');
        return redirect()->back();
    }

    public function showWishlist()
    {
        $id = session()->get('items.wishlist');
        $data = [];
        if (is_array($id)) {
            $data = Course_course::where('status', 'active')->whereIn('id', $id)->get();
        }

//        foreach($item as $i ){
//            $data  = $i->find($id);
//        }
        return view(config("edushop.end-user.pathView") . "wishlistCourse", compact('data'));
    }

    public function getShipping(Request $request)
    {
        if ($request->address_id) {
            $address = Address::find($request->address_id);
            $to_province = $address->CityName;
            $to_district = $address->DistrictName;
            // $to_ward = $address->WardName;

            $ship_fee = $this->getKhoAddress($to_province, $to_district);
            return $ship_fee;
        } elseif ($request->province_name && $request->district_name) {
            $to_province = $request->province_name;
            $to_district = $request->district_name;
            $ship_fee = $this->getKhoAddress($to_province, $to_district);
            return $ship_fee;
        }
        return 0;

    }
    public function getPriceShipping(Request $request)
    {
        $tong = 0;
        if (Session('Cart')) {
            foreach(Session('Cart')->products as $products) {
                if (!empty($products['productInfo']['weight'])){
                    $tong +=  ($products['quanty'] * $products['productInfo']['weight']);
                }
            }
        }

        $ship_fee_district = \App\Ship_fee_district::where('name','like','%'.($request->province_name).'%')->where('type', $request->type)->first();
        $fee_ship = $ship_fee_district->fee_ship??0;

        return response()->json([
            'fee_ship' => $fee_ship * $tong,
        ]);

    }
    public function getKhoAddress($province_to, $district_to)
    {
        $carts = \Cart::getContent();
        $arrKho = [];
        foreach ($carts as $k => $cart) {
            $type = $cart->attributes->type;
            if ($type == "product") {
                $id = explode("-", $cart->id)[1];
                $product = Product_products::find($id);
                $warehouse = $product->warehouse;
                $product->quantity = $cart->quantity;
                $arrKho[$warehouse->id][] = $product;
            } elseif ($type == "course") {
                $id = explode("-", $cart->id)[1];
                $course = Course_course::find($id);
                if (isset($cart->attributes['compo_id'])) {
                    $compo_id = $cart->attributes['compo_id'];
                    $compo = Compo::find($compo_id);
                    if ($compo) {
                        // lấy kho hàng
                        if ($compo->ship_fee != 1) {
                            $warehouse = $compo->warehouse;
                            $arrKho[$warehouse->id][] = $compo;
                        }
                    }
                }


            }
        }
        $totalShip = 0;
        // lấy kết quả theo kho
        foreach ($arrKho as $k => $kho) {
            $warehouse = Warehouse::find($k);
            $totalWeight = $this->getTotalWeight($kho);
            if ($totalWeight <= 0) {
                $fee = 0;
            } else {
                $from['CityName'] = $warehouse->CityName;
                $from['DistrictName'] = $warehouse->DistrictName;
                // $from['WardName'] = $warehouse->WardName;

                $to['CityName'] = $province_to;
                $to['DistrictName'] = $district_to;
                //  $to['WardName'] =  $to_ward;
                $fee = $this->getFeeFromApi($from, $to, $totalWeight);
            }
            //dd($kho);
            $totalShip += $fee;

        }
        return $totalShip;
    }

    public function getFeeFromApi($from, $to, $weight)
    {
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

        $res = json_decode($response, true);
        if (isset($res['success']) && $res['success']) {
            return $res['fee']['fee'];
        } else {
            return 0;
        }

    }

    public function getTotalWeight($products)
    {
        $sum = 0;
        foreach ($products as $k => $product) {
            $className = get_class($product);
            if ($className == "App\Compo") {
                $sum += $product->weight;
            } else {
                $sum += $product->weight * $product->quantity;
            }

        }
        return $sum;
    }

    public function getDonViTheoId($data, $id)
    {
        foreach ($data as $k => $item) {
            if ($item->carrierId == $id) {
                return $item;
            }
        }
    }

    public function getDonViTheoTen($data, $name)
    {
        foreach ($data as $k => $item) {
            if ($item->carrierName == "Giaohangnhanh") {
                return $item;
            }
        }
    }
}
