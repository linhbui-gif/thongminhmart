
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="slug">Slug:</label>
                <input value="{{ old('slug',@$item['slug'] ) }}" name="slug" type="text" class="form-control" id="slug">
            </div>
            <script>
                $("input[id='name']").change(function(){
                    var t = $(this).val();
                    t = ChangeToSlugNew(t);
                    $("input[id='slug']").val(t);
                });
                function ChangeToSlugNew(select_nguon) {
                    var title, str;
                    // Chuyển hết sang chữ thường
                    str = select_nguon;
                    str = str.toLowerCase();

                    // xóa dấu
                    str = str.replace(/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/g, 'a');
                    str = str.replace(/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/g, 'e');
                    str = str.replace(/(ì|í|ị|ỉ|ĩ)/g, 'i');
                    str = str.replace(/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/g, 'o');
                    str = str.replace(/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/g, 'u');
                    str = str.replace(/(ỳ|ý|ỵ|ỷ|ỹ)/g, 'y');
                    str = str.replace(/(đ)/g, 'd');

                    // Xóa ký tự đặc biệt
                    str = str.replace(/([^0-9a-z-\s])/g, '');

                    // Xóa khoảng trắng thay bằng ký tự -
                    str = str.replace(/(\s+)/g, '-');

                    // xóa phần dự - ở đầu
                    str = str.replace(/^-+/g, '');

                    // xóa phần dư - ở cuối
                    str = str.replace(/-+$/g, '');
                    // xóa -- lặp lại
                    str = str.replace(/-+/g, '-');
                    // return
                    return str;
                }

            </script>
            <div class="form-group">
                <label for="meta_title">Meta Title:</label>
                <input value="{{ old('meta_title',@$item['meta_title'] ) }}" name="meta_title" type="text" class="form-control" id="meta_title">
            </div>
            <div class="form-group">
                <label for="meta_description">Meta Description:</label>
                <textarea class="form-control" name="meta_description" id="meta_description" rows="3" cols="80">{{ old('meta_description',@$item['meta_description'] ) }}</textarea>
            </div>
            <div class="form-group">
                <label for="meta_keywords">Meta Keywords:</label>
                <input value="{{ old('meta_keywords',@$item['meta_keywords'] ) }}" name="meta_keywords" type="text" class="form-control" id="meta_keywords">
            </div>

        </div>
    </div>

