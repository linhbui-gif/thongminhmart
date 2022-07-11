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
                    <div class="row">
                        <div class="col-md-12">
                            <h4>Học viên: {{ $customer->fullName() }}</h4>
                            <h4>Email: {{ $customer->email }}</h4>
                            <h4>Phone: {{ $customer->phone }}</h4>
                        </div>
                        <hr>
                        @if(count($items) > 0)
                        @foreach($items as $k => $item)
                        <div class="col-md-3">
                            <div class="panel panel-default">
                                <div class="panel-body">
                                    <div class="thumbnail">
                                        <img style="max-width: 100%" src="{{ $item->url_picture }}" alt="">
                                    </div>
                                    <div class="name">
                                        <a href="#">{{ $item->name }}</a>
                                    </div>
                                </div>
                                <div class="panel-footer">
                                    <a onclick="deleteNotify('{{ route('admin.customer.removeCourse', [ 'id_customer' => $customer->id, 'id_course' => $item->id ]) }}')" href="javascript:void(0)" class="btn btn-danger">Remove</a>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        @else
                            <div class="col-md-12">
                                <h4>Không có khóa học nào</h4>
                            </div>
                        @endif
                    </div>
                </div>
                <input type="hidden" name="search_type" value="{{ isset($params['search_type']) ?  $params['search_type'] : "all" }}">
            </div>
        </div>
    </div>
@stop

@section('script')
    <script>
        function deleteNotify(link){
            if(confirm('Bạn chắc chắn muốn xóa')){
                window.location.href = link;
            }
        }

    </script>

@stop
