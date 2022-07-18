@if(Session::has('Cart') != null)
@foreach(Session::get('Cart')->products as $key => $value)
@if(!empty($value['productInfo']['productId']) && $value['productInfo']['productId']== $productId)
<div class="ProductDetailPage-detail-info-options-item-carts-item flex items-center">
    <div class="ProductDetailPage-detail-info-options-item-carts-item-title">{{$value['quanty']??0}} sản phẩm - Màu sắc: {{$value['productInfo']['color']??''}} - Kích cỡ: {{$value['productInfo']['size']??''}}</div>
    <div class="ProductDetailPage-detail-info-options-item-carts-item-remove delCartItem" data-productId="{{ $productId }}" data-id="{{ $value['productInfo']['productId'] . '-' . $value['productInfo']['color'] . '-' . $value['productInfo']['size'] }}"> <img src="{{ asset('/assets/icons/icon-x-yellow.svg') }}" alt=""></div>
</div>
@endif
@endforeach
@endif
<script type="text/javascript">
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
            }
        });
    });
</script>