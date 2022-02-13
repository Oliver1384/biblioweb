<?php


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('home');
});

Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::post('/registerAdmin',function(){
    (new App\Http\Controllers\Auth\RegisterController)->createAdmin($_POST);
});

Route::get('/registerAdmin', function() {
    return view('auth.registerAdmin');
})->name('registerAdmin');

Route::group(['middleware' => ['role:user']], function () {
    Route::get('/userProfile', function () {
        return view('userProfile');
    })->name('userProfile');
});

Route::group(['middleware' => ['role:admin']], function () {
    Route::get('/adminProfile', function () {
        return view('adminProfile');
    })->name('adminProfile');
});
