<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('auth.login');
});

Route::get('/admin', function () {
    return view('authAdmin.login');
});


Route::get('/registerAdmin', function () {
    return view('authAdmin.register');
})->name('registerAdmin');

Route::post('/registerAdmin',function(){
   (new App\Http\Controllers\AuthAdmin\RegisterController)->create($_POST);
});

Route::get('/registerUser', function () {
    return view('auth.register');
})->name('registerUser');

Route::post('/registerUser',function(){
    (new App\Http\Controllers\Auth\RegisterController)->create($_POST);
});




Route::group(['middleware' => ['role:user']], function () {
    Route::post('/userProfile', [App\Http\Controllers\ProfileUserController::class, 'index'])->name('userProfile');
});

Route::group(['middleware' => ['role:admin']], function () {
    Route::post('/adminProfile', [App\Http\Controllers\ProfileAdminController::class, 'index'])->name('adminProfile');
});
