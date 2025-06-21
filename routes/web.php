<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\ApprovalController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ReportController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the Application's ServiceProvider and all of them
| will be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Routes untuk Pegawai (User Umum)
    Route::get('/bookings/create', [BookingController::class, 'create'])->name('bookings.create');
    Route::post('/bookings', [BookingController::class, 'store'])->name('bookings.store');
    Route::get('/my-bookings', [BookingController::class, 'index'])->name('bookings.my'); // Melihat riwayat pemesanan sendiri

    // Routes untuk Pihak yang Menyetujui (Minimal 2 Level)
    Route::middleware(['approver:1'])->group(function () {
        Route::get('/approvals/level1', [ApprovalController::class, 'indexLevel1'])->name('approvals.level1.index');
        Route::put('/approvals/{approval}/level1', [ApprovalController::class, 'approveRejectLevel1'])->name('approvals.level1.update');
    });

    Route::middleware(['approver:2'])->group(function () {
        Route::get('/approvals/level2', [ApprovalController::class, 'indexLevel2'])->name('approvals.level2.index');
        Route::put('/approvals/{approval}/level2', [ApprovalController::class, 'approveRejectLevel2'])->name('approvals.level2.update');
    });

    // Routes untuk Admin
    Route::middleware(['admin'])->group(function () {
        Route::resource('admin/vehicles', AdminController::class)->names('admin.vehicles')->except(['show']); // CRUD Kendaraan
        Route::get('admin/users', [AdminController::class, 'usersIndex'])->name('admin.users.index'); // Manajemen user (ubah role, dll.)
        Route::put('admin/users/{user}/role', [AdminController::class, 'updateUserRole'])->name('admin.users.update_role');

        Route::get('admin/bookings', [AdminController::class, 'bookingsIndex'])->name('admin.bookings.index'); // Melihat semua pemesanan
        Route::get('admin/bookings/{booking}/edit', [AdminController::class, 'editBooking'])->name('admin.bookings.edit'); // Menentukan driver & kendaraan
        Route::put('admin/bookings/{booking}', [AdminController::class, 'updateBooking'])->name('admin.bookings.update');

        Route::get('/reports/bookings', [ReportController::class, 'bookingReports'])->name('reports.bookings');
        Route::get('/reports/bookings/export', [ReportController::class, 'exportBookingReports'])->name('reports.bookings.export');
    });
});

require __DIR__.'/auth.php';
