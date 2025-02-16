@extends('adminLayouts.admin_sidebarLayout')

@section('title', 'Inventory Supplies | BHNHS')

@section('content')

<section>
    <div class="flex items-center pb-8">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" strokeWidth="1.5" stroke="currentColor" class="w-7 h-7">
            <path strokeLinecap="round" strokeLinejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
        </svg>
        <h1 class="text-3xl font-bold ml-2">Inventory Supplies</h1>
    </div>

    <!-- Breadcrumbs -->
    <nav class="flex px-5 py-3 text-gray-700 border border-gray-200 rounded-lg bg-gray-50" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
            <li class="inline-flex items-center">
                <a href="{{ route('admin_StockInSupplies') }}" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600 ">
                    Inventory
                </a>
            </li>
            <li>
                <div class="flex items-center">
                    <svg class="rtl:rotate-180 block w-3 h-3 mx-1 text-gray-400 " aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4" />
                    </svg>
                    <a href="#" class="ms-1 text-sm font-medium text-gray-700 hover:text-blue-600 md:ms-2 ">History</a>
                </div>
            </li>

        </ol>
    </nav>

    <!-- Add additional content here -->
    <div class="bg-gray-100 h-auto rounded-lg ">

        <div class="flex justify-between items-center mt-4 px-9 py-2">
            <!-- Left-Aligned Buttons -->
            <div>
                <a href="{{ route('admin_StockInSupplies') }}" class="pageloader button border-b-2 py-2 px-4 transition-all duration-300 translate-x-2">Stock In</a>
                <a href="{{ route('admin_supplies')}}" class="pageloader button border-b-2 py-2 px-4 transition-all duration-300 translate-x-2">Supplies</a>
                <a href="{{ route('admin_suppliesHistory')}}" class="pageloader button border-b-2 border-blue-500 py-2 px-4 transition-all duration-300 translate-x-2">History</a>
                <a href="{{ route('admin_suppliesUsed')}}" class="pageloader button border-b-2 py-2 px-4 transition-all duration-300 translate-x-2">Used</a>
            </div>

            <!-- Date Picker -->


            <!-- Search Bar -->
            <div class="flex items-center space-x-4">

                <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 w-full sr-only ">Search</label>
                <form id="suppliesSearchForm" class="flex items-center space-x-4">
                    <div class="relative w-96">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                            <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                            </svg>
                        </div>
                        <input type="search" id="suppliesSearch" name="suppliesSearch" class="block w-full p-4 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search" />
                        
                    </div>

                    <!-- Add Item Button-->

            </div>
        </div>

        <!-- Floating Card with Form (Initially Hidden) -->


        <!-- Table -->
        <div class="relative shadow-md sm:rounded-lg px-9 py-5 ">
            <table id="dynamicTable" class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-sm text-white dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            User ID
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Username
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Actions
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Product Name
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Date
                        </th>
                    </tr>
                </thead>
                <tbody id="tableBody">
                    <tr class="odd:bg-blue-100  even:bg-white  border-b " data-id="">
                        <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap ">TEST</td>
                        <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap "></td>
                        <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap "></td>
                        <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap "></td>
                        <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap "></td>
                    </tr>
                    <!-- Dynamic rows will be inserted here -->
                </tbody>
            </table>

            <!-- Edit 1 Popup Card -->

            <!-- END OF Edit 1 Popup Card -->

            <!-- View 1 Popup Card -->
            <div id="ViewSuppUsedModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 hidden">
                <div class="bg-white p-4 rounded-lg shadow-lg max-w-md w-full">
                    <div class="flex justify-between items-center mb-4">
                        <h2 class="text-lg font-semibold">View Full Information</h2>
                        <button id="closeViewSuppUsedFormButton" class="text-gray-500 hover:text-gray-700">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                    <div class="text-sm text-gray-700 mb-4">
                        <p><strong>Serial Number:</strong></p>
                        <p><strong>Control Number:</strong></p>
                        <p><strong>Brand Name:</strong></p>
                        <p><strong>Product Name:</strong></p>
                        <p><strong>Category:</strong></p>
                        <p><strong>Type:</strong></p>
                        <p><strong>Color:</strong></p>
                        <p><strong>Unit:</strong></p>
                        <p><strong>Unit Price:</strong>₱</p>
                        <p><strong>Classification:</strong></p>
                        <p><strong>User ID:</strong></p>
                        <p><strong>Username:</strong></p>
                        <p><strong>Department</strong></p>
                        <p><strong>Date Used:</strong></p>
                        <p><strong>Admin:</strong></p>
                        <p><strong>Remarks:</strong></p>
                    </div>

                </div>
            </div>
            <!-- END OF View 1 Popup Card -->

            <!-- Edit 2 Popup Card -->

            <!-- END OF Edit 2 Popup Card -->

            <!-- Add Pop Up Card -->

            <!-- END OF Add Pop Up Card -->

            <!-- View 2 Table Pop Up Card -->

            <!-- END OF View 2 Table Pop Up Card -->
        </div>

    </div>


    <!-- Popup Card -->
</section>
@endsection