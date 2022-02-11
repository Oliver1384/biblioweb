<?php

namespace App\Http\Controllers\AuthAdmin;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\ResetsPasswords;

class ResetPasswordController extends Controller {

    use ResetsPasswords;

    protected $redirectTo = RouteServiceProvider::ADMIN;
}
