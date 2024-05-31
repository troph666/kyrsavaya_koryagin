<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            
            return redirect()->intended('/');
        }

        
        return back()->withErrors([
            'email' => 'Неправильный email или пароль.',
        ]);
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
