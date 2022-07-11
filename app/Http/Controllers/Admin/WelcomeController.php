<?php

namespace App\Http\Controllers\Admin;

use App\Helper\Common;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;
use Session;

class WelcomeController extends Controller
{
    protected $pathView = "admin.page.welcome.";

    public function index(){
        return view($this->pathView . "index");
    }


}
