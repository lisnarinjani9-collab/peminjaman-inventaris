    <script src="{{ asset('asset/bootstrap-5.3.8-dist/js/bootstrap.bundle.js') }}"></script>
    <script>
        // tombol mata: tampilkan atau sembunyikan password
        const toggle = document.getElementById('togglePassword');
        const input = document.getElementById('password');

        toggle.addEventListener('click', function () {
            const show = input.type === 'password';
            input.type = show ? 'text' : 'password';
            this.querySelector('i').className = show ? 'bi bi-eye-slash' : 'bi bi-eye';
        });
    </script>
