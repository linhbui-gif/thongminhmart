@extends("enduser.layout")

@section('content')

    @include("enduser.partials.breadcrumb", [ 'mainpage' => "Trang chủ",'name' => 'Khóa học của tôi' ])


    <div class="user-layout">
       <div class="container">
           <div class="user-layout-wrapper">
               <div class="row">
                   <div class="col-lg-3">
                       @include("enduser.components.account.sidebar")
                   </div>
                   <div class="col-lg-9">
                       <div class="user-layout-main">
                           <h3 class="layout-title">Khoá học của tôi</h3>
                           <div class="section-main" style="margin-bottom: 15px">
                               <div class="row">
                                   @php
                                       $user = \Auth::user();
                                   @endphp
                                   @if($list_user_lesson->count() > 0)
                                       @foreach($list_user_lesson as $key => $value)
                                           @php
                                               $list_chapter = [];
                                                $list_lessons = [];
                                                $chappter = $value->chapters;
                                                $lastChappter = [];
                                                foreach ($chappter as $key => $value_chappter){
                                                        $list_chapter[$key] = $value_chappter->lessons()->orderBy('sort', 'asc')->get();

                                                }
                                                $indexWatchedLast = 0;
                                                $countWatched = 0;
                                                foreach ($list_chapter as $key => $value_c){
                                                    foreach ($value_c as $item => $collection){
                                                        $list_lessons[] = $collection;
                                                        $exist = \Illuminate\Support\Facades\DB::table('user_lesson')->where('user_id', $user->id)->where('lesson_id', $collection->id)->first();
                                                        if($exist){
                                                            $countWatched++;
                                                        }
                                                    }
                                                }
                                                $totalLesson = count($list_lessons);
                                                $phantram = 0;
                                                if($totalLesson <= 0){
                                                    $phantram = 0;
                                                }else{
                                                    $phantram = floor($countWatched  * 100 / $totalLesson);
                                                }


                                           @endphp
                                           <div class="col-lg-4 col-sm-6">
                                               <div class="product-component">
                                                   <div class="product-image"> <a href="{{ route('course.lessionDetailChapter', $value->slug) }}"><img class="lazyload" data-src="{{  $value->url_picture }}" alt=""></a>
                                                   </div><a class="product-title" href="{{ route('course.lessionDetailChapter', $value->slug) }}">{{ $value->name }}</a>
                                                   <div class="line"> </div>
                                                   <div class="product-progress-wrapper">
                                                       <div class="product-progress-label d-flex justify-content-between">
                                                           <p>Hoàn thiện:</p>
                                                           <p>{{ $phantram }}%</p>
                                                       </div>
                                                       <div class="product-progress">
                                                           <div class="progress-bar" style="width: {{ $phantram }}%;"></div>
                                                       </div>
                                                   </div>
                                               </div>
                                           </div>
                                       @endforeach
                                   @endif

                               </div>
                           </div>
{{--                           <div class="pagination-wrapper d-flex justify-content-center align-items-center flex-wrap">--}}
{{--                               <div class="pagination-item arrow-left">&lt;</div>--}}
{{--                               <div class="pagination-item active">1</div>--}}
{{--                               <div class="pagination-item">2</div>--}}
{{--                               <div class="pagination-item">3</div>--}}
{{--                               <div class="pagination-item arrow-right">&gt;</div>--}}
{{--                           </div>--}}
                       </div>
                   </div>
               </div>
           </div>
       </div>
   </div>


@stop
