function changeSearch(t,k,v){
    var tObj = $(t);
    tObj.parents(".box-search").find(".btn").text(v);
    $("input[name='search_type']").val(k);
}
function searchAction(){
    var type = $("input[name='search_type']").val();
    var value = $("input[name='search_value']").val();
    if(type == "" || value == ""){
        alert('không được rỗng');
        return;
    }
    var pathname	= window.location.pathname;
    console.log(pathname);
    let searchParams= new URLSearchParams(window.location.search);
    var params 			= ['page'];
    let link		= "";
    $.each( params, function( key, value ) {
        if (searchParams.has(value) ) {
            link += value + "=" + searchParams.get(value) + "&"
        }
    });
    window.location.href = pathname + "?" + link  + 'search_type=' + type + '&search_value=' + value;
}
function clearSearchAction(){
    var pathname	= window.location.pathname;
    window.location.href = pathname;
}
function deleteAction(link){
    alertify.confirm('Thông báo', 'Bạn chắc chắn muốn xóa',
        function(){
            window.location.href = link;
        }
        ,
        function(){

        });
}
function actionCommentDelete(link){
    alertify.confirm('Thông báo', 'Bạn chắc chắn muốn xóa',
        function(){
            window.location.href = link;
        }
        ,
        function(){

        });
}
function deleteMulti(){
    alertify.confirm('Thông báo', 'Bạn chắc chắn muốn xóa',
        function(){
           $("#frmList").submit();
        }
        ,
        function(){

        });
}
$(".picture_multi").change(function() {
    readURLMulty(this);
});
$(".file_picture_one").change(function() {
    readURL(this);
});
function readURLMulty(input) {
    var length = input.files['length'];
    console.log(input);
    $(input).next(".multi_preview_image").html("");
    for (var i = 0; i < length; i++) {

        if (input.files && input.files[i]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                var src = e.target.result;
                // apend img after id
                var img = "<img class='avatar_preview' src=" + src + ">";
                $(input).after(img);
            }

            reader.readAsDataURL(input.files[i]);
        }
    }

}
function readURL(input) {
    var inputObj = $(input);
    console.log(inputObj);
    inputObj.parents(".file_picture").children(".image-upload").remove();
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function(e) {
            var src = e.target.result;
            var img = htmlImg(src);
            inputObj.after(img);
        }

        reader.readAsDataURL(input.files[0]);
    }
}
function htmlImg(src) {
    var html = '<div class="image-upload">';
    html += '<img src="' + src + '" class="preview_picture">';
    html += '</div>';
    return html;
}
function submitFormOrdering(link){
    $('#frmCompo').attr('action', link);
    $('#frmCompo').submit();
}
function submitForm(){
    $('#form_info').submit();
}
function ordering(link){
    alertify.confirm('Thông báo', 'Bạn chắc chắn muốn thay đổi thứ tự',
        function(){
            $("#frmList").attr('action', link);
            $("#frmList").submit();
        }
        ,
        function(){

        });
}
function activeCourse(link){
    alertify.confirm('Thông báo', 'Bạn chắc chắn kích hoạt khóa học này',
        function(){
            window.location.href = link;
        }
        ,
        function(){

        });
}
$( document ).ready(function() {

    $("#check-all").on('ifChanged', function(){
        var checked = $(this).prop("checked");
        var check = "";
        if(checked){
            check = "check";
        }else{
            check = "uncheck";
        }
        $("#frmList input[type='checkbox']").iCheck(check);
    });
});
function confirmDelete(link){
    if(confirm('Bạn chắc chắn muốn xóa')){
        window.location.href = link;
    }
}
function showEdit(name, price, id){
    $("#form_add_product input[name='name']").val(name);
    $("#form_add_product input[name='price']").val(price);
    $("#form_add_product").append('<input type="hidden" name="compo_id" value="'+id+'">');
    $("#form_add_product").addClass("in");
}
function resetCreate(){
    $("#form_add_product input[name='name']").val('');
    $("#form_add_product input[name='price']").val('');
    $("#form_add_product").append('<input type="hidden" name="compo_id" value="0">');
}

