<?php
use App\Models\RegisterMasjid;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AdminMasjidController;
use App\Http\Controllers\DashboardDataKKController;
use App\Http\Controllers\DataIndukController;
use App\Http\Controllers\DataKartuKeluargaController;
use App\Http\Controllers\DataKeahlianController;
use App\Http\Controllers\DataMasjidController;
use App\Http\Controllers\DataUserController;
use App\Http\Controllers\ProgramTakmirController;
use App\Http\Controllers\RegisterMasjidController;
use App\Http\Controllers\RemajaMasjidController;
use App\Http\Controllers\TampilDataController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// landing page
Route::get('/', [RegisterMasjidController::class, 'landingPage'])->middleware('guest');

/////////////////// AUTH ///////////////////////
// register
Route::get('/register', [RegisterMasjidController::class, 'index'])->middleware('guest'); // Show the registration form
Route::post('/register', [RegisterMasjidController::class, 'store']); // Handle the form submission


// login
Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');;
Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout']);

// login with google
Route::get('oauth/google', [LoginController::class, 'redirectToProvider'])->name('oauth.google');  
Route::get('oauth/google/callback', [LoginController::class, 'handleProviderCallback'])->name('oauth.google.callback');

/////////////////// END AUTH ///////////////////////

/////////////// INDEX ALL ROLE //////////////////////
Route::get('/dashboard', [AdminMasjidController::class, 'index'])->middleware('auth');

/////////////// ADMIN MASJID //////////////////////
Route::get('/dashboard/data_user', [UserController::class, 'index'])->name('user.index')->middleware('auth');

// Route for editing user data
Route::post('/dashboard/user/update', [UserController::class, 'editUserData'])->name('user.update');

// Route for deleting user data
Route::delete('/dashboard/user/{id}/delete', [UserController::class, 'deleteUserData'])->name('user.delete');

Route::get('/dashboard/tambah_user',[UserController::class, 'indexAddUserData'])->middleware('auth');
Route::post('/dashboard/tambah_user',[UserController::class, 'addUserData'])->middleware('auth');

Route::get('/dashboard/data_masjid', [DataMasjidController::class, 'index'])->name('data_masjid.index')->middleware('auth');

Route::get('/dashboard/edit_data_masjid', [DataMasjidController::class, 'getViewEditDataMasjid'])->middleware('auth');
Route::put('/dashboard/edit_data_masjid', [DataMasjidController::class, 'updateDataMasjid'])->name('update.mosque')->middleware('auth');


/////////////// END ADMIN MASJID //////////////////////


/////////////// TAKMIR MASJID //////////////////////
///// DATA KARTU KELUARGA /////
Route::get('/dashboard/data_kk', [DataKartuKeluargaController::class, 'indexDataKK'])->name('data_kk.index')->middleware('auth');

// post data
Route::get('/dashboard/data_kk/create', [DataKartuKeluargaController::class, 'indexAddDataKK'])->name('data_kk.create')->middleware('auth');
Route::post('/dashboard/data_kk/create', [DataKartuKeluargaController::class, 'addDataKK'])->name('data_kk.store')->middleware('auth');

// edit data
Route::get('/dashboard/data_kk/{id}/edit', [DataKartuKeluargaController::class, 'indexEditDataKK'])->middleware('auth');
Route::put('/dashboard/data_kk/{id}/edit', [DataKartuKeluargaController::class, 'editDataKK'])->middleware('auth');

// delete data
Route::delete('/dashboard/data_kk/{id}', [DataKartuKeluargaController::class, 'deleteData'])->middleware('auth');

///// DATA INDUK /////
Route::get('/dashboard/data_induk', [DataIndukController::class, 'index'])->name('data_induk.index')->middleware('auth');

Route::get('/dashboard/data_induk/create', [DataIndukController::class, 'indexAddDataInduk'])->middleware('auth');
Route::post('/dashboard/data_induk/create', [DataIndukController::class, 'addDataInduk'])->name('data_induk.store')->middleware('auth');

Route::get('/dashboard/data_induk/edit/{id}', [DataIndukController::class, 'indexEditDataInduk'])->name('data_induk.edit')->middleware('auth');
Route::put('/dashboard/data_induk/update/{id}', [DataIndukController::class, 'editDataInduk'])->name('data_induk.update')->middleware('auth');

