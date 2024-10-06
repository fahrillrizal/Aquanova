<!Doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- import cdn Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Font embed Montserrat Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
    <!-- CropperJs -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.css" rel="stylesheet">
    <!-- Flowbite -->
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.1/dist/flowbite.min.css" rel="stylesheet" />
    <!-- Apexcharts -->
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <style>
        #scroll-up {
            background-color: #082F49;
            width: 45px;
            height: 45px;
            color: white;
            border-radius: 50%;
            padding: 12px;
            display: none;
            position: fixed;
            bottom: 40px;
            right: 40px;
            cursor: pointer;
            z-index: 1000;
        }

        #scroll-up:hover {
            background-color: #082F49;
        }

        .cropper-crop-box {
            border-radius: 50%;
        }

        .cropper-face {
            border-radius: 50%;
        }

        .cropper-view-box {
            border-radius: 50%;
        }
    </style>
</head>

<body class="font-['Montserrat']">
    <!-- Navigation -->
    <nav class="fixed top-0 left-0 w-full px-8 py-4 text-sm font-medium bg-white bg-opacity-20 backdrop-blur-sm z-10">
        <div class="container mx-auto flex justify-between items-center">
            <img src="/assets/img/png/logo.png" alt="" class="w-8 h-8">

            <!-- Hamburger Menu for Mobile -->
            <div class="md:hidden">
                <button id="menu-toggle" class="text-gray-700 focus:outline-none">
                    <ion-icon name="menu-outline" size="large"></ion-icon>
                </button>
            </div>

            <ul id="navbar-menu" class="hidden md:flex justify-center items-center space-x-16">
                <li><a href="/">Home</a></li>
                @auth
                    <li><a href="{{ route('monitoring') }}">Monitoring</a></li>
                @endauth
                <li><a href="{{ route('recom') }}">Recomendation</a></li>
                @guest
                    <li><a href="{{ route('login') }}">Login</a></li>
                @endguest

                <li>
                    <div class="relative" data-twe-dropdown-ref>
                        <!-- Profile Image that toggles dropdown -->
                        <a href="javascript:void(0)" id="profileDropdown">
                            <img src="assets/img/png/profile.png" alt="Profile" class="w-10 h-10">
                        </a>

                        <!-- Dropdown Menu -->
                        <ul id="profileDropdownMenu"
                            class="absolute z-[1000] left-0 -ml-12  mt-2 hidden w-24 min-w-max list-none overflow-hidden rounded-lg border-none bg-white bg-clip-padding text-base shadow-lg data-[twe-dropdown-show]:block dark:bg-surface-dark"
                            aria-labelledby="dropdownMenuButton1h" data-twe-dropdown-menu-ref>
                            <h6
                                class="block w-full whitespace-nowrap bg-white px-4 py-2 text-sm font-normal text-black/50 focus:bg-zinc-200/60 focus:outline-none dark:bg-surface-dark dark:text-white/50">
                                Angelicav.
                            </h6>
                            <li class="flex justify-center items-center">
                                <a class="block w-full whitespace-nowrap bg-white px-4 py-2 text-sm font-normal text-neutral-700 hover:bg-zinc-200/60 focus:bg-zinc-200/60 focus:outline-none active:bg-zinc-200/60 active:no-underline dark:bg-surface-dark dark:text-white dark:hover:bg-neutral-800/25 dark:focus:bg-neutral-800/25 dark:active:bg-neutral-800/25"
                                    href="#" data-twe-dropdown-item-ref> <ion-icon name="person-outline"
                                        class="text-sm transform mr-2"></ion-icon>Profile
                                </a>
                            </li>
                            <li>
                                <a class="block w-full whitespace-nowrap bg-white px-4 py-2 text-sm font-normal text-neutral-700 hover:bg-zinc-200/60 focus:bg-zinc-200/60 focus:outline-none active:bg-zinc-200/60 active:no-underline dark:bg-surface-dark dark:text-white dark:hover:bg-neutral-800/25 dark:focus:bg-neutral-800/25 dark:active:bg-neutral-800/25"
                                    href="#" data-twe-dropdown-item-ref><ion-icon name="log-out-outline"
                                        class="text-sm transform mr-2"></ion-icon>Logout</a>
                            </li>
                        </ul>
                    </div>
                </li>
                {{-- end --}}
            </ul>
        </div>

        {{-- Mobile Menu (Initially hidden) --}}
        <div id="mobile-menu" class="hidden md:hidden mt-4">
            <ul class="flex flex-col space-y-4 text-gray-700">
                <li><a href="/">Home</a></li>
                @auth
                    <li><a href="{{ route('monitoring') }}">Monitoring</a></li>
                @endauth
                <li><a href="{{ route('recom') }}">Recommendation</a></li>
                @guest
                    <li><a href="{{ route('login') }}">Login</a></li>
                @endguest

                {{-- <!-- Profile Dropdown for Mobile --> --}}
                <li>
                    <a href="javascript:void(0)" class="flex items-center">
                        <img src="assets/img/png/profile.png" alt="Profile" class="w-10 h-10 mr-2"> Angelicav.
                    </a>
                    <ul class="pl-10">
                        <li><a href="#" class="block py-1 text-sm">Profile</a></li>
                        <li><a href="#" class="block py-1 text-sm">Logout</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>

    <main class="mx-8 mt-20 flex-grow">
        <div class="mb-20">
            @yield('content')
        </div>
    </main>

    <button id="scroll-up" aria-label="Scroll to top" class=" flex justify-center text-center">
        <ion-icon name="arrow-up-outline" class="text-xl"></ion-icon>
    </button>

    <!-- Footer -->
    <footer class="relative md:text-center text-left">
        <div>
            <svg class="h-24 w-full" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"
                preserveAspectRatio="none">
                <path class="fill-[#082F49]" fill-opacity="1"
                    d="M0,288L60,245.3C120,203,240,117,360,112C480,107,600,181,720,229.3C840,277,960,299,1080,256C1200,213,1320,107,1380,53.3L1440,0L1440,320L1380,320C1320,320,1200,320,1080,320C960,320,840,320,720,320C600,320,480,320,360,320C240,320,120,320,60,320L0,320Z">
                </path>
            </svg>
        </div>
        <div class="h-36 absolute w-36 ml-64">
                <img src="{{ asset('assets/logo.png') }}" class="mt-1" alt="">
        </div>
        <div class="bg-[#082F49] text-white text-sm text-center py-4">
            <p>&copy; 2024 AquaNova. All rights reserved.</p>
        </div>
    </footer>

    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.1/dist/flowbite.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const scrollUpButton = document.getElementById("scroll-up");

            window.addEventListener("scroll", function() {
                if (window.scrollY > 100) {
                    scrollUpButton.style.display = "block";
                } else {
                    scrollUpButton.style.display = "none";
                }
            });

            scrollUpButton.addEventListener("click", function() {
                window.scrollTo({
                    top: 0,
                    behavior: "smooth"
                });
            });
        });

        // responsif navbar
        const menuToggle = document.getElementById('menu-toggle');
        const mobileMenu = document.getElementById('mobile-menu');

        menuToggle.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
        });

        // dropdown profile
        // Ambil elemen tombol dan dropdown menu
        const menuButton = document.getElementById('menu-button');
        const dropdownMenu = menuButton.nextElementSibling;

        // Fungsi untuk menampilkan atau menyembunyikan menu dropdown
        menuButton.addEventListener('click', () => {
            const isExpanded = menuButton.getAttribute('aria-expanded') === 'true';

            // Toggle atribut aria-expanded dan tampilan dropdown
            menuButton.setAttribute('aria-expanded', !isExpanded);
            dropdownMenu.classList.toggle('hidden');
        });

        // Menyembunyikan dropdown jika klik di luar area
        window.addEventListener('click', (e) => {
            if (!menuButton.contains(e.target) && !dropdownMenu.contains(e.target)) {
                menuButton.setAttribute('aria-expanded', 'false');
                dropdownMenu.classList.add('hidden');
            }
        });

        document.getElementById('scrollButton').addEventListener('click', function() {
            const targetElement = document.getElementById('optimizing');
            const offset = -100; // negative offset (scrolling -100px above the target element)
            const targetPosition = targetElement.getBoundingClientRect().top + window.pageYOffset + offset;

            window.scrollTo({
                top: targetPosition,
                behavior: 'smooth'
            });
        });

        // Get the toggle and menu elements
        const toggle = document.getElementById('profileDropdown');
        const menu = document.getElementById('profileDropdownMenu');

        // Add event listener to the profile image
        toggle.addEventListener('click', function() {
            // Toggle the visibility of the dropdown menu
            menu.classList.toggle('hidden');
        });

        // Optional: Close the dropdown when clicking outside
        document.addEventListener('click', function(event) {
            if (!menu.contains(event.target) && !toggle.contains(event.target)) {
                menu.classList.add('hidden');
            }
        });
    </script>
</body>

</html>
