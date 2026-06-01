<?php

use App\Http\Controllers\Admin\BudgetController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\TransactionController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

use App\Http\Controllers\DashboardController;

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth','verified'])
->name('admin.')
->prefix('admin')
->group(function () {
    Route::get('/transactions', [TransactionController::class, 'index'])
        ->name('transactions.index');
    Route::post('/transactions', [TransactionController::class, 'store'])
        ->name('transactions.store');
    Route::get('/budgets',[BudgetController::class,'index'])
        ->name('budgets.index');
    Route::get('/categories',[CategoryController::class, 'index'])
        ->name('categories.index');
});
Route::get('/', [App\Http\Controllers\LandingController::class, 'index'])->name('landing');

require __DIR__.'/auth.php';
