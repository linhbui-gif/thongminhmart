<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Comment extends Authenticatable
{
    protected $table = "comments";
    protected $folderUpload = "";
    public function __construct(){
        $className = (new \ReflectionClass($this))->getShortName();
        if(empty($this->folderUpload)){
            $this->folderUpload = strtolower($className);
        }
    }
    public function childrens(){
        return $this->hasMany(Comment::class, 'parent_id', 'id')->where('parent_id', '!=', 0);
    }
    public function user(){
        return $this->belongsTo(User::class, "user_id");
    }
    public function likes(){
        return $this->belongsToMany(User::class, "like_user_comment", "comment_id", "user_id");
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
            $path = asset("images/" . $this->folderUpload . "/" . $this->picture);
        }else if($type == "thumb"){
            $path = asset("images/" . $this->folderUpload . "/thumb" . $this->picture);
        }else if($type == "standard"){
            $path = asset("images/" . $this->folderUpload . "/standard" . $this->picture);
        }
        return $path;
    }

}
