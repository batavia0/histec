<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FAQController;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WordController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\NotifikasiController;
use App\Http\Controllers\KepalaUPTTIKController;
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
    return view('sivitas_akademika.landing_hero');
});


Route::get('dashboard', function () {
    return view('dashboard');
})->middleware('auth');
Auth::routes(['register' => false]);
Route::get('/logout', function () {
    Auth::logout();
    // Redirect to the desired page
    return redirect()->route('tickets.index');
})->name('logout');
Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');
//Routes for Sivitas Akademika
Route::resource('tickets', SivitasAkademikaController::class);
Route::controller(SivitasAkademikaController::class)->group(function () {
     Route::get('/cek_status_tiket/find_tickets', 'findTicketsByTicketNumber');
    Route::get('/cek_status_tiket', 'indexCekStatusTiket')->name('indexCekStatusTiket');
    Route::post('/tickets/store', 'store')->name('tickets.store');
    Route::get('/tickets/{id}', 'showFaqById')->name('showFaqById');
});
Route::get('balasan_tiket2', function () {
    return view('sivitas_akademika.emails.ticket_request');
});
//Routes for Tiket
Route::middleware(['auth', 'technicianrole:1,2,3'])->group(function () {
    Route::get('tiket/mutasi_tiket_edit/{id}',[TicketController::class,'mutasiTiketInIndexMutasiTiket'])->name('mutasi_tiket_mutasi_edit');
    Route::post('tiket/mutasi_tiket_update/{id}',[TicketController::class,'updateMutasiTiket'])->name('mutasi_tiket_mutasi_update');
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
//END Routes for Tiket

//Routes for Balasan Tiket
Route::middleware(['auth', 'technicianrole:1,2,3'])->group(function () {
    Route::get('balasan_tiket', [TicketController::class, 'indexBalasanTiket'])->name('indexBalasanTiket');
    Route::get('balasan_tiket/{id}', [TicketController::class, 'showBalasanTiket'])->name('BalasanTiket');
    Route::post('balasan_tiket/send_mail/{email}', [TicketController::class, 'mailBalasanTiket'])->name('mailBalasanTiket');
});
//END Routes for Balasan Tiket

//Routes for User
Route::get('user/tambah', [UserController::class,'indexTambahUser'])->name('indexTambahUser');
Route::middleware('auth','kepalaupttikrole')->group(function () {
    Route::resource('user', UserController::class);
    Route::post('user/store', [UserController::class,'store'])->name('user.store');
    Route::get('user/tambah', [UserController::class,'indexTambahUser'])->name('user.tambah');
    Route::post('user/destroy/{id}', [UserController::class,'destroy'])->name('user.destroy');
    Route::get('user/edit/{id?}', [UserController::class,'edit'])->name('user.edit');
    Route::get('user/{id}', [UserController::class,'show'])->name('user.show');
    Route::post('user/update/{id}', [UserController::class,'updates'])->name('user.update');
});
//END Routes for User

//Routes for Berita Penyelesaian
Route::middleware('auth','technicianrole:1,2,3')->group(function () {
    Route::resource('berita_penyelesaian', BeritaPenyelesaianController::class);
    Route::controller(BeritaPenyelesaianController::class)->group(function () {
        Route::post('/berita_penyelesaian/generate', 'generate')->name('generate');
    });
});
//END Routes for Berita Penyelesaian
// Routes for WordController
Route::middleware('auth','technicianrole:1,2,3')->group(function () {
    Route::post('berita_penyelesaian/generate', [WordController::class,'generate'])->name('word.generate');
    Route::get('indexword', function () {
        return view('berita_penyelesaian.word');
    });    
});
// END Routes for WordController
//Routes for Category Controller
Route::middleware('auth','technicianrole:1,2,3')->group(function () {
    Route::get('kategori', [CategoryController::class,'index'])->name('index.kategori');
    Route::get('kategori/{id}', [CategoryController::class,'show'])->name('show.kategori');

});

// END Routes for CategoryController

// Routes for FAQController
Route::controller(FAQController::class)->group(function () {
    Route::get('faq', 'index')->name('faq_admin_page_index'); //Routes for Sivitas Akademika FAQ's
    Route::get('faq/{id}', 'showFaqById'); //Routes for show
});
Route::get('faq', [FAQController::class,'index'])->name('faq_admin_page_index'); //Routes for Sivitas Akademika
// END Routes for FAQController
// Routes for FAQController
Route::middleware('auth','technicianrole:1,2,3')->group(function () {
    Route::resource('faq_admin_page', FAQController::class);
    Route::controller(FAQController::class)->group(function () {
        // FAQ pada halaman dashboard admin
        Route::get('faq_admin_page', 'indexFaqAdmin')->name('indexFaqAdmin');
        Route::get('faq_admin_page/edit/{id}', 'edit')->name('editFaqAdmin');
    });
    Route::post('faq_admin_page/destroy/{id}', [FAQController::class,'destroy']);
    Route::post('faq_admin_page/update/{id}', [FAQController::class,'update'])->name('updateFaqAdmin');
    Route::post('faq_admin_page/store', [FAQController::class,'stores'])->name('storeFaqAdmin');
    Route::get('faq_admin_page/show/{id}', [FAQController::class,'show'])->name('showFaqAdmin');
});
Route::get('/inspire', function () {
    $output = Artisan::call('inspire');
    return $output == 0 ? 'command berhasil dijalankan' : 'command tidak ditemukan';
});
// END Routes for FAQController
// Routes for LocationController
Route::middleware('auth','technicianrole:1,2,3')->group(function () {
    Route::resource('lokasi', LocationController::class);
    Route::get('lokasi/{id}', [LocationController::class,'show'])->name('lokasi.show');
    Route::get('lokasi/edit/{id}', [LocationController::class,'edit'])->name('lokasi.edit');
    Route::get('lokasi/create', [LocationController::class,'create'])->name('lokasi.create');
    Route::post('lokasi/{id}', [LocationController::class,'update'])->name('lokasi.update');
    Route::post('lokasi/delete/{locations}', [LocationController::class,'destroy'])->name('lokasi.destroy');
});
// END Routes for LocationController

// Routes for KepalaUPTTIKController
Route::middleware(['auth','kepalaupttikrole'])->group(function () {
    Route::get('laporan', [KepalaUPTTIKController::class, 'index'])->name('indexLaporan');
    Route::post('laporan/filter', [KepalaUPTTIKController::class, 'filterLaporan'])->name('laporan.filter');
    Route::post('laporan/filter_tiket_selesai', [KepalaUPTTIKController::class, 'filterLaporanTiketSelesai'])->name('laporan.filter_tiket_selesai');
});
// END Routes for KepalaUPTTIKController

