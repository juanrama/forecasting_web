<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AkademikController;
use App\Http\Controllers\ChartController;

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

Route::get('/', function () {
    return view('dashboard.layouts.main');
});

Route::resource('/mhsregresi', AkademikController::class)->names('mhs_regresi');

Route::get('/mhsregresi', [AkademikController::class, 'cari'])->name('mhs_regresi_cari');
;


Route::get('/prdregresi', function () {
    return view('dashboard.predict.prodi');
});

Route::get('/fkregresi', function () {
    return view('dashboard.predict.fakultas');
});
