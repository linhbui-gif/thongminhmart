<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Thông Minh Mart</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('/assets/css/main.css') }}">
    <link rel="icon" type="image/png" href="{{ asset('/assets/images/favicon.png') }}">
</head>

<body>
    <div id="top"></div>
    <header class="Header">
        <div class="container">
            <div class="Header-wrapper flex justify-between"><a class="Header-logo" href="{{ route('siteIndex') }}"><img src="{{ asset('/assets/images/logo.svg') }}" alt=""></a>
                <div class="Header-info">
                    <div class="Header-info-contact flex justify-end">
                        <div class="Header-info-contact-item flex items-center">
                            <div class="Header-info-contact-item-icon"> <img src="{{ asset('/assets/icons/icon-phone-yellow.svg') }}" alt=""></div>
                            <div class="Header-info-contact-item-title"><strong>Đặt hàng:</strong><a href="#">0979 188 002</a><span>|</span><a href="#">0988 599 559</a></div>
                        </div>
                        <div class="Header-info-contact-item flex items-center">
                            <div class="Header-info-contact-item-icon"> <img src="{{ asset('/assets/icons/icon-phone-yellow.svg') }}" alt=""></div>
                            <div class="Header-info-contact-item-title"><strong>Hotline:</strong><a href="#">1900 9999</a></div>
                        </div>
                    </div>
                    <div class="Header-info-actions flex justify-end">
                        <div class="Header-info-search flex items-center">
                            <div class="Header-info-search-control">
                                <input type="text" placeholder="Tìm kiếm">
                            </div>
                            <div class="Header-info-search-icon"> <img src="{{ asset('/assets/icons/icon-search.svg') }}" alt=""></div>
                        </div>
                        <div class="Header-info-cart flex items-center">
                            <div class="Header-info-cart-icon"> <img src="{{ asset('/assets/icons/icon-cart-gray.svg') }}" alt=""></div>
                            <div class="Header-info-cart-content"><span>Giỏ hàng</span><strong>0 đ</strong></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
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
        <div class="ProductActions-item buy">Mua ngay</div>
    </div>
    <div class="ProductCartDrawer">
        <div class="ProductCartDrawer-overlay"></div>
        <div class="ProductCartDrawer-main">
            <div class="ProductCartDrawer-product flex">
                <div class="ProductCartDrawer-product-image"> <img src="./assets/images/image-product.png" alt=""></div>
                <div class="ProductCartDrawer-product-info">
                    <div class="ProductCartDrawer-product-info-title">Lorem Ipsum is simply dummy text of the </div>
                    <div class="ProductCartDrawer-product-info-price"> <span>120,000 đ</span>
                        <del>190,000 đ</del>
                    </div>
                </div>
            </div>
            <div class="ProductDetailPage-detail-info-options-item">
                <div class="ProductDetailPage-detail-info-options-item-row flex items-center">
                    <div class="ProductDetailPage-detail-info-options-item-row-label">Màu sắc</div>
                    <div class="ProductDetailPage-detail-info-options-item-row-control">
                        <div class="Select middle">
                            <select class="Select-control">
                                <option value="white">Trắng</option>
                                <option value="red">Đỏ</option>
                                <option value="blue">Xanh</option>
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
                            <select class="Select-control">
                                <option value="small">Nhỏ</option>
                                <option value="medium">Vừa</option>
                                <option value="large">To</option>
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
                            <input class="Amount-control" type="number" value="1" min="1">
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
                    <button class="Button-control flex items-center justify-center" type="button"><span class="Button-control-icon"><svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path class="fill" d="M16.8581 5.19919L15.2775 11.5228C15.1521 12.0246 14.7032 12.375 14.1857 12.375H4.43812C3.86719 12.375 3.38681 11.9475 3.321 11.3805L2.18194 2.25H1.40625C0.939938 2.25 0.5625 1.87256 0.5625 1.40625C0.5625 0.939938 0.939938 0.5625 1.40625 0.5625H2.91769C3.33956 0.5625 3.69619 0.874125 3.75356 1.2915L4.19344 4.5H16.3125C16.6781 4.5 16.947 4.84425 16.8581 5.19919Z" fill="#FBB508" />
                                <path class="fill" d="M3.9375 15.1875C3.9375 16.1179 4.69462 16.875 5.625 16.875C6.55538 16.875 7.3125 16.1179 7.3125 15.1875C7.3125 14.2571 6.55538 13.5 5.625 13.5C4.69462 13.5 3.9375 14.2571 3.9375 15.1875Z" fill="#FBB508" />
                                <path d="M14.0625 15.1875C14.0625 14.2571 13.3054 13.5 12.375 13.5C11.4446 13.5 10.6875 14.2571 10.6875 15.1875C10.6875 16.1179 11.4446 16.875 12.375 16.875C13.3054 16.875 14.0625 16.1179 14.0625 15.1875Z" fill="#FBB508" />
                            </svg></span>
                    </button>
                </div>
            </div>
        </div>
    </div>
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
                    <div class="Navigation-list flex items-center"> <a class="Navigation-list-item" href="#">Giới thiệu</a><a class="Navigation-list-item" href="#">Chính sách</a><a class="Navigation-list-item" href="#">Kiến thức</a><a class="Navigation-list-item" href="#">Đối tác</a><a class="Navigation-list-item" href="#">Tuyển dụng</a><a class="Navigation-list-item" href="#">Liên hệ</a>
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
                                        <div class="ProductDetailPage-detail-info-basic-price flex items-center"><span>{{ $product->price_final ? $product->price_final. 'đ' : '' }}</span>
                                            <del>{{ $product->price_base ? $product->price_base. 'đ' : '' }}</del>
                                        </div>
                                    </div>
                                    <div class="ProductDetailPage-detail-info-basic-item">
                                        <div class="ProductDetailPage-detail-info-text">MSP: {{ $product->slug }}</div>
                                    </div>
                                </div>
                                <div class="ProductDetailPage-detail-info-options flex flex-wrap">
                                    <div class="ProductDetailPage-detail-info-options-item">
                                        <div class="ProductDetailPage-detail-info-options-item-title"></div>
                                        <div class="ProductDetailPage-detail-info-options-item-row flex items-center">
                                            <div class="ProductDetailPage-detail-info-options-item-row-label">Màu sắc</div>
                                            <div class="ProductDetailPage-detail-info-options-item-row-control">
                                                <div class="Select middle">
                                                    <select class="Select-control">
                                                        <option value="white">Trắng</option>
                                                        <option value="red">Đỏ</option>
                                                        <option value="blue">Xanh</option>
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
                                                    <select class="Select-control">
                                                        <option value="small">Nhỏ</option>
                                                        <option value="medium">Vừa</option>
                                                        <option value="large">To</option>
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
                                                    <input class="Amount-control" type="number" value="1" min="1">
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
                                            <div class="ProductDetailPage-detail-info-options-item-carts-item flex items-center">
                                                <div class="ProductDetailPage-detail-info-options-item-carts-item-title">1 sản phẩm - Màu sắc: Trắng - Kích cỡ: 5x7x3</div>
                                                <div class="ProductDetailPage-detail-info-options-item-carts-item-remove"> <img src="./assets/icons/icon-x-yellow.svg" alt=""></div>
                                            </div>
                                            <div class="ProductDetailPage-detail-info-options-item-carts-item flex items-center">
                                                <div class="ProductDetailPage-detail-info-options-item-carts-item-title">1 sản phẩm - Màu sắc: Trắng - Kích cỡ: 5x7x3</div>
                                                <div class="ProductDetailPage-detail-info-options-item-carts-item-remove"> <img src="./assets/icons/icon-x-yellow.svg" alt=""></div>
                                            </div>
                                            <div class="ProductDetailPage-detail-info-options-item-carts-item flex items-center">
                                                <div class="ProductDetailPage-detail-info-options-item-carts-item-title">1 sản phẩm - Màu sắc: Trắng - Kích cỡ: 5x7x3</div>
                                                <div class="ProductDetailPage-detail-info-options-item-carts-item-remove"> <img src="./assets/icons/icon-x-yellow.svg" alt=""></div>
                                            </div>
                                            <div class="ProductDetailPage-detail-info-options-item-carts-item flex items-center">
                                                <div class="ProductDetailPage-detail-info-options-item-carts-item-title">1 sản phẩm - Màu sắc: Trắng - Kích cỡ: 5x7x3</div>
                                                <div class="ProductDetailPage-detail-info-options-item-carts-item-remove"> <img src="./assets/icons/icon-x-yellow.svg" alt=""></div>
                                            </div>
                                            <div class="ProductDetailPage-detail-info-options-item-carts-item flex items-center">
                                                <div class="ProductDetailPage-detail-info-options-item-carts-item-title">1 sản phẩm - Màu sắc: Trắng - Kích cỡ: 5x7x3</div>
                                                <div class="ProductDetailPage-detail-info-options-item-carts-item-remove"> <img src="./assets/icons/icon-x-yellow.svg" alt=""></div>
                                            </div>
                                            <div class="ProductDetailPage-detail-info-options-item-carts-item flex items-center">
                                                <div class="ProductDetailPage-detail-info-options-item-carts-item-title">1 sản phẩm - Màu sắc: Trắng - Kích cỡ: 5x7x3</div>
                                                <div class="ProductDetailPage-detail-info-options-item-carts-item-remove"> <img src="./assets/icons/icon-x-yellow.svg" alt=""></div>
                                            </div>
                                            <div class="ProductDetailPage-detail-info-options-item-carts-item flex items-center">
                                                <div class="ProductDetailPage-detail-info-options-item-carts-item-title">1 sản phẩm - Màu sắc: Trắng - Kích cỡ: 5x7x3</div>
                                                <div class="ProductDetailPage-detail-info-options-item-carts-item-remove"> <img src="./assets/icons/icon-x-yellow.svg" alt=""></div>
                                            </div>
                                            <div class="ProductDetailPage-detail-info-options-item-carts-item flex items-center">
                                                <div class="ProductDetailPage-detail-info-options-item-carts-item-title">1 sản phẩm - Màu sắc: Trắng - Kích cỡ: 5x7x3</div>
                                                <div class="ProductDetailPage-detail-info-options-item-carts-item-remove"> <img src="./assets/icons/icon-x-yellow.svg" alt=""></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="ProductDetailPage-detail-info-actions flex flex-wrap">
                                    <div class="ProductDetailPage-detail-info-actions-item">
                                        <div class="Button outline-gray middle">
                                            <button class="Button-control flex items-center justify-center" type="button"><span class="Button-control-icon"><svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path class="fill" d="M16.8581 5.19919L15.2775 11.5228C15.1521 12.0246 14.7032 12.375 14.1857 12.375H4.43812C3.86719 12.375 3.38681 11.9475 3.321 11.3805L2.18194 2.25H1.40625C0.939938 2.25 0.5625 1.87256 0.5625 1.40625C0.5625 0.939938 0.939938 0.5625 1.40625 0.5625H2.91769C3.33956 0.5625 3.69619 0.874125 3.75356 1.2915L4.19344 4.5H16.3125C16.6781 4.5 16.947 4.84425 16.8581 5.19919Z" fill="#FBB508" />
                                                        <path class="fill" d="M3.9375 15.1875C3.9375 16.1179 4.69462 16.875 5.625 16.875C6.55538 16.875 7.3125 16.1179 7.3125 15.1875C7.3125 14.2571 6.55538 13.5 5.625 13.5C4.69462 13.5 3.9375 14.2571 3.9375 15.1875Z" fill="#FBB508" />
                                                        <path d="M14.0625 15.1875C14.0625 14.2571 13.3054 13.5 12.375 13.5C11.4446 13.5 10.6875 14.2571 10.6875 15.1875C10.6875 16.1179 11.4446 16.875 12.375 16.875C13.3054 16.875 14.0625 16.1179 14.0625 15.1875Z" fill="#FBB508" />
                                                    </svg></span><span class="Button-control-title">Thêm vào giỏ hàng</span>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="ProductDetailPage-detail-info-actions-item">
                                        <div class="Button primary middle">
                                            <button class="Button-control flex items-center justify-center" type="button"><span class="Button-control-title">Mua ngay</span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
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
                                @if($productSameCategory->isNotEmpty())
                                @foreach($productSameCategory as $productSame)
                                <div class="ProductList-list-item">
                                    <div class="ProductBox">
                                        <div class="ProductBox-image">
                                            <div class="ProductBox-image-wrapper"><img src="{{ $productSame->url_picture }}" alt="{{ $productSame->name }}">
                                                <video class="ProductBox-video" data-src="{{ asset('/assets/videos/video-product-1.mp4') }}" muted="muted" loop="loop"></video>
                                            </div>
                                        </div>
                                        <div class="ProductBox-info"><a class="ProductBox-title" href="{{route('product.productDetail',['category'=>$productSame->slug])}}">{{ $productSame->name }}</a>
                                            <div class="ProductBox-price">
                                                <del>{{ $productSame->price_base ? $productSame->price_base. 'đ' : '' }} </del><span>{{ $productSame->price_final ? $productSame->price_final. 'đ' : '' }}</span>
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
    <footer class="Footer">
        <div class="container">
            <div class="Footer-wrapper">
                <div class="Footer-wrapper-item">
                    <div class="Footer-services flex items-center justify-between">
                        <div class="Footer-services-item flex items-center">
                            <div class="Footer-services-item-icon"> <img src="./assets/icons/icon-shield.svg" alt=""></div>
                            <div class="Footer-services-item-title">DỊCH VỤ UY TÍN</div>
                        </div>
                        <div class="Footer-services-item flex items-center">
                            <div class="Footer-services-item-icon"> <img src="./assets/icons/icon-refresh.svg" alt=""></div>
                            <div class="Footer-services-item-title">ĐỔI TRẢ TRÒNG VÒNG 7 NGÀY</div>
                        </div>
                        <div class="Footer-services-item flex items-center">
                            <div class="Footer-services-item-icon"> <img src="./assets/icons/icon-delivery.svg" alt=""></div>
                            <div class="Footer-services-item-title">GIAO HÀNG TOÀN QUỐC</div>
                        </div>
                    </div>
                </div>
                <div class="Footer-wrapper-item flex justify-between">
                    <div class="Footer-col">
                        <div class="Footer-col-title">Thông tin khác</div>
                        <div class="Footer-lists"> <a class="Footer-lists-item" href="#">Giới thiệu Thông Minh Mart</a><a class="Footer-lists-item" href="#">Chính sách bảo hành</a><a class="Footer-lists-item" href="#">Chính sách vận chuyển</a><a class="Footer-lists-item" href="#">Chính sách đổi hàng & hoàn tiền</a></div>
                    </div>
                    <div class="Footer-col">
                        <div class="Footer-col-title">Kết nối với chúng tôi</div>
                        <div class="Footer-socials flex flex-wrap"><a class="Footer-socials-item" href="#" target="_blank"><img src="./assets/icons/icon-facebook.svg" alt=""></a><a class="Footer-socials-item" href="#" target="_blank"><img src="./assets/icons/icon-youtube.svg" alt=""></a><a class="Footer-socials-item" href="#" target="_blank"><img src="./assets/icons/icon-zalo.svg" alt=""></a><a class="Footer-socials-item" href="#" target="_blank"><img src="./assets/icons/icon-tiktok.svg" alt=""></a>
                            <div class="Footer-socials-item bct"><img src="./assets/images/logo-bct.svg" alt=""></div>
                        </div>
                    </div>
                    <div class="Footer-col flex">
                        <div class="Footer-col-item">
                            <div class="Footer-favicon"><img src="./assets/images/favicon.png" alt=""></div>
                        </div>
                        <div class="Footer-col-item">
                            <div class="Footer-col-title">CÔNG TY CỔ PHẦN TM&DV SMARTCHOISE</div>
                            <div class="Footer-lists">
                                <div class="Footer-lists-item">Địa chỉ: 130A25 - Nghĩa Tân - Cầu Giấy - Hà Nội</div><a class="Footer-lists-item" href="tel: 0932868585">Điện thoại: Zalo - 093 286 8585</a><a class="Footer-lists-item" href="mailto: thongminhmart@gmail.com">Email: thongminhmart@gmail.com</a><a class="Footer-lists-item" href="www.thongminhmart.vn">Website: www.thongminhmart.vn</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer><a class="ButtonToTop" href="#top"><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-chevron-up" width="44" height="44" viewBox="0 0 24 24" stroke-width="2" stroke="#000" fill="none" stroke-linecap="round" stroke-linejoin="round">
            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
            <polyline points="6 15 12 9 18 15" />
        </svg></a>
    <div class="ButtonsCta">
        <div class="ButtonsCta-item">
            <div class="ButtonsCta-item-tooltip">Nhắn tin Zalo</div><a href="#"><img src="./assets/images/image-button-cta-zalo.png" alt=""></a>
        </div>
        <div class="ButtonsCta-item">
            <div class="ButtonsCta-item-tooltip">Gọi ngay</div><a href="#"><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-phone" width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="#fff" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M5 4h4l2 5l-2.5 1.5a11 11 0 0 0 5 5l1.5 -2.5l5 2v4a2 2 0 0 1 -2 2a16 16 0 0 1 -15 -15a2 2 0 0 1 2 -2" />
                </svg></a>
        </div>
        <div class="ButtonsCta-item">
            <div class="ButtonsCta-item-tooltip">Bản đồ</div><a href="#"><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-map-pin" width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="#fff" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <circle cx="12" cy="11" r="3" />
                    <path d="M17.657 16.657l-4.243 4.243a2 2 0 0 1 -2.827 0l-4.244 -4.243a8 8 0 1 1 11.314 0z" />
                </svg></a>
        </div>
    </div>
    <div class="ProductCategoryDrawer">
        <div class="ProductCategoryDrawer-overlay"></div>
        <div class="ProductCategoryDrawer-main"><a class="ProductCategoryDrawer-main-item" href="danh-sach-san-pham.html"><span class="ProductCategoryDrawer-main-item-image"><img src="" alt=""></span><span class="ProductCategoryDrawer-main-item-title">Danh mục 1</span></a><a class="ProductCategoryDrawer-main-item" href="danh-sach-san-pham.html"><span class="ProductCategoryDrawer-main-item-image"><img src="" alt=""></span><span class="ProductCategoryDrawer-main-item-title">Danh mục 2</span></a><a class="ProductCategoryDrawer-main-item" href="danh-sach-san-pham.html"><span class="ProductCategoryDrawer-main-item-image"><img src="" alt=""></span><span class="ProductCategoryDrawer-main-item-title">Danh mục 3</span></a><a class="ProductCategoryDrawer-main-item" href="danh-sach-san-pham.html"><span class="ProductCategoryDrawer-main-item-image"><img src="" alt=""></span><span class="ProductCategoryDrawer-main-item-title">Danh mục 4</span></a><a class="ProductCategoryDrawer-main-item" href="danh-sach-san-pham.html"><span class="ProductCategoryDrawer-main-item-image"><img src="" alt=""></span><span class="ProductCategoryDrawer-main-item-title">Danh mục 5</span></a><a class="ProductCategoryDrawer-main-item" href="danh-sach-san-pham.html"><span class="ProductCategoryDrawer-main-item-image"><img src="" alt=""></span><span class="ProductCategoryDrawer-main-item-title">Danh mục 6</span></a><a class="ProductCategoryDrawer-main-item" href="danh-sach-san-pham.html"><span class="ProductCategoryDrawer-main-item-image"><img src="" alt=""></span><span class="ProductCategoryDrawer-main-item-title">Danh mục 7</span></a><a class="ProductCategoryDrawer-main-item" href="danh-sach-san-pham.html"><span class="ProductCategoryDrawer-main-item-image"><img src="" alt=""></span><span class="ProductCategoryDrawer-main-item-title">Danh mục 8</span></a>
        </div>
    </div>
    <script src="./assets/js/jquery.min.js"></script>
    <script src="./assets/js/owl.carousel.min.js"></script>
    <script src="./assets/js/main.js"></script>
</body>

</html>