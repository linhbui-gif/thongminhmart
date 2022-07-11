@extends("enduser.layout")

@section('content')

    @include("enduser.partials.breadcrumb", [ 'mainpage' => "Trang chủ",'name' => $lesson_current->label ])

   <section class="section lesson-detail-video section-course-detail">
       <div class="container">
           <div class="lesson-detail-video-wrapper section-course-detail-wrapper">
               <div class="row">
                   <div class="col-lg-8 col-current-video">
                       <div class="lesson-current-video" style="text-align: center;width: 100%;height: 100%">
                           @if($lesson_current)
                               @if($type == "full")
                                   <iframe src="https://player.vimeo.com/video/{{ $lesson_current->video_full }}" style="width: 100%;height: 100%" id="my-player" autopause frameborder="0" allow="autoplay; fullscreen; picture-in-picture" allowfullscreen="true"></iframe>
                               @else
                                   <iframe src="https://player.vimeo.com/video/{{ $lesson_current->video_demo }}" style="width: 100%;height: 100%" id="my-player" autopause frameborder="0" allow="autoplay; fullscreen; picture-in-picture" allowfullscreen="true"></iframe>
                               @endif
                           @else
                               <h1>Đang cập nhật dữ liệu</h1>
                           @endif
                       </div>
                   </div>
                   <div class="col-lg-4 col-list-video">
                       <div class="tab-wrapper">
                           <div class="tabs-group d-flex">
                               <div class="tab-item active">Video List</div>
                               <div class="tab-item">Hướng dẫn</div>
                           </div>
                           <div class="tabs-main-group">
                               <div class="tab-item active">
                                   <div class="lesson-list-video vjs-playlist vjs-playlist-vertical vjs-csspointerevents" style="margin-top: 10px;">
                                       <ol class="vjs-playlist-item-list">
                                           @if(isset($list_lessons))
                                                @php
                                                    $k_current = 0;
                                                @endphp
                                               @foreach($list_lessons as $key => $value)
                                                   @php

                                                   @endphp
                                                   <li class="vjs-playlist-item vjs-selected" tabindex="0">
                                                       <a href="{{ route("course.lessionDetailChapter", [ "slug_lesson" => $course->slug ]) }}?lesson={{ $value->id }}">
                                                           <picture class="vjs-playlist-thumbnail vjs-playlist-now-playing">
                                                               <img alt="" class="lazyload" data-src="{{ $value->url_thumbnail }}" />
                                                               <div class="right_item">
                                                                   @if($value->id == $lesson_current->id)
                                                                       @php
                                                                           $k_current = $key;
                                                                       @endphp
                                                                       <span class="vjs-playlist-now-playing-text" title="Now Playing">Now Playing</span>
                                                                   @endif

                                                                   <div class="vjs-playlist-title-container">
                                                                       <span class="vjs-up-next-text" title="Up Next">Up Next</span>
                                                                       <cite class="vjs-playlist-name" title="{{ $value->label }}">{{ $value->label }}</cite>
                                                                   </div>
                                                               </div>

                                                           </picture>
                                                       </a>
                                                   </li>
                                               @endforeach

                                           @endif
{{--                                           <li class="vjs-playlist-item vjs-up-next" tabindex="0">--}}
{{--                                               <picture class="vjs-playlist-thumbnail">--}}
{{--                                                   <img alt="" src="https://anyclass.vn/images/lesson/k5LtakfNtC.jpg" /><span class="vjs-playlist-now-playing-text" title="Now Playing">Now Playing</span>--}}
{{--                                                   <div class="vjs-playlist-title-container"><span class="vjs-up-next-text" title="Up Next">Up Next</span><cite class="vjs-playlist-name" title="Bài 2">Bài 2</cite></div>--}}
{{--                                               </picture>--}}
{{--                                           </li>--}}
{{--                                           <li class="vjs-playlist-item" tabindex="0">--}}
{{--                                               <picture class="vjs-playlist-thumbnail">--}}
{{--                                                   <img alt="" src="https://anyclass.vn/images/lesson/uYExmoPMTH.png" /><span class="vjs-playlist-now-playing-text" title="Now Playing">Now Playing</span>--}}
{{--                                                   <div class="vjs-playlist-title-container"><span class="vjs-up-next-text" title="Up Next">Up Next</span><cite class="vjs-playlist-name" title="Bài 3">Bài 3</cite></div>--}}
{{--                                               </picture>--}}
{{--                                           </li>--}}
                                           <li class="vjs-playlist-ad-overlay"></li>
                                       </ol>
                                   </div>

                                   <div class="lesson-action-video d-flex align-items-center justify-content-between">
                                       <div class="action-item-group">
{{--                                           <input type="text" placeholder="Tìm kiếm video">--}}
                                       </div>
                                       <div class="action-item-group d-flex align-items-center">
                                           <div class="action-item first">
                                               @php
                                                $first_link = "?lesson=" . $list_lessons[0]->id;
                                               @endphp
                                               <a href="{{ $first_link }}"><img src="{{ asset('enduser/assets/icons/icon-first-track.svg') }}" alt=""></a>
                                           </div>
                                           <div class="action-item prev">
                                               @php
                                                   if(isset($list_lessons[$k_current - 1])){
                                                       $prev_link = "?lesson=" .$list_lessons[$k_current - 1]->id;
                                                   }else{
                                                       $prev_link = "?lesson=" .$list_lessons[$k_current]->id;
                                                   }
                                               @endphp
                                               <a href="{{ $prev_link }}"><img src="{{ asset("enduser/assets/icons/icon-caret-left.svg") }}" alt=""></a>
                                           </div>
                                           <div class="action-item next">
                                               @php
                                                    if(isset($list_lessons[$k_current + 1])){
                                                        $next_link = "?lesson=" .$list_lessons[$k_current + 1]->id;
                                                    }else{
                                                        $next_link = "?lesson=" .$list_lessons[$k_current]->id;
                                                    }
                                               @endphp
                                               <a href="{{ $next_link }}"><img src="{{ asset("enduser/assets/icons/icon-caret-right.svg") }}" alt=""></a>
                                           </div>
                                           <div class="action-item last">
                                               @php
                                                   $last_link = "?lesson=" . $list_lessons[count($list_lessons) - 1]->id;
                                               @endphp
                                               <a href="{{ $last_link }}"><img src="{{asset("enduser/assets/icons/icon-last-track.svg")}}" alt=""></a>
                                           </div>
                                       </div>
                                   </div>
                               </div>
                               <div class="tab-item">
                                   <div class="description-wrapper style-content-editable" style="margin-top: 10px;">
{{--                                       <p>Để đăng ký được khóa, gói học Quý phụ huynh và các bạn học sinh thao tác các bước như sau:</p>--}}
{{--                                       <p><strong>1.  Nạp học phí</strong></p>--}}
{{--                                       <p><strong>2.  Chọn khóa, gói học</strong></p>--}}
{{--                                       <p><strong>3.  Xác nhận đăng ký khóa, gói học.</strong></p>--}}
{{--                                       <h1>GIÁ RẺ ĐẾN TẬN TAY KHÁCH HÀNG</h1>--}}
{{--                                       <h1>LUÔN ĐẶT UY TÍN LÊN HÀNG ĐẦU</h1>--}}
{{--                                       <p>— Chiếc <strong>đầm</strong> với họa tiết hoa lá gây ấn tượng kết hợp với thiết kế độc đáo ở phần cổ và vai vừa kín đáo lại vừa gợi cảm dáng váy chữ A có xếp li eo giúp phần eo trông thon gọn . Với chiếc đầm hoa phong cách cổ điển này tha hồ cho các nàng diện đi khắp mọi nơi không đối thủ và khiến cho mọi ánh nhìn phải tập trung vào mình.</p><img src="{{ asset('enduser/assets/images/image-product-description-1.jpeg')}}" alt="">--}}
                                       @if(empty($lesson_current->tutorial))
                                       <p>Nội dung đang được cập nhật</p>
                                       @else
                                       {!! $lesson_current->tutorial !!}
                                       @endif
                                   </div>
                               </div>
                           </div>
                       </div>
                   </div>
               </div>
           </div>
       </div>
   </section>
   <section class="section lesson-detail-description section-course-detail" style="padding-top: 0;">
       <div class="container">
           <div class="lesson-detail-description-wrapper section-course-detail-wrapper">
               <div class="tab-wrapper">
                   <div class="tabs-group d-flex">
                       @php
                            $tab_name = isset($_GET['tab']) ? $_GET['tab'] : "tailieu";
                       @endphp
                       <div class="tab-item @if($tab_name == "tailieu")  active @endif">Tài liệu</div>
                       <div class="tab-item @if($tab_name == "exam")  active @endif">Bài kiểm tra</div>
                       <div class="tab-item @if($tab_name == "result")  active @endif">Kết quả</div>
                       <div class="tab-item">Thảo luận</div>
                   </div>
                   <div class="tabs-main-group">
                       <div class="tab-item @if($tab_name == "tailieu")  active @endif">
                           <div class="user-layout-table">
                               @if($type == "full")
                               <table class="my-course-table">
                                   <thead>
                                   <tr>
                                       <td class="course-content">Tên file</td>
                                       <td class="col-action nowrap col-center">Tài liệu</td>
                                   </tr>
                                   </thead>
                                   <tbody>
                                   @if($course->file_doc)
                                   <tr>
                                       <td>{{ pathinfo($course->file_doc,PATHINFO_BASENAME) }}</td>
                                       <td class="col-action">
                                           @if($course->file_doc)
                                               <div class="action-group d-flex flex-wrap justify-content-center">
                                                   <a target="_blank" href="{{ route('account.downloadDocument', "file_name=" . $course->file_doc) }}" class="btn primary">Tải về   </a>
                                               </div>
                                           @endif
                                       </td>
                                   </tr>
                                   @endif
                                   </tbody>
                               </table>
                               @else
                                    <p style="margin-top: 10px">Chỉ học viên mới xem được nội dung này</p>
                               @endif
                           </div>
                       </div>
                       <div class="tab-item @if($tab_name == "exam")  active @endif">
                           @if($type == "full")
                               @if(count($questions) > 0)
                                <form class="quiz-main" action="{{ route("course.postExam", [ "slug_lesson" => $course->slug ] ) }}" method="POST">
                                    <input type="hidden" name="lesson_id" value="{{ $lesson_current->id }}">
                                    <h3 class="quiz-title"> </h3>
                                    @if(Session::has('error'))
                                        <div class="alert alert-danger alert-dismissible">
                                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                                            <strong>Lỗi!</strong> {{ Session::get('error') }}
                                        </div>
                                    @endif
                                    @csrf
                               <div class="row quiz-wrapper">
                                   <div class="col-lg-8">
                                       @foreach($questions as $k => $question)
                                           @php
                                                $title = "Câu hỏi " . ($k + 1);
                                                $arrDapAn = json_decode($question->cac_dap_an,true);
                                                $alpha = range('A', 'Z');

                                           @endphp
                                       <div class="quiz-wrapper-item">
                                           <div class="quiz-question">
                                               <h5>{{ $title }}</h5>
                                               <p>{{ $question->content }}</p>
                                           </div>
                                           <div class="quiz-answers">
                                               @if($arrDapAn && count($arrDapAn) > 0)
                                                   @foreach($arrDapAn as $k_a => $t_a)
                                                       @if($t_a && !empty(trim($t_a)))
                                                           <div class="answer-item">
                                                               <input value="{{ $k_a }}" name="dapan[{{ $question->id }}]" type="radio" id="cauhoi_{{ $k }}_{{ $alpha[$k_a] }}">
                                                               <label for="cauhoi_{{ $k }}_{{ $alpha[$k_a] }}">{{ $alpha[$k_a] }}. {{ $t_a }}</label>
                                                           </div>
                                                       @endif
                                                   @endforeach
                                               @endif
                                           </div>
                                           <div class="quiz-action d-flex justify-content-center">
                                               <button class="btn primary prev"><img src="{{ asset("enduser/assets/icons/icon-angle-left-white.svg") }}" alt=""></button>
                                               <button class="btn primary next"><img src="{{ asset("enduser/assets/icons/icon-angle-right-white.svg") }}" alt=""></button>
                                           </div>
{{--                                           <div class="quiz-explain">--}}
{{--                                               <h5>Explanation</h5>--}}
{{--                                               <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Error iste enim quisquam. Tempora harum voluptates quas. Alias a quibusdam molestias commodi, doloremque nostrum quasi debitis maxime voluptates omnis, laborum eius.</p>--}}
{{--                                           </div>--}}
                                       </div>
                                       @endforeach
                                   </div>
                                   <div class="col-lg-4 quiz-col-lists">
                                       <div class="quiz-lists-wrapper">
                                           <div class="quiz-total">
                                               <h5>Câu hỏi 1 / 12</h5>
                                           </div>
                                           @php

                                           @endphp
                                           <div class="quiz-lists d-flex flex-wrap">
                                               @foreach($questions as $k => $question)
                                                    @if($k == 0)
                                                       <div class="quiz-list-item current">{{ $k + 1 }}</div>
                                                   @else
                                                       <div class="quiz-list-item undone">{{ $k + 1 }}</div>
                                                   @endif
                                               @endforeach
                                           </div>
                                           <div class="quiz-submit mt-4">
                                               <button class="btn primary w-100">Nộp bài</button>
                                           </div>
                                       </div>
                                   </div>
                               </div>
                           </form>
                                @else
                                   <p style="margin-top: 10px">Không có bài kiểm tra nào</p>
                               @endif
                           @else
                               <p style="margin-top: 10px">Chỉ học viên mới xem được nội dung này</p>
                           @endif
                       </div>
                       <div class="tab-item @if($tab_name == "result")  active @endif">
                           @if($type == "full")
                               @php
                                   $listResult = $lesson_current->results_exam;
                                    $arrResult = [];
                               @endphp
                               @if(count($listResult) > 0)
                                   <div class="quiz-main">
                                       <h3 class="quiz-title"> </h3>
                                       <div class="row quiz-result">
                                           <div class="col-lg-8">

                                               @foreach($questions as $k => $question)
                                                   @php
                                                       $title = "Câu hỏi " . ($k + 1);
                                                       $arrDapAn = json_decode($question->cac_dap_an,true);
                                                       $alpha = range('A', 'Z');

                                                       $result = $lesson_current->results_exam()->where('result_exam.question_id', $question->id)->orderBy('result_exam.created_at','DESC')->first();
                                                        $arrResult[$k] = "incorrect";
                                                   @endphp
                                                   <div class="quiz-wrapper-item">
                                                       <div class="quiz-question">
                                                           <h5>{{ $title }}</h5>
                                                           <p>{{ $question->content }}</p>
                                                       </div>
                                                       <div class="quiz-answers">
                                                           @if($arrDapAn && count($arrDapAn) > 0)
                                                               @foreach($arrDapAn as $k_a => $t_a)
                                                                   @if($t_a && !empty(trim($t_a)))
                                                                       @php

                                                                               $checked = "";
                                                                               if($k_a == $question->dap_an_dung){
                                                                                   $checked = "checked";
                                                                               }
                                                                               // trả lời đúng;
                                                                               $class_dapap = "";
                                                                               if($result && $question->dap_an_dung == $result->answer){
                                                                                   $arrResult[$k] = "correct";

                                                                                   if($result->answer == $k_a){
                                                                                       $class_dapap = "correct";
                                                                                   }
                                                                               }else{
                                                                                   if($result && $result->answer == $k_a){
                                                                                       $class_dapap = "incorrect";
                                                                                   }
                                                                               }
                                                                               /*if($result->answer == $k_a){
                                                                                   $checked = "checked";
                                                                               }*/
                                                                       @endphp
                                                                       <div class="answer-item {{ $class_dapap }} @if($checked == "checked") correct @endif">
                                                                           <input {{ $checked }} value="{{ $k_a }}" type="radio" name="dapan[{{ $question->id }}]" type="radio" id="result_{{ $k }}_{{ $alpha[$k_a] }}">
                                                                           <label for="result_{{ $k }}_{{ $alpha[$k_a] }}">{{ $alpha[$k_a] }}. {{ $t_a }}</label>
                                                                       </div>
                                                                   @endif
                                                               @endforeach
                                                           @endif
                                                       </div>
                                                       <div class="quiz-action d-flex justify-content-center">
                                                           <button class="btn primary prev"><img src="{{ asset("enduser/assets/icons/icon-angle-left-white.svg") }}" alt=""></button>
                                                           <button class="btn primary next"><img src="{{ asset("enduser/assets/icons/icon-angle-right-white.svg") }}" alt=""></button>
                                                       </div>

                                                   </div>
                                               @endforeach
                                           </div>
                                           <div class="col-lg-4 quiz-col-lists">
                                               <div class="quiz-lists-wrapper">
                                                   <div class="quiz-total">
                                                       <h5>Câu hỏi 1 / 12</h5>
                                                   </div>
                                                   @php

                                                       @endphp
                                                   <div class="quiz-lists d-flex flex-wrap">

                                                       @foreach($questions as $k => $question)
                                                           @php
                                                                $cl  = "wrong";
                                                                if(isset($arrResult[$k])){
                                                                    if($arrResult[$k] == "correct"){
                                                                        $cl = "correct";
                                                                    }
                                                                }
                                                           @endphp
                                                           <div class="quiz-list-item {{ $cl }}">{{ $k + 1 }}</div>
                                                       @endforeach
                                                   </div>
                                                   <div class="quiz-submit mt-4">
                                                       <a href="{{ route("course.postExam", [ "slug_lesson" => $course->slug ] ) }}?lesson={{ $lesson_current->id }}&tab=exam" class="btn primary w-100">Làm lại</a>
                                                   </div>
                                               </div>
                                           </div>
                                       </div>
                                   </div>
                                @else
                                   <p style="margin-top: 10px">Bạn chưa hoàn thành bài kiểm tra</p>
                               @endif
                           @else
                               <p style="margin-top: 10px">Chỉ học viên mới xem được nội dung này</p>
                           @endif
                       </div>
                       <div class="tab-item">
                           <div class="comments-group-wrapper">
                               <div class="comment-users-lists">
                                   @php
                                       $comments = $course->comments()->where('parent_id', 0)->orderBy('id','desc')->get();
                                   @endphp
                                   @if(count($comments) > 0)
                                       @include("enduser.components.showComment", [ 'comments' => $comments ])
                                   @else
                                       <p>Chưa có đánh giá nào</p>
                                   @endif
                               </div>
                               <h4 class="course-sub-title">Thêm đánh giá</h4>
                               <div class="rating-star d-flex align-items-center rating-action" id="rating-action">
                                   <img data-num="1" class="star active" src="" alt="">
                                   <img data-num="2" class="star" src="" alt="">
                                   <img data-num="3" class="star" src="" alt="">
                                   <img data-num="4" class="star" src="" alt="">
                                   <img data-num="5" class="star" src="" alt="">
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
       </div>
   </section>
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
        function buynow(){
            $("#action").val("buynow");
            $("#frmCart").submit();
        }
    </script>
    <script  src="{{ asset('enduser/assets/modal-video/js/jquery-modal-video.js') }}"></script>
    <script>
        $(".js-modal-btn").modalVideo({channel:'vimeo'});
    </script>
    @if($errors->any())
        <script>
            toastr.error('Nội dung đánh giá không được rỗng', 'Thất bại');
        </script>
    @endif
{{--    <script>--}}
{{--        const videoJs = {--}}
{{--            init: function () {--}}
{{--                this.configVideoJs()--}}
{{--            },--}}
{{--            configVideoJs: function () {--}}
{{--                const player = videojs('my-player', {--}}
{{--                    playbackRates: [0.7, 1.0, 1.5, 2.0],--}}
{{--                    nativeTextTracks: true,--}}
{{--                    qualitySelector: true,--}}
{{--                    controlBar: {--}}
{{--                        volumePanel: {inline: false}--}}
{{--                    },--}}
{{--                })--}}

{{--                player.playlist(--}}
{{--                    [--}}
{{--                            @if(isset($list_lessons))--}}
{{--                                @foreach($list_lessons as $key => $value)--}}
{{--                                    @php--}}
{{--                                        $video_demo = Vimeo::request('/me/videos', ['per_page' => 10], 'GET')['body']['data'];--}}
{{--                                    @endphp--}}
{{--                                    @foreach($video_demo as $item => $collection)--}}
{{--                                        @php--}}
{{--                                            $typeVideo = "video_demo";--}}
{{--                                            if($type == "full"){--}}
{{--                                                $typeVideo = "video_full";--}}
{{--                                            }--}}

{{--                                        @endphp--}}
{{--                                        @if(explode('/', $collection['uri'])[2] === $value->{$typeVideo})--}}
{{--                                        {--}}
{{--                                            name: '{{ $value->label }}',--}}
{{--                                            description: 'description',--}}
{{--                                            duration: {{ $value->duration === null ? 0 : $value->duration }},--}}
{{--                                            sources: [--}}
{{--                                                {--}}
{{--                                                    src: "{{ explode('"', explode(" ", $collection['embed']['html'])[1])[1] }}",--}}
{{--                                                    type: 'video/mp4',--}}
{{--                                                    label: '360P',--}}
{{--                                                },--}}
{{--                                            ],--}}

{{--                                            // you can use <picture> syntax to display responsive images--}}
{{--                                            thumbnail: [--}}
{{--                                                { src: '{{ $value->getImage() . '/' . $value->thumbnail }}',},--}}
{{--                                            ]--}}
{{--                                        },--}}
{{--                                        @endif--}}
{{--                                    @endforeach--}}
{{--                                @endforeach--}}
{{--                            @endif--}}
{{--                    ]);--}}

{{--                player.playlistUi()--}}

{{--                // const loopBtn = document.querySelector('.lesson-action-video .action-item.loop')--}}
{{--                const moveFirstBtn = document.querySelector('.lesson-action-video .action-item.first')--}}
{{--                const moveLastBtn = document.querySelector('.lesson-action-video .action-item.last')--}}
{{--                const movePrevBtn = document.querySelector('.lesson-action-video .action-item.prev')--}}
{{--                const moveNextBtn = document.querySelector('.lesson-action-video .action-item.next')--}}

{{--                // loopBtn.addEventListener('click', () => {--}}
{{--                // 	loopBtn.classList.toggle('active')--}}
{{--                // 	if (loopBtn.className.includes('active')) {--}}
{{--                // 		player.playlist.repeat(true)--}}
{{--                // 	} else {--}}
{{--                // 		player.playlist.repeat(false)--}}
{{--                // 	}--}}
{{--                // })--}}

{{--                moveFirstBtn.addEventListener('click', () => {--}}
{{--                    player.playlist.first()--}}
{{--                    player.play()--}}
{{--                })--}}
{{--                moveLastBtn.addEventListener('click', () => {--}}
{{--                    player.playlist.last()--}}
{{--                    player.play()--}}
{{--                })--}}
{{--                movePrevBtn.addEventListener('click', () => {--}}
{{--                    player.playlist.previous()--}}
{{--                    player.play()--}}
{{--                })--}}
{{--                moveNextBtn.addEventListener('click', () => {--}}
{{--                    player.playlist.next()--}}
{{--                    player.play()--}}
{{--                })--}}
{{--            }--}}
{{--        }--}}
{{--    </script>--}}

{{--<script>--}}
{{--    const videoJs = {--}}
{{--        init: function () {--}}
{{--            this.configVideoJs()--}}
{{--        },--}}
{{--        configVideoJs: function () {--}}
{{--            const player = videojs('my-player', {--}}
{{--                playbackRates: [0.7, 1.0, 1.5, 2.0],--}}
{{--            })--}}

{{--            player.playlist(--}}
{{--                [--}}
{{--                    @if(isset($list_lessons))--}}

{{--                        @foreach($list_lessons as $key => $value)--}}

{{--                            @php--}}
{{--                                    $typeVideo = "video_demo";--}}
{{--                                     if($type == "full"){--}}
{{--                                         $typeVideo = "video_full";--}}
{{--                                     }--}}
{{--                                    $nameVideo = $value->{$typeVideo};--}}
{{--                                    $src = "https://player.vimeo.com/video/" . $nameVideo;--}}
{{--                            @endphp--}}
{{--                            {--}}
{{--                                name: '{{ $value->label }}',--}}
{{--                                // description: 'Explore the depths of our planet\'s oceans. ',--}}
{{--                                duration: {{ $value->duration === null ? 0 : $value->duration }},--}}
{{--                                sources: [--}}
{{--                                    {--}}
{{--                                        src: '{{ $src }}',--}}
{{--                                        type: 'video/mp4'--}}
{{--                                    },--}}
{{--                                ],--}}
{{--                                // you can use <picture> syntax to display responsive images--}}
{{--                                thumbnail: [--}}
{{--                                    { src: '{{ asset('images/lesson/' . $value->thumbnail ) }}',},--}}
{{--                                ]--}}
{{--                            },--}}

{{--                @endforeach--}}


{{--                        @endif--}}

{{--                ]);--}}

{{--            player.playlistUi();--}}

{{--            // const loopBtn = document.querySelector('.lesson-action-video .action-item.loop')--}}
{{--            const moveFirstBtn = document.querySelector('.lesson-action-video .action-item.first')--}}
{{--            const moveLastBtn = document.querySelector('.lesson-action-video .action-item.last')--}}
{{--            const movePrevBtn = document.querySelector('.lesson-action-video .action-item.prev')--}}
{{--            const moveNextBtn = document.querySelector('.lesson-action-video .action-item.next')--}}

{{--            // loopBtn.addEventListener('click', () => {--}}
{{--            // 	loopBtn.classList.toggle('active')--}}
{{--            // 	if (loopBtn.className.includes('active')) {--}}
{{--            // 		player.playlist.repeat(true)--}}
{{--            // 	} else {--}}
{{--            // 		player.playlist.repeat(false)--}}
{{--            // 	}--}}
{{--            // })--}}

{{--            moveFirstBtn.addEventListener('click', () => {--}}
{{--                player.playlist.first()--}}
{{--                player.play()--}}
{{--            })--}}
{{--            moveLastBtn.addEventListener('click', () => {--}}
{{--                player.playlist.last()--}}
{{--                player.play()--}}
{{--            })--}}
{{--            movePrevBtn.addEventListener('click', () => {--}}
{{--                player.playlist.previous()--}}
{{--                player.play()--}}
{{--            })--}}
{{--            moveNextBtn.addEventListener('click', () => {--}}
{{--                player.playlist.next()--}}
{{--                player.play()--}}
{{--            })--}}
{{--        }--}}
{{--    }--}}
{{--    $(document).ready(function () {--}}
{{--        videoJs.init()--}}
{{--    });--}}

{{--</script>--}}
@stop
