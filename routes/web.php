<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SkillController;
use App\Http\Controllers\ExperienceController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\TestimonialController;

Route::get('/', [PublicController::class, 'home'])->name('home');
Route::get('/work/{id}', [PublicController::class, 'projectShow'])->name('work.show');
Route::post('/contact', [PublicController::class, 'contact'])->name('contact.send');

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('categories', CategoryController::class)->except('show');
    Route::resource('projects', ProjectController::class);
    Route::resource('skills', SkillController::class)->except('show');
    Route::resource('experiences', ExperienceController::class)->except('show');
    Route::resource('services', ServiceController::class)->except('show');
    Route::resource('messages', MessageController::class)->only(['index', 'show', 'destroy']);
    Route::resource('testimonials', TestimonialController::class)->except('show');
});

require __DIR__.'/auth.php';
