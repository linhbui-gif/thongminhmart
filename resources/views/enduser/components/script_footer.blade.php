<a class="ButtonToTop" href="#top"><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-chevron-up" width="44" height="44" viewBox="0 0 24 24" stroke-width="2" stroke="#000" fill="none" stroke-linecap="round" stroke-linejoin="round">
            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
            <polyline points="6 15 12 9 18 15" />
        </svg></a>
    <div class="ButtonsCta">
        <div class="ButtonsCta-item">
            <div class="ButtonsCta-item-tooltip">Nhắn tin Zalo</div><a href="#"><img src="{{ asset('/assets/images/image-button-cta-zalo.png') }}" alt=""></a>
        </div>
        <div class="ButtonsCta-item">
            <div class="ButtonsCta-item-tooltip">Gọi ngay</div><a href="#"><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-phone" width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="#fff" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M5 4h4l2 5l-2.5 1.5a11 11 0 0 0 5 5l1.5 -2.5l5 2v4a2 2 0 0 1 -2 2a16 16 0 0 1 -15 -15a2 2 0 0 1 2 -2" />
                </svg></a>
        </div>
        <div class="ButtonsCta-item">
            <div class="ButtonsCta-item-tooltip">Bản đồ</div><a href="#"><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-map-pin" width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="#fff" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <circle cx="12" cy="11" r="3" />
                    <path d="M17.657 16.657l-4.243 4.243a2 2 0 0 1 -2.827 0l-4.244 -4.243a8 8 0 1 1 11.314 0z" />
                </svg></a>
        </div>
    </div>
    <div class="ProductCategoryDrawer">
        <div class="ProductCategoryDrawer-overlay"></div>
        <div class="ProductCategoryDrawer-main"><a class="ProductCategoryDrawer-main-item" href="danh-sach-san-pham.html"><span class="ProductCategoryDrawer-main-item-image"><img src="" alt=""></span><span class="ProductCategoryDrawer-main-item-title">Danh mục 1</span></a><a class="ProductCategoryDrawer-main-item" href="danh-sach-san-pham.html"><span class="ProductCategoryDrawer-main-item-image"><img src="" alt=""></span><span class="ProductCategoryDrawer-main-item-title">Danh mục 2</span></a><a class="ProductCategoryDrawer-main-item" href="danh-sach-san-pham.html"><span class="ProductCategoryDrawer-main-item-image"><img src="" alt=""></span><span class="ProductCategoryDrawer-main-item-title">Danh mục 3</span></a><a class="ProductCategoryDrawer-main-item" href="danh-sach-san-pham.html"><span class="ProductCategoryDrawer-main-item-image"><img src="" alt=""></span><span class="ProductCategoryDrawer-main-item-title">Danh mục 4</span></a><a class="ProductCategoryDrawer-main-item" href="danh-sach-san-pham.html"><span class="ProductCategoryDrawer-main-item-image"><img src="" alt=""></span><span class="ProductCategoryDrawer-main-item-title">Danh mục 5</span></a><a class="ProductCategoryDrawer-main-item" href="danh-sach-san-pham.html"><span class="ProductCategoryDrawer-main-item-image"><img src="" alt=""></span><span class="ProductCategoryDrawer-main-item-title">Danh mục 6</span></a><a class="ProductCategoryDrawer-main-item" href="danh-sach-san-pham.html"><span class="ProductCategoryDrawer-main-item-image"><img src="" alt=""></span><span class="ProductCategoryDrawer-main-item-title">Danh mục 7</span></a><a class="ProductCategoryDrawer-main-item" href="danh-sach-san-pham.html"><span class="ProductCategoryDrawer-main-item-image"><img src="" alt=""></span><span class="ProductCategoryDrawer-main-item-title">Danh mục 8</span></a>
        </div>
    </div>
    <script src="{{ asset('/assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('/assets/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('/assets/js/main.js') }}"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@yield('script')
@if (Session::has('success'))
    <script>
        // toastr.success('{{ Session::get('success') }}', 'Thành công');
        Swal.fire({
            position: 'top-end',
            icon: 'success',
            title: '{{ Session::get('success') }}',
            showConfirmButton: false,
            timer: 1500
        });
    </script>
@endif
@if (Session::has('error'))
    <script>
        // toastr.error('{{ Session::get('error') }}', 'Thất bại');
        Swal.fire({
            position: 'top-end',
            icon: 'error',
            title: '{{ Session::get('error') }}',
            showConfirmButton: false,
            timer: 1500
        });
    </script>
@endif
