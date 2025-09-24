@extends('layouts.admin.main')

@section('title')
    {{ $title }}
@endsection

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>{{ $title }}</h1>
        </div>

        <div class="section-body">
            <div class="card card-primary">
                <div class="card-header">
                    <h4>Tambah {{ $title }}</h4>
                </div>
                <form action="{{ route('admin.range.store') }}" method="POST">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="min_value">Nilai Minimum</label>
                            <input type="number" step="0.01" name="min_value" id="min_value"
                                class="form-control @error('min_value') is-invalid @enderror"
                                placeholder="Masukkan nilai minimum" required>
                            @error('min_value')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="max_value">Nilai Maksimum</label>
                            <input type="number" step="0.01" name="max_value" id="max_value"
                                class="form-control @error('max_value') is-invalid @enderror"
                                placeholder="Masukkan nilai maksimum" required>
                            @error('max_value')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="keterangan">Keterangan</label>
                            <input type="text" name="keterangan" id="keterangan"
                                class="form-control @error('keterangan') is-invalid @enderror"
                                placeholder="Masukkan keterangan (contoh: Kecenderungan Tinggi)" required>
                            @error('keterangan')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="card-footer text-right">
                        <a href="{{ route('admin.range.index') }}" class="btn btn-danger"><i class="fas fa-arrow-left"></i>
                            Kembali</a>
                        <button type="submit" class="btn btn-success"><i class="fa fa-plus"></i> Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
@push('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet">
@endpush

@push('js')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
@endpush

@push('script')
    <script>
        $(document).ready(() => {
            $(".cb").select2();
        });
    </script>
@endpush
