@extends("enduser.layout")

@section('meta')
    @include("enduser.meta",[
        'title' => $product->meta_title,
        'description' => $product->meta_description,
        'link' =>"",
        'img' => $product->url_picture
    ])

@stop

@section('content')
    <?php
    $dataBreb = [
        [
            "name" => "chi tiết sản phẩm"
        ],
        [
            "name" => $product->name
        ]
    ];

    ?>
    @include("enduser.page.components.breb-crumb",['data' => $dataBreb])
{{--    <div class="content details">--}}
{{--        <div class="container">--}}
{{--            <div class="row">--}}
{{--                <div class="col-xl-8 col-lg-8 col-md-12 col-sm-12 col-12">--}}
{{--                    <div class="details">--}}
{{--                        <h3 class="fz-1">{{$product->name}}</h3>--}}
{{--                        {!! $product->content !!}--}}
{{--                        <div class="plugin-btn d-flex mt-3">--}}
{{--                            <div class="fb-like mt" data-href="https://developers.facebook.com/docs/plugins/" data-width="" data-layout="button" data-action="like" data-size="small" data-share="true"></div>--}}
{{--                            <div class="socials-share ml-2">--}}
{{--                                <a class="bg-pinterest" href="" target="_blank"><span class="fa fa-pinterest"></span> Save</a>--}}
{{--                                <a class="bg-twitter" href="" target="_blank"><span class="fa fa-twitter"></span> Tweet</a>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <!-- /.coaching card -->--}}
{{--                </div>--}}
{{--                <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12">--}}
{{--                    <div class="details-left">--}}
{{--                        <h3 class="fz-1 bcf">BỒN COMPOSITE FRP</h3>--}}
{{--                        @if(!empty($productSameCategory))--}}
{{--                            @foreach($productSameCategory as $data)--}}
{{--                        <div class="details-left-ctn d-flex">--}}
{{--                            <div class="left-ctn-img">--}}
{{--                                <img src="{{$data->url_picture}}" alt="{{$data->name}}" class="ctn-img">--}}
{{--                            </div>--}}
{{--                            <a href="{{route('product.productDetail',['category'=>$data->slug])}}" class="ml-2 title-img fz mt-1">{{$data->name}})</a>--}}
{{--                        </div>--}}
{{--                            @endforeach--}}
{{--                        @endif--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
<?php
 $colors = \App\Color::where('status','active')->get();
 $sizes = \App\Size::where('status','active')->get();

?>
<div class="container">
    <div class="row">
        <div class="col-5">
            <img width="100%" src="{{$product->url_picture}}" alt="">
        </div>
        <div class="col-7">
            <h3>{{$product->name}}</h3>
            <p>{!! $product->short_description !!}</p>
            <p style="font-size: 30px"><b>{{number_format($product->price_final)}} đ</b></p>
            <div class="row">
                <div class="col-6">
                    <form action="{{route('product.addCart')}}" method="POST">
                        @csrf
                        <input type="hidden" name="product_id" value="{{$product->id}}">
                        <div class="form-group">
                            <select name="color_id" class="form-control">
                                <option value="">Select color</option>
                                @if(!empty($colors))
                                    @foreach($colors as $k => $v)
                                        <option value="{{$v->id}}">{{$v->name}}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="form-group">
                            <select name="size_id" class="form-control">
                                <option value="">Select size</option>
                                @if(!empty($sizes))
                                    @foreach($sizes as $k => $v)
                                        <option value="{{$v->id}}">{{$v->name}}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="form-group">
                            <input type="number" name="quantity" value="1" class="form-control" >
                        </div>
                        <button class="btn btn-default" type="submit">
                            Thêm vào giỏ hàng
                        </button>
{{--                        <a href="{{ route('product.addCart') }}" class="btn btn-default"></a>--}}
                    </form>
                </div>
                <div class="col-6">
                    List cart product
                    <ul id="list-cart-product"></ul>
                </div>
            </div>

        </div>
    </div>
</div>
@stop

@section('script')


@stop
