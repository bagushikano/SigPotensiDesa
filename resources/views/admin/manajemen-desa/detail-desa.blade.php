@extends('layouts/admin/admin-layout')

@push('css')
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
        <h1 class="h3 col-lg-auto text-center text-md-start">Detail Desa</h1>
        <div class="col-auto ml-auto text-right mt-n1">
            <nav aria-label="breadcrumb text-center">
                <ol class="breadcrumb bg-transparent p-0 mt-1 mb-0">
                    <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ route('Manajemen Desa') }}">Manajemen Desa</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Detail</li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="container-fluid p-0">
        <div class="row">
            <div class="col-sm-12 col-md-8 order-2 order-md-1">
                <div class="card">
                    <div class="card-header my-auto">
                        <p class="my-auto">Peta Desa</p>
                    </div>
                    <div class="card-body">
                        <div id="mapid"></div>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-4 order-1 order-md-2">
                <div class="card">
                    <div class="card-header my-auto">
                        <p class="my-auto">Data Desa</p>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('Update Desa', $desa->id) }}" method="POST" class="needs-validation" novalidate>
                            @csrf
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control @error('nama_desa') is-invalid @enderror" id="nama_desa" name="nama_desa" placeholder="Masukan nama desa" value="{{ old('nama_desa', $desa->nama) }}" autocomplete="off" required>
                                <label for="nama_desa">Nama Desa</label>
                                @error('nama_desa')
                                    <div class="invalid-feedback text-start">
                                        {{ $message }}
                                    </div>
                                @else
                                    <div class="invalid-feedback">
                                        Nama desa wajib diisi
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="warna">Warna Batas Desa</label>
                                @if ($desa->warna == NULL)
                                    <input type="color" class="form-control" id="warna" name="warna" value="#3FA7DD">
                                @else
                                    <input type="color" class="form-control" id="warna" name="warna" value="{{ $desa->warna }}">
                                @endif
                            </div>
                            <div class="mb-3">
                                <label for="batas_desa" class="form-label">Koordinat Batas Desa</label>
                                <textarea class="form-control @error('batas_wilayah') is-invalid @enderror" id="batas_desa" placeholder="Silahkan buat batas desa" name="batas_wilayah" style="height: 200px" required readonly>{{ old('batas_wilayah', $desa->batas_wilayah ) }}</textarea>
                                @error('batas_wilayah')
                                    <div class="invalid-feedback text-start">
                                        {{ $message }}
                                    </div>
                                @else
                                    <div class="invalid-feedback">
                                        Batas desa wajib diisi
                                    </div>
                                @enderror
                            </div>
                            <div class="text-right">
                                <a href="{{ route('Manajemen Desa') }}" class="btn btn-sm btn-outline-danger" >Batal</a>
                                <button type="submit" class="btn btn-sm btn-outline-success">Simpan Data</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
    integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
    crossorigin="anonymous"></script>
    <script src="https://unpkg.com/@geoman-io/leaflet-geoman-free@latest/dist/leaflet-geoman.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function(){
            $('#admin-manajemen-desa').addClass('menu-open');
            $('#manajemen-desa').addClass('active');
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

        // Menambahkan tombol controll dari Leaflet-Geoman
        mymap.pm.addControls({  
            position: 'topleft',
            drawCircle: false,
            drawMarker: false,
            rotateMode: false,
            editMode: false,
            drawCircleMarker:false,
            drawRectangle: false,
            drawPolygon: false,
            drawPolyline: false,
            dragMode:false,
            cutPolygon: false,
        });

        // Memunculkan menu tambah Polyline untuk membuat batas desa
        // ketika Koordinat batas desa kosong
        if ($('#batas_desa').val() === '') {
            mymap.pm.addControls({
                drawPolyline: true,
            });
        }

        // Menambahkan tombol controller zoom in out
        L.control.zoom({
            position: 'bottomright'
        }).addTo(mymap);

        let line = [];
        let koordinat = {};

        // Menampilkan batas desa (Polyline) dari db
        let batas = {!! json_encode($desa) !!}
        let koor = jQuery.parseJSON(batas['batas_wilayah']);
        let pathCoords = makePolygon(koor);
        let pathLine = L.polygon(pathCoords, {
            color: batas['warna'],
            fillColor: batas['warna'],
            fillOpacity: 0.4,
        }).addTo(mymap);

        // Digunakan ketika ada polyline baru yang dibuat
        mymap.on('pm:create', ({ layer }) => {
            $("#batas_desa").val(JSON.stringify(layer._latlngs));
            mymap.pm.addControls({
                drawPolyline: false,
                editMode: true,
            });
            // Dijalankan ketika polyline yang baru dibuat itu di geser
            layer.on('pm:update', e => {
                console.log(e.layer._latlngs);
                $("#batas_desa").val(JSON.stringify(e.layer._latlngs));
            });
            // Dijalankan ketika polyline yang baru dibuat itu di hapus
            mymap.on('pm:remove', e => {
                $('#batas_desa').val("");
            });
        });

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

        // Digunakan untuk tracking pergeseran Polyline yg telah dibuat ketika di edit
        pathLine.on('pm:update', e => {
            let koordinats = e.layer._latlngs;
            let koordinat = {};
            line = [];
            koordinats.forEach(function(latlng){
                for(let m = 0; m<latlng.length; m++){
                    line.push(
                        latlng[m]
                    )
                }
            });
            $("#batas_desa").val(JSON.stringify(line));
        });

        // Berfungsing ketika Polyline di hapus
        mymap.on('pm:remove', e => {
            var id = e.layer.options.id;
            $('#batas_desa').val("");
            mymap.pm.addControls({
                drawPolyline: true,
                editMode: false,
            });
            $("#warna").val('#3FA7DD');
        });

        if ($("#batas_desa").val() != '') {
            mymap.pm.addControls({
                editMode: true,
            });
        }

        // JS bawaan dari Bootstrap 5 untuk melakukan realtime validation ketika form required
        (function () {
            'use strict'
            var forms = document.querySelectorAll('.needs-validation')
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
    </script>

    @if (count($errors) > 0)
        <script type="text/javascript">
            $('#batas_desa').val('');
        </script>
    @endif

    @if($message = Session::get('failed'))
        <script>
            $(document).ready(function(){
                alertDanger('{{$message}}');
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
@endpush
