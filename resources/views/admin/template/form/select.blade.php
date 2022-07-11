@php
    if(is_array($item['data_source'])){
        $data = $item['data_source'];
        $type = "array";
    }else{
        $classSource = new $item['data_source'];
        $data = $classSource->select("id","name")->where('status','active')->orderBy('id','desc')->get()->toArray();
        $type = "object";
    }
@endphp
<div class="form-group">
    <label for="{{ $item['name'] }}">Chọn {{ $item['label'] }}:</label>
    <select name="{{ $item['name'] }}" class="form-control" id="{{ $item['name'] }}">
        <option value="default">--- Chọn {{ $item['label'] }} --</option>
        @if($type == "array")
            @foreach($data as $k => $v)
                @php
                    $checked = "";
                    $old = old($item['name'],@$item_model[$item['name']] );
                   if($old == $k){
                        $checked = "selected";
                    }
                @endphp
                <option {{ $checked }} value="{{ $k }}">{{ $v }}</option>
            @endforeach
        @else
            @foreach($data as $k => $item_source)
                @php
                    $checked = "";
                    $old = old($item['name'], @$item_model[$item['foreign_key']] );
                   if($item_source['id'] == $old ){
                        $checked = "selected";
                    }
                @endphp
                <option {{ $checked }} value="{{ $item_source['id'] }}">{{ $item_source['name'] }}</option>
            @endforeach
        @endif

    </select>
</div>
