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
            "name" => @$category->name
        ]
    ];

    ?>
        @include("enduser.page.components.breb-crumb",['data' => $dataBreb])
    <div class="ProductList">
        <div class="container">
            <div class="ProductCategory-wrapper">
                <div class="Card">
                    <div class="Card-header flex items-center justify-between">
                        <div class="Card-header-title">{{@$category->name}}</div>
                    </div>
                    <div class="Card-body">
                        <div class="ProductList-list flex flex-wrap">
                            @include('enduser.page.components.product-items', ['data' => $products])
                        </div>
{{--                        <div class="ProductList-loadmore">--}}
{{--                            <div class="Button outline-primary middle">--}}
{{--                                <button class="Button-control flex items-center justify-center" type="button"><span--}}
{{--                                        class="Button-control-title">Xem thêm</span>--}}
{{--                                </button>--}}
{{--                            </div>--}}
{{--                        </div>--}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
