<?php

namespace App\Http\Controllers\Admin;

use App\Compo;
use App\Helper\Common;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Helper\Log;
use Illuminate\Support\Facades\Auth;
use App\Compo as MainModel;
use Illuminate\Support\Facades\Hash;
use Session;

class CompoController extends Controller
{
    public function __construct()
    {
        if(isset($_REQUEST['tab_current'])){
            Session::put('tab_current', $_REQUEST['tab_current']);
        }
    }

    public function store(Request $request){
        $request->validate([
            'name' => 'required',
            'price' => 'required',
            'warehouse_id' => 'required|exists:warehouse,id',
            'weight' => 'required'
        ],[
            'required' => ":attribute không được để trống",
            'exists' => ":attribute không hợp lệ"
        ],[
            'name' => 'Tên',
            'price' => 'Giá',
            'warehouse_id' => 'Kho',
            'weight' => 'Trọng lượng'
        ]);

        $compo = Compo::find($request->compo_id);
        if(!$compo){
            $compo = new Compo();
        }
        $compo->name = $request->name;
        $compo->price = $request->price;
        $compo->course_id = $request->product_id;
        $compo->warehouse_id = $request->warehouse_id;
        $compo->weight = $request->weight;
        $compo->ship_fee = $request->ship_fee;
        $compo->save();

        $controller = (new \ReflectionClass($this))->getShortName();
        $shortController = Common::getShortNameController($controller);
        $this->logFolder = $shortController;

        if($this->logFolder){
            $time = Carbon::now()->format('H:i:s');
            $message = "[$time] " . Auth::user()->email . " create new";
            $log = new Log($this->logFolder);
            $log->put("log-" . date("Y-m-d"), $message);
        }

        return redirect()->back();
    }
    public function delete($id){

        $compo = Compo::find($id)->delete();

        $modelRawValues = array_values($compo->toArray())[1];
        $modelRawKeys = array_keys($compo->toArray())[1];

        $controller = (new \ReflectionClass($this))->getShortName();
        $shortController = Common::getShortNameController($controller);
        $this->logFolder = $shortController;

        if($this->logFolder){
            $time = Carbon::now()->format('H:i:s');
            $message = "[$time] " . Auth::user()->email . " delete id: $id, $modelRawKeys: $modelRawValues";
            $log = new Log($this->logFolder);
            $log->put("log-" . date("Y-m-d"), $message);
        }

        return redirect()->back();
    }
    public function addToCompo(Request $request){
        $compo = Compo::find($request->compo_id);
        $compo->products()->attach($request->product_id, [ 'quantity' => $request->quantity ] );
        return redirect()->back();
    }
    public function deleteItemInCompo(Request $request){
        $compo = Compo::find($request->compo_id);
        $compo->products()->detach($request->product_id);
        return redirect()->back();
    }
    public function changeOrdering(Request $request){
        $ordering = $request->ordering_compo;
        if($ordering && count($ordering) > 0){
            foreach($ordering as $id => $stt){
                $compo = Compo::find($id);
                $compo->ordering = $stt;
                $compo->save();
            }

        }

        $controller = (new \ReflectionClass($this))->getShortName();
        $shortController = Common::getShortNameController($controller);
        $this->logFolder = $shortController;

        if($this->logFolder){
            $time = Carbon::now()->format('H:i:s');
            $message = "[$time] " . Auth::user()->email . " update order";
            $log = new Log($this->logFolder);
            $log->put("log-" . date("Y-m-d"), $message);
        }

        Session::flash('success', 'Cập nhật thứ tự thành công !');
        return redirect()->back();
    }

}
