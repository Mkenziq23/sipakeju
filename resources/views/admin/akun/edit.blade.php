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
                    <h4>Edit {{ $title }}</h4>
                </div>
                <form action="{{ route('admin.akun.update', $akun->id) }}" method="post">
                    @method('PUT')
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="nama">Nama</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="nama"
                                name="name" value="{{ old('name', $akun->name) }}" placeholder="Masukkan Nama Lengkap">
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" class="form-control @error('username') is-invalid @enderror"
                                id="username" name="username" value="{{ old('username', $akun->username) }}"
                                placeholder="Masukkan Username">
                            @error('username')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                                name="email" value="{{ old('email', $akun->email) }}" placeholder="Masukkan Email">
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="password">Password Baru (kosongkan jika tidak ingin mengubah)</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror"
                                id="password" name="password" placeholder="Masukkan Password Baru">
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="password_confirmation">Konfirmasi Password Baru</label>
                            <input type="password" class="form-control" id="password_confirmation"
                                name="password_confirmation" placeholder="Konfirmasi Password Baru">
                        </div>


                        @if (Auth::user()->role === 'admin')
                            <div class="form-group">
                                <label for="role">Role</label>
                                <select name="role" id="role"
                                    class="form-control @error('role') is-invalid @enderror">
                                    <option value="">-- Pilih Role --</option>
                                    <option value="admin" {{ old('role', $akun->role) === 'admin' ? 'selected' : '' }}>
                                        Admin</option>
                                    <option value="psikologi"
                                        {{ old('role', $akun->role) === 'psikologi' ? 'selected' : '' }}>Psikologi</option>
                                    <option value="client" {{ old('role', $akun->role) === 'client' ? 'selected' : '' }}>
                                        Client</option>
                                </select>
                                @error('role')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        @else
                            {{-- Jika psikologi login, sembunyikan input role dan tampilkan info --}}
                            <input type="hidden" name="role" value="{{ $akun->role }}">
                            <div class="form-group">
                                <label for="role">Role</label>
                                <input type="text" class="form-control" value="{{ ucfirst($akun->role) }}" disabled>
                            </div>
                        @endif

                        <div class="card-footer text-right">
                            <a href="{{ route('admin.akun.index') }}" class="btn btn-danger">
                                <i class="fas fa-arrow-left"></i> Kembali</a>
                            <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Simpan
                                Perubahan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
