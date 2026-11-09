<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Landing page portofolio (data diambil dari config/portfolio.php)
Route::view('/', 'portofolio.home')->name('portfolio');

// Form kontak: untuk sementara hanya validasi, BELUM disimpan ke database.
// Penyimpanan ke DB ditambahkan di branch feature/backend-laravel-db.
Route::post('/contact', function (Request $request) {
    $request->validate([
        'name' => 'required|string|max:100',
        'email' => 'required|email|max:150',
        'message' => 'required|string|max:2000',
    ]);

    return redirect(url('/') . '#contact')->with('success', 'Terima kasih! Pesanmu sudah terkirim.');
})->name('contact.store');
