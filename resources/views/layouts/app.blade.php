<!Doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Default Title')</title>
    <!-- import cdn Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link href='./assets/img/png/logo.png' rel='shortcut icon'>
    <!-- Font embed Montserrat Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
    {{-- css --}}
    <link rel="stylesheet" href="{{ asset('./app.css') }}">
    <!-- CropperJs -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.css" rel="stylesheet">
    <!-- Flowbite -->
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.1/dist/flowbite.min.css" rel="stylesheet" />
    <!-- Apexcharts -->
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
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

        [x-cloak] {
            display: none !important;
        }

        .active-link {
            /* border: 1px solid #9F7AEA; */
            border-radius: 20px;
            padding: 10px;
            background-color: #6fc1f7;
            color: white;
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
                <li><a href="/" class="navbar-item tracking-wider" id="home">Home</a></li>
                @auth
                    <li><a href="{{ route('monitoring') }}" id="monitoring" class="navbar-item tracking-wider">Monitoring</a></li>
                    <li><a href="{{ route('recap') }}" id="recap" class="navbar-item tracking-wider">Recap</a></li>
                @endauth
                <li><a href="{{ route('recom') }}" id="recom" class="navbar-item tracking-wider">Recomendation</a></li>
                @auth
                    <li>
                        <!-- ikon kondisi udara lur -->
                        <div id="loading">Loading...</div>
                        <div id="weatherData" style="display: none;">
                            <img class="w-12" id="weatherIcon" alt="Weather Icon">
                            <p><span id="temperature"></span></p>
                        </div>
                    </li>
                @endauth
                @guest
                    <li><a href="{{ route('login') }}" class="tracking-wider">Login</a></li>
                @endguest
                @auth
                    <li>
                        <!-- Profile Dropdown Button -->
                        <div class="relative" x-data="{ isOpen: false }">
                            <button @click="isOpen = !isOpen" @click.away="isOpen = false"
                                class="flex items-center focus:outline-none" type="button">
                                <img src="{{ Auth::user()->foto ? asset('storage/pp/' . Auth::user()->foto) : asset('assets/img/png/profile.png') }}"
                                    alt="Profile" class="w-10 h-10 rounded-full">
                            </button>

                            <!-- Dropdown Menu -->
                            <div x-show="isOpen" x-cloak x-transition:enter="transition ease-out duration-100"
                                x-transition:enter-start="transform opacity-0 scale-95"
                                x-transition:enter-end="transform opacity-100 scale-100"
                                x-transition:leave="transition ease-in duration-75"
                                x-transition:leave-start="transform opacity-100 scale-100"
                                x-transition:leave-end="transform opacity-0 scale-95"
                                class="absolute right-0 mt-2 w-48 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 z-50">

                                <div class="px-4 py-2 text-sm text-gray-500 border-b">
                                    {{ Auth::user()->name }}
                                </div>

                                <a href="{{ route('profile') }}"
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 flex items-center">
                                    <ion-icon name="person-outline" class="mr-2 text-lg"></ion-icon>
                                    Profile
                                </a>

                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit"
                                        class="w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 flex items-center">
                                        <ion-icon name="log-out-outline" class="mr-2 text-lg"></ion-icon>
                                        Logout
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endauth
                    {{-- end --}}
            </ul>
        </div>

        {{-- Mobile Menu (Initially hidden) --}}
        <div id="mobile-menu" class="hidden md:hidden mt-4">
            <ul class="flex flex-col space-y-4 text-gray-700">
                <li><a href="/">Home</a></li>
                @auth
                    <li><a href="{{ route('monitoring') }}">Monitoring</a></li>
                    <li><a href="{{ route('recap') }}">Recap</a></li>
                @endauth
                <li><a href="{{ route('recom') }}">Recommendation</a></li>
                @guest
                    <li><a href="{{ route('login') }}">Login</a></li>
                @endguest

                {{-- <!-- Profile Dropdown for Mobile --> --}}
                @auth
                    <li>
                        <a href="javascript:void(0)" class="flex items-center">
                            <img src="{{ Auth::user()->foto ? asset('storage/pp/' . Auth::user()->foto) : asset('assets/img/png/profile.png') }}"
                                alt="Profile" class="w-10 h-10 mr-2">
                            {{ Auth::user()->name }}
                        </a>
                        <ul class="pl-10">
                            <li>
                                <a href="{{ route('profile') }}" class="flex items-center py-2 text-sm">
                                    <ion-icon name="person-outline" class="mr-2 text-lg"></ion-icon>
                                    Profile
                                </a>
                            </li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="flex items-center py-2 text-sm w-full">
                                        <ion-icon name="log-out-outline" class="mr-2 text-lg"></ion-icon>
                                        Logout
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </li>
                @endauth
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
        <div class="bg-[#082F49] py-10 text-left text-white">
            <div class="grid-1 mx-32 grid gap-16 md:grid-cols-1 lg:grid-cols-3">
                <!-- TW Elements section -->
                <div class="flex justify-start">
                    <img src="/assets/img/png/logo.png" alt="" class="w-28 h-28">
                </div>

                <!-- navbar section-->
                <div class="text-left">
                    <h6 class="mb-4 flex justify-start font-semibold uppercase md:justify-start">
                        Useful links
                    </h6>
                    <p class="mb-4">
                        <a href="#home">Home</a>
                    </p>
                    <p class="mb-4">
                        <a href="{{ route('monitoring') }}">Monitoring</a>
                    </p>
                    <p class="mb-4">
                        <a href="{{ route('recap') }}">Recap</a>
                    </p>
                    <p class="mb-4">
                        <a href="{{ route('recom') }}">Recomendation</a>
                    </p>
                    <p class="mb-4">
                        <a href="{{ route('profile') }}">Profile</a>
                    </p>
                </div>

                <!-- Contact section -->
                <div class="text-left md:text-center">
                    <h6 class="mb-4 flex justify-start font-semibold uppercase md:justify-start">
                        Contact
                    </h6>
                    <p class="mb-4 flex items-center justify-start">
                        <span class="me-3 [&>svg]:h-5 [&>svg]:w-5">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                                <path
                                    d="M11.47 3.84a.75.75 0 011.06 0l8.69 8.69a.75.75 0 101.06-1.06l-8.689-8.69a2.25 2.25 0 00-3.182 0l-8.69 8.69a.75.75 0 001.061 1.06l8.69-8.69z" />
                                <path
                                    d="M12 5.432l8.159 8.159c.03.03.06.058.091.086v6.198c0 1.035-.84 1.875-1.875 1.875H15a.75.75 0 01-.75-.75v-4.5a.75.75 0 00-.75-.75h-3a.75.75 0 00-.75.75V21a.75.75 0 01-.75.75H5.625a1.875 1.875 0 01-1.875-1.875v-6.198a2.29 2.29 0 00.091-.086L12 5.43z" />
                            </svg>
                        </span>
                        New York, NY 10012, US
                    </p>
                    <p class="mb-4 flex items-center justify-start">
                        <span class="me-3 [&>svg]:h-5 [&>svg]:w-5">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                                <path
                                    d="M1.5 8.67v8.58a3 3 0 003 3h15a3 3 0 003-3V8.67l-8.928 5.493a3 3 0 01-3.144 0L1.5 8.67z" />
                                <path
                                    d="M22.5 6.908V6.75a3 3 0 00-3-3h-15a3 3 0 00-3 3v.158l9.714 5.978a1.5 1.5 0 001.572 0L22.5 6.908z" />
                            </svg>
                        </span>
                        aquanova.app@gmail.com
                    </p>
                    <p class="mb-4 flex items-center justify-start">
                        <span class="me-3 [&>svg]:h-5 [&>svg]:w-5">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M1.5 4.5a3 3 0 013-3h1.372c.86 0 1.61.586 1.819 1.42l1.105 4.423a1.875 1.875 0 01-.694 1.955l-1.293.97c-.135.101-.164.249-.126.352a11.285 11.285 0 006.697 6.697c.103.038.25.009.352-.126l.97-1.293a1.875 1.875 0 011.955-.694l4.423 1.105c.834.209 1.42.959 1.42 1.82V19.5a3 3 0 01-3 3h-2.25C8.552 22.5 1.5 15.448 1.5 6.75V4.5z"
                                    clip-rule="evenodd" />
                            </svg>
                        </span>
                        + 01 234 567 88
                    </p>
                    <p class="flex items-center justify-start">
                        <span class="me-3 [&>svg]:h-5 [&>svg]:w-5">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M7.875 1.5C6.839 1.5 6 2.34 6 3.375v2.99c-.426.053-.851.11-1.274.174-1.454.218-2.476 1.483-2.476 2.917v6.294a3 3 0 003 3h.27l-.155 1.705A1.875 1.875 0 007.232 22.5h9.536a1.875 1.875 0 001.867-2.045l-.155-1.705h.27a3 3 0 003-3V9.456c0-1.434-1.022-2.7-2.476-2.917A48.716 48.716 0 0018 6.366V3.375c0-1.036-.84-1.875-1.875-1.875h-8.25zM16.5 6.205v-2.83A.375.375 0 0016.125 3h-8.25a.375.375 0 00-.375.375v2.83a49.353 49.353 0 019 0zm-.217 8.265c.178.018.317.16.333.337l.526 5.784a.375.375 0 01-.374.409H7.232a.375.375 0 01-.374-.409l.526-5.784a.373.373 0 01.333-.337 41.741 41.741 0 018.566 0zm.967-3.97a.75.75 0 01.75-.75h.008a.75.75 0 01.75.75v.008a.75.75 0 01-.75.75H18a.75.75 0 01-.75-.75V10.5zM15 9.75a.75.75 0 00-.75.75v.008c0 .414.336.75.75.75h.008a.75.75 0 00.75-.75V10.5a.75.75 0 00-.75-.75H15z"
                                    clip-rule="evenodd" />
                            </svg>
                        </span>
                        + 01 234 567 89
                    </p>
                </div>
            </div>
        </div>
        <div class="bg-[#082F49] text-white text-sm text-center py-4">
            <p>&copy; 2024 AquaNova. All rights reserved.</p>
        </div>
    </footer>

    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.1/dist/flowbite.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
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

        const navItems = document.querySelectorAll(".navbar-item");

        // Check local storage for the active item
        const activeItem = localStorage.getItem("activeLinkId");
        if (activeItem) {
            document.getElementById(activeItem)?.classList.add("active-link");
        }

        navItems.forEach(item => {
            item.addEventListener("click", () => {
                // Remove 'active-link' from all items
                navItems.forEach(nav => nav.classList.remove("active-link"));

                // Add 'active-link' to the clicked item and store its ID
                item.classList.add("active-link");
                localStorage.setItem("activeLinkId", item.id);
            });
        });

        // responsif navbar
        const menuToggle = document.getElementById('menu-toggle');
        const mobileMenu = document.getElementById('mobile-menu');

        menuToggle.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
        });

        // dropdown profile
        const menuButton = document.getElementById('menu-button');
        const dropdownMenu = menuButton.nextElementSibling;

        // Fungsi untuk menampilkan atau menyembunyikan menu dropdown
        menuButton.addEventListener('click', () => {
            const isExpanded = menuButton.getAttribute('aria-expanded') === 'true';
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
            const offset = -100;
            const targetPosition = targetElement.getBoundingClientRect().top + window.pageYOffset + offset;

            window.scrollTo({
                top: targetPosition,
                behavior: 'smooth'
            });
        });
    </script>
    <script>
        function fetchWeatherData() {
            const apiKey = 'f8c320633d6543ccb8a161745242410';
            const loadingDiv = document.getElementById('loading');
            const weatherDataDiv = document.getElementById('weatherData');
            const temperatureElem = document.getElementById('temperature');
            const weatherIconElem = document.getElementById('weatherIcon');

            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(position => {
                    const lat = position.coords.latitude;
                    const lon = position.coords.longitude;
                    const url = `https://api.weatherapi.com/v1/current.json?key=${apiKey}&q=${lat},${lon}&aqi=no`;

                    fetch(url)
                        .then(response => {
                            if (!response.ok) {
                                throw new Error(`HTTP error! Status: ${response.status}`);
                            }
                            return response.json();
                        })
                        .then(data => {
                            temperatureElem.textContent = `${data.current.temp_c}°C`;

                            const conditionText = data.current.condition.text.toLowerCase();
                            weatherIconElem.src = getWeatherIcon(conditionText);
                            weatherIconElem.style.display = 'block';

                            loadingDiv.style.display = 'none';
                            weatherDataDiv.style.display = 'block';
                        })
                        .catch(error => {
                            console.error("Error in fetch:", error);
                            loadingDiv.textContent = 'Failed to load weather data.';
                        });
                }, error => {
                    console.error('Geolocation error:', error);
                    loadingDiv.textContent = 'Error accessing location.';
                    alert("Geolocation error: Pastikan izin lokasi diberikan dan tersedia.");
                });
            } else {
                alert("Geolocation tidak didukung oleh browser Anda.");
            }
        }

        function getWeatherIcon(condition) {
            if (condition.includes("clear")) return '{{ asset('assets/gif/clear.gif') }}';
            if (condition.includes("partly cloudy")) return '{{ asset('assets/gif/pcloudy.gif') }}';
            if (condition.includes("overcast")) return '{{ asset('assets/gif/overcas.gif') }}';
            if (condition.includes("rain")) return '{{ asset('assets/gif/rain.gif') }}';
            if (condition.includes("thunderstorm")) return '{{ asset('assets/gif/storm.gif') }}';
            // if (condition.includes("snow")) return '{{ asset('assets/images/snow.png') }}';
            if (condition.includes("mist") || condition.includes("fog")) return '{{ asset('assets/gif/kabut.gif') }}';
            if (condition.includes("haze")) return '{{ asset('assets/gif/kabut.gif') }}';
            if (condition.includes("windy")) return '{{ asset('assets/gif/windy.gif') }}';
            return '{{ asset('assets/gif/clear.gif') }}';
        }

        window.onload = function() {
            fetchWeatherData();
        }
    </script>
</body>

</html>
