@extends('layout.main-after-login')

@section('container')
<link rel="stylesheet" href="https://cdn.datatables.net/2.1.3/css/dataTables.dataTables.css"/>
<link rel="stylesheet" href="{{ asset('assets/admin_masjid/css/addUserData.css') }}">
<!-- Include Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Include jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Include Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

        {{-- header --}}
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Tambah Data User</h1>
                        <p class="mt-2">{{ $getData->nama_masjid }}</p>
                    </div>
                    <div class="col-sm-6 mb-3">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item">
                                <a href="#" style="text-decoration: none">Data user</a>
                            </li>
                            <li class="breadcrumb-item active">
                                Tambah data user
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        {{-- content --}}
        <div class="content">
            <div class="container-fluid">
                {{-- <div class="card">
                    <h3 class="p-3">Form User</h3>
                </div> --}}
                <div class="card">
                    {{-- alert success --}}
                    @if (session()->has('success'))
                        <div class="row justify-content-center mt-4">
                            <div class="col-md-8 alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>  
                        </div>
                    @endif
                    <div class="mt-3 p-3 custom-icon">
                        <i class="fas fa-users" style="font-size: 100px;"></i>
                    </div>
                    <form action="/dashboard/tambah_user" method="post" style="margin-top: 20px">
                        @csrf
                        <div class="form-group row justify-content-center">
                            <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                            <div class="col-sm-6">
                                <input name="nama" type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" value="{{ old('nama') }}" placeholder="Nama" required autofocus>
                                @error('nama')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>                        
                        <div class="form-group row justify-content-center">
                            <label for="email" class="col-sm-2 col-form-label">Email</label>
                            <div class="col-sm-6">
                                <input name="email" type="email" class="form-control @error('email') is-invalid @enderror" id="email" value="{{ old('email') }}" placeholder="Email@gmail.com" required>
                                
                                @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>                        
                        <div class="form-group row justify-content-center">
                            <label for="role" class="col-sm-2 col-form-label">Role</label>                       
                            <div class="col-sm-6">
                                <select name="role" class="custom-select form-control @error('role') is-invalid @enderror" id="role" required>
                                    <option hidden disabled selected value="">Pilih role sebagai...</option>
                                    <option value="admin_masjid" {{ old('role') == 'admin_masjid' ? 'selected' : '' }}>Admin masjid</option>
                                    <option value="takmir" {{ old('role') == 'takmir' ? 'selected' : '' }}>Takmir masjid</option>
                                    <option value="remaja_masjid" {{ old('role') == 'remaja_masjid' ? 'selected' : '' }}>Remaja masjid</option>
                                </select>
                        
                                @error('role')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>                                             
                        <div class="text-center mt-3 mb-5">
                            <button type="button" class="col-md-4 btn btn-secondary mr-3" onclick="onClickLocationBack()">Kembali</button>
                            <button type="submit" class="col-md-4 btn btn-primary">Simpan</button>
                        </div>
                    </form>   
                </div>
            </div>
        </div>
        {{-- script --}}
        <script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM=" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/2.1.3/js/dataTables.js"></script>
        <script src="{{ asset('assets/admin_masjid/js/addUserData.js') }}"></script>
@endsection
