<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\ThreadController;
use App\Http\Controllers\TransactionController;
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
    return redirect()->route('login');
});

Route::get('/images/{filename}', function ($filename) {
    return response()->file(public_path('upload/image/' . $filename));
})->where('path', '.*')
->name('images');


Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'show'])->name('dashboard');

    Route::get('/threads/{id}', [ThreadController::class, 'show'])->name('threads.show');
    Route::post('/threads/{id?}', [ThreadController::class, 'store'])->name('threads.store');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/shops', [ShopController::class, 'index'])->name('shop.index');
    Route::get('/shops/{id}', [ShopController::class, 'show'])->name('shop.show');
    Route::put('/shop', [ShopController::class, 'update'])->name('shop.update');

    Route::get('/transactions', [TransactionController::class, 'index'])->name('transaction.index');
    Route::get('/transactions/{id}', [TransactionController::class, 'show'])->name('transaction.show');
    Route::post('/transactions/{id}/updateprogress', [TransactionController::class, 'updateProgress'])->name('transaction.update.progress');
    Route::post('/transaction/store', [TransactionController::class, 'store'])->name('transaction.store');

    Route::get('transactions/{id}/review', [ReviewController::class, 'indexAddReview'])->name('transaction.add-review.index');
    Route::post('transactions/{id}/review', [ReviewController::class, 'addReview'])->name('transaction.add-review');
});

require __DIR__ . '/auth.php';
