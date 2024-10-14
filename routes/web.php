<?php

use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OsikerController;
use App\Http\Controllers\RuanganController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\Admin\AdminBookingController;

Route::get('/', [HomeController::class, 'index']);
Route::get('/admin/bookings', [AdminBookingController::class, 'index']);
Route::patch('/admin/bookings/{code}/status', [AdminBookingController::class, 'updateStatus'])->name('update.status');

Route::group(['prefix' => 'event', 'as' => 'event.'], function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/ruangan', [RuanganController::class, 'showRuangan'])->name('ruangan.index');
    Route::get('/ruangan/{id}/edit', [RuanganController::class, 'edit'])->name('ruangan.edit');
    Route::get('/ruangan/{id}', [RuanganController::class, 'show'])->name('ruangan.show');
    Route::put('/ruangan/{id}', [RuanganController::class, 'update'])->name('ruangan.update');  // Route update sudah benar di sini
    Route::middleware('auth')->group(function () {
        Route::get('booking/create/{ruang}', [EventController::class, 'create'])->name('booking.create');
        Route::post('/booking', [EventController::class, 'store'])->name('booking.store');
        Route::post('/booking/store', [BookingController::class, 'store'])->name('booking.store');
        Route::get('/booking-history', [BookingController::class, 'history'])->name('booking.history');
    });
});


// Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['admin']], function () {
//     Route::get('/bookings', [BookingController::class, 'index'])->name('bookings.index');
//     Route::post('/bookings/approve', [BookingController::class, 'approve'])->name('bookings.approve');
//     Route::post('/bookings/reject', [BookingController::class, 'reject'])->name('bookings.reject');
    
//     // Rute tambahan jika perlu
//     // Route::get('/bookings/{id}', [BookingController::class, 'show'])->name('bookings.show');
//     // Route::get('/bookings/{id}/edit', [BookingController::class, 'edit'])->name('bookings.edit');
//     // Route::put('/bookings/{id}', [BookingController::class, 'update'])->name('bookings.update');
// });


// Route untuk Osiker
Route::group(['prefix' => 'osiker', 'as' => 'osiker.'], function () {
    Route::post('/submit', [RegisterController::class, 'store']);
    Route::get('/home', [OsikerController::class, 'index'])->name('home');
    Route::get('register/{id}/edit', [RegisterController::class, 'edit'])->name('register.edit');
    Route::post('register/{id}/update', [RegisterController::class, 'update'])->name('register.update');
    Route::delete('register/{id}', [RegisterController::class, 'destroy'])->name('register.destroy');
    Route::get('/register', [OsikerController::class, 'form'])->name('register');
    Route::post('/register', [OsikerController::class, 'store']);
    Route::post('/get-subsektor', [OsikerController::class, 'showSubsector']);
    Route::post('/api/get-kecamatan', [OsikerController::class, 'showDistrict']);
});

Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
