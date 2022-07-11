@extends("enduser.layout")

@section('css')

    <link rel="stylesheet" type="text/css" href="{{ asset('enduser/assets/modal-video/css/modal-video.min.css') }}" >

@stop

@section('meta')
    @include("enduser.meta",[
        'title' => $course->meta_title,
        'description' => $course->meta_description,
        'link' => route('course.courseDetail',  [ 'slug_category' => isset($course->category) ? $course->category->slug : "chua-ro", 'course_slug' => $course->slug ] ),
        'img' => asset('images/course_courses/' . $course->picture)
    ])

@stop

@section('content')
    @php
        $totalStar = $course->comments()->where('star', '>', 0)->count();
        $fiveStar = $course->comments()->where('star', 5)->count();
        $fourStar = $course->comments()->where('star', 4)->count();
        $threeStar = $course->comments()->where('star', 3)->count();
        $twoStar = $course->comments()->where('star', 2)->count();
        $oneStar = $course->comments()->where('star', 1)->count();

        if($totalStar > 0){
            $trungbinh = (5 * $fiveStar + 4 *  $fourStar + 3 * $threeStar + 2 * $twoStar +  $oneStar) / ( $fiveStar + $fourStar + $threeStar + $twoStar + $oneStar);
        }else{
            $trungbinh = 0;
        }

    @endphp
    @include("enduser.partials.breadcrumb",[ 'mainpage' => $course ? "Khóa học" : '','name' => $course->name ])

   <section class="section-course-detail course-detail-infomation">
       <div class="container">
           <form action="{{ route('order.addCart') }}" method="GET" id="frmCart">
               @csrf
               @method('GET')
           <div class="section-course-detail-wrapper">
               <div class="row">
                   <div class="col-lg-6 col-banner">
                       <div class="course-banner-carousel">
                           @php
                           $galleries = json_decode($course->gallery);
                           @endphp
                           <div class="course-preview">
                               <div class="owl-carousel" id="course-preview-carousel">
                                   @if(!empty($course->thumbnail_intro_url) && !empty($course->video_intro))
                                       <div class="item">
                                           <div data-video-id="{{ $course->video_intro }}" class="js-modal-btn course-carousel-item"><img class="lazyload" data-src="{{ $course->thumbnail_intro_url }}" alt="">
                                               <span class="icon_play">
                                                    <svg aria-hidden="true" focusable="false" data-prefix="fab" data-icon="youtube" class="svg-inline--fa fa-youtube fa-w-18" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><path fill="currentColor" d="M549.655 124.083c-6.281-23.65-24.787-42.276-48.284-48.597C458.781 64 288 64 288 64S117.22 64 74.629 75.486c-23.497 6.322-42.003 24.947-48.284 48.597-11.412 42.867-11.412 132.305-11.412 132.305s0 89.438 11.412 132.305c6.281 23.65 24.787 41.5 48.284 47.821C117.22 448 288 448 288 448s170.78 0 213.371-11.486c23.497-6.321 42.003-24.171 48.284-47.821 11.412-42.867 11.412-132.305 11.412-132.305s0-89.438-11.412-132.305zm-317.51 213.508V175.185l142.739 81.205-142.739 81.201z"></path></svg>
                                               </span>
                                           </div>
                                       </div>
                                   @endif
                                   @foreach($galleries as $k => $picture)
                                       @php
                                            $src = asset($picture);
                                       @endphp
                                   <div class="item">
                                       <div class="course-carousel-item"><img class="lazyload" data-src="{{ $src }}" alt=""></div>
                                   </div>
                                   @endforeach
                               </div>
                           </div>
                           <div class="course-control">
                               <div class="owl-carousel" id="course-control-carousel">
                                   @if(!empty($course->thumbnail_intro_url) && !empty($course->video_intro))
                                       <div class="item">
                                           <div class="course-carousel-item"><img class="lazyload" data-src="{{ $course->thumbnail_intro_url }}" alt=""></div>
                                       </div>
                                   @endif
                                   @foreach($galleries as $k => $picture)
                                       @php
                                           $src = asset($picture);
                                       @endphp
                                       <div class="item">
                                           <div class="course-carousel-item"><img class="lazyload" data-src="{{ $src }}" alt=""></div>
                                       </div>
                                   @endforeach
                               </div>
                           </div>
                       </div>
                   </div>
                   <div class="col-lg-6 col-info">

                       <div class="course-detail-info">
                           <h2 class="course-title">{{ $course->name }}</h2>
                           <!-- Two status: stocking / out-of-stock-->
                           <p class="course-status">(<span class="stocking">Còn hàng</span>)</p>
                           <div class="line"> </div>
                           <div class="course-rating d-flex align-items-center">
                               <div class="rating-star d-flex align-items-center">
                                   @for($i = 1; $i < 6; $i++)
                                       @if($i <= round($trungbinh))
                                           <img class="star active " src="{{ asset('enduser/assets/icons/icon-star-fill-yellow.svg') }}" alt="">
                                       @else
                                           <img class="star " src="{{ asset('enduser/assets/icons/icon-star-yellow.svg') }}" alt="">
                                       @endif
                                   @endfor
                               </div>
                               <div class="rating-label">{{ round($trungbinh) }} ({{ $totalStar }} đánh giá)</div>
                           </div>
                           @php
                               $compos = $course->compos()->orderBy('compo.ordering', 'asc')->get();
                               $count_compo = count($compos);
                           @endphp
                           @if($course->price_base == "-1")
                               <h5 class="course-price">Miễn phí</h5>
                           @elseif($course->price_base == "-2")
                               <h5 class="course-price">Coming soon</h5>
                            @else
                               @if($count_compo > 0)
                                   @if($count_compo == 1)
                                       <h5 class="course-price">{{ number_format($compos[0]->price)  }} đ</h5>
                                   @else
                                       <h5 class="course-price">{{ number_format($course->price_base)  }} đ</h5>
                                   @endif
                               @endif
                           @endif

                           <div class="course-options d-flex flex-wrap">
                               @if($course->price_base == 0)

                               @else
                                   @if($count_compo > 0)
                                       @if($count_compo == 1)
                                           @foreach($compos as $k => $compo)
                                               <div data-id="{{ $compo->id }}"class="course-option-item d-flex align-items-center justify-content-center active">{{ $compo->name }}<input type="hidden" value="{{ number_format($compo->price) }}" name="price_custom"></div>
                                           @endforeach
                                       @else
                                           @foreach($compos as $k => $compo)
                                               <div data-id="{{ $compo->id }}"class="course-option-item d-flex align-items-center justify-content-center">{{ $compo->name }}<input type="hidden" value="{{ number_format($compo->price) }}" name="price_custom"></div>
                                           @endforeach
                                       @endif

                                   @endif
                                   @if($count_compo > 0)
                                       @if($count_compo > 1)
                                           <input type="hidden" name="compo_id" value="0">
                                       @else
                                           <input type="hidden" name="compo_id" value="{{ $compos[0]->id }}">
                                       @endif
                                   @endif
                               @endif

                           </div>
                           @if($count_compo > 0)
                               @if($count_compo > 1)
                                    <div class="reset_compo">
                                        <span class="clear_compo">Clear</span>
                                        <input class="hidden_price" type="hidden" value="{{ number_format($course->price_base) }}">
                                    </div>
                               @else
                                   <input class="hidden_price" type="hidden" value="{{ number_format($course->price_base) }}">
                               @endif
                           @endif
                           <div class="line"></div>
                           <div class="course-buttons">
                               <div class="button-group d-flex justify-content-between half flex-wrap">
{{--                                   <input type="hidden" value="{{$course->id}}" name="id">--}}
                                       <input type="hidden" name="action" id="action">
                                        @if($course->price_base == -1)
                                            <button onclick="learnNow()" type="button" class="button-item primary">Học ngay</button>
                                        @else
                                       @if($count_compo <= 0)
                                           <button type="button" class="button-item primary my_disabled">Comming soon</button>
                                       @else
                                           <button onclick="buynow()" type="button" class="button-item primary">Mua ngay</button>
                                           <button onclick="addToCart()" class="button-item" type="button">Thêm vào giỏ hàng </button>
                                       @endif
                                        @endif
                                       <input type="hidden" name="id" value="{{ $course->id }}">

                               </div>
                               <div id="msg_area"></div>
                               @if(Session::has('cartSuccess'))
                                   <div class="alert alert-success alert-dismissible w-100 mt-2">
                                       <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                       {{ Session::get('cartSuccess') }}
                                       <a href="{{route('order.cart')}}" >Đi đến giỏ hàng</a>
                                   </div>
                               @endif
                               @if(Session::has('cartError'))
                                   <div class="alert alert-danger alert-dismissible w-100 mt-2">
                                       <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                       {{ Session::get('cartError') }}
                                   </div>
                               @endif
                           </div>
                           <h4 class="course-sub-title">Thẻ</h4>
                           <div class="course-tags d-flex flex-wrap">
                               @if(isset($course_tag))
                                   @foreach($course_tag as $key => $value)
                                       <a href="{{  route('course.courseTagSlug', $value->slug) }}"><div class="tag-item">{{  $value->name }}</div></a>
                                   @endforeach
                               @endif
                           </div>
                           <h4 class="course-sub-title">Chia sẻ</h4>
                           <div class="socials-item-wrapper d-flex align-items-center flex-wrap">
                               @php
                                $linkShare = route('course.courseDetail',  [ 'slug_category' => isset($course->category) ? $course->category->slug : "chua-ro", 'course_slug' => $course->slug ] );
                               @endphp
                               <a class="social-item" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u={{ $linkShare }}"><img src="{{ asset('enduser/assets/icons/icon-facebook.svg') }}" alt=""></a>
                               <a class="social-item" target="_blank" href="https://twitter.com/intent/tweet?url={{ $linkShare }}"><img src="{{ asset('enduser/assets/icons/icon-twitter.svg') }}" alt=""></a>
                               <a class="social-item" target="_blank" href="https://www.instagram.com/?url={{ $linkShare }}"><img src="{{ asset('enduser/assets/icons/icon-instagram.svg') }}" alt=""></a>
                           </div>

