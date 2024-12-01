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


    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-5 pt-5 flex-1 overflow-x-auto">

        <!-- Facility Card -->
        <div class="bg-gray-200 flex flex-col justify-between shadow-md rounded-lg p-5">
            <div class="flex justify-between items-center">
                <h2 class="text-lg font-bold">Facility</h2>
                <div class="bg-black h-5 w-5"></div>
            </div>
            <p class="mt-4 text-lg font-bold">No. of facility: <span class="font-extrabold">10</span></p>
        </div>

        <!-- Inventory Card -->
        <div class="bg-gray-200 flex flex-col justify-between shadow-md rounded-lg p-5">
            <div class="flex justify-between items-center">
                <h2 class="text-lg font-bold">Inventory</h2>
                <div class="bg-black h-5 w-5"></div>
            </div>
            <p class="mt-4">No. of Equipment: <span class="font-extrabold">10</span></p>
            <p class="mt-1">No. of Supplies: <span class="font-extrabold">10</span></p>
        </div>

        <!-- Event and Activity Card -->
        <div class="bg-gray-200 flex flex-col justify-between shadow-md rounded-lg p-5">
            <div class="flex justify-between items-center">
                <h2 class="text-lg font-bold">Event and Activity</h2>
                <div class="bg-black h-5 w-5"></div>
            </div>
            <p class="mt-4 text-lg font-bold">No. of Events: <span class="font-extrabold">10</span></p>
        </div>

        <!-- Maintenance Card -->
        <div class="bg-gray-200 flex flex-col justify-between shadow-md rounded-lg p-5">
            <div class="flex justify-between items-center">
                <h2 class="text-lg font-bold">Maintenance</h2>
                <div class="bg-black h-5 w-5"></div>
            </div>
            <p class="mt-4">No. of Pending maintenance requests: <span class="font-extrabold">10</span></p>
            <p class="mt-1">No. of Pending maintenance requests: <span class="font-extrabold">10</span></p>
            <p class="mt-1">No. of Pending maintenance requests: <span class="font-extrabold">10</span></p>
        </div>

    </div>

    <!-- Chart Section -->
    <div class="mt-10 max-w-lg w-full">
        <h2 class="text-2xl font-bold mb-5">Charts</h2>
        <div id="chart" class="w-full max-w-[500px]"></div>
    </div>
    <script>
        var options = {
            chart: {
                type: 'bar',
                height: 350
            },
            series: [{
                name: 'Requests',
                data: [10, 15, 20, 25]
            }],
            xaxis: {
                categories: ['Facilities', 'Inventory', 'Activities', 'Maintenance']
            }
        }

        var chart = new ApexCharts(document.querySelector("#chart"), options);
        chart.render();
    </script>
    <!-- Add additional content here -->
</section>
@endsection