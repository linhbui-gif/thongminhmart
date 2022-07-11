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
            <form action="{{ route('admin.'.$controllerName.'.updatePassword', [ 'id' => $item['id'] ]  ) }}" method="POST" enctype="multipart/form-data">
                @csrf
            <div class="box box-primary">
                <div class="box-body">
                    @include("admin.template.error")
                    <div class="edu_tab">
                        @php
                            $keyActive = "general_tab";
                        @endphp
                        <ul class="nav nav-tabs tab_header">
                            <li class="active"><a data-toggle="tab" href="#frmChangePassword">Change Password</a></li>
                        </ul>
                        <div class="tab-content">
                            <div id="frmChangePassword" class="tab-pane fade in active">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="pwd">Password:</label>
                                            <input name="password" type="password" class="form-control" id="pwd">
                                        </div>
                                        <div class="form-group">
                                            <label for="pwd">Re-Password:</label>
                                            <input name="password_confirmation" type="password" class="form-control" id="pwd">
                                        </div>
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
                            <a href="{{ route('admin.' . $controllerName . ".index") }}" class="el-button el-button--default"><span>Cancel </span></a>
                        </div>
                    </div>
                </div>

            </div>
            </form>
        </div>
    </div>
@stop



