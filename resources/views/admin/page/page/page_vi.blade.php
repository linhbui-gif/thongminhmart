<div id="thongtin" class="page_manager tab-pane fade in active">
    @php
        $content = unserialize($item->content);
    @endphp
    @if($item->id == 19)
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="">Khối tiêu đề du thuyền của Aliga</label>
                    <input value="{{ @$content['duthuyen' ]['name'] }}" name="content[duthuyen][name]"  type="text" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">Khối các hoạt động </label>
                    <input value="{{ @$content['activity' ]['name'] }}" name="content[activity][name]"  type="text" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">Khối đánh giá của khách hàng</label>
                    <input value="{{ @$content['client' ]['name'] }}" name="content[client][name]"  type="text" class="form-control">
                </div>
                <div class="col-12">
                    <h3>Khối kêu gọi hành động</h3>
                    <div class="form-group">
                        <label for="">Mô tả</label>
                        <input value="{{ @$content['call' ]['name'] }}" name="content[call][name]"  type="text" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Tên Button</label>
                        <input value="{{ @$content['call' ]['button'] }}" name="content[call][button]"  type="text" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Link Button</label>
                        <input value="{{ @$content['call' ]['link'] }}" name="content[call][link]"  type="text" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <label for="">Khối đối tác</label>
                    <input value="{{ @$content['partner' ]['name'] }}" name="content[partner][name]"  type="text" class="form-control">
                </div>
            </div>

        </div>

    @elseif($item->id == 21)
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="">Name</label>
                    <input value="{{ @$item->name }}" type="text" class="form-control">
                </div>
                <div class="form-group ">
                    <label for="">Nội dung:</label>
                    <textarea  id="content_finder" name="content[finder][text]" class="form-control" name="" id="" cols="30" rows="10">{{ @$content['finder']['text'] }}</textarea>
                    <script>
                        CKEDITOR.replace( 'content_finder' );
                    </script>
                </div>
            </div>
        </div>
    @elseif($item->id == 22)
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="">Name</label>
                    <input value="{{ @$content['kinhnghiem']['name'] }}" name="content[kinhnghiem][name]" type="text" class="form-control">
                </div>
                <div class="form-group ">
                    <label for="">Nội dung:</label>
                    <textarea  id="content_exp" name="content[content_exp][text]" class="form-control" name="" id="" cols="30" rows="10">{{ @$content['content_exp']['text'] }}</textarea>
                    <script>
                        CKEDITOR.replace( 'content_exp' );
                    </script>
                </div>
            </div>
        </div>
    @elseif($item->id == 23)
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="">Name</label>
                    <input value="{{ @$content['lienhe']['name'] }}" name="content[lienhe][name]" type="text" class="form-control">
                </div>

            </div>
{{--            <div class="col-md-12">--}}
{{--                <div class="form-group">--}}
{{--                    <label for="">Địa chỉ 1</label>--}}
{{--                    <input value="{{ @$content['lienhe']['name'] }}" name="content[lienhe][name]" type="text" class="form-control">--}}
{{--                </div>--}}
{{--                <div class="form-group">--}}
{{--                    <label for="">Description</label>--}}
{{--                    <input value="{{ @$content['lienhe']['description'] }}" name="content[lienhe][description]" type="text" class="form-control">--}}
{{--                </div>--}}
{{--            </div>--}}
        </div>

    @elseif($item->id == 24)
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="">Name</label>
                    <input value="{{ @$item->name }}" type="text" class="form-control">
                </div>
            </div>
        </div>

    @elseif($item->id == 26)
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="">Name</label>
                    <input value="{{ @$item->name }}" type="text" class="form-control">
                </div>
            </div>
        </div>
    @elseif($item->id == 27)
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="">Name</label>
                    <input value="{{ @$content['tuyendung']['name'] }}" name="content[tuyendung][name]" type="text" class="form-control">
                </div>
                <div class="form-group ">
                    <label for="">Nội dung:</label>
                    <textarea  id="content_tuyendung" name="content[tuyendung][text]" class="form-control" name="" id="" cols="30" rows="10">{{ @$content['tuyendung']['text'] }}</textarea>
                    <script>
                        CKEDITOR.replace( 'content_tuyendung' );
                    </script>
                </div>
            </div>
        </div>
    @elseif($item->id == 28)
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="">Name</label>
                    <input value="{{ @$content['page_about']['name'] }}" name="content[page_about][name]" type="text" class="form-control">
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group ">
                    <label for="">Nội dung:</label>
                    <textarea  id="page_about" name="content[about][text]" class="form-control" name="" id="" cols="30" rows="10">{{ @$content['about']['text'] }}</textarea>
                    <script>
                        CKEDITOR.replace( 'page_about' );
                    </script>
                </div>
            </div>

        </div>
    @elseif($item->id == 31)
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="">Name</label>
                    <input value="{{ @$content['tintuc']['name'] }}" name="content[tintuc][name]" type="text" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">Description</label>
                    <input value="{{ @$content['tintuc']['description'] }}" name="content[tintuc][description]" type="text" class="form-control">
                </div>
            </div>
        </div>

    @endif
</div>
