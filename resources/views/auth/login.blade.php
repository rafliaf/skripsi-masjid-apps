@extends('layout.main-auth')

@section('container')
{{-- style login masjid --}}
<link rel="stylesheet" href="assets/auth/css/login.css">
 <!-- Include Bootstrap CSS -->
 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

 <!-- Include jQuery -->
 <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

 <!-- Include Bootstrap JS -->
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    {{-- alert --}}
    @if (session()->has('loginError'))
        <div class="row justify-content-center mt-4">
            <div class="col-md-6 alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('loginError') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>  
        </div>
    @endif

<div class="row justify-content-center mt-4">
        <div class="col-md-6">
            <main class="form-registration">
                <form action="/login" method="post">
                    @csrf
                    <img class="mb-4 rounded mx-auto d-block" src="assets/auth/img/logo_profile.jpg" alt="" width="120"
                        height="120">
                    <h1 class="h3 mb-3 fw-normal text-center">Form Login</h1>
                    {{-- email --}}
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="email" value="{{ old('email') }}" required>
                        @error('email')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    {{-- password --}}
                    <div class="form-group mt-3">
                        <label for="password">Kata sandi</label>
                        <input type="password" name="password" class="form-control rounded-bottom @error('password') is-invalid @enderror" id="myInput" required>
                        @error('password')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="mb-2 mt-2 form-check">
                        <input id="tampilPassword" type="checkbox" class="form-check-input" onclick="myFunction()">
                        <label class="form-check-label" for="tampilPassword">Tampilkan password</label>
                    </div>
                    <button class="w-100 btn btn-lg btn-primary mt-3" type="submit">Login </button>
                    <div class="divider d-flex align-items-center my-4">
                        <p class="text-center fw-bold mx-3 mb-0 text-muted">Atau</p>
                    </div>
                </form>
                {{-- login google --}}
                <a href="{{ route('oauth.google') }}" style="color:white; text-decoration:none;">
                    <button class="w-100 btn btn-lg btn-danger mt-3">
                        <i class="fa-brands fa-google-plus-g" style="margin-right: 5px">
                        </i> 
                        Login dengan google
                    </button>
                </a>
           
                <small class="d-block text-center mt-4 mb-2">Belum Punya Akun? Silahkan <a href="register" style="text-decoration: none">Daftar</a></small>
                <div class="w-full text-center p-t-27 p-b-239">
                    @if (session('alert'))
                        <div class="alert alert-danger alert-dismissible" role="alert">
                            {{--  {{ session('alert') }}  --}}
                            <button type="button" class="close" data-dismiss="alert">
                                <i class="fa fa-times"></i>
                            </button>
                            <strong>{{ session('alert') }}</strong>
                        </div>
                    @endif
                </div>
            </main>
        </div>
    </div>

    <script>

    function myFunction() {
        var x = document.getElementById("myInput");
        if (x.type === "password") {
            x.type = "text";
        } else {
            x.type = "password";
        }
    }
    </script>
    {{-- javascript register masjid --}}
    <script src="assets/auth/js/register.js">
    </script>
@endsection
