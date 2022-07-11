<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AdminController;
use App\Role as MainModel;
use App\Helper\Common;

use Carbon\Carbon;
use App\Helper\Log;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Session;

class RoleController extends AdminController
{
    protected $pathView = "admin.page.role.";
    protected $config = [
        'pagination' => 10,
        'resizeImage' => [
            'thumb' => ['width' => 100],
            'standard' => ['width' => 300]
        ]
    ];
    protected $listFields = [
        [ 'name' => 'id', 'label' => 'Id', 'type' => 'text'],
        [ 'name' => 'name', 'label' => 'Name', 'type' => 'text'],
        [ 'name' => 'created_by', 'label' => 'Created by', 'type' => 'text_foreign'],
        [ 'name' => 'updated_by', 'label' => 'Updated by', 'type' => 'text_foreign'],
        [ 'name' => 'created_at', 'label' => 'Created At', 'type' => 'datetime', 'format' => 'd/m/Y' ],
        [ 'name' => 'updated_at', 'label' => 'Updated At', 'type' => 'datetime', 'format' => 'd/m/Y' ],
    ];
    protected $formFields = [
        'general_tab' => [
            'label_tab' => 'Data',
            'items' => [
                [ 'label' => 'Role Name' ,'name' => 'name', 'type' => 'text'],
            ]
        ],

    ];
    protected $searchList = [
        'all' => 'Search By All',
        'id' => 'Search By Id',
        'name' => 'Search By Name'
    ];
    protected $notAcceptedCrud = [  '_token', 'password_confirmation','role_id'];
    public function __construct(){
        $controller = (new \ReflectionClass($this))->getShortName();
        $shortController = Common::getShortNameController($controller);
        $this->controllerName = $shortController;
        $this->folderUpload = $shortController;
        $this->logFolder = $shortController;
        view()->share("controller", $shortController);
        view()->share("pathView", $this->pathView);
        view()->share("formFields", $this->formFields);
        view()->share("listFields", $this->listFields);
        view()->share("searchList", $this->searchList);
        view()->share("controllerName", $this->controllerName);
        $this->model = new MainModel();
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);
        $permissionRequest = $request->permission;
        $dataPermission = [];
        foreach($permissionRequest as $k => $module){
            foreach($module as $action => $item){
                if($item == 1){
                    $flag = true;
                }elseif($item == -1) {
                    $flag = false;
                }
                $dataPermission[$k . "." . $action] = $flag;
            }

        }
        $strPermission = json_encode($dataPermission);
        $data = $this->getDataForm($request->all());
        foreach ($data as $k => $v) {
            $this->model->$k = $v;
        }
        $this->model->permissions = $strPermission;

        $user = \Auth::user();
        $this->model->created_by = $user->id;
        
        $this->model->save();

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
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
        ]);
        $this->model = MainModel::find($id);
        $permissionRequest = $request->permission;
        $dataPermission = [];
        foreach($permissionRequest as $k => $module){
            foreach($module as $action => $item){
                if($item == 1){
                    $flag = true;
                }elseif($item == -1) {
                    $flag = false;
                }
                $dataPermission[$k . "." . $action] = $flag;
            }

        }
        $strPermission = json_encode($dataPermission);
        $data = $this->getDataForm($request->all());
        foreach ($data as $k => $v) {
            $this->model->$k = $v;
        }
        $this->model->permissions = $strPermission;
        $this->model->updated_by = $request->user()->id;
        $this->model->save();

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

    public function deleteMain($id){
        $model = $this->model->find($id);

        $modelRawValues = array_values($model->toArray())[1];
        $modelRawKeys = array_keys($model->toArray())[1];

        $model->users()->detach();
        $model->delete();

        $controller = (new \ReflectionClass($this))->getShortName();
        $shortController = Common::getShortNameController($controller);
        $this->logFolder = $shortController;

        if($this->logFolder){
            $time = Carbon::now()->format('H:i:s');
            $message = "[$time] " . Auth::user()->email . " delete id: $id, $modelRawKeys: $modelRawValues";
            $log = new Log($this->logFolder);
            $log->put("log-" . date("Y-m-d"), $message);
        }

    }
    public function destroy($id){
        if($id != 1){
            $this->deleteMain($id);
            Session::flash('success', 'Bạn đã xóa thành công');
        }else{
            Session::flash('success', 'Quyền này không được xóa');
        }
        return redirect()->route('admin.' . $this->controllerName . ".index");
    }
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
}
