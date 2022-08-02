<?php

namespace App\Http\Controllers\Admin;

use App\Helper\Common;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Banner as MainModel;
use Illuminate\Support\Facades\Hash;
use Session;

class BannerController extends AdminController
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
        [ 'name' => 'picture', 'label' => 'Picture', 'type' => 'thumb_url'],
        [ 'name' => 'location', 'label' => 'Vị trí', 'type' => 'text'],
        [ 'name' => 'status', 'label' => 'Status', 'type' => 'status'],
        [ 'name' => 'created_by', 'label' => 'Created by', 'type' => 'text_foreign'],
        [ 'name' => 'updated_by', 'label' => 'Updated by', 'type' => 'text_foreign'],
        [ 'name' => 'created_at', 'label' => 'Created At', 'type' => 'datetime', 'format' => 'd/m/Y' ],
        [ 'name' => 'updated_at', 'label' => 'Updated At', 'type' => 'datetime', 'format' => 'd/m/Y' ],
    ];
    protected $formFields = [
        'general_tab' => [
            'label_tab' => 'General',
            'items' => [
                [ 'label' => 'Name' ,'name' => 'name', 'type' => 'text'],
                [ 'label' => 'Tiêu đề' ,'name' => 'title', 'type' => 'text'],
                [ 'label' => 'Mô tả' ,'name' => 'description', 'type' => 'ckeditor'],
                [ 'label' => 'Picture' ,'name' => 'picture', 'type' => 'file_from_url'],
                [ 'label' => 'Picture version mobile slider Home' ,'name' => 'url_picture_mobile', 'type' => 'file_from_url'],
//                [ 'label' => 'Gallery' ,'name' => 'gallery', 'type' => 'gallery'],
                [ 'label' => 'Type' ,'name' => 'type', 'type' => 'select','data_source' =>
                    [
                        '0' => 'Hiển thị là banner',
                        '1' => 'Hiển thị là slider',
                    ]
                ],
                [ 'label' => 'Vị trí hiển thị' ,'name' => 'location', 'type' => 'select','data_source' =>
                    [
                        'banner_about_page' => 'Hiển thị banner trang giới thiệu',
                        'banner_team' => 'Hiển thị banner team',
                        'banner_home' => 'Hiển thị Banner trang chủ',
                        'banner_dt' => 'Hiển thị Banner khối du thuyền',
                        'banner_acti' => 'Hiển thị Banner khối các hoạt động',
                        'banner_partner' => 'Hiển thị Banner đối tác',
                        'banner_dv' => 'Hiển thị Banner khối dịch vụ',
                        'banner_dv_page' => 'Hiển thị Banner trang dịch vụ',
                        'banner_about' => 'Hiển thị Banner khối giới thiệu ',
                    ]
                ],
                [ 'label' => 'Link ' ,'name' => 'link', 'type' => 'text'],
                [ 'name' => 'button_name', 'label' => 'Tên button', 'type' => 'text'],
                [ 'name' => 'order_no', 'label' => 'Số thứ tự', 'type' => 'text'],
                [ 'label' => 'Status' ,'name' => 'status', 'type' => 'status'],
            ]
        ],
//        'general_tab_ko' => [
//            'label_tab' => 'General (Korean)',
//            'items' => [
//                [ 'label' => 'Name' ,'name' => 'name_ko', 'type' => 'text'],
//                [ 'label' => 'Title' ,'name' => 'title_ko', 'type' => 'text'],
//                [ 'name' => 'button_name_ko', 'label' => 'Tên button', 'type' => 'text'],
//                [ 'label' => 'Mô tả' ,'name' => 'description_ko', 'type' => 'ckeditor']
//            ]
//        ],
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
//            'picture' => "required",
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
            'name' => 'required|min:3',
//            'type' => "required",
//            'location' => "required",
        ],[
            'required' => ":attribute không được để trống",
            'min' => ":attribute ít nhất :min ký tự",
            'max' => ":attribute vượt quá :max ký tự"
        ],[
            'name' => 'Tên'
//            'type' => "Loại ảnh bìa",
//            'location' => "Vị trí hiển thị",
        ]);
    }

}
