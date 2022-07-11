<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Support\Facades\Auth;
use Session;

class CheckLoginAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $user= Auth::user();
        if($user == null || $user->is_guest()){
            return redirect()->route('auth.login');
        }
        return $next($request);
        //Session::flash('error', 'Bạn phải đăng nhập để tiếp tục');
        //return redirect('/login');
    }
}
