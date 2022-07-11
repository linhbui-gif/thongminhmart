@extends("enduser.layout")
@section('content')
<!--    --><?php
//
//    dd(session('cart')  );
//        ?>

    @if(!empty(session('cart')))
    @if(count(session('cart')) > 0)
    <table id="cart" class="table table-hover table-condensed">
        <thead>
        <tr>
            <th style="width:10%">Images</th>
            <th >Name</th>
{{--            <th >Color</th>--}}
{{--            <th >Size</th>--}}
            <th style="width:10%">Price</th>
            <th style="width:8%">Quantity</th>
            <th style="width:22%" class="text-center">Subtotal</th>
            <th style="width:10%">Action</th>
        </tr>
        </thead>
        <tbody>

        @php $total = 0; $color = '';$size = ''; @endphp

            @foreach(session('cart') as $id => $details)
                @php
                    $total += $details['price'] * $details['quantity'];

                @endphp

{{--                if($details['color_id']){--}}
{{--                $color = \App\Color::find($details['color_id']);--}}
{{--                }--}}
{{--                if($details['size_id']){--}}
{{--                $size = \App\Size::find($details['size_id']);--}}
{{--                }--}}
                <tr data-id="{{ $id }}">
                    <td data-th="Product">
{{--                        <div class="row">--}}
{{--                            <div class="col-sm-3 hidden-xs"></div>--}}
{{--                            <div class="col-sm-9">--}}
{{--                                <h4 class="nomargin">{{ $details['name'] }}</h4>--}}
{{--                            </div>--}}
{{--                        </div>--}}
                        <img src="{{ $details['image'] }}" width="100" height="100" class="img-responsive"/>
                    </td>
                    <td><h4 class="nomargin">{{ $details['name'] }}</h4></td>
{{--                    <td>{{$color->name}}</td>--}}
{{--                    <td>{{$size->name ?? "-"}}</td>--}}
                    <td data-th="Price">{{ number_format($details['price']) }} VND</td>
                    <td data-th="Quantity">
                        <input type="number" value="{{ $details['quantity'] }}" class="form-control quantity update-cart" />
                    </td>
                    <td data-th="Subtotal" class="text-center">{{ number_format($details['price'] * $details['quantity']) }} VND</td>
                    <td class="actions" data-th="">
                        <button class="btn btn-danger btn-sm remove-from-cart"><i class="fa fa-trash-o"></i></button>
                    </td>
                </tr>
            @endforeach

        </tbody>
        <tfoot>
        <tr>
            <td colspan="5" class="text-right"><h3><strong>Total {{ number_format($total) }} VND</strong></h3></td>
        </tr>
        <tr>
            <td colspan="5" class="text-right">
                <a href="{{ url('/') }}" class="btn btn-warning"><i class="fa fa-angle-left"></i> Continue Shopping</a>
                <button class="btn btn-success"><a href="{{route('product.checkout')}}">Checkout</a></button>
            </td>
        </tr>
        </tfoot>
    </table>
    @else
        <p>Không có sản phẩm nào trong giỏ hàng <a href="{{route("product.productList")}}">tiếp tục mua hàng</a> </p>
    @endif
    @endif
@endsection

@section('script')
    <script type="text/javascript">

        $(".update-cart").change(function (e) {
            e.preventDefault();

            var ele = $(this);

            $.ajax({
                url: '{{ route('product.updateCart') }}',
                method: "patch",
                data: {
                    _token: '{{ csrf_token() }}',
                    id: ele.parents("tr").attr("data-id"),
                    quantity: ele.parents("tr").find(".quantity").val()
                },
                success: function (response) {
                    window.location.reload();
                }
            });
        });

        $(".remove-from-cart").click(function (e) {
            e.preventDefault();

            var ele = $(this);

            if(confirm("Are you sure want to remove?")) {
                $.ajax({
                    url: '{{ route('product.deleteCart') }}',
                    method: "DELETE",
                    data: {
                        _token: '{{ csrf_token() }}',
                        id: ele.parents("tr").attr("data-id")
                    },
                    success: function (response) {
                        window.location.reload();
                    }
                });
            }
        });

    </script>
@endsection
