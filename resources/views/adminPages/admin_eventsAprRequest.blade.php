@extends('adminLayouts.admin_sidebarLayout')

@section('title', 'Events and Activities | BHNHS')

@section('content')

<meta name="csrf-token" content="{{ csrf_token() }}">
<section>
    <div class="flex items-center pb-8">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" strokeWidth="1.5" stroke="currentColor" class="w-9 h-9">
            <path strokeLinecap="round" strokeLinejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
        </svg>
        <h1 class="text-3xl font-bold ml-2">Events and Activities Management</h1>
    </div>

    <!-- Breadcrumb -->
    <nav class="flex px-5 py-3 text-gray-700 border border-gray-200 rounded-lg bg-gray-50 " aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
            <li class="inline-flex items-center">
                <a href="#" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600 ">
                    Events and Activities
                </a>
            </li>
            <li>
                <div class="flex items-center">
                    <svg class="rtl:rotate-180 block w-3 h-3 mx-1 text-gray-400 " aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4" />
                    </svg>
                    <a href="#" class="ms-1 text-sm font-medium text-gray-700 hover:text-blue-600 md:ms-2">Approve Request</a>
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
                <a href="{{route('admin_eventsForApproval')}}" class="pageloader button border-b-2 py-2 px-4 transition-all duration-300 translate-x-2">For Approval</a>
                <a href="{{route('admin_eventsAprRequest')}}" class="pageloader button border-b-2 border-blue-500 py-2 px-4 transition-all duration-300 translate-x-2">Approve Request</a>
                <a href="{{route('admin_eventsComRequest')}}" class="pageloader button border-b-2 py-2 px-4 transition-all duration-300 translate-x-2">Completed Request</a>
                <a href="{{route('admin_eventsHistory')}}" class="pageloader button border-b-2 py-2 px-4 transition-all duration-300 translate-x-2">History</a>
            </div>

            <!-- Search Bar -->
            <div class=" flex items-center space-x-4">

                <label for="event-search" class="mb-2 text-sm font-medium text-gray-900 w-full sr-only dark:text-white">Search</label>
                <form id="eventSearchForm" class="flex items-center space-x-4">
                    <div class="relative w-96">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                            <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                            </svg>
                        </div>
                        <input type="search" id="eventApprReqSearch" class="block w-full p-4 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search" />
                        <button type="submit" class="text-white absolute right-2.5 top-1/2 transform -translate-y-1/2 bg-blue-500 hover:bg-blue-600 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Search</button>
                    </div>

                    <!-- Add Item Button -->

            </div>
        </div>

        <!-- Floating Card with Form (Initially Hidden) -->



        <!-- Table -->
        <div class="relative shadow-md sm:rounded-lg px-9 py-5">
            <table id="EventApproveReqTable" class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-sm text-white dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            Status
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Event ID
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Date
                        </th>
                        <th scope="col" class="px-6 py-30">
                            Time Requested
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Requesting Office/Unit
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Requesting for
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Actions
                        </th>

                </thead>
                <tbody id="tableBody" class="">
                @foreach ($events as $event)
                    <tr class="odd:bg-blue-100 even:bg-white   " data-index="" data-id="{{$event->id}}">
                        <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap ">End</td>
                        <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap ">{{$event->eventId}}</td>
                        <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap ">{{$event->EventApprDate}}</td>
                        <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap ">{{ \Carbon\Carbon::parse($event->StartEventApprTime)->format('g:ia') }}-{{ \Carbon\Carbon::parse($event->EndEventApprTime)->format('g:ia') }}</td>
                        <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap ">{{$event->EventApprRequestOffice}}</td>
                        <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap ">{{$event->EventApprRequestFor}}</td>
                        <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap ">
                            <button data-id="{{ $event->id }}" type="button" class=" EventApprReqViewBTN bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded">View</button>
                            <button data-id="{{ $event->id }}" type="button" class=" EventApprReqCompletedBTN bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded">Completed</button>
                            <button data-id="{{ $event->id }}" type="button" class=" EventApprReqCancelBTN bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded">Cancel</button>
                        </td>
                    </tr>
                    @endforeach
                    <!-- Dynamic rows will be inserted here -->
                </tbody>
            </table>

            <!-- View Popup Card -->
            @foreach ($events as $event)
            <div id="ViewEventApprReqPopupCard" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 hidden">
                <div class="bg-white p-4 rounded-lg shadow-lg w-full max-w-4xl overflow-y-auto">
                    <div class="flex justify-between items-center mb-4">
                        <h2 class="text-lg font-semibold">Event and Activity Request Slip</h2>
                    </div>

                    <div class="text-sm" id="getEventsDetails">
                        <p class="mb-2"><strong>Date:</strong>{{$event->EventApprDate}}</p>
                        <p class="mb-2"><strong>Time:</strong>{{$event->EventApprTime}}</p>
                        <p class="mb-2"><strong>Requesting Office/Unit:</strong>{{$event->EventApprRequestOffice}}</p>
                        <p class="mb-2"><strong>Event Name:</strong>{{$event->EventApprName}}</p>
                        <p class="mb-2"><strong>Event Date:</strong>{{$event->StartEventApprDate}}</p>
                        <p class="mb-2"><strong>Event Time:</strong>{{$event->StartEventApprTime}}</p>
                        <p class="mb-2"><strong>Event Location:</strong>{{$event->EventApprLocation}}</p>
                        <br>
                        <hr>
                    </div>

                    <div class="relative shadow-md sm:rounded-lg px-9 py-5 max-h-96 overflow-y-auto ">
                        <table id="EventApproveReqTable" class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                            <thead class="text-sm text-white dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3">
                                        Category
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Brand Name
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Type
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Unit
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        SKU
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Stocks
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Quantity
                                    </th>
                                </tr>
                            </thead>
                            <tbody id="tableViewBody">
                                <tr class="odd:bg-blue-100  even:bg-white  border-b " data-id="">
                                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">Laptop</td>
                                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">DELL</td>
                                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">TYPE</td>
                                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">UNIT</td>
                                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">SKU</td>
                                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">STOCKS</td>
                                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">Quantity</td>
                                </tr>


                                
                                <!-- Dynamic rows will be inserted here -->
                            </tbody>
                        </table>
                    </div>

                    <div class="flex justify-end space-x-4 pt-3">
                        <button id="printViewEventApprReqPopupCard" class="bg-green-500 hover:bg-green-600 text-white py-2 px-4 rounded">Print</button>
                        <button id="closeViewEventApprReqPopupCard" class="bg-red-500 hover:bg-red-600 text-white py-2 px-4 rounded">Close</button>
                    </div>
                </div>
            </div>
            @endforeach

            <!-- Completed Popup Card -->
            <div id="CompletedEventApprReqPopupCard" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 hidden">
                <div class="bg-white p-4 rounded-lg shadow-lg w-full max-w-8xl h-auto overflow-auto">
                    <div class="flex justify-center items-center">
                        <h2 class="text-lg text-center font-semibold px-7">Complete</h2>
                    </div>

                    <div class="flex justify-between items-center">
                        <h2 class="text-lg text-center font-semibold px-7">Item Checklist</h2>
                    </div>

                    <div class="relative shadow-md sm:rounded-lg px-9 py-5">
                        <table id="CompletedTable" class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                            <thead class="text-sm text-white dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3">
                                        
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Product Name
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Brand Name
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Type
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Quantity
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        SKU
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Missing
                                    </th>
                                </tr>
                            </thead>
                            <tbody id="tableViewBody">
                                <tr class="odd:bg-blue-100  even:bg-white  border-b " data-id="">
                                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap ">
                                        <input id="checkbox-all-search" type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 ">
                                    </td>
                                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap ">Chair</td>
                                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap ">Uratex</td>
                                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap ">monoblock</td>
                                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap ">4</td>
                                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap ">AUTOMATIC SKU</td>
                                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap ">
                                        <input type="text" value="1" class="border-0 border-b border-gray-500 px-2 py-1 w-20 text-center">
                                    </td>
                                </tr>
                                <!-- Dynamic rows will be inserted here -->
                            </tbody>
                        </table>
                    </div>

                    <div class="flex justify-end space-x-4 mt-10">
                        <button id="submitCompletedEventApprReqPopupCard" class="bg-green-500 hover:bg-green-600 text-white py-2 px-4 rounded">Submit</button>
                        <button id="closeCompletedEventApprReqPopupCard" class="bg-red-500 hover:bg-red-600 text-white py-2 px-4 rounded">Cancel</button>
                    </div>

                </div>
            </div>

            <!-- Cancel Popup Card -->
        @if(isset($event))
            <div id="CancelEventPopupCard" class="hidden fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-50 z-50">
                <div class="bg-white p-6 rounded-lg shadow-lg w-80">

                    <h2 class="text-xl font-bold mb-4 text-center">Are you sure you want to Cancel this request?</h2>
                    <!-- Remarks Textarea -->
                    <label for="remarks" class="block mb-2">Remarks</label>
                    <textarea id="CancelEventRemarks" class="w-full p-2 rounded border border-gray-400 mb-4" rows="3" placeholder="Enter your remarks here..." style="resize: none; overflow-y: auto;"></textarea>

                    <div class="flex justify-center space-x-4">
                        <button data-id="{{ $event->id }}" class=" submitCancelEventPopupCard bg-green-500 hover:bg-green-600 text-white py-2 px-4 rounded">Submit</button>
                        <button id="closeCancelEventPopupCard" class="bg-red-500 hover:bg-red-600 text-white py-2 px-4 rounded">Cancel</button>
                    </div>
                </div>
            </div>
        @else
            <!-- Pagination -->
        </div>
    </div>
@endif
</section>
@endsection