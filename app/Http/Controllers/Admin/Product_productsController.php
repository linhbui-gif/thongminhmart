<?php

namespace App\Http\Controllers\Admin;

use App\Helper\Common;
use App\Helper\Log;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
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
//                [ 'label' => 'Chọn size' ,'name' => 'color_id', 'type' => 'select', 'data_source' => \App\Size::class, 'foreign_key' => 'size_id' ],
                [ 'label' => 'Tags' ,'name' => 'tag_id', 'type' => 'tag','data_source' => \App\Product_tags::class,  'foreign_key' => 'tags'],
//                [ 'label' => 'Loại sản phẩm', 'name' => 'type', 'type' => 'select', 'data_source' =>
//                    [
//                        'hot' => 'Hiển thị là sản phẩm hot',
//                        'features' => 'Hiển thị là sản phẩm nổi bật'
//                    ]
//                ],
                [ 'label' => 'Số thứ tự' ,'name' => 'order_no', 'type' => 'number'],
                [ 'label' => 'Status' ,'name' => 'status', 'type' => 'status'],
                [ 'label' => 'Video Upload' ,'name' => 'video_link', 'type' => 'file'],
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
//        'general_tab_ko' => [
//            'label_tab' => 'General (Korean)',
//            'items' => [
//                [ 'label' => 'Name' ,'name' => 'name_ko', 'type' => 'text'],
//                [ 'label' => 'Mô tả tóm tắc' ,'name' => 'short_description_ko', 'type' => 'ckeditor'],
//            ]
//        ],
//        'seo_tab_ko' => [
//            'label_tab' => 'Meta (Korean)',
//            'items' => [
//                [ 'label' => 'Meta title' ,'name' => 'meta_title_ko', 'type' => 'text'],
//                [ 'label' => 'Meta description' ,'name' => 'meta_description_ko', 'type' => 'textarea'],
//                [ 'label' => 'Meta keywords' ,'name' => 'meta_keywords_ko', 'type' => 'text'],
//            ]
//        ]
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
    public function store(Request $request)
    {

        $this->validateStore($request);
        $product = new MainModel();
        $data = [];
        foreach($request->contents as $k => $sections){
            foreach($sections as $k_1 => $section){
                $data[$k][$k_1] = $section;
            }
        }
        $product->name = $request->name;
        $product->price_base = $request->price_base;
        $product->price_final = $request->price_final;
        $product->short_description = $request->short_description;
        $product->category_id = $request->category_id;
        $product->slug = $request->slug;
        $product->content = $request->content;
        $product->status = isset($request->status) && $request->status != null ? "active" : "inactive";
        $product->meta_title = $request->meta_title;
        $product->meta_description = $request->meta_description;
        $product->meta_keywords = $request->meta_keywords;
        $product->url_picture = $request->url_picture;
        $product->order_no = $request->order_no;
        $product->ts_kt = serialize($data);
        if(isset($request->video_link)){
            if(preg_match("#mp4#", $_FILES['video_link']['type'])){
                $video_upload = $request->file('video_link');

                if(isset($video_upload))
                {
                    $videoName  = \Str::random(10).'.'.$video_upload->getClientOriginalExtension();

                    if(!\Storage::disk('public')->exists('video-intro'))
                    {
                        \Storage::disk('public')->makeDirectory('video-intro');
                    }

                    \Storage::disk('public')->putFileAs('video-intro',$video_upload,$videoName);
                } else {
                    $videoName = $product->video_link;
                }
                $product->video_link = $videoName;
            }
        }
        $product->save();
        // xử lý tag
        if(isset($request->tag_id)  && count($request->tag_id) > 0 ){
            $tag_id = [];
            foreach($request->tag_id as $k => $v){
                if(is_numeric ($v)){
                    $tag_id[] = $v;
                }
            }
            $this->model->tags()->attach($tag_id);
        }

        Session::flash('success', 'Bạn đã thêm mới thành công');
        return redirect()->route('admin.' . $this->controllerName . ".index" );
    }
  public function update(Request $request, $id)
  {
     $this->validateUpdate($request, $id);
     $product = MainModel::findOrFail($id);
      $content = unserialize($product->ts_kt);
      $data = [];
      foreach($request->contents as $k => $sections){
          foreach($sections as $k_1 => $section){
              if(is_object($section)){
                  $section = $this->uploadThumb($section);
              }
              $data[$k][$k_1] = $section;
          }
      }

      if(is_array($content)){
          foreach($content as $k => $sections){
              foreach($sections as $k_1 => $section){
                  if(!isset($data[$k][$k_1])){
                      $data[$k][$k_1] = $content[$k][$k_1];
                  }
              }
          }
      }
      $product->name = $request->name;
      $product->price_base = $request->price_base;
      $product->price_final = $request->price_final;
      $product->short_description = $request->short_description;
      $product->category_id = $request->category_id;
      $product->slug = $request->slug;
      $product->content = $request->content;
      $product->status = isset($request->status) && $request->status != null ? "active" : "inactive";
      $product->meta_title = $request->meta_title;
      $product->meta_description = $request->meta_description;
      $product->meta_keywords = $request->meta_keywords;
      $product->url_picture = $request->url_picture;
      $product->order_no = $request->order_no;
      $product->ts_kt = serialize($data);
      if(isset($request->video_link)){
          if(preg_match("#mp4#", $_FILES['video_link']['type'])){
              $video_upload = $request->file('video_link');

              if(isset($video_upload))
              {
                  $videoName  = \Str::random(10).'.'.$video_upload->getClientOriginalExtension();

                  if(!\Storage::disk('public')->exists('video-intro'))
                  {
                      \Storage::disk('public')->makeDirectory('video-intro');
                  }

                  \Storage::disk('public')->putFileAs('video-intro',$video_upload,$videoName);
              } else {
                  $videoName = $product->video_link;
              }
              $product->video_link = $videoName;
          }
      }
      $product->save();
      if(isset($request->tag_id)  && count($request->tag_id) > 0 ){
          $tag_id = [];
          foreach($request->tag_id as $k => $v){
              if(is_numeric ($v)){
                  $tag_id[] = $v;
              }
          }
          $product->tags()->sync($tag_id);
      }
      Session::flash('success', 'Bạn đã thêm mới thành công');
      return redirect()->route('admin.' . $this->controllerName . ".index" );
  }

    // option validate Store
    protected function validateStore(Request $request){

    }
    // option validate Update
    protected function validateUpdate(Request $request, $id = ""){

    }

}
