<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('pages.login');
    }
    
    public function login(Request $request)
    {
        $validated = $request->validate([
            'gmail' => ['required', 'email'],
            'password' => ['required', 'string'],
        ], [
            'gmail.required' => 'جیمیل الزامی است.',
            'gmail.email' => 'جیمیل واردشده معتبر نیست.',
            'password.required' => 'رمز عبور الزامی است.',
        ]);

        $remember = $request->boolean('remember');

        if (Auth::attempt([
            'gmail' => $validated['gmail'],
            'password' => $validated['password'],
        ], $remember)) {

            $request->session()->regenerate();

            return response()->json([
                'success' => true,
                'message' => 'ورود با موفقیت انجام شد.',
                'redirect' => route('admin.dashboard'),
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'جیمیل یا رمز عبور اشتباه است.',
        ], 422);
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}