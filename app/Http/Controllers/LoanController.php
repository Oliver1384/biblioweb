<?php

namespace App\Http\Controllers;

use App\Models\Loan;
use Illuminate\Http\Request;

class LoanController extends Controller {

    public function index() {
        return route('home');
    }


    public function create() {

    }


    public function store(Request $request) {

        $request->validate([
            'book_loan_id' => 'required|min:1|max:1000',
            'user_loan_id' => 'required|min:1|max:1000',
        ]);
        $input = $request->all();

        /*if ($image = $request->file('image')) {
            $imageDestinationPath = 'uploads/';
            $postImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($imageDestinationPath, $postImage);
            $input['image'] = "$postImage";
        }*/

        Loan::create($input);
        return redirect()->route('userProfile')->with('success','Tendrás disponible el libro durante 14 días');
    }


    public function show($id) {

    }


    public function edit($id) {

    }


    public function update(Request $request, $id) {

    }


    public function destroy($id) {

    }
}
