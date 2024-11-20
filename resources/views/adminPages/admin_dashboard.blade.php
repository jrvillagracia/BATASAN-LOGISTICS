@extends('adminLayouts.admin_sidebarLayout')

@section('title', 'Dashboard | BHNHS')

@section('content')
<section>
    <div class="flex items-center pb-8">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" strokeWidth="1.5" stroke="currentColor" class="w-9 h-9">
            <path strokeLinecap="round" strokeLinejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
        </svg>
        <h1 class="text-3xl font-bold ml-2">Dashboard Analytics</h1>
    </div>

    <!-- Breadcrumb -->
    <nav class="flex px-5 py-3 text-gray-700 border border-gray-200 rounded-lg bg-gray-50 dark:bg-gray-800 dark:border-gray-700" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
            <li class="inline-flex items-center">
                <a href="#" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600 dark:text-gray-400 dark:hover:text-white">
                    Dashboard Analytics
                </a>
            </li>
            <li>
                <div class="flex items-center">
                    <svg class="rtl:rotate-180 block w-3 h-3 mx-1 text-gray-400 " aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4" />
                    </svg>
                    <a href="#" class="ms-1 text-sm font-medium text-gray-700 hover:text-blue-600 md:ms-2 dark:text-gray-400 dark:hover:text-white">Templates</a>
                </div>
            </li>
            <li aria-current="page">
                <div class="flex items-center">
                    <svg class="rtl:rotate-180  w-3 h-3 mx-1 text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4" />
                    </svg>
                    <span class="ms-1 text-sm font-medium text-gray-500 md:ms-2 dark:text-gray-400">Flowbite</span>
                </div>
            </li>
        </ol>
    </nav>


    <div class="grid grid-cols-3 gap-4 mt-8 pb-8">
        <!-- Card 1 -->
        <div class="block max-w-screen-md p-6 bg-white border border-gray-200 rounded-lg shadow transform transition duration-300 hover:scale-105 hover:shadow-2xl">
            <img class="w-full" src="{{asset('img/facility.jpg')}}" alt="Facility">
            <div class="px-6 py-4">
                <div class="font-bold text-xl mb-2">School Facility Analytics</div>
                <p class="text-gray-700 text-base">
                    Look up at the night sky, and find yourself <span class="font-semibold">immersed</span> in the amazing mountain range of Aspen.
                </p>
            </div>
            <div class="px-6 py-4 flex justify-end">
                <button class="bg-blue-100 text-blue-700 font-semibold py-2 px-4 rounded hover:bg-blue-200 transition duration-300">
                    Explore →
                </button>
            </div>
        </div>


        <!-- Card 2 -->
        <div class="block max-w-screen-md p-6 bg-white border border-gray-200 rounded-lg shadow transform transition duration-300 hover:scale-105 hover:shadow-2xl">
            <img class="w-full" src="{{asset('img/eventactivities.jpg')}}" alt="Facility">
            <div class="px-6 py-4">
                <div class="font-bold text-xl mb-2">Event and Activities</div>
                <p class="text-gray-700 text-base">
                    Look up at the night sky, and find yourself <span class="font-semibold">immersed</span> in the amazing mountain range of Aspen.
                </p>
            </div>
            <div class="px-6 py-4 flex justify-end">
                <button class="bg-blue-100 text-blue-700 font-semibold py-2 px-4 rounded hover:bg-blue-200 transition duration-300">
                    Explore →
                </button>
            </div>
        </div>

        <!-- Card 3 -->
        <div class="block max-w-screen-md p-6 bg-white border border-gray-200 rounded-lg shadow transform transition duration-300 hover:scale-105 hover:shadow-2xl">
            <img class="w-full" src="{{asset('img/inventory.jpg')}}" alt="Facility">
            <div class="px-6 py-4">
                <div class="font-bold text-xl mb-2">Inventory</div>
                <p class="text-gray-700 text-base">
                    Look up at the night sky, and find yourself <span class="font-semibold">immersed</span> in the amazing mountain range of Aspen.
                </p>
            </div>
            <div class="px-6 py-4 flex justify-end">
                <button class="bg-blue-100 text-blue-700 font-semibold py-2 px-4 rounded hover:bg-blue-200 transition duration-300">
                    Explore →
                </button>
            </div>
        </div>
    </div>
    <!-- Add additional content here -->
</section>
@endsection