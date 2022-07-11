
@if ($paginator->lastPage() > 1)
    <div class="pagination-wrapper d-flex justify-content-center align-items-center flex-wrap">
        <div class="pagination-item arrow-left"><a href="{{ $paginator->url(1) }}">&lt;</a></div>
        @for ($i = 1; $i <= $paginator->lastPage(); $i++)
            <div class="pagination-item {{ ($paginator->currentPage() == $i) ? ' active' : '' }}"><a href="{{ $paginator->url($i) }}">{{ $i }}</a></div>
        @endfor
        <div class="pagination-item arrow-right"><a href="{{ $paginator->url($paginator->currentPage()+1) }}">&gt;</a></div>
    </div>
@endif
