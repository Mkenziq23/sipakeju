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
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4>Daftar {{ $title }}</h4>
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#cetakFilter">
                        <i class="fas fa-print"></i> Cetak
                    </button>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered" id="tabel">
                            <thead class="thead-dark">
                                <tr>
                                    <th width='7%'>No</th>
                                    <th>Tanggal</th>
                                    <th>Kode Klien</th>
                                    <th>Nama</th>
                                    <th>Alamat</th>
                                    <th>Pakar Menangani</th>
                                    <th>Presentase</th>
                                    <th>Tingkat Kecenderungan</th>
                                    <th>Detail</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($diagnosas as $diagnosa)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ date_format($diagnosa->created_at, 'd-m-Y') }}</td>
                                        <td>{{ $diagnosa->user->client_code ?? '-' }}</td>
                                        <td>{{ Str::title($diagnosa->nama) }}</td>
                                        <td>{{ Str::title($diagnosa->alamat) }}</td>
                                        <td>{{ $diagnosa->pakar }}</td>
                                        <td>{{ $diagnosa->presentase }}%</td>
                                        <td>{{ $diagnosa->tingkat_kecenderungan }}</td>
                                        <td>
                                            <a href="{{ route('admin.diagnosa.show', $diagnosa->id) }}"
                                                class="btn btn-info btn-sm">
                                                <i class="fas fa-eye"></i> Show
                                            </a>
                                        </td>
                                        <td>
                                            @if ($diagnosa->status === 'Diserahkan kepada pakar')
                                                <span class="badge badge-warning">
                                                    <i class="fas fa-paper-plane"></i> {{ $diagnosa->status }}
                                                </span>
                                            @elseif ($diagnosa->status === 'Selesai')
                                                <span class="badge badge-success">
                                                    <i class="fas fa-check-circle"></i> {{ $diagnosa->status }}
                                                </span>
                                            @else
                                                <span class="badge badge-secondary">
                                                    <i class="fas fa-clock"></i> Menunggu
                                                </span>
                                            @endif
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

    {{-- Modal Cetak Filter --}}
    <div class="modal fade" id="cetakFilter" tabindex="-1" aria-labelledby="cetakModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('admin.laporan.create') }}" method="post">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="cetakModalLabel">Filter Tanggal Cetak</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span>&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="periode_awal">Periode Awal</label>
                                <input type="date" class="form-control" name="periode_awal" id="periode_awal" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="periode_akhir">Periode Akhir</label>
                                <input type="date" class="form-control" name="periode_akhir" id="periode_akhir" required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-success">Konfirmasi</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('css')
    <link rel="stylesheet" href="{{ asset('assets/vendor/datatables/datatables.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('assets/vendor/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/datatables/Select-1.2.4/css/select.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/sweetalert2/dist/sweetalert2.min.css') }}">
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
        $(document).ready(function() {
            $('#tabel').DataTable();
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
            });
        });

        // function hapusData(id) {
        //     let url = $(`#delete_${id}`).attr('action');
        //     let data = $(`#delete_${id}`).serialize();
        //     $.ajax({
        //         url: url,
        //         type: 'POST',
        //         data: data,
        //         success: function(response) {
        //             Swal.fire('Berhasil!', 'Data berhasil dihapus', 'success');
        //             setTimeout(() => {
        //                 location.reload();
        //             }, 1000);
        //         }
        //     });
        // }
    </script>
@endpush
