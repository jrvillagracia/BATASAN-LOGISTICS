@extends('adminLayouts.admin_sidebarLayout')

@section('title', 'Maintenance Inventory | BHNHS')

@section('content')

<section>
    <div class="flex items-center pb-8">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" strokeWidth="1.5" stroke="currentColor" class="w-9 h-9">
            <path strokeLinecap="round" strokeLinejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
        </svg>
        <h1 class="text-3xl font-bold ml-2">Maintenance Equipment</h1>
    </div>

    <!-- Breadcrumb -->
    <nav class="flex px-5 py-3 text-gray-700 border border-gray-200 rounded-lg bg-gray-50 " aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
            <li class="inline-flex items-center">
                <a href="#" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600 ">
                    Request
                </a>
            </li>
            <li>
                <div class="flex items-center">
                    <svg class="rtl:rotate-180 block w-3 h-3 mx-1 text-gray-400 " aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4" />
                    </svg>
                    <a href="#" class="ms-1 text-sm font-medium text-gray-700 hover:text-blue-600 md:ms-2 ">For Approval</a>
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
                <a href="{{route('admin_mainteEquipment')}}" class="pageloader button border-b-2 border-blue-500 py-2 px-4 transition-all duration-300 translate-x-2">For Approval</a>
                <a href="{{route('admin_mainteForRepEquip')}}" class="pageloader button border-b-2 py-2 px-4 transition-all duration-300 translate-x-2">For Repair</a>
                <a href="{{route('admin_ComReqMainteEquip')}}" class="pageloader button border-b-2 py-2 px-4 transition-all duration-300 translate-x-2">Completed Request</a>
                {{-- <!--<a href="{{route('admin_HistoryMainteEquip')}}" class="pageloader button border-b-2 py-2 px-4 transition-all duration-300 translate-x-2">History</a> --> --}}
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
                        <input type="search" id="MainteEquipmentSearch" name="MainteEquipmentSearch" class="block w-full p-4 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500  dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search" />
                    </div>

                    <!-- Add Item Button -->
                    <button id="MainteEquipmentREQFormButton" class="bg-blue-500 text-white p-2 rounded hover:bg-blue-600">Add Request</button>
            </div>
        </div>

        <!-- Floating Card with Form (Initially Hidden) -->
        <div id="MainteEquipmentFormBtn" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
            <div class="bg-white p-4 rounded-lg shadow-lg max-w-4xl w-full">

                <div class="flex justify-center items-center mb-4 relative">
                    <h2 class="text-xl font-bold">Maintenance Request</h2>
                    <button id="closeAddReqMainteEquipInventoryPopupCard" class="absolute right-0 text-gray-500 hover:text-gray-700">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <ol class="items-center w-full mb-6 space-y-4 sm:flex sm:space-x-8 sm:space-y-0 rtl:space-x-reverse" id="stepper">
                    <li id="MainteEquipStep1Icon" class="flex items-center text-blue-600 dark:text-blue-500 space-x-2.5 rtl:space-x-reverse">
                        <span class="flex items-center justify-center w-8 h-8 border border-blue-600 rounded-full shrink-0 dark:border-blue-500">
                            1
                        </span>
                        <span>
                            <h3 class="font-medium leading-tight">Fill Up Details</h3>
                        </span>
                    </li>
                    <li id="MainteEquipStep2Icon" class="flex items-center text-gray-500 dark:text-gray-400 space-x-2.5 rtl:space-x-reverse">
                        <span class="flex items-center justify-center w-8 h-8 border border-gray-500 rounded-full shrink-0 dark:border-gray-400">
                            2
                        </span>
                        <span>
                            <h3 class="font-medium leading-tight">Add a Maintenance Request Inventory </h3>
                        </span>
                    </li>
                </ol>
                <!-- Step 1 Content -->
                <div id="MainteEquipStep1Content" class="bg-white border w-full border-blue-900 rounded-md shadow sm:p-8 p-6">
                    <form id="MainteEquipmentForm" action="" method="POST">
                        <!-- Input Fields -->

                        <input type="hidden" name="mainteEquipmentId" id="mainteEquipmentId" value="">

                        <input type="hidden" name="equipmentStockId" id="equipmentStockId" required>

                        <div class="grid grid-cols-2 gap-4 mb-4">
                            <div>
                                <label for="datepicker-format" class="block text-sm font-semibold mb-2">Date:</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                        <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                                        </svg>
                                    </div>
                                    <input id="MainteEquipDate" type="text" readonly class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5 dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Select date">
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
                                    <input type="time" id="MainteEquipTime" name="MainteEquipTime" class="bg-gray-50 border leading-none border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5  dark:focus:ring-blue-500 dark:focus:border-blue-500" min="09:00" max="18:00" value="00:00" required />
                                </div>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="MainteEquipReqUnit" class="block text-sm font-semibold mb-2">Requesting Office/Unit</label>
                            <select id="MainteEquipReqUnit" name="MainteEquipReqUnit" class="w-full px-2 py-1 border border-gray-400 rounded" required>  
                                <option value="" disabled selected>Select Office/Unit</option>
                            </select>
                            <span id="unitError" class="text-red-500 text-sm hidden">This field is required.</span>
                        </div>

                        <div class="mb-4">
                            <label for="MainteEquipReqFOR" class="block text-sm font-semibold mb-2">Requesting for</label>
                            <textarea id="MainteEquipReqFOR" class="w-full p-2 rounded border border-gray-400 mb-4 max-h-40 overflow-y-scroll" rows="3" placeholder="Enter your requesting here for..." required></textarea>
                            <span id="forError" class="text-red-500 text-sm hidden">This field is required.</span>
                        </div>


                        <div class="flex justify-end">
                            <button id="MainteEquipGoToStep2" type="button" class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2.5 rounded">Next</button>
                        </div>
                    </form>
                </div>

                <!-- Step 2 Content -->
                <div id="MainteEquipStep2Content" class="border w-full border-blue-900 rounded-md shadow sm:p-8 p-4 hidden">
                    <!-- Add a wrapper div around the table for scrolling -->
                    <div class="overflow-y-auto max-h-60">
                        <table id="step2ContentTable" class="w-full border-collapse">
                            <thead>
                                <tr class="bg-gray-200">
                                    <th class="p-2 text-black">Serial Number</th>
                                    <th class="p-2 text-black">Control Number</th>
                                    <th class="p-2 text-black">Actions</th>
                                </tr>
                            </thead>
                            <tbody id="MaintenanceEquip-TablBody">
                                <!-- Single Inventory Item -->
                                <tr class="MaintenanceEquip-Rows">
                                    <td class="p-2">
                                        <select class="js-serial-number w-full rounded p-2">
                                            <!-- Options will be dynamically loaded -->
                                        </select>
                                    </td>
                                    <td class="p-2">
                                        <input type="text" class="w-full rounded p-2" placeholder="Control Number">
                                    </td>
                                    <td class="p-2 text-center">
                                        <button id="viewMainteEquipReqBTN" type="button">
                                            <svg class="w-[27px] h-[27px] text-green-600 " aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                                <path stroke="currentColor" stroke-width="2" d="M21 12c0 1.2-4.03 6-9 6s-9-4.8-9-6c0-1.2 4.03-6 9-6s9 4.8 9 6Z" />
                                                <path stroke="currentColor" stroke-width="2" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                            </svg>
                                        </button>
                                        <button type="button" class="MainteEquipDelete-row-btn text-red-500 hover:text-red-700">
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
                        <button id="MainteEquipBackToStep1" type="button" class="bg-gray-300 hover:bg-gray-400 text-gray-700 px-5 py-2.5 rounded">Back</button>
                        <div class="flex justify-end space-x-2">
                            <button type="button" id="MainteEquipAddRowBtn" class="bg-blue-500 hover:bg-blue-600 text-white px-5 py-2.5 rounded">+ Add Another Item</button>
                            <button id="CloseMainteEquipForm" type="button" class="bg-red-500 hover:bg-red-600 text-white py-2 px-4 rounded">Close</button>
                            <button id="SubmitMainteEquipForm" type="button" class="bg-green-500 hover:bg-green-600 text-white py-2 px-4 rounded">Submit</button>
                        </div>
                    </div>
                </div>
                <!-- Submit & Cancel Buttons -->
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
                @foreach($equipment as $mergedData)
                <tr class="odd:bg-blue-100  even:bg-white  border-b ">
                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap ">Waiting for Pick Up</td>
                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap ">{{ $mergedData->mainteEquipmentId ?? 'N/A' }}</td>
                    
                    <!-- Displaying Brand Name, Equipment Name, Category, and SKU from the equipmentStock relation -->
                    @if($mergedData->equipmentStock)
                        <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap ">{{ $mergedData->equipmentStock->EquipmentBrandName }}</td>
                        <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap ">{{ $mergedData->equipmentStock->EquipmentName }}</td>
                        <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap ">{{ $mergedData->equipmentStock->EquipmentCategory }}</td>
                        <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap ">{{ $mergedData->equipmentStock->EquipmentSKU }}</td>
                    @else
                        <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap ">N/A</td>
                        <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap ">N/A</td>
                        <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap ">N/A</td>
                        <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap ">N/A</td>
                    @endif
                    
                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap ">{{ $mergedData->MainteEquipDate ?? 'N/A' }}</td>
                    
                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap ">
                        <button id="MaintenanceEquipmentViewBTN" type="button" class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded">View</button>
                        <button id="MaintenanceEquipmentApproveBTN" type="button" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded">Approve</button>
                        <button id="MaintenanceEquipmentDeclineBTN" type="button" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded">Decline</button>
                    </td>
                </tr>
                @endforeach
                    <!-- Dynamic rows will be inserted here -->
                </tbody>
            </table>

            <!-- View Popup Card -->
            <div id="ViewMainteInventoryPopupCard" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
                <div id="view-maintequip-pdf-content" class="bg-white p-4 rounded-lg shadow-lg max-w-md w-full max-h-[80vh] overflow-y-auto">
                    <div class="flex flex-col items-center mb-4">
                        <div class="flex items-center">
                            <div class="rounded-full w-20 h-15 flex items-center justify-center overflow-hidden">
                                <img src="{{asset('img/logo.png')}}" alt="Logo" class="w-full h-full object-cover" />
                            </div>
                            <div class="ml-4 text-center">
                                <span class="font-bold text-lg text-black">Batasan Hills National High School</span>
                            </div>
                        </div>
                        <h2 class="text-lg font-semibold mt-2 text-center">Maintenance Request Slip</h2>
                    </div>

                    <div class="text-sm">
                        <p class="mb-2"><strong>Date/Time Requested: </strong></p>
                        <p class="mb-2"><strong>Requesting Office/Unit: </strong></p>
                        <p class="mb-2"><strong>Requesting for: </strong></p>

                        <div class="pt-4">
                        </div>
                        <p class="mb-2"><strong>Building Name: </strong></p>
                        <p class="mb-2"><strong>Room: </strong></p>
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
                        <button id="printForApprMainteInventoryPopupCard" class="print-btn bg-green-500 hover:bg-green-600 text-white py-2 px-4 rounded">Print</button>
                        <button id="cancelForApprMainteInventoryPopupCard" class="cancel-btn bg-red-500 hover:bg-red-600 text-white py-2 px-4 rounded">Cancel</button>
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

            <!-- VIEWING BUTTON IN MAINTENANCE REQUEST -->
            <div id="View-Mainte-Equip-InventoryPopupCard" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
                <div class="bg-white p-4 rounded-lg shadow-lg max-w-md w-full max-h-[80vh] overflow-y-auto">
                    <div class="flex justify-between items-center mb-4">
                        <h2 class="text-lg font-semibold">Name of the [CATEGORY OF THE EQUIPMENT]</h2>
                    </div>

                    
                    <div class="text-sm">
                        <p class="mb-2"><strong>Brand Name: </strong></p>
                        <p class="mb-2"><strong>Product Name: </strong></p>
                        <p class="mb-2"><strong>Category: </strong></p>
                        <p class="mb-2"><strong>SKU: </strong></p>
                        <p class="mb-2"><strong>Color: </strong></p>
                        <p class="mb-2"><strong>Type: </strong></p>

                        <div class="pt-4">
                            <hr>
                        </div>

                        <p class="mb-2"><strong>Building Name: </strong></p>
                        <p class="mb-2"><strong>Room: </strong></p>

                        <div class="pt-4">
                            <hr>
                        </div>

                        <p class="mb-2"><strong>Serial Number: </strong></p>
                        <p class="mb-2"><strong>Control Number: </strong></p>

                    </div>
                    <div class="flex justify-end space-x-4">
                        <button id="closeView-Mainte-Equip-InventoryPopupCard" class="bg-red-500 hover:bg-red-600 text-white py-2 px-4 rounded">Close</button>
                    </div>
                </div>
            </div>


            <!-- Pagination -->
        </div>
    </div>

</section>
@endsection