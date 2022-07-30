@extends("enduser.layout")

@section('content')

<div class="ProductActions flex">
    <div class="ProductActions-item">
        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
            <g clip-path="url(#clip0_680_441)">
                <path d="M6.1707 1.23535H17.7383C18.9855 1.23535 20 2.2498 20 3.49707V13.6338C20 14.1139 19.4571 14.3845 19.0738 14.1107L15.8523 11.8123C15.582 11.6197 15.2641 11.5178 14.932 11.5178H7.84648C6.59922 11.5178 5.58477 10.5033 5.58477 9.25605V1.82129C5.58477 1.49785 5.84727 1.23535 6.1707 1.23535ZM9.0168 8.3334H15.7867C16.1102 8.3334 16.3727 8.07129 16.3727 7.74746C16.3727 7.42402 16.1102 7.16152 15.7867 7.16152H9.0168C8.69336 7.16152 8.43086 7.42402 8.43086 7.74746C8.43086 8.07129 8.69336 8.3334 9.0168 8.3334ZM9.0168 5.59902H15.7867C16.1102 5.59902 16.3727 5.33691 16.3727 5.01309C16.3727 4.68965 16.1102 4.42715 15.7867 4.42715H9.0168C8.69336 4.42715 8.43086 4.68965 8.43086 5.01309C8.43086 5.33691 8.69336 5.59902 9.0168 5.59902Z" fill="#929191" />
                <path d="M-0.000195503 8.04189V18.1782C-0.000195503 18.6551 0.54 18.9309 0.925976 18.6552L4.14746 16.3571C4.41777 16.1646 4.73574 16.0626 5.06777 16.0626H12.1533C13.4006 16.0626 14.415 15.0478 14.415 13.8005V12.6896H7.84629C5.95293 12.6896 4.41269 11.1493 4.41269 9.25596V5.77979H2.26152C1.01426 5.77979 -0.000195503 6.79463 -0.000195503 8.04189Z" fill="#929191" />
            </g>
            <defs>
                <clipPath id="clip0_680_441">
                    <rect width="20" height="20" fill="white" transform="matrix(-1 0 0 1 20 0)" />
                </clipPath>
            </defs>
        </svg>
    </div>
    <div class="ProductActions-item"><svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M18.7719 14.125C18.7206 14.0844 15 11.4025 13.9787 11.595C13.4912 11.6812 13.2125 12.0138 12.6531 12.6794C12.5631 12.7869 12.3469 13.0444 12.1788 13.2275C11.8252 13.1122 11.4804 12.9718 11.1469 12.8075C9.42533 11.9694 8.03437 10.5784 7.19625 8.85687C7.03179 8.52339 6.89143 8.17855 6.77625 7.825C6.96 7.65625 7.2175 7.44 7.3275 7.3475C7.99 6.79125 8.32312 6.5125 8.40938 6.02375C8.58625 5.01125 5.90625 1.265 5.87812 1.23125C5.75653 1.05754 5.59784 0.913039 5.41355 0.808189C5.22925 0.70334 5.02395 0.640768 4.8125 0.625C3.72625 0.625 0.625 4.64813 0.625 5.32562C0.625 5.365 0.681875 9.3675 5.6175 14.3881C10.6331 19.3181 14.635 19.375 14.6744 19.375C15.3525 19.375 19.375 16.2737 19.375 15.1875C19.3594 14.9768 19.2972 14.7722 19.1929 14.5884C19.0886 14.4047 18.9448 14.2464 18.7719 14.125Z" fill="#929191" />
        </svg></div>
    <div class="ProductActions-item cart"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M22.4775 6.93225L20.37 15.3638C20.2028 16.0328 19.6043 16.5 18.9143 16.5H5.9175C5.15625 16.5 4.51575 15.93 4.428 15.174L2.90925 3H1.875C1.25325 3 0.75 2.49675 0.75 1.875C0.75 1.25325 1.25325 0.75 1.875 0.75H3.89025C4.45275 0.75 4.92825 1.1655 5.00475 1.722L5.59125 6H21.75C22.2375 6 22.596 6.459 22.4775 6.93225Z" fill="#FBB508" />
            <path d="M5.25 20.25C5.25 21.4905 6.2595 22.5 7.5 22.5C8.7405 22.5 9.75 21.4905 9.75 20.25C9.75 19.0095 8.7405 18 7.5 18C6.2595 18 5.25 19.0095 5.25 20.25Z" fill="#FBB508" />
            <path d="M18.75 20.25C18.75 19.0095 17.7405 18 16.5 18C15.2595 18 14.25 19.0095 14.25 20.25C14.25 21.4905 15.2595 22.5 16.5 22.5C17.7405 22.5 18.75 21.4905 18.75 20.25Z" fill="#FBB508" />
        </svg></div>
        @php $checkoutUrl =  route('product.checkout')@endphp
    <div onclick='window.location.href = "{{$checkoutUrl}}"' role="button" class="ProductActions-item buy">Mua ngay</div>
