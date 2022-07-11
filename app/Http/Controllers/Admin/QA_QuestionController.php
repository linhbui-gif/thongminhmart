<?php

namespace App\Http\Controllers\Admin;

use App\Helper\Common;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\QA_Question as MainModel;
use Illuminate\Support\Facades\Hash;
use Session;

class Qa_questionController extends AdminController
{
    protected $pathView = "admin.page.question.";
    protected $config = [
        'pagination' => 50,
        'resizeImage' => [
            'thumb' => ['width' => 100],
            'standard' => ['width' => 300]
        ]
    ];
    protected $listFields = [
        [ 'name' => 'id', 'label' => 'Id', 'type' => 'text'],
        [ 'name' => 'name', 'label' => 'Question', 'type' => 'text'],
        [ 'name' => 'custom', 'label' => 'Question', 'type' => 'custom'],
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
                [ 'label' => 'Question', 'name' => 'name','type' => 'text'],
                [ 'label' => 'Answer', 'name' => 'answer','type' => 'textarea'],
                [ 'label' => 'Câu hỏi thường gặp ?' ,'name' => 'thuonggap', 'type' => 'select','data_source' =>
                    [
                        'no' => 'No',
                        'yes' => 'Yes',
                    ]
                ],
                [ 'label' => 'Status', 'name' => 'status','type' => 'status'],
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
//            'description' => "required|min:3|max:255",
            'thuonggap' => "required|in:no,yes",
        ],[
            'required' => ":attribute không được để trống",
            'min' => ":attribute ít nhất :min ký tự",
            'max' => ":attribute vượt quá :max ký tự",
            'exists' => ":attribute phải được chọn",
            'integer' => ":attribute phải là một con số",
            'in' => ":attribute phải chọn yes hoặc no",
        ],[
            'name' => 'Tên',
            'description' => 'Mô tả ngắn',
            'thuonggap' => 'Câu hỏi thường gặp'
        ]);
    }
    // option validate Update
    protected function validateUpdate(Request $request, $id = ""){
        $request->validate([
            'name' => 'required',
//            'description' => "required|min:3|max:255",
            'thuonggap' => "required|in:no,yes",
        ],[
            'required' => ":attribute không được để trống",
            'min' => ":attribute ít nhất :min ký tự",
            'max' => ":attribute vượt quá :max ký tự",
            'exists' => ":attribute phải được chọn",
            'integer' => ":attribute phải là một con số",
            'in' => ":attribute phải chọn yes hoặc no",
        ],[
            'name' => 'Tên',
            'description' => 'Mô tả ngắn',
            'thuonggap' => 'Câu hỏi thường gặp'
        ]);
    }

}
