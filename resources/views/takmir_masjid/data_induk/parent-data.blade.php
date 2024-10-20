@extends('layout.main-after-login')

@section('container')
 <link rel="stylesheet" href="{{ asset('assets/takmir_masjid/css/parentData.css') }}">
 <link rel="stylesheet" href="https://cdn.datatables.net/2.1.3/css/dataTables.dataTables.css"/>
 <!-- Include Bootstrap CSS -->
 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

        {{-- header --}}
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Data Induk</h1>
                        <p class="mt-2">{{ $getData->nama_masjid }}</p>
                    </div>
                    <div class="col-sm-6 mb-3">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item">
                                <a href="#" style="text-decoration: none">Data induk</a>
                            </li>
                            <li class="breadcrumb-item active">
                                Tampilan data induk
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
                        {{-- alert sukses menambah data --}}
                        @if (session()->has('success'))
                            <div class="row justify-content-center mt-4 ms-1 me-1">
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    {{ session('success') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>  
                            </div>
                        @endif
                        <div class="mt-4 m-3">
                            <button class="btn btn-success" onclick="onAddClicked()">Tambah data</button>
                        </div>
                        <div class="col-md-12">
                            {{-- tablesData --}}
                            <table id="myTable" class="table table-striped">
                                <thead>
                                    <tr>
                                        <th class="custom-header">No</th>
                                        <th>Nama lengkap</th>
                                        <th>Jenis kelamin</th>
                                        <th>Status hubungan</th>
                                        <th style="text-align: left">No. telepon</th>
                                        <th style="text-align: center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody id="tableBody">
                                    @foreach ($dataInduk as $key => $induk)
                                        <tr>
                                            <td class="custom-cell">{{ $key + 1 }}</td>
                                            <td>{{ $induk->nama_lengkap }}</td>
                                            <td>{{ str_replace('_', ' ', ucfirst($induk->jenis_kelamin)) }}</td>
                                            <td>{{ ucfirst($induk->status_hubungan_keluarga) }}</td>
                                            <td style="text-align: left">{{ $induk->no_wa }}</td>
                                            <td style="text-align: center">
                                                <i class="fas fa-edit icon-style-edit mr-1" onclick="onEditClicked({{ $induk->id }})" data-toggle="tooltip" data-placement="top" title="Edit"></i>
                                                <i class="fas fa-trash-alt icon-style-delete" onclick="onDeleteClicked({{ $induk->id }})" data-toggle="tooltip" data-placement="top" title="Delete"></i>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>                                                     
                        </div>
                    </div>
            </div>
        </div>

        <!-- Modal -->
        {{-- modal edit --}}
        <div class="modal fade bd-example-modal-lg" id="modalEdit" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header" style="background-color: #0B689C">
                        <h5 class="modal-title" id="exampleModalLabel" style="color: white">Edit data user</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="onCloseModalEdit()">
                            <span aria-hidden="true" style="color: white">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form style="margin-top: 20px">
                            <div class="form-group row justify-content-center">
                                <label for="inputNama" class="col-sm-2 col-form-label">Nama</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" id="inputNama" placeholder="Nama">
                                </div>
                            </div>
                            <div class="form-group row justify-content-center">
                                <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                                <div class="col-sm-6">
                                    <input type="email" class="form-control" id="inputEmail" placeholder="Email@gmail.com">
                                </div>
                            </div>
                            <div class="form-group row justify-content-center">
                                <label for="inputRole" class="col-sm-2 col-form-label">Role</label>
                                <div class="col-sm-6">
                                    <select class="custom-select" id="inputGroupSelect01">
                                        <option selected>Pilih role sebagai...</option>
                                        <option value="1">Takmir masjid</option>
                                        <option value="2">Remaja masjid</option>
                                        <option value="3">Admin masjid</option>
                                    </select>                                  
                                </div>
                            </div>
                        </form> 
                    </div>
                    <div class="text-center mb-4">
                        <button type="button" class="btn btn-danger col-sm-4" onclick="onCloseModalEdit()">Batal</button>
                        <button type="button" class="btn btn-success col-sm-4" style="margin-left: 20px">Simpan</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Delete -->
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
                        <div class="mt-4 text-center">
                            <button type="button" class="btn btn-danger col-sm-4" onclick="onCloseModalDelete()">Tidak</button>

                            <!-- Form to delete data -->
                            <form id="deleteForm" method="POST" action="" style="display: inline;">
                                @csrf
                                @method('DELETE') <!-- HTTP method spoofing to DELETE -->

                                <button type="submit" class="btn btn-success col-sm-4" style="margin-left: 20px">Ya</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- script --}}
        <script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM=" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/2.1.3/js/dataTables.js"></script>
        <script src="{{ asset('assets/takmir_masjid/js/parentData.js') }}"></script>
         <!-- Include jQuery -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

        <!-- Include Bootstrap JS -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@endsection
