@extends('layout.main-after-login')
@section('container')

<link rel="stylesheet" href="https://cdn.datatables.net/2.1.3/css/dataTables.dataTables.css"/>
<link rel="stylesheet" href="{{ asset('assets/takmir_masjid/css/detailMosqueProgram.css') }}">
        {{-- header --}}
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Detail Data Kemampuan</h1>
                        <p class="mt-2">{{ $getData->nama_masjid }}</p>
                    </div>
                    <div class="col-sm-6 mb-3">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item">
                                <a href="#">Detail data kemampuan</a>
                            </li>
                            <li class="breadcrumb-item active">
                                Tampilan detail kemampuan
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
                        <h5 class="card-header" style="color: #03337B"><i class="fas fa-user-tie mr-2"></i>Detail data kemampuan</h5>
                    </div>
                    <div class="col-md-12 mt-3">
                        <table width="100%">
                            <thead>
                                <tr class="col-md-12">
                                    <td class="custom-width-td" width="180px"><b>Nama</b></td>
                                    <td width="1%">:</td>
                                    <td style="padding-left: 5px;">{{ $detailDataKemampuan->nama_lengkap }}</td>
                                </tr>
                                <tr class="col-md-12">
                                    <td class="custom-width-td" width="180px"><b>No.telepon</b></td>
                                    <td width="1%">:</td>
                                    <td style="padding-left: 5px;">{{ $detailDataKemampuan->no_wa }}</td>
                                </tr>
                                <tr class="col-md-12">
                                    <td class="custom-width-td" width="200p"><b>RT</b></td>
                                    <td width="1%">:</td>
                                    <td style="padding-left: 5px;">{{ $detailDataKemampuan->kartuKeluarga->no_rt }}</td>
                                </tr>
                                <tr class="col-md-12">
                                    <td class="custom-width-td" width="180px"><b>Baca latin</b></td>
                                    <td width="1%">:</td>
                                    <td style="padding-left: 5px;">{{ ucfirst($detailDataKemampuan->is_baca_latin) }}</td>
                                </tr>
                                <tr class="col-md-12">
                                    <td class="custom-width-td" width="180px"><b>Baca hijaiyah</b></td>
                                    <td width="1%">:</td>
                                    <td style="padding-left: 5px;">{{ ucfirst($detailDataKemampuan->is_baca_hijaiyah) }}</td>
                                </tr>
                                <tr class="col-md-12">
                                    <td class="custom-width-td" width="180px"><b>Baca iqro</b></td>
                                    <td width="1%">:</td>
                                    <td style="padding-left: 5px;">{{ ucfirst($detailDataKemampuan->is_baca_iqro) }}</td>
                                </tr>
                                <tr class="col-md-12">
                                    <td class="custom-width-td" width="180px"><b>Baca Al-Qur'an</b></td>
                                    <td width="1%">:</td>
                                    <td style="padding-left: 5px;">{{ ucfirst($detailDataKemampuan->is_baca_quran) }}</td>
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
                window.location.href = '/dashboard/tampil_data_kemampuan'
            }
        </script>
@endsection