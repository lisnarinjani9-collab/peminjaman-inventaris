<script src="{{ asset('asset/bootstrap-5.3.8-dist/js/bootstrap.bundle.js') }}"></script>
<script>
    // tombol menu: buka dan tutup sidebar di layar kecil
    const sidebar = document.getElementById('sidebar');

    document.querySelectorAll('[data-toggle-sidebar]').forEach(function (btn) {
        btn.addEventListener('click', function () {
            sidebar.classList.toggle('show');
        });
    });
</script>
