<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PlacardController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::post('/download-count', [PlacardController::class, 'storeDownload'])->middleware('throttle:20,1')->name('download-count');
Route::get('/country-ranking', [PlacardController::class, 'ranking'])->name('country-ranking');

Route::get('/admin/login', [AdminController::class, 'login'])->name('admin.login');
Route::post('/admin/login', [AdminController::class, 'authenticate'])->name('admin.authenticate');

Route::middleware('admin.session')->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::post('/logout', [AdminController::class, 'logout'])->name('logout');
    Route::get('/countries', [AdminController::class, 'countries'])->name('countries');
    Route::post('/countries', [AdminController::class, 'storeCountry'])->name('countries.store');
    Route::get('/years', [AdminController::class, 'years'])->name('years');
    Route::post('/years', [AdminController::class, 'storeYear'])->name('years.store');
    Route::get('/settings', [AdminController::class, 'settings'])->name('settings');
    Route::post('/settings', [AdminController::class, 'storeSettings'])->name('settings.store');
    Route::get('/placard-records', [AdminController::class, 'records'])->name('records');
});
