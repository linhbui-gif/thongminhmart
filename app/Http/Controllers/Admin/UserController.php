<?php

namespace App\Http\Controllers\Admin;

use App\Helper\Common;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\Helper\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\User as MainModel;
use Illuminate\Support\Facades\Hash;
use Session;

class UserController extends AdminController
{
    protected $pathView = "admin.page.user.";
    protected $config = [
        'pagination' => 50,
        'resizeImage' => [
            'thumb' => ['width' => 100],
            'standard' => ['width' => 300]
        ]
    ];
    protected $listFields = [
        [ 'name' => 'id', 'label' => 'Id', 'type' => 'text'],
        [ 'name' => 'email', 'label' => 'Email', 'type' => 'text'],
        [ 'name' => 'url_picture', 'label' => 'Picture', 'type' => 'thumb_url'],
        [ 'name' => 'first_name', 'label' => 'First Name', 'type' => 'text'],
        [ 'name' => 'last_name', 'label' => 'Last Name', 'type' => 'text'],
        [ 'name' => 'status', 'label' => 'Status', 'type' => 'status'],
        // [ 'name' => 'created_by', 'label' => 'Created by', 'type' => 'text_foreign'],
        // [ 'name' => 'updated_by', 'label' => 'Updated by', 'type' => 'text_foreign'],
        [ 'name' => 'created_at', 'label' => 'Created At', 'type' => 'datetime', 'format' => 'd/m/Y' ],
        [ 'name' => 'updated_at', 'label' => 'Updated At', 'type' => 'datetime', 'format' => 'd/m/Y' ],
    ];
    protected $formFields = [
        'general_tab' => [
            'label_tab' => 'General',
            'items' => [
                [ 'label' => 'First Name' ,'name' => 'first_name', 'type' => 'text'],
                [ 'label' => 'Last Name' ,'name' => 'last_name', 'type' => 'text'],
                [ 'label' => 'Email' ,'name' => 'email', 'type' => 'email'],
                [ 'label' => 'Active' ,'name' => 'status', 'type' => 'status'],
                [ 'label' => 'Password' ,'name' => 'password', 'type' => 'password'],
                [ 'label' => 'Re-Password' ,'name' => 'password_confirmation', 'type' => 'password'],
            //    [ 'label' => 'Avatar' ,'name' => 'picture', 'type' => 'file'],
                [ 'label' => 'Avatar' ,'name' => 'url_picture', 'type' => 'file_from_url'],

            ]
        ],
        'role' => [
            'label_tab' => 'Role',
            'items' => [
                [ 'label' => 'Role' ,'name' => 'role_id', 'type' => 'checkbox', 'modal' => \App\Role::class,'key_relave' => 'roles'  ],
            ]
        ]
    ];
    protected $searchList = [
        'all' => 'Search By All',
        'id' => 'Search By Id',
        'email' => 'Search By Email'
    ];
    protected $notAcceptedCrud = [  '_token', 'password_confirmation','role_id'];
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
    // over write Store
    public function store(Request $request)
    {
        $this->validateStore($request);
        $data = $this->getDataForm($request->all());
        if(isset($data['password'])){
            $data['password'] = Hash::make($data['password']);
        }

        foreach ($data as $k => $v) {
            if(is_object($v)){
                $v = $this->uploadThumb($v);
            }
            $this->model->$k = $v;
        }

        $user = \Auth::user();
        $this->model->created_by = $user->id;

        $this->model->save();
        $this->model->roles()->attach($request->role_id);

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
    // over write update
    public function update(Request $request, $id)
    {
        $this->validateUpdate($request, $id);
        $this->model = $this->model->find($id);
        $data = $this->getDataForm($request->all());
        // xử lý datepicker
        $arrDatepicker = $this->getKeyByType('datepicker');

        foreach($arrDatepicker as $k => $keyname){
            $date = $data[$keyname];
            $cDate = Carbon::createFromFormat("d/m/Y", $date, "Asia/Ho_Chi_Minh");
            $dateNew = $cDate->toDateTimeString();
            $data[$keyname] = $dateNew;
        }
        // end datepicker
        if(!isset($data['status'])){
            $this->model->status = "inactive";
        }

        foreach ($data as $k => $v) {
            if(is_object($v)){
                $this->deleteThumb($this->model->{$k});
                $v = $this->uploadThumb($v);
            }
            $this->model->$k = $v;
        }

        $user = \Auth::user();
        $this->model->created_by = $user->id;

        $this->model->save();
        $this->model->roles()->sync($request->role_id);

        $controller = (new \ReflectionClass($this))->getShortName();
        $shortController = Common::getShortNameController($controller);
        $this->logFolder = $shortController;

        if($this->logFolder){
            $time = Carbon::now()->format('H:i:s');
            $message = "[$time] " . Auth::user()->email . " update id: $id";
            $log = new Log($this->logFolder);
            $log->put("log-" . date("Y-m-d"), $message);
        }

        Session::flash('success', 'Bạn đã cập nhật thành công');
        return redirect()->route('admin.' . $this->controllerName . ".index" );
    }
    // over write main xóa
    public function deleteMain($id){

        $model = $this->model->find($id);

        $modelRawValues = array_values($model->toArray())[1];
        $modelRawKeys = array_keys($model->toArray())[1];

        $arrFile = $this->getKeyByType('file');
        if(count($arrFile) > 0){
            foreach($arrFile as $k){
                $this->deleteThumb($model->{$k});

                $controller = (new \ReflectionClass($this))->getShortName();
                $shortController = Common::getShortNameController($controller);
                $this->logFolder = $shortController;

                if($this->logFolder){
                    $time = Carbon::now()->format('H:i:s');
                    $thumb = $model->{$k};
                    $message = "[$time] " . Auth::user()->email . " delete thumb: $thumb";
                    $log = new Log($this->logFolder);
                    $log->put("log-" . date("Y-m-d"), $message);
                }
            }
        }
        $model->roles()->detach();
        $model->delete();

        if($this->logFolder){
            $time = Carbon::now()->format('H:i:s');
            $message = "[$time] " . Auth::user()->email . " delete id: $id, $modelRawKeys: $modelRawValues";
            $log = new Log($this->logFolder);
            $log->put("log-" . date("Y-m-d"), $message);
        }
    }
    // over write Xóa
    public function destroy($id){
        if($id != 1){
            $this->deleteMain($id);
            Session::flash('success', 'Bạn đã xóa thành công');
        }else{
            Session::flash('success', 'Tài khoản này không được xóa');
        }

        return redirect()->route('admin.' . $this->controllerName . ".index");
    }
    // over write Xóa nhiều
    public function multiDestroy(Request $request){
        $cId = $request->cid;
        if(count($cId) > 0){
            foreach($cId as $k => $id){
                if($id != 1){
                    $this->deleteMain($id);
                }
            }
            Session::flash('success', 'Bạn đã xóa thành công');
        }
        return redirect()->route('admin.' . $this->controllerName . ".index");
    }
    // option valudate store
    public function validateStore(Request $request){
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:users,email',
            'status' => 'in:active,inactive',
            'role_id' => 'required',
            'password' => 'required|confirmed'
        ]);
    }
    // option valudate update
    public function validateUpdate(Request $request, $id){
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
            'status' => 'in:active,inactive',
            'role_id' => 'required',
        ]);
    }
    public function changePassword($id)
    {
        $item = $this->model->find($id);
        return view($this->pathView . 'changePassword')->with('item', $item);
    }
    public function updatePassword(Request $request, $id){
        $request->validate([
            'password' => 'required|confirmed',
        ],[
            'required' => ":attribute không được rỗng",
            'confirmed' => ":attribute xác nhận mật khẩu không chính xác",
        ],[
            'password' => 'Mật khẩu'
        ]);
        $item = $this->model->find($id);
        $passnew = \Hash::make($request->password);
        $item->password = $passnew;
        $item->save();

        $controller = (new \ReflectionClass($this))->getShortName();
        $shortController = Common::getShortNameController($controller);
        $this->logFolder = $shortController;

        if($this->logFolder){
            $time = Carbon::now()->format('H:i:s');
            $message = "[$time] " . Auth::user()->email . " update password";
            $log = new Log($this->logFolder);
            $log->put("log-" . date("Y-m-d"), $message);
        }

        Session::flash('success', 'Cập nhật mật khẩu thành công');
        return redirect()->route('admin.' . $this->controllerName . ".index");

    }

}
