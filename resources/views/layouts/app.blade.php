<!Doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- import cdn Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Font embed Montserrat Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
    <style>
        #scroll-up {
            background-color: #6CA2BA;
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
            background-color: #4a90a2;
        }
    </style>
</head>

<body class="font-['Montserrat']">
    <!-- Navigation -->
    <nav class="fixed top-0 left-0 w-full px-8 py-4 text-sm font-medium bg-white bg-opacity-20 backdrop-blur-sm z-10">
        <div class="container mx-auto flex justify-between items-center">
            <div class="card border-2 border-blue-200 rounded-lg w-24 h-12 flex justify-center items-center">
<<<<<<< HEAD
                <h3 class="p-2 bg-gradient-to-r from-[#6FCDF7] to-[#D3E2FF] bg-clip-text text-transparent font-bold">
                    Aquanova
=======
                <h3 class="p-2 bg-gradient-to-r from-[#6FCDF7] to-[#D3E2FF] bg-clip-text text-transparent font-bold">AquaNova
>>>>>>> 496340e0e039b54a8d52f3b711af21bc3a673b4d
                </h3>
            </div>
            <ul class="flex space-x-16">
                <li><a href="#">Home</a></li>
                @auth
                    <li><a href="#">Monitoring</a></li>
                @endauth
                <li><a href="#">Recomendation</a></li>
                @guest
<<<<<<< HEAD
                    <li><a href="#">Login</a></li>
=======
                <li><a href="{{ route('login') }}">Login</a></li>
>>>>>>> 496340e0e039b54a8d52f3b711af21bc3a673b4d
                @endguest
            </ul>
        </div>
    </nav>
    <main class="mx-8 mt-24 flex-grow">
        <div class="mb-96">
            @yield('content')
        </div>
    </main>

    <button id="scroll-up" aria-label="Scroll to top" class=" flex justify-center text-center">
        <ion-icon name="arrow-up-outline" class="text-xl"></ion-icon>
    </button>

    <!-- Footer -->
    <footer class="relative text-center">
        <div>
            <svg class="h-24 w-full" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"
                preserveAspectRatio="none">
                <path class="fill-[#6CA2BA]" fill-opacity="1"
                    d="M0,288L60,245.3C120,203,240,117,360,112C480,107,600,181,720,229.3C840,277,960,299,1080,256C1200,213,1320,107,1380,53.3L1440,0L1440,320L1380,320C1320,320,1200,320,1080,320C960,320,840,320,720,320C600,320,480,320,360,320C240,320,120,320,60,320L0,320Z">
                </path>
            </svg>
        </div>
        <div class="bg-[#6CA2BA] text-white text-sm text-center py-24">
            <p>&copy; 2024 AquaNova. All rights reserved.</p>
        </div>
    </footer>
    
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const scrollUpButton = document.getElementById("scroll-up");

            window.addEventListener("scroll", function() {
                if (window.scrollY > 10) { //ubahen seng 10 bebas wes pokok pas
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
    </script>
</body>

</html>
