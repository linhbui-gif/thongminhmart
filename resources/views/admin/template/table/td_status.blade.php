

@php
    $v = $item->{$itemField['name']};
@endphp

@if($v == "active")
    <td><span class="label label-success">Active</span></td>
@else
    <td><span class="label label-danger">Inactive</span></td>
@endif
