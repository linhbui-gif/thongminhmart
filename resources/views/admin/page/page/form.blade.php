
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
<style>
    img{
        width: 100%;
    }
</style>
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
                            <li class="active"><a data-toggle="tab" href="#thongtin">Thông tin chung</a></li>
{{--                            <li><a data-toggle="tab" href="#thongtin_en">Thông tin chung (Korera)</a></li>--}}
                            @foreach($formFields as $k => $tab)
                            <li><a data-toggle="tab" href="#{{ $k }}">{{ $tab['label_tab'] }}</a></li>
                            @endforeach
                        </ul>
                        <div class="tab-content">
                            @include("admin.page.page.page_vi")
{{--                            @include("admin.page.page.page_ko")--}}
                            @foreach($formFields as $k => $tab)
                                <div id="{{ $k }}" class="tab-pane fade in @if($k == $keyActive) active @endif">
                                    <div class="row">
                                        <div class="col-md-12">
                                            {!! Form::show($tab['items'], $item) !!}
                                            <div class="form-group file_picture">
                                                <label for="">Hình đại diện:</label>
                                                <input name="picture" type="file" class="form-control" id="">
                                                @if(isset($item) && is_object($item)  )
                                                    <p class="image_preview"><img src="{{  \App\Helper\Common::showThumb($folderUpload, $item->picture ) }}" alt=""></p>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                @include("admin.template.action_form")
            </div>
            </form>
        </div>
    </div>
@stop



