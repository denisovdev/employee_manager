<?php
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;

Route::middleware('guest')->group(function () {
    Route::get('/register', [AuthController::class, 'register'])->name('register.index');
    Route::post('/register/{invite}', [AuthController::class, 'create'])->name('register.create');

    Route::view('/login', 'login');
    Route::post('/login', [AuthController::class, 'login'])->name('login');
});

Route::middleware('auth')->group(function () {
    // home
    Route::get('/', [HomeController::class, 'index'])->name('home');

    // staff
    Route::prefix('user')->name('user.')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('index');
        Route::get('/{user}', [UserController::class, 'show'])->name('show');
        Route::get('/{user}/edit', [UserController::class, 'edit'])->name('edit');
        
        Route::post('/export', [UserController::class, 'export'])->name('export');
        Route::post('/invite', [UserController::class, 'sendInvite'])->name('invite');
        Route::post('/invite/{invite}', [UserController::class, 'resendInvite'])->name('invite.resend');
        Route::post('/{user}', [UserController::class, 'update'])->name('update');

        Route::delete('/invite/{invite}', [UserController::class, 'deleteInvite'])->name('invite.delete');
    });

    // role
    Route::prefix('role')->name('role.')->group(function () {
        Route::get('/', [RoleController::class, 'index'])->name('index');
        Route::get('/{role}', [RoleController::class, 'show'])->name('show');
        Route::put('/create', [RoleController::class, 'create'])->name('create');
        Route::delete('/delete/{role}', [RoleController::class, 'delete'])->name('delete');
        Route::post('/{role}/right/update', [RoleController::class, 'updateRight'])->name('right.update');
    });
});

