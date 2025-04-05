<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\JobOfferController;

Route::get('/', function () {
    return view('welcome');
});

// Ruta para consultas de compañías
Route::get('/consultasCompany', [CompanyController::class, 'consultasCom']);
// Ruta para consultas de ofertas de trabajo
Route::get('/consultasJobOffer', [JobOfferController::class, 'consultasJO']);

// Rutas para Company
Route::get('/formularioCompania', [CompanyController::class, 'create']);
Route::post('/crearCompania', [CompanyController::class, 'agg_company'])->name('company.ss');

// Rutas para JobOffer
Route::get('/formularioOferta', [JobOfferController::class, 'create']);
Route::post('/crearOferta', [JobOfferController::class, 'agg_joboffer'])->name('joboffer.ss');
