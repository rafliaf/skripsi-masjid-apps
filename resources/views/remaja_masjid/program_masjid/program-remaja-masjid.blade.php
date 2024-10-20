@extends('layout.main-after-login')

@section('container')
<link rel="stylesheet" href="https://cdn.datatables.net/2.1.3/css/dataTables.dataTables.css"/>
<link rel="stylesheet" href="{{ asset('assets/remaja_masjid/css/programRemajaMasjid.css') }}">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        {{-- header --}}
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Program Remaja Masjid</h1>
                        <p class="mt-2">{{ $getData->nama_masjid }}</p>
                    </div>
                    <div class="col-sm-6 mb-3">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item">
                                <a href="#" style="text-decoration: none;">Program remaja masjid</a>
                            </li>
                            <li class="breadcrumb-item active">
                                Tampilan program remaja masjid
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        {{-- content --}}
        <div class="content">
            <div class="container-fluid">
                {{-- table --}}
                <div class="card col-md-12">
                    {{-- alert --}}
                    @if (session()->has('success'))
                        <div class="row justify-content-center mt-4 ms-2 me-2">
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>  
                        </div>
                    @endif
                    {{-- btn --}}
                    <div class="m-3">
                        <button class="btn btn-success" onclick="onAddClicked()">Tambah program</button>
                    </div>
                    <div class="col-md-12">
                        {{-- tablesData --}}
                        <table id="myTable" class="table table-striped">
                            <thead>
                                <tr>
                                    <th class="custom-header">No</th>
                                    <th class="middle">Nama kegiatan</th>
                                    <th class="middle">Tanggal mulai</th>
                                    <th class="middle">Tanggal selesai</th>
                                    <th class="middle">Lokasi</th>
                                    <th style="text-align: center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="tableBody">
                                @foreach ($programs as $index => $program)
                                    <tr>
                                        <td class="custom-cell">{{ $index + 1 }}</td>
                                        <td>{{ $program->nama_kegiatan }}</td>
                                        <td>{{ \Carbon\Carbon::parse($program->tgl_mulai)->format('d F Y H:i') }} WIB</td>
                                        <td>{{ \Carbon\Carbon::parse($program->tgl_selesai)->format('d F Y H:i') }} WIB</td>
                                        <td>{{ $program->lokasi_kegiatan }}</td>
                                        <td style="text-align: center">
                                            <i class="fas fa-edit icon-style-edit mr-1" onclick="onEditClicked({{ $program->id }})" data-toggle="tooltip" data-placement="top" title="Edit"></i>
                                            <i class="fas fa-eye icon-style-detail mr-1" onclick="onDetailClicked({{ $program->id }})" data-toggle="tooltip" data-placement="top" title="Detail"></i>
                                            <i class="fas fa-trash-alt icon-style-delete" onclick="onDeleteClicked({{ $program->id }})" data-toggle="tooltip" data-placement="top" title="Delete"></i>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal konfirmasi delete -->
        <div class="modal fade" id="modalDelete" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="mt-3 custom-icon-alert">
                            <i class="bi bi-exclamation-circle"></i>    
                        </div>
                        <h4 class="mt-4" style="text-align: center">
                            Apakah anda yakin ingin menghapus data ini?
                        </h4>
                        <form id="formDeleteProgram" method="POST">
                            @csrf
                            @method('DELETE')
                            <div class="mt-4 text-center">
                                <button type="button" class="btn btn-danger col-sm-4" onclick="onCloseModalDelete()">Tidak</button>
                                <button type="submit" class="btn btn-success col-sm-4" style="margin-left: 20px">Ya</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
   

        {{-- script --}}
        <script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM=" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/2.1.3/js/dataTables.js"></script>
        <script src="{{ asset('assets/remaja_masjid/js/programRemajaMasjid.js') }}"></script>
@endsection
