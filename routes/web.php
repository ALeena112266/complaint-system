<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ComplaintController;
use App\Http\Controllers\FeedbackController;

Route::resource('complaints', ComplaintController::class);
Route::resource('feedback', FeedbackController::class);
Route::get('/', function () {
    return view('welcome');
});
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth','verified']);
Route::view('profile/edit','profile.edit')->name('profile.edit')->middleware(['auth','verified']);