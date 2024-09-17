@extends('layouts.app') <!-- Menggunakan layout yang sudah ada -->
@section('content')
    <!-- Container for Profile Section -->
    <div class="relative w-full p-6 lg:p-5">
        <!-- Background Image Section -->
        <div class="relative w-full h-60 lg:h-72 overflow-hidden rounded-t-lg">
            <source srcset="./img/tmobaile.png" media="(min-width: 640px)">
            <img src="./assets/ab.png" alt="Background Image" class="w-full object-cover">
        </div>
    
        <!-- "My Profile" Title -->
        <h1 class="absolute top-6 right-4 sm:top-10 sm:right-8 md:top-5 md:right-10 lg:top-140 lg:right-140 xl:top-12 xl:right-20 text-sky-400 font-bold"
            style="font-size: clamp(20px, 5vw, 60px);">
            My Profile
        </h1>
    
        <!-- Profile Image and Info Section -->
        <div class="">
            <!-- Profile Image --> 
            <div class="relative w-10 h-10 sm:w-[100px] sm:h-[100px] lg:w-40 lg:h-40 top-0 sm:top-[-40px] sm:left-[50px] md:top-[-170px] md:left-[50px] lg:top-[-140px] lg:left-[120px] rounded-full border-4 border-white overflow-hidden">
                <img src="./assets/profile.png" alt="Profile Image" class="w-full h-full object-cover rounded-full">
            </div>
        
            <!-- User Information -->
            <div class="relative text-xs sm:mt-[-215px] sm:ml-[170px] lg:left-[180px] lg:top-[10px]">
                <h2 class="text- sm:text-lg lg:text-2xl font-bold">Alexa Rawles</h2>
                <p class="text-sm sm:text-sm lg:text-base text-gray-500">alexarawles@gmail.com</p>
            </div>
        </div>
    </div>
    
    </div>

     <!-- Google Connect and Logout Buttons -->
        <div class="absolute sm:right-[30px] sm:top-[160px] lg:right-20 lg:top-[350px] flex space-x-4">
            <button class="bg-white border border-gray-300 hover:bg-gray-100 text-gray-700 font-semibold py-2 px-4 rounded shadow-sm flex items-center">
                <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/5/53/Google_%22G%22_Logo.svg/512px-Google_%22G%22_Logo.svg.png" alt="Google Icon" class="w-5 h-5 mr-2">
                Connect with Email
            </button>
            <button class="bg-sky-400 hover:bg-sky-500 text-white font-semibold py-2 px-4 rounded shadow-sm">Logout</button>
    </div>

    <!-- Form Section -->
    <div class="container mx-auto">
        <div class="p-6 rounded-lg top-[-1000px]">
            <form class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <!-- Full Name Input -->
                <div>
                    <label class="block font-semibold text-gray-600">Full Name</label>
                    <input type="text" placeholder="Your First Name" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-sky-500 focus:border-sky-500">
                </div>
                
                <!-- Nick Name Input -->
                <div>
                    <label class="block font-semibold text-gray-600">Nick Name</label>
                    <input type="text" placeholder="Your First Name" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-sky-500 focus:border-sky-500">
                </div>
                
                <!-- Address Input -->
                <div>
                    <label class="block font-semibold text-gray-600">Address</label>
                    <input type="text" placeholder="Your First Name" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-sky-500 focus:border-sky-500">
                </div>
                
                <!-- Phone Number Input -->
                <div>
                    <label class="block font-semibold text-gray-600">Phone Number</label>
                    <input type="text" placeholder="Your First Name" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-sky-500 focus:border-sky-500">
                </div>
            </form>

            <!-- Buttons Section -->
            <div class="flex justify-end space-x-4 mt-6">
                <button class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded shadow-md">
                    Change Password
                </button>
                <button class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded shadow-md">
                    Edit
                </button>
            </div>
        </div>
    </div>
    @endsection