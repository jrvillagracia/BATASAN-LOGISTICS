@extends('adminLayouts.admin_sidebarLayout')

@section('title', 'Maintenance Inveontory | BHNHS')

@section('content')

<section>
    <div class="flex items-center pb-8">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" strokeWidth="1.5" stroke="currentColor" class="w-9 h-9">
            <path strokeLinecap="round" strokeLinejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
        </svg>
        <h1 class="text-3xl font-bold ml-2">Maintenance Equipment</h1>
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
                <a href="{{route('admin_mainteEquipment')}}" class="button border-b-2 border-blue-500 py-2 px-4 transition-all duration-300 translate-x-2">For Approval</a>
                <a href="{{route('admin_mainteForRepEquip')}}" class="button border-b-2 py-2 px-4 transition-all duration-300 translate-x-2">For Repair</a>
                <a href="{{route('admin_ComReqMainteEquip')}}" class="button border-b-2 py-2 px-4 transition-all duration-300 translate-x-2">Completed Request</a>
                <a href="{{route('admin_HistoryMainteEquip')}}" class="button border-b-2 py-2 px-4 transition-all duration-300 translate-x-2">History</a>
            </div>

            <!-- Search Bar -->
            <div class=" flex items-center space-x-4">

                <label for="maintenance-search" class="mb-2 text-sm font-medium text-gray-900 w-full sr-only dark:text-white">Search</label>
                <form id="MainteEquipmentSearchForm" class="flex items-center space-x-4">
                    <div class="relative w-96">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                            <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                            </svg>
                        </div>
                        <input type="search" id="MainteEquipmentSearch" name="MainteEquipmentSearch" class="block w-full p-4 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search" />  
                    </div>

                    <!-- Add Item Button -->
                    <button id="MainteEquipmentREQFormButton" class="bg-blue-500 text-white p-2 rounded hover:bg-blue-600">Add Request</button>
            </div>
        </div>

        <!-- Floating Card with Form (Initially Hidden) -->
        <div id="MainteEquipmentFormBtn" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
            <div class="bg-white p-4 rounded-lg shadow-lg max-w-lg w-full">

                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-xl font-bold mb-4">Maintenance Request</h2>
                </div>

                <form id="MainteEquipmentForm" action="" method="POST">
                    <!-- Input Fields -->
                    <div class="mb-4">
                        <label for="datepicker-format" class="block text-sm font-semibold mb-2">Date:</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                                </svg>
                            </div>
                            <input id="MainteEquipDate" type="text" readonly class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Select date">
                        </div>


                        <label for="time" class="block text-sm font-semibold mb-2">Select time:</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 end-0 top-0 flex items-center pe-3.5 pointer-events-none">
                                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                    <path fill-rule="evenodd" d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12Zm11-4a1 1 0 1 0-2 0v4a1 1 0 0 0 .293.707l3 3a1 1 0 0 0 1.414-1.414L13 11.586V8Z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <input type="time" id="MainteEquipTime" name="MainteEquipTime" readonly class="bg-gray-50 border leading-none border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" min="09:00" max="18:00" value="00:00" required />
                        </div>
                    </div>

                    <div class="mb-4">
                        <label for="MainteEquipReqUnit" class="block text-sm font-semibold mb-2">Requesting Office/Unit</label>
                    </div>

                    <div class="mb-4">
                        <div class="flex space-x-4">
                            <!-- Building Dropdown -->
                            <div class="flex-1">
                                <label for="MainteEquipBuildingName" class="block text-sm font-semibold mb-2">Building Name</label>
                                <select id="MainteEquipBuildingName" name="MainteEquipBuildingName" class="w-full px-2 py-1 border border-gray-400 rounded">
                                    <option value="" disabled selected>Select Building</option>
                                    <option value="BuildingA">Building A</option>
                                    <option value="BuildingB">Building B</option>
                                    <option value="BuildingC">Building C</option>
                                </select>
                            </div>

                            <!-- Room Dropdown -->
                            <div class="flex-1">
                                <label for="MainteEquipRoom" class="block text-sm font-semibold mb-2">Room</label>
                                <select id="MainteEquipRoom" name="MainteEquipRoom" class="w-full px-2 py-1 border border-gray-400 rounded">
                                    <option value="" disabled selected>Select Room</option>
                                    <!-- These options will depend on the selected building -->
                                    <option value="Room101" data-building="BuildingA">Room 101</option>
                                    <option value="Room102" data-building="BuildingA">Room 102</option>
                                    <option value="Room201" data-building="BuildingB">Room 201</option>
                                    <option value="Room202" data-building="BuildingB">Room 202</option>
                                    <option value="Room301" data-building="BuildingC">Room 301</option>
                                    <option value="Room302" data-building="BuildingC">Room 302</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label for="MainteEquipReqFOR" class="block text-sm font-semibold mb-2">Requesting for</label>
                    </div>

                    <!-- Two-column section for the specified fields -->
                    <div class="grid grid-cols-2 gap-4 mb-4">
                        <div>
                            <label for="EquipmentBrandName" class="block text-sm font-semibold mb-1">Brand Name:</label>
                            <input type="text" id="EquipmentBrandName" name="EquipmentBrandName" class="border border-gray-400 p-2 rounded w-full" placeholder="Brand Name">
                        </div>

                        <div>
                            <label for="EquipmentName" class="block text-sm font-semibold mb-1">Product Name:</label>
                            <input type="text" name="EquipmentName" id="EquipmentName" class="border border-gray-400 p-2 rounded w-full" placeholder="Product Name">
                        </div>

                        <div>
                            <label for="EquipmentCategory" class="block text-sm font-semibold mb-1">Category:</label>
                            <select name="EquipmentCategory" id="EquipmentCategory" class="border border-gray-400 p-2 rounded w-full">
                                <option value="" disabled selected>Select a category</option>
                                <option value="textbook">Textbook</option>
                                <option value="office">Office Supplies</option>
                                <option value="electronics">Electronics</option>
                                <option value="other">Other</option>
                            </select>
                        </div>

                        <div>
                            <label for="EquipmentSKU" class="block text-sm font-semibold mb-1">SKU:</label>
                            <input type="text" id="EquipmentSKU" class="border border-gray-400 p-2 rounded w-full" placeholder="SKU">
                        </div>

                        <div>
                            <label for="EquipmentColor" class="block text-sm font-semibold mb-1">Color:</label>
                            <input type="text" name="EquipmentColor" id="EquipmentColor" class="border border-gray-400 p-2 rounded w-full" placeholder="Color" pattern="[A-Za-z ]*" title="Only characters are allowed">
                        </div>

                        <div>
                            <label for="EquipmentType" class="block text-sm font-semibold mb-1">Type:</label>
                            <input type="text" name="EquipmentType" id="EquipmentType" class="border border-gray-400 p-2 rounded w-full" placeholder="Type" pattern="[A-Za-z ]*" title="Only characters are allowed">
                        </div>

                        <div>
                            <label for="EquipmentSerialNo" class="block text-sm font-semibold mb-1">Serial Number:</label>
                            <input type="text" name="EquipmentSerialNo" id="EquipmentSerialNo" class="border border-gray-400 p-2 rounded w-full" placeholder="Serial Number">
                        </div>

                        <div>
                            <label for="EquipmentControlNo" class="block text-sm font-semibold mb-1">Control Number:</label>
                            <input type="text" name="EquipmentControlNo" id="EquipmentControlNo" class="border border-gray-400 p-2 rounded w-full" placeholder="Control Number">
                        </div>
                    </div>

                    <div class="flex justify-end space-x-2">
                        <button id="CloseMainteEquipForm" type="button" class="bg-red-500 hover:bg-red-600 text-white py-2 px-4 rounded">Close</button>
                        <button id="SubmitMainteEquipForm" type="button" class="bg-green-500 hover:bg-green-600 text-white py-2 px-4 rounded">Submit</button>
                    </div>
                </form>
            </div>
        </div>


        <!-- Table -->
        <div class="relative shadow-md sm:rounded-lg px-9 py-5">
            <table id="MainteInventoryTable" class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-sm text-white dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            Status
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Repair ID
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Brand Name
                        </th>
                        <th scope="col" class="px-6 py-30">
                            Product Name
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Category
                        </th>
                        <th scope="col" class="px-6 py-3">
                            SKU
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Date Requested
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Actions
                        </th>

                </thead>
                <tbody id="tableBody" class="">

                    <tr class="odd:bg-blue-100 odd:dark:bg-gray-900 even:bg-white even:dark:bg-gray-800 border-b dark:border-gray-700 " data-index="" data-id="">
                        <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">Waiting for Pick Up</td>
                        <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">BHNHS-2024-0001</td>
                        <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">Sir. Vic</td>
                        <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">TLE Department</td>
                        <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">LAPDELL-001234</td>
                        <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">LPT-0001</td>
                        <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">DELL</td>
                        <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            <button id="MaintenanceEquipmentViewBTN" type="button" class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded">View</button>
                            <button id="MaintenanceEquipmentApproveBTN" type="button" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded">Approve</button>
                            <button id="MaintenanceEquipmentDeclineBTN" type="button" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded">Decline</button>
                        </td>
                    </tr>

                    <!-- Dynamic rows will be inserted here -->
                </tbody>
            </table>

            <!-- View Popup Card -->
            <div id="ViewMainteInventoryPopupCard" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
                <div class="bg-white p-4 rounded-lg shadow-lg max-w-md w-full max-h-[80vh] overflow-y-auto">
                    <div class="flex justify-between items-center mb-4">
                        <h2 class="text-lg font-semibold">Maintenance Request Slip</h2>
                        <button id="closeViewMainteInventoryPopupCard" class="text-gray-500 hover:text-gray-700">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>

                    <div class="text-sm">
                        <p class="mb-2"><strong>Date/Time Requested: </strong></p>
                        <p class="mb-2"><strong>Requesting Office/Unit: </strong></p>
                        <p class="mb-2"><strong>Requesting for: </strong></p>

                        <div class="pt-4">
                        </div>
                        <p class="mb-2"><strong>Brand Name: </strong></p>
                        <p class="mb-2"><strong>Product Name: </strong></p>
                        <p class="mb-2"><strong>Category: </strong></p>
                        <p class="mb-2"><strong>SKU: </strong></p>
                        <p class="mb-2"><strong>Color: </strong></p>
                        <p class="mb-2"><strong>Type: </strong></p>
                        <p class="mb-2"><strong>Serial Number: </strong></p>
                        <p class="mb-2"><strong>Control Number: </strong></p>
                    </div>
                    <div class="flex justify-end space-x-4">
                        <button id="printForApprMainteInventoryPopupCard" class="bg-green-500 hover:bg-green-600 text-white py-2 px-4 rounded">Print</button>
                        <button id="cancelForApprMainteInventoryPopupCard" class="bg-red-500 hover:bg-red-600 text-white py-2 px-4 rounded">Cancel</button>
                    </div>
                </div>

            </div>

            <!-- Approval Popup Card -->
            <div id="ApprMainteInventoryPopupCard" class="hidden fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-50 z-50">
                <div class="bg-white p-6 rounded-lg shadow-lg w-80">

                    <label for="remarks" class="block mb-2"><strong>Remarks</strong></label>
                    <textarea id="remarks" class="w-full p-2 rounded border border-gray-400 mb-4" rows="3" placeholder="Enter your remarks here..."></textarea>

                    <div class="flex justify-center space-x-4">
                        <button id="submitApprMainteInventoryPopupCard" class="bg-green-500 hover:bg-green-600 text-white py-2 px-4 rounded">Submit</button>
                        <button id="closeApprMainteInventoryPopupCard" class="bg-red-500 hover:bg-red-600 text-white py-2 px-4 rounded">Cancel</button>
                    </div>
                </div>
            </div>

            <!--Decline Popup Card -->
            <div id="DclnMainteInventoryPopupCard" class="hidden fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-50 z-50">
                <div class="bg-white p-6 rounded-lg shadow-lg w-80">

                    <!-- Reason Dropdown -->
                    <label for="reason" class="block mb-2">Reason</label>
 
                    <!-- Remarks Textarea -->
                    <label for="remarks" class="block mb-2">Remarks</label>
                    <textarea id="remarks" class="w-full p-2 rounded border border-gray-400 mb-4" rows="3" placeholder="Enter your remarks here..."></textarea>

                    <div class="flex justify-center space-x-4">
                        <button id="submitDclnMainteInventoryPopupCard" class="bg-green-500 hover:bg-green-600 text-white py-2 px-4 rounded">Submit</button>
                        <button id="closeDclnMainteInventoryPopupCard" class="bg-red-500 hover:bg-red-600 text-white py-2 px-4 rounded">Cancel</button>
                    </div>
                </div>
            </div>


            <!-- Release Popup Card -->


            <!-- Pagination -->
        </div>
    </div>

</section>
@endsection