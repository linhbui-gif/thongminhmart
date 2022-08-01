@extends("enduser.layout")

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
{{--<div class="page-breadcrumb">--}}
{{--    <!-- page breadcrumb -->--}}
{{--    <div class="container">--}}
{{--        <div class="row">--}}
{{--            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">--}}
{{--                <nav aria-label="breadcrumb">--}}
{{--                    <ol class="breadcrumb">--}}
{{--                        <li class="breadcrumb-item"><a href="/">Trang chủ</a></li>--}}
{{--                        <li class="breadcrumb-item active" aria-current="page">Tuyeenr dung</li>--}}
{{--                    </ol>--}}
{{--                </nav>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}
<div class="content">

    <div class="container">
        <h1>{{@$page_content['page_about']['name']}}</h1>
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="content-area">
                    {!! @$page_content['about']['text'] !!}

                </div>
            </div>

        </div>
    </div>
</div>
<style>

    /*------- Breadcrumb ------*/
    .page-breadcrumb {
        background: url(../images/slanting-pattern-breadcrumb.png);
    }

    .page-breadcrumb .breadcrumb {
        background: transparent;
        font-size: 14px;
        padding: 0px;
        margin-bottom: 0px;
        text-transform: capitalize;
        font-weight: 400;
    }

    .page-breadcrumb .breadcrumb-item {}

    .page-breadcrumb .breadcrumb-item .breadcrumb-link {
        color: #6c7178;
    }

    .page-breadcrumb .breadcrumb-item .breadcrumb-link:hover {
        color: #f12a02;
    }
    .breadcrumb {
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -ms-flex-wrap: wrap;
        flex-wrap: wrap;
        padding: 0.75rem 1rem;
        margin-bottom: 1rem;
        list-style: none;
        background-color: #e9ecef;
        border-radius: 0.25rem;
    }
</style>
@stop
