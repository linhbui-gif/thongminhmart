<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Image;
use Session;
use App\Helper\Log;
use Illuminate\Support\Facades\Auth;
use function GuzzleHttp\Promise\all;

class AdminController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    protected  $folderUpload;
    protected $config;
    protected $model;
    protected $logFolder;

    public function index(Request $request)
    {
        $params = $request->all();
        $params['search_list'] = $this->searchList;
        $params['search_type'] = isset($params['search_type']) && in_array($params['search_type'], array_flip($this->searchList) ) ? $params['search_type'] : "all";
        $params['search_value'] = isset($params['search_value']) ? $params['search_value'] : "";
        $data['items'] = $this->model->listItems($params, $this->config);
        $data['params'] = $params;
        //dd($this);
        if($this->logFolder){
            $time = Carbon::now()->format('H:i:s');
            $message = "[$time] " . $request->user()->email . " view";
            $log = new Log($this->logFolder);
            $log->put("log-" . date("Y-m-d"), $message);
        }
        return view($this->pathView . 'index')->with($data);
    }
    public function create(Request $request)
    {

        if($this->logFolder){
            $time = Carbon::now()->format('H:i:s');
            $message = "[$time] " . $request->user()->email . " click button create";
            $log = new Log($this->logFolder);
            $log->put("log-" . date("Y-m-d"), $message);
        }

        return view($this->pathView . 'form');
    }
    public function edit($id)
    {

        $item = $this->model->find($id);

        if($this->logFolder){
            $time = Carbon::now()->format('H:i:s');
            $message = "[$time] " . Auth::user()->email . " click button edit";
            $log = new Log($this->logFolder);
            $log->put("log-" . date("Y-m-d"), $message);
        }

        return view($this->pathView . 'form')->with('item', $item);
    }
    public function uploadMulti($objects){
       $data = [];
       foreach($objects as $k => $file){
           $data[] = $this->uploadThumb($file);
       }
       return json_encode($data);
    }
    public function store(Request $request)
    {
        $this->validateStore($request);

        $data = $this->getDataForm($request->all());
        // xử lý datepicker
        $arrDatepicker = $this->getKeyByType('datepicker');

        foreach($arrDatepicker as $k => $keyname){
            $date = $data[$keyname];
            $cDate = Carbon::createFromFormat("d/m/Y", $date, "Asia/Ho_Chi_Minh");
            $dateNew = $cDate->toDateTimeString();
            $data[$keyname] = $dateNew;
        }
        // end datepicker
        foreach ($data as $k => $v) {
            if(is_object($v)){
                $v = $this->uploadThumb($v);
            }
            if(is_array($v) && count($v) > 0 ){
                if(is_object($v[0])){
                    $v = $this->uploadMulti($v);
                }
            }
            $this->model->$k = $v;
        }


        $user = \Auth::user();
        $this->model->created_by = $user->id;

        // trường hợp gallery

        if(isset($request->galleries)){
            $this->model->gallery = json_encode($request->galleries);
        }


        $this->model->save();

        // xử lý tag
        if(isset($request->tag_id)  && count($request->tag_id) > 0 ){
            $tag_id = [];
            foreach($request->tag_id as $k => $v){
                if(is_numeric ($v)){
                    $tag_id[] = $v;
                }
            }
            $this->model->tags()->attach($tag_id);
        }
        if(isset($request->related_post_id)  && count($request->related_post_id) > 0 ){
            $related_post_id = [];
            foreach($request->related_post_id as $k => $v){
                if(is_numeric ($v)){
                    $related_post_id[] = $v;
                }
            }
            $this->model->posts()->attach($related_post_id);
        }
        if($this->logFolder){
            $time = Carbon::now()->format('H:i:s');
            $message = "[$time] " . $request->user()->email . " create new";
            $log = new Log($this->logFolder);
            $log->put("log-" . date("Y-m-d"), $message);
        }

        Session::flash('success', 'Bạn đã thêm mới thành công');
        return redirect()->route('admin.' . $this->controllerName . ".index" );
    }
    public function update(Request $request, $id)
    {
        $this->validateUpdate($request, $id);

        $this->model = $this->model->find($id);

        $data = $this->getDataForm($request->all());

        // xử lý datepicker
        $arrDatepicker = $this->getKeyByType('datepicker');

        foreach($arrDatepicker as $k => $keyname){
            $date = $data[$keyname];
            $cDate = Carbon::createFromFormat("d/m/Y", $date, "Asia/Ho_Chi_Minh");
            $dateNew = $cDate->toDateTimeString();
            $data[$keyname] = $dateNew;
        }
        // end datepicker

        if(!isset($data['status'])){
            $this->model->status = "inactive";
        }
        foreach ($data as $k => $v) {
            if(is_object($v)){
                $this->deleteThumb($this->model->{$k});
                $v = $this->uploadThumb($v);
            }
            if(is_array($v) && count($v) > 0 ){
                if(is_object($v[0])){
                    $v = $this->uploadMulti($v);
                }
            }
            $this->model->$k = $v;
        }

        $user = \Auth::user();
        // $this->model->created_by = $user->id;
        $this->model->updated_by = $user->id;

        // trường hợp gallery
        if(isset($request->galleries)){
            $this->model->gallery = json_encode($request->galleries);
        }
        $this->model->save();
        // xử lý tag

        if(isset($request->tag_id)  && count($request->tag_id) > 0 ){
            $tag_id = [];
            foreach($request->tag_id as $k => $v){
                if(is_numeric ($v)){
                    $tag_id[] = $v;
                }
            }
            $this->model->tags()->sync($tag_id);
        }else{
            //$this->model->tags()->detach();
        }
        if(isset($request->related_post_id)  && count($request->related_post_id) > 0 ){
            $related_post_id = [];
            foreach($request->related_post_id as $k => $v){
                if(is_numeric ($v)){
                    $related_post_id[] = $v;
                }
            }
            $this->model->posts()->sync($related_post_id);
        }

        if($this->logFolder){
            $time = Carbon::now()->format('H:i:s');
            $message = "[$time] " . $request->user()->email . " update id: $id";
            $log = new Log($this->logFolder);
            $log->put("log-" . date("Y-m-d"), $message);
        }

        Session::flash('success', 'Bạn đã cập nhật thành công');
        return redirect()->route('admin.' . $this->controllerName . ".index" );
    }
    public function deleteMain($id){
        $user = \Auth::user();
        $model = $this->model->find($id);

        $modelRawValues = array_values($model->toArray())[1];
        $modelRawKeys = array_keys($model->toArray())[1];

        if(!$user->is_admin()){
            $model->where('created_by', $user->id);
        }
        if($model){
            $arrFile = $this->getKeyByType('file');
            if(count($arrFile) > 0){
                foreach($arrFile as $k){
                    $this->deleteThumb($model->{$k});
                }
            }
            $model->delete();

            if($this->logFolder){
                $time = Carbon::now()->format('H:i:s');
                $message = "[$time] " . Auth::user()->email . " delete id: $id, $modelRawKeys: $modelRawValues";
                $log = new Log($this->logFolder);
                $log->put("log-" . date("Y-m-d"), $message);
            }

        }

    }
    public function destroy($id){

        $this->deleteMain($id);
        Session::flash('success', 'Bạn đã xóa thành công');
        return redirect()->route('admin.' . $this->controllerName . ".index");
    }
    public function multiDestroy(Request $request){

        $cId = $request->cid;
        if(count($cId) > 0){
            foreach($cId as $k => $id){
                $this->deleteMain($id);
            }
            Session::flash('success', 'Bạn đã xóa thành công');
        }
        return redirect()->route('admin.' . $this->controllerName . ".index");
    }
    public function getKeyByType($type){

        $data = [];

        foreach($this->formFields as $k => $row){
            $items = $row['items'];
            foreach($items as $_k => $item){
                if($item['type'] == $type){
                    $data[] = $item['name'];
                }
            }
        }
        return $data;
    }
