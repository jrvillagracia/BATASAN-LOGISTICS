@extends('adminLayouts.admin_sidebarLayout')

@section('title', 'Facility Instructional Room | BHNHS')

@section('content')


<section>
    <div class="flex items-center pb-8">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" strokeWidth="1.5" stroke="currentColor" class="w-9 h-9">
            <path strokeLinecap="round" strokeLinejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
        </svg>
        <h1 class="text-3xl font-bold ml-2">Instructional Facility</h1>
    </div>

    <!-- Breadcrumb -->
    <nav class="flex px-5 py-3 text-gray-700 border border-gray-200 rounded-lg bg-gray-50 dark:bg-gray-800 dark:border-gray-700" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
            <li class="inline-flex items-center">
                <a href="#" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600 dark:text-gray-400 dark:hover:text-white">
                    Facility
                </a>
            </li>
            <li>
                <div class="flex items-center">
                    <svg class="rtl:rotate-180 block w-3 h-3 mx-1 text-gray-400 " aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4" />
                    </svg>
                    <a href="#" class="ms-1 text-sm font-medium text-gray-700 hover:text-blue-600 md:ms-2 dark:text-gray-400 dark:hover:text-white">Instructional Rooms</a>
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
                <a href="#" class="button border-b-2 border-blue-500  py-2 px-4 transition-all duration-300 translate-x-2">Instructional Room Facility</a>
                <a href="#" class="button border-b-2 py-2 px-4 transition-all duration-300 translate-x-2">History</a>
            </div>

            <div class=" flex items-center space-x-4">


                <!-- Search Bar -->
                <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 w-full sr-only dark:text-white">Search</label>
                <div class="relative w-96">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                        </svg>
                    </div>
                    <input type="search" id="RegSearch" class="block w-full p-4 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search" required />

                </div>

                <!-- Add Item Button -->
                <button id="RegRoomFormBtn" class="bg-blue-500 text-white p-2 rounded hover:bg-blue-600">&plus; Add Facility</button>
                <button id="RegRoomExportBtn" class="bg-green-500 text-white p-2 rounded hover:bg-green-600">Export File</button>
                <button id="RegRoomSelectAllBtn" class="bg-blue-500 text-white p-2 rounded hover:bg-blue-600">Select all</button>

            </div>
        </div>

        <!-- Floating Card with Form (Initially Hidden) -->
        <div id="RegFormCard" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
            <div class="bg-white p-4 rounded-lg shadow-lg max-w-md w-full">

                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-xl font-bold mb-4">Add Instructional Facility</h2>
                    <button id="RegCloseFormBtn" class="text-gray-500 hover:text-gray-700">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <form id="RegForm" action="{{route ('room.store') }}" method="POST">
                    @csrf
                    <!-- Input Fields -->

                    <input type="hidden" id="facilityRoomType" value="Instructional">

                    <div class="mb-4">
                        <label for="datepicker-format" class="block text-sm font-semibold mb-2">Date:</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                                </svg>
                            </div>
                            <input id="RegRoomDate" name="facilityRoomDate" datepicker datepicker-buttons datepicker-autoselect-today type="text" readonly datepicker datepicker-min-date="06/04/2024" datepicker-max-date="05/05/2025" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Select date">
                        </div>
                    </div>

                    <div class="mb-4">
                        <label for="name" class="block text-sm font-semibold mb-2">Building Name</label>
                        <input type="text" id="RegBldName" name="buildingName" class="w-full px-2 py-1 border border-gray-400 rounded" placeholder="Building Name">
                    </div>

                    <div class="mb-4">
                        <label for="room" class="block text-sm font-semibold mb-2">Room</label>
                        <input type="text" id="RegRoom" name="room" class="w-full px-2 py-1 border border-gray-400 rounded" placeholder="Room">
                    </div>

                    <div class="mb-4">
                        <label for="RegCapacity" class="block text-sm font-semibold mb-2">Capacity</label>
                        <input type="number" id="RegCapacity" name="capacity" class="w-full px-2 py-1 border border-gray-400 rounded" placeholder="Capacity">
                    </div>



                    <div class="flex justify-end space-x-2">
                        <button id="RegCancelFormBtn" type="button" class="bg-red-500 hover:bg-red-600 text-white py-2 px-4 rounded">Cancel</button>
                        <button id="RegSubFormBtn" type="button" class="bg-green-500 hover:bg-green-600 text-white py-2 px-4 rounded">Submit</button>
                    </div>
                </form>
            </div>
        </div>


        <!-- Table -->
        <div class="relative shadow-md sm:rounded-lg px-9 py-5">
            <table id="RegFacTable" class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-sm text-white dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            Building Name
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Room
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Status
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Capacity
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Shift Type
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Assigned
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Action
                        </th>
                        <th scope="col" class="px-6 py-3">
                        </th>
                    </tr>
                </thead>
                <tbody id="tableBody">
                    @foreach($combinedRooms as $room)
                        <tr class="odd:bg-blue-100 odd:dark:bg-gray-900 even:bg-white even:dark:bg-gray-800 border-b dark:border-gray-700" data-index="{{$loop->index}}" data-id="{{$room['roomId']}}">
                        <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $room['facilityRoom']['BldName']}}</td>
                        <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $room['facilityRoom']['Room'] }}</td>
                        <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $room['facilityRoom']['facilityStatus'] }}</td>
                        <td clas="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $room['currentEnrollment'] . '/' . $room['facilityRoom']['Capacity'] }}</td>
                        <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">{{$room['session']}}</td>
                        <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">{{$room['gradeLevel'] . ' - ' . $room['sectionName']}}</td>
                        <td class="px-6 py-4">
                            <button class="viewINSTpButton" data-id="{{$room['roomId']}}" data-index="{{$loop->index}}" type="button">
                                <svg class="w-[27px] h-[27px] text-green-600 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-width="2" d="M21 12c0 1.2-4.03 6-9 6s-9-4.8-9-6c0-1.2 4.03-6 9-6s9 4.8 9 6Z" />
                                    <path stroke="currentColor" stroke-width="2" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                </svg>
                            </button>
                            
                            <button class="editINSTButton" data-id="{{$room['roomId']}}" type="button">
                                <svg class="w-[27px] h-[27px] text-blue-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                    <path fill-rule="evenodd" d="M11.32 6.176H5c-1.105 0-2 .949-2 2.118v10.588C3 20.052 3.895 21 5 21h11c1.105 0 2-.948 2-2.118v-7.75l-3.914 4.144A2.46 2.46 0 0 1 12.81 16l-2.681.568c-1.75.37-3.292-1.263-2.942-3.115l.536-2.839c.097-.512.335-.983.684-1.352l2.914-3.086Z" clip-rule="evenodd" />
                                    <path fill-rule="evenodd" d="M19.846 4.318a2.148 2.148 0 0 0-.437-.692 2.014 2.014 0 0 0-.654-.463 1.92 1.92 0 0 0-1.544 0 2.014 2.014 0 0 0-.654.463l-.546.578 2.852 3.02.546-.579a2.14 2.14 0 0 0 .437-.692 2.244 2.244 0 0 0 0-1.635ZM17.45 8.721 14.597 5.7 9.82 10.76a.54.54 0 0 0-.137.27l-.536 2.84c-.07.37.239.696.588.622l2.682-.567a.492.492 0 0 0 .255-.145l4.778-5.06Z" clip-rule="evenodd" />
                                </svg>
                            </button>

                        <td scope="col" class="px-6 py-4">
                            <div class="flex items-center">
                                <input id="RegRoomCheckBox" type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                <label for="checkbox-all-search" class="sr-only">checkbox</label>
                            </div>
                        </td>
                        </td>
                    </tr>
                    @endforeach
                    <!-- Dynamic rows will be inserted here -->
                </tbody>
            </table>

            <!-- View Popup Card -->
            @foreach($combinedRooms as $room)
            <div id="ViewINSTPopupCard-{{ $loop->index }}" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
                <div class="bg-white p-4 rounded-lg shadow-lg max-w-md w-full max-h-[80vh] overflow-y-auto">
                    <div class="flex justify-between items-center mb-4">
                        <h2 class="text-lg font-semibold">Room/Facility Information</h2>
                        <button data-id="{{ $loop->index }}" class=" closeViewINSTPopupCard text-gray-500 hover:text-gray-700">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>

                    <div class="text-sm" id="showDetailsRooms">
                        <p class="mb-2"><strong>Status:</strong>{{ $room['facilityRoom']['facilityStatus']}}</p>
                        <p class="mb-2"><strong>Building Name:</strong>{{ $room['facilityRoom']['BldName']}}</p>
                        <p class="mb-2"><strong>Room:</strong>{{ $room['facilityRoom']['Room']}}</p>
                        <p class="mb-2"><strong>Capacity:</strong>{{ $room['currentEnrollment'] . '/' . $room['facilityRoom']['Capacity'] }}</p>
                        <p class="mb-2"><strong>Shift Type:</strong>{{$room['session']}}</p>
                        <p class="mb-2"><strong>Facility Type:</strong>Instructional</p>
                        <p class="mb-2"><strong>Assigned Date:</strong>{{ $room ['assignedDate'] }}</p>
                        <p class="mb-2"><strong>Assigned:</strong>{{$room['gradeLevel'] . ' - ' . $room['sectionName']}}</p>
                        <div class="pt-4">
                            <h2 class="text-lg font-semibold">Inventory in the Room</h2>
                        </div>
                        <p class="mb-2"><strong>Supplies:</strong></p>
                        <p class="ml-5">Chalk</p>
                        <p class="mb-2"><strong>Equipment:</strong></p>
                        <p class="ml-5">Chair: 45</p>
                        <p class="ml-5">TV: 1</p>
                    </div>
                </div>
            </div>
            @endforeach

            <!-- Edit Popup Card -->
            <div id="RegEditFormCard" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
                <div class="bg-white p-4 rounded-lg shadow-lg max-w-md w-full">

                    <div class="flex justify-between items-center mb-4">
                        <h2 class="text-xl font-bold mb-4">Edit Facility</h2>
                        <button id="RegEditCloseFormBtn" class="text-gray-500 hover:text-gray-700">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                    
                    @foreach($combinedRooms as $room)
                    <form id="RegEditForm" action="" method="">
                        @csrf
                        <!-- Input Fields -->
                        <!-- <div class="mb-4">
                            <label for="datepicker-format" class="block text-sm font-semibold mb-2">Date:</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                                    </svg>
                                </div>
                                <input id="RegEditDate" datepicker datepicker-buttons datepicker-autoselect-today type="text" readonly datepicker datepicker-min-date="06/04/2024" datepicker-max-date="05/05/2025" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Select date">
                            </div>
                        </div> -->

                        <input type="hidden" name="id" id="RegEditRoomId" value="">


                        <div class="mb-4">
                            <label for="name" class="block text-sm font-semibold mb-2">Building Name</label>
                            <input type="text" id="RegEditBldName" name="buildingName" class="w-full px-2 py-1 border border-gray-400 rounded" placeholder="Building Name">
                        </div>

                        <div class="mb-4">
                            <label for="room" class="block text-sm font-semibold mb-2">Room</label>
                            <input type="text" id="RegEditRoom" name="room" class="w-full px-2 py-1 border border-gray-400 rounded" placeholder="Room">
                        </div>

                        <div class="mb-4">
                            <label for="RegCapacity" class="block text-sm font-semibold mb-2">Capacity</label>
                            <input type="number" id="RegEditCapacity" name="capacity" class="w-full px-2 py-1 border border-gray-400 rounded" placeholder="Capacity">
                        </div>

                        <div class="flex justify-end space-x-2">
                            <button id="RegEditCancelFormBtn" type="button" class="bg-red-500 hover:bg-red-600 text-white py-2 px-4 rounded">Cancel</button>
                            <button type="button" data-id="{{$room['roomId']}}" class=" RegEditSaveFormBtn bg-green-500 hover:bg-green-600 text-white py-2 px-4 rounded">Save</button>
                        </div>
                    </form>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

</section>
@endsection