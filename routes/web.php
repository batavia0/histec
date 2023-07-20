<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FAQController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WordController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\NotifikasiController;
use App\Http\Controllers\SivitasAkademikaController;
use App\Http\Controllers\BeritaPenyelesaianController;

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

Route::get('/', function () {
    return redirect()->route('tickets.index');
});



Route::get('dashboard', function () {
    return view('dashboard');
})->middleware('auth');
Auth::routes();
Route::get('/logout', function () {
    Auth::logout();

    // Redirect to the desired page
    return redirect()->route('tickets.index');
})->name('logout');
//Routes for Sivitas Akademika
Route::resource('tickets', SivitasAkademikaController::class);
Route::controller(SivitasAkademikaController::class)->group(function () {
     Route::get('/cek_status_tiket/find_tickets', 'findTicketsByTicketNumber');
    Route::get('/cek_status_tiket', 'indexCekStatusTiket')->name('indexCekStatusTiket');
    Route::post('/tickets/store', 'store')->name('tickets.store');
    Route::get('/tickets/{id}', 'showFaqById')->name('showFaqById');
});
//Routes for Tiket
Route::middleware('auth')->group(function () {
    Route::controller(TicketController::class)->group(function () {
        Route::get('tiket/semua_tiket', 'indexSemuaTiket')->name('indexSemuaTiket');
        Route::get('tiket/tiket_ditugaskan', 'indexTiketDitugaskan')->name('indexTiketDitugaskan');
        Route::get('tiket/mutasi_tiket', 'indexMutasiTiket')->name('indexMutasiTiket');
        Route::get('tiket/tiket_selesai', 'indexTiketSelesai')->name('indexTiketSelesai');
        //Routes for Status Tiket
        Route::get('tiket/status_tiket', 'indexStatusTiket')->name('indexStatusTiket');
        Route::get('tiket/read_status_tiket/{id}', 'showStatusTiket')->name('showStatusTiket');
        //END Routes for Status Tiket
        Route::get('tiket/edit_tiket/{id}', 'edit')->name('editTiket');
        Route::get('tiket/proses_tiket/{id}', 'editTiketDitugaskan')->name('editTiketDitugaskan');
        Route::get('tiket/mutasi_proses_tiket/{id}', 'mutasiProsesTiket')->name('editTiketDitugaskan');
        Route::get('tiket/tiket_mutasi/{id}', 'editTiketMutasi')->name('editTiketMutasi');
        Route::post('tiket/update_tiket/{id}', 'updates')->name('updateTiket');
        // Routes For Tiket Ditugaskan
        Route::post('tiket/update_tiket_ditugaskan/{id}', 'updateTiketDitugaskan')->name('updateTiketDitugaskan');
        Route::post('tiket/mutasi_proses_tiket/{id}', 'updateMutasiProsesTiket')->name('updateMutasiProsesTiket');
        Route::post('tiket/update_mutasi_proses_tiket/{id}', 'updateMutasiProsesTiket')->name('updateMutasiProsesTiket');
        Route::get('tiket/read_tiket/{id}', 'show')->name('readTiket');
        Route::get('tiket/read_tiket_ditugaskan/{id}', 'showTiketDitugaskan')->name('readTiketDitugaskan');
        Route::get('tiket/read_tiket_selesai/{id}', 'showTiketSelesai')->name('readTiketSelesai');
        Route::post('tiket/delete_tiket/{id}', 'destroy')->name('deleteTiket');
    });
    
});

//Routes for Balasan Tiket
//Routes for Laporan
Route::middleware(['auth','kepalaupttikrole'])->group(function () {
    Route::controller(LaporanController::class)->group(function () {
        Route::get('/laporan/index', 'index')->name('indexLaporan');
    });
});
//END Routes for Laporan

//Routes for User
Route::get('user/tambah', [UserController::class,'indexTambahUser'])->name('indexTambahUser');
Route::middleware('auth')->group(function () {
    Route::resource('user', UserController::class);
    Route::post('user/store', [UserController::class,'store'])->name('user.store');
    Route::get('user/tambah', [UserController::class,'indexTambahUser'])->name('user.tambah');
    Route::post('user/destroy/{id}', [UserController::class,'destroy'])->name('user.destroy');
    // Route::controller(UserController::class)->group(function () {
    //     // Route::get('user/tambah', 'indexTambahUser')->name('indexTambahUser');
    //     // Route::post('user/name/{id}', 'name')->name('name');
    //     // Route::post('user/name/{id}', 'name')->name('name');
    //     // Route::get('user/name/{id}', 'name')->name('name');
    // });
});
//END Routes for Laporan

//Routes for Berita Penyelesaian
Route::resource('berita_penyelesaian', BeritaPenyelesaianController::class);
Route::middleware('auth')->group(function () {
    Route::controller(BeritaPenyelesaianController::class)->group(function () {
        Route::post('/berita_penyelesaian/generate', 'generate')->name('generate');
    });
});
//END Routes for Berita Penyelesaian
// Routes for WordController
Route::middleware('auth')->group(function () {
    Route::post('berita_penyelesaian/generate', [WordController::class,'generate'])->name('word.generate');
    Route::get('indexword', function () {
        return view('berita_penyelesaian.word');
    });    
});
// END Routes for WordController

// Routes for FAQController
Route::controller(FAQController::class)->group(function () {
    Route::get('faq', 'index')->name('faq_admin_page_index'); //Routes for Sivitas Akademika FAQ's
    Route::get('faq/{id}', 'showFaqById'); //Routes for show
});
Route::middleware('auth')->group(function () {
    Route::resource('faq_admin_page', FAQController::class);
    Route::controller(FAQController::class)->group(function () {
        // FAQ pada halaman dashboard admin
        Route::get('faq_admin_page', 'indexFaqAdmin')->name('indexFaqAdmin');
        Route::post('faq_admin_page/{id}', 'destroy')->name('destroy_faq');
    });
});
// END Routes for FAQController


Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');
