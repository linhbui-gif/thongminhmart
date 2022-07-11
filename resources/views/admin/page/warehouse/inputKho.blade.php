@php
    use App\Helper\Form;
 use App\Helper\NhanhService;
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
            {{--            <form action="{{ $link  }}" method="POST" enctype="multipart/form-data">--}}
            @csrf
            <div class="box box-primary">
                <div class="box-body">
                    @include("admin.template.error")
                    <div class="edu_tab">

                        <ul class="nav nav-tabs tab_header">
                            @php
                                $tab_current = request()->input('tab_current', 'info');
                            @endphp
                            <li @if($tab_current == "info") class="active" @endif><a data-toggle="tab" href="#tab_info">Thông tin</a></li>
                        </ul>
                        <div class="tab-content">
                            <form id="form_info" action="{{ route('admin.'.$controllerName.'.storeInput')  }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div id="tab_info" class="tab-pane fade in @if($tab_current == "info") active @endif ">
                                    <div class="row">
                                        <div class="col-md-8">
                                            @php

                                            @endphp
                                            <div class="form-group">
                                                <label for="">Sản phẩm:</label>
                                                <select class="form-control product_id" name="product_id">
                                                    <option value="default">-- Chọn sản phẩm --</option>
                                                    @foreach($products as $k => $item)
                                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <script>
                                                $(document).ready(function() {
                                                    $('.product_id').select2();
                                                });

                                            </script>
                                            <div class="form-group">
                                                <label for="">Kho:</label>
                                                <select class="form-control warehouse_id" name="warehouse_id">
                                                    <option value="default">-- Chọn kho --</option>
                                                    @foreach($warehouses as $k => $item)
                                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <script>
                                                $(document).ready(function() {
                                                    $('.warehouse_id').select2();
                                                });

                                            </script>
                                            <div class="form-group">
                                                <label for="">Số lượng:</label>
                                                <input value="{{ old("quantity", @$item['quantity'] )  }}" name="quantity" type="text" class="form-control" id="quantity">
                                            </div>
                                        </div>
                                        <div class="col-md-4">

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
                            <button type="button" onclick="submitForm('form_info')" class="el-button el-button--primary"><span>Save</span></button>
                            <a href="{{ route('admin.' . $controllerName . ".index") }}" class="el-button el-button--default"><span>Cancel </span></a>
                        </div>
                    </div>
                </div>
            </div>
            {{--            </form>--}}
        </div>
    </div>
@stop

@section('script')
    {!! Menu::scripts() !!}
    <script>
        $("#select_tinh").change(function(){
            var id_tinh = $(this).val();
            layHuyenTheoTinh(id_tinh)
        });

        function layHuyenTheoTinh(id_tinh){
            $("#select_quan").html('');
            $.ajax({
                url : '{{ route('ajax.getDistrict') }}?id_tinh=' + id_tinh,
                dataType:"html",
                success: function(data){
                    $("#select_quan").html(data);
                    $("#select_quan").change(function(){
                        var id_huyen = $(this).val();
                        layXaTheoHuyen(id_huyen);
                    });
                }
            });
        }
        function layXaTheoHuyen(id_huyen){
            $("#select_phuong").html('');
            $.ajax({
                url : '{{ route('ajax.getWard') }}?id_huyen=' + id_huyen,
                dataType:"html",
                success: function(data){
                    $("#select_phuong").html(data);
                }
            });
        }
        var product_id = 0;
        var warehouse_id = 0;
        $("select[name='product_id']").change(function(){
            product_id = $(this).val();
            getQuantity(product_id, warehouse_id);
        })
        $("select[name='warehouse_id']").change(function(){
            warehouse_id = $(this).val();
            getQuantity(product_id, warehouse_id);
        })
        function getQuantity(product_id, warehouse_id){
            $.ajax({
                url : '{{ route('admin.warehouse.getQuantity') }}',
                data : { product_id : product_id, warehouse_id : warehouse_id},
                dataType:"html",
                success: function(data){
                    $("input[name='quantity']").val(data);
                },
                error: function(){
                    $("input[name='quantity']").val(0);
                }
            });
        }
    </script>
@stop


