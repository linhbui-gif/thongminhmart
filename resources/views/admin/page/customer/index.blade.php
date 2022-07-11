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
                    @include("admin.template.notify")
                    <form id="frmList" action="#" method="POST">
                        <div class="sc-table">
                            @include($pathView . "list")
                        </div>
                        @csrf
                    </form>
                    @include("admin.template.pagination", [ 'paginator' => $items ])
                </div>
                <input type="hidden" name="search_type">
            </div>
        </div>
    </div>
@stop



