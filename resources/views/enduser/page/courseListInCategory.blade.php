@extends("enduser.layout")

@section('meta')
    @include("enduser.meta",[
        'title' => $category->meta_title,
        'description' => $category->meta_description,
        'link' => route('course.courseListInCategory',  [ 'slug_category' => $category->slug ] ),
        'img' => asset('images/course_category/' . $category->picture)
    ])

@stop

@section('content')

    @include("enduser.partials.breadcrumb",[ 'mainpage' => "Trang chủ",'name' => $category->name ])
   @include("enduser.components.banner_course")
   <section class="section section-product">
       <section class="section section-product">
           <div class="container">
               <div class="section-header d-flex align-items-center justify-content-between">
                   <h2 class="d-flex align-items-center"> <img src="{{ asset('/images/assets/icons/icon-book.svg') }}" alt="">{{ $category->name }}
                   </h2>
                   <div class="sort-group d-flex align-items-center">
                       <label>Lọc</label>
                       <select class="custom-select" style="min-width: 120px;">
                           <option value="#">Mặc định</option>
                           <option value="#">A - Z</option>
                           <option value="#">Z - A</option>
                           <option value="#">Cao nhất</option>
                           <option value="#">Thấp nhất</option>
                       </select>
{{--                       <select class="custom-select">--}}
{{--                           <option value="#">Danh mục </option>--}}
{{--                           <option value="#">Danh mục 1</option>--}}
{{--                           <option value="#">Danh mục 2</option>--}}
{{--                           <option value="#">Danh mục 3</option>--}}
{{--                           <option value="#">Danh mục 4</option>--}}
{{--                       </select>--}}
                   </div>
               </div>
               <div class="section-main">
                   <div class="row">
                       @if(count($courses))
                           @foreach($courses as $k => $course)
                               @include("enduser.partials.item_loop_course", [ 'item' => $course,'class' => 'col-product' ])
                           @endforeach
                       @else
                           <div class="col-md-12">
                               <p>Dữ liệu đang cập nhật</p>
                           </div>
                       @endif

                   </div>
               </div>
           </div>
       </section>

{{--       <div class="pagination-wrapper d-flex justify-content-center align-items-center flex-wrap">--}}
{{--           <div class="pagination-item arrow-left">&lt;</div>--}}
{{--           <div class="pagination-item active">1</div>--}}
{{--           <div class="pagination-item">2</div>--}}
{{--           <div class="pagination-item">3</div>--}}
{{--           <div class="pagination-item arrow-right">&gt;</div>--}}
{{--       </div>--}}
   </section>

@stop
