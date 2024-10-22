@extends('layout.main-after-login')

@section('container')
<link rel="stylesheet" href="https://cdn.datatables.net/2.1.3/css/dataTables.dataTables.css"/>
<link rel="stylesheet" href="{{ asset('assets/tampil_data/css/tampilJamaah.css') }}">
        {{-- header --}}
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Tampil Data Jamaah</h1>
                        <p class="mt-2">{{ $getData->nama_masjid }}</p>
                    </div>
                    <div class="col-sm-6 mb-3">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item">
                                <a href="#">Data jamaah</a>
                            </li>
                            <li class="breadcrumb-item active">
                                Tampilan data jamaah
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        {{-- content --}}
        <div class="content">
            <div class="container-fluid">
                {{-- Filter --}}
                <div class="card">
                    <div class="row mb-4 mt-2 ml-2">
                        <div class="col-md-3">
                            <label for="inputRT" class="col-form-label ml-1">Status mukim</label>
                            <div class="input-group">
                                <select class="custom-select" id="inputRT">
                                    <option value="" hidden>- Pilih -</option>
                                    <option value="ya" {{ request('status_mukim') == 'ya' ? 'selected' : '' }}>Ya</option>
                                    <option value="tidak" {{ request('status_mukim') == 'tidak' ? 'selected' : '' }}>Tidak</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label for="inputBaca" class="col-form-label ml-1">Remaja masjid</label>
                            <div class="input-group">
                                <select class="custom-select" id="inputBaca">
                                    <option value="" hidden>- Pilih -</option>
                                    <option value="ya" {{ request('remaja_masjid') == 'ya' ? 'selected' : '' }}>Ya</option>
                                    <option value="tidak" {{ request('remaja_masjid') == 'tidak' ? 'selected' : '' }}>Tidak</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label for="inputRemaja" class="col-form-label ml-1">Jamaah pengajian</label>
                            <div class="input-group">
                                <select class="custom-select" id="inputRemaja">
                                    <option value="" hidden>- Pilih -</option>
                                    <option value="ya" {{ request('jamaah_pengajian') == 'ya' ? 'selected' : '' }}>Ya</option>
                                    <option value="tidak" {{ request('jamaah_pengajian') == 'tidak' ? 'selected' : '' }}>Tidak</option>
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
                                    <th>Nama</th>
                                    <th style="text-align: left">Umur</th>
                                    <th style="text-align: left">Status hubungan</th>
                                    <th class="center-content">Status mukim</th>
                                    <th class="center-content">Remaja masjid</th>
                                    <th class="center-content">Jamaah pengajian</th>
                                    <th style="text-align: left">No.telepon</th>
                                    <th class="center-content">Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="tableBody">
                                @foreach ( $dataJamaah as $index => $jamaahData)
                                <tr>
                                    <td class="custom-cell">{{ $index + 1 }}</td>
                                    <td>{{ $jamaahData->nama_lengkap ?? '-' }}</td>
                                    <td style="text-align: left">{{ \Carbon\Carbon::parse($jamaahData->tgl_lahir)->age ?? '-' }}</td>
                                    <td style="text-align: left">{{ $jamaahData->status_hubungan_keluarga }}</td>
                                    <td class="center-content">{{ ucfirst($jamaahData->is_status_mukim) }}</td>
                                    <td class="center-content">{{ ucfirst($jamaahData->is_remaja_masjid) }}</td>
                                    <td class="center-content">{{ ucfirst($jamaahData->is_pengajian_rutin) }}</td>
                                    <td style="text-align: left">{{ $jamaahData->no_wa ?? '-'}}</td>
                                    <td style="text-align: center">
                                        <i class="fas fa-eye icon-style-detail mr-1" onclick="onDetailClicked({{ $jamaahData->id }})" data-toggle="tooltip" data-placement="top" title="Detail"></i>
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
        <script src="{{ asset('assets/tampil_data/js/tampilJamaah.js') }}"></script>
@endsection
