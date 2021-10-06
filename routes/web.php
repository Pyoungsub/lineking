<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\SocialiteController;

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

Route::get('/', App\Http\Livewire\Main\Show::class)->name('main');
Route::middleware(['auth:sanctum', 'verified'])->get('/details/{id}', App\Http\Livewire\Main\Details::class)->name('details');

Route::get('/howto', App\Http\Livewire\Howto::class)->name('howto');

Route::middleware(['auth:sanctum', 'verified'])->get('/request', function () {return view('livewire.request.show');})->name('request');

Route::middleware(['auth:sanctum', 'verified'])->get('/requested', App\Http\Livewire\Requested\Show::class)->name('requested');
Route::middleware(['auth:sanctum', 'verified'])->get('/apply', App\Http\Livewire\Apply\Show::class)->name('apply');

Route::middleware(['auth:sanctum', 'verified'])->get('/messages', App\Http\Livewire\Tool\Messages\Show::class)->name('messages');
Route::middleware(['auth:sanctum', 'verified'])->get('/messages/{id}', App\Http\Livewire\Tool\Messages\Room::class)->name('message');

Route::middleware(['auth:sanctum', 'verified'])->get('/payment', App\Http\Livewire\Payment\Show::class)->name('payment');
Route::middleware(['auth:sanctum', 'verified'])->get('/withdraw', App\Http\Livewire\Withdraw\Show::class)->name('withdraw');

Route::get('/kakao/redirect', [SocialiteController::class,'kakaoRedirect'])->name('kakao_login');
Route::get('/kakao/callback', [SocialiteController::class,'kakaoCallback']);
Route::get('/google/redirect', [SocialiteController::class,'googleRedirect'])->name('google_login');
Route::get('/google/callback', [SocialiteController::class,'googleCallback']);