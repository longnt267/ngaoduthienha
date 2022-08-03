<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<!-- Tell the browser to be responsive to screen width -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="">
<meta name="author" content="">
<meta name="csrf-token" content="{{ csrf_token() }}">
<!-- Favicon icon -->
<link rel="icon" type="image/png" sizes="16x16" href="{{ asset('xtreme/assets/images/favicon.png') }}">
<title>@yield('title')</title>
<!--c3 CSS -->
<link href="{{ asset('xtreme/assets/extra-libs/c3/c3.min.css') }}" rel="stylesheet">
<!-- Custom CSS -->
<link rel="stylesheet" type="text/css" href="{{ asset('xtreme/assets/libs/select2/dist/css/select2.min.css') }}">
<link href="{{ asset('xtreme/dist/css/style.min.css') }}" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('xtreme/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.css') }}">
<link rel="stylesheet" href="{{ asset('vendor/font-awesome/css/all.css') }}">
<link rel="stylesheet" href="{{ asset('xtreme/dist/css/custom.css') }}">
<link rel="stylesheet" href="{{ asset('vendor/sweet-alert/sweetalert2.min.css') }}">
<link rel="stylesheet" href="{{ asset('vendor/pannellum/pannellum.css') }}">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
{{--  <script src="{{ asset('vendor/ckeditor/ckeditor.js') }}"></script>  --}}
<script src="{{ asset('xtreme/assets/libs/ckeditor/ckeditor.js') }}"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/toastr@2.1.4/build/toastr.css">