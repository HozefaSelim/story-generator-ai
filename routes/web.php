<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\StoryController;
use App\Http\Controllers\FileUploadController;

// Public routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [HomeController::class, 'about'])->name('about');
Route::get('/features', [HomeController::class, 'features'])->name('features');
Route::get('/how-it-works', [HomeController::class, 'howItWorks'])->name('how-it-works');

// Authentication routes (Laravel Breeze/Jetstream will add these)
// Route::middleware(['auth'])->group(function () { ... });

// Story routes (protected by auth middleware in controller)
Route::resource('stories', StoryController::class);
Route::post('/stories/{story}/generate', [StoryController::class, 'generate'])->name('stories.generate');
Route::get('/stories/{story}/download-pdf', [StoryController::class, 'downloadPdf'])->name('stories.download-pdf');
Route::get('/stories/{story}/download-video', [StoryController::class, 'downloadVideo'])->name('stories.download-video');

// File upload routes
Route::get('/uploads', [FileUploadController::class, 'index'])->name('uploads.index');
Route::get('/uploads/create', [FileUploadController::class, 'create'])->name('uploads.create');
Route::post('/uploads/photo', [FileUploadController::class, 'uploadPhoto'])->name('uploads.photo');
Route::delete('/uploads/{upload}', [FileUploadController::class, 'destroy'])->name('uploads.destroy');

// Dashboard route
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
