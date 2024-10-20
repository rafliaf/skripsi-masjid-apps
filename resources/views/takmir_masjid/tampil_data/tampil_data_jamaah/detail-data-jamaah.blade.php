@extends('layout.main-after-login')
@section('container')

<link rel="stylesheet" href="https://cdn.datatables.net/2.1.3/css/dataTables.dataTables.css"/>
<link rel="stylesheet" href="{{ asset('assets/takmir_masjid/css/detailMosqueProgram.css') }}">
    
    {{-- header --}}
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Detail Data Jamaah</h1>
                    {{-- Dynamically display the mosque name --}}
                    <p class="mt-2">{{ $getData->nama_masjid }}</p>
                </div>
                <div class="col-sm-6 mb-3">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a href="#">Detail data jamaah</a>
                        </li>
                        <li class="breadcrumb-item active">Tampilan detail jamaah</li>
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
                    <h5 class="card-header" style="color: #03337B">
                        <i class="fas fa-users mr-3"></i>Detail Data Jamaah
                    </h5>
                </div>
                <div class="col-md-12 mt-3">
                    {{-- Detail Table --}}
                    <table width="100%">
                        <tbody>
                            <tr>
                                <td class="custom-width-td" width="180px"><b>NIK</b></td>
                                <td width="1%">:</td>
                                <td style="padding-left: 5px;">{{ $jamaahData->nik ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <td class="custom-width-td" width="180px"><b>Nama kepala keluarga</b></td>
                                <td width="1%">:</td>
                                <td style="padding-left: 5px;">{{ $jamaahData->kartuKeluarga->nama_kepala_keluarga ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <td class="custom-width-td" width="180px"><b>Nama lengkap</b></td>
                                <td width="1%">:</td>
                                <td style="padding-left: 5px;">{{ $jamaahData->nama_lengkap ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <td class="custom-width-td" width="200px"><b>Status hubungan keluarga</b></td>
                                <td width="1%">:</td>
                                <td style="padding-left: 5px;">{{ $jamaahData->status_hubungan_keluarga ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <td class="custom-width-td" width="180px"><b>Tempat lahir</b></td>
                                <td width="1%">:</td>
                                <td style="padding-left: 5px;">{{ $jamaahData->tempat_lahir ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <td class="custom-width-td" width="200px"><b>Tanggal lahir</b></td>
                                <td width="1%">:</td>
                                <td style="padding-left: 5px;">{{ \Carbon\Carbon::parse($jamaahData->tgl_lahir)->isoFormat('D MMMM YYYY') ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <td class="custom-width-td" width="180px"><b>Jenis kelamin</b></td>
                                <td width="1%">:</td>
                                <td style="padding-left: 5px;">{{ str_replace('_', ' ', ucfirst($jamaahData->jenis_kelamin ?? 'N/A'))}}</td>
                            </tr>
                            <tr>
                                <td class="custom-width-td" width="180px"><b>Pendidikan</b></td>
                                <td width="1%">:</td>
                                <td style="padding-left: 5px;">{{ $jamaahData->pendidikan_name ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <td class="custom-width-td" width="180px"><b>Pekerjaan</b></td>
                                <td width="1%">:</td>
                                <td style="padding-left: 5px;">{{ $jamaahData->pekerjaan ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <td class="custom-width-td" width="180px"><b>No.telepon</b></td>
                                <td width="1%">:</td>
                                <td style="padding-left: 5px;">{{ $jamaahData->no_wa ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <td class="custom-width-td" width="180px"><b>Status kawin</b></td>
                                <td width="1%">:</td>
                                <td style="padding-left: 5px;">{{ ucfirst(str_replace('_', ' ', $jamaahData->status_kawin)) ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <td class="custom-width-td" width="180px"><b>Remaja masjid</b></td>
                                <td width="1%">:</td>
                                <td style="padding-left: 5px;">{{ ucfirst($jamaahData->is_remaja_masjid) ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <td class="custom-width-td" width="180px"><b>Status mukim</b></td>
                                <td width="1%">:</td>
                                <td style="padding-left: 5px;">{{ ucfirst($jamaahData->is_status_mukim) ?? 'N/A' }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        {{-- Back Button --}}
        <div class="row">
            <div class="col-md-12 text-center mb-3">
                <button type="button" class="col-md-3 btn btn-secondary" onclick="onClickLocationBack()">Kembali</button>
            </div>
        </div>
    </div>

    {{-- Script --}}
    <script>
        function onClickLocationBack() {
            window.location.href = '/dashboard/tampil_data_jamaah'; // Go back to the previous page
        }
    </script>

    <script src="https://code.jquery.com/jquery-3.7.0.js" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/2.1.3/js/dataTables.js"></script>
@endsection