{{--                           <div class="course-services">--}}
{{--                               <h3>Chúng tôi bán trải nghiệm </h3>--}}
{{--                               <div class="service-item d-flex align-items-center"> <img class="item-icon" src="{{asset('enduser/assets/icons/icon-giftbox-red.svg')}}" alt="">--}}
{{--                                   <p class="item-info"><strong>Miễn phí giao hàng</strong> với đơn hàng trên 300k. Nhập mã <strong>FREEE300</strong></p>--}}
{{--                               </div>--}}
{{--                               <div class="service-item d-flex align-items-center"> <img class="item-icon" src="{{asset('enduser/assets/icons/icon-giftbox-red.svg')}}" alt="">--}}
{{--                                   <p class="item-info">Đổi trả sản phẩm <strong>7 ngày</strong> không cần lý do</p>--}}
{{--                               </div>--}}
{{--                               <div class="service-item d-flex align-items-center"> <img class="item-icon" src="{{asset('enduser/assets/icons/icon-giftbox-red.svg')}}" alt="">--}}
{{--                                   <p class="item-info"><strong>Giao hàng mới hoàn toàn</strong>, nếu hàng lỗi chỉ cần số điện thoại và địa chỉ</p>--}}
{{--                               </div>--}}
{{--                               <div class="service-item d-flex align-items-center"> <img class="item-icon" src="{{asset('enduser/assets/icons/icon-giftbox-red.svg')}}" alt="">--}}
{{--                                   <p class="item-info">Tư vấn <strong>24/7</strong></p>--}}
{{--                               </div>--}}
{{--                           </div>--}}
                           {!! $course->short_description !!}
                       </div>

                   </div>

               </div>
           </div>
           </form>
       </div>
   </section>
   <div class="section-course-tab-wrapper">
       <div class="tab-wrapper">
           <div class="container tab-wrapper-container">
               <div class="tabs-group d-flex" style="margin-bottom: 15px;">
                   <a class="tab-item active my-tab-item" data-href="#thong-tin-chung">Thông tin chung</a>
                   <a class="tab-item my-tab-item" data-href="#ket-qua">Kết quả</a>
                   <a class="tab-item my-tab-item" data-href="#giao-trinh">Giáo trình</a>
                   <a class="tab-item my-tab-item" data-href="#hoc-lieu">Học liệu</a>
                   <a class="tab-item my-tab-item" data-href="#giang-vien">Giảng viên</a>
                   <a class="tab-item my-tab-item" data-href="#nhan-xet">Nhận xét</a>
               </div>
           </div>
           <div class="tabs-main-group">
               <div class="pos_tab" id="thong-tin-chung" style="padding-top: 48px;">
                   <div class="tab-item">
                       <section class="section-course-detail course-detail-description">
                           <div class="container">
                               <div class="section-course-detail-wrapper">
                                   <h3 class="section-course-title">Thông tin chung</h3>
                                   <div class="description-wrapper style-content-editable">
                                       {!! $course->content !!}
                                   </div>
                               </div>
                           </div>
                       </section>
                   </div>
               </div>
               <div class="pos_tab" id="ket-qua" style="padding-top: 48px;">
                   <div class="tab-item">
                       @php
                           $arrResult = json_decode($course->result, true);
                       @endphp
                       <section class="section-course-detail course-detail-result">
                           <div class="result-modal modal fade" id="resultModal" tabindex="-1" role="dialog" aria-labelledby="resultModal" aria-hidden="true">
                               <div class="modal-dialog" role="document">
                                   <div class="modal-content">
                                       <div class="modal-header">
                                           <button class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times</span></button>
                                       </div>
                                       <div class="modal-body">
                                           <div class="result-wrapper">
                                               @if(isset($arrResult['gallery']))
                                                   @foreach($arrResult['gallery'] as $k => $item)
                                                    <div class="new-box-component vertical">
                                                   <a class="new-image" href="#"> <img class="lazyload" data-src="{{ $item['image'] }}" alt="" /></a>
                                                   <div class="new-info">
                                                       <p class="new-des">{{ $item['title'] }}</p>
                                                   </div>
                                               </div>
                                                   @endforeach
                                               @endif
                                           </div>
                                       </div>
                                   </div>
                               </div>
                           </div>
                           <div class="container">

                               <div class="section-course-detail-wrapper">
                                   <h3 class="section-course-title">Chúng ta sẽ học được gì?</h3>
                                   <div class="result-wrapper">
                                       <div class="owl-carousel custom-carousel-style arrow-top" id="result-carousel-section">
                                           @if(isset($arrResult['gallery_slider']))
                                               @foreach($arrResult['gallery_slider'] as $k => $item)
                                                   <div class="item">
                                                       <div class="result-item">
                                                           <h4 class="result-title text-center">{{ $item['title'] }}</h4>
                                                           <p class="result-des">
                                                               {{ $item['description'] }}
                                                           </p>
                                                           <div class="result-image"><img class="lazyload" data-src="{{ $item['image'] }}" alt="" /></div>
                                                       </div>
                                                   </div>
                                               @endforeach
                                           @endif


                                       </div>
                                   </div>
                                   <h3 class="section-course-title">Kết quả</h3>
                                    @if(isset($arrResult['description']))
                                       {!! $arrResult['description'] !!}
                                   @endif

                                   <div class="result-wrapper">

                                       <div class="result-wrapper">

                                           <div class="owl-carousel custom-carousel-style arrow-top" id="result-carousel-section-2">
                                           @if(isset($arrResult['gallery']))
                                               @foreach($arrResult['gallery'] as $k => $item)
                                                   <div class="item" data-toggle="modal" data-target="#resultModal">
                                                       <div class="new-box-component vertical">
                                                           <a class="new-image" href="#"> <img class="lazyload" data-src="{{ $item['image'] }}" alt="" /></a>
                                                           <div class="new-info">
                                                               <p class="new-des text-center">{{ $item['title'] }}</p>
                                                           </div>
                                                       </div>
                                                   </div>
                                               @endforeach
                                           </div>
                                           @endif
                                       </div>
                                   </div>

                               </div>
                           </div>
                       </section>
                   </div>
               </div>
               <div class="pos_tab" id="giao-trinh" style="padding-top: 48px;">
                   <div class="tab-item">
                       <section class="section-course-detail course-detail-lesson">
                           <div class="container">
                               <div class="section-course-detail-wrapper">
                                   <h3 class="section-course-title">Giáo trình </h3>
                                   <div class="lesson-overview-wrapper d-flex justify-content-between align-items-center">
                                       <h4 class="course-sub-title">Thông tin: </h4>
                                       <div class="lesson-overview d-flex">
                                           @php
                                                $chapters = $course->chapters;
                                                $totalLesson = \App\Helper\Common::getTotalLesson($chapters);
                                                $totalTime = \App\Helper\Common::getTotalTimeLesson($chapters);
                                           @endphp
                                           <div class="total-item d-flex align-items-center"> <img src="{{ asset('enduser/assets/icons/icon-play.svg') }}" alt=""><span>Số bài <strong>{{ $totalLesson }}</strong></span></div>
                                           <div class="total-item d-flex align-items-center"> <img src="{{ asset('enduser/assets/icons/icon-clock.svg') }}" alt=""><span>Tổng thời gian <strong>{{ $totalTime }}</strong></span></div>
                                       </div>
                                   </div>
                                   <div class="lesson-lists-wrapper">
                                       <div class="list-single-lesson">
                                           <div class="list-header d-flex justify-content-between align-items-center">
                                               <h3 class="list-name d-flex align-items-center"><img src="{{ asset('enduser/assets/icons/icon-play.svg') }}" alt="">Khoá học</h3>
                                               <p class="list-total">{{ $totalLesson  }} bài</p>
                                           </div>
                                           <div class="list-main">
                                               @php
                                                    $chapters = $course->chapters()->orderBy('ordering','asc')->get();
                                               @endphp
                                               @foreach($chapters as $k => $chapter)
                                                   @php
                                                        $lessons = $chapter->lessons()->orderBy('sort','asc')->get();
                                                   @endphp
                                                   <div class="list-item d-flex flex-wrap align-items-center">
                                                       <div class="item-image"><img class="lazyload" data-src="{{ $chapter->url_picture }}" alt=""></div>
                                                       <div class="item-info"> <a class="item-title" href="#">{{ $chapter->name }}</a>
                                                           <ul>
                                                               @foreach($lessons as $stt => $lesson)
{{--                                                               <li class="d-flex align-items-start"> <span class="number">{{ $stt + 1 }}</span><span class="text"><a href="{{ route('course.lessionDetailChapter',  [ 'slug_lesson' => $course->slug ]  ) }}?lesson={{ $lesson->id }}">{{ $lesson->label }}</a> </span></li>--}}
                                                                   @if(empty($lesson->video_demo))
                                                                       <li class="d-flex align-items-start"> <span class="number">{{ $stt + 1 }}</span><span class="text"><a   href="javascript:void(0)">{{ $lesson->label }}</a></span></li>
                                                                       @else
                                                                       <li class="d-flex align-items-start"> <span class="number">{{ $stt + 1 }}</span><span class="text"><a class="js-modal-btn" data-video-id="{{ $lesson->video_demo }}" href="javascript:void(0)">{{ $lesson->label }} <span class="icon_play_demo"><svg aria-hidden="true" focusable="false" data-prefix="far" data-icon="play-circle" class="svg-inline--fa fa-play-circle fa-w-16" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path fill="currentColor" d="M371.7 238l-176-107c-15.8-8.8-35.7 2.5-35.7 21v208c0 18.4 19.8 29.8 35.7 21l176-101c16.4-9.1 16.4-32.8 0-42zM504 256C504 119 393 8 256 8S8 119 8 256s111 248 248 248 248-111 248-248zm-448 0c0-110.5 89.5-200 200-200s200 89.5 200 200-89.5 200-200 200S56 366.5 56 256z"></path></svg></span></a></span></li>
                                                                       @endif

                                                                @endforeach
                                                           </ul>
                                                       </div>
                                                   </div>
                                               @endforeach
                                           </div>
                                       </div>
                                   </div>
                               </div>
                           </div>
                       </section>
                   </div>
               </div>
               <div class="pos_tab" id="hoc-lieu" style="padding-top: 48px;">
                   <div class="tab-item">
                       <section class="section-course-detail course-detail-result">
                           <div class="container">
                               <div class="section-course-detail-wrapper">
                                   <h3 class="section-course-title">Học liệu</h3>
                                   <div class="section-main">
                                       <div class="description-wrapper style-content-editable">
                                        {!! $course->hoclieu !!}
                                       </div>
                                   </div>
                               </div>
                           </div>
                       </section>
                   </div>
               </div>
               <div class="pos_tab" id="giang-vien" style="padding-top: 48px;">
                   <div class="tab-item">
                       <section class="section-course-detail course-detail-result">
                           <div class="container">
                               <div class="section-course-detail-wrapper">
                                   <h3 class="section-course-title">Giảng viên</h3>
                                   <div class="section-main">
                                       <div class="description-wrapper style-content-editable">
                                           {!! $course->giangvien !!}
                                       </div>
                                   </div>
                               </div>
                           </div>
                       </section>
                   </div>
               </div>
               <div class="pos_tab" id="nhan-xet" style="padding-top: 48px;">
                   <div class="tab-item">
                       <section class="section-course-detail course-detail-rating">
                           <div class="container">
                               <div class="section-course-detail-wrapper">

                                   <h3 class="section-course-title">Đánh giá</h3>
                                   <div class="row">
                                       <div class="col-lg-4 col-rating">
                                           <div class="rating-group-wrapper">
                                               <div class="rating-number">
                                                   <h3 class="rating-value">{{ round($trungbinh) }}</h3>
                                                   <div class="rating-star d-flex align-items-center justify-content-center">
                                                       @for($i = 1; $i < 6; $i++)
                                                           @if($i <= round($trungbinh))
                                                               <img class="star active "src="{{ asset('enduser/assets/icons/icon-star-fill-yellow.svg') }}" alt="">
                                                           @else
                                                               <img class="star " src="{{ asset('enduser/assets/icons/icon-star-yellow.svg') }}" alt="">
                                                           @endif
                                                       @endfor
                                                   </div>
                                                   <div class="rating-label">{{ round($trungbinh) }} ({{ $totalStar }} đánh giá)</div>
                                               </div>
                                               <div class="rating-process-wrapper">
                                                   <div class="process-item d-flex align-items-center justify-content-center">
                                                      @php

                                                        if($totalStar > 0){
                                                            $phantran = $fiveStar / $totalStar * 100;
                                                        }else{
                                                            $phantran = 0;
                                                        }
                                                      @endphp
                                                       <div class="rating-count-star">5</div>
                                                       <div class="rating-process">
                                                           <div class="rating-bar" style="width: {{ $phantran }}%;"></div>
                                                       </div>
                                                       <div class="rating-percent">{{ round($phantran) }}%</div>
                                                   </div>
                                                   <div class="process-item d-flex align-items-center justify-content-center">
                                                       @php

                                                            if($totalStar > 0){
                                                                 $phantran = $fourStar / $totalStar * 100;
                                                            }else{
                                                                $phantran = 0;
                                                            }
                                                       @endphp
                                                       <div class="rating-count-star">4</div>
                                                       <div class="rating-process">
                                                           <div class="rating-bar" style="width: {{ $phantran }}%;"></div>
                                                       </div>
                                                       <div class="rating-percent">{{ round($phantran) }}%</div>
                                                   </div>
                                                   <div class="process-item d-flex align-items-center justify-content-center">
                                                       @php

                                                             if($totalStar > 0){
                                                                 $phantran = $threeStar / $totalStar * 100;
                                                             }else{
                                                                 $phantran = 0;
                                                             }
                                                       @endphp
                                                       <div class="rating-count-star">3</div>
                                                       <div class="rating-process">
                                                           <div class="rating-bar" style="width: {{ $phantran }}%;"></div>
                                                       </div>
                                                       <div class="rating-percent">{{ round($phantran) }}%</div>
                                                   </div>
                                                   <div class="process-item d-flex align-items-center justify-content-center">
                                                       @php
                                                           if($totalStar > 0){
                                                                $phantran = $twoStar / $totalStar * 100;
                                                            }else{
                                                                $phantran = 0;
                                                            }

                                                       @endphp
                                                       <div class="rating-count-star">2</div>
                                                       <div class="rating-process">
                                                           <div class="rating-bar" style="width: {{ $phantran }}%;"></div>
                                                       </div>
                                                       <div class="rating-percent">{{ round($phantran) }}%</div>
                                                   </div>
                                                   <div class="process-item d-flex align-items-center justify-content-center">
                                                       @php

                                                            if($totalStar > 0){
                                                                 $phantran = $oneStar / $totalStar * 100;
                                                            }else{
                                                                $phantran = 0;
                                                            }
                                                       @endphp
                                                       <div class="rating-count-star">1</div>
                                                       <div class="rating-process">
                                                           <div class="rating-bar" style="width: {{ $phantran }}%;"></div>
                                                       </div>
                                                       <div class="rating-percent">{{ round($phantran) }}%</div>
                                                   </div>
                                               </div>
                                           </div>
                                       </div>
                                       <div class="col-lg-8 col-comments">
                                           <div class="comments-group-wrapper">
                                               <div class="comment-users-lists">
                                                   @if(count($comments) > 0)
                                                       @include("enduser.components.showComment", [ 'comments' => $comments ])
                                                   @else
                                                   <p>Chưa có đánh giá nào</p>
                                                   @endif
{{--                                                   <div class="comment-item">--}}
{{--                                                       <div class="comment-header d-flex aligns-item-center">--}}
{{--                                                           <div class="comment-avatar"> <img src="{{ asset('enduser/assets/images/image-avatar-placeholder.webp') }}" alt=""></div>--}}
{{--                                                           <div class="comment-info">--}}
{{--                                                               <h6 class="comment-name">User 5</h6>--}}
{{--                                                               <div class="rating-star d-flex align-items-center"><img src="{{ asset('assets/icons/icon-star-fill-yellow.svg') }}" alt=""><img src="{{ asset('enduser/assets/icons/icon-star-fill-yellow.svg') }}" alt=""><img src="{{ asset('enduser/assets/icons/icon-star-fill-yellow.svg') }}" alt=""><img src="{{ asset('enduser/assets/icons/icon-star-yellow.svg') }}" alt=""><img src="{{ asset('enduser/assets/icons/icon-star-yellow.') }}svg" alt=""></div>--}}
{{--                                                           </div>--}}
{{--                                                       </div>--}}
{{--                                                       <div class="comment-caption">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</div>--}}
{{--                                                       <div class="comment-action d-flex align-items-center">--}}
{{--                                                           <div class="action-item like d-flex align-items-center"><img src="{{ asset('enduser/assets/icons/icon-like-gray.svg') }}" alt=""><span>3</span></div>--}}
{{--                                                           <div class="action-item dislike d-flex align-items-center"><img src="{{ asset('enduser/assets/icons/icon-dislike-gray.svg') }}" alt=""><span>3</span></div>--}}
{{--                                                           <div class="action-item reply d-flex align-items-center"><img src="{{ asset('enduser/assets/icons/icon-reply-gray.svg') }}" alt=""><span>Reply</span></div>--}}
{{--                                                       </div>--}}
{{--                                                   </div>--}}
                                               </div>
                                               <h4 class="course-sub-title">Thêm đánh giá</h4>
                                               <div class="rating-star d-flex align-items-center rating-action" id="rating-action">
                                                   <img data-num="1" class="star active" src="" alt="">
                                                   <img data-num="2" class="star active" src="" alt="">
                                                   <img data-num="3" class="star active" src="" alt="">
                                                   <img data-num="4" class="star active" src="" alt="">
                                                   <img data-num="5" class="star active" src="" alt="">
                                               </div>
                                               <h4 class="course-sub-title">Đánh giá</h4>
                                               <form id="frmComment" method="POST" class="comment-form authen-form" action="{{ route('course.addComment') }}" enctype="multipart/form-data">
                                                   @csrf
                                                   <textarea name="body" placeholder="Viết 1 đánh giá"></textarea>
                                                   <div class="form-item list-uploads d-flex flex-wrap" id="show-thumb-upload">
{{--                                                       <div class="upload-item"> <img class="item-image" src="{{ asset('enduser/assets/images/image-sample-product.jpg') }}" alt=""><img class="item-delete" src="{{ asset('enduser/assets/icons/icon-close-circle.svg') }}" alt=""></div>--}}
{{--                                                       <div class="upload-item"> <img class="item-image" src="{{ asset('enduser/assets/images/image-sample-product.jpg') }}" alt=""><img class="item-delete" src="{{ asset('enduser/assets/icons/icon-close-circle.svg') }}" alt=""></div>--}}
                                                   </div>
                                                   <div class="d-flex justify-content-between align-items-center">
                                                       <div class="form-item upload icon">
                                                           <input name="images" type="file"><img src="{{ asset('enduser/assets/icons/icon-image-gray.svg') }}" alt="">
                                                       </div>
                                                       <div class="form-item button-checkout">
                                                           <button onclick="submitFormComment(this)" class="btn" type="button">Đồng ý</button>
                                                       </div>
                                                   </div>
                                                   <input type="hidden" name="star" value="0">
                                                   <input type="hidden" name="parent_id" value="0">
                                                   <input type="hidden" name="course_id" value="{{ $course->id }}">
                                               </form>

                                           </div>
                                       </div>
                                   </div>
                               </div>
                           </div>
                       </section>
                   </div>
               </div>
           </div>
       </div>
   </div>



