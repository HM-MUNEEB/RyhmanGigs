<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\User;

class UserController extends Controller
{
    //show register form
    public function create()
    {
        return view("users.register");
    }
    //Creates A New User
    public function store(Request $request)
    {
        $formFields = $request->validate([
            'name' => ['required', 'min:8'],
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'password' => 'required|confirmed|min:6',
        ]);

        //hash password 
        $formFields['password'] = bcrypt($formFields['password']);

        //Create New User
        $user = User::create($formFields);

        //Login
        auth()->login($user);

        return redirect('/');
    }
    //show login form
    public function login()
    {
        return view("users.login");
    }

    //Logs In the user 
    public function authenticate(Request $request)
    {
        $formFields = $request->validate([
            'email' => ['required', 'email'],
            'password' => 'required|min:6',
        ]);

        if (auth()->attempt($formFields)) {
            $request->session()->regenerate();

            return redirect('/');
        }
        return back()->withErrors(['email' => 'Invalid Credentials'])->onlyInput('email');
    }

    //Logouts the user
    public function logout(Request $request)
    {
        auth()->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
