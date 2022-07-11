<?php

namespace App\Http\Controllers\Admin;

use App\Helper\Common;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Product_products as MainModel;
use Illuminate\Support\Facades\Hash;
use Session;

class Product_productsController extends AdminController
{
    protected $pathView = "admin.page.product.";
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
//        [ 'name' => 'price_base', 'label' => 'Price Base', 'type' => 'text'],
        [ 'name' => 'url_picture', 'label' => 'Picture', 'type' => 'thumb_url'],
//        [ 'name' => 'quantity', 'label' => 'Số lượng', 'type' => 'text'],
//        [ 'name' => 'warehouse_id', 'label' => 'Kho', 'type' => 'custome_kho' ],
        [ 'name' => 'order_no', 'label' => 'Số thứ tự', 'type' => 'text'],
        [ 'name' => 'status', 'label' => 'Status', 'type' => 'status'],
//        [ 'name' => 'created_by', 'label' => 'Created by', 'type' => 'text_foreign'],
//        [ 'name' => 'updated_by', 'label' => 'Updated by', 'type' => 'text_foreign'],
//        [ 'name' => 'created_at', 'label' => 'Created At', 'type' => 'datetime', 'format' => 'd/m/Y' ],
//        [ 'name' => 'updated_at', 'label' => 'Updated At', 'type' => 'datetime', 'format' => 'd/m/Y' ],
    ];
    protected $formFields = [
        'general_tab' => [
            'label_tab' => 'General',
            'items' => [
                [ 'label' => 'Name' ,'name' => 'name', 'type' => 'text'],
                [ 'label' => 'Price Base' ,'name' => 'price_base', 'type' => 'text'],
                [ 'label' => 'Price Final' ,'name' => 'price_final', 'type' => 'text'],
//                [ 'label' => 'Weight (gr)' ,'name' => 'weight', 'type' => 'float'],
                [ 'label' => 'Mô tả tóm tắt' ,'name' => 'short_description', 'type' => 'ckeditor'],
                [ 'label' => 'Nội dung' ,'name' => 'content', 'type' => 'ckeditor'],
                [ 'label' => 'Danh mục' ,'name' => 'category_id', 'type' => 'select', 'data_source' => \App\Product_category::class, 'foreign_key' => 'category_id' ],
                [ 'label' => 'Chọn màu' ,'name' => 'color_id', 'type' => 'select', 'data_source' => \App\Color::class, 'foreign_key' => 'color_id' ],
                [ 'label' => 'Chọn size' ,'name' => 'color_id', 'type' => 'select', 'data_source' => \App\Size::class, 'foreign_key' => 'size_id' ],
                [ 'label' => 'Tags' ,'name' => 'tag_id', 'type' => 'tag','data_source' => \App\Product_tags::class,  'foreign_key' => 'tags'],
//                [ 'label' => 'Loại sản phẩm', 'name' => 'type', 'type' => 'select', 'data_source' =>
//                    [
//                        'hot' => 'Hiển thị là sản phẩm hot',
//                        'features' => 'Hiển thị là sản phẩm nổi bật'
//                    ]
//                ],
                [ 'label' => 'Số thứ tự' ,'name' => 'order_no', 'type' => 'number'],
                [ 'label' => 'Status' ,'name' => 'status', 'type' => 'status'],
                [ 'label' => 'Picture' ,'name' => 'url_picture', 'type' => 'file_from_url'],
//                [ 'label' => 'Gallery' ,'name' => 'gallery', 'type' => 'gallery'],

            ]
        ],
//        'info_tab' => [
//            'label_tab' => 'Thông tin chung',
//            'items' => [
//                [ 'label' => 'Description' ,'name' => 'description', 'type' => 'ckeditor'],
//            ]
//        ],
//        'mota_tab' => [
//            'label_tab' => 'Mô tả chi tiết',
//            'items' => [
//                [ 'label' => 'Content', 'name' => 'content', 'type' => 'ckeditor'],
//            ]
//        ],
//        'nhapkho_tab' => [
//            'label_tab' => 'Thông tin kho hàng',
//            'items' => [
//                [ 'label' => 'Số lượng' ,'name' => 'quantity', 'type' => 'number'],
//                [ 'label' => 'Kho' ,'name' => 'warehouse_id', 'type' => 'select', 'data_source' => \App\Warehouse::class, 'foreign_key' => 'warehouse_id' ],
//            ]
//        ],
        'seo_tab' => [
            'label_tab' => 'Meta',
            'items' => [
                [ 'label' => 'Slug' ,'name' => 'slug', 'type' => 'slug'],
                [ 'label' => 'Meta Title' ,'name' => 'meta_title', 'type' => 'text'],
                [ 'label' => 'Meta Description' ,'name' => 'meta_description', 'type' => 'textarea'],
                [ 'label' => 'Meta Keywords' ,'name' => 'meta_keywords', 'type' => 'text'],
            ]
        ],
        'general_tab_ko' => [
            'label_tab' => 'General (Korean)',
            'items' => [
                [ 'label' => 'Name' ,'name' => 'name_ko', 'type' => 'text'],
                [ 'label' => 'Mô tả tóm tắc' ,'name' => 'short_description_ko', 'type' => 'ckeditor'],
            ]
        ],
        'seo_tab_ko' => [
            'label_tab' => 'Meta (Korean)',
            'items' => [
                [ 'label' => 'Meta title' ,'name' => 'meta_title_ko', 'type' => 'text'],
                [ 'label' => 'Meta description' ,'name' => 'meta_description_ko', 'type' => 'textarea'],
                [ 'label' => 'Meta keywords' ,'name' => 'meta_keywords_ko', 'type' => 'text'],
            ]
        ]
    ];
    protected $searchList = [
        'all' => 'Search By All',
        'id' => 'Search By Id',
        'name' => 'Search By Name'
    ];
    protected $notAcceptedCrud = [  '_token','tag_id'];
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
//        $request->validate([
//            'name' => 'required',
//            'short_description' => "required",
//            'price_base' => "required|integer",
//            'price_final' => "required|integer",
////            'picture' => "required",
////            'type' => "required",
//            'category_id' => "exists:product_categories,id",
//            'warehouse_id' => "exists:warehouse,id",
//            'quantity' => 'required|integer',
//            'slug' => 'required'
//        ],[
//            'required' => ":attribute không được để trống",
//            'min' => ":attribute ít nhất :min ký tự",
//            'max' => ":attribute vượt quá :max ký tự",
//            'exists' => ":attribute phải được chọn",
//            'integer' => ":attribute phải là số hợp lệ"
//        ],[
//            'name' => 'Tên',
//            'short_description' => 'Mô tả ngắn',
//            'content' => 'Nội dung',
//            'price_base' => 'Giá cơ bản',
//            'price_final' => 'Giá chính thức',
//            'picture' => 'Hình ảnh',
//            'gallery' => 'Danh sách hình ảnh',
////            'type' => 'Loại sản phẩm',
//            'category_id' => 'Danh mục',
//            'warehouse_id' => 'Kho hàng',
//            'quantity' => 'Số lượng'
//        ]);
    }
    // option validate Update
    protected function validateUpdate(Request $request, $id = ""){

//        $request->validate([
//            'name' => 'required',
//            'short_description' => "required",
//            'price_base' => "required|integer",
//            'price_final' => "required|integer",
//
////            'type' => "required",
//            'category_id' => "exists:product_categories,id",
//            'warehouse_id' => "exists:warehouse,id",
//            'quantity' => 'required|integer',
//            'slug' => 'required'
//        ],[
//            'required' => ":attribute không được để trống",
//            'min' => ":attribute ít nhất :min ký tự",
//            'max' => ":attribute vượt quá :max ký tự",
//            'exists' => ":attribute phải được chọn",
//        ],[
//            'name' => 'Tên',
//            'short_description' => 'Mô tả ngắn',
//            'content' => 'Nội dung',
//            'price_base' => 'Giá cơ bản',
//            'price_final' => 'Giá chính thức',
//            'picture' => 'Hình ảnh',
//            'gallery' => 'Danh sách hình ảnh',
////            'type' => 'Loại sản phẩm',
//            'category_id' => 'Danh mục',
//            'warehouse_id' => 'Kho hàng',
//            'quantity' => 'Số lượng'
//        ]);
    }

}
