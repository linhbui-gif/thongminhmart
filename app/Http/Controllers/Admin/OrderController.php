<?php

namespace App\Http\Controllers\Admin;

use App\Helper\Common;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Controller;
use App\Order;
use App\OrderDetail;
use App\Warehouse;
use Illuminate\Http\Request;
use App\Order as MainModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Session;

use Carbon\Carbon;
use App\Helper\Log;
use Illuminate\Support\Facades\Auth;

use Vimeo\Laravel\Facades\Vimeo;
use Illuminate\Support\Str;
use File;
use Illuminate\Support\Facades\Http;

class OrderController extends AdminController
{
    protected $pathView = "admin.page.order.";
    protected $config = [
        'pagination' => 50,
        'resizeImage' => [
            'thumb' => ['width' => 100],
            'standard' => ['width' => 300]
        ]
    ];
    protected $listFields = [

    ];
    protected $formFields = [

    ];
    protected $searchList = [
        'all' => 'Search By All',
        'id' => 'Search By Id',
        'name' => 'Search By Name'
    ];
    protected $notAcceptedCrud = [  '_token'];
    public function __construct(){
        $controller = (new \ReflectionClass($this))->getShortName();
        $shortController = Common::getShortNameController($controller);
        $this->controllerName = $shortController;
        $this->folderUpload = $shortController;
        $this->logFolder = $shortController;
        view()->share("controller", $shortController);
        view()->share("folderUpload", $this->folderUpload);
        view()->share("pathView", $this->pathView);
        view()->share("formFields", $this->formFields);
        view()->share("listFields", $this->listFields);
        view()->share("searchList", $this->searchList);
        view()->share("controllerName", $this->controllerName);
        $this->model = new MainModel();
    }

    public function index(Request $request){
        $params = $request->all();
        $params['search_list'] = $this->searchList;
        $params['search_type'] = isset($params['search_type']) && in_array($params['search_type'], array_flip($this->searchList) ) ? $params['search_type'] : "all";
        $params['search_value'] = isset($params['search_value']) ? $params['search_value'] : "";
        $data['params'] = $params;


        $controller = (new \ReflectionClass($this))->getShortName();
        $shortController = Common::getShortNameController($controller);
        $this->logFolder = $shortController;

        if($this->logFolder){
            $time = Carbon::now()->format('H:i:s');
            $message = "[$time] " . Auth::user()->email . " view";
            $log = new Log($this->logFolder);
            $log->put("log-" . date("Y-m-d"), $message);
        }
        $user = Auth::user();
        $data['items'] = $this->model->listItems($params, $this->config);
        return view($this->pathView . 'index')->with($data);
//        if($user->is_giangvien()){
//            $items = OrderDetail::select("order_detail.*", "course_courses.name")
//                ->join('course_courses', function($join) use($user) {
//                    $join->on('order_detail.product_id', '=', 'course_courses.id')
//                        ->join('users', function($join){
//                            $join->on('course_courses.teacher_id', '=', 'users.id');
//                        })->where('users.id','=', $user->id);
//                })
//                ->where('order_detail.type','=', 'course')->orderBy('order_detail.created_at','desc')->paginate(25);
//            $data['items'] = $items;
//            return view($this->pathView . 'order_giangvien')->with($data);
//        }else{
//            $data['items'] = $this->model->listItems($params, $this->config);
//            return view($this->pathView . 'index')->with($data);
//        }


    }
    public function changeStatusCourse(Request $request, $order_detail_id){
        $user = \Auth::user();
        if($user->is_admin()){
            $detail = OrderDetail::find($order_detail_id);
            $order = $detail->order;

            $course_id = $detail->product_id;
            $user = $order->user;
            //$user->course()->
            $piot = DB::table('users_course')->where('user_id',$user->id)->where('course_id', $course_id)->first();
            if($request->action == "inactive"){
                // hủy khóa học
                $user->courses()->detach([ $course_id  ]);
            }else{
                // kích hoạt khóa học
                if(!$piot){
                    $user->courses()->attach([ $course_id  ]);
                }
            }

        }else{

        }

        $controller = (new \ReflectionClass($this))->getShortName();
        $shortController = Common::getShortNameController($controller);
        $this->logFolder = $shortController;

        if($this->logFolder){
            $time = Carbon::now()->format('H:i:s');
            $message = "[$time] " . Auth::user()->email . " change status order detail id: $order_detail_id";
            $log = new Log($this->logFolder);
            $log->put("log-" . date("Y-m-d"), $message);
        }

        Session::flash('success', 'Thay đổi trạng thái khóa học thành công');
        return redirect()->back();
    }
    public function detail(Request $request, $order_id){
        $order = Order::find($order_id);
        $data['order'] = $order;

        $controller = (new \ReflectionClass($this))->getShortName();
        $shortController = Common::getShortNameController($controller);
        $this->logFolder = $shortController;

        if($this->logFolder){
            $time = Carbon::now()->format('H:i:s');
            $message = "[$time] " . Auth::user()->email . " show detail order: $order_id";
            $log = new Log($this->logFolder);
            $log->put("log-" . date("Y-m-d"), $message);
        }

        return view($this->pathView . 'view')->with($data);
    }
    public function changeStatus(Request $request,$id){
        $order = Order::find($id);
        $order_status = $request->status_order;
        $order->trangthai = $order_status;
        $order->save();

        $details = $order->details()->where('type' , 'like', '%course%')->get();

        $arrIdCourse = [];
        foreach($details as $k => $detail){
            $course = $detail->getProduct()->first();
            $arrIdCourse[] = $course->id;
        }
        $user = $order->user;
        if($order_status == 4){
            $user->courses()->sync($arrIdCourse);
        }else if($order_status == 5){
            $user->courses()->detach($arrIdCourse);
        }

        $controller = (new \ReflectionClass($this))->getShortName();
        $shortController = Common::getShortNameController($controller);
        $this->logFolder = $shortController;

        if($this->logFolder){
            $time = Carbon::now()->format('H:i:s');
            $message = "[$time] " . Auth::user()->email . " change status order id: $id";
            $log = new Log($this->logFolder);
            $log->put("log-" . date("Y-m-d"), $message);
        }

        Session::flash('success', 'Trạng thái đơn hàng được cập nhật thành công');
        return redirect()->back();

    }
    public function thongke(Request $request){

        $controller = (new \ReflectionClass($this))->getShortName();
        $shortController = Common::getShortNameController($controller);
        $this->logFolder = $shortController;

        if($this->logFolder){
            $time = Carbon::now()->format('H:i:s');
            $message = "[$time] " . Auth::user()->email . " thong ke";
            $log = new Log($this->logFolder);
            $log->put("log-" . date("Y-m-d"), $message);
        }

        return view($this->pathView . 'thongke');
    }
    public function getDataStatistic(Request $request){

        $data = \App\Statistic::orderBy('order_date','ASC');
        if($request->from_date && $request->to_date){
            $from_date = date_create_from_format('d/m/Y', $request->from_date)->format("Y-m-d");
            $to_date = date_create_from_format('d/m/Y', $request->to_date)->format("Y-m-d");
            $data->whereBetween("order_date", [$from_date, $to_date]);
        }
        $data = $data->get();
        $chart_data = [];
        foreach($data as $k => $val){
            $date = date("d-m-Y", strtotime($val->order_date));
            $chart_data[] = [
                'period' => $date,
                'order' => $val->total_order,
                'sales' => $val->sales,
                'quantity' => $val->quantity,
            ];
        }
        echo $data = json_encode($chart_data);
    }

