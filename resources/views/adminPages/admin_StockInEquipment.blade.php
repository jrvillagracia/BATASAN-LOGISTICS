@extends('adminLayouts.admin_sidebarLayout')

@section('title', 'Inventory Equipment | BHNHS')

@section('content')



<section>
    <div class="flex items-center pb-8">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" strokeWidth="1.5" stroke="currentColor" class="w-7 h-7">
            <path strokeLinecap="round" strokeLinejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
        </svg>
        <h1 class="text-3xl font-bold ml-2">Inventory Equipment</h1>
    </div>

    <!-- Breadcrumbs -->
    <nav class="flex px-5 py-3 text-gray-700 border border-gray-200 rounded-lg bg-gray-50 dark:bg-gray-800 dark:border-gray-700" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
            <li class="inline-flex items-center">
                <a href="{{ route('admin_equipment') }}" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600 dark:text-gray-400 dark:hover:text-white">
                    Inventory
                </a>
            </li>
            <li>
                <div class="flex items-center">
                    <svg class="rtl:rotate-180 block w-3 h-3 mx-1 text-gray-400 " aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4" />
                    </svg>
                    <a href="#" class="ms-1 text-sm font-medium text-gray-700 hover:text-blue-600 md:ms-2 dark:text-gray-400 dark:hover:text-white">Equipment</a>
                </div>
            </li>

        </ol>
    </nav>

    <!-- Add additional content here -->
    <div class="bg-gray-100 h-auto rounded-lg ">

        <div class="flex justify-between items-center mt-4 px-9 py-2">
            <!-- Left-Aligned Buttons -->
            <div>
                <a href="#" class="button border-b-2 border-blue-500 py-2 px-4 transition-all duration-300 translate-x-2">Stock In</a>
                <a href="{{ route('admin_equipment') }}" class="button border-b-2 py-2 px-4 transition-all duration-300 translate-x-2">Equipment</a>
                <a href="{{ route('admin_equipCondemned') }}" class="button border-b-2 py-2 px-4 transition-all duration-300 translate-x-2">Condemned</a>
                <a href="{{ route('admin_equipHistory')}}" class="button border-b-2 py-2 px-4 transition-all duration-300 translate-x-2">History</a>
                <a href="{{ route('admin_equipUsed')}}" class="button border-b-2 py-2 px-4 transition-all duration-300 translate-x-2">Used</a>
            </div>

            <!-- Search Bar -->
            <div class=" flex items-center space-x-4">

                <label for="equipment-search" class="mb-2 text-sm font-medium text-gray-900 w-full sr-only dark:text-white">Search</label>
                <form id="equipmentSearchForm" class="flex items-center space-x-4">
                    <div class="relative w-96">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                            <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                            </svg>
                        </div>
                        <input type="search" id="equipmentSearch" name="equipmentSearch" class="block w-full p-4 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search" />
                    </div>

                    <!-- Add Item Button -->
                    <button id="EquipFormButton" class="bg-blue-500 text-white p-2 rounded hover:bg-blue-600">Add Item</button>
            </div>
        </div>

        <!-- Floating Card with Form (Initially Hidden) -->
        <div id="EquipFormCard" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
            <div class="bg-white p-4 rounded-lg shadow-lg max-w-xl w-full">
                <h2 class="text-xl font-bold mb-4">Add New Equipment</h2>

                <form id="EquipmentForm" action=" " method="POST">
                    <!-- @csrf -->
                    <!-- Grid for Input Fields -->
                    <div class="grid grid-cols-2 gap-2">
                        <!-- First column label/input -->
                        <div>
                            <label for="EquipmentBrandName" class="block text-sm font-semibold mb-1">Brand Name</label>
                            <input type="text" name="EquipmentBrandName" id="EquipmentBrandName" class="border border-gray-400 p-2 rounded w-full mb-2" placeholder="Brand Name">
                        </div>

                        <div>
                            <label for="EquipmentName" class="block text-sm font-semibold mb-1">Equipment Name</label>
                            <input type="text" name="EquipmentName" id="EquipmentName" class="border border-gray-400 p-2 rounded w-full mb-2" placeholder="Equipment Name">
                        </div>
                        <div>
                            <label for="EquipmentCategory" class="block text-sm font-semibold mb-1">Category</label>
                            <select name="EquipmentCategory" id="EquipmentCategory" class="border border-gray-400 p-2 rounded w-full mb-2">
                                <option value="" disabled selected>Select a category</option>
                                <option value="textbook">Textbook</option>
                                <option value="office">Office Supplies</option>
                                <option value="electronics">Electronics</option>
                                <option value="other">Other</option>
                                <!-- Add more options as needed -->
                            </select>
                        </div>

                        <div id="otherEquipCategoryDiv" class="hidden">
                            <label for="otherCategory" class="block text-sm font-semibold mb-1">Other Category</label>
                            <input type="text" name="otherCategory" id="otherEquipCategory" class="border border-gray-400 p-2 rounded w-full mb-2" placeholder="Enter category">
                        </div>


                        <div>
                            <label for="EquipmentType" class="block text-sm font-semibold mb-1">Type</label>
                            <input type="text" name="EquipmentType" id="EquipmentType" class="border border-gray-400 p-2 rounded w-full mb-2" placeholder="Type" pattern="[A-Za-z ]*" title="Only characters are allowed">
                        </div>
                        <div>
                            <label for="EquipmentColor" class="block text-sm font-semibold mb-1">Color</label>
                            <input type="text" name="EquipmentColor" id="EquipmentColor" class="border border-gray-400 p-2 rounded w-full mb-2" placeholder="Color" pattern="[A-Za-z ]*" title="Only characters are allowed">
                        </div>

                        <div>
                            <label for="EquipmentUnit" class="block text-sm font-semibold mb-1">Unit</label>
                            <input type="text" name="EquipmentUnit" id="EquipmentUnit" class="border border-gray-400 p-2 rounded w-full mb-2" placeholder="Unit" pattern="[A-Za-z ]*" title="Only characters are allowed">
                        </div>
                        <div>
                            <label for="EquipmentQuantity" class="block text-sm font-semibold mb-1">Quantity</label>
                            <input type="number" name="EquipmentQuantity" id="EquipmentQuantity" min="1" class="border border-gray-400 p-2 rounded w-full mb-2" placeholder="Quantity" required>
                        </div>

                        <div>
                            <label for="EquipmentDate" class="block text-sm font-semibold mb-1">Date</label>
                            <input type="text" id="EquipmentDate" name="EquipmentDate" datepicker datepicker-format="yyyy-mm-dd" class="border border-gray-400 p-2 rounded w-full mb-4" placeholder="YYYY-MM-DD">
                        </div>
                        <div>
                            <label for="EquipmentUnitPrice" class="block text-sm font-semibold mb-1">Unit Price</label>
                            <input type="number" name="EquipmentUnitPrice" id="EquipmentUnitPrice" class="border border-gray-400 p-2 rounded w-full mb-4" placeholder="Price">
                        </div>

                        <div>
                            <label for="EquipmentClassification" class="block text-sm font-semibold mb-1">Classification</label>
                            <input type="text" name="EquipmentClassification" id="EquipmentClassification" class="border border-gray-400 p-2 rounded w-full mb-2" placeholder="Classification" pattern="[A-Za-z ]*" title="Only characters are allowed">
                        </div>

                        <div>
                            <label for="EquipmentSKU" class="block text-sm font-semibold mb-1">SKU</label>
                            <input type="text" id="EquipmentSKU" class="border border-gray-400 p-2 rounded w-full mb-2" placeholder="SKU">
                        </div>
                    </div>

                    <!-- Save and Close Buttons -->
                    <div class="flex justify-end space-x-2 mt-4">
                        <button id="EquipCloseFormButton" class="bg-red-500 hover:bg-red-600 text-white p-2 rounded">Close</button>
                        <button id="EquipmentSaveButton" type="button" data-id="equipment" class="bg-green-500 hover:bg-green-600 text-white p-2 rounded">Save</button>
                    </div>
                </form>
            </div>
        </div>
        <!-- END of Floating Card with Form -->


        <!-- MAIN Table -->
        <div class="relative shadow-md sm:rounded-lg px-9 py-5">
            <table id="dynamicTable" class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-sm text-white dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            Status
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Brand Name
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Equipment Name
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Category
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Quantity
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Total
                        </th>
                        <th scope="col" class="px-6 py-3">
                            SKU
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Classification
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Actions
                        </th>
                    </tr>
                </thead>
                <tbody id="tableBody">
                    <tr class="odd:bg-blue-100 odd:dark:bg-gray-900 even:bg-white even:dark:bg-gray-800 border-b dark:border-gray-700" data-id="" data-brand="">
                        <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white"></td>
                        <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white"></td>
                        <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white"></td>
                        <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white"></td>
                        <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white"></td>
                        <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">₱</td>
                        <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white"></td>
                        <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white"></td>
                        <td class="px-6 py-4">
                            <button id="viewEquipButton" type="button">
                                <svg class="w-[27px] h-[27px] text-green-600 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-width="2" d="M21 12c0 1.2-4.03 6-9 6s-9-4.8-9-6c0-1.2 4.03-6 9-6s9 4.8 9 6Z" />
                                    <path stroke="currentColor" stroke-width="2" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                </svg>
                            </button>
                            <button id="editEquipButton" type="button">
                                <svg class="w-[27px] h-[27px] text-blue-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                    <path fill-rule="evenodd" d="M11.32 6.176H5c-1.105 0-2 .949-2 2.118v10.588C3 20.052 3.895 21 5 21h11c1.105 0 2-.948 2-2.118v-7.75l-3.914 4.144A2.46 2.46 0 0 1 12.81 16l-2.681.568c-1.75.37-3.292-1.263-2.942-3.115l.536-2.839c.097-.512.335-.983.684-1.352l2.914-3.086Z" clip-rule="evenodd" />
                                    <path fill-rule="evenodd" d="M19.846 4.318a2.148 2.148 0 0 0-.437-.692 2.014 2.014 0 0 0-.654-.463 1.92 1.92 0 0 0-1.544 0 2.014 2.014 0 0 0-.654.463l-.546.578 2.852 3.02.546-.579a2.14 2.14 0 0 0 .437-.692 2.244 2.244 0 0 0 0-1.635ZM17.45 8.721 14.597 5.7 9.82 10.76a.54.54 0 0 0-.137.27l-.536 2.84c-.07.37.239.696.588.622l2.682-.567a.492.492 0 0 0 .255-.145l4.778-5.06Z" clip-rule="evenodd" />
                                </svg>
                            </button>
                            <button id="editStockInButton" type="button">
                                <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#000000">
                                    <path d="M200-520q-33 0-56.5-23.5T120-600v-160q0-33 23.5-56.5T200-840h560q33 0 56.5 23.5T840-760v160q0 33-23.5 56.5T760-520H200Zm0 400q-33 0-56.5-23.5T120-200v-160q0-33 23.5-56.5T200-440h560q33 0 56.5 23.5T840-360v160q0 33-23.5 56.5T760-120H200Z" />
                                </svg>
                            </button>
                        </td>
                    </tr>
                    <!-- Dynamic rows will be inserted here -->
                </tbody>
            </table>
        </div>
        <!-- END OF MAIN Table -->


        <!-- Edit 1 Popup Card -->
        <div id="editEquipModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 hidden">
            <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-md h-auto overflow-auto">
                <!-- Flex container for heading and close button -->
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-2xl font-semibold">Edit Equipment</h2>
                    <button id="closeEquipFormButton" class="text-gray-500 hover:text-gray-700">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                <form id="editForm" action="" method="POST">

                    <input type="hidden" name="brand" value="">

                    <label for="EquipmentBrandName" class="block text-sm font-semibold mb-1">Brand Name</label>
                    <input type="text" name="EquipmentBrandName" id="EquipmentBrandNameEdit" class="border border-gray-400 p-2 rounded w-full mb-2" placeholder="Brand Name">

                    <label for="EquipmentName" class="block text-sm font-semibold mb-1">Equipment Name</label>
                    <input type="text" name="EquipmentName" id="EquipmentNameEdit" class="border border-gray-400 p-2 rounded w-full mb-2" placeholder="Equipment Name">

                    <label for="EquipmentCategory" class="block text-sm font-semibold mb-1">Category</label>
                    <select name="EquipmentCategory" id="EquipmentCategoryEdit" class="border border-gray-400 p-2 rounded w-full mb-2">
                        <option value="" disabled selected>Select a category</option>
                        <option value="textbook">Textbook</option>
                        <option value="office">Office Supplies</option>
                        <option value="electronics">Electronics</option>
                        <option value="other">Other</option>
                        <!-- Add more options as needed -->
                    </select>

                    <div id="otherEquipCategoryDiv" class="hidden">
                        <label for="otherCategoryEdit" class="block text-sm font-semibold mb-1">Other Category</label>
                        <input type="text" name="otherCategoryEdit" id="otherEquipCategoryEdit" class="border border-gray-400 p-2 rounded w-full mb-2" placeholder="Enter category">
                    </div>

                    <label for="EquipmentSKU" class="block text-sm font-semibold mb-1">SKU</label>
                    <input type="text" name="EquipmentSKU" id="EquipmentSKUEdit" class="border  border-gray-400 p-2 rounded w-full mb-2" placeholder="SKU">

                    <div class="flex justify-end space-x-2">
                        <button type="button" id="saveEquipButton" class="bg-green-500 hover:bg-green-600 text-white p-2 rounded">Save</button>
                        <!-- @if(isset($item)) -->
                        <button type="button" id="deleteEquipButton" data-brand=" " class="bg-red-500 hover:bg-red-600 text-white p-2 rounded">Delete</button>
                        <!-- @else -->
                        <button type="button" id="deleteEquipButton" class="bg-red-500 hover:bg-red-600 text-white p-2 rounded" disabled>No Equipment to Delete</button>
                        <!-- @endif -->
                    </div>
                </form>
            </div>
        </div>
        <!-- END OF Edit 1 Popup Card -->


        <!-- View 1 Popup Card -->
        <div id="ViewEquipModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 hidden">
            <div class="bg-white p-4 rounded-lg shadow-lg max-w-3xl w-full max-h-[90vh] overflow-y-auto"> <!-- Updated width and height -->
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-lg font-semibold px-7">View Full Information</h2>
                    <button id="closeViewEquipFormButton" class="text-gray-500 hover:text-gray-700">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <div class="relative shadow-md sm:rounded-lg px-9 py-5">
                    <div class="grid grid-cols-2 gap-1 px-4 text-sm text-gray-700 mb-4" id="equipmentDetails">
                        <div><strong>Brand Name:</strong> Logitech</div>
                        <div><strong>Color:</strong> Black</div>
                        <div><strong>Product Name:</strong> Mouse</div>
                        <div><strong>Unit:</strong> Boxes</div>
                        <div><strong>Category:</strong> IT Department</div>
                        <div><strong>Unit Price:</strong> ₱500</div>
                        <div><strong>SKU:</strong> MOUSE0000001</div>
                        <div><strong>Classification:</strong> DO</div>
                        <div><strong>Type:</strong> TYPE</div>
                        <div><strong>Date:</strong> 11/16/2024</div>
                    </div>
                    <div class="overflow-x-auto"> <!-- Added for horizontal scrolling if needed -->
                        <table id="ViewDynamicTable" class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                            <thead class="text-sm text-white dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3">
                                        Serial Number
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Control Number
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Actions
                                    </th>
                                </tr>
                            </thead>
                            <tbody id="tableViewBody">
                                <tr class="odd:bg-blue-100 odd:dark:bg-gray-900 even:bg-white even:dark:bg-gray-800 border-b dark:border-gray-700" data-id="">
                                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">SDADSAD</td>
                                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">SADASDasd</td>
                                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        <button id="viewEquipBTN" data-id="" type="button">
                                            <svg class="w-[27px] h-[27px] text-green-600 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                                <path stroke="currentColor" stroke-width="2" d="M21 12c0 1.2-4.03 6-9 6s-9-4.8-9-6c0-1.2 4.03-6 9-6s9 4.8 9 6Z" />
                                                <path stroke="currentColor" stroke-width="2" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                            </svg>
                                        </button>
                                        <button id="editEquipBTN" data-id="" type="button">
                                            <svg class="w-[27px] h-[27px] text-blue-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
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
                </div>
            </div>
        </div>
        <!-- END OF View 1 Popup Card -->


        <!-- Edit 2 Popup Card -->
        <div id="editFullEquipModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 hidden">
            <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-md h-auto overflow-auto">
                <!-- Flex container for heading and close button -->
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-2xl font-semibold">Edit Equipment</h2>
                    <button id="closeEditFullEquipModal" class="text-gray-500 hover:text-gray-700">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                <form id="editFullEquipForm" action="" method="POST">

                    <input type="hidden" name="id" id="fullequipmentId">

                    <label for="FullEquipmentSerialNoEdit" class="block text-sm font-semibold mb-1">Serial Number</label>
                    <input type="text" name="FullEquipmentSerialNoEdit" id="FullEquipmentSerialNoEdit" class="border border-gray-400 p-2 rounded w-full mb-2" placeholder="Serial Number">

                    <label for="FullEquipmentControlNoEdit" class="block text-sm font-semibold mb-1">Control Number</label>
                    <input type="text" name="FullEquipmentControlNoEdit" id="FullEquipmentControlNoEdit" class="border border-gray-400 p-2 rounded w-full mb-2" placeholder="Control Number">

                    <label for="FullEquipmentTypeEdit" class="block text-sm font-semibold mb-1">Type</label>
                    <input type="text" name="FullEquipmentTypeEdit" id="FullEquipmentTypeEdit" class="border border-gray-400 p-2 rounded w-full mb-2" placeholder="Type" pattern="[A-Za-z ]*" title="Only characters are allowed">

                    <label for="FullEquipmentColorEdit" class="block text-sm font-semibold mb-1">Color</label>
                    <input type="text" name="FullEquipmentColorEdit" id="FullEquipmentColorEdit" class="border border-gray-400 p-2 rounded w-full mb-2" placeholder="Color" pattern="[A-Za-z ]*" title="Only characters are allowed">

                    <label for="FullEquipmentUnitEdit" class="block text-sm font-semibold mb-1">Unit</label>
                    <input type="text" name="FullEquipmentUnitEdit" id="FullEquipmentUnitEdit" class="border border-gray-400 p-2 rounded w-full mb-2" placeholder="Unit" pattern="[A-Za-z ]*" title="Only characters are allowed">

                    <label for="FullEquipmentUnitPriceEdit" class="block text-sm font-semibold mb-1">Unit Price</label>
                    <input type="number" name="FullEquipmentUnitPriceEdit" id="FullEquipmentUnitPriceEdit" class="border border-gray-400 p-2 rounded w-full mb-4" placeholder="Price">

                    <label for="FullEquipmentClassificationEditn" class="block text-sm font-semibold mb-1">Classification</label>
                    <input type="text" name="FullEquipmentClassificationEdit" id="FullEquipmentClassificationEdit" class="border border-gray-400 p-2 rounded w-full mb-2" placeholder="Classification" pattern="[A-Za-z ]*" title="Only characters are allowed">

                    <label for="FullEquipmentDateEdit" class="block text-sm font-semibold mb-1">Date</label>
                    <input type="text" id="FullEquipmentDateEdit" name="FullEquipmentDateEdit" datepicker datepicker-format="yyyy-mm-dd" class="border border-gray-400 p-2 rounded w-full mb-4" placeholder="YYYY-MM-DD">


                    <div class="flex justify-end space-x-2">
                        <button type="button" id="saveFullEquipButton" class="bg-green-500 hover:bg-green-600 text-white p-2 rounded">Save</button>
                        <button type="button" id="condFullEquipButton" class="bg-yellow-500 hover:bg-yellow-600 text-white p-2 rounded">Condemn</button>
                        <button type="button" id="deleteFullEquipButton" class="bg-red-500 hover:bg-red-600 text-white p-2 rounded">Delete</button>
                    </div>
                </form>
            </div>
        </div>
        <!-- END OF Edit 2 Popup Card -->


        <!-- Add Pop Up Card -->
        <div id="AddEquipFormCard" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 hidden">
            <div class="bg-white p-4 rounded-lg shadow-lg max-w-xl w-full">
                <h2 class="text-xl font-bold mb-4">Add Equipment</h2>
                <form id="EquipmentForm" action="" method="POST">
                    <!-- Grid for Input Fields -->
                    <div class="grid grid-cols-2 gap-2">
                        <!-- First column label/input -->
                        <div>
                            <label for="EquipmentControlNo" class="block text-sm font-semibold mb-1">Control Number</label>
                            <input type="text" name="EquipmentControlNo" id="AddEquipmentControlNo" class="border border-gray-400 p-2 rounded w-full mb-2" placeholder="Control Number">
                        </div>

                        <div>
                            <label for="EquipmentType" class="block text-sm font-semibold mb-1">Type</label>
                            <input type="text" name="EquipmentType" id="AddEquipmentType" class="border border-gray-400 p-2 rounded w-full mb-2" placeholder="Type" pattern="[A-Za-z ]*" title="Only characters are allowed">
                        </div>
                        <div>
                            <label for="EquipmentColor" class="block text-sm font-semibold mb-1">Color</label>
                            <input type="text" name="EquipmentColor" id="AddEquipmentColor" class="border border-gray-400 p-2 rounded w-full mb-2" placeholder="Color" pattern="[A-Za-z ]*" title="Only characters are allowed">
                        </div>

                        <div>
                            <label for="EquipmentUnit" class="block text-sm font-semibold mb-1">Unit</label>
                            <input type="text" name="EquipmentUnit" id="AddEquipmentUnit" class="border border-gray-400 p-2 rounded w-full mb-2" placeholder="Unit" pattern="[A-Za-z ]*" title="Only characters are allowed">
                        </div>
                        <div>
                            <label for="EquipmentQuantity" class="block text-sm font-semibold mb-1">Quantity</label>
                            <input type="number" name="EquipmentQuantity" id="AddEquipmentQuantity" class="border border-gray-400 p-2 rounded w-full mb-2" placeholder="Quantity">
                        </div>

                        <div>
                            <label for="EquipmentDate" class="block text-sm font-semibold mb-1">Date</label>
                            <input type="text" id="AddEquipmentDate" name="EquipmentDate" datepicker datepicker-format="yyyy-mm-dd" class="border border-gray-400 p-2 rounded w-full mb-4" placeholder="YYYY-MM-DD">
                        </div>
                        <div>
                            <label for="EquipmentUnitPrice" class="block text-sm font-semibold mb-1">Unit Price</label>
                            <input type="number" name="EquipmentUnitPrice" id="AddEquipmentUnitPrice" class="border border-gray-400 p-2 rounded w-full mb-4" placeholder="Price">
                        </div>

                        <div>
                            <label for="EquipmentClassification" class="block text-sm font-semibold mb-1">Classification</label>
                            <input type="text" name="EquipmentClassification" id="AddEquipmentClassification" class="border border-gray-400 p-2 rounded w-full mb-2" placeholder="Classification" pattern="[A-Za-z ]*" title="Only characters are allowed">
                        </div>

                        <div>
                            <label for="EquipmentSerialNo" class="block text-sm font-semibold mb-1">Serial Number</label>
                            <input type="text" name="EquipmentSerialNo" id="AddEquipmentSerialNo" class="border border-gray-400 p-2 rounded w-full mb-2" placeholder="Serial Number">
                        </div>
                    </div>

                    <!-- Save and Close Buttons -->
                    <div class="flex justify-end space-x-2 mt-4">
                        <button id="AddEquipCloseFormButton" class="bg-red-500 hover:bg-red-600 text-white p-2 rounded">Close</button>
                        <button id="AddEquipSaveFormButton" type="button" data-id="equipment" class="bg-green-500 hover:bg-green-600 text-white p-2 rounded">Save</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- END OF Add Pop Up Card -->

        <!-- View 2 Table Pop Up Card -->

        <div id="ViewFullEquipModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 hidden">
            <div class="bg-white p-4 rounded-lg shadow-lg max-w-md w-full">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-lg font-semibold">Final Viewing</h2>
                    <button id="closeViewFullEquipModal" class="text-gray-500 hover:text-gray-700">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                <div class="text-sm text-gray-700 mb-4" id=equipmentDetails>
                    <p><strong>Serial Number:</strong></p>
                    <p><strong>Control Number:</strong></p>
                    <p><strong>Brand Name:</strong></p>
                    <p><strong>Product Name:</strong></p>
                    <p><strong>Category:</strong></p>
                    <p><strong>Type:</strong></p>
                    <p><strong>Color:</strong></p>
                    <p><strong>Unit:</strong></p>
                    <p><strong>Unit Price:</strong>₱</p>
                    <p><strong>Classification:</strong></p>
                    <p><strong>Date:</strong></p>
                </div>

            </div>
        </div>
        <!-- END OF View 2 Table Pop Up Card -->
    </div>
</section>
@endsection