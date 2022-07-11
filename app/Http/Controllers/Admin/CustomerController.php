<?php

namespace App\Http\Controllers\Admin;

use App\Helper\Common;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\Helper\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\User as MainModel;
use Illuminate\Support\Facades\Hash;
use Session;

class CustomerController extends AdminController
{
    protected $pathView = "admin.page.customer.";
    protected $config = [
        'pagination' => 50,
        'resizeImage' => [
            'thumb' => ['width' => 100],
            'standard' => ['width' => 300]
        ]
    ];
    protected $listFields = [
        [ 'name' => 'id', 'label' => 'Id', 'type' => 'text'],
        [ 'name' => 'email', 'label' => 'Email', 'type' => 'text'],
        [ 'name' => 'url_picture', 'label' => 'Picture', 'type' => 'thumb_url'],
        [ 'name' => 'first_name', 'label' => 'First Name', 'type' => 'text'],
        [ 'name' => 'last_name', 'label' => 'Last Name', 'type' => 'text'],
        [ 'name' => 'customer_course', 'label' => 'Khóa học', 'type' => 'customer_course'],
        [ 'name' => 'created_at', 'label' => 'Created At', 'type' => 'datetime', 'format' => 'd/m/Y' ],
        [ 'name' => 'updated_at', 'label' => 'Updated At', 'type' => 'datetime', 'format' => 'd/m/Y' ],
    ];
    protected $formFields = [
        'general_tab' => [
            'label_tab' => 'General',
            'items' => [
                [ 'label' => 'First Name' ,'name' => 'first_name', 'type' => 'text'],
                [ 'label' => 'Last Name' ,'name' => 'last_name', 'type' => 'text'],
                [ 'label' => 'Email' ,'name' => 'email', 'type' => 'email'],
                [ 'label' => 'Active' ,'name' => 'status', 'type' => 'status'],
                [ 'label' => 'Password' ,'name' => 'password', 'type' => 'password'],
                [ 'label' => 'Re-Password' ,'name' => 'password_confirmation', 'type' => 'password'],
            //    [ 'label' => 'Avatar' ,'name' => 'picture', 'type' => 'file'],
                [ 'label' => 'Avatar' ,'name' => 'url_picture', 'type' => 'file_from_url'],

            ]
        ],
        'role' => [
            'label_tab' => 'Role',
            'items' => [
                [ 'label' => 'Role' ,'name' => 'role_id', 'type' => 'checkbox', 'modal' => \App\Role::class,'key_relave' => 'roles'  ],
            ]
        ]
    ];
    protected $searchList = [
        'all' => 'Search By All',
        'id' => 'Search By Id',
        'email' => 'Search By Email'
    ];
    protected $notAcceptedCrud = [  '_token', 'password_confirmation','role_id'];
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
    public function index(Request $request)
    {
        $params = $request->all();
        $params['search_list'] = $this->searchList;
        $params['search_type'] = isset($params['search_type']) && in_array($params['search_type'], array_flip($this->searchList) ) ? $params['search_type'] : "all";
        $params['search_value'] = isset($params['search_value']) ? $params['search_value'] : "";
        $data['items'] = $this->model->listItemsCustomer($params, $this->config);
        $data['params'] = $params;
        //dd($this);
        if($this->logFolder){
            $time = Carbon::now()->format('H:i:s');
            $message = "[$time] " . $request->user()->email . " view";
            $log = new Log($this->logFolder);
            $log->put("log-" . date("Y-m-d"), $message);
        }
        return view($this->pathView . 'index')->with($data);
    }
    public function listCourse(Request $request, $customer_id){
        $user = \Auth::user();

        $customer = $this->model->find($customer_id);

        $items = $customer->courses;
        if($user->is_giangvien() ){
            $items = $items = $customer->courses()->where('course_courses.teacher_id', $user->id)->get();
        }elseif($user->is_admin() ){
            $items = $customer->courses;
        }


        $data['items'] = $items;
        $data['customer'] = $customer;
        return view($this->pathView . 'list_course')->with($data);
    }
    public function removeCourse($id_customer, $id_course){
        $user = $this->model->find($id_customer);
        $user->courses()->detach([ 'courses_id' => $id_course ]);
        Session::flash('success', 'Bạn đã xóa thành công');
        return redirect()->back();
    }


}
