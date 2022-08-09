<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use DB;

class Order extends Authenticatable
{
    protected $table = "order";
    protected $guarded = [];
    protected $folderUpload = "";
    public function __construct(){
        $className = (new \ReflectionClass($this))->getShortName();
        if(empty($this->folderUpload)){
            $this->folderUpload = strtolower($className);
        }
    }
    public function sellers(){
        return $this->belongsToMany(User::class, "order_user", "order_id", "user_id");
    }
    public function details(){
        return $this->hasMany("App\OrderDetail", "order_id");
    }
    public function suborder(){
        return $this->hasMany("App\OrderSub", "order_id");
    }
    public function coupon(){
        return $this->belongsTo(Coupon::class, "coupon_code", "name");
    }
    public function address(){
        return $this->belongsTo(OrderAddress::class, "address_id");
    }
    public function user(){
        return $this->belongsTo(User::class, "user_id");
    }
    public function province(){
        return $this->hasOne(Province::class, "id", "province_id");
    }
    public function district(){
        return $this->hasOne(District::class, "id","district_id");
    }
    public function ward(){
        return $this->hasOne(Ward::class, "id", "ward_id");
    }
    public function listItems($params = [], $config = []){

        $users = DB::table('users')->get();

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
    public function getTotalPrice(){
        $details = $this->details;
        $total = 0;
        if($details){
            foreach ($details as $k => $detail){
                $price = $detail->product_price;
                $totalPrice = $price * $detail->quantity;
                $total += $totalPrice;
            }
        }
        return $total;
    }
    public function getStatus(){
        $status = config("edushop.order_status");
        $classCss = "label-danger";
        if(in_array($this->trangthai, [4])){
            $classCss = "label-success";
        }else if(in_array($this->trangthai, [0,1,2,3])){
            $classCss = "label-warning";
        }
        return '<span class="label '.$classCss.'">'.$status[$this->trangthai].'</span>';
    }
    public function getPaymentMethod(){
        $config  = config("edushop.payment_method");
        if(isset($config[$this->pay_method])){
            return $config[$this->pay_method];
        }
        return $config["cod"];
    }
    public function getId(){
        return sprintf("%06d", $this->id);
    }

}