//show video lesson
function previewVideo(input, inputName, PreVideoID){
    var file = $("input[name='" + inputName + "']").get(0).files[0];
    if(file){
        var reader = new FileReader();
        reader.onload = function(){
            $("#" + PreVideoID).attr("src", reader.result);
            $("#" + PreVideoID).show();
            $("iframe").hide();
        }
        reader.readAsDataURL(file);
    }
}

//show picture lesson
function previewImage(input, inputName, PreImageID){
    var file = $("input[name='" + inputName + "']").get(0).files[0];
    if(file){
        var reader = new FileReader();
        reader.onload = function(){
            $("#" + PreImageID).attr("src", reader.result);
            $("#" + PreImageID).show();
            $(".show_image").hide();
        }
        reader.readAsDataURL(file);
    }
}


function triggerShowDelete(className) {
    $('#ctn-app-colors').on(
        {
            mouseenter: function () {
                $(this).children('.dynamic-icon-delete').css({display: 'block'});
            },
            mouseleave: function () {
                $(this).children('.dynamic-icon-delete').css({display: 'none'});
            }
        },
        className
    );
}
function triggerShowDelete2(className) {
    $('.ctn-app-colors').on(
        {
            mouseenter: function () {
                $(this).children('.dynamic-icon-delete').css({display: 'block'});
            },
            mouseleave: function () {
                $(this).children('.dynamic-icon-delete').css({display: 'none'});
            }
        },
        className
    );
}
function triggerNewItem(className) {
    $(className).on('click', function () {
            var newItem = `
            <div class="item-sort">
                <div class="dynamic-box-item">
                  <div class="box-img">
                    <input class="dynamic-attach-id" name="galleries[]"  type="hidden" value="" />
                    <div class="box-icon-upload">
                      <div class="upload-icon"></div>
                      <div class="upload-text">Upload image</div>
                    </div>
                    <div class="upload-image-box">
                      <img class="upload-image" style="display:none;" src="" />
                    </div>
                  </div>
                  <div class="dynamic-icon-delete"></div>
                </div>
            </div>`;


        $(this).before(newItem);
        var lastestIdx = $('.dynamic-box-item').length;
        var elmLastest = $('.dynamic-box-item')
            .eq(lastestIdx - 1)
            .find('.box-pick-color')[0];
        // new CP(elmLastest).on('change', function (r, g, b, a) {
        //     var inputElm = $(this.source).parent().children('input');
        //     inputElm.val(this.color(r, g, b, a));
        //     console.log(inputElm.val());
        //     this.source.style.backgroundColor = this.color(r, g, b, a);
        // });
    });
}
function htmlResultGallery(item){
    return `<div class="item-sort">
                <div class="dynamic-box-item box-gallery-2">
                  <div class="box-img">
                    <input class="dynamic-attach-id" name="result[gallery][image][]"  type="hidden" value="`+item.url+`" />
                    <div class="box-icon-upload">
                      <div class="upload-icon"></div>
                      <div class="upload-text">Upload image</div>
                    </div>
                    <div class="upload-image-box">
                      <img class="upload-image" style="display:block;" src="`+item.url+`" />
                    </div>
                  </div>
                  <div class="dynamic-icon-delete"></div>
                    <div class="group_input">
                        <input name="result[gallery][title][]" type="text" class="g_description">
                    </div>
                </div>
            </div>`;
}
function htmlResultGallerySlider(item){
    return ` <div class="item-sort">
            <div class="dynamic-box-item box-gallery-2">
              <div class="box-img">
                <input class="dynamic-attach-id" name="result[gallery_slider][image][]"  type="hidden" value="`+item.url+`" />
                <div class="box-icon-upload">
                  <div class="upload-icon"></div>
                  <div class="upload-text">Upload image</div>
                </div>
                <div class="upload-image-box">
                  <img class="upload-image" style="display:block;" src="`+item.url+`" />
                </div>
              </div>
              <div class="dynamic-icon-delete"></div>
                <div class="group_input">
                    <input name="result[gallery_slider][title][]" placeholder="title..." type="text" class="g_description">
                    <textarea name="result[gallery_slider][description][]" class="g_description_text" name="" id=""  rows="2"></textarea>
                </div>
            </div>
            </div>`;
}
function triggerNewItemGallery2(className) {
    $(className).on('click', function () {
        var newItem = `
            <div class="item-sort">
                <div class="dynamic-box-item box-gallery-2">
                  <div class="box-img">
                    <input class="dynamic-attach-id" name="result[gallery][image][]"  type="hidden" value="" />
                    <div class="box-icon-upload">
                      <div class="upload-icon"></div>
                      <div class="upload-text">Upload image</div>
                    </div>
                    <div class="upload-image-box">
                      <img class="upload-image" style="display:none;" src="" />
                    </div>
                  </div>
                  <div class="dynamic-icon-delete"></div>
                    <div class="group_input">
                        <input name="result[gallery][title][]" type="text" class="g_description">
                    </div>
                </div>
            </div>`;


        $(this).before(newItem);
        var lastestIdx = $( className).length;
        var elmLastest = $( className)
            .eq(lastestIdx - 1)
            .find('.box-pick-color')[0];
        // new CP(elmLastest).on('change', function (r, g, b, a) {
        //     var inputElm = $(this.source).parent().children('input');
        //     inputElm.val(this.color(r, g, b, a));
        //     console.log(inputElm.val());
        //     this.source.style.backgroundColor = this.color(r, g, b, a);
        // });
    });
}
function triggerNewItemGallerySlider(className) {
    $(className).on('click', function () {
        var newItem = `
            <div class="item-sort">
                <div class="dynamic-box-item box-gallery-2">
                  <div class="box-img">
                    <input class="dynamic-attach-id" name="result[gallery_slider][image][]"  type="hidden" value="" />
                    <div class="box-icon-upload">
                      <div class="upload-icon"></div>
                      <div class="upload-text">Upload image</div>
                    </div>
                    <div class="upload-image-box">
                      <img class="upload-image" style="display:none;" src="" />
                    </div>
                  </div>
                  <div class="dynamic-icon-delete"></div>
                    <div class="group_input">
                        <input name="result[gallery_slider][title][]" placeholder="title..." type="text" class="g_description">
                        <textarea name="result[gallery_slider][description][]" class="g_description_text" name="" id=""  rows="2"></textarea>
                    </div>
                </div>
            </div>`;


        $(this).before(newItem);
        var lastestIdx = $( className).length;
        var elmLastest = $(className)
            .eq(lastestIdx - 1)
            .find('.box-pick-color')[0];
        // new CP(elmLastest).on('change', function (r, g, b, a) {
        //     var inputElm = $(this.source).parent().children('input');
        //     inputElm.val(this.color(r, g, b, a));
        //     console.log(inputElm.val());
        //     this.source.style.backgroundColor = this.color(r, g, b, a);
        // });
    });
}
var route_prefix = "/admin/laravel-filemanager";
function initMediaUploader(selectorRoot) {
    // $(selectorRoot).on('click', '.box-img', function (e) {
    //     $(this).filemanager('image', { prefix: route_prefix });
    //     e.preventDefault();
    //
    // });
}
function triggerDelete() {
    $('#ctn-app-colors').on('click', '.dynamic-icon-delete', function () {
        $(this).parents('.item-sort').remove();
    });
}
function triggerDelete2() {
    $('.ctn-app-colors').on('click', '.dynamic-icon-delete', function () {
        $(this).parents('.item-sort').remove();
    });
}

