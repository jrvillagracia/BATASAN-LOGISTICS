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
                <a href="{{route('admin_REQapprovalEquipment')}}" class="button border-b-2 border-blue-500 py-2 px-4 transition-all duration-300 translate-x-2">For Approval</a>
                <a href="{{route('admin_REQreleaseEquipment')}}" class="button border-b-2 py-2 px-4 transition-all duration-300 translate-x-2">For Release</a>
                <a href="{{route('admin_REQrqstEquipment')}}" class="button border-b-2 py-2 px-4 transition-all duration-300 translate-x-2">Completed Request</a>
            </div>

            <!-- Search Bar -->
            <div class=" flex items-center space-x-4">
                <!-- Add Item Button -->
                <button id="ReqEquipFormBtn" class="bg-blue-500 text-white p-2 rounded hover:bg-blue-600">&plus; Add Request</button>
            </div>
        </div>

        <!-- Floating Card with Form (Initially Hidden) -->
        <div id="ReqEquipFormCard" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
            <div class="bg-white p-4 rounded-lg shadow-lg max-w-md w-full">

                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-xl font-bold mb-4">Add Request Equipment</h2>
                    <button id="ReqEquipCloseFormBtn" class="text-gray-500 hover:text-gray-700">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <form id="ReqEquipForm">
                    <div class="mb-4">
                        <label for="name" class="block text-sm font-semibold mb-2">Name:</label>
                        <input type="text" id="name" class="w-full px-2 py-1 border border-gray-400 rounded">
                    </div>

                    <div class="mb-4">
                        <label for="department" class="block text-sm font-semibold mb-2">Department:</label>
                        <select id="EquipmentDepartment" class="w-full px-2 py-1 border border-gray-400 rounded">
                            <option value="">Select Department</option>
                            <option value="hr">HR</option>
                            <option value="it">IT</option>
                            <option value="sales">Sales</option>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label for="ReqEquipDate" class="block text-sm font-semibold mb-2">Date:</label>
                        <input type="text" id="ReqEquipDate" name="EquipmentDate" datepicker datepicker-format="yyyy-mm-dd" class="border  border-gray-400 p-2 rounded w-full mb-4" placeholder="YYYY-MM-DD">
                    </div>

                    <div class="mb-4">
                        <label for="ReqEquipReason" class="block text-sm font-semibold mb-2">Reason:</label>
                        <input type="text" id="ReqEquipReason" class="w-full px-2 py-1 border border-gray-400 rounded">
                    </div>

                    <div class="mb-4">
                        <label for="ReqEquipRemarks" class="block text-sm font-semibold mb-2">Remarks:</label>
                        <textarea id="ReqEquipRemarks" class="w-full px-2 py-1 border border-gray-400 rounded h-20"></textarea>
                    </div>

                    <div class="flex justify-end space-x-2">
                        <button id="ReqEquipCancelFormBtn" type="button" class="bg-red-500 hover:bg-red-600 text-white py-2 px-4 rounded">Cancel</button>
                        <button id="ReqEquipSubmitFormBtn" type="button" class="bg-green-500 hover:bg-green-600 text-white py-2 px-4 rounded">Submit</button>
                    </div>
                </form>
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
                            Name
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Department
                        </th>
                        <th scope="col" class="px-6 py-30">
                            Date
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Actions
                        </th>
                    </tr>
                </thead>
                <tbody id="tableBody" class="">

                    <tr class="odd:bg-blue-100 odd:dark:bg-gray-900 even:bg-white even:dark:bg-gray-800 border-b dark:border-gray-700" data-index="" data-id="">
                        <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white"></td>
                        <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">VicThor</td>
                        <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">Faculty Teacher</td>
                        <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">2024-08-23</td>
                        <td class="px-6 py-4">
                            <button id="ViewEquipBtn" type="button">
                                <svg class="w-[27px] h-[27px] text-green-600 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-width="2" d="M21 12c0 1.2-4.03 6-9 6s-9-4.8-9-6c0-1.2 4.03-6 9-6s9 4.8 9 6Z" />
                                    <path stroke="currentColor" stroke-width="2" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                </svg>
                            </button>
                            <button id="ApprEquipBtn" type="button">
                                <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#0000FF">
                                    <path d="M382-240 154-468l57-57 171 171 367-367 57 57-424 424Z" />
                                </svg>
                            </button>
                            <button id="DclnEquipBtn" type="button">
                                <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#D1191A">
                                    <path d="M200-440v-80h560v80H200Z" />
                                </svg>
                            </button>
                        </td>
                    </tr>

                    <!-- Dynamic rows will be inserted here -->
                </tbody>
            </table>

            <!-- View Popup Card -->
            <div id="ViewEquipPopupCard" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
                <div class="bg-white p-4 rounded-lg shadow-lg max-w-md w-full">
                    <div class="flex justify-between items-center mb-4">
                        <h2 class="text-lg font-semibold">View Request</h2>
                        <button id="closeViewEquipPopupCard" class="text-gray-500 hover:text-gray-700">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>

                    <div class="text-sm">
                        <p class="mb-2"><strong>Name:</strong> Rey</p>
                        <p class="mb-2"><strong>Position:</strong> Faculty Teacher</p>
                        <p class="mb-2"><strong>Date:</strong> 2024-08/23</p>
                        <p class="mb-2"><strong>Product Name:</strong> Chalk Box</p>
                        <p class="mb-2"><strong>Category:</strong> Classroom Supply</p>
                        <p class="mb-2"><strong>Quantity:</strong> 1</p>
                        <p class="mb-2"><strong>Reason:</strong> For Teaching Use</p>
                        <div class="mb-4">
                            <label for="Remarks" class="block text-sm font-semibold mb-2">Remarks:</label>
                            <textarea id="Remarks" class="w-full px-2 py-1 border border-gray-400 rounded h-20">For teaching .. etc</textarea>
                        </div>
                    </div>
                </div>
            </div>



            <!-- Approval Popup Card -->
            <div id="ApprEquipPopupCard" class="hidden fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-50 z-50">
                <div class="bg-white p-6 rounded-lg shadow-lg w-80">
                    <h2 class="text-xl font-bold mb-4 text-center">Are you Sure?</h2>
                    <p class="mb-4 text-center">Product name: Chalk Box</p>
                    <p class="mb-4 text-center">Available Stock(s): 20</p>
                    <div class="flex justify-center space-x-4">
                        <button id="submitApprEquipPopupCard" class="bg-green-400 hover:bg-green-500 text-white py-2 px-4 rounded">Submit</button>
                        <button id="closeApprEquipPopupCard" class="bg-red-400 hover:bg-red-500 text-white py-2 px-4 rounded">Cancel</button>
                    </div>
                </div>
            </div>

            <!-- Decline Popup Card -->
            <div id="DclnEquipPopupCard" class="hidden fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-50 z-50">
                <div class="bg-white p-6 rounded-lg shadow-lg w-80">

                    <!-- Reason Dropdown -->
                    <label for="reason" class="block mb-2">Reason</label>
                    <select id="reason" class="mb-4 w-full p-2 rounded border border-gray-400">
                        <option value="no-supply">No Supply</option>
                        <option value="wrong-order">Wrong Order</option>
                        <option value="damaged">Damaged Product</option>
                    </select>

                    <!-- Remarks Textarea -->
                    <label for="remarks" class="block mb-2">Remarks</label>
                    <textarea id="remarks" class="w-full p-2 rounded border border-gray-400 mb-4" rows="3" placeholder="Enter your remarks here..."></textarea>

                    <div class="flex justify-center space-x-4">
                        <button id="submitDclnEquipPopupCard" class="bg-green-400 hover:bg-green-500 text-white py-2 px-4 rounded">Submit</button>
                        <button id="closeDclnEquipPopupCard" class="bg-red-400 hover:bg-red-500 text-white py-2 px-4 rounded">Cancel</button>
                    </div>
                </div>
            </div>


            <!-- Pagination -->
        </div>
    </div>

</section>
@endsection