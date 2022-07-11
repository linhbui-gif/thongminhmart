
    @csrf
@foreach($arrLang as $k => $langs)
    <h4>{{ $k }}</h4>
<table class="table table-hover">
    <thead>
    <tr>
        <th width="5%">ID</th>
        <th width="15%">Key</th>
        <th>{{ app()->getLocale() }}</th>
    </tr>
    </thead>
    <tbody>
    @php
        $stt = 0;
    @endphp
    @foreach($langs as $k_sub => $item)
        @php
            $stt++;
        @endphp
        <tr>
            <td>{{ $stt  }}</td>
            <td>
                {{ $k_sub }}
            </td>
            <td><input name="data[{{ $k }}][{{ $k_sub }}]" class="form-control" type="text" value="{{ $item }}"></td>
        </tr>
        @endforeach
    </tbody>
</table>
@endforeach
<div class="text-center">
    <button class="btn btn-success" type="submit">Save</button>
</div>

