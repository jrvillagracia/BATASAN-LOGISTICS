@extends('adminLayouts.admin_sidebarLayout')

@section('title', 'Request Supplies | BHNHS')

@section('content')

<section>
    <div class="flex items-center pb-8">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" strokeWidth="1.5" stroke="currentColor" class="w-9 h-9">
            <path strokeLinecap="round" strokeLinejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
        </svg>
        <h1 class="text-3xl font-bold ml-2">Inventory Request Supplies</h1>
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
                    <a href="#" class="ms-1 text-sm font-medium text-gray-700 hover:text-blue-600 md:ms-2 dark:text-gray-400 dark:hover:text-white">Completed Request</a>
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
                <a href="{{route('admin_REQapprovalSupplies')}}" class="pageloader button border-b-2  py-2 px-4 transition-all duration-300 translate-x-2">For Approval</a>
                <a href="{{route('admin_REQAprRequestSupplies')}}" class="pageloader button border-b-2  py-2 px-4 transition-all duration-300 translate-x-2">Approve Request</a>
                <a href="{{route('admin_REQComRequestSupplies')}}" class="pageloader button border-b-2 border-blue-500 py-2 px-4 transition-all duration-300 translate-x-2">Completed Request</a>
                {{-- <a href="{{route('admin_REQHistorySupplies')}}" class="pageloader button border-b-2 py-2 px-4 transition-all duration-300 translate-x-2">History</a> --}}
            </div>

            <!-- Search Bar -->
            <div class=" flex items-center space-x-4">
                <label for="maintenance-search" class="mb-2 text-sm font-medium text-gray-900 w-full sr-only dark:text-white">Search</label>
                <form id="REQSuppliesSearchForm" class="flex items-center space-x-4">
                    <div class="relative w-96">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                            <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                            </svg>
                        </div>
                        <input type="search" id="REQSuppliesSearch" name="REQSuppliesSearch" class="block w-full p-4 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search" />
                    </div>
                    <!-- Add Item Button -->
            </div>
        </div>

        <!-- Floating Card with Form (Initially Hidden) -->


        <!-- Table -->
        <div class="relative shadow-md sm:rounded-lg px-9 py-5">
            <table id="reqSuppTable" class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-sm text-white dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            Status
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Request ID
                        </th>
                        <th scope="col" class="px-6 py-30">
                            Requesting Office/Unit
                        </th>
                        <th scope="col" class="px-6 py-30">
                            Date Requested
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Actions
                        </th>
                    </tr>
                </thead>
                <tbody id="tableBody" class="">

                    <tr class="odd:bg-blue-100 odd:dark:bg-gray-900 even:bg-white even:dark:bg-gray-800 border-b dark:border-gray-700" data-index="" data-id="">
                        <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">Pending</td>
                        <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">R00001</td>
                        <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">Elementary Faculty</td>
                        <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">9/12/2024</td>
                        <td class="px-6 py-4">
                            <button id="COMReqViewSupBtn" type="button" class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded">View</button>

                        </td>
                    </tr>

                    <!-- Dynamic rows will be inserted here -->
                </tbody>
            </table>


            <!-- View Popup Card -->
            <div id="COMReqSupPopupCard" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
                <div class="bg-white p-4 rounded-lg shadow-lg w-full max-w-8xl max-h-[80vh] overflow-y-auto">
                    <div class="flex justify-between items-center mb-4">
                        <h2 class="text-lg font-semibold ">Set Item</h2>
                        <button id="closeCOMReqViewSupPopupCard" class="text-gray-500 hover:text-gray-700">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>

                    <div class="grid grid-cols-2 gap-4 ml-6 text-sm w-full">
                        <div>
                            <p class="mb-2"><strong>Date:</strong></p>
                            <p class="mb-2"><strong>Time:</strong></p>
                            <p class="mb-2"><strong>Requesting Office/Unit:</strong></p>
                            <p class="mb-2"><strong>Requesting For:</strong></p>
                            <p class="mb-2"><strong>Requesting ID:</strong></p>
                        </div>

                        <div>
                            <p class="mb-2"><strong>Category:</strong></p>
                            <p class="mb-2"><strong>Quantity:</strong></p>
                            <p class="mb-2"><strong>Type:</strong></p>
                        </div>
                    </div>

                    <div class="relative shadow-md sm:rounded-lg px-9 py-5 max-h-96 overflow-y-auto">
                        <table id="reqCOMREQSupTable" class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                            <thead class="text-sm text-white dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3">Category</th>
                                    <th scope="col" class="px-6 py-3">Brand Name</th>
                                    <th scope="col" class="px-6 py-3">Type</th>
                                    <th scope="col" class="px-6 py-3">SKU</th>
                                    <th scope="col" class="px-6 py-3">Stocks</th>
                                    <th scope="col" class="px-6 py-3">Quantity</th>
                                </tr>
                            </thead>
                            <tbody id="tableViewBody">
                                <tr class="odd:bg-blue-100 odd:dark:bg-gray-900 even:bg-white even:dark:bg-gray-800 border-b dark:border-gray-700">
                                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">Laptop</td>
                                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">Brand Name</td>
                                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">64gb</td>
                                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">LAP000001</td>
                                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">STOCKS</td>
                                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">50</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="flex justify-end space-x-4 pt-4">
                        <button id="COMReqSupSeeMoretBTN" class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded">See More</button>
                        <button id="COMReqSupCancelBTN" class="bg-red-500 hover:bg-red-600 text-white py-2 px-4 rounded">Cancel</button>
                    </div>
                </div>
            </div>

            <!-- See More Popup Card -->
            <div id="COMReqSeeMoreSupPopupCard" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 hidden">
                <div class="bg-white p-4 rounded-lg shadow-lg w-full max-w-5xl max-h-[80vh] overflow-y-auto">
                    <div class="flex justify-between items-center mb-4">
                        <h2 class="text-lg font-semibold">Item Checklist</h2>
                        <button id="closeCOMReqSeeMoreSupPopupCard" class="text-gray-500 hover:text-gray-700">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>

                    <div id="checkedRatio" class="mt-4 pl-10 text-m font-medium text-gray-900 dark:text-white font-bold">
                        Checked: <span id="checkedCount">0</span> / <span id="totalCount">1</span>
                    </div>

                    <div class="relative shadow-md sm:rounded-lg px-9 py-5 max-h-96 overflow-y-auto">
                        <table id="reqSETITEMEquipTable" class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                            <thead class="text-sm text-white dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3">Category</th>
                                    <th scope="col" class="px-6 py-3">Brand Name</th>
                                    <th scope="col" class="px-6 py-3">Type</th>
                                    <th scope="col" class="px-6 py-3">SKU</th>
                                    <th scope="col" class="px-6 py-3">Unit</th>
                                    <th scope="col" class="px-6 py-3">QUANTITY</th>
                                </tr>
                            </thead>
                            <tbody id="tableViewBody">
                                <tr class="odd:bg-blue-100 odd:dark:bg-gray-900 even:bg-white even:dark:bg-gray-800 border-b dark:border-gray-700" data-id="">
                                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">Laptop</td>
                                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">Brand Name</td>
                                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">64gb</td>
                                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">LAP000001</td>
                                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">Unit</td>
                                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">QUANTITY</td>
                                </tr>

                                <!-- Dynamic rows will be inserted here -->
                            </tbody>
                        </table>
                    </div>

                    <div class="flex justify-end space-x-4 pt-4">
                        <button id="COMReqSupSeeMoreCloseBTN" class="bg-red-500 hover:bg-red-600 text-white py-2 px-4 rounded">Close</button>
                    </div>

                </div>
            </div>


            <!-- Pagination -->
        </div>
    </div>

</section>
@endsection