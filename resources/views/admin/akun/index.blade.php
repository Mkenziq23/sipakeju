@extends('layouts.admin.main')

@section('title')
    {{ $title }}
@endsection

@section('content')
    <section class="section">
        {{-- Header --}}
        <div class="section-header d-flex justify-content-between align-items-center">
            <h1>{{ $title }}</h1>
            <a href="{{ route('admin.akun.create') }}" class="btn btn-primary btn-icon-text">
                <i class="fa fa-plus mr-2"></i> Tambah Akun
            </a>
        </div>

        {{-- Body --}}
        <div class="section-body">
            <div class="card card-primary shadow-sm">
                <div class="card-header">
                    <h4 class="mb-0">Daftar {{ $title }}</h4>
                </div>
                <div class="card-body p-3">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover" id="tabel">
                            <thead class="thead-dark">
                                <tr>
                                    <th width="7%" class="text-center align-middle">No</th>
                                    <th class="align-middle">Kode Klien</th>
                                    <th class="align-middle">Nama</th>
                                    <th width="30%" class="align-middle">Email</th>
                                    <th width="15%" class="align-middle">Role</th>
                                    <th width="28%" class="text-center align-middle">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($akuns as $akun)
                                    <tr>
                                        <td class="text-center align-middle">{{ $loop->iteration }}</td>
                                        <td class="align-middle">{{ Str::title($akun->client_code) }}</td>
                                        <td class="align-middle">{{ Str::title($akun->name) }}</td>
                                        <td class="align-middle">{{ $akun->email }}</td>
                                        <td class="align-middle">
                                            @if ($akun->role === 'admin')
                                                <span class="badge badge-danger">{{ ucfirst($akun->role) }}</span>
                                            @elseif($akun->role === 'psikologi')
                                                <span class="badge badge-primary">{{ ucfirst($akun->role) }}</span>
                                            @elseif($akun->role === 'client')
                                                <span class="badge badge-success">{{ ucfirst($akun->role) }}</span>
                                            @else
                                                <span class="badge badge-secondary">{{ ucfirst($akun->role) }}</span>
                                            @endif
                                        </td>
                                        <td class="text-center align-middle">
                                            <a href="{{ route('admin.akun.edit', $akun->id) }}"
                                                class="btn btn-sm btn-warning mr-1" data-toggle="tooltip" title="Ubah Data">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            <a href="{{ route('admin.akun.show', $akun->id) }}"
                                                class="btn btn-sm btn-info mr-1" data-toggle="tooltip" title="Detail Akun">
                                                <i class="fa fa-info-circle"></i>
                                            </a>

                                            <form action="{{ route('admin.akun.destroy', $akun->id) }}"
                                                id="delete_{{ $akun->id }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="btn btn-sm btn-danger btn-hapus"
                                                    value="{{ $akun->id }}" data-toggle="tooltip" title="Hapus Akun">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('css')
    <link rel="stylesheet" href="{{ asset('assets/vendor/datatables/datatables.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('assets/vendor/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/datatables/Select-1.2.4/css/select.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/sweetalert2/dist/sweetalert2.min.css') }}">
    <style>
        .btn-sm {
            min-width: 38px;
            width: 38px;
            height: 38px;
            padding: 0;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            border-radius: 0.25rem;
            transition: background-color 0.2s ease;
        }

        .btn-sm i {
            font-size: 18px;
        }

        .section-header {
            margin-bottom: 1.8rem;
        }

        /* Hover effect pada baris tabel */
        table#tabel tbody tr:hover {
            background-color: #e9ecef;
            /* lebih kontras */
            cursor: pointer;
        }

        /* Padding dan ukuran font nyaman pada sel tabel */
        table#tabel td,
        table#tabel th {
            vertical-align: middle !important;
            padding: 12px 15px;
            font-size: 14px;
        }

        /* Badge role warna */
        .badge {
            font-size: 0.85rem;
            padding: 0.35em 0.65em;
        }

        /* Responsif: tombol aksi vertikal di layar kecil */
        @media (max-width: 575.98px) {
            td.text-center .btn-sm {
                margin-bottom: 4px;
                min-width: auto;
                width: auto;
                padding: 6px 10px;
            }
        }
    </style>
@endpush

@push('js')
    <script src="{{ asset('assets/vendor/datatables/datatables.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/datatables/Select-1.2.4/js/dataTables.select.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/jquery-ui/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/sweetalert2/dist/sweetalert2.min.js') }}"></script>
@endpush

@push('script')
    <script>
        $(document).ready(() => {
            $('#tabel').DataTable({
                "language": {
                    "search": "Cari:",
                    "lengthMenu": "Tampilkan _MENU_ data",
                    "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                    "paginate": {
                        "previous": "Sebelumnya",
                        "next": "Berikutnya"
                    }
                }
            });

            // Enable tooltip
            $('[data-toggle="tooltip"]').tooltip({
                delay: {
                    "show": 300,
                    "hide": 100
                }
            });

            $('.btn-hapus').click(function() {
                let id = $(this).val();
                Swal.fire({
                    title: 'Perhatian!',
                    text: "Apakah Anda yakin ingin menghapus data ini?",
                    icon: 'warning',
                    showCancelButton: true,
                    cancelButtonColor: 'grey',
                    confirmButtonText: 'Ya',
                    cancelButtonText: 'Tidak'
                }).then((result) => {
                    if (result.isConfirmed) {
                        hapusData(id);
                    }
                })
            });

            function hapusData(id) {
                let url = $(`#delete_${id}`).attr('action');
                let data = $(`#delete_${id}`).serialize();
                $.ajax({
                    url: url,
                    type: 'POST',
                    data: data,
                    success: function(response) {
                        Swal.fire(
                            'Berhasil!',
                            'Data akun berhasil dihapus.',
                            'success'
                        );
                        setTimeout(() => {
                            location.reload();
                        }, 1000);
                    }
                })
            }
        });
    </script>
@endpush
