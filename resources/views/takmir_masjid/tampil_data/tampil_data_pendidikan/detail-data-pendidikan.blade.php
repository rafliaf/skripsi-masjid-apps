@extends('layout.main-after-login')
@section('container')

<link rel="stylesheet" href="https://cdn.datatables.net/2.1.3/css/dataTables.dataTables.css"/>
<link rel="stylesheet" href="{{ asset('assets/takmir_masjid/css/detailMosqueProgram.css') }}">
        {{-- header --}}
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Detail Data Pendidikan</h1>
                        <p class="mt-2">{{ $getData->nama_masjid }}</p>
                    </div>
                    <div class="col-sm-6 mb-3">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item">
                                <a href="#">Detail data pendidikan</a>
                            </li>
                            <li class="breadcrumb-item active">
                                Tampilan detail pendidikan
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
                        <h5 class="card-header" style="color: #03337B"><i class="fas fa-user-tie mr-2"></i>Detail data pendidikan</h5>
                    </div>
                    <div class="col-md-12 mt-3">
                        <table width="100%">
                            <thead>
                                <tr class="col-md-12">
                                    <td class="custom-width-td" width="180px"><b>Nama</b></td>
                                    <td width="1%">:</td>
                                    <td style="padding-left: 5px;">{{ $detailPendidikan->nama_lengkap }}</td>
                                </tr>
                                <tr class="col-md-12">
                                    <td class="custom-width-td" width="200p"><b>Pendidikan</b></td>
                                    <td width="1%">:</td>
                                    <td style="padding-left: 5px;">{{ $detailPendidikan->pendidikan_name }}</td>
                                </tr>
                                <tr class="col-md-12">
                                    <td class="custom-width-td" width="180px"><b>No kartu keluarga</b></td>
                                    <td width="1%">:</td>
                                    <td style="padding-left: 5px;">{{ $detailPendidikan->kartuKeluarga->nomor_kk }}</td>
                                </tr>
                                <tr class="col-md-12">
                                    <td class="custom-width-td" width="180px"><b>No.telepon</b></td>
                                    <td width="1%">:</td>
                                    <td style="padding-left: 5px;">{{ $detailPendidikan->no_wa }}</td>
                                </tr>
                                <tr class="col-md-12">
                                    <td class="custom-width-td" width="200px"><b>RT</b></td>
                                    <td width="1%">:</td>
                                    <td style="padding-left: 5px;">{{ $detailPendidikan->kartuKeluarga->no_rt }}</td>
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
                window.location.href = "/dashboard/tampil_data_pendidikan";
            }
        </script>
@endsection