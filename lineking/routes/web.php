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

Route::get('/howto', function () {return view('welcome');})->name('howto');

Route::middleware(['auth:sanctum', 'verified'])->get('/request', function () {return view('livewire.request.show');})->name('request');

Route::middleware(['auth:sanctum', 'verified'])->get('/requested', App\Http\Livewire\Requested\Show::class)->name('requested');
Route::middleware(['auth:sanctum', 'verified'])->get('/requested/{id}', App\Http\Livewire\Requested\Requested::class)->name('requested.details');
Route::middleware(['auth:sanctum', 'verified'])->get('/reserved', App\Http\Livewire\Reserved\Show::class)->name('reserved');
Route::middleware(['auth:sanctum', 'verified'])->get('/reserved/{id}', App\Http\Livewire\Reserved\Reserved::class);
Route::middleware(['auth:sanctum', 'verified'])->get('/completed', App\Http\Livewire\Completed\Show::class)->name('completed');
Route::middleware(['auth:sanctum', 'verified'])->get('/completed/{id}', App\Http\Livewire\Completed\Completed::class);


Route::get('/kakao/redirect', [SocialiteController::class,'kakaoRedirect'])->name('kakao_login');
Route::get('/kakao/callback', [SocialiteController::class,'kakaoCallback']);
Route::get('/google/redirect', [SocialiteController::class,'googleRedirect'])->name('google_login');
Route::get('/google/callback', [SocialiteController::class,'googleCallback']);