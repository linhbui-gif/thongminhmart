<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class Config extends Model
{
    protected $table = "config";
    public function users(){
        return $this->belongsToMany('App\User', 'role_users' ,'role_id', 'user_id');
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

}
