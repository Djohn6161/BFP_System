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
    return view('auth.login');
});
Route::get('/admin/report', function () {
    return view('admin.report.response');
});

Route::get('/user/dashboard', [UsersController::class,'dashboard'])->middleware(['auth','verified'])->name('dashboard');
Route::get('/user/dashboard', [UsersController::class,'dashboard'])->middleware(['auth','verified'])->name('dashboard');
Route::get('/user/logout', [UsersController::class,'userLogout'])->name('user.logout');

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class,'dashboard'])->middleware(['auth','verified'])->name('admin.dashboard');
    Route::get('/admin/logout', [AdminController::class,'adminLogout'])->name('admin.logout');
});

require __DIR__.'/auth.php';
