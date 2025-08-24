<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TransactionController;

Route::get('/', [TransactionController::class, 'index'])->name('home');
Route::resource('transactions', TransactionController::class);
Route::get('/temple', function () {
    return view('temple');
});
