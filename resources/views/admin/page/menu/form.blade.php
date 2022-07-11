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
                            @foreach($formFields as $k => $tab)
                            <li @if($k == $keyActive) class="active" @endif><a data-toggle="tab" href="#{{ $k }}">{{ $tab['label_tab'] }}</a></li>
                            @endforeach
                        </ul>
                        <div class="tab-content">
                            @foreach($formFields as $k => $tab)
                                <div id="{{ $k }}" class="tab-pane fade in @if($k == $keyActive) active @endif">
                                    <div class="row">
                                        <div class="col-md-12">
                                            @php
                                                if(@$item['id']){
                                                    foreach($tab['items'] as $k => $i){
                                                        if(in_array($i['name'], [ 'password','password_confirmation' ] )){
                                                            unset($tab['items'][$k]);
                                                        }
                                                    }
                                                }
                                            @endphp
                                            {!! Form::show($tab['items'], $item) !!}
                                        </div>
                                    </div>
                                </div>
                            @endforeach
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
            </form>
        </div>
    </div>
@stop



