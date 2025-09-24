<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>{{ $title }}</title>
    <style>
        body {
            font-family: 'Times New Roman', Times, serif;
            font-size: 12px;
            margin: 20px;
            color: #000;
        }

        h2,
        h4 {
            text-align: center;
            margin: 0;
        }

        h2 {
            font-size: 18px;
            margin-bottom: 5px;
        }

        h4 {
            font-size: 14px;
            margin-bottom: 20px;
        }

        .title {
            font-size: 18px;
            font-weight: bold;
            text-align: center;
            margin-top: 20px;
            color: #333;
            padding: 10px;
            background-color: #f1f1f1;
            border: 2px solid #ccc;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .section-title {
            font-size: 14px;
            font-weight: bold;
            margin-top: 20px;
            margin-bottom: 10px;
            color: #2a5d84;
            border-bottom: 2px solid #2a5d84;
            padding-bottom: 5px;
        }

        table {
            border-collapse: collapse;
            width: 100%;
            margin-top: 5px;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
            vertical-align: top;
        }

        th {
            background-color: #f5f5f5;
            font-weight: bold;
        }

        tbody tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tbody tr:hover {
            background-color: #f0f0f0;
        }

        .row {
            display: flex;
            gap: 20px;
            margin-top: 15px;
        }

        .col {
            flex: 1;
        }

        .box {
            border: 1px solid #ddd;
            padding: 10px;
            /* Reduced padding to make the box smaller */
            min-height: 80px;
            /* Reduced minimum height */
            background-color: #f9f9f9;
            box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.1);
            font-size: 12px;
            /* Reduced font size */
        }

        p {
            margin: 0;
            text-align: justify;
        }

        .page-break {
            page-break-before: always;
        }

        /* Print-specific styles */
        @media print {
            body {
                font-size: 10px;
                margin: 10px;
            }

            .title,
            .section-title {
                text-align: left;
            }

            .row {
                flex-direction: column;
            }

            table {
                width: 100%;
                font-size: 10px;
                margin-bottom: 15px;
            }

            th,
            td {
                padding: 6px;
            }

            .page-break {
                page-break-before: always;
            }

            /* Adjust spacing to ensure content fits in print layout */
            .section-title,
            table,
            .box {
                page-break-inside: avoid;
            }

            /* Make sure each page has a clear header */
            .title {
                page-break-before: always;
            }

            h3 {
                font-size: 12px;
            }
        }
    </style>
</head>

<body>

    <div class="title">
        {{ $title }}
    </div>

    <h3 style="text-align: center; font-size: 14px; font-weight: normal; color: #555; margin-top: 5px;">
        <span style="font-weight: bold;">Periode:</span> {{ $tanggal }}
    </h3>

    {{-- Identitas Pengguna --}}
    <div class="section-title">Biodata</div>
    <table>
        <tr>
            <th style="width: 25%;">Nama</th>
            <td>{{ $diagnosa->nama }}</td>
        </tr>
        <tr>
            <th>No HP</th>
            <td>{{ $diagnosa->no_hp }}</td>
        </tr>
        <tr>
            <th>Alamat</th>
            <td>{{ $diagnosa->alamat }}</td>
        </tr>
        <tr>
            <th>Pakar yang menangani</th>
            <td>{{ $diagnosa->pakar ?? 'Tidak Diketahui' }}</td>
        </tr>
    </table>

    {{-- Jawaban Pengguna --}}
    <div class="section-title">Pilihan Pengguna</div>
    <table>
        <thead>
            <tr>
                <th style="width: 5%;">No</th>
                <th style="width: 60%;">Pernyataan</th>
                <th style="width: 35%;">Jawaban</th>
            </tr>
        </thead>
        <tbody>
            @foreach (json_decode($diagnosa->kondisi, true) as $gejalaId => $kondisiItem)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ optional($gejala->where('id', $gejalaId)->first())->nama }}</td>
                    <td>{{ $kondisiItem['label'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{-- Hasil Identifikasi --}}
    <div class="section-title">Hasil Identifikasi</div>
    <table>
        <tr>
            <th style="width: 40%;">Presentase</th>
            <td>{{ number_format($diagnosa->presentase, 2) }}%</td>
        </tr>
        <tr>
            <th>Tingkat Kecenderungan</th>
            <td>{{ $diagnosa->tingkat_kecenderungan }}</td>
        </tr>
    </table>

    {{-- Deskripsi dan Solusi --}}
    <div class="section-title">Analisa</div>
    <div class="row">
        <div class="col">
            <div class="box">
                <h4>Deskripsi</h4>
                <p>{{ $diagnosa->deskripsi ?? 'Tidak ada deskripsi.' }}</p>
            </div>
        </div>
        <div class="col">
            <div class="box">
                <h4>Solusi</h4>
                <p>{{ $diagnosa->solusi ?? 'Belum ada solusi.' }}</p>
            </div>
        </div>
    </div>

    <div class="page-break"></div> {{-- To ensure each diagnosis starts on a new page --}}

</body>

</html>
