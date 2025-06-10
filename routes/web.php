<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Route;


//Rutas para la vista
Route::view('/login', 'login')->name('login');
Route::view('/home', 'home')->middleware('auth')->name('home');

//Rutas para crear un Usuario
Route::get('/register',[UserController::class,'create'])->name('register');
Route::post('/crearUsuario',[UserController::class,'agg_user'])->name('create-user');
Route::post('/inicia-sesion',[UserController::class,'login'])->name('inicia-sesion');
Route::get('/logout',[UserController::class,'logout'])->name('logout');


Route::get('/message/create', [MessageController::class, 'create'])->name('message-form');
Route::post('/message/send', [MessageController::class, 'send_message'])->name('send-message');
Route::get('/messages', [MessageController::class, 'index'])->name('messages')->middleware('auth');



Route::get('/unemployed-form', [UnemployedController::class, 'create'])->name('unemployed-form');
Route::post('/agg-unemployed', [UnemployedController::class, 'agg_unemployed'])->name('agg-unemployed');
Route::get('/company-form', [CompanyController::class, 'create'])->name('company-form');
Route::post('/agg-company', [CompanyController::class, 'agg_company'])->name('agg-company');



Route::middleware('auth')->group(function () {
    // Ver la lista de portafolios
    Route::get('/portfolio-list', [PortfolioController::class, 'list'])->name('portfolio-list');

    // Crear un nuevo portafolio
    Route::get('/portfolio-form', [PortfolioController::class, 'create'])->name('portfolio-form');
    Route::post('/agg-portfolio', [PortfolioController::class, 'store'])->name('agg-portfolio');

    // Editar un portafolio
    Route::get('/portfolio-edit/{id}', [PortfolioController::class, 'edit'])->name('edit-portfolio');
    Route::post('/portfolio-update/{id}', [PortfolioController::class, 'update'])->name('update-portfolio');

    // Eliminar un portafolio
    Route::delete('/portfolio-delete/{id}', [PortfolioController::class, 'destroy'])->name('delete-portfolio');

    // Categories
    Route::get('/categories', [CategoryController::class, 'list'])->name('category-list');
    Route::get('/categories/create', [CategoryController::class, 'create'])->name('category-create');
    Route::post('/categories', [CategoryController::class, 'store'])->name('category-store');
    Route::get('/categories/{id}/edit', [CategoryController::class, 'edit'])->name('category-edit');
    Route::put('/categories/{id}', [CategoryController::class, 'update'])->name('category-update');
    Route::delete('/categories/{id}', [CategoryController::class, 'destroy'])->name('category-delete');
});
