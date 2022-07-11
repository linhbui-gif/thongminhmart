<div class="filter-item price">
    <h3>Giá</h3>
    <form action="{{route('product.productList')}}" method="get">
        <div class="filter-price-range">
            <input type="hidden" class="range-slider" name="price">
            <div class="multil-range-value">

                <span id="minValue">0 đ</span>
                <span>-</span>
                <span id="maxValue">0 đ</span>
            </div>
        </div>
        <button type="submit">Lọc</button>
    </form>
</div>
