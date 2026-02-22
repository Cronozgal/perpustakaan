<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/login');
});

Route::get('/login', [AuthController::class , 'login'])->name('login');
Route::post('/login', [AuthController::class , 'authenticate']);
Route::post('/logout', [AuthController::class , 'logout'])->name('logout');

Route::get('/register', [RegisterController::class , 'index'])->name('register');
Route::post('/register', [RegisterController::class , 'store']);

Route::middleware(['auth'])->group(function () {
    // Admin routes
    Route::middleware(['role:admin'])->prefix('admin')->group(function () {
            Route::get('/dashboard', [\App\Http\Controllers\AdminController::class , 'dashboard'])->name('admin.dashboard');
            Route::resource('books', \App\Http\Controllers\BookController::class);
            Route::resource('members', \App\Http\Controllers\MemberController::class);
            Route::resource('transactions', \App\Http\Controllers\TransactionController::class);
        }
        );

        // Siswa routes
        Route::middleware(['role:siswa'])->prefix('siswa')->group(function () {
            Route::get('/dashboard', [\App\Http\Controllers\SiswaController::class , 'dashboard'])->name('siswa.dashboard');

            Route::get('/peminjaman', [\App\Http\Controllers\SiswaController::class , 'peminjaman'])->name('siswa.peminjaman');
            Route::post('/peminjaman/{book}', [\App\Http\Controllers\SiswaController::class , 'storePinjam'])->name('siswa.peminjaman.store');

            Route::get('/pengembalian', [\App\Http\Controllers\SiswaController::class , 'pengembalian'])->name('siswa.pengembalian');
            Route::post('/pengembalian/{transaction}', [\App\Http\Controllers\SiswaController::class , 'storeKembali'])->name('siswa.pengembalian.store');
        }
        );    });
