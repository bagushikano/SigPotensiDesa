@extends('layouts/admin/admin-layout')

@push('css')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('admin-template/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin-template/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin-template/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
@endpush

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h3 col-lg-auto text-center text-md-start">Manajemen Desa</h1>
        <div class="col-auto ml-auto text-right mt-n1">
            <nav aria-label="breadcrumb text-center">
                <ol class="breadcrumb bg-transparent p-0 mt-1 mb-0">
                    <li class="breadcrumb-item"><a class="text-decoration-none" href="/">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Seluruh Desa</li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row p-0">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-6 my-auto">
                                <h3 class="card-title my-auto">Daftar Seluruh Desa</h3>
                            </div>
                            <div class="col-6 my-auto d-flex justify-content-end">
                                <a data-bs-toggle="modal" data-bs-target="#tambahDesa" class="card-title btn btn-success my-auto">Tambah Desa</a>
                            </div>
                        </div>
                    </div>
                    @if ($desa->count() < 1)
                        <div class="card-body my-auto">
                            <p class="fs-5 my-auto text-center">Tidak Terdapat Data Desa</p>
                        </div>
                    @else
                        <div class="card-body table-responsive-md">
                            <table id="tbDesa" class="table table-bordered table-hover">
                                <thead class="text-center">
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Desa</th>
                                        <th class="d-md-none">Tindakan</th>
                                        <th class="d-none d-md-table-cell">Tindakan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($desa as $data)
                                        <tr class="text-center align-middle my-auto">
                                            <td class="align-middle">{{ $loop->iteration }}</td>
                                            <td class="align-middle">{{ $data->nama }}</td>
                                            <td class="text-center align-middle d-md-none">
                                                <a href="{{ route('Detail Desa', $data->id) }}" class="btn btn-warning btn-sm">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                            </td>
                                            <td class="text-center align-middle d-none d-md-table-cell">
                                                <a href="{{ route('Detail Desa', $data->id) }}" class="btn btn-warning btn-sm">
                                                    <i class="fas fa-eye"></i>
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
    @include('modal/tambah-desa')  
@endsection

@push('js')
    <!-- DataTables  & Plugins -->
    <script src="{{ asset('admin-template/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('admin-template/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('admin-template/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('admin-template/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>

    <script type="text/javascript">
        $(document).ready(function(){
            $('#admin-manajemen-desa').addClass('menu-open');
            $('#manajemen-desa').addClass('active');
        });

        $(function () {
            $("#tbDesa").DataTable({
                "responsive": false, "lengthChange": false, "autoWidth": false,
                "oLanguage": {
                    "sSearch": "Cari:",
                    "sZeroRecords": "Data Tidak Ditemukan",
                    "sSearchPlaceholder": "Cari desa ...",
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

        // Example starter JavaScript for disabling form submissions if there are invalid fields
        (function () {
            'use strict'

            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            var forms = document.querySelectorAll('.needs-validation')

            // Loop over them and prevent submission
            Array.prototype.slice.call(forms)
                .forEach(function (form) {
                    form.addEventListener('submit', function (event) {
                        if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                        }

                        form.classList.add('was-validated')
                    }, false)
                })
        })()

        function resetForm() {
            $("#formTambahDesa").trigger("reset");
            $('#nama_desa').removeClass('is-invalid');
            $("#nama_desa").val('');
        }
    </script>

    @if (count($errors) > 0)
        <script type="text/javascript">
            $( document ).ready(function() {
                $('#tambahDesa').modal('show');
            });
        </script>
    @endif

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

    @if($message = Session::get('confirm'))
        <script>
          Swal.fire({
            title: 'Sukses',
            text: '{{$message}}',
            icon: 'success',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: `<a class="text-decoration-none link-light" class href="{{ route('Landing Page') }}">Iya, tambahkan</a>`,
            cancelButtonText: 'Tidak, lain kali',
          })
        </script>
    @endif
@endpush
