<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SavingController;
use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');


    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('/students', StudentController::class);
    Route::resource('/savings', SavingController::class);

    Route::resource('/expenses', ExpenseController::class);
    Route::get('/expenses/create/{id}', [ExpenseController::class, 'create'])->name('expenses.created');
    Route::post('/expenses/store/{id}', [ExpenseController::class, 'store'])->name('expenses.stored');
    Route::get('/expenses/edit/{id}', [ExpenseController::class, 'edit'])->name('expenses.edited');
    Route::put('/expenses/update/{id}', [ExpenseController::class, 'update'])->name('expenses.updated');


    Route::get('/amount-savings-day', [SavingController::class, 'getSavingInDay']);
    Route::get('/amount-savings-month', [SavingController::class, 'getSavingInMonth']);
});

require __DIR__ . '/auth.php';
