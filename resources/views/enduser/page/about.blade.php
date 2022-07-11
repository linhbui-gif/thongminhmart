@extends("enduser.layout")

@section('meta')

    @include("enduser.meta",[
    'title' => $_config->meta_title,
    'description' => $_config->meta_description,
    'link' => route('siteAbout'),
    'img' => asset('images/config/' . $_config->picture)
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
@section('content')

    @php
        $banner = \App\Banner::where('type',0)->where('status','active')->where('location','banner_home')->orderBy('id','desc')->first();
         $bannerAbout = \App\Banner::where('type',0)->where('status','active')->where('location','banner_about')->orderBy('id','desc')->first();
 $galleries = json_decode($bannerAbout->gallery,true);
         $widgets = \App\Widget::where('location', 'timeline')->orderBy('order_no','desc')->get();
    @endphp
    <!-- Hero image starts here -->
    <section class="hero-about">
        <div class="container-fluid">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="hero-text">
                            <h5>{{@$page_content['page_about']['name']}}</h5>
                            <p>{{@$page_content['page_about']['description']}}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Hero image ends here -->
    <!--testimonial section start-->
    <section class="testimonial_section mt-5 pt-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <div class="title">
                        <h2>{{$bannerAbout->name}}</h2>
                    </div>
                    <p>  {!! $bannerAbout->description !!}</p>
                </div>

                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    @if(!empty($galleries))
                        @foreach($galleries as $k => $v)
                            <img class="img-fluid mb-3" src="{{$v}}" alt="">
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
{{--        <div class="container">--}}
{{--            <div class="row">--}}
{{--                <div class="col-lg-6 col-md-6 pt-5">--}}
{{--                    <div class="about-point">--}}
{{--                        <img src="{{asset('enduser/aliga/images/about_icon_1.svg')}}" alt="">--}}
{{--                        <h6>Luxury Yachts</h6>--}}
{{--                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore adipiscing elit dolore magna aliqua. Ut enim ad minim veniam.</p>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="col-lg-6 col-md-6 pt-5">--}}
{{--                    <div class="about-point">--}}
{{--                        <img src="{{asset('enduser/aliga/images/about_icon_2.svg')}}" alt="">--}}
{{--                        <h6>Experienced Team</h6>--}}
{{--                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore adipiscing elit dolore magna aliqua. Ut enim ad minim veniam.</p>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="col-lg-6 col-md-6 pt-5">--}}
{{--                    <div class="about-point">--}}
{{--                        <img src="{{asset('enduser/aliga/images/about_icon_3.svg')}}" alt="">--}}
{{--                        <h6>Quick Service</h6>--}}
{{--                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore adipiscing elit dolore magna aliqua. Ut enim ad minim veniam.</p>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="col-lg-6 col-md-6 pt-5">--}}
{{--                    <div class="about-point">--}}
{{--                        <img src="{{asset('enduser/aliga/images/about_icon_4.svg')}}" alt="">--}}
{{--                        <h6>Best Destinations</h6>--}}
{{--                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore adipiscing elit dolore magna aliqua. Ut enim ad minim veniam.</p>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
    </section>
    <!-- Yacht tab start here -->
    <!-- Number starts here -->
{{--    <section>--}}
{{--        <div class="container-fluid number-bg">--}}
{{--            <div class="container">--}}
{{--                <div class="row">--}}
{{--                    <div class="col-lg-3 col-md-6 col-sm-6">--}}
{{--                        <div class="number-single">--}}
{{--                            <img src="{{asset('enduser/aliga/images/number_img_1.png')}}" class="img-fluid" alt="">--}}
{{--                            <h1>1200+</h1>--}}
{{--                            <p>Our Customer</p>--}}
{{--                        </div>--}}
{{--                    </div>--}}

{{--                    <div class="col-lg-3 col-md-6 col-sm-6">--}}
{{--                        <div class="number-single">--}}
{{--                            <img src="{{asset('enduser/aliga/images/number_img_2.png')}}" class="img-fluid" alt="">--}}
{{--                            <h1>51</h1>--}}
{{--                            <p>Total Yachts</p>--}}
{{--                        </div>--}}
{{--                    </div>--}}

{{--                    <div class="col-lg-3 col-md-6 col-sm-6">--}}
{{--                        <div class="number-single">--}}
{{--                            <img src="{{asset('enduser/aliga/images/number_img_3.png')}}" class="img-fluid" alt="">--}}
{{--                            <h1>69</h1>--}}
{{--                            <p>Our Locations</p>--}}
{{--                        </div>--}}
{{--                    </div>--}}

{{--                    <div class="col-lg-3 col-md-6 col-sm-6">--}}
{{--                        <div class="number-single">--}}
{{--                            <img src="{{asset('enduser/aliga/images/number_img_4.png')}}" class="img-fluid" alt="">--}}
{{--                            <h1>1800+</h1>--}}
{{--                            <p>Total Tours</p>--}}
{{--                        </div>--}}
{{--                    </div>--}}

{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </section>--}}
    <!-- Number ends here -->

    <!-- Image Gallery starts here -->
    <?php
    $product = \App\Product_products::where('status','active')->first();
    $galleries = json_decode($product->gallery,true);
    ?>
    <section>
        <div class="container">
            <div class="row">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12 text-center">
                            <div class="title">
                                <h2>{{$product->name}}</h2>
                            </div>
                        </div>
                    </div>
                </div>

                @foreach($galleries as $k => $ga)
                    <div class="col-lg-3 col-md-6 col-sm-6 gall-img">
                        <a class="moto" href="{{ $ga }}">
                            <img class="img-fluid" src="{{ $ga }}" alt="">
                            <div class="zoom"><img src="{{asset('enduser/aliga/images/icon_zoom.svg')}}" alt=""></div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    @php
        $bannerPartner = \App\Banner::where('type',0)->where('status','active')->where('location','banner_partner')->orderBy('order_no','asc')->get();
    @endphp
    <section class="mar-bot">
        <div class="container">
            <div class="row">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12 text-center">
                            <div class="title">
                                <h2>{{@$page_content['partner']['name']}}</h2>
                            </div>
                        </div>
                    </div>
                </div>
                @foreach($bannerPartner as $k => $v)
                    <div class="col-lg-3 col-md-6 col-sm-6 client-single">
                        {{--                    <img class="img-fluid" src="{{asset('enduser/aliga/images/client_1.jpg')}}" alt="">--}}
                        <img class="img-fluid" src="{{$v->picture}}" alt="">
                    </div>
                @endforeach


            </div>
        </div>
    </section>
@stop
