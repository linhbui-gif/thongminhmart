<?php

namespace App\Http\Controllers\Api;

use App\blog_posts;
use App\blog_categories;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Api\BaseController as BaseController;
use Illuminate\Http\Request;

class BlogApiController extends BaseController
{
    public function list(){
        $data = blog_posts::where('status','active')->latest()->paginate(8);
        foreach ($data as $da){
            $da->picture = $da->getImage();
            //xy ly gallery
            $test =  json_decode($da->gallery,true);
            if (!empty($test)){
              $a = [];
              foreach($test as $t) {
                  $a[] = asset('images/blog_posts/'.$t);
              }
              $da->gallery = json_encode($a);
             }
        }
        return $this->sendResponse($data, 'Lấy danh sách bài viết thành công');
    }
    public function show($id){
        $data = blog_posts::find($id);
        $data->picture = $data->getImage();
        $test =  json_decode($data->gallery,true);
        if (!empty($test)){
            $a = [];
            foreach($test as $t) {
                $a[] = asset('images/blog_posts/'.$t);
            }
            $data->gallery = json_encode($a);
        }
         if($data){
             return $this->sendResponse($data, 'Lấy bài viết thành công');
         }
         else{
             return $this->sendError('Không tồn tại bài viết nào', 'error');
         }
    }
    public function category(){
        $data = blog_categories::where('status','active')->latest()->paginate(8);
        foreach ($data as $da){
            $da->picture = $da->getImage();
        }
        if($data){
            return $this->sendResponse($data, 'Lấy danh mục bài viết thành công');
        }
        else{
            return $this->sendError('Không tồn tại bài viết nào', 'error');
        }
    }

}
