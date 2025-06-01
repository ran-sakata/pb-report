<?php

use App\Http\Controllers\ConfirmationController;
use App\Http\Controllers\DownloadController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\Steps\FirstController;
use App\Http\Controllers\Steps\RemarkController;
use App\Http\Controllers\Inspection\FirstController as InspectionFirstController;
use App\Http\Controllers\Inspection\SecondController as InspectionSecondController;
use App\Http\Controllers\Inspection\ThirdController as InspectionThirdController;
use App\Http\Controllers\Inspection\ForthController as InspectionForthController;
use Livewire\Livewire;

Livewire::setUpdateRoute(function ($handle) {
    return Route::post('/livewire/update', $handle);
});
Livewire::setScriptRoute(function ($handle) {
    return Route::get('/livewire/livewire.js', $handle);
});
Route::controller(WelcomeController::class)->group(function () {
    Route::get('/', 'index')->name('welcome');
});

Route::controller(HistoryController::class)->group(function () {
    Route::get('/history', 'index')->name('history');
});

Route::controller(FirstController::class)->group(function () {
    Route::get('/new', 'create')->name('report.create');
    Route::post('/new', 'store')->name('report.store');
    Route::get('/edit/{report}', 'edit')->name('report.edit');
    Route::post('/edit/{report}', 'update')->name('report.update');
});

Route::group(['prefix' => '/edit/{report}/inspection'], function () {
    Route::get('/first', InspectionFirstController::class)->name('inspection.first');
    Route::get('/second', InspectionSecondController::class)->name('inspection.second');
    Route::get('/third', InspectionThirdController::class)->name('inspection.third');
    Route::get('/forth', InspectionForthController::class)->name('inspection.forth');
});

Route::get('/edit/{report}/remark', RemarkController::class)->name('remark');
Route::get('/edit/{report}/confirmation', ConfirmationController::class)->name('confirmation');
Route::get('/edit/{report}/download', DownloadController::class)->name('export');
