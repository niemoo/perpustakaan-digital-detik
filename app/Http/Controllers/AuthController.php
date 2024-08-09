<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;
use Throwable;

class AuthController extends Controller
{
    public function register(RegisterUserRequest $request) {
        try {
            User::create([
                'name' => $request->validated('name'),
                'username' => $request->validated('username'),
                'email' => $request->validated('email'),
                'password' => Hash::make($request->validated('password')),
            ]);

            Alert::success('Success', 'Berhasil melakukan registrasi');
        } catch (Throwable $err) {
            Alert::error('Error', 'Gagal melakukan registrasi');
            return redirect()->back();
        }
    }

    public function login(Request $request) {
        $validator = Validator::make($request->all(), [
            'username' => 'required',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            Alert::toast('Username atau password salah', 'error');
            return redirect()->route('login');
        }

        $credentials = $request->only('username', 'password');

        // Cek kredensial
        if (Auth::attempt($credentials)) {
            // Autentikasi berhasil
            Alert::success('Success', 'Berhasil login');
            return redirect()->route('dashboard');
        } else {
            // Autentikasi gagal
            Alert::toast('Username atau password salah', 'error');
            return redirect()->route('login');
        }
    }
}