    public function postGHTK($order_id, $warehouse_id){
        $order = Order::find($order_id);
        $warehouse = Warehouse::find($warehouse_id);
        $details = $order->details()->where('order_detail.kho_id' , $warehouse_id)->get();
        $sub_order_id = $details[0]->sub_order_id;


        $config = config('edushop.status_gthk');
        $address = $order->address;
        $user = $order->user;
        $thongtinnoinhan = [
                'tel' => $address->phone,
                'name' => !empty($address->fullname) ? $address->fullname : $user->fullname(),
                'address' => $address->address,
                'province' => $address->CityName,
                'district' => $address->DistrictName,
                'ward' => $address->WardName,
                "hamlet" => "Khác",
            ];

        $madonhang = 'dh' . Str::random(6) . '_' . $order_id;
        $totalPriceInKho = $this->getTotalPriceDetails($details);
        $noigui = [
                    'id' => $madonhang,
                    'pick_name' => $warehouse->contact_name,
                    'pick_address' => $warehouse->address,
                    'pick_province' => $warehouse->CityName,
                    'pick_district' => $warehouse->DistrictName,
                    'pick_ward' => $warehouse->WardName,
                    'pick_tel' => $warehouse->phone,
                    'value' => $totalPriceInKho
                ];
        if ($order->pay_method == "cod") {
            $noigui['pick_option'] = 'cod';
            $noigui['pick_money'] = $totalPriceInKho;
        } else {
            $noigui['pick_money'] = 0;
        }
        $products = [];
        foreach($details as $k => $detail){
            $item = [
                'name' => $detail->product_name,
                'weight' => $detail->weight / 1000,
                'quantity' => $detail->quantity,
                'product_code' => $detail->product_id,
                'price' => (int)$detail->product_price
            ];
            $products[] = $item;
        }


        $dataPost = [
            'products' =>   $products,
            'order' => $thongtinnoinhan + $noigui
        ];
        $response = $this->createOrderGHTK($dataPost);
        $response = json_decode($response, true);

        $totalWeight = $this->getTotalWeightDetails($details);
        $ship_fee_by_ware_house  = 0;
        if($totalWeight > 0){
            $from = [ 'CityName' => $warehouse->CityName, 'DistrictName' => $warehouse->DistrictName ];
            $to = [ 'CityName' => $address->CityName, 'DistrictName' => $address->DistrictName ];
            $ship_fee_by_ware_house = $this->getFeeFromApi($from , $to, $totalWeight);
        }

        $suborder = \App\OrderSub::find($sub_order_id);
        $suborder->status_code = $response['order']['status_id'];
        $suborder->mavandon = $response['order']['label'];
        $suborder->status = $config[$suborder->status_code];
        $suborder->save();
        // cập nhật lại chi tiếc đơn hàng thuộc sub order nào
        OrderDetail::where('order_id', $order_id)->where('kho_id', $warehouse_id)->update(['sub_order_id' => $suborder->id]);

        Session::flash('success', 'Đã gửi đơn hàng sang GHTK thành công');
        return redirect()->back();



    }
    public function createOrderGHTK($data)
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

    public function getTotalPriceDetails($details){
        $total = 0;
        foreach($details as $k => $detail){
            $total += $detail->total;
        }
        return $total;
    }
    public function getTotalWeightDetails($details){
        $total = 0;
        foreach($details as $k => $detail){
            $total += $detail->weight;
        }
        return $total;
    }
}
