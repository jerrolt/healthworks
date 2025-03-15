<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    /**
     * 
     */
    public function create()
    {
        if(Auth::check())
        {
            return redirect()->intended('/message/create');
        }
        return inertia('Auth/Login');
    }

    /**
     * 
     */
    public function store(Request $request)
    {
        // Auth::attempt keeps the user logged in indefinitely if 2nd param true
        if (!Auth::attempt($request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string'
        ]), true)) {
            throw ValidationException::withMessages([
                'email' => 'Authentication failed'
            ]);
        }

        $request->session()->regenerate();

        // set intended page to redirect
        return redirect()->intended('/message/create'); 
    }

    /**
     * 
     */
    public function destroy(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
