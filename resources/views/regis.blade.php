@extends('layouts.lg')
@section('content')
<div class="bg-gray-100 flex h-screen">
    <!-- Left Side: Image and Title (Visible on large screens) -->
    <div class="hidden lg:flex flex-col items-center justify-center w-1/2 bg-white p-10 relative">
        <!-- Title Section -->
        <div class="absolute top-12 left-12 m-[50px]">
            <h1 class="text-7xl bg-gradient-to-r from-[#6FCDF7] to-[#D3E2FF] bg-clip-text text-transparent font-semibold mb-4">AquaNova</h1>
            <p class="text-[32px] text-gray-700">where water quality meets <br> innovation</p>
        </div>
        <!-- Image Section -->
        <img src="{{ asset('assets/img/png/Subtract.png') }}" alt="Water Innovation Image" class="rounded-[60px] ml-20 object-cover w-full h-[95%]">
    </div>

    <!-- Right Side: Register Form -->
    <div class="flex items-center justify-center w-full lg:w-1/2 p-8 lg:p-20 bg-white">
        <div class="w-full max-w-md">
            <!-- Welcome Title -->
            <h1 class="text-4xl font-bold text-sky-400 mb-2">Create Account</h1>
            <p class="text-lg text-sky-400 mb-6">Register to get started</p>

            <!-- Register Form -->
            <form action="{{ route('regis') }}" method="POST">
                @csrf
                <!-- Name -->
                <div class="mb-4">
                    <label for="name" class="block text-gray-600 mb-1">Name</label>
                    <input type="text" id="name" name="name" class="w-full border border-gray-300 rounded-lg py-2 px-3 focus:outline-none focus:border-blue-500" placeholder="John Doe" value="{{ old('name') }}" autocomplete="off">
                    @error('name')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Email -->
                <div class="mb-4">
                    <label for="email" class="block text-gray-600 mb-1">Email</label>
                    <input type="email" id="email" name="email" class="w-full border border-gray-300 rounded-lg py-2 px-3 focus:outline-none focus:border-blue-500" placeholder="user123@gmail.com" value="{{ old('email') }}" autocomplete="off">
                    @error('email')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Password -->
                <div class="mb-4 relative">
                    <label for="password" class="block text-gray-600 mb-1">Password</label>
                    <input type="password" id="password" name="password" class="w-full border border-gray-300 rounded-lg py-2 px-3 focus:outline-none focus:border-blue-500" placeholder="••••••••" autocomplete="off">
                    <ion-icon name="eye-off-outline" id="password-toggle1" class="absolute text-sky-400 right-3 top-12 -translate-y-1/2 transform origin-center cursor-pointer"></ion-icon>
                    @error('password')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Confirm Password -->
                <div class="mb-4 relative">
                    <label for="password_confirmation" class="block text-gray-600 mb-1">Confirm Password</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" class="w-full border border-gray-300 rounded-lg py-2 px-3 focus:outline-none focus:border-blue-500" placeholder="••••••••" autocomplete="off">
                    <ion-icon name="eye-off-outline" id="password-toggle2" class="absolute text-sky-400 right-3 top-12 -translate-y-1/2 transform origin-center cursor-pointer"></ion-icon>
                </div>

                <!-- Google Login Button -->
                <a href="{{ route('google.login') }}" class="flex items-center justify-center w-full py-2 bg-white border border-gray-300 text-gray-600 rounded-lg shadow-md hover:bg-gray-100 mb-4">
                    <img src="https://www.google.com/favicon.ico" alt="Google Icon" class="w-5 h-5 mr-2">
                    Login with Google
                </a>

                <!-- Submit Button -->
                <button type="submit" class="w-full py-2 bg-white border border-gray-300 text-gray-600 rounded-lg shadow-md hover:bg-gray-100">Register</button>
            </form>

            <!-- Login Link -->
            <p class="mt-6 text-center text-gray-600">Already have an account? <a href="{{ route('login') }}" class="text-blue-500 hover:underline">Login here</a></p>
        </div>
    </div>
</div>

@endsection
