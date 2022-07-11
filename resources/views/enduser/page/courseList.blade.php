@extends("enduser.layout")


    @if(@$page)
        @include("enduser.meta", [
            'title' => $page->meta_title,
            'description' => $page->meta_description,
            'link' => route('course.courseList'),
            'img' => asset('images/config/' . $page->picture)
        ])
    @endif

@section('content')

   @include("enduser.partials.breadcrumb",[ 'mainpage' => "Trang chủ",'name' => 'Danh sách khóa học'])
   @include("enduser.components.banner_course")
   <section class="section section-product">
       <div class="container">
           <form action="{{route('course.searchResult')}}" method="get">
               <div class="section-header d-flex align-items-center justify-content-between">
                   <div></div>
                   @csrf
                   <div class="table-header-action d-flex justify-content-between">
                       <div class="action-item d-flex align-items-center search w-100">
                           <input type="text" name="search" placeholder="Tìm kiếm theo tên">
                           <button type="submit"><img src="{{asset("enduser/assets/icons/icon-search.svg")}}" alt=""></button>
                       </div>
                   </div>
               </div>
           </form>
       </div>
       @foreach($categories as $k => $category)
       <div class="container">
           @include("enduser.partials.title_section", ['name' => $category->name, 'more' => route('course.courseListInCategory', [ 'slug_category' => $category->slug ]), 'icon'=>   asset('enduser/assets/icons/icon-book.svg')  ])
           <div class="section-main">
               <div class="row">
                   @php
                        $courses = $category->courses()->where('course_courses.status','active')->orderBy('id','desc')->limit(10)->get();
                   @endphp
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
        @endforeach
   </section>

@stop
