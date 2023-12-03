<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            // Check the user's role
            if ($user->role == 0) {
                // Regular user, redirect to '/dashboard'
                return redirect()->intended('/dashboard');
            } elseif ($user->role == 1) {
                // Admin user, redirect to the admin page
                return redirect()->intended('/admin');
            }
        }

        // Unsuccessful login
        return back()->withErrors(['email' => 'Hatalı giriş bilgileri']);
    }


    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }
}
