<?php

namespace App\Http\Controllers\Admin;

use App\Helper\Common;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Controller;
use App\Lesson;
use Illuminate\Http\Request;
use App\Lesson as MainModel;
use Illuminate\Support\Facades\Hash;
use Session;

use Carbon\Carbon;
use App\Helper\Log;
use Illuminate\Support\Facades\Auth;

use Vimeo\Laravel\Facades\Vimeo;
use Illuminate\Support\Str;
use File;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
class LessonController extends AdminController
{
    protected $pathView = "admin.page.lesson.";
    protected $config = [
        'pagination' => 10,
        'resizeImage' => [
            'thumb' => ['width' => 100],
            'standard' => ['width' => 300]
        ]
    ];
    protected $listFields = [
        [ 'name' => 'id', 'label' => 'Id', 'type' => 'text'],
        [ 'name' => 'name', 'label' => 'Name', 'type' => 'text'],
        [ 'name' => 'status', 'label' => 'Status', 'type' => 'status'],
        [ 'name' => 'created_at', 'label' => 'Created At', 'type' => 'datetime', 'format' => 'd/m/Y' ],
        [ 'name' => 'updated_at', 'label' => 'Updated At', 'type' => 'datetime', 'format' => 'd/m/Y' ],
    ];
    protected $formFields = [
        'general_tab' => [
            'label_tab' => 'General',
            'items' => [
                [ 'label' => 'Name' ,'name' => 'name', 'type' => 'text'],
                [ 'label' => 'Thuộc chương' ,'name' => 'chapter_id', 'type' => 'select', 'data_source' => \App\Chapter::class, 'foreign_key' => 'chapter_id' ],
                [ 'label' => 'Status' ,'name' => 'status', 'type' => 'status'],
            ]
        ]
    ];
    protected $searchList = [
        'all' => 'Search By All',
        'id' => 'Search By Id',
        'name' => 'Search By Name'
    ];
    protected $notAcceptedCrud = [  '_token'];
    public function __construct(){
        $controller = (new \ReflectionClass($this))->getShortName();
        $shortController = Common::getShortNameController($controller);
        $this->controllerName = $shortController;
        $this->folderUpload = $shortController;
        $this->logFolder = $shortController;
        view()->share("controller", $shortController);
        view()->share("folderUpload", $this->folderUpload);
        view()->share("pathView", $this->pathView);
        view()->share("formFields", $this->formFields);
        view()->share("listFields", $this->listFields);
        view()->share("searchList", $this->searchList);
        view()->share("controllerName", $this->controllerName);
        $this->model = new MainModel();
        if(isset($_REQUEST['tab_current'])){
            Session::put('tab_current', $_REQUEST['tab_current']);
        }
    }

    // option validate Store
    protected function validateStore(Request $request){
        $request->validate([
            'name' => 'required|min:3|max:50',
            'chapter_id' => 'exists:course_categories,id',
        ],[
            'required' => ":attribute không được để trống",
            'min' => ":attribute ít nhất :min ký tự",
            'max' => ":attribute vượt quá :max ký tự",
            'exists' => ":attribute phải được chọn",
            'integer' => ":attribute phải là một con số",
        ],[
            'name' => 'Tên',
            'chapter_id' => 'Chương học',
        ]);
    }
    // option validate Update
    protected function validateUpdate(Request $request, $id = ""){

    }
    public function editLesson ($id)
    {
        $item = $this->model->find($id);
        $data['item'] = $item;

        $controller = (new \ReflectionClass($this))->getShortName();
        $shortController = Common::getShortNameController($controller);
        $this->logFolder = $shortController;

        if($this->logFolder){
            $time = Carbon::now()->format('H:i:s');
            $message = "[$time] " . Auth::user()->email . " click button edit with id: $id";
            $log = new Log($this->logFolder);
            $log->put("log-" . date("Y-m-d"), $message);
        }


        return view($this->pathView . 'form')->with($data);
    }

