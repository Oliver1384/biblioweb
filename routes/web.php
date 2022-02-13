<?php


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('home');
});

Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::post('/registerAdmin',[App\Http\Controllers\Auth\RegisterController::class,'createAdmin']);

Route::get('/registerAdmin', function() {
    return view('auth.registerAdmin');
})->name('registerAdmin');

Route::group(['middleware' => ['role:user']], function () {
    Route::get('/userProfile', [App\Http\Controllers\UserProfileController::class, 'index']);
});

Route::group(['middleware' => ['role:admin']], function () {
    Route::get('/adminProfile', [App\Http\Controllers\UserProfileController::class, 'index']);
});
