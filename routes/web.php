<?php
use App\Http\Controllers\BookController;
use App\Models\Book;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('home');
});

Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::post('/registerAdmin',function(){
    (new App\Http\Controllers\Auth\RegisterController)->createAdmin($_POST);
    return redirect()->route('login');
});

Route::get('/registerAdmin', function() {
    return view('auth.registerAdmin');
})->name('registerAdmin');

Route::group(['middleware' => ['role:user']], function () {
    Route::get('/userProfile', function () {
        $books = Book::all();
        return view('user/userProfile')->with('books', $books);
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

    Route::resource('books', BookController::class);
});



