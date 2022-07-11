<?php

namespace App\Http\Controllers\Admin;

use App\Comment;
use App\Helper\Common;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Controller;
use App\Lesson;

use Carbon\Carbon;
use App\Helper\Log;
use Illuminate\Support\Facades\Auth;

use App\Tracnghiem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Session;

class TracnghiemController extends Controller
{
    public function __construct()
    {
        if(isset($_REQUEST['tab_current'])){
            Session::put('tab_current', $_REQUEST['tab_current']);
        }


    }
    public function store(Request $request){
        if($request->question_id){
            $tracnghiem = Tracnghiem::find($request->question_id);
            $tracnghiem->content = $request->question_text;
            $tracnghiem->save();
            return redirect()->back();
        }
        $lesson_id = $request->lesson_id;
        $tracnghiem = new Tracnghiem();
        $tracnghiem->lesson_id = $lesson_id;
        $tracnghiem->content = $request->question_text;

        $user = \Auth::user();
        $tracnghiem->created_by = $user->id;

        $tracnghiem->save();

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
    public function update(Request $request){

        $tracnghiem = Tracnghiem::find($request->id);
        if(!$tracnghiem){
            return redirect()->back();
        }
        $tracnghiem->cac_dap_an = json_encode($request->dapan);
        $tracnghiem->dap_an_dung = $request->dapan_dung;
        $tracnghiem->save();

        $controller = (new \ReflectionClass($this))->getShortName();
        $shortController = Common::getShortNameController($controller);
        $this->logFolder = $shortController;

        if($this->logFolder){
            $time = Carbon::now()->format('H:i:s');
            $message = "[$time] " . Auth::user()->email . " update";
            $log = new Log($this->logFolder);
            $log->put("log-" . date("Y-m-d"), $message);
        }

        return redirect()->back();
    }
    public function delete(Request $request, $id){
        $tracnghiem = Tracnghiem::find($id);

        $modelRawValues = array_values($tracnghiem->toArray())[1];
        $modelRawKeys = array_keys($tracnghiem->toArray())[1];

        $tracnghiem->delete();

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
    public function sort(Request $request){
        $arraydata = $request->arraydata;
        foreach($arraydata as $k => $item){
                $id = $item['id'];
                Tracnghiem::where("id", $id)->update([ "order" => $k ]);
        }
    }
}
