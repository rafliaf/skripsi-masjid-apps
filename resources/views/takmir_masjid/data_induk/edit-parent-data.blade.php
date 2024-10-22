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
                        <h1 class="m-0">Edit Data Induk</h1>
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
            {{-- errors --}}
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
        </div>
        {{-- content --}}
        <div class="content">
            <div class="container-fluid">
                {{-- <div class="card">
                    <h3 class="p-3">Form User</h3>
                </div> --}}
                <div class="card">
                    <h5 class="card-header">Form edit data induk</h5>
                    <div class="card-body">
                    <form action="{{ route('data_induk.update', $dataInduk->id) }}" method="POST">
                        @csrf
                        @method('PUT')
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
                                            <select class="custom-select" id="inputGroupSelect01" name="kartu_keluarga_id">
                                                <option hidden>Pilih nama kepala keluarga...</option>
                                                @foreach($dataKartuKeluarga as $kk)
                                                    <option value="{{ $kk->id }}" {{ old('kartu_keluarga_id', $dataInduk->kartu_keluarga_id ?? '') == $kk->id ? 'selected' : '' }}>
                                                        {{ $kk->nama_kepala_keluarga }}
                                                    </option>
                                                @endforeach
                                            </select>                                            
                                        </div>                                    
                                    </div>
                                </div>
                                <div class="mt-3 mb-3 row">
                                    <label for="nik" class="col-sm-3 col-form-label">NIK</label>
                                    <div class="col-sm-9">
                                      <input type="text" class="form-control" name="nik" id="nik" value="{{ old('nik', $dataInduk->nik) }}"  placeholder="Masukkan NIK...">
                                    </div>
                                </div>
                                <div class="mt-3 mb-3 row">
                                    <label for="namaLengkap" class="col-sm-3 col-form-label">Nama lengkap</label>
                                    <div class="col-sm-9">
                                      <input type="text" class="form-control" name="nama_lengkap" id="namaLengkap" value="{{ old('nama_lengkap', $dataInduk->nama_lengkap) }}" placeholder="Masukkan nama lengkap...">
                                    </div>
                                </div>
                                <div class="mt-3 mb-3 row">
                                    <label for="statusHubunganKeluarga" class="col-sm-3 col-form-label">Status hubungan keluarga</label>
                                    <div class="col-sm-9">
                                      <input type="text" class="form-control" name="status_hubungan_keluarga" id="statusHubunganKeluarga" value="{{ old('status_hubungan_keluarga', $dataInduk->status_hubungan_keluarga) }}"  placeholder="Masukkan status hubungan...">
                                    </div>
                                </div>
                                <div class="mt-3 mb-3 row">
                                    <label for="tempatLahir" class="col-sm-3 col-form-label">Tempat lahir</label>
                                    <div class="col-sm-9">
                                      <input type="text" class="form-control" name="tempat_lahir" id="tempatLahir" value="{{ old('tempat_lahir', $dataInduk->tempat_lahir) }}"  placeholder="Masukkan tempat lahir...">
                                    </div>
                                </div>
                                <div class="mt-3 mb-3 row">
                                    <label class="col-sm-3 col-form-label">Tanggal lahir</label>
                                    <div class="col-sm-9">
                                        <div class="input-group">
                                            <input type="text" id="inputTanggal" class="form-control" placeholder="Pilih tanggal lahir" 
                                                   value="{{ old('tgl_lahir', isset($dataInduk->tgl_lahir) ? \Carbon\Carbon::parse($dataInduk->tgl_lahir)->format('d F Y') : '') }}">
                                            <input type="hidden" name="tgl_lahir" id="hiddenDate" 
                                                   value="{{ old('tgl_lahir', isset($dataInduk->tgl_lahir) ? $dataInduk->tgl_lahir : '') }}"> <!-- Hidden field to store formatted date -->
                                            <span class="input-group-text" id="inputTanggal" style="border-radius: 0px 5px 5px 0px; cursor: pointer; background-color: #fdfbfb; color: #0B689C">
                                                <i class="fas fa-calendar-alt"></i>
                                            </span>
                                        </div>                                        
                                    </div>
                                </div>
                                <div class="mt-3 mb-3 row">
                                    <label for="inputPassword" class="col-sm-3 col-form-label">Jenis kelamin</label>
                                    <div class="col-sm-9">
                                        <div class="input-group">
                                            <select class="custom-select" name="jenis_kelamin" id="inputGroupSelect01">
                                                <option hidden>Pilih jenis kelamin....</option>
                                                <option value="laki_laki" {{ old('jenis_kelamin', $dataInduk->jenis_kelamin ?? '') == 'laki_laki' ? 'selected' : '' }}>Laki-laki</option>
                                                <option value="perempuan" {{ old('jenis_kelamin', $dataInduk->jenis_kelamin ?? '') == 'perempuan' ? 'selected' : '' }}>Perempuan</option>
                                            </select>
                                        </div>                                        
                                    </div>
                                </div>
                                <div class="mt-3 mb-3 row">
                                    <label for="pendidikan" class="col-sm-3 col-form-label">Pendidikan</label>
                                    <div class="col-sm-9">
                                        <div class="input-group">
                                            <select class="custom-select" name="pendidikan" id="inputGroupSelect01">
                                                <option hidden>Pilih pendidikan....</option>
                                                <option value="belum_sekolah" {{ old('pendidikan', $dataInduk->pendidikan ?? '') == 'belum_sekolah' ? 'selected' : '' }}>Tidak/belum sekolah</option>
                                                <option value="paud" {{ old('pendidikan', $dataInduk->pendidikan ?? '') == 'paud' ? 'selected' : '' }}>PAUD</option>
                                                <option value="tk" {{ old('pendidikan', $dataInduk->pendidikan ?? '') == 'tk' ? 'selected' : '' }}>TK/taman kanak-kanak</option>
                                                <option value="sd" {{ old('pendidikan', $dataInduk->pendidikan ?? '') == 'sd' ? 'selected' : '' }}>SD/sekolah dasar</option>
                                                <option value="smp" {{ old('pendidikan', $dataInduk->pendidikan ?? '') == 'smp' ? 'selected' : '' }}>SMP/sederajat</option>
                                                <option value="smk" {{ old('pendidikan', $dataInduk->pendidikan ?? '') == 'smk' ? 'selected' : '' }}>SMK/sederajat</option>
                                                <option value="sma" {{ old('pendidikan', $dataInduk->pendidikan ?? '') == 'sma' ? 'selected' : '' }}>SMA/sederajat</option>
                                                <option value="d1" {{ old('pendidikan', $dataInduk->pendidikan ?? '') == 'd1' ? 'selected' : '' }}>Diploma I</option>
                                                <option value="d2" {{ old('pendidikan', $dataInduk->pendidikan ?? '') == 'd2' ? 'selected' : '' }}>Diploma II</option>
                                                <option value="d3" {{ old('pendidikan', $dataInduk->pendidikan ?? '') == 'd3' ? 'selected' : '' }}>Diploma III</option>
                                                <option value="d4" {{ old('pendidikan', $dataInduk->pendidikan ?? '') == 'd4' ? 'selected' : '' }}>Diploma IV</option>
                                                <option value="s1" {{ old('pendidikan', $dataInduk->pendidikan ?? '') == 's1' ? 'selected' : '' }}>Sarjana S1</option>
                                                <option value="s2" {{ old('pendidikan', $dataInduk->pendidikan ?? '') == 's2' ? 'selected' : '' }}>Sarjana S2</option>
                                                <option value="s3" {{ old('pendidikan', $dataInduk->pendidikan ?? '') == 's3' ? 'selected' : '' }}>Sarjana S3</option>
                                            </select>                                            
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-3 mb-3 row">
                                    <label for="pekerjaan" class="col-sm-3 col-form-label">Pekerjaan</label>
                                    <div class="col-sm-9">
                                      <input type="text" class="form-control" name="pekerjaan" id="pekerjaan" value="{{ old('pekerjaan', $dataInduk->pekerjaan) }}" placeholder="Masukkan pekerjaan...">
                                    </div>
                                </div>
                                <div class="form-group row justify-content-center">
                                    <label for="noWa" class="col-md-3 col-form-label">Nomor Telepon / WA</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="no_wa" id="noWa" value="{{ old('no_wa', $dataInduk->no_wa) }}" placeholder="Nomor telepon / WA">
                                    </div>
                                </div>
                                <div class="mt-3 mb-3 row">
                                    <label for="inputPassword" class="col-sm-3 col-form-label">Status kawin</label>
                                    <div class="col-sm-9">
                                        <div class="input-group">
                                            <select class="custom-select" name="status_kawin" id="inputGroupSelect01">
                                                <option hidden >Pilih status kawin....</option>
                                                <option value="menikah" {{ old('status_kawin', $dataInduk->status_kawin ?? '') == 'menikah' ? 'selected' : '' }}>Menikah</option>
                                                <option value="belum_menikah" {{ old('status_kawin', $dataInduk->status_kawin ?? '') == 'belum_menikah' ? 'selected' : '' }}>Belum menikah</option>
                                                <option value="duda" {{ old('status_kawin', $dataInduk->status_kawin ?? '') == 'duda' ? 'selected' : '' }}>Duda</option>
                                                <option value="janda" {{ old('status_kawin', $dataInduk->status_kawin ?? '') == 'janda' ? 'selected' : '' }}>Janda</option>
                                              </select>
                                        </div>                                    
                                    </div>
                                </div>
                                <div class="mt-3 mb-3 row">
                                    <label for="inputPassword" class="col-sm-3 col-form-label">Remaja masjid</label>
                                    <div class="col-sm-9">
                                        <div class="input-group">
                                            <select class="custom-select" name="is_remaja_masjid" id="inputGroupSelect01">
                                                <option hidden >Pilih status remaja masjid....</option>
                                                <option value="ya"  {{ old('is_remaja_masjid', $dataInduk->is_remaja_masjid ?? '') == 'ya' ? 'selected' : '' }}>Ya</option>
                                                <option value="tidak" {{ old('is_remaja_masjid', $dataInduk->is_remaja_masjid ?? '') == 'tidak' ? 'selected' : '' }}>Tidak</option>
                                              </select>
                                        </div>                                   
                                     </div>
                                </div>
                                <div class="mt-3 mb-3 row">
                                    <label for="inputPassword" class="col-sm-3 col-form-label">Status mukim</label>
                                    <div class="col-sm-9">
                                        <div class="input-group">
                                            <select class="custom-select"  name="is_status_mukim" id="inputGroupSelect01">
                                                <option hidden >Pilih status mukim....</option>
                                                <option value="ya"  {{ old('is_status_mukim', $dataInduk->is_status_mukim ?? '') == 'ya' ? 'selected' : '' }}>Mukim</option>
                                                <option value="tidak" {{ old('is_status_mukim', $dataInduk->is_status_mukim ?? '') == 'tidak' ? 'selected' : '' }}>Bukan mukim</option>
                                              </select>
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
                                            <select class="custom-select" name="is_baca_latin" id="inputGroupSelect01">
                                                <option hidden >Pilih status baca....</option>
                                                <option value="ya" {{ old('is_status_mukim', $dataInduk->is_status_mukim ?? '') == 'ya' ? 'selected' : '' }}>Ya</option>
                                                <option value="tidak" {{ old('is_baca_latin', $dataInduk->is_baca_latin ?? '') == 'tidak' ? 'selected' : '' }}>Tidak</option>
                                              </select>                                    
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-3 mb-3 row">
                                    <label for="inputPassword" class="col-sm-3 col-form-label">Baca hijaiyah</label>
                                    <div class="col-sm-9">
                                        <div class="input-group">
                                            <select class="custom-select" name="is_baca_hijaiyah" id="inputGroupSelect01">
                                                <option hidden >Pilih status baca....</option>
                                                <option value="ya" {{ old('is_baca_hijaiyah', $dataInduk->is_baca_hijaiyah ?? '') == 'ya' ? 'selected' : '' }}>Ya</option>
                                                <option value="tidak" {{ old('is_baca_hijaiyah', $dataInduk->is_baca_hijaiyah ?? '') == 'tidak' ? 'selected' : '' }}>Tidak</option>
                                              </select>                                    
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-3 mb-3 row">
                                    <label for="inputPassword" class="col-sm-3 col-form-label">Baca iqro</label>
                                    <div class="col-sm-9">
                                        <div class="input-group">
                                            <select class="custom-select" name="is_baca_iqro" id="inputGroupSelect01">
                                                <option hidden >Pilih status baca....</option>
                                                <option value="ya" {{ old('is_baca_iqro', $dataInduk->is_baca_iqro ?? '') == 'ya' ? 'selected' : '' }}>Ya</option>
                                                <option value="tidak" {{ old('is_baca_iqro', $dataInduk->is_baca_iqro ?? '') == 'tidak' ? 'selected' : '' }}>Tidak</option>
                                              </select>                                    
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-3 mb-3 row">
                                    <label for="inputPassword" class="col-sm-3 col-form-label">Baca Al-Qur'an</label>
                                    <div class="col-sm-9">
                                        <div class="input-group">
                                            <select class="custom-select" name="is_baca_quran" id="inputGroupSelect01">
                                                <option hidden >Pilih status baca....</option>
                                                <option value="ya" {{ old('is_baca_quran', $dataInduk->is_baca_quran ?? '') == 'ya' ? 'selected' : '' }}>Ya</option>
                                                <option value="tidak" {{ old('is_baca_quran', $dataInduk->is_baca_quran ?? '') == 'tidak' ? 'selected' : '' }}>Tidak</option>
                                              </select>                                    
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-3 mb-3 row">
                                    <label for="inputPassword" class="col-sm-3 col-form-label">Sholat 5 waktu</label>
                                    <div class="col-sm-9">
                                        <div class="input-group">
                                            <select class="custom-select" name="is_sholat_5_waktu" id="inputGroupSelect01">
                                                <option hidden >Pilih status sholat....</option>
                                                <option value="ya" {{ old('is_sholat_5_waktu', $dataInduk->is_sholat_5_waktu ?? '') == 'ya' ? 'selected' : '' }}>Ya</option>
                                                <option value="tidak" {{ old('is_sholat_5_waktu', $dataInduk->is_sholat_5_waktu ?? '') == 'tidak' ? 'selected' : '' }}>Tidak</option>
                                              </select>                                    
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-3 mb-3 row">
                                    <label for="inputPassword" class="col-sm-3 col-form-label">Sholat berjamaah</label>
                                    <div class="col-sm-9">
                                        <div class="input-group">
                                            <select class="custom-select" name="is_sholat_berjamaah" id="inputGroupSelect01">
                                                <option hidden >Pilih status sholat....</option>
                                                <option value="ya" {{ old('is_sholat_berjamaah', $dataInduk->is_sholat_berjamaah ?? '') == 'ya' ? 'selected' : '' }}>Ya</option>
                                                <option value="tidak" {{ old('is_sholat_berjamaah', $dataInduk->is_sholat_berjamaah ?? '') == 'tidak' ? 'selected' : '' }}>Tidak</option>
                                              </select>                                    
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-3 mb-3 row">
                                    <label for="inputPassword" class="col-sm-3 col-form-label">Zakat fitrah</label>
                                    <div class="col-sm-9">
                                        <div class="input-group">
                                            <select class="custom-select" name="is_zakat_fitrah" id="inputGroupSelect01">
                                                <option hidden >Pilih status zakat....</option>
                                                <option value="ya" {{ old('is_zakat_fitrah', $dataInduk->is_zakat_fitrah ?? '') == 'ya' ? 'selected' : '' }}>Ya</option>
                                                <option value="tidak" {{ old('is_zakat_fitrah', $dataInduk->is_zakat_fitrah ?? '') == 'tidak' ? 'selected' : '' }}>Tidak</option>
                                              </select>                                    
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-3 mb-3 row">
                                    <label for="inputPassword" class="col-sm-3 col-form-label">Zakat mal</label>
                                    <div class="col-sm-9">
                                        <div class="input-group">
                                            <select class="custom-select" name="is_zakat_mal" id="inputGroupSelect01">
                                                <option hidden >Pilih status zakat....</option>
                                                <option value="ya" {{ old('is_zakat_mal', $dataInduk->is_zakat_mal ?? '') == 'ya' ? 'selected' : '' }}>Ya</option>
                                                <option value="tidak" {{ old('is_zakat_mal', $dataInduk->is_zakat_mal ?? '') == 'tidak' ? 'selected' : '' }}>Tidak</option>
                                              </select>                                    
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-3 mb-3 row">
                                    <label for="inputPassword" class="col-sm-3 col-form-label">Kurban</label>
                                    <div class="col-sm-9">
                                        <div class="input-group">
                                            <select class="custom-select" name="is_kurban" id="inputGroupSelect01">
                                                <option hidden >Pilih status kurban....</option>
                                                <option value="ya" {{ old('is_kurban', $dataInduk->is_kurban ?? '') == 'ya' ? 'selected' : '' }}>Ya</option>
                                                <option value="tidak" {{ old('is_kurban', $dataInduk->is_kurban ?? '') == 'tidak' ? 'selected' : '' }}>Tidak</option>
                                              </select>                                    
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-3 mb-3 row">
                                    <label for="inputPassword" class="col-sm-3 col-form-label">Haji</label>
                                    <div class="col-sm-9">
                                        <div class="input-group">
                                            <select class="custom-select" name="is_haji" id="inputGroupSelect01">
                                                <option hidden >Pilih status haji....</option>
                                                <option value="ya" {{ old('is_haji', $dataInduk->is_haji ?? '') == 'ya' ? 'selected' : '' }}>Ya</option>
                                                <option value="tidak" {{ old('is_haji', $dataInduk->is_haji ?? '') == 'tidak' ? 'selected' : '' }}>Tidak</option>
                                              </select>                                    
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-3 mb-3 row">
                                    <label for="inputPassword" class="col-sm-3 col-form-label">Umrah</label>
                                    <div class="col-sm-9">
                                        <div class="input-group">
                                            <select class="custom-select" name="is_umrah" id="inputGroupSelect01">
                                                <option hidden >Pilih status haji....</option>
                                                <option value="ya" {{ old('is_umrah', $dataInduk->is_umrah ?? '') == 'ya' ? 'selected' : '' }}>Ya</option>
                                                <option value="tidak" {{ old('is_umrah', $dataInduk->is_umrah ?? '') == 'tidak' ? 'selected' : '' }}>Tidak</option>
                                              </select>                                    
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-3 mb-3 row">
                                    <label for="inputPassword" class="col-sm-3 col-form-label">Pengajian rutin</label>
                                    <div class="col-sm-9">
                                        <div class="input-group">
                                            <select class="custom-select" name="is_pengajian_rutin" id="inputGroupSelect01">
                                                <option hidden >Pilih status pengajian....</option>
                                                <option value="ya" {{ old('is_pengajian_rutin', $dataInduk->is_pengajian_rutin ?? '') == 'ya' ? 'selected' : '' }}>Ya</option>
                                                <option value="tidak" {{ old('is_pengajian_rutin', $dataInduk->is_pengajian_rutin ?? '') == 'tidak' ? 'selected' : '' }}>Tidak</option>
                                              </select>                                    
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="text-center mt-5">
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
