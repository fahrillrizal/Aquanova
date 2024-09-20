@extends('layouts.app') <!-- Ganti dengan layout yang sesuai jika ada -->

@section('content')
    <div class="bg-gray-100 flex h-screen">
        <div class="flex items-center justify-center w-full lg:w-1/2 p-8 lg:p-20 bg-white">
            <div class="w-full max-w-md">
                <h1 class="text-4xl font-bold text-sky-400 mb-6">Reset Password</h1>

                @if ($errors->any())
                    <div class="mb-4">
                        <ul class="list-disc list-inside text-red-600">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('password.update') }}">
                    @csrf
                    <input type="hidden" name="token" value="{{ $token }}">

                    <div class="mb-4">
                        <label for="email" class="block text-gray-600 mb-1">Email</label>
                        <input id="email" type="email" name="email" class="w-full border border-gray-300 rounded-lg py-2 px-3 focus:outline-none focus:border-blue-500" value="{{ old('email', $email) }}" required autofocus>
                    </div>

                    <div class="mb-4">
                        <label for="password" class="block text-gray-600 mb-1">New Password</label>
                        <input id="password" type="password" name="password" class="w-full border border-gray-300 rounded-lg py-2 px-3 focus:outline-none focus:border-blue-500" required>
                    </div>

                    <div class="mb-4">
                        <label for="password_confirmation" class="block text-gray-600 mb-1">Confirm Password</label>
                        <input id="password_confirmation" type="password" name="password_confirmation" class="w-full border border-gray-300 rounded-lg py-2 px-3 focus:outline-none focus:border-blue-500" required>
                    </div>

                    <div>
                        <button type="submit" class="w-full py-2 bg-blue-500 text-white rounded-lg">Reset Password</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
