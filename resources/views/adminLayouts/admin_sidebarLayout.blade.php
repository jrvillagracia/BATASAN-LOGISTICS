<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>


    <!-- FOR GENERATE TO PDF SCRIPT LIBRARY -->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.2/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
    <script src="https://unpkg.com/jspdf@latest/dist/jspdf.umd.min.js"></script> -->

    <!-- LOCAL JS FILES -->
    <script src="{{asset('js/jquery.js')}}"></script>
    <script src="{{asset('js/main.js')}}"></script>


    <script src="{{asset('js/admin_dashboard.js')}}"></script> <!-- DASHBOARD MODULE -->

    <script src="{{asset('js/admin_ForApprMainteEquip.js')}}"></script> <!-- MAINTENANCE INVENTORY MODULE -->
    <script src="{{asset('js/admin_ForRepMainteEquip.js')}}"></script>
    <script src="{{asset('js/admin_ComReqMainteEquip.js')}}"></script>

    <script src="{{asset('js/admin_eventsForApproval.js')}}"></script> <!-- EVENTS AND ACTIVITIES MODULE -->
    <script src="{{asset('js/admin_eventsAprRequest.js')}}"></script>
    <script src="{{asset('js/admin_eventsHistory.js')}}"></script>
    <script src="{{asset('js/admin_eventsComRequest.js')}}"></script>

    <script src="{{asset('js/admin_EQUIPMENT.js')}}"></script> <!-- INVENTORY EQUIPMENT MODULE -->
    <script src="{{asset('js/admin_equipCondemned.js')}}"></script>
    <script src="{{asset('js/admin_equipUsed.js')}}"></script>
    <script src="{{asset('js/admin_equipHistory.js')}}"></script>


    <script src="{{asset('js/admin_POInventory.js')}}"></script> <!-- INVENTORY PRODUCT MODULE -->
    <script src="{{asset('js/admin_POApprOrderInventory.js')}}"></script>
    <script src="{{asset('js/admin_POCompleteOrderInventory.js')}}"></script>


    <script src="{{asset('js/admin_requestEquipment.js')}}"></script> <!-- REQUEST EQUIPMENT MODULE -->
    <script src="{{asset('js/admin_REQAprRequestEquipment.js')}}"></script>
    <script src="{{asset('js/admin_REQComRequestEquipment.js')}}"></script>


    <script src="{{asset('js/admin_requestSupplies.js')}}"></script> <!-- REQUEST SUPPLIES MODULE -->
    <script src="{{asset('js/admin_REQAprRequestSupplies.js')}}"></script>
    <script src="{{asset('js/admin_REQComRequestSupplies.js')}}"></script>

    <script src="{{asset('js/admin_supplies.js')}}"></script> <!-- INVENTORY SUPPLIES MODULE -->
    <script src="{{asset('js/admin_suppliesHistory.js')}}"></script>
    <script src="{{asset('js/admin_suppliesUsed.js')}}"></script>

    <script src="{{asset('js/admin_StockInEquipment.js')}}"></script> <!-- INVENTORY SUPPLIES & EQUIPMENT MODULE -->
    <script src="{{asset('js/admin_StockInSupplies.js')}}"></script>

    <script src="{{asset('js/admin_facilityOfficeRoom.js')}}"></script> <!-- FACILITY MODULE -->
    <script src="{{asset('js/admin_facilityRegRoom.js')}}"></script>
    <script src="{{asset('js/admin_facilitySpecRoom.js')}}"></script>

    <script src="{{asset('js/admin_ForApprMainteFacility.js')}}"></script> <!-- MAINTENANCE FACILITY MODULE -->
    <script src="{{asset('js/admin_ForRepMainteFacility.js')}}"></script>
    <script src="{{asset('js/admin_ComReqMainteFacility.js')}}"></script>


    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@9.0.3"></script>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.1/dist/flowbite.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.12.4/dist/sweetalert2.all.min.js"></script>


    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,500,0,0" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.12.4/dist/sweetalert2.min.css">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.1/dist/flowbite.min.css" rel="stylesheet" />




    <!-- LOCAL CSS FILES -->
    <link rel="stylesheet" href="{{asset('css/admin.css')}}">
    <link rel="stylesheet" href="{{asset('css/admin_mainteEquipment.css')}}">
    <link rel="stylesheet" href="{{asset('css/admin_events.css')}}">
    <link rel="stylesheet" href="{{asset('css/admin_StockInEquipment.css')}}">
    <link rel="stylesheet" href="{{asset('css/admin_requestEquipment.css')}}">
    <link rel="stylesheet" href="{{asset('css/admin_requestSupplies.css')}}">
    <link rel="stylesheet" href="{{asset('css/admin_supplies.css')}}">
    <link rel="stylesheet" href="{{asset('css/admin_facilityOfficeRoom.css')}}">
    <link rel="stylesheet" href="{{asset('css/admin_facilityRegRoom.css')}}">
    <link rel="stylesheet" href="{{asset('css/admin_facilitySpecRoom.css')}}">
    <link rel="stylesheet" href="{{asset('css/admin_POInventory.css')}}">



    <!-- <link rel="stylesheet" href="https://cdn.datatables.net/2.1.4/css/dataTables.dataTables.min.css"> -->


    <!-- <script src="https://cdn.datatables.net/2.1.4/js/dataTables.min.js"></script> -->

</head>

