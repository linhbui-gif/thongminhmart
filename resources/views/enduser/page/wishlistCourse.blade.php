@extends("enduser.layout")

@section('content')

    @include("enduser.partials.breadcrumb",[ 'mainpage' => "Trang chủ",'name' => 'Danh sách yêu thích'])
    @include("enduser.components.banner_course")

    <section class="section section-product">
        <section class="section section-product">
            <div class="container">
                <div class="section-header d-flex align-items-center justify-content-between">
                    <h2 class="d-flex align-items-center"> <img src="{{ asset('/images/assets/icons/icon-book.svg') }}" alt="">Khóa học yêu thích
                    </h2>
                    <div class="sort-group d-flex align-items-center">
{{--                        <label>Lọc</label>--}}
{{--                        <select class="custom-select" style="min-width: 120px;">--}}
{{--                            <option value="#">Mặc định</option>--}}
{{--                            <option value="#">A - Z</option>--}}
{{--                            <option value="#">Z - A</option>--}}
{{--                            <option value="#">Cao nhất</option>--}}
{{--                            <option value="#">Thấp nhất</option>--}}
{{--                        </select>--}}
                        {{--                       <select class="custom-select">--}}
                        {{--                           <option value="#">Danh mục </option>--}}
                        {{--                           <option value="#">Danh mục 1</option>--}}
                        {{--                           <option value="#">Danh mục 2</option>--}}
                        {{--                           <option value="#">Danh mục 3</option>--}}
                        {{--                           <option value="#">Danh mục 4</option>--}}
                        {{--                       </select>--}}
                    </div>
                </div>
                <div class="section-main">
                    <div class="row">
                        @if(!empty($data))
                            @if(count($data))
                                @foreach($data as $k => $course)
                                    @include("enduser.partials.item_loop_course", [ 'item' => $course,'class' => 'col-product' ])
                                @endforeach
                            @else
                                <div class="col-md-12">
                                    <p>Chưa có sản phẩm yêu thích nào</p>
                                </div>

                            @endif

                        @else
                            <div class="col-md-12">
                                <p>Chưa có sản phẩm yêu thích nào</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </section>

{{--        <div class="pagination-wrapper d-flex justify-content-center align-items-center flex-wrap">--}}
{{--            <div class="pagination-item arrow-left">&lt;</div>--}}
{{--            <div class="pagination-item active">1</div>--}}
{{--            <div class="pagination-item">2</div>--}}
{{--            <div class="pagination-item">3</div>--}}
{{--            <div class="pagination-item arrow-right">&gt;</div>--}}
{{--        </div>--}}
    </section>

@stop
