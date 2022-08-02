<?php

namespace App\Http\Controllers\Enduser;

use App\Comment;
use App\Course_category;
use App\Course_course;
use App\Http\Controllers\Controller;
use App\Lesson;
use App\Product_products;
use App\ResultExam;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Session;
use App\Chapter;
use Image;
class CourseController extends Controller
{

    public function __construct()
    {
        $_config = \App\Config::find(26);
        return view()->share('_config', $_config);
    }
    public function courseDetail(Request $request, $category_slug, $course_slug){

        $course = Course_course::where("status","active")->where('slug', $course_slug)->first();
        if(!$course){
            return redirect()->route('home.index');
        }
        $course_tag = Course_category::where('id', $course->category_id)->get();
        $data['course'] = $course;
        $data['comments'] = $course->comments()->where('parent_id', 0)->orderBy('comments.id','desc')->get();

        return view(config("edushop.end-user.pathView") . "courseDetail")->with($data)->with('course_tag', $course_tag);

    }

    public function search(Request $request){
        $params = $request->all();
        $course_category = Course_category::all();
        if(isset($params['sort']) && $params['category']){
            if($params['sort'] != "0" && $params['category'] != 0){
                $sort_by = explode("-", $params['sort']);
                $key_word = $params['key_word'];
                $courses['courses'] = Course_course::where('name', 'LIKE', '%' . $key_word . '%')->where('course_courses.status','active')->where('category_id', $params['category'])->orderBy($sort_by[0], $sort_by[1])->paginate(15);
                return view(config("edushop.end-user.pathView") . "course_search")->with($courses)->with('key_word', $key_word)->with('sort_by', $params['sort'])->with('course_category', $course_category)->with('category_id', $params['category']);
            }
        }
        if(isset($params['sort'])){
            if ($params['sort'] != "0") {
                $sort_by = explode("-", $params['sort']);
                $key_word = $params['key_word'];
                $courses['courses'] = Course_course::where('name', 'LIKE', '%' . $key_word . '%')->where('course_courses.status','active')->orderBy($sort_by[0], $sort_by[1])->paginate(15);
                return view(config("edushop.end-user.pathView") . "course_search")->with($courses)->with('key_word', $key_word)->with('sort_by', $params['sort'])->with('course_category', $course_category);
            }
        }
        if (isset($params['category'])){
            if ($params['category'] != 0){
                 $key_word = $params['key_word'];
                 $courses['courses'] = Course_course::where('name', 'LIKE', '%' . $key_word . '%')->where('course_courses.status','active')->where('category_id', $params['category'])->paginate(15);
                 return view(config("edushop.end-user.pathView") . "course_search")->with($courses)->with('key_word', $key_word)->with('sort_by', $params['sort'])->with('course_category', $course_category)->with('category_id', $params['category']);
            }
        }
        if(isset($params['search']) || $params['search'] == null){
            $key_word = $params['search'];
            $courses['courses'] = Course_course::where('name', 'LIKE', '%' . $key_word . '%')->where('course_courses.status','active')->paginate(15);
            return view(config("edushop.end-user.pathView") . "course_search")->with($courses)->with('key_word', $key_word)->with('course_category', $course_category);
        }
        $key_word = $params['key_word'];
        $courses['courses'] = Course_course::where('name', 'LIKE', '%' . $key_word . '%')->where('course_courses.status','active')->paginate(15);
        return view(config("edushop.end-user.pathView") . "course_search")->with($courses)->with('key_word', $key_word)->with('course_category', $course_category);
    }

    public function searchResult(Request $request){
        $params = $request->all();
        $course_category = Course_category::all();
        if(isset($params['search']) && $params['search'] != null && !empty($params['search'])){
            $key_word = $params['search'];
            $courses['courses'] = Course_course::where('course_courses.status','active')->where('name', 'LIKE', '%' . $key_word . '%')->paginate(15);
            return view(config("edushop.end-user.pathView") . "course_search")->with($courses)->with('key_word', $key_word)->with('course_category', $course_category);
        }else{
            return redirect()->route('home.index');
        }
        //$key_word = $params['key_word'];
        //$courses['courses'] = Course_course::where('name', 'LIKE', '%' . $key_word . '%')->orWhere('short_description', 'LIKE', '%' . $key_word . '%')->paginate(15);
        //return view(config("edushop.end-user.pathView") . "course_search")->with($courses)->with('key_word', $key_word)->with('course_category', $course_category);
    }

    public function courseList(){
        $data['categories'] = Course_category::where('status','active')->orderBy('id','desc')->get();
        return view(config("edushop.end-user.pathView") . "courseList")->with($data);
    }

