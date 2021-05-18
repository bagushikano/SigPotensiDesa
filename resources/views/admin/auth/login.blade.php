<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    {{-- <link rel="icon" type="image/png" href="{{ asset('images/sipandu-logo.ico') }}"> --}}
    <title>Login Admin</title>

    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('admin-template/plugins/fontawesome-free/css/all.min.css')}}">
    <link rel="stylesheet" href="{{asset('admin-template/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('admin-template/dist/css/adminlte.min.css')}}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">

    <style>
        html, body {
            font-family: 'Nunito', sans-serif;
            font-weight: 300;
        }
    </style>
</head>
<body class="hold-transition login-page">
    <div class="login-box">
        <div class="card card-outline card-primary">
            <div class="card-header bg-white text-center">
                <img class="rounded mx-auto d-block" src="..." alt="sipandu logo" width="100" height="100">
                <a href="" class="text-decoration-none h4 fw-bold">Pemetaan Potensi Desa</a>
                <p class="login-box-msg mb-0 pb-0 px-0 pb-3 fw-bold h6">Selamat Datang Admin</p>
            </div>
            <div class="card-body">
                <p class="text-center pb-2 fs-6">Silakan login untuk mengelola sistem</p>
                @if (session('message'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{session('message')}}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                <form action="{{ route('Login') }}" method="post" id="form">
                    @csrf
                    <div class="input-group mb-3">
                        <input name="username" type="text" class="form-control @error('username') is-invalid @enderror" placeholder="username" value="{{ old('username') }}" autocomplete="off">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-key"></span>
                            </div>
                        </div>
                        @error('username')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="input-group mb-3">
                        <input name="password" type="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password" id="password" autocomplete="off">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="row mb-3">
                        <div class="col-8">
                            <div class="icheck-primary">
                                <input type="checkbox" name="show-hide" id="show-hide">
                                <label for="show-hide">Tampilkan Password</label>
                            </div>
                        </div>
                        <div class="col-4">
                            <button type="submit" class="btn btn-outline-primary btn-block">Masuk</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="text-center mt-2 mb-0">
                <a href="{{ route('Landing Page') }}" class="nav-link link-dark">Potensi Desa &copy {{ date('Y', strtotime(date('Y-m-d H:i:s'))) }}</a>
            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="{{asset('admin-template/plugins/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('admin-template/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('admin-template/dist/js/adminlte.js')}}"></script>

    <script>
        (function() {
            var showHide = function( element, field ) {
                this.element = element;
                this.field = field;
                this.toggle();    
            };
            showHide.prototype = {
                toggle: function() {
                    var self = this;
                    self.element.addEventListener( "change", function() {
                        if(self.element.checked) {self.field.setAttribute( "type", "text" );}
                        else {self.field.setAttribute( "type", "password" );}
                    }, false);
                }
            };
            document.addEventListener( "DOMContentLoaded", function() {
                var checkbox = document.querySelector( "#show-hide" ),
                password = document.querySelector( "#password" ),
                form = document.querySelector( "#form" );
                var toggler = new showHide( checkbox, password );
            });
        })();
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
</body>
</html>
