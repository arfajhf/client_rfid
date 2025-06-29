<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RfidController;
use App\Http\Controllers\Sdm\SdmController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Invalid\InvalideController;
use App\Http\Controllers\Laporan\LaporanController;
use App\Http\Controllers\presensi\LivePresensiController;
use App\Http\Controllers\presensi\PresensiController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('admin.data_invalid.index');
// });

// Route::group([
//     'prefix'=>config('admin.prefix'),
//     'namespace'=>'App\\Http\\Controllers',
// ],function () {


Route::controller(DashboardController::class)->group(function () {
    Route::get('/', 'index')->name('dashboard');
});
// Route::view('/', 'dashboard')->name('dashboard');
Route::controller(InvalideController::class)->group(function () {
    Route::get('/invalid', 'index')->name('invalid');
    Route::get('/invalid/create/{id}', 'create')->name('invalid.create');
    Route::post('/invalid/create', 'store');
    Route::get('/invalid/delete/{id}', 'delete');
});
Route::controller(SdmController::class)->group(function () {
    Route::get('/sdm', 'index')->name('sdm');
    Route::get('/sdm/delete/{id}', 'delete');
    Route::get('/sdm/update/{id}', 'edit');
    Route::post('/sdm/update/{id}', 'update');
    Route::get('/sdm/view/{id}', 'view');
});
Route::controller(PresensiController::class)->group(function () {
    Route::get('/presensi', 'index')->name('data.presensi');
});

Route::controller(LivePresensiController::class)->group(function () {
    Route::get('/presensilive', 'index')->name('live.presensi');
});

Route::controller(LaporanController::class)->group(function(){
    Route::get('/laporan', 'index')->name('data.laporan');
    Route::post('/laporan/view', 'views')->name('view.laporan');
    Route::post('/laporan/download', 'CsvDownload')->name('download.laporan');
});


Route::get('login', [AuthController::class, 'formLogin'])->name('admin.login');
Route::post('login', [AuthController::class, 'login']);

Route::middleware(['auth:admin'])->group(function () {
    Route::post('logout', [AuthController::class, 'logout'])->name('admin.logout');
    // Route::controller(DashboardController::class)->group(function(){
    //     Route::get('/', 'index')->name('dashboard');
    // });
    // // Route::view('/', 'dashboard')->name('dashboard');
    // Route::controller(InvalideController::class)->group(function(){
    //     Route::get('/invalid', 'index')->name('invalid');
    //     Route::get('/invalid/create/{id}', 'create')->name('invalid.create');
    //     Route::post('/invalid/create', 'store');
    //     Route::get('/invalid/delete/{id}', 'delete');
    // });
    // Route::controller(SdmController::class)->group(function(){
    //     Route::get('/sdm', 'index')->name('sdm');
    //     Route::get('/sdm/delete/{id}', 'delete');
    //     Route::get('/sdm/update/{id}', 'edit');
    //     Route::post('/sdm/update/{id}', 'update');
    //     Route::get('/sdm/view/{id}', 'view');
    // });
    // Route::controller(PresensiController::class)->group(function(){
    //     Route::get('/presensi', 'index')->name('data.presensi');
    // });

    // Route::controller(LivePresensiController::class)->group(function(){
    //     Route::get('/presensilive', 'index')->name('live.presensi');
    // });

    // Route::view('/super', 'super_admin.index')->name('post')->middleware('can:role,"superadmin"');
    // Route::view('/admin', 'admin.index')->name('admin')->middleware('can:role,"admin"');
});
// });