<body class="h-screen overflow-x-hidden">
    <div id="csrf-token" data-token="{{ csrf_token() }}"></div>
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
                        <div class="ml-1">
                            <p class="text-sm text-white sidebar-text">Main</p>
                        </div>
                        <li class="hover:bg-gray-200 p-3 rounded-md shadow-sm">
                            <a href="{{route('admin_dashboard')}}" class="flex items-center justify-center md:justify-start space-x-2 text-white hover:text-black">
                                <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="currentColor" class="w-7 h-7">
                                    <path d="M111.87-520v-328.13H440V-520H111.87Zm0 408.13V-440H440v328.13H111.87ZM520-520v-328.13h328.13V-520H520Zm0 408.13V-440h328.13v328.13H520Z" />
                                </svg>

                                <span class="sidebar-text font-bold">Dashboard</span>
                            </a>
                        </li>
                        <div class="ml-1">
                            <p class="text-sm text-white sidebar-text">Management</p>
                        </div>
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
                                    <a href="{{ route('admin_POInventory')}}" class="flex items-center w-full sidebar-text p-2 font-bold text-white transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 hover:text-black">Product Order</a>
                                </li>
                                <li>
                                    <a href="{{ route('admin_StockInSupplies') }}" class="flex items-center w-full sidebar-text p-2 font-bold text-white transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 hover:text-black">Supplies</a>
                                </li>
                                <li>
                                    <a href="{{ route('admin_StockInEquipment') }}" class="flex items-center w-full sidebar-text p-2 font-bold text-white transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 hover:text-black">Equipment</a>
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
                                    <a href="{{ route('admin_REQapprovalSupplies') }}" class="flex items-center w-full sidebar-text p-2 font-bold text-white transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 hover:text-black">Request Supplies</a>
                                </li>
                                <li>
                                    <a href="{{ route('admin_REQapprovalEquipment') }}" class="flex items-center w-full sidebar-text p-2 font-bold text-white transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 hover:text-black">Request Equipment</a>
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
                                    <a href="{{ route('admin_mainteFacility')}}" class="flex items-center w-full sidebar-text p-2 font-bold text-white transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 hover:text-black">Maintenance Facility</a>
                                </li>
                                <li>
                                    <a href="{{ route('admin_mainteEquipment') }}" class="flex items-center w-full sidebar-text p-2 font-bold text-white transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 hover:text-black">Maintenance Inventory</a>
                                </li>
                            </ul>
                        </li>
                        <div class="pt-5">
                            <hr>
                        </div>

                        <li class="hover:bg-gray-200 p-3 rounded-md">
                            <button id="student-info-link" class="flex items-center justify-center md:justify-start space-x-2 text-white hover:text-black">
                                <span class="material-symbols-outlined">account_box</span>
                                <span class="sidebar-text font-bold">Student Information</span>
                            </button>
                        </li>
                        <li class="hover:bg-gray-200 p-3 rounded-md">
                            <a href="https://bnhs-hr.onrender.com/admin/dashboard" class="flex items-center justify-center md:justify-start space-x-2 text-white hover:text-black">
                                <span class="material-symbols-outlined">groups_2</span>
                                <span class="sidebar-text font-bold">Human Resources</span>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </aside>


        <!-- Main Content --> <!-- EASE IN OUT n MARGIN SIZE-->
        <main id="main-content" class="flex-1 p-8 transition-all duration-300 ease-in-out ml-80">
            <header class="flex justify-end mb-8">
                <form action="/logout" method="POST">
                    @csrf
                    @method('POST')
                    <div>
                        <div class="text-sm bg-gray-200 rounded-full pr-2 pl-1 py-1 inline-flex items-center space-x-4" aria-expanded="false" data-dropdown-toggle="dropdown-user">
                            <span class="sr-only">Open user menu</span>
                            <div>
                                <span id="userFullName" class="font-semibold text-black">Robert Badong</span>
                                <p class="text-gray-600 text-xs pl-11">administrator</p>
                            </div>
                            <svg class="w-8 h-8 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 9-7 7-7-7" />
                            </svg>
                            </>
                        </div>
                        <div class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded shadow" id="dropdown-user">
                            <ul id="dropdownContent" class="py-1" role="none">
                                <li>
                                    <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 " role="menuitem">My Account</a>
                                </li>
                                <li>
                                    <button type="logout-button" class="block px-4 py-2 text-sm text-red-700 hover:bg-gray-100  " role="menuitem">Log Out</a>
                                </li>
                            </ul>
                        </div>
                </form>
            </header>
            @yield('content')
        </main>

    </div>

    <script>
    // Ensure the DOM is fully loaded before adding the event listener
    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById("student-info-link").addEventListener("click", function(event) {
            event.preventDefault(); // Prevent the default button action

            // Retrieve the token from localStorage
            const token = localStorage.getItem('token'); // Assuming the token is stored under the key 'access_token'

            console.log("Token from localStorage: " + token); // Log token to console for debugging

            if (token) {
                // If the token exists, proceed with the redirection
                const baseUrl = "https://bhnhs-sis.onrender.com/admin/dashboard";
                const urlWithToken = `${baseUrl}?access_token=${token}`;

                // Remove the token from localStorage
                localStorage.removeItem('token'); // Remove the token after redirecting

                // Redirect to the new URL with the token
                window.location.href = urlWithToken;
            } else {
                // If no token is found, log an error (or handle the scenario as needed)
                console.error("Token is missing!");
            }
        });
    });
</script>

    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.2/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
    <script src="https://unpkg.com/jspdf@latest/dist/jspdf.umd.min.js"></script> -->
</body>

</html>