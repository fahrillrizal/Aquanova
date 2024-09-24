@extends('layouts.app')

@section('content')
    <!--  header-->
    <header class="mt-40 mx-20">

        <!-- picture -->
        <div>
            <img src="/assets/img/svg/header_home_substract.svg" alt="header">
        </div>


        <!-- tagline utama -->
        <div class="mx-12 -mt-[600px] relative">
            <h1 class="text-7xl bg-gradient-to-r from-[#6FCDF7] to-[#D3E2FF] bg-clip-text text-transparent font-semibold mb-4">AquaNova</h1>
            <h3 class="text-4xl mt-8 max-w-2xl font-regular">where water quality meets innovation</h3>
        </div>



        <!-- tagline-2 -->
        <div class="md:container md:mx-auto mt-36">
            <!-- analisis -->
            <div
                class="box-content bg-white opacity-75 border-none rounded-full mb-4 mx-20 p-2 w-40 flex items-start justify-start">
                <h3 class="text-xl font-medium mx-4">Monitoring</h3>
            </div>

            <!-- analisis -->
            <div
                class="box-content bg-white opacity-75 border-none rounded-full mb-4 mx-20 p-2 w-40 flex items-start justify-start">
                <h3 class="text-xl font-medium mx-4">Analyzing</h3>
            </div>

            <!-- recomen -->
            <div
                class="box-content bg-white opacity-75 border-none rounded-full mb-4 mx-20 p-2 w-56 flex items-start justify-start">
                <h3 class="text-xl font-medium mx-4">Recomendation</h3>
            </div>
        </div>
        <!-- close header -->
        {{-- button start --}}
        <button
            class="flex justify-center items-center ml-[1000px] mt-8 rounded-full bg-gradient-to-r from-[#6FCDF7] to-[#D3E2FF] text-white md:px-6 py-3 w-[211px] h-[60px] text-lg font-medium transition-all duration-300 hover:shadow-lg hover:opacity-90 space-x-3">
            <span>Start Now</span>
            <ion-icon name="arrow-up-outline" class="text-3xl transform rotate-45"></ion-icon>
        </button>
    </header>



    <!-- manfaat -->
    <section class="my-40">
        <!-- header manfaat-->
        <h3 class=" flex justify-center items-center text-4xl font-semibold"> optimizes fish farming</h3>
        <p class=" flex justify-center items-center text-center text-xl mt-8 font-regular">Aquanova optimizes fish
            production through innovative water management solutions.</p>

        <!-- card 3 (hover) -->
        <div class="flex flex-row-3 gap-32 my-60 justify-center">

            {{-- chard 1 --}}
            <div class="card w-72 h-46 bg-gray-100 rounded-xl">
                <div class="card w-8 h-8 bg-white rounded m-2 flex justify-center items-center shadow-lg">
                    <ion-icon name="stats-chart" class=" text-cyan-600 size-6"></ion-icon>
                </div>
                <h3 class="text-xl font-semibold mt-12 mb-4 mx-4">Set your water quality to stabilise</h3>
            </div>

            {{-- card 2 --}}
            <div class="card w-72 h-46 bg-gray-100 rounded-xl">
                <div class="card w-8 h-8 bg-white rounded m-2 flex justify-center items-center shadow-lg">
                    <ion-icon name="bag" class=" text-cyan-600 size-6"></ion-icon>
                </div>
                <h3 class="text-xl font-semibold mt-12 mb-4 mx-4">Set your water quality to stabilise</h3>
            </div>

            {{-- card 3 --}}
            <div class="card w-72 h-46 bg-gray-100 rounded-xl">
                <div class="card w-8 h-8 bg-white rounded m-2 flex justify-center items-center shadow-lg">
                    <ion-icon name="wallet" class=" text-cyan-600 size-6"></ion-icon>
                </div>
                <h3 class="text-xl font-semibold mt-12 mb-4 mx-4">Set your water quality to stabilise</h3>
            </div>
        </div>


        <!-- img right info -->
        <div class="my-40 flex flex-row-2 mx-52 my-40 justify-center items-center">
            <img src="/assets/img/svg/img_benefit.svg" alt="fish"
                class=" w-[516px] h-[397px] rounded-2xl mx-20 object-cover transition delay-100 hover:scale-105 duration-200 ease-in-out">

            <div class="">
                <div class="flex flex-row items-center space-x-4 mb-8">
                    <h3 class="text-4xl font-semibold">Choose</h3>
                    <p>choosing the best treatments and products for aquaculture</p>
                </div>
                <div class="flex flex-row items-center space-x-4 mb-8">
                    <h3 class="text-4xl font-semibold">AquaNova for the Best</h3>
                </div>
                <div class="flex flex-row items-center space-x-4 mb-8">
                    <p>focuses on increasing fish production through monitoring water conditions</p>
                    <h3 class="text-4xl font-semibold">Aquaculture</h3>
                </div>
            </div>

    </section>

    <!-- Alur aquanova  -->
    <section class="my-40">
        <h3 class="flex justify-center items-center text-4xl font-semibold">How It Works</h3>
        <!-- mobile view -->
        <div class="mt-10 flex justify-center item-center space-y-4 -gap-2">
            <img src="/assets/img/svg/iMockup - iPhone_14_logo.svg" alt="Logo"
                class="w-[553px] h-[600px] max-w-sm md:max-w-md lg:max-w-lg">
            <img src="/assets/img/svg/iMockup - iPhone_analyzing.svg" alt="Analyzing"
                class="w-[553px] h-[600px] max-w-sm md:max-w-md lg:max-w-lg pt-32 ">
        </div>

        <!-- alur/step -->
        <div class="flex mt-20 gap-8 mx-64 justify-center items-center text-center">
            {{-- step 1 --}}
            <div class="flex flex-col justify-center items-center">
                <div class="card w-12 h-12 bg-zinc-800 rounded-full flex justify-center items-center">
                    <h3 class="text-xl font-medium text-white">1</h3>
                </div>
                <p class="text-2xl mt-4 max-w-8xl flex justify-center items-center"> Temperature, pH, <br> CO2 and Salinity
                </p>
            </div>
            <hr class="border-t-4 border-dashed border-black w-24">

            {{-- step 2 --}}
            <div class="flex flex-col justify-center items-center">
                <div class="card w-12 h-12 bg-zinc-800 rounded-full flex justify-center items-center">
                    <h3 class="text-xl font-medium text-white">2</h3>
                </div>
                <p class="text-2xl mt-4 flex justify-center items-center"> Graph data has been <br> created</p>
            </div>
            <hr class="border-t-4 border-dashed border-black w-24">

            {{-- step 3 --}}
            <div class="flex flex-col justify-center items-center">
                <div class="card w-12 h-12 bg-zinc-800 rounded-full flex justify-center items-center">
                    <h3 class="text-xl font-medium text-white">3</h3>
                </div>
                <p class="text-2xl mt-4 flex justify-center items-center"> Article <br> Recomendation</p>
            </div>
        </div>
    </section>

    <!-- faq -->
    <section class=" mt-20 mb-10 bg-white dark:bg-gray-900">
        <div class="py-8 px-4 mx-auto max-w-screen-xl sm:py-16 lg:px-6">
            <h3 class="flex justify-center my-8 text-2xl tracking-tight font-medium text-cyan-600 dark:text-white">FAQs
            </h3>
            <h2 class="flex justify-center my-8 text-4xl tracking-tight font-extrabold text-gray-900 dark:text-white">
                Frequently asked questions</h2>
            <div class="grid pt-8 text-left border-t border-gray-200 md:gap-16 dark:border-gray-700 md:grid-cols-2">
                <div>
                    <div class="mb-10">
                        <h3 class="flex items-center mb-4 text-lg font-medium text-gray-900 dark:text-white">
                            <svg class="flex-shrink-0 mr-2 w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor"
                                viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-3a1 1 0 00-.867.5 1 1 0 11-1.731-1A3 3 0 0113 8a3.001 3.001 0 01-2 2.83V11a1 1 0 11-2 0v-1a1 1 0 011-1 1 1 0 100-2zm0 8a1 1 0 100-2 1 1 0 000 2z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            What is "Aquanova"?
                        </h3>
                        <p class="text-gray-500 dark:text-gray-400">Aquanova is an advanced aquaculture system designed to
                            monitor and optimize water conditions in aquaculture environments. It tracks key parameters such
                            as temperature, pH, oxygen levels, and salinity to ensure the health and productivity of aquatic
                            species.</p>
                    </div>
                    <div class="mb-10">
                        <h3 class="flex items-center mb-4 text-lg font-medium text-gray-900 dark:text-white">
                            <svg class="flex-shrink-0 mr-2 w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor"
                                viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-3a1 1 0 00-.867.5 1 1 0 11-1.731-1A3 3 0 0113 8a3.001 3.001 0 01-2 2.83V11a1 1 0 11-2 0v-1a1 1 0 011-1 1 1 0 100-2zm0 8a1 1 0 100-2 1 1 0 000 2z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            What parameters does Aquanova monitor?
                        </h3>
                        <p class="text-gray-500 dark:text-gray-400">Aquanova monitors several critical water quality
                            parameters including: Temperature, pH levels, Oxygen levels and Salinity.</p>
                    </div>
                    <div class="mb-10">
                        <h3 class="flex items-center mb-4 text-lg font-medium text-gray-900 dark:text-white">
                            <svg class="flex-shrink-0 mr-2 w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor"
                                viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-3a1 1 0 00-.867.5 1 1 0 11-1.731-1A3 3 0 0113 8a3.001 3.001 0 01-2 2.83V11a1 1 0 11-2 0v-1a1 1 0 011-1 1 1 0 100-2zm0 8a1 1 0 100-2 1 1 0 000 2z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            How does Aquanova collect data?
                        </h3>
                        <p class="text-gray-500 dark:text-gray-400">Aquanova collects data through integrated sensors that
                            continuously measure water parameters. This data is then recorded and analyzed to assess water
                            quality and identify any issues.</p>
                    </div>
                    <div class="mb-10">
                        <h3 class="flex items-center mb-4 text-lg font-medium text-gray-900 dark:text-white">
                            <svg class="flex-shrink-0 mr-2 w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor"
                                viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-3a1 1 0 00-.867.5 1 1 0 11-1.731-1A3 3 0 0113 8a3.001 3.001 0 01-2 2.83V11a1 1 0 11-2 0v-1a1 1 0 011-1 1 1 0 100-2zm0 8a1 1 0 100-2 1 1 0 000 2z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            What happens if the water conditions are not optimal?
                        </h3>
                        <p class="text-gray-500 dark:text-gray-400">If Aquanova detects that water conditions are outside
                            the optimal range, it provides recommendations to improve the environment. This may include
                            adjustments to temperature, pH, or oxygen levels, or other necessary actions to rectify the
                            issue.</p>
                    </div>
                </div>
                <div>
                    <div class="mb-10">
                        <h3 class="flex items-center mb-4 text-lg font-medium text-gray-900 dark:text-white">
                            <svg class="flex-shrink-0 mr-2 w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor"
                                viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-3a1 1 0 00-.867.5 1 1 0 11-1.731-1A3 3 0 0113 8a3.001 3.001 0 01-2 2.83V11a1 1 0 11-2 0v-1a1 1 0 011-1 1 1 0 100-2zm0 8a1 1 0 100-2 1 1 0 000 2z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            How frequently does Aquanova update its data?
                        </h3>
                        <p class="text-gray-500 dark:text-gray-400">Aquanova updates its data in real-time or at specified
                            intervals, depending on the configuration and needs of the aquaculture system. This ensures that
                            users have the most current information about water conditions.</p>
                    </div>
                    <div class="mb-10">
                        <h3 class="flex items-center mb-4 text-lg font-medium text-gray-900 dark:text-white">
                            <svg class="flex-shrink-0 mr-2 w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor"
                                viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-3a1 1 0 00-.867.5 1 1 0 11-1.731-1A3 3 0 0113 8a3.001 3.001 0 01-2 2.83V11a1 1 0 11-2 0v-1a1 1 0 011-1 1 1 0 100-2zm0 8a1 1 0 100-2 1 1 0 000 2z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            Can Aquanova be integrated with other systems?
                        </h3>
                        <p class="text-gray-500 dark:text-gray-400">
                            Yes,
                            Aquanova can be integrated with other aquaculture management systems or automation tools.
                            This allows for seamless operation and coordination with existing infrastructure and
                            practices.</p>
                    </div>
                    <div class="mb-10">
                        <h3 class="flex items-center mb-4 text-lg font-medium text-gray-900 dark:text-white">
                            <svg class="flex-shrink-0 mr-2 w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor"
                                viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-3a1 1 0 00-.867.5 1 1 0 11-1.731-1A3 3 0 0113 8a3.001 3.001 0 01-2 2.83V11a1 1 0 11-2 0v-1a1 1 0 011-1 1 1 0 100-2zm0 8a1 1 0 100-2 1 1 0 000 2z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            How does Aquanova help improve aquaculture productivity?
                        </h3>
                        <p class="text-gray-500 dark:text-gray-400">By providing precise and timely data on water quality,
                            Aquanova helps prevent issues that could harm aquatic species. This proactive monitoring and
                            recommendation system ensures optimal conditions, which leads to healthier fish and higher
                            productivity.</p>
                    </div><!--  header-->
    </section>
@endsection