$(function () {
    initMediaUploader('#ctn-app-colors');
    triggerShowDelete('.dynamic-box-item');
    triggerDelete();
    triggerNewItem('.dynamic-new-box');

    triggerShowDelete2('.dynamic-box-item');
    triggerDelete2();
    initMediaUploader('.ctn-app-colors');
    triggerNewItemGallery2('.box-gallery');


    triggerNewItemGallerySlider('.box-gallery-slider');
    //triggerShowDeleteSlider('.dynamic-box-item');
});
function htmlNewItem(item){
    var html = `<div class="item-sort"><div class="dynamic-box-item">
      <div class="box-img">
        <input class="dynamic-attach-id" name="galleries[]"  type="hidden" value="`+item.url+`" />
        <div class="box-icon-upload">
          <div class="upload-icon"></div>
          <div class="upload-text">Upload image</div>
        </div>
        <div class="upload-image-box">
          <img style="display: block" class="upload-image"  src="`+item.url+`" />
        </div>
      </div>
      <div class="dynamic-icon-delete"></div>
    </div></div>`;
    return html;
}
$.fn.filemanager = function(type, options) {
    type = type || 'file';
    var t = this;
    this.on('click', function(e) {
        var route_prefix = (options && options.prefix) ? options.prefix : '/laravel-filemanager';
        localStorage.setItem('target_input', $(this).data('input'));
        localStorage.setItem('target_preview', $(this).data('preview'));
        window.open(route_prefix + '?type=' + type, 'FileManager', 'width=900,height=600');
        window.SetUrl = function (url, file_path) {
           var linkImg = url[0].url;
            //set the value of the desired input to image url
           var target_input = t.find(".dynamic-attach-id");
           target_input.val(linkImg);

            //set cho file
            $(t).parents(".input-group").children(".path_file").val(linkImg);
            $(".input-group .path_file").val(linkImg);

            //set or change the preview image src
            var target_preview = t.find(".upload-image");
            target_preview.attr('src', linkImg).trigger('change');
            target_preview.css({display: 'block'});
            console.log(url);

            // var html = '';
            // for(var i = 0; i < url.length; i++){
            //     var itemCurrent = url[i];
            //     html += htmlNewItem(itemCurrent);
            // }
            // var parent = $(t).parents('.dynamic-box-item');
            // $(html).insertAfter(parent);
            // parent.remove();



        };
        return false;
    });
}

