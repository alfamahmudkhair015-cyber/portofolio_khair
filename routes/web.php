<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;

// Portofolio baru
Route::view('/', 'portofolio.home')->name('portfolio');

// Versi lama (opsional, boleh dihapus kalau tidak dipakai)
Route::get('/classic', [PageController::class, 'home'])->name('home');
Route::get('/about', [PageController::class, 'about'])->name('about');
Route::get('/projects', [PageController::class, 'projects'])->name('projects');
Route::get('/projects/{project}', [PageController::class, 'show'])->name('projects.show');
Route::get('/contact', [PageController::class, 'contact'])->name('contact');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');