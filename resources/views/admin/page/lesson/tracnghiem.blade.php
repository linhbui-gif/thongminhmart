@php
    //dd($item->questions);
@endphp
<div id="soantracnghiem">
    <div id="hwpwrap">
        <div class="custom-wp-admin wp-admin wp-core-ui js   menu-max-depth-0 nav-menus-php auto-fold admin-bar">
            <div id="wpwrap">
                <div id="wpcontent">
                    <div id="wpbody">
                        <div id="wpbody-content" style="overflow: hidden;">

                            <div class="wrap">

                                <div id="nav-menus-frame">

                                    <div id="menu-settings-column" class="metabox-holder">

                                        <div class="clear"></div>


                                            <div id="side-sortables" class="accordion-container">
                                                <ul class="outer-border">
                                                    <li class="control-section accordion-section add-page open" id="add-page">
                                                        <h3 class="accordion-section-title hndle" tabindex="0"> Tạo câu hỏi <span class="screen-reader-text">Press return or enter to expand</span></h3>
                                                        <div class="accordion-section-content " style="display: block;">
                                                            <div class="inside">
                                                                <div class="customlinkdiv" id="customlinkdiv">
                                                                    <form action="{{ route("admin.tracnghiem.store") }}" method="POST">
                                                                        @csrf
                                                                        <p id="menu-item-name-wrap">
                                                                            <div class="form-group">
                                                                                <label for="comment">Nội dung câu hỏi:</label>
                                                                                @php
                                                                                    $c_q = "";
                                                                                    if(isset($_GET['question_id']) && $_GET['question_id']){
                                                                                        $q = \App\Tracnghiem::find($_GET['question_id']);
                                                                                        $c_q = $q->content;
                                                                                    }
                                                                                @endphp
                                                                                <textarea name="question_text" class="form-control" rows="5" id="question_text">{{ $c_q }}</textarea>
                                                                            </div>
                                                                        </p>
                                                                        <p class="button-controls">
                                                                            @if(isset($_GET['question_id']) && $_GET['question_id'])
                                                                                <a href="{{ route("admin.lesson.editLesson", [ 'lesson_id' => $item->id]  ) }}?tab_current=tracnghiem_tab">Tạo mới câu hỏi</a>
                                                                            @endif
                                                                                @if(isset($_GET['question_id']) && $_GET['question_id'])
                                                                                    <button type="submit"  class="button-secondary submit-add-to-menu right">Cập nhật vào bài thi</button>
                                                                                @else
                                                                                    <button type="submit"  class="button-secondary submit-add-to-menu right">Thêm vào bài thi</button>
                                                                                @endif

                                                                            <span class="spinner" id="spincustomu"></span>
                                                                        </p>
                                                                        <input type="hidden" name="lesson_id" value="{{ $item->id }}">
                                                                        <input type="hidden" name="tab_current" value="tracnghiem_tab">
                                                                        @if(isset($_GET['question_id']) && $_GET['question_id'])
                                                                            <input type="hidden" name="question_id" value="{{ $_GET['question_id'] }}">
                                                                        @endif
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </li>

                                                </ul>
                                            </div>


                                    </div>
                                    <div id="menu-management-liquid">
                                        <div id="menu-management">
                                            <div id="update-nav-menu">
                                                <div class="menu-edit ">
{{--                                                    <div id="nav-menu-header">--}}
{{--                                                        <div class="major-publishing-actions">--}}
{{--                                                            <label class="menu-name-label howto open-label" for="menu-name"> <span>Tên</span>--}}
{{--                                                                <input name="menu-name" id="menu-name" type="text" class="menu-name regular-text menu-item-textbox" title="Enter menu name" value="Chương 1 : Giới thiệu">--}}
{{--                                                                <input type="hidden" id="idmenu" value="25">--}}
{{--                                                            </label>--}}

{{--                                                            <div class="publishing-action">--}}
{{--                                                                <a onclick="getmenus()" name="save_menu" id="save_menu_header" class="button button-primary menu-save">Cập nhật</a>--}}
{{--                                                                <span class="spinner" id="spincustomu2" style="display: none;"></span>--}}
{{--                                                            </div>--}}

