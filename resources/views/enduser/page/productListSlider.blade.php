@extends("enduser.layout")

@section('content')

    @include("enduser.partials.breadcrumb",[ 'mainpage' => "Trang chủ",'name' => 'Cửa hàng'])

   <section class="section product-lists" style="padding-top: 0;">
       <div class="container">
           <form action="{{route('product.productList')}}" method="get">
           <div class="section-header d-flex align-items-center justify-content-between">
               <div></div>
                   @csrf
               <div class="table-header-action d-flex justify-content-between">
                   <div class="action-item d-flex align-items-center search w-100">
                       <input type="text" name="name" placeholder="Tìm kiếm theo tên">
                       <button type="submit"><img src="{{asset("enduser/assets/icons/icon-search.svg")}}" alt=""></button>
                   </div>
               </div>
           </div>
           </form>
           <div class="product-lists-wrapper">
               <div class="row">
                   <div class="col-lg-3">
                       <div class="product-lists-filter-wrapper">
                           @include("enduser.components.product_sidebar.category")
                           @include("enduser.components.product_sidebar.fillter_price")
                       </div>
                   </div>
                   <div class="col-lg-9">
                       <div class="section-main">
                           @php
                                $countTotal = 0;
                           @endphp
                           @foreach($categories as $k => $category)
                               @php
                                   $products = $category->products()->where('product_products.status', 'active');
                                    if(isset($fillter) && isset($fillter['price'])){
                                        $p = explode(',', $fillter['price']);
                                        if(isset($p[0]) && isset($p[1])){
                                            $products->whereBetween('price_final',[ $p[0], $p[1] ] );
                                        }
                                    }

                                    if(isset($fillter) && isset($fillter['name'])){

                                        $products->where('name', 'like', '%' . $fillter['name'] . '%');

                                    }
                                    $products = $products->orderBy('product_products.id', 'desc')->get();

                               @endphp
                               @if($products && count($products) > 0)

                                   @php
                                       $countTotal += count($products);
                                   @endphp
                                   <section class="section section-product product-lists-carousel">
                                       <div class="section-header d-flex align-items-center justify-content-between sm-column">
                                           <a href="{{ $category->getLink() }}"><h2 class="d-flex align-items-center">{{ $category->name }}</h2></a>
                                       </div>
                                       <div class="section-main">

                                           <div class="owl-carousel custom-carousel-style arrow-two-side">
                                               @foreach($products as $k => $product)
                                                   @include("enduser.partials.item_loop_product", [ 'product' => $product, 'class' => 'item' ])
                                               @endforeach
                                           </div>

                                       </div>
                                   </section>
                               @endif
                           @endforeach
                           @if($countTotal <= 0)
                               <section class="section section-product product-lists-carousel">
                                   <div class="section-header d-flex align-items-center justify-content-between sm-column">
                                       <h2 class="d-flex align-items-center">Không có sản phẩm nào phù hợp</h2>
                                   </div>
                               </section>
                               @endif
                       </div>

                   </div>
               </div>
           </div>
       </div>
   </section>
   <section class="section section-product product">
       <div class="container">
           <div class="section-header d-flex align-items-center justify-content-between">
               <h2 class="d-flex align-items-center"> <img src="{{ asset("enduser/assets/icons/icon-book.svg") }}" alt="">Sản phẩm gần đây</h2>
           </div>
           <div class="section-main">

               <div class="owl-carousel custom-carousel-style arrow-two-side">
                  @include("enduser.components.product_featured")
               </div>
           </div>
       </div>
   </section>
@stop
