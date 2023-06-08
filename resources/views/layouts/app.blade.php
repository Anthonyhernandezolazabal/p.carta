<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    @include('layouts.sections.head')
    <body class="hold-transition sidebar-mini layout-fixed ">
        <div class="wrapper" id="app">
            <div class="preloader flex-column justify-content-center align-items-center">
              <img class="animation__shake" src="img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
            </div>
            @yield('content')
        </div>
        @include('layouts.sections.script')
    </body>
</html>
