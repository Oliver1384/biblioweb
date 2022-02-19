<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\LoanController;
use App\Models\Book;
use App\Models\Loan;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('home');
});

Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware' => ['role:user']], function () {
    Route::get('/userProfile', function () {
        $books =  Book::paginate(5);
        $booksLoan = Loan::all();
        return view('user.userProfile',['books'=>$books,'booksLoan'=>$booksLoan]);
    })->name('userProfile');
});

Route::group(['middleware' => ['role:admin']], function () {

    Route::get('/adminProfile', function () {
        $books = Book::all();
        return view('admin.adminProfile')->with('books', $books);
    })->name('adminProfile');

    Route::get('/createBook', function() {
        return view('admin.createBook');
    })->name('createBook');

    Route::get('/addAdmin', function() {
        $users = User::all();
        return view('admin.addAdmin')->with('users',$users);
    })->name('addAdmin');

});

Route::resource('books', BookController::class);

Route::resource('loans', LoanController::class);

Route::resource('admin', AdminController::class);



