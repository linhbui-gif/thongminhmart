<?php

namespace App\Http\Controllers\Admin;

use App\Helper\Common;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Notification as MainModel;
use Illuminate\Support\Facades\Hash;
use Session;

class NotificationController extends AdminController
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
        [ 'name' => 'name', 'label' => 'Name', 'type' => 'text'],
//        [ 'name' => 'description', 'label' => 'Description', 'type' => 'text'],
        [ 'name' => 'date_notification', 'label' => 'Date', 'type' => 'datetime'],
//        [ 'name' => 'location', 'label' => 'Vị trí', 'type' => 'text'],
        [ 'name' => 'status', 'label' => 'Status', 'type' => 'status'],
//        [ 'name' => 'created_at', 'label' => 'Created At', 'type' => 'datetime', 'format' => 'd/m/Y' ],
//        [ 'name' => 'updated_at', 'label' => 'Updated At', 'type' => 'datetime', 'format' => 'd/m/Y' ],
    ];
    protected $formFields = [
        'general_tab' => [
            'label_tab' => 'General',
            'items' => [
                [ 'label' => 'Name' ,'name' => 'name', 'type' => 'text'],
//                [ 'name' => 'description', 'label' => 'Description', 'type' => 'text'],
                [ 'name' => 'content', 'label' => 'Content', 'type' => 'ckeditor'],
//                [ 'name' => 'picture', 'label' => 'Picture', 'type' => 'file'],
                [ 'label' => 'Picture' ,'name' => 'url_picture', 'type' => 'file_from_url'],
                [ 'name' => 'date_notification', 'label' => 'Date', 'type' => 'datepicker', 'format'=> 'd/m/Y'],
                [ 'label' => 'Status' ,'name' => 'status', 'type' => 'status'],
            ]
        ],

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

    // option validate Store
    protected function validateStore(Request $request){
        $request->validate([
            'name' => 'required',
//            'description' => "required|min:3|max:255",
            'date_notification' => "required",
        ],[
            'required' => ":attribute không được để trống",
            'min' => ":attribute ít nhất :min ký tự",
            'max' => ":attribute vượt quá :max ký tự"
        ],[
            'name' => 'Tên',
            'description' => 'Mô tả',
            'date_notification' => "Ngày thông báo",
        ]);
    }
    // option validate Update
    protected function validateUpdate(Request $request, $id = ""){
        $request->validate([
            'name' => 'required',
//            'description' => "required|min:3|max:255",
            'date_notification' => "required",
        ],[
            'required' => ":attribute không được để trống",
            'min' => ":attribute ít nhất :min ký tự",
            'max' => ":attribute vượt quá :max ký tự"
        ],[
            'name' => 'Tên',
            'description' => 'Mô tả',
            'date_notification' => "Ngày thông báo",
        ]);
    }

}
