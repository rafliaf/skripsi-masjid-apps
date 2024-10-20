@extends('layout.main-after-login')

@section('container')
<!-- Include jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<link rel="stylesheet" href="{{ asset('assets/admin_masjid/css/addUserData.css') }}">
    {{-- header --}}
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Tambah Data Kartu Keluarga</h1>
                        <p class="mt-2">{{ $getData->nama_masjid }}</p>
                    </div>
                    <div class="col-sm-6 mb-3">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item">
                                <a href="#">Data kartu keluarga</a>
                            </li>
                            <li class="breadcrumb-item active">
                                Tambah data kartu keluarga
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
                    <div class="mt-3 p-3 custom-icon">
                        <i class="fas fa-users" style="font-size: 100px;"></i>
                    </div>
                    {{-- form --}}
                    <form action="{{ route('data_kk.store') }}" method="POST" style="margin-top: 20px">
                        @csrf
                        <div class="form-group row justify-content-center">
                            <label for="nomor_kk" class="col-md-3 col-form-label">Nomor kartu keluarga</label>
                            <div class="col-sm-6">
                                <input type="number" class="form-control @error('nomor_kk') is-invalid @enderror" value="{{ old('nomor_kk') }}" id="nomor_kk" name="nomor_kk" placeholder="Masukkan nomor kartu keluarga">
                                @error('nomor_kk')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row justify-content-center">
                            <label for="no_rt" class="col-md-3 col-form-label">Nomor RT</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control @error('no_rt') is-invalid @enderror" value="{{ old('no_rt') }}" id="no_rt" name="no_rt" placeholder="Masukkan nomor RT (contoh: RT 01)">
                                @error('no_rt')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row justify-content-center">
                            <label for="nama_kepala_keluarga" class="col-md-3 col-form-label">Nama kepala keluarga</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control @error('nama_kepala_keluarga') is-invalid @enderror" value="{{ old('nama_kepala_keluarga') }}" id="nama_kepala_keluarga" name="nama_kepala_keluarga" placeholder="Masukkan nama kepala keluarga">
                                @error('nama_kepala_keluarga')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row justify-content-center">
                            <label for="kode_rumah" class="col-md-3 col-form-label">Kode rumah</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control @error('kode_rumah') is-invalid @enderror" value="{{ old('kode_rumah') }}" id="kode_rumah" name="kode_rumah" placeholder="Masukkan kode rumah">
                                @error('kode_rumah')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row justify-content-center">
                            <label for="level_ekonomi" class="col-md-3 col-form-label">Level ekonomi</label>
                            <div class="col-sm-6">
                                <select id="level_ekonomi" name="level_ekonomi" class="custom-select @error('level_ekonomi') is-invalid @enderror">
                                    <option value="" hidden>Pilih level ekonomi....</option>
                                    <option value="menengah_ke_atas" {{ old('level_ekonomi') == 'menengah_ke_atas' ? 'selected' : '' }}>Menengah ke atas</option>
                                    <option value="menengah" {{ old('level_ekonomi') == 'menengah' ? 'selected' : '' }}>Menengah</option>
                                    <option value="menengah_ke_bawah" {{ old('level_ekonomi') == 'menengah_ke_bawah' ? 'selected' : '' }}>Menengah ke bawah</option>
                                </select>
                        
                                <!-- Error message handling -->
                                @error('level_ekonomi')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>                        
                        <div class="form-group row justify-content-center">
                            <label for="jumlah_anggota_keluarga" class="col-md-3 col-form-label">Jumlah anggota keluarga</label>
                            <div class="col-sm-6">
                                <input type="number" class="form-control @error('jumlah_anggota_keluarga') is-invalid @enderror" value="{{ old('jumlah_anggota_keluarga') }}" id="jumlah_anggota_keluarga" name="jumlah_anggota_keluarga" placeholder="Masukkan jumlah anggota keluarga">
                                @error('jumlah_anggota_keluarga')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row justify-content-center">
                            <label for="no_wa" class="col-md-3 col-form-label">Nomor Telepon / WA</label>
                            <div class="col-sm-6">
                                <input type="number" class="form-control @error('no_wa') is-invalid @enderror" value="{{ old('no_wa') }}" id="no_wa" name="no_wa" placeholder="Masukkan nomor telepon / WA">
                                @error('no_wa')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row justify-content-center">
                            <label placeholder="Keterangan tambahan" for="keterangan" class="col-md-3 col-form-label">Keterangan</label>
                            <div class="col-sm-6">
                                <textarea name="keterangan" placeholder="Keterangan tambahan (jika ada)" class="form-control" id="keterangan" cols="4" rows="4"></textarea>
                            </div>
                        </div>
                        <div class="text-center mt-5 mb-5">
                            <button type="button" class="col-md-3 btn btn-secondary mr-3" onclick="onClickLocationBack()">Kembali</button>
                            <button type="submit" class="col-md-3 btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        {{-- script --}}
        <script src="{{ asset('assets/takmir_masjid/js/addFamilyCard.js') }}"></script>
        <script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM=" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/2.1.3/js/dataTables.js"></script>
@endsection
