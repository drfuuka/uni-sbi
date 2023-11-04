<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
            $credentials = $request->validate([
                'email'    => ['required', 'email'],
                'password' => ['required'],
            ]);
     
            if (Auth::attempt($credentials)) {
                $request->session()->regenerate();
     
                if(Auth::user()->role) {
                    return redirect()->route('admin.index');
                }
                return redirect()->route('inspektor.index');
            }
    
            return back()->withErrors([
                'email' => 'The provided credentials do not match our records.',
            ])->onlyInput('email');
    }

    public function logout()
    {
       Auth::logout();
       return redirect('/');
    }
}
