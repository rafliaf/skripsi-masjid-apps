@extends('layout.main-after-login')

@section('container')
<link rel="stylesheet" href="https://cdn.datatables.net/2.1.3/css/dataTables.dataTables.css"/>
<link rel="stylesheet" href="{{ asset('assets/remaja_masjid/css/mosqueYouth.css') }}">
 <!-- Include Bootstrap CSS -->
 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        {{-- header --}}
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Data Remaja Masjid</h1>
                        <p class="mt-2">{{ $getData->nama_masjid }}</p>
                    </div>
                    <div class="col-sm-6 mb-3">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item">
                                <a href="#" style="text-decoration: none">Data remaja masjid</a>
                            </li>
                            <li class="breadcrumb-item active">
                                Tampilan data remaja masjid
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
                        {{-- RT --}}
                        <div class="col-md-3">
                            <label for="inputRT" class="col-form-label ml-1">RT</label>
                            <div class="input-group">
                                {{-- RT Filter --}}
                                <select class="custom-select" id="inputRT">
                                    <option value="" hidden>- Pilih -</option>
                                    @foreach($rtValues as $rt)
                                        <option value="{{ $rt }}" {{ request('rt') == $rt ? 'selected' : '' }}>{{ $rt }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        {{-- kemampuan baca --}}
                        <div class="col-md-3">
                            <label for="inputBaca" class="col-form-label ml-1">Kemampuan baca</label>
                            <div class="input-group">
                                {{-- Kemampuan Baca Filter --}}
                                <select class="custom-select" id="inputBaca">
                                    <option value="" hidden>- Pilih -</option>
                                    <option value="alquran" {{ request('kemampuan_baca') == 'alquran' ? 'selected' : '' }}>Al-Qur'an</option>
                                    <option value="iqra" {{ request('kemampuan_baca') == 'iqra' ? 'selected' : '' }}>Iqra</option>
                                    <option value="hijaiyah" {{ request('kemampuan_baca') == 'hijaiyah' ? 'selected' : '' }}>Hijaiyah</option>
                                    <option value="latin" {{ request('kemampuan_baca') == 'latin' ? 'selected' : '' }}>Latin</option>
                                </select>
                            </div>
                        </div>
                        {{-- anggota remaja masjid --}}
                        <div class="col-md-3">
                            <label for="inputRemaja" class="col-form-label ml-1">Remaja masjid</label>
                            <div class="input-group">
                                {{-- Remaja Masjid Filter --}}
                                <select class="custom-select" id="inputRemaja">
                                    <option value="" hidden>- Pilih -</option>
                                    <option value="ya" {{ request('remaja_masjid') == 'ya' ? 'selected' : '' }}>Ya</option>
                                    <option value="tidak" {{ request('remaja_masjid') == 'tidak' ? 'selected' : '' }}>Tidak</option>
                                </select>
                            </div>
                        </div>
                        <!-- btn cari -->
                        <div class="col-md-3 display-flex-btn">
                            <button class="btn btn-info mr-4 custom-btn" onclick="onFilter()">Cari<i class="fa fa-search ml-1"></i></button>
                        </div>
                    </div>
                </div>
                {{-- table --}}
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
                                    <th rowspan="2" class="custom-header">No</th>
                                    <th rowspan="2" class="middle">Nama</th>
                                    <th rowspan="2" class="middle">Usia</th>
                                    <th rowspan="2" class="middle">RT</th>
                                    <th colspan="3" class="center-content">Kemampuan baca</th>
                                    <th rowspan="2" class="center-content middle">Remaja masjid</th>
                                    <th rowspan="2" class="middle">Jenis kelamin</th>
                                    <th rowspan="2" class="middle" style="text-align: left">No. telepon</th>
                                    <th rowspan="2" class="middle" style="text-align: left">Aksi</th>
                                </tr>
                                <tr> 
                                    <th class="center-content">Iqra</th>
                                    <th class="center-content">Qur'an</th>
                                    <th class="center-content">Hijaiyah</th>
                                </tr>
                            </thead>
                            <tbody id="tableBody">
                                @foreach($remajaMasjidData as $index => $remaja)
                                <tr>
                                    <td class="custom-cell">{{ $index + 1 }}</td>
                                    <td>{{ $remaja->dataInduk->nama_lengkap ?? 'N/A' }}</td>
                                    <td class="center-content">{{ \Carbon\Carbon::parse($remaja->dataInduk->tgl_lahir)->age ?? 'N/A' }}</td>
                                    <td>{{ $remaja->dataInduk->kartuKeluarga->no_rt ?? 'N/A' }}</td>
                                    <td class="center-content">{{ $remaja->dataInduk->is_baca_iqro == 'ya' ? 'Ya' : 'Tidak' }}</td>
                                    <td class="center-content">{{ $remaja->dataInduk->is_baca_quran == 'ya' ? 'Ya' : 'Tidak' }}</td>
                                    <td class="center-content">{{ $remaja->dataInduk->is_baca_hijaiyah == 'ya' ? 'Ya' : 'Tidak' }}</td>
                                    <td class="center-content">{{ $remaja->is_remaja_masjid == 'ya' ? 'Ya' : 'Tidak' }}</td>
                                    <td>{{ str_replace('_', ' ', ucfirst($remaja->dataInduk->jenis_kelamin ?? 'N/A')) }}</td>
                                    <td style="text-align: left">{{ $remaja->dataInduk->no_wa ?? 'N/A' }}</td>
                                    <td style="text-align: center">
                                        <i class="fas fa-edit icon-style-edit mr-1" onclick="onEditClicked({{ $remaja->id }})" data-toggle="tooltip" data-placement="top" title="Edit"></i>
                                        <i class="fas fa-trash-alt icon-style-delete" onclick="onDeleteClicked({{ $remaja->id }})" data-toggle="tooltip" data-placement="top" title="Hapus"></i>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Edit -->
        <div class="modal fade" id="modalEdit" tabindex="-1" aria-labelledby="modalEditLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header" style="background-color: #0B689C">
                        <h5 class="modal-title" id="modalEditLabel" style="color: white">Edit Data Remaja Masjid</h5>
                        <button type="button" class="btn-close" aria-label="Close" onclick="onCloseModalEdit()"></button>
                    </div>
                    <div class="modal-body">
                        <form id="editRemajaForm" action="{{ route('user.update') }}" method="POST">
                            @csrf
                            <input type="hidden" id="edit_id" name="id">
                            
                            <!-- Name field, disabled -->
                            <div class="form-group row justify-content-center">
                                <label for="editNama" class="col-sm-4 col-form-label">Nama</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" id="editNama" name="nama" disabled>
                                </div>
                            </div>
                            
                            <!-- Other fields -->
                            <div class="form-group row justify-content-center">
                                <label for="editIsRemaja" class="col-sm-4 col-form-label">Anggota Remaja Masjid</label>
                                <div class="col-sm-6">
                                    <select class="custom-select" id="editIsRemaja" name="is_remaja_masjid">
                                        <option value="ya">Ya</option>
                                        <option value="tidak">Tidak</option>
                                    </select>
                                </div>
                            </div>

                            <div class="text-center mb-4">
                                <button type="button" class="btn btn-danger col-sm-4" onclick="onCloseModalEdit()">Batal</button>
                                <button type="submit" class="btn btn-success col-sm-4" style="margin-left: 20px">Simpan</button>
                            </div>
                        </form> 
                    </div>
                </div>
            </div>
        </div>

        {{-- Modal Delete --}}
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
                        <!-- Hidden input to store the ID -->
                        <input type="hidden" id="delete_id">
                        <div class="mt-4 text-center">
                            <button type="button" class="btn btn-danger col-sm-4" onclick="onCloseModalDelete()">Tidak</button>
                            <!-- Delete button submits form -->
                            <form id="deleteUserForm" action="" method="POST" style="display: inline;">
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
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdn.datatables.net/2.1.3/js/dataTables.js"></script>
        <script src="{{ asset('assets/remaja_masjid/js/mosqueYouth.js') }}"></script>
        <script>
            // Pass the remajaMasjidData from the controller to the front-end
            var remajaMasjidData = @json($remajaMasjidData);
            console.log(remajaMasjidData); 
        </script>
@endsection
