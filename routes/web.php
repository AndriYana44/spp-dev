<?php

use App\Http\Controllers\Mst\JurusanController;
use App\Http\Controllers\Mst\SiswaController;
use App\Http\Controllers\Trs\TransaksiSppController;
use App\Models\Trs\TransaksiSpp;
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

    Route::get('/dashboard', function () {
        return view('dashborad');
    });

    Route::prefix('siswa')->group(function() {
        Route::get('/', [SiswaController::class, 'index']);
        Route::post('/upload', [SiswaController::class, 'importCsv']);
        Route::get('/tambah-data', [SiswaController::class, 'create']);
        Route::get('/data-siswa', [SiswaController::class, 'dataSiswa']);
        Route::post('/store', [SiswaController::class, 'store']);
        Route::get('/edit/{id}', [SiswaController::class, 'edit']);
        Route::get('/delete/{id}', [SiswaController::class, 'destroy']);
        Route::patch('/update/{id}', [SiswaController::class, 'update']);
    });

    Route::prefix('jurusan')->group(function() {
        Route::get('/', [JurusanController::class, 'index']);
        Route::post('/add', [JurusanController::class, 'store']);
        Route::patch('/update/{id}', [JurusanController::class, 'update']);
        Route::get('/delete/{id}', [JurusanController::class, 'destroy']);
    });

    Route::prefix('transaksi')->group(function() {
        Route::get('/', [TransaksiSppController::class, 'index']);
        Route::get('/add', [TransaksiSppController::class, 'create']);
        Route::post('/store', [TransaksiSppController::class, 'store']);
        Route::post('/update/{id}', [TransaksiSppController::class, 'update']);
        Route::get('/edit/{id}', [TransaksiSppController::class, 'edit']);
        Route::get('/add/{id}', [TransaksiSppController::class, 'create']);

        // set herga spp
        Route::post('/set-harga-spp/set', [TransaksiSppController::class, 'setSppHarga']);

        // get data siswa (json)
        Route::get('/get-siswa/{id}', [TransaksiSppController::class, 'getSiswa']);
        Route::get('/set-harga-spp', [TransaksiSppController::class, 'createSppHarga']);

        // get harga spp
        Route::get('/get-harga-spp', [TransaksiSppController::class, 'getHargaSpp']);

        //get transaksi
        Route::get('/get-transaksi/{id}', [TransaksiSppController::class, 'getTransaksi']);

        // lihat tagihan persiswa
        Route::get('/tagihan/{id}', [TransaksiSppController::class, 'tagihan']);
        Route::get('/getTagihan/{id}/{tahun}/{bulan}', [TransaksiSppController::class, 'getTagihan']);
    });

    Route::post('file-import', [UserController::class, 'fileImport'])->name('file-import');
});

Route::get('/logout', [AuthenticatedSessionController::class, 'destroy']);
