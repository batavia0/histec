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
        Route::get('/berita_penyelesaian/generate', 'generate')->name('generate');
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
    Route::get('faq', 'index'); //Routes for Sivitas Akademika FAQ's
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

// Dashboard
Route::get('/dashboard-general-dashboard', function () {
    return view('pages.dashboard-general-dashboard', ['type_menu' => 'dashboard']);
});
Route::get('/dashboard-ecommerce-dashboard', function () {
    return view('pages.dashboard-ecommerce-dashboard', ['type_menu' => 'dashboard']);
});

//Routes for Notifikasi
Route::post('/markNotificationAsRead/{id}', [NotifikasiController::class, 'markAsRead'])
    ->name('markNotificationAsRead');
// End Routes for notifikasi

// Layout
Route::get('/layout-default-layout', function () {
    return view('pages.layout-default-layout', ['type_menu' => 'layout']);
});

// Blank Page
Route::get('/blank-page', function () {
    return view('pages.blank-page', ['type_menu' => '']);
});

// Bootstrap
Route::get('/bootstrap-alert', function () {
    return view('pages.bootstrap-alert', ['type_menu' => 'bootstrap']);
});
Route::get('/bootstrap-badge', function () {
    return view('pages.bootstrap-badge', ['type_menu' => 'bootstrap']);
});
Route::get('/bootstrap-breadcrumb', function () {
    return view('pages.bootstrap-breadcrumb', ['type_menu' => 'bootstrap']);
});
Route::get('/bootstrap-buttons', function () {
    return view('pages.bootstrap-buttons', ['type_menu' => 'bootstrap']);
});
Route::get('/bootstrap-card', function () {
    return view('pages.bootstrap-card', ['type_menu' => 'bootstrap']);
});
Route::get('/bootstrap-carousel', function () {
    return view('pages.bootstrap-carousel', ['type_menu' => 'bootstrap']);
});
Route::get('/bootstrap-collapse', function () {
    return view('pages.bootstrap-collapse', ['type_menu' => 'bootstrap']);
});
Route::get('/bootstrap-dropdown', function () {
    return view('pages.bootstrap-dropdown', ['type_menu' => 'bootstrap']);
});
Route::get('/bootstrap-form', function () {
    return view('pages.bootstrap-form', ['type_menu' => 'bootstrap']);
});
Route::get('/bootstrap-list-group', function () {
    return view('pages.bootstrap-list-group', ['type_menu' => 'bootstrap']);
});
Route::get('/bootstrap-media-object', function () {
    return view('pages.bootstrap-media-object', ['type_menu' => 'bootstrap']);
});
Route::get('/bootstrap-modal', function () {
    return view('pages.bootstrap-modal', ['type_menu' => 'bootstrap']);
});
Route::get('/bootstrap-nav', function () {
    return view('pages.bootstrap-nav', ['type_menu' => 'bootstrap']);
});
Route::get('/bootstrap-navbar', function () {
    return view('pages.bootstrap-navbar', ['type_menu' => 'bootstrap']);
});
Route::get('/bootstrap-pagination', function () {
    return view('pages.bootstrap-pagination', ['type_menu' => 'bootstrap']);
});
Route::get('/bootstrap-popover', function () {
    return view('pages.bootstrap-popover', ['type_menu' => 'bootstrap']);
});
Route::get('/bootstrap-progress', function () {
    return view('pages.bootstrap-progress', ['type_menu' => 'bootstrap']);
});
Route::get('/bootstrap-table', function () {
    return view('pages.bootstrap-table', ['type_menu' => 'bootstrap']);
});
Route::get('/bootstrap-tooltip', function () {
    return view('pages.bootstrap-tooltip', ['type_menu' => 'bootstrap']);
});
Route::get('/bootstrap-typography', function () {
    return view('pages.bootstrap-typography', ['type_menu' => 'bootstrap']);
});


// components
Route::get('/components-article', function () {
    return view('pages.components-article', ['type_menu' => 'components']);
});
Route::get('/components-avatar', function () {
    return view('pages.components-avatar', ['type_menu' => 'components']);
});
Route::get('/components-chat-box', function () {
    return view('pages.components-chat-box', ['type_menu' => 'components']);
});
Route::get('/components-empty-state', function () {
    return view('pages.components-empty-state', ['type_menu' => 'components']);
});
Route::get('/components-gallery', function () {
    return view('pages.components-gallery', ['type_menu' => 'components']);
});
Route::get('/components-hero', function () {
    return view('pages.components-hero', ['type_menu' => 'components']);
});
Route::get('/components-multiple-upload', function () {
    return view('pages.components-multiple-upload', ['type_menu' => 'components']);
});
Route::get('/components-pricing', function () {
    return view('pages.components-pricing', ['type_menu' => 'components']);
});
Route::get('/components-statistic', function () {
    return view('pages.components-statistic', ['type_menu' => 'components']);
});
Route::get('/components-tab', function () {
    return view('pages.components-tab', ['type_menu' => 'components']);
});
Route::get('/components-table', function () {
    return view('pages.components-table', ['type_menu' => 'components']);
});
Route::get('/components-user', function () {
    return view('pages.components-user', ['type_menu' => 'components']);
});
Route::get('/components-wizard', function () {
    return view('pages.components-wizard', ['type_menu' => 'components']);
});

