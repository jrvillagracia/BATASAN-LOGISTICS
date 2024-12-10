@extends('adminLayouts.admin_sidebarLayout')

@section('title', 'Maintenance Facility | BHNHS')

@section('content')

<section>
    <div class="flex items-center pb-8">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" strokeWidth="1.5" stroke="currentColor" class="w-9 h-9">
            <path strokeLinecap="round" strokeLinejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
        </svg>
        <h1 class="text-3xl font-bold ml-2">Maintenance Facility</h1>
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
                    <a href="#" class="ms-1 text-sm font-medium text-gray-700 hover:text-blue-600 md:ms-2 dark:text-gray-400 dark:hover:text-white">For Repair</a>
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
                <a href="{{route('admin_mainteFacility')}}" class="button border-b-2 py-2 px-4 transition-all duration-300 translate-x-2">For Approval</a>
                <a href="{{route('admin_mainteForRepFacility')}}" class="button border-b-2 border-blue-500 py-2 px-4 transition-all duration-300 translate-x-2">For Repair</a>
                <a href="{{route('admin_ComReqMainteFacility')}}" class="button border-b-2 py-2 px-4 transition-all duration-300 translate-x-2">Completed Request</a>
                <a href="{{route('admin_HistoryMainteFacility')}}" class="button border-b-2 py-2 px-4 transition-all duration-300 translate-x-2">History</a>
            </div>

            <!-- Search Bar -->
            <div class=" flex items-center space-x-4">

                <label for="maintenance-search" class="mb-2 text-sm font-medium text-gray-900 w-full sr-only dark:text-white">Search</label>
                <form id="MainteFacilitytSearchForm" class="flex items-center space-x-4">
                    <div class="relative w-96">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                            <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                            </svg>
                        </div>
                        <input type="search" id="MainteFacilitytSearch" name="MainteFacilitytSearch" class="block w-full p-4 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search" />
                    </div>

                    <!-- Add Item Button -->
            </div>
        </div>

        <!-- Floating Card with Form (Initially Hidden) -->

        <!-- Table -->
        <div class="relative shadow-md sm:rounded-lg px-9 py-5">
            <table id="MainteFacilityTable" class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-sm text-white dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            Status
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Repair ID
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Building Name
                        </th>
                        <th scope="col" class="px-6 py-30">
                            Room
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Facility Type
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
                        <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">Pending</td>
                        <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">R00001</td>
                        <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">SB</td>
                        <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">402</td>
                        <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">Insturctional</td>
                        <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">11/18/2024</td>
                        <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            <button id="REPMaintenanceFacilitytViewBTN" type="button" class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded">View</button>
                            <button id="REPMaintenanceFacilitytSetBTN" type="button" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">Set Job</button>
                            <button id="REPMaintenanceFacilityCompBTN" type="button" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded">Comnplete</button>
                            <button id="REPMaintenanceFacilityCancelBTN" type="button" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded">Cancel</button>
                        </td>
                    </tr>

                    <!-- Dynamic rows will be inserted here -->
                </tbody>
            </table>

            <!-- View Popup Card -->
            <div id="REPViewMainteFacilityPopupCard" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
                <div class="bg-white p-4 rounded-lg shadow-lg max-w-md w-full max-h-[80vh] overflow-y-auto">
                    <div class="flex justify-between items-center mb-4">
                        <h2 class="text-lg font-semibold">Maintenance Request Slip</h2>
                        <button id="REPCloseViewMainteFacilityPopupCard" class="text-gray-500 hover:text-gray-700">
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
                        <p class="mb-2"><strong>Building Name: </strong></p>
                        <p class="mb-2"><strong>Room: </strong></p>
                        <p class="mb-2"><strong>Facility Type: </strong></p>
                    </div>
                    <div class="flex justify-end space-x-4">
                        <button id="cancelViewForReprMainteFacilityPopupCard" class="bg-red-500 hover:bg-red-600 text-white py-2 px-4 rounded">Cancel</button>
                    </div>
                </div>

            </div>

            <!-- Set Job Popup Card -->
            <div id="REPSetMainteFacilityPopupCard" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
                <div class="bg-white p-4 rounded-lg shadow-lg max-w-md w-full max-h-[80vh] overflow-y-auto">
                    <div class="flex justify-between items-center mb-4">
                        <h2 class="text-lg font-semibold">JOB Slip</h2>
                        <button id="REPCloseSetMainteFacilityPopupCard" class="text-gray-500 hover:text-gray-700">
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
                        <p class="mb-2"><strong>Building Name: </strong></p>
                        <p class="mb-2"><strong>Room: </strong></p>
                        <p class="mb-2"><strong>Facility Type: </strong></p>

                        <div class="pt-4">
                        </div>
                        <p class="mb-2"><strong>Assigned Personnel: </strong></p>
                        <p class="mb-2"><strong>Technician Name: </strong> </p>
                        <p class="mb-2"><strong>Contact No: </strong> </p>
                    </div>
                    <div class="flex justify-end space-x-4">
                        <button id="printSetForRepMainteFacilityPopupCard" class="bg-green-500 hover:bg-green-600 text-white py-2 px-4 rounded">Print</button>
                        <button id="cancelSetForReprMainteFacilityPopupCard" class="bg-red-500 hover:bg-red-600 text-white py-2 px-4 rounded">Cancel</button>
                    </div>
                </div>

            </div>


            <!-- Completed Popup Card -->
            <div id="REPCompleteMntcFacilityPopCard" class="hidden fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-50 z-50">
                <div class="bg-white p-6 rounded-lg shadow-lg w-80">

                    <label for="remarks" class="block mb-2"><strong>Remarks</strong></label>
                    <textarea id="remarks" class="w-full p-2 rounded border border-gray-400 mb-4" rows="3" placeholder="Enter your remarks here..."></textarea>

                    <div class="flex justify-center space-x-4">
                        <button id="submitCompMainteFacPopupCard" class="bg-green-500 hover:bg-green-600 text-white py-2 px-4 rounded">Submit</button>
                        <button id="cancelCompMainteFacPopupCard" class="bg-red-500 hover:bg-red-600 text-white py-2 px-4 rounded">Cancel</button>
                    </div>
                </div>
            </div>

            <!--Cancel Popup Card -->
            <div id="REPCancelMainteFacilityPopupCard" class="hidden fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-50 z-50">
                <div class="bg-white p-6 rounded-lg shadow-lg w-80">

                    <!-- Remarks Textarea -->
                    <label for="remarks" class="block mb-2">Remarks</label>
                    <textarea id="remarks" class="w-full p-2 rounded border border-gray-400 mb-4" rows="3" placeholder="Enter your remarks here..."></textarea>

                    <div class="flex justify-center space-x-4">
                        <button id="submitMainteFacPopupCard" class="bg-green-500 hover:bg-green-600 text-white py-2 px-4 rounded">Submit</button>
                        <button id="cancelMainteFacPopupCard" class="bg-red-500 hover:bg-red-600 text-white py-2 px-4 rounded">Cancel</button>
                    </div>
                </div>
            </div>


            <!-- Release Popup Card -->


            <!-- Pagination -->
        </div>
    </div>

</section>

@endsection