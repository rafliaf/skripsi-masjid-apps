@extends('layout.main-auth')

@section('container')
<link rel="stylesheet" href="assets/auth/css/register.css">
 <!-- Include Bootstrap CSS -->
 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

 <!-- Include jQuery -->
 <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

 <!-- Include Bootstrap JS -->
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<div class="row justify-content-center mt-4">
    <div class="col-md-6">
        <main class="form-registration">
            <form action="/register" method="post">
                @csrf
                <img class="mb-4 rounded mx-auto d-block" src="assets/auth/img/logo_profile.jpg" alt="" width="120" height="120">
                <h1 class="h3 mb-3 fw-normal text-center">Form Pendaftaran</h1>
                <div class="form-group">
                    <label for="nama_masjid">Nama masjid</label>
                    <input type="text" name="nama_masjid" class="form-control @error('nama_masjid') is-invalid @enderror" id="nama_masjid" value="{{ old('nama_masjid') }}" autofocus required>
                    @error('nama_masjid')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="form-group mt-3">
                    <label for="alamat_masjid">Alamat</label>
                    <textarea type="text" name="alamat_masjid" class="form-control @error('alamat_masjid') is-invalid @enderror" id="alamat_masjid" style="height: 100px" required>{{ old('alamat_masjid') }}</textarea>
                    @error('alamat_masjid')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="form-group mt-3">
                    <label for="email">Email</label>
                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="email" value="{{ old('email') }}" required>
                    @error('email')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
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
                <button class="w-100 btn btn-lg btn-primary mt-3" type="submit">Daftar</button>
            </form>

            <!-- Modal menunggu verifikasi -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content custom-modal-content">
                        <div class="modal-body text-center">
                            <div class="custom-icon-alert">
                                <i class="bi bi-exclamation-circle"></i>    
                            </div>
                            <div class="custom-text">
                                Akun masjid dalam tahap verifikasi mohon tunggu
                            </div>
                            <div class="mt-3">
                                <button type="button" class="btn btn-warning" onclick="onClickNext()">Selanjutnya</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal berhasil verifikasi -->
            <div class="modal fade" id="nextModal" tabindex="-1" aria-labelledby="nextModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content custom-modal-content">
                        <div class="modal-body text-center">
                            <div class="custom-icon-check">
                                <i class="bi bi-check-circle"></i>    
                            </div>
                            <div class="custom-text">
                                Akun Berhasil di verifikasi
                            </div>
                            <div class="custom-text-body">
                                Silahkan login
                            </div>
                            <div class="mt-3">
                                <button type="button" class="btn btn-success" onclick="onCloseModal()">Tutup</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <small class="d-block text-center mt-4 mb-2">Sudah Punya Akun? Silahkan <a href="login">Login</a></small>
        </main>
    </div>
</div>

@if(session('registration_success'))
<script>
    $(document).ready(function() {
        $('#exampleModal').modal('show');
    });
</script>
@endif

<script>
    function onClickNext() {
        $('#exampleModal').modal('hide');
        $('#exampleModal').on('hidden.bs.modal', function () {
            $('#nextModal').modal('show');
        });
    }

    function onCloseModal(){
        $('#nextModal').modal('hide').on('hidden.bs.modal', function () {
            window.location.href = '/login';
        });
    }

    function myFunction() {
        var x = document.getElementById("myInput");
        if (x.type === "password") {
            x.type = "text";
        } else {
            x.type = "password";
        }
    }
</script>
@endsection
