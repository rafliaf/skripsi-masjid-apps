@extends('layout.main-after-login')
@section('container')

<link rel="stylesheet" href="https://cdn.datatables.net/2.1.3/css/dataTables.dataTables.css"/>
<link rel="stylesheet" href="{{ asset('assets/takmir_masjid/css/detailMosqueProgram.css') }}">

    {{-- header --}}
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Detail Data Keahlian</h1>
                    <p class="mt-2">{{ $getData->nama_masjid }}</p>
                </div>
                <div class="col-sm-6 mb-3">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a href="#">Detail data keahlian</a>
                        </li>
                        <li class="breadcrumb-item active">
                            Tampilan detail keahlian
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
                    <h5 class="card-header" style="color: #03337B">
                        <i class="fas fa-user-tie mr-2"></i>Detail Data Keahlian
                    </h5>
                </div>
                <div class="col-md-12 mt-3">
                    <table width="100%">
                        <tbody>
                            <tr>
                                <td class="custom-width-td" width="180px"><b>Nama</b></td>
                                <td width="1%">:</td>
                                <td style="padding-left: 5px;">{{ $keahlian->dataInduk->nama_lengkap ?? '-' }}</td>
                            </tr>
                            <tr>
                                <td class="custom-width-td" width="200px"><b>Keahlian</b></td>
                                <td width="1%">:</td>
                                <td style="padding-left: 5px;">{{ $keahlian->jenisKeahlian->jenis_keahlian ?? '-' }}</td>
                            </tr>
                            <tr>
                                <td class="custom-width-td" width="180px"><b>Deskripsi Keahlian</b></td>
                                <td width="1%">:</td>
                                <td style="padding-left: 5px;">{{ $keahlian->deskripsi_keahlian ?? '-' }}</td>
                            </tr>
                            <tr>
                                <td class="custom-width-td" width="200px"><b>Keahlian Lain</b></td>
                                <td width="1%">:</td>
                                <td style="padding-left: 5px;">{{ $keahlian->keahlian_lain ?? '-' }}</td>
                            </tr>
                            <tr>
                                <td class="custom-width-td" width="180px"><b>Status mukim</b></td>
                                <td width="1%">:</td>
                                <td style="padding-left: 5px;">{{ ucfirst($keahlian->dataInduk->is_status_mukim ?? '-' )}}</td>
                            </tr>
                            <tr>
                                <td class="custom-width-td" width="180px"><b>Sertifikat</b></td>
                                <td width="1%">:</td>
                                <td style="padding-left: 5px;">{{ ucfirst($keahlian->is_sertifikat) }}</td>
                            </tr>
                            <tr>
                                <td class="custom-width-td" width="180px"><b>Deskripsi Sertifikat</b></td>
                                <td width="1%">:</td>
                                <td style="padding-left: 5px;">{{ $keahlian->deskripsi_sertifikat ?? '-' }}</td>
                            </tr>
                            <tr>
                                <td class="custom-width-td" width="180px"><b>No. Telepon</b></td>
                                <td width="1%">:</td>
                                <td style="padding-left: 5px;">{{ $keahlian->dataInduk->no_wa ?? '-' }}</td>
                            </tr>
                        </tbody>
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
    <script>
        function onClickLocationBack() {
            window.location.href = '/dashboard/tampil_data_keahlian';
        }
    </script>

    <script src="https://code.jquery.com/jquery-3.7.0.js" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/2.1.3/js/dataTables.js"></script>
@endsection
