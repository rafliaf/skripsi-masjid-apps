@extends('layout.main-after-login')

@section('container')
<link rel="stylesheet" href="https://cdn.datatables.net/2.1.3/css/dataTables.dataTables.css"/>
<link rel="stylesheet" href="{{ asset('assets/tampil_data/css/tampilKemampuan.css') }}">
        {{-- header --}}
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Tampil Data Kemampuan</h1>
                        <p class="mt-2">{{ $getData->nama_masjid }}</p>
                    </div>
                    <div class="col-sm-6 mb-3">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item">
                                <a href="#">Data kemampuan</a>
                            </li>
                            <li class="breadcrumb-item active">
                                Tampilan data kemampuan
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
                        <div class="col-md-3">
                            <label for="inputBacaQuran" class="col-form-label ml-1">Baca Al-Qur'an</label>
                            <div class="input-group">
                                {{-- Baca Al-Qur'an Filter --}}
                                <select class="custom-select" id="inputBacaQuran">
                                    <option value="" hidden>- Pilih -</option>
                                    <option value="ya" {{ request('baca_quran') == 'ya' ? 'selected' : '' }}>Ya</option>
                                    <option value="tidak" {{ request('baca_quran') == 'tidak' ? 'selected' : '' }}>Tidak</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label for="inputBacaIqro" class="col-form-label ml-1">Baca Iqro</label>
                            <div class="input-group">
                                {{-- Baca Iqro Filter --}}
                                <select class="custom-select" id="inputBacaIqro">
                                    <option value="" hidden>- Pilih -</option>
                                    <option value="ya" {{ request('baca_iqro') == 'ya' ? 'selected' : '' }}>Ya</option>
                                    <option value="tidak" {{ request('baca_iqro') == 'tidak' ? 'selected' : '' }}>Tidak</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label for="inputBacaHijaiyah" class="col-form-label ml-1">Baca Hijaiyah</label>
                            <div class="input-group">
                                {{-- Baca Hijaiyah Filter --}}
                                <select class="custom-select" id="inputBacaHijaiyah">
                                    <option value="" hidden>- Pilih -</option>
                                     <option value="tidak" {{ request('baca_hijaiyah') == 'tidak' ? 'selected' : '' }}>Tidak</option>
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
                                    <th class="center-content">RT</th>
                                    <th class="center-content">Baca latin</th>
                                    <th class="center-content">Baca hijaiyah</th>
                                    <th class="center-content">Baca iqro</th>
                                    <th class="center-content">Baca Al-Qur'an</th>
                                    <th class="center-content">Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="tableBody">
                                @foreach ($dataKemampuan as $index => $dk )  
                                    <tr>
                                        <td class="custom-cell">{{ $index + 1 }}</td>
                                        <td>{{ $dk->nama_lengkap }}</td>
                                        <td class="center-content">{{ $dk->kartuKeluarga->no_rt }}</td>
                                        <td class="center-content">{{ ucfirst($dk->is_baca_latin) }}</td>
                                        <td class="center-content">{{ ucfirst($dk->is_baca_hijaiyah) }}</td>
                                        <td class="center-content">{{ ucfirst($dk->is_baca_iqro) }}</td>
                                        <td class="center-content">{{ ucfirst($dk->is_baca_quran) }}</td>
                                        <td style="text-align: center">
                                            <i class="fas fa-eye icon-style-detail mr-1" onclick="onDetailClicked({{ $dk->id }})" data-toggle="tooltip" data-placement="top" title="Detail"></i>
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
        <script src="{{ asset('assets/tampil_data/js/tampilKemampuan.js') }}"></script>
@endsection
