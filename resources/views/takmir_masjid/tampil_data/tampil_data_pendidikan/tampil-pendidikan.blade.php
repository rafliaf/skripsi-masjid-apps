@extends('layout.main-after-login')

@section('container')
<link rel="stylesheet" href="https://cdn.datatables.net/2.1.3/css/dataTables.dataTables.css"/>
<link rel="stylesheet" href="{{ asset('assets/tampil_data/css/tampilPendidikan.css') }}">
        {{-- header --}}
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Tampil Data Pendidikan</h1>
                        <p class="mt-2">{{ $getData->nama_masjid }}</p>
                    </div>
                    <div class="col-sm-6 mb-3">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item">
                                <a href="#">Data pendidikan</a>
                            </li>
                            <li class="breadcrumb-item active">
                                Tampilan data pendidikan
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
                            <label for="inputRT" class="col-form-label ml-1">RT</label>
                            <div class="input-group">
                                <select class="custom-select" id="inputRT">
                                    <option value="">Semua</option>
                                    @foreach ($dataPendidikan->unique('kartuKeluarga.no_rt') as $data)
                                        <option value="{{ $data->kartuKeluarga->no_rt }}" {{ request('rt') == $data->kartuKeluarga->no_rt ? 'selected' : '' }}>
                                            {{ $data->kartuKeluarga->no_rt }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label for="inputPendidikan" class="col-form-label ml-1">Pendidikan</label>
                            <div class="input-group">
                                <select class="custom-select" id="inputPendidikan">
                                    <option value="">Semua</option>
                                    @foreach ($dataPendidikan->unique('pendidikan_name') as $data)
                                        <option value="{{ $data->pendidikan }}" {{ request('pendidikan') == $data->pendidikan ? 'selected' : '' }}>
                                            {{ $data->pendidikan_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label for="inputNama" class="col-form-label ml-1">Nama</label>
                            <div class="input-group">
                                <select class="custom-select" id="inputNama">
                                    <option value="">Semua</option>
                                    @foreach ($dataPendidikan->unique('nama_lengkap') as $data)
                                        <option value="{{ $data->nama_lengkap }}" {{ request('nama') == $data->nama_lengkap ? 'selected' : '' }}>
                                            {{ $data->nama_lengkap }}
                                        </option>
                                    @endforeach
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
                                    <th>Pendidikan</th>
                                    <th class="center-content">RT</th>
                                    <th style="text-align: left">No.telepon</th>
                                    <th class="center-content">Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="tableBody">
                                @foreach ($dataPendidikan as $index => $dataPendidikan)
                                    <tr>
                                        <td class="custom-cell">{{ $index + 1 }}</td>
                                        <td>{{ $dataPendidikan->nama_lengkap }}</td>
                                        <td>{{ $dataPendidikan->pendidikan_name }}</td>
                                        <td class="center-content">{{ $dataPendidikan->kartuKeluarga->no_rt }}</td>
                                        <td style="text-align: left">{{ $dataPendidikan->no_wa }}</td>
                                        <td style="text-align: center">
                                            <i class="fas fa-eye icon-style-detail mr-1" onclick="onDetailClicked({{ $dataPendidikan->id }})" data-toggle="tooltip" data-placement="top" title="Detail"></i>
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
        <script src="{{ asset('assets/tampil_data/js/tampilPendidikan.js') }}"></script>
@endsection
