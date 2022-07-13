<?php

namespace App\Http\Controllers\Admin;

use App\Helper\Common;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Controller;
use App\Product_products;
use Carbon\Carbon;
use App\Helper\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Course_course as MainModel;
use Illuminate\Support\Facades\Hash;
use Session;
use Vimeo\Laravel\Facades\Vimeo;

class Course_coursesController extends AdminController
{
    protected $pathView = "admin.page.course.";
    protected $config = [
        'pagination' => 50,
        'resizeImage' => [
            'thumb' => ['width' => 100],
            'standard' => ['width' => 500]
        ]
    ];
    protected $listFields = [
        [ 'name' => 'id', 'label' => 'Id', 'type' => 'text'],
        [ 'name' => 'name', 'label' => 'Name', 'type' => 'text'],
//        [ 'name' => 'short_description', 'label' => 'Short Description', 'type' => 'text'],
        [ 'name' => 'price_base', 'label' => 'Price Base', 'type' => 'price_product'],
        [ 'name' => 'teacher_id', 'label' => 'Giảng viên', 'type' => 'display_giangvien'],
//        [ 'name' => 'picture', 'label' => 'Picture', 'type' => 'thumb'],
        [ 'name' => 'url_picture', 'label' => 'Picture', 'type' => 'thumb_url'],
        [ 'name' => 'hot', 'label' => 'Hot', 'type' => 'boolean'],
        [ 'name' => 'status', 'label' => 'Status', 'type' => 'status'],
        [ 'name' => 'created_by', 'label' => 'Created by', 'type' => 'text_foreign'],
//        [ 'name' => 'updated_by', 'label' => 'Updated by', 'type' => 'text_foreign'],
        [ 'name' => 'created_at', 'label' => 'Created At', 'type' => 'datetime', 'format' => 'd/m/Y' ],
//        [ 'name' => 'updated_at', 'label' => 'Updated At', 'type' => 'datetime', 'format' => 'd/m/Y' ],
    ];
    protected $formFields = [

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
    public function edit($id)
    {
        $item = $this->model->find($id);
        $data['products'] = Product_products::orderBy('name','desc')->paginate(10);
        $data['item'] =  $item;

        $controller = (new \ReflectionClass($this))->getShortName();
        $shortController = Common::getShortNameController($controller);
        $this->logFolder = $shortController;

        if($this->logFolder){
            $time = Carbon::now()->format('H:i:s');
            $message = "[$time] " . Auth::user()->email . " click button edit";
            $log = new Log($this->logFolder);
            $log->put("log-" . date("Y-m-d"), $message);
        }

        return view($this->pathView . 'form')->with($data);
    }
    public function store(Request $request)
    {
        // xu ly kêt quả
        $arrResult = [];
        if($request->result){
            $arrResult['description'] = $request->result['description'];

            $newGallery = [];
            if(isset($request->result['gallery'])){
                $gallery = $request->result['gallery'];
                if($gallery && count($gallery) > 0){
                    if($gallery['image'] && count($gallery['image']) > 0){
                        foreach($gallery['image'] as $k => $link){
                            if(!empty($link)){
                                $newGallery[] = [
                                    'image' => $link,
                                    'title' => $gallery['title'][$k]
                                ];
                            }
                        }
                    }
                }
            }
            $arrResult['gallery'] = $newGallery;
            $newGallerySlider = [];
            if(isset($request->result['gallery_slider'])){
                $gallery = $request->result['gallery_slider'];
                if($gallery && count($gallery) > 0){
                    if($gallery['image'] && count($gallery['image']) > 0){
                        foreach($gallery['image'] as $k => $link){
                            if(!empty($link)){
                                $newGallerySlider[] = [
                                    'image' => $link,
                                    'title' => $gallery['title'][$k],
                                    'description' => $gallery['description'][$k]
                                ];
                            }
                        }
                    }
                }
            }
            $arrResult['gallery_slider'] = $newGallerySlider;
        }

        $this->validateStore($request);
        $course = new MainModel();
        $course->name = $request->name;
        $course->price_base = $request->price_base;
//        $course->price_final = $request->price_final;
        $course->short_description = $request->short_description;
        $course->category_id = $request->category_id;
        $course->slug = $request->slug;
        $course->content = $request->content;
       // $course->result = $request->result;
        $course->status = isset($request->status) && $request->status != null ? "active" : "inactive";
        $course->hoclieu = $request->hoclieu;
        $course->giangvien = $request->giangvien;
        $course->meta_title = $request->meta_title;
        $course->meta_description = $request->meta_description;
        $course->meta_keywords = $request->meta_keywords;
        $course->teacher_id = $request->teacher_id;
        $course->result = json_encode($arrResult);
        $course->url_picture = $request->url_picture;
        if($request->picture){
            $picture_name = $this->uploadThumb($request->picture);
            $course->picture = $picture_name;
        }



        if($request->galleries){
            $course->gallery = json_encode($request->galleries);
        }
        $user = \Auth::user();
        $course->created_by = $user->id;

        $course->save();

        $controller = (new \ReflectionClass($this))->getShortName();
        $shortController = Common::getShortNameController($controller);
        $this->logFolder = $shortController;

        if($this->logFolder){
            $time = Carbon::now()->format('H:i:s');
            $message = "[$time] " . Auth::user()->email . " create new";
            $log = new Log($this->logFolder);
            $log->put("log-" . date("Y-m-d"), $message);
        }

        Session::flash('success', 'Bạn đã thêm mới thành công');
        return redirect()->route('admin.' . $this->controllerName . ".index" );
    }
    public function update(Request $request, $id)
    {
        // xu ly kêt quả
        $arrResult = [];
        if($request->result){
            $arrResult['description'] = $request->result['description'];

            $newGallery = [];
            if(isset($request->result['gallery'])){
                $gallery = $request->result['gallery'];
                if($gallery && count($gallery) > 0){
                    if($gallery['image'] && count($gallery['image']) > 0){
                        foreach($gallery['image'] as $k => $link){
                            if(!empty($link)){
                                $newGallery[] = [
                                    'image' => $link,
                                    'title' => $gallery['title'][$k]
                                ];
                            }
                        }
                    }
                }
            }
            $arrResult['gallery'] = $newGallery;
            $newGallerySlider = [];
            if(isset($request->result['gallery_slider'])){
                $gallery = $request->result['gallery_slider'];
                if($gallery && count($gallery) > 0){
                    if($gallery['image'] && count($gallery['image']) > 0){
                        foreach($gallery['image'] as $k => $link){
                            if(!empty($link)){
                                $newGallerySlider[] = [
                                    'image' => $link,
                                    'title' => $gallery['title'][$k],
                                    'description' => $gallery['description'][$k]
                                ];
                            }
                        }
                    }
                }
            }
            $arrResult['gallery_slider'] = $newGallerySlider;
        }
        $this->validateUpdate($request);
        $course = MainModel::findOrFail($id);
        $course->name = $request->name;
        $course->price_base = $request->price_base;
//        $course->price_final = $request->price_final;
        $course->short_description = $request->short_description;
        $course->category_id = $request->category_id;
        $course->slug = $request->slug;
        $course->meta_title = $request->meta_title;
        $course->content = $request->content;
        $course->hoclieu = $request->hoclieu;
        $course->status = isset($request->status) && $request->status != null ? "active" : "inactive";
        $course->giangvien = $request->giangvien;
        $course->meta_description = $request->meta_description;
        $course->meta_keywords = $request->meta_keywords;
        $course->url_picture = $request->url_picture;
        $course->teacher_id = $request->teacher_id;
        $course->thumbnail_intro_url = $request->thumbnail_intro_url;
        $course->file_doc = $request->filepath;
        //dd($request->all());
        if($request->picture){
            // delete thumb
            if(!empty(trim(($course->picture)))){
                $this->deleteThumb($course->picture);
            }
            // upload thumb
            $picture_name = $this->uploadThumb($request->picture);
            $course->picture = $picture_name;
        }
        if($request->thumbnail_intro){
            $picture_name = $this->uploadThumb($request->thumbnail_intro);
            $course->thumbnail_intro = $picture_name;
        }
        if(isset($request->video_intro)){
            if(preg_match("#mp4#", $_FILES['video_intro']['type'])){
                $name = pathinfo($_FILES['video_intro']['name'], PATHINFO_FILENAME);
                $vimeo = Vimeo::connection('main');
                $response =$vimeo->upload($request->video_intro->getRealPath(), [
                    'name' =>  $name
                ]);
                //lay ten video vua upload
                $nameIntro = explode('/', $response)[2];
                $course->video_intro = $nameIntro;
            }
        }
        $course->result = json_encode($arrResult);

        if($request->galleries){
            $course->gallery = json_encode($request->galleries);
        }
        //$user = \Auth::user();
        $course->updated_by = $request->user()->id;
        $course->save();

        $controller = (new \ReflectionClass($this))->getShortName();
        $shortController = Common::getShortNameController($controller);
        $this->logFolder = $shortController;

        if($this->logFolder){
            $time = Carbon::now()->format('H:i:s');
            $message = "[$time] " . Auth::user()->email . " update id: $id";
            $log = new Log($this->logFolder);
            $log->put("log-" . date("Y-m-d"), $message);
        }

        Session::flash('success', 'Bạn đã cập nhật thành công');
        return redirect()->route('admin.' . $this->controllerName . ".index" );
    }
    // option validate Store
    protected function validateStore(Request $request){
        $request->validate([
            'name' => 'required',
            'short_description' => "required",
            'content' => "required",
 //           'price_base' => "required|integer",
//            'price_final' => "required|min:3",
            'category_id' => 'exists:course_categories,id',
 //           'picture' => "required",
            'galleries' => "required",
            'slug' => 'required',
            'teacher_id' => 'required|exists:users,id',
        ],[
            'required' => ":attribute không được để trống",
            'min' => ":attribute ít nhất :min ký tự",
            'max' => ":attribute vượt quá :max ký tự",
            'exists' => ":attribute phải được chọn",
            'integer' => ":attribute phải là một con số",
        ],[
            'name' => 'Tên',
            'short_description' => 'Mô tả ngắn',
            'content' => 'Thông tin chung',
            'price_base' => 'Giá cơ bản',
//            'price_final' => 'Giá chính thức',
            'picture' => 'Hình ảnh',
            'gallery' => 'Danh sách hình ảnh',
            'type' => 'Loại sản phẩm',
            'category_id' => 'Danh mục',
            'result' => 'Kết quả',
            'hoclieu' => 'Học liệu',
            'giangvien' => 'Giảng viên',
            'teacher_id' => 'Tên giảng viên'
        ]);
    }
    // option validate Update
    protected function validateUpdate(Request $request, $id = ""){
        $request->validate([
            'name' => 'required',
            'short_description' => "required",
            'content' => "required",
 //           'price_base' => "required|integer",
//            'price_final' => "required|min:3",
            'category_id' => 'exists:course_categories,id',
            'galleries' => "required",
            'slug' => 'required',
            'teacher_id' => 'required|exists:users,id',
        ],[
            'required' => ":attribute không được để trống",
            'min' => ":attribute ít nhất :min ký tự",
            'max' => ":attribute vượt quá :max ký tự",
            'exists' => ":attribute phải được chọn",
            'integer' => ":attribute phải là một con số",
        ],[
            'name' => 'Tên',
            'short_description' => 'Mô tả ngắn',
            'content' => 'Thông tin chung',
            'price_base' => 'Giá cơ bản',
//            'price_final' => 'Giá chính thức',
            'picture' => 'Hình ảnh',
            'gallery' => 'Danh sách hình ảnh',
            'type' => 'Loại sản phẩm',
            'category_id' => 'Danh mục',
            'result' => 'Kết quả',
            'hoclieu' => 'Học liệu',
            'giangvien' => 'Giảng viên',
            'teacher_id' => 'Tên giảng viên'
        ]);
    }

}
