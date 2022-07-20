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
            <form action="{{ $link  }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="box box-primary">
                    <div class="box-body">
                        @include("admin.template.error")
                        <div class="edu_tab">
                            @php
                                $keyActive = "general_tab";
                            @endphp
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
                                                <div class="form-group">
                                                    <label for="name">Price Base:</label>
                                                    <input value="{{ old("price_base", @$item['price_base'] )  }}" name="price_base" type="text" class="form-control" id="price_base">
                                                </div>
                                                <div class="form-group">
                                                    <label for="name">Price Final:</label>
                                                    <input value="{{ old("price_final", @$item['price_final'] )  }}" name="price_final" type="text" class="form-control" id="price_final">
                                                </div>
                                                <div class="form-group">
                                                    <label for="short_description">Mô tả tóm tắt:</label>
                                                    <textarea name="short_description" id="ck_description" rows="10" cols="80">{{ old("short_description", @$item['short_description'])  }}</textarea>
                                                    <script>
                                                        CKEDITOR.replace( "ck_description",options );
                                                    </script>
                                                </div>
                                                <div class="form-group">
                                                    <label for="short_description">Nội dung:</label>
                                                    <textarea name="content" id="ck_content" rows="10" cols="80">{{ old("content", @$item['content'])  }}</textarea>
                                                    <script>
                                                        CKEDITOR.replace( "ck_content",options );
                                                    </script>
                                                </div>
                                                <div class="form-group">
                                                    <label for="name">Số thứ tự:</label>
                                                    <input value="{{ old("order_no", @$item['order_no'] )  }}" name="order_no" type="text" class="form-control" id="order_no">
                                                </div>
                                                <?php
                                                if (isset($item->ts_kt)){
                                                    $content = unserialize($item->ts_kt);
                                                }

                                                ?>
                                                <div class="row">
                                                    @for($stt = 1; $stt < 10; $stt++)
                                                        <div class="col-md-4">
                                                            <h4>Tiêu chí {{ $stt }}</h4>
                                                            <div class="form-group">
                                                                <label for="">Tên:</label>
                                                                <input name="contents[tieu_chi_{{ $stt }}][name]" value="{{ @$content['tieu_chi_' . $stt ]['name'] }}" type="text" class="form-control" id="">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="">Mô tả</label>
                                                                <textarea name="contents[tieu_chi_{{ $stt }}][description]" class="form-control" cols="30" rows="5">{{ @$content['tieu_chi_' . $stt ]['description'] }}</textarea>
                                                            </div>
                                                        </div>
                                                    @endfor
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Status:</label>
                                                    <div class="checkbox">
                                                        <label><input @if(old('status',@$item['status'] ) == "active") checked @endif name="status" value="active" class="minimal" type="checkbox"> Active</label>
                                                    </div>
                                                </div>
                                                @php
                                                    $categories = \App\Product_category::select("id","name")->orderBy('name','asc')->get();
                                                    $oldCategory = old('category_id',@$item['category_id'] );
                                                @endphp
                                                <div class="form-group">
                                                    <label for="parent_id">Chọn danh mục:</label>
                                                    <select name="parent_id" class="form-control" id="parent_id">
{{--                                                        <option value="0">--- Chọn danh mục sản phẩm--</option>--}}
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
                                                @php
                                                    $model = new \App\Product_tags();
                                                    $items = $model->orderBy('id','desc')->get()->pluck('name','id')->toArray();
                                                @endphp
                                                <div class="form-group">
                                                    <label for="hashtag">Nhập hashtag:</label>
                                                    <select multiple="multiple" class="form-control tag_id" name="tag_id[]">
                                                        <option value="default">-- Select tags --</option>
                                                        @if ( isset($item->tags)  && count($item->tags) > 0)
                                                                @foreach ($item->tags as $k => $tag)
                                                                    <option value="{{ $k }}" selected >{{ $tag->name }}</option>
                                                                @endforeach
                                                        @else
                                                            @foreach($items as $k => $name)
                                                                <option value="{{ $k }}">{{ $name }}</option>
                                                            @endforeach
                                                        @endif


                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="name">Video Upload:</label>
                                                    <input value="{{ old("video_link", @$item['video_link'] )  }}" name="video_link" type="file" class="form-control" id="video_link">

                                                    @if(isset($item->video_link))
                                                        <video width="100%" height="300px" controls>
                                                            <source src="{{asset('storage/video-intro/'.$item->video_link)}}" type="video/mp4">
                                                        </video>
                                                    @endif
                                                </div>

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


                                            </div>
                                        </div>
                                    </div>
                                    <div id="seo_tab" class="tab-pane fade in @if($tab_current == "seo") active @endif ">
                                        @include("admin.partials.meta_seo")
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="box-footer">
                        <div class="el-form-item">
                            <div class="el-form-item__content">
                                <button type="submit" class="el-button el-button--primary"><span>Save</span></button>
                                <a href="{{ route('admin.' . $controllerName . ".index") }}" class="el-button el-button--default"><span>Cancel </span></a>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@stop


@section('script')
<script>
    $(document).ready(function() {
        $('.tag_id').select2();
    });

</script>
@endsection
