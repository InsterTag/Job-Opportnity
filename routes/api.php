<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\ClassifiedController;
use App\Http\Controllers\Api\CommentController;
use App\Http\Controllers\Api\CompanyController;
use App\Http\Controllers\Api\FavoriteController;
use App\Http\Controllers\Api\JobApplicationController;
use App\Http\Controllers\Api\JobOfferController;
use App\Http\Controllers\Api\MessageController;
use App\Http\Controllers\Api\NotificationController;
use App\Http\Controllers\Api\PortfolioController;
use App\Http\Controllers\Api\TrainingController;
use App\Http\Controllers\Api\TrainingUserController;
use App\Http\Controllers\Api\UnemployedController;
use App\Http\Controllers\Api\UserController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::prefix('category')->group(function () {
    Route::get('/', [CategoryController::class, 'index']);
    Route::post('/', [CategoryController::class, 'store']);
    Route::get('/{id}', [CategoryController::class, 'show']);
    Route::put('/{id}', [CategoryController::class, 'update']);
    Route::delete('/{id}', [CategoryController::class, 'destroy']);
});

Route::prefix('classified')->group(function () {
    Route::get('/', [ClassifiedController::class, 'index']);
    Route::post('/', [ClassifiedController::class, 'store']);
    Route::get('/{id}', [ClassifiedController::class, 'show']);
    Route::put('/{id}', [ClassifiedController::class, 'update']);
    Route::delete('/{id}', [ClassifiedController::class, 'destroy']);
});

Route::prefix('comment')->group(function () {
    Route::get('/', [CommentController::class, 'index']);
    Route::post('/', [CommentController::class, 'store']);
    Route::get('/{id}', [CommentController::class, 'show']);
    Route::put('/{id}', [CommentController::class, 'update']);
    Route::delete('/{id}', [CommentController::class, 'destroy']);
});

Route::prefix('company')->group(function () {
    Route::get('/', [CompanyController::class, 'index']);
    Route::post('/', [CompanyController::class, 'store']);
    Route::get('/{id}', [CompanyController::class, 'show']);
    Route::put('/{id}', [CompanyController::class, 'update']);
    Route::delete('/{id}', [CompanyController::class, 'destroy']);
});

Route::prefix('favorite')->group(function () {
    Route::get('/', [FavoriteController::class, 'index']);
    Route::post('/', [FavoriteController::class, 'store']);
    Route::get('/{id}', [FavoriteController::class, 'show']);
    Route::put('/{id}', [FavoriteController::class, 'update']);
    Route::delete('/{id}', [FavoriteController::class, 'destroy']);
});

Route::prefix('job-application')->group(function () {
    Route::get('/', [JobApplicationController::class, 'index']);
    Route::post('/', [JobApplicationController::class, 'store']);
    Route::get('/{id}', [JobApplicationController::class, 'show']);
    Route::put('/{id}', [JobApplicationController::class, 'update']);
    Route::delete('/{id}', [JobApplicationController::class, 'destroy']);
});

Route::prefix('job-offer')->group(function () {
    Route::get('/', [JobOfferController::class, 'index']);
    Route::post('/', [JobOfferController::class, 'store']);
    Route::get('/{id}', [JobOfferController::class, 'show']);
    Route::put('/{id}', [JobOfferController::class, 'update']);
    Route::delete('/{id}', [JobOfferController::class, 'destroy']);
});

Route::prefix('message')->group(function () {
    Route::get('/', [MessageController::class, 'index']);
    Route::post('/', [MessageController::class, 'store']);
    Route::get('/{id}', [MessageController::class, 'show']);
    Route::put('/{id}', [MessageController::class, 'update']);
    Route::delete('/{id}', [MessageController::class, 'destroy']);
});

Route::prefix('notification')->group(function () {
    Route::get('/', [NotificationController::class, 'index']);
    Route::post('/', [NotificationController::class, 'store']);
    Route::get('/{id}', [NotificationController::class, 'show']);
    Route::put('/{id}', [NotificationController::class, 'update']);
    Route::delete('/{id}', [NotificationController::class, 'destroy']);
});

Route::prefix('portfolio')->group(function () {
    Route::get('/', [PortfolioController::class, 'index']);
    Route::post('/', [PortfolioController::class, 'store']);
    Route::get('/{id}', [PortfolioController::class, 'show']);
    Route::put('/{id}', [PortfolioController::class, 'update']);
    Route::delete('/{id}', [PortfolioController::class, 'destroy']);
});

Route::prefix('training')->group(function () {
    Route::get('/', [TrainingController::class, 'index']);
    Route::post('/', [TrainingController::class, 'store']);
    Route::get('/{id}', [TrainingController::class, 'show']);
    Route::put('/{id}', [TrainingController::class, 'update']);
    Route::delete('/{id}', [TrainingController::class, 'destroy']);
});

Route::prefix('training-user')->group(function () {
    Route::get('/', [TrainingUserController::class, 'index']);
    Route::post('/', [TrainingUserController::class, 'store']);
    Route::get('/{id}', [TrainingUserController::class, 'show']);
    Route::put('/{id}', [TrainingUserController::class, 'update']);
    Route::delete('/{id}', [TrainingUserController::class, 'destroy']);
});

Route::prefix('unemployed')->group(function () {
    Route::get('/', [UnemployedController::class, 'index']);
    Route::post('/', [UnemployedController::class, 'store']);
    Route::get('/{id}', [UnemployedController::class, 'show']);
    Route::put('/{id}', [UnemployedController::class, 'update']);
    Route::delete('/{id}', [UnemployedController::class, 'destroy']);
});

Route::prefix('user')->group(function () {
    Route::get('/', [UserController::class, 'index']);
    Route::post('/', [UserController::class, 'store']);
    Route::get('/{id}', [UserController::class, 'show']);
    Route::put('/{id}', [UserController::class, 'update']);
    Route::delete('/{id}', [UserController::class, 'destroy']);
});
