@php
    if(isset($item['modal'])){
        $m = new $item['modal']();
        $items = $m->select("*")->orderBy('id','desc')->get()->pluck('name','id')->toArray();
        $data = $items;
    }
@endphp

@php
    if(isset($item['key_relave'])){
        if(is_object(@$item_model->{$item['key_relave']})){
            $tmp = $item_model->{$item['key_relave']};
            $arrCheckTmp = [];
            foreach($tmp as $k => $i){
                $arrCheckTmp[] = $i->id;
            }
            $arrCheck = old($item['name'], $arrCheckTmp );
        }else{
             $arrCheck = old($item['name'] );
        }
    }else{
        $arrCheck = old($item['name'] );
    }
@endphp
@foreach($data as $k => $v)
<div class="checkbox">
    <label><input @if($arrCheck && in_array($k,  $arrCheck))  checked @endif name="{{ $item['name'] }}[]" class="minimal" type="checkbox" value="{{ $k }}">{{ $v }}</label>
</div>
@endforeach
