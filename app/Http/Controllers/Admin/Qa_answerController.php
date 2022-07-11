<?php

namespace App\Http\Controllers\Admin;

use App\Helper\Common;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\QA_answer as MainModel;
use Illuminate\Support\Facades\Hash;
use Session;

class Qa_answerController extends AdminController
{

    protected $pathView = "admin.core.";
    protected $config = [
        'pagination' => 10,
        'resizeImage' => [
            'thumb' => ['width' => 100],
            'standard' => ['width' => 300]
        ]
    ];
    protected $listFields = [
        [ 'name' => 'id', 'label' => 'Id', 'type' => 'text'],
        [ 'name' => 'name', 'label' => 'Answer', 'type' => 'text'],
        [ 'name' => 'status', 'label' => 'Status', 'type' => 'status'],
        [ 'name' => 'created_at', 'label' => 'Created At', 'type' => 'datetime', 'format' => 'd/m/Y' ],
        [ 'name' => 'updated_at', 'label' => 'Updated At', 'type' => 'datetime', 'format' => 'd/m/Y' ],
    ];
    protected $formFields = [
        'general_tab' => [
            'label_tab' => 'General',
            'items' => [
                [ 'label' => 'Answer', 'name' => 'name','type' => 'text'],
                [ 'label' => 'Câu hỏi' ,'name' => 'qa_question_id', 'type' => 'select', 'data_source' => \App\QA_Question::class, 'foreign_key' => 'qa_question_id' ],
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
            'qa_question_id' => "required|exists:qa_answer,id",
        ],[
            'required' => ":attribute không được để trống",
            'exists' => ":attribute phải được chọn",
        ],[
            'name' => 'Tên',
            'qa_question_id' => 'Câu hỏi',
        ]);
    }
    // option validate Update
    protected function validateUpdate(Request $request, $id = ""){
        $request->validate([
            'name' => 'required',
            'qa_question_id' => "required|exists:qa_answer,id",
        ],[
            'required' => ":attribute không được để trống",
            'exists' => ":attribute phải được chọn",
        ],[
            'name' => 'Tên',
            'qa_question_id' => 'Câu hỏi',
        ]);
    }

}
