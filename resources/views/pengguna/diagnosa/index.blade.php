@extends('layouts.pengguna.main')

@section('content')
    <section class="inn">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h3 class="mb-4">Identitas Diri:</h3>
                    <table border="0" class="table">
                        <tr>
                            <td>Nama</td>
                            <td>:</td>
                            <td>{{ Str::title(Session('biodata')['nama']) }}</td>
                        </tr>
                        <tr>
                            <td>No. HP</td>
                            <td>:</td>
                            <td>{{ Session('biodata')['no_hp'] }}</td>
                        </tr>
                        <tr>
                            <td>Alamat</td>
                            <td>:</td>
                            <td>{{ Str::title(Session('biodata')['alamat']) }}</td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class='alert alert-primary alert-dismissible'>
                        <h4><i class="bi bi-exclamation-triangle"></i>&nbsp;Perhatian !</h4>
                        <p>Silahkan pilih jawaban pada pernyataan sesuai dengan perilaku yang dialami🙏</p>
                        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
                    </div>
                    <form action="{{ route('pengguna.diagnosa.analisa') }}" method="post" id="diagnosaForm">
                        @csrf
                        <table class="table table-bordered">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Pernyataan Kecenderungan Perilaku Judi Online</th>
                                    <th scope="col">Jawaban</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($gejalas as $gejala)
                                    <tr>
                                        <th scope="row" width="10%">{{ $loop->iteration }}</th>
                                        <td>{{ Str::title($gejala->nama) }}</td>
                                        <td width="25%">
                                            <div class="form-group">
                                                <select name="kondisi[]" class="form-control" required>
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
                            <a href="{{ route('pengguna.diagnosa.reset') }}" class="btn btn-secondary">Kembali</a>
                            <button type="submit" class="btn btn-primary">Analisa</button>
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
                    $(this).css('border', '2px solid red');
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