</div>
<form action="{{route('product.addCart')}}" method="POST">
    
    <div class="ProductCartDrawer">
        <div class="ProductCartDrawer-overlay"></div>
        <div class="ProductCartDrawer-main">
            <div class="ProductCartDrawer-product flex">
                <div class="ProductCartDrawer-product-image"> <img src="{{ $product->url_picture }}" alt="{{$product->name}}"></div>
                <div class="ProductCartDrawer-product-info">
                    <div class="ProductCartDrawer-product-info-title">{{$product->name}}</div>
                    <div class="ProductCartDrawer-product-info-price"> <span>{{ $product->price_final ? number_format($product->price_final). 'đ' : '' }}</span>
                        <del>{{ $product->price_base ? number_format($product->price_base). 'đ' : '' }}</del>
                    </div>
                </div>
            </div>
            <div class="ProductDetailPage-detail-info-options-item">
                <?php
                $metaColor = unserialize($product->meta_color);
                $metaSize = unserialize($product->meta_size);
                // $colors = \App\Color::where('status', 'active')->get();
                // $sizes = \App\Size::where('status', 'active')->get();
                $page_content = unserialize($product->ts_kt);
                ?>
                <div class="ProductDetailPage-detail-info-options-item-row flex items-center">
                    <div class="ProductDetailPage-detail-info-options-item-row-label">Màu sắc</div>
                    <div class="ProductDetailPage-detail-info-options-item-row-control">
                        <div class="Select middle">
                            <select class="Select-control" name="color_id_mb" id="color_id_mb">
                                <!-- <option value="">Select color</option> -->
                                @if(!empty($metaColor))
                                @foreach($metaColor as $c => $color)
                                @if($color['status'] == 'active' && !empty($color['name']))
                                <option value="{{$c}}">{{$color['name']}}</option>
                                @endif
                                @endforeach
                                @endif
                            </select>
                            <div class="Select-arrow">
                                <svg width="14" height="9" viewBox="0 0 14 9" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M12.9248 1L6.89488 7L0.864954 0.999999" stroke="black" stroke-width="1.5" stroke-linecap="round" />
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="ProductDetailPage-detail-info-options-item-row flex items-center">
                    <div class="ProductDetailPage-detail-info-options-item-row-label">Kích cỡ</div>
                    <div class="ProductDetailPage-detail-info-options-item-row-control">
                        <div class="Select middle">
                            <select class="Select-control" name="size_id_mb" id="size_id_mb">
                                <option value="" data-price-base="{{ $product->price_base ? number_format($product->price_base). 'đ' : '' }}" data-price-final="{{ $product->price_final ? number_format($product->price_final). 'đ' : '' }}" data-price-active="{{$product->price_final}}">Size</option>
                                @if(!empty($metaSize))
                                @foreach($metaSize as $s => $size)
                                @if($size['status'] == 'active' && !empty($size['price_final']))
                                <option value="{{$s}}" data-price-base="{{ $size['price_base'] ? number_format($size['price_base']). 'đ' : '' }}" data-price-final="{{ $size['price_final'] ? number_format($size['price_final']). 'đ' : '' }}" data-price-active="{{$size['price_final']}}">{{$size['name']}}</option>
                                @endif
                                @endforeach
                                @endif
                            </select>
                            <div class="Select-arrow">
                                <svg width="14" height="9" viewBox="0 0 14 9" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M12.9248 1L6.89488 7L0.864954 0.999999" stroke="black" stroke-width="1.5" stroke-linecap="round" />
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="ProductDetailPage-detail-info-options-item-row flex items-center">
                    <div class="ProductDetailPage-detail-info-options-item-row-label">Số lượng</div>
                    <div class="ProductDetailPage-detail-info-options-item-row-control">
                        <div class="Amount flex">
                            <div class="Amount-minus"><svg width="17" height="3" viewBox="0 0 17 3" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M0 0H16.8149V2.80248H0V0Z" fill="black" />
                                </svg></div>
                            <input class="Amount-control" type="number" name="quantity_mb" id="quantity_mb" value="1" min="1">
                            <div class="Amount-plus">
                                <svg width="17" height="17" viewBox="0 0 17 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M9.90497 7.07477V0H7.07504V7.07477H0V9.90469H7.07504V16.9796H9.90497V9.90469H16.9796V7.07477H9.90497Z" fill="black" />
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="ProductCartDrawer-submit">
                <div class="Button primary big">
                    <button class="Button-control flex items-center justify-center" type="button" id="addtocart_mb"><span class="Button-control-icon"><svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path class="fill" d="M16.8581 5.19919L15.2775 11.5228C15.1521 12.0246 14.7032 12.375 14.1857 12.375H4.43812C3.86719 12.375 3.38681 11.9475 3.321 11.3805L2.18194 2.25H1.40625C0.939938 2.25 0.5625 1.87256 0.5625 1.40625C0.5625 0.939938 0.939938 0.5625 1.40625 0.5625H2.91769C3.33956 0.5625 3.69619 0.874125 3.75356 1.2915L4.19344 4.5H16.3125C16.6781 4.5 16.947 4.84425 16.8581 5.19919Z" fill="#FBB508" />
                                <path class="fill" d="M3.9375 15.1875C3.9375 16.1179 4.69462 16.875 5.625 16.875C6.55538 16.875 7.3125 16.1179 7.3125 15.1875C7.3125 14.2571 6.55538 13.5 5.625 13.5C4.69462 13.5 3.9375 14.2571 3.9375 15.1875Z" fill="#FBB508" />
                                <path d="M14.0625 15.1875C14.0625 14.2571 13.3054 13.5 12.375 13.5C11.4446 13.5 10.6875 14.2571 10.6875 15.1875C10.6875 16.1179 11.4446 16.875 12.375 16.875C13.3054 16.875 14.0625 16.1179 14.0625 15.1875Z" fill="#FBB508" />
                            </svg></span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>

