<?php

namespace App\Http\Controllers\Admin;

use App\Helper\Common;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\Helper\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Chapter as MainModel;
use Illuminate\Support\Facades\Hash;
use Session;

class ChapterController extends AdminController
{
    protected $pathView = "admin.page.chapter.";
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
//        [ 'name' => 'status', 'label' => 'Status', 'type' => 'status'],
        [ 'name' => 'url_picture', 'label' => 'Picture', 'type' => 'thumb_url'],
        [ 'name' => 'ordering', 'label' => 'Thứ tự', 'type' => 'input_ordering'],
        [ 'name' => 'created_at', 'label' => 'Created At', 'type' => 'datetime', 'format' => 'd/m/Y' ],
        [ 'name' => 'updated_at', 'label' => 'Updated At', 'type' => 'datetime', 'format' => 'd/m/Y' ],
    ];
    protected $formFields = [
        'general_tab' => [
            'label_tab' => 'General',
            'items' => [
                [ 'label' => 'Name' ,'name' => 'name', 'type' => 'text'],
     //           [ 'label' => 'Hình' ,'name' => 'picture', 'type' => 'file'],
                [ 'label' => 'Picture' ,'name' => 'url_picture', 'type' => 'file_from_url'],
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
            'name' => 'required',

            'picture' => "required",
        ],[
            'required' => ":attribute không được để trống",
            'min' => ":attribute ít nhất :min ký tự",
            'max' => ":attribute vượt quá :max ký tự",
            'exists' => ":attribute phải được chọn",
            'integer' => ":attribute phải là một con số",
        ],[
            'name' => 'Tên',

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

            'picture' => 'Hình ảnh',
        ]);
    }
    public function index_chapter(Request $request, $course_id)
    {
        $params = $request->all();
        $params['search_list'] = $this->searchList;
        $params['search_type'] = isset($params['search_type']) && in_array($params['search_type'], array_flip($this->searchList) ) ? $params['search_type'] : "all";
        $params['search_value'] = isset($params['search_value']) ? $params['search_value'] : "";
        $data['items'] = $this->model->listItems($params, $this->config, $course_id);
        $data['params'] = $params;
        $data['course_id'] = $course_id;

        $controller = (new \ReflectionClass($this))->getShortName();
        $shortController = Common::getShortNameController($controller);
        $this->logFolder = $shortController;

        if($this->logFolder){
            $time = Carbon::now()->format('H:i:s');
            $message = "[$time] " . Auth::user()->email . " view course id: $course_id";
            $log = new Log($this->logFolder);
            $log->put("log-" . date("Y-m-d"), $message);
        }

        return view($this->pathView . 'index')->with($data);
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
        $this->model->save();

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
        return redirect()->route('admin.' . $this->controllerName . ".index", [ 'course_id' =>  $this->model->course->id] );
    }
    public function ordering(Request $request){

        foreach($request->ordering as $id => $v ){
            $m = $this->model->find($id);
            $m->ordering = $v;
            $m->save();
        }

        $controller = (new \ReflectionClass($this))->getShortName();
        $shortController = Common::getShortNameController($controller);
        $this->logFolder = $shortController;

        if($this->logFolder){
            $time = Carbon::now()->format('H:i:s');
            $message = "[$time] " . Auth::user()->email . " ordering";
            $log = new Log($this->logFolder);
            $log->put("log-" . date("Y-m-d"), $message);
        }

        Session::flash('success', 'Bạn đã cập nhật thành công');
        return redirect()->back();
    }
}
