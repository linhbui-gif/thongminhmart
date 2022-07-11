

@php
    $v = $item->{$itemField['name']};
@endphp

@if($v == "yes")
    <td><span class="label label-success">Yes</span></td>
@else
    <td><span class="label label-danger">No</span></td>
@endif
