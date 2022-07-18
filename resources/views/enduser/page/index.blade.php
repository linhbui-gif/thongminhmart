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
<div class="ProductCategory">
    <div class="container">
        <div class="ProductCategory-wrapper">
            <div class="Card">
                <div class="Card-header flex items-center justify-between">
                    <div class="Card-header-title">Danh mục sản phẩm</div><a class="Card-header-see-more" href="danh-sach-san-pham.html">Xem thêm</a>
                </div>
                <div class="Card-body">
                    <div class="ProductCategory-list owl-carousel desktop" id="ProductCategory-carousel">
                        <div class="item">
                            <div class="ProductCategory-list-item">
                                <div class="ProductCategory-list-item-image"> <a href="#"> <img src="" alt=""></a></div><a class="ProductCategory-list-item-title" href="#">Phòng khách</a>
                            </div>
                        </div>
                        <div class="item">
                            <div class="ProductCategory-list-item">
                                <div class="ProductCategory-list-item-image"> <a href="#"> <img src="" alt=""></a></div><a class="ProductCategory-list-item-title" href="#">Phòng khách</a>
                            </div>
                        </div>
                        <div class="item">
                            <div class="ProductCategory-list-item">
                                <div class="ProductCategory-list-item-image"> <a href="#"> <img src="" alt=""></a></div><a class="ProductCategory-list-item-title" href="#">Phòng khách</a>
                            </div>
                        </div>
                        <div class="item">
                            <div class="ProductCategory-list-item">
                                <div class="ProductCategory-list-item-image"> <a href="#"> <img src="" alt=""></a></div><a class="ProductCategory-list-item-title" href="#">Phòng khách</a>
                            </div>
                        </div>
                        <div class="item">
                            <div class="ProductCategory-list-item">
                                <div class="ProductCategory-list-item-image"> <a href="#"> <img src="" alt=""></a></div><a class="ProductCategory-list-item-title" href="#">Phòng khách</a>
                            </div>
                        </div>
                        <div class="item">
                            <div class="ProductCategory-list-item">
                                <div class="ProductCategory-list-item-image"> <a href="#"> <img src="" alt=""></a></div><a class="ProductCategory-list-item-title" href="#">Phòng khách</a>
                            </div>
                        </div>
                        <div class="item">
                            <div class="ProductCategory-list-item">
                                <div class="ProductCategory-list-item-image"> <a href="#"> <img src="" alt=""></a></div><a class="ProductCategory-list-item-title" href="#">Phòng khách</a>
                            </div>
                        </div>
                        <div class="item">
                            <div class="ProductCategory-list-item">
                                <div class="ProductCategory-list-item-image"> <a href="#"> <img src="" alt=""></a></div><a class="ProductCategory-list-item-title" href="#">Phòng khách</a>
                            </div>
                        </div>
                        <div class="item">
                            <div class="ProductCategory-list-item">
                                <div class="ProductCategory-list-item-image"> <a href="#"> <img src="" alt=""></a></div><a class="ProductCategory-list-item-title" href="#">Phòng khách</a>
                            </div>
                        </div>
                        <div class="item">
                            <div class="ProductCategory-list-item">
                                <div class="ProductCategory-list-item-image"> <a href="#"> <img src="" alt=""></a></div><a class="ProductCategory-list-item-title" href="#">Phòng khách</a>
                            </div>
                        </div>
                        <div class="item">
                            <div class="ProductCategory-list-item">
                                <div class="ProductCategory-list-item-image"> <a href="#"> <img src="" alt=""></a></div><a class="ProductCategory-list-item-title" href="#">Phòng khách</a>
                            </div>
                        </div>
                        <div class="item">
                            <div class="ProductCategory-list-item">
                                <div class="ProductCategory-list-item-image"> <a href="#"> <img src="" alt=""></a></div><a class="ProductCategory-list-item-title" href="#">Phòng khách</a>
                            </div>
                        </div>
                        <div class="item">
                            <div class="ProductCategory-list-item">
                                <div class="ProductCategory-list-item-image"> <a href="#"> <img src="" alt=""></a></div><a class="ProductCategory-list-item-title" href="#">Phòng khách</a>
                            </div>
                        </div>
                        <div class="item">
                            <div class="ProductCategory-list-item">
                                <div class="ProductCategory-list-item-image"> <a href="#"> <img src="" alt=""></a></div><a class="ProductCategory-list-item-title" href="#">Phòng khách</a>
                            </div>
                        </div>
                        <div class="item">
                            <div class="ProductCategory-list-item">
                                <div class="ProductCategory-list-item-image"> <a href="#"> <img src="" alt=""></a></div><a class="ProductCategory-list-item-title" href="#">Phòng khách</a>
                            </div>
                        </div>
                    </div>
                    <div class="ProductCategory-list owl-carousel mobile" id="ProductCategory-carousel-mobile">
                        <div class="item">
                            <div class="ProductCategory-list-item">
                                <div class="ProductCategory-list-item-image"> <a href="#"> <img src="" alt=""></a></div><a class="ProductCategory-list-item-title" href="#">Phòng khách</a>
                            </div>
                            <div class="ProductCategory-list-item">
                                <div class="ProductCategory-list-item-image"> <a href="#"> <img src="" alt=""></a></div><a class="ProductCategory-list-item-title" href="#">Phòng khách</a>
                            </div>
                        </div>
                        <div class="item">
                            <div class="ProductCategory-list-item">
                                <div class="ProductCategory-list-item-image"> <a href="#"> <img src="" alt=""></a></div><a class="ProductCategory-list-item-title" href="#">Phòng khách</a>
                            </div>
                            <div class="ProductCategory-list-item">
                                <div class="ProductCategory-list-item-image"> <a href="#"> <img src="" alt=""></a></div><a class="ProductCategory-list-item-title" href="#">Phòng khách</a>
                            </div>
                        </div>
                        <div class="item">
                            <div class="ProductCategory-list-item">
                                <div class="ProductCategory-list-item-image"> <a href="#"> <img src="" alt=""></a></div><a class="ProductCategory-list-item-title" href="#">Phòng khách</a>
                            </div>
                            <div class="ProductCategory-list-item">
                                <div class="ProductCategory-list-item-image"> <a href="#"> <img src="" alt=""></a></div><a class="ProductCategory-list-item-title" href="#">Phòng khách</a>
                            </div>
                        </div>
                        <div class="item">
                            <div class="ProductCategory-list-item">
                                <div class="ProductCategory-list-item-image"> <a href="#"> <img src="" alt=""></a></div><a class="ProductCategory-list-item-title" href="#">Phòng khách</a>
                            </div>
                            <div class="ProductCategory-list-item">
                                <div class="ProductCategory-list-item-image"> <a href="#"> <img src="" alt=""></a></div><a class="ProductCategory-list-item-title" href="#">Phòng khách</a>
                            </div>
                        </div>
                        <div class="item">
                            <div class="ProductCategory-list-item">
                                <div class="ProductCategory-list-item-image"> <a href="#"> <img src="" alt=""></a></div><a class="ProductCategory-list-item-title" href="#">Phòng khách</a>
                            </div>
                            <div class="ProductCategory-list-item">
                                <div class="ProductCategory-list-item-image"> <a href="#"> <img src="" alt=""></a></div><a class="ProductCategory-list-item-title" href="#">Phòng khách</a>
                            </div>
                        </div>
                        <div class="item">
                            <div class="ProductCategory-list-item">
                                <div class="ProductCategory-list-item-image"> <a href="#"> <img src="" alt=""></a></div><a class="ProductCategory-list-item-title" href="#">Phòng khách</a>
                            </div>
                            <div class="ProductCategory-list-item">
                                <div class="ProductCategory-list-item-image"> <a href="#"> <img src="" alt=""></a></div><a class="ProductCategory-list-item-title" href="#">Phòng khách</a>
                            </div>
                        </div>
                        <div class="item">
                            <div class="ProductCategory-list-item">
                                <div class="ProductCategory-list-item-image"> <a href="#"> <img src="" alt=""></a></div><a class="ProductCategory-list-item-title" href="#">Phòng khách</a>
                            </div>
                            <div class="ProductCategory-list-item">
                                <div class="ProductCategory-list-item-image"> <a href="#"> <img src="" alt=""></a></div><a class="ProductCategory-list-item-title" href="#">Phòng khách</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="ProductList">
    <div class="container">
        <div class="ProductCategory-wrapper">
            <div class="Card">
                <div class="Card-header flex items-center justify-between">
                    <div class="Card-header-title">Gợi ý hôm nay</div>
                </div>
                <div class="Card-body">
                    <div class="ProductList-list flex flex-wrap">
                        @if($products->isNotEmpty())
                        @foreach($products as $product)
                        <div class="ProductList-list-item">
                            <div class="ProductBox">
                                <div class="ProductBox-image">
                                    <div class="ProductBox-image-wrapper"><img src="{{ $product->url_picture }}" alt="{{ $product->name }}">
                                        <video class="ProductBox-video" data-src="./assets/videos/video-product-1.mp4" muted="muted" loop="loop"></video>
                                    </div>
                                </div>
                                <div class="ProductBox-info"><a class="ProductBox-title" href="{{route('product.productDetail',['id'=>$product->id])}}">{{ $product->name }}</a>
                                    <div class="ProductBox-price">
                                        <del>{{ $product->price_base ? number_format($product->price_base). 'đ' : '' }} </del><span>{{ $product->price_final ? number_format($product->price_final). 'đ' : '' }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        @endif
                    </div>
                    <div class="ProductList-loadmore">
                        <div class="Button outline-primary middle">
                            <button class="Button-control flex items-center justify-center" type="button"><span class="Button-control-title">Xem thêm</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="AboutMobile">
    <div class="container">
        <div class="AboutMobile-wrapper">
            <div class="Collapse">
                <div class="Collapse-item">
                    <div class="Collapse-item-header flex items-center justify-between">
                        <div class="Collapse-item-header-title">Về thongminhmart</div>
                        <div class="Collapse-item-header-arrow"><svg width="14" height="9" viewBox="0 0 14 9" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M13 1L7 7L1 0.999999" stroke="black" stroke-width="1.5" stroke-linecap="round" />
                            </svg></div>
                    </div>
                    <div class="Collapse-item-body style-content">
                        <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Sequi quae ab nam sapiente dolores laborum amet fuga velit nemo, voluptatibus reiciendis ratione ipsum a dolor enim dicta perferendis placeat quos!</p>
                    </div>
                </div>
                <div class="Collapse-item">
                    <div class="Collapse-item-header flex items-center justify-between">
                        <div class="Collapse-item-header-title">Hỗ trợ khách hàng</div>
                        <div class="Collapse-item-header-arrow"><svg width="14" height="9" viewBox="0 0 14 9" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M13 1L7 7L1 0.999999" stroke="black" stroke-width="1.5" stroke-linecap="round" />
                            </svg></div>
                    </div>
                    <div class="Collapse-item-body style-content">
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Tempore debitis quas quos maxime voluptate, ratione et eius tempora iure facilis rem repellendus, optio eveniet possimus animi recusandae voluptas error sequi!</p>
                        <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Eum unde fugiat maiores, assumenda minima necessitatibus! Neque voluptate a quia? Culpa inventore in minima, laborum id voluptatibus incidunt voluptates aperiam reprehenderit.</p>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Tempore perferendis iure voluptatum asperiores nemo delectus? Alias asperiores quos vitae, harum tempora ut consequuntur illo pariatur molestias quaerat! Quo, natus laborum.</p>
                    </div>
                </div>
                <div class="Collapse-item">
                    <div class="Collapse-item-header flex items-center justify-between">
                        <div class="Collapse-item-header-title">Hệ thống tiện ích</div>
                        <div class="Collapse-item-header-arrow"><svg width="14" height="9" viewBox="0 0 14 9" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M13 1L7 7L1 0.999999" stroke="black" stroke-width="1.5" stroke-linecap="round" />
                            </svg></div>
                    </div>
                    <div class="Collapse-item-body style-content">
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Nisi numquam ratione id nobis fugiat. Saepe similique inventore, dignissimos eaque amet non debitis est quam esse! Placeat enim vitae libero cupiditate!</p>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Dicta unde iusto quasi saepe qui. Vero explicabo quos accusantium quidem a nulla, quaerat recusandae sed alias, eum adipisci, aspernatur laudantium inventore!</p>
                    </div>
                </div>
                <div class="Collapse-item">
                    <div class="Collapse-item-header flex items-center justify-between">
                        <div class="Collapse-item-header-title">Kênh thông tin</div>
                        <div class="Collapse-item-header-arrow"><svg width="14" height="9" viewBox="0 0 14 9" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M13 1L7 7L1 0.999999" stroke="black" stroke-width="1.5" stroke-linecap="round" />
                            </svg></div>
                    </div>
                    <div class="Collapse-item-body style-content">
                        <div class="AnotherInfoPage-socials flex flex-wrap justify-center"><a class="AnotherInfoPage-socials-item" href="#" target="_blank"><img src="./assets/icons/icon-facebook.svg" alt=""></a><a class="AnotherInfoPage-socials-item" href="#" target="_blank"><img src="./assets/icons/icon-youtube.svg" alt=""></a><a class="AnotherInfoPage-socials-item" href="#" target="_blank"><img src="./assets/icons/icon-zalo.svg" alt=""></a><a class="AnotherInfoPage-socials-item" href="#" target="_blank"><img src="./assets/icons/icon-tiktok.svg" alt=""></a></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection