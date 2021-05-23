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
        }
        .test{
            left: 0;
            margin-right: -100px;
            position: relative;
            float: left;
            z-index: 2;
        }
        #mapid { 
            z-index: 1;
            height:100vh;
         }
    </style>
<body class="bg-dark">
</head>
    {{-- <ul class="nav justify-content-end navbar-light fixed-top">
        <li class="nav-item dropdown me-4">
            <a class="nav-link link-dark" data-bs-toggle="dropdown">
                <svg xmlns="http://www.w3.org/1000/svg" width="20" height="20" fill="currentColor" class="bi bi-grid-3x3-gap-fill" viewBox="0 0 16 16">
                    <path d="M1 2a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2zm5 0a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V2zm5 0a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1h-2a1 1 0 0 1-1-1V2zM1 7a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V7zm5 0a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V7zm5 0a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1h-2a1 1 0 0 1-1-1V7zM1 12a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1v-2zm5 0a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1v-2zm5 0a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1h-2a1 1 0 0 1-1-1v-2z"/>
                </svg>
            </a>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                <div class="text-center"><a class="text-decoration-none link-dark" href="{{ route('Login Form') }}">Masuk</a></div>
            </ul>
        </li>
    </ul> --}}
    <div class="container-map">
        <div class="row p-0 m-0">
            <div class="col-12 p-0" id="main">
                    <div class="row test">
                        <div class="col-12 overflow-auto bg-light" id="sidebar" style="height: 100vh; width:400px">
                            <div class="card-body mx-auto">
                                <button type="button" class="btn-close" aria-label="Close" style="float: right" onclick="hideSidebar()" id="tombolhide"></button>
                                <img class="card-img-top mt-2" id="img_preview" src="" alt="">
                                <p class="text-center" id="loader">Silahkan Tunggu ...</p>
                                <div class="form-floating mt-2 mb-3" id="formNama">
                                    <input type="text" class="form-control" id="nama" value="Nama Objectnya" >
                                    <label>Nama Potensi Desa</label>
                                </div>
                                <div class="form-floating mt-2 mb-3" id="formJenjang">
                                    <input type="text" class="form-control" id="jenjang" value="Janjang Sekolah" >
                                    <label>Jenjang</label>
                                </div>
                                <div class="form-floating mt-2 mb-3" id="formJenis">
                                    <input type="text" class="form-control" id="jenis" value="Jenis Sekolah" >
                                    <label>Jenis Sekolah</label>
                                </div>
                                <div class="form-floating mt-2 mb-3" id="formTingkat">
                                    <input type="text" class="form-control" id="tingkat" value="Tingkat Pemerintahan" >
                                    <label>Tingkat</label>
                                </div>
                                <div class="form-floating mt-2 mb-3" id="formAgama">
                                    <input type="text" class="form-control" id="agama" value="Umat Agama" >
                                    <label>Umat Agama</label>
                                </div>
                                <div class="form-floating mt-2 mb-3" id="formAlamat">
                                    <textarea class="form-control" id="alamat" style="height: 200px"></textarea>
                                    <label>Alamat</label>
                                </div>
                                <div class="form-floating mt-2 mb-3" id="linkGmaps">
                                    <a class='text-decoration-none text-dark' id="gmaps" target='_blank' href=""><i class='fas fa-map-marked-alt'></i> Lihat di Gmaps</a>
                                </div>
                            </div>
                        </div>
                    </div>
                <div class="" id="mapid"></div>
            </div>
        </div>
    </div>
    @include('modal/info-desa') 

    <script src="{{asset('admin-template/plugins/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('admin-template/plugins/jquery-ui/jquery-ui.min.js')}}"></script>
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
    integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
    crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>

    <script>
        let mymap = L.map('mapid', { zoomControl: false }).setView([-8.477003, 115.0407526], 10);
        let markerPasar, markerPuspem, markerSekolah, markerTempatIbadah;

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

        $("#tombolhide").show();
        $("#sidebar").hide();
        $("#formNama").hide();
        $("#formAlamat").hide();
        $("#formJenjang").hide();
        $("#formJenis").hide();
        $("#formTingkat").hide();
        $("#formAgama").hide();
        $("#linkGmaps").hide();
        $("#loader").hide();
        showBatasDesa();
        mymap.invalidateSize()

        function showSidebar() {
            $("#sidebar").show();
        }
        
        function hideSidebar() {
            $("#sidebar").hide();
        }

        function showBatasDesa() {
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
                });
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
        function showMarkerPasar() {
            let pasar = {!! json_encode($pasar) !!}
            pasar.forEach(element => {
                markerPasar = L.marker([element.lat, element.lng], {
                    icon: pasarIcon,
                }).addTo(mymap);
                markerPasar.on('click', function() {
                    $('#img_preview').hide();
                    $("#formTingkat").hide();
                    $('#formJenjang').hide();
                    $('#formJenis').hide();
                    $('#formAgama').hide();
                    $("#loader").show();
                    $("#formNama").hide();
                    $("#formAlamat").hide();
                    $("#linkGmaps").hide();
                    showSidebar();
                    setTimeout(function(){
                        $('#img_preview').attr('src', "/pasar/getImg/"+element['id']);
                        $("#nama").val(element['nama']);
                        $("#alamat").val(element['alamat']);
                        $("#gmaps").prop("href", "https://www.google.com/maps/place/"+element['lat']+","+element['lng']+"");
                        $('#img_preview').show();
                        $("#loader").hide();
                        $('#formNama').show();
                        $('#formAlamat').show();
                        $('#linkGmaps').show();
                    }, 2000);
                });
            });
        }

        function showMarkerPuspem() {
            let puspem = {!! json_encode($puspem) !!}
            puspem.forEach(element => {
                markerPuspem = L.marker([element.lat, element.lng], {
                    icon: puspemIcon,
                }).addTo(mymap);
                markerPuspem.on('click', function() {
                    $('#img_preview').hide();
                    $("#formTingkat").hide();
                    $('#formJenjang').hide();
                    $('#formJenis').hide();
                    $("#formNama").hide();
                    $("#formAlamat").hide();
                    $("#linkGmaps").hide();
                    $("#loader").show();
                    showSidebar();
                    setTimeout(function(){
                        $('#img_preview').attr('src', "/pusat-pemerintahan/getImg/"+element['id']);
                        $("#nama").val(element['nama']);
                        if (element['tingkat'] == 'Pemda') {
                            $("#tingkat").val('Pemerintah Daerah');
                        }
                        if (element['tingkat'] == 'Pemkot') {
                            $("#tingkat").val('Pemerintah Kabupaten/Kota');
                        }
                        if (element['tingkat'] == 'Pemprov') {
                            $("#tingkat").val('Pemerintah Provinsi');
                        }
                        $("#alamat").val(element['alamat']);
                        $("#gmaps").prop("href", "https://www.google.com/maps/place/"+element['lat']+","+element['lng']+"");
                        $('#img_preview').show();
                        $("#loader").hide();
                        $('#formNama').show();
                        $('#formTingkat').show();
                        $('#formAlamat').show();
                        $("#linkGmaps").show();
                    }, 2000);
                    // mymap.panBy([-450, 0]);
                });
            });
        }

        function showMarkerSekolah(params) {
            let sekolah = {!! json_encode($sekolah) !!}
            sekolah.forEach(element => {
                markerSekolah = L.marker([element.lat, element.lng], {
                    icon: sekolahIcon,
                }).addTo(mymap);
                markerSekolah.on('click', function() {
                    $('#img_preview').hide();
                    $("#formTingkat").hide();
                    $('#formJenjang').hide();
                    $('#formJenis').hide();
                    $("#formNama").hide();
                    $("#formAlamat").hide();
                    $("#linkGmaps").hide();
                    $("#loader").show();
                    showSidebar();
                    setTimeout(function(){
                        $('#img_preview').attr('src', "/sekolah/getImg/"+element['id']);
                        $("#nama").val(element['nama']);
                        $("#jenjang").val(element['jenjang']);
                        $("#jenis").val(element['jenis']);
                        $("#alamat").val(element['alamat']);
                        $("#gmaps").prop("href", "https://www.google.com/maps/place/"+element['lat']+","+element['lng']+"");
                        $('#img_preview').show();
                        $("#loader").hide();
                        $('#formNama').show();
                        $('#formJenis').show();
                        $('#formJenjang').show();
                        $('#formAlamat').show();
                        $("#linkGmaps").show();
                    }, 2000);
                });
            });
        }

        function showMarkerTempatIbadah(params) {
            let tempatIbadah = {!! json_encode($tempatIbadah) !!}
            tempatIbadah.forEach(element => {
                markerTempatIbadah = L.marker([element.lat, element.lng], {
                    icon: tempatIbadahIcon,
                }).addTo(mymap);
                markerTempatIbadah.on('click', function() {
                    $('#img_preview').hide();
                    $("#formTingkat").hide();
                    $('#formJenjang').hide();
                    $('#formJenis').hide();
                    $('#formAgama').hide();
                    $("#formNama").hide();
                    $("#formAlamat").hide();
                    $("#linkGmaps").hide();
                    $("#loader").show();
                    showSidebar();
                    setTimeout(function(){
                        $('#img_preview').attr('src', "/tempat-ibadah/getImg/"+element['id']);
                        $("#nama").val(element['nama']);
                        $("#agama").val(element['agama']);
                        $("#alamat").val(element['alamat']);
                        $("#gmaps").prop("href", "https://www.google.com/maps/place/"+element['lat']+","+element['lng']+"");
                        $('#img_preview').show();
                        $("#loader").hide();
                        $('#formNama').show();
                        $('#formAgama').show();
                        $('#formAlamat').show();
                        $("#linkGmaps").show();
                    }, 2000);
                });
            });
        }

        
        // Fungsi untuk show/hide Marker ketika Zoomend
        mymap.on('zoomend' , function (e) {
            if (mymap.getZoom()<12)
            {
                for(; Object.keys(mymap._layers).length > 2;) {
                    mymap.removeLayer(mymap._layers[Object.keys(mymap._layers)[2]]);
                }
                showBatasDesa();
            } else {
                for(; Object.keys(mymap._layers).length > 1;) {
                    mymap.removeLayer(mymap._layers[Object.keys(mymap._layers)[1]]);
                }
                showBatasDesa();
                showMarkerPasar();
                showMarkerPuspem();
                showMarkerSekolah();
                showMarkerTempatIbadah();
            }
        });
    </script>
</body>
</html>