@extends("enduser.layout")

@section('meta')
    @include("enduser.meta",[
        'title' => $category->meta_title,
        'description' => $category->meta_description,
        'link' => route('product.productListByCategory',  [ 'slug_category' => $category->slug ] ),
        'img' => asset('images/products_category/' . $category->picture)
    ])

@stop

@section('content')
    <?php
    $dataBreb = [
        [
            "name" => "Sản phẩm"
        ],
        [
            "name" => $category->name
        ]
    ];

    ?>
    {{--    @include("enduser.page.components.breb-crumb",['data' => $dataBreb])--}}
    <div class="Breadcrumb">
        <div class="container">
            <div class="Breadcrumb-wrapper">
                <div class="Breadcrumb-list flex flex-wrap"><a class="Breadcrumb-list-item" href="/">Trang chủ</a>
                    <div class="Breadcrumb-list-item arrow">
                        <svg width="9" height="14" viewBox="0 0 9 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M1 1L7 7L1 13" stroke="#777777" stroke-width="1.5" stroke-linecap="round"/>
                        </svg>
                    </div>
                    <a class="Breadcrumb-list-item" href="#">Sản phẩm theo danh mục</a>
                    <div class="Breadcrumb-list-item arrow">
                        <svg width="9" height="14" viewBox="0 0 9 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M1 1L7 7L1 13" stroke="#777777" stroke-width="1.5" stroke-linecap="round"/>
                        </svg>
                    </div>
                    <a class="Breadcrumb-list-item" href="#">{{$category->name}}</a>
                </div>
            </div>
        </div>
    </div>
    <div class="ProductList">
        <div class="container">
            <div class="ProductCategory-wrapper">
                <div class="Card">
                    <div class="Card-header flex items-center justify-between">
                        <div class="Card-header-title">{{$category->name}}</div>
                    </div>
                    <div class="Card-body">
                        <div class="ProductList-list flex flex-wrap">
                            @include('enduser.page.components.product-items', ['data' => $products])
                        </div>
                        <div class="ProductList-loadmore">
                            <div class="Button outline-primary middle">
                                <button class="Button-control flex items-center justify-center" type="button"><span
                                        class="Button-control-title">Xem thêm</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
