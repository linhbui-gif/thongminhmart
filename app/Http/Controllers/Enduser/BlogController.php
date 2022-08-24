<?php

namespace App\Http\Controllers\Enduser;

use App\Blog_categories;
use App\blog_posts;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BlogController extends Controller
{

    public function __construct()
    {
        $_config = \App\Config::find(26);
        return view()->share('_config', $_config);
    }

    public function newDetail($slug)
    {
        $course = blog_posts::where("status", "active")->where('slug', $slug)->first();
//        $related = $course->posts()->pluck('related_post_id')->toArray();
//        $related_post = DB::table('blog_posts')->whereIn('id', $related)->get();
        if ($course) {
            $idCategory = $course->category->id;
            $data['categoryName'] = $course->category->name;
        }
        $data['new'] = $course;
//        $data['related'] = $related_post;
        $data['blogSameCategory'] = blog_posts::where('category_id', $idCategory)->where('status', 'active')->get();
        return view(config("edushop.end-user.pathView") . "blogDetail")->with($data);
    }

    public function newList()
    {
        return view(config("edushop.end-user.pathView") . "blogList");
    }

    public function blogListByCategory(Request $request, $slug_category)
    {
        $category = Blog_categories::where('slug', $slug_category)->where('status', 'active')->first();

        if (!$category) {
            $category = Blog_categories::where('id', $slug_category)->where('status', 'active')->first();
        }
        if (!$category) {
            return abort(404);
        }

        $products = $category->news()->where('blog_posts.status', 'active')->orderBy('order_no','asc')->latest()->paginate(9);
        $data['blogs'] = $products;
        $data['category'] = $category;
        return view(config("edushop.end-user.pathView") . "postListByCategory")->with($data);
    }

//    public function courseListInCategory(Request $request, $category_slug){
//        $category = Course_category::where('slug', $category_slug)->first();
//        $courses = $category->courses()->where('course_courses.status','active')->orderBy('course_courses.id','desc')->paginate(15);
//
//        $data['category'] = $category;
//        $data['courses'] = $courses;
//        return view(config("edushop.end-user.pathView") . "courseListInCategory")->with($data);
//    }
//    public function lessionDetail(){
//
//        return view(config("edushop.end-user.pathView") . "lessionDetail");
//
//    }
//


}
