<!doctype html>
<html lang="id">

<!-- Head -->
@include('admin_ga.partials.head')

<body>
    <div class="d-flex">
        <!-- Sidebar -->
        @include('admin_ga.components.sidebar')

        <div class="main">
            <!-- Navbar -->
            @include('admin_ga.components.navbar')

            <div class="content">
                <!-- Alert -->
                @include('admin_ga.components.alert')

                <!-- Isi halaman -->
                @yield('content')
            </div>

            <!-- Footer -->
            @include('admin_ga.components.footer')
        </div>
    </div>

    <!-- Script -->
    @include('admin_ga.partials.script')
</body>

</html>
