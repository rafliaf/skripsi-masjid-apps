@extends('layout.main-after-login')

@section('container')
<link rel="stylesheet" href="https://cdn.datatables.net/2.1.3/css/dataTables.dataTables.css"/>
<link rel="stylesheet" href="{{ asset('assets/admin_masjid/css/addUserData.css') }}">
        {{-- header --}}
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Tambah Data Remaja Masjid</h1>
                        <p class="mt-2">{{ $getData->nama_masjid }}</p>
                    </div>
                    <div class="col-sm-6 mb-3">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item">
                                <a href="#">Data remaja masjid</a>
                            </li>
                            <li class="breadcrumb-item active">
                                Tambah data remaja masjid
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
                    <form method="POST" action="{{ route('storeDataRemajaMasjid') }}">
                        @csrf
                        <div class="form-group row justify-content-center">
                            <label for="inputNama" class="col-sm-3 col-form-label">Nama</label>
                            <div class="col-sm-6">
                                <select class="custom-select @error('data_induk_id') is-invalid @enderror" name="data_induk_id" id="inputGroupSelect01">
                                    <option hidden>Cari warga...</option>
                                    @foreach($dataInduk as $induk)
                                        <option value="{{ $induk->id }}" {{ old('data_induk_id') == $induk->id ? 'selected' : '' }}>
                                            {{ $induk->nama_lengkap }}
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
                        <div class="form-group row justify-content-center">
                            <label for="inputRole" class="col-sm-3 col-form-label">Anggota remaja masjid</label>                       
                            <div class="col-sm-6">
                                <select class="custom-select @error('is_remaja_masjid') is-invalid @enderror" name="is_remaja_masjid" id="inputGroupSelect02">
                                    <option hidden>Pilih apakah remaja masjid...</option>
                                    <option value="ya" {{ old('is_remaja_masjid') == 'ya' ? 'selected' : '' }}>Ya</option>
                                    <option value="tidak" {{ old('is_remaja_masjid') == 'tidak' ? 'selected' : '' }}>Tidak</option>
                                </select>
                                @error('is_remaja_masjid')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>                        
                
                        <div class="text-center mt-4 mb-5">
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
        <script src="{{ asset('assets/remaja_masjid/js/mosqueYouth.js') }}"></script>
@endsection
