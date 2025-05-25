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
            return redirect('/customers');
        }
    }
    return view('welcome');
});

Auth::routes();

Route::get('/staff', [StaffController::class, 'index']);

Route::resource('cars', CarController::class)->except('index', 'show');

Route::get('/bookings', [BookingController::class, 'index'])->name('bookings.index');
Route::get('/bookings/create/{car_id}', [BookingController::class, 'create'])->name('bookings.create');
Route::post('/bookings', [BookingController::class, 'store'])->name('bookings.store');
Route::get('/bookings/{booking}/edit', [BookingController::class, 'edit'])->name('bookings.edit');
Route::put('/bookings/{booking}', [BookingController::class, 'update'])->name('bookings.update');
Route::delete('/bookings/{booking}', [BookingController::class, 'destroy'])->name('bookings.destroy');

Route::get('/customers', [CustomerController::class, 'index']);

Route::get('/branches', [BranchController::class, 'index']);

Route::get('/cars', [CarController::class, 'index'])->name('cars.index');

Route::get('/staff/bookings/manage', [BookingController::class, 'manage'])->name('bookings.manage')->middleware('auth');
Route::put('/staff/bookings/{booking}/status', [BookingController::class, 'updateStatus'])->name('bookings.updateStatus')->middleware('auth');
