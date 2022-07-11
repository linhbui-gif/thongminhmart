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
                            <li @if($tab_current == "seo") class="active" @endif><a data-toggle="tab" href="#seo_tab">Meta</a></li>
                            <li @if($tab_current == "ketqua") class="active" @endif><a data-toggle="tab" href="#ketqua_tab">Kết quả</a></li>
                            <li @if($tab_current == "hoclieu") class="active" @endif><a data-toggle="tab" href="#hoclieu_tab">Học liệu</a></li>
                            <li @if($tab_current == "giangvien") class="active" @endif><a data-toggle="tab" href="#giangvien_tab">Giảng viên</a></li>
                            @if(isset($item['id']))
                                <li @if($tab_current == "hoccu_tab") class="active" @endif><a data-toggle="tab" href="#hoccu_tab">Quản lý học cụ</a></li>
                                <li @if($tab_current == "giaotrinh") class="active" @endif><a data-toggle="tab" href="#giaotrinh">Giáo trình</a></li>
                            @endif
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
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="price_base">Price base:</label>
                                                    <input value="{{ old("price_base", @$item['price_base'] )  }}" name="price_base" type="text" class="form-control" id="price_base">
                                                </div>
                                            </div>
{{--                                            <div class="col-md-6">--}}
{{--                                                <div class="form-group">--}}
{{--                                                    <label for="price_base">Price final:</label>--}}
{{--                                                    <input value="{{ old("price_final", @$item['price_final'] )  }}" name="price_final" type="text" class="form-control" id="price_final">--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
                                        </div>
{{--                                        <div class="form-group">--}}
{{--                                            <label for="short_description">Short Description:</label>--}}
{{--                                            <textarea class="form-control" name="short_description" id="short_description" rows="4" cols="80">{{ old("short_description", @$item['short_description'])  }}</textarea>--}}
{{--                                        </div>--}}
                                        <div class="form-group">
                                            <label for="short_description">Short Description:</label>
                                            <textarea name="short_description" id="ck_short_description_course" rows="10" cols="80">{{ old("short_description", @$item['short_description'])  }}</textarea>
                                            <script>
                                                // Replace the <textarea id="editor1"> with a CKEditor 4
                                                // instance, using default configuration.
                                                CKEDITOR.replace( "ck_short_description_course" );
                                            </script>
                                        </div>
                                        <div class="form-group">
                                            <label for="content">Thông tin chung
                                                :</label>
                                            <textarea name="content" id="ck_content_course" rows="10" cols="80">{{ old("content", @$item['content'])  }}</textarea>
                                            <script>
                                                // Replace the <textarea id="editor1"> with a CKEditor 4
                                                // instance, using default configuration.
                                                CKEDITOR.replace( "ck_content_course" );
                                            </script>
                                        </div>

                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Status:</label>
                                            <div class="checkbox">
                                                <label><input @if(old('status',@$item['status'] ) == "active") checked @endif name="status" value="active" class="minimal" type="checkbox"> Active</label>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Hot:</label>
                                            <div class="checkbox">
                                                <label><input @if(old('hot',@$item['hot'] ) == "yes") checked @endif name="hot" value="yes" class="minimal" type="checkbox"> Hot</label>
                                            </div>
                                        </div>
                                        @php
                                            $categories = \App\Course_category::select("id","name")->orderBy('name','asc')->get();
                                        @endphp
                                        <div class="form-group">
                                            <label for="category_id">Chọn danh mục:</label>
                                            <select name="category_id" class="form-control" id="category_id">
                                                <option value="default">--- Chọn danh mục --</option>
                                                @foreach($categories as $k => $category)
                                                    @php
                                                        $checked = "";
                                                        if($category['id'] == @$item->category_id){
                                                            $checked = "selected";
                                                        }
                                                    @endphp
                                                    <option {{ $checked }} value="{{ $category['id'] }}">{{ $category['name'] }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group file_picture">
                                            <label for="picture">Picture:</label>
                                            <input name="picture" type="file" class="form-control file_picture_one" id="picture">
                                            @if(isset($item) && isset($item['picture']))
                                                <p><img class="image_preview" width="300" src="{{  $item->getImage() }}" alt=""></p>
                                            @endif
                                        </div>
                                        <div class="form-group file_picture gallery_course">
                                            <label for="gallery">Gallery:</label>
                                            <input multiple name="gallery[]" type="file" class="form-control picture_multi" id="gallery">
                                            <div class="multi_preview_image">
                                                @if(isset($item) && isset($item['gallery']) )
                                                    @php
                                                        $arrImage = json_decode($item['gallery']);
                                                    @endphp
                                                    @foreach($arrImage as $k => $file_name)
                                                        <img class="avatar_preview" style="max-width: 100px" src="{{  \App\Helper\Common::showThumb($folderUpload, $file_name ) }}" alt="">
                                                    @endforeach

                                                @endif
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div id="seo_tab" class="tab-pane fade in @if($tab_current == "seo") active @endif ">
                                @include("admin.partials.meta_seo")
                            </div>
                                <div id="ketqua_tab" class="tab-pane fade in @if($tab_current == "ketqua") active @endif ">
                                    <div class="form-group">
                                        <label for="content">Kết quả :</label>
                                        <textarea name="result" id="ck_content_ketqua" rows="10" cols="80">{{ old("result", @$item['result'])  }}</textarea>
                                        <script>
                                            CKEDITOR.replace( "ck_content_ketqua" );
                                        </script>
                                    </div>
                                </div>
                                <div id="hoclieu_tab" class="tab-pane fade in @if($tab_current == "hoclieu") active @endif ">
                                    <div class="form-group">
                                        <label for="content">Học liệu :</label>
                                        <textarea name="hoclieu" id="ck_content_hoclieu" rows="10" cols="80">{{ old("hoclieu", @$item['hoclieu'])  }}</textarea>
                                        <script>
                                            CKEDITOR.replace( "ck_content_hoclieu" );
                                        </script>
                                    </div>
                                </div>
                                <div id="giangvien_tab" class="tab-pane fade in @if($tab_current == "giangvien") active @endif ">
                                    <div class="form-group">
                                        <label for="content">Giảng viên :</label>
                                        <textarea name="giangvien" id="ck_content_giangvien" rows="10" cols="80">{{ old("giangvien", @$item['giangvien'])  }}</textarea>
                                        <script>
                                            CKEDITOR.replace( "ck_content_giangvien" );
                                        </script>
                                    </div>
                                </div>
                                <div id="chapter" class="tab-pane fade in @if($tab_current == "chapter") active @endif ">
                                    <div class="content_wrapper_chapter">

                                    </div>
                                </div>
                            </form>
                            @if(isset($item['id']))
                            <div id="giaotrinh" class="tab-pane fade in @if($tab_current == "giaotrinh") active @endif ">
                                <div class="content_wrapper_giaotrinh">
                                    {!! Menu::render($item['id']) !!}
                                </div>
                            </div>
                                <div id="hoccu_tab" class="tab-pane fade in @if($tab_current == "hoccu_tab") active @endif ">
                                   <div class="row">
                                       <div class="col-md-4">
                                           <div class="group_form_add">
                                               <div class="list_item">
                                                   <h4>Danh sách các compo</h4>
                                                   @php
                                                       $compos = $item->compos;
                                                   @endphp
                                                   <table class="table table-bordered">
                                                       <thead>
                                                       <tr>

                                                           <th>Tên</th>
                                                           <th>Giá</th>
                                                           <td></td>
                                                       </tr>
                                                       </thead>
                                                       <tbody>
                                                       @if(count($compos) > 0)
                                                           @foreach($compos as $k => $compo)
                                                               <tr class="row-{{ $compo->id }}">

                                                                   <td class="compo_name" data-value="{{ $compo->name }}">{{ $compo->name }}</td>
                                                                   <td class="compo_price" data-value="{{ $compo->price }}">{{ number_format($compo->price) }} VNĐ</td>
                                                                   <td>
                                                                       <span onclick="showEdit('{{ $compo->name }}', '{{ $compo->price }}', '{{ $compo->id }}')" class="btn btn-sm btn-info">Edit</span>
                                                                       <a class="btn btn-sm btn-danger" href="javascript:confirmDelete('{{ route('admin.compo.delete', [ 'id' => $compo->id ] ) }}?tab_current=hoccu_tab')">Xóa</a>
                                                                        <a href="?compo_id={{ $compo->id }}&tab_current=hoccu_tab" class="btn btn-sm btn-info">Show</a>
                                                                   </td>
                                                               </tr>
                                                           @endforeach
                                                       @else
                                                           <tr>
                                                               <td colspan="10">Không có dữ liệu</td>
                                                           </tr>
                                                       @endif

                                                       </tbody>
                                                   </table>
                                               </div>
                                               <div class="text-center">
                                                   <span onclick="resetCreate()" data-toggle="collapse" data-target="#form_add_product" class="btn btn-success"><i class="fa    fa-plus-circle"></i></span>
                                               </div>
                                               <form id="form_add_product" action="{{ route('admin.compo.store') }}" method="POST" class="collapse">
                                                   @csrf
                                                   <div class="form-group">
                                                       <label for="">Tên gói</label>
                                                       <input class="form-control" type="text" name="name">
                                                   </div>
                                                   <div class="form-group">
                                                       <label for="">Giá</label>
                                                       <input class="form-control" type="text" name="price">
                                                   </div>
                                                   <div class="form-group">
                                                       <button type="submit" class="btn btn-success">Lưu</button>
                                                       <button type="button" onclick="resetCreate()" class="btn btn-danger">Hủy</button>
                                                   </div>
                                                   <input type="hidden" name="product_id" value="{{ $item['id'] }}">
                                                   <input type="hidden" name="tab_current" value="hoccu_tab">
                                               </form>
                                           </div>


                                       </div>
                                       <div class="col-md-4">
                                           @php
                                               $id_compo = isset($_GET['compo_id']) ? $_GET['compo_id'] : 0;
                                               $compo = \App\Compo::find($id_compo);
                                           @endphp
                                           <h4>{{ @$compo->name }}</h4>
                                           @if($compo)
                                               @php
                                                   $p_in_compo = $compo->products;
                                               @endphp
                                                @if(count($p_in_compo) > 0)
                                               @foreach($p_in_compo as $k => $item_product)
                                                   <div class="box_item">
                                                       <div class="img_left">
                                                           <img src="{{ $item_product->getImage() }}" alt="">
                                                       </div>
                                                       <div class="c_right">
                                                           <p class="name_product">
                                                               {{ $item_product->name }}
                                                           </p>
                                                           <p class="price_product">
                                                               <span>{{ number_format($item_product->price_base) }} VNĐ</span>
                                                           </p>
                                                           <div class="add_box">
                                                               <form action="{{ route('admin.compo.deleteItemInCompo') }}" method="get">

                                                                   <button type="submit" class="btn btn-danger btn-sm">Remove</button>
                                                                   <input type="hidden" value="{{ $_GET['compo_id'] }}" name="compo_id">
                                                                   <input type="hidden" value="{{ $item_product->id }}" name="product_id">
                                                                   <input type="hidden" value="hoccu_tab" name="tab_current">
                                                               </form>
                                                           </div>
                                                       </div>
                                                   </div>
                                               @endforeach
                                               @else
                                                    <p>Hãy thêm sản phẩm vào đây</p>
                                               @endif
                                           @else
                                               <p>Hãy chọn compo</p>
                                           @endif

                                       </div>
                                       <div class="col-md-4">
                                           <h4>Các sản phẩm hiện tại</h4>
                                           <div id="content_item">
                                               @foreach($products as $k => $item_product)
                                                   <div class="box_item">
                                                       <div class="img_left">
                                                           <img src="{{ $item_product->getImage() }}" alt="">
                                                       </div>
                                                       <div class="c_right">
                                                           <p class="name_product">
                                                               {{ $item_product->name }}
                                                           </p>
                                                           <p class="price_product">
                                                               <span>{{ number_format($item_product->price_base) }}VNĐ</span>
                                                           </p>
                                                           <div class="add_box">
                                                               <form action="{{ route('admin.compo.addToCompo') }}" method="POST">
                                                                   @csrf
                                                                   <input name="quantity" class="form-control" type="number" value="0">
                                                                   <button type="submit" class="btn btn-success btn-sm">Add</button>
                                                                   <input type="hidden" value="{{ @$_GET['compo_id'] }}" name="compo_id">
                                                                   <input type="hidden" value="{{ $item_product->id }}" name="product_id">
                                                                   <input type="hidden" value="hoccu_tab" name="tab_current">

                                                               </form>
                                                           </div>
                                                       </div>
                                                   </div>
                                               @endforeach
                                               {!! $products->appends(['tab_current' => 'item_tab'])->links() !!}
                                           </div>
                                       </div>
                                   </div>
                                </div>
                            @endif
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
@stop


