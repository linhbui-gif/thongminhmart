@extends("enduser.layout")

@section('meta')

@include("enduser.meta",[
'title' => $_config->meta_title,
'description' => $_config->meta_description,
'link' => route('siteContact'),
'img' => asset('images/config/' . $_config->picture)
])

@stop
@section('head')
@php
$locale = app()->getLocale();

if($locale == "vi") {
$page_content = unserialize($page->content);
}
else{
$page_content = unserialize($page->content_ko);
}
@endphp
@stop
@section('content')
    <?php
    $dataBreb = [
        [
            "name" =>  @$page_content['lienhe']['name']
        ]
    ];
    ?>
    @include("enduser.page.components.breb-crumb",['data' => $dataBreb])
<!-- Address Section Starts here -->
<section class="mar-bot mb-5">
    <div class="container">
        <div class="content mt-5 bg-white ">
        <div class="row">
       <div class="col-12 ">
           {!! @$page_content['lienhe']['text'] !!}
       </div>
{{--            <div class="col-lg-6 col-md-12 col-sm-12 ">--}}

{{--                <div class="contact-form">--}}
{{--                    <div class="form-body">--}}
{{--                        @if(Session::has('success'))--}}
{{--                        <div class="alert alert-success alert-dismissible">--}}
{{--                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>--}}
{{--                            {{ Session::get('success') }}--}}
{{--                        </div>--}}
{{--                        @endif--}}
{{--                        <form action="{{route('ajaxContact')}}" method="POST">--}}
{{--                            @csrf--}}
{{--                            <div class="form-group">--}}
{{--                                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" placeholder="Name" id="exampleFormControlInput1">--}}
{{--                                @error('name')--}}
{{--                                <div class="alert alert-danger">{{ $message }}</div>--}}
{{--                                @enderror--}}
{{--                            </div>--}}
{{--                            <div class="form-group">--}}
{{--                                <input type="email" value="{{ old('email') }}" name="email" placeholder="Enter Email..." class="form-control @error('email') is-invalid @enderror">--}}
{{--                                @error('email')--}}
{{--                                <div class="alert alert-danger">{{ $message }}</div>--}}
{{--                                @enderror--}}
{{--                            </div>--}}
{{--                            <div class="form-group">--}}
{{--                                <input type="text" value="{{ old('phone') }}" name="phone" placeholder="Enter Phone.." class="form-control @error('phone') is-invalid @enderror">--}}
{{--                                @error('phone')--}}
{{--                                <div class="alert alert-danger">{{ $message }}</div>--}}
{{--                                @enderror--}}
{{--                            </div>--}}
{{--                            <div class="form-group">--}}
{{--                                <textarea class="form-control" rows="9" placeholder="Content..."></textarea>--}}
{{--                            </div>--}}
{{--                            <div class="form-footer">--}}
{{--                                <button type="submit" class="btn btn-primary btn-block">Send Message</button>--}}
{{--                            </div>--}}

{{--                        </form>--}}
{{--                    </div>--}}

{{--                </div>--}}

{{--            </div>--}}

{{--            <div class="col-lg-12 col-md-12 col-sm-12 ">--}}
{{--                <div class="world-map">--}}

{{--                    <!--Google map-->--}}
{{--                    <div id="map-container-google-1" class="z-depth-1-half map-container">--}}
{{--                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3723.7263151284988!2d105.78488961540258!3d21.04363409264519!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3135ab33e2204a21%3A0xcc3de1ba95bc0fdb!2zMTMwIFAuIE5naMSpYSBUw6JuLCBOZ2jEqWEgVMOibiwgQ-G6p3UgR2nhuqV5LCBIw6AgTuG7mWksIFZp4buHdCBOYW0!5e0!3m2!1svi!2s!4v1660641978015!5m2!1svi!2s" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>                    </div>--}}
{{--                    <!--Google Maps-->--}}

{{--                </div>--}}
{{--            </div>--}}

        </div>
        </div>
    </div>
</section>

<!-- Locations -->



@endsection
