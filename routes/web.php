<?php
use App\Http\Controllers\HomeController;

use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home.index');
Route::get('/{param}', [HomeController::class, 'redirect'])->name('home.redirect');
Route::post('/encurtar', [HomeController::class, 'encurtar'])->name('home.encurtar');