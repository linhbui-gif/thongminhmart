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
<div class="Breadcrumb">
    <div class="container">
        <div class="Breadcrumb-wrapper">
            <div class="Breadcrumb-list flex flex-wrap"><a class="Breadcrumb-list-item" href="{{ route('siteIndex') }}">Trang chủ</a>
                <div class="Breadcrumb-list-item arrow">
                    <svg width="9" height="14" viewBox="0 0 9 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M1 1L7 7L1 13" stroke="#777777" stroke-width="1.5" stroke-linecap="round" />
                    </svg>
                </div><a class="Breadcrumb-list-item" href="danh-sach-san-pham.html">Danh sách sản phẩm</a>
                <div class="Breadcrumb-list-item arrow">
                    <svg width="9" height="14" viewBox="0 0 9 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M1 1L7 7L1 13" stroke="#777777" stroke-width="1.5" stroke-linecap="round" />
                    </svg>
                </div><a class="Breadcrumb-list-item" href="chi-tiet-san-pham.html">Chi tiết</a>
            </div>
        </div>
    </div>
</div>
<!-- Address Section Starts here -->
<section class="mar-bot mb-5">
    <!-- Locations -->
    <?php
    $widgetContactLeft = \App\Widget::where('location', 'contact_content_left')->first();
    $widgetContactRight = \App\Widget::where('location', 'contact_content_right')->first();
    ?>
    <div class="container">
        <div class="row">

            <div class="col-lg-6 col-md-12 col-sm-12 ">

                <div class="contact-form">



                    <div class="form-body">
                        @if(Session::has('success'))
                        <div class="alert alert-success alert-dismissible">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            {{ Session::get('success') }}
                        </div>
                        @endif
                        <form action="{{route('ajaxContact')}}" method="POST">
                            @csrf
                            <div class="form-group">
                                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" placeholder="Name" id="exampleFormControlInput1">
                                @error('name')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <input type="email" value="{{ old('email') }}" name="email" placeholder="Enter Email..." class="form-control @error('email') is-invalid @enderror">
                                @error('email')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <input type="text" value="{{ old('phone') }}" name="phone" placeholder="Enter Phone.." class="form-control @error('phone') is-invalid @enderror">
                                @error('phone')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <textarea class="form-control" rows="9" placeholder="Content..."></textarea>
                            </div>
                            <div class="form-footer">
                                <button type="submit" class="btn btn-primary btn-block">Send Message</button>
                            </div>

                        </form>
                    </div>

                </div>

            </div>

            <div class="col-lg-6 col-md-12 col-sm-12 ">
                <div class="world-map">

                    <!--Google map-->
                    <div id="map-container-google-1" class="z-depth-1-half map-container">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d14896.931532430219!2d105.810949!3d21.0233658!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3135ab68ba3cd041%3A0xe95bcaedfd87024d!2zNzEgxJDGsOG7nW5nIE5ndXnhu4VuIENow60gVGhhbmgsIEzDoW5nIFRoxrDhu6NuZywgxJDhu5FuZyDEkGEsIEjDoCBO4buZaQ!5e0!3m2!1svi!2s!4v1637516685026!5m2!1svi!2s" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                    </div>
                    <!--Google Maps-->

                </div>
            </div>

        </div>
    </div>
</section>

<!-- Locations -->



@endsection