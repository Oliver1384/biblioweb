<?php
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
});

Route::get('/register', function () {
    return view('user.register');
});

Route::get('/login', function () {
    return view('login');
});

Auth::routes();

Route::group(['middleware' => ['role:user']], function () {
    return view('users.userProfile');
});

Route::group(['middleware' => ['role:admin']], function () {
    return view('admins.adminProfile');
});




