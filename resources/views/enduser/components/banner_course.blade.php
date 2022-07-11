@php
    $sliders = \App\Banner::where('status','active')->where('type',1)->where('location','course_slider')->get();
@endphp
<section class="section-banner">
    <div class="container">
        <div class="row">
            <div class="col-lg-5 col-info">
                <div class="banner-item info">
                    <h2 class="banner-title">{{$sliders[0]['title']}}</h2>
                    <p class="banner-des">{{$sliders[0]['description']}}</p>
                </div>
            </div>
            <div class="col-lg-7 col-banner">
                <div class="banner-item">
                    <div class="owl-carousel custom-carousel-style" id="section-banner-carousel">
                        @foreach($sliders as $s)
                            <div class="item">
                                <div class="banner-carousel-item"> <img class="owl-lazy" data-src="{{$s->getImage()}}" alt="{{$s->name}}"></div>
                            </div>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
