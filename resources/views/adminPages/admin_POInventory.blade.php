@extends('adminLayouts.admin_sidebarLayout')

@section('title', 'Product Order | BHNHS')

@section('content')


<section>
    <div class="flex items-center pb-8">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" strokeWidth="1.5" stroke="currentColor" class="w-9 h-9">
            <path strokeLinecap="round" strokeLinejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
        </svg>
        <h1 class="text-3xl font-bold ml-2">Inventory Product Order</h1>
    </div>

    <!-- Breadcrumb -->
    <nav class="flex px-5 py-3 text-gray-700 border border-gray-200 rounded-lg bg-gray-50 dark:bg-gray-800 dark:border-gray-700" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
            <li class="inline-flex items-center">
                <a href="#" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600 dark:text-gray-400 dark:hover:text-white">
                    Inventory
                </a>
            </li>
            <li>
                <div class="flex items-center">
                    <svg class="rtl:rotate-180 block w-3 h-3 mx-1 text-gray-400 " aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4" />
                    </svg>
                    <a href="#" class="ms-1 text-sm font-medium text-gray-700 hover:text-blue-600 md:ms-2 dark:text-gray-400 dark:hover:text-white">Product Order</a>
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
                <a href="{{route('admin_POInventory')}}" class="button border-b-2 py-2 px-4 border-blue-500 transition-all duration-300 translate-x-2">For Approval</a>
                <a href="{{route('admin_POApprOrderInventory')}}" class="button border-b-2 py-2 px-4 transition-all duration-300 translate-x-2">Approve Order</a>
                <a href="{{route('admin_POCompleteOrderInventory')}}" class="button border-b-2 py-2 px-4 transition-all duration-300 translate-x-2">Completed Request</a>
            </div>

            <!-- Search Bar -->
            <div class=" flex items-center space-x-4">
                <label for="maintenance-search" class="mb-2 text-sm font-medium text-gray-900 w-full sr-only dark:text-white">Search</label>
                <form id="RequestEquipmentSearchForm" class="flex items-center space-x-4">
                    <div class="relative w-96">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                            <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                            </svg>
                        </div>
                        <input type="search" id="RequestEquipmentSearch" name="RequestEquipmentSearch" class="block w-full p-4 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search" />
                    </div>
                    <!-- Add Item Button -->
                    <button id="ProductOrderBTN" class="bg-blue-500 text-white p-2 rounded hover:bg-blue-600">Add Order</button>
            </div>
        </div>

        <!-- Floating Card with Form (Initially Hidden) -->
        <div id="ProductOrder1" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
            <div class="bg-white p-4 rounded-lg shadow-lg max-w-4xl w-full">
                <div class="flex justify-center items-center mb-4 relative">
                    <h2 class="text-xl font-bold">Add Order</h2>
                    <button id="ProductOrderCloseFormBtn" class="absolute right-0 text-gray-500 hover:text-gray-700">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                <!-- Stepper Navigation -->
                <ol class="items-center w-full mb-6 space-y-4 sm:flex sm:space-x-8 sm:space-y-0 rtl:space-x-reverse" id="stepper">
                    <li id="step1" class="flex items-center text-blue-600 dark:text-blue-500 space-x-2.5 rtl:space-x-reverse">
                        <span id="circle1" class="flex items-center justify-center w-8 h-8 border border-blue-600 rounded-full shrink-0 dark:border-blue-500">
                            1
                        </span>
                        <span>
                            <h3 class="font-medium leading-tight">Fill Up Details</h3>
                        </span>
                    </li>
                    <li id="step2" class="flex items-center text-gray-500 dark:text-gray-400 space-x-2.5 rtl:space-x-reverse">
                        <span id="circle2" class="flex items-center justify-center w-8 h-8 border border-gray-500 rounded-full shrink-0 dark:border-gray-400">
                            2
                        </span>
                        <span>
                            <h3 class="font-medium leading-tight">Request Inventory</h3>
                        </span>
                    </li>
                </ol>
                <!-- Step 1 Content -->
                <div id="step1Content" class="bg-white border w-full border-blue-900 rounded-md shadow sm:p-8 p-6">
                    <form id="ProductOrderForm">
                        <div class="mb-4">
                            <label for="datepicker-format" class="block text-sm font-semibold mb-2">Date:</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                                    </svg>
                                </div>
                                <input id="ProductOrderDate" type="text" readonly class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Select date">
                            </div>

                            <label for="time" class="block text-sm font-semibold mb-2">Time:</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 end-0 top-0 flex items-center pe-3.5 pointer-events-none">
                                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                        <path fill-rule="evenodd" d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12Zm11-4a1 1 0 1 0-2 0v4a1 1 0 0 0 .293.707l3 3a1 1 0 0 0 1.414-1.414L13 11.586V8Z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <input type="time" id="ProductOrderTime" name="ProductOrderTime" class="bg-gray-50 border leading-none border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" min="09:00" max="18:00" value="00:00" required />
                            </div>

                        </div>
                        <div class="mb-4">
                            <label for="ProductOrderRequestingOffc" class="block text-sm font-semibold mb-2">Requesting Office/Unit:</label>
                            <input type="text" id="ProductOrderRequestingOffc" name="ProductOrderRequestingOffc" class="border border-gray-400 p-2 rounded w-full" placeholder="*Logistics Department" pattern="[A-Za-z ]*" title="Only characters are allowed">
                        </div>
                        <div class="flex justify-end">
                            <button id="goToStep2" type="button" class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2.5 rounded">Next</button>
                        </div>
                    </form>
                </div>
                <!-- Step 2 Content -->
                <div id="step2Content" class="border w-full border-blue-900 rounded-md shadow sm:p-8 p-4 hidden">
                    <table id="step2ContentTable" class="w-full border-collapse">
                        <thead>
                            <tr class="bg-blue-900">
                                <th class="p-2 text-white">Inventory</th>
                                <th class="p-2 text-white">Category</th>
                                <th class="p-2 text-white">Type</th>
                                <th class="p-2 text-white">Unit</th>
                                <th class="p-2 text-white">Quantity</th>
                                <th class="p-2 text-white">Action</th>
                            </tr>
                        </thead>
                    </table>

                    <!-- Add this div around the tbody for scrolling -->
                    <div class="overflow-y-auto max-h-60 ">
                        <table id="step2ContentTable" class="w-full border-collapse">
                            <tbody id="inventory-items">
                                <!-- Single Inventory Item -->
                                <tr class="inventory-item">
                                    <td class="p-2">
                                        <select class="w-full border rounded p-2">
                                            <option value="">Select Inventory</option>
                                            <option>Equipment</option>
                                            <option>Supplies</option>
                                        </select>
                                    </td>
                                    <td class="p-2">
                                        <select class="w-full border rounded p-2">
                                            <option value="">Select Category</option>
                                            <option>Laptop</option>
                                            <option>Printer</option>
                                        </select>
                                    </td>
                                    <td class="p-2">
                                        <select class="w-full border rounded p-2">
                                            <option value="">Select Type</option>
                                            <option>64GB</option>
                                            <option>Steel</option>
                                        </select>
                                    </td>
                                    <td class="p-2">
                                        <select class="w-full border rounded p-2">
                                            <option value="">Select Unit</option>
                                            <option>Box</option>
                                            <option>Unit</option>
                                        </select>
                                    </td>
                                    <td class="p-2">
                                        <input type="number" class="w-full border rounded p-2" placeholder="Enter Quantity">
                                    </td>
                                    <td class="p-2">
                                        <button type="button" class="delete-row-btn text-red-500 hover:text-red-700">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                            </svg>
                                        </button>
                                    </td>
                                </tr>
                                <!-- More inventory rows can be added here -->
                            </tbody>
                        </table>
                    </div>

                    <!-- Submit & Cancel Buttons -->
                    <div class="flex justify-between pt-3">
                        <button id="backToStep1" type="button" class="bg-gray-300 hover:bg-gray-400 text-gray-700 px-5 py-2.5 rounded">Back</button>
                        <div class="flex space-x-4">
                            <button type="button" id="addItemBtn" class="bg-blue-500 hover:bg-blue-600 text-white px-5 py-2.5 rounded">+ Add Another Item</button>
                            <button type="submit" id="ProductOrderSubmitBTN" class="bg-green-600 hover:bg-green-700 text-white px-5 py-2.5 rounded">Submit</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>



        <!-- Table -->
        <div class="relative shadow-md sm:rounded-lg px-9 py-5">
            <table id="POTable" class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="table_color text-xs text-white uppercase">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            Status
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Order ID
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Requesting Office/Unit
                        </th>
                        <th scope="col" class="px-6 py-30">
                            Date Requested
                        </th>
                        <th scope="col" class="px-6 py-30">
                            Actions
                        </th>
                    </tr>
                </thead>
                <tbody id="tableBody" class="">

                    <tr class="odd:bg-blue-100 odd:dark:bg-gray-900 even:bg-white even:dark:bg-gray-800 border-b dark:border-gray-700" data-index="" data-id="">
                        <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">Pending</td>
                        <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">R00001</td>
                        <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">Elem Faculty</td>
                        <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">9/21/2024</td>
                        <td class="px-6 py-4">
                            <button id="POViewBTN" type="button" class="bg-yellow-500 hover:bg-yellow-600 text-white p-2 rounded">View</button>
                            <button id="POApprBTN" type="button" class="bg-green-500 hover:bg-green-600 text-white p-2 rounded">Approve</button>
                            <button id="PODclnBTN" type="button" class="bg-red-500 hover:bg-red-600 text-white p-2 rounded">Decline</button>
                        </td>
                    </tr>

                    <!-- Dynamic rows will be inserted here -->
                </tbody>
            </table>

            <!-- Approval Popup Card -->
            <div id="ApprProductInventoryPopupCard" class="hidden fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-50 z-50">
                <div class="bg-white p-6 rounded-lg shadow-lg w-80">
                    <h2 class="text-xl font-bold mb-4 text-center">Are you sure you want to approve this Product Order?</h2>
                    <div class="flex justify-center space-x-4">
                        <button id="submitApprProductInventoryPopupCard" class="bg-green-500 hover:bg-green-600 text-white py-2 px-4 rounded">Submit</button>
                        <button id="closeApprProductInventoryPopupCard" class="bg-red-500 hover:bg-red-600 text-white py-2 px-4 rounded">Cancel</button>
                    </div>
                </div>
            </div>

            <!-- Decline Popup Card -->
            <div id="DclnProductInventoryPopupCard" class="hidden fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-50 z-50">
                <div class="bg-white p-6 rounded-lg shadow-lg w-80">

                    <!-- Reason Dropdown -->
                    <h2 class="text-xl font-bold mb-4 text-center">Are you sure you want to decline this request?</h2>

                    <div class="flex justify-center space-x-4">
                        <button id="submitDclnProductInventoryPopupCard" class="bg-green-500 hover:bg-green-600 text-white py-2 px-4 rounded">Submit</button>
                        <button id="closeDclnProductInventoryPopupCard" class="bg-red-500 hover:bg-red-600 text-white py-2 px-4 rounded">Cancel</button>
                    </div>
                </div>
            </div>


            <!-- View Popup Card -->
            <div id="ViewProductOrderPopupCard" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
                <div class="bg-white p-4 rounded-lg shadow-lg w-full max-w-5xl max-h-[80vh] overflow-y-auto">
                    <div class="flex justify-between items-center mb-4">
                        <h2 class="text-lg font-semibold ">Product Order Slip</h2>
                        <button id="closeViewProductOrderPopupCard" class="text-gray-500 hover:text-gray-700">
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
                        </div>
                    </div>

                    <div class="relative shadow-md sm:rounded-lg px-9 py-5 max-h-96 overflow-y-auto">
                        <table id="step2ReqEquipContentTable" class="w-full border-collapse">
                            <thead>
                                <tr class="bg-blue-900 ">
                                    <th class="p-2 text-white">Inventory</th>
                                    <th class="p-2 text-white">Category</th>
                                    <th class="p-2 text-white">Type</th>
                                    <th class="p-2 text-white">Unit</th>
                                    <th class="p-2 text-white">Quantity</th>
                                    <th class="p-2 text-white">Action</th>
                                </tr>
                            </thead>
                            <tbody id="ViewProductOrder-TablBody">
                                <!-- Single Inventory Item -->
                                <tr class="ViewProductOrder-Rows">
                                    <td class="p-2">
                                        <select id="" name="" class="w-full px-2 py-1 border border-gray-400 rounded">
                                            <option value="" disabled selected>Select Inventory</option>
                                            <!-- These options will depend on the selected building -->
                                            <option value="Equipment" data-building="">Equipment</option>
                                            <option value="Supplies" data-building="">Supplies</option>
                                        </select>
                                    </td>
                                    <td class="p-2">
                                        <select id="" name="" class="w-full px-2 py-1 border border-gray-400 rounded">
                                            <option value="" disabled selected>Select Category</option>
                                            <!-- These options will depend on the selected building -->
                                            <option value="Laptop" data-building="">Laptop</option>
                                            <option value="Printer" data-building="">Printer</option>
                                        </select>
                                    </td>
                                    <td class="p-2">
                                        <select id="" name="" class="w-full px-2 py-1 border border-gray-400 rounded">
                                            <option value="" disabled selected>Select Type</option>
                                            <!-- These options will depend on the selected building -->
                                            <option value="64gb" data-building="">64gb</option>
                                            <option value="Nikon" data-building="">Nikon</option>
                                        </select>
                                    </td>
                                    <td class="p-2">
                                        <select id="" name="" class="w-full px-2 py-1 border border-gray-400 rounded">
                                            <option value="" disabled selected>Select Unit</option>
                                            <!-- These options will depend on the selected building -->
                                            <option value="Box" data-building="">Box</option>
                                            <option value="Unit" data-building="">Unit</option>
                                        </select>
                                    </td>
                                    <td class="p-2 flex justify-center">
                                        <input type="number" class="w-20 border rounded p-2" placeholder="">
                                    </td>

                                    <td class="p-2 text-center">
                                        <button type="button" class="ViewProductOrder-DeleteBTN text-red-500 hover:text-red-700">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                            </svg>
                                        </button>
                                    </td>
                                </tr>
                                <!-- More inventory rows can be added here -->
                            </tbody>
                        </table>

                        <div class="flex justify-between pt-3">
                            <button id="printProductOrderInventoryPopupCard" type="button" class="bg-green-500 hover:bg-green-700 text-white py-2 px-4 rounded">Print</button>
                            <div class="flex justify-end space-x-4">
                                <button id="ViewAddRowBTN" class="bg-blue-500 hover:bg-blue-700 text-white py-2 px-4 rounded">+ Add Item</button>
                            </div>
                        </div>
                    </div>

                    <!-- Pagination -->
                </div>
            </div>

</section>
@endsection