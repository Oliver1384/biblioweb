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
   (new App\Http\Controllers\Auth\RegisterAdminController)->create($_POST);
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');



Route::group(['middleware' => ['role:user']], function () {
    //rutas accesibles solo para clientes
});
