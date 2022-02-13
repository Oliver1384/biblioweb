<?php

namespace App\Http\Controllers;


class ProfileAdminController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {
        return view('admin.profile');
    }
}