$('#lfm').filemanager('file', {
    prefix: route_prefix ,
    allow_multi_user: true
});

$(".cung_gia_video").click(function(){
    var price = $(this).data("price");
    $(this).parents(".form-group").find("input[name='price']").val(price);
});
$( function() {
    $( ".ctn-app-colors" ).sortable({
        placeholder: "ui-state-highlight",
        helper:'clone',
        axis: "x"
    });
    $( ".ctn-app-colors" ).disableSelection();
} );


var lfm = function(className, type, options) {
    $(className).on('click', '.box-img', function (e) {
        let t = $(this);
        var route_prefix = (options && options.prefix) ? options.prefix : '/laravel-filemanager';
        //var target_input = document.getElementById(button.getAttribute('data-input'));
        //var target_preview = document.getElementById(button.getAttribute('data-preview'));
        window.open(route_prefix + '?type=' + options.type || 'file', 'FileManager', 'width=900,height=600');
        window.SetUrl = function (url, file_path) {
            var html = '';
            for(var i = 0; i < url.length; i++){
                var itemCurrent = url[i];
                html += htmlNewItem(itemCurrent);
            }
            var parent = $(t).parents('.item-sort');
            $(html).insertAfter(parent);
            parent.remove();
        };
    });
    // box_image.addEventListener('click', function () {
    //     alert('123');

    //
    //     window.open(route_prefix + '?type=' + options.type || 'file', 'FileManager', 'width=900,height=600');
    //     window.SetUrl = function (items) {
    //         console.log(items);
    //
    //         // trigger change event
    //         target_preview.dispatchEvent(new Event('change'));
    //     };
    // });
};
var lfmResult = function(className, type, options) {
    $(className).on('click', '.box-img', function (e) {
        let t = $(this);
        var route_prefix = (options && options.prefix) ? options.prefix : '/laravel-filemanager';
        window.open(route_prefix + '?type=' + options.type || 'file', 'FileManager', 'width=900,height=600');
        window.SetUrl = function (url, file_path) {
            var html = '';
            for(var i = 0; i < url.length; i++){
                var itemCurrent = url[i];
                html += htmlResultGallery(itemCurrent);
            }
            var parent = $(t).parents('.item-sort');
            $(html).insertAfter(parent);
            parent.remove();
        };
    });
};
var lfmResultSlider = function(className, type, options) {
    $(className).on('click', '.box-img', function (e) {
        let t = $(this);
        var route_prefix = (options && options.prefix) ? options.prefix : '/laravel-filemanager';
        window.open(route_prefix + '?type=' + options.type || 'file', 'FileManager', 'width=900,height=600');
        window.SetUrl = function (url, file_path) {
            var html = '';
            for(var i = 0; i < url.length; i++){
                var itemCurrent = url[i];
                html += htmlResultGallerySlider(itemCurrent);
            }
            var parent = $(t).parents('.item-sort');
            $(html).insertAfter(parent);
            parent.remove();
        };
    });
};
var lfmOne = function(className, type, options) {
    $(className).on('click', '.box-img', function (e) {
        let t = $(this);
        var route_prefix = (options && options.prefix) ? options.prefix : '/laravel-filemanager';
        //var target_input = document.getElementById(button.getAttribute('data-input'));
        //var target_preview = document.getElementById(button.getAttribute('data-preview'));
        window.open(route_prefix + '?type=' + options.type || 'file', 'FileManager', 'width=900,height=600');
        window.SetUrl = function (url, file_path) {
            var linkImg = url[0].url;
            //set the value of the desired input to image url
            var target_input = t.find(".dynamic-attach-id");
            target_input.val(linkImg);
            //set cho file
           // $(t).parents(".input-group").children(".path_file").val(linkImg);
           // $(".input-group .path_file").val(linkImg);
            //set or change the preview image src
            var target_preview = t.find(".upload-image");
            target_preview.attr('src', linkImg).trigger('change');
            target_preview.css({display: 'block'});
        };
    });
};

