@extends('layouts.nvprofile')

@section('content')
<!-- Container for Profile Section -->
<div class="relative w-full p-6 sm:p-5 lg:p-5">
    <!-- Background Image Section -->
    <div class="relative w-full h-60 lg:h-72 overflow-hidden rounded-t-lg">
        <img src="./assets/img/png/ab.png" alt="Background Image" class="w-full object-cover max-w-full">
    </div>

    <!-- "My Profile" Title -->
    <h1 class="absolute top-6 right-4 sm:top-12 sm:right-4 md:top-5 md:right-10 lg:top-[140px] lg:right-[140px] xl:top-12 xl:right-20 text-sky-400 font-bold"
    style="font-size: clamp(20px, 4vw, 60px);">
    My Profile
</h1>


    <!-- Profile Image and Info Section -->
    <div class="">
        <!-- Profile Image -->
        <div class="relative w-10 h-10 sm:w-[100px] sm:h-[100px] lg:w-40 lg:h-40 top-0 sm:top-[-40px] sm:left-[50px] md:top-[-170px] md:left-[50px] lg:top-[-140px] lg:left-[110px] rounded-full border-4 border-white overflow-hidden">
            <img src="{{ Auth::user()->foto ? asset('storage/pp/' . Auth::user()->foto) : asset('assets/img/png/profile.png') }}" alt="Profile Image" class="w-full h-full object-cover rounded-full">
            <button onclick="openModal('editPhotoModal')" class="absolute bottom-2 right-2 bg-white p-1 rounded-full border border-gray-300 shadow">
                <ion-icon name="pencil-outline" class="text-blue-500 hover:text-blue-600"></ion-icon>
            </button>
        </div>

        <!-- User Information -->
        <div class="relative text-xs sm:mt-[-215px] sm:ml-[170px] lg:left-[120px] lg:top-[10px]">
            <h2 class="text- sm:text-lg lg:text-2xl font-bold">{{ Auth::user()->name }}</h2>
            <p class="text-sm sm:text-sm lg:text-base text-gray-500">{{ Auth::user()->email }}</p>
        </div>
    </div>
</div>

<!-- Buttons for Google Connect and Logout -->
<div class="absolute sm:right-[60px] sm:top-[250px] lg:right-20 lg:top-[350px] flex space-x-4">
    <button class="bg-white border border-gray-300 hover:bg-gray-100 text-gray-700 font-semibold py-2 px-4 rounded shadow-sm flex items-center">
        <img src="https://www.google.com/favicon.ico" alt="Google Icon" class="w-5 h-5 mr-2">
        Connect with Google
    </button>
    <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button type="submit" class="bg-sky-400 hover:bg-sky-500 text-white font-semibold py-2 px-4 rounded shadow-sm">Logout</button>
    </form>
</div>

<!-- Form Section for Profile Info -->
<div class="container mx-auto mt-6 sm:mt-0 mb-0">
    <div class="p-6 rounded-lg">
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

        <div class="relative w-24 h-24 mx-auto overflow-hidden mb-4">
            <img id="photoPreview" src="{{ Auth::user()->foto ? asset('storage/pp/' . Auth::user()->foto) : asset('assets/profile.png') }}" alt="Profile Image" class="w-full h-full object-cover">
        </div>

        <div class="flex justify-center space-x-4 mb-4">
            <input type="file" id="photoInput" class="hidden" accept=".jpeg, .png, .jpg, .heic">
            <label for="photoInput" class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded shadow-md cursor-pointer">Choose Photo</label>
            @if(Auth::user()->foto)
            <form action="{{ route('profile.photo.delete') }}" method="POST">
                @csrf
                <button type="submit" class="bg-red-500 hover:bg-red-600 text-white py-2 px-4 rounded shadow-md">Delete</button>
            </form>
            @endif
            <button id="savePhotoButton" class="bg-green-500 hover:bg-green-600 text-white py-2 px-4 rounded shadow-md hidden" onclick="cropImage()">Save</button>
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

    let cropper;
    const input = document.getElementById('photoInput');
    const image = document.getElementById('photoPreview');
    const saveButton = document.getElementById('savePhotoButton');

    input.addEventListener('change', function(e) {
        const files = e.target.files;
        if (files && files.length > 0) {
            const file = files[0];
            const reader = new FileReader();
            reader.onload = function(event) {
                image.src = event.target.result;
                if (cropper) {
                    cropper.destroy();
                }
                cropper = new Cropper(image, {
                    aspectRatio: 1,
                    viewMode: 2,
                    autoCropArea: 1,
                    background: false,
                    cropBoxResizable: false,
                    minContainerWidth: 100,
                    minContainerHeight: 100,
                });
                saveButton.classList.remove('hidden');
            };
            reader.readAsDataURL(file);
        }
    });

    function cropImage() {
        if (!cropper) {
            console.error('Cropper not initialized');
            return;
        }

        const canvas = cropper.getCroppedCanvas({
            width: 300,
            height: 300,
            imageSmoothingEnabled: true,
            imageSmoothingQuality: 'high'
        });

        canvas.toBlob(function(blob) {
            const formData = new FormData();
            formData.append('photo', blob, 'profile.jpg');
            formData.append('_token', '{{ csrf_token() }}');
            fetch('{{ route("profile.photo.change") }}', {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                    },
                })
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'success') {
                        const profileImages = document.querySelectorAll('.profile-image');
                        profileImages.forEach(img => {
                            img.src = data.imageUrl + '?t=' + new Date().getTime();
                        });
            
                        closeModal('editPhotoModal');

                        // Update the main profile image
                        const mainProfileImage = document.querySelector('.relative.w-10.h-10 img');
                        if (mainProfileImage) {
                            mainProfileImage.src = data.imageUrl + '?t=' + new Date().getTime();
                        }

                        // Auto-refresh the page after a short delay
                        setTimeout(() => {
                            location.reload();
                        }, 1000);
                    } else {
                        showAlert('error', 'Failed to update profile photo');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    showAlert('error', 'An error occurred while updating the profile photo');
                });
        }, 'image/jpeg');
    }

    // function showAlert(type, message) {
    //     const alertElement = document.createElement('div');
    //     alertElement.textContent = message;
    //     alertElement.className = `alert alert-${type} fixed top-4 right-4 p-4 rounded shadow-lg z-50`;
    //     if (type === 'success') {
    //         alertElement.classList.add('bg-green-500', 'text-white');
    //     } else {
    //         alertElement.classList.add('bg-red-500', 'text-white');
    //     }
    //     document.body.appendChild(alertElement);

    //     setTimeout(() => {
    //         alertElement.remove();
    //     }, 3000);
    // }
</script>
@endsection