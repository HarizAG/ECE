<?php

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\CustomerController;

Route::get('/', function () {
    if (Auth::check()) {
        if (Auth::user()->role === 'staff') {
            return redirect('/staff');
        } elseif (Auth::user()->role === 'customer') {
            return redirect('/customer');
        }
    }
    return view('welcome');
});

Auth::routes();

Route::get('/staff', [StaffController::class, 'index']);

Route::resource('cars', CarController::class)->except('index', 'show');

Route::resource('bookings', BookingController::class);

Route::get('/customers', [CustomerController::class, 'index']);

Route::get('/cars/{car}', [CarController::class, 'show']);

Route::get('/branches', [BranchController::class, 'index']);

Route::get('/cars', [CarController::class, 'index'])->name('cars.index');
