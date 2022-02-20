<?php

namespace App\Http\Controllers;

use App\Models\RequestLoan;
use Illuminate\Http\Request;

class RequestLoanController extends Controller
{
    public function store(Request $request) {
        $loans = RequestLoan::query()
            ->orWhere('request_loans.book_loan_id', '=', $request->all()["book_loan_id"])
            ->select('request_loans.id')
            ->get();
        if (count($loans) === 0) {
            $request->validate([
                'book_loan_id' => 'required|min:1|max:1000',
                'user_loan_id' => 'required|min:1|max:1000',
            ]);
            $input = $request->all();
            RequestLoan::create($input);
        }
        /*if ($image = $request->file('image')) {
            $imageDestinationPath = 'uploads/';
            $postImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($imageDestinationPath, $postImage);
            $input['image'] = "$postImage";
        }*/
        return redirect()->route('userProfile');
    }
}
