<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ElectionStatusController;
use App\Http\Controllers\GradeController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\StudyProgramController;
use App\Http\Controllers\UserController;
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
    return view('auth/login');
});

Route::group(['prefix' => 'master', 'middleware' => ['auth:web', 'verified']], function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::name('permission.')->prefix('permission')->group(function () {
        Route::get('/', [PermissionController::class, 'index'])->name('index');
        Route::get('/data', [PermissionController::class, 'data'])->name('data');
    });

    Route::name('role.')->prefix('role')->group(function () {
        Route::get('/', [RoleController::class, 'index'])->name('index');
        Route::get('/create', [RoleController::class, 'create'])->name('create');
        Route::post('/store', [RoleController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [RoleController::class, 'edit'])->name('edit');
        Route::put('/update/{id}', [RoleController::class, 'update'])->name('update');
        Route::delete('/{id}/destroy', [RoleController::class, 'destroy'])->name('destroy');
        Route::get('/data', [RoleController::class, 'data'])->name('data');
    });

    Route::name('user.')->prefix('user')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('index');
        Route::get('/create', [UserController::class, 'create'])->name('create');
        Route::post('/store', [UserController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [UserController::class, 'edit'])->name('edit');
        Route::put('/update/{id}', [UserController::class, 'update'])->name('update');
        Route::delete('/{id}/destroy', [UserController::class, 'destroy'])->name('destroy');
        Route::get('/data', [UserController::class, 'data'])->name('data');
    });

    Route::name('study-program.')->prefix('study-program')->group(function () {
        Route::get('/', [StudyProgramController::class, 'index'])->name('index');
        Route::get('/create', [StudyProgramController::class, 'create'])->name('create');
        Route::post('/store', [StudyProgramController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [StudyProgramController::class, 'edit'])->name('edit');
        Route::put('/update/{id}', [StudyProgramController::class, 'update'])->name('update');
        Route::delete('/{id}/destroy', [StudyProgramController::class, 'destroy'])->name('destroy');
        Route::get('/data', [StudyProgramController::class, 'data'])->name('data');
    });

    Route::name('grade.')->prefix('grade')->group(function () {
        Route::get('/', [GradeController::class, 'index'])->name('index');
        Route::get('/create', [GradeController::class, 'create'])->name('create');
        Route::post('/store', [GradeController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [GradeController::class, 'edit'])->name('edit');
        Route::put('/update/{id}', [GradeController::class, 'update'])->name('update');
        Route::delete('/{id}/destroy', [GradeController::class, 'destroy'])->name('destroy');
        Route::get('/data', [GradeController::class, 'data'])->name('data');
    });

    Route::name('election-status.already.')->prefix('election-status.already')->group(function () {
        Route::get('/', [ElectionStatusController::class, 'already'])->name('index');
        Route::get('/data', [ElectionStatusController::class, 'alreadyData'])->name('data');
    });

    Route::name('election-status.notyet.')->prefix('election-status.notyet')->group(function () {
        Route::get('/', [ElectionStatusController::class, 'notyet'])->name('index');
        Route::get('/data', [ElectionStatusController::class, 'notyetData'])->name('data');
    });
});

require __DIR__.'/auth.php';
