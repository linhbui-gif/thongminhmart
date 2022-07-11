@php
    $v = '';
    if(isset($item_model->{$item['name']}) && $item_model->{$item['name']} != null ){
        if(isset($item['format'])){
            $v = $item_model->{$item['name']}->format($item['format']);
        }else{
            $v = $item_model->{$item['name']};
        }

    }
@endphp
<div class="form-group">
    <label for="{{ $item['name'] }}">{{ $item['label'] }}:</label>
    <input autocomplete="off" value="{{ old($item['name'], $v )  }}" name="{{ $item['name'] }}" type="text" class="form-control" id="{{ $item['name'] }}">
</div>
<script>

    $.fn.datepicker.dates['en'] = {
        days: ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"],
        daysShort: ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"],
        daysMin: ["Su", "Mo", "Tu", "We", "Th", "Fr", "Sa"],
        months: ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"],
        monthsShort: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
        today: "Today",
        clear: "Clear",
        format: "mm/dd/yyyy",
        titleFormat: "MM yyyy", /* Leverages same syntax as 'format' */
        weekStart: 0
    };
    $.fn.datepicker.dates['vi'] = {
        days: ["Chủ nhật", "Thứ hai", "Thứ ba", "Thứ tư", "Thứ năm", "Thứ sáu", "Thứ 7"],
        daysShort: ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"],
        daysMin: ["CN", "T2", "T3", "T4", "T5", "T6", "T7"],
        months: ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"],
        monthsShort: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
        today: "Today",
        clear: "Clear",
        format: "dd/mm/yyyy",
        titleFormat: "MM yyyy", /* Leverages same syntax as 'format' */
        weekStart: 0
    };

</script>
<script>
    $('#{{ $item['name'] }}').datepicker({
        language : 'vi'
    });
</script>
