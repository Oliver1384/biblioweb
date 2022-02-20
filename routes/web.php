<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\LoanController;
use App\Http\Controllers\RequestLoanController;
use App\Models\Book;
use App\Models\Loan;
use App\Models\RequestLoan;
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
        $requestsLoan = RequestLoan::all();
        $booksLoan = Loan::paginate(5);
        return view('user.userProfile',['booksLoan'=>$booksLoan,'books'=>$books,'requestsLoan'=>$requestsLoan]);
    })->name('userProfile');
});

Route::group(['middleware' => ['role:admin']], function () {

    Route::get('/adminProfile', function () {
        $books = Book::paginate(5);
        return view('admin.adminProfile')->with('books', $books);
    })->name('adminProfile');

    Route::get('/createBook', function() {
        return view('admin.createBook');
    })->name('createBook');

    Route::get('/addAdmin', function() {
        $users = User::all();
        return view('admin.addAdmin')->with('users',$users);
    })->name('addAdmin');

    Route::get('/manageLoans', function() {
        $requestsLoan = RequestLoan::paginate(8);
        $books = Book::all();
        $users = User::all();
        return view('admin.manageLoans',['requestsLoan'=>$requestsLoan,'books'=>$books,'users'=>$users]);
    })->name('manageLoans');

});

Route::resource('books', BookController::class);

Route::resource('loans', LoanController::class);

Route::resource('requestLoans', RequestLoanController::class);

Route::resource('admin', AdminController::class);



