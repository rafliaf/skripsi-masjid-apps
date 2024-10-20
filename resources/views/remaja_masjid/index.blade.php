@extends('layout.main-after-login')

@section('container')
{{-- style --}}
<link rel="stylesheet" href="{{ asset('assets/remaja_masjid/css/index.css') }}">
    {{-- header --}}
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Selamat datang {{ $role }}</h1>
                    <p class="mt-2">{{ $getData->nama_masjid }}</p>
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
                {{-- jml anggota remaja masjid --}}
                <div class="col-lg-3 col-sm-12">
                    <div class="card">
                        <div class="card-body" onclick="onClicked()">
                            <div class="custom-display">
                                <div class="custom-icon-users">
                                    <i class="fas fa-briefcase"></i>
                                </div>
                                <div class="user">
                                    <h3>{{ $jumlah_anggota_remaja_masjid }} orang</h3>
                                </div>
                            </div>
                            <div class="custom-card-title">
                                <h4 class="card-title">Anggota remaja masjid</h4>
                            </div>
                        </div>
                      </div>
                </div>
                {{-- jml remaja --}}
                <div class="col-lg-3 col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="custom-display">
                                <div class="custom-icon-data-kk">
                                    <i class="fas fa-users"></i>                            
                                </div>
                                <div class="user-data-kk">
                                    <h2>{{ $jumlah_remaja }} orang</h2>
                                </div>
                            </div>
                            <div class="custom-card-title">
                                <h5 class="card-title">Jumlah remaja</h5>
                            </div>
                        </div>
                      </div>
                </div>
                {{-- jml remaja laki-laki --}}
                <div class="col-lg-3 col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="custom-display">
                                <div class="custom-icon-jml-laki-laki">
                                    <i class="fas fa-male"></i>
                                </div>
                                <div class="jml-laki-laki">
                                    <h2>{{ $jumlah_remaja_laki_laki }} orang</h2>
                                </div>
                            </div>
                            <div class="custom-card-title">
                                <h5 class="card-title">Jumlah remaja laki-laki</h5>
                            </div>
                        </div>
                      </div>
                </div>
                {{-- jml perempuan --}}
                <div class="col-lg-3 col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="custom-display">
                                <div class="custom-icon-jml-perempuan">
                                    <i class="fas fa-female"></i>
                                </div>
                                <div class="jml-perempuan">
                                    <h2>{{ $jumlah_remaja_perempuan }} orang</h2>
                                </div>
                            </div>
                            <div class="custom-card-title">
                                <h5 class="card-title">Jumlah remaja perempuan</h5>
                            </div>
                        </div>
                      </div>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row">
                {{-- chart jml remaja --}}
                <div class="col-md-6 col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <div id="jumlahRemaja"></div>
                        </div>
                        <div class="card-footer">
                            <a href="dashboard/remaja_masjid">
                                <h6>Lihat semua</h6>
                            </a>
                        </div>
                    </div>
                </div>
                {{-- chart kemampuan baca --}}
                <div class="col-md-6 col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <div id="chartKemampuanBaca"></div>
                        </div>
                        <div class="card-footer">
                            <a href="dashboard/tampil_data_kemampuan">
                                <h6>Lihat semua</h6>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Load Highcharts first --}}
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>

    
    {{-- Pass variables from Laravel to JavaScript --}}
    <script>
        // TOTAL REMAJA
        window.jumlahRemajaLakiLaki = @json($jumlah_remaja_laki_laki);
        window.jumlahRemajaPerempuan = @json($jumlah_remaja_perempuan);
        window.jumlahAnggotaRemajaMasjid = @json($jumlah_anggota_remaja_masjid);
        window.totalRemaja = window.jumlahRemajaLakiLaki + window.jumlahRemajaPerempuan + window.jumlahAnggotaRemajaMasjid;

        // KEMAMPUAN BACA
        window.countBacaLatin = @json($countBacaLatin);
        window.countBacaHijaiyah = @json($countBacaHijaiyah);
        window.countBacaIqro = @json($countBacaIqro);
        window.countBacaQuran = @json($countBacaQuran);
    </script>

    {{-- Load external JavaScript file after Highcharts --}}
    <script src="{{ asset('assets/remaja_masjid/js/index.js') }}"></script>
@endsection
