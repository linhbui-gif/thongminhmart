<script src="{{ asset('enduser/thongminhmart/assets/js/jquery.min.js') }}"></script>
<script src="{{ asset('enduser/thongminhmart/assets/js/owl.carousel.min.js') }}"></script>
<script src="{{ asset('enduser/thongminhmart/assets/js/main.js') }}"></script>

{{--<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>--}}
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
