@extends("admin.layout")


@section('content-header')
    @include("admin.partials.page-header")
@stop

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary">
                <div class="box-body">
                    @include("admin.template.error")

                    <div class="sc-table">
                        <div class="_c_main_menu">
                            {!! Menu::render() !!}
                        </div>

                    </div>

                </div>

            </div>
        </div>
    </div>
@stop

@section('script')
    {!! Menu::scripts() !!}
@stop