// forms
Route::get('/forms-advanced-form', function () {
    return view('pages.forms-advanced-form', ['type_menu' => 'forms']);
});
Route::get('/forms-editor', function () {
    return view('pages.forms-editor', ['type_menu' => 'forms']);
});
Route::get('/forms-validation', function () {
    return view('pages.forms-validation', ['type_menu' => 'forms']);
});

// google maps
// belum tersedia

// modules
Route::get('/modules-calendar', function () {
    return view('pages.modules-calendar', ['type_menu' => 'modules']);
});
Route::get('/modules-chartjs', function () {
    return view('pages.modules-chartjs', ['type_menu' => 'modules']);
});
Route::get('/modules-datatables', function () {
    return view('pages.modules-datatables', ['type_menu' => 'modules']);
});
Route::get('/modules-flag', function () {
    return view('pages.modules-flag', ['type_menu' => 'modules']);
});
Route::get('/modules-font-awesome', function () {
    return view('pages.modules-font-awesome', ['type_menu' => 'modules']);
});
Route::get('/modules-ion-icons', function () {
    return view('pages.modules-ion-icons', ['type_menu' => 'modules']);
});
Route::get('/modules-owl-carousel', function () {
    return view('pages.modules-owl-carousel', ['type_menu' => 'modules']);
});
Route::get('/modules-sparkline', function () {
    return view('pages.modules-sparkline', ['type_menu' => 'modules']);
});
Route::get('/modules-sweet-alert', function () {
    return view('pages.modules-sweet-alert', ['type_menu' => 'modules']);
});
Route::get('/modules-toastr', function () {
    return view('pages.modules-toastr', ['type_menu' => 'modules']);
});
Route::get('/modules-vector-map', function () {
    return view('pages.modules-vector-map', ['type_menu' => 'modules']);
});
Route::get('/modules-weather-icon', function () {
    return view('pages.modules-weather-icon', ['type_menu' => 'modules']);
});

// auth
Route::get('/auth-forgot-password', function () {
    return view('pages.auth-forgot-password', ['type_menu' => 'auth']);
});
Route::get('/auth-login', function () {
    return view('pages.auth-login', ['type_menu' => 'auth']);
});
Route::get('/auth-login2', function () {
    return view('pages.auth-login2', ['type_menu' => 'auth']);
});
Route::get('/auth-register', function () {
    return view('pages.auth-register', ['type_menu' => 'auth']);
});
Route::get('/auth-reset-password', function () {
    return view('pages.auth-reset-password', ['type_menu' => 'auth']);
});

// error
Route::get('/error-403', function () {
    return view('pages.error-403', ['type_menu' => 'error']);
});
Route::get('/error-404', function () {
    return view('pages.error-404', ['type_menu' => 'error']);
});
Route::get('/error-500', function () {
    return view('pages.error-500', ['type_menu' => 'error']);
});
Route::get('/error-503', function () {
    return view('pages.error-503', ['type_menu' => 'error']);
});

// features
Route::get('/features-activities', function () {
    return view('pages.features-activities', ['type_menu' => 'features']);
});
Route::get('/features-post-create', function () {
    return view('pages.features-post-create', ['type_menu' => 'features']);
});
Route::get('/features-post', function () {
    return view('pages.features-post', ['type_menu' => 'features']);
});
Route::get('/features-profile', function () {
    return view('pages.features-profile', ['type_menu' => 'features']);
});
Route::get('/features-settings', function () {
    return view('pages.features-settings', ['type_menu' => 'features']);
});
Route::get('/features-setting-detail', function () {
    return view('pages.features-setting-detail', ['type_menu' => 'features']);
});
Route::get('/features-tickets', function () {
    return view('pages.features-tickets', ['type_menu' => 'features']);
});

// utilities
Route::get('/utilities-contact', function () {
    return view('pages.utilities-contact', ['type_menu' => 'utilities']);
});
Route::get('/utilities-invoice', function () {
    return view('pages.utilities-invoice', ['type_menu' => 'utilities']);
});
Route::get('/utilities-subscribe', function () {
    return view('pages.utilities-subscribe', ['type_menu' => 'utilities']);
});

// credits
Route::get('/credits', function () {
    return view('pages.credits', ['type_menu' => '']);
});
