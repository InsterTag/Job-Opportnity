<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UnemployedController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\JobOfferController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\JobApplicationController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\TrainingController;
use App\Http\Controllers\ClassifiedController;
use App\Http\Controllers\NotificationController;


// Rutas públicas
Route::view('/login', 'login')->name('login');
Route::view('/', 'home')->middleware('auth')->name('home');

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
    
    // Notificaciones
    Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');
    Route::post('/notifications/{id}/mark-as-read', [NotificationController::class, 'markAsRead'])->name('notifications.mark-as-read');
    Route::get('/notifications/unread-count', [NotificationController::class, 'getUnreadCount'])->name('notifications.unread-count');
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

// // Favorite Offers
// Route::get('/favoriteOffer', [FavoriteController::class, 'index'])->name('favorite-offers.index');
// Route::post('/ofertas/{jobOffer}/favorite', [FavoriteController::class, 'toggle'])->name('job-offers.toggle-favorite');


// Postulaciones (Job Applications)
Route::middleware(['auth'])->group(function () {
    Route::get('/job-applications/create', [JobApplicationController::class, 'create'])->name('job-applications.create');
    Route::post('/job-applications', [JobApplicationController::class, 'store'])->name('job-applications.store');
    Route::patch('/job-applications/{id}/status', [JobApplicationController::class, 'updateStatus'])->name('job-applications.update-status');
    Route::get('/job-applications/company', [JobApplicationController::class, 'indexCompany'])->name('job-applications.index-company');
    Route::get('/job-applications/unemployed', [JobApplicationController::class, 'indexUnemployed'])->name('job-applications.index-unemployed');
    Route::get('/job-applications/{id}/download-cv', [JobApplicationController::class, 'downloadCv'])->name('job-applications.download-cv');

    // Rutas para entrevistas (programar y ver)
    Route::get('/interviews/{applicationId}', [\App\Http\Controllers\InterviewController::class, 'index'])->name('interviews.index');
    Route::post('/interviews/{applicationId}', [\App\Http\Controllers\InterviewController::class, 'store'])->name('interviews.store');
});

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



Route::middleware(['auth'])->group(function () {
    Route::resource('classifieds', ClassifiedController::class);
});

// corrigiendo esto
// Route::post('/favorites/toggle', [FavoriteController::class, 'toggle'])->name('favorites.toggle');
Route::post('/favorites/toggle', [FavoriteController::class, 'toggle'])->name('favorites.toggle');
Route::get('/favorites', [FavoriteController::class, 'index'])->name('favorites.index');
Route::post('/favorites/classifieds/{classified}/toggle', [FavoriteController::class, 'toggleClassified'])->middleware(['auth'])->name('favorites.classifieds.toggle');
