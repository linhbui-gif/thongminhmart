<?php

namespace App\Http\Controllers\Admin;

use App\Helper\Common;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Page as MainModel;

use Carbon\Carbon;
use App\Helper\Log;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Hash;
use Session;

class PageController extends AdminController
{
    protected $pathView = "admin.page.page.";
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
        [ 'name' => 'status', 'label' => 'Status', 'type' => 'status'],
        [ 'name' => 'created_at', 'label' => 'Created At', 'type' => 'datetime', 'format' => 'd/m/Y' ],
        [ 'name' => 'updated_at', 'label' => 'Updated At', 'type' => 'datetime', 'format' => 'd/m/Y' ],
    ];
    protected $formFields = [
        'seo_tab' => [
            'label_tab' => 'Meta',
            'items' => [
                [ 'label' => 'Meta title' ,'name' => 'meta_title', 'type' => 'text'],
                [ 'label' => 'Meta description' ,'name' => 'meta_description', 'type' => 'textarea'],
                [ 'label' => 'Meta keywords' ,'name' => 'meta_keywords', 'type' => 'text'],
            ]
        ],
//        'seo_tab_ko' => [
//            'label_tab' => 'Meta (Korea)',
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
    protected $notAcceptedCrud = [  '_token', 'tag_id'];
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
    public function create(Request $request)
    {
        $controller = (new \ReflectionClass($this))->getShortName();
        $shortController = Common::getShortNameController($controller);
        $this->logFolder = $shortController;

        if($this->logFolder){
            $time = Carbon::now()->format('H:i:s');
            $message = "[$time] " . Auth::user()->email . " click button create";
            $log = new Log($this->logFolder);
            $log->put("log-" . date("Y-m-d"), $message);
        }
        return redirect()->back();
    }
    public function store(Request $request)
    {
        $this->validateStore($request);

        foreach($request->content as $k => $sections){
            dd($sections);
            foreach($sections as $k_1 => $section){
                if(is_object($section)){
                    dd($section);
                }
            }
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
        $item = MainModel::find($id);
        $content = unserialize($item->content);
        //dd($content);


        $data = [];
        foreach($request->content as $k => $sections){
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

        // Korera
//        $content_ko = unserialize($item->content_ko);
//
//        $data_ko = [];
//        foreach($request->content_ko as $k => $sections){
//            foreach($sections as $k_1 => $section){
//                if(is_object($section)){
//                    $section = $this->uploadThumb($section);
//                }
//                $data_ko[$k][$k_1] = $section;
//            }
//        }
//
//        if(is_array($content_ko)){
//            foreach($content_ko as $k => $sections){
//                foreach($sections as $k_1 => $section){
//                    if(!isset($data_ko[$k][$k_1])){
//                        $data_ko[$k][$k_1] = $content_ko[$k][$k_1];
//                    }
//                }
//            }
//        }

        $item->meta_title = $request->meta_title;
        $item->meta_description = $request->meta_description;
        $item->meta_keywords = $request->meta_keywords;
        $item->content = serialize($data);

//        $item->content_ko = serialize($data_ko);
//        $item->meta_title_ko = $request->meta_title_ko;
//        $item->meta_description_ko = $request->meta_description_ko;
//        $item->meta_keywords_ko = $request->meta_keywords_ko;

        $item->save();

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
            'name' => 'required'
        ],[
            'required' => ':attribute không được rỗng'
        ],[
            'name' => 'Tên'
        ]);
    }
    // option validate Update
    protected function validateUpdate(Request $request, $id = ""){

    }

}
