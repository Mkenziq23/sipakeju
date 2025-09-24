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
                <form action="{{ route('admin.akun.store') }}" method="post">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="nama">Nama</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="nama"
                                name="name" placeholder="Masukkan Nama Lengkap" value="{{ old('name') }}">
                            @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" class="form-control @error('username') is-invalid @enderror"
                                id="username" name="username" placeholder="Masukkan username"
                                value="{{ old('username') }}">
                            @error('username')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                                name="email" placeholder="Masukkan Email" value="{{ old('email') }}">
                            @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="password" class="form-control @error('password') is-invalid @enderror"
                                        id="password" name="password" placeholder="Masukkan Password">
                                    @error('password')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="password_confirmation">Konfirmasi Password</label>
                                    <input type="password"
                                        class="form-control @error('password_confirmation') is-invalid @enderror"
                                        id="password_confirmation" name="password_confirmation"
                                        placeholder="Masukkan Konfirmasi Password">
                                    @error('password_confirmation')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        @if (Auth::user()->role === 'admin')
                            <div class="form-group">
                                <label for="role">Role</label>
                                <select name="role" id="role"
                                    class="form-control @error('role') is-invalid @enderror">
                                    <option value="">-- Pilih Role --</option>
                                    <option value="admin">Admin</option>
                                    <option value="psikologi">Psikologi</option>
                                    <option value="asisten1">Asisten 1</option>
                                    <option value="asisten2">Asisten 2</option>
                                    <option value="client">Client</option>
                                </select>
                                @error('role')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        @elseif (Auth::user()->role === 'psikologi')
                            <div class="form-group">
                                <label for="role">Role</label>
                                <select name="role" id="role"
                                    class="form-control @error('role') is-invalid @enderror">
                                    <option value="">-- Pilih Role --</option>
                                    <option value="asisten1">Asisten 1</option>
                                    <option value="asisten2">Asisten 2</option>
                                </select>
                                @error('role')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        @elseif (in_array(Auth::user()->role, ['asisten1', 'asisten2']))
                            <input type="hidden" name="role" value="client">
                        @endif


                        <div class="card-footer text-right">
                            <a href="{{ route('admin.akun.index') }}" class="btn btn-danger">
                                <i class="fas fa-arrow-left"></i> Kembali</a>
                            <button type="submit" class="btn btn-success"><i class="fa fa-plus"></i> Simpan</button>
                        </div>
                </form>
            </div>
        </div>
    </section>
@endsection
