@extends('layout.main-after-login')

@section('container')
<link rel="stylesheet" href="https://cdn.datatables.net/2.1.3/css/dataTables.dataTables.css"/>
<link rel="stylesheet" href="{{ asset('assets/takmir_masjid/css/addMosqueProgram.css') }}">
<!-- Flatpickr CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
        {{-- header --}}
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Tambah Jenis Program Takmir Masjid</h1>
                        <p class="mt-2">{{ $getData->nama_masjid }}</p>
                    </div>
                    <div class="col-sm-6 mb-3">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item">
                                <a href="#">Jenis Program masjid</a>
                            </li>
                            <li class="breadcrumb-item active">
                                Tambah jenis program masjid
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        {{-- content --}}
        <div class="content">
            <div class="container-fluid">
                @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    @foreach ($errors->all() as $error)
                        <strong>{{ $error }}</strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    @endforeach
                  </div>
                @endif
                <div class="card">
                    <h5 class="card-header text-center">Jenis Program {{ $getData->nama_masjid }}</h5>
                    <div class="mt-3 p-3 custom-icon">
                        <i class="fas fa-clipboard-list" style="font-size: 120px"></i>
                    </div>
                    <form action="{{ route('jenis_program_masjid.store') }}" method="POST" style="margin-top: 20px">
                        @csrf
                        <div class="form-group row justify-content-center" id="inputContainer">
                            {{-- Jika data jenis_program kosong, tampilkan satu input kosong --}}
                            @if($jenis_programs->isEmpty())
                                <div class="input-group row justify-content-center" id="inputGroup-1">
                                    <label for="inputNama-1" class="col-md-3 col-form-label">Jenis program ke-1</label>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control margin-top-20" name="jenis_program[]" id="inputNama-1" placeholder="Jenis program" required>
                                    </div>
                                    <div style="margin-left: 10px; display: flex; align-items: flex-end; gap: 5px;">
                                        <button type="button" class="btn btn-success btn-add" onclick="onClickAdd()">
                                            <span class="fa fa-plus"></span>
                                        </button>
                                        <button type="button" class="btn btn-danger btn-delete" onclick="onClickRemove(this)" style="display: none;">
                                            <span class="fa fa-minus"></span>
                                        </button>
                                    </div>
                                </div>
                            @else
                                {{-- Jika ada data jenis_program, tampilkan semua data --}}
                                @foreach ($jenis_programs as $index => $program)
                                    <div class="input-group row justify-content-center mt-4" id="inputGroup-{{ $index + 1 }}">
                                        <label for="inputNama-{{ $index + 1 }}" class="col-md-3 col-form-label">Jenis program ke-{{ $index + 1 }}</label>
                                        <div class="col-sm-6">
                                            <input type="text" class="form-control margin-top-20" 
                                                   name="jenis_program[]" 
                                                   id="inputNama-{{ $index + 1 }}" 
                                                   placeholder="Jenis program" 
                                                   value="{{ old('jenis_program.' . $index, $program->jenis_program) }}" 
                                                   disabled>
                                        </div>
                                        <div style="margin-left: 10px; display: flex; align-items: flex-end; gap: 5px;">
                                            <button type="button" class="btn btn-success btn-add" onclick="onClickAdd()">
                                                <span class="fa fa-plus"></span>
                                            </button>
                                            <button type="button" class="btn btn-danger btn-delete" onclick="onClickRemove(this)" style="display: none;" disabled>
                                                <span class="fa fa-minus"></span>
                                            </button>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                        
                        <div class="text-center mt-4 mb-5">
                            <button type="button" class="col-md-3 btn btn-secondary mr-3" onclick="onClickLocationBack()">Kembali</button>
                            <button type="submit" class="col-md-3 btn btn-primary">Simpan</button>
                        </div>                     
                    </form>                                                      
                </div>
            </div>
        </div>
        {{-- script --}}
        <!-- Flatpickr JS -->
        <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
        <script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM=" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/2.1.3/js/dataTables.js"></script>
        <script src="{{ asset('assets/takmir_masjid/js/mosqueProgramType.js') }}"></script>
@endsection
