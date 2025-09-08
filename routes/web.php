<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AboutMeController;
use App\Http\Controllers\CertificateController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ToolController;
use App\Http\Controllers\CareerController;

// Rutas de autenticación
    Route::get('/', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login'])->name('login.perform');
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

    Route::redirect('/dashboard', '/about-me')->name('dashboard');
    
    // Rutas para Projects
    Route::get('/projects', [ProjectController::class, 'index'])->name('projects.index');
    Route::get('/projects/create', [ProjectController::class, 'create'])->name('projects.create');
    Route::post('/projects', [ProjectController::class, 'store'])->name('projects.store');
    Route::get('/projects/{project}', [ProjectController::class, 'show'])->name('projects.show');
    Route::put('/projects/{project}', [ProjectController::class, 'update'])->name('projects.update');
    Route::delete('/projects/{project}', [ProjectController::class, 'destroy'])->name('projects.destroy');
    Route::get('/projects/{project}/tools', [ProjectController::class, 'getTools'])->name('projects.tools');
    
    // Rutas para Certificates
    Route::get('/certificates', [CertificateController::class, 'index'])->name('certificates.index');
    Route::get('/certificates/create', [CertificateController::class, 'create'])->name('certificates.create');
    Route::post('/certificates', [CertificateController::class, 'store'])->name('certificates.store');
    Route::get('/certificates/{certificate}', [CertificateController::class, 'show'])->name('certificates.show');
    Route::put('/certificates/{certificate}', [CertificateController::class, 'update'])->name('certificates.update');
    Route::delete('/certificates/{certificate}', [CertificateController::class, 'destroy'])->name('certificates.destroy');
    Route::get('/certificates/{certificate}/tools', [CertificateController::class, 'getTools'])->name('certificates.tools');
    
    // Rutas para Tools
    Route::get('/tools', [ToolController::class, 'index'])->name('tools.index');
    Route::get('/tools/create', [ToolController::class, 'create'])->name('tools.create');
    Route::post('/tools', [ToolController::class, 'store'])->name('tools.store');
    Route::get('/tools/{tool}', [ToolController::class, 'show'])->name('tools.show');
    Route::put('/tools/{tool}', [ToolController::class, 'update'])->name('tools.update');
    Route::delete('/tools/{tool}', [ToolController::class, 'destroy'])->name('tools.destroy');
    Route::get('/tools/list/all', [ToolController::class, 'getAllTools'])->name('tools.all');
    
    // Rutas para About Me
    Route::get('/about-me', [AboutMeController::class, 'index'])->name('about-me.index');
    Route::post('/about-me', [AboutMeController::class, 'store'])->name('about-me.store');
    Route::get('/about-me/{aboutMe}', [AboutMeController::class, 'show'])->name('about-me.show');
    Route::put('/about-me/{aboutMe}', [AboutMeController::class, 'update'])->name('about-me.update');
    Route::delete('/about-me/{aboutMe}', [AboutMeController::class, 'destroy'])->name('about-me.destroy');
    Route::get('/about-me/create', [AboutMeController::class, 'create'])->name('about-me.create');
    
    // Rutas para Career
    Route::get('/careers', [CareerController::class, 'index'])->name('careers.index');
    Route::get('/careers/create', [CareerController::class, 'create'])->name('careers.create');
    Route::post('/careers', [CareerController::class, 'store'])->name('careers.store');
    Route::get('/careers/{career}', [CareerController::class, 'show'])->name('careers.show');
    Route::get('/careers/{career}/edit', [CareerController::class, 'edit'])->name('careers.edit');
    Route::put('/careers/{career}', [CareerController::class, 'update'])->name('careers.update');
    Route::delete('/careers/{career}', [CareerController::class, 'destroy'])->name('careers.destroy');