{{--                                                        </div>--}}
{{--                                                    </div>--}}
                                                    <div id="post-body">
                                                        <div id="post-body-content">

                                                            <h3>Cấu trúc bài thi</h3>
                                                            <div class="drag-instructions post-body-plain" style="">
                                                                <p>
                                                                    Hãy thêm các câu hỏi vào đây
                                                                </p>
                                                            </div>

                                                            @if(count($item->questions) > 0)
                                                            <ul class="menu ui-sortable" id="menu-to-edit">
                                                                @php
                                                                    $questions = $item->questions()->orderBy('order', 'asc')->get();
                                                                @endphp
                                                                @foreach($questions as $k => $q)
                                                                <li id="menu-item-{{ $q->id }}" class="menu-item menu-item-depth-0 menu-item-page pending menu-item-edit-inactive" style="display: list-item; position: relative; top: 0px; left: 0px;">
                                                                    <dl class="menu-item-bar">
                                                                        <dt class="menu-item-handle ui-sortable-handle">
                                                                            <span class="item-title">
                                                                                <span class="menu-item-title">
                                                                                    <span id="menutitletemp_{{ $q->id }}">{{ $q->content }}</span>
                                                                                    <span style="color: transparent;">|{{ $q->id }}|</span>
                                                                                    <a href="?question_id={{ $q->id }}&tab_current=tracnghiem_tab"><i class="fa fa-edit"></i> Edit</a>
                                                                                </span>
                                                                                <span class="is-submenu" style="display: none;"></span>
                                                                            </span>
                                                                            <span class="item-controls">
                                                                                <span class="item-type"></span>
                                                                                <span class="item-order hide-if-js">
                                                                                    <a href="#" class="item-move-up"><abbr title="Move Up">↑</abbr></a> | <a href="#" class="item-move-down"><abbr title="Move Down">↓</abbr></a> </span>
                                                                                    <a class="item-edit" id="edit-{{ $q->id }}"  href="?edit-menu-item=38#menu-item-settings-{{ $q->id }}"> Bài 1 |38| . Element menu 1 of 2.</a>
                                                                            </span>
                                                                        </dt>
                                                                    </dl>

                                                                    <div class="menu-item-settings" id="menu-item-settings-{{ $q->id }}" style="display: none;">
                                                                        <input type="hidden" class="edit-menu-item-id" name="menuid_{{ $q->id }}" value={{ $q->id }}>
                                                                        <form action="{{ route("admin.tracnghiem.update") }}" method="POST">
                                                                            @csrf
                                                                            @php
                                                                                $cac_dap_an = json_decode($q->cac_dap_an,true);
                                                                            @endphp
                                                                            <p class="description description-thin">
                                                                                <label for="edit-menu-item-title-{{ $q->id }}"> Đáp án <span class="order_dapan">A</span>
                                                                                    <br>
                                                                                    <input value="{{ @$cac_dap_an[0] }}" type="text"  class="widefat edit-menu-item-title" name="dapan[]">
                                                                                </label>
                                                                            </p>
                                                                            <p class="description description-thin">
                                                                                <label for="edit-menu-item-title-{{ $q->id }}"> Đáp án <span class="order_dapan">B</span>
                                                                                    <br>
                                                                                    <input value="{{ @$cac_dap_an[1] }}" type="text"  class="widefat edit-menu-item-title" name="dapan[]">
                                                                                </label>
                                                                            </p>
                                                                            <p class="description description-thin">
                                                                                <label for="edit-menu-item-title-{{ $q->id }}"> Đáp án <span class="order_dapan">C</span>
                                                                                    <br>
                                                                                    <input value="{{ @$cac_dap_an[2] }}" type="text"  class="widefat edit-menu-item-title" name="dapan[]">
                                                                                </label>
                                                                            </p>
                                                                            <p class="description description-thin">
                                                                                <label for="edit-menu-item-title-{{ $q->id }}"> Đáp án <span class="order_dapan">D</span>
                                                                                    <br>
                                                                                    <input value="{{ @$cac_dap_an[3] }}" type="text"  class="widefat edit-menu-item-title" name="dapan[]">
                                                                                </label>
                                                                            </p>

                                                                            <p class="description description-thin">
                                                                                <label for="sel1" class="dapan_dung">Chọn đáp án đúng:</label>
                                                                                <select name="dapan_dung" class="form-control">
                                                                                    @php
                                                                                        $dung = $q->dap_an_dung;
                                                                                    @endphp
                                                                                    <option @if($dung == 0) selected @endif value="0">A</option>
                                                                                    <option @if($dung == 1) selected @endif value="1">B</option>
                                                                                    <option @if($dung == 2) selected @endif value="2">C</option>
                                                                                    <option @if($dung == 3) selected @endif value="3">D</option>
                                                                                </select>
                                                                            </p>

                                                                            <div class="menu-item-actions description-wide submitbox">

                                                                                <a class=" submitdelete"  href="javascript:deleteAction('{{ route("admin.tracnghiem.delete", [ "id" => $q->id ] ) }}?tab_current=tracnghiem_tab')">Xóa</a>
                                                                                <span class="meta-sep hide-if-no-js"> | </span>

                                                                                <button type="submit" class="button button-primary updatemenu"  href="#">Cập nhật</button>
                                                                            </div>
                                                                            <input type="hidden" name="tab_current" value="tracnghiem_tab">
                                                                            <input type="hidden" name="id" value="{{ $q->id }}">
                                                                        </form>
                                                                    </div>
                                                                    <ul class="menu-item-transport"></ul>
                                                                </li>
                                                                @endforeach
                                                            </ul>
                                                            @endif
                                                            <div class="menu-settings">

                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div id="nav-menu-footer">
                                                        <div class="major-publishing-actions">

{{--                                                            <span class="delete-action"> <a class="submitdelete deletion menu-delete" onclick="deletemenu()" href="javascript:void(9)">Xóa</a> </span>--}}
{{--                                                            <div class="publishing-action">--}}

{{--                                                                <a onclick="getmenus()" name="save_menu" id="save_menu_header" class="button button-primary menu-save">Lưu lại</a>--}}
{{--                                                                <span class="spinner" id="spincustomu2"></span>--}}
{{--                                                            </div>--}}

                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="clear"></div>
                        </div>

                        <div class="clear"></div>
                    </div>
                    <div class="clear"></div>
                </div>

                <div class="clear"></div>
            </div>
        </div>
    </div>
    <input type="hidden" value="{{ $item->id }}" id="id_lesson">
</div>
