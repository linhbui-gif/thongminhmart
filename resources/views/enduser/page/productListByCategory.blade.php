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
    @include("enduser.page.components.breb-crumb",['data' => $dataBreb])
    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="section-title mb60">
                        <!-- section title start-->
                        <h2>{{$category->name}}</h2>
                    </div>
                    <!-- /.section title start-->
                </div>
            </div>
            <div class="row">
                @if($products->count() > 0)
                    @foreach($products as $product)
                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-12">
                    <div class="coaching-card">
                        <!-- coaching card -->
                        <div class="coaching-card-img zoomimg">
                            <a href="#"><img src="{{ @$product->url_picture }}" alt="" class="img-fluid w-100"></a>
                        </div>
                        <div class="coaching-card-body">
                            <h2 class="coaching-card-title"><a href="#" class="title htit">{{$product->name}}</a></h2>
                            <p class="an"> {!! $product->short_description !!}</p>
                            <a href="#" class="btn btn-default">Đọc Thêm</a>
                        </div>
                    </div>
                    <!-- /.coaching card -->
                </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>


@stop
