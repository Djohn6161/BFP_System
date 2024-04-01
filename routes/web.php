<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UsersController;
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

Route::get('/', function () {
    return view('index');
})->middleware(['guest']);


Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/user/logout', [UsersController::class,'userLogout'])->name('user.logout');
    Route::middleware(['role:user'])->prefix('user')->name('user.')->group(function(){
        Route::get('/dashboard', [UsersController::class,'dashboard'])->name('dashboard');
    });
    Route::middleware(['role:admin'])->prefix('admin')->name('admin.')->group(function(){
        Route::get('/dashboard', [AdminController::class,'dashboard'])->name('dashboard');

    });
});

require __DIR__.'/auth.php';
