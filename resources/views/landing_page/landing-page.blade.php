@extends('layout.main-auth')

{{-- HERO --}}
@section('container')
    <div class="hero vh-100 d-flex align-items-center">
        <div class="container">
            <div class="row">
                <div class="col-lg-7 mx-auto text-center">
                    <h1 class="display-5 fw-bold text-white">Daftarkan Masjid Anda Sekarang</h1>
                    <p class="text-white my-4">Lorem ipsum dolor sit amet consectetur adipisicing elit. Quos libero officia,
                        fuga quibusdam nam perspiciatis nulla nemo reprehenderit odio quis cumque possimus, voluptate dolor
                        sed quia mollitia impedit sunt quae.</p>
                    <a href="register" class="btn btn-primary">Daftar</a>
                    <a href="login" class="btn btn-outline-light">Login</a>
                </div>
            </div>
        </div>
    </div>
@endsection
