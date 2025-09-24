@extends('layouts.pengguna.main')

@section('title')
    {{ $title }}
@endsection

@section('content')
    <section class="py-5">
        <div class="container">
            <!-- Tombol Kembali -->
            <div class="d-flex justify-content-between align-items-center no-print mb-4">
                <a href="{{ route('pengguna.diagnosa.index') }}" class="btn btn-outline-primary">
                    <i class="bi bi-arrow-left"></i> Identifikasi Ulang
                </a>
                <a href="#" class="btn btn-outline-success" onclick="window.print()">
                    <i class="bi bi-printer"></i> Cetak Hasil
                </a>
            </div>

            <h2 class="text-center fw-bold mb-4">Detail Hasil Identifikasi</h2>
            <hr class="mb-5">

            <!-- Identitas Pengguna -->
            <div class="mb-5">
                <h4 class="fw-semibold mb-3">🧑 Identitas Pengguna</h4>
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-black-border">
                        <tr>
                            <th class="w-25">Nama</th>
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
                </div>
            </div>

            <!-- Pilihan Jawaban -->
            <div class="mb-5">
                <h4 class="fw-semibold mb-3">📝 Pilihan Pengguna</h4>
                <div class="table-responsive">
                    <table class="table table-bordered table-hover table-striped table-black-border">
                        <thead class="table-dark">
                            <tr>
                                <th class="text-white">No</th>
                                <th class="text-white">Pernyataan Kecenderungan Perilaku Judi Online</th>
                                <th class="text-white">Jawaban</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($kondisi as $gejalaId => $kondisiItem)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ optional($gejalas->where('id', $gejalaId)->first())->nama }}</td>
                                    <td>{{ $kondisiItem['label'] }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Hasil Analisa -->
            <div class="row bg-light rounded p-4 mb-5 border">
                <div class="col-md-6">
                    <h4 class="fw-semibold mb-3">📊 Hasil Identifikasi</h4>
                    <p>Berdasarkan jawaban yang dipilih, tingkat kecenderungan Anda adalah:</p>
                    <p class="fs-5 text-success">
                        <i class="bi bi-graph-up-arrow"></i>
                        Presentase:
                        <strong>{{ number_format($diagnosa->presentase, 2) }}%</strong>
                    </p>
                    <p class="fs-5 text-success">
                        <i class="bi bi-activity"></i>
                        Tingkat Kecenderungan:
                        <strong>{{ $diagnosa->tingkat_kecenderungan }}</strong>
                    </p>
                </div>
            </div>

            <!-- Deskripsi dan Solusi -->
            <div class="row">
                <div class="col-md-6 mb-4">
                    <div class="card shadow-sm h-100">
                        <div class="card-body">
                            <h4 class="fw-semibold mb-3">📝 Deskripsi</h4>
                            <p>{{ $diagnosa->deskripsi ?? 'Tidak ada deskripsi terkait.' }}</p>
                        </div>
                    </div>
                </div>
                @if (Auth::check() && Auth::user()->role === 'psikologi')
                    <div class="col-md-6">
                        <div class="card shadow-sm h-100">
                            <div class="card-body">
                                <h4 class="fw-semibold mb-3">💡 Solusi</h4>
                                <p>{{ $diagnosa->solusi ?? 'Tidak ada solusi terkait.' }}</p>
                            </div>
                        </div>
                    </div>
                @endif
            </div>

        </div>
    </section>

    <style>
        /* Hanya berlaku saat proses print */
        @media print {
            body {
                font-size: 12px;
                line-height: 1.5;
                padding: 0;
                margin: 0;
            }

            .container {
                width: 100%;
                max-width: 100%;
                padding: 0;
                margin: 0;
            }

            /* Menyembunyikan elemen yang tidak perlu saat print */
            .no-print {
                display: none;
            }

            /* Menyesuaikan margin agar bisa masuk dalam 1 halaman */
            section {
                margin: 0;
                padding: 0;
                width: 100%;
                page-break-before: always;
            }

            .table-bordered,
            .table-striped,
            .table-hover {
                border: 1px solid black !important;
            }

            /* Menyesuaikan ukuran tabel agar muat di 1 halaman */
            table {
                width: 100%;
                page-break-inside: auto;
            }

            th,
            td {
                padding: 4px 10px;
            }
        }
    </style>
@endsection
