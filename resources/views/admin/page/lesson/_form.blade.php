@php
    use App\Helper\Form;
    if(!isset($item)){
        $item = [];
        $link = route('admin.'.$controllerName.'.store');
    }else{
        $link = route('admin.'.$controllerName.'.update', [ 'id' => $item['id'] ]  );
    }
@endphp

@extends("admin.layout")

@section('content-header')
    <section class="content-header">
        <h1>
            Khóa học: {{ $item->chappter->course->name }}</small>
            <p><small>{{ $item->chappter->name }}</small></p>
        </h1>
    </section>
@stop

@section('content')
    <div class="row">

        <div class="col-xs-12">

            <form action="{{ route('admin.lesson.uploadVideo')  }}" method="POST" enctype="multipart/form-data">
                @csrf
                @if(isset($item->id))
                    <input name="id" type="hidden" value="{{ $item->id }}">
                @endif
                <div class="box box-primary">
                    <div class="box-body">
                        <h3>{{ $item->label }}</h3>
                        @include("admin.template.error")
                        @php
                            if($item->video_demo != null && $item->video_full != null){
                               $video_demo = Vimeo::request('/me/videos', ['per_page' => 10], 'GET')['body']['data'];
                               foreach ($video_demo as $key => $value){
                                    if(explode('/', $value['uri'])[2] === $item->video_demo){
                                       $iframe_demo = $value['embed']['html'];
                                    }
                                    if(explode('/', $value['uri'])[2] === $item->video_full){
                                        $iframe_full = $value['embed']['html'];
                                    }
                               }
                            }
                        @endphp

                        <div class="row">
                            <div class="col-md-12">
                                <h4 style="margin-bottom: 20px">Duration</h4>
                                @if(isset($item->duration))
                                    @php
                                        $arrTime = explode(":", gmdate("H:i:s", $item->duration));
                                        $hour = $arrTime[0];
                                        $minute = $arrTime[1];
                                        $seconds = $arrTime[2];
                                    @endphp
                                @endif
                                <span>Giờ: </span>
                                <input style="margin-bottom: 10px;width:50px" name="hour" type="number" placeholder="Nhập giờ" value="{{ @$hour }}">
                                <span>Phút: </span>
                                <input style="margin-bottom: 10px;width:50px" name="minute" type="number" placeholder="Nhập phút" value="{{ @$minute }}">
                                <span>Giây: </span>
                                <input style="margin-bottom: 10px;width:50px" name="seconds" type="number" placeholder="Nhập giây" value="{{ @$seconds }}">
{{--                                <div style="display: block; margin-top: 20px">--}}
{{--                                    <h4 style="margin-bottom: 20px">Text track video demo</h4>--}}
{{--                                    <input type="file" name="text_track_demo" value="{{ @$item->text_track_demo }}">--}}
{{--                                    <h4 style="margin: 20px 0">Text track video full</h4>--}}
{{--                                    <input type="file" name="text_track_full" value="{{ @$item->text_track_full }}">--}}
{{--                                </div>--}}
                            </div>
                            <div class="col-md-6 showvideo">
                                <div>
                                    <h4>Video Demo</h4>
                                    <input onchange="previewVideo(this, 'video_demo', 'pre-view-video-demo')"  name="video_demo" type="file" style="margin-bottom: 20px">
                                    <video id="pre-view-video-demo" style="display: none"  width="500" height="500" controls></video>
                                    {!! @$iframe_demo !!}
                                </div>

                                <div class="form-control1">
                                    <div style="display: block; margin-top: 20px">
                                        <h4 style="margin-bottom: 20px">Text track video demo</h4>
                                        <input type="file" name="text_track_demo" value="{{ @$item->text_track_demo }}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 showvideo">
                                <h4>Video Full</h4>
                                <input onchange="previewVideo(this, 'video_full', 'pre-view-video-full')" name="video_full" type="file" style="margin-bottom: 20px">
                                <video id="pre-view-video-full" style="display: none" width="500" height="500" controls></video>
                                {!! @$iframe_full !!}
                                <div class="form-control1">
                                    <div style="display: block; margin-top: 20px">
                                        <h4 style="margin: 20px 0">Text track video full</h4>
                                        <input type="file" name="text_track_full" value="{{ @$item->text_track_full }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row picturethumbnal">
                            <div class="col-md-6">
                                <h4>Picture thumbnail</h4>
                                <input onchange="previewImage(this, 'image-thumbnail', 'pre-view-image')" name="image-thumbnail" type="file" style="margin-bottom: 20px">
                                <div>
                                    <img id="pre-view-image" width="500px" style="display: none" controls>
                                    @if($item->thumbnail)
                                        <img class="show_image" width="500px" src="{{  $item->getImage() . "/" . $item->thumbnail }}" id="show-image" controls></img>
                                    @endif
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <h4>Choose language upload text track</h4>
                                    <select class="form-control" name="language" style="width: 20%;">
                                        <option style="padding: 10px" value="vi">Vietnamese</option>
                                        <option style="padding: 10px" value="en">English</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <input class="btn btn-success" type="submit" value="save" style="width: 150px;height:50px; border-radius: 8px; display: block; margin: 20px auto">
                    </div>
    {{--                @include("admin.template.action_form")--}}
                </div>
            </form>
        </div>
    </div>
@stop
@section('script')
    <script src="https://player.vimeo.com/api/player.js"></script>
    <script>
        var iframe = document.querySelectorAll('iframe');
        iframe.forEach((i)=>{
            var player = new Vimeo.Player(i);
            player.enableTextTrack('ja', 'subtitles').then(a=>console.log(a))

            player.getVideoTitle().then(function(title) {
                console.log('title:', title);
            });
        })
    </script>
@stop
