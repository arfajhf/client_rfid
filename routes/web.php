<?php

use App\Http\Controllers\Auth\AuthController;
use Illuminate\Support\Facades\Route;

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

Route::get('login', [AuthController::class, 'formLogin'] )->name('admin.login');
Route::post('login', [AuthController::class, 'login']);

Route::middleware(['auth:admin'])->group(function () {
    Route::post('logout', [AuthController::class, 'logout'])->name('admin.logout');
    Route::view('/', 'dashboard')->name('dashboard');
    Route::view('/super', 'super_admin.index')->name('post')->middleware('can:role,"superadmin"');
    Route::view('/admin', 'admin.index')->name('admin')->middleware('can:role,"admin"');
});
// });