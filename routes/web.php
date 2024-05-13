<?php

use App\Models\Report;
use App\Models\Operation;
use App\Models\Investigation;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LogsController;
use App\Http\Controllers\RankController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AlarmController;
use App\Http\Controllers\TrashController;
use App\Http\Controllers\TruckController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BarangayController;
use App\Http\Controllers\OccupancyController;
use App\Http\Controllers\DesignationController;
use App\Http\Controllers\InvestigationController;
use App\Http\Controllers\OperationController;
use App\Http\Controllers\PersonnelController;

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

        // Dashboard
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

        // Accounts
        Route::get('/account/admins', [AdminController::class, 'adminAccountIndex'])->name('account.admin');
        Route::get('/account/users', [AdminController::class, 'userAccountIndex'])->name('account.user');
        //Rank
        Route::get('/rank/index', [RankController::class, 'viewRank'])->name('rank.index');
        Route::post('/rank/store', [RankController::class, 'storeRank'])->name('rank.store');
        Route::put('/rank/{id}/update', [RankController::class, 'updateRank'])->name('rank.update');
        Route::delete('/rank/{id}', [RankController::class, 'deleteRank'])->name('rank.delete');

        // Account
        Route::get('/account', [AdminController::class, 'accountIndex'])->name('account');
        // Accounts
        Route::get('/account/admins', [AdminController::class, 'adminAccountIndex'])->name('account.admin');
        Route::get('/account/users', [AdminController::class, 'userAccountIndex'])->name('account.user');
        Route::post('/account/create', [AdminController::class, 'accountCreate'])->name('account.create');
        Route::post('/account/update', [AdminController::class, 'accountUpdate'])->name('account.update');
        Route::delete('/account/delete', [AdminController::class, 'accountDelete'])->name('account.delete');
        Route::post('/account/password/update', [AdminController::class, 'accountPasswordUpdate'])->name('account.password.update');

        //Barangay
        Route::get('/barangay/index', [BarangayController::class, 'viewBarangay'])->name('barangay.index');
        Route::post('/barangay/create', [BarangayController::class, 'createBarangay'])->name('barangay.create');
        Route::put('/barangay/edit/{id}', [BarangayController::class, 'updateBarangay'])->name('barangay.edit');
        Route::delete('/barangay/delete/{id}', [BarangayController::class, 'deleteBarangay'])->name('barangay.delete');
        //Trucks
        Route::get('/trucks/index', [TruckController::class, 'viewTrucks'])->name('trucks.index');
        Route::post('/trucks/create', [TruckController::class, 'createTruck'])->name('trucks.create');
        Route::put('/trucks/edit/{id}', [TruckController::class, 'updateTruck'])->name('trucks.edit');
        Route::delete('/trucks/delete/{id}', [TruckController::class, 'deleteTruck'])->name('trucks.delete');
        //Alarms
        Route::get('/alarms/index', [AlarmController::class, 'alarmIndex'])->name('alarms.index');
        Route::post('/alarm/create', [AlarmController::class, 'alarmCreate'])->name('alarms.create');
        Route::put('/alarm/update/{id}', [AlarmController::class, 'alarmUpdate'])->name('alarms.update');
        Route::delete('/alarm/delete/{id}', [AlarmController::class, 'alarmDelete'])->name('alarms.delete');

        //Trash Operation
        Route::get('/trash/operation/index', [TrashController::class, 'trashOperationIndex'])->name('trash.operation.index');
        Route::delete('/trash/operation/delete/{id}', [TrashController::class, 'trashOperationDelete'])->name('trash.operation.delete');
        Route::put('/trash/operation/restore/{id}', [TrashController::class, 'trashOperationRestore'])->name('trash.operation.restore');

        //Trash Investigation
        Route::get('/trash/investigation/index', [TrashController::class, 'trashInvestigationIndex'])->name('trash.investigation.index');
        Route::delete('/trash/investigation/delete', [TrashController::class, 'trashInvestigationDelete'])->name('trash.investigation.delete');
        Route::put('/trash/investigation/restore/{investigation}', [TrashController::class, 'trashInvestigationRestore'])->name('trash.investigation.restore');
        //Trucks
        Route::get('/trucks/index', [TruckController::class, 'viewTrucks'])->name('trucks.index');
        Route::post('/trucks/create', [TruckController::class, 'createTruck'])->name('trucks.create');
        Route::put('/trucks/edit/{id}', [TruckController::class, 'updateTruck'])->name('trucks.edit');
        Route::delete('/trucks/delete/{id}', [TruckController::class, 'deleteTruck'])->name('trucks.delete');

        //Occupancy
        Route::get('/occupancy/index', [OccupancyController::class, 'viewOccupancyNames'])->name('occupancy.index');
        Route::post('/occupancy/create', [OccupancyController::class, 'createOccupancyName'])->name('occupancy_name.create');
        Route::put('/occupancy/update/{id}', [OccupancyController::class, 'updateOccupancyName'])->name('occupancy_name.update');
        Route::delete('/occupancy/delete/{id}', [OccupancyController::class, 'deleteOccupancyName'])->name('occupancy_name.delete');
        // Personnel    
        Route::get('/personnel/index', [PersonnelController::class, 'personnelIndex'])->name('personnel.index');
        Route::get('personnel/view/{id}', [PersonnelController::class, 'personnelView'])->name('personnel.view');
        Route::get('personnel/update/{id}', [PersonnelController::class, 'personnelUpdateForm'])->name('personnel.update.form');
        Route::post('personnel/create/submit', [PersonnelController::class, 'personnelStore'])->name('personnel.store');
        Route::post('personnel/update/submit', [PersonnelController::class, 'personnelUpdate'])->name('personnel.update');
        Route::delete('personnel/delete/{id}', [PersonnelController::class, 'personnelDelete'])->name('personnel.delete');

        // Designation
        Route::get('/designation/index',[DesignationController::class, 'designationIndex'])->name('designation.index');
        Route::post('/designation/store', [DesignationController::class, 'store'])->name('designation.store');
        Route::put('/designation/update/{designation}', [DesignationController::class, 'update'])->name('designation.update');
        Route::delete('/designation/destroy', [DesignationController::class, 'destroy'])->name('designation.destroy');

        // Route::get('/update/form/{id}', [OperationController::class, 'operationUpdateForm'])->name('update.form');
        // Route::post('/update/submit', [OperationController::class, 'operationUpdate'])->name('update');

        //Logs 
        Route::get('/logs/investigation/viewLogs', [LogsController::class, 'logsInvestigationIndex'])->name('logs.investigation.viewLogs');
        Route::get('/logs/operation/viewLogs', [LogsController::class, 'logsOperationIndex'])->name('logs.operation.viewLogs');
        
    });

    // Operation
    Route::prefix('reports/operation')->name('operation.')->group(function () {
        Route::get('/index', [OperationController::class, 'operationIndex'])->name('index');
        Route::get('/create/form', [OperationController::class, 'operationCreateForm'])->name('create.form');
        Route::post('/create/submit', [OperationController::class, 'operationStore'])->name('create');
        Route::get('/update/form/{id}', [OperationController::class, 'operationUpdateForm'])->name('update.form');
        Route::post('/update/submit', [OperationController::class, 'operationUpdate'])->name('update');
        Route::put('/delete/{id}', [OperationController::class, 'operationDelete'])->name('delete');
    }); 


    // Investigation
    Route::prefix('reports/investigation')->name('investigation.')->group(function () {
        Route::get('/index', [InvestigationController::class, 'index'])->name('index');

        Route::get('/minimal/index', [InvestigationController::class, 'investigationMinimalIndex'])->name('minimal.index');
        Route::get('/minimal/create', [InvestigationController::class, 'createMinimal'])->name('minimal.create');
        Route::post('/minimal/store', [InvestigationController::class, 'storeMinimal'])->name('minimal.store');
        Route::get('/minimal/edit/{minimal}', [InvestigationController::class, 'editMinimal'])->name('minimal.edit');
        Route::put('/minimal/update/{minimal}', [InvestigationController::class, 'updateMinimal'])->name('minimal.update');
        Route::delete('/minimal/destroy', [InvestigationController::class, 'destroyMinimal'])->name('minimal.destroy');


        Route::get('/Spot/index', [InvestigationController::class, 'spot'])->name('spot.index');
        Route::get('/spot/create', [InvestigationController::class, 'createSpot'])->name('spot.create');
        Route::post('/spot/store', [InvestigationController::class, 'storeSpot'])->name('spot.store');
        Route::get('/spot/edit/{spot}', [InvestigationController::class, 'editSpot'])->name('spot.edit');
        Route::put('/spot/update/{spot}', [InvestigationController::class, 'updateSpot'])->name('spot.update');
        Route::delete('/spot/destroy', [InvestigationController::class, 'destroySpot'])->name('spot.destroy');
        Route::get('/spot/print/{spot}', [InvestigationController::class, 'printSpot'])->name('spot.print');


        Route::get('/progress/index', [InvestigationController::class, 'progress'])->name('progress.index');
        Route::get('/progress/create/{spot}', [InvestigationController::class, 'createProgress'])->name('progress.create');
        Route::post('/propress/store/{spot}', [InvestigationController::class, 'storeProgress'])->name('progress.store');
        Route::get('/progress/edit/{progress}', [InvestigationController::class, 'editProgress'])->name('progress.edit');
        Route::put('/progress/update/{progress}', [InvestigationController::class, 'updateProgress'])->name('progress.update');
        Route::delete('/progress/destroy', [InvestigationController::class, 'destroyProgress'])->name('progress.destroy');

        Route::get('/final/index', [InvestigationController::class, 'final'])->name('final.index');
        Route::get('/final/create/{spot}', [InvestigationController::class, 'createFinal'])->name('final.create');
        Route::post('/final/store/{spot}', [InvestigationController::class, 'storeFinal'])->name('final.store');
        Route::get('final/edit/{final}', [InvestigationController::class, 'editFinal'])->name('final.edit');
        Route::put('/final/update/{final}', [InvestigationController::class, 'updateFinal'])->name('final.update');
        Route::delete('/final/destroy', [InvestigationController::class, 'destroyFinal'])->name('final.destroy');



        // Route::get('/create/form', [InvestigationController::class, 'investigationMinimalCreateForm'])->name('minimal.create.form');
    });

    //Profile 
    Route::get('/profile/myProfile', [ProfileController::class, 'myProfile'])->name('profile.myProfile');

    // User Account
    Route::post('/account/edit', [UsersController::class, 'updateProfile'])->name('profile.update');
    Route::post('/account/password/edit', [UsersController::class, 'updatePassword'])->name('profile.password.update');
});


require __DIR__ . '/auth.php';
