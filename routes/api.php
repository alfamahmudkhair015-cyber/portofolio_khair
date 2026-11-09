<?php

use App\Http\Controllers\Api\ContactMessageController;
use App\Http\Controllers\Api\ProjectController;
use Illuminate\Support\Facades\Route;

// Semua URL diawali /api (mis. GET /api/projects)
Route::get('/projects', [ProjectController::class, 'index'])->name('api.projects.index');
Route::get('/projects/{project}', [ProjectController::class, 'show'])->name('api.projects.show');

// Dibatasi 10 permintaan per menit per IP agar tidak mudah di-spam
Route::post('/contact-messages', [ContactMessageController::class, 'store'])
    ->middleware('throttle:10,1')
    ->name('api.contact-messages.store');
