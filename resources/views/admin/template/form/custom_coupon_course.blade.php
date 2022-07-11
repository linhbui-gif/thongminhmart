@php
    $list_course = \App\Course_course::where('status', 'active')->orderBy('id','desc')->get();
    $arrChecked = [];
    if(isset($item_model)){
        if(isset($item_model['course_id'])){
             $arrChecked = unserialize($item_model['course_id']);
        }
    }
@endphp
<div class="form-group">
    <label for="">Áp dụng cho:</label>
    <select class="form-control course_coupon" name="course_id[]" multiple>
        <option value="default">-- Chọn khóa học --</option>
        @foreach($list_course as $k => $item)
        <option @if($arrChecked && in_array($item->id, $arrChecked)) selected @endif value="{{ $item->id }}">{{ $item->name }}</option>
        @endforeach
    </select>
</div>
<script>
    $(document).ready(function() {
        $('.course_coupon').select2();
    });
</script>
