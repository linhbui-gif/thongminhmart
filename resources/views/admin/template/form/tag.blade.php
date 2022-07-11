@php
    $classSource = new $item['data_source'];
    $data = $classSource->select("id","name")->orderBy('id','desc')->get()->toArray();
    if(is_object($item_model) && $item_model->{$item['foreign_key']}){
        $arrChecked = old($item['name'], @$item_model->{$item['foreign_key']}->pluck('id','id')->toArray() );
    }else{
        $arrChecked = old($item['name'], []);
    }

@endphp
<div class="form-group">
    <label for="{{ $item['name'] }}">Chọn {{ $item['label'] }}:</label>
    <select multiple="multiple" name="{{ $item['name'] }}[]" class="form-control" id="{{ $item['name'] }}">
        @foreach($data as $k => $item_source)
            @php
                $checked = "";
                if( isset($arrChecked) && isset($item_source['id'])){
                    if(in_array($item_source['id'], $arrChecked)){
                        $checked = "selected";
                    }
                }

            @endphp
            <option {{ $checked }} value="{{ $item_source['id'] }}">{{ $item_source['name'] }}</option>
        @endforeach
    </select>
</div>
<script>
    $("#{{ $item['name'] }}").select2({
        tags: true,
        tokenSeparators: [',', ' ']
    });
</script>
