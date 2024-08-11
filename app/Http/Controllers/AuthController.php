<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterUserRequest;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class AuthController extends Controller
{
    public function login()
    {
        if (Auth::check()) {
            return redirect('/dashboard');
        }else{
            return view('auth.login');
        }
    }

    public function register() {
        return view('auth.register');
    }

    public function store(RegisterUserRequest $request)
    {
        try {
            User::create([
                'name' => $request->validated('name'),
                'username' => $request->validated('username'),
                'email' => $request->validated('email'),
                'password' => Hash::make($request->validated('password')),
            ]);

            Alert::success('Success', 'Berhasil melakukan registrasi');
            return redirect()->route('auth.login');
        } catch (\Throwable $err) {
            Alert::error('Error', 'Gagal melakukan registrasi. Silahkan coba lagi.');
            return redirect()->back();
        }
    }

    public function actionLogin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            Alert::toast('Username atau password salah', 'error');
            return redirect()->route('auth.login');
        }

        $credentials = $request->only('username', 'password');

        // Cek kredensial
        if (Auth::attempt($credentials)) {
            // Autentikasi berhasil
            Alert::success('Success', 'Berhasil login');
            return redirect()->route('dashboard.dashboard');
        } else {
            // Autentikasi gagal
            Alert::toast('Username atau password salah', 'error');
            return redirect()->route('auth.login');
        }
    }

    public function logout()
    {
        Auth::logout();
        Alert::toast('Anda berhasil logout', 'success');
        return redirect()->route('auth.login');
    }
}
