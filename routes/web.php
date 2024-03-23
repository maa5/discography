<?php

use App\Http\Controllers\ArtistController;
use App\Http\Controllers\DatatableController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LPController;
use App\Http\Controllers\ReportController;
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

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/report', [ReportController::class, 'index'])->name('report.index');

Route::resource('artists', ArtistController::class);
Route::get('artists/{slug}/lps', [ArtistController::class, 'lps'])->name('artists.lps');

Route::resource('lps', LPController::class);

Route::get('datatable/lps', [DatatableController::class, 'lp'])->name('datatable.lp');
Route::get('datatable/artists', [DatatableController::class, 'artist'])->name('datatable.artist');
