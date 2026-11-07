<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProjectGalleryController;
use App\Http\Controllers\SkillController;
use Illuminate\Support\Facades\Route;
use App\Models\Project;
use App\Http\Controllers\ProfileSayaController;

Route::get('/', [DashboardController::class, 'index'])->name('home');

Route::get('/home', [DashboardController::class, 'index']);

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/education', function () {
    return view('education');
})->name('education');

Route::get('/dashboard', function () {
    return redirect()->route('home');
})->middleware(['auth', 'verified'])->name('dashboard');

// 1. Route Publik / User Biasa
Route::get('/projects', [ProjectController::class, 'index'])->name('projects.index');
Route::get('/projects/{project}', [ProjectController::class, 'show'])->name('projects.show');

// 2. Route khusus Admin (Trash, Restore, & Force Delete)
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/post/projects/trash', [ProjectController::class, 'trash'])->name('projects.trash');
    Route::post('/post/projects/{id}/restore', [ProjectController::class, 'restore'])->name('post.projects.restore');
    Route::delete('/post/projects/{id}/force-delete', [ProjectController::class, 'forceDelete'])->name('post.projects.force-delete');
});

// 3. Route Grup /post khusus Management Admin
Route::prefix('post')->name('post.')->middleware('auth')->group(function () {
    Route::resource('dashboard', DashboardController::class);
    Route::resource('projects', ProjectController::class);

    // Route Galeri Foto
    Route::post('/projects/{project}/gallery', [ProjectGalleryController::class, 'store'])->name('projects.gallery.store');
    Route::delete('/projects/{project}/gallery/{image}', [ProjectGalleryController::class, 'destroy'])->name('projects.gallery.destroy');
    Route::put('/projects/{project}/gallery/{image}', [ProjectGalleryController::class, 'updateCaption'])->name('projects.gallery.updateCaption');
    Route::put('/projects/{project}/gallery/{image}/replace', [ProjectGalleryController::class, 'updateImage'])->name('projects.gallery.updateImage');

    Route::resource('skills', SkillController::class)->except(['show']);
});

// 4. Route khusus User Login (Profile)
Route::middleware('auth')->group(function () {
    Route::get('/post/profile-saya', [ProfileSayaController::class, 'show'])->name('profile.saya');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';