<!DOCTYPE html>
<html lang="en">

@include('karyawan.partials.head')

<body class="index-page">

    @include('karyawan.components.header')

  <main class="main">

    @yield('content')

  </main>

  @include('karyawan.components.footer')

  <!-- Scroll Top -->
  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Preloader -->
  <div id="preloader"></div>

  @include('karyawan.partials.script')

</body>

</html>
