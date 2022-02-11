<?php

namespace App\Http\Controllers\AuthAdmin;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller {
    use AuthenticatesUsers;

    protected $redirectTo = RouteServiceProvider::ADMIN;

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
