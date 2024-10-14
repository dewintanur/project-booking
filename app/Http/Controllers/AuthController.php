<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login'); // Ensure the login view exists in resources/views/auth/login.blade.php
    }

    public function login(Request $request)
    {
        // Validasi input
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Coba login menggunakan Auth
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate(); // Regenerasi session setelah login
            Log::info('User successfully logged in: ' . $request->input('email'));
            return redirect()->intended('home'); // Arahkan ke dashboard setelah login
        }

        // Jika login gagal
        Log::error('Failed login attempt: ' . $request->input('email'));
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->withInput();
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('home')->with('success', 'Successfully logged out.');
    }
}


// namespace App\Http\Controllers;

// use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Log;
// use Illuminate\Support\Facades\Auth;

// class AuthController extends Controller
// {
//     public function showLoginForm()
//     {
//         return view('auth.login'); // Pastikan view login ada di resources/views/auth/login.blade.php
//     }

//     public function login(Request $request)
//     {
//         // Validasi input
//         $credentials = $request->validate([
//             'email' => ['required', 'email'],
//             'password' => ['required'],
//         ]);

//         // Coba login menggunakan Auth
//         if (Auth::attempt($credentials)) {
//             $request->session()->regenerate(); // Regenerasi session setelah login
//             Log::info('User successfully logged in: ' . $request->input('email'));

//             // Cek apakah user adalah admin
//             if (Auth::user()->isAdmin()) {
//                 return redirect()->route('admin.booking.index'); // Arahkan ke halaman admin
//             }

//             return redirect()->intended('home'); // Arahkan ke dashboard pengguna biasa
//         }

//         // Jika login gagal
//         Log::error('Failed login attempt: ' . $request->input('email'));
//         return back()->withErrors([
//             'email' => 'The provided credentials do not match our records.',
//         ])->withInput();
//     }

//     public function logout(Request $request)
//     {
//         Auth::logout();
//         $request->session()->invalidate();
//         $request->session()->regenerateToken();
//         return redirect()->route('home')->with('success', 'Successfully logged out.');
//     }
// }
