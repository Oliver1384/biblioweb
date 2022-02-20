<?php

namespace App\Http\Controllers;

use App\Models\RequestLoan;
use Illuminate\Http\Request;

class RequestLoanController extends Controller
{
    public function store(Request $request) {
        $request->validate([
            'book_loan_id' => 'required|min:1|max:1000',
            'user_loan_id' => 'required|min:1|max:1000',
        ]);
        $input = $request->all();
        RequestLoan::create($input);

        return redirect()->route('userProfile');
    }

    public function destroy(RequestLoan $requestLoan) {
        $requestLoan->delete();
        return redirect()->route('manageLoans');
    }
}
