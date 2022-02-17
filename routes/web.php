<?php
use App\Http\Controllers\BookController;
use App\Http\Controllers\LoanController;
use App\Models\Book;
use App\Models\Loan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('home');
});

Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::post('/registerAdmin',function(){
    $request = (new App\Http\Controllers\Auth\RegisterController)->createAdmin($_POST);
    if($request === null) {
        return view('auth.registerAdmin')->with('error', 'El nombre o correo ya están registrados');
    } else {
        return redirect()->route('login');
    }
});

Route::get('/registerAdmin', function() {
    return view('auth.registerAdmin');
})->name('registerAdmin');

Route::group(['middleware' => ['role:user']], function () {
    Route::get('/userProfile', function () {
        $books = Book::all();
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

});

Route::resource('books', BookController::class);

Route::resource('loans', LoanController::class);



