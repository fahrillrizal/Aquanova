@extends('layouts.lg') <!-- Menggunakan layout yang sudah ada -->
@section('content')
    <div class="bg-gray-100 flex h-screen">
        <!-- Left Side: Image and Title (Visible on large screens) -->
        <div class="hidden lg:flex flex-col items-center justify-center w-1/2 bg-white p-10 relative">
            <div class="absolute top-12 left-12 m-[50px]">
                <h1 class="text-7xl bg-gradient-to-r from-[#6FCDF7] to-[#D3E2FF] bg-clip-text text-transparent font-semibold mb-4">AquaNova</h1>
                <p class="text-[32px] text-gray-700">where water quality meets <br> innovation</p>
            </div>
            <img src="{{ asset('assets/img/png/Subtract.png') }}" alt="Water Innovation Image" class="rounded-[60px] ml-20 object-cover w-full h-[95%]">
        </div>
        
        <!-- Right Side: Login Form -->
        <div class="flex items-center justify-center w-full lg:w-1/2 p-8 lg:p-20 bg-white">
            <div class="w-full max-w-md">
                <h1 class="text-4xl font-bold text-sky-400 mb-2">Welcome Back!</h1>
                <p class="text-lg text-sky-400 mb-6">Login to continue</p>

                @if ($errors->any())
                    <div class="mb-4">
                        <ul class="list-disc list-inside text-red-600">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('login') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label for="email" class="block text-gray-600 mb-1">Email</label>
                        <input type="email" id="email" name="email" class="w-full border border-gray-300 rounded-lg py-2 px-3 focus:outline-none focus:border-blue-500" placeholder="user123@gmail.com" value="{{ old('email') }}" required autocomplete="off">
                    </div>
                    <div class="mb-4 relative">
                        <label for="password" class="block text-gray-600 mb-1">Password</label>
                        <input type="password" id="password" name="password" class="w-full border border-gray-300 rounded-lg py-2 px-3 focus:outline-none focus:border-blue-500" placeholder="••••••••" required>
                        <ion-icon name="eye-off-outline" id="password-toggle" class="absolute text-sky-400 right-3 top-12 -translate-y-1/2 transform origin-center cursor-pointer"></ion-icon>
                    </div>
                    <div class="mb-4 flex items-center justify-between">
                        <div class="flex items-center">
                            <input type="checkbox" id="remember" name="remember" class="text-blue-500 mr-2">
                            <label for="remember" class="text-gray-600">Remember Me</label>
                        </div>
                        <a href="#" class="text-blue-500 hover:underline">Forgot password?</a>
                    </div>
                    <a href="{{ route('google.login') }}" class="flex items-center justify-center w-full py-2 bg-white border border-gray-300 text-gray-600 rounded-lg shadow-md hover:bg-gray-100 mb-4">
                        <img src="https://www.google.com/favicon.ico" alt="Google Icon" class="w-5 h-5 mr-2">
                        Masuk dengan Google
                    </a>
                    <button type="submit" class="w-full py-2 bg-white border border-gray-300 text-gray-600 rounded-lg shadow-md hover:bg-gray-100">Masuk</button>
                </form>
                <p class="mt-6 text-center text-gray-600">Belum memiliki akun? <a href="{{ route('regis') }}" class="text-blue-500 hover:underline">Daftar disini</a></p>
            </div>
        </div>
    </div>
@endsection
