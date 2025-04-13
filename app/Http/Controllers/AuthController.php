<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{


    public function login(Request $request) {
        $credentials = $request->only('identifier', 'password');

        // Bisa login pakai email atau username
        $login_type = filter_var($credentials['identifier'], FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        if (Auth::attempt([$login_type => $credentials['identifier'], 'password' => $credentials['password']])) {
            $request->session()->regenerate();
            return redirect()->intended('/');
        }

        return back()->withErrors([
            'identifier' => 'Email/Username atau password salah.',
        ]);
    }

    public function register(Request $request) {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
            'username' => 'required|unique:users,username',
            'class' => 'required',
            'phone' => 'nullable|string|max:20',
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'username' => $validated['username'],
            'class' => $validated['class'],
            'phone' => $validated['phone'],
            'password' => Hash::make($validated['password']),
        ]);

        Auth::login($user);
        return redirect('/');
    }

    public function logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
