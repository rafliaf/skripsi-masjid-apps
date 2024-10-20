@extends('layout.main-after-login')

@section('container')
<link rel="stylesheet" href="https://cdn.datatables.net/2.1.3/css/dataTables.dataTables.css"/>
<link rel="stylesheet" href="{{ asset('assets/tampil_data/css/tampilKeahlian.css') }}">

    {{-- header --}}
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Tampil Data Keahlian</h1>
                    <p class="mt-2">{{ $getData->nama_masjid }}</p>
                </div>
                <div class="col-sm-6 mb-3">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a href="#">Data keahlian</a>
                        </li>
                        <li class="breadcrumb-item active">Tampilan data keahlian</li>
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
                        <label for="inputMukim" class="col-form-label ml-1">Status mukim</label>
                        <div class="input-group">
                            <select class="custom-select" id="inputMukim">
                                <option value="">Semua</option>
                                <option value="ya" {{ request('status_mukim') == 'ya' ? 'selected' : '' }}>Ya</option>
                                <option value="tidak" {{ request('status_mukim') == 'tidak' ? 'selected' : '' }}>Tidak</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <label for="inputBaca" class="col-form-label ml-1">Keahlian</label>
                        <div class="input-group">
                            <select class="custom-select" id="inputBaca">
                                <option value="">Semua</option>
                                @foreach ($mdDataKeahlian as $mdKeahlian)
                                    <option value="{{ $mdKeahlian->jenis_keahlian }}" {{ request('keahlian') == $mdKeahlian->jenis_keahlian ? 'selected' : '' }}>
                                        {{ $mdKeahlian->jenis_keahlian }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <label for="inputRemaja" class="col-form-label ml-1">Sertifikat</label>
                        <div class="input-group">
                            <select class="custom-select" id="inputRemaja">
                                <option value="">Semua</option>
                                <option value="ya" {{ request('sertifikat') == 'ya' ? 'selected' : '' }}>Ya</option>
                                <option value="tidak" {{ request('sertifikat') == 'tidak' ? 'selected' : '' }}>Tidak</option>
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
                                <th>Keahlian</th>
                                <th>Deskripsi keahlian</th>
                                <th style="text-align: center">Sertifikat</th>
                                <th style="text-align: center">Status mukim</th>
                                <th style="text-align: left">No.telepon</th>
                                <th class="center-content">Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="tableBody">
                            {{-- Loop through $dataKeahlian to populate the table --}}
                            @foreach ($dataKeahlian as $index => $keahlian)
                            <tr>
                                <td class="custom-cell">{{ $index + 1 }}</td>
                                <td>{{ $keahlian->dataInduk->nama_lengkap ?? '-' }}</td>
                                <td>{{ $keahlian->jenisKeahlian->jenis_keahlian ?? '-' }}</td>
                                <td>{{ $keahlian->deskripsi_keahlian ?? '-' }}</td>
                                <td style="text-align: center">{{ ucfirst($keahlian->is_sertifikat) }}</td>
                                <td style="text-align: center">{{ ucfirst($keahlian->dataInduk->is_status_mukim ?? '-' )}}</td>
                                <td style="text-align: left">{{ $keahlian->dataInduk->no_wa ?? '-' }}</td>
                                <td style="text-align: center">
                                    <i class="fas fa-eye icon-style-detail mr-1" onclick="onDetailClicked({{ $keahlian->id }})" data-toggle="tooltip" data-placement="top" title="Detail"></i>
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
    <script src="https://code.jquery.com/jquery-3.7.0.js" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/2.1.3/js/dataTables.js"></script>
    <script src="{{ asset('assets/tampil_data/js/tampilKeahlian.js') }}"></script>

    <script>
        // Detail button click handler
        function onDetailClicked(id) {
            // Redirect to the detail page for the selected keahlian
            window.location.href = '/dashboard/tampil_data_keahlian/read/' + id;
        }
    </script>
@endsection
