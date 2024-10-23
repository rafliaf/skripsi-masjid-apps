@extends('layout.main-after-login')

@section('container')
<link rel="stylesheet" href="https://cdn.datatables.net/2.1.3/css/dataTables.dataTables.css"/>

<!-- Include Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Include jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Include Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<link rel="stylesheet" href="{{ asset('assets/admin_masjid/css/userData.css') }}">
        {{-- header --}}
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Data User</h1>
                        <p class="mt-2">{{ $getData->nama_masjid }}</p>
                    </div>
                    <div class="col-sm-6 mb-3">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item">
                                <a href="#" style="text-decoration: none">Data user</a>
                            </li>
                            <li class="breadcrumb-item active">
                                Tampilan data user
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
                        {{-- alert menghapus data user --}}
                        @if(session('success'))
                            <div class="mt-4 alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        <div class="mt-4 m-3">
                            <button class="btn btn-success" onclick="onAddClicked()">Tambah data user</button>
                        </div>
                        <div class="col-md-12">
                            {{-- tablesData --}}
                            <table id="myTable" class="table table-striped">
                                <thead>
                                    <tr>
                                        <th class="custom-header">No</th>
                                        <th>Nama</th>
                                        <th>Email</th>
                                        <th>Role</th>
                                        <th style="text-align: center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody id="tableBody">
                                    @foreach ($users as $user)
                                    <tr data-id="{{ $user->id }}" data-nama="{{ $user->nama }}" data-email="{{ $user->email }}" data-role="{{ $user->role }}">
                                        <td class="custom-cell">{{ $loop->iteration }}</td>
                                        <td>{{ $user->nama }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>
                                            @if($user->role === 'admin_masjid')
                                                Admin masjid
                                            @elseif ($user->role === 'takmir')
                                                Takmir masjid
                                            @elseif ($user->role === 'remaja_masjid')
                                                Remaja masjid
                                            @else
                                                {{ ucfirst(str_replace('_', ' ', $user->role)) }}
                                            @endif
                                        </td>
                                        <td style="text-align: center">
                                            <i class="fas fa-edit icon-style-edit mr-1" onclick="onEditClicked(this)" data-toggle="tooltip" data-placement="top" title="Edit"></i>
                                            <i class="fas fa-trash-alt icon-style-delete" onclick="onDeleteClicked(this)" data-toggle="tooltip" data-placement="top" title="Hapus"></i>
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
        <!-- Edit Modal -->
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
                        <!-- Form for editing the user -->
                        <form id="editUserForm" action="{{ route('user.update') }}" method="POST" style="margin-top: 20px">
                            @csrf
                            <!-- Hidden input to store the user ID -->
                            <input type="hidden" name="user_id" id="hiddenUserId">

                            <div class="form-group row justify-content-center">
                                <label for="inputNama" class="col-sm-2 col-form-label">Nama</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" id="inputNama" name="nama" placeholder="Nama" required>
                                </div>
                            </div>

                            <div class="form-group row justify-content-center">
                                <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                                <div class="col-sm-6">
                                    <input type="email" class="form-control" id="inputEmail" name="email" placeholder="Email@gmail.com" required>
                                </div>
                            </div>

                            <div class="form-group row justify-content-center">
                                <label for="inputRole" class="col-sm-2 col-form-label">Role</label>
                                <div class="col-sm-6">
                                    <select class="custom-select" id="inputGroupSelect01" name="role" required>
                                        <option hidden disabled selected value="">Pilih role sebagai...</option>
                                        <option value="admin_masjid">Admin masjid</option>
                                        <option value="takmir">Takmir masjid</option>
                                        <option value="remaja_masjid">Remaja masjid</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Modal Footer Buttons -->
                            <div class="text-center mb-4">
                                <button type="button" class="btn btn-danger col-sm-4" onclick="onCloseModalEdit()">Batal</button>
                                <button type="submit" class="btn btn-success col-sm-4" style="margin-left: 20px">Simpan</button>
                            </div>
                        </form>
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
                            <form id="deleteUserForm" method="POST" style="display: inline;">
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
        <script src="{{ asset('assets/admin_masjid/js/userData.js') }}"></script>
@endsection
