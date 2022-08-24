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
                            @if(!empty($products))
                                @foreach($products as $v)
                                    <div class="ProductList-list-item">
                                        <div class="ProductBox">
                                            <div class="ProductBox-image">
                                                <div class="ProductBox-image-wrapper"><img src="{{$v->url_picture}}" alt="">
                                                    {{--                    <canvas class="ProductBox-thumbnail-video active"></canvas>--}}
                                                    <video class="ProductBox-video desktop" data-link="{{route('product.productDetail',['category'=>$v->slug])}}" data-src="{{asset('storage/video-intro/'.$v->video_link)}}" muted="muted" loop="loop" playsinline="playsinline"></video>
                                                    <div class="ProductBox-video-loading">  <img src="{{ asset('enduser/thongminhmart/assets/icons/icon-spinner.svg') }}" alt=""></div>
                                                </div>
                                            </div>
                                            <div class="ProductBox-info"><a class="ProductBox-title" href="{{route('product.productDetail',['category'=>$v->slug])}}">{{$v->name}}</a>
                                                <div class="ProductBox-price">
                                                    <del>{{number_format($v->price_base)}} đ</del><span>{{number_format($v->price_final)}} đ</span>
                                                    <a class="ProductBox-cart" href="{{route('product.productDetail',['category'=>$v->slug]) . "?cart=true"}}"><svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M13.1119 4.04381L11.8825 8.96219C11.7849 9.35244 11.4358 9.625 11.0333 9.625H3.45187C3.00781 9.625 2.63419 9.2925 2.583 8.8515L1.69706 1.75H1.09375C0.731063 1.75 0.4375 1.45644 0.4375 1.09375C0.4375 0.731063 0.731063 0.4375 1.09375 0.4375H2.26931C2.59744 0.4375 2.87481 0.679875 2.91944 1.0045L3.26156 3.5H12.6875C12.9719 3.5 13.181 3.76775 13.1119 4.04381Z" fill="white"/><path d="M3.0625 11.8125C3.0625 12.5361 3.65137 13.125 4.375 13.125C5.09862 13.125 5.6875 12.5361 5.6875 11.8125C5.6875 11.0889 5.09862 10.5 4.375 10.5C3.65137 10.5 3.0625 11.0889 3.0625 11.8125Z" fill="white"/><path d="M10.9375 11.8125C10.9375 11.0889 10.3486 10.5 9.625 10.5C8.90137 10.5 8.3125 11.0889 8.3125 11.8125C8.3125 12.5361 8.90137 13.125 9.625 13.125C10.3486 13.125 10.9375 12.5361 10.9375 11.8125Z" fill="white"/></svg></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
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
