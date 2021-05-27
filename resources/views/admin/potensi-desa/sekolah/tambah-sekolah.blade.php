@extends('layouts/admin/admin-layout')

@push('css')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('admin-template/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin-template/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin-template/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
    integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
    crossorigin="anonymous"/>
    <link rel="stylesheet" href="https://unpkg.com/@geoman-io/leaflet-geoman-free@latest/dist/leaflet-geoman.css"/>

    <style>
        #mapid { height: 65vh; }
    </style>
@endpush

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h3 col-lg-auto text-center text-md-start">Tambah Sekolah</h1>
        <div class="col-auto ml-auto text-right mt-n1">
            <nav aria-label="breadcrumb text-center">
                <ol class="breadcrumb bg-transparent p-0 mt-1 mb-0">
                    <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ route('Sekolah') }}">Manajemen Sekolah</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Tambah Baru</li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="container-fluid p-0">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header my-auto text-center">
                        <p class="my-auto">Tambah Data Sekolah</p>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('Simpan Sekolah') }}" enctype="multipart/form-data" method="POST" class="needs-validation" novalidate>
                            @csrf
                            <div class="row">
                                <div class="col-sm-12 col-md-6">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control @error('nama_sekolah') is-invalid @enderror" id="nama_sekolah" name="nama_sekolah" placeholder="Masukan nama pusat pemerintahan" value="{{ old('nama_sekolah') }}" autocomplete="off" required>
                                        <label for="nama_sekolah">Nama Sekolah<span class="text-danger">*</span></label>
                                        @error('nama_sekolah')
                                            <div class="invalid-feedback text-start">
                                                {{ $message }}
                                            </div>
                                        @else
                                            <div class="invalid-feedback">
                                                Nama Sekolah wajib diisi
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                @include('modal/tambah-foto')
                                <div class="col-sm-12 col-md-6">
                                    <div class="form-floating mb-3">
                                        <select class="form-select" id="lokasi_desa" name="lokasi_desa" required>
                                            <option disabled selected value="">Pilih desa lokasi sekolah</option>
                                            @foreach ($desa as $data)
                                                @if ($data->batas_wilayah == NULL)
                                                <option value="" disabled>{{ $data->nama }}</option>
                                                @else
                                                    <option value="{{ $data->id }}" onclick="showBatasDesa('{{$data->id}}')">{{ $data->nama }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                        @error('lokasi_desa')
                                            <div class="invalid-feedback text-start">
                                                {{ $message }}
                                            </div>
                                        @else
                                            <div class="invalid-feedback">
                                                Desa lokasi sekolah wajib diisi
                                            </div>
                                        @enderror
                                        <label for="lokasi_desa">Lokasi Desa<span class="text-danger">*</span></label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 col-md-6">
                                    <div class="form-floating mb-3">
                                        <select class="form-select" id="jenjang" name="jenjang" required>
                                            <option disabled selected value="">Pilih Jenjang Sekolah</option>
                                            <option value="Paud">Paud</option>
                                            <option value="TK">TK</option>
                                            <option value="SD">SD</option>
                                            <option value="SMP">SMP</option>
                                            <option value="SMA">SMA</option>
                                            <option value="SMK">SMK</option>
                                            <option value="Universitas">Universitas</option>
                                        </select>
                                        @error('jenjang')
                                            <div class="invalid-feedback text-start">
                                                {{ $message }}
                                            </div>
                                        @else
                                            <div class="invalid-feedback">
                                                Jenjang sekolah wajib diisi
                                            </div>
                                        @enderror
                                        <label for="jenjang">Jenjang Sekolah<span class="text-danger">*</span></label>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-6">
                                    <div class="form-floating mb-3">
                                        <select class="form-select" id="jenis_sekolah" name="jenis_sekolah" name="desa" required>
                                            <option disabled selected value="">Pilih jenis sekolah</option>
                                            <option value="Sekolah Negeri">Sekolah Negeri</option>
                                            <option value="Sekolah Swasta">Sekolah Swasta</option>
                                        </select>
                                        @error('jenis_sekolah')
                                            <div class="invalid-feedback text-start">
                                                {{ $message }}
                                            </div>
                                        @else
                                            <div class="invalid-feedback">
                                                Jenis sekolah wajib diisi
                                            </div>
                                        @enderror
                                        <label for="jenis_sekolah">Jenis Sekolah<span class="text-danger">*</span></label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 col-md-6">
                                    <div class="mb-3">
                                        <label for="latSekolah" class="form-label">Koordinat Latitude<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control disabled" id="latSekolah" name="latSekolah" placeholder="Koordinat latitude sekolah" required readonly>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-6">
                                    <div class="mb-3">
                                        <label for="lngSekolah" class="form-label">Koordinat Longitude<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="lngSekolah" name="lngSekolah" placeholder="Koordinat longitude sekolah" required readonly>
                                    </div>
                                </div>
                                @if ($errors->has('lngSekolah') && $errors->has('latSekolah'))
                                    <p class="text-end text-danger">Lokasi sekolah pada peta wajib ditentukan</p>
                                @endif
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="mb-3">
                                        <label for="alamat" class="form-label">Alamat Sekolah</label>
                                        <textarea class="form-control @error('alamat') is-invalid @enderror" id="alamat" placeholder="Masukan alamat sekolah" name="alamat" style="height: 60px" required>{{ old('alamat') }}</textarea>
                                        @error('alamat')
                                            <div class="invalid-feedback text-start">
                                                {{ $message }}
                                            </div>
                                        @else
                                            <div class="invalid-feedback">
                                                Alamat sekolah wajib diisi
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 text-right">
                                    <a data-bs-toggle="modal" data-bs-target="#tambahFoto" class="card-title btn btn-sm btn-primary">Tambah Foto Sekolah</a>
                                    <button type="submit" class="btn btn-sm btn-outline-success">Simpan Data</button>
                                </div>
                            </div>
                            <div class="row">
                                <span class="text-danger text-end">* Data wajib diisi</span>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="card">
                    <div class="card-header my-auto text-center">
                        <p class="my-auto">Peta Sekolah</p>
                    </div>
                    <div class="card-body">
                        <div id="mapid"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script src="{{ asset('admin-template/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('admin-template/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('admin-template/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('admin-template/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
    <script src="{{ asset('admin-template/plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
    integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
    crossorigin="anonymous"></script>
    <script src="https://unpkg.com/@geoman-io/leaflet-geoman-free@latest/dist/leaflet-geoman.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function(){
            $('#list-potensi-desa').addClass('menu-is-opening menu-open');
            $('#potensi-desa').addClass('active');
            $('#sekolah').addClass('active');
        });

        $(function () {
            bsCustomFileInput.init();
        });

        $('#img_preview').hide();

        $('#inputFoto').on('change', function(event){
            var img = document.getElementById('img_preview');
            img.src = URL.createObjectURL(event.target.files[0]);
            img.onload = function() {
                URL.revokeObjectURL(img.src) // free memory
            }
            $('#img_preview').show();
        });

        // Inisialisasi Map
        let mymap = L.map('mapid', { zoomControl: false }).setView([-8.477003, 115.0407526], 10);

        // Memunculkan Map
        L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
            attribution: 'Sistem Informasi Geografis Potensi Desa &copy; {{ date('Y', strtotime(date('Y-m-d H:i:s'))) }}',
            maxZoom: 18,
            minZoom: 1,
            id: 'mapbox/streets-v11',
            tileSize: 512,
            zoomOffset: -1,
            accessToken: 'pk.eyJ1IjoiZGVkeWR3aXZhIiwiYSI6ImNra3NheDBkaDB6NXMyeG54ODZqdXlnbGUifQ.9OCiV7iAva0iXlZu-HZUkQ'
        }).addTo(mymap);

        // Menambahkan tombol controller zoom in out
        L.control.zoom({
            position: 'bottomright'
        }).addTo(mymap);

        let pathLine;

        // Menampilkan batas desa sesuai desa yang dipilih
        function showBatasDesa(desa) {
            let myDesa = {!! json_encode($desa->toArray()) !!}
            myDesa.forEach(element => {
                if(element['id'] == desa){
                    // Menghapus batas desa sebelumnya ketika desa baru dipilih
                    for(; Object.keys(mymap._layers).length > 1;) {
                        mymap.removeLayer(mymap._layers[Object.keys(mymap._layers)[1]]);
                    }
                    $('#latSekolah').val(''); // Set field latSekolah dengan nilai lat baru
                    $('#lngSekolah').val(''); // Set field lngSekolah dengan nilai lng baru
                    let koor = jQuery.parseJSON(element['batas_wilayah']);
                    let pathCoords = makePolygon(koor);
                    pathLine = L.polygon(pathCoords, {
                        id: element['id'],
                        color: element['warna'],
                        fillColor: element['warna'],
                        fillOpacity: 0.4,
                    }).addTo(mymap);
                    mymap.fitBounds(pathLine.getBounds());
                    pathLine.on('click', klikBatasDesa); // Memanggil fungsi klikBatasDesa
                }
            });
        }

        // Menghubungkan antar koordinat batas desa
        function makePolygon(data){
            var c = [];
            for(i in data) {
                var x = data[i]['lat'];
                var y = data[i]['lng'];
                c.push([x, y]);
            }
            return c;
        }

        // Inisialisasi Map Icon
        let mapIcon = L.icon({
            iconUrl: "/maps/icon/3",
            iconSize: [27, 27],
            iconAnchor: [16, 16],
        });

        // Digunakan untuk membuat event on klik pada batas desa yang tampil
        function klikBatasDesa(e) {
            marker = new L.marker(e.latlng, {icon: mapIcon});
            pathLine.off('click', klikBatasDesa); // Disable fungsi onClik pada layer batas desa
            // Event ketika marker pada map di klik
            marker.on('click', function() {
                mymap.removeLayer(marker) // Menghapus marker
                $('#latSekolah').val(''); // Set field latSekolah dengan nilai lat baru
                $('#lngSekolah').val(''); // Set field lngSekolah dengan nilai lng baru
                pathLine.on('click', klikBatasDesa); // Enable fungsi onClik pada layer batas desa setelah marker sebelumnya di hapus
            });
            $('#latSekolah').val(e.latlng.lat); // Set field latSekolah dengan nilai lat baru
            $('#lngSekolah').val(e.latlng.lng); // Set field lngSekolah dengan nilai lng baru
            mymap.addLayer(marker);
        };
    </script>

    @if ($errors->has('foto'))
        <script type="text/javascript">
            $( document ).ready(function() {
                $('#tambahFoto').modal('show');
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
@endpush
