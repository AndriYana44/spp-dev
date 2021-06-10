<?php

use App\Http\Controllers\SiswaController;
use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Http\Controllers\AuthenticatedSessionController;

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

Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('/', function () {
        return view('dashborad');
    });

    Route::prefix('siswa')->group(function() {
        Route::get('/', [SiswaController::class, 'index']);
        Route::post('/upload', [SiswaController::class, 'importCsv']);
        Route::get('/data-siswa', [SiswaController::class, 'dataSiswa']);
    });

    Route::post('file-import', [UserController::class, 'fileImport'])->name('file-import');
});

Route::get('/logout', [AuthenticatedSessionController::class, 'destroy']);
