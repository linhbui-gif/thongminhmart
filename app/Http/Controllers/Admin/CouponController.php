<?php

namespace App\Http\Controllers\Admin;

use App\Helper\Common;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\Helper\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Coupon as MainModel;
use Illuminate\Support\Facades\Hash;
use Session;

class CouponController extends AdminController
{
    protected $pathView = "admin.page.coupon.";
    protected $config = [
        'pagination' => 10,
        'resizeImage' => [
            'thumb' => ['width' => 100],
            'standard' => ['width' => 300]
        ]
    ];
    protected $listFields = [
        [ 'name' => 'id', 'label' => 'Id', 'type' => 'text'],
        [ 'name' => 'name', 'label' => 'Code', 'type' => 'text'],
        [ 'name' => 'type', 'label' => 'Type', 'type' => 'text_in_array', 'data_source' => [  0  => 'Phần trăm', 1 => 'Giảm theo tiền' ]  ],
        [ 'name' => 'value', 'label' => 'Value', 'type' => 'text' ],
        [ 'name' => 'expire', 'label' => 'Expire', 'type' => 'datetime', 'format' => 'd/m/Y'],
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
                [ 'label' => 'Mã' ,'name' => 'name', 'type' => 'text'],
                [ 'label' => 'Loại giảm giá' ,'name' => 'type', 'type' => 'select', 'data_source' => [ 0 => 'Phần trăm', 1 => 'Số tiền giảm' ]  ],
                [ 'label' => 'Giá trị' ,'name' => 'value', 'type' => 'text'],
                [ 'label' => 'Số lượng' ,'name' => 'quantity', 'type' => 'number'],
                [ 'label' => 'Ngày hết hạn' ,'name' => 'expire', 'type' => 'datepicker', 'format' => 'd/m/Y'],
                [ 'label' => 'Áp dụng cho tất cả́' ,'name' => 'all_course', 'type' => 'select', 'data_source' => [ 'no' => 'No', 'yes' => 'Yes' ]  ],
                [ 'label' => 'Áp dụng cho' ,'name' => 'expire', 'type' => 'custom_coupon_course', 'format' => 'd/m/Y'],
                [ 'label' => 'Kích hoạt' ,'name' => 'status', 'type' => 'status'],
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
    public function store(Request $request)
    {
        $this->validateStore($request);
        $data = $this->getDataForm($request->all());

        // xử lý datepicker
        $arrDatepicker = $this->getKeyByType('datepicker');

        foreach($arrDatepicker as $k => $keyname){
            $date = $data[$keyname];
            $cDate = Carbon::createFromFormat("d/m/Y", $date, "Asia/Ho_Chi_Minh");
            $dateNew = $cDate->toDateTimeString();
            $data[$keyname] = $dateNew;
        }
        // end datepicker
        foreach ($data as $k => $v) {
            if(is_object($v)){
                $v = $this->uploadThumb($v);
            }
            if(is_array($v) && count($v) > 0 ){
                if(is_object($v[0])){
                    $v = $this->uploadMulti($v);
                }
            }


            $this->model->$k = $v;
        }

        $user = \Auth::user();
        $this->model->created_by = $user->id;
        // trường hợp gallery
        if(isset($request->galleries)){
            $this->model->gallery = json_encode($request->galleries);
        }
        // xử lý dành cho khóa học
        $course_string = serialize($request->course_id);
        $this->model->course_id = $course_string;

        $this->model->save();
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
        $this->validateUpdate($request, $id);
        $this->model = $this->model->find($id);
        $data = $this->getDataForm($request->all());

        // xử lý datepicker
        $arrDatepicker = $this->getKeyByType('datepicker');

        foreach($arrDatepicker as $k => $keyname){
            $date = $data[$keyname];
            $cDate = Carbon::createFromFormat("d/m/Y", $date, "Asia/Ho_Chi_Minh");
            $dateNew = $cDate->toDateTimeString();
            $data[$keyname] = $dateNew;
        }
        // end datepicker

        if(!isset($data['status'])){
            $this->model->status = "inactive";
        }
        foreach ($data as $k => $v) {
            if(is_object($v)){
                $this->deleteThumb($this->model->{$k});
                $v = $this->uploadThumb($v);
            }
            if(is_array($v) && count($v) > 0 ){
                if(is_object($v[0])){
                    $v = $this->uploadMulti($v);
                }
            }
            $this->model->$k = $v;
        }

        $user = \Auth::user();
        $this->model->updated_by = $user->id;

        // trường hợp gallery
        if(isset($request->galleries)){
            $this->model->gallery = json_encode($request->galleries);
        }
        // xử lý dành cho khóa học
        $course_string = serialize($request->course_id);
        $this->model->course_id = $course_string;

        $this->model->save();
        // xử lý tag

        if(isset($request->tag_id)  && count($request->tag_id) > 0 ){
            $tag_id = [];
            foreach($request->tag_id as $k => $v){
                if(is_numeric ($v)){
                    $tag_id[] = $v;
                }
            }
            $this->model->tags()->sync($tag_id);
        }else{
            //$this->model->tags()->detach();
        }

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
            'type' => 'required|in:0,1',
            'value' => 'required|integer',
            'expire' => 'required',
            'all_course' => 'required|in:no,yes',
//            'course_id' => 'required|exists:course_courses,id'
        ],[
            'required' => ':attribute không được rỗng',
            'in' => ':attribute không hợp lệ',
            'integer'  => ':attribute phải là số nguyên',
            'exists' => ':attribute không được bỏ trống',
        ],[
            'name' => 'Tên',
            'type' => 'Thể loại',
            'value' => 'Giá trị',
            'expire' => 'Ngày hết hạn',
            'course_id' => 'Khóa học',
            'all_course' => 'Áp dụng cho tất cả'
        ]);
    }
    // option validate Update
    protected function validateUpdate(Request $request, $id = ""){
        $request->validate([
            'name' => 'required',
            'type' => 'required|in:0,1',
            'value' => 'required|integer',
            'expire' => 'required',
            'all_course' => 'required|in:no,yes',
 //           'course_id' => 'required|exists:course_courses,id'
        ],[
            'required' => ':attribute không được rỗng',
            'in' => ':attribute không hợp lệ',
            'integer'  => ':attribute phải là số nguyên',
            'exists' => ':attribute không được bỏ trống',
        ],[
            'name' => 'Tên',
            'type' => 'Thể loại',
            'value' => 'Giá trị',
            'expire' => 'Ngày hết hạn',
            'course_id' => 'Khóa học',
            'all_course' => 'Áp dụng cho tất cả'
        ]);
    }


}