Route::delete('/dashboard/data_induk/{id}', [DataIndukController::class, 'deleteDataInduk'])->name('data_induk.delete')->middleware('auth');

/////////////// DATA KEAHLIAN //////////////////////
Route::get('/dashboard/data_keahlian', [DataKeahlianController::class, 'index'])->name('dataKeahlianIndex')->middleware('auth');
// post jenis keahlian
Route::get('/dashboard/data_keahlian/create_jenis_keahlian', [DataKeahlianController::class, 'indexAddJenisKeahlian'])->middleware('auth');
Route::post('/dashboard/data_keahlian/store_jenis_keahlian', [DataKeahlianController::class, 'storeJenisKeahlian'])->name('storeJenisKeahlian')->middleware('auth');

// post data keahlian
Route::get('/dashboard/data_keahlian/create', [DataKeahlianController::class, 'indexAddDataKeahlian'])->middleware('auth');
Route::post('/dashboard/data_keahlian/store', [DataKeahlianController::class, 'storeDataKeahlian'])->name('storeDataKeahlian')->middleware('auth');

// edit
Route::get('/dashboard/data_keahlian/edit/{id}', [DataKeahlianController::class, 'indexEditDataKeahlian'])->name('editDataKeahlian')->middleware('auth');
Route::put('/dashboard/data_keahlian/update/{id}', [DataKeahlianController::class, 'updateDataKeahlian'])->name('updateDataKeahlian')->middleware('auth');

// delete
Route::delete('/dashboard/data_keahlian/{id}', [DataKeahlianController::class, 'deleteDataKeahlian'])->name('deleteDataKeahlian')->middleware('auth');

/////////////// END DATA KEAHLIAN //////////////////////

/////////////// PROGRAM TAKMIR MASJID //////////////////////
Route::get('/dashboard/program_takmir',[ProgramTakmirController::class, 'index'])->name('index_program_takmir.index')->middleware('auth');

// POST jenis program
Route::get('/dashboard/program_takmir/create_jenis_program', [ProgramTakmirController::class, 'indexAddJenisProgram'])->middleware('auth');
Route::post('/dashboard/program_takmir/create_jenis_program', [ProgramTakmirController::class, 'storeJenisProgram'])->name('jenis_program_masjid.store');
// POST data program
Route::get('/dashboard/program_takmir/create', [ProgramTakmirController::class, 'indexAddData'])->middleware('auth');
Route::post('/dashboard/program_takmir/store', [ProgramTakmirController::class, 'storeDataProgram'])->name('program_takmir.store')->middleware('auth');
// EDIT Program
Route::get('/dashboard/program_takmir/edit/{id}', [ProgramTakmirController::class, 'indexEditData'])->name('program_takmir.edit')->middleware('auth');
Route::put('/dashboard/program_takmir/update/{id}', [ProgramTakmirController::class, 'update'])->name('program_takmir.update')->middleware('auth');
// DETAIL
Route::get('/dashboard/program_takmir/detail/{id}', [ProgramTakmirController::class, 'detail'])->name('program_takmir.detail');
// DELETE
Route::delete('/dashboard/program_takmir/delete/{id}', [ProgramTakmirController::class, 'deleteDataProgram'])->name('program_takmir.delete')->middleware('auth');

/////////////// END PROGRAM TAKMIR MASJID ///////////////
/////////////// END TAKMIR MASJID //////////////////////

/////////////// REMAJA MASJID //////////////////////
Route::get('/dashboard/remaja_masjid', [RemajaMasjidController::class, 'index'])->name('remajaMasjidIndex')->middleware('auth');

// post data
Route::get('/dashboard/remaja_masjid/create', [RemajaMasjidController::class, 'indexAddData'])->middleware('auth');
Route::post('/dashboard/remaja_masjid/store', [RemajaMasjidController::class, 'storeDataRemajaMasjid'])->name('storeDataRemajaMasjid')->middleware('auth');

// Edit and Update routes
Route::post('/dashboard/remaja_masjid/edit/{id}', [RemajaMasjidController::class, 'editDataRemajaMasjid'])->name('remaja.update')->middleware('auth');

