@extends('layouts.app')

@section('title', 'AquaNova')

@section('content')
    @if (session('success'))
        <div id="alertlogin" tabindex="-1"
            class="fixed inset-0 flex items-center justify-center z-50 bg-black bg-opacity-50 rounded-xl">
            <div class="relative p-4 w-full max-w-md">
                <div class="relative bg-white rounded-xl shadow">
                    <div class="p-4 md:p-5 text-center">
                        <img src="/assets/img/svg/ceklist.svg" alt="Success Checkmark" class="mx-auto mb-4 w-12 h-12" />
                        <h3 class="mb-5 text-lg text-dark">{{ session('success') }}</h3>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <script>
        window.addEventListener('load', function() {
            const alertModal = document.getElementById('alertlogin');
            if (alertModal) {
                setTimeout(() => {
                    alertModal.classList.add('hidden');
                    window.location.href = '/';
                }, 1500);
            }
        });
    </script>
    <!--  header-->
    <header class="md:mt-36 md:mx-20 sm:-mx-20 mt-20">

        <!-- tagline utama -->
        <div class="mx-4 md:mx-12 relative mt-16 md:mt-0 sm:-mt-12 sm:text-left">
            <h1
                class="text-5xl md:text-6xl lg:text-7xl bg-gradient-to-r from-[#6FCDF7] to-[#D3E2FF] bg-clip-text text-transparent font-semibold mb-4">
                AquaNova
            </h1>
            <h3 class="text-xl sm:text-2xl md:text-3xl lg:text-4xl mt-4 md:mt-8 max-w-lg md:max-w-2xl font-regular">
                where water quality <br>meets innovation
            </h3>
        </div>

        <div class="md:-mt-40">
            <!-- Gambar untuk mobile -->
            <img src="assets/img/svg/header_home_substract_mobile.svg" alt="Mobile Header"
                class="md:hidden w-full h-auto my-8">

            <!-- Gambar untuk desktop -->
            <img src="/assets/img/svg/header_home_substract.svg" alt="Desktop Header" class="hidden md:block md:w-full">
        </div>



        <!-- tagline-2 -->
        <div class="md:container md:mx-10 md:-mt-64 -mt-[190px]">
            <div class=""> <!-- Flex container for responsive alignment -->
                <!-- analisis -->
                <div
                    class="box-content bg-white opacity-75 border-none rounded-full mb-4 p-2 w-20 md:w-40 flex items-center justify-center mx-4 md:mx-10">
                    <h3 class="md:text-xl text-sm font-medium">Monitoring</h3>
                </div>

                <!-- analisis -->
                <div
                    class="box-content bg-white opacity-75 border-none rounded-full mb-4  p-2 w-20 md:w-40 flex items-center justify-center mx-4 md:mx-10">
                    <h3 class="md:text-xl text-sm font-medium">Analyzing</h3>
                </div>

                <!-- recomen -->
                <div
                    class="box-content bg-white opacity-75 border-none rounded-full mb-4 p-2  w-36 md:w-56 flex items-center justify-center mx-4 md:mx-10">
                    <h3 class="md:text-xl text-sm font-medium">Recomendation</h3>
                </div>
            </div>
        </div>

        <!-- close header -->
        {{-- button start --}}
        <button id="scrollButton"
            class="flex justify-center items-center mx-auto lg:mr-8 rounded-full bg-gradient-to-r from-[#6FCDF7] to-[#D3E2FF] text-white md:px-6 xl:py-8 md:w-[211px] w-40 md:h-[60px] h-14 text-sm md:text-lg xl:text-lg font-medium transition-all duration-300 hover:shadow-lg hover:opacity-90 space-x-3">
            <span>Start Now</span>
            <ion-icon name="arrow-up-outline" class="text-3xl transform rotate-45"></ion-icon>
        </button>
    </header>



    <!-- manfaat -->
    <section id="optimizing" class="md:my-40 my-20">
        <!-- header manfaat-->
        <h3 class="flex justify-center items-center md:text-4xl text-2xl font-semibold"> Optimizes Fish Farming</h3>
        <p class=" flex justify-center items-center text-center md:text-xl text-lg mt-8 font-regular">Aquanova optimizes
            fish
            production through innovative water management solutions.</p>

        <!-- card 3 (hover) -->
        <div class="flex flex-col md:flex-row gap-20 md:gap-32 md:my-60 my-20 mx-auto justify-center items-center">

            {{-- card 1 --}}
            <div id="optimize"
                class="card w-[252px] h-[178px] bg-gray-100 rounded-xl overflow-hidden relative group transition-all duration-300 hover:-translate-y-16">
                <!-- Konten default -->
                <div class="absolute inset-0 flex flex-col transition-opacity duration-300 group-hover:opacity-0">
                    <div class="card w-8 h-8 bg-white rounded m-2 flex justify-center items-start shadow-lg">
                        <ion-icon name="stats-chart" class="text-cyan-600 size-6"></ion-icon>
                    </div>
                    <h3 class="md:text-lg text-sm font-semibold mt-12 mb-4 mx-4 text-start">
                        Optimize your system for efficient water management
                    </h3>
                </div>

                <!-- Gambar yang muncul saat di-hover -->
                <div
                    class="absolute inset-0 opacity-0 group-hover:opacity-100 transition-opacity duration-300 h-[309px] w-[252px] bg-[url('/assets/img/png/Card1_(1).png')] bg-cover bg-center">
                    <div class="flex flex-col items-start justify-start h-full">
                        <!-- Icon above the image -->
                        <div class="w-8 h-8 bg-white rounded m-2 flex justify-center items-center shadow-lg">
                            <ion-icon name="stats-chart" class="text-cyan-600 size-6"></ion-icon>
                        </div>
                        <!-- Heading above the image -->
                        <h3 class="md:text-lg text-white text-sm font-semibold mt-36 mb-4 mx-4 text-start">
                            Optimize your system for efficient water management
                        </h3>
                    </div>
                </div>
            </div>

            {{-- card 2 --}}
            <a href="{{ route('monitoring') }}">
            <div id="set"
                class="card w-[252px] h-[178px] bg-gray-100 rounded-xl overflow-hidden relative group transition-all duration-300 hover:-translate-y-16">
                <!-- Konten default -->
                <div class="absolute inset-0 flex flex-col transition-opacity duration-300 group-hover:opacity-0">
                    <div class="card w-8 h-8 bg-white rounded m-2 flex justify-center items-start shadow-lg">
                        <ion-icon name="stats-chart" class="text-cyan-600 size-6"></ion-icon>
                    </div>
                    <h3 class="md:text-lg text-sm font-semibold mt-12 mb-4 mx-4 text-start">
                        Set your water quality to stabiliser management
                    </h3>
                </div>

                <!-- Gambar yang muncul saat di-hover -->
                <div
                    class="absolute inset-0 opacity-0 group-hover:opacity-100 transition-opacity duration-300 h-[309px] w-[252px] bg-[url('/assets/img/png/card2.png')] bg-cover bg-center">
                    <div class="flex flex-col items-start justify-start h-full">
                        <!-- Icon above the image -->
                        <div class="w-8 h-8 bg-white rounded m-2 flex justify-center items-center shadow-lg">
                            <ion-icon name="stats-chart" class="text-cyan-600 size-6"></ion-icon>
                        </div>
                        <!-- Heading above the image -->
                        <h3 class="md:text-lg text-white text-sm font-semibold mt-36 mb-4 mx-4 text-start">
                            Maximalizing fish production
                        </h3>
                    </div>
                </div>
            </div>
            </a>
            
            {{-- card 3 --}}
            <div id="sell"
                class="card w-[252px] h-[178px] bg-gray-100 rounded-xl overflow-hidden relative group transition-all duration-300 hover:-translate-y-16">
                <!-- Konten default -->
                <div class="absolute inset-0 flex flex-col transition-opacity duration-300 group-hover:opacity-0">
                    <div class="card w-8 h-8 bg-white rounded m-2 flex justify-center items-start shadow-lg">
                        <ion-icon name="stats-chart" class="text-cyan-600 size-6"></ion-icon>
                    </div>
                    <h3 class="md:text-lg text-sm font-semibold mt-12 mb-4 mx-4 text-start">
                        Sell or buy the fish production
                    </h3>
                </div>

                <!-- Gambar yang muncul saat di-hover -->
                <div
                    class="absolute inset-0 opacity-0 group-hover:opacity-100 transition-opacity duration-300 h-[309px] w-[252px] bg-[url('/assets/img/png/card3.png')] bg-cover bg-center">
                    <div class="flex flex-col items-start justify-start h-full">
                        <!-- Icon above the image -->
                        <div class="w-8 h-8 bg-white rounded m-2 flex justify-center items-center shadow-lg">
                            <ion-icon name="stats-chart" class="text-cyan-600 size-6"></ion-icon>
                        </div>
                        <!-- Heading above the image -->
                        <h3 class="md:text-lg text-white text-sm font-semibold mt-36 mb-4 mx-4 text-start">
                            Optimize your system for efficient water management
                        </h3>
                    </div>
                </div>
            </div>

        </div>


        <!-- img right info -->
        <div id="info" class="my-20 md:my-40 flex flex-col md:flex-row md:mx-52 justify-center items-center">
            <img src="/assets/img/svg/img_benefit.svg" alt="fish"
                class=" w-[516px] h-[397px] rounded-2xl mx-20 mb-10 md:mb-0 object-cover transition delay-100 hover:scale-105 duration-200 ease-in-out">

            <div class="">
                <div class="flex flex-row items-center space-x-4 mb-8 sm:mt-20">
                    <h3 class="md:text-4xl text-2xl font-semibold">Choose</h3>
                    <p class="md:text-xl text-sm">choosing the best treatments and products for aquaculture</p>
                </div>
                <div class="flex flex-row items-center space-x-4 mb-8">
                    <h3 class="md:text-4xl text-2xl font-semibold">AquaNova for the Best</h3>
                </div>
                <div class="flex flex-row items-center space-x-4 mb-8">
                    <p class="md:text-xl text-sm">focuses on increasing fish production through monitoring water conditions
                    </p>
                    <h3 class="md:text-4xl text-2xl font-semibold">Aquaculture</h3>
                </div>
            </div>
        </div>
    </section>

    <!-- Alur aquanova  -->
    <section class="md:my-40 my-20">
        <h3 class="flex justify-center items-center md:text-4xl text-2xl font-semibold">How It Works</h3>
        <!-- mobile view -->
        <div class="flex flex-col md:flex-row justify-center items-center mt-24 space-y-2 md:space-y-0 -gap-2">
            <img src="/assets/img/svg/iMockup - iPhone_14_logo.svg" alt="Logo"
                class="md:w-[553px] md:h-[600px] w-[253px] h-[300px] max-w-sm md:max-w-md md:-mt-64 -mt-24 -mb-20 lg:max-w-lg">
            <img src="/assets/img/svg/iMockup - iPhone_analyzing.svg" alt="Analyzing"
                class="md:w-[553px] md:h-[600px] w-[253px] h-[300px] max-w-sm md:max-w-md lg:max-w-lg md:pt-32 pt-6 -ml-6">
        </div>

        <!-- alur/step -->
        <div class="flex flex-col sm:flex-row md:mt-20 mt-10 gap-8 mx-4 sm:mx-64 justify-center items-center text-center">
            {{-- step 1 --}}
            <div class="flex flex-col justify-center items-center">
                <div class="card w-12 h-12 bg-zinc-800 rounded-full flex justify-center items-center">
                    <h3 class="text-xl font-medium text-white">1</h3>
                </div>
                <p class="text-xl sm:text-sm mt-4 max-w-xs sm:max-w-8xl flex justify-center items-center">
                    Temperature, pH, <br> CO2 and Salinity
                </p>
            </div>
            <hr class="border-t-4 border-dashed border-black w-24 sm:w-24">

            {{-- step 2 --}}
            <div class="flex flex-col justify-center items-center">
                <div class="card w-12 h-12 bg-zinc-800 rounded-full flex justify-center items-center">
                    <h3 class="text-xl font-medium text-white">2</h3>
                </div>
                <p class="text-xl sm:text-sm mt-4 flex justify-center items-center">
                    Graph data has been <br> created
                </p>
            </div>
            <hr class="border-t-4 border-dashed border-black w-24 sm:w-24">

            {{-- step 3 --}}
            <div class="flex flex-col justify-center items-center">
                <div class="card w-12 h-12 bg-zinc-800 rounded-full flex justify-center items-center">
                    <h3 class="text-xl font-medium text-white">3</h3>
                </div>
                <p class="text-xl sm:text-sm mt-4 flex justify-center items-center">
                    Article <br> Recommendation
                </p>
            </div>
        </div>

    </section>

    <!-- faq -->
    <section class=" mt-20 bg-white ">
        <div class="py-8 px-4 mx-auto max-w-screen-xl sm:py-16 lg:px-6">
            <h3 class="flex justify-center my-8 text-2xl tracking-tight font-medium text-cyan-600">FAQs
            </h3>
            <h2 class="flex justify-center my-8 text-4xl tracking-tight font-extrabold text-gray-900 ">
                Frequently asked questions</h2>
            <div class="grid pt-8 text-left border-t border-gray-200 md:gap-16  md:grid-cols-2">
                <div>
                    <div class="mb-10">
                        <h3 class="flex items-center mb-4 text-lg font-medium text-gray-900 ">
                            <svg class="flex-shrink-0 mr-2 w-5 h-5 text-gray-500" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-3a1 1 0 00-.867.5 1 1 0 11-1.731-1A3 3 0 0113 8a3.001 3.001 0 01-2 2.83V11a1 1 0 11-2 0v-1a1 1 0 011-1 1 1 0 100-2zm0 8a1 1 0 100-2 1 1 0 000 2z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            What is "Aquanova"?
                        </h3>
                        <p class="text-gray-500">Aquanova is an advanced aquaculture system designed to
                            monitor and optimize water conditions in aquaculture environments. It tracks key parameters such
                            as temperature, pH, oxygen levels, and salinity to ensure the health and productivity of aquatic
                            species.</p>
                    </div>
                    <div class="mb-10">
                        <h3 class="flex items-center mb-4 text-lg font-medium text-gray-900 ">
                            <svg class="flex-shrink-0 mr-2 w-5 h-5 text-gray-500 " fill="currentColor"
                                viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-3a1 1 0 00-.867.5 1 1 0 11-1.731-1A3 3 0 0113 8a3.001 3.001 0 01-2 2.83V11a1 1 0 11-2 0v-1a1 1 0 011-1 1 1 0 100-2zm0 8a1 1 0 100-2 1 1 0 000 2z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            What parameters does Aquanova monitor?
                        </h3>
                        <p class="text-gray-500">Aquanova monitors several critical water quality
                            parameters including: Temperature, pH levels, Oxygen levels and Salinity.</p>
                    </div>
                    <div class="mb-10">
                        <h3 class="flex items-center mb-4 text-lg font-medium text-gray-900">
                            <svg class="flex-shrink-0 mr-2 w-5 h-5 text-gray-500 " fill="currentColor"
                                viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-3a1 1 0 00-.867.5 1 1 0 11-1.731-1A3 3 0 0113 8a3.001 3.001 0 01-2 2.83V11a1 1 0 11-2 0v-1a1 1 0 011-1 1 1 0 100-2zm0 8a1 1 0 100-2 1 1 0 000 2z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            How does Aquanova collect data?
                        </h3>
                        <p class="text-gray-500 ">Aquanova collects data through integrated sensors that
                            continuously measure water parameters. This data is then recorded and analyzed to assess water
                            quality and identify any issues.</p>
                    </div>
                    <div class="mb-10">
                        <h3 class="flex items-center mb-4 text-lg font-medium text-gray-900 ">
                            <svg class="flex-shrink-0 mr-2 w-5 h-5 text-gray-500 " fill="currentColor"
                                viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-3a1 1 0 00-.867.5 1 1 0 11-1.731-1A3 3 0 0113 8a3.001 3.001 0 01-2 2.83V11a1 1 0 11-2 0v-1a1 1 0 011-1 1 1 0 100-2zm0 8a1 1 0 100-2 1 1 0 000 2z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            What happens if the water conditions are not optimal?
                        </h3>
                        <p class="text-gray-500 ">If Aquanova detects that water conditions are outside
                            the optimal range, it provides recommendations to improve the environment. This may include
                            adjustments to temperature, pH, or oxygen levels, or other necessary actions to rectify the
                            issue.</p>
                    </div>
                </div>
                <div>
                    <div class="mb-10">
                        <h3 class="flex items-center mb-4 text-lg font-medium text-gray-900 ">
                            <svg class="flex-shrink-0 mr-2 w-5 h-5 text-gray-500 " fill="currentColor"
                                viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-3a1 1 0 00-.867.5 1 1 0 11-1.731-1A3 3 0 0113 8a3.001 3.001 0 01-2 2.83V11a1 1 0 11-2 0v-1a1 1 0 011-1 1 1 0 100-2zm0 8a1 1 0 100-2 1 1 0 000 2z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            How frequently does Aquanova update its data?
                        </h3>
                        <p class="text-gray-500 ">Aquanova updates its data in real-time or at specified
                            intervals, depending on the configuration and needs of the aquaculture system. This ensures that
                            users have the most current information about water conditions.</p>
                    </div>
                    <div class="mb-10">
                        <h3 class="flex items-center mb-4 text-lg font-medium text-gray-900 ">
                            <svg class="flex-shrink-0 mr-2 w-5 h-5 text-gray-500" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-3a1 1 0 00-.867.5 1 1 0 11-1.731-1A3 3 0 0113 8a3.001 3.001 0 01-2 2.83V11a1 1 0 11-2 0v-1a1 1 0 011-1 1 1 0 100-2zm0 8a1 1 0 100-2 1 1 0 000 2z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            Can Aquanova be integrated with other systems?
                        </h3>
                        <p class="text-gray-500 ">
                            Yes,
                            Aquanova can be integrated with other aquaculture management systems or automation tools.
                            This allows for seamless operation and coordination with existing infrastructure and
                            practices.</p>
                    </div>
                    <div class="mb-10">
                        <h3 class="flex items-center mb-4 text-lg font-medium text-gray-900 ">
                            <svg class="flex-shrink-0 mr-2 w-5 h-5 text-gray-500 " fill="currentColor"
                                viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-3a1 1 0 00-.867.5 1 1 0 11-1.731-1A3 3 0 0113 8a3.001 3.001 0 01-2 2.83V11a1 1 0 11-2 0v-1a1 1 0 011-1 1 1 0 100-2zm0 8a1 1 0 100-2 1 1 0 000 2z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            How does Aquanova help improve aquaculture productivity?
                        </h3>
                        <p class="text-gray-500 ">By providing precise and timely data on water quality,
                            Aquanova helps prevent issues that could harm aquatic species. This proactive monitoring and
                            recommendation system ensures optimal conditions, which leads to healthier fish and higher
                            productivity.</p>
                    </div><!--  header-->
    </section>
    <script>
        document.getElementById('scrollButton').addEventListener('click', function() {
            const targetElement = document.getElementById('optimizing');
            const offset = -100; // negative offset (scrolling -100px above the target element)
            const targetPosition = targetElement.getBoundingClientRect().top + window.pageYOffset + offset;

            window.scrollTo({
                top: targetPosition,
                behavior: 'smooth'
            });
        });

        document.getElementById('optimize').addEventListener('click', function() {
            const targetElement = document.getElementById('info');
            const offset = -100; // negative offset (scrolling -100px above the target element)
            const targetPosition = targetElement.getBoundingClientRect().top + window.pageYOffset + offset;

            window.scrollTo({
                top: targetPosition,
                behavior: 'smooth'
            });
        });

        //hover optimize
        document.addEventListener('DOMContentLoaded', function() {
            const card = document.getElementById('optimize');
            const defaultContent = card.querySelector('.default-content');
            const hoverImage = card.querySelector('.hover-image');

            card.addEventListener('mouseenter', function() {
                // Set height to image height when hovering
                card.style.height = `309px`;
            });

            card.addEventListener('mouseleave', function() {
                // Reset height to default when not hovering
                card.style.height = '178px'; // Reset to original height
            });
        });

        document.addEventListener('DOMContentLoaded', function() {
            const card = document.getElementById('set');
            const defaultContent = card.querySelector('.default-content');
            const hoverImage = card.querySelector('.hover-image');

            card.addEventListener('mouseenter', function() {
                // Set height to image height when hovering
                card.style.height = `309px`;
            });

            card.addEventListener('mouseleave', function() {
                // Reset height to default when not hovering
                card.style.height = '178px'; // Reset to original height
            });
        });

        document.addEventListener('DOMContentLoaded', function() {
            const card = document.getElementById('sell');
            const defaultContent = card.querySelector('.default-content');
            const hoverImage = card.querySelector('.hover-image');

            card.addEventListener('mouseenter', function() {
                // Set height to image height when hovering
                card.style.height = `309px`;
            });

            card.addEventListener('mouseleave', function() {
                // Reset height to default when not hovering
                card.style.height = '178px'; // Reset to original height
            });
        });
    </script>
@endsection