//    protected function validateStore(Request $request){
//
//    }
//    // option valudate update
//    protected function validateUpdate(Request $request, $id = ""){
//
//    }
    public function getDataForm($request){

        $data = [];
        $r = [];
        foreach($request as $k => $v){
            $r[] = $k;
        }
        foreach($this->formFields as $k => $row){

            $items = $row['items'];
            foreach($items as $_k => $item){
                //$data[] = $item['name'];
                $name =  $item['name'];
                if(in_array($name, $r)){
                    $data[$name] = $request[$name];
                }
            }
        }
        return array_diff_key($data, array_flip($this->notAcceptedCrud));
    }
    public function deleteThumb($thumbName){
        $configSize = $this->config['resizeImage'];
        $path = public_path().'/images/' . $this->folderUpload .'/';
        $orgin = $path . $thumbName;
        if(!empty($thumbName) &&  file_exists($orgin) ){
            // xóa ảnh gốc
            unlink($orgin);
        }
        if(count($configSize) > 0){

            foreach ($configSize as $key => $value) {
                $p = $path . $key . "/" . $thumbName;
                if(!empty($thumbName) &&  file_exists($p) ){
                    // xóa custome
                    unlink($p);

                    if($this->logFolder){
                        $time = Carbon::now()->format('H:i:s');
                        $message = "[$time] " . Auth::user()->email . " delete thumb: $p";
                        $log = new Log($this->logFolder);
                        $log->put("log-" . date("Y-m-d"), $message);
                    }
                }
            }
        }

    }
    public function uploadThumb($thumbObj, $name_picture_custome = ""){

        //$thumbObj = $params['picture'];
        $name_picture_custome = Str::slug($name_picture_custome);
        //$alt_picture_custome = $params['alt_picture_custome'];

        //dd('ihostinger.config.image.' . $this->folderUpload);
        $configSize = $this->config['resizeImage'];

        $thumbnailImage = Image::make($thumbObj);

        $ext = $thumbObj->clientExtension();

        $thumbName = Str::random(10) . '.' . $ext;

        $originalPath = public_path().'/images/' . $this->folderUpload .'/';
        if( ! \File::isDirectory($originalPath) ) {
            \File::makeDirectory($originalPath, 493, true);
        }
        if($name_picture_custome != null || !empty($name_picture_custome)){
            $pathInputNameImage = $originalPath . $name_picture_custome;
            if(file_exists($pathInputNameImage . "." . $ext)){
                $thumbName = $name_picture_custome ."-". time() . "." . $ext;
            }else{
                $thumbName = $name_picture_custome . "." . $ext;
            }
        }
        $thumbnailImage->save($originalPath.$thumbName);

        if(count($configSize) > 0){

            foreach ($configSize as $key => $value) {
                $thumbnailPath = public_path().'/images/'.$this->folderUpload .'/'.$key.'/';
                if( ! \File::isDirectory($thumbnailPath) ) {
                    \File::makeDirectory($thumbnailPath, 493, true);
                }
                $thumbnailImage->resize($value['width'], null, function ($constraint) {
                    $constraint->aspectRatio();
                });
                $thumbnailImage->save($thumbnailPath.$thumbName);

                if($this->logFolder){
                    $time = Carbon::now()->format('H:i:s');
                    $message = "[$time] " . Auth::user()->email . " upload thumb: $thumbName";
                    $log = new Log($this->logFolder);
                    $log->put("log-" . date("Y-m-d"), $message);
                }
            }
        }
        return $thumbName;
    }



}
