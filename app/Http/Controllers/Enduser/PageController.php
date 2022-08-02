<?php

namespace App\Http\Controllers\Enduser;

use App\Product_products;
use App\Http\Controllers\Admin\Blog_tagController;
use App\Page;
use App\Product_category;
use Hash;
use Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class PageController extends Controller
{
    protected $config = [
        'pagination' => 6,
        'resizeImage' => [
            'thumb' => ['width' => 100],
            'standard' => ['width' => 300]
        ]
    ];

    public function __construct()
    {

        view()->share('_config', \App\Config::first());
        $routeName = \Request::route()->getName();
        $page_id = 0;
        switch ($routeName){
            case "siteTuyendung":
                $page_id = 27;
                break;
            case "siteLvhd":
                $page_id = 31;
                break;
            case "siteKinhNghiem":
                $page_id = 22;
                break;
            case "siteIndex":
                $page_id = 19;
                break;
            case "siteAbout":
                $page_id = 28;
                break;
            case "siteContact":
                $page_id = 23;
                break;
            case "siteChitiet":
                $page_id = 29;
                break;


        }
        $page = Page::find($page_id);
        view()->share('page', $page);
    }
    public function getIndex()
    {
        $data['products'] = Product_products::where('status', 'active')->orderBy('order_no','asc')->get();

        return view(config("edushop.end-user.pathView") . "index")->with($data);;
    }
    public function lienhe(){

        return view(config("edushop.end-user.pathView") . "contact");
    }

    public function about(){

        return view(config("edushop.end-user.pathView") . "about");
    }
    public function tuyendung(){

        return view(config("edushop.end-user.pathView") . "tuyendung");
    }
    public function kinhnghiem(){

        return view(config("edushop.end-user.pathView") . "kinhnghiem");
    }
    public function chitietchungtoi(){
        return view('enduser.page.chitietchungtoi');
    }
    public function newList()
    {
        return view(config("edushop.end-user.pathView") . "blogList");
    }
    public function chinhsach(){
        return view(config("edushop.end-user.pathView") . "chinhsach");
    }
    public function productList(Request $request)
    {

        $data['products'] = Product_products::where('status', 'active')->orderBy('order_no', 'asc')->get();
        $data['categories'] = Product_category::where('status', 'active')->orderBy('order_no', 'asc')->get();
        return view(config("edushop.end-user.pathView") . "productList")->with($data);
    }
}
