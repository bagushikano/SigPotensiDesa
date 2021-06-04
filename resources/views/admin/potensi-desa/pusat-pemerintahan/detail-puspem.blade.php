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
        <h1 class="h3 col-lg-auto text-center text-md-start">Detail Pusat Pemerintahan</h1>
        <div class="col-auto ml-auto text-right mt-n1">
            <nav aria-label="breadcrumb text-center">
                <ol class="breadcrumb bg-transparent p-0 mt-1 mb-0">
                    <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ route('Puspem') }}">Manajemen Pusat Pemerintahan</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Detail</li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="container-fluid p-0">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header my-auto text-center">
                        <p class="my-auto">Peta Lokasi Pusat Pemerintahan</p>
                    </div>
                    <div class="card-body">
                        <div id="mapid"></div>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="card">
                    <div class="card-header my-auto text-center">
                        <p class="my-auto">Data Data Pusat Pemerintahan</p>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('Update Puspem', $puspem->id) }}" enctype="multipart/form-data" method="POST" class="needs-validation" novalidate>
                            @csrf
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control @error('nama_puspem') is-invalid @enderror" id="nama_puspem" name="nama_puspem" placeholder="Masukan nama pusat pemerintahan" value="{{ old('nama_puspem', $puspem->nama) }}" autocomplete="off" required>
                                        <label for="nama_puspem">Nama Pusat Pemerintahan<span class="text-danger">*</span></label>
                                        @error('nama_puspem')
                                            <div class="invalid-feedback text-start">
                                                {{ $message }}
                                            </div>
                                        @else
                                            <div class="invalid-feedback">
                                                Nama Pusat Pemerintahan wajib diisi
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            @include('modal/detail-foto-puspem')
                            <div class="row">
                                <div class="col-sm-12 col-md-6">
                                    <div class="form-floating mb-3">
                                        <select class="form-select" id="lokasi_desa" name="lokasi_desa" aria-label="Floating label select example" required>
                                            @foreach ($desa as $data)
                                                @if ($data->id == $puspem->desa->id)
                                                    <option selected value="{{ $puspem->id_desa }}" onclick="showBatasDesa('{{$data->id}}')">{{ $puspem->desa->nama }}</option>
                                                @else
                                                    @if ($data->batas_wilayah == NULL)
                                                        <option value="" disabled>{{ $data->nama }}</option>
                                                    @else
                                                        <option value="{{ $data->id }}" onclick="showBatasDesa('{{$data->id}}')">{{ $data->nama }}</option>
                                                    @endif
                                                @endif
                                            @endforeach
                                        </select>
                                        @error('lokasi_desa')
                                            <div class="invalid-feedback text-start">
                                                {{ $message }}
                                            </div>
                                        @else
                                            <div class="invalid-feedback">
                                                Desa lokasi puspem wajib diisi
                                            </div>
                                        @enderror
                                        <label for="lokasi_desa">Lokasi Desa<span class="text-danger">*</span></label>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-6">
                                    <div class="form-floating mb-3">
                                        <select class="form-select" id="tingkat_pemerintahan" name="tingkat_pemerintahan" name="desa" required>
                                            @if ($puspem->tingkat == 'Pemda')
                                                <option selected value="Pemda">Pemda</option>
                                                <option value="Pemkab">Pemkab</option>
                                                <option value="Pemprov">Pemprov</option>
                                            @endif
                                            @if ($puspem->tingkat == 'Pemkab')
                                                <option value="Pemda">Pemda</option>
                                                <option selected value="Pemkab">Pemkab</option>
                                                <option value="Pemprov">Pemprov</option>
                                            @endif
                                            @if ($puspem->tingkat == 'Pemprov')
                                                <option value="Pemda">Pemda</option>
                                                <option value="Pemkab">Pemkab</option>
                                                <option selected value="Pemprov">Pemprov</option>
                                            @endif
                                        </select>
                                        @error('tingkat_pemerintahan')
                                            <div class="invalid-feedback text-start">
                                                {{ $message }}
                                            </div>
                                        @else
                                            <div class="invalid-feedback">
                                                Tingkat pemerintahan wajib diisi
                                            </div>
                                        @enderror
                                        <label for="tingkat_pemerintahan">Tingkat Pemerintahan<span class="text-danger">*</span></label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 col-md-6">
                                    <div class="mb-3">
                                        <label for="latPuspem" class="form-label">Koordinat Latitude<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control disabled" id="latPuspem" name="latPuspem" placeholder="Koordinat latitude pusat pemerintahan" value="{{ old('latPuspem', $puspem->lat) }}" required readonly>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-6">
                                    <div class="mb-3">
                                        <label for="lngPuspem" class="form-label">Koordinat Longitude<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="lngPuspem" name="lngPuspem" placeholder="Koordinat longitude pusat pemerintahan" value="{{ old('lngPuspem', $puspem->lng) }}" required readonly>
                                    </div>
                                </div>
                                @if ($errors->has('lngPuspem') && $errors->has('latPuspem'))
                                    <p class="text-end text-danger">Lokasi pusat pemerintahan pada peta wajib ditentukan</p>
                                @endif
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="mb-3">
                                        <label for="alamat" class="form-label">Alamat Pusat Pemerintahan<span class="text-danger">*</span></label>
                                        <textarea class="form-control @error('alamat') is-invalid @enderror" id="alamat" placeholder="Masukan alamat pusat pemerintahan" name="alamat" style="height: 60px" required>{{ old('alamat', $puspem->alamat ) }}</textarea>
                                        @error('alamat')
                                            <div class="invalid-feedback text-start">
                                                {{ $message }}
                                            </div>
                                        @else
                                            <div class="invalid-feedback">
                                                Alamat pusat pemerintahan wajib diisi
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 text-right">
                                    <a data-bs-toggle="modal" data-bs-target="#detailFoto" class="card-title btn btn-sm btn-primary">
                                        <i class="fas fa-image"></i>
                                        <span class="border-end mx-2"></span>
                                        Ganti Foto Puspem
                                    </a>
                                    <button type="submit" class="btn btn-sm btn-outline-success">Simpan Pembaharuan Data</button>
                                </div>
                            </div>
                            <div class="row">
                                <span class="text-danger text-end">* Data wajib diisi</span>
                            </div>
                        </form>
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
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js" integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
    crossorigin="anonymous"></script>
    <script src="https://unpkg.com/@geoman-io/leaflet-geoman-free@latest/dist/leaflet-geoman.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function(){
            $('#list-potensi-desa').addClass('menu-is-opening menu-open');
            $('#potensi-desa').addClass('active');
            $('#pusat-pemerintahan').addClass('active');
            document.getElementById('labelFoto').innerHTML='Ganti Foto Pasar';
        });

        $(function () {
            bsCustomFileInput.init();
        });

        $('#inputFoto').on('change', function(event){
            var img = document.getElementById('img_preview');
            img.src = URL.createObjectURL(event.target.files[0]);
            img.onload = function() {
                URL.revokeObjectURL(img.src) // free memory
            }
            $('#img_preview').show();
        });

        $('#closeModal').on('click', function () {
            $(this).find('img').trigger('reset');
            $('#img_preview').attr('src', "{{route('Image Puspem', $puspem->id)}}");
            $("#inputFoto").val('');
            document.getElementById('labelFoto').innerHTML
                = 'Ganti Foto Puspem';
        })

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

        // Memunculkan batas desa (Polyline) dari db bedasarkan id_desa di field
        let desa = {!! json_encode($satuDesa) !!}
        desa.forEach(element => {
            let koor = jQuery.parseJSON(element['batas_wilayah']);
            let pathCoords = makePolygon(koor);
            pathLine = L.polygon(pathCoords, {
                id: element['id'],
                color: element['warna'],
                fillColor: element['warna'],
                fillOpacity: 0.4,
                fillOpacity: 0.4,
                nama: element['nama'],
            }).addTo(mymap);
            mymap.fitBounds(pathLine.getBounds());
        });

        // Inisialisasi Map Icon
        let mapIcon = L.icon({
            iconUrl: "/maps/icon/2",
            iconSize: [27, 27],
            iconAnchor: [16, 16],
            popupAnchor: [0, -8],
        });

        // Menampilkan Marker dari db
        let puspem = {!! json_encode($puspem) !!}
        let marker = L.marker([puspem.lat, puspem.lng], {
            icon: mapIcon,
        }).addTo(mymap);

        marker.dragging.enable();

        marker.on('drag', function(e){
            $('#latPuspem').val(e.target._latlng.lat); // Set field latPuspem dengan nilai lat baru
            $('#lngPuspem').val(e.target._latlng.lng); // Set field lngPuspem dengan nilai lng baru
        });

        // Menampilkan batas desa (Polyline) ketika desa dipilih pada field Lokasi Desa
        function showBatasDesa(desa) {
            let myDesa = {!! json_encode($desa->toArray()) !!}
            myDesa.forEach(element => {
                if(element['id'] == desa){
                    // Menghapus semua Polyline yang ada sebelumnya, sebelum memunculkan Polyline baru
                    for(; Object.keys(mymap._layers).length > 1;) {
                        mymap.removeLayer(mymap._layers[Object.keys(mymap._layers)[1]]);
                    }
                    let koor = jQuery.parseJSON(element['batas_wilayah']);
                    let pathCoords = makePolygon(koor);
                    let pathLine = L.polygon(pathCoords, {
                        id: element['id'],
                        color: element['warna'],
                        fillColor: element['warna'],
                        fillOpacity: 0.4,
                    }).addTo(mymap);
                    mymap.fitBounds(pathLine.getBounds());
                    let puspem = {!! json_encode($puspem) !!}
                    let marker = L.marker([puspem.lat, puspem.lng], {
                        icon: mapIcon,
                    }).bindPopup().addTo(mymap);
                    marker.dragging.enable();
                    marker.on('drag', function(e){
                        $('#latPuspem').val(e.target._latlng.lat); // Set field latPuspem dengan nilai lat baru
                        $('#lngPuspem').val(e.target._latlng.lng); // Set field lngPuspem dengan nilai lng baru
                    });
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
    </script>

    @if ($errors->has('foto'))
        <script type="text/javascript">
            $( document ).ready(function() {
                $('#detailFoto').modal('show');
                $('#img_preview').hide();
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
