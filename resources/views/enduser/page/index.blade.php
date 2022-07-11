@extends("enduser.layout")

@section('meta')

    @include("enduser.meta",[
    'title' => $_config->meta_title,
    'description' => $_config->meta_description,
    'link' => route('siteIndex'),
    'img' => asset('images/logo2.png')
    ])

@stop
@section('head')
    @php
        $locale = app()->getLocale();

        if($locale == "vi") {
            $page_content = unserialize($page->content);
        }
        else{
             $page_content = unserialize($page->content_ko);
        }
    @endphp
@stop
@php
    $banners = \App\Helper\Common::getFromCache('banner_home');
    if(!$banners) {
      $banners = \App\Banner::where('type',1)->where('status','active')->where('location','banner_home')->orderBy('order_no','asc')->get();
      \App\Helper\Common::putToCache('banner_home',$banners);
    }
    $productsBanner = \App\Product_products::where('status','active')->orderBy('order_no','asc')->get();
    if(!$productsBanner) {
      $productsBanner = \App\Product_products::where('status','active')->orderBy('order_no','asc')->get();
      \App\Helper\Common::putToCache('product_asc',$productsBanner);
    }
    $products= \App\Product_products::where('status','active')->orderBy('order_no','asc')->get();
    if(!$products) {
      $products = \App\Product_products::where('status','active')->orderBy('order_no','desc')->get();
      \App\Helper\Common::putToCache('product_main',$products);
    }
    $bannerTeam= \App\Banner::where('type',0)->where('status','active')->where('location','banner_team')->orderBy('order_no','asc')->get();
    $bannerPartner = \App\Banner::where('type',0)->where('status','active')->where('location','banner_partner')->orderBy('order_no','asc')->get();
    $postFeatures = \App\blog_posts::where('status','active')->orderBy('order_no','asc')->limit(6)->get();
@endphp
@section('content')
   @include('enduser.page.pages.home.slider',['nameCarousel' => "slider-carsoule", "data" => $banners ])
   <div class="container">
       <div class="space-medium">
           <div class="carousel ">
               <div class="owl-carousel carousel-2 owl-theme">
                   <!-- carousel-item -->
                   @include('enduser.page.components.product-hozizon',["data" => $productsBanner ])
                   <!-- /.carousel-item -->
               </div>
           </div>
       </div>
   </div>
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
               @include('enduser.page.components.product-items',["data" => $products ])
           </div>
       </div>
   </div>
   <div class="container">
       <div class="space-medium">
           <div class="row">
               <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                   <div class="section-title mb60">
                       <!-- section title start-->
                       <h2>SỰ KIỆN NỔI BẬT</h2>
                   </div>
                   <!-- /.section title start-->
               </div>
           </div>
           <div class="carousel ">
               <div class="owl-carousel carousel-1 owl-theme">
                   <!-- carousel-item -->
                   @if(!empty($postFeatures))
                       @foreach($postFeatures as $v)
                   <div class="item">
                       <div class="carousel-img">
                           <a href="{{route('new.newDetail',['slug'=>$v->slug])}}"><img src="{{$v->url_picture}}" alt="" class="img-fluid"></a>
                           <div class="overlay-category">
                               <p class="category-overlay-text text-center">
                                   {{$v->name}}
                               </p>
                           </div>
                       </div>
                   </div>
                   @endforeach
               @endif
                   <!-- /.carousel-item -->
               </div>
           </div>
       </div>
   </div>
   <div class="space-medium">
       <div class="container">
           <div class="row">
               <div class="offset-lg-2 col-lg-8 col-md-12 col-sm-12 col-xs-12">
                   <div class="section-title text-center mb60">
                       <!-- section title start-->
                       <h2>Khách hàng nói gì về chúng tôi?</h2>
                       <!-- /.section title start-->
                   </div>
               </div>
           </div>
           <div class="row">
               @if(!empty($bannerTeam))
               @foreach($bannerTeam as $k => $v)
               <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-12">
                   <div class="card-testimonial card-testimonial-light">
                       <!-- card testimonial start -->
                       <div class="card-testimonial-img"><img width="90px" height="90px"  src="{{$v->picture}}" alt="{{$v->name}}"
                                                              class="rounded-circle"></div>
                       <div class="card-testimonial-content">
                           <p class="card-testimonial-text">{!! $v->description !!}</p>
                       </div>
                       <div class="card-testimonial-info">
                           <h4 class="card-testimonial-name">{{$v->title}}</h4>
                       </div>
                   </div>
                   <!-- /.card testimonial start -->
               </div>
               @endforeach
               @endif
           </div>
       </div>
   </div>
   <div class="space-medium pdb0">
       <div class="container">
           <div class="row">
               <div class="col-xl-12">
                   <h2>ĐỐI TÁC NỔI BẬT</h2>
               </div>
               @foreach($bannerPartner as $k => $v)
               <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-6">
                   <div class="partner-logo">
                       <!-- partner logo -->
                       <img src="{{$v->picture}}"
                            alt="{{$v->name}}"
                            class="img-fluid grayscale">
                   </div>
                   <!-- /.partner logo -->
               </div>
               @endforeach
           </div>
       </div>
   </div>
@stop