@stop

@section('script')

    <script>
        $(".rating-action img.star").hover(function() {
            var star = $(".rating-action img.star");
            var current = $(this);
            var num = current.data('num');
            resetStar(star);
            if(current.hasClass("active")){
                current.removeClass('active');
            }else{
                $.each(star,function(i,e){
                    if(i < num){
                        $(e).addClass("active");
                    }
                });
            }
            syncStar();
        }, function() {

        });
        syncStar();
        function resetStar(star){
            $.each(star,function(i,e){
                $(e).removeClass("active");
            });
        }
        function syncStar(){
            $(".rating-action img.star").prop('src', '{{ asset('enduser/assets/icons/icon-star-yellow.svg') }}');
            $(".rating-action img.star.active").prop('src', '{{ asset('enduser/assets/icons/icon-star-fill-yellow.svg') }}');
        }
        function submitFormComment(t){
            var numStar = $(".rating-action img.star.active").length;
            $("#frmComment input[name='star']").val(numStar);
            $("#frmComment").submit();
        }
        function like(t, like, comment_id){
            var parent = $(t).parent(".comment-action");
            parent.find("input[name='like']").val(like);
            parent.find("input[name='comment_id']").val(comment_id);
            parent.find('form').submit();
        }
        $(".course-option-item").click(function(){
            $(this).parent(".course-options").find(".course-option-item").removeClass("active");
            $(this).addClass("active");
            var id = $(this).data("id");
            $("input[name='compo_id']").val(id);
            var price = $(this).find("input[name='price_custom']").val();
            $(".section-course-detail-wrapper .course-price").text(price + " đ");
        });
    </script>
    <script>
        $(".upload input[type=file]").change(function(){
            readURL(this);
        });

        function readURL(input) {
            var inputObj = $(input);
           // inputObj.parents(".file_picture").children(".image-upload").remove();

            if (input.files && input.files[0]) {

                var reader = new FileReader();
                reader.onload = function(e) {
                    var src = e.target.result;
                    var htmlImage = '<div class="upload-item"> <img class="item-image " src="'+src+'" alt=""><img onclick="deteleThumb(this)" class="item-delete " src="/enduser/assets/icons/icon-close-circle.svg" alt=""></div>';
                    $("#show-thumb-upload").html(htmlImage);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }
        function deteleThumb(t){
            var tObj = $(t);
            tObj.parents(".upload-item").remove();
            $(".upload input[type=file]").val('');
        }
    </script>
    <script>
        function checkCompo(){
            var compo_id = $("input[name='compo_id']").val();

            $("#msg_area").html('');
            if(compo_id == "0" || compo_id == ""){
                // thêm lỗi
                var msg = `<div class="alert alert-danger alert-dismissible w-100 mt-2">
                                       <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                       Vui lòng chọn combo khóa học
                            </div>`;
                $("#msg_area").html(msg);
                return false;
            }
            return true;
        }
        function buynow(){
            if(checkCompo()) {
                $("#action").val("buynow");
                $("#frmCart").submit();
            }
        }
        function addToCart(){
            if(checkCompo()){
                $("#action").val("add_cart");
                $("#frmCart").submit();
            }
        }
        function learnNow(){
            var link = '{{ route('order.learnNow') }}';
            $("#frmCart").attr("action", link);
            $("#action").val("learnNow");
            $("#frmCart").submit();
        }

    </script>
    @if($errors->any('body'))
        <script>
            toastr.error('Nội dung đánh giá không được rỗng', 'Thất bại');
        </script>
    @endif
    <script  src="{{ asset('enduser/assets/modal-video/js/jquery-modal-video.js') }}"></script>
    <script>
        $(".js-modal-btn").modalVideo({channel:'vimeo'});
    </script>
    <script>
        jQuery(document.documentElement).keyup(function (event) {

            var owl = jQuery(".owl-carousel");

            // handle cursor keys
            if (event.keyCode == 37) {
                // go left
                owl.trigger('prev.owl.carousel');
            } else if (event.keyCode == 39) {
                // go right
                owl.trigger('next.owl.carousel');
            }

        });
    </script>
@stop


