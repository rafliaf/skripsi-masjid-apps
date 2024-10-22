@extends('layout.main-after-login')

@section('container')
<link rel="stylesheet" href="https://cdn.datatables.net/2.1.3/css/dataTables.dataTables.css"/>
<link rel="stylesheet" href="{{ asset('assets/takmir_masjid/css/editSkillsData.css') }}">
        {{-- header --}}
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Edit Data Keahlian</h1>
                        <p class="mt-2">{{ $getData->nama_masjid }}</p>
                    </div>
                    <div class="col-sm-6 mb-3">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item">
                                <a href="#">Data kartu keluarga</a>
                            </li>
                            <li class="breadcrumb-item active">
                                Edit data kartu keluarga
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
                        <i class="fa-solid fa-user-pen" style="font-size: 100px;"></i>
                    </div>
                    <form method="POST" action="{{ route('updateDataKeahlian', $dataKeahlian->id) }}">
                        @csrf
                        @method('PUT') <!-- Use PUT method for update -->
                    
                        {{-- Nama lengkap --}}
                        <div class="form-group row justify-content-center">
                            <label for="inputNama" class="col-md-3 col-form-label">Nama lengkap</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="inputNama" name="nama_lengkap" value="{{ $dataKeahlian->dataInduk->nama_lengkap}}" disabled>
                            </div>
                        </div>
                    
                        {{-- Jenis Keahlian --}}
                        <div class="form-group row justify-content-center">
                            <label for="inputJenisKeahlian" class="col-md-3 col-form-label">Jenis keahlian</label>
                            <div class="col-sm-6">
                                <select class="custom-select" name="jenis_keahlian_id" required>
                                    <option hidden>Jenis keahlian...</option>
                                    @foreach($jenis_keahlian as $keahlian)
                                        <option value="{{ $keahlian->id }}" {{ $keahlian->id == $dataKeahlian->jenisKeahlian->id ? 'selected' : '' }}>
                                            {{ $keahlian->jenis_keahlian }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        {{-- Keahlian lain --}}
                        <div class="form-group row justify-content-center">
                            <label for="inputKeahlianLain" class="col-md-3 col-form-label">Keahlian lain</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="inputKeahlianLain" name="keahlian_lain" value="{{ $dataKeahlian->keahlian_lain ?? '-'}}">
                            </div>
                        </div>
                    
                        {{-- Deskripsi keahlian --}}
                        <div class="form-group row justify-content-center">
                            <label for="inputDeskripsiKeahlian" class="col-md-3 col-form-label">Deskripsi keahlian</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="inputDeskripsiKeahlian" name="deskripsi_keahlian" value="{{ $dataKeahlian->deskripsi_keahlian }}">
                            </div>
                        </div>
                    
                        {{-- Sertifikat --}}
                        <div class="form-group row justify-content-center">
                            <label for="inputSertifikat" class="col-md-3 col-form-label">Sertifikat</label>
                            <div class="col-sm-6">
                                <select class="form-control" name="is_sertifikat" id="inputSertifikat" onchange="toggleCertificateDescription()">
                                    <option value="ya" {{ $dataKeahlian->is_sertifikat == 'ya' ? 'selected' : '' }}>Ya</option>
                                    <option value="tidak" {{ $dataKeahlian->is_sertifikat == 'tidak' ? 'selected' : '' }}>Tidak</option>
                                </select>
                            </div>
                        </div>

                        {{-- Deskripsi Sertifikat --}}
                        <div id="certificateDescription" class="form-group row justify-content-center" style="display: none;">
                            <label for="inputDeskripsiSertifikat" class="col-md-3 col-form-label">Deskripsi sertifikat</label>
                            <div class="col-sm-6">
                                <textarea class="form-control" id="inputDeskripsiSertifikat" name="deskripsi_sertifikat" rows="3">{{ $dataKeahlian->deskripsi_sertifikat }}</textarea>
                            </div>
                        </div>

                        {{-- Submit button --}}
                        <div class="text-center mt-3 mb-5">
                            <button type="button" class="col-md-3 btn btn-secondary mr-3" onclick="onClickLocationBack()">Kembali</button>
                            <button type="submit" class="col-md-3 btn btn-primary">Simpan</button>
                        </div>
                    </form>                    
                </div>
            </div>
        </div>
        {{-- script --}}
        <script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM=" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/2.1.3/js/dataTables.js"></script>
        <script src="{{ asset('assets/takmir_masjid/js/editSkillsData.js') }}"></script>
@endsection
