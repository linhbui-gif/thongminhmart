<?php

namespace App\Http\Controllers\Admin;

use App\Helper\Common;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Address as MainModel;
use Illuminate\Support\Facades\Hash;
use Session;

class AddressController extends AdminController
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
        [ 'name' => 'fullname', 'label' => 'Full Name', 'type' => 'text'],
        [ 'name' => 'email', 'label' => 'Email', 'type' => 'text'],
        [ 'name' => 'phone', 'label' => 'Phone', 'type' => 'text'],
//        [ 'name' => 'district_id', 'label' => 'District Id', 'type' => 'text'],
//        [ 'name' => 'province_id', 'label' => 'Province Id', 'type' => 'text'],
        [ 'name' => 'address', 'label' => 'Address', 'type' => 'text'],
        [ 'name' => 'url_picture', 'label' => 'Picture', 'type' => 'thumb_url'],
//        [ 'name' => 'picture', 'label' => 'Picture', 'type' => 'thumb'],
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
                [ 'label' => 'Full Name', 'name' => 'fullname','type' => 'text'],
                [ 'label' => 'Email', 'name' => 'email','type' => 'email'],
                [ 'label' => 'Phone', 'name' => 'phone','type' => 'text'],
                [ 'label' => 'Status' ,'name' => 'status', 'type' => 'status'],
                [ 'label' => 'District Id', 'name' => 'district_id','type' => 'select2', 'data_source' => \App\Address::class],
                [ 'label' => 'Province Id', 'name' => 'province_id','type' => 'select2', 'data_source' => \App\Address::class],
                [ 'label' => 'Address', 'name' => 'address','type' => 'text'],
 //               [ 'label' => 'Picture' ,'name' => 'picture', 'type' => 'file'],
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

    }
    // option validate Update
    protected function validateUpdate(Request $request, $id = ""){

    }

}
