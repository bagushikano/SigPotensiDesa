@extends('layouts/admin/admin-layout')

@push('css')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('admin-template/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin-template/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin-template/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
@endpush

@section('content')  
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h3 col-lg-auto text-center text-md-start">Manajemen Pasar</h1>
        <div class="col-auto ml-auto text-right mt-n1">
            <nav aria-label="breadcrumb text-center">
                <ol class="breadcrumb bg-transparent p-0 mt-1 mb-0">
                    <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ route('Dashboard Admin') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Pasar</li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 p-0">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-6 my-auto">
                                <h3 class="card-title my-auto">Daftar Pasar</h3>
                            </div>
                            <div class="col-6 my-auto d-flex justify-content-end">
                                <a href="{{ route('Tambah Pasar') }}" class="card-title btn btn-success my-auto">
                                    <i class="fas fa-plus"></i>
                                    <span class="border-end mx-2"></span>
                                    Tambah Pasar
                                </a>
                            </div>
                        </div>
                    </div>
                    @if ($pasar->count() < 1)
                        <div class="card-body my-auto">
                            <p class="fs-5 my-auto text-center">Tidak Terdapat Data Pasar</p>
                        </div>
                    @else
                        <div class="card-body table-responsive-md">
                            <table id="tbPasar" class="table table-bordered table-hover">
                                <thead class="text-center">
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Desa</th>
                                        <th>Lokasi Desa</th>
                                        <th class="d-md-none">Tindakan</th>
                                        <th class="d-none d-md-table-cell">Tindakan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($pasar as $data)
                                        <tr class="text-center align-middle my-auto">
                                            <td class="align-middle">{{ $loop->iteration }}</td>
                                            <td class="align-middle">{{ $data->nama }}</td>
                                            <td class="align-middle">{{ $data->desa->nama }}</td>
                                            <td class="text-center align-middle d-md-none">
                                                <a href="{{ route('Detail Pasar', $data->id) }}" class="btn btn-warning btn-sm">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <button type="submit" onclick="deletePasar('{{$data->id}}')" class="btn btn-sm btn-danger">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </td>
                                            <td class="text-center align-middle d-none d-md-table-cell">
                                                <a href="{{ route('Detail Pasar', $data->id) }}" class="btn btn-warning btn-sm">
                                                    <i class="fas fa-eye"></i>
                                                    <span class="border-end mx-2 border-dark"></span>
                                                    Detail
                                                </a>
                                                <button onclick="deletePasar('{{$data->id}}')" class="btn btn-sm btn-danger">
                                                    <i class="fas fa-trash"></i>
                                                    <span class="border-end mx-2"></span>
                                                    Hapus
                                                </button>
                                            </td>
                                            <form action="{{ route('Hapus Pasar', $data->id) }}" id="hapus-pasar" method="POST" class="d-inline">
                                                @csrf
                                            </form>
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
            $('#list-potensi-desa').addClass('menu-is-opening menu-open');
            $('#potensi-desa').addClass('active');
            $('#pasar').addClass('active');
        });

        $(function () {
            $("#tbPasar").DataTable({
                "responsive": false, "lengthChange": false, "autoWidth": false,
                "oLanguage": {
                    "sSearch": "Cari:",
                    "sZeroRecords": "Data Tidak Ditemukan",
                    "sSearchPlaceholder": "Cari pasar ...",
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

        function deletePasar(desa) {
            Swal.fire({
                title: 'Peringatan',
                text: 'Apakah anda yakin akan menghapus pasar ?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: "Ya, hapus",
                cancelButtonText: 'Tidak, batalkan',
            }).then((result) => {
                if (result.isConfirmed) {
                    $('#hapus-pasar').submit();
                }
            })
        }
    </script>

    @if($message = Session::get('success'))
        <script>
            $(document).ready(function(){
                alertSuccess('{{$message}}');
            });
        </script>
    @endif

    @if($message = Session::get('failed'))
        <script>
            $(document).ready(function(){
                alertDanger('{{$message}}');
            });
        </script>
    @endif
@endpush
