@extends('layout.main-after-login')
@section('container')

<link rel="stylesheet" href="https://cdn.datatables.net/2.1.3/css/dataTables.dataTables.css"/>
<link rel="stylesheet" href="{{ asset('assets/takmir_masjid/css/detailMosqueProgram.css') }}">
        {{-- header --}}
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Detail Data Ibadah</h1>
                        <p class="mt-2">{{ $getData->nama_masjid }}</p>
                    </div>
                    <div class="col-sm-6 mb-3">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item">
                                <a href="#">Detail data ibadah</a>
                            </li>
                            <li class="breadcrumb-item active">
                                Tampilan detail ibadah
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        {{-- content --}}
        <div class="content">
            <div class="container-fluid">
                <div class="card">
                    <div>
                        <h5 class="card-header" style="color: #03337B"><i class="fas fa-users mr-3"></i>Detail data ibadah</h5>
                    </div>
                    <div class="col-md-6 mt-3">
                        <table width="100%">
                                <thead>
                                        <tr>
                                            <td class="custom-width-td" width="180px"><b>Nama</b></td>
                                            <td width="1%">:</td>
                                            <td style="padding-left: 5px;">{{ $ibadahData->nama_lengkap }}</td>
                                        </tr>         
                                        <tr>
                                            <td class="custom-width-td" width="180px"><b>Sholat 5 waktu</b></td>
                                            <td width="1%">:</td>
                                            <td style="padding-left: 5px;">{{ ucfirst($ibadahData->is_sholat_5_waktu) }}</td>
                                        </tr>
                                        <tr>
                                            <td class="custom-width-td" width="180px"><b>Zakat fitrah</b></td>
                                            <td width="1%">:</td>
                                            <td style="padding-left: 5px;">{{ ucfirst($ibadahData->is_zakat_fitrah) }}</td>
                                        </tr>
                                        <tr>
                                            <td class="custom-width-td" width="200p"><b>Zakat mal</b></td>
                                            <td width="1%">:</td>
                                            <td style="padding-left: 5px;">{{ ucfirst($ibadahData->is_zakat_mal) }}</td>
                                        </tr>
                                        <tr>
                                            <td class="custom-width-td" width="200p"><b>Kurban</b></td>
                                            <td width="1%">:</td>
                                            <td style="padding-left: 5px;">{{ ucfirst($ibadahData->is_kurban) }}</td>
                                        </tr>
                                        <tr>
                                            <td class="custom-width-td" width="200p"><b>Haji</b></td>
                                            <td width="1%">:</td>
                                            <td style="padding-left: 5px;">{{ ucfirst($ibadahData->is_haji) }}</td>
                                        </tr>
                                        <tr>
                                            <td class="custom-width-td" width="200p"><b>Umrah</b></td>
                                            <td width="1%">:</td>
                                            <td style="padding-left: 5px;">{{ ucfirst($ibadahData->is_umrah) }}</td>
                                        </tr>
                                        <tr>
                                            <td class="custom-width-td" width="180px"><b>Pengajian</b></td>
                                            <td width="1%">:</td>
                                            <td style="padding-left: 5px;">{{ ucfirst($ibadahData->is_pengajian_rutin) }}</td>
                                        </tr>
                                        <tr>
                                            <td class="custom-width-td" width="180px"><b>Baca Al-Qur'an</b></td>
                                            <td width="1%">:</td>
                                            <td style="padding-left: 5px;">{{ ucfirst($ibadahData->is_baca_quran) }}</td>
                                        </tr>
                                        <tr>
                                            <td class="custom-width-td" width="180px"><b>Baca latin</b></td>
                                            <td width="1%">:</td>
                                            <td style="padding-left: 5px;">{{ ucfirst($ibadahData->is_baca_latin) }}</td>
                                        </tr>
                                        <tr>
                                            <td class="custom-width-td" width="180px"><b>Baca hijaiyah</b></td>
                                            <td width="1%">:</td>
                                            <td style="padding-left: 5px;">{{ ucfirst($ibadahData->is_baca_hijaiyah) }}</td>
                                        </tr>
                                        <tr>
                                            <td class="custom-width-td" width="180px"><b>Baca iqro</b></td>
                                            <td width="1%">:</td>
                                            <td style="padding-left: 5px;">{{ ucfirst($ibadahData->is_baca_iqro) }}</td>
                                        </tr>
                                </thead>
                            </table>
                    </div>                      
                </div>
            </div>
                <div class="row">
                    <div class="col-md-12 text-center mb-3">
                        <button type="button" class="col-md-3 btn btn-secondary" onclick="onClickLocationBack()">Kembali</button>
                    </div>
                </div>
        </div>

        {{-- script --}}
        <script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM=" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/2.1.3/js/dataTables.js"></script>
        <script>
            function onClickLocationBack(){
                window.location.href = '/dashboard/tampil_data_ibadah';
            }
        </script>
@endsection