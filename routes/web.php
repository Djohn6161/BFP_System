<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\UsersController;
use App\Models\Report;
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
})->middleware(['guest'])->name('index');

Route::get('/home', function () {
    return view('user_homepage');
});
Route::get('/test', function () {
    return view('test');
});
Route::get('/form', function () {
    return view('form', [
        'active' => 'dashboard'
    ]);
});


Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/user/logout', [UsersController::class, 'userLogout'])->name('user.logout');

    Route::middleware(['role:user'])->prefix('user')->name('user.')->group(function () {
        Route::get('/dashboard', [UsersController::class, 'dashboard'])->name('dashboard');

    });
    Route::middleware(['role:admin'])->prefix('admin')->name('admin.')->group(function () {

        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

        // Account
        Route::get('/account', [AdminController::class, 'accountIndex'])->name('account');
    });

    // Reports
    Route::get('/reports/Investigation/index', [ReportController::class, 'investigationIndex'])->name('investigation.index');
    Route::get('/reports/Operation/index', [ReportController::class, 'operationIndex'])->name('operation.index');
    Route::get('/report/create/{id}/{type}/{category}', [ReportController::class, 'createReport'])->name('report.create');
    Route::post('/report/store/{category}', [ReportController::class, 'storeReport'])->name('report.store');
});


require __DIR__ . '/auth.php';
