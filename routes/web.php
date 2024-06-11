<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SetorController;
use App\Http\Controllers\AssuntoController;
use App\Http\Controllers\PortariaController;
use App\Http\Controllers\UserController;

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;

// Perfil de Usuario Logado
Route::middleware(['auth', 'registered'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
});

// Home
Route::get('/', function() { return redirect(route('portaria.index')); });

// Portaria
// Route::prefix('portaria')->middleware(['auth', 'registered'])->group(function () {
//     Route::get('/', [PortariaController::class, 'index'])->name('portaria.index');
//     Route::get('/create', [PortariaController::class, 'create'])->name('portaria.create');
//     Route::post('/store', [PortariaController::class, 'store'])->name('portaria.store');
//     Route::get('/detail/{id}', [PortariaController::class, 'detail'])->name('portaria.detail');
//     Route::get('/edit/{id}', [PortariaController::class, 'edit'])->middleware(['protected_access_portaria'])->name('portaria.edit');
//     Route::put('/update/{id}', [PortariaController::class, 'update'])->middleware(['protected_access_portaria'])->name('portaria.update');
//     Route::get('/destroy/{id}', [PortariaController::class, 'softDelete'])->middleware(['protected_access_portaria'])->name('portaria.disable');
//     Route::get('/enable/{id}', [PortariaController::class, 'enable'])->middleware(['protected_access_portaria'])->name('portaria.enable');
// });

// Setores
Route::prefix('setor')->middleware(['auth', 'registered', 'master'])->group(function () {
    Route::get('/', [SetorController::class, 'index'])->name('setor.index');
    Route::get('/create', [SetorController::class, 'create'])->name('setor.create');
    Route::post('/', [SetorController::class, 'store'])->name('setor.store');
    Route::get('/{setor}/edit', [SetorController::class, 'edit'])->name('setor.edit');
    Route::put('/{setor}/update', [SetorController::class, 'update'])->name('setor.update');
    Route::get('/{id}/destroy', [SetorController::class, 'destroy'])->name('setor.destroy');
});

// Assuntos
Route::prefix('assunto')->middleware(['auth', 'registered', 'admin'])->group(function () {
    Route::get('/', [AssuntoController::class, 'index'])->name('assunto.index');
    Route::get('/create', [AssuntoController::class, 'create'])->name('assunto.create');
    Route::post('/', [AssuntoController::class, 'store'])->name('assunto.store');
    Route::get('/{assunto}/edit', [AssuntoController::class, 'edit'])->name('assunto.edit');
    Route::put('/{assunto}/update', [AssuntoController::class, 'update'])->name('assunto.update');
    Route::get('/{id}/destroy', [AssuntoController::class, 'destroy'])->name('assunto.destroy');
});

// Usuarios
Route::prefix('gerenciar-perfis')->middleware(['auth', 'registered', 'admin'])->group(function () {
    Route::get('/', [UserController::class, 'index'])->name('user.index');
    Route::get('/{id}/edit', [UserController::class, 'edit'])->middleware('protected_access_user')->name('user.edit');
    Route::put('/{id}/update', [UserController::class, 'update'])->middleware('protected_access_user')->name('user.update');
    Route::get('/{id}/enable', [UserController::class, 'enable'])->middleware('protected_access_user')->name('user.enable');
    Route::get('/{id}/disable', [UserController::class, 'disable'])->middleware('protected_access_user')->name('user.disable');
});

// Formulario
Route::middleware('guest')->group(function () {
    Route::get('register', [RegisteredUserController::class, 'create'])->name('register');
    Route::post('register', [RegisteredUserController::class, 'store']);
    Route::get('login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('login', [AuthenticatedSessionController::class, 'store']);
});

Route::middleware('auth')->group(function () {
    // Logout
    Route::get('logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
    // Status de acesso
    Route::get('/status', function() {
                    return view('status.status');
                })->name('status'); 
});

