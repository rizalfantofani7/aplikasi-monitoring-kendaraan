<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\ApprovalController;
use Illuminate\Support\Facades\Auth;


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
    return redirect()->route('login');
});

Auth::routes(['register' => false]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::prefix('admin')->middleware(['auth'])->group(function() {
    Route::get('/', [TransactionController::class, 'dashboard'])->name('admin.index');
    Route::get('/export', [TransactionController::class, 'export'])->name('export-transaction');
    Route::resource('kendaraan', VehicleController::class)->except(['edit', 'update', 'destroy']);;
    Route::resource('peminjaman', TransactionController::class)->except(['edit', 'update', 'destroy']);;
});

Route::group([
    'prefix' => '{role}',
    'middleware' => 'auth',
    'where' => ['role' => 'supervisor|manager']], function() {
        Route::get('/approval-request', [ApprovalController::class, 'index'])->name('approval-request');
        Route::post('/approve/{id_trx}', [ApprovalController::class, 'store'])->name('approve');
        Route::get('/approval/{id_trx}', [ApprovalController::class, 'show'])->name('approval.detail');
        Route::get('/approval-history', [ApprovalController::class, 'history'])->name('approval-history');
    }
);