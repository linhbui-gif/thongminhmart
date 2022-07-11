@extends("enduser.layout")
@section('head')

    @if($page)
        @include("enduser.meta", [
            'title' => $page->meta_title,
            'description' => $page->meta_description,
            'link' => route('SiteTeacher'),
            'img' => asset('images/config/' . $page->picture)
        ])
    @endif
    @php
        $page_content = unserialize($page->content);
    @endphp
@stop
@section('content')

    @include("enduser.partials.breadcrumb",[ 'mainpage' => "Trang chủ",'name' => 'Trở thành giảng viên'])

   <section class="section-banner">
       <div class="container">
           <div class="row">
               <div class="col-lg-5 col-info">
                   <div class="banner-item info">
                       <h2 class="banner-title">{{$page_content['slider' ]['name']}}</h2>
                       <p class="banner-des">{{$page_content['slider' ]['description']}}</p>
                       <div class="banner-btn-group d-flex">
{{--                           <form action="#" method="POST">--}}
{{--                               <button class="btn primary">Become an Instructor</button>--}}
{{--                                @csrf--}}
{{--                           </form>--}}
                           <a class="btn primary" href="{{ route('account.formTeacher') }}">{{$page_content['slider' ]['text_button']}}</a>
{{--                           <button class="btn primary">{{$page_content['slider' ]['text_button']}}</button>--}}
                       </div>
                   </div>
               </div>
               <div class="col-lg-7 col-banner">
                   <div class="banner-item">
                       <div class="owl-carousel custom-carousel-style" id="section-banner-carousel">
                           @for($stt = 1; $stt < 4; $stt++)
                               @if(isset($page_content['slider_' . $stt]))
                                   @php
                                       $item = $page_content['slider_' . $stt];
                                   @endphp
                                   <div class="item">
                                       <div class="banner-carousel-item"> <img class="owl-lazy" data-src="{{ $item['picture_url'] }}" alt=""></div>
                                   </div>
                               @endif
                           @endfor


                       </div>
                   </div>
               </div>
           </div>
       </div>
   </section>
   <section class="section become-teacher-section discover">
       <div class="container">
           <div class="become-teacher-section-wrapper">
               <h2 class="section-title">{{$page_content['dichvu_khoi' ]['name']}}</h2>
               <div class="row">
                   @for($stt = 1; $stt < 4; $stt++)
                       @if(isset($page_content['dichvu_khoi_' . $stt]))
                           @php
                               $item = $page_content['dichvu_khoi_' . $stt];
                           @endphp
                           <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                               <div class="discover-item">
                                   <div class="item-icon"> <img class="lazyload" data-src="{{ $item['picture_url']  }}" alt=""></div>
                                   <h5 class="item-title">{{ $item['name'] }}</h5>
                                   <p class="item-des">{{ $item['description'] }}</p>
                               </div>
                           </div>

                       @endif
                   @endfor


               </div>
           </div>
       </div>
   </section>
   <section class="section become-teacher-section opportunities white">
       <div class="container">
           <div class="become-teacher-section-wrapper">
               <h2 class="section-title">{{$page_content['conso']['tieude']}}</h2>
               <div class="row">
                   @for($stt = 1; $stt < 5; $stt++)
                       @if(isset($page_content['cacconso_' . $stt]))
                           @php
                               $item = $page_content['cacconso_' . $stt];
                           @endphp
                           <div class="col-lg-3 col-md-6">
                               <div class="opportunitie-item">
                                   <div class="number" id="countUp-{{$stt}}" data-count="{{$item['number']}}">{{$item['number']}}</div>
                                   <div class="description">{{$item['name']}}</div>
                               </div>
                           </div>

                       @endif
                       @endfor


               </div>
           </div>
       </div>
   </section>
   <section class="section become-teacher-section steps">
       <div class="container">
           <div class="become-teacher-section-wrapper">
               <h2 class="section-title">{{$page_content['cacbuoc']['tieude']}}</h2>
               <div class="row">
                   @for($stt = 1; $stt < 7; $stt++)
                       @if(isset($page_content['cacbuoc_' . $stt]))
                           @php
                               $item = $page_content['cacbuoc_' . $stt];
                           @endphp
                           <div class="col-lg-4 col-md-6">
                               <div class="step-item">
                                   <div class="item-image"> <img class="lazyload" data-src="{{ $item['picture_url']  }}" alt=""></div>
                                   <h5 class="item-title">{{$item['name']}}</h5>
                                   <p class="item-des">{{$item['description']}}</p>
                               </div>
                           </div>
                       @endif
                   @endfor

               </div>
           </div>
       </div>
   </section>
   <section class="section become-teacher-section teachers">
       <div class="container">
           <div class="become-teacher-section-wrapper">
               <h2 class="section-title">{{$page_content['phamvi']['tieude']}}</h2>
               <div class="owl-carousel custom-carousel-style" id="carousel-section-teachers">
                   @for($stt = 1; $stt < 4; $stt++)
                       @if(isset($page_content['phamvi_' . $stt]))
                           @php
                               $item = $page_content['phamvi_' . $stt];
                           @endphp
                           <div class="item">
                               <div class="teachers-item"> <img class="item-image-quote " src="{{asset('enduser/assets/icons/icon-quote-gray.svg')}}" alt="">
                                   <p class="item-quote">{{@$item['description']}}</p>
                                   <div class="item-info d-flex align-items-center">
                                       <div class="item-avatar"> <img class="lazyload" data-src="{{ $item['picture_url']  }}" alt=""></div>
                                       <div class="item-content">
                                           <h6 class="item-name">{{@$item['name']}}</h6>
                                           <p class="item-job">{{@$item['job']}}</p>
                                       </div>
                                   </div>
                               </div>
                           </div>

                       @endif
                   @endfor


               </div>
           </div>
       </div>
   </section>

@stop
