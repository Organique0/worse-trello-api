<?php

use App\Http\Controllers\BoardController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::post('/boards/favorite', [BoardController::class, 'addFavorite']);
    Route::delete('/boards/favorite', [BoardController::class, 'removeFavorite']);

    Route::post('/workspaces/create', [BoardController::class, 'addWorkspace']);
    Route::delete('/workspaces/delete', [BoardController::class, 'removeWorkspace']);
    Route::get('/workspaces', [BoardController::class, 'getWorkspaces']);

    Route::post('/boards/create', [BoardController::class, 'addBoard']);
    Route::delete('/boards/delete', [BoardController::class, 'removeBoard']);

    Route::post('/comments/create', [BoardController::class, 'addComment']);
    Route::delete('/comments/delete', [BoardController::class, 'removeComment']);

    Route::post('/cards/create', [BoardController::class, 'addCard']);
    Route::delete('/cards/delete', [BoardController::class, 'removeCard']);

    Route::post('/labels/create', [BoardController::class, 'labelCard']);
    Route::delete('/labels/delete', [BoardController::class, 'labelCard']);
});
