<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="{{ asset('logo.png') }}">
    <title>Potensi Desa</title>

    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('admin-template/plugins/fontawesome-free/css/all.min.css')}}">
    <link rel="stylesheet" href="{{asset('admin-template/dist/css/adminlte.min.css')}}">
    <link rel="stylesheet" href="{{asset('admin-template/plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
    @stack('css')

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">

    <style>
        html, body {
            font-family: 'Nunito', sans-serif;
            font-weight: 300;
        }
        .swal-footer {
            text-align: center;
        }
    </style>
</head>
<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed">
    <div class="wrapper">
        {{-- Navbar Start --}}
            @include('layouts/admin/navbar-layout')
        {{-- Navbar End --}}

        {{-- Sidebar Container Start --}}
            @include('layouts/admin/sidebar-layout')
        {{-- Sidebar Container End --}}

        {{-- Content Start --}}
            @include('layouts/admin/content-layout')
        {{-- Content End --}}

        {{-- Footer Start --}}
            @include('layouts/admin/footer-layout')
        {{-- Footer End --}}

        @include('modal/tentang')  
        @include('modal/profile-admin')  
        @include('modal/password-admin')  
        @include('modal/tambah-admin')  
    </div>

    <!-- jQuery -->
    <script src="{{asset('admin-template/plugins/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('admin-template/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('admin-template/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
    <script src="{{asset('admin-template/dist/js/adminlte.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>

    <script>
        function alertSuccess(msg){
          Swal.fire({
            title: "Sukses",
            text: msg,
            icon: "success",
            button: "Ok",
          });
        }

        function alertError(msg){
          Swal.fire({
            title: "Eror",
            text: msg,
            icon: "warning",
            button: "Ok",
          });
        }

        function alertDanger(msg){
          Swal.fire({
            title: "Peringatan",
            text: msg,
            icon: "error",
            button: "Ok",
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

    @stack('js')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
</body>
</html>