    public function uploadVideo(Request $request){

        $params = $request->all();

        // xử lý time
        if(isset($params['time'])){
            $gio = $params['time']['gio'] == null ? 0 :  $params['time']['gio'];
            $phut = $params['time']['phut'] == null ? 0 :  $params['time']['phut'];
            $giay = $params['time']['giay'] == null ? 0 :  $params['time']['giay'];
            $strFullTime = $gio . ":" . $phut . ":" . $giay;
        }else{
            $strFullTime = "0:0:0";
        }

        Lesson::where('id', $params['id'])->update(
            [
                'time_full' => $strFullTime,
                'tutorial' => $request->tutorial
            ]
        );

        //duration
//        $hour = $params['hour'] === null ? 0 : (int)$params['hour'];
//        $minute = $params['minute'] === null ? 0 : (int)$params['minute'];
//        $seconds = $params['seconds'] === null ? 0 : (int)$params['seconds'];
//        $duration = ($hour * 60 * 60) + ($minute * 60) + $seconds;

        //gọi model
        $model = new MainModel();

        //kiểm tra duration
//        if($duration != 0){
//            // check extension
//                if(isset($params['id'])){
//                    $model->uploadDuration($params['id'], $duration);
//                }
//        }

        //chưa bắt đk, kiểm tra dữ liệu
//        if(isset($params['video_demo']) && isset($params['video_full'])){
//            // check extension
//            if($_FILES['video_demo']['type'] === "video/mp4" && $_FILES['video_full']['type'] === "video/mp4"){
//
//                //upload video lên vimeo
//                $vimeo_demo = Vimeo::connection('main')->upload($params['video_demo']->getRealPath());
//                $vimeo_full = Vimeo::connection('main')->upload($params['video_full']->getRealPath());
//
//                //lay ten video vua upload
//                $nameVideo['video_demo'] = explode('/', $vimeo_demo)[2];
//                $nameVideo['video_full'] = explode('/', $vimeo_full)[2];
//
//                if(isset($params['id'])){
//
//                    // luu ten vao data
//                    $model->uploadVideoLesson($params['id'], $nameVideo);
//
//                }
//            }
//        }
        if(isset($params['filepath'])){
              Lesson::where('id', $params['id'])->update([ 'file_doc' => $params['filepath'] ]);
        }
        if(isset($params['url_thumbnail'])){
              Lesson::where('id', $params['id'])->update([ 'url_thumbnail' => $params['url_thumbnail'] ]);
        }
        if(isset($params['video_demo']) ){
            // check extension
            if(preg_match("#mp4#", $_FILES['video_demo']['type'])){
//                $name = $request->video_demo->getClientOriginalName();
//                $pathVideo = storage_path() . "/app/public/tmp_demo/" . $name;
//                if(!file_exists($pathVideo)){
//                    $request->video_demo->storeAs('/public/tmp_demo/', $name);
//                    $lesson_id = $params['id'];
//                    \App\Jobs\UploaderVideoDemo::dispatch($name,$lesson_id);
//                }
                $name = pathinfo($_FILES['video_demo']['name'], PATHINFO_FILENAME);
                $vimeo = Vimeo::connection('main');
                $response =$vimeo->upload($params['video_demo']->getRealPath(), [
                    'name' =>  $name
                ]);
                //lay ten video vua upload
                $nameVideo['video_demo'] = explode('/', $response)[2];
                if(isset($params['id'])){
                    // luu ten vao data
                    $model->where('id', $params['id'])->update($nameVideo);
                }
            }
        }

        if(isset($params['video_full'])){
            // check extension
            if(preg_match("#mp4#", $_FILES['video_full']['type'])){
//                $name = $request->video_full->getClientOriginalName();
//                $pathVideo = storage_path() . "/app/public/tmp/" . $name;
//                if(!file_exists($pathVideo)){
//                    $request->video_full->storeAs('/public/tmp/', $name);
//                    $lesson_id = $params['id'];
//
//                     \App\Jobs\UploaderVideo::dispatch($name,$lesson_id);
//                }


                $name = pathinfo($_FILES['video_full']['name'], PATHINFO_FILENAME);
                $vimeo = Vimeo::connection('main');
                $response =$vimeo->upload($params['video_full']->getRealPath(), [
                    'name' =>  $name
                ]);
                //lay ten video vua upload
                $nameVideo['video_full'] = explode('/', $response)[2];
                if(isset($params['id'])){
                    // luu ten vao data
                    $model->where('id', $params['id'])->update($nameVideo);
                }
            }
        }

        //  upload file VTT text track demo
//        if(isset($params['text_track_demo_vi'])){
//            $this->uploadTextTrackDemo($params['id'], $_FILES['text_track_demo_vi'], "vi");
//        }
//        if(isset($params['text_track_demo_en'])){
//            $this->uploadTextTrackDemo($params['id'], $_FILES['text_track_demo_en'], "en");
//        }

        if(isset($params['text_track_full_vi'])){
            $this->uploadTextTrackDemo($params['id'], $_FILES['text_track_full_vi'], "vi", "video_demo");
            $this->uploadTextTrackDemo($params['id'], $_FILES['text_track_full_vi'], "vi", "video_full");
        }
        if(isset($params['text_track_full_en'])){
            $this->uploadTextTrackDemo($params['id'], $_FILES['text_track_full_en'], "en", "video_demo");
            $this->uploadTextTrackDemo($params['id'], $_FILES['text_track_full_en'], "en", "video_full");
        }



        // upload hình ảnh từ computer
//        if(isset($params['image-thumbnail'])){
//            //kiểm tra đuôi file image
//            $lengPictureThumnailk = count(explode('.', $_FILES['image-thumbnail']['name']));
//            $extPictureThumbnail = explode('.', $_FILES['image-thumbnail']['name'])[$lengPictureThumnailk - 1];
//            $extPictureThumbnail = strtolower($extPictureThumbnail);
//            if($extPictureThumbnail === "png" || $extPictureThumbnail === "jpg" || $extPictureThumbnail === "jpeg"){
//
//                $thumnailNewName = $this->uploadThumb($params['image-thumbnail']);
//
//                $image = public_path() . "/images/lesson/" . $thumnailNewName;
//                $data = fopen ($image, 'rb');
//                $size=filesize ($image);
//                $contents= fread ($data, $size);
//                fclose ($data);
//
//                if(isset($params['id'])){
//                    $nameImageThumb = $model->get_item_by_id($params['id'])[0]->thumbnail;
//                    $model->uploadImageLesson($params['id'], $thumnailNewName);
//                    $this->deleteThumb($nameImageThumb);
//                }
//
//                $edu_lesson = Lesson::where('id', $params['id'])->first();
//                $name_video_demo = $edu_lesson->video_demo;
//                $name_video_full = $edu_lesson->video_full;
//
//                $response_video = Vimeo::request("/me/videos/" . $name_video_demo , [], 'GET')["body"];
//
//                $pictureBody = Vimeo::request($response_video['metadata']['connections']['pictures']['uri'], [ ], 'POST')['body'];
//                Http::withHeaders([
//                    'Authorization' => 'bearer 09aeb6f0793423bfecf65c6b659d384a',
//                    'Accept' => 'application/vnd.vimeo.*+json;version=3.4',
//                    "Content-Type"=>"text/plain"
//                ])->withBody($contents,'image/' . $extPictureThumbnail)->put($pictureBody['link'], $contents);
//
//            }
//        }

//        if(isset($params['image-thumbnail'])){
//            //kiểm tra đuôi file image
//            $lengPictureThumnailk = count(explode('.', $_FILES['image-thumbnail']['name']));
//            $extPictureThumbnail = explode('.', $_FILES['image-thumbnail']['name'])[$lengPictureThumnailk - 1];
//            if($extPictureThumbnail === "png" || $extPictureThumbnail === "jpg" || $extPictureThumbnail === "jpeg"){
//
//                $thumnailNewName = $this->uploadThumb($params['image-thumbnail']);
//
//                $image = public_path() . "/images/lesson/" . $thumnailNewName;
//                $data = fopen ($image, 'rb');
//                $size=filesize ($image);
//                $contents= fread ($data, $size);
//                fclose ($data);
//
//                if(isset($params['id'])){
//                    $nameImageThumb = $model->get_item_by_id($params['id'])[0]->thumbnail;
//                    $model->uploadImageLesson($params['id'], $thumnailNewName);
//                    $this->deleteThumb($nameImageThumb);
//                }
//
//                $edu_lesson = Lesson::where('id', $params['id'])->first();
//                $name_video_demo = $edu_lesson->video_demo;
//                $name_video_full = $edu_lesson->video_full;
//
//                $videos = Vimeo::request('/me/videos', ['per_page' => 10], 'GET')['body']['data'];
//                // tim kiem sau do delete
//                foreach ($videos as $key => $value){
//                    $uri = $value['uri'];
//                    if(explode('/', $value['uri'])[2] === $name_video_demo){
//                        $pictureBody = Vimeo::request($value['metadata']['connections']['pictures']['uri'], [], 'POST')['body'];
//                        $response = Http::withHeaders([
//                            'Authorization' => 'bearer 09aeb6f0793423bfecf65c6b659d384a',
//                            'Accept' => 'application/vnd.vimeo.*+json;version=3.4',
//                            "Content-Type"=>"text/plain"
//                        ])->withBody($contents, 'image/' . $extPictureThumbnail)->put($pictureBody['link'], $contents);
//                        $pictureActive = Vimeo::request($pictureBody['uri'], ["active" => true], 'PATCH');
//                    }
//                    if (explode('/', $value['uri'])[2] === $name_video_full) {
//                        $pictureBody = Vimeo::request($value['metadata']['connections']['pictures']['uri'], [], 'POST')['body'];
//                        $response = Http::withHeaders([
//                            'Authorization' => 'bearer 09aeb6f0793423bfecf65c6b659d384a',
//                            'Accept' => 'application/vnd.vimeo.*+json;version=3.4',
//                            "Content-Type"=>"text/plain"
//                        ])->withBody($contents, 'image/' . $extPictureThumbnail)->put($pictureBody['link'], $contents);
//                        $pictureActive = Vimeo::request($pictureBody['uri'], ["active" => true], 'PATCH');
//                    }
//                }
//            }
//        }

        $controller = (new \ReflectionClass($this))->getShortName();
        $shortController = Common::getShortNameController($controller);
        $this->logFolder = $shortController;

        if($this->logFolder){
            $time = Carbon::now()->format('H:i:s');
            $message = "[$time] " . Auth::user()->email . " upload video";
            $log = new Log($this->logFolder);
            $log->put("log-" . date("Y-m-d"), $message);
        }


        return redirect()->route('admin.lesson.editLesson', $params['id']);
    }
    public function uploadTextTrackDemo($id_video, $file_name, $lang, $key){

        $arrNameTextTrack = explode('.', $file_name['name']);
        $nameTextTrack = $arrNameTextTrack[0];
        $ext = $arrNameTextTrack[1];
        if(strtolower( $ext) === "vtt"){
            $name_text_track = $nameTextTrack . '.' . $ext;
            $linkStore = public_path() . "/texttrack/" . $name_text_track;
            move_uploaded_file($file_name["tmp_name"], $linkStore);

            $edu_lesson = Lesson::where('id',$id_video)->first();
            $name_video_demo = $edu_lesson->{$key};
            if(!empty($name_video_demo)){
                $fh = fopen($linkStore,'r');
                $textVTT = "";
                while ($line = fgets($fh)) {
                    if($line != "\r\n") {
                        $textVTT = $textVTT . $line;
                    }
                }
                fclose($fh);

                $response_video = Vimeo::request("/me/videos/" . $name_video_demo , [], 'GET')["body"];

                $name_lang = "";
                if($lang == "vi"){
                    $name_lang = "Tiếng Việt";
                }elseif($lang == "en"){
                    $name_lang = "English";
                }
                $textTrackBody = Vimeo::request($response_video['metadata']['connections']['texttracks']['uri'], ["type"=> "subtitles", "language" => $lang, "name" => $name_lang ], 'POST')['body'];
                Http::withHeaders([
                    'Authorization' => 'bearer 09aeb6f0793423bfecf65c6b659d384a',
                    'Accept' => 'application/vnd.vimeo.*+json;version=3.4',
                    "Content-Type"=>"text/plain"
                ])->withBody($textVTT,"text/plain")->put($textTrackBody['link']);

                $textTrackActive = Vimeo::request($textTrackBody['uri'], ["active" => true], 'PATCH');
            }
        }
    }
    public function postTextTrackByName($keyName){

    }
    public function saveVideo($file){
            $arrNewNameVideos = [];
            $output_dir_videos = public_path() . "/storage/lesson/";
            //video demo
            $videoDemoName = str_replace(' ','-',strtolower($file['video_demo']['name']));
            $videoDemoExt = substr($videoDemoName, strrpos($videoDemoName, '.'));
            $NewVideoDemoName = Str::random(10) . $videoDemoExt;
            //video full
            $videoFullName = str_replace(' ','-',strtolower($file['video_full']['name']));
            $videoFullExt = substr($videoFullName, strrpos($videoFullName, '.'));
            $NewVideoFullName = Str::random(10) . $videoFullExt;
            if (!file_exists($output_dir_videos)){
                @mkdir($output_dir_videos, 0777);
            }
            move_uploaded_file($file['video_demo']["tmp_name"],$output_dir_videos ."video_demo/" . $NewVideoDemoName);
            move_uploaded_file($file['video_full']["tmp_name"],$output_dir_videos ."video_full/" . $NewVideoFullName);
            $arrNewNameVideos['video_demo'] = $NewVideoDemoName;
            $arrNewNameVideos['video_full'] = $NewVideoFullName;
            return  $arrNewNameVideos;
    }

