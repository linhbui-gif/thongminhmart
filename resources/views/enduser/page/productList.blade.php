@extends("enduser.layout")

@section('content')

    <div class="space-medium bg-light">
        <!-- News section -->
        <div class="container">
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="section-title mb60">
                        <!-- section title start-->
                        <h2>SẢN PHẨM CHÍNH</h2>
                    </div>
                    <!-- /.section title start-->
                </div>
            </div>

            <div class="row">

                @if(!empty($products))
                    @foreach($products as $v)
                        <div class=" col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12">
                            <div class="post-holder">
                                <div class="post-img zoomimg">
                                    <a href="#"><img src="{{$v->url_picture}}"
                                                     alt="{{$v->name}}"
                                                     class="img-fluid w-100"></a>
                                </div>
                                <div class="post-header">
                                    <h2 class="post-title"><a href="{{route('product.productDetail',['category'=>$v->slug])}}" class="title">{{$v->name}}</a></h2>
                                    <h2 class="post-title"><a href="{{route('product.productDetail',['category'=>$v->slug])}}" class="title">{{number_format($v->price_base)}} đ</a></h2>
                                    <p>{!! $v->short_description !!}</p>
                                </div>
                                <div class="post-content">
                                    {{$v->description}}
                                    <a href="{{ route('product.addCart', ['id' => $v->id]) }}" class="btn btn-default">Thêm vào giỏ hàng</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif

            </div>
        </div>
    </div>
@stop


@section('script')
    <script>

    </script>
@endsection
