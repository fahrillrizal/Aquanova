@extends('layouts.app')

@section('content')
<!-- Container for Profile Section -->
<div class="relative w-full p-6 lg:p-5">
    <!-- Background Image Section -->
    <div class="relative w-full h-60 lg:h-72 overflow-hidden rounded-t-lg">
        <img src="./assets/ab.png" alt="Background Image" class="w-full object-cover">
    </div>

    <!-- "My Profile" Title -->
    <h1 class="absolute top-6 right-4 sm:top-10 sm:right-8 md:top-5 md:right-10 lg:top-140 lg:right-140 xl:top-12 xl:right-20 text-sky-400 font-bold"
        style="font-size: clamp(20px, 5vw, 60px);">
        My Profile
    </h1>

    <!-- Profile Image and Info Section -->
    <div class="relative flex items-center space-x-4">
        <!-- Profile Image -->
        <div class="relative w-24 h-24 sm:w-32 sm:h-32 lg:w-40 lg:h-40 rounded-full border-4 border-white overflow-hidden">
            <img src="{{ Auth::user()->foto ? asset('storage/pp/' . Auth::user()->foto) : asset('assets/profile.png') }}" alt="Profile Image" class="w-full h-full object-cover rounded-full">
        </div>

        <!-- User Information -->
        <div class="relative">
            <h2 class="text-lg lg:text-2xl font-bold">{{ Auth::user()->name }}</h2>
            <button onclick="openModal('editPhotoModal')">
                <ion-icon name="pencil-outline" class="text-blue-500 hover:text-blue-600"></ion-icon> Edit
            </button>
            <p class="text-sm lg:text-base text-gray-500">{{ Auth::user()->email }}</p>
        </div>
    </div>
</div>

<!-- Buttons for Google Connect and Logout -->
<div class="absolute sm:right-[30px] sm:top-[160px] lg:right-20 lg:top-[350px] flex space-x-4">
    <button class="bg-white border border-gray-300 hover:bg-gray-100 text-gray-700 font-semibold py-2 px-4 rounded shadow-sm flex items-center">
        <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/5/53/Google_%22G%22_Logo.svg/512px-Google_%22G%22_Logo.svg.png" alt="Google Icon" class="w-5 h-5 mr-2">
        Connect with Google
    </button>
    <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button type="submit" class="bg-sky-400 hover:bg-sky-500 text-white font-semibold py-2 px-4 rounded shadow-sm">Logout</button>
    </form>
</div>

<!-- Form Section for Profile Info -->
<div class="container mx-auto mt-6">
    <div class="p-6 rounded-lg bg-white shadow">
        <form class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block font-semibold text-gray-600">Full Name</label>
                <input type="text" value="{{ Auth::user()->full_name ?? '-' }}" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none" readonly>
            </div>
            <div>
                <label class="block font-semibold text-gray-600">Nick Name</label>
                <input type="text" value="{{ Auth::user()->name ?? '-' }}" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none" readonly>
            </div>
            <div>
                <label class="block font-semibold text-gray-600">Address</label>
                <input type="text" value="{{ Auth::user()->address ?? '-' }}" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none" readonly>
            </div>
            <div>
                <label class="block font-semibold text-gray-600">Phone Number</label>
                <input type="text" value="{{ Auth::user()->hp ?? '-' }}" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none" readonly>
            </div>
        </form>

        <!-- Buttons Section -->
        <div class="flex justify-end space-x-4 mt-6">
            <button class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded shadow-md" onclick="openModal('changePasswordModal')">
                Change Password
            </button>
            <button class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded shadow-md" onclick="openModal('editProfileModal')">
                Edit
            </button>
        </div>
    </div>
</div>

<!-- Modals -->
<!-- Edit Photo Modal -->
<div id="editPhotoModal" class="fixed inset-0 bg-gray-900 bg-opacity-50 hidden items-center justify-center">
    <div class="bg-white p-6 rounded-lg shadow-lg">
        <h2 class="text-lg font-bold mb-4">Edit Profile Photo</h2>

        <!-- Profile Image -->
        <div class="relative w-24 h-24 sm:w-32 sm:h-32 lg:w-40 lg:h-40 mx-auto rounded-full border-4 border-gray-300 overflow-hidden mb-4">
            <img src="{{ Auth::user()->foto ? asset('storage/pp/' . Auth::user()->foto) : asset('assets/profile.png') }}" alt="Profile Image" class="w-full h-full object-cover rounded-full">
        </div>

        <!-- Buttons for Change/Delete -->
        <div class="flex justify-center space-x-4 mb-4">
            <form action="{{ route('profile.photo.change') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <label for="photo" class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded shadow-md cursor-pointer">Change</label>
                <input type="file" id="photo" name="photo" class="hidden" onchange="this.form.submit()">
            </form>

            @if(Auth::user()->foto)
            <form action="{{ route('profile.photo.delete') }}" method="POST">
                @csrf
                <button type="submit" class="bg-red-500 hover:bg-red-600 text-white py-2 px-4 rounded shadow-md">Delete</button>
            </form>
            @endif
        </div>
        <div class="mt-4 text-center">
            <button class="bg-gray-500 hover:bg-gray-600 text-white py-2 px-4 rounded" onclick="closeModal('editPhotoModal')">Cancel</button>
        </div>
    </div>
</div>


<!-- Edit Profile Modal -->
<div id="editProfileModal" class="fixed inset-0 bg-gray-900 bg-opacity-50 hidden items-center justify-center">
    <div class="bg-white p-6 rounded-lg shadow-lg">
        <h2 class="text-lg font-bold mb-4">Edit Profile</h2>
        <form action="{{ route('profile.update') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Full Name</label>
                <input type="text" name="full_name" value="{{ Auth::user()->full_name }}" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md">
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Nick Name</label>
                <input type="text" name="nickname" value="{{ Auth::user()->name }}" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md">
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Address</label>
                <input type="text" name="address" value="{{ Auth::user()->address }}" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md">
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Phone Number</label>
                <input type="text" name="hp" value="{{ Auth::user()->hp }}" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md">
            </div>
            <div class="flex justify-end space-x-4">
                <button type="button" onclick="closeModal('editProfileModal')" class="bg-gray-500 hover:bg-gray-600 text-white py-2 px-4 rounded">Cancel</button>
                <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded">Save Changes</button>
            </div>
        </form>
    </div>
</div>

<!-- Change Password Modal -->
<div id="changePasswordModal" class="fixed inset-0 bg-gray-900 bg-opacity-50 hidden items-center justify-center">
    <div class="bg-white p-6 rounded-lg shadow-lg">
        <h2 class="text-lg font-bold mb-4">Change Password</h2>
        <form action="{{ route('password.update') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Current Password</label>
                <input type="password" name="current_password" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md">
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">New Password</label>
                <input type="password" name="new_password" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md">
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Confirm New Password</label>
                <input type="password" name="new_password_confirmation" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md">
            </div>
            <div class="flex justify-end space-x-4">
                <button type="button" onclick="closeModal('changePasswordModal')" class="bg-gray-500 hover:bg-gray-600 text-white py-2 px-4 rounded">Cancel</button>
                <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded">Save Changes</button>
            </div>
        </form>
    </div>
</div>

<script>
    function openModal(modalId) {
        document.getElementById(modalId).classList.remove('hidden');
    }

    function closeModal(modalId) {
        document.getElementById(modalId).classList.add('hidden');
    }
</script>
@endsection