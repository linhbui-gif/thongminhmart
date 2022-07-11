<?php

namespace App\Http\Controllers\Admin;

use App\Comment;
use App\Helper\Common;
use App\Http\Controllers\AdminController;
use Carbon\Carbon;
use App\Helper\Log;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Session;

class CommentController extends Controller
{
    public function __construct()
    {

        if(isset($_GET['tab_current'])){
            Session::put('tab_current', $_GET['tab_current']);
        }

    }
    public function delete(Request $request, $id){

            $comment = Comment::find($id);

            $modelRawValues = array_values($comment->toArray())[1];
            $modelRawKeys = array_keys($comment->toArray())[1];

            $comment->delete();

            $controller = (new \ReflectionClass($this))->getShortName();
            $shortController = Common::getShortNameController($controller);
            $this->logFolder = $shortController;
    
            if($this->logFolder){
                $time = Carbon::now()->format('H:i:s');
                $message = "[$time] " . Auth::user()->email . " delete id: $id, $modelRawKeys: $modelRawValues";
                $log = new Log($this->logFolder);
                $log->put("log-" . date("Y-m-d"), $message);
            }

            Session::flash('success', 'Bạn xóa thành công');
            return redirect()->back();
    }
    public function changeShow(Request $request, $id, $show){
        $show = $show == 0 ? 1 : 0;
        $comment = Comment::find($id);
        $comment->show_page_review = $show;
        $comment->save();

        $controller = (new \ReflectionClass($this))->getShortName();
        $shortController = Common::getShortNameController($controller);
        $this->logFolder = $shortController;

        if($this->logFolder){
            $time = Carbon::now()->format('H:i:s');
            $message = "[$time] " . Auth::user()->email . " change";
            $log = new Log($this->logFolder);
            $log->put("log-" . date("Y-m-d"), $message);
        }

        Session::flash('success', 'Bạn cập nhật thành công');
        return redirect()->back();
    }

}
