@extends('layouts.admin.main')

@section('title')
    Detail {{ $title }}
@endsection

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Detail {{ $title }}</h1>
            <a href="{{ route('admin.akun.index') }}" class="btn btn-secondary ml-auto">Kembali</a>
        </div>

        <div class="section-body">
            <div class="card card-primary shadow-sm">
                <div class="card-body">
                    <table class="table table-bordered">
                        <tr>
                            <th>Nama</th>
                            <td>{{ $akun->name }}</td>
                        </tr>
                        <tr>
                            <th>Username</th>
                            <td>{{ $akun->username }}</td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td>{{ $akun->email }}</td>
                        </tr>
                        <tr>
                            <th>Password</th>
                            <td><code>{{ $akun->password }}</code></td>
                        </tr>
                        <tr>
                            <th>Role</th>
                            <td>{{ ucfirst($akun->role) }}</td>
                        </tr>
                        <tr>
                            <th>Dibuat pada</th>
                            <td>{{ $akun->created_at->format('d M Y H:i') }}</td>
                        </tr>
                        <tr>
                            <th>Terakhir diubah</th>
                            <td>{{ $akun->updated_at->format('d M Y H:i') }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </section>
@endsection
