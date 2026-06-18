<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\StockMovementController;



    Route::post('/stock-movements', [StockMovementController::class, 'store']);

    Route::get('/products/{id}/stock', [StockMovementController::class, 'stock']);

    Route::get('/products/{id}/stock-movements', [StockMovementController::class, 'movements']);

    Route::get(
    '/products/{id}/stock-movements',
    [StockMovementController::class, 'movements']
);