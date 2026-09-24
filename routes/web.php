<?php

use App\Http\Controllers\Admin\BudgetController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\TransactionController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/* -------------------------------------------------------------------------- */
/*                                 Public routes                              */
/* -------------------------------------------------------------------------- */

// Landing page
Route::get('/', [App\Http\Controllers\LandingController::class, 'index'])
    ->name('landing');

// Welcome (se ti serve, altrimenti puoi toglierla)
Route::get('/welcome', function () {
    return view('welcome');
});

/* -------------------------------------------------------------------------- */
/*                             Auth-required routes                           */
/* -------------------------------------------------------------------------- */

// Dashboard
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])
        ->name('dashboard');
});

// Profilo
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');
});

/* -------------------------------------------------------------------------- */
/*                              Admin area (auth + verified)                  */
/* -------------------------------------------------------------------------- */

Route::middleware(['auth', 'verified'])
    ->name('admin.')
    ->prefix('admin')
    ->group(function () {

        /* ------------------------------- Transactions ------------------------------ */
        Route::get('/transactions', [TransactionController::class, 'index'])
            ->name('transactions.index');

        Route::post('/transactions', [TransactionController::class, 'store'])
            ->name('transactions.store');

        /* -------------------------------- Budgets -------------------------------- */
        // Lista / panoramica budget
        Route::get('/budgets', [BudgetController::class, 'index'])
            ->name('budgets.index');

        // Form creazione / modifica budget
        Route::get('/budgets/create', [BudgetController::class, 'create'])
            ->name('budgets.create');

        // Salvataggio budget
        Route::post('/budgets', [BudgetController::class, 'store'])
            ->name('budgets.store');

        /* ------------------------------- Categories ------------------------------ */
        Route::get('/categories', [CategoryController::class, 'index'])
            ->name('categories.index');
    });

/* -------------------------------------------------------------------------- */
/*                               Auth routes                                  */
/* -------------------------------------------------------------------------- */

require __DIR__.'/auth.php';