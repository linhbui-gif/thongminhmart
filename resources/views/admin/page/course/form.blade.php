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
    @include("admin.partials.page-header")
@stop

@section('content')
    <div class="row">
        <div class="col-xs-12">
{{--            <form action="{{ $link  }}" method="POST" enctype="multipart/form-data">--}}
                @csrf
            <div class="box box-primary">
                <div class="box-body">
                    @include("admin.template.error")
                    <div class="edu_tab">

                        <ul class="nav nav-tabs tab_header">
                            @php
                                $tab_current = request()->input('tab_current', 'info');

                                if(Session::has('tab_current')){
                                    $tab_current = Session::get('tab_current');
                                    Session::forget('tab_current');
                                }else{

                                    $tab_current = "info";
                                }


                            @endphp
                            <li @if($tab_current == "info") class="active" @endif><a data-toggle="tab" href="#tab_info">Thông tin</a></li>
                            <li @if($tab_current == "seo") class="active" @endif><a data-toggle="tab" href="#seo_tab">Meta</a></li>
                            <li @if($tab_current == "ketqua") class="active" @endif><a data-toggle="tab" href="#ketqua_tab">Kết quả</a></li>
                            <li @if($tab_current == "hoclieu") class="active" @endif><a data-toggle="tab" href="#hoclieu_tab">Học liệu</a></li>
                            <li @if($tab_current == "giangvien") class="active" @endif><a data-toggle="tab" href="#giangvien_tab">Giảng viên</a></li>
                            @if(isset($item['id']))
                                <li @if($tab_current == "intro_tab") class="active" @endif><a data-toggle="tab" href="#intro_tab">Video giới thiệu</a></li>
                                <li @if($tab_current == "hoccu_tab") class="active" @endif><a data-toggle="tab" href="#hoccu_tab">Quản lý compo</a></li>
                                <li @if($tab_current == "giaotrinh") class="active" @endif><a data-toggle="tab" href="#giaotrinh">Giáo trình</a></li>
                                <li @if($tab_current == "tailieu") class="active" @endif><a data-toggle="tab" href="#tailieu">Tài liệu</a></li>
                                <li @if($tab_current == "review") class="active" @endif><a data-toggle="tab" href="#review">Đánh giá</a></li>
                            @endif
                        </ul>
                        <div class="tab-content">
                            <form id="form_info" action="{{ $link  }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div id="tab_info" class="tab-pane fade in @if($tab_current == "info") active @endif ">
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label for="name">Name:</label>
                                            <input value="{{ old("name", @$item['name'] )  }}" name="name" type="text" class="form-control" id="name">
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="price_base">Price:</label>
{{--                                                    <p style="color:red">Nhập giá 0 thì khóa học là miễn phí</p>--}}

                                                    @php
                                                        $old_price = old("price_base", @$item['price_base'] );
                                                    @endphp
                                                    <select id="option_price" class="form-control">
                                                        <option @if($old_price != "-1" && $old_price != "-2") selected @endif value="1">Điền giá cụ thể</option>
                                                        <option @if($old_price == "-1") selected @endif value="-1">Miễn phí</option>
                                                        <option @if($old_price == "-2") selected @endif value="-2">Sắp khai giảng</option>
                                                    </select>
                                                    <br>
                                                    <input placeholder="50000" style="display: none" value="{{ old("price_base", @$item['price_base'] )  }}" name="price_base" type="text" class="form-control" id="price_base">
                                                    <input value="{{ old("price_base", @$item['price_base'] )  }}" name="price_base_hidden" type="hidden" class="form-control">
                                                </div>
                                            </div>
{{--                                            <div class="col-md-6">--}}
{{--                                                <div class="form-group">--}}
{{--                                                    <label for="price_base">Price final:</label>--}}
{{--                                                    <input value="{{ old("price_final", @$item['price_final'] )  }}" name="price_final" type="text" class="form-control" id="price_final">--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
                                        </div>
{{--                                        <div class="form-group">--}}
{{--                                            <label for="short_description">Short Description:</label>--}}
{{--                                            <textarea class="form-control" name="short_description" id="short_description" rows="4" cols="80">{{ old("short_description", @$item['short_description'])  }}</textarea>--}}
{{--                                        </div>--}}
                                        <div class="form-group">
                                            <label for="short_description">Short Description:</label>
                                            <textarea name="short_description" id="ck_short_description_course" rows="10" cols="80">{{ old("short_description", @$item['short_description'])  }}</textarea>
                                            <script>
                                                // Replace the <textarea id="editor1"> with a CKEditor 4
                                                // instance, using default configuration.
                                                CKEDITOR.replace( "ck_short_description_course",options );
                                            </script>
                                        </div>
                                        <div class="form-group">
                                            <label for="content">Thông tin chung
                                                :</label>
                                            <textarea name="content" id="ck_content_course" rows="10" cols="80">{{ old("content", @$item['content'])  }}</textarea>
                                            <script>
                                                // Replace the <textarea id="editor1"> with a CKEditor 4
                                                // instance, using default configuration.
                                                CKEDITOR.replace( "ck_content_course",options );
                                            </script>
                                        </div>
                                        <div class="form-group">
                                            <div class="panel panel-default">
                                                <div class="panel-heading">Gallery</div>
                                                <div class="panel-body">
                                                    <div id="ctn-app-colors" class="ctn-app-colors box-gallery-ctn-app ui-sortable">
                                                        @if($item)
                                                        @if($item->gallery)


                                                                @php
                                                                    $arrGallery = json_decode($item->gallery);

                                                                @endphp

                                                                @foreach($arrGallery as $k => $src)
                                                                    <div class="item-sort">
                                                                        <div class="item-sort">
                                                                            <div class="dynamic-box-item">
                                                                                <div class="box-img">
                                                                                    <input class="dynamic-attach-id" name="galleries[]" type="hidden" value="{{ $src }}">
                                                                                    <div class="box-icon-upload">
                                                                                        <div class="upload-icon"></div>
                                                                                        <div class="upload-text">Upload image</div>
                                                                                    </div>
                                                                                    <div class="upload-image-box">
                                                                                        <img class="upload-image" style="display: block;" src="{{ $src }}">
                                                                                    </div>
                                                                                </div>
                                                                                <div class="dynamic-icon-delete" style="display: none;"></div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                @endforeach
                                                        @endif
                                                        @endif
                                                        <div class="dynamic-new-box">
                                                            <div class="dynamic-icon-plus"></div>
                                                            <div class="dynamic-icon-txt">New Image</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Status:</label>
                                            <div class="checkbox">
                                                <label><input @if(old('status',@$item['status'] ) == "active") checked @endif name="status" value="active" class="minimal" type="checkbox"> Active</label>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Hot:</label>
                                            <div class="checkbox">
                                                <label><input @if(old('hot',@$item['hot'] ) == "yes") checked @endif name="hot" value="yes" class="minimal" type="checkbox"> Hot</label>
                                            </div>
                                        </div>
                                        @php
                                            $categories = \App\Course_category::select("id","name")->orderBy('name','asc')->get();
                                            $oldCategory = old('category_id',@$item['category_id'] );
                                        @endphp
                                        <div class="form-group">
                                            <label for="category_id">Chọn danh mục:</label>
                                            <select name="category_id" class="form-control" id="category_id">
                                                <option value="default">--- Chọn danh mục --</option>
                                                @foreach($categories as $k => $category)
                                                    @php
                                                        $checked = "";
                                                        if($category['id'] == $oldCategory){
                                                            $checked = "selected";
                                                        }
                                                    @endphp
                                                    <option {{ $checked }} value="{{ $category['id'] }}">{{ $category['name'] }}</option>
                                                @endforeach
                                            </select>
                                        </div>
{{--                                        <div class="form-group file_picture">--}}
{{--                                            <label for="picture">Picture:</label>--}}
{{--                                            <input name="picture" type="file" class="form-control file_picture_one" id="picture">--}}
{{--                                            @if(isset($item) && isset($item['picture']))--}}
{{--                                                <p><img class="image_preview" width="300" src="{{  $item->getImage() }}" alt=""></p>--}}
{{--                                            @endif--}}
{{--                                        </div>--}}
                                        <div class="form-group">
                                            <div class="panel panel-default">
                                                <div class="panel-heading">Picture:</div>
                                                <div class="panel-body">
                                                    <div id="ctn-app-colors" class="box-picture-ctn-app">
                                                        <div class="dynamic-box-item">
                                                            <div class="box-img">
                                                                @if(isset($item) && is_object($item))
                                                                    <input class="dynamic-attach-id" name="url_picture" type="hidden" value="{{ $item->url_picture }}">
                                                                @else
                                                                    <input class="dynamic-attach-id" name="url_picture" type="hidden" >
                                                                @endif

                                                                <div class="box-icon-upload">
                                                                    <div class="upload-icon"></div>
                                                                    <div class="upload-text">Upload image</div>
                                                                </div>
                                                                <div class="upload-image-box">
                                                                    @if(isset($item) && is_object($item) )
                                                                        <img class="upload-image" style="display: block;" src="{{ $item->url_picture }}">
                                                                    @else
                                                                        <img class="upload-image" style="display: block;">
                                                                    @endif

                                                                </div>
                                                            </div>
                                                            <div class="dynamic-icon-delete" style="display: none;"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        {{--                                        <div class="form-group file_picture gallery_course">--}}
{{--                                            <label for="gallery">Gallery:</label>--}}
{{--                                            <input multiple name="gallery[]" type="file" class="form-control picture_multi" id="gallery">--}}
{{--                                            <div class="multi_preview_image">--}}
{{--                                                @if(isset($item) && isset($item['gallery']) )--}}
{{--                                                    @php--}}
{{--                                                        $arrImage = json_decode($item['gallery']);--}}
{{--                                                    @endphp--}}
{{--                                                    @foreach($arrImage as $k => $file_name)--}}
{{--                                                        <img class="avatar_preview" style="max-width: 100px" src="{{  \App\Helper\Common::showThumb($folderUpload, $file_name ) }}" alt="">--}}
{{--                                                    @endforeach--}}

{{--                                                @endif--}}
{{--                                            </div>--}}

{{--                                        </div>--}}
                                    </div>
                                </div>
                                </div>

                            <div id="seo_tab" class="tab-pane fade in @if($tab_current == "seo") active @endif ">
                                @include("admin.partials.meta_seo")
                            </div>
                                @if(isset($item['id']))
                                <div id="intro_tab" class="tab-pane fade in @if($tab_current == "intro_tab") active @endif ">
                                    <div class="row">
                                        <div class="col-md-6">
{{--                                            <div class="form-group file_picture">--}}
{{--                                                <label for="thumbnail_intro">Thumbnail:</label>--}}
{{--                                                <input name="thumbnail_intro" type="file" class="form-control file_picture_one" id="thumbnail_intro">--}}
{{--                                                @if(isset($item) && isset($item['picture']))--}}
{{--                                                    <p><img class="image_preview" width="300" src="{{ asset('images/course_courses/' . $item['thumbnail_intro'] ) }}" alt=""></p>--}}
{{--                                                @endif--}}
{{--                                            </div>--}}
                                            <div class="form-group">
                                                <div class="panel panel-default">
                                                    <div class="panel-heading">Thumbnail:</div>
                                                    <div class="panel-body">
                                                        <div id="ctn-app-colors" class="box-picture-ctn-app">
                                                            <div class="dynamic-box-item">
                                                                <div class="box-img">
                                                                    @if(isset($item) && is_object($item))
                                                                        <input class="dynamic-attach-id" name="thumbnail_intro_url" type="hidden" value="{{ $item->thumbnail_intro_url }}">
                                                                    @else
                                                                        <input class="dynamic-attach-id" name="thumbnail_intro_url" type="hidden" >
                                                                    @endif

                                                                    <div class="box-icon-upload">
                                                                        <div class="upload-icon"></div>
                                                                        <div class="upload-text">Upload image</div>
                                                                    </div>
                                                                    <div class="upload-image-box">
                                                                        @if(isset($item) && is_object($item) )
                                                                            <img class="upload-image" style="display: block;" src="{{ $item->thumbnail_intro_url }}">
                                                                        @else
                                                                            <img class="upload-image" style="display: block;">
                                                                        @endif

                                                                    </div>
                                                                </div>
                                                                <div class="dynamic-icon-delete" style="display: none;"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">Video Giới thiệu : (.zip)</label>
                                                <input name="video_intro" type="file" style="margin-bottom: 20px">
                                                @if($item->video_intro)
                                                    @php
                                                        $link_video = "https://player.vimeo.com/video/" . $item->video_intro;
                                                    @endphp
                                                    <iframe src="{{ $link_video }}" width="500" height="300" frameborder="0"   allowfullscreen></iframe>
                                                @endif

                                            </div>
                                        </div>

                                    </div>
                                </div>
                                @endif
                                <div id="ketqua_tab" class="tab-pane fade in @if($tab_current == "ketqua") active @endif ">

                                    <div class="form-group">
                                        @php
                                            $result_descrition = '';
                                            if(isset($item)){
                                                if(isset($item['id'])){
                                                    $result = json_decode($item->result, true);
                                                    if(isset( $result['description'])){
                                                        $result_descrition = $result['description'];
                                                    }
                                                }
                                            }
                                           if($res = old('result')){
                                                $result_descrition = $res['description'];
                                            }

                                        @endphp
                                        <label for="content">Mô tả :</label>
                                        <textarea name="result[description]" id="ck_content_ketqua" rows="10" cols="80">{{ $result_descrition }}</textarea>
                                        <script>
                                            CKEDITOR.replace( "ck_content_ketqua",options );
                                        </script>
                                    </div>
                                    <div class="form-group">
                                        <div class="panel panel-default">
                                            <div class="panel-heading">Gallery</div>
                                            <div class="panel-body">
                                                <div id="ctn-app-colors" class="ctn-app-colors result-gallery-app custome">
                                                    @php
                                                        $result_gallery = [];
                                                        if(old('result')){
                                                            $result = isset($res['gallery']) ? $res['gallery'] : null;
                                                        }else{
                                                            $result = @$item->result;
                                                        }
                                                        if($result_gallery){
                                                            if(!is_array($result_gallery)){
                                                                $result_gallery = json_encode($item->result,true)['gallery'];
                                                            }else{
                                                                $result_gallery = $result;
                                                            }
                                                        }
                                                        //dd($result_gallery);
                                                    @endphp
                                                    @if($item)
                                                        @php
                                                            $result = json_decode($item->result, true);
                                                            $result_gallery = [];
                                                            if(isset($result['gallery'])){
                                                                $result_gallery = $result['gallery'];
                                                            }

                                                        @endphp
                                                        @if($result_gallery)
                                                            @foreach($result_gallery as $k => $item_loop)
                                                                <div class="item-sort">
                                                                    <div class="dynamic-box-item box-gallery-2">
                                                                        <div class="box-img" id="lfm-test">
                                                                            <input class="dynamic-attach-id" name="result[gallery][image][]"  type="hidden" value="{{ $item_loop['image'] }}" />
                                                                            <div class="box-icon-upload">
                                                                                <div class="upload-icon"></div>
                                                                                <div class="upload-text">Upload image</div>
                                                                            </div>
                                                                            <div class="upload-image-box">
                                                                                <img class="upload-image" style="display: block"  src="{{ $item_loop['image'] }}" />
                                                                            </div>
                                                                        </div>
                                                                        <div class="dynamic-icon-delete"></div>
                                                                        <div class="group_input">
                                                                            <input value="{{ $item_loop['title'] }}" name="result[gallery][title][]" type="text" class="g_description">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @endforeach
                                                        @endif
                                                    @endif
                                                    <div class="box-gallery">
                                                        <div class="dynamic-icon-plus"></div>
                                                        <div class="dynamic-icon-txt">New Image</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="panel panel-default">
                                            <div class="panel-heading">Slider Gallery</div>
                                            <div class="panel-body">
                                                <div id="ctn-app-colors" class="ctn-app-colors result-slider-app custome">
                                                    @if($item)
                                                        @php
                                                            $result = json_decode($item->result, true);
                                                            $result_gallery = [];
                                                            if(isset($result['gallery_slider'])){
                                                                 $result_gallery = $result['gallery_slider'];
                                                            }

                                                        @endphp
                                                        @if($result_gallery)
                                                            @foreach($result_gallery as $k => $item_loop)
                                                                <div class="item-sort">
                                                                    <div class="dynamic-box-item box-gallery-2">
                                                                        <div class="box-img">
                                                                            <input class="dynamic-attach-id" name="result[gallery_slider][image][]"  type="hidden" value="{{ $item_loop['image'] }}" />
                                                                            <div class="box-icon-upload">
                                                                                <div class="upload-icon"></div>
                                                                                <div class="upload-text">Upload image</div>
                                                                            </div>
                                                                            <div class="upload-image-box">
                                                                                <img class="upload-image" style="display:block;" src="{{ $item_loop['image'] }}" />
                                                                            </div>
                                                                        </div>
                                                                        <div class="dynamic-icon-delete"></div>
                                                                        <div class="group_input">
                                                                            <input value="{{ $item_loop['title'] }}" name="result[gallery_slider][title][]" placeholder="title..." type="text" class="g_description">
                                                                            <textarea name="result[gallery_slider][description][]" class="g_description_text" name="" id=""  rows="2">{{ $item_loop['description'] }}</textarea>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @endforeach
                                                        @endif
                                                    @endif
                                                    <div class="box-gallery-slider">
                                                        <div class="dynamic-icon-plus"></div>
                                                        <div class="dynamic-icon-txt">New Image</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                </div>
                                <div id="hoclieu_tab" class="tab-pane fade in @if($tab_current == "hoclieu") active @endif ">
                                    <div class="form-group">
                                        <label for="content">Học liệu :</label>
                                        <textarea name="hoclieu" id="ck_content_hoclieu" rows="10" cols="80">{{ old("hoclieu", @$item['hoclieu'])  }}</textarea>
                                        <script>
                                            CKEDITOR.replace( "ck_content_hoclieu",options );
                                        </script>
                                    </div>
                                </div>
                                <div id="giangvien_tab" class="tab-pane fade in @if($tab_current == "giangvien") active @endif ">
                                    <br>
                                    <div class="form-group">
                                        <label for="content">Danh sách Giảng viên :</label>
                                        @php
                                            $allUser = \App\User::orderBy('id','asc')->get();
                                            $teacher_id = old("teacher_id", @$item['teacher_id'])
                                        @endphp
                                        <select class="form-control" name="teacher_id">
                                            <option value="-1">-- Chọn giảng viên --</option>
                                            @foreach($allUser as $k => $user_giangvien)
                                                @if($user_giangvien->is_giangvien())
                                                <option @if($teacher_id == $user_giangvien->id) selected @endif value="{{ $user_giangvien->id }}">{{ $user_giangvien->email }} - {{ $user_giangvien->fullName() }}</option>
                                                @endif
                                            @endforeach
                                        </select>

                                    </div>
                                    <div class="form-group">
                                        <label for="content">Giảng viên :</label>
                                        <textarea name="giangvien" id="ck_content_giangvien" rows="10" cols="80">{{ old("giangvien", @$item['giangvien'])  }}</textarea>
                                        <script>
                                            CKEDITOR.replace( "ck_content_giangvien",options );
                                        </script>
                                    </div>
                                </div>
                                <div id="chapter" class="tab-pane fade in @if($tab_current == "chapter") active @endif ">
                                    <div class="content_wrapper_chapter">

                                    </div>
                                </div>
                                <div id="tailieu" class="tab-pane fade in @if($tab_current == "tailieu") active @endif ">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">Tài liệu :</label>
                                                <div class="input-group">
                                                    <span class="input-group-btn">
                                                        <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary">
                                                            <i class="fa fa-file"></i> Choose
                                                        </a>
                                                    </span>
                                                    <input value="{{ @$item->file_doc }}" id="thumbnail" class="form-control path_file " type="text" name="filepath">
                                                </div>

                                            </div>
                                        </div>


                                    </div>
                                </div>

                            </form>
                            @if(isset($item['id']))
                            <div id="giaotrinh" class="tab-pane fade in @if($tab_current == "giaotrinh") active @endif ">
                                <div class="content_wrapper_giaotrinh">
                                    {!! Menu::render($item['id']) !!}
                                </div>
                            </div>
                                <div id="hoccu_tab" class="tab-pane fade in @if($tab_current == "hoccu_tab") active @endif ">
                                   <div class="row">
                                       <div class="col-md-12">
                                           <div class="group_form_add">
                                               <div class="list_item">
                                                   <h4>Danh sách các compo</h4>
                                                   @php
                                                       $compos = $item->compos;
                                                   @endphp
                                                   @if(count($compos) > 0)
                                                   <div class="tool-bar">
                                                       <div class="row">
                                                           <div class="col-md-12 text-right">
                                                               <a href="javascript:submitFormOrdering('{{ route('admin.compo.changeOrdering') }}')" class="">
                                                                   <button type="button" class="btn btn-warning">
                                                                       <span><i class="el-icon-edit"></i> Thứ tự</span>
                                                                   </button>
                                                               </a>
                                                           </div>
                                                       </div>
                                                   </div>
                                                   @endif
                                                   <br>

                                                   <form action="" method="POST" id="frmCompo">
                                                       @csrf
                                                   <table class="table table-bordered">
                                                       <thead>
                                                       <tr>

                                                           <th>Tên</th>
                                                           <th>Giá</th>
                                                           <th>Trọng lượng</th>
                                                           <th>Kho</th>
                                                           <th>Phí ship</th>
                                                           <th>Thứ tự hiển thị</th>
                                                       </tr>
                                                       </thead>
                                                       <tbody>
                                                       @if(count($compos) > 0)
                                                           @foreach($compos as $k => $compo)
                                                               <tr class="row-{{ $compo->id }}">

                                                                   <td class="compo_name" data-value="{{ $compo->name }}">{{ $compo->name }}</td>
                                                                   <td class="compo_price" data-value="{{ $compo->price }}">{{ number_format($compo->price) }} VNĐ</td>
                                                                   <td>{{ $compo->weight }} (gr)</td>
                                                                   <td>
                                                                       @php
                                                                            $warehouse = $compo->warehouse;
                                                                       @endphp
                                                                       @if($warehouse)
                                                                       <p>Tên kho: {{ $warehouse->name }}</p>
                                                                       <p>Người đại diện: {{ $warehouse->contact_name }}</p>
                                                                       <p>Địa chỉ: {{ $warehouse->address }}</p>
                                                                       @endif
                                                                   </td>
                                                                   <td>{{ $compo->ship_fee == 0 ? "Người nhận trả" : "Người gửi trả" }}</td>
                                                                   <td><input style="width: 100px;" class="form-control" type="number" name="ordering_compo[{{ $compo->id }}]" value="{{ $compo->ordering }}"></td>
                                                                   <td>
{{--                                                                       <span onclick="showEdit('{{ $compo->name }}', '{{ $compo->price }}', '{{ $compo->id }}')" class="btn btn-sm btn-info">Edit</span>--}}
                                                                       <a class="btn btn-sm btn-info" href="?compo_id={{$compo->id}}&tab_current=hoccu_tab">Edit</a>
                                                                       <a class="btn btn-sm btn-danger" href="javascript:confirmDelete('{{ route('admin.compo.delete', [ 'id' => $compo->id ] ) }}?tab_current=hoccu_tab')">Xóa</a>
{{--                                                                        <a href="?compo_id={{ $compo->id }}&tab_current=hoccu_tab" class="btn btn-sm btn-info">Show</a>--}}
                                                                   </td>
                                                               </tr>
                                                           @endforeach
                                                       @else
                                                           <tr>
                                                               <td colspan="10">Không có dữ liệu</td>
                                                           </tr>
                                                       @endif

                                                       </tbody>
                                                   </table>
                                                       <input type="hidden" name="tab_current" value="hoccu_tab">
                                                   </form>
                                               </div>
                                               <div class="text-center">
                                                   <span onclick="resetCreate()" data-toggle="collapse" data-target="#form_add_product" class="btn btn-success"><i class="fa    fa-plus-circle"></i></span>
                                               </div>
                                               @php
                                                    $compo_item = null;
                                                    if(isset($_GET['compo_id'])){
                                                        $compo_item = \App\Compo::find($_GET['compo_id']);
                                                    }

                                               @endphp
                                               <form id="form_add_product" action="{{ route('admin.compo.store') }}" method="POST" class="collapse @if($compo_item) in @endif">
                                                   @csrf
                                                   <div class="form-group">
                                                       <label for="">Tên gói</label>
                                                       <input @if($compo_item)  value="{{ $compo_item->name }}" @endif class="form-control" type="text" name="name">
                                                   </div>
                                                   <div class="form-group">
                                                       <label for="">Giá: <a href="javascript:void(0)" class="cung_gia_video" data-price="{{ $item->price_base }}" >Cùng giá với video </a></label>
                                                       <input @if($compo_item)  value="{{ $compo_item->price }}" @endif class="form-control" type="number" name="price">
                                                   </div>
                                                   <div class="form-group">
                                                       <label for="">Trọng lượng (gr)</label>
                                                       <input @if($compo_item)  value="{{ $compo_item->weight }}" @endif class="form-control" type="number" step="0.01" name="weight">
                                                   </div>
                                                   <div class="form-group">
                                                       <label for="">Phí ship</label>
                                                       <select style="width: 100%" name="ship_fee" class="form-control" id="ship_fee">
                                                           <option @if( @$compo_item->ship_fee == 0) selected @endif value="0">Người nhận trả</option>
                                                           <option @if(@$compo_item->ship_fee == 1) selected @endif value="1">Người gửi trả</option>
                                                       </select>

                                                   </div>
                                                   <div class="form-group">
                                                       @php
                                                           $warehouses = \App\Warehouse::orderBy('id','desc')->where('status','active')->get();
                                                       @endphp
                                                       <label for="">Kho</label>
                                                       <select style="width: 100%" name="warehouse_id" class="form-control" id="warehouse_id">
                                                           <option value="default">--- Chọn Kho --</option>
                                                           @foreach($warehouses as $k => $warehouse)
                                                               <option @if($compo_item && $compo_item->warehouse_id == $warehouse->id ) selected @endif  value="{{ $warehouse->id }}">{{ $warehouse->name }}</option>
                                                           @endforeach
                                                       </select>
                                                       <script>
                                                           $(document).ready(function() {
                                                               $('#warehouse_id').select2({
                                                                   theme: "classic"
                                                               });
                                                           });

                                                       </script>
                                                   </div>

                                                   <div class="form-group">
                                                       <button type="submit" class="btn btn-success">Lưu</button>
                                                       <button type="button" onclick="resetCreate()" class="btn btn-danger">Hủy</button>
                                                   </div>
                                                   <input type="hidden" name="product_id" value="{{ $item['id'] }}">
                                                   @if($compo_item)
                                                       <input type="hidden" name="compo_id" value="{{ $compo_item->id }}">
                                                   @endif
                                                   <input type="hidden" name="tab_current" value="hoccu_tab">
                                               </form>
                                           </div>


                                       </div>
{{--                                       <div class="col-md-3">--}}
{{--                                           @php--}}
{{--                                               $id_compo = isset($_GET['compo_id']) ? $_GET['compo_id'] : 0;--}}
{{--                                               $compo = \App\Compo::find($id_compo);--}}
{{--                                           @endphp--}}
{{--                                           <h4>{{ @$compo->name }}</h4>--}}
{{--                                           @if($compo)--}}
{{--                                               @php--}}
{{--                                                   $p_in_compo = $compo->products;--}}
{{--                                               @endphp--}}
{{--                                                @if(count($p_in_compo) > 0)--}}
{{--                                               @foreach($p_in_compo as $k => $item_product)--}}
{{--                                                   <div class="box_item">--}}
{{--                                                       <div class="img_left">--}}
{{--                                                           <img src="{{ $item_product->getImage() }}" alt="">--}}
{{--                                                       </div>--}}
{{--                                                       <div class="c_right">--}}
{{--                                                           <p class="name_product">--}}
{{--                                                               {{ $item_product->name }}--}}
{{--                                                           </p>--}}
{{--                                                           <p class="price_product">--}}
{{--                                                               <span>{{ number_format($item_product->price_base) }} VNĐ</span>--}}
{{--                                                           </p>--}}
{{--                                                           <div class="add_box">--}}
{{--                                                               <form action="{{ route('admin.compo.deleteItemInCompo') }}" method="get">--}}

{{--                                                                   <button type="submit" class="btn btn-danger btn-sm">Remove</button>--}}
{{--                                                                   <input type="hidden" value="{{ $_GET['compo_id'] }}" name="compo_id">--}}
{{--                                                                   <input type="hidden" value="{{ $item_product->id }}" name="product_id">--}}
{{--                                                                   <input type="hidden" value="hoccu_tab" name="tab_current">--}}
{{--                                                               </form>--}}
{{--                                                           </div>--}}
{{--                                                       </div>--}}
{{--                                                   </div>--}}
{{--                                               @endforeach--}}
{{--                                               @else--}}
{{--                                                    <p>Hãy thêm sản phẩm vào đây</p>--}}
{{--                                               @endif--}}
{{--                                           @else--}}
{{--                                               <p>Hãy chọn compo</p>--}}
{{--                                           @endif--}}

{{--                                       </div>--}}
{{--                                       <div class="col-md-4">--}}
{{--                                           <h4>Các sản phẩm hiện tại</h4>--}}
{{--                                           <div id="content_item">--}}
{{--                                               @foreach($products as $k => $item_product)--}}
{{--                                                   <div class="box_item">--}}
{{--                                                       <div class="img_left">--}}
{{--                                                           <img src="{{ $item_product->getImage() }}" alt="">--}}
{{--                                                       </div>--}}
{{--                                                       <div class="c_right">--}}
{{--                                                           <p class="name_product">--}}
{{--                                                               {{ $item_product->name }}--}}
{{--                                                           </p>--}}
{{--                                                           <p class="price_product">--}}
{{--                                                               <span>{{ number_format($item_product->price_base) }}VNĐ</span>--}}
{{--                                                           </p>--}}
{{--                                                           <div class="add_box">--}}
{{--                                                               <form action="{{ route('admin.compo.addToCompo') }}" method="POST">--}}
{{--                                                                   @csrf--}}
{{--                                                                   <input name="quantity" class="form-control" type="number" value="0">--}}
{{--                                                                   <button type="submit" class="btn btn-success btn-sm">Add</button>--}}
{{--                                                                   <input type="hidden" value="{{ @$_GET['compo_id'] }}" name="compo_id">--}}
{{--                                                                   <input type="hidden" value="{{ $item_product->id }}" name="product_id">--}}
{{--                                                                   <input type="hidden" value="hoccu_tab" name="tab_current">--}}

{{--                                                               </form>--}}
{{--                                                           </div>--}}
{{--                                                       </div>--}}
{{--                                                   </div>--}}
{{--                                               @endforeach--}}
{{--                                               {!! $products->appends(['tab_current' => 'item_tab'])->links() !!}--}}
{{--                                           </div>--}}
{{--                                       </div>--}}
                                   </div>
                                </div>
                                <div id="review" class="tab-pane fade in @if($tab_current == "review") active @endif ">
                                    <form id="form_review" action="#" method="POST">
                                        @csrf
                                        @php
                                            $comments = $item->comments('parent_id', 0)->orderBy('comments.id','desc')->get();
                                        @endphp
                                        @if($comments && count($comments) > 0)
                                            @foreach($comments as $k => $comment)
                                                @php
                                                    $user = $comment->user;
                                                    $star = $comment->star;
                                                @endphp
                                            @if($user)
                                                <div class="comment-item">
                                                    <div class="comment-header d-flex aligns-item-center">
                                                        <div class="comment-avatar"> <img src="{{ $user->getImage() }}" alt=""></div>
                                                        <div class="comment-info">
                                                            <h6 class="comment-name">{{ $user->fullname() }}</h6>
                                                            <div class="rating-star d-flex align-items-center">
                                                                @for($i = 1; $i < 6; $i++)
                                                                    @if($i <= $star)
                                                                        <img class="star active" src="{{ asset('enduser/assets/icons/icon-star-fill-yellow.svg') }}" alt="">
                                                                    @else
                                                                        <img class="star" src="{{ asset('enduser/assets/icons/icon-star-yellow.svg') }}" alt="">
                                                                    @endif
                                                                @endfor
                                                            </div>
                                                        </div>
                                                        <div class="comment-action">
                                                            @php
                                                                $classShow = $comment->show_page_review == 0 ? "btn-default" : "btn-success";
                                                            @endphp
                                                            <a title="Show" href="{{ route('admin.comment.changeShow' , [ 'id' => $comment->id, 'show' => $comment->show_page_review ]  ) }}?tab_current=review" class="btn btn-sm {{ $classShow }}"><i class="fa fa-check"></i></a>
                                                            <a href="javascript:actionCommentDelete('{{ route('admin.comment.delete', [ 'id' => $comment->id ]  ) }}?tab_current=review')" class="trash-action btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
                                                        </div>
                                                    </div>
                                                    <div class="comment-caption">
                                                        <p>{{ $comment->body }}</p>
                                                        @if($comment->images)
                                                            <img src="{{ asset('images/comments/' . $comment->images ) }}" style="max-width: 200px">
                                                        @endif
                                                    </div>
                                                </div>
                                                @endif
                                            @endforeach


                                        @else
                                            <h3>Không có đánh giá nào</h3>
                                        @endif
                                        <input type="hidden" name="product_id" value="{{ $item['id'] }}">
                                        <input type="hidden" name="tab_current" value="review">
                                    </form>
                                </div>

                            @endif
                        </div>
                    </div>
                </div>
                <div class="box-footer">
                    <div class="el-form-item">
                        <div class="el-form-item__content">
                            <button type="button" onclick="submitForm('form_info')" class="el-button el-button--primary"><span>Save</span></button>
                            <a href="{{ route('admin.' . $controllerName . ".index") }}" class="el-button el-button--default"><span>Cancel </span></a>
                        </div>
                    </div>
                </div>
            </div>
{{--            </form>--}}
        </div>
    </div>


@stop

@section('script')
    {!! Menu::scripts() !!}
@stop


