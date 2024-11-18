@extends('layouts.app')

@section('title', 'Recomendation')

@section('content')
    <style>
        /* Skeleton loader animation */
        .animate-pulse {
            animation: pulse 1.5s infinite;
        }

        @keyframes pulse {

            0%,
            100% {
                opacity: 1;
            }

            50% {
                opacity: 0.5;
            }
        }
    </style>
    <!-- content -->
    <main class="md:my-32 my-24">

        <!-- Skeleton Loader -->
        {{-- tagline --}}

        <div id="skeleton" class="w-full">
            <div class="animate-pulse grid grid-cols-1 place-items-center">
                <div class="h-16 bg-gray-100 rounded mt-4 w-[650px]"></div>
                <div class="h-20 bg-gray-100 rounded mt-4 w-[450px]"></div>
                <div class="h-12 bg-gray-300 rounded-xl mt-4 w-[550px]"></div>
            </div>
            {{-- card 1 --}}
            <div class="grid sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-24 my-24 items-center">
                @for ($i = 0; $i < 8; $i++)
                    <div class="animate-pulse">
                        <div class="h-4 bg-gray-300 rounded mt-4"></div>
                        <div class="h-4 bg-gray-300 mb-10 rounded mt-2 w-2/3"></div>
                        <div class="w-72 h-52 bg-gray-300 rounded-2xl"></div>
                        <div class="h-8 w-28 bg-gray-300 rounded-2xl mt-4"></div>
                    </div>
                @endfor
            </div>
        </div>

        <div id="content" class="hidden">
            <!-- tagline -->
            <h3
                class=" md:flex md:justify-center md:items-center text-left text-4xl font-semibold mb-10 bg-gradient-to-r from-[#6FCDF7] to-[#D3E2FF] bg-clip-text text-transparent">
                The Best Guide for Successful Fish Farming</h3>
            <p
                class="md:flex md:justify-center md:items-center md:text-center text-left text-lg font-regular my-10 text-gray-500">
                Collection of
                articles addressing common challenges in fish farming, <br> providing practical solutions to enhance both
                productivity and water quality</p>
            <!-- search -->
            <form id="searchBar" class="max-w-md mx-auto">
                <label for="default-search"
                    class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
                <div class="relative">
                    <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                        <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                        </svg>
                    </div>
                    <input type="search" id="default-search"
                        class="block w-full p-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-xl bg-gray-50 focus:ring-1 focus:outline-none focus:border-blue-100"
                        placeholder="Cari article..." autocomplete="off" required />
                    <button type="submit"
                        class="text-white absolute end-2.5 bottom-2.5 bg-blue-300 hover:bg-gray-300 focus:ring-1 focus:outline-none focus:ring-blue-300 font-medium rounded-xl text-sm px-4 py-2">Search</button>
                </div>
            </form>
            <!-- end search -->

            <!-- article -->
            <section class="flex justify-center item-center">
                <div id="articleGrid" class="grid sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-24 my-24">
                    <div class="-mb-10" data-title="Cara Menaikkan pH Air Kolam Ikan agar Budidaya Tetap Lancar">
                        <h5 class="mb-4 font-semibold text-lg max-w-72 text-gray-700">Cara Menaikkan pH Air Kolam Ikan agar
                            Budidaya Tetap
                            Lancar</h5>
                        <img src="https://wpheadless.efishery.com/wp-content/uploads/2022/12/cara-menaikkan-ph-air.webp"
                            alt=""
                            class="w-72 h-52 object-cover rounded-2xl shadow-sm transition delay-100 hover:scale-105 duration-200 ease-in-out">
                        <button
                            class=" flex justify-center items-center text-center w-28 h-8 mt-4 rounded-2xl border border-blue-200 bg-blue-50 text-blue-400 hover:bg-blue-200">
                            <span class="text-sm"><a href="https://efishery.com/id/resources/cara-menaikkan-ph-air/">read
                                    more</a><span>
                                    <ion-icon name="arrow-up-outline" class="text-sm transform rotate-45"></ion-icon>
                        </button>
                    </div>
                    <!-- card 2-->
                    <div class="-mb-10"
                        data-title="Salinitas, Kunci Sukses dalam Budidaya
                            Ikan yang
                            Menantang">
                        <h5 class="mb-4 font-semibold text-lg max-w-72 text-gray-700">Salinitas, Kunci Sukses dalam Budidaya
                            Ikan yang
                            Menantang</h5>
                        <img src="https://hidupkita.com/wp-content/uploads/2023/09/Budidaya-38.jpg" alt=""
                            class="w-72 h-52 object-cover rounded-2xl shadow-sm transition delay-100 hover:scale-105 duration-200 ease-in-out">
                        <button
                            class=" flex justify-center items-center text-center w-28 h-8 mt-4 rounded-2xl border border-blue-200 bg-blue-50 text-blue-400 hover:bg-blue-200">
                            <span class="text-sm"><a href="https://hidupkita.com/salinitas-terhadap-budidaya-ikan/">read
                                    more</a><span>
                                    <ion-icon name="arrow-up-outline" class="text-sm transform rotate-45"></ion-icon>
                        </button>
                    </div>
                    <!-- card 3 -->
                    <div class="-mb-10"
                        data-title="Teknik Meningkatkan Kualitas Air pada
                            Budidaya Ikan">
                        <h5 class="mb-10 font-semibold text-lg max-w-72 text-gray-700">Teknik Meningkatkan Kualitas Air pada
                            Budidaya Ikan
                        </h5>
                        <img src="https://budidaya.kazu.co.id/wp-content/uploads/2024/01/Teknik-Meningkatkan-Kualitas-Air-pada-Budidaya-Ikan.webp"
                            alt=""
                            class="w-72 h-52 object-cover rounded-2xl shadow-sm transition delay-100 hover:scale-105 duration-200 ease-in-out">
                        <button
                            class=" flex justify-center items-center text-center w-28 h-8 mt-4 rounded-2xl border border-blue-200 bg-blue-50 text-blue-400 hover:bg-blue-200">
                            <span class="text-sm"><a
                                    href="https://budidaya.kazu.co.id/teknik-meningkatkan-kualitas-air-pada-budidaya-ikan/">read
                                    more</a><span>
                                    <ion-icon name="arrow-up-outline" class="text-sm transform rotate-45"></ion-icon>
                        </button>
                    </div>
                    <!-- card 4 -->
                    <div class="-mb-10" data-title="15 Cara Mengatasi Ikan Kekurangan
                            Oksigen">
                        <h5 class="mb-10 font-semibold text-lg max-w-72 text-gray-700">15 Cara Mengatasi Ikan Kekurangan
                            Oksigen</h5>
                        <img src="https://arenahewan.com/wp-content/uploads/2018/07/Ikan-Kekurangan-Oksigen.webp"
                            alt=""
                            class="w-72 h-52 object-cover rounded-2xl shadow-sm transition delay-100 hover:scale-105 duration-200 ease-in-out">
                        <button
                            class=" flex justify-center items-center text-center w-28 h-8 mt-4 rounded-2xl border border-blue-200 bg-blue-50 text-blue-400 hover:bg-blue-200 ">
                            <span class="text-sm"><a
                                    href="https://arenahewan.com/cara-mengatasi-ikan-kekurangan-oksigen">read
                                    more</a><span>
                                    <ion-icon name="arrow-up-outline" class="text-sm transform rotate-45"></ion-icon>
                        </button>
                    </div>

                    <!-- card 7 -->
                    <div class="-mb-10" data-title="Cara Mengatur Kualitas Air yang Ideal untuk Budidaya Ikan">
                        <h5 class="mb-4 font-semibold text-lg max-w-72 text-gray-700">Cara Mengatur Kualitas Air yang Ideal
                            untuk Budidaya Ikan</h5>
                        <img src="https://budidaya.kazu.co.id/wp-content/uploads/2024/01/Cara-Mengatur-Kualitas-Air-yang-Ideal-untuk-Budidaya-Ikan.webp"
                            alt=""
                            class="w-72 h-52 object-cover rounded-2xl shadow-sm transition delay-100 hover:scale-105 duration-200 ease-in-out">
                        <button
                            class=" flex justify-center items-center text-center w-28 h-8 mt-4 rounded-2xl border border-blue-200 bg-blue-50 text-blue-400 hover:bg-blue-200">
                            <span class="text-sm"><a
                                    href="https://budidaya.kazu.co.id/cara-mengatur-kualitas-air-yang-ideal-untuk-budidaya-ikan/">read
                                    more</a><span>
                                    <ion-icon name="arrow-up-outline" class="text-sm transform rotate-45"></ion-icon>
                        </button>
                    </div>
                    <!-- card 5 -->
                    <div class="-mb-10" data-title="Cara Lengkap Budidaya Lele Sistem Boster Sukses Panen">
                        <h5 class="mb-10 font-semibold text-lg max-w-72 text-gray-700">Cara Lengkap Budidaya Lele Sistem
                            Boster
                            Sukses Panen</h5>
                        <img src="https://wpheadless.efishery.com/wp-content/uploads/2024/06/budidaya-lele-sistem-boster.webp"
                            alt=""
                            class="w-72 h-52 object-cover rounded-2xl shadow-sm transition delay-100 hover:scale-105 duration-200 ease-in-out">
                        <button
                            class=" flex justify-center items-center text-center w-28 h-8 mt-4 rounded-2xl border border-blue-200 bg-blue-50 text-blue-400 hover:bg-blue-200">
                            <span class="text-sm"><a
                                    href="https://efishery.com/id/resources/budidaya-lele-sistem-boster/">read
                                    more</a><span>
                                    <ion-icon name="arrow-up-outline" class="text-sm transform rotate-45"></ion-icon>
                        </button>
                    </div>
                    <!-- card 6-->
                    <div class="-mb-10" data-title="Meningkatkan Kesejahteraan Ikan dalam Proses Budidaya">
                        <h5 class="mb-10 font-semibold text-lg max-w-72 text-gray-700">Meningkatkan Kesejahteraan Ikan
                            dalam
                            Proses Budidaya</h5>
                        <img src="https://budidaya.kazu.co.id/wp-content/uploads/2024/01/Meningkatkan-Kesejahteraan-Ikan-dalam-Proses-Budidaya.webp"
                            alt=""
                            class="w-72 h-52 object-cover rounded-2xl shadow-sm transition delay-100 hover:scale-105 duration-200 ease-in-out">
                        <button
                            class=" flex justify-center items-center text-center w-28 h-8 mt-4 rounded-2xl border border-blue-200 bg-blue-50 text-blue-400 hover:bg-blue-200">
                            <span class="text-sm"><a
                                    href="https://budidaya.kazu.co.id/meningkatkan-kesejahteraan-ikan-dalam-proses-budidaya/">read
                                    more</a><span>
                                    <ion-icon name="arrow-up-outline" class="text-sm transform rotate-45"></ion-icon>
                        </button>
                    </div>
                    <!-- card 8 -->
                    <div class="-mb-10" data-title="Daun Johar dan Manfaatnya untuk Ikan Gurame">
                        <h5 class="mb-10 font-semibold text-lg max-w-72 text-gray-700">Daun Johar dan Manfaatnya untuk Ikan
                            Gurame</h5>
                        <img src="https://wpheadless.efishery.com/wp-content/uploads/2024/05/daun-johar-untuk-gurame.webp"
                            alt=""
                            class="w-72 h-52 object-cover rounded-2xl shadow-sm transition delay-100 hover:scale-105 duration-200 ease-in-out">
                        <button
                            class=" flex justify-center items-center text-center w-28 h-8 mt-4 rounded-2xl border border-blue-200 bg-blue-50 text-blue-400 hover:bg-blue-200">
                            <span class="text-sm"><a
                                    href="https://efishery.com/id/resources/daun-johar-untuk-gurame/">read
                                    more</a><span>
                                    <ion-icon name="arrow-up-outline" class="text-sm transform rotate-45"></ion-icon>
                        </button>
                    </div>
                </div>
            </section>
        </div>
        <!-- end article -->
    </main>

    <script>
        document.getElementById('default-search').addEventListener('input', function() {
            const searchText = this.value.toLowerCase();
            const articles = document.querySelectorAll('#articleGrid > div');
            const skeleton = document.getElementById("skeleton");
            const content = document.getElementById("content");

            articles.forEach(article => {
                const title = article.getAttribute('data-title').toLowerCase();
                if (title.includes(searchText)) {
                    article.style.display = 'block';
                } else {
                    article.style.display = 'none';
                }
            });

            //  skeleton loader 
            skeleton.classList.remove("hidden");
            content.classList.add("hidden");

            //  setTimeout untuk menampilkan konten
            setTimeout(() => {
                skeleton.classList.add("hidden");
                content.classList.remove("hidden");
            }, 250);//250 ms
        });

        // add event listener 
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
