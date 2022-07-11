<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;

class Product_products extends Authenticatable
{
    protected $table = "product_products";
    protected $folderUpload = "";
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
    public function compos(){
        return $this->belongsToMany(Compo::class, "product_compo","product_id", "compo_id");
    }
    public function category()
    {
        return $this->belongsTo(Product_category::class, 'category_id');
    }
    public function comments(){
        return $this->hasMany("App\Comment", "product_id");
    }
    public function tags()
    {
        return $this->belongsToMany(Product_tags::class, 'product_products_tags', 'product_id','tag_id');
    }
    public function warehouse(){
        return $this->belongsTo(Warehouse::class, "warehouse_id", "id");
    }
    public function warehouse_product(){
        return $this->hasOne(Warehouse_product::class, "product_id", "id");
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
    public function getLink(){

        $slug_category = @$this->category->id;
        if(!empty($this->category->slug)){
            $slug_category = $this->category->slug;
        }

        $slug = $this->id;
        if(!empty($this->slug)){
            $slug = $this->slug;
        }

        $link = route("product.productDetail", [ 'slug_category' => $slug_category, 'slug' => $slug ]);
        return $link;
    }
}
