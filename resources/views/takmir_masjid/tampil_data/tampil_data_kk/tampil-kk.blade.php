@extends('layout.main-after-login')

@section('container')
<link rel="stylesheet" href="https://cdn.datatables.net/2.1.3/css/dataTables.dataTables.css"/>
<link rel="stylesheet" href="{{ asset('assets/tampil_data/css/tampilKK.css') }}">
{{-- header --}}
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Tampil Data Kartu Keluarga</h1>
                        <p class="mt-2">{{ $getData->nama_masjid }}</p>
                    </div>
                    <div class="col-sm-6 mb-3">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item">
                                <a href="#">Data kartu keluarga</a>
                            </li>
                            <li class="breadcrumb-item active">
                                Tampilan data kartu keluarga
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        {{-- content --}}
        <div class="content">
            <div class="container-fluid">
                {{-- filter --}}
                <div class="card">
                    <div class="row mb-4 mt-2 ml-2">
                        {{-- RT Filter --}}
                        <div class="col-md-3">
                            <label for="inputRT" class="col-form-label ml-1">RT</label>
                            <div class="input-group">
                                {{-- RT Filter --}}
                                <select class="custom-select" id="inputRT">
                                    <option value="" hidden>- Pilih -</option>
                                    <option value="">Semua data</option>
                                    @foreach($rtValues as $rt)
                                        <option value="{{ $rt }}" {{ request('rt') == $rt ? 'selected' : '' }}>{{ $rt }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        {{-- Jumlah anggota keluarga --}}
                        <div class="col-md-3">
                            <label for="inputJumlahAnggota" class="col-form-label ml-1">Jumlah anggota keluarga</label>
                            <div class="input-group">
                                <select class="custom-select" id="inputJumlahAnggota">
                                    <option value="" hidden>- Pilih -</option>
                                    <option value="">Semua data</option>
                                    <option value="1-3" {{ request('jumlah_anggota') == '1-3' ? 'selected' : '' }}>1-3</option>
                                    <option value="4-6" {{ request('jumlah_anggota') == '4-6' ? 'selected' : '' }}>4-6</option>
                                </select>
                            </div>
                        </div>

                        {{-- Level ekonomi --}}
                        <div class="col-md-3">
                            <label for="inputLevelEkonomi" class="col-form-label ml-1">Level ekonomi</label>
                            <div class="input-group">
                                <select class="custom-select" id="inputLevelEkonomi">
                                    <option value="" hidden>- Pilih -</option>
                                    <option value="">Semua data</option>
                                    <option value="menengah_ke_atas" {{ request('level_ekonomi') == 'menengah_ke_atas' ? 'selected' : '' }}>Menengah ke atas</option>
                                    <option value="menengah" {{ request('level_ekonomi') == 'menengah' ? 'selected' : '' }}>Menengah</option>
                                    <option value="menengah_ke_bawah" {{ request('level_ekonomi') == 'menengah_ke_bawah' ? 'selected' : '' }}>Menengah ke bawah</option>
                                </select>
                            </div>
                        </div>

                        {{-- btn cari --}}
                        <div class="col-md-3 display-flex-btn">
                            <button class="btn btn-info mr-4 custom-btn" onclick="onFilter()">Cari<i class="fa fa-search ml-1"></i></button>
                        </div>
                    </div>
                </div>

                {{-- table --}}
                <div class="card col-md-12">
                    <div class="mt-3 col-md-12">
                        {{-- tablesData --}}
                        <table id="myTable" class="table table-striped">
                            <thead>
                                <tr>
                                    <th class="custom-header">No</th>
                                    <th>Nama kepala keluarga</th>
                                    <th>RT</th>
                                    <th class="center-content">Jumlah anggota keluarga</th>
                                    <th>Level ekonomi</th>
                                    <th style="text-align: left">Kode rumah</th>
                                    <th style="text-align: left">No.telepon</th>
                                    <th class="center-content">Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="tableBody">
                                @foreach ($dataKK as $index => $kk)
                                    <tr>
                                        <td class="custom-cell">{{ $index + 1 }}</td>
                                        <td>{{ $kk->nama_kepala_keluarga }}</td>
                                        <td>{{ $kk->no_rt }}</td>
                                        <td class="center-content">{{ $kk->jumlah_anggota_keluarga }}</td>
                                        <td>{{ str_replace('_', ' ', ucfirst($kk->level_ekonomi)) }}</td>
                                        <td style="text-align: left">{{ $kk->kode_rumah }}</td>
                                        <td style="text-align: left">{{ $kk->no_wa }}</td>
                                        <td style="text-align: center">
                                            <i class="fas fa-eye icon-style-detail mr-1" onclick="onDetailClicked({{ $kk->id }})" data-toggle="tooltip" data-placement="top" title="Detail"></i>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>                            
                        </table>
                    </div>
                </div>
            </div>
        </div>

        {{-- script --}}
        <script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM=" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/2.1.3/js/dataTables.js"></script>
        <script src="{{ asset('assets/tampil_data/js/tampilKK.js') }}"></script>
@endsection
