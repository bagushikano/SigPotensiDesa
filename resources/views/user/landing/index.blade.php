<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#7952b3">

    <title>Maps Potensi Desa</title>
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
    integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
    crossorigin="anonymous"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">

    <style>
        html, body {
            font-family: 'Nunito', sans-serif;
            font-weight: 200;
            margin: 0;
            }
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }
        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }
        #mapid { height: 100vh; }
    </style>
</head>
<body>
    <ul class="nav justify-content-end navbar-light fixed-top mt-2">
        <li class="nav-item dropdown me-4">
            <a class="nav-link link-dark" data-bs-toggle="dropdown">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-grid-3x3-gap-fill" viewBox="0 0 16 16">
                    <path d="M1 2a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2zm5 0a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V2zm5 0a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1h-2a1 1 0 0 1-1-1V2zM1 7a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V7zm5 0a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V7zm5 0a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1h-2a1 1 0 0 1-1-1V7zM1 12a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1v-2zm5 0a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1v-2zm5 0a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1h-2a1 1 0 0 1-1-1v-2z"/>
                </svg>
            </a>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                <div class="text-center"><a class="text-decoration-none link-dark" href="{{ route('Login Form') }}">Masuk</a></div>
            </ul>
        </li>
    </ul>
    @include('modal/info-desa') 
    <div id="mapid"></div>

    <script src="{{asset('admin-template/plugins/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('admin-template/plugins/jquery-ui/jquery-ui.min.js')}}"></script>
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
    integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
    crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>

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
</body>
</html>