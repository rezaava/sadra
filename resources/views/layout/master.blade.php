<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    @include('includes.head')
    @yield('head')
</head>
<body>
    @hasSection('no_chrome')
    @else
        @include('includes.nav')
    @endif

    @yield('main')

    @hasSection('no_chrome')
    @else
        @include('includes.footer')
    @endif

    @yield('js')
</body>
</html>
