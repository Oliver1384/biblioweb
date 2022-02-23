<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\LoanController;
use App\Models\Book;
use App\Models\Loan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    $books = Book::paginate(5);
    $booksLoan = Loan::paginate(5);
    return view('home',['books'=>$books,'booksLoan'=>$booksLoan]);
});

Auth::routes();
Route::get('/home', function () {
    $books = Book::paginate(5);
    $booksLoan = Loan::paginate(5);
    return view('home',['books'=>$books,'booksLoan'=>$booksLoan]);
})->name('home');

Route::get('/home', function (Request $request) {
    $books =(new App\Http\Controllers\BookController)->search($request);
    $booksLoan = Loan::paginate(5);
    return view('home',['books'=>$books,'booksLoan'=>$booksLoan]);
})->name('searchHome');



Route::group(['middleware' => ['role:user']], function () {
    Route::get('/userProfile', function () {
        $books =  Book::paginate(5);
        $booksLoan = Loan::paginate(5);
        return view('user.userProfile',['booksLoan'=>$booksLoan,'books'=>$books]);
    })->name('userProfile');

    Route::get('/userProfileSearch', function (Request $request) {
        $books = (new App\Http\Controllers\BookController)->search($request);
        $booksLoan = Loan::paginate(5);
        return view('user.userProfile',['booksLoan'=>$booksLoan,'books'=>$books]);
    })->name('searchUserProfile');
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
        $books = Book::all();
        $users = User::all();
        $loans = Loan::all();
        return view('admin.manageLoans',['loans'=>$loans,'books'=>$books,'users'=>$users]);
    })->name('manageLoans');
});

Route::resource('books', BookController::class);

Route::resource('loans', LoanController::class);

Route::resource('admin', AdminController::class);



