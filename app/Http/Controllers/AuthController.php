<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;
class AuthController extends Controller
{
    public function login(){
        return view("auth.page.login");
    }
    public function postLogin(Request $request){
        $username = $request->email;
        $password = $request->password;
        $remember = $request->remember_me ? true : false;
        if(filter_var($username, FILTER_VALIDATE_EMAIL)) {
            Auth::attempt(['email' => $username, 'password' => $password], $remember);
        } else {
            Auth::attempt(['username' => $username, 'password' => $password], $remember);
        }
        if (Auth::check()) {
            return redirect()->route('admin.welcome.index');
        } else {
            return redirect()->route('auth.login')->withErrors(trans('message.invalid_login_account'));
        }
    }
    public function logout(){
        Auth::logout();
        return redirect()->route('auth.login');
    }
    public function changeLang($lang){
        Session::put('website_language', $lang);
        return redirect()->back();
    }
}
