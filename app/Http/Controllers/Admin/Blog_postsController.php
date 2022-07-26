<?php

namespace App\Http\Controllers\Admin;

use App\blog_tags;
use App\Helper\Common;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\blog_posts as MainModel;
use Illuminate\Support\Facades\Hash;
use Session;

class Blog_postsController extends AdminController
{
    protected $pathView = "admin.core.";
    protected $config = [
        'pagination' => 10,
        'resizeImage' => [
            'thumb' => ['width' => 100],
            'standard' => ['width' => 500]
        ]
    ];
    protected $listFields = [
        [ 'name' => 'id', 'label' => 'Id', 'type' => 'text'],
        [ 'name' => 'name', 'label' => 'Name', 'type' => 'text'],
//        [ 'name' => 'order_no', 'label' => 'Số thứ tự', 'type' => 'number'],
        [ 'name' => 'url_picture', 'label' => 'Picture', 'type' => 'thumb_url'],
        [ 'name' => 'order_no', 'label' => 'Số thứ tự', 'type' => 'text'],
        [ 'name' => 'status', 'label' => 'Status', 'type' => 'status'],

//        [ 'name' => 'updated_by', 'label' => 'Updated by', 'type' => 'text_foreign'],
//        [ 'name' => 'created_at', 'label' => 'Created At', 'type' => 'datetime', 'format' => 'd/m/Y' ],
//        [ 'name' => 'updated_at', 'label' => 'Updated At', 'type' => 'datetime', 'format' => 'd/m/Y' ],
    ];
    protected $formFields = [
        'general_tab' => [
            'label_tab' => 'General(VI)',
            'items' => [
                [ 'label' => 'Name' ,'name' => 'name', 'type' => 'text'],
                [ 'label' => 'Description' ,'name' => 'description', 'type' => 'textarea'],
                [ 'label' => 'Content' ,'name' => 'content', 'type' => 'ckeditor'],
                [ 'label' => 'Danh mục' ,'name' => 'category_id', 'type' => 'select', 'data_source' => \App\blog_categories::class, 'foreign_key' => 'category_id' ],
                [ 'label' => 'Tags' ,'name' => 'tag_id', 'type' => 'tag','data_source' => \App\blog_tags::class,  'foreign_key' => 'tags'],
//                [ 'label' => 'bài viết liên quan' ,'name' => 'related_post_id', 'type' => 'tag','data_source' => \App\blog_posts::class,  'foreign_key' => 'posts'],
//                [ 'label' => 'Vị trí hiển thị' ,'name' => 'location', 'type' => 'select','data_source' => [
//                        'post_home' => 'Bài viết trang chủ',
//                    ]
//                ],
//                [ 'label' => 'Thumbnail' ,'name' => 'picture', 'type' => 'file'],
                [ 'label' => 'Số thứ tự' ,'name' => 'order_no', 'type' => 'number'],
                [ 'label' => 'Thumbnail' ,'name' => 'url_picture', 'type' => 'file_from_url'],
                [ 'label' => 'Active' ,'name' => 'status', 'type' => 'status'],
//                [ 'label' => 'Images' ,'name' => 'gallery', 'type' => 'file_multi'],
            ]
        ],
        'seo_tab' => [
            'label_tab' => 'Meta(VI)',
            'items' => [
                [ 'label' => 'Slug' ,'name' => 'slug', 'type' => 'slug'],
                [ 'label' => 'Meta title' ,'name' => 'meta_title', 'type' => 'text'],
                [ 'label' => 'Meta description' ,'name' => 'meta_description', 'type' => 'textarea'],
                [ 'label' => 'Meta keywords' ,'name' => 'meta_keywords', 'type' => 'text'],
            ]
        ],
        'general_tab_ko' => [
            'label_tab' => 'General (Korean)',
            'items' => [
                [ 'label' => 'Name' ,'name' => 'name_ko', 'type' => 'text'],
                [ 'label' => 'Mô tả' ,'name' => 'description_ko', 'type' => 'textarea'],
                [ 'label' => 'Nội dung' ,'name' => 'content_ko', 'type' => 'ckeditor'],
            ]
        ],
        'seo_tab_ko' => [
            'label_tab' => 'Meta (EN)',
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
    protected $notAcceptedCrud = [  '_token','tag_id', 'related_post_id'];
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
            'description' => "required",
            'content' => "required",
            'category_id' => 'exists:blog_categories,id',
            //'tag_id' => 'required|exists:blog_tags,id',
            //'picture' => 'required',
            'slug' => 'required'

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
            'category_id' => 'Danh mục',
            'picture' => 'Hình ảnh',
            'tag_id' => 'Tag',
        ]);
    }
    // option validate Update
    protected function validateUpdate(Request $request, $id = ""){
        $request->validate([
            'name' => 'required',
            'description' => "required",
            'content' => "required",
            'category_id' => 'exists:blog_categories,id',
         //   'tag_id' => 'required|exists:blog_tags,id',
            'slug' => 'required'

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
            'category_id' => 'Danh mục',
            'picture' => 'Hình ảnh',
            'tag_id' => 'Tag',
        ]);
    }
//    public function edit($id)
//    {
//        $item = $this->model->find($id);
//        return view($this->pathView . 'form')->with('item', $item);
//    }
//    public function store(Request $request)
//    {
//        // validate
//        $data = [
//          'name' => $request->name,
//        ];
//        // upload hinh
//        $data['picture'] = $this->uploadThumb($request->picture);
//        MainModel::create($data);
//        Session::flash('success', 'Bạn đã thêm mới thành công');
//        return redirect()->route('admin.' . $this->controllerName . ".index" );
//    }
}
