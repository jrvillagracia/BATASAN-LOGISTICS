<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Analytics</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,500,0,0" />
    <link rel="stylesheet" href="{{asset('css/admin.css')}}">

    <script src="{{asset('js/jquery.js')}}"></script>
    <script src="{{asset('js/admin.js')}}"></script>
    <script src="{{asset('js/popups.js')}}"></script>


    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.12.4/dist/sweetalert2.all.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.12.4/dist/sweetalert2.min.css">
</head>

<body class="h-screen">
    <div id="csrf-token" data-token="{{ csrf_token() }}"></div>
    <div class="flex h-screen">
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
                        <li class="p-3 rounded-md hover:bg-gray-200">
                            <a href="#" class="flex items-center justify-center md:justify-start space-x-2 text-white hover:text-black">
                                <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="currentColor" class="w-7 h-7">
                                    <path d="M101.35-111.87v-91h83.58v-645.26h419.14v40h171v605.26h83.58v91H684.07v-605.26h-80v605.26H101.35Zm331.72-326.22q17.81 0 29.86-12.05T474.98-480q0-17.81-12.05-29.86t-29.86-12.05q-17.82 0-29.87 12.05T391.15-480q0 17.81 12.05 29.86t29.87 12.05Z" />
                                </svg>
                                <span class="sidebar-text font-bold">Facility</span>
                            </a>
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
                                <li>
                                    <a href="#" class="flex items-center w-full sidebar-text p-2 font-bold text-white transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 hover:text-black">Module</a>
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
                    <h1 class="text-3xl font-bold ml-2">Inventory Equipment</h1>
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
                                <a href="#" class="ms-1 text-sm font-medium text-gray-700 hover:text-blue-600 md:ms-2 dark:text-gray-400 dark:hover:text-white">Equipment</a>
                            </div>
                        </li>

                    </ol>
                </nav>

                <!-- Add additional content here -->
                <div class="bg-gray-100 h-auto rounded-lg ">

                    <div class="flex justify-between items-center mt-4 px-9 py-2">
                        <!-- Left-Aligned Buttons -->
                        <div>
                            <button id="suppliesTab" class="button border-b-2 border-blue-500 py-2 px-4 transition-all duration-300 translate-x-2">Equipment</button>
                        </div>



                        <!-- Search Bar -->
                        <div class=" flex items-center space-x-4">

                            <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 w-full sr-only dark:text-white">Search</label>
                            <div class="relative w-96">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                                    </svg>
                                </div>
                                <input type="search" id="default-search" class="block w-full p-4 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search" required />
                                <button type="submit" class="text-white absolute right-2.5 top-1/2 transform -translate-y-1/2 bg-blue-500 hover:bg-blue-600 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Search</button>
                            </div>

                            <!-- Add Item Button -->
                            <button id="showFormButton" class="bg-blue-500 text-white p-2 rounded hover:bg-blue-600">Add Item</button>
                        </div>
                    </div>

                    <!-- Floating Card with Form (Initially Hidden) -->
                    <div id="itemFormCard" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
                        <div class="bg-white p-4 rounded-lg shadow-lg max-w-md w-full">
                            <h2 class="text-xl font-bold mb-4">Add New Product</h2>

                            <form action="{{ route('equipment.store') }}" method="POST">
                                @csrf
                                <!-- Input Fields -->
                                <div class="mb-4">
                                    <input type="text" name="productName" id="productName" class="border p-2 rounded w-full mb-2" placeholder="Product Name">
                                    <label for="productCategory" class="block text-gray-700 mb-1">Category</label>
                                    <select name="productCategory" id="productCategory" class="border p-2 rounded w-full mb-2">
                                        <option value="" disabled selected>Select a category</option>
                                        <option value="textbook">Textbook</option>
                                        <option value="office">Office Supplies</option>
                                        <option value="electronics">Electronics</option>
                                        <!-- Add more options as needed -->
                                    </select>
                                    <input type="number" name="productQuantity" id="productQuantity" class="border p-2 rounded w-full mb-2" placeholder="Quantity">
                                    <input type="date" name="productDate" id="productDate" class="border p-2 rounded w-full mb-4" placeholder="Date">
                                    <input type="number" name="productPrice" id="productPrice" class="border p-2 rounded w-full mb-4" placeholder="Price">
                                    <label for="productDepartment" class="block text-gray-700 mb-1">Department</label>
                                    <select name="productDepartment" id="productDepartment" class="border p-2 rounded w-full mb-2">
                                        <option value="" disabled selected>Select a department</option>
                                        <option value="science">Science Department</option>
                                        <option value="it">IT Department</option>
                                        <option value="electronics">Electornics Department</option>
                                        <!-- Add more options as needed -->
                                    </select>
                                    <input type="text" id="productSKU" class="border p-2 rounded w-full mb-2" placeholder="SKU">
                                </div>

                                <!-- Save and Close Buttons -->
                                <div class="flex justify-end space-x-2">
                                    <button id="closeFormButton" class="bg-red-500 hover:bg-red-600 text-white p-2 rounded">Close</button>
                                    <button id="saveButton" type="button" data-id="equipment" class="bg-green-500 hover:bg-green-600 text-white p-2 rounded">Save</button>
                                </div>
                            </form>


                            <!-- @if(Session::has('message'))
                            <script>
                                swal.fire("Message", "{{Session::get('message')}}", 'success', {
                                    showConfirmButton: true
                                });
                            </script>

                            @endif -->
                        </div>
                    </div>

                    <!-- Table -->
                    <div class="relative shadow-md sm:rounded-lg px-9 py-5">
                        <table id="dynamicTable" class="w-full text-sm text-left rtl:text-right text-black">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-200">
                                <tr>
                                    <th scope="col" class="px-6 py-3">
                                        <span class="flex items-center">
                                            Product Name
                                            <svg class="w-4 h-4 ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m8 15 4 4 4-4m0-6-4-4-4 4" />
                                            </svg>
                                        </span>
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        <span class="flex items-center">
                                            Category
                                            <svg class="w-4 h-4 ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m8 15 4 4 4-4m0-6-4-4-4 4" />
                                            </svg>
                                        </span>
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        <span class="flex items-center">
                                            Quantity
                                            <svg class="w-4 h-4 ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m8 15 4 4 4-4m0-6-4-4-4 4" />
                                            </svg>
                                        </span>
                                    </th>
                                    <th scope="col" class="px-6 py-3">Date</th>
                                    <th scope="col" class="px-6 py-3">
                                        <span class="flex items-center">
                                            Price
                                            <svg class="w-4 h-4 ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m8 15 4 4 4-4m0-6-4-4-4 4" />
                                            </svg>
                                        </span>
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        <span class="flex items-center">
                                            Department
                                            <svg class="w-4 h-4 ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m8 15 4 4 4-4m0-6-4-4-4 4" />
                                            </svg>
                                        </span>
                                    </th>
                                    <th scope="col" class="px-6 py-3">SKU</th>
                                    <th scope="col" class="px-6 py-3">Action</th>
                                </tr>
                            </thead>
                            <tbody id="tableBody" class="">
                                @foreach($equipment as $item)
                                <tr class="cursor-pointer table-row " data-index="${start + index}" data-id="{{$item->id}}">
                                    <td class="px-6 py-3">{{$item->productName}}</td>
                                    <td class="px-6 py-3">{{$item->productCategory}}</td>
                                    <td class="px-6 py-3">{{$item->productQuantity}}</td>
                                    <td class="px-6 py-3">{{$item->productDate}}</td>
                                    <td class="px-6 py-3">₱{{number_format($item->productPrice, 2)}}</td>
                                    <td class="px-6 py-3">{{$item->productDepartment}}</td>
                                    <td class="px-6 py-3">{{$item->productSKU}}</td>
                                    <td class="px-6 py-4">
                                        <button id="editEquipButton" type="button" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">Edit</button>
                                    </td>
                                </tr>
                                @endforeach
                                <!-- Dynamic rows will be inserted here -->
                            </tbody>
                        </table>

                        <!-- Edit Popup Card -->
                        <div id="editEquipModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
                            <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-md">
                                <h2 class="text-2xl font-semibold mb-4">Edit Product</h2>
                                <form id="editForm">
                                    <div class="mb-4">
                                        <input type="text" id="productName" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Product Name">
                                    </div>
                                    <div class="mb-4">
                                        <input type="text" id="category" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Category">
                                    </div>
                                    <div class="mb-4">
                                        <input type="number" id="quantity" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Quantity">
                                    </div>
                                    <div class="mb-4">
                                        <input type="date" id="date" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                                    </div>
                                    <div class="mb-4">
                                        <input type="text" id="price" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Price">
                                    </div>
                                    <div class="mb-4">
                                        <input type="text" id="department" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Department">
                                    </div>
                                    <div class="mb-4">
                                        <input type="text" id="sku" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="SKU">
                                    </div>
                                    <div class="flex justify-end space-x-2">
                                        <button type="button" id="closeEquipFormButton" class="bg-green-500 hover:bg-green-600 text-white p-2 rounded">Save</button>
                                        <button type="button" id="saveEquipButton" class="bg-yellow-500 hover:bg-yellow-600 text-white p-2 rounded">Condemn</button>
                                        <button type="button" id="#" class="bg-red-500 hover:bg-red-600 text-white p-2 rounded">Delete</button>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <!-- Pagination -->
                        <nav id="paginationNav" class="flex items-center flex-column flex-wrap md:flex-row justify-between pt-4" aria-label="Table navigation">
                            <span class="text-sm font-normal text-gray-500 dark:text-gray-400 mb-4 md:mb-0 block w-full md:inline md:w-auto">Showing <span id="currentPage" class="font-bold text-black">1</span> of <span id="totalPages" class="font-bold text-black">1</span></span>
                            <ul id="pagination" class="inline-flex -space-x-px rtl:space-x-reverse text-sm h-8">
                                <!-- Pagination buttons will be inserted here dynamically -->
                            </ul>
                        </nav>
                    </div>
                </div>

                <!-- Popup Card -->
                <!-- <div id="popup" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
                    <div class="bg-white p-4 rounded-lg shadow-lg max-w-lg w-full">
                        <button id="closePopup" class="text-red-500 float-right">Close</button>
                        <h2 id="popupTitle" class="text-xl font-bold mb-2"></h2>
                        <p id="popupCategory"></p>
                        <p id="popupQuantity"></p>
                        <p id="popupDate"></p>
                        <p id="popupPrice"></p>
                        <p id="popupDepartment"></p>
                        <p id="popupSKU"></p>
                    </div>
                </div> -->
            </section>
        </main>
    </div>


    <!-- <script src="{{asset('js/jquery.js')}}"></script>
    <script src="{{asset('js/admin.js')}}"></script> -->
</body>

</html>