@extends('layouts.lg')

@section('title', 'Login')

@section('content')

@if (session('success'))
<div id="alertregis" class="fixed inset-0 flex items-center justify-center z-50 bg-black bg-opacity-50 rounded-xl">
    <div class="relative p-4 w-full max-w-md">
        <div class="relative bg-white rounded-xl shadow">
            <div class="p-4 md:p-5 text-center">
                <img src="/assets/img/svg/ceklist.svg" alt="Success Checkmark" class="mx-auto mb-4 w-12 h-12" />
                <h3 class="mb-5 text-lg text-dark">{{ session('success') }}</h3>
            </div>
        </div>
    </div>
</div>
<script>
    setTimeout(() => {
        document.getElementById('alertregis').style.display = 'none';
    }, 1500);
</script>
@endif

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
    <div id="loginform" class="flex items-center justify-center w-full lg:w-1/2 p-8 lg:p-20 bg-white">
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
                    <ion-icon name="eye-off-outline" id="password-toggle1" class="absolute text-sky-400 right-3 top-12 -translate-y-1/2 transform origin-center cursor-pointer"></ion-icon>
                </div>
                <div class="mb-4 flex items-center justify-between">
                    <div class="flex items-center">
                        <input type="checkbox" id="remember" name="remember" class="text-blue-500 mr-2">
                        <label for="remember" class="text-gray-600">Remember Me</label>
                    </div>
                    <a href="{{ route('password.request') }}" class="text-blue-500 hover:underline">Forgot password?</a>
                </div>
                <a href="{{ route('auth.google') }}" class="flex items-center justify-center w-full py-2 bg-white border border-gray-300 text-gray-600 rounded-lg shadow-md hover:bg-gray-100 mb-4">
                    <img src="https://www.google.com/favicon.ico" alt="Google Icon" class="w-5 h-5 mr-2">
                    Login with Google
                </a>
                <button type="submit" class="w-full py-2 bg-white border border-gray-300 text-gray-600 rounded-lg shadow-md hover:bg-gray-100">Login</button>
            </form>
            <p class="mt-6 text-center text-gray-600">Don't have an account? <a href="{{ route('regis') }}" class="text-blue-500 hover:underline">Register here</a></p>
        </div>
    </div>
</div>
@endsection