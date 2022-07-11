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
                            <li @if($tab_current == "info_en") class="active" @endif><a data-toggle="tab" href="#tab_info_en">Thông tin(en)</a></li>
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
                                                <label for="description">Description:</label>
                                                <textarea name="description" id="ck_description" rows="10" cols="80">{{ old("description", @$item['description'])  }}</textarea>
                                                <script>
                                                    // Replace the <textarea id="editor1"> with a CKEditor 4
                                                    // instance, using default configuration.
                                                    CKEDITOR.replace( "ck_description",options );
                                                </script>
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
                                                <label for="parent_id">Chọn danh mục cha:</label>
                                                <select name="parent_id" class="form-control" id="parent_id">
                                                    <option value="0">--- Chọn danh mục cha--</option>
                                                    {!! $htmlOpition !!}
                                                </select>
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
                                <div id="tab_info_en" class="tab-pane fade in @if($tab_current == "info_en") active @endif ">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label for="name">Name:</label>
                                                <input value="{{ old("name_ko", @$item['name_ko'] )  }}" name="name_ko" type="text" class="form-control" id="name">
                                            </div>
                                            <div class="form-group">
                                                <label for="description">Description:</label>
                                                <textarea name="description_ko" id="ck_description_en" rows="10" cols="80">{{ old("description_ko", @$item['description_ko'])  }}</textarea>
                                                <script>
                                                    // Replace the <textarea id="editor1"> with a CKEditor 4
                                                    // instance, using default configuration.
                                                    CKEDITOR.replace( "ck_description_en",options );
                                                </script>
                                            </div>

                                        </div>

                                    </div>
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



