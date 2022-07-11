@extends("enduser.layout")

@section('content')
    @include("enduser.partials.breadcrumb",[ 'mainpage' => "Chi tiết thông báo",'name' =>$data->name])
    <style>
        /*------- blog page start -------*/
        .ed_blog_all_item{
            float:left;
            width:100%;
        }
        .ed_blog_item{
            float:left;
            width:100%;
            border-radius: 3px;
            -webkit-transition: all 0.3s;
            -moz-transition: all 0.3s;
            -ms-transition: all 0.3s;
            -o-transition: all 0.3s;
            transition: all 0.3s;
        }
        .ed_blog_image {
            float:left;
            width:100%;
            margin-bottom:0px;
            position:relative;
            border-radius: 3px;
        }
        .ed_blog_image a:after{
            content: "";
            position: absolute;
            top: 0%;
            left: 50%;
            right: 50%;
            bottom: 0%;
            border-radius: 3px;
            background-color: rgba(252, 169, 1, 0.7);
            -webkit-transition: all 0.3s;
            -moz-transition: all 0.3s;
            -ms-transition: all 0.3s;
            -o-transition: all 0.3s;
            transition: all 0.3s;
        }
        .ed_blog_image a:hover:after{
            content: "";
            position: absolute;
            top: 0%;
            left: 0%;
            right: 0%;
            bottom: 0%;
            background-color: rgba(252, 169, 1, 0.7);
            -webkit-transition: all 0.3s;
            -moz-transition: all 0.3s;
            -ms-transition: all 0.3s;
            -o-transition: all 0.3s;
            transition: all 0.3s;
        }
        .ed_blog_image:hover  img{

        }
        .ed_blog_image img{
            width:100%;
            border-radius: 3px;
            border-bottom-left-radius: 0px;
            border-bottom-right-radius: 0px;
            -webkit-transition: all 0.3s;
            -moz-transition: all 0.3s;
            -ms-transition: all 0.3s;
            -o-transition: all 0.3s;
            transition: all 0.3s;
        }
        .ed_blog_info{
            float: left;
            width: 100%;
            background-color: #ffffff;
            padding: 30px;
            border: 1px solid #e1e1e1;
            border-top:none;
            border-radius: 3px;
            border-top-left-radius: 0px;
            border-top-right-radius: 0px;
        }
        .ed_blog_info h2{
            font-size: 24px;
            margin: 0px 0px 5px 0px;

        }
        .ed_blog_info h2 a{
            text-decoration:none;
            color:#272727;
            -webkit-transition: all 0.3s;
            -moz-transition: all 0.3s;
            -ms-transition: all 0.3s;
            -o-transition: all 0.3s;
            transition: all 0.3s;
        }
        .ed_blog_info h2 a:hover{
            color:#016db6;
            -webkit-transition: all 0.3s;
            -moz-transition: all 0.3s;
            -ms-transition: all 0.3s;
            -o-transition: all 0.3s;
            transition: all 0.3s;
        }
        .ed_blog_info ul{
            margin:0px;
            padding:0px;
        }
        .ed_blog_info ul li{
            float:left;
            list-style:none;
            margin-right:15px;
        }
        .ed_blog_info ul li:last-child{
            margin-right:0px;
        }
        .ed_blog_info ul li a{
            text-decoration: none;
            color: #272727;
            text-transform: capitalize;
            -webkit-transition: all 0.3s;
            -moz-transition: all 0.3s;
            -ms-transition: all 0.3s;
            -o-transition: all 0.3s;
            transition: all 0.3s;
            font-weight: 400;
            font-size: 14px;
        }
        .ed_blog_info ul li a:hover{
            color:#016db6;
            -webkit-transition: all 0.3s;
            -moz-transition: all 0.3s;
            -ms-transition: all 0.3s;
            -o-transition: all 0.3s;
            transition: all 0.3s;
        }
        .ed_blog_info ul li a i{
            color:#016db6;
            padding-right:5px;
            font-size: 15px;
        }
        .ed_blog_info p{
            float: left;
            width: 100%;
            margin-top: 15px;
        }
        .ed_blog_all_item_second{
            float:left;
            width:100%;
        }
        .ed_blog_all_item_second .ed_blog_info h2 {
            float: left;
            width: 100%;
            font-size: 24px;
            margin: 0px 0px 15px 0px;
        }
        .ed_blog_all_item_second .ed_blog_info p {
            margin-top: 15px;
        }
        .ed_blog_all_item_second .ed_blog_info a{
            float:left;
        }
        /*------- blog page end -------*/
        /*------- blog Single page start -------*/
        .ed_blog_info blockquote{
            float:left;
            padding: 10px 20px;
            margin: 30px 0px 0px 50px;
            font-size: 18px;
            border-left: 5px solid #016db6;
            color: #272727;
            font-style: italic;
            font-family: 'Work Sans';
        }
        .ed_blog_tags {
            float: left;
            width: 100%;
            padding: 25px 0px 0px 0px;
            font-weight: 500;
        }
        .ed_blog_tags ul{
            margin:0px;
            padding:0px;
        }
        .ed_blog_tags ul li{
            float:left;
            list-style:none;
            padding-left:5px;
        }
        .ed_blog_tags ul li:first-child{
            padding-left:0px;
        }
        .ed_blog_tags ul li:first-child a{
            text-transform:uppercase;
            padding:3px 0px 0px 0px;
            color: #272727;
        }
        .ed_blog_tags ul li:first-child a:hover{
            color:#272727;
            cursor:text;
        }
        .ed_blog_tags ul li i{
            color:#016db6;
            -ms-transform: rotate(85deg); /* IE 9 */
            -moz-transform: rotate(85deg);
            -o-transform: rotate(85deg);
            -webkit-transform: rotate(85deg); /* Chrome, Safari, Opera */
            transform: rotate(85deg);
        }
        .ed_blog_tags ul li a{
            text-decoration:none;
            text-transform:capitalize;
            color: #272727;
        }
        .ed_blog_tags ul li a:hover{
            color:#016db6;
        }
        .ed_blog_tags div{
            float:right;
        }
        .ed_blog_tags div a{
            text-decoration:none;
            text-transform:capitalize;
            color: #272727;
        }
        .ed_blog_tags div a:hover{
            color:#016db6;
        }
        #ed_social_share{
            position:absolute;
            right:0%;
            display:none;
            z-index:1000;
        }
        #ed_social_share li a i{
            font-size:16px;
            transform: rotate(0deg);
            -o-transform: rotate(0deg);
            -ms-transform: rotate(0deg);
            -moz-transform: rotate(0deg);
            -webkit-transform: rotate(0deg);
            color:#272727;
        }
        #ed_social_share li a {
            margin-right:10px;
        }
        #ed_social_share li a i{
            -webkit-transition: all 0.3s;
            -moz-transition: all 0.3s;
            -ms-transition: all 0.3s;
            -o-transition: all 0.3s;
            transition: all 0.3s;
        }
        #ed_social_share li a i:hover{
            color:#016db6;
            -webkit-transition: all 0.3s;
            -moz-transition: all 0.3s;
            -ms-transition: all 0.3s;
            -o-transition: all 0.3s;
            transition: all 0.3s;
        }
        #ed_social_share li:first-child a:hover{
            cursor:pointer;
        }
        .ed_quotation{
            float:left;
            width:100%;
            text-align:center;
            margin:15px 0px;
            background-color:#272727;
            background-image: url(../images/blog/qoute_bg.png);
            background-size: cover;
            background-repeat:no-repeat;
            background-position: 100% 100%;
        }
        .ed_quotation h4{
            font-size: 36px;
            padding: 50px 0px;
            color: #ffffff;
        }
        .ed_quotation span{
            padding-left:12px;
        }
        .ed_blog_comment_wrapper{
            float:left;
            width:100%;
            padding-bottom: 20px;
        }
        .ed_blog_comment_wrapper h4{
            float:left;
            width:100%;
            font-size:24px;
            font-weight:500;
            position:relative;
            margin: 30px 0px 20px 0px;
        }
        .ed_blog_comment_wrapper h4:after{
            position:absolute;
            content:"";
            top:100%;
            left:0%;
            width:70px;
            height:2px;
            background-color:#016db6;
            margin: 8px auto;
        }
        .ed_blog_comment{
            float:left;
            width:100%;
        }
        .ed_comment_image{
            float:left;
            padding-right:10px;
        }
        .ed_comment_image img{
            width:70px;
            height:70px;
            border-radius:3px;
        }
        .ed_comment_text{
            float: right;
            width: 89%;
            padding: 0px 20px;
        }
        .ed_comment_text h5{
            margin: 0px;
            font-weight: 400;
            font-size: 16px;
        }
        .ed_comment_text h5 span{
            float:right;
            text-transform:capitalize;
        }
        .ed_comment_text h5 span a{
            text-decoration: none;
            color: #272727;
            padding-left: 25px;
            -webkit-transition: all 0.3s;
            -moz-transition: all 0.3s;
            -ms-transition: all 0.3s;
            -o-transition: all 0.3s;
            transition: all 0.3s;
        }
        .ed_comment_text h5 span a:hover{
            color:#016db6;
            -webkit-transition: all 0.3s;
            -moz-transition: all 0.3s;
            -ms-transition: all 0.3s;
            -o-transition: all 0.3s;
            transition: all 0.3s;
        }
        .ed_comment_text p{
            margin:15px 0px 0px 0px;
        }
        .ed_blog_sub_comment{
            float:right;
            width:87%;
        }
        .ed_blog_message_wrapper{
            float: left;
            width: 100%;
            border-top: 1px solid #e1e1e1;
            padding: 0px;
            margin-top: 20px;
        }
        .ed_blog_message_wrapper h4{
            float: left;
            width: 100%;
            font-size: 24px;
            font-weight: 500;
            position: relative;
            margin: 20px 0px 0px 0px;
        }
        .ed_blog_message_wrapper h4:after{
            position:absolute;
            content:"";
            top:100%;
            left:0%;
            width:70px;
            height:2px;
            background-color:#016db6;
            margin: 8px auto;
        }
        .ed_blog_messages{
            float:left;
            width:100%;
        }
        .ed_blog_messages .form-control{
            margin-bottom: 30px;
            color: #272727;
            box-shadow: none;
            resize: none;
            padding: 0px 15px;
            height: 45px;
            -webkit-transition: all 0.3s;
            -moz-transition: all 0.3s;
            -ms-transition: all 0.3s;
            -o-transition: all 0.3s;
            transition: all 0.3s;
        }
        .ed_blog_messages textarea.form-control{
            padding: 10px 15px;
            height: auto;
        }
        .ed_blog_messages .form-control:focus{
            outline:none;
            box-shadow:none;
            border: 1px solid #016db6;
            -webkit-transition: all 0.3s;
            -moz-transition: all 0.3s;
            -ms-transition: all 0.3s;
            -o-transition: all 0.3s;
            transition: all 0.3s;
        }
        .ed_blog_messages .orange{
            margin-top:15px;
        }
        /*------- blog Single page end -------*/
        ul.social_box li {
            display: inline-block;
        }

        ul.social_box li a img {
            width: 18px;
            display: block;
            cursor: pointer;
        }

        ul.social_box {
            display: inline-block;
        }
    </style>
    <div class="blog mt-4">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="ed_blog_all_item">
                        <div class="ed_blog_item ed_bottompadder50">
{{--                            <div class="ed_blog_image">--}}
{{--                                <img src="{{$data->getImage()}}" alt="blog image" width="100%">--}}
{{--                            </div>--}}
                            <div class="ed_blog_info">
                                <h2>{{$data->name}}</h2>
                                <ul>
                                    {{--                                <li><a href="#"><i class="fa fa-user"></i> james marco</a></li>--}}
                                    <li><a href="#"><svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="clock" class="svg-inline--fa fa-clock fa-w-16" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path fill="currentColor" d="M256,8C119,8,8,119,8,256S119,504,256,504,504,393,504,256,393,8,256,8Zm92.49,313h0l-20,25a16,16,0,0,1-22.49,2.5h0l-67-49.72a40,40,0,0,1-15-31.23V112a16,16,0,0,1,16-16h32a16,16,0,0,1,16,16V256l58,42.5A16,16,0,0,1,348.49,321Z"></path></svg> {{$data->updated_at}}</a></li>
                                    {{--                                <li><a href="#"><i class="fa fa-comment-o"></i> 4 comments</a></li>--}}
                                </ul>
                                {!! $data->content !!}
                            </div>
                            <div class="ed_blog_tags">
                                <div><span>Share the post</span>
                                    <ul class="social_box">
                                        @php
                                            $linkShare = route("page.showEvent",  [ 'id' => $data->id ] );
                                        @endphp
                                        <li><a class="social-item" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u={{ $linkShare }}"><img src="{{ asset('enduser/assets/icons/icon-facebook.svg') }}" alt=""></a></li>
                                        <li><a class="social-item" target="_blank" href="https://twitter.com/intent/tweet?url={{ $linkShare }}"><img src="{{ asset('enduser/assets/icons/icon-twitter.svg') }}" alt=""></a></li>
                                        <li><a class="social-item" target="_blank" href="https://www.instagram.com/?url={{ $linkShare }}"><img src="{{ asset('enduser/assets/icons/icon-instagram.svg') }}" alt=""></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
