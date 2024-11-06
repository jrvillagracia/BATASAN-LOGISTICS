<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Request | BHNHS</title>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js"></script>
    <script src="{{asset('js/jquery.js')}}"></script>
    <script src="{{asset('js/main.js')}}"></script>
    <script src="{{asset('js/admin_requestEquipment.js')}}"></script>
    <script src="https://cdn.tailwindcss.com"></script>

    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@9.0.3"></script>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.1/dist/flowbite.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.1/dist/flowbite.min.css" rel="stylesheet" />

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.12.4/dist/sweetalert2.all.min.js"></script>

    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,500,0,0" />
    <link rel="stylesheet" href="{{asset('css/admin.css')}}">
    <link rel="stylesheet" href="{{asset('css/admin_requestEquipment.css')}}">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <!-- <link rel="stylesheet" href="https://cdn.datatables.net/2.1.4/css/dataTables.dataTables.min.css"> -->


    <!-- <script src="https://cdn.datatables.net/2.1.4/js/dataTables.min.js"></script> -->

</head>

<body class="h-screen overflow-x-hidden">
    <div class="flex">
        <!-- Sidebar --> <!-- May na Update dito -->
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
                            <a href="{{route('admin_eventsForApproval')}}" class="flex items-center justify-center md:justify-start space-x-2 text-white hover:text-black">
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




        <!-- Main Content --> <!-- EASE IN OUT n MARGIN SIZE-->
        <main id="main-content" class="flex-1 p-8 transition-all duration-300 ease-in-out ml-80">
            <header class="flex justify-end mb-8">
                <div class="bg-gray-200 rounded-full px-4 py-2 inline-flex items-center space-x-4">
                    <div>
                        <span class="font-semibold text-black">Andres Santiago</span>
                        <p class="text-gray-600 text-xs pl-11">administrator</p>
                    </div>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-9 h-9">
                        <path fillRule="evenodd" d="M12.53 16.28a.75.75 0 0 1-1.06 0l-7.5-7.5a.75.75 0 0 1 1.06-1.06L12 14.69l6.97-6.97a.75.75 0 1 1 1.06 1.06l-7.5 7.5Z" clipRule="evenodd" />
                    </svg>

                </div>
            </header>
            <section>
                <div class="flex items-center pb-8">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" strokeWidth="1.5" stroke="currentColor" class="w-9 h-9">
                        <path strokeLinecap="round" strokeLinejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
                    </svg>
                    <h1 class="text-3xl font-bold ml-2">Inventory Request Equipment</h1>
                </div>

                <!-- Breadcrumb -->
                <nav class="flex px-5 py-3 text-gray-700 border border-gray-200 rounded-lg bg-gray-50 dark:bg-gray-800 dark:border-gray-700" aria-label="Breadcrumb">
                    <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
                        <li class="inline-flex items-center">
                            <a href="#" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600 dark:text-gray-400 dark:hover:text-white">
                                Request
                            </a>
                        </li>
                        <li>
                            <div class="flex items-center">
                                <svg class="rtl:rotate-180 block w-3 h-3 mx-1 text-gray-400 " aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4" />
                                </svg>
                                <a href="#" class="ms-1 text-sm font-medium text-gray-700 hover:text-blue-600 md:ms-2 dark:text-gray-400 dark:hover:text-white">For Release</a>
                            </div>
                        </li>
                        <!-- Add additional breadcrumbs here -->

                    </ol>
                </nav>


                <!-- Add additional content here -->
                <!-- TABLE -->
                <div class="bg-gray-100 h-auto rounded-lg ">

                    <div class="flex justify-between items-center mt-4 px-9 py-2">
                        <!-- Left-Aligned Buttons -->
                        <div id="tabs-container" class="relative">
                            <a href="{{route('admin_approvalEquipment')}}" class="button border-b-2 py-2 px-4 transition-all duration-300 translate-x-2">For Approval</a>
                            <a href="{{route('admin_releaseEquipment')}}" class="button border-b-2 border-blue-500 py-2 px-4 transition-all duration-300 translate-x-2">For Release</a>
                            <a href="{{route('admin_com_rqstEquipment')}}" class="button border-b-2 py-2 px-4 transition-all duration-300 translate-x-2">Completed Request</a>
                        </div>

                        <!-- Search Bar -->
                        <div class=" flex items-center space-x-4">
                            <!-- Add Item Button -->
                            <button id="ReqEquipFormBtn" class="bg-blue-500 text-white p-2 rounded hover:bg-blue-600">&plus; Add Request</button>
                        </div>
                    </div>

                    <!-- Floating Card with Form (Initially Hidden) -->
                    <div id="ReqEquipFormCard" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
                        <div class="bg-white p-4 rounded-lg shadow-lg max-w-md w-full">

                            <div class="flex justify-between items-center mb-4">
                                <h2 class="text-xl font-bold mb-4">Add Request Equipment</h2>
                                <button id="ReqEquipCloseFormBtn" class="text-gray-500 hover:text-gray-700">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </button>
                            </div>

                            <form id="ReqEquipForm">
                                <div class="mb-4">
                                    <label for="name" class="block text-sm font-semibold mb-2">Name:</label>
                                    <input type="text" id="name" class="w-full px-2 py-1 border border-gray-400 rounded">
                                </div>

                                <div class="mb-4">
                                    <label for="department" class="block text-sm font-semibold mb-2">Department:</label>
                                    <select id="EquipmentDepartment" class="w-full px-2 py-1 border border-gray-400 rounded">
                                        <option value="">Select Department</option>
                                        <option value="hr">HR</option>
                                        <option value="it">IT</option>
                                        <option value="sales">Sales</option>
                                    </select>
                                </div>

                                <div class="mb-4">
                                    <label for="ReqEquipDate" class="block text-sm font-semibold mb-2">Date:</label>
                                    <input type="text" id="ReqEquipDate" name="ReqEquipDate" datepicker datepicker-format="yyyy-mm-dd" class="border  border-gray-400 p-2 rounded w-full mb-4" placeholder="YYYY-MM-DD">
                                </div>

                                <div class="mb-4">
                                    <label for="ReqEquipReason" class="block text-sm font-semibold mb-2">Reason:</label>
                                    <input type="text" id="ReqEquipReason" class="w-full px-2 py-1 border border-gray-400 rounded">
                                </div>

                                <div class="mb-4">
                                    <label for="ReqEquipRemarks" class="block text-sm font-semibold mb-2">Remarks:</label>
                                    <textarea id="ReqEquipRemarks" class="w-full px-2 py-1 border border-gray-400 rounded h-20"></textarea>
                                </div>

                                <div class="flex justify-end space-x-2">
                                    <button id="ReqEquipCancelFormBtn" type="button" class="bg-red-500 hover:bg-red-600 text-white py-2 px-4 rounded">Cancel</button>
                                    <button id="ReqEquipSubmitFormBtn" type="button" class="bg-green-500 hover:bg-green-600 text-white py-2 px-4 rounded">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Table -->
                    <div class="relative shadow-md sm:rounded-lg px-9 py-5">
                        <table id="reqEquipTable" class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                            <thead class="text-sm text-white dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3">
                                        Status
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Name
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Department
                                    </th>
                                    <th scope="col" class="px-6 py-30">
                                        Date
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Actions
                                    </th>
                            </thead>
                            <tbody id="tableBody" class="">

                                <tr class="odd:bg-blue-100 odd:dark:bg-gray-900 even:bg-white even:dark:bg-gray-800 border-b dark:border-gray-700 " data-index="" data-id="">
                                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">Waiting for Pick Up</td>
                                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">VicThor</td>
                                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">Faculty Teacher</td>
                                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">2024-08-23</td>
                                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        <button id="ViewEquipBtn" type="button" class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded">View</button>
                                        <button id="RelEquipBtn" type="button" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded">Release</button>
                                        <button id="RevEquipBtn" type="button" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded">Revoke</button>
                                    </td>
                                </tr>

                                <!-- Dynamic rows will be inserted here -->
                            </tbody>
                        </table>

                        <!-- View Popup Card -->
                        <div id="ViewEquipPopupCard" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
                            <div class="bg-white p-4 rounded-lg shadow-lg max-w-md w-full">
                                <div class="flex justify-between items-center mb-4">
                                    <h2 class="text-lg font-semibold">View Request</h2>
                                    <button id="closeViewEquipPopupCard" class="text-gray-500 hover:text-gray-700">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                    </button>
                                </div>

                                <div class="text-sm">
                                    <p class="mb-2"><strong>Name:</strong> Rey</p>
                                    <p class="mb-2"><strong>Position:</strong> Faculty Teacher</p>
                                    <p class="mb-2"><strong>Date:</strong> 2024-08/23</p>
                                    <p class="mb-2"><strong>Product Name:</strong> Chalk Box</p>
                                    <p class="mb-2"><strong>Category:</strong> Classroom Supply</p>
                                    <p class="mb-2"><strong>Quantity:</strong> 1</p>
                                    <p class="mb-2"><strong>Reason:</strong> For Teaching Use</p>
                                    <div class="mb-4">
                                        <label for="Remarks" class="block text-sm font-semibold mb-2">Remarks:</label>
                                        <textarea id="Remarks" class="w-full px-2 py-1 border border-gray-400 rounded h-20">For teaching .. etc</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <!-- Release Popup Card -->
                        <div id="RelEquipPopupCard" class="hidden fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-50 z-50">
                            <div class="bg-white p-6 rounded-lg shadow-lg w-80">
                                <!-- Product Details -->
                                <p class="mb-2 text-center">Product name: Chalk Box</p>
                                <p class="mb-2 text-center">Quantity Release: 10</p>
                                <p class="mb-4 text-center">Updated Stock(s): 10</p>

                                <div class="flex justify-center space-x-4">
                                    <button id="submitRelEquipPopupCard" class="bg-green-400 hover:bg-green-500 text-white py-2 px-4 rounded">Submit</button>
                                    <button id="closeRelEquipPopupCard" class="bg-red-400 hover:bg-red-500 text-white py-2 px-4 rounded">Cancel</button>
                                </div>
                            </div>
                        </div>

                        <!-- Revoke Popup Card -->
                        <div id="RevEquipPopupCard" class="hidden fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-50 z-50">
                            <div class="bg-white p-6 rounded-lg shadow-lg w-80">

                                <!-- Reason Dropdown -->
                                <label for="reason" class="block mb-2">Reason</label>
                                <select id="reason" class="mb-4 w-full p-2 rounded border border-gray-400">
                                    <option value="no-supply">No Supply</option>
                                    <option value="wrong-order">Wrong Order</option>
                                    <option value="damaged">Damaged Product</option>
                                </select>

                                <!-- Remarks Textarea -->
                                <label for="remarks" class="block mb-2">Remarks</label>
                                <textarea id="remarks" class="w-full p-2 rounded border border-gray-400 mb-4" rows="3" placeholder="Enter your remarks here..."></textarea>

                                <div class="flex justify-center space-x-4">
                                    <button id="submitRevEquipPopupCard" class="bg-green-400 hover:bg-green-500 text-white py-2 px-4 rounded">Submit</button>
                                    <button id="closeRevEquipPopupCard" class="bg-red-400 hover:bg-red-500 text-white py-2 px-4 rounded">Cancel</button>
                                </div>
                            </div>
                        </div>

                        <!-- Pagination -->
                    </div>
                </div>

            </section>
        </main>
    </div>
</body>

</html>