// Delete data
Route::delete('/dashboard/remaja_masjid/delete/{id}', [RemajaMasjidController::class, 'deleteDataRemajaMasjid'])->name('remaja.delete')->middleware('auth');


// PROGRAM REMAJA MASJID
Route::get('/dashboard/pogram_remaja_masjid', [RemajaMasjidController::class, 'indexProgramRemaja'])->name('indexProgramRemaja')->middleware('auth');

// Display the form
Route::get('/dashboard/pogram_remaja_masjid/create', [RemajaMasjidController::class, 'indexAddProgram'])->middleware('auth');

// Handle the form submission
Route::post('/dashboard/pogram_remaja_masjid/store', [RemajaMasjidController::class, 'addProgram'])->name('addProgram')->middleware('auth');

// Display the form for editing
Route::get('/dashboard/pogram_remaja_masjid/edit/{id}', [RemajaMasjidController::class, 'indexEditProgram'])->name('editProgram')->middleware('auth');

// Handle the form submission for updating
Route::put('/dashboard/pogram_remaja_masjid/update/{id}', [RemajaMasjidController::class, 'updateProgram'])->name('updateProgram')->middleware('auth');

// DETAIL
Route::get('/dashboard/pogram_remaja_masjid/detail/{id}', [RemajaMasjidController::class, 'detailProgram'])->middleware('auth');

// DELETE
Route::delete('/dashboard/program_remaja_masjid/delete/{id}', [RemajaMasjidController::class, 'deleteDataProgram'])->name('deleteProgram')->middleware('auth');


/////////////// END REMAJA MASJID //////////////////////

/////////////// TAMPIL DATA TAKMIR MASJID //////////////////////
// data kk
Route::get('/dashboard/tampil_data_kk',[TampilDataController::class, 'indexDataKK'])->middleware('auth');

// detail kk
Route::get('/dashboard/tampil_data_kk/read/{id}', [TampilDataController::class, 'detailDataKK'])->middleware('auth');

// data jamaah
Route::get('/dashboard/tampil_data_jamaah', [TampilDataController::class, 'indexDataJamaah'])->middleware('auth');
// detail data jamaah
Route::get('/dashboard/tampil_data_jamaah/read/{id}', [TampilDataController::class, 'detailDataJamaah'])->middleware('auth');


// data ibadah
Route::get('/dashboard/tampil_data_ibadah', [TampilDataController::class, 'indexDataIbadah'])->middleware('auth');
// detail ibadah
Route::get('/dashboard/tampil_data_ibadah/read/{id}', [TampilDataController::class, 'detailDataIbadah'])->middleware('auth');

// data keahlian
Route::get('/dashboard/tampil_data_keahlian', [TampilDataController::class, 'indexDataKeahlian'])->middleware('auth');
// detail data keahlian
Route::get('/dashboard/tampil_data_keahlian/read/{id}', [TampilDataController::class, 'detailDataKeahlian'])->middleware('auth');

// data pekerjaan
Route::get('/dashboard/tampil_data_pekerjaan', [TampilDataController::class, 'indexDataPekerjaan'])->middleware('auth');
// detail pekerjaan
Route::get('/dashboard/tampil_data_pekerjaan/read/{id}', [TampilDataController::class, 'detailDataPekerjaan'])->middleware('auth');

// data pendidikan
Route::get('/dashboard/tampil_data_pendidikan', [TampilDataController::class, 'indexDataPendidikan'])->middleware('auth');
// detail data pendidikan
Route::get('/dashboard/tampil_data_pendidikan/read/{id}', [TampilDataController::class, 'detailDataPendidikan'])->middleware('auth');

// data kemampuan
Route::get('/dashboard/tampil_data_kemampuan', [TampilDataController::class, 'indexDataKemampuan'])->middleware('auth');

// detail data kemampuan
Route::get('/dashboard/tampil_data_kemampuan/read/{id}', [TampilDataController::class, 'detailDataKemampuan'])->middleware('auth');

/////////////// END TAMPIL DATA TAKMIR MASJID //////////////////////

// FRONTEND TES
Route::get('/tes', function () {
    return view('tes-induksi');
});