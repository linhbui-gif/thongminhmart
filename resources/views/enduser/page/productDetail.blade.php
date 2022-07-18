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
                                    <div class="ProductDetailPage-detail-info-basic-price flex items-center"><span>{{ $product->price_final ? number_format($product->price_final). 'đ' : '' }}</span>
                                        <del>{{ $product->price_base ? number_format($product->price_base). 'đ' : '' }}</del>
                                    </div>
                                </div>
                                <div class="ProductDetailPage-detail-info-basic-item">
                                    <div class="ProductDetailPage-detail-info-text">MSP: {{ $product->slug }}</div>
                                </div>
                            </div>
                            <form action="{{route('product.addCart')}}" method="POST">
                                @csrf
                                <input type="hidden" name="product_id" id="product_id" value="{{$product->id}}">
                                <input type="hidden" name="jsTotalPrice" id="jsTotalPrice" value="{{$product->price_base}}">
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
                                                        @if(!empty($colors))
                                                        @foreach($colors as $k => $v)
                                                        <option value="{{$v->id}}">{{$v->name}}</option>
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
                                                        <!-- <option value="">Select size</option> -->
                                                        @if(!empty($sizes))
                                                        @foreach($sizes as $k => $v)
                                                        <option value="{{$v->id}}">{{$v->name}}</option>
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
                                                    <div class="ProductDetailPage-detail-info-options-item-carts-item-remove delCartItem" data-id="{{ $value['productInfo']['productId'] . '-' . $value['productInfo']['color'] . '-' . $value['productInfo']['size'] }}"> <img src="{{ asset('/assets/icons/icon-x-yellow.svg') }}" alt=""></div>
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
                                            <button class="Button-control flex items-center justify-center" type="button"><span class="Button-control-title">Mua ngay</span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <div class="ProductDetailPage-row flex flex-wrap">
                    <div class="ProductDetailPage-row-item">
                        <div class="Card">
                            <div class="Card-header">
                                <div class="Card-header-title color-black">Mô tả sản phẩm</div>
                            </div>
                            <div class="Card-body">
                                <div class="style-content">
                                   {!! $product->content !!}
                                </div>
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
                                        @for($stt = 1; $stt < 10; $stt++)
                                                    @if(isset($page_content['tieu_chi_' . $stt]))
                                                        @php
                                                            $item = $page_content['tieu_chi_' . $stt];
                                                        @endphp
                                                            @if(isset($item['name']) && isset($item['description']))
                                                                <tr>
                                                                    <td>{{@$item['name']}} </td>
                                                                    <td>{{@$item['description']}}</td>
                                                                </tr>
                                                            @else
                                                                 <p>Chưa có dữ liệu phù hợp</p>
                                                            @endif
                                                    @endif
                                                @endfor
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
        $products = \App\Helper\Common::getFromCache('product_main');
        if(!$products) {
            $products= \Illuminate\Support\Facades\DB::table("product_products")->select(['name','url_picture','slug','video_link','price_base','price_final'])->where('status','active')->orderBy('order_no','desc')->get();
            \App\Helper\Common::putToCache('product_main',$products);
        }
        ?>
        <div class="ProductList">
            <div class="container">
                <div class="ProductCategory-wrapper">
                    <div class="Card">
                        <div class="Card-header flex items-center justify-between">
                            <div class="Card-header-title">Có thể bạn sẽ thích</div>
                        </div>
                        <div class="Card-body">
                            <div class="ProductList-list flex flex-wrap">
                                @include('enduser.page.components.product-items', ['data' => $products])
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('script')
<script type="text/javascript">
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

        if (color == '' || size == '') {
            alert('Vui lòng chọn phân loại hàng');
            return false;
        }
        var productId = $('#product_id').val();
        var data = {
            '_token': '{{ csrf_token() }}',
            'size': size,
            'color': color,
            'quantity': quantity,
            'productId': productId,
            'price': $('#jsTotalPrice').val(),
            'avatar': $('#jsAvarta').val(),
            'name': $('#jsProductName').val(),
        }

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
                $('.delCartItem').click(function() {
                    var url = "{{route('product.delCart')}}";
                    var data = {
                        '_token': '{{ csrf_token() }}',
                        'id': $(this).data('id')
                    }

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
                        }
                    });
                });

            }
        });
    });
    $('.delCartItem').click(function() {
        var url = "{{route('product.delCart')}}";
        var data = {
            '_token': '{{ csrf_token() }}',
            'id': $(this).data('id')
        }

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
            }
        });
    });
</script>
@stop