lfm('.box-gallery-ctn-app', 'image', {prefix: route_prefix, type:"image"});
lfmOne('.box-picture-ctn-app', 'image', {prefix: route_prefix, type:"image"});
lfmResult('.result-gallery-app', 'image', {prefix: route_prefix, type:"image"});
lfmResultSlider('.result-slider-app', 'image', {prefix: route_prefix, type:"image"});

$("#option_price").change(function(){
    var v = $(this).val();
    if(v == "1"){
        var price_hidden = $("input[name='price_base_hidden']").val();
        $("#price_base").css({ display: "block" });
        if(price_hidden != "-1" && price_hidden != "-2"){
            $("#price_base").val(price_hidden);
        }else{
            $("#price_base").val("");
        }

    }else if(v == "-1"){
        $("#price_base").val("-1");
        $("#price_base").css({ display: "none" });
    }else if(v == "-2"){
        $("#price_base").val("-2");
        $("#price_base").css({ display: "none" });

    }
});
var p_selected = $("#option_price").val();
if(p_selected == 1){
    $("#price_base").css({ display: "block" });
}

function removeVideoShow(t){
    if(confirm("Bạn chắc chắn muốn xóa !")){
        $(t).parents(".form-group").find("input").val("");
        $(t).parents(".form-group").find("iframe").remove();
    }

}




