@extends('layouts.pengguna.main')

@section('content')
    <section class="inn py-5">
        <div class="container">
            <!-- Tombol Cetak dan Reset -->
            <div class="d-flex justify-content-between align-items-center no-print mb-4">
                <button type="button" class="btn btn-primary" onclick="window.print()">
                    <i class="bi bi-printer"></i> Cetak Hasil Identifikasi
                </button>
                <button type="button" class="btn btn-secondary"
                    onclick="window.location.href='{{ route('pengguna.diagnosa.reset') }}'">
                    <i class="bi bi-arrow-left"></i> Kembali
                </button>
            </div>

            <h2 class="text-center fw-bold mb-4">Hasil Identifikasi</h2>
            <hr class="mb-5">

            <!-- Bagian Identitas -->
            <div class="identitas mb-5">
                <h3 class="fw-semibold mb-3">Identitas Pengguna</h3>
                @if ($biodata)
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th class="w-25">Nama</th>
                            <td>{{ $biodata['nama'] }}</td>
                        </tr>
                        <tr>
                            <th>No HP</th>
                            <td>{{ $biodata['no_hp'] }}</td>
                        </tr>
                        <tr>
                            <th>Alamat</th>
                            <td>{{ $biodata['alamat'] }}</td>
                        </tr>
                    </table>
                @else
                    <p class="text-danger">Data identitas tidak tersedia.</p>
                @endif
            </div>

            <!-- Pilihan Jawaban -->
            <div class="pilihan mb-5">
                <h3 class="fw-semibold mb-3">Pilihan Pengguna</h3>
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead class="table-dark">
                            <tr>
                                <th>No</th>
                                <th>Pernyataan Kecenderungan Perilaku Judi Online</th>
                                <th>Jawaban</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($gejalas as $gejala)
                                @foreach ($kepastian as $key => $kp)
                                    @if ($gejala->id == $key)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $gejala->nama }}</td>
                                            <td>{{ $kp['label'] }}</td>
                                        </tr>
                                    @endif
                                @endforeach
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Hasil Analisa -->
            <div class="row bg-light rounded p-4 mb-5">
                <div class="col-md-6 mb-4 mb-md-0">
                    <h3 class="fw-semibold mb-3">Hasil Identifikasi</h3>
                    <p>Berdasarkan jawaban pernyataan yang dipilih, tingkat kecenderungan Anda adalah:</p>
                    <p class="fs-5 text-success">Presentase: <strong>{{ number_format($highestCf * 100,2 )}}%</strong></p>
                    <p class="fs-5 text-success">Tingkat Kecenderungan: <strong>{{ $tingkatKecenderungan }}</strong></p>
                </div>
            </div>

            <!-- Deskripsi dan Solusi -->
            <div class="mb-5">
                <div class="card shadow-sm mb-4">
                    <div class="card-body">
                        <h3 class="fw-semibold mb-3">Deskripsi</h3>
                        <p>{{ $penyakit ? $penyakit->deskripsi : 'Tidak ada deskripsi terkait.' }}</p>
                    </div>
                </div>

                <div class="card shadow-sm">
                    <div class="card-body">
                        <h3 class="fw-semibold mb-3">Solusi</h3>
                        <p>{{ $penyakit ? $penyakit->solusi : 'Tidak ada solusi terkait.' }}</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
