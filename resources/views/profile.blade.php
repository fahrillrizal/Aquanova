@extends('layouts.app')

@section('title', 'Profile')

@section('content')
    <div id="skeleton" class="w-full">
        <div class="animate-pulse grid grid-cols-1">
            <div class="h-60 bg-gray-100 rounded-xl mt-4 w-full"></div>
            <div class="grid grid-cols-2 gap-4 my-10">
                <div class="h-12 bg-gray-100 rounded-xl "></div>
                <div class="h-12 bg-gray-100 rounded-xl "></div>
                <div class="h-12 bg-gray-100 rounded-xl "></div>
                <div class="h-12 bg-gray-100 rounded-xl "></div>
            </div>
            <div class="flex justify-end items-end gap-24">
                <div class="h-10 bg-gray-100 rounded-xl mt-4 w-20 mx-10"></div>
                <div class="h-10 bg-gray-100 rounded-xl mt-4 w-20"></div>
            </div>
        </div>
    </div>

    <div id="content" class="hidden">
        <!-- Tampilan Mobile-->
        <div class="block md:hidden bg-white w-full max-w-sm rounded-lg p-0 mt-5">
            <div class="text-center mb-5">

                <!-- Background Image Section -->
                <div class="h-24 w-[100%] bg-cover bg-center rounded-t-lg">
                    <img class="" src="./assets/img/svg/inibg.svg" alt="">
                </div>

                <!-- Profile Image -->
                <div class="w-20 h-20 justify-center rounded-full mx-auto -mt-6">
                    <img src="{{ Auth::user()->foto ? asset('storage/pp/' . Auth::user()->foto) : asset('assets/img/png/profile.png') }}"
                        alt="Profile Image" class="w-full h-full object-cover rounded-full">
                    <button onclick="openModal('editPhotoModal')"
                        class="absolute top-[-100] right-50 transform translate-x-1/2 -translate-y-1/2 w-8 h-8 bg-white p-2 rounded-full border border-gray-300 shadow">
                        <ion-icon name="pencil-outline" class="text-blue-500 hover:text-blue-600 rounded-full"></ion-icon>
                    </button>
                </div>

                <!-- User Information -->
                <h2 class="mt-4 text-xl font-semibold">{{ Auth::user()->name }}</h2>
                <p class="text-gray-500">{{ Auth::user()->email }}</p>
            </div>

            <!-- Buttons for Google Connect and Logout -->
            <div class="flex justify-end space-x-4 mb-6">
            @if (auth()->user()->google_id === null)
                <button
                    class="bg-white border border-gray-300 hover:bg-gray-100 text-gray-700 font-semibold py-2 px-3 rounded-lg flex items-center">
                    <img src="https://www.svgrepo.com/show/355037/google.svg" alt="Google Icon" class="w-4 h-4 mr-2">
                    Connect with Email
                </button>
            @endif
                <form id="logoutForm" action="{{ route('logout') }}" method="POST" class="flex">
                    @csrf
                    <button id="lg"
                        class="bg-sky-400 hover:bg-sky-500 text-white font-semibold py-2 px-3 rounded-lg">
                        Logout
                    </button>
                </form>
            </div>
        </div>

        <!-- Tampilan Dekstop -->

        <!-- Container for Profile Section -->
        <div class="relative hidden md:block w-full p-5 sm:p-5 lg:p-5">
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
                <div
                    class="relative w-10 h-10 sm:w-[100px] sm:h-[100px] lg:w-40 lg:h-40 top-0 sm:top-[-40px] sm:left-[50px] md:top-[-170px] md:left-[50px] lg:top-[-140px] lg:left-[110px] rounded-full border-4 border-white overflow-hidden">
                    <img src="{{ Auth::user()->foto ? asset('storage/pp/' . Auth::user()->foto) : asset('assets/img/png/profile.png') }}"
                        alt="Profile Image" class="w-full h-full object-cover rounded-full">
                    <button onclick="openModal('editPhotoModal')"
                        class="absolute bottom-2 right-2 bg-white p-1 rounded-full border border-gray-300 shadow">
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
        <div class="absolute sm:right-[60px] sm:top-[250px] lg:right-20 lg:top-[350px] flex space-x-4 hidden sm:flex">
        @if (auth()->user()->google_id === null)
        <button
            class="bg-white border border-gray-300 hover:bg-gray-100 text-gray-700 font-semibold py-2 px-4 rounded shadow-sm flex items-center"
            onclick="window.location.href='{{ route('auth.google') }}'">
            <img src="https://www.google.com/favicon.ico" alt="Google Icon" class="w-5 h-5 mr-2">
            Connect with Google
        </button>
        @endif
            <form id="logoutForm" action="{{ route('logout') }}" method="POST">
                @csrf
                <button id="lg" type="submit"
                    class="bg-sky-400 hover:bg-sky-500 text-white font-semibold py-2 px-4 rounded shadow-sm">Logout</button>
            </form>
        </div>

        <!-- Form Section for Profile Info -->
        <div class="container mx-auto mt-6 sm:mt-0 mb-0">
            <div class="p-6 rounded-lg">
                <form class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block font-semibold text-gray-600">Full Name</label>
                        <input type="text" value="{{ Auth::user()->full_name ?? '-' }}"
                            class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none"
                            readonly>
                    </div>
                    <div>
                        <label class="block font-semibold text-gray-600">Nick Name</label>
                        <input type="text" value="{{ Auth::user()->name ?? '-' }}"
                            class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none"
                            readonly>
                    </div>
                    <div>
                        <label class="block font-semibold text-gray-600">Address</label>
                        <input type="text" value="{{ Auth::user()->address ?? '-' }}"
                            class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none"
                            readonly>
                    </div>
                    <div>
                        <label class="block font-semibold text-gray-600">Phone Number</label>
                        <input type="text" value="{{ Auth::user()->hp ?? '-' }}"
                            class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none"
                            readonly>
                    </div>
                </form>

                <!-- Buttons Section -->
                <div class="flex justify-end space-x-4 mt-6">
                    <button class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded shadow-md"
                        onclick="openModal('changePasswordModal')">
                        Change Password
                    </button>
                    <button class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded shadow-md"
                        onclick="openModal('editProfileModal')">
                        Edit
                    </button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modals Edit Profile -->
    <div id="editProfileModal" tabindex="-1" aria-hidden="true"
        class="hidden fixed top-0 left-0 z-50 w-full h-full flex items-center justify-center">
        <div class="fixed inset-0 bg-black bg-opacity-50"></div>
        <div class="relative p-4 w-full max-w-md max-h-full z-10">
            <div class="relative bg-white rounded-lg shadow white:bg-white-700">
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-xl text-center font-semibold text-dark-900 dark:text-dark">
                        Edit Profile
                    </h3>
                </div>
                <div class="p-4 md:p-5">
                    <form id="editProfileForm" action="{{ route('profile.update') }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700">Full Name</label>
                            <input type="text" name="full_name" value="{{ Auth::user()->full_name }}"
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md">
                        </div>
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700">Nick Name</label>
                            <input type="text" name="nickname" value="{{ Auth::user()->name }}"
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md">
                        </div>
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700">Address</label>
                            <input type="text" name="address" value="{{ Auth::user()->address }}"
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md">
                        </div>
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700">Phone Number</label>
                            <input type="text" name="hp" value="{{ Auth::user()->hp }}"
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md">
                        </div>
                        <div class="flex justify-end space-x-4">
                            <button type="button" onclick="closeModal('editProfileModal')"
                                class="bg-red-500 hover:bg-red-600 text-white py-2 px-4 rounded">Cancel</button>
                            <button type="submit" id="submit"
                                class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded">Save
                                Changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- modals Edit Profile Image-->
    <div id="editPhotoModal" tabindex="-1" aria-hidden="true"
        class="hidden fixed inset-0 z-50 flex items-center justify-center overflow-y-auto overflow-x-hidden bg-black bg-opacity-50">
        <div class="fixed inset-0 bg-black bg-opacity-50"></div>
        <div class="relative p-4 w-full max-w-md max-h-full z-10">
            <div class="relative bg-white rounded-lg shadow white:bg-white-700">
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-dark-600">
                    <h3 class="text-xl font-semibold text-dark-900 dark:text-dark">
                        Edit Profile Image
                    </h3>
                    <button type="button"
                        class="end-2.5 text-dark-400 bg-transparent hover:bg-white-200 hover:text-white-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                        onclick="closeModal('editPhotoModal')">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <div class="p-4 md:p-5">
                    <form class="space-y-4" action="#">
                        <div class="relative w-24 h-24 mx-auto overflow-hidden mb-4">
                            <img id="photoPreview"
                                src="{{ Auth::user()->foto ? asset('storage/pp/' . Auth::user()->foto) : asset('assets/img/png/profile.png') }}"
                                alt="Profile Image" class="w-full h-full object-cover">
                        </div>
                        <div id="fileButtons" class="flex flex-col items-center mb-4">
                            <input type="file" id="photoInput" class="hidden" accept=".jpeg, .png, .jpg, .heic">
                            <label for="photoInput"
                                class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded shadow-md cursor-pointer mb-3">Choose
                                Photo</label>
                            @if (Auth::user()->foto)
                                <button type="button" id="deletePhotoBtn"
                                    class="bg-red-500 hover:bg-red-600 text-white py-2 px-4 rounded shadow-md">
                                    Delete Photo
                                </button>
                            @endif
                        </div>
                        <div id="actionButtons" class="flex justify-center space-x-4 mb-4 hidden">
                            <button id="cancelPhotoButton" type="button"
                                class="bg-red-500 hover:bg-red-600 text-white py-2 px-4 rounded shadow-md"
                                onclick="cancelPhoto()">Cancel</button>
                            <button id="savePhotoButton" type="button"
                                class="bg-green-500 hover:bg-green-600 text-white py-2 px-4 rounded shadow-md"
                                onclick="cropImage()">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>

    <!-- Baru Change Password Modal -->
    <div id="changePasswordModal" tabindex="-1" aria-hidden="true"
        class="hidden fixed inset-0 z-50 flex items-center justify-center overflow-y-auto overflow-x-hidden bg-black bg-opacity-50">
        <div class="fixed inset-0 bg-black bg-opacity-50"></div>
        <div class="relative p-4 w-full max-w-md max-h-full z-10">
            <div class="relative bg-white rounded-lg shadow white:bg-white-700">
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-dark-600">
                    <h3 class="text-xl font-semibold text-dark-900 dark:text-dark">
                        Change Password
                    </h3>
                    <button type="button"
                        class="end-2.5 text-dark-400 bg-transparent hover:bg-white-200 hover:text-white-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                        onclick="closeModal('changePasswordModal')">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
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

    <!--alert modals add data baru -->
    <div id="alertEditModal" tabindex="-1"
        class="hidden fixed inset-0 flex items-center justify-center z-50 bg-black bg-opacity-50 rounded-xl">
        <div class="relative p-4 w-full max-w-md">
            <div class="relative bg-white rounded-xl shadow">
                <div class="p-4 md:p-5 text-center">
                    <img src="/assets/img/svg/ceklist.svg" alt="Success Checkmark" class="mx-auto mb-4 w-12 h-12" />
                    <h3 class="mb-5 text-lg text-dark">Data berhasil disimpan.</h3>
                </div>
            </div>
        </div>
    </div>

    <!--alert modals change password -->
    <div id="alertChangeModal" tabindex="-1"
        class="hidden fixed inset-0 flex items-center justify-center z-50 bg-black bg-opacity-50 rounded-xl">
        <div class="relative p-4 w-full max-w-md">
            <div class="relative bg-white rounded-xl shadow">
                <div class="p-4 md:p-5 text-center">
                    <img src="/assets/img/svg/ceklist.svg" alt="Success Checkmark" class="mx-auto mb-4 w-12 h-12" />
                    <h3 class="mb-5 text-lg text-dark">Password berhasil disimpan.</h3>
                </div>
            </div>
        </div>
    </div>

    <!--alert modals edit profile -->
    <div id="alertEditProfileModal" tabindex="-1"
        class="hidden fixed inset-0 flex items-center justify-center z-50 bg-black bg-opacity-50 rounded-xl">
        <div class="relative p-4 w-full max-w-md">
            <div class="relative bg-white rounded-xl shadow">
                <div class="p-4 md:p-5 text-center">
                    <img src="/assets/img/svg/ceklist.svg" alt="Success Checkmark" class="mx-auto mb-4 w-12 h-12" />
                    <h3 class="mb-5 text-lg text-dark">Foto berhasil disimpan.</h3>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div id="deleteConfirmationModal" tabindex="-1"
        class="hidden fixed inset-0 flex items-center justify-center z-50 bg-black bg-opacity-50">
        <div class="relative p-4 w-full max-w-md">
            <div class="relative bg-white rounded-xl shadow">
                <div class="p-4 md:p-5 text-center">
                    <h3 class="mb-5 text-lg font-normal text-gray-800">Apakah anda yakin ingin menghapus foto profil?</h3>
                    <div class="flex justify-center gap-4">
                        <button type="button" id="confirmDeleteBtn"
                            class="bg-red-500 hover:bg-red-600 text-white py-2 px-4 rounded shadow-md">
                            Iya
                        </button>
                        <button type="button" id="cancelDeleteBtn"
                            class="bg-gray-500 hover:bg-gray-600 text-white py-2 px-4 rounded shadow-md">
                            Batal
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Success Alert Modal -->
    <div id="alertDeleteProfileModal" tabindex="-1"
        class="hidden fixed inset-0 flex items-center justify-center z-50 bg-black bg-opacity-50 rounded-xl">
        <div class="relative p-4 w-full max-w-md">
            <div class="relative bg-white rounded-xl shadow">
                <div class="p-4 md:p-5 text-center">
                    <img src="/assets/img/svg/ceklist.svg" alt="Success Checkmark" class="mx-auto mb-4 w-12 h-12" />
                    <h3 class="mb-5 text-lg text-dark">Foto berhasil Dihapus.</h3>
                </div>
            </div>
        </div>
    </div>

    <script>
        // alert modals edit profile
        document.addEventListener('DOMContentLoaded', function() {
            const csrfTokenMeta = document.querySelector('meta[name="csrf-token"]');

            if (!csrfTokenMeta) {
                console.error('CSRF token meta tag is missing.');
                return;
            }

            const csrfToken = csrfTokenMeta.content;
            document.getElementById('savePhotoButton').addEventListener('click', async function(event) {
                event.preventDefault();

                const form = document.querySelector('#editPhotoModal form');

                try {
                    const formData = new FormData(form);
                    const response = await fetch(form.action, {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-CSRF-TOKEN': csrfToken
                        }
                    });

                    if (response.ok) {
                        document.getElementById('editPhotoModal').classList.add('hidden');
                        const modalBody = document.getElementById('alertEditProfileModal');
                        modalBody.classList.remove('hidden');
                        setTimeout(() => {
                            modalBody.classList.add('hidden');
                            location.reload();
                        }, 1500);
                    } else {
                        throw new Error('Gagal menyimpan data.');
                    }
                } catch (error) {
                    document.getElementById('editPhotoModal').classList.add('hidden');
                    const modalBody = document.getElementById('alertEditProfileModal');
                    modalBody.classList.remove('hidden');
                    setTimeout(() => {
                        modalBody.classList.add('hidden');
                    }, 1500);
                }
            });
            // Delete button click handler
            document.getElementById('deletePhotoBtn').addEventListener('click', function() {
                document.getElementById('deleteConfirmationModal').classList.remove('hidden');
            });

            // Cancel delete button click handler
            document.getElementById('cancelDeleteBtn').addEventListener('click', function() {
                document.getElementById('deleteConfirmationModal').classList.add('hidden');
            });

            // Confirm delete button click handler
            document.getElementById('confirmDeleteBtn').addEventListener('click', async function() {
                try {
                    const response = await fetch('{{ route('profile.photo.delete') }}', {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': csrfToken,
                            'Content-Type': 'application/json',
                            'Accept': 'application/json'
                        }
                    });

                    if (response.ok) {
                        // Hide confirmation modal
                        document.getElementById('deleteConfirmationModal').classList.add('hidden');

                        // Show success modal
                        const modalBody = document.getElementById('alertDeleteProfileModal');
                        modalBody.classList.remove('hidden');

                        // Hide success modal and reload page after delay
                        setTimeout(() => {
                            modalBody.classList.add('hidden');
                            location.reload();
                        }, 1500);
                    } else {
                        throw new Error('Gagal menghapus foto.');
                    }
                } catch (error) {
                    document.getElementById('deleteConfirmationModal').classList.add('hidden');
                    alert('Gagal menghapus foto. Silakan coba lagi.');
                }
            });
        });

        // Change Password
        document.querySelector('#changePasswordModal form').addEventListener('submit', async function (event) {
            event.preventDefault();

            const currentPassword = document.getElementById('current_password').value.trim();
            const newPassword = document.getElementById('new_password').value.trim();
            const confirmPassword = document.getElementById('new_password_confirmation').value.trim();

            if (!currentPassword) {
                alert('Current password is required.');
                return;
            }
            if (newPassword.length < 8) {
                alert('New password must be at least 8 characters.');
                return;
            }
            if (newPassword !== confirmPassword) {
                alert('New password and confirmation do not match.');
                return;
            }

            // Jika lolos validasi, kirim permintaan ke server
            try {
                const formData = new FormData(this);
                const response = await fetch(this.action, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    },
                });

                const result = await response.json();
                if (response.ok) {
                    const alertModal = document.getElementById('alertChangeModal');
                    
                    // Tampilkan modal
                    alertModal.classList.remove('hidden');

                    // Sembunyikan modal setelah 2 detik dan reload halaman
                    setTimeout(() => {
                        alertModal.classList.add('hidden');
                        location.reload(); // Reload halaman setelah sukses
                    }, 2000);
                } else {
                    alert(result.message || 'Failed to update password.');
                }
            } catch (error) {
                alert('An error occurred. Please try again later.');
            }
        });


        // alert modals edit
        document.getElementById('editProfileForm').addEventListener('submit', async function(event) {
            event.preventDefault();

            try {
                const formData = new FormData(this);
                const response = await fetch(this.action, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    }
                });

                if (response.ok) {
                    document.getElementById('editProfileForm').classList.add('hidden');
                    const modalBody = document.querySelector('#alertEditModal');
                    modalBody.classList.remove('hidden');
                    setTimeout(() => {
                        modalBody.classList.add('hidden');
                        location.reload();
                    }, 1500);
                } else {
                    throw new Error('Gagal menyimpan data.');
                }
            } catch (error) {
                document.getElementById('editProfileForm').classList.add('hidden');
                const modalBody = document.querySelector('#alertEditModal');
                modalBody.classList.remove('hidden');
                setTimeout(() => {
                    modalBody.classList.add('hidden');
                }, 1500);
            }
        });

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
                fetch('{{ route('profile.photo.change') }}', {
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
            image.src =
                "{{ Auth::user()->foto ? asset('storage/pp/' . Auth::user()->foto) : asset('assets/profile.png') }}"; // Reset to default image

            // Show file buttons and hide action buttons
            fileButtons.classList.remove('hidden');
            actionButtons.classList.add('hidden');

            if (cropper) {
                cropper.destroy();
                cropper = null;
            }
        }
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
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const skeleton = document.getElementById("skeleton");
            const content = document.getElementById("content");

            // hidden konten dan tampilkan skeleton saat halaman load
            skeleton.classList.remove("hidden");
            content.classList.add("hidden");

            // Tampilkan konten 
            setTimeout(() => {
                skeleton.classList.add("hidden");
                content.classList.remove("hidden");
            }, 250); //250ms
        });
    </script>
@endsection
