@extends('layout.main-after-login')
@section('container')

<link rel="stylesheet" href="https://cdn.datatables.net/2.1.3/css/dataTables.dataTables.css"/>
<link rel="stylesheet" href="{{ asset('assets/takmir_masjid/css/detailMosqueProgram.css') }}">
        {{-- header --}}
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Detail Program Remaja Masjid</h1>
                        <p class="mt-2">{{ $getData->nama_masjid }}</p>
                    </div>
                    <div class="col-sm-6 mb-3">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item">
                                <a href="#">Detail Program remaja masjid</a>
                            </li>
                            <li class="breadcrumb-item active">
                                Tampilan detail program remaja masjid
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
                        <h5 class="card-header" style="color: #03337B"><i class="fas fa-clipboard-list mr-2"></i>Detail kegiatan</h5>
                    </div>
                    <div class="col-md-12 mt-3">
                      <table width="100%">
                          <thead>
                              <tr class="col-md-12">
                                  <td class="custom-width-td" width="180px"><b>Jenis Program</b></td>
                                  <td width="1%">:</td>
                                  <td style="padding-left: 5px;">{{ $program->jenisProgram->jenis_program ?? 'Tidak diketahui' }}</td> <!-- Assuming a relation for jenis program -->
                              </tr>
                              <tr class="col-md-12">
                                  <td class="custom-width-td" width="180px"><b>Nama kegiatan</b></td>
                                  <td width="1%">:</td>
                                  <td style="padding-left: 5px;">{{ $program->nama_kegiatan }}</td>
                              </tr>
                              <tr class="col-md-12">
                                  <td class="custom-width-td" width="180px"><b>Lokasi kegiatan</b></td>
                                  <td width="1%">:</td>
                                  <td style="padding-left: 5px;">{{ $program->lokasi_kegiatan }}</td>
                              </tr>
                              <tr class="col-md-12">
                                  <td class="custom-width-td" width="180px"><b>Tanggal mulai</b></td>
                                  <td width="1%">:</td>
                                  <td style="padding-left: 5px;">{{ \Carbon\Carbon::parse($program->tgl_mulai)->format('d F Y H:i') }} WIB</td>
                              </tr>
                              <tr class="col-md-12">
                                  <td class="custom-width-td" width="180px"><b>Tanggal selesai</b></td>
                                  <td width="1%">:</td>
                                  <td style="padding-left: 5px;">{{ \Carbon\Carbon::parse($program->tgl_selesai)->format('d F Y H:i') }} WIB</td>
                              </tr>
                              <tr class="col-md-12">
                                  <td class="custom-width-td" width="180px"><b>Penanggung jawab</b></td>
                                  <td width="1%">:</td>
                                  <td style="padding-left: 5px;">{{ $dataInduk->nama_lengkap ?? 'Tidak diketahui' }}</td>
                              </tr>
                              <tr class="col-md-12">
                                  <td class="custom-width-td" width="180px"><b>No.telepon</b></td>
                                  <td width="1%">:</td>
                                  <td style="padding-left: 5px;">{{ $dataInduk->no_wa ?? 'Tidak diketahui' }}</td>
                              </tr>
                              <tr class="col-md-12">
                                  <td class="custom-width-td" width="180px"><b>Sasaran kegiatan</b></td>
                                  <td width="1%">:</td>
                                  <td style="padding-left: 5px;">{{ $program->sasaran_kegiatan }}</td>
                              </tr>
                              <tr class="col-md-12">
                                  <td class="custom-width-td" width="180px"><b>Catatan pelaksanaan</b></td>
                                  <td width="1%">:</td>
                                  <td style="padding-left: 5px; text-align: justify">{{ $program->catatan_pelaksanaan }}</td>
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
        <script src="{{ asset('assets/takmir_masjid/js/mosqueProgram.js') }}"></script>
@endsection