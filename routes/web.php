<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserAccountController;
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
    return view('welcome');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {

    Route::get('/dashboard', [ProfileController::class, 'dashboard'])->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    //deposit

    Route::get('/deposit', [UserAccountController::class, 'index'])->name('deposit');

    Route::post('/deposit/store', [UserAccountController::class, 'store'])->name('deposit-store');

    //withdrow

    Route::get('/withdraw', [UserAccountController::class, 'withdraw'])->name('withdraw');

    Route::post('/withdraw/store', [UserAccountController::class, 'withdrawstore'])->name('withdraw-store');

    //transacton

    Route::get('/transfer', [UserAccountController::class, 'transfer'])->name('transfer');

    Route::post('/transfer/store', [UserAccountController::class, 'transferstore'])->name('transfer-store');

     //statement 

     Route::get('/statement', [UserAccountController::class, 'statement'])->name('statement');





});

require __DIR__.'/auth.php';
