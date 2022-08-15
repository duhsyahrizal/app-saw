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
        $fieldType = filter_var($request->username, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        if(auth()->guard('web')->attempt([
            $fieldType  => $request->username,
            'password'  => $request->password
        ])) {
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
