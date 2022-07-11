@extends("enduser.layout")

@section('content')

   <div class="section-nav-redirect">
       <div class="container">
           <div class="d-flex align-items-center flex-wrap"> <a href="/">Trang chủ</a><span>/</span><span>Đánh giá</span>
           </div>
       </div>
   </div>
   <section class="section section-review" style="padding-top: 0;">
       <div class="container">
           <div class="section-header d-flex align-items-center justify-content-between sm-column">
               <h2 class="d-flex align-items-center">
                   Đánh giá</h2>
               <div class="sort-group d-flex align-items-center">
                   <label>Sắp xếp</label>
                   <form action="#">
                   <select name="sort_by" class="custom-select" id="sort_select_review">
                       <option @if($sort == "new") selected @endif  value="new">Mới nhất</option>
                       <option  @if($sort == "old") selected @endif value="old">Cũ nhất</option>
                   </select>
                   </form>
               </div>
           </div>
           <div class="section-main">
               <div class="row">
                   @if(count($items) > 0)
                        @foreach($items as $k => $item)
                       <div class="col-lg-3 col-md-4 col-6">
                       <div class="review-component">
                           <div class="review-image">
                               @if(empty($item->images) || !file_exists( public_path() . "/images/comments/" .  $item->images ) )
                                   <img class="lazyload" data-src="{{ asset('enduser/assets/images/logo.png') }}" alt="">
                               @else
                                   <img class="lazyload" data-src="{{ asset('images/comments/' . $item->images ) }}" alt="">
                               @endif

                           </div>
                           <div class="review-info">
                               <h4 class="review-title">{{ $item->body }}</h4>
                               <p class="review-des">Username: {{ $item->user->fullname() }}</p>
                           </div>
                       </div>
                   </div>
                       @endforeach
                   @endif

               </div>
           </div>
       </div>
   </section>
   @php
       $querystringArray = request()->only(['sort_by']);
   @endphp
   {!! $items->appends($querystringArray)->links('enduser.partials.pagination') !!}


@stop

@section('script')

    <script>
        $("#sort_select_review").change(function(){
            $(this).parents("form").submit();
        });
    </script>

@stop


