@extends('layout.main-after-login')

@section('container')
{{-- dataTables --}}
<link rel="stylesheet" href="https://cdn.datatables.net/2.1.3/css/dataTables.dataTables.css"/>
<!-- Flatpickr CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
{{-- css --}}
<link rel="stylesheet" href="{{ asset('assets/takmir_masjid/css/addParentData.css') }}">
        {{-- header --}}
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Tambah Data Induk</h1>
                        <p class="mt-2">{{ $getData->nama_masjid }}</p>
                    </div>
                    <div class="col-sm-6 mb-3">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item">
                                <a href="#">Data induk</a>
                            </li>
                            <li class="breadcrumb-item active">
                                Tambah data induk
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
                    <h5 class="card-header">Form input data induk</h5>
                    <div class="card-body">
                    <form action="{{ route('data_induk.store') }}" method="POST">
                        @csrf
                        {{-- tabset --}}
                        <!-- daftar tabset -->
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                              <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">Data inti</button>
                            </li>
                            <li class="nav-item" role="presentation">
                              <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Data ibadah</button>
                            </li>
                        </ul>
                        {{-- tabset ke 1 --}}
                          <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                <div class="mt-3 mb-3 row">
                                    <label for="inputNamaKepalaKeluarga" class="col-sm-3 col-form-label">Nama kepala keluarga</label>
                                    <div class="col-sm-9">
                                        <div class="input-group">
                                            <select id="kartu_keluarga_id" name="kartu_keluarga_id" class="custom-select @error('kartu_keluarga_id') is-invalid @enderror">
                                                <option hidden>Pilih nama kepala keluarga...</option>
                                                @foreach($dataKartuKeluarga as $kk)
                                                    <option value="{{ $kk->id }}" {{ old('kartu_keluarga_id') == $kk->id ? 'selected' : '' }}>
                                                        {{ $kk->nama_kepala_keluarga }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <!-- Error message handling -->
                                            @error('kartu_keluarga_id')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>                                                                          
                                    </div>
                                </div>
                                <div class="mt-3 mb-3 row">
                                    <label for="nik" class="col-sm-3 col-form-label">NIK</label>
                                    <div class="col-sm-9">
                                      <input type="text" class="form-control @error('nik') is-invalid @enderror" value="{{ old('nik') }}"  name="nik" id="nik" placeholder="Masukkan NIK...">
                                        @error('nik')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="mt-3 mb-3 row">
                                    <label for="namaLengkap" class="col-sm-3 col-form-label">Nama lengkap</label>
                                    <div class="col-sm-9">
                                      <input type="text" class="form-control @error('nama_lengkap') is-invalid @enderror" value="{{ old('nama_lengkap') }}" name="nama_lengkap" id="namaLengkap" placeholder="Masukkan nama lengkap...">
                                      @error('nama_lengkap')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                    </div>
                                </div>
                                <div class="mt-3 mb-3 row">
                                    <label for="statusHubunganKeluarga" class="col-sm-3 col-form-label">Status hubungan keluarga</label>
                                    <div class="col-sm-9">
                                      <input type="text" class="form-control @error('status_hubungan_keluarga') is-invalid @enderror" value="{{ old('status_hubungan_keluarga') }}" name="status_hubungan_keluarga" id="statusHubunganKeluarga" placeholder="Masukkan status hubungan...">
                                        @error('status_hubungan_keluarga')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="mt-3 mb-3 row">
                                    <label for="tempatLahir" class="col-sm-3 col-form-label">Tempat lahir</label>
                                    <div class="col-sm-9">
                                      <input type="text" class="form-control @error('tempat_lahir') is-invalid @enderror" value="{{ old('tempat_lahir') }}" name="tempat_lahir" id="tempatLahir" placeholder="Masukkan tempat lahir...">
                                      @error('tempat_lahir')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                    </div>
                                </div>
                                <div class="mt-3 mb-3 row">
                                    <label class="col-sm-3 col-form-label">Tanggal lahir</label>
                                    <div class="col-sm-9">
                                        <div class="input-group">
                                            <!-- Visible input for displaying the date -->
                                            <input type="text" id="inputTanggal" class="form-control @error('tgl_lahir') is-invalid @enderror" value="{{ old('tgl_lahir') }}" placeholder="Pilih tanggal lahir" readonly>
                                        
                                            <!-- Hidden field to store the formatted date for submission -->
                                            <input type="hidden" name="tgl_lahir" id="hiddenDate" value="{{ old('tgl_lahir') }}">
                                        
                                            <!-- Calendar icon to trigger date picker -->
                                            <span class="input-group-text" id="inputTanggalTrigger" style="border-radius: 0px 5px 5px 0px; cursor: pointer; background-color: #fdfbfb; color: #0B689C">
                                                <i class="fas fa-calendar-alt"></i>
                                            </span>             
                                        
                                            <!-- Error message handling -->
                                            @error('tgl_lahir')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror                   
                                        </div>                                        
                                    </div>
                                </div>
                                <div class="mt-3 mb-3 row">
                                    <label for="inputPassword" class="col-sm-3 col-form-label">Jenis kelamin</label>
                                    <div class="col-sm-9">
                                        <div class="input-group">
                                            <select class="custom-select @error('jenis_kelamin') is-invalid @enderror" name="jenis_kelamin" id="inputGroupSelect01">
                                                <option hidden>Pilih jenis kelamin....</option>
                                                <option value="laki_laki" {{ old('jenis_kelamin') == 'laki_laki' ? 'selected' : '' }}>Laki-laki</option>
                                                <option value="perempuan" {{ old('jenis_kelamin') == 'perempuan' ? 'selected' : '' }}>Perempuan</option>
                                            </select>
                                            <!-- Error message handling -->
                                            @error('jenis_kelamin')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>                                        
                                    </div>
                                </div>
                                <div class="mt-3 mb-3 row">
                                    <label for="pendidikan" class="col-sm-3 col-form-label">Pendidikan</label>
                                    <div class="col-sm-9">
                                        <div class="input-group">
                                            <select class="custom-select @error('pendidikan') is-invalid @enderror" name="pendidikan" id="inputGroupSelect01">
                                                <option hidden>Pilih pendidikan....</option>
                                                <option value="belum_sekolah" {{ old('pendidikan') == 'belum_sekolah' ? 'selected' : '' }}>Tidak/belum sekolah</option>
                                                <option value="paud" {{ old('pendidikan') == 'paud' ? 'selected' : '' }}>PAUD</option>
                                                <option value="tk" {{ old('pendidikan') == 'tk' ? 'selected' : '' }}>TK/taman kanak-kanak</option>
                                                <option value="sd" {{ old('pendidikan') == 'sd' ? 'selected' : '' }}>SD/sekolah dasar</option>
                                                <option value="smp" {{ old('pendidikan') == 'smp' ? 'selected' : '' }}>SMP/sederajat</option>
                                                <option value="smk" {{ old('pendidikan') == 'smk' ? 'selected' : '' }}>SMK/sederajat</option>
                                                <option value="sma" {{ old('pendidikan') == 'sma' ? 'selected' : '' }}>SMA/sederajat</option>
                                                <option value="d1" {{ old('pendidikan') == 'd1' ? 'selected' : '' }}>Diploma I</option>
                                                <option value="d2" {{ old('pendidikan') == 'd2' ? 'selected' : '' }}>Diploma II</option>
                                                <option value="d3" {{ old('pendidikan') == 'd3' ? 'selected' : '' }}>Diploma III</option>
                                                <option value="d4" {{ old('pendidikan') == 'd4' ? 'selected' : '' }}>Diploma IV</option>
                                                <option value="s1" {{ old('pendidikan') == 's1' ? 'selected' : '' }}>Sarjana S1</option>
                                                <option value="s2" {{ old('pendidikan') == 's2' ? 'selected' : '' }}>Sarjana S2</option>
                                                <option value="s3" {{ old('pendidikan') == 's3' ? 'selected' : '' }}>Sarjana S3</option>
                                            </select>    
                                            <!-- Error message handling -->
                                            @error('pendidikan')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>                                        
                                    </div>
                                </div>
                                <div class="mt-3 mb-3 row">
                                    <label for="pekerjaan" class="col-sm-3 col-form-label">Pekerjaan</label>
                                    <div class="col-sm-9">
                                      <input type="text" class="form-control @error('pekerjaan') is-invalid @enderror" value="{{ old('pekerjaan') }}" name="pekerjaan" id="pekerjaan" placeholder="Masukkan pekerjaan...">
                                        @error('pekerjaan')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row justify-content-center">
                                    <label for="noWa" class="col-md-3 col-form-label">Nomor Telepon / WA</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control @error('no_wa') is-invalid @enderror" value="{{ old('no_wa') }}" name="no_wa" id="noWa" placeholder="Nomor telepon / WA">
                                        @error('no_wa')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="mt-3 mb-3 row">
                                    <label for="inputPassword" class="col-sm-3 col-form-label">Status kawin</label>
                                    <div class="col-sm-9">
                                        <div class="input-group">
                                            <select class="custom-select @error('status_kawin') is-invalid @enderror" name="status_kawin" id="inputGroupSelect01">
                                                <option hidden>Pilih status kawin....</option>
                                                <option value="menikah" {{ old('status_kawin') == 'menikah' ? 'selected' : '' }}>Menikah</option>
                                                <option value="belum_menikah" {{ old('status_kawin') == 'belum_menikah' ? 'selected' : '' }}>Belum menikah</option>
                                                <option value="duda" {{ old('status_kawin') == 'duda' ? 'selected' : '' }}>Duda</option>
                                                <option value="janda" {{ old('status_kawin') == 'janda' ? 'selected' : '' }}>Janda</option>
                                            </select>
                                            @error('status_kawin')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>                                                                          
                                    </div>
                                </div>
                                <div class="mt-3 mb-3 row">
                                    <label for="inputPassword" class="col-sm-3 col-form-label">Remaja masjid</label>
                                    <div class="col-sm-9">
                                        <div class="input-group">
                                            <select class="custom-select @error('is_remaja_masjid') is-invalid @enderror" name="is_remaja_masjid" id="inputGroupSelect01">
                                                <option hidden>Pilih status remaja masjid....</option>
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
                                </div>
                                <div class="mt-3 mb-3 row">
                                    <label for="inputPassword" class="col-sm-3 col-form-label">Status mukim</label>
                                    <div class="col-sm-9">
                                        <div class="input-group">
                                            <select class="custom-select @error('is_status_mukim') is-invalid @enderror"  name="is_status_mukim" id="inputGroupSelect01">
                                                <option hidden >Pilih status mukim....</option>
                                                <option value="ya"  {{ old('is_status_mukim') == 'ya' ? 'selected' : '' }}>Mukim</option>
                                                <option value="tidak" {{ old('is_status_mukim') == 'tidak' ? 'selected' : '' }}>Bukan mukim</option>
                                            </select>
                                            @error('is_status_mukim')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>                                   
                                     </div>
                                </div>
                            </div>
                            {{-- tabset ke 2 --}}
                            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                <div class="mt-3 mb-3 row">
                                    <label for="inputPassword" class="col-sm-3 col-form-label">Baca latin</label>
                                    <div class="col-sm-9">
                                        <div class="input-group">
                                            <select class="custom-select @error('is_baca_latin') is-invalid @enderror" name="is_baca_latin" id="inputGroupSelect01">
                                                <option hidden>Pilih status baca....</option>
                                                <option value="ya" {{ old('is_baca_latin') == 'ya' ? 'selected' : '' }}>Ya</option>
                                                <option value="tidak" {{ old('is_baca_latin') == 'tidak' ? 'selected' : '' }}>Tidak</option>
                                            </select>
                                            @error('is_baca_latin')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-3 mb-3 row">
                                    <label for="inputPassword" class="col-sm-3 col-form-label">Baca hijaiyah</label>
                                    <div class="col-sm-9">
                                        <div class="input-group">
                                            <select class="custom-select @error('is_baca_hijaiyah') is-invalid @enderror" name="is_baca_hijaiyah" id="inputGroupSelect01">
                                                <option hidden>Pilih status baca....</option>
                                                <option value="ya" {{ old('is_baca_hijaiyah') == 'ya' ? 'selected' : '' }}>Ya</option>
                                                <option value="tidak" {{ old('is_baca_hijaiyah') == 'tidak' ? 'selected' : '' }}>Tidak</option>
                                            </select>
                                            @error('is_baca_hijaiyah')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-3 mb-3 row">
                                    <label for="inputPassword" class="col-sm-3 col-form-label">Baca iqro</label>
                                    <div class="col-sm-9">
                                        <div class="input-group">
                                            <select class="custom-select @error('is_baca_iqro') is-invalid @enderror" name="is_baca_iqro" id="inputGroupSelect01">
                                                <option hidden>Pilih status baca....</option>
                                                <option value="ya" {{ old('is_baca_iqro') == 'ya' ? 'selected' : '' }}>Ya</option>
                                                <option value="tidak" {{ old('is_baca_iqro') == 'tidak' ? 'selected' : '' }}>Tidak</option>
                                            </select>
                                            @error('is_baca_iqro')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-3 mb-3 row">
                                    <label for="inputPassword" class="col-sm-3 col-form-label">Baca Al-Qur'an</label>
                                    <div class="col-sm-9">
                                        <div class="input-group">
                                            <select class="custom-select @error('is_baca_quran') is-invalid @enderror" name="is_baca_quran" id="inputGroupSelect01">
                                                <option hidden>Pilih status baca....</option>
                                                <option value="ya" {{ old('is_baca_quran') == 'ya' ? 'selected' : '' }}>Ya</option>
                                                <option value="tidak" {{ old('is_baca_quran') == 'tidak' ? 'selected' : '' }}>Tidak</option>
                                            </select>
                                            @error('is_baca_quran')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-3 mb-3 row">
                                    <label for="inputPassword" class="col-sm-3 col-form-label">Sholat 5 waktu</label>
                                    <div class="col-sm-9">
                                        <div class="input-group">
                                            <select class="custom-select @error('is_sholat_5_waktu') is-invalid @enderror" name="is_sholat_5_waktu" id="inputGroupSelect01">
                                                <option hidden>Pilih status sholat....</option>
                                                <option value="ya" {{ old('is_sholat_5_waktu') == 'ya' ? 'selected' : '' }}>Ya</option>
                                                <option value="tidak" {{ old('is_sholat_5_waktu') == 'tidak' ? 'selected' : '' }}>Tidak</option>
                                            </select>
                                            @error('is_sholat_5_waktu')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            
                                <div class="mt-3 mb-3 row">
                                    <label for="inputPassword" class="col-sm-3 col-form-label">Sholat berjamaah</label>
                                    <div class="col-sm-9">
                                        <div class="input-group">
                                            <select class="custom-select @error('is_sholat_berjamaah') is-invalid @enderror" name="is_sholat_berjamaah" id="inputGroupSelect01">
                                                <option hidden>Pilih status sholat....</option>
                                                <option value="ya" {{ old('is_sholat_berjamaah') == 'ya' ? 'selected' : '' }}>Ya</option>
                                                <option value="tidak" {{ old('is_sholat_berjamaah') == 'tidak' ? 'selected' : '' }}>Tidak</option>
                                            </select>
                                            @error('is_sholat_berjamaah')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            
                                <div class="mt-3 mb-3 row">
                                    <label for="inputPassword" class="col-sm-3 col-form-label">Zakat fitrah</label>
                                    <div class="col-sm-9">
                                        <div class="input-group">
                                            <select class="custom-select @error('is_zakat_fitrah') is-invalid @enderror" name="is_zakat_fitrah" id="inputGroupSelect01">
                                                <option hidden>Pilih status zakat....</option>
                                                <option value="ya" {{ old('is_zakat_fitrah') == 'ya' ? 'selected' : '' }}>Ya</option>
                                                <option value="tidak" {{ old('is_zakat_fitrah') == 'tidak' ? 'selected' : '' }}>Tidak</option>
                                            </select>
                                            @error('is_zakat_fitrah')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            
                                <div class="mt-3 mb-3 row">
                                    <label for="inputPassword" class="col-sm-3 col-form-label">Zakat mal</label>
                                    <div class="col-sm-9">
                                        <div class="input-group">
                                            <select class="custom-select @error('is_zakat_mal') is-invalid @enderror" name="is_zakat_mal" id="inputGroupSelect01">
                                                <option hidden>Pilih status zakat....</option>
                                                <option value="ya" {{ old('is_zakat_mal') == 'ya' ? 'selected' : '' }}>Ya</option>
                                                <option value="tidak" {{ old('is_zakat_mal') == 'tidak' ? 'selected' : '' }}>Tidak</option>
                                            </select>
                                            @error('is_zakat_mal')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            
                                <div class="mt-3 mb-3 row">
                                    <label for="inputPassword" class="col-sm-3 col-form-label">Kurban</label>
                                    <div class="col-sm-9">
                                        <div class="input-group">
                                            <select class="custom-select @error('is_kurban') is-invalid @enderror" name="is_kurban" id="inputGroupSelect01">
                                                <option hidden>Pilih status kurban....</option>
                                                <option value="ya" {{ old('is_kurban') == 'ya' ? 'selected' : '' }}>Ya</option>
                                                <option value="tidak" {{ old('is_kurban') == 'tidak' ? 'selected' : '' }}>Tidak</option>
                                            </select>
                                            @error('is_kurban')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            
                                <div class="mt-3 mb-3 row">
                                    <label for="inputPassword" class="col-sm-3 col-form-label">Haji</label>
                                    <div class="col-sm-9">
                                        <div class="input-group">
                                            <select class="custom-select @error('is_haji') is-invalid @enderror" name="is_haji" id="inputGroupSelect01">
                                                <option hidden>Pilih status haji....</option>
                                                <option value="ya" {{ old('is_haji') == 'ya' ? 'selected' : '' }}>Ya</option>
                                                <option value="tidak" {{ old('is_haji') == 'tidak' ? 'selected' : '' }}>Tidak</option>
                                            </select>
                                            @error('is_haji')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-3 mb-3 row">
                                    <label for="inputPassword" class="col-sm-3 col-form-label">Umrah</label>
                                    <div class="col-sm-9">
                                        <div class="input-group">
                                            <select class="custom-select @error('is_umrah') is-invalid @enderror" name="is_umrah" id="inputGroupSelect01">
                                                <option hidden>Pilih status umrah....</option>
                                                <option value="ya" {{ old('is_umrah') == 'ya' ? 'selected' : '' }}>Ya</option>
                                                <option value="tidak" {{ old('is_umrah') == 'tidak' ? 'selected' : '' }}>Tidak</option>
                                            </select>
                                            @error('is_umrah')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            
                                <div class="mt-3 mb-3 row">
                                    <label for="inputPassword" class="col-sm-3 col-form-label">Pengajian rutin</label>
                                    <div class="col-sm-9">
                                        <div class="input-group">
                                            <select class="custom-select @error('is_pengajian_rutin') is-invalid @enderror" name="is_pengajian_rutin" id="inputGroupSelect01">
                                                <option hidden>Pilih status pengajian....</option>
                                                <option value="ya" {{ old('is_pengajian_rutin') == 'ya' ? 'selected' : '' }}>Ya</option>
                                                <option value="tidak" {{ old('is_pengajian_rutin') == 'tidak' ? 'selected' : '' }}>Tidak</option>
                                            </select>
                                            @error('is_pengajian_rutin')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            </div>

                            <div class="text-center mt-4">
                                <button type="button" class="col-md-3 btn btn-secondary mr-3" onclick="onClickLocationBack()">Kembali</button>
                                <button type="submit" class="col-md-3 btn btn-primary">Simpan</button>
                            </div>
                          </div>
                    </form>
                    </div>
                    {{-- <div class="mt-3 p-3 custom-icon">
                        <i class="fas fa-users" style="font-size: 100px;"></i>
                    </div> --}}
                </div>
            </div>
        </div>
        {{-- script --}}
        <!-- Flatpickr JS -->
        <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
        <script src="https://cdn.datatables.net/2.1.3/js/dataTables.js"></script>
        <script src="{{ asset('assets/takmir_masjid/js/addParentData.js') }}"></script>
@endsection
