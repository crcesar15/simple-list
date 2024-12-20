<?php

use App\Http\Controllers\Api\ItemsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => 'auth:sanctum', 'as' => 'api.'], function () {
    Route::get('/items', [ItemsController::class, 'index'])->name('items.index');
    Route::get('/items/{item}', [ItemsController::class, 'show'])->name('items.show');
    Route::post('/items', [ItemsController::class, 'store'])->name('items.store');
    Route::put('/items/{item}', [ItemsController::class, 'update'])->name('items.update');
    Route::delete('/items/{item}', [ItemsController::class, 'destroy'])->name('items.destroy');
});
