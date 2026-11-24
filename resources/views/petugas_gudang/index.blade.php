<!doctype html>
<html lang="id">

<!-- Head -->
@include('petugas_gudang.partials.head')

<body>
    <!-- Sidebar -->
    @include('petugas_gudang.components.sidebar')

    <div class="main-wrapper">
        <!-- Navbar -->
        @include('petugas_gudang.components.navbar')

        <!-- Alert -->
        @include('petugas_gudang.components.alert')

        <!-- Isi halaman -->
        @yield('content')

        <!-- Footer -->
        @include('petugas_gudang.components.footer')
    </div>

    <!-- Script -->
    @include('petugas_gudang.partials.script')
</body>

</html>
