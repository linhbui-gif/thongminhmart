@extends("enduser.layout")

@section('content')

    <?php
    $dataBreb = [
        [
            "name" => "chi tiết tin tức"
        ],
        [
            "name" => $new->name
        ]
    ];

    ?>
    @include("enduser.page.components.breb-crumb",['data' => $dataBreb])

    <style>
        @media (max-width:767px) {
            .blog_details_desc-mb img{
                width: 100%!important;
                height: auto!important;
            }
        }
    </style>
    <!--blog body area start-->
    <div class="blog_details_bg mt-5">
        <div class="container">
            <div class="blog_details bg-white content">
                <div class="blog_wrapper_details">
                    <div class="row">
                        <div class="col-12">

                            <div class="blog_details_content">
{{--                                <img width="100%" src="{{$new->url_picture}}" alt="">--}}
                                <div class="blog_details_desc blog_details_desc-mb">
                                    {!! $new->content !!}
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!--blog section area end-->
@stop
