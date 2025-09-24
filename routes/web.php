<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\admin\UbahPasswordController;
use App\Http\Controllers\admin\LaporanController;
use App\Http\Controllers\admin\DiagnosaController as AdminDiagnosaController;
use App\Http\Controllers\pengguna\DiagnosaController as PenggunaDiagnosaController;



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

Auth::routes(['register' => true, 'reset' => false, 'verify' => false]);

foreach (['admin', 'psikologi', 'asisten1', 'asisten2'] as $role) {
    Route::group([
        'prefix' => $role,
        'namespace' => 'admin',
        'as' => $role . '.',
        'middleware' => 'auth'
    ], function () {
        Route::get('/', DashboardController::class)->name('dashboard');
        Route::resource('range', RangeController::class);
        Route::resource('gejala', GejalaController::class)->except('show');
        Route::resource('penyakit', PenyakitController::class);
        Route::resource('bp', BasisPengetahuanController::class);
        Route::resource('diagnosa', DiagnosaController::class)->except(['create', 'store', 'edit', 'update']);
        Route::resource('akun', AkunController::class);
        Route::resource('pesan', PesanController::class)->except(['create', 'store', 'edit', 'update']);
        Route::get('password/edit', [UbahPasswordController::class, 'edit'])->name('pw.edit');
        Route::post('password/edit', [UbahPasswordController::class, 'update'])->name('pw.update');
        Route::post('laporan', [LaporanController::class, 'index'])->name('laporan.create');

        Route::put('diagnosa/analisa', [AdminDiagnosaController::class, 'updateSolusi'])->name('pengguna.diagnosa.updateSolusi');
        Route::get('diagnosa/{id}/print', [AdminDiagnosaController::class, 'print'])->name('diagnosa.print');
        Route::put('diagnosa/{id}/update-status', [AdminDiagnosaController::class, 'updateStatus'])->name('diagnosa.updateStatus');

    
    });
}

Route::group([
    'prefix' => 'client',
    'namespace' => 'admin',
    'as' => 'client.',
    'middleware' => ['auth']
], function () {
    Route::resource('diagnosa', DiagnosaController::class)->except(['create', 'store', 'edit', 'update']);
});


use App\Http\Controllers\pengguna\BiodataController;
use App\Http\Controllers\pengguna\DiagnosaController;
use App\Http\Controllers\pengguna\PenyakitController;

Route::group(['namespace' => 'pengguna', 'as' => 'pengguna.'], function () {
    Route::get('/', DashboardController::class)->name('dashboard');
    Route::get('penyakit', [PenyakitController::class, 'index'])->name('penyakit.index');
    Route::get('penyakit/{penyakit:slug}', [PenyakitController::class, 'show'])->name('penyakit.show');
    Route::resource('pesan', PesanController::class);
    Route::get('biodata', [BiodataController::class, 'index'])->name('biodata.index')->middleware('biodata');
    Route::post('biodata', [BiodataController::class, 'store'])->name('biodata.store');
    Route::get('diagnosa', [DiagnosaController::class, 'index'])->name('diagnosa.index')->middleware('diagnosa');
    Route::get('diagnosa/reset', [DiagnosaController::class, 'reset'])->name('diagnosa.reset')->middleware('diagnosa');
    Route::post('diagnosa/analisa', [DiagnosaController::class, 'analisa'])->name('diagnosa.analisa')->middleware('diagnosa');
    Route::put('diagnosa/analisa', [DiagnosaController::class, 'updateSolusi'])->name('pengguna.diagnosa.updateSolusi');
    Route::get('/diagnosa/{id}', [DiagnosaController::class, 'show'])->name('pengguna.diagnosa.show');




});

Route::put('diagnosa/analisa', [DiagnosaController::class, 'updateSolusi'])->name('pengguna.diagnosa.updateSolusi');
Route::get('/diagnosa/{id}', [DiagnosaController::class, 'show'])->name('pengguna.diagnosa.show');




