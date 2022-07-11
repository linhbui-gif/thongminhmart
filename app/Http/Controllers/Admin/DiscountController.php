<?php

namespace App\Http\Controllers\Admin;

use App\Helper\Common;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Discount as MainModel;
use Illuminate\Support\Facades\Hash;
use Session;

class DiscountController extends AdminController
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
        [ 'name' => 'amount', 'label' => 'Amount', 'type' => 'text'],

        [ 'name' => 'start_date', 'label' => 'Start date', 'type' => 'text' ],
        [ 'name' => 'end_date', 'label' => 'End date', 'type' => 'text' ],
        [ 'name' => 'status', 'label' => 'Status', 'type' => 'status'],
    ];
    protected $formFields = [
        'general_tab' => [
            'label_tab' => 'General',
            'items' => [
                [ 'label' => 'Name' ,'name' => 'name', 'type' => 'text'],
                [ 'label' => 'Amount' ,'name' => 'amount', 'type' => 'text'],
                [ 'label' => 'Start date' ,'name' => 'start_date', 'type' => 'datepicker'],
                [ 'label' => 'End date' ,'name' => 'end_date', 'type' => 'datepicker'],
                [ 'label' => 'Status' ,'name' => 'status', 'type' => 'status'],
            ]
        ]
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
            'name' => 'required|min:3|max:50',
            'amount' => "required|min:1|max:30",
            'start_date' => "required",
            'end_date' => "required",
        ],[
            'required' => ":attribute không được để trống",
            'min' => ":attribute ít nhất :min ký tự",
            'max' => ":attribute vượt quá :max ký tự"
        ],[
            'name' => 'Tên',
            'amount' => 'Số dư',
            'start_date' => "Ngày bắt đầu",
            'end_date' => "Ngày kết thúc",
        ]);
    }
    // option validate Update
    protected function validateUpdate(Request $request, $id = ""){
        $request->validate([
            'name' => 'required|min:3|max:50',
            'amount' => "required|min:1|max:30",
            'start_date' => "required",
            'end_date' => "required",
        ],[
            'required' => ":attribute không được để trống",
            'min' => ":attribute ít nhất :min ký tự",
            'max' => ":attribute vượt quá :max ký tự"
        ],[
            'name' => 'Tên',
            'amount' => 'Số dư',
            'start_date' => "Ngày bắt đầu",
            'end_date' => "Ngày kết thúc",
        ]);
    }

}
