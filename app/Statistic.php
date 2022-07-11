<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Statistic extends Authenticatable
{
    protected $table = "tbl_statistical";

    protected $folderUpload = "";
    public function __construct(){
        $className = (new \ReflectionClass($this))->getShortName();
        if(empty($this->folderUpload)){
            $this->folderUpload = strtolower($className);
        }
    }
    public function lessons(){
        return $this->hasMany(Lesson::class, "menu");
    }
    public function course(){
        return $this->belongsTo(Course_course::class, 'product_id');
    }
    public function listItems($params = [], $config = [],$course_id){
        unset($params['search_list']['all']);
        $seachList = array_flip($params['search_list']);
        $items = self::select("*")->where('product_id', $course_id);
        if(!empty($params['search_value'])){
            $field = $params['search_type'];
            $valueSearch = $params['search_value'];
            if($field == "all"){
                $items->where(function($items) use($params, $valueSearch,$seachList){
                    foreach ($seachList as $column) {
                        $items->orWhere($column, 'LIKE', "%{$valueSearch}%");
                    }
                });
            }else if(in_array($field, $seachList)){
                $items->where($field , 'LIKE', "%{$valueSearch}%");
            }
        }
        $items = $items->orderBy('id','desc');
        $items = $items->paginate($config['pagination']);
        return $items;
    }
    public function getImage($type = ""){
        if(empty($type)){
            if(empty($this->picture) || !file_exists(public_path() . "/images/" . $this->folderUpload . "/" . $this->picture)){
                $path = asset("enduser/assets/images/logo.png");
            }else{
                $path = asset("images/" . $this->folderUpload . "/" . $this->picture);
            }

        }else if($type == "thumb"){
            $path = asset("images/" . $this->folderUpload . "/thumb" . $this->picture);
        }else if($type == "standard"){
            $path = asset("images/" . $this->folderUpload . "/standard" . $this->picture);
        }
        return $path;
    }

    public function getChapterByCourse($id){
        $query = $this->select('*')->where('product_id', $id);
        $query = $query->join('edu_lesson', 'edu_chapter.id', '=', 'edu_lesson.menu')->get();
        return $query;
    }
}
