@extends('adminLayouts.admin_sidebarLayout')

@section('title', 'Events and Activities | BHNHS')

@section('content')

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
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
                <a href="{{route('admin_eventsForApproval')}}" class="pageloader button border-b-2 border-blue-500 py-2 px-4 transition-all duration-300 translate-x-2">For Approval</a>
                <a href="{{route('admin_eventsAprRequest')}}" class="pageloader button border-b-2 py-2 px-4 transition-all duration-300 translate-x-2">Approve Request</a>
                <a href="{{route('admin_eventsComRequest')}}" class="pageloaderbutton border-b-2 py-2 px-4 transition-all duration-300 translate-x-2">Completed Request</a>
                {{-- <a href="{{route('admin_eventsHistory')}}" class="pageloader button border-b-2 py-2 px-4 transition-all duration-300 translate-x-2">History</a> --}}
            </div>

            <!-- Search Bar -->
            <div class=" flex items-center space-x-4">

                <label for="event-search" class="mb-2 text-sm font-medium text-gray-900 w-full sr-only">Search</label>
                <form id="eventSearchForm" class="flex items-center space-x-4">
                    <div class="relative w-96">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                            <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                            </svg>
                        </div>
                        <input type="search" id="eventSearch" name="eventSearch" class="block w-full p-4 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search" />
                    </div>

                    <!-- Add Item Button -->
                    <button id="EventFormButton" class="bg-blue-500 text-white p-2 rounded hover:bg-blue-600">Add Event</button>
            </div>
        </div>

        <!-- Floating Card with Form (Initially Hidden) -->
        <div id="EventFormCard" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
            <div class="bg-white p-4 rounded-lg shadow-lg max-w-4xl w-full">

                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-xl font-bold mb-4">Add Event and Activity</h2>
                    <button id="EventCloseFormBtn" class="text-gray-500 hover:text-gray-700">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <ol class="items-center w-full mb-6 space-y-4 sm:flex sm:space-x-8 sm:space-y-0 rtl:space-x-reverse" id="stepper">
                    <li id="EventsStep1Icon" class="flex items-center text-blue-600 dark:text-blue-500 space-x-2.5 rtl:space-x-reverse">
                        <span class="flex items-center justify-center w-8 h-8 border border-blue-600 rounded-full shrink-0 dark:border-blue-500">
                            1
                        </span>
                        <span>
                            <h3 class="font-medium leading-tight">Fill Up Details</h3>
                        </span>
                    </li>
                    <li id="EventsStep2Icon" class="flex items-center text-gray-500 dark:text-gray-400 space-x-2.5 rtl:space-x-reverse">
                        <span class="flex items-center justify-center w-8 h-8 border border-gray-500 rounded-full shrink-0 dark:border-gray-400">
                            2
                        </span>
                        <span>
                            <h3 class="font-medium leading-tight">Request Inventory To Events</h3>
                        </span>
                    </li>
                </ol>

                <!-- Step 1 Content -->
                <div id="EventsActStep1Content" class="bg-white border w-full border-blue-900 rounded-md shadow sm:p-8 p-6">
                    <form id="EventForm" action="{{ route('events.store') }}" method="POST">
                        <!-- Input Fields -->
                        @csrf
                        <div class="grid grid-cols-2 gap-2">
                            <!-- First column label/input -->
                            <input type="hidden" name="event_id" id="event_id" value="{{ $event->event_id ?? '' }}">
                            <div>
                                <label for="time" class="block text-sm font-semibold mb-2">Time:</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 end-0 top-0 flex items-center pe-3.5 pointer-events-none">
                                        <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                            <path fill-rule="evenodd" d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12Zm11-4a1 1 0 1 0-2 0v4a1 1 0 0 0 .293.707l3 3a1 1 0 0 0 1.414-1.414L13 11.586V8Z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                    <input type="time" id="EventApprTime" name="EventApprtime" readonly class="bg-gray-50 border leading-none border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5  dark:focus:ring-blue-500 dark:focus:border-blue-500" min="09:00" max="18:00" value="00:00" required />
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
                                    <input id="EventApprDate" name="EventApprDate" readonly datepicker datepicker-min-date="06/04/2024" datepicker-max-date="05/05/2025" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Select date">
                                </div>
                            </div>

                            <div>
                                <label for="EventApprRequestOffice" class="block text-sm font-semibold mb-2">Requesting Office/Unit</label>
                                <select id="EventApprRequestOffice" name="EventApprRequestOffice" class="w-full px-2 py-1 border border-gray-400 rounded">
                                    <option value="" disabled selected>Select Office/Unit</option>
                                    <option value="">TLE Department</option>
                                    <option value="">English Department</option>
                                    <option value="">Storage Office</option>
                                </select>
                            </div>

                            <div>
                                <label for="Request" class="block text-sm font-semibold mb-2">Requesting for:</label>
                                <input type="text" id="EventApprRequestFor" name="EventApprRequestFor" class="border border-gray-400 p-2 rounded w-full mb-2" placeholder="Request for...." pattern="[A-Za-z ]*" title="Only characters are allowed">
                            </div>

                            <div>
                                <label for="EName" class="block text-sm font-semibold mb-2">Event Name:</label>
                                <input type="text" id="EventApprName" name="EventApprName" class="border border-gray-400 p-2 rounded w-full mb-2" placeholder="Event Name">
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
                                        <input id="StartEventApprDate" datepicker datepicker-min-date="06/04/2024" datepicker-max-date="05/05/2025" name="startEventApprDate" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5   dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Select date start">
                                    </div>
                                    <span class="mx-4 text-gray-500">to</span>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                            <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                                            </svg>
                                        </div>
                                        <input id="EndEventApprDate" datepicker datepicker-min-date="06/04/2024" datepicker-max-date="05/05/2025" name="endEventApprDate" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5   dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Select date end">
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
                                    <input type="time" id="StartEventApprTime" name="StartEventApprTime" class="bg-gray-50 border leading-none border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5  dark:focus:ring-blue-500 dark:focus:border-blue-500" min="09:00" max="18:00" value="00:00" required />
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
                                    <input type="time" id="EndEventApprTime" name="EndEventApprTime" class="bg-gray-50 border leading-none border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5  dark:focus:ring-blue-500 dark:focus:border-blue-500" min="09:00" max="18:00" value="00:00" required />
                                </div>
                            </div>

                            <div>
                                <label for="EventsActBldName" class="block text-sm font-semibold mb-2">Building Name</label>
                                <select id="EventsActBldName" name="EventsActBldName" class="w-full px-2 py-1 border border-gray-400 rounded">
                                    <option value="" disabled selected>Select Building</option>
                                    <option value=""></option>
                                </select>
                            </div>

                            <div>
                                <label for="EventsActRoom" class="block text-sm font-semibold mb-2">Room</label>
                                <select id="EventsActRoom" name="EventsActRoom" class="w-full px-2 py-1 border border-gray-400 rounded">
                                    <option value="" disabled selected>Select Room</option>
                                    <option value=""></option>
                                </select>
                            </div>

                        </div>
                        <div class="flex justify-end pt-5">
                            <button id="EventGoToStep2" type="button" class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2.5 rounded">Next</button>
                        </div>
                    </form>
                </div>

                <!-- Step 2 Content -->
                <div id="EventsActStep2Content" class="border w-full border-blue-900 rounded-md shadow sm:p-8 p-4 hidden">
                    <!-- Add a wrapper div around the table for scrolling -->
                    <div class="overflow-y-auto max-h-60">
                        <table id="step2ContentTable" class="w-full border-collapse">
                            <thead>
                                <tr class=" bg-blue-900">
                                    <th class="p-2 text-white">Inventory</th>
                                    <th class="p-2 text-white">Category</th>
                                    <th class="p-2 text-white">Type</th>
                                    <th class="p-2 text-white">Unit</th>
                                    <th class="p-2 text-white">Quantity</th>
                                    <th class="p-2 text-white">Action</th>
                                </tr>
                            </thead>
                            <tbody id="Events-TablBody">
                                <!-- Single Inventory Item -->
                                <tr class="Events-Rows">
                                    <td class="p-2">
                                        <select id="EventsActivityInventory" name="EventsActivityInventory" class="w-full px-2 py-1 border border-gray-400 rounded">
                                            <option value="EventsActivityInventory" disabled selected>Select Inventory</option>
                                            <!-- These options will depend on the selected building -->
                                            <option value="Equipment" data-building="">Equipment</option>
                                            <option value="Supplies" data-building="">Supplies</option>
                                        </select>
                                    </td>
                                    <td class="p-2">
                                        <select id="EventActCategoryName" name="EventActCategoryName" class="w-full px-2 py-1 border border-gray-400 rounded">
                                            <option value="EventActCategoryName" disabled selected>Select Category</option>
                                            <!-- These options will depend on the selected building -->
                                        </select>
                                    </td>
                                    <td class="p-2">
                                        <select id="EventActType" name="EventActType" class="w-full px-2 py-1 border border-gray-400 rounded">
                                            <option value="EventActType" disabled selected>Select Type</option>
                                            <!-- These options will depend on the selected building -->
                                        </select>
                                    </td>
                                    <td class="p-2">
                                        <select id="EventActUnit" name="EventActUnit" class="w-full px-2 py-1 border border-gray-400 rounded">
                                            <option value="EventActUnit" disabled selected>Select Unit</option>
                                            <!-- These options will depend on the selected building -->
                                        </select>
                                    </td>
                                    <td class="p-2">
                                        <input type="number" id="EventActQuantity" class="w-20 border rounded p-2" placeholder="">
                                    </td>

                                    <td class="p-2 text-center">
                                        <button type="button" class="EventActivitiesDelete-row-btn text-red-500 hover:text-red-700">
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
                        <button id="EventBackToStep1" type="button" class="bg-gray-300 hover:bg-gray-400 text-gray-700 px-5 py-2.5 rounded">Back</button>
                        <div class="flex justify-end space-x-2">
                            <button type="button" id="EventAddRowBtn" class="bg-blue-500 hover:bg-blue-600 text-white px-5 py-2.5 rounded">+ Add Another Item</button>
                            <button id="EventCancelFormBtn" type="button" class="bg-red-500 hover:bg-red-600 text-white py-2 px-4 rounded">Cancel</button>
                            <button id="EventSubmitFormBtn" type="button" class="bg-green-500 hover:bg-green-600 text-white py-2 px-4 rounded">Submit</button>
                        </div>
                    </div>
                </div>

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
                    @foreach ($events as $event)
                    <tr class="odd:bg-blue-100 even:bg-white border-b" data-index="" data-id="{{$event->id}}">
                        <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">{{$event->status}}</td>
                        <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">{{$event->eventId}}</td>
                        <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap ">{{$event->EventApprDate}}</td>
                        <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap ">{{ \Carbon\Carbon::parse($event->StartEventApprTime)->format('g:ia') }}-{{ \Carbon\Carbon::parse($event->EndEventApprTime)->format('g:ia') }}</td>
                        <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">{{$event->EventApprRequestOffice}} Department</td>
                        <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">{{$event->EventApprRequestFor}}</td>
                        <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                            <button type="button" data-id="{{ $event->id }}" class=" EventViewBTN bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded">View</button>
                            <button type="button" id="EventForApprvlSetItemBTN" class=" EventForApprvlSetItemBTN bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">Set Item</button>
                            <button type="button" data-id="{{ $event->id }}" class=" EventApproveBTN bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded">Approve</button>
                            <button type="button" data-id="{{ $event->id }}" class=" EventDeclineBTN bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded">Decline</button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <!-- View Popup Card -->
            @foreach ($events as $event)
            <div id="ViewEventApprPopupCard" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden" data-id="">
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
                        <p class="mb-2"><strong>Event Location:</strong>{{$event->EventsActBldName}} - {{$event->EventsActRoom}}</p>
                        <br>
                        <hr>
                    </div>

                    <div class="relative shadow-md sm:rounded-lg px-9 py-5 max-h-96 overflow-y-auto ">
                        <table id="EventApproveTable" class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                            <thead class="text-sm text-white dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3">
                                        Category
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Type
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Quantity
                                    </th>
                                </tr>
                            </thead>
                            <tbody id="tableViewBody">
                                <tr class="odd:bg-blue-100  even:bg-white  border-b " data-id="">
                                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">Laptop</td>
                                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">64gb</td>
                                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">10</td>
                                </tr>
                                <tr class="odd:bg-blue-100  even:bg-white  border-b " data-id="">
                                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">Laptop</td>
                                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">64gb</td>
                                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">10</td>
                                </tr>
                                <tr class="odd:bg-blue-100  even:bg-white  border-b " data-id="">
                                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">Laptop</td>
                                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">64gb</td>
                                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">10</td>
                                </tr>
                                <tr class="odd:bg-blue-100  even:bg-white  border-b " data-id="">
                                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">Laptop</td>
                                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">64gb</td>
                                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">10</td>
                                </tr>
                                <tr class="odd:bg-blue-100  even:bg-white  border-b " data-id="">
                                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">Laptop</td>
                                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">64gb</td>
                                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">10</td>
                                </tr>
                                <!-- Dynamic rows will be inserted here -->
                            </tbody>
                        </table>
                    </div>

                    <div class="flex justify-end space-x-4 pt-5">
                        <button id="closeViewEventPopupCard" class="bg-red-600 hover:bg-red-800 text-white py-2 px-4 rounded">Close</button>
                    </div>
                </div>
            </div>
            @endforeach

            <!-- SET ITEM  -->
            <div id="SetItemEventForApprReqPopupCard" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 hidden">
                <div class="bg-white p-4 rounded-lg shadow-lg w-full max-w-8xl h-auto overflow-auto">
                    <div class="flex justify-between items-center mb-4">
                        <h2 class="text-lg font-semibold">Set Item</h2>
                    </div>

                    <div class="grid grid-cols-2 gap-4 text-sm w-full">
                        <div>
                            <p class="mb-2"><strong>Date:</strong></p>
                            <p class="mb-2"><strong>Time:</strong></p>
                            <p class="mb-2"><strong>Requesting Office/Unit:</strong></p>
                        </div>

                        <div>
                            <p class="mb-2"><strong>Event Name:</strong></p>
                            <p class="mb-2"><strong>Event Date:</strong></p>
                            <p class="mb-2"><strong>Event Time:</strong></p>
                            <p class="mb-2"><strong>Event Location:</strong></p>
                        </div>
                    </div>

                    <div class="text-sm">
                        <p class="mb-2"><strong>Required Equipment and Supplies</strong></p>
                        <p class="mb-2"><strong>Product Name:</strong></p>
                        <p class="mb-2"><strong>Quantity:</strong></p>
                    </div>
            
                    <div class="relative shadow-md sm:rounded-lg px-9 py-5 max-h-96 overflow-y-auto">
                        <table id="SetItemTable" class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                            <thead class="text-sm text-white dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3">
                                        Inventory
                                    </th>
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
                                        Stocks
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Quantity
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        SKU
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Add
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Action
                                    </th>
                                </tr>
                            </thead>
                    
                            
                            <tbody id="tableViewBody">
                                
                                <tr class="odd:bg-blue-100  even:bg-white  border-b " data-id="">
                                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap "></td>
                                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap "></td>
                                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap "></td>
                                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap "></td>
                                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap "></td>
                                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap "></td>
                                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap "></td>
                                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap ">
                                        <input type="number" value="1" class="border-0 border-b border-gray-500 px-2 py-1 w-20 text-center">
                                    </td>
                                    <td class="px-6 py-4">
                                        <button id="editEventForApprBTN" type="button">
                                            <svg class="w-[27px] h-[27px] text-blue-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                                <path fill-rule="evenodd" d="M11.32 6.176H5c-1.105 0-2 .949-2 2.118v10.588C3 20.052 3.895 21 5 21h11c1.105 0 2-.948 2-2.118v-7.75l-3.914 4.144A2.46 2.46 0 0 1 12.81 16l-2.681.568c-1.75.37-3.292-1.263-2.942-3.115l.536-2.839c.097-.512.335-.983.684-1.352l2.914-3.086Z" clip-rule="evenodd" />
                                                <path fill-rule="evenodd" d="M19.846 4.318a2.148 2.148 0 0 0-.437-.692 2.014 2.014 0 0 0-.654-.463 1.92 1.92 0 0 0-1.544 0 2.014 2.014 0 0 0-.654.463l-.546.578 2.852 3.02.546-.579a2.14 2.14 0 0 0 .437-.692 2.244 2.244 0 0 0 0-1.635ZM17.45 8.721 14.597 5.7 9.82 10.76a.54.54 0 0 0-.137.27l-.536 2.84c-.07.37.239.696.588.622l2.682-.567a.492.492 0 0 0 .255-.145l4.778-5.06Z" clip-rule="evenodd" />
                                            </svg>
                                        </button>
                                    </td>
                                </tr>
                                
                                <!-- Dynamic rows will be inserted here -->
                            </tbody>
                        </table>
                    </div>
                    <div class="flex justify-between pt-3">
                        <div class="flex space-x-4">
                            <button id="printSetItemEventForApprReqPopupCard" class="bg-green-500 hover:bg-green-600 text-white py-2 px-4 rounded">Print</button>
                        </div>
                        <div class="flex justify-end space-x-4">
                            <button id="submitSetItemEventForApprReqPopupCard" class="bg-green-500 hover:bg-green-600 text-white py-2 px-4 rounded">Submit</button>
                            <button id="closeSetItemEventForApprReqPopupCard" class="bg-red-500 hover:bg-red-600 text-white py-2 px-4 rounded">Cancel</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Approval Popup Card -->
            @foreach ($events as $event)
            <div data-id="{{ $event->id }}" class="ApprEventPopupCard hidden fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-50 z-50">
                <div class="bg-white p-6 rounded-lg shadow-lg w-80">
                    <h2 class="text-xl font-bold mb-4 text-center">Are you sure you want to approve this request?</h2>

                    <label for="remarks" class="block mb-2">Remarks</label>
                    <textarea id="ApprEventRemarks" class="w-full p-2 rounded border border-gray-400 mb-4" rows="3" placeholder="Enter your remarks here..." style="resize: none; overflow-y: auto;"></textarea>

                    <div class="flex justify-center space-x-4">
                        <button data-id="{{ $event->id }}" class=" submitApprEventPopupCard bg-green-400 hover:bg-green-500 text-white py-2 px-4 rounded">Submit</button>
                        <button class=" closeApprEventPopupCard bg-red-400 hover:bg-red-500 text-white py-2 px-4 rounded">Cancel</button>
                    </div>
                </div>
            </div>
            @endforeach


            <!-- Decline Popup Card -->
            @foreach ($events as $event)
            <div id="DeclineEventPopupCard" class="hidden fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-50 z-50">
                <div class="bg-white p-6 rounded-lg shadow-lg w-80">

                    <h2 class="text-xl font-bold mb-4 text-center">Are you sure you want to decline this request?</h2>
                    <!-- Remarks Textarea -->
                    <label for="remarks" class="block mb-2">Remarks</label>
                    <textarea id="DeclineEventRemarks" class="w-full p-2 rounded border border-gray-400 mb-4" rows="3" placeholder="Enter your remarks here..." style="resize: none; overflow-y: auto;"></textarea>

                    <div class="flex justify-center space-x-4">
                        <button data-id="{{ $event->id }}" class="submitDeclineEventPopupCard bg-green-400 hover:bg-green-500 text-white py-2 px-4 rounded">Submit</button>
                        <button id="closeDeclineEventPopupCard" class="bg-red-400 hover:bg-red-500 text-white py-2 px-4 rounded">Cancel</button>
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