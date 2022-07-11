<?php

namespace App\Http\Controllers\Admin;

use App\Helper\Common;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Contact as MainModel;
use Illuminate\Support\Facades\Hash;
use Session;

class ContactController extends AdminController
{
    protected $pathView = "admin.core.";
    protected $config = [
        'pagination' => 10,
        'resizeImage' => [
            'thumb' => ['width' => 100],
            'standard' => ['width' => 300]
        ]
    ];
    protected $listFields = [
        [ 'name' => 'id', 'label' => 'Id', 'type' => 'text'],
        [ 'name' => 'fullname', 'label' => 'Fullname', 'type' => 'text'],
        [ 'name' => 'phone', 'label' => 'Phone', 'type' => 'text'],
        [ 'name' => 'email', 'label' => 'Email', 'type' => 'text'],
        [ 'name' => 'message', 'label' => 'Message', 'type' => 'text'],
//        [ 'name' => 'ip', 'label' => 'Ip', 'type' => 'text'],
//        [ 'name' => 'status', 'label' => 'Status', 'type' => 'status'],
//        [ 'name' => 'created_by', 'label' => 'Created by', 'type' => 'text_foreign'],
//        [ 'name' => 'updated_by', 'label' => 'Updated by', 'type' => 'text_foreign'],
//        [ 'name' => 'created_at', 'label' => 'Created At', 'type' => 'datetime', 'format' => 'd/m/Y' ],
//        [ 'name' => 'updated_at', 'label' => 'Updated At', 'type' => 'datetime', 'format' => 'd/m/Y' ],
    ];
    protected $formFields = [
        'general_tab' => [
            'label_tab' => 'General',
            'items' => [
                [ 'label' => 'Fullname' ,'name' => 'fullname', 'type' => 'text'],
                [ 'label' => 'Phone' ,'name' => 'phone', 'type' => 'text'],
                [ 'label' => 'Email' ,'name' => 'email', 'type' => 'text'],
                [ 'label' => 'Message' ,'name' => 'message', 'type' => 'textarea'],
                [ 'label' => 'Status' ,'name' => 'status', 'type' => 'status'],
            ]
        ]
    ];
    protected $searchList = [
        'all' => 'Search By All',
        'id' => 'Search By Id',
        'fullname' => 'Search By Fullname',
        'phone' => 'Search By Phone',
        'email' => 'Search By Email'
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
    // option validate Store
    protected function validateStore(Request $request){
        $request->validate([
            'fullname' => 'required',
            'phone' => 'required',
            'message' => 'required'
        ],[
            'required' => ":attribute không được để trống",
        ],[
            'fullname' => 'Tên',
            'phone' => 'Điện thoại',
            'message' => 'Thông điệp'
        ]);
    }
    // option validate Update
    protected function validateUpdate(Request $request, $id = ""){

    }

}
