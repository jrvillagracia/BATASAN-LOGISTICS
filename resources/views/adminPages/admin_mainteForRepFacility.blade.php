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
                    <a href="#" class="ms-1 text-sm font-medium text-gray-700 hover:text-blue-600 md:ms-2 ">For Repair</a>
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
                <a href="{{route('admin_mainteFacility')}}" class="pageloader button border-b-2 py-2 px-4 transition-all duration-300 translate-x-2">For Approval</a>
                <a href="{{route('admin_mainteForRepFacility')}}" class="pageloader button border-b-2 border-blue-500 py-2 px-4 transition-all duration-300 translate-x-2">For Repair</a>
                <a href="{{route('admin_ComReqMainteFacility')}}" class="pageloader button border-b-2 py-2 px-4 transition-all duration-300 translate-x-2">Completed Request</a>
                {{-- <a href="{{route('admin_HistoryMainteFacility')}}" class="pageloader button border-b-2 py-2 px-4 transition-all duration-300 translate-x-2">History</a> --}}
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
                        <input type="search" id="MainteFacilitytSearch" name="MainteFacilitytSearch" class="block w-full p-4 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500  dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search" />
                    </div>

                    <!-- Add Item Button -->
                </form>
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
                    @foreach($facility as $mainteFacility)
                    <tr class="odd:bg-blue-100  even:bg-white  border-b  " data-index="{{$loop->index}}" data-id="{{$mainteFacility->facilityApproveId}}">
                        <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap ">Pending</td>
                        <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap ">{{$mainteFacility->RepairId}}</td>
                        <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap ">{{$mainteFacility->FacilityBuildingName}}</td>
                        <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap ">{{$mainteFacility->FacilityRoom}}</td>
                        <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap ">{{$mainteFacility->FacilityType}}</td>
                        <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap ">{{$mainteFacility->MainteFacilityDate}}</td>
                        <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap ">
                            <button data-id="{{$mainteFacility->facilityApproveId}}" data-index="{{$loop->index}}" type="button" class="REPMaintenanceFacilitytViewBTN bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded">View</button>
                            <button data-id="{{$mainteFacility->facilityApproveId}}" data-index="{{$loop->index}}" type="button" class="REPMaintenanceFacilitytSetBTN bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">Set Job</button>
                            <button data-id="{{$mainteFacility->facilityApproveId}}" data-index="{{$loop->index}}" type="button" class="REPMaintenanceFacilityCompBTN bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded">Comnplete</button>
                            <button data-id="{{$mainteFacility->facilityApproveId}}" data-index="{{$loop->index}}" type="button" class="REPMaintenanceFacilityCancelBTN bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded">Cancel</button>
                        </td>
                    </tr>
                    @endforeach
                    <!-- Dynamic rows will be inserted here -->
                </tbody>
            </table>

            <!-- View Popup Card -->
             @foreach($facility as $mainteFacility)
            <div id="REPViewMainteFacilityPopupCard--{{$loop->index}}" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
                <div class="bg-white p-4 rounded-lg shadow-lg max-w-md w-full max-h-[80vh] overflow-y-auto">
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
                        <p class="mb-2"><strong>Date/Time Requested:{{$mainteFacility->MainteFacilityDate}}/{{$mainteFacility->MainteFacilityTime}} </strong></p>
                        <p class="mb-2"><strong>Requesting Office/Unit:{{$mainteFacility->MainteFacilityReqUnit}} </strong></p>
                        <p class="mb-2"><strong>Requesting for:{{$mainteFacility->MainteFacilityReqFOR}} </strong></p>

                        <div class="pt-4">
                        </div>
                        <p class="mb-2"><strong>Building Name:{{$mainteFacility->FacilityBuildingName}} </strong></p>
                        <p class="mb-2"><strong>Room:{{$mainteFacility->FacilityRoom}}</strong></p>
                        <p class="mb-2"><strong>Facility Type:{{$mainteFacility->FacilityType}} </strong></p>
                    </div>
                    <div class="flex justify-end space-x-4">
                        <button data-index="{{$loop->index}}" class="cancelViewForReprMainteFacilityPopupCard bg-red-500 hover:bg-red-600 text-white py-2 px-4 rounded">Close</button>
                    </div>
                </div>

            </div>
            @endforeach

            <!-- Set Job Popup Card -->
            @foreach($facility as $mainteFacility)
            <div id="REPSetMainteFacilityPopupCard--{{$loop->index}}" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
                <div id="set-item-FORRE-maintFaci-print-btn" class="bg-white p-4 rounded-lg shadow-lg max-w-md w-full max-h-[80vh] overflow-y-auto">
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
                        <p class="mb-2"><strong>Date/Time Requested:{{$mainteFacility->MainteFacilityDate}}/{{$mainteFacility->MainteFacilityTime}} </strong></p>
                        <p class="mb-2"><strong>Requesting Office/Unit:{{$mainteFacility->MainteFacilityReqUnit}}  </strong></p>
                        <p class="mb-2"><strong>Requesting for:{{$mainteFacility->MainteFacilityReqFOR}} </strong></p>

                        <div class="pt-4">
                        </div>
                        <p class="mb-2"><strong>Building Name:{{$mainteFacility->FacilityBuildingName}} </strong></p>
                        <p class="mb-2"><strong>Room:{{$mainteFacility->FacilityRoom}} </strong></p>
                        <p class="mb-2"><strong>Facility Type:{{$mainteFacility->FacilityType}} </strong></p>

                        <div class="pt-4">
                        </div>
                        <p class="mb-2"><strong>Assigned Personnel: </strong></p>
                        <p class="mb-2"><strong>Technician Name: </strong> </p>
                        <p class="mb-2"><strong>Contact No: </strong> </p>
                    </div>
                    <div class="flex justify-end space-x-4">
                        <button id="printSetForRepMainteFacilityPopupCard" class="set-item-FOR-REP-FACILITY-print-btn bg-green-500 hover:bg-green-600 text-white py-2 px-4 rounded">Print</button>
                        <button data-index="{{$loop->index}}" class="cancelSetForReprMainteFacilityPopupCard set-item-FOR-REP-FACILITY-cance-btn bg-red-500 hover:bg-red-600 text-white py-2 px-4 rounded">Cancel</button>
                    </div>
                </div>

            </div>
            @endforeach

            <!-- Completed Popup Card -->
            @foreach($facility as $mainteFacility)
            <div id="REPCompleteMntcFacilityPopCard" class="hidden fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-50 z-50">
                <div class="bg-white p-6 rounded-lg shadow-lg w-80">

                    <label for="remarks" class="block mb-2"><strong>Remarks</strong></label>
                    <textarea id="remarks" class="w-full p-2 rounded border border-gray-400 mb-4" rows="3" placeholder="Enter your remarks here..."></textarea>

                    <div class="flex justify-center space-x-4">
                        <button data-id="{{$mainteFacility->facilityApproveId}}" class="submitCompMainteFacPopupCard bg-green-500 hover:bg-green-600 text-white py-2 px-4 rounded">Submit</button>
                        <button id="cancelCompMainteFacPopupCard" class="bg-red-500 hover:bg-red-600 text-white py-2 px-4 rounded">Cancel</button>
                    </div>
                </div>
            </div>
            @endforeach

            <!--Cancel Popup Card -->
            @foreach($facility as $mainteFacility)
            <div id="REPCancelMainteFacilityPopupCard" class="hidden fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-50 z-50">
                <div class="bg-white p-6 rounded-lg shadow-lg w-80">

                    <!-- Remarks Textarea -->
                    <label for="remarks" class="block mb-2">Remarks</label>
                    <textarea id="remarks" class="w-full p-2 rounded border border-gray-400 mb-4" rows="3" placeholder="Enter your remarks here..."></textarea>

                    <div class="flex justify-center space-x-4">
                        <button data-id="{{$mainteFacility->facilityApproveId}}" class="submitMainteFacPopupCard bg-green-500 hover:bg-green-600 text-white py-2 px-4 rounded">Submit</button>
                        <button id="cancelMainteFacPopupCard" class="bg-red-500 hover:bg-red-600 text-white py-2 px-4 rounded">Cancel</button>
                    </div>
                </div>
            </div>
            @endforeach

            <!-- Release Popup Card -->


            <!-- Pagination -->
        </div>
    </div>

</section>
@endsection