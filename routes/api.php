<?php


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//Controllers
Use App\Http\Controllers\Api\ApartmentController;
use App\Http\Controllers\Api\ServiceController;
use App\Http\Controllers\Api\PictureController;
use App\Http\Controllers\Api\SponsorshipController;
use App\Http\Controllers\Api\MessageController as ApiMessageController;
use App\Http\Controllers\Api\UserController as ApiUserController;
use App\Models\Apartment;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/


Route::middleware('auth:sanctum')->get('user', [ApiUserController::class, 'getUser']);

// Route::get('user',[UserController::class, 'getUser']);

Route::get('apartments', [ApartmentController::class, 'index'])->name('api.apartments.index');

Route::get('apartments/{apartment}', [ApartmentController::class, 'show'])->name('api.apartments.show');

Route::get('search', [ApartmentController::class, 'search']);

Route::get('services', [ServiceController::class, 'index'])->name('api.services.index');

Route::get('pictures', [PictureController::class, 'index'])->name('api.pictures.index');

Route::get('sponsorship', [SponsorshipController::class, 'index'])->name('api.sponsorships.index');

Route::get('messages', [ApiMessageController::class, 'index'])->name('api.messages.index');

Route::post('messages/store', [ApiMessageController::class, 'store'])->name('api.messages.store');

Route::get('/random-apartments', [ApartmentController::class, 'getRandomApartments']);


