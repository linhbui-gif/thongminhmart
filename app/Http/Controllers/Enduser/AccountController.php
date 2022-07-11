<?php

namespace App\Http\Controllers\Enduser;

use App\Address;
use App\becomeTeacher;
use App\Coupon;
use App\Http\Controllers\Controller;
use App\Order;
use App\UserCourse;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Hash;
use Session;
class AccountController extends Controller
{
    public function __construct()
    {
        $_config = \App\Config::find(26);
        return view()->share('_config', $_config);
    }

    public function changeProfile(Request $request){
        $user = Auth::user();
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
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->phone = $request->phone;
        $user->birthday = implode("-", array_reverse(explode("/", $request->birthday)));


        $user->save();

        Session::flash('success', 'Cập nhật thành công');
        return redirect()->route('account.myProfile');
    }
    public function changePassword(Request $request){

        $user = Auth::user();

        $request->validate([
            'password' => 'required|confirmed',
        ],[
            'required' => ':attribute không được rỗng',
            'confirmed' => ':attribute không trùng khớp'
        ],[
            'password' => 'Mật khẩu',
        ]);

        if (Hash::check($request->old_pass, $user->password)) {
            $user->fill([
                'password' => Hash::make($request->password)
            ])->save();
            Session::flash('success_pass', 'Cập nhật mật khẩu thành công');
        }else{
            Session::flash('error', 'Mật khẩu không chính xác');
        }
        return redirect()->route('account.myProfile');

    }
    public function myProfile(){

        $user = Auth::user();
        $data['user'] = $user;
        return view(config("edushop.end-user.pathView") . "myProfile")->with($data);
    }
    public function myQuestions(){
        $user = Auth::user();
        $data['user'] = $user;
        $data['questions'] = $user->questions()->orderBy('id','desc')->get();
        return view(config("edushop.end-user.pathView") . "myQuestion")->with($data);
    }
    public function myCoupon(){
        $user = Auth::user();
        $data['user'] = $user;
        $data['coupons'] = Coupon::where('status','active')->orderBy('id','desc')->get();
        return view(config("edushop.end-user.pathView") . "myCoupon")->with($data);

    }

    public function myCourses(){
        //gọi model
        $user = Auth::user();
        $users = \App\User::find($user->id);
        $list_user_lesson = $user->courses()->where('course_courses.status','active')->get();
        return view(config("edushop.end-user.pathView") . "myCourses")->with("list_user_lesson", $list_user_lesson);

    }
    public function myOrderDetail($order_id){

        $data['order'] = Order::findOrFail($order_id);

        return view(config("edushop.end-user.pathView") . "myOrderDetail")->with($data);

    }
    public function myOrder(){
        $user = Auth::user();
        $data['orders'] = $user->orders()->orderBy('order.id','desc')->paginate(12);

        return view(config("edushop.end-user.pathView") . "myOrder")->with($data);

    }
    public function address(){

        return view(config("edushop.end-user.pathView") . "address");

    }
    public function editAddress($id){

        $user = Auth::user();
        $address = $user->addresses()->where('address.id', $id)->first();
        if(!$address){
            return redirect()->route('account.address');
        }
        $data['address'] = $address;
        return view(config("edushop.end-user.pathView") . "editAddress")->with($data);

    }

    public function addAddress(){

        return view(config("edushop.end-user.pathView") . "addAddress");

    }
    public function postAddress(Request $request){
        $request->validate( [
            'phone' => 'required',
            'address' => 'required',
            'CityName' => 'required',
            'DistrictName' => 'required',
            'WardName' => 'required',
            'province_id' => 'required|exists:province,id',
            'district_id' => 'required|exists:district,id',
            'ward_id' => 'required|exists:ward,id',

        ],[
            'required' => ':attribute không được rỗng',
            'exists' => ':attribute không hợp lệ',
            'min' => ':attribute phải có ít nhất :min kí tự',
            'max' => ':attribute không vượt quá :max kí tự',
            'in' => ':attribute không hợp lệ',
        ],[
            'phone' => 'Số điện thoại',
            'address' => 'Địa chỉ',
            'province_id' => 'Tỉnh/TP',
            'district_id' => 'Quận/Huyện',
            'ward_id' => 'Phường/xã',

        ]);
        $user = Auth::user();
        $address = new Address();
        $address->district_id = $request->district_id;
        $address->province_id = $request->province_id;
        $address->ward_id = $request->ward_id;
        $address->address = $request->address;
        $address->phone = $request->phone;
        $address->user_id = $user->id;

        $address->CityName = $request->CityName;
        $address->DistrictName = $request->DistrictName;
        $address->WardName = $request->WardName;

        $address->save();
        return redirect()->back();
    }
    public function updateAddress(Request $request, $id){
        $user = Auth::user();
        $address = $user->addresses()->where('address.id', $id)->first();
        if(!$address){
            return redirect()->back();
        }

        $request->validate( [
            'phone' => 'required',
            'address' => 'required',
            'CityName' => 'required',
            'DistrictName' => 'required',
            'WardName' => 'required'
        ],[
            'required' => ':attribute không được rỗng',
            'exists' => ':attribute không hợp lệ',
            'min' => ':attribute phải có ít nhất :min kí tự',
            'max' => ':attribute không vượt quá :max kí tự',
            'in' => ':attribute không hợp lệ',
        ],[
            'phone' => 'Số điện thoại',
            'address' => 'Địa chỉ',
            'province_id' => 'Tỉnh/TP',
            'district_id' => 'Quận/Huyện',
            'ward_id' => 'Phường/xã',

        ]);

        $address->district_id = $request->district_id;
        $address->province_id = $request->province_id;
        $address->ward_id = $request->ward_id;
        $address->address = $request->address;
        $address->phone = $request->phone;

        $address->CityName = $request->CityName;
        $address->DistrictName = $request->DistrictName;
        $address->WardName = $request->WardName;

        $address->save();
        return redirect()->back();
    }
    public function deleteAddress(Request $request, $id){
        $user = Auth::user();
        $address = $user->addresses()->where('address.id', $id)->first();
        if(!$address){
            return redirect()->back();
        }
        $address->delete();
        return redirect()->back();
    }
    public function downloadDocument(Request $request){

        $previewReplace = "https://anyclass.vn";
        $url_file = $request->file_name;
        $fileName = pathinfo($url_file, PATHINFO_BASENAME);
        $url_file = str_replace($previewReplace,"", $url_file);
        $path = public_path() . $url_file;
//        $headers = array(
//            'Content-Type: application/zip',
//        );
        $headers = [];
        return \Response::download($path, $fileName, $headers);

        //return redirect()->back();
    }
    public function formTeacher(Request $request){
        $data = [];
        return view(config("edushop.end-user.pathView") . "becometeacher_form")->with($data);
    }
    public function postFormTeacher(Request $request){
        $user = Auth::user();

        $item = new becomeTeacher();
        $item->name = $request->name;
        $item->age = $request->age;
        $item->phone = $request->phone;
        $item->email = $request->email;
        $item->cmnd = $request->cmnd;
        $item->link_mxh = $request->link_mxh;
        $item->co_kinh_nghiem = $request->kinhnghiem;
        $item->so_nam_kinh_nghiem = $request->so_nam_kinh_nghiem;
        $item->linhvuc = $request->linhvuc;
        $item->chude = $request->chude;
        $item->khinao = $request->khinao;
        $item->user_id = $user->id;
        $item->save();

        Session::flash('success', 'success');
        return redirect()->back();

    }

}
