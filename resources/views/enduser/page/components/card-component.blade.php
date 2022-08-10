<div class="ProductList-list-item">
    <div class="ProductBox">
        <div class="ProductBox-image">
            <div class="ProductBox-image-wrapper"><img src="{{$product->url_picture}}" alt="">
                <video class="ProductBox-video desktop" data-link="{{route('product.productDetail',['category'=>$product->slug])}}" data-src="{{asset('storage/video-intro/'.$product->video_link)}}" muted="muted" loop="loop" playsinline="playsinline"></video>
                <div class="ProductBox-video-loading">  <img src="{{ asset('enduser/thongminhmart/assets/icons/icon-spinner.svg') }}" alt=""></div>
            </div>
        </div>
        <div class="ProductBox-info"><a class="ProductBox-title" href="{{route('product.productDetail',['category'=>$product->slug])}}">{{$product->name}}</a>
            <div class="ProductBox-price">
                <del>{{number_format($product->price_base)}} đ</del><span>{{number_format($product->price_final)}} đ</span>
                <div class="ProductBox-cart"><svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M13.1119 4.04381L11.8825 8.96219C11.7849 9.35244 11.4358 9.625 11.0333 9.625H3.45187C3.00781 9.625 2.63419 9.2925 2.583 8.8515L1.69706 1.75H1.09375C0.731063 1.75 0.4375 1.45644 0.4375 1.09375C0.4375 0.731063 0.731063 0.4375 1.09375 0.4375H2.26931C2.59744 0.4375 2.87481 0.679875 2.91944 1.0045L3.26156 3.5H12.6875C12.9719 3.5 13.181 3.76775 13.1119 4.04381Z" fill="white"/><path d="M3.0625 11.8125C3.0625 12.5361 3.65137 13.125 4.375 13.125C5.09862 13.125 5.6875 12.5361 5.6875 11.8125C5.6875 11.0889 5.09862 10.5 4.375 10.5C3.65137 10.5 3.0625 11.0889 3.0625 11.8125Z" fill="white"/><path d="M10.9375 11.8125C10.9375 11.0889 10.3486 10.5 9.625 10.5C8.90137 10.5 8.3125 11.0889 8.3125 11.8125C8.3125 12.5361 8.90137 13.125 9.625 13.125C10.3486 13.125 10.9375 12.5361 10.9375 11.8125Z" fill="white"/></svg></div>
            </div>
        </div>
    </div>
</div>
