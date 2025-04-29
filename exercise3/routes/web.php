<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ThemeController;
use Illuminate\Support\Facades\Route;

Route::get('language/{lang}', [LanguageController::class, 'switchLang'])->name('language.switch');
Route::post('theme', [ThemeController::class, 'switch'])->name('theme.switch');
Route::get('theme', [ThemeController::class, 'current'])->name('theme.current');

Route::get('/', function () {
    return redirect()->route('dashboard');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Project routes
    Route::resource('projects', ProjectController::class);
    Route::patch('projects/{project}/jobs', [ProjectController::class, 'updateJobs'])->name('projects.update-jobs');
});

require __DIR__.'/auth.php';
