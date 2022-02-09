<?php
namespace app\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller {

    use AuthenticatesUsers;

    protected function authenticated(Request $request, $user) {

        if($user->isAdmin()) {
            return redirect(route('admin_dashboard'));
        } else if($user->isUser()) {
            return redirect(route('user_dashboard'));
        }

        abort(404);
    }
}
