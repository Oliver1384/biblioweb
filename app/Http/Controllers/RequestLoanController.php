<?php

namespace App\Http\Controllers;

use App\Models\Loan;
use App\Models\RequestLoan;
use Illuminate\Http\Request;

class RequestLoanController extends Controller
{
    protected function store(Request $request) {
        $userId = $request->query()["user_loan_id"];

        $loans = Loan::query()
            ->orWhere('loans.user_loan_id', '=', $userId)
            ->select('loans.id')
            ->get();
        if(count($loans) < 2){
            $request->validate([
                'book_loan_id' => 'required|min:1|max:1000',
                'user_loan_id' => 'required|min:1|max:1000',
            ]);
            $input = $request->all();
            RequestLoan::create($input);
        }
        return redirect()->route('userProfile');
    }

    public function destroy(RequestLoan $requestLoan) {
        $requestLoan->delete();
        return redirect()->route('manageLoans');
    }


}
