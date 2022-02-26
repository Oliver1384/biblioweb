<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller {

    public function store(Request $request){
        $userId = $request->query->all()["userId"];
        $currentUser = User::where('id',$userId)->firstOrFail();
        $currentUser->assignRole('admin');
        return redirect()->route('addAdmin');
    }

}
