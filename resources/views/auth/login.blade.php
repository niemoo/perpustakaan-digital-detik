@extends('auth.layouts.authmain')
@section('title', 'Login')
@section('content')
    <section class="bg-teal-700 h-screen flex items-center md:p-0 p-5">
        <div class="flex items-center justify-center bg-white rounded-2xl mx-auto md:w-1/2 w-full shadow-xl overflow-hidden">
            <div class="md:w-1/2 px-10 md:block hidden">
                <img src="{{ asset('assets/registersvg.svg') }}" alt="register svg">
            </div>
            <div class="md:w-1/2 w-full bg-teal-800">
                <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                    <h1 class="text-xl font-bold leading-tight tracking-tight text-white md:text-2xl">
                        Login Akun
                    </h1>
                    <form class="grid gap-5" action="{{ route('signin') }}" method="POST">
                        @csrf
                        <div>
                            <label for="username" class="block mb-2 text-sm font-medium text-white">
                                Username</label>
                            <input type="text" name="username" id="username"
                                class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-400 focus:border-blue-400 block w-full p-2.5"
                                placeholder="Masukkan Username Anda">
                        </div>
                        <div>
                            <label for="password"
                                class="block mb-2 text-sm font-medium text-white">Password</label>
                            <input type="password" name="password" id="password" placeholder="Masukkan Password Anda"
                                class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-400 focus:border-blue-400 block w-full p-2.5">
                        </div>
                        <button type="submit"
                            class="w-full text-white bg-blue-400 hover:bg-blue-500 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-400 dark:hover:bg-blue-400 dark:focus:ring-blue-400">Sign
                            in</button>
                        <p class="text-sm text-white">
                            Belum punya akun? <a href="{{ route('auth.register') }}"
                                class="font-medium text-teal-200 hover:text-teal-400 underline">Daftar disini</a>
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
