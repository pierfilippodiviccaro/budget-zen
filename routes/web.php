<?php

use App\Http\Controllers\BudgetController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth','verified'])
->name('admin.')
->prefix('admin')
->group(function () {
    Route::get('/budgets', [BudgetController::class,'index'])
    ->name('index');
    
    Route::get('/transactions', [TransactionController::class, 'index'])
        ->name('transactions.index');
        Route::get('/budgets',[BudgetController::class,'index'])
        ->name('budgets.index');
        Route::get('/categories',[CategoryController::class, 'index'])
        ->name('categories.index');
});
Route::get('/', [App\Http\Controllers\LandingController::class, 'index'])->name('landing');

require __DIR__.'/auth.php';
