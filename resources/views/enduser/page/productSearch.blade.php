@extends("enduser.layout")


@section('content')
    <?php
    $key = $_GET['keyword'];
    $dataBreb = [
        [
            "name" => "Tìm kiếm sản phẩm"
        ]
    ];

    ?>
    @include("enduser.page.components.breb-crumb",['data' => $dataBreb])
    <div class="ProductList">
        <div class="container">
            <div class="ProductCategory-wrapper">
                <div class="Card">
                    <div class="Card-header ">
                        @if($key !== "")
                        <div class="Card-header-title">Từ khóa : {{@$key}}</div>
                        @endif
                        <p style="font-size: 18px;margin-top: 15px;">Có <span style="color: red">{{count($products)}}</span> sản phẩm được tìm thấy</p>
                    </div>
                    <div class="Card-body">
                        <div class="ProductList-list flex flex-wrap">
                            @include('enduser.page.components.product-items', ['data' => $products])
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
