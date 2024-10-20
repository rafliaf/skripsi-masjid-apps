@extends('layout.main-after-login')

@section('container')
<link rel="stylesheet" href="https://cdn.datatables.net/2.1.3/css/dataTables.dataTables.css"/>
<link rel="stylesheet" href="{{ asset('assets/takmir_masjid/css/addMosqueProgram.css') }}">
<!-- Flatpickr CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
        {{-- header --}}
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Tambah Program Takmir Masjid</h1>
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
                {{-- @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif --}}
                <div class="card">
                    <div class="mt-3 p-3 custom-icon">
                        <i class="fas fa-clipboard-list" style="font-size: 120px"></i>
                    </div>
                    <form action="{{ route('program_takmir.store') }}" method="POST" style="margin-top: 20px">
                        @csrf
                        <!-- Jenis Program -->
                        <div class="form-group row justify-content-center">
                            <label for="jenisProgram" class="col-md-3 col-form-label">Jenis program</label>
                            <div class="col-sm-6">
                                <div class="input-group">
                                    <select class="custom-select @error('jenis_program') is-invalid @enderror" name="jenis_program" id="jenisProgram">
                                        <option hidden>Pilih jenis program...</option>
                                        @foreach($jenis_programs as $program)
                                            <option value="{{ $program->id }}" {{ old('jenis_program') == $program->id ? 'selected' : '' }}>
                                                {{ $program->jenis_program }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('jenis_program')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    
                        <!-- Nama Kegiatan -->
                        <div class="form-group row justify-content-center">
                            <label for="inputNama" class="col-md-3 col-form-label">Nama kegiatan</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control @error('nama_kegiatan') is-invalid @enderror" id="inputNama" name="nama_kegiatan" placeholder="Nama kegiatan" value="{{ old('nama_kegiatan') }}">
                                @error('nama_kegiatan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    
                        <!-- Lokasi Kegiatan -->
                        <div class="form-group row justify-content-center">
                            <label for="inputLokasi" class="col-md-3 col-form-label">Lokasi kegiatan</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control @error('lokasi_kegiatan') is-invalid @enderror" id="inputLokasi" name="lokasi_kegiatan" placeholder="Lokasi kegiatan" value="{{ old('lokasi_kegiatan') }}">
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
                                    <!-- Visible input for displaying the date -->
                                    <input type="text" id="inputTanggalMulai" class="form-control @error('tgl_mulai') is-invalid @enderror" value="{{ old('tgl_mulai') }}" placeholder="Pilih tanggal mulai" readonly>
                                    
                                    <!-- Hidden input to store the formatted date for submission -->
                                    <input type="hidden" name="tgl_mulai" id="hiddenInputTanggalMulai" value="{{ old('tgl_mulai') }}">
                                    
                                    <!-- Calendar icon to trigger date picker -->
                                    <span class="input-group-text" id="inputTanggalMulaiTrigger" style="cursor: pointer; background-color: #fdfbfb; color: #0B689C">
                                        <i class="fas fa-calendar-alt"></i>
                                    </span>  
                                    
                                    <!-- Error message handling -->
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
                                    <!-- Visible input for displaying the date -->
                                    <input type="text" id="inputTanggalSelesai" class="form-control @error('tgl_selesai') is-invalid @enderror" value="{{ old('tgl_selesai') }}" placeholder="Pilih tanggal selesai" readonly>
                                    
                                    <!-- Hidden input to store the formatted date for submission -->
                                    <input type="hidden" name="tgl_selesai" id="hiddenInputTanggalSelesai" value="{{ old('tgl_selesai') }}">
                                    
                                    <!-- Calendar icon to trigger date picker -->
                                    <span class="input-group-text" id="inputTanggalSelesaiTrigger" style="cursor: pointer; background-color: #fdfbfb; color: #0B689C">
                                        <i class="fas fa-calendar-alt"></i>
                                    </span>  
                                    
                                    <!-- Error message handling -->
                                    @error('tgl_selesai')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    
                        <!-- Penanggung Jawab -->
                        <div class="form-group row justify-content-center">
                            <label for="inputPenanggungJawab" class="col-md-3 col-form-label">Penanggung jawab</label>
                            <div class="col-sm-6">
                                <div class="input-group">
                                    <select class="custom-select @error('penanggung_jawab') is-invalid @enderror" name="penanggung_jawab" id="inputPenanggungJawab">
                                        <option hidden>Cari nama warga...</option>
                                        @foreach($penanggung_jawab as $pj)
                                            <option value="{{ $pj->id }}" {{ old('penanggung_jawab') == $pj->id ? 'selected' : '' }}>
                                                {{ $pj->nama_lengkap }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('penanggung_jawab')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    
                        <!-- Sasaran Kegiatan -->
                        <div class="form-group row justify-content-center">
                            <label for="inputSasaran" class="col-md-3 col-form-label">Sasaran kegiatan</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control @error('sasaran_kegiatan') is-invalid @enderror" id="inputSasaran" name="sasaran_kegiatan" placeholder="Sasaran kegiatan" value="{{ old('sasaran_kegiatan') }}">
                                @error('sasaran_kegiatan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    
                        <!-- Catatan Pelaksanaan -->
                        <div class="form-group row justify-content-center">
                            <label for="inputCatatan" class="col-md-3 col-form-label">Catatan pelaksanaan</label>
                            <div class="col-sm-6">
                                <textarea class="form-control @error('catatan_pelaksanaan') is-invalid @enderror" placeholder="Masukkan catatan pelaksanaan" id="inputCatatan" rows="3" name="catatan_pelaksanaan">{{ old('catatan_pelaksanaan') }}</textarea>
                                @error('catatan_pelaksanaan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    
                        <!-- Form Submit Buttons -->
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
        <script src="{{ asset('assets/takmir_masjid/js/mosqueProgram.js') }}"></script>
@endsection
