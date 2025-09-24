@extends('layouts.pengguna.main')

@section('content')
    <section class="inn py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6">
                    <div class="card shadow-sm border-0">
                        <div class="card-body">
                            <h3 class="mb-4 text-center text-primary">Identitas Diri</h3>

                            <table class="table table-borderless">
                                <tr>
                                    <td><i class="bi bi-person-circle"></i> <strong>Nama</strong></td>
                                    <td>:</td>
                                    <td>{{ Str::title(Session('biodata')['nama']) }}</td>
                                </tr>
                                {{-- <p><strong>User ID:</strong> {{ $diagnosa->user_id }}</p> --}}
                                <tr>
                                    <td><i class="bi bi-phone"></i> <strong>No. HP</strong></td>
                                    <td>:</td>
                                    <td>{{ Session('biodata')['no_hp'] }}</td>
                                </tr>
                                <tr>
                                    <td><i class="bi bi-house-door"></i> <strong>Alamat</strong></td>
                                    <td>:</td>
                                    <td>{{ Str::title(Session('biodata')['alamat']) }}</td>
                                </tr>
                                @auth
                                    <tr>
                                        <td><i class="bi bi-house-door"></i> <strong>Pakar yang Menangani</strong></td>
                                        <td>:</td>
                                        <td>
                                            @if (Auth::user()->role === 'psikologi')
                                                {{ Auth::user()->name ?? 'Tidak Diketahui' }}
                                            @elseif(Auth::user()->role === 'admin')
                                                Panca Kursistin Handayani, S.Psi., MA
                                            @elseif(Auth::user()->role === 'client')
                                                Panca Kursistin Handayani, S.Psi., MA
                                            @else
                                                Tidak Diketahui
                                            @endif
                                        </td>
                                    </tr>

                                @endauth
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card shadow-lg mt-4">
                <div class="card-body">
                    <div class='alert alert-info alert-dismissible fade show' role="alert">
                        <h4><i class="bi bi-exclamation-triangle"></i>&nbsp;Perhatian !</h4>
                        <p>Silahkan pilih jawaban pada pernyataan sesuai dengan perilaku yang dialami 🙏</p>
                        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                            <span aria-hidden='true'>&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('pengguna.diagnosa.analisa') }}" method="post" id="diagnosaForm">
                        @csrf
                        <table class="table table-striped table-hover">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col" class="text-center">No</th>
                                    <th scope="col">Pernyataan Kecenderungan Perilaku Judi Online</th>
                                    <th scope="col" class="text-center">Jawaban</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($gejalas as $gejala)
                                    <tr>
                                        <th scope="row" class="text-center">{{ $loop->iteration }}</th>
                                        <td>{{ Str::title($gejala->nama) }}</td>
                                        <td class="text-center">
                                            <div class="form-group">
                                                <select name="kondisi[]" class="form-control form-control-lg" required>
                                                    <option value="" disabled selected>-- Pilih Jawaban --</option>
                                                    <option value="{{ $gejala->id }}_0">Sangat Tidak Setuju</option>
                                                    <option value="{{ $gejala->id }}_1">Tidak Setuju</option>
                                                    <option value="{{ $gejala->id }}_2">Setuju</option>
                                                    <option value="{{ $gejala->id }}_3">Sangat Setuju</option>
                                                    <option value="{{ $gejala->id }}_4">Tidak Tahu</option>
                                                </select>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="card-footer d-flex justify-content-between">
                            <a href="{{ route('pengguna.diagnosa.reset') }}" class="btn btn-secondary btn-lg">Kembali</a>
                            <button type="submit" class="btn btn-success btn-lg">Analisa</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('css')
    <link rel="stylesheet" href="{{ asset('assets/vendor/sweetalert2/dist/sweetalert2.min.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.6.1/font/bootstrap-icons.css">
    <style>
        /* Styling untuk select */
        select.form-control {
            border-radius: 8px;
            padding: 10px;
            font-size: 1rem;
        }

        /* Hover Effect untuk tombol */
        .btn:hover {
            opacity: 0.9;
            transition: opacity 0.3s ease;
        }

        /* Styling untuk card */
        .card {
            border-radius: 10px;
        }

        /* Error border styling */
        .form-control:invalid {
            border-color: #e74a3b;
            box-shadow: 0 0 0 0.2rem rgba(231, 74, 59, 0.25);
        }

        /* Alert custom style */
        .alert {
            font-size: 1.1rem;
            padding: 1rem;
            border-radius: 8px;
        }
    </style>
@endpush

@push('js')
    <script src="{{ asset('assets/vendor/sweetalert2/dist/sweetalert2.min.js') }}"></script>
    <script>
        $('form').on('submit', function(e) {
            var allSelected = true;
            var firstUnselected = null;

            $('select[name="kondisi[]"]').each(function() {
                if ($(this).val() == null) {
                    allSelected = false;
                    if (firstUnselected === null) {
                        firstUnselected = $(this);
                    }
                    $(this).css('border', '2px solid #e74a3b');
                } else {
                    $(this).css('border', '');
                }
            });

            if (!allSelected) {
                e.preventDefault();
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Semua jawaban harus diisi sebelum analisa!'
                });

                firstUnselected.focus();
            }
        });

        $('select[name="kondisi[]"]').on('change', function() {
            if ($(this).val() !== null) {
                $(this).css('border', '');
            }
        });
    </script>
@endpush
