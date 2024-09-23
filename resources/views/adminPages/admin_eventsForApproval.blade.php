@extends('adminLayouts.admin_sidebarLayout')

@section('title', 'Events and Activities | BHNHS')

@section('content')

<section>
    <div class="flex items-center pb-8">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" strokeWidth="1.5" stroke="currentColor" class="w-9 h-9">
            <path strokeLinecap="round" strokeLinejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
        </svg>
        <h1 class="text-3xl font-bold ml-2">Events and Activities Management</h1>
    </div>

    <!-- Breadcrumb -->
    <nav class="flex px-5 py-3 text-gray-700 border border-gray-200 rounded-lg bg-gray-50 dark:bg-gray-800 dark:border-gray-700" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
            <li class="inline-flex items-center">
                <a href="#" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600 dark:text-gray-400 dark:hover:text-white">
                    Events and Activities
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
                <a href="{{route('admin_eventsForApproval')}}" class="button border-b-2 border-blue-500 py-2 px-4 transition-all duration-300 translate-x-2">For Approval</a>
                <a href="{{route('admin_eventsAprRequest')}}" class="button border-b-2 py-2 px-4 transition-all duration-300 translate-x-2">Approve Request</a>
                <a href="#" class="button border-b-2 py-2 px-4 transition-all duration-300 translate-x-2">Completed Request</a>
                <a href="{{route('admin_eventsHistory')}}" class="button border-b-2 py-2 px-4 transition-all duration-300 translate-x-2">History</a>
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
                        <input type="search" id="eventSearch" name="eventSearch" class="block w-full p-4 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search" />
                        <button type="submit" class="text-white absolute right-2.5 top-1/2 transform -translate-y-1/2 bg-blue-500 hover:bg-blue-600 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Search</button>
                    </div>

                    <!-- Add Item Button -->
                    <button id="EventFormButton" class="bg-blue-500 text-white p-2 rounded hover:bg-blue-600">Add Event</button>
            </div>
        </div>

        <!-- Floating Card with Form (Initially Hidden) -->
        <div id="EventFormCard" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
            <div class="bg-white p-4 rounded-lg shadow-lg max-w-xl w-full">

                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-xl font-bold mb-4">Add Event and Activity</h2>
                    <button id="EventCloseFormBtn" class="text-gray-500 hover:text-gray-700">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <form id="EventForm">

                    <div class="grid grid-cols-2 gap-2">
                        <!-- First column label/input -->
                        <div>
                            <label for="time" class="block text-sm font-semibold mb-2">Select time:</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 end-0 top-0 flex items-center pe-3.5 pointer-events-none">
                                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                        <path fill-rule="evenodd" d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12Zm11-4a1 1 0 1 0-2 0v4a1 1 0 0 0 .293.707l3 3a1 1 0 0 0 1.414-1.414L13 11.586V8Z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <input type="time" id="EventApprTime" class="bg-gray-50 border leading-none border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" min="09:00" max="18:00" value="00:00" required />
                            </div>
                        </div>

                        <div>
                            <label for="datepicker-format" class="block text-sm font-semibold mb-2">Date:</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                                    </svg>
                                </div>
                                <input id="EventApprDate" datepicker datepicker-min-date="06/04/2024" datepicker-max-date="05/05/2025" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Select date">
                            </div>
                        </div>

                        <div>
                            <label for="Request" class="block text-sm font-semibold mb-2">Requesting Office/Unit:</label>
                            <input type="text" id="EventApprRequestOffice" class="border border-gray-400 p-2 rounded w-full mb-2" placeholder="Request">
                        </div>

                        <div>
                            <label for="Request" class="block text-sm font-semibold mb-2">Requesting for:</label>
                            <input type="text" id="EventApprRequestFor" class="border border-gray-400 p-2 rounded w-full mb-2" placeholder="Request for...." pattern="[A-Za-z ]*" title="Only characters are allowed">
                        </div>

                        <div>
                            <label for="EName" class="block text-sm font-semibold mb-2">Event Name:</label>
                            <input type="text" id="EventApprName" class="border border-gray-400 p-2 rounded w-full mb-2" placeholder="Event Name">
                        </div>

                        <div>
                            <label for="EName" class="block text-sm font-semibold mb-2">Event Date:</label>
                            <div id="date-range-picker" date-rangepicker class="flex items-center">
                                <div class="relative">
                                    <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                        <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                                        </svg>
                                    </div>
                                    <input id="StartEventApprDate" datepicker datepicker-min-date="06/04/2024" datepicker-max-date="05/05/2025" name="start" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Select date start">
                                </div>
                                <span class="mx-4 text-gray-500">to</span>
                                <div class="relative">
                                    <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                        <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                                        </svg>
                                    </div>
                                    <input id="EndEventApprDate" datepicker datepicker-min-date="06/04/2024" datepicker-max-date="05/05/2025" name="end" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Select date end">
                                </div>
                            </div>
                        </div>

                        <div>
                            <label for="start-time" class="block text-sm font-semibold mb-2">Start time:</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 end-0 top-0 flex items-center pe-3.5 pointer-events-none">
                                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                        <path fill-rule="evenodd" d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12Zm11-4a1 1 0 1 0-2 0v4a1 1 0 0 0 .293.707l3 3a1 1 0 0 0 1.414-1.414L13 11.586V8Z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <input type="time" id="StartEventApprTime" class="bg-gray-50 border leading-none border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" min="09:00" max="18:00" value="00:00" required />
                            </div>
                        </div>

                        <div>
                            <label for="end-time" class="block text-sm font-semibold mb-2">End time:</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 end-0 top-0 flex items-center pe-3.5 pointer-events-none">
                                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                        <path fill-rule="evenodd" d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12Zm11-4a1 1 0 1 0-2 0v4a1 1 0 0 0 .293.707l3 3a1 1 0 0 0 1.414-1.414L13 11.586V8Z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <input type="time" id="EndEventApprTime" class="bg-gray-50 border leading-none border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" min="09:00" max="18:00" value="00:00" required />
                            </div>
                        </div>

                        <div>
                            <label for="ELocation" class="block text-sm font-semibold mb-2">Event Location:</label>
                            <input type="text" id="EventApprLocation" class="border border-gray-400 p-2 rounded w-full mb-2" placeholder="Event Location">
                        </div>

                        <div>
                            <label for="EProductName" class="block text-sm font-semibold mb-2">Product Name:</label>
                            <input type="text" id="EventApprProductName" class="border border-gray-400 p-2 rounded w-full mb-2" placeholder="Product Name">
                        </div>

                        <div>
                            <label for="EQuantity" class="block text-sm font-semibold mb-1">Quantity</label>
                            <input type="number" name="EventApprQuantity" id="EventQuantity" class="border border-gray-400 p-2 rounded w-full mb-2" placeholder="Quantity">
                        </div>
                    </div>

                    <div class="flex justify-end space-x-2">
                        <button id="EventCancelFormBtn" type="button" class="bg-red-500 hover:bg-red-600 text-white py-2 px-4 rounded">Cancel</button>
                        <button id="EventSubmitFormBtn" type="button" class="bg-green-500 hover:bg-green-600 text-white py-2 px-4 rounded">Submit</button>
                    </div>

                </form>
            </div>
        </div>


        <!-- Table -->
        <div class="relative shadow-md sm:rounded-lg px-9 py-5">
            <table id="EventApproveTable" class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
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

                    <tr class="odd:bg-blue-100 odd:dark:bg-gray-900 even:bg-white even:dark:bg-gray-800 border-b dark:border-gray-700 " data-index="" data-id="">
                        <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">Pending</td>
                        <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">1902</td>
                        <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">9/21/2024</td>
                        <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">1pm-5pm</td>
                        <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">Grade 9 TLE Faculty</td>
                        <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">TLE Event</td>
                        <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            <button id="EventViewBTN" type="button" class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded">View</button>
                            <button id="EventApproveBTN" type="button" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded">Approve</button>
                            <button id="EventDeclineBTN" type="button" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded">Decline</button>
                        </td>
                    </tr>

                    <!-- Dynamic rows will be inserted here -->
                </tbody>
            </table>

            <!-- View Popup Card -->
            <div id="ViewEventApprPopupCard" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
                <div class="bg-white p-4 rounded-lg shadow-lg max-w-md w-full">
                    <div class="flex justify-between items-center mb-4">
                        <h2 class="text-lg font-semibold">Event and Activity Request Slip</h2>
                    </div>

                    <div class="text-sm">
                        <p class="mb-2"><strong>Date:</strong> 25th Sept 2024</p>
                        <p class="mb-2"><strong>Time:</strong> 10:00 AM</p>
                        <p class="mb-2"><strong>Requesting Office/Unit:</strong> Marketing Department</p>
                        <p class="mb-2"><strong>Event Name:</strong> Product Launch</p>
                        <p class="mb-2"><strong>Event Date:</strong> 26th Sept 2024</p>
                        <p class="mb-2"><strong>Event Time:</strong> 11:00 AM</p>
                        <p class="mb-2"><strong>Event Location:</strong> Conference Hall</p>
                        <br>
                        <hr>
                        <br>
                        <p class="mb-2"><strong>Required Equipment and Supplies</strong></p>
                        <p class="mb-2"><strong>Product Name:</strong> Projector</p>
                        <p class="mb-2"><strong>Quantity:</strong> 1</p>
                    </div>

                    <div class="flex justify-end space-x-4">
                        <button id="printViewEventPopupCard" class="bg-green-400 hover:bg-green-500 text-white py-2 px-4 rounded">Print</button>
                        <button id="closeViewEventPopupCard" class="bg-red-400 hover:bg-red-500 text-white py-2 px-4 rounded">Close</button>
                    </div>
                </div>
            </div>

            <!-- Approval Popup Card -->
            <div id="ApprEventPopupCard" class="hidden fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-50 z-50">
                <div class="bg-white p-6 rounded-lg shadow-lg w-80">
                    <h2 class="text-xl font-bold mb-4 text-center">Are you sure you want to approve this request?</h2>

                    <label for="remarks" class="block mb-2">Remarks</label>
                    <textarea id="ApprEventRemarks" class="w-full p-2 rounded border border-gray-400 mb-4" rows="3" placeholder="Enter your remarks here..." style="resize: none; overflow-y: auto;"></textarea>

                    <div class="flex justify-center space-x-4">
                        <button id="submitApprEventPopupCard" class="bg-green-400 hover:bg-green-500 text-white py-2 px-4 rounded">Submit</button>
                        <button id="closeApprEventPopupCard" class="bg-red-400 hover:bg-red-500 text-white py-2 px-4 rounded">Cancel</button>
                    </div>
                </div>
            </div>

            <!-- Decline Popup Card -->
            <div id="DeclineEventPopupCard" class="hidden fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-50 z-50">
                <div class="bg-white p-6 rounded-lg shadow-lg w-80">

                    <h2 class="text-xl font-bold mb-4 text-center">Are you sure you want to decline this request?</h2>
                    <!-- Remarks Textarea -->
                    <label for="remarks" class="block mb-2">Remarks</label>
                    <textarea id="DeclineEventRemarks" class="w-full p-2 rounded border border-gray-400 mb-4" rows="3" placeholder="Enter your remarks here..." style="resize: none; overflow-y: auto;"></textarea>

                    <div class="flex justify-center space-x-4">
                        <button id="submitDeclineEventPopupCard" class="bg-green-400 hover:bg-green-500 text-white py-2 px-4 rounded">Submit</button>
                        <button id="closeDeclineEventPopupCard" class="bg-red-400 hover:bg-red-500 text-white py-2 px-4 rounded">Cancel</button>
                    </div>
                </div>
            </div>


            <!-- Release Popup Card -->


            <!-- Pagination -->
        </div>
    </div>

</section>
@endsection