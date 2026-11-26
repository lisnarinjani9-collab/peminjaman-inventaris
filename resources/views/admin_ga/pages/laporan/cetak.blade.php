<!doctype html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Laporan - Peminjaman Inventaris</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 13px;
            color: #000;
            margin: 0;
            padding: 32px 40px;
        }

        .tombol {
            text-align: center;
            margin-bottom: 24px;
        }

        .tombol a,
        .tombol button {
            display: inline-block;
            padding: 12px 24px;
            margin: 0 4px;
            border: 1px solid #333;
            border-radius: 4px;
            background: #f3f3f3;
            color: #000;
            font-size: 15px;
            text-decoration: none;
            cursor: pointer;
        }

        .tombol a {
            background: #fff;
        }

        .kop {
            text-align: center;
            padding-bottom: 14px;
            border-bottom: 2px solid #000;
        }

        .kop h1 {
            margin: 0 0 4px;
            font-size: 22px;
        }

        .kop p {
            margin: 0;
        }

        .judul {
            text-align: center;
            margin: 24px 0 20px;
        }

        .judul h2 {
            margin: 0 0 6px;
            font-size: 17px;
            text-decoration: underline;
        }

        .judul p {
            margin: 0;
            color: #333;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 8px 10px;
            text-align: left;
            vertical-align: top;
        }

        th {
            background: #e9e9e9;
            text-align: center;
        }

        .ringkasan {
            margin-bottom: 22px;
        }

        .ringkasan td:nth-child(odd) {
            font-weight: bold;
        }

        .tengah {
            text-align: center;
        }

        .ttd {
            width: 240px;
            margin: 36px 0 0 auto;
            text-align: center;
        }

        .ttd .ruang {
            height: 70px;
        }

        @page {
            size: A4 landscape;
            margin: 12mm;
        }

        @media print {
            .tombol {
                display: none;
            }

            body {
                padding: 0;
            }
        }
    </style>
</head>

<body>
    <div class="tombol">
        <a href="{{ route('admin.laporan') }}">&larr; Kembali ke Laporan</a>
        <button type="button" onclick="window.print()">Cetak / Simpan sebagai PDF</button>
    </div>

    <div class="kop">
        <h1>PEMINJAMAN INVENTARIS</h1>
        <p>Sistem Peminjaman Inventaris Sarana dan Prasarana Perusahaan</p>
    </div>

    <div class="judul">
        <h2>LAPORAN REKAPITULASI PEMINJAMAN ASET</h2>
        <p>Dicetak pada: {{ $tanggalCetak }}</p>
    </div>

    <table class="ringkasan">
        <tr>
            <td>Total Peminjaman</td>
            <td>{{ $total }} Pengajuan</td>
            <td>Sedang Dipinjam</td>
            <td>{{ $dipinjam }} Pengajuan</td>
            <td>Dikembalikan</td>
            <td>{{ $dikembalikan }} Pengajuan</td>
            <td>Ditolak</td>
            <td>{{ $ditolak }} Pengajuan</td>
        </tr>
    </table>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Karyawan</th>
                <th>Divisi</th>
                <th>Aset yang Dipinjam</th>
                <th>Tgl Pinjam</th>
                <th>Tgl Kembali</th>
                <th>Status</th>
                <th>Kondisi Kembali</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($laporan as $item)
            <tr>
                <td class="tengah">{{ $loop->iteration }}</td>
                <td>{{ $item->karyawan->nama }}</td>
                <td>{{ $item->karyawan->divisi }}</td>
                <td>
                    @foreach ($item->details as $detail)
                    <div>{{ $detail->asset->nama }} ({{ $detail->jumlah }})</div>
                    @endforeach
                </td>
                <td class="tengah">{{ $item->tanggal_pinjam->format('d-m-Y') }}</td>
                <td class="tengah">{{ $item->tanggal_kembali->format('d-m-Y') }}</td>
                <td class="tengah">
                    @if ($item->status == 'pending')
                    Menunggu
                    @else
                    {{ ucfirst($item->status) }}
                    @endif
                </td>
                <td class="tengah">
                    @if ($item->returnLog)
                        @if ($item->returnLog->kondisi_kembali == 'baik')
                        Baik
                        @elseif ($item->returnLog->kondisi_kembali == 'rusak_ringan')
                        Rusak Ringan
                        @else
                        Rusak Berat
                        @endif
                    @else
                    -
                    @endif
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="8" class="tengah">Tidak ada data peminjaman</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <div class="ttd">
        <div>Mengetahui,</div>
        <div>Admin GA</div>
        <div class="ruang"></div>
        <div><strong>{{ auth()->user()->nama }}</strong></div>
    </div>
</body>

</html>
