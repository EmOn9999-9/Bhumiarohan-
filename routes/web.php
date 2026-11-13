<?php

use App\Http\Controllers\Admin;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ServiceController;
use Illuminate\Support\Facades\Route;

// Public website
Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/about', [PageController::class, 'about'])->name('about');
Route::get('/team', [PageController::class, 'team'])->name('team');
Route::get('/unit-converter', [PageController::class, 'converter'])->name('converter');

Route::get('/services', [ServiceController::class, 'index'])->name('services.index');
Route::get('/services/{service}', [ServiceController::class, 'show'])->name('services.show');

Route::get('/projects', [ProjectController::class, 'index'])->name('projects.index');
Route::get('/projects/{project}', [ProjectController::class, 'show'])->name('projects.show');

Route::get('/contact', [ContactController::class, 'show'])->name('contact');
Route::post('/contact', [ContactController::class, 'store'])->middleware('throttle:5,1')->name('contact.store');

// Admin panel
Route::prefix('admin')->name('admin.')->group(function () {
    Route::middleware('guest')->group(function () {
        Route::get('login', [Admin\AuthController::class, 'showLogin'])->name('login');
        Route::post('login', [Admin\AuthController::class, 'login'])->middleware('throttle:5,1')->name('login.attempt');
    });

    Route::middleware('auth')->group(function () {
        Route::post('logout', [Admin\AuthController::class, 'logout'])->name('logout');
        Route::get('/', Admin\DashboardController::class)->name('dashboard');

        Route::resource('projects', Admin\ProjectController::class)->except('show');
        Route::delete('project-images/{image}', [Admin\ProjectController::class, 'destroyImage'])->name('project-images.destroy');
        Route::resource('services', Admin\ServiceController::class)->except('show');
        Route::resource('team', Admin\TeamMemberController::class)->except('show')->parameters(['team' => 'member']);
        Route::resource('inquiries', Admin\InquiryController::class)->only(['index', 'show', 'destroy']);
        Route::patch('inquiries/{inquiry}/toggle', [Admin\InquiryController::class, 'toggle'])->name('inquiries.toggle');

        Route::get('password', [Admin\AuthController::class, 'editPassword'])->name('password.edit');
        Route::put('password', [Admin\AuthController::class, 'updatePassword'])->name('password.update');
    });
});
