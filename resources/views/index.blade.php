@extends('layout.main-after-login')

@section('container')
{{-- style --}}
<link rel="stylesheet" href="{{ asset('assets/admin_masjid/css/home.css') }}">
    
    @if(Auth::check() && Auth::user()->role == 'admin_masjid' || 'takmir' || 'remaja_masjid')
        {{-- header --}}
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Selamat datang, {{ $role }}</h1>
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
                    {{-- jml jamaah --}}
                    <div class="col-lg-4 col-sm-12">
                        <div class="card">
                            <div class="card-body" onclick="onClicked()">
                                <div class="custom-display">
                                    <div class="custom-icon-users">
                                        <i class="fas fa-users"></i>                            
                                    </div>
                                    <div class="user">
                                        <h3>{{ $total_jamaah }} orang</h3>
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
                                        <h2>{{ $total_data_kk }}</h2>
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
                                        <h2>{{ $total_rumah }} rumah</h2>
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
                                <a href="dashboard/tampil_data_jamaah">
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
                                <a href="dashboard/tampil_data_ibadah">
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
                                <a href="dashboard/tampil_data_kemampuan">
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
                                <a href="dashboard/tampil_data_kk">
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
                                <a href="dashboard/tampil_data_pendidikan">
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
                                <a href="dashboard/tampil_data_pekerjaan">
                                    <h6>Lihat semua</h6>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

{{-- js --}}
<script src="https://code.highcharts.com/highcharts.js"></script>
{{-- PASS DATA HIGHCHARTS --}}
<script>
    // PERBANDINGAN USIA
    var maleData = @json(array_values($data_laki_laki));
    var femaleData = @json(array_values($data_perempuan));

    // CHART IBADAH
    var ibadahData = {
        sholat5Waktu: {{ $sholat_5_waktu }},
        sholatBerjamaah: {{ $sholat_berjamaah }},
        zakatFitrah: {{ $zakat_fitrah }},
        zakatMal: {{ $zakat_mal }},
        kurban: {{ $kurban }},
        haji: {{ $haji }},
        pengajian: {{ $pengajian }}
    };

    // CHART KEMAMPUAN MENGAJId
    var mengajiData = {
        bacaQuran: {{ $baca_quran }},
        bacaIqro: {{ $baca_iqro }},
        bacaHijaiyah: {{ $baca_hijaiyah }},
        bacaLatin: {{ $baca_latin }}
    };

    // CHART LEVEL EKONOMI
    var ekonomiData = {
        menengahKeAtas: {{ $menengah_atas }},
        menengah: {{ $menengah }},
        menengahKeBawah: {{ $menengah_bawah }}
    };

    // CHART PENDIDIKAN
    var pendidikanData = @json(array_values($pendidikan_counts));

    // CHART PEKERJAAN
    var categoriesPekerjaan = @json($categories_pekerjaan);
    var dataPekerjaan = @json($data_pekerjaan);
</script>

<script src="{{ asset('assets/admin_masjid/js/home.js') }}"></script>
  
 @endsection
