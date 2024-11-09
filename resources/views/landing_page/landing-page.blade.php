@extends('layout.main-auth')

{{-- HERO --}}
@section('container')
    <div class="hero vh-100 d-flex align-items-center">
        <div class="container">
        <div class="row">
                <div class="col-lg-7 mx-auto text-center">
                    <h1 class="display-5 fw-bold text-white">Daftarkan Masjid Anda Sekarang</h1>
                    <p class="text-white my-4">Kelola masjid dengan lebih mudah dan efisien! Platform kami membantu Anda mencatat data jamaah, mengatur jadwal kegiatan, hingga mengelola donasi dengan transparan. Tingkatkan keterlibatan jamaah dan optimalkan pengelolaan masjid dalam satu aplikasi terintegrasi.</p>
                    <a href="register" class="btn btn-primary">Daftar</a>
                    <a href="login" class="btn btn-outline-light">Login</a>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid about" id="about">
        <div class="container">
            <div class="row g-5 mb-5 mt-1">
                <div class="col-xl-6">
                    <div class="row g-4">
                        <div class="col-6">
                            <img src="assets/landing_page/img/about1.png" class="img-fluid h-100 wow zoomIn" data-wow-delay="0.1s" alt="">
                        </div>
                        <div class="col-6">
                            <img src="assets/landing_page/img/about2.png" class="img-fluid pb-3 wow zoomIn" data-wow-delay="0.1s" alt="">
                            <img src="assets/landing_page/img/about3.png" class="img-fluid pt-3 wow zoomIn" data-wow-delay="0.1s" alt="">
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 wow fadeIn" data-wow-delay="0.5s">
                    <p class="fs-5 text-uppercase text-primary" >About
                    </p>
                    <h2 class="display-5 pb-4 m-0">Pencatatan data jamaah masjid</h2>
                      Mempermudah takmir masjid untuk mengelola data jamaah masjid serta mempermudah dalam pengambilan keputusan untuk takmir masjid dalam membantu jamaah di sekitar masjid
                    </p>
                </div>
                
                <div class="container text-center bg-primary py-5 wow fadeIn" data-wow-delay="0.1s">
                  <div class="row g-4 align-items-center">
                      <div class="col-lg-2">
                          <i class="fa fa-mosque fa-5x text-white"></i>
                      </div>
                      <div class="col-lg-7 text-center text-lg-start">
                          <h1 class="mb-0" style="color: white">Manajemen data jamaah masjid</h1>
                      </div>
                      <div class="col-lg-3">
                          <a href="" class="btn btn-light py-2 px-4">Learn More</a>
                      </div>
                  </div>
              </div>
                <a href="#" class="btn btn-primary border-3 border-light back-to-top"><i class="fa fa-arrow-up"></i></a>
                <div class="container-fluid activities">
                  <div class="container">
                      <div class="mx-auto text-center mt-3 mb-5 wow fadeIn" data-wow-delay="0.1s" style="max-width: 700px;">
                        <h1>Fitur & Fungsi</h1>
                      </div>
                      <div class="row g-4">
                          <div class="col-lg-6 col-xl-4">
                              <div class="activities-item p-4 wow fadeIn" data-wow-delay="0.1s">
                                  <i class="fa fa-mosque fa-4x text-dark"></i>
                                  <div class="ms-4">
                                      <h4>Manajemen Jamaah Masjid</h4>
                                      <p class="mb-4">Memberikan kemudahan dalam mengelola data jamaah masjid</p>
                                      <a href="" class="btn btn-primary px-3">Read More</a>
                                  </div>
                              </div>
                          </div>
                          <div class="col-lg-6 col-xl-4">
                              <div class="activities-item p-4 wow fadeIn" data-wow-delay="0.3s">
                                  <i class="fa-solid fa-chart-pie fa-4x text-dark"></i>
                                  <div class="ms-4">
                                      <h4>Chart</h4>
                                      <p class="mb-4">Memberikan informasi data jamaah dalam bentuk chart untuk memudahkan informasi dan mendapatkan perbandingan data jamaah</p>
                                      <a href="" class="btn btn-primary px-3">Read More</a>
                                  </div>
                              </div>
                          </div>
                          <div class="col-lg-6 col-xl-4">
                              <div class="activities-item p-4 wow fadeIn" data-wow-delay="0.5s">
                                  <i class="fa fa-quran fa-4x text-dark"></i>
                                  <div class="ms-4">
                                      <h4>Remaja Masjid</h4>
                                      <p class="mb-4">Membantu takmir dalam pengelolaan program masjid, dan mengelola data remaja masjid</p>
                                      <a href="" class="btn btn-primary px-3">Read More</a>
                                  </div>
                              </div>
                          </div>
                          <div class="col-lg-6 col-xl-4">
                              <div class="activities-item p-4 wow fadeIn" data-wow-delay="0.1s">
                                  <i class="fa-solid fa-table fa-5x text-dark"></i>
                                  <div class="ms-4">
                                      <h4>Tabel</h4>
                                      <p class="mb-4">Menampilkan dan menyimpan data dalam bentuk tabel sesuai dengan kelompok untuk kemudahan dalam pencarian data</p>
                                      <a href="" class="btn btn-primary px-3">Read More</a>
                                  </div>
                              </div>
                          </div>
                          <div class="col-lg-6 col-xl-4">
                              <div class="activities-item p-4 wow fadeIn" data-wow-delay="0.5s">
                                  <i class="fa-solid fa-solid fa-desktop fa-4x text-dark"></i>
                                  <div class="ms-4">
                                      <h4>Dasbor</h4>
                                      <p class="mb-4">Fitur utama dalam mengelola data jamaah yang berisi tabel, dan chart untuk menyimpan dan memudahkan dalam mendapatkan informasi.</p>
                                      <a href="" class="btn btn-primary px-3">Read More</a>
                                  </div>
                              </div>
                          </div>
                          <div class="col-lg-6 col-xl-4">
                              <div class="activities-item p-4 wow fadeIn" data-wow-delay="0.3s">
                                  <i class="fa fa-book-open fa-4x text-dark"></i>
                                  <div class="ms-4">
                                      <h4>Program Masjid</h4>
                                      <p class="mb-4">Untuk mencatat kegiatan program masjid seperti program rutin, program ramadhan, dan program lainnya sesuai kebutuhan masjid</p>
                                      <a href="" class="btn btn-primary px-3">Read More</a>
                                  </div>
                              </div>
                          </div>
                          
                      </div>
                  </div>
              </div> 
                
              <!-- footer -->
              <footer class="bg-body-tertiary text-center text-lg-start">
                <!-- Copyright -->
                <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.05);">
                  © 2020 Copyright:
                  <a class="text-body" href="">Masjidku</a>
                </div>
                <!-- Copyright -->
              </footer>
@endsection
