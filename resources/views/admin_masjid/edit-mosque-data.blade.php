@extends('layout.main-after-login')

@section('container')
<link rel="stylesheet" href="{{ asset('assets/admin_masjid/css/mosqueData.css') }}">
        {{-- header --}}
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    {{-- <div class="card">
                        <h1 class="m-0">Data Masjid</h1>
                    </div> --}}
                    <div class="col-sm-6">
                        <h1 class="m-0">Edit Data {{ $nama_masjid }}</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item">
                                <a href="#">Data masjid</a>
                            </li>
                            <li class="breadcrumb-item active">
                                Edit data masjid
                            </li>
                        </ol>
                    </div>
                    <hr>
                </div>
            </div>
        </div>
        {{-- content --}}
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="card col-md-12">
                        {{-- <div class="img-container">
                            <img src="assets/sidebar/img/mosque.png" class="rounded-image" alt="User Image">
                        </div> --}}
                        <div class="card-body">
                        @if(session('success'))
                            <div class="mt-4 alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif
                        <form action="{{ route('update.mosque') }}" method="POST">
                            @csrf <!-- Include CSRF token for security -->
                            @method('PUT') <!-- Specify method for updating data -->     
                            <table width="100%">
                                <thead>
                                    <tr class="col-md-12">
                                        <td class="custom-width-td" width="180px"><b>Nama masjid</b></td>
                                        <td width="1%">:</td>
                                        <td style="padding-left: 5px;">{{ $nama_masjid }}</td>
                                    </tr>
                                    <tr class="col-md-12">
                                        <td class="" width="180px"><b>Alamat</b></td>
                                        <td width="1%">:</td>
                                        <td style="padding-left: 5px;">
                                            <input class="form-control" type="text" name="alamat_masjid" value="{{ $alamat }}" required>
                                        </td>
                                    </tr>
                                    <tr class="col-md-12">
                                        <td class="custom-width-td" width="180px"><b>Ketua masjid</b></td>
                                        <td width="1%">:</td>
                                        <td style="padding-left: 5px;">
                                            <input class="form-control" type="text" name="ketua_masjid" value="{{ $ketua_masjid }}" placeholder="Masukkan ketua masjid">
                                        </td>
                                    </tr>
                                    <tr class="col-md-12">
                                        <td class="custom-width-td" width="180px"><b>Ketua takmir</b></td>
                                        <td width="1%">:</td>
                                        <td style="padding-left: 5px;">
                                            <input class="form-control" type="text" name="ketua_takmir" value="{{ $ketua_takmir }}" placeholder="Masukkan ketua takmir">
                                        </td>
                                    </tr>
                                    <tr class="col-md-12">
                                        <td class="custom-width-td" width="180px"><b>Ketua remaja masjid</b></td>
                                        <td width="1%">:</td>
                                        <td style="padding-left: 5px;">
                                            <input class="form-control" type="text" name="ketua_remaja_masjid" value="{{ $ketua_remaja_masjid }}" placeholder="Masukkan ketua remaja masjid">
                                        </td>
                                    </tr>
                                    <tr class="col-md-12">
                                        <td class="custom-width-td" width="180px"><b>Total jamaah</b></td>
                                        <td width="1%">:</td>
                                        <td style="padding-left: 5px;">
                                            <input class="form-control" type="number" name="total_jamaah" value="{{ $total_jamaah }}" placeholder="Masukkan total jamaah">
                                        </td>
                                    </tr>
                                    <tr class="col-md-12">
                                        <td class="custom-width-td" width="180px"><b>Total remaja masjid</b></td>
                                        <td width="1%">:</td>
                                        <td style="padding-left: 5px;">
                                            <input class="form-control" type="number" name="total_remaja_masjid" value="{{ $total_remaja_masjid }}" placeholder="Masukkan total remaja masjid">
                                        </td>
                                    </tr>
                                    <tr class="col-md-12">
                                        <td class="custom-width-td" width="180px"><b>Luas tanah masjid</b></td>
                                        <td width="1%">:</td>
                                        <td style="padding-left: 5px;">
                                            <input class="form-control" type="text" name="luas_tanah_masjid" value="{{ $luas_tanah }}" placeholder="Masukkan luas tanah masjid">
                                        </td>
                                    </tr>
                                    <tr class="col-md-12">
                                        <td class="custom-width-td" width="180px"><b>Deskripsi masjid</b></td>
                                        <td width="1%">:</td>
                                        <td style="padding-left: 5px;">
                                            <textarea class="form-control" type="text" name="deskripsi_masjid" placeholder="Masukkan deskripsi masjid" rows="3">{{ $deskripsi_masjid }}</textarea>
                                        </td>
                                    </tr>
                                </thead>
                            </table> 
                            <div class="mt-3 float-right">
                                <button type="button" class="btn btn-secondary" onclick="onClickBack()">Kembali</button>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>  
                        </form>                                           
                        </div>
                    </div>                    
                </div>
            </div>
        </div>
        <script src="{{ asset('assets/admin_masjid/js/mosqueData.js') }}"></script>
@endsection
