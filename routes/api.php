<?php

use App\Http\Controllers\BookController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//Route::get('books/{id}/review', [BookController::class, 'review']);
//Route::resource('/books', BookController::class);

Route::controller(BookController::class)->group(function () {
    Route::get('/books', 'index');
    Route::get('/books/{id}', 'show');
    Route::get('/books/{id}/review', 'review');
    Route::get('/test', 'testQuery');
});
