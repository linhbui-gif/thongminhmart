<script src="{{ asset('enduser/composite/js/jquery.min.js') }}"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="{{ asset('enduser/composite/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('enduser/composite/js/bootstrap.bundle.js') }}"></script>
<!-- menumaker js -->
<script src="{{ asset('enduser/composite/js/menumaker.js') }}"></script>
<script src="{{ asset('enduser/composite/js/navigation.js') }}"></script>
<!-- owl.carousel.min.js -->
<script src="{{ asset('enduser/composite/js/owl.carousel.min.js') }}"></script>
<script src="{{ asset('enduser/composite/js/custom-carousel.js') }}"></script>
<!--Magnific-Video-Popup-->
<script src="{{ asset('enduser/composite/js/jquery.magnific-popup.min.js') }}"></script>
<script src="{{ asset('enduser/composite/js/video-zoom.js') }}"></script>
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
