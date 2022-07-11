<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;

class Course_course extends Authenticatable
{
    protected $table = "course_courses";
    protected $folderUpload = "course_courses";
    public function __construct(){
        $className = (new \ReflectionClass($this))->getShortName();
        if(empty($this->folderUpload)){
            $this->folderUpload = strtolower($className);
        }
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
    public function of_giangvien()
    {
        return $this->belongsTo(User::class, 'teacher_id');
    }
    public function compos(){
        return $this->hasMany(Compo::class, "course_id");
    }
    public function chapters(){
        return $this->hasMany(Chapter::class, "product_id");
    }
    public function category(){
        return $this->belongsTo("App\Course_category", "category_id");
    }
    public function comments(){
        return $this->hasMany("App\Comment", "course_id");
    }
    public function listItems($params = [], $config = []){
        unset($params['search_list']['all']);
        $seachList = array_flip($params['search_list']);
        $items = self::select("*");
        $user = Auth::user();
        if(!$user->is_admin()){
            if($user->is_giangvien()){
                $items->where('teacher_id', $user->id);
            }else{
                $items->where('created_by', $user->id);
            }

        }
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
            $path = asset("images/" . $this->folderUpload . "/" . $this->picture);
        }else if($type == "thumb"){
            $path = asset("images/" . $this->folderUpload . "/thumb/" . $this->picture);
        }else if($type == "standard"){
            $path = asset("images/" . $this->folderUpload . "/standard/" . $this->picture);
        }
        return $path;
    }
}
