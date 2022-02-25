<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{

    public function index(){
        $records= Book::paginate(5);
        return view('adminProfile', compact('records'));// compact: ["record"=>$records]
    }

    public function create()   {
        return view('createBook');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3|max:30',
            'author' => 'required|min:3|max:30',
            'editorial' => 'required|min:1|max:20',
            'category'  => 'required|min:4|max:50',
            'isbn'  => 'required|min:4|max:20',
        ]);
        $input = $request->all();
        if ($image = $request->file('image')) {
            $imageDestinationPath = 'images/';
            $postImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($imageDestinationPath, $postImage);
            $input['image'] = "$postImage";
        }
        Book::create($input);
        return redirect()->route('adminProfile')->with('success','Producto agregado!!');
    }


    public function show()
    {
        $books= Book::paginate(5);
        return view('admin.adminProfile', compact('books'));
    }


    public function edit(Book $book) {
        return view('admin.editBook',compact('book'));
    }


    public function update(Request $request, Book $book)
    {
        $request->validate([
            'name' => 'required|min:3|max:30',
            'author' => 'required|min:3|max:30',
            'editorial' => 'required|min:1|max:20',
            'category'  => 'required|min:4|max:50',
            'isbn'  => 'required|min:4|max:20',
        ]);
        $input = $request->all();
        if ($image = $request->file('image')) {
            $imageDestinationPath = 'images/';
            $postImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($imageDestinationPath, $postImage);
            $input['image'] = "$postImage";
        }
        $book->update($input);
        return redirect()->route('adminProfile');
    }


    public function destroy(Book $book) {
        $book->delete();
        return redirect()->route('adminProfile');
    }

    public function search(Request $request){
        $search = $request->input('search');
        if ($search === null) {
            return null;
        }
        $books = Book::query()
            ->where('name', 'LIKE', "%{$search}%")
            ->paginate(5);
        return $books;
    }
}
