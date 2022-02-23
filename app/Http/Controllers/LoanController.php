<?php

namespace App\Http\Controllers;

use App\Models\Loan;
use App\Models\RequestLoan;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class LoanController extends Controller {

    public function store(Request $request) {
        $validate = $this->validateLoan($request);
        if ($validate[0]){
            $request->validate([
                'book_loan_id' => 'required|min:1|max:1000',
                'user_loan_id' => 'required|min:1|max:1000',
            ]);
            $input = $request->all();
            Loan::create($input);
            $requestsLoan = RequestLoan::query()
                ->orWhere('request_loans.book_loan_id', '=', $request->all()["book_loan_id"])
                ->select('request_loans.id')
                ->get();
            foreach($requestsLoan as $requestLoan) {
                (new RequestLoanController)->destroy($requestLoan);
            }
            return redirect()->route('manageLoans');
        } else {
            return back()->with('errors', $validate[1]);
        }

    }

    /**
     * Comprueba si tiene libros prestados pasados de fecha,
     * si tiene un castigo ya aplicado y en curso y
     * si tiene prestado dos libros actualmente
     */
    protected function validateLoan(Request $request){
        $errors = [];
        $overdueLoan = true;
        $currentDate = Carbon::now();
        $userId = $request->query()["user_loan_id"];
        $loans = Loan::query()
            ->orWhere('loans.book_loan_id', '=', $request->all()["book_loan_id"])
            ->select('loans.id')
            ->get();
        $currentUserloans = Loan::query()
            ->Where('loans.user_loan_id', '=', $userId)
            ->select('loans.expiration_date')
            ->get();
        $user = User::query()
            ->Where('users.id', '=', $userId)
            ->get();
        $punishment_date = new Carbon($user->first()->getAttributes()["punishment_date"]);
        if ($currentDate->lt($punishment_date)){
            $overdueLoan = false;
            array_push($errors,'El usuario tiene un castigo en curso por devolver libros tarde');
        }
        foreach ($currentUserloans as $currentUserloan){
            $expirationDate = new Carbon($currentUserloan->value('expiration_date'));
            if ($expirationDate->lt($currentDate)){
                $overdueLoan = false;
                array_push($errors,'El usuario tiene libros atrasados sin devolver');
            }
        }
        if (count($currentUserloans) >= 2){
            array_push($errors,'El usuario ya tiene el máximo de libros que se permiten prestar (2)');
        }
        return (count($loans) === 0 && count($currentUserloans) < 2 && $overdueLoan) ? [true,$errors]: [false,$errors];
    }

    public function destroy(Loan $loan) {
        $expirationDate = new Carbon($loan->value('expiration_date'));
        $userId = $loan->value('user_loan_id');
        $currentDate = Carbon::now();
        if ($expirationDate->lt($currentDate)){
            $punishment_days = $expirationDate->diffInDays($currentDate);
            $current_punishment = new Carbon (User::where('id',$userId)->select('punishment_date')->get()->first()->getAttributes()["punishment_date"]);
            if ($currentDate->lt($current_punishment)){
                $punishment_days = $punishment_days + $currentDate->diffInDays($current_punishment);
            }
            $punishment_date = Carbon::now()->addDays($punishment_days);
            User::where('id',$userId)->update(array('punishment_date'=>$punishment_date));
        }
        $loan->delete();
        return redirect()->route('manageLoans');
    }
}