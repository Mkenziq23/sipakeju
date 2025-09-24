@extends('layouts.admin.main')

@section('title')
    {{ $title }}
@endsection

@section('content')
    <section class="section">
        {{-- Header --}}
        <div class="section-header">
            <h1>{{ $title }}</h1>
        </div>
        {{-- Body --}}
        <div class="section-body">
            <div class="card card-primary">
                <div class="card-header">
                    <h4>Ubah {{ $title }}</h4>
                </div>
                <form action="{{ route('admin.range.update', $range->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        <div class="form-group">
                            <label for="min_value">Nilai Minimum</label>
                            <input type="number" step="0.01" name="min_value" id="min_value"
                                class="form-control @error('min_value') is-invalid @enderror"
                                value="{{ old('min_value', $range->min_value) }}" required>
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
                                value="{{ old('max_value', $range->max_value) }}" required>
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
                                value="{{ old('keterangan', $range->keterangan) }}" required>
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
                        <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
