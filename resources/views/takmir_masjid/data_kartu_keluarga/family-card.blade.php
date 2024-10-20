@extends('layout.main-after-login')

@section('container')
    <link rel="stylesheet" href="{{ asset('assets/takmir_masjid/css/familyCard.css') }}">

    <!-- Include Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Include jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Include Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.3/css/dataTables.dataTables.css"/>
    {{-- <link rel="stylesheet" href="assets/takmir_masjid/css/familyCard.css"> --}}
            {{-- header --}}
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">Data Kartu Keluarga</h1>
                            <p class="mt-2">{{ $getData->nama_masjid }}</p>
                        </div>
                        <div class="col-sm-6 mb-3">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item">
                                    <a href="#" style="text-decoration: none">Data kartu keluarga</a>
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
                        {{-- alert success menambah data --}}
                        <div class="card col-md-12">
                            @if (session()->has('success'))
                                <div class="row justify-content-center mt-4 ms-2 me-2">
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
                                            <th>Nama kepala keluarga</th>
                                            <th>Level ekonomi</th>
                                            <th class="center-col">Jumlah anggota keluarga</th>
                                            <th>RT</th>
                                            <th style="text-align: left">No. telepon</th>
                                            <th class="center-col">Kode rumah</th>
                                            <th style="text-align: center">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tableBody">
                                        @foreach ($dataKartuKeluarga as $index => $data)
                                        <tr>
                                            <td class="custom-cell">{{ $index + 1 }}</td>
                                            <td>{{ $data->nama_kepala_keluarga }}</td>
                                            <td>{{ ucwords(str_replace('_', ' ', $data->level_ekonomi)) }}</td>
                                            <td class="center-col">{{ $data->jumlah_anggota_keluarga }}</td>
                                            <td>{{ $data->no_rt }}</td>
                                            <td style="text-align: left">{{ $data->no_wa }}</td>
                                            <td class="center-col">{{ $data->kode_rumah }}</td>
                                            <td style="text-align: center">
                                                <i class="fas fa-edit icon-style-edit mr-1" onclick="onEditClicked('{{ $data->id }}')" data-toggle="tooltip" data-placement="top" title="Edit"></i>
                                                <i class="fas fa-trash-alt icon-style-delete" onclick="onDeleteClicked({{ $data->id }})" data-toggle="tooltip" data-placement="top" title="Delete"></i>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>                                
                            </div>
                        </div>
                </div>
            </div>

        <!-- Delete Modal -->
        <div class="modal fade" id="modalDelete" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="mt-3 custom-icon-alert">
                            <i class="bi bi-exclamation-circle"></i>
                        </div>
                        <h4 class="mt-4" style="text-align: center">Apakah anda yakin ingin menghapus data ini?</h4>

                        <!-- Hidden input to store the user ID for deletion -->
                        <input type="hidden" id="hiddenDeleteUserId" name="user_id">

                        <div class="mt-4 text-center">
                            <button type="button" class="btn btn-danger col-sm-4" onclick="onCloseModalDelete()">Tidak</button>
                            <!-- Delete button submits form -->
                            <form id="deleteUserForm" method="POST" action="" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <input type="hidden" name="user_id" id="hiddenDeleteUserId">
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
            <script src="{{ asset('assets/takmir_masjid/js/familyCard.js') }}"></script>
@endsection
