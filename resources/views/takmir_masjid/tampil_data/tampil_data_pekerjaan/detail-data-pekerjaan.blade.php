@extends('layout.main-after-login')
@section('container')

<link rel="stylesheet" href="https://cdn.datatables.net/2.1.3/css/dataTables.dataTables.css"/>
<link rel="stylesheet" href="{{ asset('assets/takmir_masjid/css/detailMosqueProgram.css') }}">

    {{-- header --}}
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Detail Data Pekerjaan</h1>
                    <p class="mt-2">{{ $getData->nama_masjid }}</p>
                </div>
                <div class="col-sm-6 mb-3">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a href="#">Detail data pekerjaan</a>
                        </li>
                        <li class="breadcrumb-item active">Tampilan detail pekerjaan</li>
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
                        <i class="fas fa-user-tie mr-2"></i>Detail Data Pekerjaan
                    </h5>
                </div>
                <div class="col-md-12 mt-3">
                    <table width="100%">
                        <tbody>
                            <tr>
                                <td class="custom-width-td" width="180px"><b>Nama</b></td>
                                <td width="1%">:</td>
                                <td style="padding-left: 5px;">{{ $pekerjaan->nama_lengkap ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <td class="custom-width-td" width="200px"><b>Pekerjaan</b></td>
                                <td width="1%">:</td>
                                <td style="padding-left: 5px;">{{ $pekerjaan->pekerjaan ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <td class="custom-width-td" width="180px"><b>No. Telepon</b></td>
                                <td width="1%">:</td>
                                <td style="padding-left: 5px;">{{ $pekerjaan->no_wa ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <td class="custom-width-td" width="200px"><b>RT</b></td>
                                <td width="1%">:</td>
                                <td style="padding-left: 5px;">{{ $pekerjaan->kartuKeluarga->no_rt ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <td class="custom-width-td" width="180px"><b>No Kartu Keluarga</b></td>
                                <td width="1%">:</td>
                                <td style="padding-left: 5px;">{{ $pekerjaan->kartuKeluarga->nomor_kk ?? 'N/A' }}</td>
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
            window.location.href = '/dashboard/tampil_data_pekerjaan'; // Go back to the previous page
        }
    </script>

    <script src="https://code.jquery.com/jquery-3.7.0.js" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/2.1.3/js/dataTables.js"></script>
@endsection
