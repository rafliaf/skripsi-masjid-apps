<link rel="stylesheet" href="{{ asset('assets/sidebar/css/sidebar.css') }}">
<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4 sidebar-custom">
    <!-- Brand Logo -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex align-items-center">
        <div class="image">
            <img src="{{ asset('assets/sidebar/img/mosque.png') }}" class="" alt="User Image">
        </div>
        <div class="info">
            <p style="color: white; font-weight:bold; margin: 0;">{{ $getData->nama_masjid }}</p>
        </div>
    </div>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        {{-- <div class="user-panel">
        <div class="info">
            <h5 style="color: white">General</h5>
        </div>
      </div> --}}

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu">

                {{-- if role admin --}}
                @if (Auth::check() && Auth::user()->role == 'admin_masjid')
                    <li class="nav-item" style="margin-top: 10px">
                        <a href="/dashboard" class="nav-link {{ Request::is('dashboard') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-home"></i>
                            <p>
                                Home
                            </p>
                        </a>
                    </li>
                    {{-- user --}}
                    <li class="nav-item" style="margin-top: 10px">
                        <a href="/dashboard/data_user"
                            class="nav-link {{ Request::is('dashboard/data_user', 'dashboard/tambah_user') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-user"></i>
                            <p>
                                Data user
                            </p>
                        </a>
                    </li>
                    {{-- data masjid --}}
                    <li class="nav-item" style="margin-top: 10px">
                        <a href="/dashboard/data_masjid"
                            class="nav-link {{ Request::is('dashboard/data_masjid', 'dashboard/edit_data_masjid') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-mosque"></i>
                            <p>
                                Data masjid
                            </p>
                        </a>
                    </li>
                    {{-- tampil data dropdown --}}
                    <li class="nav-item" id="tampil-data-menu" style="margin-top: 10px">
                        <a href="#"
                            class="nav-link {{ Request::is('dashboard/tampil_data_kk', 'dashboard/tampil_data_kk/read/*', 'dashboard/tampil_data_jamaah', 'dashboard/tampil_data_jamaah/read/*', 'dashboard/tampil_data_ibadah', 'dashboard/tampil_data_ibadah/read/*', 'dashboard/tampil_data_keahlian', 'dashboard/tampil_data_keahlian/read/*', 'dashboard/tampil_data_pekerjaan', 'dashboard/tampil_data_pekerjaan/read/*', 'dashboard/tampil_data_pendidikan', 'dashboard/tampil_data_pendidikan/read/*', 'dashboard/tampil_data_kemampuan', 'dashboard/tampil_data_kemampuan/read/*') ? 'active' : '' }}">
                            <i class="nav-icon fa-solid fa-database pr-1"></i>
                            <p>
                                Tampil data
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="/dashboard/tampil_data_kk"
                                    class="nav-link {{ Request::is('dashboard/tampil_data_kk', 'dashboard/tampil_data_kk/read/*') ? 'active' : '' }}">
                                    <i class="fa fa-circle nav-icon" style="font-size: 12px"></i>
                                    <p>Tampil KK</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="/dashboard/tampil_data_jamaah"
                                    class="nav-link {{ Request::is('dashboard/tampil_data_jamaah', 'dashboard/tampil_data_jamaah/read/*') ? 'active' : '' }}">
                                    <i class="fa fa-circle nav-icon" style="font-size: 12px"></i>
                                    <p>Tampil jamaah</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="/dashboard/tampil_data_ibadah"
                                    class="nav-link {{ Request::is('dashboard/tampil_data_ibadah', 'dashboard/tampil_data_ibadah/read/*') ? 'active' : '' }}">
                                    <i class="fa fa-circle nav-icon" style="font-size: 12px"></i>
                                    <p>Tampil ibadah</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="/dashboard/tampil_data_keahlian"
                                    class="nav-link {{ Request::is('dashboard/tampil_data_keahlian', 'dashboard/tampil_data_keahlian/read/*') ? 'active' : '' }}">
                                    <i class="fa fa-circle nav-icon" style="font-size: 12px"></i>
                                    <p>Tampil keahlian</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="/dashboard/tampil_data_pekerjaan"
                                    class="nav-link {{ Request::is('dashboard/tampil_data_pekerjaan', 'dashboard/tampil_data_pekerjaan/read/*') ? 'active' : '' }}">
                                    <i class="fa fa-circle nav-icon" style="font-size: 12px"></i>
                                    <p>Tampil pekerjaan</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="/dashboard/tampil_data_pendidikan"
                                    class="nav-link {{ Request::is('dashboard/tampil_data_pendidikan', 'dashboard/tampil_data_pendidikan/read/*') ? 'active' : '' }}">
                                    <i class="fa fa-circle nav-icon" style="font-size: 12px"></i>
                                    <p>Tampil pendidikan</p>
                                </a>
                            </li>
                            <li class="nav-item mb-5">
                                <a href="/dashboard/tampil_data_kemampuan"
                                    class="nav-link {{ Request::is('dashboard/tampil_data_kemampuan', 'dashboard/tampil_data_kemampuan/read/*') ? 'active' : '' }}">
                                    <i class="fa fa-circle nav-icon" style="font-size: 12px"></i>
                                    <p>Tampil kemampuan</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endif

                {{-- if role takmir --}}
                @if (Auth::check() && Auth::user()->role == 'takmir')
                    <li class="nav-item" style="margin-top: 10px">
                        <a href="/dashboard" class="nav-link {{ Request::is('dashboard') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-home"></i>
                            <p>
                                Home
                            </p>
                        </a>
                    </li>
                    {{-- data jamaah dropdown --}}
                    <li class="nav-item" id="data-jamaah-menu" style="margin-top: 10px">
                        <a href="#"
                            class="nav-link {{ Request::is('dashboard/data_kk', 'dashboard/data_induk', 'dashboard/data_keahlian', 'dashboard/data_kk/create', 'dashboard/data_kk/*/edit', 'dashboard/data_induk/create', 'dashboard/data_induk/edit/*', 'dashboard/data_keahlian/create_jenis_keahlian', 'dashboard/data_keahlian/create', 'dashboard/data_keahlian/edit/*') ? 'active' : '' }}">
                            <i class="nav-icon fa-solid fa-user-plus"></i>
                            <p>
                                Data jamaah
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="/dashboard/data_kk"
                                    class="nav-link {{ Request::is('dashboard/data_kk', 'dashboard/data_kk/create', 'dashboard/data_kk/*/edit') ? 'active' : '' }}">
                                    <i class="fa fa-circle nav-icon" style="font-size: 12px"></i>
                                    <p>Data kartu keluarga</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="/dashboard/data_induk"
                                    class="nav-link {{ Request::is('dashboard/data_induk', 'dashboard/data_induk/create', 'dashboard/data_induk/edit/*') ? 'active' : '' }}">
                                    <i class="fa fa-circle nav-icon" style="font-size: 12px"></i>
                                    <p>Data induk</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="/dashboard/data_keahlian"
                                    class="nav-link {{ Request::is('dashboard/data_keahlian', 'dashboard/data_keahlian/create_jenis_keahlian', 'dashboard/data_keahlian/create', 'dashboard/data_keahlian/edit/*') ? 'active' : '' }}">
                                    <i class="fa fa-circle nav-icon" style="font-size: 12px"></i>
                                    <p>Data keahlian</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    {{-- data remaja masjid --}}
                    <li class="nav-item mt-2">
                        <a href="/dashboard/remaja_masjid"
                            class="nav-link {{ Request::is('dashboard/remaja_masjid', 'dashboard/remaja_masjid/create') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-user-plus"></i>
                            <p>
                                Data remaja masjid
                            </p>
                        </a>
                    </li>
                    {{-- program takmir masjid --}}
                    <li class="nav-item mt-2">
                        <a href="/dashboard/program_takmir"
                            class="nav-link {{ Request::is('dashboard/program_takmir', 'dashboard/program_takmir/create_jenis_program', 'dashboard/program_takmir/create', 'dashboard/program_takmir/detail/*', 'dashboard/program_takmir/edit/*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-list-alt pr-1"></i>
                            <p>
                                Program takmir masjid
                            </p>
                        </a>
                    </li>
                    {{-- tampil data dropdown --}}
                    <li class="nav-item" id="tampil-data-menu" style="margin-top: 10px">
                        <a href="#"
                            class="nav-link {{ Request::is('dashboard/tampil_data_kk', 'dashboard/tampil_data_kk/read/*', 'dashboard/tampil_data_jamaah', 'dashboard/tampil_data_jamaah/read/*', 'dashboard/tampil_data_ibadah', 'dashboard/tampil_data_ibadah/read/*', 'dashboard/tampil_data_keahlian', 'dashboard/tampil_data_keahlian/read/*', 'dashboard/tampil_data_pekerjaan', 'dashboard/tampil_data_pekerjaan/read/*', 'dashboard/tampil_data_pendidikan', 'dashboard/tampil_data_pendidikan/read/*', 'dashboard/tampil_data_kemampuan', 'dashboard/tampil_data_kemampuan/read/*') ? 'active' : '' }}">
                            <i class="nav-icon fa-solid fa-database pr-1"></i>
                            <p>
                                Tampil data
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="/dashboard/tampil_data_kk"
                                    class="nav-link {{ Request::is('dashboard/tampil_data_kk', 'dashboard/tampil_data_kk/read/*') ? 'active' : '' }}">
                                    <i class="fa fa-circle nav-icon" style="font-size: 12px"></i>
                                    <p>Tampil KK</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="/dashboard/tampil_data_jamaah"
                                    class="nav-link {{ Request::is('dashboard/tampil_data_jamaah', 'dashboard/tampil_data_jamaah/read/*') ? 'active' : '' }}">
                                    <i class="fa fa-circle nav-icon" style="font-size: 12px"></i>
                                    <p>Tampil jamaah</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="/dashboard/tampil_data_ibadah"
                                    class="nav-link {{ Request::is('dashboard/tampil_data_ibadah', 'dashboard/tampil_data_ibadah/read/*') ? 'active' : '' }}">
                                    <i class="fa fa-circle nav-icon" style="font-size: 12px"></i>
                                    <p>Tampil ibadah</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="/dashboard/tampil_data_keahlian"
                                    class="nav-link {{ Request::is('dashboard/tampil_data_keahlian', 'dashboard/tampil_data_keahlian/read/*') ? 'active' : '' }}">
                                    <i class="fa fa-circle nav-icon" style="font-size: 12px"></i>
                                    <p>Tampil keahlian</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="/dashboard/tampil_data_pekerjaan"
                                    class="nav-link {{ Request::is('dashboard/tampil_data_pekerjaan', 'dashboard/tampil_data_pekerjaan/read/*') ? 'active' : '' }}">
                                    <i class="fa fa-circle nav-icon" style="font-size: 12px"></i>
                                    <p>Tampil pekerjaan</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="/dashboard/tampil_data_pendidikan"
                                    class="nav-link {{ Request::is('dashboard/tampil_data_pendidikan', 'dashboard/tampil_data_pendidikan/read/*') ? 'active' : '' }}">
                                    <i class="fa fa-circle nav-icon" style="font-size: 12px"></i>
                                    <p>Tampil pendidikan</p>
                                </a>
                            </li>
                            <li class="nav-item mb-5">
                                <a href="/dashboard/tampil_data_kemampuan"
                                    class="nav-link {{ Request::is('dashboard/tampil_data_kemampuan', 'dashboard/tampil_data_kemampuan/read/*') ? 'active' : '' }}">
                                    <i class="fa fa-circle nav-icon" style="font-size: 12px"></i>
                                    <p>Tampil kemampuan</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endif

                {{-- if role remaja masjid --}}
                @if (Auth::check() && Auth::user()->role == 'remaja_masjid')
                    {{-- home remaja masjid --}}
                    <li class="nav-item" style="margin-top: 10px">
                        <a href="/dashboard" class="nav-link {{ Request::is('dashboard') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-home"></i>
                            <p>
                                Home
                            </p>
                        </a>
                    </li>
                    {{-- data remaja masjid --}}
                    <li class="nav-item mt-2">
                        <a href="/dashboard/remaja_masjid"
                            class="nav-link {{ Request::is('dashboard/remaja_masjid', 'dashboard/remaja_masjid/create') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-user-plus"></i>
                            <p>
                                Data remaja masjid
                            </p>
                        </a>
                    </li>
                    {{-- program remaja masjid --}}
                    <li class="nav-item mt-2">
                        <a href="/dashboard/pogram_remaja_masjid"
                            class="nav-link {{ Request::is('dashboard/pogram_remaja_masjid', 'dashboard/pogram_remaja_masjid/create', 'dashboard/pogram_remaja_masjid/edit/*', 'dashboard/pogram_remaja_masjid/detail/*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-list-alt pr-1"></i>
                            <p>
                                Program remaja masjid
                            </p>
                        </a>
                    </li>

                    {{-- tampil kemampuan --}}
                    <li class="nav-item">
                        <a href="/dashboard/tampil_data_kemampuan"
                            class="nav-link {{ Request::is('dashboard/tampil_data_kemampuan', 'dashboard/tampil_data_kemampuan/read/*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-book-reader"></i>
                            <p>Kemampuan baca</p>
                        </a>
                    </li>
                @endif
            </ul>
        </nav>
    </div>
    <!-- /.sidebar -->
</aside>
<!-- Include jQuery -->
<script src="{{ asset('assets/sidebar/js/sidebar.js') }}"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
