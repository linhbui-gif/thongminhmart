@if ($paginator->hasPages())
<div class="row">
    <div class="col-sm-5"><div class="dataTables_info" role="status" aria-live="polite">Showing {{ $paginator->firstItem() }} to {{ $paginator->lastItem() }} of {{ $paginator->total() }} entries</div></div>
    <div class="col-sm-7">
        <div class="dataTables_paginate paging_simple_numbers text-right">
            <ul class="pagination">
                <li class="paginate_button previous {{ ($paginator->currentPage() == 1) ? ' disabled' : '' }}" id="example2_previous"><a href="{{ $paginator->url(1) }}" aria-controls="example2" data-dt-idx="0" tabindex="0">Previous</a></li>
                @for ($i = 1; $i <= $paginator->lastPage(); $i++)
                    <li class="paginate_button {{ ($paginator->currentPage() == $i) ? ' active' : '' }}"><a href="{{ $paginator->url($i) }}" aria-controls="example2" data-dt-idx="1" tabindex="0">{{ $i }}</a></li>
                @endfor

                <li class="paginate_button next {{ ($paginator->currentPage() == $paginator->lastPage()) ? ' disabled' : '' }}" id="example2_next"><a href="{{ $paginator->url($paginator->currentPage()+1) }}" aria-controls="example2" data-dt-idx="7" tabindex="0">Next</a></li>
            </ul>
        </div>
    </div>
</div>
@endif
