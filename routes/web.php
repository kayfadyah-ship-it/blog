<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use Illuminate\Support\Facades\Route;
use App\Models\Project;
use App\Http\Controllers\ProfileSayaController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

//Route khusus yang butuh Login DAN Role Admin
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('projects/trash', [ProjectController::class, 'trash'])->name('projects.trash');
    Route::resource('projects', ProjectController::class);
});

//Route khusus yang butuh Login (bisa user biasa atau admin)
Route::middleware('auth')->group(function () {
    Route::get('/profile/profile-saya', [ProfileSayaController::class, 'show'])->name('profile.saya');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
