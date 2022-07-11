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
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    <link href="https://anyclass.vn/vendor/harimayco-menu/style.css" rel="stylesheet">
    <style>
        div#soantracnghiem #hwpwrap #wpbody-content #menu-settings-column {
            width: 40%;
            margin-left: 0px;
            margin-right: 8px;
        }

        #soantracnghiem #hwpwrap #nav-menus-frame {
            margin-left: 0px;
        }
        div#soantracnghiem #hwpwrap #wpbody-content #menu-management-liquid {
            width: 59%;
            max-width: 100%;
            min-width: initial;
        }
        #soantracnghiem #hwpwrap .menu-item-bar .menu-item-handle {
            width: 100%;
        }
        #soantracnghiem #hwpwrap .menu-item-settings {
            width: 100%;
            padding-right: 8px;
        }
        span.order_dapan {
            color: red;
            font-weight: bold;
        }
        .dapan_dung {
            color: #11a00f;
            font-weight: bold;
        }
    </style>
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
                        <div class="edu_tab">
                            @php
                                $keyActive = "general_tab";
                            @endphp
                            @php
                                $tab_current = request()->input('tab_current', 'general_tab');
                                if(Session::has('tab_current')){
                                    $tab_current = Session::get('tab_current');
                                    Session::forget('tab_current');
                                }else{
                                    $tab_current = "general_tab";
                                }
                            @endphp
                            <ul class="nav nav-tabs tab_header">
                                <li @if($tab_current == "general_tab") class="active" @endif><a data-toggle="tab" href="#general_tab">Thông tin chung</a></li>
                                <li @if($tab_current == "demo_tab") class="active" @endif><a data-toggle="tab" href="#demo_tab">Demo</a></li>
                                <li @if($tab_current == "full_tab") class="active" @endif ><a data-toggle="tab" href="#full_tab">Full</a></li>
                                <li @if($tab_current == "tracnghiem_tab") class="active" @endif><a data-toggle="tab" href="#tracnghiem_tab">Soạn bài trắc nghiệm</a></li>
                                <li @if($tab_current == "huongdan_tab") class="active" @endif><a data-toggle="tab" href="#huongdan_tab">Hướng dẫn</a></li>
                            </ul>
                            <div class="tab-content">
                                <form action="{{ route('admin.lesson.uploadVideo')  }}" method="POST" enctype="multipart/form-data">
                                <div id="general_tab" class="tab-pane fade in @if($tab_current == "general_tab") active @endif">
                                    <div class="row">
                                        <div class="col-md-6">
{{--                                            <div class="form-group file_picture">--}}
{{--                                                <label for="">Video Thumnail :</label>--}}
{{--                                                <input name="image-thumbnail" type="file" class="form-control file_picture_one"">--}}
{{--                                                @if($item->thumbnail)--}}
{{--                                                    <img class="image_preview" width="200px" src="{{  $item->getImage()  }}" id="show-image" controls></img>--}}
{{--                                                @endif--}}
{{--                                            </div>--}}
                                            @php
                                                $nameItem = 'url_thumbnail';
                                                $itemPicture = $item->{$nameItem};
                                            @endphp
                                            @include("admin.page.page.picture", [ 'label' => 'Thumbnail', 'name' => $nameItem, 'item' => $itemPicture ])
{{--                                            <div class="form-group">--}}
{{--                                                <div class="panel panel-default">--}}
{{--                                                    <div class="panel-heading">Video Thumbnail :</div>--}}
{{--                                                    <div class="panel-body">--}}
{{--                                                        <div id="ctn-app-colors" class="ctn-app-colors">--}}
{{--                                                            <div class="dynamic-box-item">--}}
{{--                                                                <div class="box-img">--}}
{{--                                                                    @if(isset($item) && is_object($item))--}}
{{--                                                                        <input class="dynamic-attach-id" name="url_thumbnail" type="hidden" value="{{ $item->url_thumbnail }}">--}}
{{--                                                                    @else--}}
{{--                                                                        <input class="dynamic-attach-id" name="url_thumbnail" type="hidden" >--}}
{{--                                                                    @endif--}}

{{--                                                                    <div class="box-icon-upload">--}}
{{--                                                                        <div class="upload-icon"></div>--}}
{{--                                                                        <div class="upload-text">Upload image</div>--}}
{{--                                                                    </div>--}}
{{--                                                                    <div class="upload-image-box">--}}
{{--                                                                        @if(isset($item) && is_object($item) )--}}
{{--                                                                            <img class="upload-image" style="display: block;" src="{{ $item->url_thumbnail }}">--}}
{{--                                                                        @else--}}
{{--                                                                            <img class="upload-image" style="display: block;">--}}
{{--                                                                        @endif--}}

{{--                                                                    </div>--}}
{{--                                                                </div>--}}
{{--                                                                <div class="dynamic-icon-delete" style="display: none;"></div>--}}
{{--                                                            </div>--}}
{{--                                                        </div>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                            <div class="form-group">--}}
{{--                                                <label for="">Tài liệu :</label>--}}
{{--                                                <div class="input-group">--}}
{{--                                                    <span class="input-group-btn">--}}
{{--                                                        <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary">--}}
{{--                                                           <i class="fa fa-file"></i> Choose--}}
{{--                                                         </a>--}}
{{--                                                    </span>--}}
{{--                                                    <input value="{{ @$item->file_doc }}" id="thumbnail" class="form-control path_file " type="text" name="filepath">--}}
{{--                                                </div>--}}

{{--                                            </div>--}}
                                        </div>
                                    </div>
                                </div>
                                <div id="demo_tab" class="tab-pane fade in @if($tab_current == "demo_tab") active @endif">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">Video Demo : (.zip)</label>
                                                <input name="video_demo" type="file" style="margin-bottom: 20px">
                                                @if($item)

                                                    @if($item->video_demo)
                                                        @php
                                                            $link_video = "https://player.vimeo.com/video/" . $item->video_demo;
                                                        @endphp
                                                        <iframe src="{{ $link_video }}" width="500" height="300" frameborder="0"   allowfullscreen></iframe>
                                                    @endif
                                                @endif

                                            </div>
                                        </div>
{{--                                        <div class="col-md-6">--}}
{{--                                            <div class="form-group">--}}
{{--                                                <label for="">Text track (Vietnamese):</label>--}}
{{--                                                <input name="text_track_demo_vi" type="file" style="margin-bottom: 20px">--}}
{{--                                            </div>--}}
{{--                                            <div class="form-group">--}}
{{--                                                <label for="">Text track (English):</label>--}}
{{--                                                <input name="text_track_demo_en" type="file" style="margin-bottom: 20px">--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
                                    </div>
                                </div>
                                <div id="full_tab" class="tab-pane fade in @if($tab_current == "full_tab") active @endif">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">Thời gian</label>
                                            </div>
                                            @php
                                                $strTime = $item->time_full;
                                                if($item->time_full == null){
                                                    $strTime = "0:0:0";
                                                }
                                                $arrTime = explode(":",$strTime);
                                            @endphp
                                            <div class="form-group inline-block">
                                                <input value="{{ $arrTime[0] }}" name="time[gio]" class="form-control" type="number" min="0" max="24">
                                                <label for="">Giờ</label>
                                            </div>
                                            <div class="form-group inline-block">
                                                <input value="{{ $arrTime[1] }}" name="time[phut]" class="form-control" type="number" min="0" max="60">
                                                <label for="">Phút</label>
                                            </div>
                                            <div class="form-group inline-block">
                                                <input value="{{ $arrTime[2] }}" name="time[giay]" class="form-control" type="number" min="0" max="60">
                                                <label for="">Giây</label>
                                            </div>
                                            <div class="form-group">
                                                <label for="">Video Full : (.zip)</label>
                                                <input name="video_full" type="file" style="margin-bottom: 20px">
                                                @if($item)

                                                    @if($item->video_full)
                                                        @php
                                                            $link_video = "https://player.vimeo.com/video/" . $item->video_full;
                                                        @endphp
                                                        <iframe src="{{ $link_video }}" width="500" height="300" frameborder="0"   allowfullscreen></iframe>
                                                    @endif
                                                @endif

                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">Text track (Vietnamese):</label>
                                                <input name="text_track_full_vi" type="file" style="margin-bottom: 20px">
                                            </div>
                                            <div class="form-group">
                                                <label for="">Text track (English):</label>
                                                <input name="text_track_full_en" type="file" style="margin-bottom: 20px">
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                    <div id="huongdan_tab" class="tab-pane fade in @if($tab_current == "huongdan_tab") active @endif">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="content">Hướng dẫn:</label>
                                                    <textarea name="tutorial" id="tutorial_ck" rows="10" cols="80">{{ old("tutorial", @$item['tutorial'])  }}</textarea>
                                                    <script>
                                                        // Replace the <textarea id="editor1"> with a CKEditor 4
                                                        // instance, using default configuration.
                                                        CKEDITOR.replace( "tutorial_ck",options );
                                                    </script>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                <div id="tracnghiem_tab" class="tab-pane fade in @if($tab_current == "tracnghiem_tab") active @endif">
                                    <div class="row">
                                        <div class="col-md-12">
                                           @include("admin.page.lesson.tracnghiem")
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="box-footer">
                        <div class="el-form-item">
                            <div class="el-form-item__content">
                                <button type="submit" class="el-button el-button--primary"><span>Save</span></button>
                            </div>
                        </div>
                    </div>
                </div>

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
    <script type="text/javascript" src="https://anyclass.vn/vendor/harimayco-menu/scripts.js"></script>
    <script type="text/javascript" src="https://anyclass.vn/vendor/harimayco-menu/menu.js"></script>
@stop