    public function courseListInCategory(Request $request, $category_slug){
        $category = Course_category::where('slug', $category_slug)->first();
        $courses = $category->courses()->where('course_courses.status','active')->orderBy('course_courses.id','desc')->paginate(15);

        $data['category'] = $category;
        $data['courses'] = $courses;
        return view(config("edushop.end-user.pathView") . "courseListInCategory")->with($data);
    }

    public function lessionDetail(){
        $user = Auth::user();

        return view(config("edushop.end-user.pathView") . "lessionDetail");

    }

    public function lessionDetailChapter(Request $request, $slug_lesson){

        $user = \Auth::user();

        $type = "demo";
        if($user){
            $check = $user->courses()->where('course_courses.slug', $slug_lesson)->first();
            if($user && $check){
                $type = "full";
            }
        }


        // list ra các bài học
        $list_chapter = [];
        $list_lessons = [];
        $course = Course_course::where("status","active")->where('slug', $slug_lesson)->first();
        $chapter = $course->chapters()->orderBy('ordering', 'asc')->get();
        foreach ($chapter as $key => $value){
            $list_chapter[$key] = $value->lessons()->orderBy('sort', 'asc')->get();
        }
        foreach ($list_chapter as $key => $value){
            foreach ($value as $item => $collection){
                $list_lessons[] = $collection;
            }
        }

        if(isset($request->lesson)){
            if(!$this->checkLessonInList($request->lesson, $list_lessons)){
                return redirect()->route('home.index');
            }

            $lesson = Lesson::find($request->lesson);
        }else{
            // lấy video mặc định đầu bài học
            $lesson = $list_lessons[0];
        }
        $questions = $lesson->questions()->orderBy('order','asc')->get();
        // xác định rặng video này thuộc list danh sách bài học này

        //$result_exam = $lesson->results_exam;
        $lesson->watched = 1;
        $lesson->save();

        $query = "select * from user_lesson where user_id = " . $user->id . " and lesson_id=" .  $lesson->id;
        $rs = DB::select($query);
        if(count($rs) <= 0){
            DB::table('user_lesson')->insert([
                'user_id' => $user->id,
                'lesson_id' => $lesson->id,
                'watched' => 1
            ]);
        }else{
            DB::table('user_lesson')->where('user_id', $user->id)->where('lesson_id', $lesson->id)->update([
                'watched' => 1
            ]);
        }

        return view(config("edushop.end-user.pathView") . "lessionDetail")
            ->with('course' , $course)
            ->with('list_lessons', $list_lessons)
            ->with('type', 'full')
            ->with('lesson_current', $lesson)
            ->with('type', $type)
            ->with('questions', $questions);

    }
    public function postExam(Request $request, $slug_course){
        $user = \Auth::user();
        if($user){
            $check = $user->courses()->where('course_courses.slug', $slug_course)->first();
            if(!$check){
                return redirect()->route('home.index');
            }
        }else{
            return redirect()->route('home.index');
        }
        // list ra các bài học
        $list_chapter = [];
        $list_lessons = [];
        $course = Course_course::where("status","active")->where('slug', $slug_course)->first();
        $chapter = $course->chapters;
        foreach ($chapter as $key => $value){
            $list_chapter[$key] = $value->lessons;
        }
        foreach ($list_chapter as $key => $value){
            foreach ($value as $item => $collection){
                $list_lessons[] = $collection;
            }
        }

        if(isset($request->lesson_id)){
            if(!$this->checkLessonInList($request->lesson_id, $list_lessons)){
                return redirect()->route('home.index');
            }

        }else{
            return redirect()->route('home.index');
        }
        $lesson = Lesson::find($request->lesson_id);

        $questions = $lesson->questions()->orderBy('order','asc')->get();
       if(!$request->dapan || count($request->dapan) !=  count($questions) ){
           // chưa trả lời hết
           Session::flash('error', 'Bạn chưa hoàn thành bài kiểm tra');
           $route = route('course.lessionDetailChapter', [ 'slug_lesson' => $slug_course ]) . "?lesson=" . $request->lesson_id . "&tab=exam";
           return redirect($route);
       }
        foreach($request->dapan as $l_id => $dapan){
            $result = new ResultExam();
            $result->lesson_id = $request->lesson_id;
            $result->question_id = $l_id;
            $result->answer = $dapan;
            $result->user_id = $user->id;
            $result->save();
        }
        $route = route('course.lessionDetailChapter', [ 'slug_lesson' => $slug_course ]) . "?lesson=" . $request->lesson_id . "&tab=result";
        return redirect($route);
    }
    public function checkLessonInList($lesson_id, $list){
        foreach($list as $k => $item){
            if($lesson_id == $item->id){
                return true;
            }
        }
        return false;
    }


