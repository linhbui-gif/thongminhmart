@php
    $model = new $item['data_source'];
    $items = $model->orderBy('id','desc')->get()->pluck('name','id')->toArray();
@endphp
<div class="form-group">
    <label for="{{ $item['name'] }}">{{ $item['label'] }}:</label>
    <select class="form-control {{ $item['name'] }}" name="state">
        <option value="default">-- Select Data --</option>
        @foreach($items as $k => $name)
        <option value="{{ $k }}">{{ $name }}</option>
        @endforeach
    </select>
</div>
<script>
    $(document).ready(function() {
        $('.{{ $item['name'] }}').select2();
    });

</script>
