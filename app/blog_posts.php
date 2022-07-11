<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class blog_posts extends Model
{
    protected $table = "blog_posts";
    protected $folderUpload = "";
    public function __construct(){
        $className = (new \ReflectionClass($this))->getShortName();
        if(empty($this->folderUpload)){
            $this->folderUpload = strtolower($className);
        }
    }
    public function category()
    {
        return $this->belongsTo(blog_categories::class, 'category_id');
    }
    public function tags()
    {
        return $this->belongsToMany('App\blog_tags', 'blog_post_tag', 'post_id','tag_id');
    }
    public function posts()
    {
        return $this->belongsToMany('App\blog_posts', 'post_related_post', 'post_id', 'related_post_id');
    }
    public function listItems($params = [], $config = []){


        unset($params['search_list']['all']);
        $seachList = array_flip($params['search_list']);
        $items = self::select("*");
        $user = Auth::user();
        if(!$user->is_admin()){
            $items->where('created_by', $user->id);
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
            $path = asset("images/" . $this->folderUpload . "/thumb" . $this->picture);
        }else if($type == "standard"){
            $path = asset("images/" . $this->folderUpload . "/standard" . $this->picture);
        }
        return $path;
    }

}
