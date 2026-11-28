@extends('karyawan.index')

@section('title', 'Ajukan Peminjaman')

@section('content')

    <!-- Judul halaman -->
    <section class="section dark-background" style="padding: 110px 0 40px;">
      <div class="container">
        <h1 style="font-size: 32px; font-weight: 700;">Ajukan Peminjaman</h1>
        <p class="mb-0">Isi tanggal pinjam dan kembali, lalu pilih aset yang ingin dipinjam. Satu pengajuan boleh berisi lebih dari satu aset.</p>
      </div>
    </section>

    <section class="section light-background">
      <div class="container">

        @include('karyawan.components.alert')

        <div class="row justify-content-center">
          <div class="col-lg-9">
            <div class="card border-0 shadow-sm p-4" style="border-radius: 16px;">

              <form action="{{ route('karyawan.peminjaman.store') }}" method="post">
                @csrf

                <div class="row g-3 mb-4">
                  <div class="col-md-6">
                    <label for="tanggal_pinjam" class="form-label fw-semibold">Tanggal Pinjam</label>
                    <input type="date" class="form-control" name="tanggal_pinjam" id="tanggal_pinjam"
                      value="{{ old('tanggal_pinjam') }}" min="{{ date('Y-m-d') }}" required>
                  </div>
                  <div class="col-md-6">
                    <label for="tanggal_kembali" class="form-label fw-semibold">Tanggal Kembali</label>
                    <input type="date" class="form-control" name="tanggal_kembali" id="tanggal_kembali"
                      value="{{ old('tanggal_kembali') }}" min="{{ date('Y-m-d') }}" required>
                  </div>
                </div>

                <h5 class="mb-1">Aset yang Dipinjam</h5>
                <p class="text-muted">Pilih aset dan jumlahnya. Klik Tambah Aset untuk meminjam lebih dari satu.</p>

                @php
                  // kalau datang dari katalog, aset yang diklik sudah terpilih
                  $barisAset = old('aset_id', [request('aset')]);
                  $barisJumlah = old('jumlah', [1]);
                @endphp

                <div id="daftar-baris">
                  @foreach ($barisAset as $i => $dipilih)
                  <div class="baris-aset">
                    <img class="foto-aset" alt="">

                    <div class="kolom-aset">
                      <label class="form-label fw-semibold">Aset</label>
                      <select name="aset_id[]" class="form-select pilih-aset" required>
                        <option value="">Pilih aset</option>
                        @foreach ($aset as $item)
                        <option value="{{ $item->id }}"
                          data-stok="{{ $item->stok_tersedia }}"
                          data-tinggi="{{ $item->bernilai_tinggi }}"
                          data-gambar="{{ $item->gambar ? asset('storage/' . $item->gambar) : '' }}"
                          {{ $dipilih == $item->id ? 'selected' : '' }}>
                          {{ $item->nama }} (stok {{ $item->stok_tersedia }})
                        </option>
                        @endforeach
                      </select>
                      <small class="text-muted info-aset d-block mt-1"></small>
                    </div>

                    <div class="kolom-jumlah">
                      <label class="form-label fw-semibold">Jumlah</label>
                      <input type="number" name="jumlah[]" class="form-control jumlah" min="1"
                        value="{{ $barisJumlah[$i] ?? 1 }}" required>
                    </div>

                    <button type="button" class="btn btn-outline-danger hapus-baris" title="Hapus aset ini"><i class="bi bi-trash"></i></button>
                  </div>
                  @endforeach
                </div>

                <button type="button" id="tambah-baris" class="btn btn-outline-primary btn-sm rounded-pill"><i class="bi bi-plus-lg"></i> Tambah Aset</button>

                <div class="d-flex justify-content-end gap-2 mt-4 pt-4 border-top">
                  <a href="{{ route('karyawan.katalog') }}" class="btn btn-light rounded-pill px-4">Batal</a>
                  <button type="submit" class="btn btn-primary rounded-pill px-4">Kirim Pengajuan</button>
                </div>
              </form>

            </div>
          </div>
        </div>

      </div>
    </section>

    <style>
      /* satu baris aset: foto | aset | jumlah | hapus, semua rata atas */
      .baris-aset {
        display: grid;
        grid-template-columns: 64px 1fr 110px 40px;
        gap: 16px;
        align-items: start;
        padding: 16px;
        margin-bottom: 12px;
        border: 1px solid #e6dccd;
        border-radius: 12px;
        background: #fbf8f3;
      }

      /* foto dan tombol hapus diturunkan setinggi label supaya sejajar dengan kolom isian */
      .foto-aset {
        width: 64px;
        height: 64px;
        object-fit: cover;
        border-radius: 10px;
        background: #f3ece1;
        margin-top: 30px;
      }

      .hapus-baris {
        margin-top: 30px;
        height: 38px;
        padding: 0;
      }

      .baris-aset .form-label {
        font-size: 14px;
        margin-bottom: 4px;
      }

      /* layar kecil: foto + aset di atas, jumlah + hapus di bawah */
      @media (max-width: 575px) {
        .baris-aset {
          grid-template-columns: 56px 1fr;
        }
        .foto-aset {
          width: 56px;
          height: 56px;
        }
        .kolom-jumlah {
          grid-column: 1 / 2;
        }
        .hapus-baris {
          grid-column: 2 / 3;
          justify-self: end;
          width: 40px;
        }
      }
    </style>

    <script>
      const daftar = document.getElementById('daftar-baris');
      const tombolTambah = document.getElementById('tambah-baris');
      const tglPinjam = document.getElementById('tanggal_pinjam');
      const tglKembali = document.getElementById('tanggal_kembali');

      // tanggal kembali tidak boleh sebelum tanggal pinjam
      function aturTanggal() {
        if (tglPinjam.value) {
          tglKembali.min = tglPinjam.value;
          if (tglKembali.value && tglKembali.value < tglPinjam.value) {
            tglKembali.value = tglPinjam.value;
          }
        }
      }
      tglPinjam.addEventListener('change', aturTanggal);
      aturTanggal();

      // perbarui satu baris: foto, info stok, dan batas jumlah
      function perbaruiBaris(baris) {
        const pilih = baris.querySelector('.pilih-aset');
        const foto = baris.querySelector('.foto-aset');
        const info = baris.querySelector('.info-aset');
        const jumlah = baris.querySelector('.jumlah');
        const opsi = pilih.options[pilih.selectedIndex];

        if (!pilih.value) {
          foto.removeAttribute('src');
          info.textContent = '';
          jumlah.removeAttribute('max');
          return;
        }

        const stok = opsi.dataset.stok;
        if (opsi.dataset.gambar) {
          foto.src = opsi.dataset.gambar;
        } else {
          foto.removeAttribute('src');
        }

        jumlah.max = stok;
        if (Number(jumlah.value) > Number(stok)) {
          jumlah.value = stok;
        }

        let teks = 'Stok tersedia: ' + stok;
        if (opsi.dataset.tinggi === '1') {
          teks += ' | Aset bernilai tinggi, perlu persetujuan Admin GA';
        }
        info.textContent = teks;
      }

      // aset yang sudah dipilih di baris lain tidak bisa dipilih lagi
      function sinkronOpsi() {
        const dipilih = [];
        daftar.querySelectorAll('.pilih-aset').forEach(function (pilih) {
          if (pilih.value) {
            dipilih.push(pilih.value);
          }
        });

        daftar.querySelectorAll('.pilih-aset').forEach(function (pilih) {
          pilih.querySelectorAll('option').forEach(function (opsi) {
            opsi.disabled = opsi.value !== '' && opsi.value !== pilih.value && dipilih.includes(opsi.value);
          });
        });
      }

      // tombol hapus disembunyikan kalau tinggal satu baris
      function aturTombolHapus() {
        const semua = daftar.querySelectorAll('.baris-aset');
        semua.forEach(function (baris) {
          baris.querySelector('.hapus-baris').style.display = semua.length > 1 ? '' : 'none';
        });
      }

      daftar.addEventListener('change', function (e) {
        if (e.target.classList.contains('pilih-aset')) {
          perbaruiBaris(e.target.closest('.baris-aset'));
          sinkronOpsi();
        }
      });

      daftar.addEventListener('click', function (e) {
        const tombol = e.target.closest('.hapus-baris');
        if (tombol) {
          tombol.closest('.baris-aset').remove();
          sinkronOpsi();
          aturTombolHapus();
        }
      });

      tombolTambah.addEventListener('click', function () {
        // salin baris pertama lalu kosongkan isinya
        const baru = daftar.querySelector('.baris-aset').cloneNode(true);
        baru.querySelector('.pilih-aset').value = '';
        baru.querySelector('.jumlah').value = 1;
        daftar.appendChild(baru);
        perbaruiBaris(baru);
        sinkronOpsi();
        aturTombolHapus();
      });

      // keadaan awal halaman
      daftar.querySelectorAll('.baris-aset').forEach(perbaruiBaris);
      sinkronOpsi();
      aturTombolHapus();
    </script>

@endsection
