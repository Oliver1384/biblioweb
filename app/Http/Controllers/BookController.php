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
            'image' => 'required|min:3|max:30',
            'name' => 'required|min:3|max:30',
            'author' => 'required|min:3|max:30',
            'editorial' => 'required|min:1|max:20',
            'category'  => 'required|min:4|max:10',
            'isbn'  => 'required|min:4|max:20',
        ]);
        $input = $request->all();
        /*if ($image = $request->file('image')) {
            $imageDestinationPath = 'uploads/';
            $postImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($imageDestinationPath, $postImage);
            $input['image'] = "$postImage";
        }*/
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
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'name' => 'required|min:3|max:30',
            'autor' => 'required|min:3|max:30',
            'editorial' => 'required|min:1|max:20',
            'category'  => 'required|min:4|max:10',
            'isbn'  => 'required|min:4|max:20',
        ]);
        $input = $request->all();
        /*if ($image = $request->file('image')) {
            $imageDestinationPath = 'uploads/';
            $postImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($imageDestinationPath, $postImage);
            $input['image'] = "$postImage";
        } else {
            unset($input['image']);
        }*/
        $book->update($input);
        return redirect()->route('admin.adminProfile')->with('success','El libro ha sido actualizado');
    }


    public function destroy(Book $book)
    {
        $book->delete();
        return redirect()->route('adminProfile')->with('success','Producto eliminado');
    }

}
