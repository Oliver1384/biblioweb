<?php

namespace App\Http\Controllers\AuthAdmin;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\ConfirmsPasswords;

class ConfirmPasswordController extends Controller {

    use ConfirmsPasswords;

    protected $redirectTo = RouteServiceProvider::ADMIN;

    public function __construct() {
        $this->middleware('auth');
    }
}
