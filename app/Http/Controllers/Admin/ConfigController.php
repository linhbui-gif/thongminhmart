<?php

namespace App\Http\Controllers\Admin;

use App\Helper\Common;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Config as MainModel;
use Carbon\Carbon;
use App\Helper\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Session;

class ConfigController extends AdminController
{
    protected $pathView = "admin.page.config.";
    protected $config = [
        'pagination' => 10,
        'resizeImage' => [
            'thumb' => ['width' => 100],
            'standard' => ['width' => 300]
        ]
    ];
    protected $listFields = [
        ['name' => 'id', 'label' => 'Id', 'type' => 'text'],
        ['name' => 'name', 'label' => 'Name', 'type' => 'text'],
        ['name' => 'picture', 'label' => 'Picture', 'type' => 'thumb'],
        ['name' => 'status', 'label' => 'Status', 'type' => 'status'],
        ['name' => 'created_at', 'label' => 'Created At', 'type' => 'datetime', 'format' => 'd/m/Y'],
        ['name' => 'updated_at', 'label' => 'Updated At', 'type' => 'datetime', 'format' => 'd/m/Y'],
    ];
    protected $formFields = [
        'general_tab' => [
            'label_tab' => 'General',
            'items' => [
                ['label' => 'Meta title', 'name' => 'meta_title', 'type' => 'text'],
                ['label' => 'Meta description', 'name' => 'meta_description', 'type' => 'textarea'],
                ['label' => 'Meta keywords', 'name' => 'meta_keywords', 'type' => 'text'],
                //               [ 'label' => 'Favicon (42 x 42px)' ,'name' => 'favicon', 'type' => 'file'],
                ['label' => 'Favicon (42 x 42px)', 'name' => 'favicon_url', 'type' => 'file_from_url'],
                //               [ 'label' => 'Logo' ,'name' => 'picture', 'type' => 'file'],
                ['label' => 'Logo', 'name' => 'url_picture', 'type' => 'file_from_url'],
            ]
        ],
        //        'seo_tab' => [
        //            'label_tab' => 'Meta',
        //            'items' => [
        //                [ 'label' => 'Meta title' ,'name' => 'meta_title', 'type' => 'text'],
        //                [ 'label' => 'Meta description' ,'name' => 'meta_description', 'type' => 'textarea'],
        //                [ 'label' => 'Meta keywords' ,'name' => 'meta_keywords', 'type' => 'text'],
        //            ]
        //        ]
    ];
    protected $searchList = [
        'all' => 'Search By All',
        'id' => 'Search By Id',
        'name' => 'Search By Name'
    ];
    protected $notAcceptedCrud = ['_token'];
    public function __construct()
    {
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
    protected function editAction()
    {
        $controller = (new \ReflectionClass($this))->getShortName();
        $shortController = Common::getShortNameController($controller);
        $this->logFolder = $shortController;

        if ($this->logFolder) {
            $time = Carbon::now()->format('H:i:s');
            $message = "[$time] " . Auth::user()->email . " view";
            $log = new Log($this->logFolder);
            $log->put("log-" . date("Y-m-d"), $message);
        }

        $item = $this->model->find(26);
        return view($this->pathView . 'form')->with('item', $item);
    }
    // option validate Store
    protected function validateStore(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ], [
            'required' => ':attribute không được rỗng'
        ], [
            'name' => 'Tên'
        ]);
    }
    // option validate Update
    protected function validateUpdate(Request $request, $id = "")
    {
    }
    public function update(Request $request, $id)
    {

        $controller = (new \ReflectionClass($this))->getShortName();
        $shortController = Common::getShortNameController($controller);
        $this->logFolder = $shortController;

        if ($this->logFolder) {
            $time = Carbon::now()->format('H:i:s');
            $message = "[$time] " . Auth::user()->email . " update id: $id";
            $log = new Log($this->logFolder);
            $log->put("log-" . date("Y-m-d"), $message);
        }

        $this->validateUpdate($request, $id);
        $this->model = $this->model->find($id);
        $data = $this->getDataForm($request->all());
        if (!isset($data['status'])) {
            $this->model->status = "inactive";
        }
        foreach ($data as $k => $v) {
            if (is_object($v)) {
                $this->deleteThumb($this->model->{$k});
                $v = $this->uploadThumb($v);
            }
            $this->model->$k = $v;
        }
        $this->model->save();
        // xử lý tag
        if (isset($request->tag_id)  && count($request->tag_id) > 0) {
            $tag_id = [];
            foreach ($request->tag_id as $k => $v) {
                if (is_numeric($v)) {
                    $tag_id[] = $v;
                }
            }
            $this->model->tags()->sync($tag_id);
        }
        Session::flash('success', 'Bạn đã cập nhật thành công');
        return redirect()->route('admin.' . $this->controllerName . ".edit");
    }
}
