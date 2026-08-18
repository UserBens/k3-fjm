<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Memo KIB - {{ $so->badge }}</title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 10px;
            color: #1F3864;
            padding: 20px;
        }

        /* ── Ringkasan (tabel bergaya Excel: header kuning + baris nilai) ── */
        table.ringkasan {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 18px;
        }

        table.ringkasan th {
            background: #F5A623;
            color: #7A4A00;
            font-size: 9px;
            font-weight: bold;
            text-transform: uppercase;
            text-align: center;
            padding: 8px 6px;
            border: 1px solid #D98C00;
        }

        table.ringkasan td {
            background: #FDF3D6;
            color: #1F3864;
            font-size: 11px;
            font-weight: bold;
            text-align: center;
            padding: 10px 6px;
            border: 1px solid #F0DDA0;
        }

        table.ringkasan td.so-cell {
            font-size: 10px;
            color: #1D4ED8;
        }

        table.ringkasan td.kodeok-cell {
            font-size: 8.5px;
            font-weight: normal;
            color: #334155;
            text-align: left;
            padding-left: 10px;
        }

        /* ── Kop surat ── */
        .kop {
            border: 1.5px solid #1A1D2E;
            padding: 10px 14px;
            margin-bottom: 14px;
        }

        table.kop-head {
            width: 100%;
            border-collapse: collapse;
        }

        table.kop-head td {
            vertical-align: middle;
            padding: 0;
        }

        .kop-name-cell {
            padding-left: 10px;
        }

        .kop-logo-cell {
            width: 150px;
            /* <-- Ubah nilainya menjadi lebih besar, misal 150px */
            text-align: left;
        }

        .kop-name {
            font-size: 15px;
            font-weight: bold;
            color: #1A1D2E;
            letter-spacing: 0.3px;
        }

        .kop-tagline {
            font-size: 8px;
            color: #64748B;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .kop-address-cell {
            text-align: right;
            font-size: 8.5px;
            color: #334155;
            line-height: 1.5;
        }

        .kop-address-cell .company {
            font-weight: bold;
            color: #1A1D2E;
        }

        .kop-divider {
            border-top: 1px solid #CBD5E1;
            margin: 8px 0;
        }

        .kop-title {
            text-align: center;
            font-size: 12px;
            font-weight: bold;
            color: #1A1D2E;
            text-transform: uppercase;
            margin-top: 4px;
        }

        .kop-nomor {
            text-align: center;
            font-size: 9.5px;
            color: #334155;
            margin-top: 3px;
        }

        /* ── Tabel data ── */
        table.data {
            width: 100%;
            border-collapse: collapse;
        }

        table.data th {
            background: #F5A623;
            color: #FFFFFF;
            border: 1px solid #D98C00;
            padding: 6px 5px;
            font-size: 8.5px;
            text-transform: uppercase;
            text-align: center;
        }

        table.data td {
            border: 1px solid #F0DDA0;
            padding: 5px;
            font-size: 8.5px;
            color: #1F3864;
            vertical-align: top;
        }

        table.data tr:nth-child(even) td {
            background: #FFFBEA;
        }

        table.data td.center {
            text-align: center;
        }

        .status-aktif {
            color: #166534;
            font-weight: bold;
        }

        .status-expired {
            color: #991B1B;
            font-weight: bold;
        }

        .status-hampir_habis {
            color: #92400E;
            font-weight: bold;
        }

        .status-tidak_ditemukan {
            color: #475569;
            font-weight: bold;
        }

        .footer {
            margin-top: 20px;
            font-size: 9px;
            color: #64748B;
            text-align: right;
        }
    </style>
</head>

<body>

    <!-- ── Ringkasan gaya Excel ── -->
    <table class="ringkasan">
        <thead>
            <tr>
                <th style="width: 20%;">Safety Officer</th>
                <th style="width: 34%;">Kode OK</th>
                <th style="width: 9%;">Jumlah Tenaga</th>
                <th style="width: 9%;">KIB Aktif</th>
                <th style="width: 9%;">KIB Expired</th>
                <th style="width: 10%;">KIB Hampir Habis</th>
                <th style="width: 9%;">KIB Tidak Ditemukan</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="so-cell">{{ $so->badge }}-{{ $so->nama }}</td>
                <td class="kodeok-cell">{{ $ringkasan['kode_ok'] }}</td>
                <td>{{ $ringkasan['jumlah_tenaga'] }}</td>
                <td>{{ $ringkasan['kib_aktif'] }}</td>
                <td>{{ $ringkasan['kib_expired'] }}</td>
                <td>{{ $ringkasan['kib_hampir_habis'] }}</td>
                <td>{{ $ringkasan['kib_tidak_ditemukan'] }}</td>
            </tr>
        </tbody>
    </table>

    <!-- ── Kop surat ── -->
    <!-- ── Kop surat ── -->
    <div class="kop">
        <table class="kop-head">
            <tr>
                <td class="kop-logo-cell">
                    <img src="{{ public_path('storage/logo-h.webp') }}"
                        style="width: 180px; height: auto; display: block;">
                </td>
                <td class="kop-address-cell">
                    <div class="company">PT. FOKUS JASA MITRA</div>
                    <div>Jl. Prof. Muh Yamin SH. PO BOX 122 Gresik</div>
                    <div>Telepon : (031) 3954726 - 3959698 Fax : (031) 3954727</div>
                </td>
            </tr>
        </table>

        <div class="kop-divider"></div>

        <div class="kop-title">
            Daftar Perpanjangan KIB Tenaga PT. Fokus Jasa Mitra Tahun {{ now()->format('Y') }}
        </div>
        <div class="kop-nomor">
            Nomor : {{ $nomor ?? '............' }}/NK.01.01/FJM.01/DR/{{ now()->format('Y') }}
        </div>
    </div>

    <!-- ── Tabel data ── -->
    <table class="data">
        <thead>
            <tr>
                <th style="width: 3%;">No</th>
                <th style="width: 13%;">Nama</th>
                <th style="width: 10%;">KTP</th>
                <th style="width: 16%;">Jalan</th>
                <th style="width: 5%;">RT/RW</th>
                <th style="width: 10%;">Kelurahan/Desa</th>
                <th style="width: 9%;">Kecamatan</th>
                <th style="width: 9%;">Kabupaten/Kota</th>
                <th style="width: 10%;">Jabatan</th>
                <th style="width: 8%;">Zonasi</th>
                {{-- <th style="width: 7%;">Status KIB</th> --}}
            </tr>
        </thead>
        <tbody>
            @forelse ($rows as $row)
                <tr>
                    <td class="center">{{ $row['no'] }}</td>
                    <td>{{ $row['nama'] }}</td>
                    <td>{{ $row['ktp'] }}</td>
                    <td>{{ $row['jalan'] }}</td>
                    <td class="center">{{ $row['rt_rw'] }}</td>
                    <td>{{ $row['kelurahan'] }}</td>
                    <td>{{ $row['kecamatan'] }}</td>
                    <td>{{ $row['kabupaten_kota'] }}</td>
                    <td>{{ $row['jabatan'] }}</td>
                    <td class="center">{{ $row['zonasi'] ?: '-' }}</td>
                    {{-- <td class="center status-{{ $row['status_kib_key'] ?? '' }}">{{ $row['status_kib'] }}</td> --}}
                </tr>
            @empty
                <tr>
                    <td colspan="11" style="text-align:center; color:#94A3B8;">Belum ada tenaga binaan.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="footer">
        Dicetak pada {{ now()->translatedFormat('d F Y, H:i') }} WIB
    </div>

</body>

</html>
