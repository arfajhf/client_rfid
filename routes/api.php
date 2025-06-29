<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Invalid\InvalideController;
use App\Http\Controllers\Laporan\LaporanController;
use App\Http\Controllers\presensi\PresensiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RfidController;
use App\Http\Controllers\Sdm\SdmController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

// dashboard
Route::get('/', [DashboardController::class, 'index']);

// absen ke alat
Route::post('/absen/{uid}', [RfidController::class, 'capture']);

// invalide
Route::controller(InvalideController::class)->group(function () {
    Route::get('/invalide', 'index');
    Route::get('/invalide/{id}', 'create');
    Route::post('/invalide/store', 'store');
    Route::post('/invalide/delete/{id}', 'delete');
});

// laporan
Route::controller(LaporanController::class)->group(function () {
    Route::get('/laporan', 'index');
    Route::post('/laporan/views', 'views');
    Route::post('/laporan/csv-download', 'CsvDownload');
});

// presensi
Route::controller(PresensiController::class)->group(function () {
    Route::get('/presensi', 'index');
});

// sdm
Route::controller(SdmController::class)->group(function () {
    Route::get('/sdm', 'index');
    Route::get('/sdm/{id}/edit', 'edit');
    Route::get('/sdm/show/{id}', 'view');
    Route::post('/sdm/{id}/update', 'update');
    Route::post('/sdm/delete/{id}', 'delete');
});

