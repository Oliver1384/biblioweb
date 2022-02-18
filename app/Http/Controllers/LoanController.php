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
        $loans = Loan::query()
            ->orWhere('loans.book_loan_id', '=',  $request->all()["book_loan_id"])
            ->select('loans.id')
            ->get();
        if (count($loans) === 0){
            $request->validate([
                'book_loan_id' => 'required|min:1|max:1000',
                'user_loan_id' => 'required|min:1|max:1000',
            ]);
            $input = $request->all();
            Loan::create($input);
        }
        /*if ($image = $request->file('image')) {
            $imageDestinationPath = 'uploads/';
            $postImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($imageDestinationPath, $postImage);
            $input['image'] = "$postImage";
        }*/
        return redirect()->route('userProfile');
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