<nav class="Navigation">
    <div class="container">
        <div class="Navigation-wrapper flex items-center justify-between">
            <div class="Navigation-wrapper-item">
                <div class="Navigation-carousel owl-carousel" id="Navigation-carousel">
                    <div class="item">
                        <div class="Navigation-carousel-item">Lorem Ipsum is simply dummy text of the printing</div>
                    </div>
                    <div class="item">
                        <div class="Navigation-carousel-item">Lorem Ipsum is simply dummy text of the printing</div>
                    </div>
                    <div class="item">
                        <div class="Navigation-carousel-item">Lorem Ipsum is simply dummy text of the printing</div>
                    </div>
                    <div class="item">
                        <div class="Navigation-carousel-item">Lorem Ipsum is simply dummy text of the printing</div>
                    </div>
                </div>
            </div>
            <div class="Navigation-wrapper-item">
                <div class="Navigation-list flex items-center"> <a class="Navigation-list-item" href="{{ route('siteAbout') }}">Giới thiệu</a><a class="Navigation-list-item" href="#">Chính sách</a><a class="Navigation-list-item" href="#">Kiến thức</a><a class="Navigation-list-item" href="#">Đối tác</a><a class="Navigation-list-item" href="#">Tuyển dụng</a><a class="Navigation-list-item" href="{{ route('siteContact') }}">Liên hệ</a>
                </div>
            </div>
        </div>
    </div>
