<?php

use App\Http\Controllers\AccessoryController;
use App\Http\Controllers\ActorController;
use App\Http\Controllers\CostumeHistoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ExportsController;
use App\Http\Controllers\ImportsController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CostumeController;
use App\Http\Controllers\RepairHistoryController;
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
  return redirect('/login');
});

Route::middleware(['auth', 'verified'])->group(function () {
  Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

  // PROFILE ROUTE
  Route::prefix('/profile')->name('profile.')->group(function () {
    Route::get('/', [ProfileController::class, 'edit'])->name('edit');
    Route::patch('/', [ProfileController::class, 'update'])->name('update');
    Route::post('/pictures', [ProfileController::class, 'updateProfilePicture'])->name('updateProfilePicture');
    Route::delete('/', [ProfileController::class, 'destroy'])->name('destroy');
  });

  // USERS ROUTES
  Route::prefix('/utilisateurs')->name('users.')->group(function () {
    Route::get('/', [UsersController::class, 'index'])->name('index');
    Route::post('/', [UsersController::class, 'store'])->name('store');
    Route::patch('/', [UsersController::class, 'update'])->name('update');
    Route::get('/search', [UsersController::class, 'searchUsers'])->name('search');
    Route::delete('/delete/{user}', [UsersController::class, 'destroy'])->name('delete');
  });

  // COSTUMES ROUTES
  Route::prefix('/costumes')->name('costumes.')->group(function () {
    Route::get('/', [CostumeController::class, 'index'])->name('index');
    Route::get('/search', [CostumeController::class, 'search'])->name('search');
    Route::get('/get-available-costumes', [CostumeController::class, 'getAvailableCostumes'])->name('getAvailableCostumes');
    Route::get('/{costume}', [CostumeController::class, 'view'])->name('view');
    Route::post('/', [CostumeController::class, 'store'])->name('store');
    Route::patch('/', [CostumeController::class, 'update'])->name('update');
    Route::delete('/delete/{costume}', [CostumeController::class, 'destroy'])->name('delete');
  });

  // ACTORS ROUTES
  Route::prefix('/acteurs')->name('actors.')->group(function () {
    Route::get('/', [ActorController::class, 'index'])->name('index');
    Route::get('/actor/{actor}', [ActorController::class, 'view'])->name('view');
    Route::post('/', [ActorController::class, 'store'])->name('store');
    Route::patch('/', [ActorController::class, 'update'])->name('update');
    Route::get('/search', [ActorController::class, 'search'])->name('search');
    Route::delete('/delete', [ActorController::class, 'delete'])->name('delete');
  });

  // COSTUMES HISTORIES ROUTES
  Route::prefix('/costume-histories')->name('costume-histories.')->group(function () {
    //Route::get('/', [CostumeHistoryController::class, 'index'])->name('index');
    Route::get('/costume-history/{costumeHistory}', [CostumeHistoryController::class, 'view'])->name('view');
    Route::post('/associate-to-actor', [CostumeHistoryController::class, 'associateCostumesToActor'])->name('associateToActor');
    Route::post('/dissociate-to-actor', [CostumeHistoryController::class, 'dissociateCostumeToActor'])->name('dissociateToActor');
    Route::patch('/', [CostumeHistoryController::class, 'update'])->name('update');
    Route::delete('/delete/{costumeHistory}', [CostumeHistoryController::class, 'delete'])->name('delete');
  });

  // ACCESSORIES ROUTES
  Route::prefix('/accessoires')->name('accessories.')->group(function () {
    Route::get('/', [AccessoryController::class, 'index'])->name('index');
    Route::get('/search', [AccessoryController::class, 'search'])->name('search');
  });

  // REPAIRS ROUTES
  Route::prefix('/reparations')->name('repairs.')->group(function () {
    Route::get('/', [RepairHistoryController::class, 'index'])->name('index');
    Route::post('/to-be-repaired', [RepairHistoryController::class, 'toBeRepaired'])->name('to-be-repaired');
    Route::post('/repaired', [RepairHistoryController::class, 'repaired'])->name('repaired');
  });

  // ENSEMBLES ROUTES
  Route::prefix('/ensembles')->name('packages.')->group(function () {
    Route::get('/', function () { dd('ij'); })->name('index');
  });

  // LOCATIONS ROUTES
  Route::prefix('/emplacements')->name('locations.')->group(function () {
    Route::get('/', [LocationController::class, 'index'])->name('index');
    Route::get('/{location}', [LocationController::class, 'show'])->name('show');
  });

  // EXPORTS ROUTES
  Route::prefix('/exports')->name('exports.')->group(function () {
    Route::get('/actors', [ExportsController::class, 'actors'])->name('actors');
    Route::get('/costumes', [ExportsController::class, 'costumes'])->name('costumes');
  });

  // IMPORTS ROUTES
  Route::prefix('/imports')->name('imports.')->group(function () {
    Route::get('dl-example-file', [ImportsController::class, 'downloadExampleFile'])->name('downloadExampleFile');
  });
});

require __DIR__ . '/auth.php';
