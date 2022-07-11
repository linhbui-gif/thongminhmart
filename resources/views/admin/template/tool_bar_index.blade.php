<div class="tool-bar">
    <div class="row">
        <div class="col-md-6">
            <a href="{{ route('admin.'.$controllerName.'.create') }}" class="">
                <button type="button" class="btn btn-primary">
                    <span><i class="el-icon-edit"></i> New</span>
                </button>
            </a>
            <a href="javascript:deleteMulti()" class="">
                <button type="button" class="btn btn-danger">
                    <span><i class="fa fa-trash"></i> Delete</span>
                </button>
            </a>
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
