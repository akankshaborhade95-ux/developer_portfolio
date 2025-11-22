<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\SkillController;
use App\Http\Controllers\TestimonialController;
use Illuminate\Support\Facades\Route;

// Public routes - Portfolio Website
Route::get('/', function () {
    $projects = \App\Models\Project::where('is_active', true)->orderBy('sort_order')->get();
    $skills = \App\Models\Skill::where('is_active', true)->orderBy('sort_order')->get();
    $testimonials = \App\Models\Testimonial::where('is_active', true)->orderBy('sort_order')->get();
    
    return view('portfolio', compact('projects', 'skills', 'testimonials'));
})->name('home');

// Admin Dashboard Routes
Route::prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    
    // Projects CRUD
    Route::get('/projects/create', [ProjectController::class, 'create'])->name('projects.create');
    Route::post('/projects', [ProjectController::class, 'store'])->name('projects.store');
    Route::get('/projects/{project}/edit', [ProjectController::class, 'edit'])->name('projects.edit');
    Route::put('/projects/{project}', [ProjectController::class, 'update'])->name('projects.update');
    Route::delete('/projects/{project}', [ProjectController::class, 'destroy'])->name('projects.destroy');
    
    // Skills CRUD - Fixed routes
    Route::get('/skills', [SkillController::class, 'index'])->name('skills.index');
    Route::get('/skills/create', [SkillController::class, 'create'])->name('skills.create');
    Route::post('/skills', [SkillController::class, 'store'])->name('skills.store');
    Route::get('/skills/{skill}/edit', [SkillController::class, 'edit'])->name('skills.edit');
    Route::put('/skills/{skill}', [SkillController::class, 'update'])->name('skills.update');
    Route::delete('/skills/{skill}', [SkillController::class, 'destroy'])->name('skills.destroy');
    
    // Testimonials CRUD
    Route::get('/testimonials', [TestimonialController::class, 'index'])->name('testimonials.index');
    Route::get('/testimonials/create', [TestimonialController::class, 'create'])->name('testimonials.create');
    Route::post('/testimonials', [TestimonialController::class, 'store'])->name('testimonials.store');
    Route::get('/testimonials/{testimonial}/edit', [TestimonialController::class, 'edit'])->name('testimonials.edit');
    Route::put('/testimonials/{testimonial}', [TestimonialController::class, 'update'])->name('testimonials.update');
    Route::delete('/testimonials/{testimonial}', [TestimonialController::class, 'destroy'])->name('testimonials.destroy');
});