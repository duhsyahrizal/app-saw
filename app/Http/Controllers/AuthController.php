<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    private $redirectTo = '/';

    public function username()
    {
        return 'username';
    }

    public function showLogin()
    {
        return view('auth.login');
    }

    public function postLogin(Request $request)
    {
        if(auth()->guard('web')->attempt($request->except('_token'))) {
            return redirect($this->redirectTo);
        }

        return redirect()->back()->with([
            'success'   => false,
            'message'   => 'Username or Password is invalid!'
        ]);
    }

    public function logout(Request $request) 
    {
        auth()->logout();

        return redirect('/login');
    }
}
