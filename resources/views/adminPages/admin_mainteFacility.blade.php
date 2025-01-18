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
                <a href="{{route('admin_mainteFacility')}}" class="pageloader button border-b-2 border-blue-500 py-2 px-4 transition-all duration-300 translate-x-2">For Approval</a>
                <a href="{{route('admin_mainteForRepFacility')}}" class="pageloader button border-b-2 py-2 px-4 transition-all duration-300 translate-x-2">For Repair</a>
                <a href="{{route('admin_ComReqMainteFacility')}}" class="pageloader button border-b-2 py-2 px-4 transition-all duration-300 translate-x-2">Completed Request</a>
                <a href="{{route('admin_HistoryMainteFacility')}}" class="pageloader button border-b-2 py-2 px-4 transition-all duration-300 translate-x-2">History</a>
            </div>

            <!-- Search Bar -->
            <div class=" flex items-center space-x-4">

                <label for="maintenance-search" class="mb-2 text-sm font-medium text-gray-900 w-full sr-only dark:text-white">Search</label>
                <form id="MainteFacilitySearchForm" class="flex items-center space-x-4">
                    <div class="relative w-96">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                            <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                            </svg>
                        </div>
                        <input type="search" id="MainteFacilitySearch" name="MainteFacilitySearch" class="block w-full p-4 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search" />
                    </div>

                    <!-- Add Item Button -->
                    <button id="MainteFacilityREQFormButton" class="bg-blue-500 text-white p-2 rounded hover:bg-blue-600">Add Request</button>
            </div>
        </div>

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
                    @foreach($facility as $mainteFacility)    
                    <tr class="odd:bg-blue-100 odd:dark:bg-gray-900 even:bg-white even:dark:bg-gray-800 border-b dark:border-gray-700 " data-index="{{$loop->index}}" data-id="{{$mainteFacility->mainteFacilityId}}">
                        <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">Pending</td>
                        <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">{{$mainteFacility->RepairId}}</td>
                        <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">{{$mainteFacility->FacilityBuildingName}}</td>
                        <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">{{$mainteFacility->FacilityRoom}}</td>
                        <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">{{$mainteFacility->FacilityType}}</td>
                        <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">{{$mainteFacility->MainteFacilityDate}}</td>
                        <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            <button data-id="{{$mainteFacility->mainteFacilityId}}" data-index="{{$loop->index}}" type="button" class=" MaintenanceFacilityViewBTN bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded">View</button>
                            <button id="MaintenanceFacilityApproveBTN" type="button" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded">Approve</button>
                            <button data-id="{{$mainteFacility->mainteFacilityId}}" type="button" class="MaintenanceFacilityDeclineBTN bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded">Decline</button>
                        </td>
                    </tr>
                    @endforeach
                    <!-- Dynamic rows will be inserted here -->
                </tbody>
            </table>

            <!-- View Popup Card -->
             @foreach($facility as $mainteFacility)
            <div id="ViewMainteFacilityPopupCard--{{$loop->index}}" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
                <div id="view-maintFacility-pdf-content" class="bg-white p-4 rounded-lg shadow-lg max-w-md w-full max-h-[80vh] overflow-y-auto">
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

                    
                    <div class="text-sm" id="showDetails">
                        <p class="mb-2"><strong>Date/Time Requested: {{$mainteFacility->MainteFacilityDate}}/{{$mainteFacility->MainteFacilityTime}}</strong></p>
                        <p class="mb-2"><strong>Requesting Office/Unit:{{$mainteFacility->MainteFacilityReqUnit}}</strong></p>
                        <p class="mb-2"><strong>Requesting for:{{$mainteFacility->MainteFacilityReqFOR}}</strong></p>

                        <div class="pt-4">
                        </div>
                        <p class="mb-2"><strong>Building Name:{{$mainteFacility->FacilityBuildingName}} </strong></p>
                        <p class="mb-2"><strong>Room:{{$mainteFacility->FacilityRoom}}</strong></p>
                        <p class="mb-2"><strong>Facility Type:{{$mainteFacility->FacilityType}}</strong></p>
                    </div>
                    <div class="flex justify-end space-x-4">
                        <button id="printForApprMainteFacilityPopupCard" class="view-MainteFaci-print-btn bg-green-500 hover:bg-green-600 text-white py-2 px-4 rounded">Print</button>
                        <button data-index="{{ $loop->index }}" class="cancelForApprMainteFacilityPopupCard view-MainteFaci-cancel-btn bg-red-500 hover:bg-red-600 text-white py-2 px-4 rounded">Cancel</button>
                    </div>
                </div>

            </div>
            @endforeach

            <!-- Approval Popup Card -->
            <div id="ApprMainteFacilityPopupCard" class="hidden fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-50 z-50">
                <div class="bg-white p-6 rounded-lg shadow-lg w-80">

                    <label for="remarks" class="block mb-2"><strong>Remarks</strong></label>
                    <textarea id="remarks" class="w-full p-2 rounded border border-gray-400 mb-4" rows="3" placeholder="Enter your remarks here..."></textarea>

                    <div class="flex justify-center space-x-4">
                        <button id="submitApprMainteFacilityPopupCard" class="bg-green-500 hover:bg-green-600 text-white py-2 px-4 rounded">Submit</button>
                        <button id="closeApprMainteFacilityPopupCard" class="bg-red-500 hover:bg-red-600 text-white py-2 px-4 rounded">Cancel</button>
                    </div>
                </div>
            </div>

            <!--Decline Popup Card -->
            <div id="DclnMainteFacilityPopupCard" class="hidden fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-50 z-50">
                <div class="bg-white p-6 rounded-lg shadow-lg w-80">

                    <!-- Reason Dropdown -->
                    <label for="reason" class="block mb-2">Reason</label>

                    <!-- Remarks Textarea -->
                    <label for="remarks" class="block mb-2">Remarks</label>
                    <textarea id="remarks" class="w-full p-2 rounded border border-gray-400 mb-4" rows="3" placeholder="Enter your remarks here..."></textarea>

                    <div class="flex justify-center space-x-4">
                        <button id="submitDclnMainteFacilityPopupCard" class="bg-green-500 hover:bg-green-600 text-white py-2 px-4 rounded">Submit</button>
                        <button id="closeDclnMainteFacilityPopupCard" class="bg-red-500 hover:bg-red-600 text-white py-2 px-4 rounded">Cancel</button>
                    </div>
                </div>
            </div>


            <!-- Floating Card with Form (Initially Hidden) -->
            <div id="MainteFacilityFormBtn" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
                <div class="bg-white p-4 rounded-lg shadow-lg max-w-lg w-full">

                    <div class="flex justify-between items-center mb-4">
                        <h2 class="text-xl font-bold mb-4">Maintenance Request Facility</h2>
                    </div>

                    <form id="MainteFacilityForm" action="" method="POST">
                        <!-- Input Fields -->

                        <input type="hidden" name="RepairId" id="RepairId" value="">

                        <div class="grid grid-cols-2 gap-4 mb-4">
                            <div>
                                <label for="datepicker-format" class="block text-sm font-semibold mb-2">Date:</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                        <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                                        </svg>
                                    </div>
                                    <input id="MainteFacilityDate" type="text" readonly class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Select date">
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
                                    <input type="time" id="MainteFacilityTime" name="MainteFacilityTime" class="bg-gray-50 border leading-none border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" min="09:00" max="18:00" required />
                                </div>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="MainteFacilityReqUnit" class="block text-sm font-semibold mb-2">Requesting Office/Unit</label>
                            <select id="MainteFacilityReqUnit" name="MainteFacilityReqUnit" class="w-full px-2 py-1 border border-gray-400 rounded">
                                <option value="" disabled selected>Select Office/Unit</option>
                            </select>
                        </div>

                        <div class="mb-4">
                            <label for="MainteFacilityReqFOR" class="block text-sm font-semibold mb-2">Requesting for</label>
                            <textarea id="MainteFacilityReqFOR" class="w-full p-2 rounded border border-gray-400 mb-4 max-h-40 overflow-y-scroll" rows="3" placeholder="Enter your requesting here for..."></textarea>
                        </div>

                        <!-- Two-column section for the specified fields -->
                        <div class="grid grid-cols-2 gap-4 mb-4">
                            <!-- Building Dropdown -->
                            <div class="flex-1">
                                <label for="FacilityBuildingName" class="block text-sm font-semibold mb-2">Building Name</label>
                                <select id="FacilityBuildingName" name="FacilityBuildingName" class="w-full px-2 py-1 border border-gray-400 rounded">
                                    <option value="" disabled selected>Select Building</option>
                                </select>
                            </div>

                            <!-- Room Dropdown -->
                            <div class="flex-1">
                                <label for="FacilityRoom" class="block text-sm font-semibold mb-2">Room</label>
                                <select id="FacilityRoom" name="FacilityRoom" class="w-full px-2 py-1 border border-gray-400 rounded">
                                    <option value="" disabled selected>Select Room</option>
                                    <!-- These options will depend on the selected building -->
                                    <option value="" data-building=""></option>
                                </select>
                            </div>


                            <div>
                                <label for="FacilityType" class="block text-sm font-semibold mb-1">Facility Type:</label>
                                <select name="FacilityType" id="FacilityType" class="border border-gray-400 p-2 rounded w-full">
                                    <option value="" disabled selected>Select a category</option>
                                </select>
                            </div>

                            <div class="flex justify-end pt-4 space-x-2">
                                <button id="CloseMainteFacilityForm" type="button" class="bg-red-500 hover:bg-red-600 text-white py-2 px-4 rounded h-12">Close</button>
                                <button id="SubmitMainteFacilityForm" type="button" class="bg-green-500 hover:bg-green-600 text-white py-2 px-4 rounded h-12">Submit</button>
                            </div>

                        </div>
                    </form>
                </div>
            </div>

            <!-- Pagination -->
        </div>
    </div>

</section>
@endsection