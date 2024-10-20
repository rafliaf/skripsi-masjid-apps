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
                        <h1 class="m-0">Edit Program Remaja Masjid</h1>
                        <p class="mt-2">{{ $getData->nama_masjid }}</p>
                    </div>
                    <div class="col-sm-6 mb-3">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item">
                                <a href="#">Program masjid</a>
                            </li>
                            <li class="breadcrumb-item active">
                                Edit program masjid
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
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    <div class="mt-3 p-3 custom-icon">
                        <i class="fas fa-clipboard-list" style="font-size: 120px"></i>
                    </div>
                    <form action="{{ route('updateProgram', $program->id) }}" method="POST" style="margin-top: 20px">
                        @csrf <!-- CSRF token for security -->
                        @method('PUT') <!-- Spoofing the PUT method for update -->
                
                        <div class="form-group row justify-content-center">
                            <label for="jenis_program" class="col-md-3 col-form-label">Jenis program</label>
                            <div class="col-sm-6">
                                <div class="input-group">
                                    <select class="custom-select" name="jenis_program_id" id="jenis_program">
                                        <option hidden>Pilih jenis program....</option>
                                        @foreach($jenis_programs as $jenis_program)
                                            <option value="{{ $jenis_program->id }}" {{ $program->jenis_program_id == $jenis_program->id ? 'selected' : '' }}>
                                                {{ $jenis_program->jenis_program }}
                                            </option>
                                        @endforeach
                                    </select>                                                            
                                </div>
                            </div>
                        </div>
                
                        <div class="form-group row justify-content-center">
                            <label for="nama_kegiatan" class="col-md-3 col-form-label">Nama kegiatan</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="nama_kegiatan" name="nama_kegiatan" value="{{ $program->nama_kegiatan }}" placeholder="Nama kegiatan">
                            </div>
                        </div>
                
                        <div class="form-group row justify-content-center">
                            <label for="lokasi_kegiatan" class="col-md-3 col-form-label">Lokasi kegiatan</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="lokasi_kegiatan" name="lokasi_kegiatan" value="{{ $program->lokasi_kegiatan }}" placeholder="Lokasi kegiatan">
                            </div>
                        </div>

                        {{-- Tgl mulai & tgl selesai --}}
                        <input type="hidden" id="hiddenInputTanggalMulai" name="tgl_mulai" value="{{ \Carbon\Carbon::parse($program->tgl_mulai)->format('Y-m-d H:i') }}">
                        <input type="hidden" id="hiddenInputTanggalSelesai" name="tgl_selesai" value="{{ \Carbon\Carbon::parse($program->tgl_selesai)->format('Y-m-d H:i') }}">

                        <div class="form-group row justify-content-center">
                            <label for="tgl_mulai" class="col-sm-3 col-form-label">Tanggal mulai</label>
                            <div class="col-sm-6">
                                <div class="input-group">
                                    {{-- Tgl mulai --}}
                                    <input type="text" id="inputTanggalMulai" class="form-control" 
                                        value="{{ \Carbon\Carbon::parse($program->tgl_mulai)->translatedFormat('d F Y H:i') }} WIB" 
                                        placeholder="Pilih tanggal mulai">
                                    <span class="input-group-text" style="border-radius: 0px 5px 5px 0px; cursor: pointer; background-color: #fdfbfb; color: #0B689C">
                                        <i class="fas fa-calendar-alt"></i>
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row justify-content-center">
                            <label for="tgl_selesai" class="col-sm-3 col-form-label">Tanggal selesai</label>
                            <div class="col-sm-6">
                                <div class="input-group">
                                    {{-- Tgl selesai --}}
                                    <input type="text" id="inputTanggalSelesai" class="form-control" 
                                        value="{{ \Carbon\Carbon::parse($program->tgl_selesai)->translatedFormat('d F Y H:i') }} WIB" 
                                        placeholder="Pilih tanggal selesai">
                                    <span class="input-group-text" style="border-radius: 0px 5px 5px 0px; cursor: pointer; background-color: #fdfbfb; color: #0B689C">
                                        <i class="fas fa-calendar-alt"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                        
                
                        <div class="form-group row justify-content-center">
                            <label for="penanggung_jawab" class="col-md-3 col-form-label">Penanggung jawab</label>
                            <div class="col-sm-6">
                                <select class="custom-select" name="data_induk_id" id="penanggung_jawab">
                                    <option hidden>Cari nama warga....</option>
                                    @foreach($penanggung_jawabs as $penanggung_jawab)
                                        <option value="{{ $penanggung_jawab->id }}" {{ $program->data_induk_id == $penanggung_jawab->id ? 'selected' : '' }}>
                                            {{ $penanggung_jawab->nama_lengkap }}
                                        </option>
                                    @endforeach
                                </select>                           
                             </div>
                        </div>
                        
                        <div class="form-group row justify-content-center">
                            <label for="sasaran_kegiatan" class="col-md-3 col-form-label">Sasaran kegiatan</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="sasaran_kegiatan" name="sasaran_kegiatan" value="{{ $program->sasaran_kegiatan }}" placeholder="Sasaran kegiatan">
                            </div>
                        </div>
                
                        <div class="form-group row justify-content-center">
                            <label for="catatan_pelaksanaan" class="col-md-3 col-form-label">Catatan pelaksanaan</label>
                            <div class="col-sm-6">
                                <textarea class="form-control" name="catatan_pelaksanaan" id="catatan_pelaksanaan" placeholder="Masukkan catatan pelaksanaan" rows="3">{{ $program->catatan_pelaksanaan }}</textarea>
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
        <script src="{{ asset('assets/remaja_masjid/js/editProgramRemajaMasjid.js') }}"></script>
@endsection
