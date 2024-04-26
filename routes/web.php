<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\StripeController;
use App\Http\Controllers\RegisterController;

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
    return redirect('/stores');
});

Route::get('/company', [CompanyController::class, 'index'])->name('company');

Route::post('reviews', [ReviewController::class, 'store'])->middleware(['auth', 'basic'])->middleware(['auth', 'basic'])->name('reviews.store');
Route::get('/stores/{review}/edit_review', [ReviewController::class, 'edit'])->middleware(['auth', 'verified'])->name('reviews.edit');
Route::patch('/stores/{review}', [ReviewController::class, 'update'])->middleware(['auth', 'verified'])->name('reviews.update');
Route::delete('/stores/{review}', [ReviewController::class, 'destroy'])->middleware(['auth', 'verified'])->name('reviews.destroy');


Route::get('stores/{store}/favorite', [StoreController::class, 'favorite'])->middleware(['auth', 'basic'])->name('stores.favorite');

Route::post('reservations', [ReservationController::class, 'store'])->middleware(['auth', 'basic'])->name('reservations.store');
Route::delete('reservations/{reservation}', [ReservationController::class, 'destroy'])->middleware(['auth', 'basic'])->name('reservations.destroy');

Route::resource('stores', StoreController::class);
Auth::routes(['verify' => true]);

Route::controller(UserController::class)->group(function () {
    Route::get('users/mypage', 'mypage')->name('mypage');
    Route::get('users/mypage/edit', 'edit')->name('mypage.edit');
    Route::put('users/mypage', 'update')->name('mypage.update');
    Route::get('users/mypage/password/edit', 'edit_password')->name('mypage.edit_password');
    Route::put('users/mypage/password', 'update_password')->name('mypage.update_password'); 
    Route::get('users/mypage/favorite', 'favorite')->middleware(['auth', 'basic'])->name('mypage.favorite');
    Route::delete('users/mypage/delete', 'destroy')->name('mypage.destroy');
    Route::get('users/mypage/reservation', 'reservation')->middleware(['auth', 'basic'])->name('mypage.reservation');
    
    
});

Route::get('subscription', [StripeController::class, 'subscription'])->name('subscription');
Route::post('subscription', [StripeController::class, 'afterpay'])->name('stripe.afterpay');

Route::get('edit_subscription/{user}', [StripeController::class, 'edit_subscription'])->middleware(['auth', 'basic'])->name('edit_subscription');
Route::post('update_subscription', [StripeController::class, 'edit_subscription,'])->middleware(['auth', 'basic'])->name('stripe.update');

Route::get('cancel_subscription/{user}', [StripeController::class, 'stripe_cancel'])->middleware(['auth', 'basic'])->name('cancel_subscription');
Route::post('cancel_subscription/{user}', [StripeController::class, 'cancel_subscription'])->middleware(['auth', 'basic'])->name('stripe.cancel');



