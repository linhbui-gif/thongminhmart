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
                    <form id="frmList" action="{{ route('admin.' . $controllerName . ".multiDestroy" ) }}" method="POST">
                    <div class="sc-table">
                        <div class="tool-bar">
                            <div class="row">
                                <div class="col-md-6">

                                </div>
                                <div class="col-md-6">
                                    <div class="group-search text-right">
                                        <div class="dropdown box-search" style="display: inline-block">
                                            <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">
                                                {{ $params['search_list'][$params['search_type']] }}

                                                <span class="caret"></span></button>
                                            <ul class="dropdown-menu">
                                                @foreach($searchList as $k => $v)
                                                    <li><a onclick="changeSearch(this,'{{ $k }}', '{{ $v }}')" href="javascript:void(0)">{{ $v }}</a></li>
                                                @endforeach
                                            </ul>
                                        </div>
                                        <input value="{{ $params['search_value'] }}" name="search_value" placeholder="search..." style="width: initial; display: inline-block" type="text" rows="2"  class="form-control" />
                                        <a onclick="searchAction()" href="javascript:void(0)" class="btn btn-primary">Search</a>
                                        <a onclick="clearSearchAction()" href="javascript:void(0)" class="btn btn-default">Clear</a>
                                    </div>
                                </div>
                            </div>
                        </div>

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



