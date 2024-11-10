@extends('layout.main-after-login')

@section('container')
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.3/css/dataTables.dataTables.css" />
    <link rel="stylesheet" href="{{ asset('assets/admin_masjid/css/addUserData.css') }}">
    {{-- header --}}
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Tambah Data Keahlian</h1>
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
        {{-- @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                @foreach ($errors->all() as $error)
                    <strong>{{ $error }}</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                @endforeach
              </div>
            @endif --}}
        <div class="container-fluid">
            {{-- <div class="card">
                    <h3 class="p-3">Form User</h3>
                </div> --}}
            <div class="card">
                <div class="mt-3 p-3 custom-icon">
                    <i class="fas fa-user-tie" style="font-size: 120px;"></i>
                </div>
                <form method="POST" action="{{ route('storeDataKeahlian') }}">
                    @csrf
                    <div class="mt-4">
                        {{-- Nama Lengkap --}}
                        <div class="form-group row justify-content-center">
                            <label for="inputNama" class="col-md-3 col-form-label">Nama</label>
                            <div class="col-sm-6">
                                <select class="custom-select @error('data_induk_id') is-invalid @enderror"
                                    name="data_induk_id" required>
                                    <option hidden>Cari nama warga...</option>
                                    @foreach ($data_warga as $warga)
                                        <option value="{{ $warga->id }}"
                                            {{ old('data_induk_id') == $warga->id ? 'selected' : '' }}>
                                            {{ $warga->nama_lengkap }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('data_induk_id')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        {{-- Jenis Keahlian --}}
                        <div class="form-group row justify-content-center">
                            <label for="inputJenisKeahlian" class="col-md-3 col-form-label">Nama keahlian</label>
                            <div class="col-sm-6">
                                <select class="custom-select @error('jenis_keahlian_id') is-invalid @enderror"
                                    name="jenis_keahlian_id" required>
                                    <option hidden>Pilih keahlian...</option>
                                    @foreach ($jenis_keahlian as $keahlian)
                                        <option value="{{ $keahlian->id }}"
                                            {{ old('jenis_keahlian_id') == $keahlian->id ? 'selected' : '' }}>
                                            {{ $keahlian->jenis_keahlian }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('jenis_keahlian_id')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        {{-- Deskripsi Keahlian --}}
                        <div class="form-group row justify-content-center">
                            <label for="inputDeskripsiKeahlian" class="col-md-3 col-form-label">Deskripsi keahlian</label>
                            <div class="col-sm-6">
                                <input type="text" name="deskripsi_keahlian"
                                    class="form-control @error('deskripsi_keahlian') is-invalid @enderror"
                                    value="{{ old('deskripsi_keahlian') }}" placeholder="Deskripsi keahlian">
                                @error('deskripsi_keahlian')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        {{-- Keahlian Lain --}}
                        <div class="form-group row justify-content-center">
                            <label for="inputKeahlianLain" class="col-md-3 col-form-label">Keahlian lain</label>
                            <div class="col-sm-6">
                                <input type="text" name="keahlian_lain"
                                    class="form-control @error('keahlian_lain') is-invalid @enderror"
                                    value="{{ old('keahlian_lain') }}" placeholder="Keahlian lain">
                                @error('keahlian_lain')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        {{-- Sertifikat --}}
                        <div class="form-group row justify-content-center">
                            <label for="sertifikat" class="col-md-3 col-form-label">Sertifikat</label>
                            <div class="col-sm-6">
                                <div class="input-group">
                                    <select class="form-control custom-select @error('is_sertifikat') is-invalid @enderror"
                                        id="sertifikat" name="is_sertifikat" onchange="toggleCertificateDescription()">
                                        <option hidden>Jika memiliki sertifikat</option>
                                        <option value="ya" {{ old('is_sertifikat') == 'ya' ? 'selected' : '' }}>Ya
                                        </option>
                                        <option value="tidak" {{ old('is_sertifikat') == 'tidak' ? 'selected' : '' }}>
                                            Tidak</option>
                                    </select>
                                    @error('is_sertifikat')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        {{-- Deskripsi Sertifikat --}}
                        <div id="deskripsiSertifikat" class="form-group row justify-content-center" style="display: none;">
                            <label for="inputDeskripsiSertifikat" class="col-md-3 col-form-label">Deskripsi
                                sertifikat</label>
                            <div class="col-sm-6">
                                <textarea name="deskripsi_sertifikat" class="form-control" placeholder="Deskripsi sertifikat" rows="3"></textarea>
                            </div>
                        </div>
                    </div>

                    {{-- Buttons --}}
                    <div class="text-center mt-5 mb-5">
                        <button type="button" class="col-md-3 btn btn-secondary mr-3"
                            onclick="onClickLocationBack()">Kembali</button>
                        <button type="submit" class="col-md-3 btn btn-primary">Simpan</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
    {{-- script --}}
    <script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM="
        crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/2.1.3/js/dataTables.js"></script>
    <script src="{{ asset('assets/takmir_masjid/js/addSkillsData.js') }}"></script>
@endsection
