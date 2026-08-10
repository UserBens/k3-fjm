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
            font-size: 11px;
            color: #1A1D2E;
            padding: 24px;
        }

        .header {
            margin-bottom: 16px;
            border-bottom: 2px solid #2D4B9E;
            padding-bottom: 10px;
        }

        .company {
            font-size: 10px;
            color: #64748B;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .title {
            font-size: 20px;
            font-weight: bold;
            color: #1A1D2E;
            margin-top: 2px;
        }

        .so-info {
            font-size: 12px;
            margin-top: 6px;
            color: #334155;
        }

        .summary {
            display: table;
            width: 100%;
            margin: 14px 0;
            border-collapse: collapse;
        }

        .summary-row {
            display: table-row;
        }

        .summary-cell {
            display: table-cell;
            border: 1px solid #E5E7EB;
            padding: 8px;
            text-align: center;
            width: 20%;
        }

        .summary-cell .val {
            font-size: 16px;
            font-weight: bold;
        }

        .summary-cell .lbl {
            font-size: 8px;
            color: #64748B;
            text-transform: uppercase;
            margin-top: 2px;
        }

        table.data {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        table.data th {
            background: #F0F2FA;
            border: 1px solid #CBD5E1;
            padding: 6px 5px;
            font-size: 9px;
            text-transform: uppercase;
            text-align: left;
        }

        table.data td {
            border: 1px solid #E2E8F0;
            padding: 5px;
            font-size: 9.5px;
            vertical-align: top;
        }

        table.data tr:nth-child(even) {
            background: #FAFBFF;
        }

        .footer {
            margin-top: 30px;
            font-size: 9.5px;
            color: #64748B;
            text-align: right;
        }
    </style>
</head>

<body>

    <div class="header">
        <div class="company">Database Safety Officer · PT. Fokus Jasa Mitra</div>
        <div class="title">MEMO KIB</div>
        <div class="so-info">
            Safety Officer: <strong>{{ $so->badge }} - {{ $so->nama }}</strong><br>
            Kode OK: {{ $ringkasan['kode_ok'] }}
        </div>
    </div>

    <div class="summary">
        <div class="summary-row">
            <div class="summary-cell">
                <div class="val">{{ $ringkasan['jumlah_tenaga'] }}</div>
                <div class="lbl">Jumlah Tenaga</div>
            </div>
            <div class="summary-cell">
                <div class="val">{{ $ringkasan['kib_aktif'] }}</div>
                <div class="lbl">KIB Aktif</div>
            </div>
            <div class="summary-cell">
                <div class="val">{{ $ringkasan['kib_expired'] }}</div>
                <div class="lbl">KIB Expired</div>
            </div>
            <div class="summary-cell">
                <div class="val">{{ $ringkasan['kib_hampir_habis'] }}</div>
                <div class="lbl">Hampir Habis</div>
            </div>
            <div class="summary-cell">
                <div class="val">{{ $ringkasan['kib_tidak_ditemukan'] }}</div>
                <div class="lbl">Tidak Ditemukan</div>
            </div>
        </div>
    </div>

    <table class="data">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>No. KTP</th>
                <th>Jalan</th>
                <th>RT/RW</th>
                <th>Kelurahan</th>
                <th>Kecamatan</th>
                <th>Kab/Kota</th>
                <th>Jabatan</th>
                <th>Zonasi</th>
                <th>Status KIB</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($rows as $row)
                <tr>
                    <td>{{ $row['no'] }}</td>
                    <td>{{ $row['nama'] }}</td>
                    <td>{{ $row['ktp'] }}</td>
                    <td>{{ $row['jalan'] }}</td>
                    <td>{{ $row['rt_rw'] }}</td>
                    <td>{{ $row['kelurahan'] }}</td>
                    <td>{{ $row['kecamatan'] }}</td>
                    <td>{{ $row['kabupaten_kota'] }}</td>
                    <td>{{ $row['jabatan'] }}</td>
                    <td>{{ $row['zonasi'] ?: '-' }}</td>
                    <td>{{ $row['status_kib'] }}</td>
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
