<?php

namespace App\Http\Controllers\Admin;

use App\Helper\Common;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Controller;
use App\Product_products;
use App\Warehouse;

use Carbon\Carbon;
use App\Helper\Log;
use Illuminate\Support\Facades\Auth;

use App\Warehouse_product;
use Illuminate\Http\Request;
use App\Warehouse as MainModel;
use Illuminate\Support\Facades\Hash;
use Session;

class WarehouseController extends AdminController
{
    protected $pathView = "admin.page.warehouse.";
    protected $config = [
        'pagination' => 10,
        'resizeImage' => [
            'thumb' => ['width' => 100],
            'standard' => ['width' => 300]
        ]
    ];
    public function index(Request $request)
    {
        $params = $request->all();
        $params['search_list'] = $this->searchList;
        $params['search_type'] = isset($params['search_type']) && in_array($params['search_type'], array_flip($this->searchList) ) ? $params['search_type'] : "all";
        $params['search_value'] = isset($params['search_value']) ? $params['search_value'] : "";
        $data['items'] = $this->model->listItems($params, $this->config);
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

        return view($this->pathView . 'index')->with($data);
    }
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
        view()->share("searchList", $this->searchList);
        view()->share("controllerName", $this->controllerName);
        $this->model = new MainModel();
    }
    public function store(Request $request){

        $request->validate([
            'name' => 'required|min:3|max:50',
            'province_id' => "required|integer|not_in:default",
            'district_id' => "required|integer|not_in:default",
            'ward_id' => "required|integer|not_in:default",
            'address' => "required",
            'CityName' => 'required',
            'DistrictName' => 'required',
            'WardName' => 'required',
            'contact_name' => 'required',
            'phone' => 'required',
        ],[
            'required' => ":attribute không được để trống",
            'min' => ":attribute ít nhất :min ký tự",
            'max' => ":attribute vượt quá :max ký tự"
        ],[
            'name' => 'Tên',
            'picture' => 'Hình ảnh',
        ]);
        $user = \Auth::user();
        $item = new Warehouse();
        $item->name = $request->name;
        $item->province_id = $request->province_id;
        $item->district_id = $request->district_id;
        $item->ward_id = $request->ward_id;
        $item->address = $request->address;
        $item->CityName = $request->CityName;
        $item->DistrictName = $request->DistrictName;
        $item->WardName = $request->WardName;
        $item->contact_name = $request->contact_name;
        $item->phone = $request->phone;
        $item->created_by = $user->id;
        $item->status = $request->status ?? "inactive";
        $item->save();

        $controller = (new \ReflectionClass($this))->getShortName();
        $shortController = Common::getShortNameController($controller);
        $this->logFolder = $shortController;

        if($this->logFolder){
            $time = Carbon::now()->format('H:i:s');
            $message = "[$time] " . Auth::user()->email . " create new";
            $log = new Log($this->logFolder);
            $log->put("log-" . date("Y-m-d"), $message);
        }

        Session::flash('success', 'Bạn đã thêm mới thành công');
        return redirect()->route('admin.' . $this->controllerName . ".index" );
    }
    public function update(Request $request, $id){
        $request->validate([
            'name' => 'required|min:3|max:50',
            'province_id' => "required|integer|not_in:default",
            'district_id' => "required|integer|not_in:default",
            'ward_id' => "required|integer|not_in:default",
            'address' => "required",
            'CityName' => 'required',
            'DistrictName' => 'required',
            'WardName' => 'required',
            'contact_name' => 'required',
            'phone' => 'required',
        ],[
            'required' => ":attribute không được để trống",
            'min' => ":attribute ít nhất :min ký tự",
            'max' => ":attribute vượt quá :max ký tự"
        ],[
            'name' => 'Tên',
            'picture' => 'Hình ảnh',
        ]);
        $user = \Auth::user();
        $item =  Warehouse::find($id);
        if(!$user->is_admin()){
            $item->where('updated_by', $user->id);
        }
        if(!$item){
            return redirect()->route('admin.' . $this->controllerName . ".index" );
        }

        $item->name = $request->name;
        $item->province_id = $request->province_id;
        $item->district_id = $request->district_id;
        $item->ward_id = $request->ward_id;
        $item->address = $request->address;
        $item->CityName = $request->CityName;
        $item->DistrictName = $request->DistrictName;
        $item->WardName = $request->WardName;
        $item->contact_name = $request->contact_name;
        $item->phone = $request->phone;
       // $item->created_by = $user->id;
        $item->status = $request->status ?? "inactive";
        $item->updated_by = $user->id;
        $item->save();

        $controller = (new \ReflectionClass($this))->getShortName();
        $shortController = Common::getShortNameController($controller);
        $this->logFolder = $shortController;

        if($this->logFolder){
            $time = Carbon::now()->format('H:i:s');
            $message = "[$time] " . Auth::user()->email . " update id: $id";
            $log = new Log($this->logFolder);
            $log->put("log-" . date("Y-m-d"), $message);
        }


        Session::flash('success', 'Bạn đã thêm mới thành công');
        return redirect()->route('admin.' . $this->controllerName . ".index" );
    }
    public function edit($id)
    {
        $user = \Auth::user();
        $item = $this->model->find($id);
        if(!$user->is_admin()){
            $item->where('created_by', $user->id);
        }
        if(!$item){
            return redirect()->route('admin.' . $this->controllerName . ".index" );
        }
        $item = $this->model->find($id);

        $controller = (new \ReflectionClass($this))->getShortName();
        $shortController = Common::getShortNameController($controller);
        $this->logFolder = $shortController;

        if($this->logFolder){
            $time = Carbon::now()->format('H:i:s');
            $message = "[$time] " . Auth::user()->email . " click button edit";
            $log = new Log($this->logFolder);
            $log->put("log-" . date("Y-m-d"), $message);
        }


        return view($this->pathView . 'formEdit')->with('item', $item);
    }
    // option validate Store
    protected function validateStore(Request $request){
        $request->validate([
            'name' => 'required|min:3|max:50',
            'picture' => "required",
//            'type' => "required",
//            'location' => "required",
        ],[
            'required' => ":attribute không được để trống",
            'min' => ":attribute ít nhất :min ký tự",
            'max' => ":attribute vượt quá :max ký tự"
        ],[
            'name' => 'Tên',
            'picture' => 'Hình ảnh',
//            'type' => "Loại ảnh bìa",
//            'location' => "Vị trí hiển thị",
        ]);
    }
    // option validate Update
    protected function validateUpdate(Request $request, $id = ""){
        $request->validate([
            'name' => 'required|min:3|max:50',
            'picture' => "required",
//            'type' => "required",
//            'location' => "required",
        ],[
            'required' => ":attribute không được để trống",
            'min' => ":attribute ít nhất :min ký tự",
            'max' => ":attribute vượt quá :max ký tự"
        ],[
            'name' => 'Tên',
            'picture' => 'Hình ảnh',
//            'type' => "Loại ảnh bìa",
//            'location' => "Vị trí hiển thị",
        ]);
    }

    public function inputProduct(Request $request){
        $data = [];
        $user = \Auth::user();
        $products = Product_products::where('status','active');
        if(!$user->is_admin()){
            $products->where('created_by', $user->id);
        }
        $products = $products->orderBy('name','ASC')->get();


        $warehouses = Warehouse::where('id','>' , 0);
        if(!$user->is_admin()){
            $warehouses->where('created_by', $user->id);
        }
        $warehouses = $warehouses->orderBy('name','ASC')->get();

        $data['warehouses'] = $warehouses;
        $data['products'] = $products;
        return view($this->pathView . 'inputKho')->with($data);
    }

    public function storeInput(Request $request){
        $request->validate([
            'product_id' => 'required|integer|exists:product_products,id',
            'quantity' => "required|integer",
            'warehouse_id' => 'required|integer|exists:warehouse,id',
        ],[
            'required' => ":attribute không được để trống",
            'integer' => ":attribute không hợp lệ",
            'exists' => ":attribute không tồn tại",
        ],[
            'product_id' => 'Sản phẩm',
            'quantity' => 'Số lượng',
            'warehouse_id' => 'Kho'
        ]);

        $warehouse_product = Warehouse_product::where('product_id',$request->product_id)->first();

        if(!$warehouse_product){
            $warehouse_product = new Warehouse_product();
        }
        $warehouse_product->product_id = $request->product_id;
        $warehouse_product->quantity = $request->quantity;
        $warehouse_product->warehouse_id = $request->warehouse_id;
        $warehouse_product->save();
        return redirect()->back();
    }
    public function getQuantity(Request $request){
        $product_id = $request->product_id;
        $warehouse_id = $request->warehouse_id;

        $tmp = Warehouse_product::where('product_id', $product_id)->where('warehouse_id', $warehouse_id)->first();
        if(!$tmp || $tmp->quantity == null || empty($tmp->quantity)){
            return 0;
        }
        return $tmp->quantity;
    }

}