    public function deleteVideo($videoName, $type){
        $output_dir_videos = public_path() . "/storage/lesson/" . $type . "/" . $videoName;

        $controller = (new \ReflectionClass($this))->getShortName();
        $shortController = Common::getShortNameController($controller);
        $this->logFolder = $shortController;

        if($this->logFolder){
            $time = Carbon::now()->format('H:i:s');
            $message = "[$time] " . Auth::user()->email . " delete video: $videoName";
            $log = new Log($this->logFolder);
            $log->put("log-" . date("Y-m-d"), $message);
        }


        File::delete($output_dir_videos);
    }

//    public function saveTextTrack($file, $name, $ext, $type){
//        $output_dir = public_path() . "/storage/lesson/";
//        $name_text_track = $name . '.' . $ext;
//        if (!file_exists($output_dir)){
//            @mkdir($output_dir, 0777);
//        }
//        move_uploaded_file($file['text_track_' . $type]["tmp_name"],$output_dir ."text_track_" . $type . '/' . $name_text_track);
//    }
    public function saveTextTrack($file, $name, $ext, $type){
        $output_dir = public_path() . "/texttrack/lesson/";
        $name_text_track = $name . '.' . $ext;
        if (!file_exists($output_dir)){
            @mkdir($output_dir, 0777);
        }
        move_uploaded_file($file['text_track_' . $type]["tmp_name"],$output_dir ."text_track_" . $type . '/' . $name_text_track);
    }

}
