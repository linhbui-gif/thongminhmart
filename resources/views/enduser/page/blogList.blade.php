@extends("enduser.layout")
@section('content')

    @php

        $blogs = \App\Helper\Common::getFromCache('blogs');
        if(!$blogs) {
          $blogs = \App\blog_posts::where('status','active')->orderBy('order_no','asc')->get();
          \App\Helper\Common::putToCache('blogs',$blogs);
        }

        $lastItemBlog = \App\blog_posts::where('status','active')->orderBy('id','desc')->limit(6)->get();
    @endphp

    <?php
    $dataBreb = [
        [
            "name" => "Chia sẻ kiến thức"
        ]
    ];
    ?>
    @include("enduser.page.components.breb-crumb",['data' => $dataBreb])

    <div class="NewsListPage">
        <div class="container">
            <div class="NewsListPage-wrapper flex flex-wrap">
                <div class="NewsListPage-wrapper-item">
                    <div class="Card">
                        <div class="Card-body">
                            <div class="NewsList">
                                <div class="NewsList-wrapper">
                                    <div class="NewsList-list flex flex-wrap">
                                        @if(!empty($blogs))
                                            @foreach($blogs as $k => $v)
                                        <div class="NewsList-list-item">
                                            <div class="NewBox">
                                                <div class="NewBox-image"> <a href="{{route('new.newDetail', ['slug' => $v->slug])}}">
                                                        <img src="{{$v->url_picture}}" alt="{{$v->name}}">
                                                    </a>
                                                </div>
                                                <div class="NewBox-info"><a class="NewBox-title" href="{{route('new.newDetail', ['slug' => $v->slug])}}">{{$v->name}}</a>
                                                    <div class="NewBox-description">{{$v->description}}</div>
{{--                                                    <div class="NewBox-socials flex"><a class="NewBox-socials-item" href="#"><img src="./assets/icons/icon-facebook-yellow.svg" alt=""></a><a class="NewBox-socials-item" href="#"><img src="./assets/icons/icon-twitter-yellow.svg" alt=""></a><a class="NewBox-socials-item" href="#"><img src="./assets/icons/icon-instagram-yellow.svg" alt=""></a><a class="NewBox-socials-item" href="#"><img src="./assets/icons/icon-google-yellow.svg" alt=""></a></div>--}}
                                                </div>
                                            </div>
                                        </div>
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="Card-footer flex justify-end">
                            <div class="Pagination flex items-center">
{{--                                <div class="Pagination-total">Trang 1 / 8</div>--}}
{{--                                <div class="Pagination-control flex items-center"><a class="Pagination-control-item" href="#"><svg width="8" height="12" viewBox="0 0 8 12" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M3.31741 5.99571L7.80785 10.4862C7.93067 10.6094 7.99964 10.7764 7.99964 10.9504C7.99964 11.1244 7.93067 11.2914 7.80785 11.4147L7.41431 11.8082C7.29101 11.931 7.12408 12 6.95005 12C6.77602 12 6.60908 11.931 6.48579 11.8082L1.13897 6.4614C1.01735 6.33748 0.949219 6.17078 0.949219 5.99714C0.949219 5.82351 1.01735 5.65681 1.13897 5.53289L6.48079 0.191782C6.60408 0.0689607 6.77102 5.08958e-07 6.94505 5.24172e-07C7.11907 5.39386e-07 7.28601 0.0689607 7.4093 0.191782L7.80285 0.58533C7.92585 0.708529 7.99493 0.875501 7.99493 1.04959C7.99493 1.22367 7.92585 1.39065 7.80285 1.51385L3.31741 5.99571Z" fill="black"></path></svg></a><a class="active Pagination-control-item" href="#">1</a><a class="Pagination-control-item" href="#">2</a><a class="Pagination-control-item" href="#">3</a><a class="Pagination-control-item" href="#">4</a><a class="Pagination-control-item" href="#">5</a><a class="Pagination-control-item" href="#">6</a><a class="Pagination-control-item" href="#">7</a><a class="Pagination-control-item" href="#">8</a><a class="Pagination-control-item" href="#"><svg width="8" height="12" viewBox="0 0 8 12" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M4.68259 6.00429L0.192151 1.51384C0.0693288 1.39055 0.000364304 1.22362 0.000364304 1.04959C0.000364304 0.875559 0.0693288 0.708621 0.192151 0.58533L0.585694 0.191782C0.708986 0.068961 0.875924 0 1.04995 0C1.22398 0 1.39092 0.068961 1.51421 0.191782L6.86103 5.5386C6.98265 5.66252 7.05078 5.82922 7.05078 6.00286C7.05078 6.17649 6.98265 6.34319 6.86103 6.46711L1.51921 11.8082C1.39592 11.931 1.22898 12 1.05496 12C0.880927 12 0.713988 11.931 0.590696 11.8082L0.197147 11.4147C0.0741515 11.2915 0.00507259 11.1245 0.00507259 10.9504C0.00507259 10.7763 0.0741515 10.6094 0.197147 10.4862L4.68259 6.00429Z" fill="black"></path></svg></a>--}}
{{--                                </div>--}}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="NewsListPage-wrapper-item">
                    <div class="Card">
                        <div class="Card-header">
                            <div class="Card-header-title">Nội dung mới nhất</div>
                        </div>
                        <div class="Card-body">
                            @if(!empty($lastItemBlog))
                                @foreach($lastItemBlog as $k => $v)
                            <div class="NewBox vertical">
                                <div class="NewBox-image"> <a href="{{route('new.newDetail', ['slug' => $v->slug])}}">
                                        <img src="{{$v->url_picture}}" alt="{{$v->name}}">
                                    </a>
                                </div>
                                <div class="NewBox-info"><a class="NewBox-title" href="{{route('new.newDetail', ['slug' => $v->slug])}}">{{$v->name}}</a>
                                    <div class="NewBox-description">{{$v->description}}</div>
                                    {{--                                                    <div class="NewBox-socials flex"><a class="NewBox-socials-item" href="#"><img src="./assets/icons/icon-facebook-yellow.svg" alt=""></a><a class="NewBox-socials-item" href="#"><img src="./assets/icons/icon-twitter-yellow.svg" alt=""></a><a class="NewBox-socials-item" href="#"><img src="./assets/icons/icon-instagram-yellow.svg" alt=""></a><a class="NewBox-socials-item" href="#"><img src="./assets/icons/icon-google-yellow.svg" alt=""></a></div>--}}
                                </div>
                            </div>
                                @endforeach
                            @endif
{{--                            <div class="Button primary middle">--}}
{{--                                <button class="Button-control flex items-center justify-center" type="button"><span class="Button-control-title">Xem thêm</span>--}}
{{--                                </button>--}}
{{--                            </div>--}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
@section('script')
    <script>
        $(document).ready(function(){

            var _token = $('input[name="_token"]').val();
            load_data('', _token);
            function load_data(id="", _token)
            {
                $.ajax({
                    url:"{{ route('ajaxProduct') }}",
                    method:"POST",
                    data:{id:id, _token:_token},
                    success:function(data)
                    {
                        $('#load_more_button').remove();
                        $('#post_data').append(data);
                    }
                })
            }

            $(document).on('click', '#load_more_button', function(){
                var id = $(this).data('id');
                $('#load_more_button').html('<b>Loading...</b>');
                load_data(id, _token);
            });

        });

    </script>
@endsection
