<?php

namespace App\Http\Controllers\Api;

use App\Course_category;
use App\Course_course;
use App\Comment;
use App\Product_products;
use App\User;
use App\Http\Controllers\Api\BaseController as BaseController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CourseApiController extends BaseController
{
    public function list(){
        $data = Course_course::where('status','active')->latest()->paginate(8);
        foreach ($data as $da){
            $da->picture = $da->getImage();
            $test =  json_decode($da->gallery,true);
            if (!empty($test)){
                $a = [];
                foreach($test as $t) {
                    $a[] = asset('images/course_courses/'.$t);
                }
                $da->gallery = json_encode($a);
            }
        }
        return $this->sendResponse($data, 'Lấy danh sách course thành công');
    }
    public function show(Request $request, $category_slug, $course_slug)
    {

        $course = Course_course::where("status", "active")->where('slug', $course_slug)->first();
            $course_tag = Course_category::where('id', @$course->category_id)->get();
            $data['course'] = $course;
            $data['comments'] = $course->comments('parent_id', 0)->orderBy('comments.id', 'desc')->get();
            $data['course']->picture = $data['course']->getImage();
            $chapters = $data['course']->chapters;
            $compo =  $data['course']->compos;
            $totalLesson = \App\Helper\Common::getTotalLesson($chapters);
            $test = json_decode($data['course']->gallery, true);
            if (!empty($test)) {
                $a = [];
                foreach ($test as $t) {
                    $a[] = asset('images/course_courses/' . $t);
                }
                $data['course']->gallery = json_encode($a);
            }
            foreach( $data['comments'] as $comment ){
                $comment->images = asset('images/comments/'. $comment->images);
            }
            return $this->sendResponse([
                'data' => $data,
                'course_tag' => $course_tag,
                'total_lesson' => $totalLesson,
                'compo' => $compo
            ], 'Lấy khóa học chi tiết thành công');



    }
    public function addComment(Request $request){
            $course = Course_course::find($request->course_id);
            $parent = User::find($request->parent_id);
            $product = Product_products::find($request->product_id);
            if($course){
                if($request->parent_id == 0 || $parent ){
                    $comment = new Comment();
                    $comment->body = $request->body;
                    $comment->course_id = $request->course_id;
                    $comment->star = $request->star;
                    $comment->parent_id = $request->parent_id;
                    $comment->user_id = Auth::user()->id;

                    if($request->images){
                        // upload images
                        $comment->images = $this->uploadThumb($request->images);
                    }

                    $comment->save();
                    return $this->sendResponse($comment, 'Lưu đánh giá khoas hoc thành công');
                }
            }
            if($product){
            if($request->parent_id == 0 || $parent ){
                $comment = new Comment();

                $comment->body = $request->body;
                $comment->star = $request->star;
                $comment->parent_id = $request->parent_id;
                $comment->user_id = Auth::user()->id;
                $comment->product_id = $request->product_id;
                $comment->type = $request->type;
                if($request->images){
                    // upload images
                    $comment->images = $this->uploadThumb($request->images);
                }


                $comment->save();
                return $this->sendResponse($comment, 'Lưu đánh giá sản phẩm thành công');
            }
        }
    }
    public function category(){
        $data = Course_category::where('status','active')->latest()->paginate(8);
        foreach ($data as $da){
            $da->picture = $da->getImage();
        }
        if($data){
            return $this->sendResponse($data, 'Lấy danh mục khóa học thành công');
        }
        else{
            return $this->sendError('Không tồn tại khóa học nào', 'error');
        }
    }
    public function categoryShow($id){
        $data = Course_category::find($id);
        if($data){
            return response([
                'data' => $data,
                'message' => 'success'
            ],200);
        }
        else{
            return response([
                'error' => 'Không tồn tại danh mục nào',
                'message' => 'error'
            ],400);
        }
    }
    public function courseListInCategory(Request $request, $category_slug){
        $category = Course_category::where('slug', $category_slug)->first();
        $courses = $category->courses()->where('course_courses.status','active')->orderBy('course_courses.id','desc')->paginate(9);

        $data['category'] = $category;
        $data['courses'] = $courses;
        $data['category']->picture = $data['category']->getImage();
        foreach ($data['courses'] as $da){
            $da->picture = $da->getImage();
            $test =  json_decode($da->gallery,true);
            if (!empty($test)){
                $a = [];
                foreach($test as $t) {
                    $a[] = asset('images/course_courses/'.$t);
                }
                $da->gallery = json_encode($a);
            }
        }
        return $this->sendResponse($data, 'Lấy khóa học theo danh mục thành công');
    }
    public function lessionDetailChapter($slug_lesson){
        $list_chapter = [];
        $list_lessons = [];
        $course_id = Course_course::where("status","active")->where('slug', $slug_lesson)->first();
        $course = \App\Course_course::find($course_id->id);
        $chapter = $course->chapters;
        foreach ($chapter as $key => $value){
            $list_chapter[$key] = $value->lessons;
        }
        foreach ($list_chapter as $key => $value){
            foreach ($value as $item => $collection){
                $list_lessons[$collection->id] = $collection;
            }
        }
        foreach ($list_lessons as $da){
            $da->thumbnail = $da->getImage();
        }
        return $this->sendResponse($list_lessons, 'Show bài học chi tiết thành công');
    }
    public function courseTagSlug(Request $request, $slug){
        $params = $request->all();
        $course_category = Course_category::where('slug', $slug)->first();
        $slug_id = $course_category->id;
        $category_name = $course_category->name;
        $courses = Course_course::where('category_id', $slug_id)->paginate(8);
        foreach ($courses as $da){
            $da->picture = $da->getImage();
            $test =  json_decode($da->gallery,true);
            if (!empty($test)){
                $a = [];
                foreach($test as $t) {
                    $a[] = asset('images/course_courses/'.$t);
                }
                $da->gallery = json_encode($a);
            }
        }
        if(isset($params['sort'])){
            if ($params['sort'] != "0") {
                $sort_by = explode("-", $params['sort']);
                $courses = Course_course::where('category_id', $slug_id)->orderBy($sort_by[0], $sort_by[1])->paginate(8);
                return $this->sendResponse([
                    "courses" => $courses,
                    "category_name" => $category_name,
                    "slug" => $slug,
                    "sort_by" => $params['sort']
                ], 'ok');

            }
        }

        return $this->sendResponse([
            "courses" => $courses,
            "category_name" => $category_name,
            "slug" => $slug,
        ], 'ok');

    }
    public function search(Request $request){
        $params = $request->all();
        $course_category = Course_category::all();
        if(isset($params['sort']) && $params['category']){
            if($params['sort'] != "0" && $params['category'] != 0){
                $sort_by = explode("-", $params['sort']);
                $key_word = $params['key_word'];
                $courses['courses'] = Course_course::where('name', 'LIKE', '%' . $key_word . '%')->where('category_id', $params['category'])->orderBy($sort_by[0], $sort_by[1])->paginate(8);
                return $this->sendResponse([
                    "courses" => $courses,
                    "key_word" => $key_word,
                    "sort_by" => $params['sort'],
                    "course_category" => $course_category,
                    "category_id" => $params['category']
                ], 'ok');
            }
        }
        if(isset($params['sort'])){
            if ($params['sort'] != "0") {
                $sort_by = explode("-", $params['sort']);
                $key_word = $params['key_word'];
                $courses['courses'] = Course_course::where('name', 'LIKE', '%' . $key_word . '%')->orderBy($sort_by[0], $sort_by[1])->paginate(8);
                return $this->sendResponse([
                    "courses" => $courses,
                    "key_word" => $key_word,
                    "sort_by" => $params['sort'],
                    "course_category" => $course_category,
                ], 'ok');

            }
        }
        if (isset($params['category'])){
            if ($params['category'] != 0){
                $key_word = $params['key_word'];
                $courses['courses'] = Course_course::where('name', 'LIKE', '%' . $key_word . '%')->where('category_id', $params['category'])->paginate(8);
                return $this->sendResponse([
                    "courses" => $courses,
                    "key_word" => $key_word,
                    "sort_by" => $params['sort'],
                    "course_category" => $course_category,
                    "category_id" => $params['category']
                ], 'ok');

            }
        }
        if(isset($params['search']) || $params['search'] == null){
            $key_word = $params['search'];
            $courses['courses'] = Course_course::where('name', 'LIKE', '%' . $key_word . '%')->paginate(8);
            return $this->sendResponse([
                "courses" => $courses,
                "key_word" => $key_word,
                "course_category" => $course_category,
            ], 'ok');
        }
        $key_word = $params['key_word'];
        $courses['courses'] = Course_course::where('name', 'LIKE', '%' . $key_word . '%')->paginate(8);
        return $this->sendResponse([
            "courses" => $courses,
            "key_word" => $key_word,
            "course_category" => $course_category,
        ], 'ok');
    }
}
