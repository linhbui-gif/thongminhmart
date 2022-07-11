@extends("enduser.layout")

@section('content')

    @include("enduser.partials.breadcrumb")

    <section class="section product-lists" style="padding-top: 0;">
        <div class="container">
            <form action="{{route('product.productList')}}" method="get">
                <div class="section-header d-flex align-items-center justify-content-between">
                    <div></div>
                    @csrf
                    <div class="table-header-action d-flex justify-content-between">
                        <div class="action-item d-flex align-items-center search w-100">
                            <input type="text" name="name" placeholder="Tìm kiếm câu hỏi ID, Title">
                            <button type="submit"><img src="{{asset("enduser/assets/icons/icon-search.svg")}}" alt=""></button>
                        </div>
                    </div>
                </div>
            </form>
            <div class="product-lists-wrapper">
                <div class="row">
                    <div class="col-lg-3">
                        <div class="product-lists-filter-wrapper">
                            @include("enduser.components.product_sidebar.category")
                            @include("enduser.components.product_sidebar.fillter_price")
                        </div>
                    </div>
                    <div class="col-lg-9">
                        <div class="section-main">

                            <section class="section section-product product-lists-carousel">
                                <div class="section-header d-flex align-items-center justify-content-between sm-column">
                                    <h2 class="d-flex align-items-center">{{ $tag->name }}</h2>
                                </div>
                                <div class="section-main">
                                    @if($products && count($products) > 0)
                                        <div class="owl-carousel custom-carousel-style arrow-two-side">
                                            @foreach($products as $k => $product)
                                                @include("enduser.partials.item_loop_product", [ 'product' => $product, 'class' => 'item' ])
                                            @endforeach
                                        </div>
                                    @else
                                        <p>Sản phẩm đang được cập nhật</p>
                                    @endif
                                </div>
                            </section>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="section section-product product">
        <div class="container">
            <div class="section-header d-flex align-items-center justify-content-between">
                <h2 class="d-flex align-items-center"> <img src="{{ asset("enduser/assets/icons/icon-book.svg") }}" alt="">Sản phẩm nổi bật</h2>
            </div>
            <div class="section-main">
                <div class="owl-carousel custom-carousel-style arrow-two-side">
                    @include("enduser.components.product_featured")
                </div>
            </div>
        </div>
    </section>
@stop
