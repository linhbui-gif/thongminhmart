<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Lesson extends Authenticatable
{
    protected $table = "edu_lesson";
    protected $folderUpload = "lesson";
    public function __construct(){
        $className = (new \ReflectionClass($this))->getShortName();
        if(empty($this->folderUpload)){
            $this->folderUpload = strtolower($className);
        }
    }
    public function comments(){
        return $this->hasMany("App\Comment", "lesson_id");
    }
    public function chappter(){
        return $this->belongsTo(Chapter::class, "menu");
    }
    public function questions(){
        return $this->hasMany(Tracnghiem::class, "lesson_id");
    }
    public function results_exam(){
        return $this->hasMany(ResultExam::class, "lesson_id");
    }
    public function listItems($params = [], $config = []){
        unset($params['search_list']['all']);
        $seachList = array_flip($params['search_list']);
        $items = self::select("*");
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

            if(empty($this->thumbnail) || !file_exists(public_path() . "/images/" . $this->folderUpload . "/" . $this->thumbnail)){
                $path = asset("enduser/assets/images/logo.png");
            }else{
                $path = asset("images/" . $this->folderUpload . "/" . $this->thumbnail);
            }
        }else if($type == "thumb"){
            $path = asset("images/" . $this->folderUpload . "/thumb" . $this->picture);
        }else if($type == "standard"){
            $path = asset("images/" . $this->folderUpload . "/standard" . $this->picture);
        }
        return $path;
    }

    public function uploadVideoLesson($id, $nameVideo){
        $query = $this->select("*")->where('id', $id)->update($nameVideo);
        return $query;
    }

    public function get_item_by_id($id){
        $query = $this->select("*")->where('id', $id)->get();
        return $query;
    }

    public function uploadImageLesson($id, $nameImage){
        $query = $this->select("*")->where('id', $id)->update(['thumbnail' => $nameImage]);
        return $query;
    }

    public function uploadDuration($id, $time){
        $query = $this->select("*")->where('id', $id)->update(['duration' => $time]);
        return $query;
    }

    public function uploadTextTrack($id, $texttrack, $name){
        $query = $this->select('*')->where('id', $id)->update(['text_track_' . $name => $texttrack]);
        return $query;
    }
}
