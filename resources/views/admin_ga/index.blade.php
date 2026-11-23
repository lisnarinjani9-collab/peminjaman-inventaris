<!doctype html>
<html lang="id">

<!-- Head -->
@include('admin_ga.partials.head')

<body>
    <!-- Sidebar -->
    @include('admin_ga.components.sidebar')

    <div class="main-wrapper">
        <!-- Navbar -->
        @include('admin_ga.components.navbar')

        <!-- Alert -->
        @include('admin_ga.components.alert')

        <!-- Isi halaman -->
        @yield('content')

        <!-- Footer -->
        @include('admin_ga.components.footer')
    </div>

    <!-- Script -->
    @include('admin_ga.partials.script')
</body>

</html>
