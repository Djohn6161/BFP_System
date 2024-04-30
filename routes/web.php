<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\InvestigationController;
use App\Http\Controllers\OperationController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\UsersController;
use App\Models\Investigation;
use App\Models\Report;
use Illuminate\Support\Facades\Route;
use App\Models\Operation;

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

// TEMPORARY ROUTES
Route::get('/minimalInvestigation', function () {
    return view('minimalInvestigation', [
        'active' => 'minimalInvestigation',
        'user' => auth()->user(),
    ]);
});
Route::get('/spotInvestigation', function () {
    return view('spotInvestigation', [
        'active' => 'spotInvestigation',
        'user' => auth()->user(),
    ]);
});

Route::get('/progressInvestigation', function () {
    return view('progressInvestigation', [
        'active' => 'progressInvestigation',
        'user' => auth()->user(),
    ]);
});

Route::get('/finalInvestigation', function () {
    return view('finalInvestigation', [
        'active' => 'finalInvestigation',
        'user' => auth()->user(),
    ]);
});
//

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/user/logout', [UsersController::class, 'userLogout'])->name('user.logout');

    Route::middleware(['role:user'])->prefix('user')->name('user.')->group(function () {
        Route::get('/dashboard', [UsersController::class, 'dashboard'])->name('dashboard');
    });
    Route::middleware(['role:admin'])->prefix('admin')->name('admin.')->group(function () {

        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
        Route::get('/account/accounts', [AdminController::class, 'viewAccount'])->name('account.accounts');
        Route::get('/personnel/index', [AdminController::class, 'viewPersonnel'])->name('personnel.index');

        // Account
        Route::get('/account', [AdminController::class, 'accountIndex'])->name('account');
        Route::post('/account/create', [AdminController::class, 'accountCreate'])->name('account.create');
        Route::post('/account/update', [AdminController::class, 'accountUpdate'])->name('account.update');
        Route::post('/account/delete', [AdminController::class, 'accountDelete'])->name('account.delete');
        Route::post('/account/password/update', [AdminController::class, 'accountPasswordUpdate'])->name('account.password.update');
    });

    // Reports


    // Route::get('/report/create/{id}/{type}/{category}', [ReportController::class, 'createReport'])->name('report.create');
    // Route::post('/report/store/{category}', [ReportController::class, 'storeReport'])->name('report.store');

    // Afor
    Route::get('/reports/Operation/index', [OperationController::class, 'operationIndex'])->name('operation.index');
    Route::get('/reports/operation/create/form', [OperationController::class, 'operationCreateForm'])->name('operation.create.form');
    Route::post('/reports/operation/create/submit', [OperationController::class, 'operationStore'])->name('operation.create');
    Route::get('/reports/operation/update/form/{id}', [OperationController::class, 'operationUpdateForm'])->name('operation.update.form');
    Route::post('/reports/operation/update/submit', [OperationController::class, 'operationUpdate'])->name('operation.update');

    // Investigation
    Route::prefix('reports/investigation')->name('investigation.')->group(function () {
        Route::get('/index', [InvestigationController::class, 'index'])->name('index');

        Route::get('/minimal/index', [InvestigationController::class, 'investigationMinimalIndex'])->name('minimal.index');
        Route::get('/minimal/create', [InvestigationController::class, 'createMinimal'])->name('minimal.create');
        Route::post('/minimal/store', [InvestigationController::class, 'storeMinimal'])->name('minimal.store');
        Route::get('/minimal/edit/{minimal}', [InvestigationController::class, 'editMinimal'])->name('minimal.edit');

        Route::get('/Spot/index', [InvestigationController::class, 'spot'])->name('spot.index');
        Route::get('/spot/create', [InvestigationController::class, 'createSpot'])->name('spot.create');
        Route::post('/spot/store', [InvestigationController::class, 'storeSpot'])->name('spot.store');
        Route::get('/spot/edit/{spot}', [InvestigationController::class, 'editSpot'])->name('spot.edit');

        Route::get('/progress/index', [InvestigationController::class, 'progress'])->name('progress.index');
        Route::get('/progress/create/{spot}', [InvestigationController::class, 'createProgress'])->name('progress.create');
        Route::post('/propress/store/{spot}', [InvestigationController::class, 'storeProgress'])->name('progress.store');

        Route::get('/final/index', [InvestigationController::class, 'final'])->name('final.index');
        Route::get('/final/create/{spot}', [InvestigationController::class, 'createFinal'])->name('final.create');
        Route::post('/final/store/{spot}', [InvestigationController::class, 'storeFinal'])->name('final.store');


        // Route::get('/create/form', [InvestigationController::class, 'investigationMinimalCreateForm'])->name('minimal.create.form');
    });



    // Account
    Route::post('/account/edit', [UsersController::class, 'updateProfile'])->name('profile.update');
    Route::post('/account/password/edit', [UsersController::class, 'updatePassword'])->name('profile.password.update');
});


require __DIR__ . '/auth.php';