</nav>
<div class="Breadcrumb">
    <div class="container">
        <div class="Breadcrumb-wrapper">
            <div class="Breadcrumb-list flex flex-wrap"><a class="Breadcrumb-list-item" href="{{ route('siteIndex') }}">Trang chủ</a>
                <div class="Breadcrumb-list-item arrow">
                    <svg width="9" height="14" viewBox="0 0 9 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M1 1L7 7L1 13" stroke="#777777" stroke-width="1.5" stroke-linecap="round" />
                    </svg>
                </div><a class="Breadcrumb-list-item" href="danh-sach-san-pham.html">Danh sách sản phẩm</a>
                <div class="Breadcrumb-list-item arrow">
                    <svg width="9" height="14" viewBox="0 0 9 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M1 1L7 7L1 13" stroke="#777777" stroke-width="1.5" stroke-linecap="round" />
                    </svg>
                </div><a class="Breadcrumb-list-item" href="chi-tiet-san-pham.html">Chi tiết</a>
            </div>
        </div>
    </div>
</div>
<div class="ProductDetailPage">

    <div class="container">
        <div class="ProductDetailPage-wrapper">
            <div class="Card ProductDetailPage-detail">
                <div class="Card-body">
                    <div class="ProductDetailPage-detail-wrapper flex flex-wrap">
                        <div class="ProductDetailPage-detail-image"> <img src="{{ $product->url_picture }}" alt="">
                            <video class="ProductDetailPage-detail-video" src="{{ asset('/assets/videos/video-product-1.mp4') }}" preload="auto" defaultmuted playsinline autoplay muted loop></video>
                            <div class="ProductDetailPage-detail-image-play"><img src="{{ asset('/assets/icons/icon-play.svg') }}" alt=""></div>
                        </div>
                        <div class="ProductDetailPage-detail-info">
                            <div class="ProductDetailPage-detail-info-title">{{$product->name}} </div>
                            <div class="ProductDetailPage-detail-info-basic flex justify-between">
                                <div class="ProductDetailPage-detail-info-basic-item">
                                    <div class="ProductDetailPage-detail-info-text">Giá bán </div><br>
                                    <div class="ProductDetailPage-detail-info-basic-price flex items-center"><span id="price_final">{{ $product->price_final ? number_format($product->price_final). 'đ' : '' }}</span>
                                        <del id="price_base">{{ $product->price_base ? number_format($product->price_base). 'đ' : '' }}</del>
                                    </div>
                                </div>
                                <div class="ProductDetailPage-detail-info-basic-item">
                                    <div class="ProductDetailPage-detail-info-text">MSP: {{ $product->slug }}</div>
                                </div>
                            </div>
                            <form action="{{route('product.addCart')}}" method="POST">
                                @csrf
                                <input type="hidden" name="product_id" id="product_id" value="{{$product->id}}">
                                <input type="hidden" name="weight" id="weight" value="{{$product->weight}}">
                                <input type="hidden" name="jsTotalPrice" id="jsTotalPrice" value="{{$product->price_final}}">
                                <input type="hidden" name="jsAvarta" id="jsAvarta" value="{{$product->url_picture}}">
                                <input type="hidden" name="jsProductName" id="jsProductName" value="{{$product->name}}">
                                <div class="ProductDetailPage-detail-info-options flex flex-wrap">
                                    <div class="ProductDetailPage-detail-info-options-item">
                                        <div class="ProductDetailPage-detail-info-options-item-title"></div>
                                        <div class="ProductDetailPage-detail-info-options-item-row flex items-center">
                                            <div class="ProductDetailPage-detail-info-options-item-row-label">Màu sắc</div>
                                            <div class="ProductDetailPage-detail-info-options-item-row-control">
                                                <div class="Select middle">
                                                    <select class="Select-control" name="color_id" id="color_id">
                                                        <!-- <option value="">Select color</option> -->
                                                        @if(!empty($metaColor))
                                                        @foreach($metaColor as $c => $color)
                                                        @if($color['status'] == 'active' && !empty($color['name']))
                                                        <option value="{{$c}}">{{$color['name']}}</option>
                                                        @endif
                                                        @endforeach
                                                        @endif
                                                    </select>
                                                    <div class="Select-arrow">
                                                        <svg width="14" height="9" viewBox="0 0 14 9" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M12.9248 1L6.89488 7L0.864954 0.999999" stroke="black" stroke-width="1.5" stroke-linecap="round" />
                                                        </svg>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="ProductDetailPage-detail-info-options-item-row flex items-center">
                                            <div class="ProductDetailPage-detail-info-options-item-row-label">Kích cỡ</div>
                                            <div class="ProductDetailPage-detail-info-options-item-row-control">
                                                <div class="Select middle">
                                                    <select class="Select-control" name="size_id" id="size_id">
                                                        <option value="" data-price-base="{{ $product->price_base ? number_format($product->price_base). 'đ' : '' }}" data-price-final="{{ $product->price_final ? number_format($product->price_final). 'đ' : '' }}" data-price-active="{{$product->price_final}}">Size</option>
                                                        @if(!empty($metaSize))
                                                        @foreach($metaSize as $s => $size)
                                                        @if($size['status'] == 'active' && !empty($size['price_final']))
                                                        <option value="{{$s}}" data-price-base="{{ $size['price_base'] ? number_format($size['price_base']). 'đ' : '' }}" data-price-final="{{ $size['price_final'] ? number_format($size['price_final']). 'đ' : '' }}" data-price-active="{{$size['price_final']}}">{{$size['name']}}</option>
                                                        @endif
                                                        @endforeach
                                                        @endif
                                                    </select>
                                                    <div class="Select-arrow">
                                                        <svg width="14" height="9" viewBox="0 0 14 9" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M12.9248 1L6.89488 7L0.864954 0.999999" stroke="black" stroke-width="1.5" stroke-linecap="round" />
                                                        </svg>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="ProductDetailPage-detail-info-options-item-row flex items-center">
                                            <div class="ProductDetailPage-detail-info-options-item-row-label">Số lượng</div>
                                            <div class="ProductDetailPage-detail-info-options-item-row-control">
                                                <div class="Amount flex">
                                                    <div class="Amount-minus"><svg width="17" height="3" viewBox="0 0 17 3" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M0 0H16.8149V2.80248H0V0Z" fill="black" />
                                                        </svg></div>
                                                    <input class="Amount-control" type="number" name="quantity" id="quantity" value="1" min="1">
                                                    <div class="Amount-plus">
                                                        <svg width="17" height="17" viewBox="0 0 17 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M9.90497 7.07477V0H7.07504V7.07477H0V9.90469H7.07504V16.9796H9.90497V9.90469H16.9796V7.07477H9.90497Z" fill="black" />
                                                        </svg>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="ProductDetailPage-detail-info-options-item">
                                        <div class="ProductDetailPage-detail-info-options-item-title">Thêm vào giỏ hàng</div>
                                        <div class="ProductDetailPage-detail-info-options-item-carts">

                                            <div id="add_to_cart">
                                                @if(Session::has('Cart') != null)
                                                @foreach(Session::get('Cart')->products as $key => $value)
                                                @if(!empty($value['productInfo']['productId']) && $value['productInfo']['productId'] == $product->id)
                                                <div class="ProductDetailPage-detail-info-options-item-carts-item flex items-center">
                                                    <div class="ProductDetailPage-detail-info-options-item-carts-item-title">{{$value['quanty']??0}} sản phẩm - Màu sắc: {{$value['productInfo']['color']??''}} - Kích cỡ: {{$value['productInfo']['size']??''}}</div>
                                                    <div class="ProductDetailPage-detail-info-options-item-carts-item-remove delCartItem" data-productId="{{ $product->id }}" data-id="{{ $value['productInfo']['productId'] . '-' . $value['productInfo']['color'] . '-' . $value['productInfo']['size'] }}"> <img src="{{ asset('/assets/icons/icon-x-yellow.svg') }}" alt=""></div>
                                                </div>
                                                @endif
                                                @endforeach
                                                @endif
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="ProductDetailPage-detail-info-actions flex flex-wrap">
                                    <div class="ProductDetailPage-detail-info-actions-item">
                                        <div class="Button outline-gray middle">
                                            <button class="Button-control flex items-center justify-center" type="button" id="addtocart"><span class="Button-control-icon"><svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path class="fill" d="M16.8581 5.19919L15.2775 11.5228C15.1521 12.0246 14.7032 12.375 14.1857 12.375H4.43812C3.86719 12.375 3.38681 11.9475 3.321 11.3805L2.18194 2.25H1.40625C0.939938 2.25 0.5625 1.87256 0.5625 1.40625C0.5625 0.939938 0.939938 0.5625 1.40625 0.5625H2.91769C3.33956 0.5625 3.69619 0.874125 3.75356 1.2915L4.19344 4.5H16.3125C16.6781 4.5 16.947 4.84425 16.8581 5.19919Z" fill="#FBB508" />
                                                        <path class="fill" d="M3.9375 15.1875C3.9375 16.1179 4.69462 16.875 5.625 16.875C6.55538 16.875 7.3125 16.1179 7.3125 15.1875C7.3125 14.2571 6.55538 13.5 5.625 13.5C4.69462 13.5 3.9375 14.2571 3.9375 15.1875Z" fill="#FBB508" />
                                                        <path d="M14.0625 15.1875C14.0625 14.2571 13.3054 13.5 12.375 13.5C11.4446 13.5 10.6875 14.2571 10.6875 15.1875C10.6875 16.1179 11.4446 16.875 12.375 16.875C13.3054 16.875 14.0625 16.1179 14.0625 15.1875Z" fill="#FBB508" />
                                                    </svg></span><span class="Button-control-title">Thêm vào giỏ hàng</span>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="ProductDetailPage-detail-info-actions-item">
                                        <div class="Button primary middle">
                                            <a href="{{route('product.checkout')}}"><button class="Button-control flex items-center justify-center" type="button"><span class="Button-control-title">Mua ngay</span>
                                                </button></a>
                                        </div>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
            <div class="ProductDetailPage-row flex flex-wrap">
                <div class="ProductDetailPage-row-item">
                    <div class="Card">
                        <div class="Card-header">
                            <div class="Card-header-title color-black">Mô tả sản phẩm</div>
                        </div>
                        <div class="Card-body">
                            <div class="style-content"> {!! $product->content !!}</div>
                        </div>
                    </div>
                </div>
                <div class="ProductDetailPage-row-item">
                    <div class="Card sticky">
                        <div class="Card-header">
                            <div class="Card-header-title color-black">Thông tin chi tiết</div>
                        </div>
                        <div class="Card-body">
                            <div class="ProductDetailPage-table-content">
                                <table>
                                    <tr>
                                        <td>Bảo hành </td>
                                        <td>24 tháng</td>
                                    </tr>
                                    <tr>
                                        <td>Công nghệ</td>
                                        <td>Thẩm thấu ngược BO</td>
                                    </tr>
                                    <tr>
                                        <td>Bảo hành </td>
                                        <td>24 tháng</td>
                                    </tr>
                                    <tr>
                                        <td>Công nghệ</td>
                                        <td>Thẩm thấu ngược BO</td>
                                    </tr>
                                    <tr>
                                        <td>Bảo hành </td>
                                        <td>24 tháng</td>
                                    </tr>
                                    <tr>
                                        <td>Công nghệ</td>
                                        <td>Thẩm thấu ngược BO</td>
                                    </tr>
                                </table>
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
                        <div class="Card-header-title">Có thể bạn sẽ thích</div>
                    </div>
                    <div class="Card-body">
                        <div class="ProductList-list flex flex-wrap">
                            @if(!empty($productSameCategory))
                            @foreach($productSameCategory as $productSame)
                            <div class="ProductList-list-item">
                                <div class="ProductBox">
                                    <div class="ProductBox-image">
                                        <div class="ProductBox-image-wrapper"><img src="{{ $productSame->url_picture }}" alt="{{ $productSame->name }}">
                                            <video class="ProductBox-video" data-src="{{ asset('/assets/videos/video-product-1.mp4') }}" muted="muted" loop="loop"></video>
                                        </div>
                                    </div>
                                    <div class="ProductBox-info"><a class="ProductBox-title" href="{{route('product.productDetail',['id'=>$productSame->id])}}">{{ $productSame->name }}</a>
                                        <div class="ProductBox-price">
                                            <del>{{ $productSame->price_base ? number_format($productSame->price_base). 'đ' : '' }} </del><span>{{ $productSame->price_final ? number_format($productSame->price_final). 'đ' : '' }}</span>
                                        </div>
                                    </div>
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
@endsection
@section('script')
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script type="">
    $('#addtocart').click(function() {
        var url = "{{route('product.addCart')}}";
        var quantity = $('#quantity').val();
        if (quantity <= 0) {
            alert('Số lượng sản phẩm lớn hơn 0');
            return false;
        }
        // var type = $('.btn-color-active').text();
        var size = $("#size_id option:selected").text();
        var color = $("#color_id option:selected").text();

        if (size == '' || color == '') {
            // alert('Vui lòng chọn phân loại hàng');
            Swal.fire({
                icon: 'error',
                title: 'Thông báo...',
                text: 'Vui lòng chọn phân loại hàng!',
                // footer: '<a href="">Why do I have this issue?</a>'
            })
            $('#size_id').focus();
            return false;
        }
        var productId = $('#product_id').val();
        var data = {
            '_token': '{{ csrf_token() }}',
            'size': size,
            'color': color,
            'quantity': quantity,
            'productId': productId,
            'weight': $('#weight').val(),
            // 'price': $('#jsTotalPrice').val(),
            'price': $('#size_id').find(':selected').attr('data-price-active'),
            'avatar': $('#jsAvarta').val(),
            'name': $('#jsProductName').val(),
        }
        // console.log(data); return;

        $.ajax({
            type: 'POST',
            url: url,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: data,
            dataType: 'HTML',
            success: function(data) {
                $('#add_to_cart').html(data);
                Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: 'Thêm sản phẩm vào giỏ hàng thành công',
                showConfirmButton: false,
                timer: 1500
                });
            }
        });
    });
    $('.delCartItem').on('click', function() {
        var url = "{{route('product.delCart')}}";
        var data = {
            '_token': '{{ csrf_token() }}',
            'id': $(this).data('id'),
            'productId': $('#product_id').val()
        }
        $.ajax({
            type: 'GET',
            url: url,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: data,
            dataType: 'HTML',
            success: function(data) {
                $('#add_to_cart').html(data);
                Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: 'Xóa sản phẩm khỏi giỏ hàng thành công',
                showConfirmButton: false,
                timer: 1500
                });
            }
        });
    });

    $('#size_id').change(function () {
        var price_base = $(this).find(':selected').attr('data-price-base');
        var price_final = $(this).find(':selected').attr('data-price-final');
        $('#price_final').text(price_final);
        $('#price_base').text(price_base);
    });

    //mb
    $('#addtocart_mb').click(function() {
        var url = "{{route('product.addCart')}}";
        var quantity = $('#quantity_mb').val();
        if (quantity <= 0) {
            alert('Số lượng sản phẩm lớn hơn 0');
            return false;
        }
        // var type = $('.btn-color-active').text();
        var size = $("#size_id_mb option:selected").text();
        var color = $("#color_id_mb option:selected").text();

        if (size == '' || color == '') {
            // alert('Vui lòng chọn phân loại hàng');
            Swal.fire({
                icon: 'error',
                title: 'Thông báo...',
                text: 'Vui lòng chọn phân loại hàng!',
                // footer: '<a href="">Why do I have this issue?</a>'
            })
            $('#size_id_mb').focus();
            return false;
        }
        var productId = $('#product_id').val();
        var data = {
            '_token': '{{ csrf_token() }}',
            'size': size,
            'color': color,
            'quantity': quantity,
            'productId': productId,
            'weight': $('#weight').val(),
            // 'price': $('#jsTotalPrice').val(),
            'price': $('#size_id_mb').find(':selected').attr('data-price-active'),
            'avatar': $('#jsAvarta').val(),
            'name': $('#jsProductName').val(),
        }
        // console.log(data); return;

        $.ajax({
            type: 'POST',
            url: url,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: data,
            dataType: 'HTML',
            success: function(data) {
                $('#add_to_cart').html(data);
                Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: 'Thêm sản phẩm vào giỏ hàng thành công',
                showConfirmButton: false,
                timer: 1500
                });
            }
        });
    });
   
</script>
@stop