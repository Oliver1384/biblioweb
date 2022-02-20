<?php

namespace App\Http\Controllers;

use App\Models\Loan;
use App\Models\RequestLoan;
use Illuminate\Http\Request;

class LoanController extends Controller
{


    public function store(Request $request) {
        $loans = Loan::query()
            ->orWhere('loans.book_loan_id', '=', $request->all()["book_loan_id"])
            ->select('loans.id')
            ->get();
        if (count($loans) === 0) {
            $request->validate([
                'book_loan_id' => 'required|min:1|max:1000',
                'user_loan_id' => 'required|min:1|max:1000',
            ]);
            $input = $request->all();
            Loan::create($input);
        }
        $requestsLoan = RequestLoan::query()
            ->orWhere('request_loans.book_loan_id', '=', $request->all()["book_loan_id"])
            ->select('request_loans.id')
            ->get();
        foreach($requestsLoan as $requestLoan) {
            (new RequestLoanController)->destroy($requestLoan);
        }
        return redirect()->route('manageLoans');
    }

    public function destroy(Loan $loan) {
        $loan->delete();
        return redirect()->route('manageLoans');
    }
}
