@extends('adminLayouts.admin_sidebarLayout')

@section('title', 'Dashboard | BHNHS')

@section('content')
<section>
    <div class="flex items-center pb-8">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" strokeWidth="1.5" stroke="currentColor"
            class="w-9 h-9">
            <path strokeLinecap="round" strokeLinejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
        </svg>
        <h1 class="text-3xl font-bold ml-2">Dashboard Analytics</h1>
    </div>

    <!-- Breadcrumb -->



    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-5 pt-5 flex-1">
        <!-- Facility Card -->
        <div
            class="flex flex-col justify-between shadow-md rounded-lg p-5 hover:scale-105 hover:shadow-lg transition-transform duration-300 outline outline-4 outline-blue-800 outline-offset-2">
            <div class="flex justify-between items-center">
                <h2 class="text-2xl font-bold text-black">Facility</h2>
                <div class="flex items-center justify-center rounded text-black">
                    <svg xmlns="http://www.w3.org/2000/svg" height="100px" viewBox="0 -960 960 960" width="100px"
                        fill="#073ce2" class="h-50 w-50">
                        <path
                            d="M120-120v-80h80v-640h400v40h160v600h80v80H680v-600h-80v600H120Zm320-320q17 0 28.5-11.5T480-480q0-17-11.5-28.5T440-520q-17 0-28.5 11.5T400-480q0 17 11.5 28.5T440-440Z" />
                    </svg>
                </div>
            </div>
            <p class="text-2xl text-gray-800 mt-4">Rooms: <span class="font-extrabold">{{$totalFacilities}}</span></p>
        </div>

        <!-- Inventory Card -->
        <div
            class=" flex flex-col justify-between shadow-md rounded-lg p-5 hover:scale-105 hover:shadow-lg transition-transform duration-300 outline outline-4 outline-blue-800 outline-offset-2">
            <div class="flex justify-between items-center">
                <h2 class="text-2xl font-bold text-black">Inventory Stocks</h2>
                <div class="flex items-center justify-center rounded text-black">
                    <svg xmlns="http://www.w3.org/2000/svg" height="100px" viewBox="0 -960 960 960" width="100px"
                        fill="#e2df07" class="h-50 w-50">
                        <path
                            d="M202.87-71.87q-37.78 0-64.39-26.61t-26.61-64.39V-612.2q-18.24-12.43-29.12-31.48-10.88-19.06-10.88-43.02v-110.43q0-37.78 26.61-64.39t64.39-26.61h634.26q37.78 0 64.39 26.61t26.61 64.39v110.43q0 23.96-10.88 43.02-10.88 19.05-29.12 31.48v449.33q0 37.78-26.61 64.39t-64.39 26.61H202.87Zm-40-614.83h634.5v-110.43h-634.5v110.43Zm193.06 292.44H604.3v-86.22H355.93v86.22Z" />
                    </svg>
                </div>
            </div>
            <p class="text-2xl text-gray-800 mt-4">Equipment Stocks: <span class="font-bold">{{$totalEquipmentStocks}}</span></p>
            <p class="text-base font-semibold text-gray-600 mt-1">Supplies Stocks: <span class="font-bold">{{$totalSuppliesStocks}}</span></p>
        </div>

        <!-- Event and Activity Card -->
        <div
            class=" flex flex-col justify-between shadow-md rounded-lg p-5 hover:scale-105 hover:shadow-lg transition-transform duration-300 outline outline-4 outline-blue-800 outline-offset-2">
            <div class="flex justify-between items-center">
                <h2 class="text-2xl font-bold text-black">Events and Activities</h2>
                <div class="flex items-center justify-center rounded text-black">
                    <svg xmlns="http://www.w3.org/2000/svg" height="100px" viewBox="0 -960 960 960" width="100px"
                        fill="#04d711" class="h-50 w-50">
                        <path
                            d="M438-223.37 293.37-367.76l60.39-60.39L438-343.91l168.24-168.24 60.39 60.39L438-223.37ZM202.87-71.87q-37.78 0-64.39-26.61t-26.61-64.39v-554.26q0-37.78 26.61-64.39t64.39-26.61H240v-80h85.5v80h309v-80H720v80h37.13q37.78 0 64.39 26.61t26.61 64.39v554.26q0 37.78-26.61 64.39t-64.39 26.61H202.87Zm0-91h554.26V-560H202.87v397.13Z" />
                    </svg>
                </div>
            </div>
            <p class="text-2xl text-gray-800 mt-4">Events: <span class="font-bold">{{$totalEventsActivities}}</span></p>
        </div>
        <!-- Maintenance Card -->
        <div
            class=" flex flex-col justify-between shadow-md rounded-lg p-5 hover:scale-105 hover:shadow-lg transition-transform duration-300 outline outline-4 outline-blue-800 outline-offset-2">
            <div class="flex justify-between items-center">
                <h2 class="text-2xl font-bold text-black">Maintenance</h2>
                <div class="flex items-center justify-center rounded text-black">
                    <svg xmlns="http://www.w3.org/2000/svg" height="100px" viewBox="0 -960 960 960" width="100px"
                        fill="#e10c0c" class="h-50 w-50">
                        <path
                            d="M686-132 444-376q-20 8-40.5 12t-43.5 4q-100 0-170-70t-70-170q0-36 10-68.5t28-61.5l146 146 72-72-146-146q29-18 61.5-28t68.5-10q100 0 170 70t70 170q0 23-4 43.5T584-516l244 242q12 12 12 29t-12 29l-84 84q-12 12-29 12t-29-12Z" />
                    </svg>
                </div>
            </div>
            <p class="text-2xl text-gray-800 mt-4">Equipment: <span class="font-bold">0</span></p>
            <p class="text-base font-semibold text-gray-600 mt-1">Facility: <span class="font-bold">{{$totalMainteFacilityApprove}}</span></p>
        </div>
    </div>


    <!-- Chart Section -->

    <div class="mt-10 grid grid-cols-1 md:grid-cols-2 gap-20 max-w-full">
        <div class="w-full flex justify-center">
            <div id="chart" class="w-[100%] sm:w-[100%] md:w-[100%] lg:w-[100%]"></div>
        </div>
    
        <div class="w-full flex justify-center">
            <div id="chart-Supp" class="w-[100%] sm:w-[100%] md:w-[100%] lg:w-[100%]"></div>
        </div>
    </div>



    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-5 pt-5 flex-1">
        <!-- Facility Card -->


        <!-- Inventory Card -->


    </div>
    <!-- Add additional content here -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Fetch data via AJAX
            $.ajax({
                url: '/get-equipment-per-month', // Update this URL to match your Laravel route
                type: 'GET',
                dataType: 'json',
                success: function (response) {
                    // Check if response has the required data
                    if (response.months && response.counts) {
                        // Chart options
                        var options = {
                            series: [{
                                data: response.counts // Populate counts dynamically
                            }],
                            chart: {
                                type: 'bar',
                                height: 350
                            },
                            dataLabels: {
                                enabled: false
                            },
                            title: {
                                text: 'Equipment Stocks Per Month',
                                align: 'left'
                            },
                            xaxis: {
                                categories: response.months // Populate months dynamically
                            },
                            yaxis: {
                                title: {
                                    text: 'Stock Count'
                                }
                            }
                        };

                        // Initialize chart
                        var chart = new ApexCharts(document.querySelector("#chart"), options);
                        chart.render();
                    } else {
                        console.error('Invalid response structure:', response);
                    }
                },
                error: function (error) {
                    console.error('Error fetching data:', error);
                }
            });
        });


        document.addEventListener('DOMContentLoaded', function () {
            $.ajax({
                url: '/get-supplies-per-month', // Update this URL to match your Laravel route
                type: 'GET',
                dataType: 'json',
                success: function (response) {
                    // Check if response has the required data
                    if (response.Suppliesmonths && response.Suppliescounts) {
                        // Chart options
                        var options = {
                            series: [{
                                data: response.Suppliescounts // Populate counts dynamically
                            }],
                            chart: {
                                type: 'bar',
                                height: 350
                            },
                            dataLabels: {
                                enabled: false
                            },
                            title: {
                                text: 'Supplies Stocks Per Month',
                                align: 'left'
                            },
                            xaxis: {
                                categories: response.Suppliesmonths // Populate months dynamically
                            },
                            yaxis: {
                                title: {
                                    text: 'Stock Count'
                                }
                            }
                        };

                        // Initialize chart
                        var chart = new ApexCharts(document.querySelector("#chart-Supp"), options);
                        chart.render();
                    } else {
                        console.error('Invalid response structure:', response);
                    }
                },
                error: function (error) {
                    console.error('Error fetching data:', error);
                }
            });
        });
    </script>

</section>
@endsection