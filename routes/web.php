<?php
use App\Http\Controllers\HomeController;

use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home.index');
Route::get('/contador', [HomeController::class, 'clickCounter'])->name('counter.index');

Route::get('/{param}', [HomeController::class, 'redirect'])->name('home.redirect');
Route::post('/shorten', [HomeController::class, 'shorten'])->name('home.shorten');