<?php

use App\Http\Controllers\ProfileController;


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
use App\Http\Controllers\Admin\SponsorshipController;
use App\Http\Controllers\Admin\DasboardController;
use App\Http\Controllers\Admin\ApartmentController;
use App\http\Controllers\Admin\MessageController;
use App\http\Controllers\Admin\ViewController;
use App\Models\Sponsorship;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});

Route::middleware(['auth', 'verified'])
    ->name('admin.')
    ->prefix('admin')
    ->group(function () {

    Route::get('/dashboard', [DasboardController::class, 'dashboard'])->name('dashboard');

    Route::resource('apartments', ApartmentController::class);

    Route::resource('messages', MessageController::class);

    Route::resource('statistics', ViewController::class);

    Route::resource('sponsorships', SponsorshipController::class);
});

require __DIR__.'/auth.php';