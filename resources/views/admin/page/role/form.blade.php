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
                            <li><a data-toggle="tab" href="#permission">Permission</a></li>
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
                                <div id="permission" class="tab-pane fade in">
                                    <div class="row">
                                        <div class="col-md-12">
                                            @php
                                                $permissions = config("permission");
                                                $permissionsModel = [];
                                                if($item){
                                                    $permissionsModel = json_decode($item->permissions,true);
                                                }
                                            @endphp
                                            <div class="permission_c">
                                                @foreach($permissions as $k => $per)
                                                    <h3>{{ $k }}</h3>
                                                    @foreach($per as $a => $name)
                                                        @php
                                                            $strAction = $k . "." . $a;
                                                            $flag = true;
                                                            if(!isset($permissionsModel[$strAction])){
                                                                $flag = false;
                                                            }
                                                        @endphp
                                                        <div class="row">
                                                            <div class="col-md-3 text-right"><label>{{ $name }}</label></div>
                                                            <div class="col-md-9">
                                                                <div role="radiogroup" class="el-radio-group">
                                                                    <label role="radio" tabindex="-1" class="el-radio-button">
                                                                        <input @if(!$flag)  checked @endif @if(@$permissionsModel[$strAction] == true) checked @endif name="permission[{{ $k }}][{{$a}}]" type="radio" tabindex="-1" class="el-radio-button__orig-radio" value="1" /><span class="el-radio-button__inner">Allow</span>
                                                                    </label>
                                                                    <label role="radio" tabindex="0" class="el-radio-button is-disabled" aria-checked="true">
                                                                        <input disabled="disabled" name="permission[{{ $k }}][{{$a}}]" type="radio" tabindex="-1" class="el-radio-button__orig-radio" value="0" /><span class="el-radio-button__inner">Inherit from role</span>
                                                                    </label>
                                                                    <label role="radio" tabindex="-1" class="el-radio-button">
                                                                        <input @if($flag && $permissionsModel[$strAction] == false) checked @endif name="permission[{{ $k }}][{{$a}}]" type="radio" tabindex="-1" class="el-radio-button__orig-radio" value="-1" /><span class="el-radio-button__inner">Deny</span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        </div>
                    </div>
                </div>
                @include("admin.template.action_form")
            </div>
            </form>
        </div>
    </div>
@stop



