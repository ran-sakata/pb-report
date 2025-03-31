<?php

use App\Http\Controllers\ConfirmationController;
use App\Http\Controllers\DownloadController;
use App\Http\Controllers\FileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\Steps\FirstController;
use App\Http\Controllers\Steps\ForthController;
use App\Http\Controllers\Steps\SecondController;
use App\Http\Controllers\Steps\ThirdController;

Route::controller(WelcomeController::class)->group(function () {
    Route::get('/', 'index');
});

Route::controller(HistoryController::class)->group(function () {
    Route::get('/history', 'index')->name('history');
});

Route::controller(FirstController::class)->group(function () {
    Route::get('/new', 'create')->name('create');
    Route::post('/new', 'store');
    Route::get('/{report}', 'edit')->name('edit');
    Route::post('/{report}', 'update');
});

Route::controller(SecondController::class)->group(function () {
    Route::get('/{report}/second-page', 'index')->name('second-page');
    Route::post('/{report}/second-page', 'update');
});

Route::controller(ThirdController::class)->group(function () {
    Route::get('/{report}/third-page', 'index')->name('third-page');
    Route::post('/{report}/third-page', 'update');
});

Route::controller(ForthController::class)->group(function () {
    Route::get('/{report}/forth-page', 'index')->name('forth-page');
    Route::post('/{report}/forth-page', 'update');
});

Route::get('/{report}/confirmation', ConfirmationController::class)->name('confirmation');
Route::get('/{report}/download', DownloadController::class)->name('export');
