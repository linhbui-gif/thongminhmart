@extends("enduser.layout")

@section('content')
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
    <?php
    $metaColor = unserialize($product->meta_color);
    $metaSize = unserialize($product->meta_size);
    $colors = \App\Color::where('status', 'active')->get();
    $sizes = \App\Size::where('status', 'active')->get();
    $page_content = unserialize($product->ts_kt);
    ?>
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
                                    <div class="ProductDetailPage-detail-info-basic-price flex items-center" ><span id="price_final">{{ $product->price_final ? number_format($product->price_final). 'đ' : '' }}</span>
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
                                                         @if($color['status'] == 'active')
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
                                                            @if($size['status'] == 'active')
                                                            <option value="{{$s}}" data-price-base="{{ $size['price_base'] ? number_format($size['price_base']). 'đ' : '' }}" data-price-final="{{ $size['price_final'] ? number_format($size['price_final']). 'đ' : '' }}" data-price-active="{{$size['price_final']}}">{{$size['name']}}</option>
                                                            @endif
                                                        @endforeach
                                                        @endif
                                                    </select>
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

        // if ($('#size_id').val() == '' || $('#color_id').val() == '') {
        //     alert('Vui lòng chọn phân loại hàng');
        //     $('#size_id').focus();
        //     return false;
        // }
        var productId = $('#product_id').val();
        var data = {
            '_token': '{{ csrf_token() }}',
            'size': size,
            'color': color,
            'quantity': quantity,
            'productId': productId,
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
   
</script>
@stop