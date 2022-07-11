<?php

namespace App\Http\Controllers\Admin;

use App\Helper\Common;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Bank as MainModel;
use Illuminate\Support\Facades\Hash;
use Session;

class BankController extends AdminController
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
        [ 'name' => 'url_picture', 'label' => 'Picture', 'type' => 'thumb_url'],
        [ 'name' => 'name', 'label' => 'Name', 'type' => 'text'],
        [ 'label' => 'Số tài khoản' ,'name' => 'stk', 'type' => 'text'],
        [ 'label' => 'Chủ tài khoản' ,'name' => 'chutaikhoan', 'type' => 'text'],
        [ 'label' => 'Chi nhánh' ,'name' => 'chinhanh', 'type' => 'text'],
//        [ 'label' => 'Picture' ,'name' => 'picture', 'type' => 'file'],
        [ 'name' => 'status', 'label' => 'Status', 'type' => 'status'],
//        [ 'name' => 'created_at', 'label' => 'Created At', 'type' => 'datetime', 'format' => 'd/m/Y' ],
//        [ 'name' => 'updated_at', 'label' => 'Updated At', 'type' => 'datetime', 'format' => 'd/m/Y' ],
    ];
    protected $formFields = [
        'general_tab' => [
            'label_tab' => 'General',
            'items' => [
                [ 'label' => 'Tên ngân hàng' ,'name' => 'name', 'type' => 'text'],
                [ 'label' => 'Số tài khoản' ,'name' => 'stk', 'type' => 'text'],
                [ 'label' => 'Chủ tài khoản' ,'name' => 'chutaikhoan', 'type' => 'text'],
                [ 'label' => 'Chi nhánh' ,'name' => 'chinhanh', 'type' => 'text'],
                [ 'label' => 'Picture' ,'name' => 'url_picture', 'type' => 'file_from_url'],
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
            'name' => 'required|min:3',
            'stk' => "required|min:3",
            'chutaikhoan' => "required|min:3",
            'chinhanh' => "",
            'picture' => "required",
        ],[
            'required' => ":attribute không được để trống",
            'min' => ":attribute ít nhất :min ký tự",
            
            'exists' => ":attribute phải được chọn",
            'integer' => ":attribute phải là một con số",
        ],[
            'name' => 'Tên',
            'stk' => 'Mô tả ngắn',
            'chutaikhoan' => 'Chủ tài khoản ',
            'chinhanh' => 'Tên chi nhánh',
            'picture' => 'Hình ảnh',
        ]);
    }
    // option validate Update
    protected function validateUpdate(Request $request, $id = ""){
        $request->validate([
            'name' => 'required|min:3',
            'stk' => "required|min:3",
            'chutaikhoan' => "required|min:3",
            'chinhanh' => "",
        ],[
            'required' => ":attribute không được để trống",
            'min' => ":attribute ít nhất :min ký tự",
            
            'exists' => ":attribute phải được chọn",
            'integer' => ":attribute phải là một con số",
        ],[
            'name' => 'Tên',
            'stk' => 'Mô tả ngắn',
            'chutaikhoan' => 'Chủ tài khoản ',
            'chinhanh' => 'Tên chi nhánh',
        ]);
    }

}
