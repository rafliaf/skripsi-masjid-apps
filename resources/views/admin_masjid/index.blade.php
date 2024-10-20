@extends('layout.main-after-login')

@section('container')
{{-- style --}}
<link rel="stylesheet" href="assets/admin_masjid/css/home.css">
    {{-- header --}}
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Selamat datang, {{ $role }}</h1>
                    <p class="mt-2">{{ $masjid }}</p>                                    
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a href="#">Home</a>
                        </li>
                        <li class="breadcrumb-item active">
                            Dashboard
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
                {{-- jml jamaah --}}
                <div class="col-lg-4 col-sm-12">
                    <div class="card">
                        <div class="card-body" onclick="onClicked()">
                            <div class="custom-display">
                                <div class="custom-icon-users">
                                    <i class="fas fa-users"></i>                            
                                </div>
                                <div class="user">
                                    <h3>45 orang</h3>
                                </div>
                            </div>
                            <div class="custom-card-title">
                                <h4 class="card-title">Jumlah Jamaah</h4>
                            </div>
                        </div>
                      </div>
                </div>
                {{-- data kk --}}
                <div class="col-lg-4 col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="custom-display">
                                <div class="custom-icon-data-kk">
                                    <i class="fas fa-database"></i>                            
                                </div>
                                <div class="user-data-kk">
                                    <h2>15</h2>
                                </div>
                            </div>
                            <div class="custom-card-title">
                                <h5 class="card-title">Data Kartu Keluarga</h5>
                            </div>
                        </div>
                      </div>
                </div>
                {{-- jml rumah --}}
                <div class="col-lg-4 col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="custom-display">
                                <div class="custom-icon-jml-rumah">
                                    <i class="fa fa-home"></i>                            
                                </div>
                                <div class="jml-rumah">
                                    <h2>20 rumah</h2>
                                </div>
                            </div>
                            <div class="custom-card-title">
                                <h5 class="card-title">Rumah</h5>
                            </div>
                        </div>
                      </div>
                </div>
            </div>
        </div>
        {{-- chart --}}
        <div class="container-fluid">
            <div class="row">
                {{-- bar chart --}}
                <div class="col-md-6 col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <div id="chartPerbandinganUsia"></div>
                        </div>
                        <div class="card-footer">
                            <a href="tampil_data_jamaah">
                                <h6>Lihat semua</h6>
                            </a>
                        </div>
                    </div>
                </div>
                {{-- bar chart ibadah --}}
                <div class="col-md-6 col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <div id="chartIbadah"></div>
                        </div>
                        <div class="card-footer">
                            <a href="tampil_data_ibadah">
                                <h6>Lihat semua</h6>
                            </a>
                        </div>
                    </div>
                </div>
                {{-- chart baca quran --}}
                <div class="col-md-6 col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <div id="chartMengaji"></div>
                        </div>
                        <div class="card-footer">
                            <a href="tampil_data_kemampuan">
                                <h6>Lihat semua</h6>
                            </a>
                        </div>
                    </div>
                </div>
                {{-- chart level ekonomi --}}
                <div class="col-md-6 col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <div id="chartLevelEkonomi"></div>
                        </div>
                        <div class="card-footer">
                            <a href="tampil_data_kk">
                                <h6>Lihat semua</h6>
                            </a>
                        </div>
                    </div>
                </div>
                {{-- chart pendidikan --}}
                <div class="col-md-6 col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <div id="chartPendidikan"></div>
                        </div>
                        <div class="card-footer">
                            <a href="tampil_data_pendidikan">
                                <h6>Lihat semua</h6>
                            </a>
                        </div>
                    </div>
                </div>
                {{-- chart pekerjaan --}}
                <div class="col-md-6 col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <div id="chartPekerjaan"></div>
                        </div>
                        <div class="card-footer">
                            <a href="tampil_data_pekerjaan">
                                <h6>Lihat semua</h6>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

{{-- js --}}
    <script src="https://code.highcharts.com/highcharts.js"></script>
  <script src="assets/admin_masjid/js/home.js"></script>
  
 @endsection
