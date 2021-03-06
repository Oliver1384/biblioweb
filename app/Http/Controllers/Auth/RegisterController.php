<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        $users = User::query()
            ->orWhere('users.email', '=', $data['email'])
            ->orWhere('users.name', '=', $data['name'])
            ->select('users.id')
            ->get();
        $user = null;
        if (count($users) === 0){
            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
            ]);
            $user->assignRole('user');
        }
        return $user;
    }

    public function createAdmin(array $data) {
        $users = User::query()
            ->orWhere('users.email', '=', $data['email'])
            ->orWhere('users.name', '=', $data['name'])
            ->select('users.id')
            ->get();
        $user = null;
        if (count($users) === 0){
            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
            ]);
            $user->assignRole('user');
            $user->assignRole('admin');
        }
        return $user;
    }

    public function update(Request $request)
    {
        $user = auth()->user();

        if ($request->all()["password"] != null) {
            if ($request->all()["password"] != $request->all()["password2"]) {
                return [false,'Las contrase??as no coinciden'];
            }
            $request->validate([
                'name' => 'required|min:3|max:30',
                'email' => 'required|min:6|max:30',
                'password' => 'required|min:6|max:40',
            ]);
            $input = array_slice($request->all(), 0, 5);
            $input["password"] =  Hash::make($input['password']);
        } else {
            $request->validate([
                'name' => 'required|min:3|max:30',
                'email' => 'required|min:6|max:30',
            ]);
            $input = array_slice($request->all(), 0, 4);
        }
        $user->update($input);
        return [true,'Se han aplicado los cambios'];
    }

}
