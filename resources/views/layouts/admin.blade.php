<!DOCTYPE html>
<html lang="en">
<head>
    @include('admin.components.meta')
</head>
<body>
    @include('admin.components.preloader')

    <div id="main-wrapper">
        @include('admin.components.topbar')
        @include('admin.components.sidebar')
        <div class="page-wrapper">
            @yield('breadcrumb')
            <div class="container-fluid">
                <div class="wrap-content">
                    @yield('content')
                </div>
            </div>
            @include('admin.components.footer')
        </div>
    </div>    
</body>
    @include('admin.components.script')
</html>