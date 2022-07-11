<?php

namespace App\Http\Controllers\Api;

use App\Banner;
use App\Event;
use App\Notification;
use App\Order;
use App\UserCourse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Validator;
use Session;
use App\Http\Controllers\Api\BaseController as BaseController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AccountApiController extends BaseController
{
    public function changeProfile(Request $request){
        $data = Auth::user();
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'phone' => 'required',
            'birthday' => 'required',
        ],[
            'required' => ':attribute không được rỗng'
        ],[
            'first_name' => 'Họ',
            'last_name' => 'Tên',
            'phone' => 'Số điện thoại',
            'birthday' => 'Sinh nhật'
        ]);
        $data->first_name = $request->first_name;
        $data->last_name = $request->last_name;
        $data->phone = $request->phone;
        $data->birthday = implode("-", array_reverse(explode("/", $request->birthday)));
        $data->picture = $data->getImage();
        $data->save();
        return $this->sendResponse($data, 'Lưu thông tin profile thành công');
    }
    public function myOrderDetail($order_id){


        if ($order_id){
            $data['order'] = Order::findOrFail($order_id);
            return $this->sendResponse($data, 'Lấy dữ liệu thành công');
        }

       else{
           return $this->sendError([],'Không tìm được thông tin đơn hàng');
       }

    }
    public function myProfile(Request $request){
        $data = $request->user();
        $data->picture = $data->getImage();
        return $this->sendResponse($data, 'Lấy dữ liệu user thành công');

    }
    public function myCourses(){
        //gọi model
        $user = Auth::user();
        $users = \App\User::find($user->id);
        $list_user_lesson = $user->courses;
        foreach ($list_user_lesson as $da){
            $da->picture = $da->getImage();
            $test =  json_decode($da->gallery,true);
            if (!empty($test)){
                $a = [];
                foreach($test as $t) {
                    $a[] = asset('images/course_courses/'.$t);
                }
                $da->gallery = json_encode($a);
            }
        }
        return $this->sendResponse($list_user_lesson, 'Lấy dữ liệu course thành công');

    }
    public function changePassword(Request $request){

        $user = Auth::user();
        $validator = Validator::make($request->all(), [
            'password' => 'required',
            'confirm_password' => 'required|same:password',
        ]);
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
        }
        if (Hash::check($request->old_pass, $user->password)) {
            $user->fill([
                'password' => Hash::make($request->password)
            ])->save();
            return $this->sendResponse([], 'Cập nhật mật khẩu thành công');

        }else{
            return $this->sendError('error', 'Mật khẩu không chính xác');
        }
    }
}
