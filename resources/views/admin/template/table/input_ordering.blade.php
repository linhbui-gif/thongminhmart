

@php
   // $v = $item->{$itemField['name']};
@endphp
<td>
    <input value="{{ @$item->{$itemField['name']} }}" name="{{ $itemField['name'] }}[{{ $item->id }}]" style="width: 75px" class="form-control"  type="number">
</td>

