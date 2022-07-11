<?php

namespace App\Http\Controllers\Admin;

use App\Components\CategoryRecusive;
use App\Helper\Common;
use App\Helper\Log;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\blog_categories as MainModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Session;

class Blog_categoriesController extends AdminController
{
    protected $pathView = "admin.page.blog.categories.";
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
        [ 'name' => 'url_picture', 'label' => 'Picture', 'type' => 'thumb_url'],
        [ 'name' => 'order_no', 'label' => 'Số thứ tự', 'type' => 'text'],
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
                [ 'label' => 'Description' ,'name' => 'description', 'type' => 'textarea'],
                [ 'label' => 'Danh mục cha' ,'name' => 'parent_id', 'type' => 'select_recusive'],
                [ 'label' => 'Content' ,'name' => 'content', 'type' => 'ckeditor'],
                [ 'name' => 'order_no', 'label' => 'Số thứ tự', 'type' => 'text'],
                [ 'label' => 'Thumbnail' ,'name' => 'url_picture', 'type' => 'file_from_url'],
                [ 'label' => 'Status' ,'name' => 'status', 'type' => 'status'],
            ]
        ],
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
                [ 'label' => 'Mô tả' ,'name' => 'description_ko', 'type' => 'textarea']
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
        if(isset($_GET['tab_current'])){
            Session::put('tab_current', $_GET['tab_current']);
        }
        $this->model = new MainModel();
    }
    public function getCategory($parent_id){
        $data = $this->model->all();
        $recusive = new CategoryRecusive($data);
        $htmlOpition = $recusive->categoryRecusive($parent_id);
        return $htmlOpition;
    }
    public function create(Request $request){
        $htmlOpition = $this->getCategory($parent_id = '');
        if($this->logFolder){
            $time = Carbon::now()->format('H:i:s');
            $message = "[$time] " . $request->user()->email . " click button create";
            $log = new Log($this->logFolder);
            $log->put("log-" . date("Y-m-d"), $message);
        }
        return view($this->pathView . 'form', compact("htmlOpition"));
    }
    public function edit($id)
    {

        $item = $this->model->find($id);
        $htmlOpition = $this->getCategory($item->parent_id);
        if($this->logFolder){
            $time = Carbon::now()->format('H:i:s');
            $message = "[$time] " . Auth::user()->email . " click button edit";
            $log = new Log($this->logFolder);
            $log->put("log-" . date("Y-m-d"), $message);
        }

        return view($this->pathView . 'form', compact("item","htmlOpition" ));
    }
    // option validate Store
    protected function validateStore(Request $request){
        $request->validate([
            'name' => 'required',
        ],[
            'required' => ":attribute không được để trống",
            'min' => ":attribute ít nhất :min ký tự",
            'max' => ":attribute vượt quá :max ký tự",
            'exists' => ":attribute phải được chọn",
            'integer' => ":attribute phải là một con số",
        ],[
            'name' => 'Tên',
            'description' => 'Mô tả ngắn',
            'content' => 'Nội dung',
            'picture' => 'Hình ảnh',
        ]);
    }
    // option validate Update
    protected function validateUpdate(Request $request, $id = ""){
        $request->validate([
            'name' => 'required',
        ],[
            'required' => ":attribute không được để trống",
            'min' => ":attribute ít nhất :min ký tự",
            'max' => ":attribute vượt quá :max ký tự",
            'exists' => ":attribute phải được chọn",
            'integer' => ":attribute phải là một con số",
        ],[
            'name' => 'Tên',
            'description' => 'Mô tả ngắn',
            'content' => 'Nội dung',
            'picture' => 'Hình ảnh',
        ]);
    }

}
