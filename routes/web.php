<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::prefix('home')->group(function () {

    Route::get('/', [App\Http\Controllers\HomeController::class, 'index']);
    Route::get('/item-list', [App\Http\Controllers\HomeController::class, 'index2']);
    Route::get('/item-list', [App\Http\Controllers\HomeController::class, 'search'])->name('item-list');
    Route::get('/item-detail/{id}', [App\Http\Controllers\HomeController::class, 'detail']);
});


//管理者ユーザーのみ

Route::group(['middleware' => ['auth', 'can:admin']], function () {

    Route::get('/users', [App\Http\Controllers\UserController::class, 'index']);
    Route::get('/users/edit/{id}', [App\Http\Controllers\UserController::class, 'edit']);
    Route::post('/users/update', [App\Http\Controllers\UserController::class, 'update']);
    Route::get('/users/delete/{id}', [App\Http\Controllers\UserController::class, 'delete']);



    Route::get('/items', [App\Http\Controllers\ItemController::class, 'index']);
    Route::get('/items/add', [App\Http\Controllers\ItemController::class, 'add']);
    Route::post('/items/add', [App\Http\Controllers\ItemController::class, 'add']);
    Route::get('/items/edit/{id}', [App\Http\Controllers\ItemController::class, 'edit']);
    Route::post('/items/update/{id}', [App\Http\Controllers\ItemController::class, 'update']);
    Route::post('/items/destroy/{id}', [App\Http\Controllers\ItemController::class, 'destroy']);
    Route::get('/items/list', [App\Http\Controllers\ItemController::class, 'find'])->name('list');
    Route::get('/items/detail/{id}', [App\Http\Controllers\ItemController::class, 'detail']);
});
