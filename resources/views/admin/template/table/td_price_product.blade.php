@if($item->{$itemField['name']} == -1)
    <td>Miễn phí</td>
@elseif($item->{$itemField['name']} == -2)
    <td>Sắp khai giảng</td>
@else
    <td>{{ $item->{$itemField['name']} }}</td>
@endif

