@extends('layout.main-after-login')

@section('container')
<!-- Include Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Include jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Include Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<link rel="stylesheet" href="{{ asset('assets/admin_masjid/css/mosqueData.css') }}">
        {{-- header --}}
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    {{-- <div class="card">
                        <h1 class="m-0">Data Masjid</h1>
                    </div> --}}
                    <div class="col-sm-6">
                        <h1 class="m-0">Data {{ $nama_masjid }}</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item">
                                <a href="#" style="text-decoration: none">Data masjid</a>
                            </li>
                            <li class="breadcrumb-item active">
                                Tampilan data masjid
                            </li>
                        </ol>
                    </div>
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
                        @if(session('success'))
                          <div class="mt-4 alert alert-success alert-dismissible fade show" role="alert">
                              {{ session('success') }}
                              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                          </div>
                        @endif
                        <div class="card-body">
                          <form action="">
                            <table width="100%">
                                <thead>
                                  <tr class="col-md-12">
                                    <td class="custom-width-td" width="180px"><b>Nama masjid</b></td>
                                    <td width="1%">:</td>
                                    <td style="padding-left: 5px;">{{ $nama_masjid ?? '-'}}</td>
                                  </tr>
                                  <tr class="col-md-12">
                                    <td class="" width="180px"><b>Alamat</b></td>
                                    <td width="1%">:</td>
                                    <td style="padding-left: 5px;">{{ $alamat ?? '-' }}</td>
                                  </tr>
                                  <tr class="col-md-12">
                                    <td class="custom-width-td" width="180px"><b>Ketua masjid</b></td>
                                    <td width="1%">:</td>
                                    <td style="padding-left: 5px;">{{ $ketua_masjid ?? '-' }}</td>
                                  </tr>
                                  <tr class="col-md-12">
                                    <td class="custom-width-td" width="180px"><b>Ketua takmir</b></td>
                                    <td width="1%">:</td>
                                    <td style="padding-left: 5px;">{{ $ketua_takmir ?? '-'}}</td>
                                  </tr>
                                  <tr class="col-md-12">
                                    <td class="custom-width-td" width="180px"><b>Ketua remaja masjid</b></td>
                                    <td width="1%">:</td>
                                    <td style="padding-left: 5px;">{{ $ketua_remaja_masjid ?? '-' }}</td>
                                  </tr>
                                  <tr class="col-md-12">
                                    <td class="custom-width-td" width="180px"><b>Total jamaah</b></td>
                                    <td width="1%">:</td>
                                    <td style="padding-left: 5px;">{{ $total_jamaah ?? '-' }}</td>
                                  </tr>
                                  <tr class="col-md-12">
                                    <td class="custom-width-td" width="180px"><b>Total remaja masjid</b></td>
                                    <td width="1%">:</td>
                                    <td style="padding-left: 5px;">{{ $total_remaja_masjid ?? '-' }}</td>
                                  </tr>
                                  <tr class="col-md-12">
                                    <td class="custom-width-td" width="180px"><b>Luas tanah masjid</b></td>
                                    <td width="1%">:</td>
                                    <td style="padding-left: 5px;">{{ $luas_tanah ?? '-' }}</td>
                                  </tr>
                                  <tr class="col-md-12">
                                    <td class="custom-width-td" width="180px"><b>Deskripsi masjid</b></td>
                                    <td width="1%">:</td>
                                    <td style="padding-left: 5px;">{{ $deskripsi_masjid ?? '-' }}</td>
                                  </tr>
                                </thead>
                              </table> 
                            </form>
                              <div class="mt-3 float-right">
                                <button type="submit" class="btn btn-primary" onclick="onEditClick()">Edit data</button>
                              </div>                       
                        </div>
                    </div>                    
                </div>
            </div>
        </div>
        <script src="{{ asset('assets/admin_masjid/js/mosqueData.js') }}"></script>
@endsection
