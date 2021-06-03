@extends('layouts/admin/admin-layout')

@push('css')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('admin-template/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin-template/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin-template/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
@endpush

@section('content')  
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h3 col-lg-auto text-center text-md-start">Laporan</h1>
        <div class="col-auto ml-auto text-right mt-n1">
            <nav aria-label="breadcrumb text-center">
                <ol class="breadcrumb bg-transparent p-0 mt-1 mb-0">
                    <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ route('Dashboard Admin') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Report</li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 px-0">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-12 my-auto">
                                <h3 class="card-title my-auto">Jumlah Potensi Desa</h3>
                            </div>
                        </div>
                    </div>
                    @if ($potensiDesa->count() < 1)
                        <div class="card-body my-auto">
                            <p class="fs-5 my-auto text-center">Tidak Terdapat Potensi Desa</p>
                        </div>
                    @else
                        <div class="card-body table-responsive-md">
                            <table id="tbPasar" class="table table-responsive-sm table-bordered table-hover">
                                <thead class="text-center">
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Desa</th>
                                        <th>Pasar</th>
                                        <th>Sekolah</th>
                                        <th>Pusat Pemerintahan</th>
                                        <th>Tempat Ibadah</th>
                                        <th class="d-md-none">Tindakan</th>
                                        <th class="d-none d-md-table-cell">Tindakan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($potensiDesa as $data)
                                        <tr class="text-center align-middle my-auto">
                                            <td class="align-middle">{{ $loop->iteration }}</td>
                                            <td class="align-middle">{{ $data->desa->nama }}</td>
                                            @if ($data->pasar == NULL)
                                                <td class="align-middle">0</td>
                                            @else
                                                <td class="align-middle">{{ $data->pasar }}</td>
                                            @endif
                                            @if ($data->sekolah == NULL)
                                                <td class="align-middle">0</td>
                                            @else
                                                <td class="align-middle">{{ $data->sekolah }}</td>
                                            @endif
                                            @if ($data->pusat_pemerintahan == NULL)
                                                <td class="align-middle">0</td>
                                            @else
                                                <td class="align-middle">{{ $data->pusat_pemerintahan }}</td>
                                            @endif
                                            @if ($data->tempat_ibadah == NULL)
                                                <td class="align-middle">0</td>
                                            @else
                                                <td class="align-middle">{{ $data->tempat_ibadah }}</td>
                                            @endif
                                            <td class="text-center align-middle d-md-none">
                                                <a href="{{ route('Detail Report', $data->id_desa) }}" class="btn btn-warning btn-sm">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                            </td>
                                            <td class="text-center align-middle d-none d-md-table-cell">
                                                <a href="{{ route('Detail Report', $data->id_desa) }}" class="btn btn-warning btn-sm">
                                                    <i class="fas fa-eye"></i>
                                                    <span class="border-end mx-2 border-dark"></span>
                                                    Detail
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <!-- DataTables  & Plugins -->
    <script src="{{ asset('admin-template/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('admin-template/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('admin-template/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('admin-template/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>

    <script type="text/javascript">
        $(document).ready(function(){
            $('#admin-report').addClass('menu-open');
            $('#report').addClass('active');
        });

        $(function () {
            $("#tbPasar").DataTable({
                "responsive": false, "lengthChange": false, "autoWidth": false,
                "oLanguage": {
                    "sSearch": "Cari:",
                    "sZeroRecords": "Data Tidak Ditemukan",
                    "sSearchPlaceholder": "Cari data ...",
                    "infoEmpty": "Menampilkan 0 Data",
                    "infoFiltered": "(dari _MAX_ Data)"
                },
                "language": {
                    "paginate": {
                        "previous": 'Sebelumnya',
                        "next": 'Berikutnya'
                    },
                    "info": "Menampilkan halaman _PAGE_ dari _PAGES_",
                },
            });
        });
    </script>
@endpush
