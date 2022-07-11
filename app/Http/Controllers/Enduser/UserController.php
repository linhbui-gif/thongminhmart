<?php

namespace App\Http\Controllers\Enduser;

use App\Http\Controllers\Controller;
use App\ResetPassword;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Validator;
use Session;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use Zalo\Zalo;
use Carbon\Carbon;
class UserController extends Controller
{
    public function __construct()
    {
        $_config = \App\Config::find(26);
        return view()->share('_config', $_config);
    }
    public function index(){

        return view(config("edushop.end-user.pathView") . "login");

    }
    public function postLogin(Request $request){
         Validator::make($request->all(),
            [
            'email' => 'required|email',
            'password' => 'required',
           ],
            [
                'email.required' => 'Email người dùng không được để trống',
                'email.email' => 'Bạn chưa nhập đúng định dạng email',
                'password.required' => 'Bắt buộc phải nhập mật khẩu',
            ]
        )->validate();
        $cerdential = $request->only(['email','password']);

        if (Auth::attempt($cerdential)){
            return redirect()->intended('/');
        }
        return redirect()->back();
    }

    public function redirectToProvider($driver)
    {
        return Socialite::driver($driver)->redirect();
    }

    public function handleProviderCallback($driver)
    {
        if($driver === 'google'){
            try {
                $user = Socialite::driver($driver)->user();
            } catch (\Exception $e) {
                return redirect()->route('user.login');
            }
            $existingUser = User::where('email', $user->getEmail())->where('type', $driver)->first();
            if ($existingUser) {
                auth()->login($existingUser, true);
            } else {
                // chưa có tài khoản trong CSDL
                $newUser = new User();
                $newUser->email = $user->getEmail();
                $newUser->type = $driver;
                $newUser->username = $user->getName();
                $newUser->first_name = $user['given_name'];
                $newUser->last_name = $user['family_name'];
                $newUser->picture = $user->getAvatar();
                $newUser->save();
                auth()->login($newUser, true);
            }
        }
        if($driver === "facebook"){
            try {
                $user = Socialite::driver($driver)->user();
            } catch (\Exception $e) {
                return redirect()->route('user.login');
            }
            $existingUser = User::where('email', $user->getEmail())->where('type', $driver)->first();
            if ($existingUser) {
                auth()->login($existingUser, true);
            } else {
                // chưa có tài khoản trong CSDL
                $fullName = $user->getName();
                $arrName = $this->split_name($fullName);

                $newUser = new User();
                $newUser->email = $user->getEmail();
                $newUser->type = $driver;
                $newUser->username = $user->getEmail();
                $newUser->first_name = $arrName[0] ?? "";
                $newUser->last_name = $arrName[1] ?? "";
                $newUser->picture = $user->getAvatar();
                $newUser->save();
                auth()->login($newUser, true);
            }
        }
        if($driver === "zalo"){
            try {
                $user = Socialite::driver($driver)->user();
            } catch (\Exception $e) {
                return redirect()->route('user.login');
            }
            $existingUser = User::where('id_zalo', $user->getId())->where('type', $driver)->first();
            if ($existingUser) {
                auth()->login($existingUser, true);
            } else {
                // chưa có tài khoản trong CSDL
                $fullName = $user->getName();
                $arrName = $this->split_name($fullName);
                $newUser = new User();
                $newUser->email = $user->getEmail();
                $newUser->type = $driver;
                $newUser->username = $user->getId();
                $newUser->first_name = $arrName[0] ?? "";
                $newUser->last_name = $arrName[1] ?? "";
                $newUser->birthday = $user['birthday'];
                $newUser->picture = $user->getAvatar();
                $newUser->save();
                auth()->login($newUser, true);
            }
        }
        return redirect()->route('home.index');
    }
    function split_name($name) {
        $name = trim($name);
        $arrName = explode(" ",$name);
        if(isset($arrName[0])){
            $firtname = $arrName[0];
            $lastName = trim( preg_replace('#'.preg_quote($firtname,'#').'#', '', $name ) );
            return array($firtname, $lastName);
        }
        return array("", $name);

    }
    public function register(){

        return view(config("edushop.end-user.pathView") . "register");

    }
    public function postRegister(Request $request){

        $request->validate( [
            'first_name' => 'required',
            'last_name' => 'required',
            'username' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:3|max:32|confirmed',
        ],[
            'required' => ':attribute không được rỗng',
            'unique' => ':attribute đã tồn tại',
            'email' => ':attribute phải là địa chỉ email hợp lệ',
            'min' => ':attribute phải có ít nhất :min kí tự',
            'max' => ':attribute không vượt quá :max kí tự',
            'confirmed' => ':attribute không trùng khớp'
        ],[
            'username' => 'Tài khoản',
            'email' => 'Email',
            'password' => 'Mật khẩu',
            'first_name' => 'Họ',
            'last_name' => 'Tên',
        ]);

        $checkUser = User::where('email', $request->email)->where('type', 'website')->first();
        if($checkUser != null){
            Session::flash('error', 'Email đã tồn tại !');
            return back();
        };

        $user = new User();
        $user->username = $request->username;
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->type = "website";
        $user->save();

        Session::flash('success', 'Đăng ký thành công, vui lòng đăng nhập !');

        return redirect()->route('user.login' );
    }
    public function logout(){
        Auth::logout();
        return redirect()->route('home.index');
     }
    public function changePassword(){

        return view(config("edushop.end-user.pathView") . "changePassword");

    }

    public function forgotPassword(){

        return view(config("edushop.end-user.pathView") . "forgotPassword");

    }

    public function sendMail(Request $request){
        $request->validate([
            'email' => 'required|email',
        ],[
            'required' => ':attribute không được rỗng',
            'email' => ':attribute phải là địa chỉ email hợp lệ',
        ],[
            'email' => 'Email',
        ]);

        $user = User::where('email', $request->email)->first();
        if($user == null){
            Session::flash('error', 'Email không tồn tại !');
            return back();
        };
        $token = Str::random(100);
        $passwordReset = ResetPassword::updateOrCreate([
            'email' => $user->email,
        ], [
            'token' => $token,
        ]);
        if ($passwordReset) {
           //$url = url('reset-password/?token=' . $token);
            Mail::send( "enduser.mail.resetPassword" , [ 'token' => $token ], function($message) use ($user){
                $message->to($user->email, $user->name)->subject('Reset password');
            });
        }
        Session::flash('success', 'Vui lòng kiểm tra email!');
        return back();
    }

    public function formReset(Request $request, $token){

        return view(config("edushop.end-user.pathView") . "formForgetPassword")->with('token', $token);
    }
    public function postForgetPass(Request $request){

        $request->validate([
            'password' => 'required|min:3|max:32|confirmed',
        ],[
            'required' => ':attribute không được rỗng',
            'min' => ':attribute phải có ít nhất :min kí tự',
            'max' => ':attribute không vượt quá :max kí tự',
            'confirmed' => ':attribute không trùng khớp'
        ],[
            'password' => 'Mật khẩu',
        ]);
        $token = $request->token;
        $passwordReset = ResetPassword::where('token', $token)->firstOrFail();
        if (Carbon::parse($passwordReset->updated_at)->addMinutes(60)->isPast()) {
            $passwordReset->delete();
            // thông báo là token hết hạn
        }
        $user = User::where('email', $passwordReset->email)->firstOrFail();
        $pass = Hash::make($request->password);
        $updatePasswordUser = $user->update(['password' => $pass]);
        $passwordReset->delete();

        Session::flash('success', 'Thay đổi mật khẩu thành công');
        return redirect()->route('user.login');
    }
}
