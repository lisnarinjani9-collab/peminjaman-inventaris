@if (session('success'))
<div class="alert-custom alert-custom-success">
    <i class="bi bi-check-circle-fill alert-custom-icon"></i>
    <div class="alert-custom-content">{{ session('success') }}</div>
    <button class="alert-custom-close" type="button" aria-label="Tutup" onclick="this.parentElement.remove();">
        <i class="bi bi-x-lg"></i>
    </button>
</div>
@endif

@if (session('error'))
<div class="alert-custom alert-custom-danger">
    <i class="bi bi-exclamation-triangle-fill alert-custom-icon"></i>
    <div class="alert-custom-content">{{ session('error') }}</div>
    <button class="alert-custom-close" type="button" aria-label="Tutup" onclick="this.parentElement.remove();">
        <i class="bi bi-x-lg"></i>
    </button>
</div>
@endif

@if ($errors->any())
<div class="alert-custom alert-custom-danger">
    <i class="bi bi-exclamation-triangle-fill alert-custom-icon"></i>
    <div class="alert-custom-content">
        @foreach ($errors->all() as $error)
        <div>{{ $error }}</div>
        @endforeach
    </div>
    <button class="alert-custom-close" type="button" aria-label="Tutup" onclick="this.parentElement.remove();">
        <i class="bi bi-x-lg"></i>
    </button>
</div>
@endif
