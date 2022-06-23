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

// Home page features
Route::controller(BookController::class)->group(function () {
    Route::get('/books', 'index');
    Route::get('/test', 'testQuery');
});

// Shop page features
Route::group(['prefix' => '/shops' ], function(){
    Route::get('/', [BookController::class, 'sort'])->name('sort');
});
