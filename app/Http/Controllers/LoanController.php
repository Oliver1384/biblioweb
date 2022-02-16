<?php

namespace App\Http\Controllers;



use App\Models\Book;
use App\Models\Loan;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;

class LoanController extends Controller {

    public function index() {
        return route('home');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {

    }



    public function store(Request $request, Book $book, User $user) {
        dd($book);
        dd($user);
        $request->validate([
            'book_loan_id' => 'required|min:3|max:1000',
            'user_loan_id' => 'required|min:3|max:1000',
        ]);
        //$input = $request->all();
        /*if ($image = $request->file('image')) {
            $imageDestinationPath = 'uploads/';
            $postImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($imageDestinationPath, $postImage);
            $input['image'] = "$postImage";
        }*/

        //Loan::create($input);
        //return redirect()->route('userProfile')->with('success','Tendrás disponible el libro durante 14 días');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
