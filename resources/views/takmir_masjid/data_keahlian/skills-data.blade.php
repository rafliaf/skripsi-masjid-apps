@extends('layout.main-after-login')

@section('container')
<link rel="stylesheet" href="{{ asset('assets/takmir_masjid/css/skillsData.css') }}">
<!-- Include Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.datatables.net/2.1.3/css/dataTables.dataTables.css"/>
        {{-- header --}}
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Data Keahlian</h1>
                        <p class="mt-2">{{ $getData->nama_masjid }}</p>
                    </div>
                    <div class="col-sm-6 mb-3">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item">
                                <a href="" style="text-decoration: none">Data keahlian</a>
                            </li>
                            <li class="breadcrumb-item active">
                                Tampilan data keahlian
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        {{-- content --}}
        <div class="content">
            <div class="container-fluid">
                    <div class="card col-md-12">
                        @if (session()->has('success'))
                            <div class="row justify-content-center mt-4 ms-2 me-2">
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    {{ session('success') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>  
                            </div>
                        @endif
                        {{-- btn --}}
                        <div class="col-md-12 mt-4">
                            <button class="btn btn-success" onclick="onAddJenisKeahlian()">Tambah keahlian</button>
                            <button class="btn btn-success" id="addButton" onclick="onAddKeahlian()" {{ $jenisKeahlianExists ? '' : 'disabled' }}>
                            Tambah data
                            </button>
                        </div>
                        {{-- table --}}
                        <div class="col-md-12 mt-2">
                            <table id="myTable" class="table table-striped">
                                <thead>
                                    <tr>
                                        <th class="custom-header">No</th>
                                        <th>Nama lengkap</th>
                                        <th>Keahlian</th>
                                        <th class="custom-col">Keahlian lain</th>
                                        <th style="text-align: left">No. telepon</th>
                                        <th style="text-align: center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody id="tableBody">
                                    @foreach($dataKeahlian as $index => $keahlian)
                                    <tr>
                                        <td class="custom-cell">{{ $index + 1 }}</td>
                                        <td>{{ $keahlian->dataInduk->nama_lengkap }}</td> <!-- Name from DataInduk -->
                                        <td>{{ $keahlian->jenisKeahlian->jenis_keahlian }}</td> <!-- Skill Type from MdDataKeahlian -->
                                        <td class="custom-col">{{ $keahlian->keahlian_lain ?? '-'}}</td>
                                        <td style="text-align: left">{{ $keahlian->dataInduk->no_wa }}</td> <!-- Phone number from DataInduk -->
                                        <td style="text-align: center">
                                            <a href="{{ route('editDataKeahlian', $keahlian->id) }}" style="text-decoration: none">
                                                <i class="fas fa-edit icon-style-edit mr-1" data-toggle="tooltip" data-placement="top" title="Edit"></i>
                                            </a>                                            
                                            <i class="fas fa-trash-alt icon-style-delete" onclick="onDeleteClicked({{ $keahlian->id }})" data-toggle="tooltip" data-placement="top" title="Hapus"></i>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                    </div>
            </div>
        </div>

        <!-- Modal delete-->
        <div class="modal fade" id="modalDelete" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="mt-3 custom-icon-alert">
                            <i class="bi bi-exclamation-circle"></i>    
                        </div>
                        <h4 class="mt-4" style="text-align: center">
                            Apakah anda yakin ingin menghapus data ini ?
                        </h4>
                        <form id="deleteForm" method="POST" action="">
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
        <script src="{{ asset('assets/takmir_masjid/js/skillsData.js') }}"></script>
@endsection
