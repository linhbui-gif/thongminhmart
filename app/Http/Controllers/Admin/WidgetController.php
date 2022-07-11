<?php

namespace App\Http\Controllers\Admin;

use App\Helper\Common;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Widget as MainModel;
use Illuminate\Support\Facades\Hash;
use Session;

class WidgetController extends AdminController
{
    protected $pathView = "admin.page.widget.";
    protected $config = [
        'pagination' => 10,
        'resizeImage' => [
            'thumb' => ['width' => 100],
            'standard' => ['width' => 300]
        ]
    ];
    protected $listFields = [
        [ 'name' => 'id', 'label' => 'Id', 'type' => 'text'],
        [ 'name' => 'name', 'label' => 'Tên khối', 'type' => 'text'],
//        [ 'name' => 'content', 'label' => 'Content', 'type' => 'text'],
        [ 'name' => 'location', 'label' => 'Vị trí', 'type' => 'text_in_array', 'data_source' =>  [
            'footer_description' => 'Footer - Mô tả chung',
            'timeline' => 'Khối TimeLine',
            'footer_block_1' => 'Footer - Khối 1',
            'footer_block_2'  => 'Footer - Khối 2',
            'footer_block_3'  => 'Footer - Khối 3',
            'footer_block_4'  => 'Footer - Khối 4',
            'chitiet'  => 'Chi tiết về chúng tôi',
            'team_title'  => 'Khối team',
            'contact_title'  => 'Khối liên hệ',
            'footer_block_bottom'  => 'Footer - Copyright',
            'contact_content_left'  => 'Contact content left',
            'contact_content_right'  => 'Contact content right',
        ] ],
        [ 'name' => 'created_by', 'label' => 'Created by', 'type' => 'text_foreign'],
        [ 'name' => 'updated_by', 'label' => 'Updated by', 'type' => 'text_foreign'],
        [ 'name' => 'created_at', 'label' => 'Created At', 'type' => 'datetime', 'format' => 'd/m/Y' ],
        [ 'name' => 'updated_at', 'label' => 'Updated At', 'type' => 'datetime', 'format' => 'd/m/Y' ],
    ];
    protected $formFields = [
        'general_tab' => [
            'label_tab' => 'General',
            'items' => [
                [ 'label' => 'Tên khối' ,'name' => 'name', 'type' => 'text'],
                [ 'label' => 'Thời gian' ,'name' => 'date', 'type' => 'text'],
                [ 'label' => 'Vị trí hiển thị' ,'name' => 'location', 'type' => 'select','data_source' =>
                    [
                        'footer_description' => 'Footer - Mô tả chung',
                        'timeline' => 'Khối TimeLine',
                        'footer_block_1' => 'Footer - Khối 1',
                        'footer_block_2'  => 'Footer - Khối 2',
                        'footer_block_3'  => 'Footer - Khối 3',
                        'footer_block_4'  => 'Footer - Khối 4',
                        'chitiet'  => 'Chi tiết về chúng tôi',
                        'team_title'  => 'Khối team',
                        'contact_title'  => 'Khối liên hệ',
                        'footer_block_bottom'  => 'Footer - Copyright',
                        'contact_content_left'  => 'Contact content left',
                        'contact_content_right'  => 'Contact content right',
                    ]
                ],
                [ 'name' => 'order_no', 'label' => 'Số thứ tự hiển thị timeline', 'type' => 'text'],
                [ 'label' => 'Nội dung' ,'name' => 'content', 'type' => 'ckeditor'],

            ]
        ],
        'general_tab_ko' => [
            'label_tab' => 'General (Korean)',
            'items' => [
                [ 'label' => 'Name' ,'name' => 'name_ko', 'type' => 'text'],
                [ 'label' => 'Button Name' ,'name' => 'date_ko', 'type' => 'text'],
                [ 'label' => 'Content' ,'name' => 'content_ko', 'type' => 'ckeditor']
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

    }
    // option validate Update
    protected function validateUpdate(Request $request, $id = ""){

    }

}
