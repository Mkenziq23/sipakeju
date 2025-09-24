@extends('layouts.pengguna.main')

@section('title')
    Hasil Identifikasi
@endsection

{{-- <style>
    .table-black-border,
    .table-black-border th,
    .table-black-border td {
        border: 1px solid black !important;
    }
</style> --}}

@section('content')
    <section class="py-5">
        <div class="container">

            <!-- Tombol Cetak dan Kembali -->
            <div class="d-flex justify-content-between align-items-center no-print mb-4">
                @auth
                    @if (Auth::user()->role === 'psikolog')
                        <button type="button" class="btn btn-outline-primary" onclick="window.print()">
                            <i class="bi bi-printer"></i> Cetak Hasil
                        </button>
                    @endif
                @endauth
                <a href="{{ route('pengguna.diagnosa.reset') }}" class="btn btn-outline-secondary">
                    <i class="bi bi-arrow-left"></i> Reset
                </a>
            </div>

            <h2 class="text-center fw-bold mb-4">Hasil Identifikasi</h2>
            <hr class="mb-5">

            <!-- Identitas Pengguna -->
            <div class="mb-5">
                <h4 class="fw-semibold mb-3">🧑 Identitas Pengguna</h4>
                <div class="table-responsive">
                    @if ($biodata)
                        <table class="table table-bordered table-striped table-black-border">
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
                            @auth
                                <tr>
                                    <th>Pakar yang menangani</th>
                                    <td>
                                        @if (Auth::user()->role === 'psikologi')
                                            {{ Auth::user()->name ?? 'Tidak Diketahui' }}
                                        @elseif(auth()->user()->role === 'client' || auth()->user()->role === 'admin')
                                            Panca Kursistin Handayani, S.Psi., MA
                                        @else
                                            Tidak Diketahui
                                        @endif

                                    </td>
                                </tr>
                            @endauth
                        </table>
                    @else
                        <p class="text-danger">Data identitas tidak tersedia.</p>
                    @endif
                </div>
            </div>

            <!-- Pilihan Pengguna -->
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
                            @php $no = 1; @endphp
                            @foreach ($gejalas as $gejala)
                                @foreach ($kepastian as $key => $kp)
                                    @if ($gejala->id == $key)
                                        <tr>
                                            <td>{{ $no++ }}</td>
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

            <!-- Hasil Identifikasi -->
            <div class="row bg-light rounded p-4 mb-5 border">
                <div class="col-md-6">
                    <h4 class="fw-semibold mb-3">📊 Hasil Identifikasi</h4>
                    <p>Berdasarkan jawaban yang dipilih, tingkat kecenderungan Anda adalah:</p>
                    <p class="fs-5 text-success">
                        <i class="bi bi-graph-up-arrow"></i>
                        Presentase:
                        <strong>{{ number_format($highestCf * 100, 2) }}%</strong>
                    </p>
                    <p class="fs-5 text-success">
                        <i class="bi bi-activity"></i>
                        Tingkat Kecenderungan:
                        <strong>{{ $tingkatKecenderungan }}</strong>
                    </p>
                </div>
            </div>

            <!-- Deskripsi dan Solusi -->
            <div class="row">
                <div class="col-md-6 mb-4">
                    <div class="card shadow-sm h-100">
                        <div class="card-body">
                            <h4 class="fw-semibold mb-3">📝 Deskripsi</h4>
                            <p>{{ $penyakit ? $penyakit->deskripsi : 'Tidak ada deskripsi terkait.' }}</p>
                        </div>
                    </div>
                </div>

                @if (Auth::check() && Auth::user()->role === 'psikologi')
                    <div class="col-md-6">
                        <div class="card shadow-sm h-100">
                            <div class="card-body">
                                <h4 class="fw-semibold mb-3">💡 Solusi</h4>
                                <form action="{{ route('pengguna.diagnosa.updateSolusi') }}" method="POST">
                                    @csrf
                                    @method('PUT')

                                    <!-- Tambahkan ini -->
                                    <input type="hidden" name="diagnosa_id" value="{{ $diagnosa->id }}">

                                    <textarea name="solusi" class="form-control" style="height: 200px;" placeholder="Masukkan solusi di sini...">{{ old('solusi', $diagnosa->solusi ?? '') }}</textarea>

                                    <button type="submit" class="btn btn-success mt-3">
                                        <i class="bi bi-save"></i> Simpan Solusi
                                    </button>
                                </form>

                            </div>
                        </div>
                    </div>
                @else
                    <div class="col-md-6 mb-4">
                        <div class="card shadow-sm h-100">
                            <div class="card-body">
                                <h4 class="fw-semibold mb-3">📝 Hasil Diagnosa</h4>
                                <p>{{ $diagnosa->solusi ?? 'Tidak ada deskripsi terkait.' }}</p>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </section>
@endsection
