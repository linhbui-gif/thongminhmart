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
                            <form id="form_info" action="{{ $link  }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div id="tab_info" class="tab-pane fade in @if($tab_current == "info") active @endif ">
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label for="name">Name:</label>
                                            <input value="{{ old("name", @$item['name'] )  }}" name="name" type="text" class="form-control" id="name">
                                        </div>
                                        <div class="form-group">
                                            <label for="name">Contact name:</label>
                                            <input value="{{ old("contact_name", @$item['contact_name'] )  }}" name="contact_name" type="text" class="form-control" id="contact_name">
                                        </div>
                                        <div class="form-group">
                                            <label for="name">Phone:</label>
                                            <input value="{{ old("phone", @$item['phone'] )  }}" name="phone" type="text" class="form-control" id="phone">
                                        </div>
                                        <div class="form-group">
                                            <div class="form-item">
                                                @php

                                                     $provinces = \App\Province::orderBy('_name','asc')->get();
                                                @endphp
                                                <select name="province_id" class="@error('province_id') is-invalid @enderror custom-select form-control" id="select_tinh">
                                                    <option value="default">Chọn tỉnh</option>
                                                    @foreach($provinces as $k => $province)
                                                        <option value="{{ $province->id }}">{{ $province->_name }}</option>
                                                    @endforeach
                                                </select>
                                                <input type="hidden" name="CityName">
                                                <input type="hidden" name="DistrictName">
                                                <input type="hidden" name="WardName">
                                                @error('province_id')
                                                <div class="alert alert-danger  mt-2">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group half">
                                            <div class="form-item">
                                                <select name="district_id" class="@error('district_id') is-invalid @enderror custom-select form-control" id="select_quan">
                                                    <option value="default">Chọn Quận/Huyện</option>
                                                </select>
                                                @error('district_id')
                                                <div class="alert alert-danger  mt-2">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group half">
                                            <div class="form-item">
                                                <select name="ward_id" class="@error('ward_id') is-invalid @enderror custom-select form-control" id="select_phuong">
                                                    <option value="default">Chọn Phường/Xã</option>
                                                </select>
                                                @error('ward_id')
                                                <div class="alert alert-danger  mt-2">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="name">Địa chỉ:</label>
                                            <input value="{{ old("address", @$item['address'] )  }}" name="address" type="text" class="form-control" id="address">
                                        </div>
                                        @include('admin.template.form.status', [
 'item' => [
                                            'label' => 'Status',
                                            'name' => 'status'
                                        ]
])
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
            var selectedText = $("#select_tinh option:selected").text();
            $("input[name='CityName']").val(selectedText);
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
                        var selectedText = $("#select_quan option:selected").text();
                        $("input[name='DistrictName']").val(selectedText);
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
                    $("#select_phuong").change(function(){
                        var selectedText = $("#select_phuong option:selected").text();
                        $("input[name='WardName']").val(selectedText);
                    });
                }
            });
        }
    </script>
@stop


