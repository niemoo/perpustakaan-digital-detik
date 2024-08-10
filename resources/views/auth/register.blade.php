@extends('auth.layouts.authmain')
@section('title', 'Register')
@section('content')
    <section class="bg-teal-700 h-screen flex items-center md:p-0 p-5">
        <div class="flex items-center justify-center bg-white rounded-2xl mx-auto md:w-1/2 w-full shadow-xl overflow-hidden">
            <div class="md:w-1/2 px-10 md:block hidden">
                <img src="{{ asset('assets/registersvg.svg') }}" alt="register svg">
            </div>
            <div class="md:w-1/2 w-full bg-teal-800">
                <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                    <h1 class="text-xl font-bold md:text-2xl text-white">
                        Pendaftaran Akun
                    </h1>
                    <form class="grid gap-5" action="{{route('signup')}}" method="POST">
                        @csrf
                        <div>
                            <label for="name" class="text-sm font-medium text-white">Nama Lengkap</label>
                            <input type="text" name="name" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-400 focus:border-blue-400 block w-full p-2.5 @error('name') is-invalid @enderror" placeholder="Masukkan Nama Lengkap Anda">
                            @error('name')
                                <div class="mt-2 text-sm text-white">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div>
                            <label for="username" class="text-sm font-medium text-white">Username</label>
                            <input type="text" name="username" id="username"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-400 focus:border-blue-400 block w-full p-2.5 @error('username') is-invalid @enderror"
                                placeholder="Masukkan Username Anda">
                            @error('username')
                                <div class="mt-2 text-sm text-white">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div>
                            <label for="email" class="text-sm font-medium text-white">Email</label>
                            <input type="email" name="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-400 focus:border-blue-400 block w-full p-2.5 @error('email') is-invalid @enderror" placeholder="Masukkan Email Anda">
                            @error('email')
                                <div class="mt-2 text-sm text-white">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div>
                            <label for="password"class="text-sm font-medium text-white">Password</label>
                            <input type="password" name="password" id="password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 @error('password') is-invalid @enderror" placeholder="Masukkan Password Anda">
                            @error('password')
                                <div class="mt-2 text-sm text-white">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <button type="submit" class="w-full text-white bg-teal-500 hover:bg-teal-600 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Daftar</button>
                        <p class="text-sm text-white">Sudah punya akun? <a href="{{ route('auth.login') }}" class="font-medium text-teal-200 hover:text-teal-400 underline">Login disini</a></p>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
