@extends('layouts.app') <!-- Ganti dengan layout yang sesuai jika ada -->

@section('content')
    <div class="bg-gray-100 flex h-screen">
        <div class="flex items-center justify-center w-full lg:w-1/2 p-8 lg:p-20 bg-white">
            <div class="w-full max-w-md">
                <h1 class="text-4xl font-bold text-sky-400 mb-2">Forgot Your Password?</h1>
                <p class="text-lg text-sky-400 mb-6">We'll send you a link to reset your password</p>

                @if (session('status'))
                    <div class="mb-4 text-green-600">
                        {{ session('status') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="mb-4">
                        <ul class="list-disc list-inside text-red-600">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('password.email') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label for="email" class="block text-gray-600 mb-1">Email</label>
                        <input type="email" id="email" name="email" class="w-full border border-gray-300 rounded-lg py-2 px-3 focus:outline-none focus:border-blue-500" placeholder="user123@gmail.com" value="{{ old('email') }}" required>
                    </div>
                    <button type="submit" class="w-full py-2 bg-white border border-gray-300 text-gray-600 rounded-lg shadow-md hover:bg-gray-100">Send Password Reset Link</button>
                </form>
            </div>
        </div>
    </div>
@endsection
