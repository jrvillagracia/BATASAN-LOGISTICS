@extends('adminLayouts.admin_sidebarLayout')

@section('title', 'Request Equipment | BHNHS')

@section('content')


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
                    <a href="#" class="ms-1 text-sm font-medium text-gray-700 hover:text-blue-600 md:ms-2 dark:text-gray-400 dark:hover:text-white">For Approval</a>
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
                <a href="{{route('admin_REQapprovalEquipment')}}" class="pageloader button border-b-2 border-blue-500 py-2 px-4 transition-all duration-300 translate-x-2">For Approval</a>
                <a href="{{route('admin_REQAprRequestEquipment')}}" class="pageloader button border-b-2 py-2 px-4 transition-all duration-300 translate-x-2">Approve Request</a>
                <a href="{{route('admin_REQComRequestEquipment')}}" class="pageloader button border-b-2 py-2 px-4 transition-all duration-300 translate-x-2">Completed Request</a>
                {{-- <a href="{{route('admin_REQHistoryEquipment')}}" class="pageloader button border-b-2 py-2 px-4 transition-all duration-300 translate-x-2">History</a> --}}
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
                    <button id="ReqEquipFormBtn" class="bg-blue-500 text-white p-2 rounded hover:bg-blue-600">&plus; Add Request</button>
            </div>
        </div>

        <!-- Floating Card with Form (Initially Hidden) -->
        <div id="ReqEquipFormCard" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
            <div class="bg-white p-4 rounded-lg shadow-lg max-w-4xl w-full">

                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-xl font-bold mb-4">Add Request Equipment</h2>
                    <button id="ReqEquipCloseFormBtn" class="text-gray-500 hover:text-gray-700">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <ol class="items-center w-full mb-6 space-y-4 sm:flex sm:space-x-8 sm:space-y-0 rtl:space-x-reverse" id="stepper">
                    <li id="RequestEquipStep1Icon" class="flex items-center text-blue-600 dark:text-blue-500 space-x-2.5 rtl:space-x-reverse">
                        <span class="flex items-center justify-center w-8 h-8 border border-blue-600 rounded-full shrink-0 dark:border-blue-500">
                            1
                        </span>
                        <span>
                            <h3 class="font-medium leading-tight">Fill Up Details</h3>
                        </span>
                    </li>
                    <li id="RequestEquipStep2Icon" class="flex items-center text-gray-500 dark:text-gray-400 space-x-2.5 rtl:space-x-reverse">
                        <span class="flex items-center justify-center w-8 h-8 border border-gray-500 rounded-full shrink-0 dark:border-gray-400">
                            2
                        </span>
                        <span>
                            <h3 class="font-medium leading-tight">Add a Request Equipment</h3>
                        </span>
                    </li>
                </ol>

                <!-- Step 1 Content -->
                <div id="RequestEquipStep1Content" class="bg-white border w-full border-blue-900 rounded-md shadow sm:p-8 p-6">
                    <form id="ReqEquipForm" action="" method="POST">
                        <!-- Input Fields -->
                        <div class="grid grid-cols-2 gap-4 mb-4">
                            <div>
                                <label for="datepicker-format" class="block text-sm font-semibold mb-2">Date:</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                        <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                                        </svg>
                                    </div>
                                    <input id="ReqEquipDate" type="text" readonly class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Select date">
                                </div>
                            </div>

                            <div>
                                <label for="time" class="block text-sm font-semibold mb-2">Time:</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 end-0 top-0 flex items-center pe-3.5 pointer-events-none">
                                        <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                            <path fill-rule="evenodd" d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12Zm11-4a1 1 0 1 0-2 0v4a1 1 0 0 0 .293.707l3 3a1 1 0 0 0 1.414-1.414L13 11.586V8Z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                    <input type="time" id="ReqEquipTime" name="ReqEquipTime" class="bg-gray-50 border leading-none border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" min="09:00" max="18:00" value="00:00" required />
                                </div>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="ReqEquipRequestOffice/Unit" class="block text-sm font-semibold mb-2">Requesting Office/Unit</label>
                            <select id="ReqEquipRequestOffice/Unit" name="ReqEquipRequestOffice/Unit" class="w-full px-2 py-1 border border-gray-400 rounded">
                                <option value="" disabled selected>Select Office/Unit</option>
                                <option value="">TLE Department</option>
                                <option value="">English Department</option>
                                <option value="">Storage Office</option>
                            </select>
                        </div>

                        <div class="mb-4">
                            <div class="flex space-x-4">
                                <!-- Building Dropdown -->
                                <div class="flex-1">
                                    <label for="ReqEquipBldName" class="block text-sm font-semibold mb-2">Building Name</label>
                                    <select id="ReqEquipBldName" name="ReqEquipBldName" class="w-full px-2 py-1 border border-gray-400 rounded">
                                        <option value="" disabled selected>Select Building</option>
                                        <option value=""></option>
                                    </select>
                                </div>

                                <!-- Room Dropdown -->
                                <div class="flex-1">
                                    <label for="ReqEquipRoom" class="block text-sm font-semibold mb-2">Room</label>
                                    <select id="ReqEquipRoom" name="ReqEquipRoom" class="w-full px-2 py-1 border border-gray-400 rounded">
                                        <option value="" disabled selected>Select Room</option>
                                        <!-- These options will depend on the selected building -->
                                        <option value="" data-building=""></option>
                                    </select>
                                </div>
                            </div>
                        </div>


                        <div class="mb-4">
                            <label for="ReqEquipRequestFOR" class="block text-sm font-semibold mb-2">Requesting for</label>
                            <textarea id="ReqEquipRequestFOR" class="w-full p-2 rounded border border-gray-400 mb-4 max-h-40 overflow-y-scroll" rows="3" placeholder="Enter your requesting here for..."></textarea>
                        </div>


                        <div class="flex justify-end">
                            <button id="RequestEquipGoToStep2" type="button" class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2.5 rounded">Next</button>
                        </div>
                    </form>
                </div>


                <!-- Step 2 Content -->
                <div id="RequestEquipStep2Content" class="border w-full border-blue-900 rounded-md shadow sm:p-8 p-4 hidden">
                    <!-- Add a wrapper div around the table for scrolling -->
                    <div class="overflow-y-auto max-h-60">
                        <table id="step2ReqEquipContentTable" class="w-full border-collapse">
                            <thead>
                                <tr class=" bg-blue-900">
                                    <th class="p-2 text-white">Category</th>
                                    <th class="p-2 text-white">Type</th>
                                    <th class="p-2 text-white">Unit</th>
                                    <th class="p-2 text-white">Quantity</th>
                                    <th class="p-2 text-white">Action</th>
                                </tr>
                            </thead>
                            <tbody id="RequestEquip-TablBody">
                                <!-- Single Inventory Item -->
                                <tr class="RequestEquip-Rows">
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
                                        <button type="button" class="RequestEquipDelete-row-btn text-red-500 hover:text-red-700">
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
                    <div class="flex justify-between pt-3">
                        <button id="RequestEquipBackToStep1" type="button" class="bg-gray-300 hover:bg-gray-400 text-gray-700 px-5 py-2.5 rounded">Back</button>
                        <div class="flex justify-end space-x-2">
                            <button type="button" id="RequestEquipAddRowBtn" class="bg-blue-500 hover:bg-blue-600 text-white px-5 py-2.5 rounded">+ Add Another Item</button>
                            <button id="ReqEquipCancelFormBtn" type="button" class="bg-red-500 hover:bg-red-600 text-white py-2 px-4 rounded">Cancel</button>
                            <button id="ReqEquipSubmitFormBtn" type="button" class="bg-green-500 hover:bg-green-600 text-white py-2 px-4 rounded">Submit</button>
                        </div>
                    </div>
                </div>
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
                            Request ID
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Category
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Type
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Quantity
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Requesting Office/Unit
                        </th>
                        <th scope="col" class="px-6 py-3">
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
                        <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">Laptop</td>
                        <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">64gb</td>
                        <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">10</td>
                        <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">Elementary Faculty</td>
                        <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">9/12/2024</td>
                        <td class="px-6 py-4">
                            <button id="ViewEquipBtn" type="button" class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded">View</button>
                            <button id="SetItemEquipBtn" type="button" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">Set Item</button>
                            <button id="ApprEquipBtn" type="button" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded">Approve</button>
                            <button id="DclnEquipBtn" type="button" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded">Decline</button>
                        </td>
                    </tr>

                    <!-- Dynamic rows will be inserted here -->
                </tbody>
            </table>

            <!-- View Popup Card -->
            <div id="ViewReqEquipPopupCard" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
                <div class="bg-white p-4 rounded-lg shadow-lg  w-full max-w-6xl max-h-[80vh] overflow-y-auto">
                    <div class="flex justify-between items-center mb-4">
                        <h2 class="text-lg font-semibold">Request Equipment Slip</h2>
                        <button id="closeReqViewEquipPopupCard" class="text-gray-500 hover:text-gray-700">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>

                    <div class="text-sm">
                        <p class="mb-2"><strong>Date:</strong></p>
                        <p class="mb-2"><strong>Time:</strong></p>
                        <p class="mb-2"><strong>Requesting Office/Unit:</strong></p>

                        <div class="pt-4">
                        </div>
                        <p class="mb-2"><strong>Building Name:</strong></p>
                        <p class="mb-2"><strong>Room:</strong></p>
                        <p class="mb-2"><strong>Requesting For:</strong></p>
                    </div>

                    <div class="relative shadow-md sm:rounded-lg px-6 py-3 max-h-96 overflow-y-auto">
                        <table id="step2ReqEquipContentTable" class="w-full border-collapse table-auto">
                            <thead class="text-sm text-white">
                                <tr class="bg-blue-900">
                                    <th scope="col" class="px-4 py-2 w-1/4 text-left">
                                        Category
                                    </th>
                                    <th scope="col" class="px-4 py-2 w-1/4 text-left">
                                        Type
                                    </th>
                                    <th scope="col" class="px-4 py-2 w-1/4 text-left">
                                        Unit
                                    </th>
                                    <th scope="col" class="px-4 py-2 w-1/4 text-left">
                                        Quantity
                                    </th>
                                </tr>
                            </thead>
                            <tbody id="ViewRequestEquip-TablBody">
                                <!-- Single Inventory Item -->
                                <tr class="odd:bg-blue-100 even:bg-white border-b">
                                    <td class="px-4 py-2 font-medium text-gray-900">Laptop</td>
                                    <td class="px-4 py-2 font-medium text-gray-900">64gb</td>
                                    <td class="px-4 py-2 font-medium text-gray-900">UNIT</td>
                                    <td class="px-4 py-2 font-medium text-gray-900">10</td>
                                </tr>

                                <!-- Additional rows can go here -->
                            </tbody>
                        </table>
                    </div>
                    <div class="flex justify-end space-x-4 pt-3">
                        <button id="cancelReqEquipmentInventoryPopupCard" class="bg-red-500 hover:bg-red-700 text-white py-2 px-4 rounded">Cancel</button>
                    </div>

                </div>
            </div>

            <!-- Approval Popup Card -->
            <div id="ApprReqEquipPopupCard" class="hidden fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-50 z-50">
                <div class="bg-white p-6 rounded-lg shadow-lg w-80">
                    <h2 class="text-xl font-bold mb-4 text-center">Are you sure you want to approve this request?</h2>
                    <div class="flex justify-center space-x-4">
                        <button id="submitApprReqEquipPopupCard" class="bg-green-400 hover:bg-green-500 text-white py-2 px-4 rounded">Submit</button>
                        <button id="closeApprReqEquipPopupCard" class="bg-red-400 hover:bg-red-500 text-white py-2 px-4 rounded">Cancel</button>
                    </div>
                </div>
            </div>

            <!-- Decline Popup Card -->
            <div id="DclnEquipPopupCard" class="hidden fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-50 z-50">
                <div class="bg-white p-6 rounded-lg shadow-lg w-80">

                    <!-- Reason Dropdown -->
                    <h2 class="text-xl font-bold mb-4 text-center">Are you sure you want to decline this request?</h2>

                    <div class="flex justify-center space-x-4">
                        <button id="submitDclnEquipPopupCard" class="bg-green-400 hover:bg-green-500 text-white py-2 px-4 rounded">Submit</button>
                        <button id="closeDclnEquipPopupCard" class="bg-red-400 hover:bg-red-500 text-white py-2 px-4 rounded">Cancel</button>
                    </div>
                </div>
            </div>


            <!-- Set Item Pop Up Card -->
            <div id="SetItemReqEquipPopupCard" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
                <div class="bg-white p-4 rounded-lg shadow-lg w-full max-w-8xl max-h-[80vh] overflow-y-auto">
                    <div class="flex justify-between items-center mb-4">
                        <h2 class="text-lg font-semibold ">Set Item</h2>
                        <button id="closeSetItemReqViewEquipPopupCard" class="text-gray-500 hover:text-gray-700">
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
                        <table id="reqSETITEMEquipTable" class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                            <thead class="text-sm text-white dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3"></th>
                                    <th scope="col" class="px-6 py-3">Category</th>
                                    <th scope="col" class="px-6 py-3">Brand Name</th>
                                    <th scope="col" class="px-6 py-3">Type</th>
                                    <th scope="col" class="px-6 py-3">SKU</th>
                                    <th scope="col" class="px-6 py-3">Stocks</th>
                                    <th scope="col" class="px-6 py-3">Quantity</th>
                                    <th scope="col" class="px-6 py-3">Action</th>
                                </tr>
                            </thead>
                            <tbody id="tableViewBody">
                                <tr class="odd:bg-blue-100 odd:dark:bg-gray-900 even:bg-white even:dark:bg-gray-800 border-b dark:border-gray-700">
                                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">

                                    </td>
                                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">Laptop</td>
                                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        <select name="ReqEquipBrandName" class="w-34 px-2 py-1 border border-gray-400 rounded">
                                            <option value="" disabled selected>Select Brand Name</option>
                                            <option value="BrandA">Brand A</option>
                                            <option value="BrandB">Brand B</option>
                                            <option value="BrandC">Brand C</option>
                                        </select>
                                    </td>
                                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">64gb</td>
                                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">LAP000001</td>
                                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">50</td>
                                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        <input type="text" value="1" class="border-0 border-b border-gray-500 px-2 py-1 w-20 text-center">
                                    </td>
                                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        <button id="SetItemEditBTN" class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded">Edit</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="flex justify-end space-x-4 pt-4">
                        <button id="SetItemSubmitBTN" class="bg-green-500 hover:bg-green-600 text-white py-2 px-4 rounded">Submit</button>
                        <button id="SetItemCancelBTN" class="bg-red-500 hover:bg-red-600 text-white py-2 px-4 rounded">Cancel</button>
                    </div>
                </div>
            </div>


            <!-- Edit Set Item -->
            <div id="EditSetItemReqEquipPopupCard" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 hidden">
                <div class="bg-white p-4 rounded-lg shadow-lg w-full max-w-5xl max-h-[80vh] overflow-y-auto">
                    <div class="flex justify-between items-center mb-4">
                        <h2 class="text-lg font-semibold">Edit Set Item</h2>
                        <button id="closeItemNumReqViewEquipPopupCard" class="text-gray-500 hover:text-gray-700">
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
                                    <th scope="col" class="px-6 py-3"></th>
                                    <th scope="col" class="px-6 py-3">Serial Number</th>
                                    <th scope="col" class="px-6 py-3">Control Number</th>
                                </tr>
                            </thead>
                            <tbody id="tableViewBody">
                                <tr class="odd:bg-blue-100 odd:dark:bg-gray-900 even:bg-white even:dark:bg-gray-800 border-b dark:border-gray-700" data-id="">
                                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        <input type="checkbox" class="row-checkbox">
                                    </td>
                                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">10</td>
                                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">LAP000001</td>
                                </tr>
                                <tr class="odd:bg-blue-100 odd:dark:bg-gray-900 even:bg-white even:dark:bg-gray-800 border-b dark:border-gray-700" data-id="">
                                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        <input type="checkbox" class="row-checkbox">
                                    </td>
                                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">10</td>
                                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">LAP000001</td>
                                </tr>
                                <tr class="odd:bg-blue-100 odd:dark:bg-gray-900 even:bg-white even:dark:bg-gray-800 border-b dark:border-gray-700" data-id="">
                                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        <input type="checkbox" class="row-checkbox">
                                    </td>
                                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">10</td>
                                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">LAP000001</td>
                                </tr>
                                <tr class="odd:bg-blue-100 odd:dark:bg-gray-900 even:bg-white even:dark:bg-gray-800 border-b dark:border-gray-700" data-id="">
                                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        <input type="checkbox" class="row-checkbox">
                                    </td>
                                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">10</td>
                                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">LAP000001</td>
                                </tr>
                                <tr class="odd:bg-blue-100 odd:dark:bg-gray-900 even:bg-white even:dark:bg-gray-800 border-b dark:border-gray-700" data-id="">
                                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        <input type="checkbox" class="row-checkbox">
                                    </td>
                                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">10</td>
                                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">LAP000001</td>
                                </tr>
                                <tr class="odd:bg-blue-100 odd:dark:bg-gray-900 even:bg-white even:dark:bg-gray-800 border-b dark:border-gray-700" data-id="">
                                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        <input type="checkbox" class="row-checkbox">
                                    </td>
                                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">10</td>
                                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">LAP000001</td>
                                </tr>
                                <tr class="odd:bg-blue-100 odd:dark:bg-gray-900 even:bg-white even:dark:bg-gray-800 border-b dark:border-gray-700" data-id="">
                                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        <input type="checkbox" class="row-checkbox">
                                    </td>
                                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">10</td>
                                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">LAP000001</td>
                                </tr>
                                <!-- Dynamic rows will be inserted here -->
                            </tbody>
                        </table>
                    </div>

                    <div class="flex justify-end space-x-4 pt-4">
                        <button id="EditItemSaveBTN" class="bg-green-500 hover:bg-green-600 text-white py-2 px-4 rounded">Save</button>
                        <button id="EditItemCancelBTN" class="bg-red-500 hover:bg-red-600 text-white py-2 px-4 rounded">Cancel</button>
                    </div>

                </div>
            </div>

        </div>
    </div>

</section>
@endsection