<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\RedirectResponse;

class AuthController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function login_process(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required'
        ], [
            'email.required' => 'Email tidak boleh kosong.',
            'email.email' => 'Email yang dimasukkan tidak valid.',
            'password.required' => 'Password tidak boleh kosong.'
        ]);

        $email = $request->input('email');
        $password = $request->input('password');
        $remember = $request->has('remember') ? true : false;

        if ($validator->fails()) {
            return redirect('/login')
                ->withErrors($validator)
                ->withInput();
        } else if (Auth::attempt(
            [
                'email' => $email,
                'password' => $password
            ],
            $remember
        )) {
            $request->session()->regenerate();

            return redirect('/dashboard');
        } else {
            Session::flash('error', 'Login gagal. Pastikan informasi yang dimasukkan benar.');
            return redirect('/login')->withInput();
        }
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        Session::flash('success', 'Anda berhasil logout.');

        return redirect('/login');
    }
}
