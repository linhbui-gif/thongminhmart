<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Laravel\Passport\HasApiTokens;
class User extends Authenticatable
{
    use Notifiable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','first_name','last_name','status'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $folderUpload = "";
    public function __construct(){
        $className = (new \ReflectionClass($this))->getShortName();
        if(empty($this->folderUpload)){
            $this->folderUpload = strtolower($className);
        }
    }

    public function courses(){
        return $this->belongsToMany(Course_course::class, "users_course", "user_id", "course_id")->withTimestamps();
    }
    public function likes(){
        return $this->belongsToMany(User::class, "like_user_comment", "user_id", "comment_id");
    }
    public function comments(){
        return $this->hasMany("App\Comments", "user_id");
    }
    public function questions(){
        return $this->hasMany(QA_Question::class, "users_id");
    }
    public function orders(){
        return $this->hasMany("App\Order", "user_id");
    }

    public function addresses(){
        return $this->hasMany("App\Address", "user_id");
    }

    public function roles(){
        return $this->belongsToMany('App\Role', 'role_users', 'user_id','role_id');
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
    public function listItemsCustomer($params = [], $config = []){
        unset($params['search_list']['all']);
        $seachList = array_flip($params['search_list']);

        $user = Auth::user();
        $items = self::select("users.*");
        if(!$user->is_admin()){
            if($user->is_giangvien()){
                $items = $items->join('users_course', function($join) use($user){
                    $join->on('users.id', '=', 'users_course.user_id')
                        ->join('course_courses', function($join) use($user){
                            $join->on('course_courses.id', '=', 'users_course.course_id');
                        })->where('course_courses.teacher_id', $user->id);
                });
            }else{

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
            $dir = public_path() . "/images/" . $this->folderUpload . "/" . $this->picture;
            if( empty(trim($this->picture)) ||  !file_exists($dir)){
                $path = asset('enduser/assets/images/logo.png');
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
    public function fullname(){
        return $this->first_name . ' ' . $this->last_name;
    }
    public function is_admin(){
        $roles = $this->roles;
        foreach($roles as $k => $role){
            if($role->id == 1){
                return true;
            }
        }
        return false;
    }
    public function is_giangvien(){
        $roles = $this->roles;
        foreach($roles as $k => $role){
            if($role->id == 9){
                return true;
            }
        }
        return false;
    }
    public function is_guest(){
        $roles = $this->roles;

        if(count($roles) <= 0){
            return true;
        }else{
            return false;
        }

    }

}
