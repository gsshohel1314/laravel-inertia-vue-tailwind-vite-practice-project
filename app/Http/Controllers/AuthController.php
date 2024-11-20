<?php

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AuthController extends Controller
{
    public function registerShow() {
        return Inertia::render('Frontend/Register');
    }

    public function register(Request $request) {
        // Validation;
        $fields = $request->validate([
            'avatar' => ['nullable', 'file', 'max:300'],
            'name' => ['required', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed']
        ]);

        if ($request->hasFile('avatar')) {
            $file = $request->avatar;
            $fileName = time() . uniqid() . '.' . $file->getClientOriginalExtension();
            $fields['avatar'] = URL::to('uploads/avatars/'.$fileName);
            $file->move('uploads/avatars', $fileName);
        }

        // Register logic
        $user = User::create($fields);

        // Login
        Auth::login($user);

        // Redirect
        return redirect()->route('home')->with('message', 'Welcome to laravel inertia vue app');
    }

    public function loginShow() {
        return Inertia::render('Frontend/Login');
    }

    public function login(Request $request) {
        // Validation;
        $fields = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required']
        ]);

        if (Auth::attempt($fields, $request->remember)) {
            $request->session()->regenerate();
            return redirect()->intended('home');
        }

        return back()->withErrors([
            'email' => 'The provided credentials dose not match our records',
        ])->onlyInput('email');
    }

    public function logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('welcome');
    }
}
