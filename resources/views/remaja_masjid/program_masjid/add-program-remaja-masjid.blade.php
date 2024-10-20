@extends('layout.main-after-login')

@section('container')
<link rel="stylesheet" href="https://cdn.datatables.net/2.1.3/css/dataTables.dataTables.css"/>
<link rel="stylesheet" href="{{ asset('assets/remaja_masjid/css/tambahProgramRemajaMasjid.css') }}">
<!-- Flatpickr CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
        {{-- header --}}
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Tambah Program Remaja Masjid</h1>
                        <p class="mt-2">{{ $getData->nama_masjid }}</p>
                    </div>
                    <div class="col-sm-6 mb-3">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item">
                                <a href="#">Program masjid</a>
                            </li>
                            <li class="breadcrumb-item active">
                                Tambah program masjid
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        {{-- content --}}
        <div class="content">
            <div class="container-fluid">
                <div class="card">
                {{-- debug error --}}
                {{-- @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif --}}
                    <div class="mt-3 p-3 custom-icon">
                        <i class="fas fa-clipboard-list" style="font-size: 120px"></i>
                    </div>
                    <form action="{{ route('addProgram') }}" method="POST" style="margin-top: 20px">
                        @csrf <!-- CSRF token for security -->
                        
                        <div class="form-group row justify-content-center">
                            <label for="jenis_program" class="col-md-3 col-form-label">Jenis program</label>
                            <div class="col-sm-6">
                                <div class="input-group">
                                    <select class="custom-select @error('jenis_program_id') is-invalid @enderror" id="jenis_program" name="jenis_program_id">
                                        <option hidden>Pilih jenis program....</option>
                                        @foreach ($jenis_programs as $jenis_program)
                                            <option value="{{ $jenis_program->id }}" {{ old('jenis_program_id') == $jenis_program->id ? 'selected' : '' }}>{{ $jenis_program->jenis_program }}</option>
                                        @endforeach
                                    </select>
                                    @error('jenis_program_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group row justify-content-center">
                            <label for="nama_kegiatan" class="col-md-3 col-form-label">Nama kegiatan</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control @error('nama_kegiatan') is-invalid @enderror" value="{{ old('nama_kegiatan') }}" id="nama_kegiatan" name="nama_kegiatan" placeholder="Nama kegiatan">
                                @error('nama_kegiatan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="form-group row justify-content-center">
                            <label for="lokasi_kegiatan" class="col-md-3 col-form-label">Lokasi kegiatan</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control @error('lokasi_kegiatan') is-invalid @enderror" value="{{ old('lokasi_kegiatan') }}" id="lokasi_kegiatan" name="lokasi_kegiatan" placeholder="Lokasi kegiatan">
                                @error('lokasi_kegiatan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <!-- Tanggal Mulai -->
                        <div class="form-group row justify-content-center">
                            <label class="col-sm-3 col-form-label">Tanggal mulai</label>
                            <div class="col-sm-6">
                                <div class="input-group">
                                    <input type="text" id="inputTanggalMulai" class="form-control @error('tgl_mulai') is-invalid @enderror" value="{{ old('tgl_mulai') }}" placeholder="Pilih tanggal mulai" readonly>
                                    <input type="hidden" name="tgl_mulai" id="hiddenInputTanggalMulai" value="{{ old('tgl_mulai') }}"> <!-- Tanggal MySQL Format -->
                                    <span class="input-group-text" id="inputTanggalMulaiTrigger" style="cursor:pointer; border-radius: 0px 5px 5px 0px; cursor: pointer; background-color: #fdfbfb; color: #0B689C">
                                        <i class="fas fa-calendar-alt"></i>
                                    </span>                  
                                    @error('tgl_mulai')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror              
                                </div>
                            </div>
                        </div>
                        <!-- Tanggal Selesai -->
                        <div class="form-group row justify-content-center">
                            <label class="col-sm-3 col-form-label">Tanggal selesai</label>
                            <div class="col-sm-6">
                                <div class="input-group">
                                    <input type="text" id="inputTanggalSelesai" class="form-control @error('tgl_selesai') is-invalid @enderror" value="{{ old('tgl_selesai') }}" placeholder="Pilih tanggal selesai" required>
                                    <input type="hidden" name="tgl_selesai" id="hiddenInputTanggalSelesai" value="{{ old('tgl_selesai') }}"> <!-- Hidden input untuk format MySQL -->
                                    <span class="input-group-text" style="border-radius: 0px 5px 5px 0px; cursor: pointer; background-color: #fdfbfb; color: #0B689C">
                                        <i class="fas fa-calendar-alt"></i>
                                    </span>   
                                    @error('tgl_selesai')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror                                 
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group row justify-content-center">
                            <label for="penanggung_jawab" class="col-sm-3 col-form-label">Penanggung jawab</label>
                            <div class="col-sm-6">
                                <div class="input-group">
                                    <select class="custom-select @error('data_induk_id') is-invalid @enderror" name="data_induk_id" id="penanggung_jawab">
                                        <option hidden>Cari nama warga....</option>
                                        @foreach ($penanggung_jawab as $pj)
                                            <option value="{{ $pj->id }}" {{ old('data_induk_id') == $pj->id ? 'selected' : '' }}>{{ $pj->nama_lengkap }}</option>
                                        @endforeach
                                    </select>
                                    @error('data_induk_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group row justify-content-center">
                            <label for="sasaran_kegiatan" class="col-md-3 col-form-label">Sasaran kegiatan</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control @error('sasaran_kegiatan') is-invalid @enderror" value="{{ old('sasaran_kegiatan') }}" id="sasaran_kegiatan" name="sasaran_kegiatan" placeholder="Sasaran kegiatan">
                                @error('sasaran_kegiatan')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror   
                            </div>
                        </div>
                        
                        <div class="form-group row justify-content-center">
                            <label for="catatan_pelaksanaan" class="col-md-3 col-form-label">Catatan pelaksanaan</label>
                            <div class="col-sm-6">
                                <textarea class="form-control" name="catatan_pelaksanaan" id="catatan_pelaksanaan" placeholder="Masukkan catatan pelaksanaan" rows="3"></textarea>
                            </div>
                        </div>
                    
                        <div class="text-center mt-3 mb-5">
                            <button type="button" class="col-md-3 btn btn-secondary mr-3" onclick="onClickLocationBack()">Kembali</button>
                            <button type="submit" class="col-md-3 btn btn-primary">Simpan</button>
                        </div>
                    </form>   
                     
                </div>
            </div>
        </div>
        {{-- script --}}
        <!-- Flatpickr JS -->
        <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
        <script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM=" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/2.1.3/js/dataTables.js"></script>
        <script src="{{ asset('assets/remaja_masjid/js/tambahProgramRemajaMasjid.js') }}"></script>
@endsection