    public function addComment(Request $request){
        if($request->method() == "POST"){
            $user = $request->user();
            $course = Course_course::find($request->course_id);
            $product = Product_products::find($request->product_id);
            $parent = User::find($request->parent_id);
            $request->validate([
               'body' => 'required'
            ],[
                'required' => ':attribute không được rỗng'
            ],[
                'body' => 'Nội dung'
            ]);
            if($course){
                if($request->parent_id == 0 || $parent ){
                    $comment = new Comment();

                    $comment->body = $request->body;
                    $comment->course_id = $request->course_id;
                    $comment->star = $request->star;
                    $comment->parent_id = $request->parent_id;
                    $comment->user_id = $user->id;
//                    if($request->type == 'product'){
//                        $comment->product_id = $request->product_id;
//                        $comment->type = $request->type;
//                    }
                    if($request->images){
                        // upload images
                        $comment->images = $this->uploadThumb($request->images);
                    }


                    $comment->save();
                    Session::flash('success', 'Đã đánh giá thành công');
                }
            }
            if($product){
                if($request->parent_id == 0 || $parent ){
                    $comment = new Comment();

                    $comment->body = $request->body;
                    $comment->star = $request->star;
                    $comment->parent_id = $request->parent_id;
                    $comment->user_id = $user->id;
                    $comment->product_id = $request->product_id;
                    $comment->type = $request->type;
                    if($request->images){
                        // upload images
                        $comment->images = $this->uploadThumb($request->images);
                    }


                    $comment->save();
                    Session::flash('success', 'Đã đánh giá thành công');
                }
            }
        }
        return redirect()->back();
    }
    public function likeComment(Request $request){
        $like = $request->like == 1 ? 1 : 0;
        $user = $request->user();
        //$update_result  = $user->likes()->sync($request->comment_id, [ 'like' => $like ],true);
        $result = $user->likes()->where('comment_id', $request->comment_id)->exists();
        if(!$result){
            $user->likes()->attach([ $request->comment_id ],  [ 'like' => $like ] );
        }else{
            $user->likes()->where('comment_id', $request->comment_id)->update([ 'like' => $like  ]);
        }
        return redirect()->back();
    }

    public function courseTagSlug(Request $request, $slug){
        $params = $request->all();
        $course_category = Course_category::where('slug', $slug)->first();
        $slug_id = $course_category->id;
        $category_name = $course_category->name;
        $courses = Course_course::where('category_id', $slug_id)->paginate(15);
        if(isset($params['sort'])){
            if ($params['sort'] != "0") {
                $sort_by = explode("-", $params['sort']);
                $courses = Course_course::where('category_id', $slug_id)->orderBy($sort_by[0], $sort_by[1])->paginate(15);
                return view(config("edushop.end-user.pathView") . "courseTag")->with('courses', $courses)->with('category_name', $category_name)->with('slug', $slug)->with('sort_by', $params['sort']);
            }
        }
        return view(config("edushop.end-user.pathView") . "courseTag")->with('courses', $courses)->with('category_name', $category_name)->with('slug', $slug);
    }
    public function uploadThumb($thumbObj, $name_picture_custome = ""){

        //$thumbObj = $params['picture'];
        $name_picture_custome = Str::slug($name_picture_custome);

        $thumbnailImage = Image::make($thumbObj);

        $ext = $thumbObj->clientExtension();

        $thumbName = Str::random(10) . '.' . $ext;

        $originalPath = public_path().'/images/comments/';
        if( ! \File::isDirectory($originalPath) ) {
            \File::makeDirectory($originalPath, 493, true);
        }
        if($name_picture_custome != null || !empty($name_picture_custome)){
            $pathInputNameImage = $originalPath . $name_picture_custome;
            if(file_exists($pathInputNameImage . "." . $ext)){
                $thumbName = $name_picture_custome ."-". time() . "." . $ext;
            }else{
                $thumbName = $name_picture_custome . "." . $ext;
            }
        }
        $thumbnailImage->save($originalPath.$thumbName);

        return $thumbName;
    }
    public function searchProduct(){
        $key = $_GET['keyword'];
        $data['products'] = Product_products::where('name','LIKE','%' . $key . '%')->orWhere('short_description','LIKE','%' . $key . '%')->orWhere('content','LIKE','%' . $key . '%')->get();
        return view(config("edushop.end-user.pathView") . "productSearch")->with($data);
    }
}
