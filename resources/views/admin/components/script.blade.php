<script src="{{ asset('xtreme/assets/libs/jquery/dist/jquery.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
{{-- Yara DataTables --}}
<script src="{{ asset('xtreme/assets/extra-libs/DataTables/datatables.min.js') }}"></script>
<script src="{{ asset('xtreme/dist/js/pages/datatable/datatable-basic.init.js') }}"></script>
<!-- Bootstrap tether Core JavaScript -->
<script src="{{ asset('xtreme/assets/libs/popper.js/dist/umd/popper.min.js') }}"></script>
<script src="{{ asset('xtreme/assets/libs/bootstrap/dist/js/bootstrap.min.js') }}"></script>
<!-- apps -->
<script src="{{ asset('xtreme/dist/js/app.min.js') }}"></script>
<script src="{{ asset('xtreme/dist/js/app.init.js') }}"></script>
<script src="{{ asset('xtreme/dist/js/app-style-switcher.js') }}"></script>
<!-- slimscrollbar scrollbar JavaScript -->
<script src="{{ asset('xtreme/assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js') }}"></script>
<script src="{{ asset('xtreme/assets/extra-libs/sparkline/sparkline.js') }}"></script>
<!--Wave Effects -->
<script src="{{ asset('xtreme/dist/js/waves.js') }}"></script>
<!--Menu sidebar -->
<script src="{{ asset('xtreme/dist/js/sidebarmenu.js') }}"></script>
<!--Custom JavaScript -->
<script src="{{ asset('xtreme/dist/js/custom.js') }}"></script>
<script src="{{ asset('xtreme/assets/extra-libs/c3/d3.min.js') }}"></script>
<script src="{{ asset('xtreme/assets/extra-libs/c3/c3.min.js') }}"></script>
<script src="{{ asset('xtreme/dist/js/pages/dashboards/dashboard8.js') }}"></script>
<script src="{{ asset('vendor/sweet-alert/sweetalert2.min.js') }}"></script>
<script src="{{ asset('vendor/pannellum/pannellum.js') }}"></script>
<script src="{{ asset('xtreme/assets/libs/select2/dist/js/select2.min.js') }}"></script>
<script src="{{ asset('xtreme/dist/js/pages/forms/select2/select2.init.js') }}"></script>
<script src="{{ asset('xtreme/assets/libs/echarts/dist/echarts-en.min.js') }}"></script>
<script src="{{ asset('xtreme/dist/js/pages/echarts/pie-doughnut/pie-doghnut.js') }}"></script>
<script src="{{ asset('js/config.js') }}"></script>
<script src="{{ asset('js/function.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/toastr@2.1.4/build/toastr.min.js"></script>
<script>
    @if (Session::has('message'))
        toastr.success('{{ session('message') }}');
    @endif

    @if (Session::has('error'))
        toastr.error('{{ session('error') }}');
    @endif
</script>
<script>
    $.ajaxSetup({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>
@yield('script')
