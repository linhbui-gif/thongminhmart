<?php

namespace App\Http\Controllers\Api;

use App\Banner;
use App\Event;
use App\Notification;
use App\QA_questionClient;
use App\QA_Question;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Api\BaseController as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommonApiController extends BaseController
{
    public function slider(){
        $data = Banner::where('status','active')->get();
        foreach ($data as $da){
            $da->picture = $da->getImage();
            $test =  json_decode($da->gallery,true);
            if (!empty($test)){
                $a = [];
                foreach($test as $t) {
                    $a[] = asset('images/banner/'.$t);
                }
                $da->gallery = json_encode($a);
            }
        }
        return $this->sendResponse($data, 'Lấy danh sách slider thành công');
    }
    public function event(){
        $data = Event::where('status','active')->get();
        foreach ($data as $da){
            $da->picture = $da->getImage();
            $test =  json_decode($da->gallery,true);
            if (!empty($test)){
                $a = [];
                foreach($test as $t) {
                    $a[] = asset('images/banner/'.$t);
                }
                $da->gallery = json_encode($a);
            }
        }
        return $this->sendResponse($data, 'Lấy danh sách event thành công');
    }
    public function eventDetail($id){
        $data = Event::where('status','active')->find($id);
        $data->picture = $data->getImage();
        return $this->sendResponse($data, 'Lấy chi tiết event thành công');
    }
    public function notification(){
        $data = Notification::where('status','active')->latest()->paginate(8);
        $data->picture = $data->getImage();
        return $this->sendResponse($data, 'Lấy danh sách notification thành công');
    }
    public function showNotification($id){
        $data = Notification::where('status','active')->find($id);
        return $this->sendResponse($data, 'Lấy chi tiết notification thành công');
    }
    public function question(){
        $data = QA_Question::where('status','active')->with('answer')->get();
        return $this->sendResponse($data, 'Lấy danh sách question thành công');
    }
    public function questionClient(){
        $data = QA_questionClient::get();
        return $this->sendResponse($data, 'Lấy danh sách question Client thành công');
    }
    public function postquestionClient(Request $request){

        $data = new QA_questionClient();
        $user = Auth::user();
        $data->name = $request->name;
        $data->users_id = $user->id;

        $data->save();
        return $this->sendResponse($data, 'Lưu câu hỏi question Client thành công');

    }

}
