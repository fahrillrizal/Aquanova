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

<!-- Modals Edit Profile -->
<div id="editProfileModal" tabindex="-1" aria-hidden="true" class="hidden fixed top-0 left-0 z-50 w-full h-full flex items-center justify-center">
    <div class="fixed inset-0 bg-black bg-opacity-50"></div>
    <div class="relative p-4 w-full max-w-md max-h-full z-10">
        <div class="relative bg-white rounded-lg shadow white:bg-white-700">
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                <h3 class="text-xl text-center font-semibold text-dark-900 dark:text-dark">
                    Edit Profile
                </h3>
            </div>
            <div class="p-4 md:p-5">
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
                        <button type="button" onclick="closeModal('editProfileModal')" class="bg-red-500 hover:bg-red-600 text-white py-2 px-4 rounded">Cancel</button>
                        <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- modals Edit Profile Image-->
<div id="editPhotoModal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 z-50 items-center justify-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full flex shadow">
    <div class="fixed inset-0 bg-black bg-opacity-50"></div>
    <div class="relative p-4 w-full max-w-md max-h-full z-10">
        <div class="relative bg-white rounded-lg shadow white:bg-white-700">
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-dark-600">
                <h3 class="text-xl font-semibold text-dark-900 dark:text-dark">
                    Edit Profile Image
                </h3>
                <button type="button" class="end-2.5 text-dark-400 bg-transparent hover:bg-white-200 hover:text-white-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" onclick="closeModal('editPhotoModal')">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <div class="p-4 md:p-5">
                <form class="space-y-4" action="#">
                    <div class="relative w-24 h-24 mx-auto overflow-hidden mb-4">
                        <img id="photoPreview" src="{{ Auth::user()->foto ? asset('storage/pp/' . Auth::user()->foto) : asset('assets/profile.png') }}" alt="Profile Image" class="w-full h-full object-cover">
                    </div>
                    <div id="fileButtons" class="flex flex-col items-center mb-4">
                        <input type="file" id="photoInput" class="hidden" accept=".jpeg, .png, .jpg, .heic">
                        <label for="photoInput" class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded shadow-md cursor-pointer mb-3">Choose Photo</label>
                        @if(Auth::user()->foto)
                        <form action="{{ route('profile.photo.delete') }}" method="POST" class="mt-6">
                            @csrf
                            <button type="submit" class="bg-red-500 hover:bg-red-600 text-white py-2 px-4 rounded shadow-md">Delete</button>
                        </form>
                        @endif
                    </div>
                    <div id="actionButtons" class="flex justify-center space-x-4 mb-4 hidden">
                        <button id="cancelPhotoButton" class="bg-red-500 hover:bg-red-600 text-white py-2 px-4 rounded shadow-md" onclick="cancelPhoto()">Cancel</button>
                        <button id="savePhotoButton" class="bg-green-500 hover:bg-green-600 text-white py-2 px-4 rounded shadow-md" onclick="cropImage()">Save</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
</div>
</div>

<!-- Baru Change Password Modal -->
<div id="changePasswordModal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 z-50 items-center justify-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full flex shadow">
    <div class="fixed inset-0 bg-black bg-opacity-50"></div>
    <div class="relative p-4 w-full max-w-md max-h-full z-10">
        <div class="relative bg-white rounded-lg shadow white:bg-white-700">
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-dark-600">
                <h3 class="text-xl font-semibold text-dark-900 dark:text-dark">
                    Edit Profile Image
                </h3>
                <button type="button" class="end-2.5 text-dark-400 bg-transparent hover:bg-white-200 hover:text-white-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" onclick="closeModal('changePasswordModal')">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <div class="p-4 md:p-5">
                <form action="{{ route('password.update') }}" method="POST">
                    @csrf
                    <div class="mb-4 relative">
                        <label class="block text-sm font-medium text-gray-700">Current Password</label>
                        <input type="password" id="current_password" name="current_password" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md" placeholder="••••••••" autocomplete="off">
                        <ion-icon name="eye-off-outline" id="password-toggle1" class="absolute text-sky-400 right-3 top-12 -translate-y-1/2 transform origin-center cursor-pointer"></ion-icon>
                    </div>
                    <div class="mb-4 relative">
                        <label class="block text-sm font-medium text-gray-700">New Password</label>
                        <input type="password" id="new_password" name="new_password" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md" placeholder="••••••••" autocomplete="off">
                        <ion-icon name="eye-off-outline" id="password-toggle2" class="absolute text-sky-400 right-3 top-12 -translate-y-1/2 transform origin-center cursor-pointer"></ion-icon>
                    </div>
                    <div class="mb-4 relative">
                        <label class="block text-sm font-medium text-gray-700">Confirm New Password</label>
                        <input type="password" id="new_password_confirmation" name="new_password_confirmation" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md" placeholder="••••••••" autocomplete="off">
                        <ion-icon name="eye-off-outline" id="password-toggle3" class="absolute text-sky-400 right-3 top-12 -translate-y-1/2 transform origin-center cursor-pointer"></ion-icon>
                    </div>

                    <div class="flex justify-end space-x-4">
                        <button type="button" onclick="closeModal('changePasswordModal')" class="bg-red-500 hover:bg-red-600 text-white py-2 px-4 rounded">Cancel</button>
                        <button type="submit" class="bg-green-500 hover:bg-green-600 text-white py-2 px-4 rounded">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
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
    const actionButtons = document.getElementById('actionButtons');
    const fileButtons = document.getElementById('fileButtons');

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

                fileButtons.classList.add('hidden');
                actionButtons.classList.remove('hidden');
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

    function cancelPhoto() {
        // Reset the photo input and preview
        input.value = '';
        image.src = "{{ Auth::user()->foto ? asset('storage/pp/' . Auth::user()->foto) : asset('assets/profile.png') }}"; // Reset to default image

        // Show file buttons and hide action buttons
        fileButtons.classList.remove('hidden');
        actionButtons.classList.add('hidden');

        if (cropper) {
            cropper.destroy();
            cropper = null;
        }
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
<script>
    const currentPasswordInput = document.getElementById("current_password");
    const currentPasswordToggle = document.getElementById("password-toggle1");

    currentPasswordToggle.addEventListener("click", () => {
        if (currentPasswordInput.type === "password") {
            currentPasswordInput.type = "text";
            currentPasswordToggle.setAttribute("name", "eye-outline");
        } else {
            currentPasswordInput.type = "password";
            currentPasswordToggle.setAttribute("name", "eye-off-outline");
        }
    });

    const newPasswordInput = document.getElementById("new_password");
    const newPasswordToggle = document.getElementById("password-toggle2");

    newPasswordToggle.addEventListener("click", () => {
        if (newPasswordInput.type === "password") {
            newPasswordInput.type = "text";
            newPasswordToggle.setAttribute("name", "eye-outline");
        } else {
            newPasswordInput.type = "password";
            newPasswordToggle.setAttribute("name", "eye-off-outline");
        }
    });
    const confirmPasswordInput = document.getElementById("new_password_confirmation");
    const confirmPasswordToggle = document.getElementById("password-toggle3");

    confirmPasswordToggle.addEventListener("click", () => {
        if (confirmPasswordInput.type === "password") {
            confirmPasswordInput.type = "text";
            confirmPasswordToggle.setAttribute("name", "eye-outline");
        } else {
            confirmPasswordInput.type = "password";
            confirmPasswordToggle.setAttribute("name", "eye-off-outline");
        }
    });
</script>
@endsection