<div class="Breadcrumb">
    <div class="container">
        <div class="Breadcrumb-wrapper">
            <div class="Breadcrumb-list flex flex-wrap"><a class="Breadcrumb-list-item" href="/">Trang chủ</a>
                <div class="Breadcrumb-list-item arrow">
                    <svg width="9" height="14" viewBox="0 0 9 14" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M1 1L7 7L1 13" stroke="#777777" stroke-width="1.5" stroke-linecap="round"></path></svg>
                </div>
                @if(!empty($data))
                    @foreach($data as $k => $v)
                     <a class="Breadcrumb-list-item" href="/">{{@$v['name']}}</a>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
</div>
