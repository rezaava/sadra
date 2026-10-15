<!DOCTYPE html>
<html lang="fa" dir="rtl">
@include('admin.layout.head')

<body>
    <div class="admin-wrapper">
    @include('admin.layout.side')
        <!-- Main -->
        <div class="admin-main">
            @include('admin.layout.header')
            <main>
                @yield('main')
            </main>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.3/js/bootstrap.bundle.min.js"></script>
</body>
@yield('js')

</html>