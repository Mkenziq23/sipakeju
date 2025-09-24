@extends('layouts.admin.main')

@section('title')
    {{ $title }}
@endsection

@section('content')
    <section class="py-5">
        <div class="container">
            <!-- Tombol Kembali dan Cetak -->
            <div class="d-flex justify-content-between align-items-center no-print mb-4">
                <a href="{{ route('admin.diagnosa.index') }}" class="btn btn-outline-success">
                    <i class="bi bi-arrow-left"></i> Kembali
                </a>
                <a href="{{ route('admin.diagnosa.print', $diagnosa->id) }}" class="btn btn-outline-primary">
                    <i class="bi bi-printer"></i> Cetak Hasil
                </a>
            </div>

            <h2 class="text-center fw-bold mb-4">Detail Hasil Identifikasi</h2>
            <hr class="mb-5">

            <!-- Identitas Pengguna -->
            <div class="mb-5">
                <h4 class="fw-semibold mb-3">🧑 Identitas Pengguna</h4>
                <div class="table-responsive shadow-sm rounded">
                    <table class="table table-bordered table-striped mb-0">
                        <tbody>
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
                            @php
                                $status = strtolower($diagnosa->status);
                            @endphp

                            <tr>
                                <th>Status</th>
                                <td>
                                    <strong>
                                        @if ($status === 'diserahkan kepada pakar')
                                            <span class="text-warning fw-semibold">{{ $diagnosa->status }}</span>
                                        @elseif ($status === 'selesai')
                                            <span class="text-success fw-semibold">{{ $diagnosa->status }}</span>
                                        @else
                                            <span class="text-muted fw-semibold">Belum diproses</span>
                                        @endif
                                    </strong>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Pilihan Jawaban -->
            <div class="mb-5">
                <h4 class="fw-semibold mb-3">📝 Pilihan Pengguna</h4>
                <div class="table-responsive shadow-sm rounded">
                    <table class="table table-bordered table-hover table-striped mb-0">
                        <thead class="table-dark">
                            <tr>
                                <th class="text-white" style="width: 5%;">No</th>
                                <th class="text-white">Pernyataan Kecenderungan Perilaku Judi Online</th>
                                <th class="text-white" style="width: 20%;">Jawaban</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($kondisi as $gejalaId => $kondisiItem)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ optional($gejala->where('id', $gejalaId)->first())->nama ?? '-' }}</td>
                                    <td>{{ $kondisiItem['label'] }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Hasil Analisa -->
            <div class="row bg-light rounded p-4 mb-5 border shadow-sm">
                <div class="col-md-6">
                    <h4 class="fw-semibold mb-3">📊 Hasil Identifikasi</h4>
                    <p>Berdasarkan jawaban yang dipilih, tingkat kecenderungan Anda adalah:</p>
                    <p class="fs-5 text-success">
                        <i class="bi bi-graph-up-arrow me-2"></i>
                        Presentase:
                        <strong>{{ number_format($diagnosa->presentase, 2) }}%</strong>
                    </p>
                    <p class="fs-5 text-success">
                        <i class="bi bi-activity me-2"></i>
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
                                <h4 class="fw-semibold mb-3">💡 Hasil Diagnosa</h4>

                                <!-- Form Simpan Solusi -->
                                <form action="{{ route('pengguna.diagnosa.updateSolusi') }}" method="POST">
                                    @csrf
                                    @method('PUT')
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
                                <p>{{ $diagnosa->solusi ?? 'Tidak ada solusi terkait.' }}</p>
                            </div>
                        </div>
                    </div>
                @endif
            </div>


            @if (Auth::check())
                @php
                    $role = Auth::user()->role;
                @endphp

                @if ($role === 'psikologi')
                    <form action="{{ route($role . '.diagnosa.updateStatus', $diagnosa->id) }}" method="POST"
                        class="mt-2 no-print">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="status" value="Selesai">
                        <button type="submit" class="btn btn-success">
                            <i class="bi bi-check-circle"></i> Selesai
                        </button>
                    </form>
                @elseif ($role === 'asisten1')
                    <form action="{{ route($role . '.diagnosa.updateStatus', $diagnosa->id) }}" method="POST"
                        class="mt-4 no-print">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="status" value="Diserahkan kepada pakar">
                        <button type="submit" class="btn btn-warning text-white">
                            <i class="bi bi-send"></i> Serahkan kepada Pakar
                        </button>
                    </form>
                @endif
                @if ($role === 'psikologi' || $role === 'asisten1')
                    <form action="{{ route($role . '.diagnosa.updateStatus', $diagnosa->id) }}" method="POST"
                        class="mt-2 no-print">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="status" value="">
                        <button type="submit" class="btn btn-danger">
                            <i class="bi bi-x-circle"></i> Batal
                        </button>
                    </form>
                @endif
            @endif

        </div>
    </section>

    <style>
        /* Print styles */
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

            /* Hide elements that shouldn't appear in print */
            .no-print {
                display: none !important;
            }

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
