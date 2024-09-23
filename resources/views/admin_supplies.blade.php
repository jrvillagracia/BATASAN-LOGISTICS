    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Inventory Supplies | BHNHS</title>
        <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js"></script>
        <script src="{{asset('js/admin_supplies.js')}}"></script>
        <script src="{{asset('js/jquery.js')}}"></script>
        <script src="{{asset('js/main.js')}}"></script>
        <script src="{{asset('js/popups.js')}}"></script>
        <script src="https://cdn.tailwindcss.com"></script>

        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@9.0.3"></script>
        <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.1/dist/flowbite.min.js"></script>
        <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.1/dist/flowbite.min.css" rel="stylesheet" />

        <!-- <script src="https://cdn.datatables.net/2.1.4/js/dataTables.min.js"></script> -->


        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.12.4/dist/sweetalert2.all.min.js"></script>

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.12.4/dist/sweetalert2.min.css">
        <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,500,0,0" />
        <link rel="stylesheet" href="{{asset('css/admin_supplies.css')}}">
        <!-- <link rel="stylesheet" href="https://cdn.datatables.net/2.1.4/css/dataTables.dataTables.min.css"></link> -->
        </link>

    </head>

    <body class="h-screen overflow-x-hidden">
        <div id="csrf-token" data-token="{{ csrf_token() }}"></div>
        <div class="flex">
            <!-- Sidebar -->
            <button data-drawer-target="sidebar-multi-level-sidebar" data-drawer-toggle="sidebar-multi-level-sidebar" aria-controls="sidebar-multi-level-sidebar" type="button" class="inline-flex items-center p-2 mt-2 ms-3 text-sm text-gray-500 rounded-lg sm:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600">
                <span class="sr-only">Open sidebar</span>
                <svg class="w-6 h-6" aria-hidden="true" fill="1E56A0" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path clip-rule="evenodd" fill-rule="evenodd" d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z"></path>
                </svg>
            </button> <!-- May na Update dito -->

            <!-- Sizing and Icons -->
            <aside id="sidebar" class="fixed top-0 left-0 z-40 w-80 h-screen transition-all duration-300" aria-label="Sidebar">
                <div class="h-full px-3 py-4 overflow-y-auto  ">

                    <div id="burger" class="cursor-pointer text-white p-4 flex justify-end h-7">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6 text-white transition-transform duration-300 hover:scale-110 hover:text-gray-300">
                            <path fill-rule="evenodd" d="M3 6.75A.75.75 0 0 1 3.75 6h16.5a.75.75 0 0 1 0 1.5H3.75A.75.75 0 0 1 3 6.75ZM3 12a.75.75 0 0 1 .75-.75h16.5a.75.75 0 0 1 0 1.5H3.75A.75.75 0 0 1 3 12Zm0 5.25a.75.75 0 0 1 .75-.75h16.5a.75.75 0 0 1 0 1.5H3.75a.75.75 0 0 1-.75-.75Z" clip-rule="evenodd" />
                        </svg>
                    </div>


                    <div class="flex items-center justify-center mb-0">
                        <div class=" rounded-full w-20 h-15 flex items-center justify-center mt-10 overflow-hidden">
                            <img src="{{asset('img/logo.png')}}" alt="Logo" class="w-full h-full object-cover" />
                        </div>
                        <div class="ml-4 school-text">
                            <span class="font-bold text-lg hidden md:block mt-10 text-white">Batasan Hills National High School</span>
                        </div>
                    </div>

                    <div class="pt-5">
                        <hr>
                    </div>

                    <nav class="mt-7">
                        <ul class="space-y-2">
                            <li class="hover:bg-gray-200 p-3 rounded-md shadow-sm">
                                <a href="{{ route('admin_dashboard') }}" class="flex items-center justify-center md:justify-start space-x-2 text-white hover:text-black">
                                    <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="currentColor" class="w-7 h-7">
                                        <path d="M111.87-520v-328.13H440V-520H111.87Zm0 408.13V-440H440v328.13H111.87ZM520-520v-328.13h328.13V-520H520Zm0 408.13V-440h328.13v328.13H520Z" />
                                    </svg>

                                    <span class="sidebar-text font-bold">Dashboard</span>
                                </a>
                            </li>
                            <li class="p-3 rounded-md relative">

                                <!-- Dropdown Button -->
                                <button type="button" class="dropdownButton flex items-center w-full p-2 -ml-1 text-base text-white transition duration-75 rounded-lg group hover:bg-gray-100 hover:text-black dark:hover:bg-gray-700" aria-controls="dropdown-example" data-collapse-toggle="dropdown-example">
                                    <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="currentColor" class="w-6 h-7 flex-shrink-0">
                                        <path d="M120-120v-80h80v-640h400v40h160v600h80v80H680v-600h-80v600H120Zm320-320q17 0 28.5-11.5T480-480q0-17-11.5-28.5T440-520q-17 0-28.5 11.5T400-480q0 17 11.5 28.5T440-440Z" />
                                    </svg>
                                    <span class="ml-3 flex-1 sidebar-text font-bold text-left rtl:text-right whitespace-nowrap">Facility</span>
                                    <svg id="dropdownIcon" class="w-3 h-3 transition-transform duration-300 transform" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4" />
                                    </svg>
                                </button>

                                <ul id="dropdownContent" class="hidden py-2 space-y-2">
                                    <li>
                                        <a href="{{route('admin_facilityRegRoom')}}" class="flex items-center w-full sidebar-text p-2 font-bold text-white transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 hover:text-black">Instructional Room</a>
                                    </li>
                                    <li>
                                        <a href="{{route('admin_facilitySpecRoom')}}" class="flex items-center w-full sidebar-text p-2 font-bold text-white transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 hover:text-black">Laboratory Room</a>
                                    </li>
                                    <li>
                                        <a href="{{route('admin_facilityOfficeRoom')}}" class="flex items-center w-full sidebar-text p-2 font-bold text-white transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 hover:text-black">Office Room</a>
                                    </li>
                                </ul>
                            </li>

                            <li class="hover:bg-gray-200 p-3 rounded-md">
                                <a href="#" class="flex items-center justify-center md:justify-start space-x-2 text-white hover:text-black">
                                    <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="currentColor" class="w-7 h-7">
                                        <path d="M438-223.37 293.37-367.76l60.39-60.39L438-343.91l168.24-168.24 60.39 60.39L438-223.37ZM202.87-71.87q-37.78 0-64.39-26.61t-26.61-64.39v-554.26q0-37.78 26.61-64.39t64.39-26.61H240v-80h85.5v80h309v-80H720v80h37.13q37.78 0 64.39 26.61t26.61 64.39v554.26q0 37.78-26.61 64.39t-64.39 26.61H202.87Zm0-91h554.26V-560H202.87v397.13Z" />
                                    </svg>
                                    <span class="sidebar-text font-bold">Event & Activities</span>
                                </a>
                            </li>
                            <li class="p-3 rounded-md relative">
                                <!-- Dropdown Button -->
                                <button type="button" class="dropdownButton flex items-center w-full p-2 -ml-1 text-base text-white transition duration-75 rounded-lg group hover:bg-gray-100 hover:text-black dark:hover:bg-gray-700" aria-controls="dropdown-example" data-collapse-toggle="dropdown-example">
                                    <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="currentColor" class="w-6 h-7 flex-shrink-0">
                                        <path d="M202.87-71.87q-37.78 0-64.39-26.61t-26.61-64.39V-612.2q-18.24-12.43-29.12-31.48-10.88-19.06-10.88-43.02v-110.43q0-37.78 26.61-64.39t64.39-26.61h634.26q37.78 0 64.39 26.61t26.61 64.39v110.43q0 23.96-10.88 43.02-10.88 19.05-29.12 31.48v449.33q0 37.78-26.61 64.39t-64.39 26.61H202.87Zm-40-614.83h634.5v-110.43h-634.5v110.43Zm193.06 292.44H604.3v-86.22H355.93v86.22Z" />
                                    </svg>
                                    <span class="ml-3 flex-1 sidebar-text font-bold text-left rtl:text-right whitespace-nowrap">Inventory</span>
                                    <svg id="dropdownIcon" class="w-3 h-3 transition-transform duration-300 transform" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4" />
                                    </svg>
                                </button>

                                <ul id="dropdownContent" class="hidden py-2 space-y-2">
                                    <li>
                                        <a href="{{ route('admin_supplies') }}" class="flex items-center w-full sidebar-text p-2 font-bold text-white transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 hover:text-black">Supplies</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('admin_equipment') }}" class="flex items-center w-full sidebar-text p-2 font-bold text-white transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 hover:text-black">Equipment</a>

                                    </li>
                                </ul>
                            </li>

                            <li class="p-3 rounded-md relative">
                                <!-- Dropdown Button -->
                                <button type="button" class="dropdownButton flex items-center w-full p-2 -ml-1 text-base text-white transition duration-75 rounded-lg group hover:bg-gray-100 hover:text-black dark:hover:bg-gray-700" aria-controls="dropdown-example" data-collapse-toggle="dropdown-example">
                                    <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="currentColor" class="w-6 h-7 flex-shrink-0">
                                        <path d="M440-240h80v-120h120v-80H520v-120h-80v120H320v80h120v120ZM240-80q-33 0-56.5-23.5T160-160v-640q0-33 23.5-56.5T240-880h320l240 240v480q0 33-23.5 56.5T720-80H240Zm280-520h200L520-800v200Z" />
                                    </svg>
                                    <span class="ml-3 flex-1 sidebar-text font-bold text-left rtl:text-right whitespace-nowrap">Request</span>
                                    <svg id="dropdownIcon" class="w-3 h-3 transition-transform duration-300 transform" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4" />
                                    </svg>
                                </button>

                                <ul id="dropdownContent" class="hidden py-2 space-y-2">
                                    <li>
                                        <a href="{{ route('admin_approvalSupplies') }}" class="flex items-center w-full sidebar-text p-2 font-bold text-white transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 hover:text-black">Request Supplies</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('admin_approvalEquipment') }}" class="flex items-center w-full sidebar-text p-2 font-bold text-white transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 hover:text-black">Request Equipment</a>

                                    </li>
                                </ul>
                            </li>

                            <li class="p-3 rounded-md relative">
                            <!-- Dropdown Button -->
                            <button type="button" class="dropdownButton flex items-center w-full p-2 -ml-1 text-base text-white transition duration-75 rounded-lg group hover:bg-gray-100 hover:text-black dark:hover:bg-gray-700" aria-controls="dropdown-example" data-collapse-toggle="dropdown-example">
                                <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="currentColor" class="w-6 h-7 flex-shrink-0">
                                    <path d="M686-132 444-376q-20 8-40.5 12t-43.5 4q-100 0-170-70t-70-170q0-36 10-68.5t28-61.5l146 146 72-72-146-146q29-18 61.5-28t68.5-10q100 0 170 70t70 170q0 23-4 43.5T584-516l244 242q12 12 12 29t-12 29l-84 84q-12 12-29 12t-29-12Z" />
                                </svg>
                                <span class="ml-3 flex-1 sidebar-text font-bold text-left rtl:text-right whitespace-nowrap">Maintenance</span>
                                <svg id="dropdownIcon" class="w-3 h-3 transition-transform duration-300 transform" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4" />
                                </svg>
                            </button>

                            <ul id="dropdownContent" class="hidden py-2 space-y-2">
                                <li>
                                    <a href="#" class="flex items-center w-full sidebar-text p-2 font-bold text-white transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 hover:text-black">Maintenance Facility</a>
                                </li>
                                <li>
                                    <a href="{{ route('admin_mainteInventory') }}" class="flex items-center w-full sidebar-text p-2 font-bold text-white transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 hover:text-black">Maintenance Inventory</a>
                                </li>
                            </ul>
                        </li>
                        </ul>
                    </nav>
                </div>
            </aside>

            <!-- Main Content -->
            <main id="main-content" class="flex-1 p-8 transition-all duration-300 ease-in-out ml-80">

                <header class="flex justify-end mb-8">
                    <div class="bg-gray-200 rounded-full px-4 py-2 inline-flex items-center space-x-4">
                        <div>
                            <span class="font-semibold text-black">Andres Santiago</span>
                            <p class="text-gray-600 text-xs pl-11">administrator</p>
                        </div>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-7 h-7">
                            <path fillRule="evenodd" d="M12.53 16.28a.75.75 0 0 1-1.06 0l-7.5-7.5a.75.75 0 0 1 1.06-1.06L12 14.69l6.97-6.97a.75.75 0 1 1 1.06 1.06l-7.5 7.5Z" clipRule="evenodd" />
                        </svg>

                    </div>
                </header>
                <section>
                    <div class="flex items-center pb-8">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" strokeWidth="1.5" stroke="currentColor" class="w-7 h-7">
                            <path strokeLinecap="round" strokeLinejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
                        </svg>
                        <h1 class="text-3xl font-bold ml-2">Inventory Supplies</h1>
                    </div>

                    <!-- Breadcrumbs -->
                    <nav class="flex px-5 py-3 text-gray-700 border border-gray-200 rounded-lg bg-gray-50 dark:bg-gray-800 dark:border-gray-700" aria-label="Breadcrumb">
                        <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
                            <li class="inline-flex items-center">
                                <a href="{{ route('admin_supplies') }}" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600 dark:text-gray-400 dark:hover:text-white">
                                    Inventory
                                </a>
                            </li>
                            <li>
                                <div class="flex items-center">
                                    <svg class="rtl:rotate-180 block w-3 h-3 mx-1 text-gray-400 " aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4" />
                                    </svg>
                                    <a href="#" class="ms-1 text-sm font-medium text-gray-700 hover:text-blue-600 md:ms-2 dark:text-gray-400 dark:hover:text-white">Supplies</a>
                                </div>
                            </li>

                        </ol>
                    </nav>

                    <!-- Add additional content here -->
                    <div class="bg-gray-100 h-auto rounded-lg ">

                        <div class="flex justify-between items-center mt-4 px-9 py-2">
                            <!-- Left-Aligned Buttons -->
                            <div>
                                <a href="{{ route('admin_supplies') }}" class="button border-b-2 border-blue-500 py-2 px-4 transition-all duration-300 translate-x-2">Supplies</a>
                                <a href="{{ route('admin_suppliesHistory')}}" class="button border-b-2 py-2 px-4 transition-all duration-300 translate-x-2">History</a>
                                <a href="{{ route('admin_suppliesUsed')}}" class="button border-b-2 py-2 px-4 transition-all duration-300 translate-x-2">Used</a>
                            </div>

                            <!-- Date Picker -->


                            <!-- Search Bar -->
                            <div class="flex items-center space-x-4">

                                <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 w-full sr-only dark:text-white">Search</label>
                                <form id="suppliesSearchForm" class="flex items-center space-x-4">
                                    <div class="relative w-96">
                                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                            <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                                            </svg>
                                        </div>
                                        <input type="search" id="suppliesSearch" name="suppliesSearch" class="block w-full p-4 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search" />
                                        <button type="submit" class="text-white absolute right-2.5 top-1/2 transform -translate-y-1/2 bg-blue-500 hover:bg-blue-600 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Search</button>
                                    </div>

                                    <!-- Add Item Button-->
                                    <button id="SuppliesFormButton" class="bg-blue-500 text-white p-2 rounded hover:bg-blue-600">Add Item</button>
                            </div>
                        </div>

                        <!-- Floating Card with Form (Initially Hidden) -->
                        <div id="SuppliesFormCard" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
                            <div class="bg-white p-4 rounded-lg shadow-lg max-w-xl w-full">
                                <h2 class="text-xl font-bold mb-4">Add New Supplies</h2>

                                <form action="{{ route('supplies.store') }}" method="POST">
                                    @csrf
                                    <!-- Input Fields -->
                                    <div class="grid grid-cols-2 gap-2">

                                        <div>
                                            <label for="SuppliesControlNo" class="block text-sm font-semibold mb-1">Control Number</label>
                                            <input type="text" name="SuppliesControlNo" id="SuppliesControlNo" class="border border-gray-400 p-2 rounded w-full mb-2" placeholder="Control Number">
                                        </div>

                                        <div>
                                            <label for="SuppliesBrandName" class="block text-sm font-semibold mb-1">Brand Name</label>
                                            <input type="text" name="SuppliesBrandName" id="SuppliesBrandName" class="border border-gray-400 p-2 rounded w-full mb-2" placeholder="Brand Name">
                                        </div>

                                        <div>
                                            <label for="SuppliesName" class="block text-sm font-semibold mb-1">Supplies Name</label>
                                            <input type="text" name="SuppliesName" id="SuppliesName" class="border border-gray-400 p-2 rounded w-full mb-2" placeholder="Supplies Name">
                                        </div>

                                        <div>
                                            <label for="SuppliesCategory" class="block text-sm font-semibold mb-1">Category</label>
                                            <select name="SuppliesCategory" id="SuppliesCategory" class="border p-2 rounded w-full mb-2 border-gray-400">
                                                <option value="" disabled selected>Select a category</option>
                                                <option value="textbook">Textbook</option>
                                                <option value="office">Office Supplies</option>
                                                <option value="electronics">Electronics</option>
                                                <option value="other">Other</option>
                                                <!-- Add more options as needed -->
                                            </select>
                                        </div>

                                        <div id="otherSuppCategoryDiv" class="hidden">
                                            <label for="otherCategory" class="block text-sm font-semibold mb-1">Other Category</label>
                                            <input type="text" name="otherCategory" id="otherSuppCategory" class="border border-gray-400 p-2 rounded w-full mb-2" placeholder="Enter category">
                                        </div>

                                        <div>
                                            <label for="SuppliesType" class="block text-sm font-semibold mb-1">Type</label>
                                            <input type="text" name="SuppliesType" id="SuppliesType" class="border border-gray-400 p-2 rounded w-full mb-2" placeholder="Type" pattern="[A-Za-z ]*" title="Only characters are allowed">
                                        </div>

                                        <div>
                                            <label for="SuppliesColor" class="block text-sm font-semibold mb-1">Color</label>
                                            <input type="text" name="SuppliesColor" id="SuppliesColor" class="border border-gray-400 p-2 rounded w-full mb-2" placeholder="Color" pattern="[A-Za-z ]*" title="Only characters are allowed">
                                        </div>

                                        <div>
                                            <label for="SuppliesUnit" class="block text-sm font-semibold mb-1">Unit</label>
                                            <input type="text" name="SuppliesUnit" id="SuppliesUnit" class="border border-gray-400 p-2 rounded w-full mb-2" placeholder="Unit" pattern="[A-Za-z ]*" title="Only characters are allowed">
                                        </div>

                                        <div>
                                            <label for="SuppliesQuantity" class="block text-sm font-semibold mb-1">Quantity</label>
                                            <input type="number" name="SuppliesQuantity" id="SuppliesQuantity" class="border p-2 rounded w-full mb-2 border-gray-400" placeholder="Quantity">
                                        </div>

                                        <div>
                                            <label for="SuppliesDate" class="block text-sm font-semibold mb-1">Date</label>
                                            <input type="text" id="SuppliesDate" name="SuppliesDate" datepicker datepicker-format="yyyy-mm-dd" class="border  border-gray-400 p-2 rounded w-full mb-4" placeholder="YYYY-MM-DD">
                                        </div>

                                        <div>
                                            <label for="SuppliesUnitPrice" class="block text-sm font-semibold mb-1">Unit Price</label>
                                            <input type="number" name="SuppliesUnitPrice" id="SuppliesUnitPrice" class="border p-2 rounded w-full mb-4 border-gray-400" placeholder="Price">
                                        </div>

                                        <div>
                                            <label for="SuppliesClassification" class="block text-sm font-semibold mb-1">Classification</label>
                                            <input type="text" name="SuppliesClassification" id="SuppliesClassification" class="border p-2 rounded w-full mb-4 border-gray-400" placeholder="Classification">
                                        </div>


                                        <div>
                                            <label for="SuppliesSKU" class="block text-sm font-semibold mb-1">SKU</label>
                                            <input type="text" id="SuppliesSKU" class="border p-2 rounded w-full mb-2 border-gray-400" placeholder="SKU">
                                        </div>

                                        <div>
                                            <label for="SuppliesSerialNo" class="block text-sm font-semibold mb-1">Serial Number</label>
                                            <input type="text" name="SuppliesSerialNo" id="SuppliesSerialNo" class="border border-gray-400 p-2 rounded w-full mb-2" placeholder="Serial Number">
                                        </div>
                                    </div>

                                    <!-- Save and Close Buttons -->
                                    <div class="flex justify-end space-x-2">
                                        <button id="SuppliesCloseFormButton" class="bg-red-500 hover:bg-red-600 text-white p-2 rounded">Close</button>
                                        <button id="SuppliesSaveButton" type="button" data-id="supplies" class="bg-green-500 hover:bg-green-600 text-white p-2 rounded">Save</button>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <!-- Table -->
                        <div class="relative shadow-md sm:rounded-lg px-9 py-5 ">
                            <table id="dynamicTable" class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                <thead class="text-sm text-white dark:text-gray-400">
                                    <tr>
                                        <th scope="col" class="px-6 py-3">
                                            Brand Name
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Supplies Name
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Category
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Quantity
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Total
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            SKU
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Actions
                                        </th>
                                    </tr>
                                </thead>
                                <tbody id="tableBody">
                                    @foreach($supplies as $item)
                                    <tr class="odd:bg-blue-100 odd:dark:bg-gray-900 even:bg-white even:dark:bg-gray-800 border-b dark:border-gray-700" data-id="{{$item->id}}">
                                        <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">{{$item->SuppliesName}}</td>
                                        <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">{{$item->SuppliesCategory}}</td>
                                        <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">{{$item->SuppliesQuantity}}</td>
                                        <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">{{$item->SuppliesDate}}</td>
                                        <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">₱{{number_format($item->SuppliesPrice,2)}}</td>
                                        <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">{{$item->SuppliesSKU}}</td>
                                        <td class="px-6 py-4 border-b border-gray-300">
                                            <button id="viewSuppButton" type="button">
                                                <svg class="w-[27px] h-[27px] text-green-600 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                                    <path stroke="currentColor" stroke-width="2" d="M21 12c0 1.2-4.03 6-9 6s-9-4.8-9-6c0-1.2 4.03-6 9-6s9 4.8 9 6Z" />
                                                    <path stroke="currentColor" stroke-width="2" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                                </svg>
                                            </button>
                                            <button id="editSuppButton" type="button">
                                                <svg class="w-[27px] h-[27px] text-blue-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                                    <path fill-rule="evenodd" d="M11.32 6.176H5c-1.105 0-2 .949-2 2.118v10.588C3 20.052 3.895 21 5 21h11c1.105 0 2-.948 2-2.118v-7.75l-3.914 4.144A2.46 2.46 0 0 1 12.81 16l-2.681.568c-1.75.37-3.292-1.263-2.942-3.115l.536-2.839c.097-.512.335-.983.684-1.352l2.914-3.086Z" clip-rule="evenodd" />
                                                    <path fill-rule="evenodd" d="M19.846 4.318a2.148 2.148 0 0 0-.437-.692 2.014 2.014 0 0 0-.654-.463 1.92 1.92 0 0 0-1.544 0 2.014 2.014 0 0 0-.654.463l-.546.578 2.852 3.02.546-.579a2.14 2.14 0 0 0 .437-.692 2.244 2.244 0 0 0 0-1.635ZM17.45 8.721 14.597 5.7 9.82 10.76a.54.54 0 0 0-.137.27l-.536 2.84c-.07.37.239.696.588.622l2.682-.567a.492.492 0 0 0 .255-.145l4.778-5.06Z" clip-rule="evenodd" />
                                                </svg>
                                            </button>
                                        </td>
                                    </tr>
                                    @endforeach
                                    <!-- Dynamic rows will be inserted here -->
                                </tbody>
                            </table>

                            <!-- Edit 1 Popup Card -->
                            <div id="editSuppModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
                                <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-md">
                                    <!-- Flex container for heading and close button -->
                                    <div class="flex justify-between items-center mb-4">
                                        <h2 class="text-2xl font-semibold">Edit Supplies</h2>
                                        <button id="closeSuppFormButton" class="text-gray-500 hover:text-gray-700">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                            </svg>
                                        </button>
                                    </div>
                                    <form id="editForm" action="{{ route('supplies.update') }}" method="POST">
                                        <input type="hidden" name="id" id="suppliesId">

                                        <label for="SuppliesBrandName" class="block text-sm font-semibold mb-1">Brand Name</label>
                                        <input type="text" name="SuppliesBrandName" id="SuppliesBrandNameEdit" class="border border-gray-400 p-2 rounded w-full mb-2" placeholder="Brand Name">

                                        <label for="SuppliesName" class="block text-sm font-semibold mb-1">Supplies Name</label>
                                        <input type="text" name="SuppliesName" id="SuppliesNameEdit" class="border border-gray-400 p-2 rounded w-full mb-2" placeholder="Supplies Name">

                                        <label for="SuppliesCategory" class="block text-sm font-semibold mb-1">Category</label>
                                        <select name="SuppliesCategory" id="SuppliesCategoryEdit" class="border p-2 rounded w-full mb-2 border-gray-400">
                                            <option value="" disabled selected>Select a category</option>
                                            <option value="textbook">Textbook</option>
                                            <option value="office">Office Supplies</option>
                                            <option value="electronics">Electronics</option>
                                            <!-- Add more options as needed -->
                                        </select>

                                        <label for="SuppliesSKU" class="block text-sm font-semibold mb-1">SKU</label>
                                        <input type="text" name="SuppliesSKU" id="SuppliesSKUEdit" class="border p-2 rounded w-full mb-2 border-gray-400" placeholder="SKU">

                                        <div class="flex justify-end space-x-2">
                                            <button type="button" id="saveSuppButton" class="bg-green-500 hover:bg-green-600 text-white p-2 rounded">Save</button>
                                            <button type="button" id="condemnSuppButton" class="bg-yellow-500 hover:bg-yellow-600 text-white p-2 rounded">Condemn</button>
                                            <button type="button" id="deleteSuppButton" class="bg-red-500 hover:bg-red-600 text-white p-2 rounded">Delete</button>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <!-- View 1 Popup Card -->
                            <div id="ViewSuppModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 hidden">
                                <div class="bg-white p-4 rounded-lg shadow-lg w-full max-w-8xl h-auto overflow-auto">
                                    <div class="flex justify-between items-center mb-4">
                                        <h2 class="text-lg font-semibold px-7">View Full Information</h2>
                                        <button id="closeViewSuppFormButton" class="text-gray-500 hover:text-gray-700">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                            </svg>
                                        </button>
                                    </div>

                                    <div class="relative shadow-md sm:rounded-lg px-9 py-5">
                                        <table id="ViewDynamicTable" class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                            <thead class="text-sm text-white dark:text-gray-400">
                                                <tr>
                                                    <th scope="col" class="px-6 py-3">
                                                        Serial Number
                                                    </th>
                                                    <th scope="col" class="px-6 py-3">
                                                        Control Number
                                                    </th>
                                                    <th scope="col" class="px-6 py-3">
                                                        Brand Name
                                                    </th>
                                                    <th scope="col" class="px-6 py-3">
                                                        Equipment Name
                                                    </th>
                                                    <th scope="col" class="px-6 py-3">
                                                        Unit
                                                    </th>
                                                    <th scope="col" class="px-6 py-3">
                                                        Unit Price
                                                    </th>
                                                    <th scope="col" class="px-6 py-3">
                                                        Classification
                                                    </th>
                                                    <th scope="col" class="px-6 py-3">
                                                        Date
                                                    </th>
                                                    <th scope="col" class="px-6 py-3">
                                                        Actions
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody id="tableViewBody">
                                                @foreach($supplies as $item)
                                                <tr class="odd:bg-blue-100 odd:dark:bg-gray-900 even:bg-white even:dark:bg-gray-800 border-b dark:border-gray-700" data-id="{{$item->id}}">
                                                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">{{$item->SuppliesSerialNo}}</td>
                                                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">{{$item->SuppliesControlNo}}</td>
                                                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">{{$item->SuppliesBrandName}}</td>
                                                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">{{$item->SuppliesName}}</td>
                                                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">{{$item->SuppliesUnit}}</td>
                                                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">₱{{number_format($item->SuppliesUnitPrice, 2)}}</td>
                                                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">{{$item->SuppliesClassification}}</td>
                                                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">{{$item->SuppliesDate}}</td>
                                                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                        <button id="viewSuppBTN" type="button">
                                                            <svg class="w-[27px] h-[27px] text-green-600 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                                                <path stroke="currentColor" stroke-width="2" d="M21 12c0 1.2-4.03 6-9 6s-9-4.8-9-6c0-1.2 4.03-6 9-6s9 4.8 9 6Z" />
                                                                <path stroke="currentColor" stroke-width="2" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                                            </svg>
                                                        </button>
                                                        <button id="editSuppBTN" type="button">
                                                            <svg class="w-[27px] h-[27px] text-blue-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                                                <path fill-rule="evenodd" d="M11.32 6.176H5c-1.105 0-2 .949-2 2.118v10.588C3 20.052 3.895 21 5 21h11c1.105 0 2-.948 2-2.118v-7.75l-3.914 4.144A2.46 2.46 0 0 1 12.81 16l-2.681.568c-1.75.37-3.292-1.263-2.942-3.115l.536-2.839c.097-.512.335-.983.684-1.352l2.914-3.086Z" clip-rule="evenodd" />
                                                                <path fill-rule="evenodd" d="M19.846 4.318a2.148 2.148 0 0 0-.437-.692 2.014 2.014 0 0 0-.654-.463 1.92 1.92 0 0 0-1.544 0 2.014 2.014 0 0 0-.654.463l-.546.578 2.852 3.02.546-.579a2.14 2.14 0 0 0 .437-.692 2.244 2.244 0 0 0 0-1.635ZM17.45 8.721 14.597 5.7 9.82 10.76a.54.54 0 0 0-.137.27l-.536 2.84c-.07.37.239.696.588.622l2.682-.567a.492.492 0 0 0 .255-.145l4.778-5.06Z" clip-rule="evenodd" />
                                                            </svg>
                                                        </button>
                                                        <button id="addSuppBTN" type="button">
                                                            <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#5f6368">
                                                                <path d="M440-440H200v-80h240v-240h80v240h240v80H520v240h-80v-240Z" />
                                                            </svg>
                                                        </button>
                                                    </td>
                                                </tr>
                                                @endforeach
                                                <!-- Dynamic rows will be inserted here -->
                                            </tbody>
                                        </table>
                                    </div>

                                </div>
                            </div>
                            <!-- END OF View 1 Popup Card -->

                            <!-- Edit 2 Popup Card -->
                            <div id="editFullSuppModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 hidden">
                                <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-md h-auto overflow-auto">
                                    <!-- Flex container for heading and close button -->
                                    <div class="flex justify-between items-center mb-4">
                                        <h2 class="text-2xl font-semibold">Edit Supplies</h2>
                                        <button id="closeEditFullSuppModal" class="text-gray-500 hover:text-gray-700">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                            </svg>
                                        </button>
                                    </div>
                                    <form id="editFullSuppForm" action="{{ route('supplies.update') }}" method="POST">

                                        <input type="hidden" name="id" id="suppliesId">

                                        <label for="FullSuppliesSerialNoEdit" class="block text-sm font-semibold mb-1">Serial Number</label>
                                        <input type="text" name="FullSuppliesSerialNoEdit" id="FullSuppliesSerialNoEdit" class="border border-gray-400 p-2 rounded w-full mb-2" placeholder="Serial Number">

                                        <label for="FullSuppliesControlNoEdit" class="block text-sm font-semibold mb-1">Control Number</label>
                                        <input type="text" name="FullSuppliesControlNoEdit" id="FullSuppliesControlNoEdit" class="border border-gray-400 p-2 rounded w-full mb-2" placeholder="Control Number">

                                        <label for="FullSuppliesTypeEdit" class="block text-sm font-semibold mb-1">Type</label>
                                        <input type="text" name="FullSuppliesTypeEdit" id="FullSuppliesTypeEdit" class="border border-gray-400 p-2 rounded w-full mb-2" placeholder="Type" pattern="[A-Za-z ]*" title="Only characters are allowed">

                                        <label for="FullSuppliesColorEdit" class="block text-sm font-semibold mb-1">Color</label>
                                        <input type="text" name="FullSuppliesColorEdit" id="FullSuppliesColorEdit" class="border border-gray-400 p-2 rounded w-full mb-2" placeholder="Color" pattern="[A-Za-z ]*" title="Only characters are allowed">

                                        <label for="FullSuppliesUnitEdit" class="block text-sm font-semibold mb-1">Unit</label>
                                        <input type="text" name="FullSuppliesUnitEdit" id="FullSuppliesUnitEdit" class="border border-gray-400 p-2 rounded w-full mb-2" placeholder="Unit" pattern="[A-Za-z ]*" title="Only characters are allowed">

                                        <label for="FullSuppliesUnitPriceEdit" class="block text-sm font-semibold mb-1">Unit Price</label>
                                        <input type="number" name="FullSuppliesUnitPriceEdit" id="FullSuppliesUnitPriceEdit" class="border border-gray-400 p-2 rounded w-full mb-4" placeholder="Price">

                                        <label for="FullSuppliesClassificationEditn" class="block text-sm font-semibold mb-1">Classification</label>
                                        <input type="text" name="FullSuppliesClassificationEdit" id="FullSuppliesClassificationEdit" class="border border-gray-400 p-2 rounded w-full mb-2" placeholder="Classification" pattern="[A-Za-z ]*" title="Only characters are allowed">

                                        <label for="FullSuppliesDateEdit" class="block text-sm font-semibold mb-1">Date</label>
                                        <input type="text" id="FullSuppliesDateEdit" name="FullSuppliesDateEdit" datepicker datepicker-format="yyyy-mm-dd" class="border border-gray-400 p-2 rounded w-full mb-4" placeholder="YYYY-MM-DD">


                                        <div class="flex justify-end space-x-2">
                                            <button type="button" id="saveFullSuppButton" class="bg-green-500 hover:bg-green-600 text-white p-2 rounded">Save</button>
                                            <button type="button" id="condFullSuppButton" class="bg-yellow-500 hover:bg-yellow-600 text-white p-2 rounded">Condemn</button>
                                            <button type="button" id="deleteFullSupppButton" class="bg-red-500 hover:bg-red-600 text-white p-2 rounded">Delete</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <!-- END OF Edit 2 Popup Card -->

                            <!-- Add Pop Up Card -->
                            <div id="AddSuppFormCard" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 hidden">
                                <div class="bg-white p-4 rounded-lg shadow-lg max-w-xl w-full">
                                    <h2 class="text-xl font-bold mb-4">Add Supplies</h2>

                                    <form id="SuppliesForm" action="" method="">
                                        @csrf
                                        <!-- Grid for Input Fields -->
                                        <div class="grid grid-cols-2 gap-2">
                                            <!-- First column label/input -->
                                            <div>
                                                <label for="SuppliesControlNo" class="block text-sm font-semibold mb-1">Control Number</label>
                                                <input type="text" name="SuppliesControlNo" id="AddSuppliesControlNo" class="border border-gray-400 p-2 rounded w-full mb-2" placeholder="Control Number">
                                            </div>

                                            <div>
                                                <label for="SuppliesType" class="block text-sm font-semibold mb-1">Type</label>
                                                <input type="text" name="SuppliesType" id="AddSuppliesType" class="border border-gray-400 p-2 rounded w-full mb-2" placeholder="Type" pattern="[A-Za-z ]*" title="Only characters are allowed">
                                            </div>
                                            <div>
                                                <label for="SuppliesColor" class="block text-sm font-semibold mb-1">Color</label>
                                                <input type="text" name="SuppliesColor" id="AddSuppliesColor" class="border border-gray-400 p-2 rounded w-full mb-2" placeholder="Color" pattern="[A-Za-z ]*" title="Only characters are allowed">
                                            </div>

                                            <div>
                                                <label for="SuppliesUnit" class="block text-sm font-semibold mb-1">Unit</label>
                                                <input type="text" name="SuppliesUnit" id="AddSuppliesUnit" class="border border-gray-400 p-2 rounded w-full mb-2" placeholder="Unit" pattern="[A-Za-z ]*" title="Only characters are allowed">
                                            </div>
                                            <div>
                                                <label for="SuppliesQuantity" class="block text-sm font-semibold mb-1">Quantity</label>
                                                <input type="number" name="SuppliesQuantity" id="AddSuppliesQuantity" class="border border-gray-400 p-2 rounded w-full mb-2" placeholder="Quantity">
                                            </div>

                                            <div>
                                                <label for="SuppliesDate" class="block text-sm font-semibold mb-1">Date</label>
                                                <input type="text" id="AddSuppliesDate" name="SuppliesDate" datepicker datepicker-format="yyyy-mm-dd" class="border border-gray-400 p-2 rounded w-full mb-4" placeholder="YYYY-MM-DD">
                                            </div>
                                            <div>
                                                <label for="SuppliesUnitPrice" class="block text-sm font-semibold mb-1">Unit Price</label>
                                                <input type="number" name="SuppliesUnitPrice" id="AddSuppliesUnitPrice" class="border border-gray-400 p-2 rounded w-full mb-4" placeholder="Price">
                                            </div>

                                            <div>
                                                <label for="SuppliesClassification" class="block text-sm font-semibold mb-1">Classification</label>
                                                <input type="text" name="SuppliesClassification" id="AddSuppliesClassification" class="border border-gray-400 p-2 rounded w-full mb-2" placeholder="Classification" pattern="[A-Za-z ]*" title="Only characters are allowed">
                                            </div>

                                            <div>
                                                <label for="SuppliesSerialNo" class="block text-sm font-semibold mb-1">Serial Number</label>
                                                <input type="text" name="SuppliesSerialNo" id="AddSuppliesSerialNo" class="border border-gray-400 p-2 rounded w-full mb-2" placeholder="Serial Number">
                                            </div>
                                        </div>

                                        <!-- Save and Close Buttons -->
                                        <div class="flex justify-end space-x-2 mt-4">
                                            <button id="AddSuppCloseFormButton" class="bg-red-500 hover:bg-red-600 text-white p-2 rounded">Close</button>
                                            <button id="AddSuppSaveFormButton" type="button" data-id="supplies" class="bg-green-500 hover:bg-green-600 text-white p-2 rounded">Save</button>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <!-- END OF Add Pop Up Card -->

                            <!-- View 2 Table Pop Up Card -->
                            @foreach($supplies as $item)
                            <div id="ViewFullSuppModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 hidden" data-id="{{$item->id}}">
                                <div class="bg-white p-4 rounded-lg shadow-lg max-w-md w-full">
                                    <div class="flex justify-between items-center mb-4">
                                        <h2 class="text-lg font-semibold">Final Viewing</h2>
                                        <button id="closeViewFullSuppModal" class="text-gray-500 hover:text-gray-700">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                            </svg>
                                        </button>
                                    </div>
                                    <div class="text-sm text-gray-700 mb-4">
                                        <p><strong>Serial Number:</strong>{{$item->SuppliesSerialNo}}</p>
                                        <p><strong>Control Number:</strong>{{$item->SuppliesControlNo}}</p>
                                        <p><strong>Brand Name:</strong>{{$item->SuppliesBrandName}}</p>
                                        <p><strong>Product Name:</strong>{{$item->SuppliesName}}</p>
                                        <p><strong>Category:</strong>{{$item->SuppliesCategory}}</p>
                                        <p><strong>Type:</strong>{{$item->SuppliesType}}</p>
                                        <p><strong>Color:</strong>{{$item->SuppliesColor}}</p>
                                        <p><strong>Unit:</strong>{{$item->SuppliesUnit}}</p>
                                        <p><strong>Unit Price:</strong>₱{{number_format($item->SuppliesUnitPrice, 2)}}</p>
                                        <p><strong>Classification:</strong>{{$item->SuppliesClassification}}</p>
                                        <p><strong>Date:</strong>{{$item->SuppliesDate}}</p>
                                    </div>

                                </div>
                            </div>
                            @endforeach
                            <!-- END OF View 2 Table Pop Up Card -->
                        </div>

                    </div>
        </div>

        <!-- Popup Card -->
        </section>
        </main>
        </div>

    </body>

    </html>