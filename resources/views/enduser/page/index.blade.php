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
    $products= \Illuminate\Support\Facades\DB::table("product_products")->select(['name','url_picture','slug','video_link','price_base','price_final'])->where('status','active')->orderBy('order_no','desc')->get();
    if(!$products) {
    $products= \Illuminate\Support\Facades\DB::table("product_products")->select(['name','url_picture','slug','video_link','price_base','price_final'])->where('status','active')->orderBy('order_no','desc')->get();
      \App\Helper\Common::putToCache('product_main',$products);
    }
    $categoryProducts = \Illuminate\Support\Facades\DB::table("product_categories")->select(['name','url_picture','slug'])->where('status','active')->orderBy('id','desc')->get();
@endphp
@section('content')
    @include('enduser.page.pages.home.slider',["data" => $banners ])
    <div class="ProductCategory">
        <div class="container">
            <div class="ProductCategory-wrapper">
                <div class="Card">
                    <div class="Card-header flex items-center justify-between">
                        <div class="Card-header-title">Danh mục sản phẩm</div>
                        {{--                       <a class="Card-header-see-more" href="#">Xem thêm</a>--}}
                    </div>
                    <div class="Card-body">
                        <div class="ProductCategory-list owl-carousel desktop" id="ProductCategory-carousel">
                            @if(!empty($categoryProducts))
                                @foreach($categoryProducts as $k => $data)
                                    <div class="item">
                                        @include('enduser.page.components.category-list',["data" => $data ])
                                    </div>
                                @endforeach
                            @endif
                        </div>
                        <div class="ProductCategory-list mobile">
                            <div class="row">
                                @if(!empty($categoryProducts))
                                    @foreach($categoryProducts as $k => $cateMobile)
                                        <div class="col-3">
                                            <div class="ProductCategory-list-item ">
                                                @include('enduser.page.components.category-list',["data" => $cateMobile ])
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
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
                        {{ csrf_field() }}
                        <div class="ProductList-list flex flex-wrap" id="product_data">
                        </div>
                        <div class="ProductList-loadmore" >
                            <div class="Button outline-primary middle" id="ProductList-loadmore"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@stop
@section('script')
    <script>
        $(document).ready(function(){

            var _token = $('input[name="_token"]').val();
            load_data('', _token);
            function load_data(id="", _token)
            {
                $.ajax({
                    url:"{{ route('ajaxProduct') }}",
                    method:"POST",
                    data:{id:id, _token:_token},
                    success:function(data)
                    {
                        console.log(data)
                        if (data.length){
                            $('#load_more_button').remove();
                            $('#product_data').append(data[0]);
                            $('#ProductList-loadmore').append(data[1]);
                            ConfigVideoProduct();
                        }
                    }
                })
            }
            function ConfigVideoProduct(){
                const products = document.querySelectorAll(".ProductBox");
                products.forEach((item) => {
                    const video = item.querySelector(".ProductBox-video.desktop");
                    const loading = item.querySelector(".ProductBox-video-loading");
                    const thumbnailVideo = item.querySelector(".ProductBox-thumbnail-video");
                    const srcVideo = video.dataset.src;

                    const playVideo = item.querySelector(".ProductBox-video-play");

                    const startVideo = () => {
                        const isDesktop = window.innerWidth > 991;

                        if (isDesktop) {
                            if (!video.src) {
                                video.addEventListener("loadeddata", () => {
                                    video.classList.add("loaded");
                                    loading.classList.add("loaded");
                                });
                                video.src = srcVideo;
                            }

                            loading.classList.add("active");
                            video.classList.add("active");
                            video.play();
                        }
                    };

                    const endVideo = () => {
                        const isDesktop = window.innerWidth > 991;
                        if (isDesktop) {
                            loading.classList.remove("active");
                            video.classList.remove("active");
                            video.pause();
                            video.currentTime = 0;
                        }
                    };

                    item.addEventListener("mousemove", startVideo);
                    item.addEventListener("touchstart", startVideo);
                    item.addEventListener("mouseleave", endVideo);
                    item.addEventListener("touchend", endVideo);

                    const getThumbnailImage = (seekTo = 0.0) => {
                        const videoPlayer = document.createElement("video");
                        videoPlayer.setAttribute("src", srcVideo);
                        videoPlayer.load();

                        videoPlayer.addEventListener("loadeddata", () => {
                            setTimeout(() => {
                                videoPlayer.currentTime = seekTo;
                            }, 1000);

                            videoPlayer.addEventListener("seeked", () => {
                                const videoPlayerWidth = videoPlayer.videoWidth * 0.45;
                                const videoPlayerHeight = videoPlayer.videoHeight * 0.22;

                                thumbnailVideo
                                    .getContext("2d")
                                    .drawImage(
                                        videoPlayer,
                                        thumbnailVideo.width / 2 - videoPlayerWidth / 2,
                                        thumbnailVideo.height / 2 - videoPlayerHeight / 2,
                                        videoPlayerWidth,
                                        videoPlayerHeight
                                    );

                                thumbnailVideo.canvas?.toBlob(
                                    (blob) => {
                                        resolve(blob);
                                    },
                                    "image/jpeg",
                                    1
                                );
                            });
                        });
                    };

                    getThumbnailImage();

                    playVideo.addEventListener("click", () => {
                        if (!video.src) {
                            video.addEventListener("loadeddata", () => {
                                video.classList.add("loaded");
                                loading.classList.add("loaded");
                            });
                            video.src = srcVideo;
                        }

                        loading.classList.add("active-mobile");
                        video.classList.add("active-mobile");

                        if (video.paused) {
                            video.play();
                            playVideo.classList.remove("active");
                            thumbnailVideo.classList.remove("active");
                        } else {
                            video.pause();
                            playVideo.classList.add("active");
                        }
                    });
                });
            }
            $(document).on('click', '#load_more_button', function(){
                var id = $(this).data('id');
                $('#load_more_button').html('<b>Loading...</b>');
                load_data(id, _token);
            });

        });

    </script>
@endsection
