@extends('layouts/admin/admin-layout')

@push('css')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A==" crossorigin="anonymous"/>

    <style>
        #mapid { height: 67vh; }
    </style>
@endpush

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h3 col-lg-auto text-center text-md-start">Dashboard</h1>
        <div class="col-auto ml-auto text-right mt-n1">
            <nav aria-label="breadcrumb text-center">
                <ol class="breadcrumb bg-transparent p-0 mt-1 mb-0">
                    <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ route('Dashboard Admin') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Potensi Desa</li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="card">
        <div class="card-body" id="mapid"></div>
    </div>
    @include('modal/info-desa')  
@endsection

@push('js')
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js" integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA==" crossorigin="anonymous"></script>

    <script type="text/javascript">
        $(document).ready(function(){
            $('#admin-dashboard').addClass('menu-open');
            $('#dashboard').addClass('active');
        });
    </script>

    <script>
        let mymap = L.map('mapid', { zoomControl: false }).setView([-8.477003, 115.0407526], 10);

        L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
            attribution: 'Sistem Informasi Geografis Potensi Desa &copy; {{ date('Y', strtotime(date('Y-m-d H:i:s'))) }}',
            maxZoom: 18,
            minZoom: 1,
            id: 'mapbox/streets-v11',
            tileSize: 512,
            zoomOffset: -1,
            accessToken: 'pk.eyJ1IjoiZGVkeWR3aXZhIiwiYSI6ImNra3NheDBkaDB6NXMyeG54ODZqdXlnbGUifQ.9OCiV7iAva0iXlZu-HZUkQ'
        }).addTo(mymap);

        L.control.zoom({
            position: 'bottomright'
        }).addTo(mymap);

        var desa = {!! json_encode($desa->toArray()) !!}
        desa.forEach(element => {
            var koor = jQuery.parseJSON(element['batas_wilayah']);
            var id = jQuery.parseJSON(element['id']);
            var pathCoords = makePolygon(koor);
            var pathLine = L.polygon(pathCoords, {
                id: element['id'],
                color: element['warna'],
                fillColor: element['warna'],
                fillOpacity: 0.4,
                fillOpacity: 0.4,
                nama: element['nama'],
            }).addTo(mymap);

            pathLine.on('click', function(e) {
                $('#detailDesa').modal('show');
                $("#nama_desa").val(element['nama']);
            } );
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


        // Inisialisasi Map Icon
        let pasarIcon = L.icon({
            iconUrl: "/maps/icon/1",
            iconSize: [27, 27],
            iconAnchor: [16, 16],
            popupAnchor: [0, -8],
        });
        let puspemIcon = L.icon({
            iconUrl: "/maps/icon/2",
            iconSize: [27, 27],
            iconAnchor: [16, 16],
            popupAnchor: [0, -8],
        });
        let sekolahIcon = L.icon({
            iconUrl: "/maps/icon/3",
            iconSize: [27, 27],
            iconAnchor: [16, 16],
            popupAnchor: [0, -8],
        });
        let tempatIbadahIcon = L.icon({
            iconUrl: "/maps/icon/4",
            iconSize: [27, 27],
            iconAnchor: [16, 16],
            popupAnchor: [0, -8],
        });


        // Menampilkan Marker dari db
        let pasar = {!! json_encode($pasar) !!}
        pasar.forEach(element => {
            let markerPasar = L.marker([element.lat, element.lng], {
                icon: pasarIcon,
            }).bindPopup().addTo(mymap);
            var msgPasar = "<ul class='list-unstyled'><li class='fw-bold text-center mb-2'>"+element['nama']+"</li><li>Desa: "+element['nama_desa']+"</li><li>Alamat: "+element['alamat']+"</li><li><a class='text-decoration-none text-dark' target='_blank' href='https://www.google.com/maps/place/"+element['lat']+","+element['lng']+"''><i class='fas fa-map-marked-alt'></i> Lihat di Gmaps</a></li></ul>"
            markerPasar.bindPopup(msgPasar);
            markerPasar.on('click', function() {
                markerPasar.openPopup();
            });
        });
        let puspem = {!! json_encode($puspem) !!}
        puspem.forEach(element => {
            let markerPuspem = L.marker([element.lat, element.lng], {
                icon: puspemIcon,
            }).bindPopup().addTo(mymap);
            var msgPuspem = "<ul class='list-unstyled'><li class='fw-bold text-center mb-2'>"+element['nama']+"</li><li>Desa: "+element['nama_desa']+"</li><li>Tingkat: "+element['tingkat']+"</li><li>Alamat: "+element['alamat']+"</li><li><a class='text-decoration-none text-dark' target='_blank' href='https://www.google.com/maps/place/"+element['lat']+","+element['lng']+"''><i class='fas fa-map-marked-alt'></i> Lihat di Gmaps</a></li></ul>"
            markerPuspem.bindPopup(msgPuspem);
            markerPuspem.on('click', function() {
                markerPuspem.openPopup();
            });
        });
        let sekolah = {!! json_encode($sekolah) !!}
        sekolah.forEach(element => {
            let markerSekolah = L.marker([element.lat, element.lng], {
                icon: sekolahIcon,
            }).bindPopup().addTo(mymap);
            var msgSekolah = "<ul class='list-unstyled'><li class='fw-bold text-center mb-2'>"+element['nama']+"</li><li>Desa: "+element['nama_desa']+"</li><li>Jenjang: "+element['jenjang']+"</li><li>Jenis Sekolah: "+element['jenis_sekolah']+"</li><li>Alamat: "+element['alamat']+"</li><li><a class='text-decoration-none text-dark' target='_blank' href='https://www.google.com/maps/place/"+element['lat']+","+element['lng']+"''><i class='fas fa-map-marked-alt'></i> Lihat di Gmaps</a></li></ul>"
            markerSekolah.bindPopup(msgSekolah);
            markerSekolah.on('click', function() {
                markerSekolah.openPopup();
            });
        });
        let tempatIbadah = {!! json_encode($tempatIbadah) !!}
        tempatIbadah.forEach(element => {
            let markerTempatIbadah = L.marker([element.lat, element.lng], {
                icon: sekolahIcon,
            }).bindPopup().addTo(mymap);
            var msgTempatIbadah = "<ul class='list-unstyled'><li class='fw-bold text-center mb-2'>"+element['nama']+"</li><li>Desa: "+element['nama_desa']+"</li><li>Ibadat Umat: "+element['agama']+"</li><li>Alamat: "+element['alamat']+"</li><li><a class='text-decoration-none text-dark' target='_blank' href='https://www.google.com/maps/place/"+element['lat']+","+element['lng']+"''><i class='fas fa-map-marked-alt'></i> Lihat di Gmaps</a></li></ul>"
            markerTempatIbadah.bindPopup(msgTempatIbadah);
            markerTempatIbadah.on('click', function() {
                markerTempatIbadah.openPopup();
            });
        });
    </script>
@endpush
