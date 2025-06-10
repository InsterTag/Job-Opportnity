<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UnemployedController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\JobOfferController;
use App\Http\Controllers\FavoriteOfferController;
use App\Http\Controllers\JobApplicationController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\TrainingController;

// Rutas públicas
Route::view('/login', 'login')->name('login');
Route::view('/home', 'home')->middleware('auth')->name('home');

// Usuario
Route::get('/register', [UserController::class, 'create'])->name('register');
Route::post('/crearUsuario', [UserController::class, 'agg_user'])->name('create-user');
Route::post('/inicia-sesion', [UserController::class, 'login'])->name('inicia-sesion');
Route::get('/logout', [UserController::class, 'logout'])->name('logout');

// Mensajes (solo auth)
Route::middleware('auth')->group(function () {
    Route::get('/messages', [MessageController::class, 'index'])->name('messages');
    Route::get('/message/create', [MessageController::class, 'create'])->name('message-form');
    Route::post('/message/send', [MessageController::class, 'send_message'])->name('send-message');
});

// Unemployed
Route::get('/unemployed-form', [UnemployedController::class, 'create'])->name('unemployed-form');
Route::post('/agg-unemployed', [UnemployedController::class, 'agg_unemployed'])->name('agg-unemployed');

// Company
Route::get('/company-form', [CompanyController::class, 'create'])->name('company-form');
Route::post('/agg-company', [CompanyController::class, 'agg_company'])->name('agg-company');

// Portfolios
Route::get('/portfolio-list', [PortfolioController::class, 'list'])->name('portfolios.index');
Route::get('/portfolio-form', [PortfolioController::class, 'create'])->name('portfolio-form');
Route::post('/agg-portfolio', [PortfolioController::class, 'store'])->name('agg-portfolio');
Route::get('/portfolio-edit/{id}', [PortfolioController::class, 'edit'])->name('edit-portfolio');
Route::post('/portfolio-update/{id}', [PortfolioController::class, 'update'])->name('update-portfolio');
Route::delete('/portfolio-delete/{id}', [PortfolioController::class, 'destroy'])->name('delete-portfolio');

// Job Offers
Route::get('/joboffers', [JobOfferController::class, 'index'])->name('job-offers.index');
Route::get('/crear', [JobOfferController::class, 'create'])->name('job-offers.create');
Route::post('/joboffers', [JobOfferController::class, 'store'])->name('job-offers.store');
Route::get('/joboffers/{jobOffer}', [JobOfferController::class, 'show'])->name('job-offers.show');
Route::get('/joboffers/{jobOffer}/editar', [JobOfferController::class, 'edit'])->name('job-offers.edit');
Route::put('/joboffers/{jobOffer}', [JobOfferController::class, 'update'])->name('job-offers.update');
Route::delete('/joboffers/{jobOffer}', [JobOfferController::class, 'destroy'])->name('job-offers.destroy');

// Favorite Offers
Route::get('/favoriteOffer', [FavoriteOfferController::class, 'index'])->name('favorite-offers.index');
Route::post('/ofertas/{jobOffer}/favorite', [FavoriteOfferController::class, 'toggle'])->name('job-offers.toggle-favorite');

// Job Applications
Route::post('/job-applications', [JobApplicationController::class, 'store'])->name('job-applications.store');

// Companies
Route::get('/Companies', [CompanyController::class, 'index'])->name('index');
Route::get('/Company/{company}', [CompanyController::class, 'show'])->name('show');

// Trainings
Route::get('/capacitaciones', [TrainingController::class, 'index'])->name('training.index');
Route::get('/capacitaciones/crear', [TrainingController::class, 'create'])->name('training.create');
Route::post('/capacitaciones', [TrainingController::class, 'store'])->name('training.store');
Route::get('/capacitaciones/{id}/editar', [TrainingController::class, 'edit'])->name('training.edit');
Route::put('/capacitaciones/{id}', [TrainingController::class, 'update'])->name('training.update');
Route::delete('/capacitaciones/{id}', [TrainingController::class, 'destroy'])->name('training.destroy');

// Categories
Route::get('/categories', [CategoryController::class, 'list'])->name('category-list');
Route::get('/categories/create', [CategoryController::class, 'create'])->name('category-create');
Route::post('/categories', [CategoryController::class, 'store'])->name('category-store');
Route::get('/categories/{id}/edit', [CategoryController::class, 'edit'])->name('category-edit');
Route::put('/categories/{id}', [CategoryController::class, 'update'])->name('category-update');
Route::delete('/categories/{id}', [CategoryController::class, 'destroy'])->name('category-delete');