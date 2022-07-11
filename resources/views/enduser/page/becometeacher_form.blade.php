@extends("enduser.layout")
@section('head')

    @php
    //$page_content = unserialize($page->content);
    //dd($page_content);
    @endphp
@stop
@section('content')

    @include("enduser.partials.breadcrumb",[ 'mainpage' => "Trang chủ",'name' => 'Trở thành giảng viên'])
    <br>
    <section class="section-form-become-teacher">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="wizard">
                        <div class="wizard-inner">
                            <div class="connecting-line"></div>
                            <ul class="nav nav-tabs" role="tablist">
                                <li role="presentation" @if (Session::has('success') && Session::get('success') == 'success') class="disabled" @else class="active" @endif>
                                    <a href="#step1" data-toggle="tab" aria-controls="step1" role="tab"
                                        aria-expanded="true"><span class="round-tab">1 </span> <i>Bước 1</i></a>
                                </li>
                                <li role="presentation" @if (Session::has('success') && Session::get('success') == 'success') class="disabled" @endif>
                                    <a href="#step2" data-toggle="tab" aria-controls="step2" role="tab"
                                        aria-expanded="false"><span class="round-tab">2</span> <i>Bước 2</i></a>
                                </li>
                                <li role="presentation" @if (Session::has('success') && Session::get('success') == 'success') class="active" @else class="disabled" @endif>
                                    <a href="#step3" data-toggle="tab" aria-controls="step3" role="tab"><span
                                            class="round-tab">3</span> <i>Bước 3</i></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    @php
                        $user = Auth::user();
                    @endphp
                    <form action="{{ route('account.postFormTeacher') }}" method="POST" class="authen-form form-teacher">
                        @csrf

                        <div class="tab-content" id="main_form">
                            <div class="tab-pane @if (Session::has('success') && Session::get('success') == 'success') disabled @else active @endif" role="tabpanel" id="step1">
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label><span class="label_name">Họ tên: </span> <span
                                                    class="red_required">*</span></label>
                                            <input name="name" value="{{ $user->fullname() }}"
                                                class="form-control required" type="text">
                                        </div>
                                        <div class="form-group">
                                            <label><span class="label_name">Tuổi:</span> <span
                                                    class="red_required">*</span></label>
                                            <input name="age" class="form-control required" type="number">
                                        </div>
                                        <div class="form-group">
                                            <label><span class="label_name">Điện thoại:</span> <span
                                                    class="red_required">*</span></label>
                                            <input name="phone" value="{{ $user->phone }}" class="form-control required"
                                                type="text">
                                        </div>
                                        <div class="form-group">
                                            <label><span class="label_name">Email:</span> <span
                                                    class="red_required">*</span></label>
                                            <input name="email" value="{{ $user->email }}" class="form-control required"
                                                type="email">
                                        </div>
                                        <div class="form-group">
                                            <label><span class="label_name">Số CMND/CCCD:</span> <span
                                                    class="red_required">*</span></label>
                                            <input name="cmnd" class="form-control required" type="text">
                                        </div>
                                        <div class="form-group">
                                            <label><span class="label_name">Facebook/ Youtube chanel hoặc Kênh xã hội khác
                                                    mà bạn đang sở hữu ?</span></label>
                                            <input name="link_mxh" class="form-control" type="text">
                                        </div>
                                        <span style="color: #958AAB; font-style: italic;"><strong>Ghi chú: </strong>(<span
                                                style="color:red">*</span>) bắt buộc</span>

                                        <ul class="list-inline pull-right button-checkout">
                                            <li><button type="button" class="btn primary btn-next next-step">Tiếp tục <svg
                                                        aria-hidden="true" focusable="false" data-prefix="fas"
                                                        data-icon="arrow-right"
                                                        class="svg-inline--fa fa-arrow-right fa-w-14" role="img"
                                                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                                                        <path fill="currentColor"
                                                            d="M190.5 66.9l22.2-22.2c9.4-9.4 24.6-9.4 33.9 0L441 239c9.4 9.4 9.4 24.6 0 33.9L246.6 467.3c-9.4 9.4-24.6 9.4-33.9 0l-22.2-22.2c-9.5-9.5-9.3-25 .4-34.3L311.4 296H24c-13.3 0-24-10.7-24-24v-32c0-13.3 10.7-24 24-24h287.4L190.9 101.2c-9.8-9.3-10-24.8-.4-34.3z">
                                                        </path>
                                                    </svg></button></li>
                                        </ul>
                                    </div>
                                </div>

                            </div>
                            <div class="tab-pane" role="tabpanel" id="step2">
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label><span class="label_name">Bạn có kinh nghiệm giảng dạy online chưa
                                                    ?</span></label>
                                        </div>
                                        <div class="form-group">
                                            <div class="form-item radio form-check-inline">
                                                <input id="kinhnghiem_yes" type="radio" class="form-check-input"
                                                    name="kinhnghiem">
                                                <label for="kinhnghiem_yes" class="form-check-label">Yes</label>
                                            </div>
                                            <div class="form-item radio form-check-inline">
                                                <input id="kinhnghiem_no" type="radio" class="form-check-input"
                                                    name="kinhnghiem">
                                                <label for="kinhnghiem_no" class="form-check-label">No</label>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label><span class="label_name">Số năm kinh nghiệm giảng dạy:</span><span color="red">*</span></label>
                                            <input name="so_nam_kinh_nghiem" class="form-control required" type="number">
                                        </div>
                                        <div class="form-group">
                                            <label><span class="label_name">Lĩnh vực bạn muốn xây dựng khóa học
                                                    online:</span><span color="red">*</span></label>
                                            <div class="form-item">
                                                @php
                                                    $categories = \App\Course_category::where('status', 'active')
                                                        ->orderBy('name')
                                                        ->get();
                                                @endphp
                                                <select class="custom-select" name="linhvuc">
                                                    <option value="default">-- Chọn lĩnh vực --</option>
                                                    @foreach ($categories as $k => $cate)
                                                        <option value="{{ $cate->id }}">{{ $cate->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label><span class="label_name">Chủ đề/ nội dung chính của khóa học mà bạn muốn
                                                    xây dựng:</span><span color="red">*</span></label>
                                            <input name="chude" class="form-control required" type="text">
                                        </div>
                                        <div class="form-group">
                                            <label><span class="label_name">Khi nào bạn sẵn sàng xây dựng khóa
                                                    học:</span><span color="red">*</span></label>
                                            <input name="khinao" class="form-control required" type="text">
                                        </div>
                                        <span style="color: #958AAB; font-style: italic;"><strong>Ghi chú: </strong>(<span style="color:red">*</span>) bắt buộc</span>
                                        <ul class="list-inline pull-right button-checkout">
                                            <li><button type="button" class="btn default prev-step"><svg aria-hidden="true"
                                                        focusable="false" data-prefix="fas" data-icon="arrow-left"
                                                        class="svg-inline--fa fa-arrow-left fa-w-14" role="img"
                                                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                                                        <path fill="currentColor"
                                                            d="M257.5 445.1l-22.2 22.2c-9.4 9.4-24.6 9.4-33.9 0L7 273c-9.4-9.4-9.4-24.6 0-33.9L201.4 44.7c9.4-9.4 24.6-9.4 33.9 0l22.2 22.2c9.5 9.5 9.3 25-.4 34.3L136.6 216H424c13.3 0 24 10.7 24 24v32c0 13.3-10.7 24-24 24H136.6l120.5 114.8c9.8 9.3 10 24.8.4 34.3z">
                                                        </path>
                                                    </svg> Trước đó</button></li>
                                              
                                            <li><button type="button" class="btn primary btn-next next-step">Gửi thông
                                                    tin</button></li>
                                        </ul>
                                    </div>
                                </div>

                            </div>
                            <div class="tab-pane @if (Session::has('success') && Session::get('success') == 'success') active @else disabled @endif" role="tabpanel" id="step3">
                                <div class="success_teacher">
                                    <div class="box_wrap">
                                        <svg aria-hidden="true" focusable="false" data-prefix="far" data-icon="check-circle"
                                            class="svg-inline--fa fa-check-circle fa-w-16" role="img"
                                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                            <path fill="currentColor"
                                                d="M256 8C119.033 8 8 119.033 8 256s111.033 248 248 248 248-111.033 248-248S392.967 8 256 8zm0 48c110.532 0 200 89.451 200 200 0 110.532-89.451 200-200 200-110.532 0-200-89.451-200-200 0-110.532 89.451-200 200-200m140.204 130.267l-22.536-22.718c-4.667-4.705-12.265-4.736-16.97-.068L215.346 303.697l-59.792-60.277c-4.667-4.705-12.265-4.736-16.97-.069l-22.719 22.536c-4.705 4.667-4.736 12.265-.068 16.971l90.781 91.516c4.667 4.705 12.265 4.736 16.97.068l172.589-171.204c4.704-4.668 4.734-12.266.067-16.971z">
                                            </path>
                                        </svg>
                                        <p class="headtitle">Bạn đã đăng ký thành công</p>
                                        <p class="subtitle">Chúng tôi sẽ liên hệ với bạn trong thời gian sớm nhất</p>
                                    </div>

                                </div>
                            </div>
                        </div>

                        {{-- <div class="form-group half"> --}}
                        {{-- <div class="form-item"></div> --}}
                        {{-- <div class="form-item button-checkout"> --}}
                        {{-- <button type="submit" class="btn primary btn-next">Tiếp theo <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="arrow-right" class="svg-inline--fa fa-arrow-right fa-w-14" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path fill="currentColor" d="M190.5 66.9l22.2-22.2c9.4-9.4 24.6-9.4 33.9 0L441 239c9.4 9.4 9.4 24.6 0 33.9L246.6 467.3c-9.4 9.4-24.6 9.4-33.9 0l-22.2-22.2c-9.5-9.5-9.3-25 .4-34.3L311.4 296H24c-13.3 0-24-10.7-24-24v-32c0-13.3 10.7-24 24-24h287.4L190.9 101.2c-9.8-9.3-10-24.8-.4-34.3z"></path></svg></button> --}}
                        {{-- </div> --}}
                        {{-- </div> --}}
                    </form>
                </div>
            </div>
        </div>
    </section>

@stop

@section('script')
    <script>
        $(document).ready(function() {
            $('.nav-tabs > li a[title]').tooltip();

            //Wizard
            $('a[data-toggle="tab"]').on('shown.bs.tab', function(e) {

                var target = $(e.target);

                if (target.parent().hasClass('disabled')) {
                    return false;
                }
            });

            $(".next-step").click(function(e) {
                var v_step1 = validateStep1();
                if (v_step1) {
                    var v_step2 = validateStep2();
                    if (v_step2) {
                        $(".form-teacher").submit();
                        return;
                    }
                    var active = $('.wizard .nav-tabs li.active');
                    active.next().removeClass('disabled');
                    nextTab(active);
                    $(window).scrollTop(80);

                }


            });
            $(".prev-step").click(function(e) {

                var active = $('.wizard .nav-tabs li.active');
                prevTab(active);
                $(window).scrollTop(80);

            });
        });

        function validateStep2() {
            var inputs = $("#step2 input.required");
            var flag = true;
            $.each(inputs, function(i, e) {
                var obj = $(e);
                var v = obj.val();
                obj.parents(".form-group").find('.txt-error').remove();
                var label = obj.parents(".form-group").find('span.label_name').text();
                console.log(label);
                if (v == "") {
                    flag = false;
                    var txtError = label + ' không được rỗng';
                    $("<p class='txt-error'>" + txtError + "</p>").insertBefore(obj);
                }
            })
            return flag;
        }

        function validateStep1() {
            var inputs = $("#step1 input.required");
            var flag = true;
            $.each(inputs, function(i, e) {
                var obj = $(e);
                var v = obj.val();
                obj.parents(".form-group").find('.txt-error').remove();
                var label = obj.parents(".form-group").find('span.label_name').text();
                console.log(label);
                if (v == "") {
                    flag = false;
                    var txtError = label + ' không được rỗng';
                    $("<p class='txt-error'>" + txtError + "</p>").insertBefore(obj);
                }
            })
            return flag;
        }

        function nextTab(elem) {
            $(elem).next().find('a[data-toggle="tab"]').click();
        }

        function prevTab(elem) {
            $(elem).prev().find('a[data-toggle="tab"]').click();
        }


        $('.nav-tabs').on('click', 'li', function() {
            $('.nav-tabs li.active').removeClass('active');
            $(this).addClass('active');
        });
    </script>

@stop
