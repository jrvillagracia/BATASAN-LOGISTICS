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



    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-5 pt-5 flex-1">
        <!-- Facility Card -->
        <div class="bg-gray-200 flex flex-col justify-between shadow-md rounded-lg p-5 hover:scale-105 hover:shadow-lg transition-transform duration-300">
            <div class="flex justify-between items-center">
                <h2 class="text-2xl font-bold text-black">Facility</h2>
                <div class="flex items-center justify-center rounded text-black">
                    <svg xmlns="http://www.w3.org/2000/svg" height="100px" viewBox="0 -960 960 960" width="100px" fill="currentColor" class="h-50 w-50">
                        <path d="M120-120v-80h80v-640h400v40h160v600h80v80H680v-600h-80v600H120Zm320-320q17 0 28.5-11.5T480-480q0-17-11.5-28.5T440-520q-17 0-28.5 11.5T400-480q0 17 11.5 28.5T440-440Z" />
                    </svg>
                </div>
            </div>
            <p class="text-2xl text-gray-800 mt-4">Room: <span class="font-extrabold">{{$totalFacilities}}</span></p>
        </div>

        <!-- Inventory Card -->
        <div class="bg-gray-200 flex flex-col justify-between shadow-md rounded-lg p-5 hover:scale-105 hover:shadow-lg transition-transform duration-300">
            <div class="flex justify-between items-center">
                <h2 class="text-2xl font-bold text-black">Inventory Stocks</h2>
                <div class="flex items-center justify-center rounded text-black">
                    <svg xmlns="http://www.w3.org/2000/svg" height="100px" viewBox="0 -960 960 960" width="100px" fill="currentColor" class="h-50 w-50">
                        <path d="M202.87-71.87q-37.78 0-64.39-26.61t-26.61-64.39V-612.2q-18.24-12.43-29.12-31.48-10.88-19.06-10.88-43.02v-110.43q0-37.78 26.61-64.39t64.39-26.61h634.26q37.78 0 64.39 26.61t26.61 64.39v110.43q0 23.96-10.88 43.02-10.88 19.05-29.12 31.48v449.33q0 37.78-26.61 64.39t-64.39 26.61H202.87Zm-40-614.83h634.5v-110.43h-634.5v110.43Zm193.06 292.44H604.3v-86.22H355.93v86.22Z" />
                    </svg>
                </div>
            </div>
            <p class="text-2xl text-gray-800 mt-4">Equipment Stocks: <span class="font-bold">{{$totalEquipmentStocks}}</span></p>
            <p class="text-base font-semibold text-gray-600 mt-1">Supplies Stocks: <span class="font-bold">10</span></p>
        </div>

        <!-- Event and Activity Card -->
        <div class="bg-gray-200 flex flex-col justify-between shadow-md rounded-lg p-5 hover:scale-105 hover:shadow-lg transition-transform duration-300">
            <div class="flex justify-between items-center">
                <h2 class="text-lg font-bold">Event and Activity</h2>
                <div class="bg-black h-10 w-10 flex items-center justify-center rounded">
                    <i class="fas fa-calendar-alt text-white text-xl"></i>
                </div>
            </div>
            <p class="mt-4 text-lg font-bold">No. of Events: <span class="font-extrabold">10</span></p>
        </div>

        <!-- Maintenance Card -->
        <div class="bg-gray-200 flex flex-col justify-between shadow-md rounded-lg p-5 hover:scale-105 hover:shadow-lg transition-transform duration-300">
            <div class="flex justify-between items-center">
                <h2 class="text-lg font-bold">Maintenance</h2>
                <div class="bg-black h-10 w-10 flex items-center justify-center rounded">
                    <i class="fas fa-cogs text-white text-xl"></i>
                </div>
            </div>
            <p class="mt-4">No. of Pending maintenance requests: <span class="font-extrabold">10</span></p>
            <p class="mt-1">No. of Approved maintenance requests: <span class="font-extrabold">10</span></p>
            <p class="mt-1">No. of Completed maintenance requests: <span class="font-extrabold">10</span></p>
        </div>
    </div>


    <!-- Chart Section -->

    <div class="mt-10 grid grid-cols-1 md:grid-cols-2 gap-5 max-w-full">
        <div class="w-full">
            <h2 class="text-2xl font-bold mb-5">Charts</h2>
            <div id="chart" class="w-full sm:w-[95%] md:w-[90%] lg:w-[750px]"></div>
        </div>

        <div class="w-full">
            <h2 class="text-2xl font-bold mb-5">Charts</h2>
            <div id="chart-Supp" class="w-full sm:w-[95%] md:w-[90%] lg:w-[750px]"></div>
        </div>
    </div>



    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-5 pt-5 flex-1">
        <!-- Facility Card -->
        <div class="bg-gray-200 flex flex-col justify-between shadow-md rounded-lg p-5 hover:scale-105 hover:shadow-lg transition-transform duration-300 text-white">
            <div class="flex justify-between items-center">
                <h2 class="text-lg font-bold text-black ">Current Stock</h2>
            </div>
            <p class="mt-4 text-lg font-bold text-black">Supplies <span class="font-extrabold">0</span></p>
        </div>

        <!-- Inventory Card -->
        <div class="bg-gray-200 flex flex-col justify-between shadow-md rounded-lg p-5 hover:scale-105 hover:shadow-lg transition-transform duration-300">
            <div class="flex justify-between items-center">
                <h2 class="text-lg font-bold">Current Stock</h2>
            </div>
            <p class="mt-4 text-lg font-bold text-black">Equipment <span class="font-extrabold">0</span></p>
        </div>

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


        document.addEventListener('DOMContentLoaded', function() {
            var options = {
                series: [{
                    data: [76, 85, 101, 98, 87, 105, 91, 114, 94]
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
                    categories: ['Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct'],
                },
                yaxis: {
                    title: {
                        text: '####'
                    }
                }
            };

            var chart = new ApexCharts(document.querySelector("#chart-Supp"), options);
            chart.render();
        });
    </script>

</section>
@endsection