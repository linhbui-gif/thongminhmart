<script src="{{ asset('enduser/thongminhmart/assets/js/jquery.min.js') }}"></script>
<script src="{{ asset('enduser/thongminhmart/assets/js/owl.carousel.min.js') }}"></script>
<script src="{{ asset('enduser/thongminhmart/assets/js/main.js') }}"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>


@yield('script')
@if (Session::has('success'))
    <script>
        toastr.success('{{ Session::get('success') }}', 'Thành công');
    </script>
@endif
@if (Session::has('error'))
    <script>
        toastr.error('{{ Session::get('error') }}', 'Thất bại');
    </script>
@endif
