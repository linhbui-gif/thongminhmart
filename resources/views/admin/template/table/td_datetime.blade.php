@if(isset($itemField['format']))
    <td>{{ $item->{$itemField['name']}->format($itemField['format']) }}</td>
@else
    <td>{{ $item->{$itemField['name']} }}</td>
@endif

