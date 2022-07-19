<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CategoryController;

Route::get('/', [HomeController::class, 'index']);
Route::get('login', [AuthController::class, 'showFormLogin'])->name('form-login');;
Route::post('login', [AuthController::class, 'login'])->name('login');

Route::get('register', [AuthController::class, 'showFormRegister'])->name('form-register');;
Route::post('register', [AuthController::class, 'register'])->name('register');


Route::get('movies/{category}', [HomeController::class, 'getMovies'])->name('get-movies');
Route::get('detail-movie/{id}', [HomeController::class, 'detailMovie'])->name('detail-movie');

Route::group(['middleware' => 'auth'], function () {    

    Route::resource('categories', CategoryController::class)->except(['show', 'create']);
    Route::get('data-categories', [CategoryController::class, 'data'])->name('categories.data');

 
    Route::get('/logout', function() {
        Auth::logout();
        return redirect('/login');
    })->name('logout');    
 
});


