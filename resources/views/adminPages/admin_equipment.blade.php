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
                <a href="{{route('admin_EQUIPMENT')}}" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600 dark:text-gray-400 dark:hover:text-white">
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
                <a href="{{route('admin_StockInEquipment')}}" class="button border-b-2 py-2 px-4 transition-all duration-300 translate-x-2">Stock In</a>
                <a href="{{route('admin_EQUIPMENT')}}" class="button border-b-2 border-blue-500 py-2 px-4 transition-all duration-300 translate-x-2">Equipment</a>
                <a href="{{ route('admin_equipCondemned') }}" class="button border-b-2 py-2 px-4 transition-all duration-300 translate-x-2">Condemned</a>
                <a href="{{ route('admin_equipHistory')}}" class="button border-b-2 py-2 px-4 transition-all duration-300 translate-x-2">History</a>
                <a href="{{ route('admin_equipUsed')}}" class="button border-b-2 py-2 px-4 transition-all duration-300 translate-x-2">Used</a>
            </div>

            <!-- Search Bar -->
            <div class=" flex items-center space-x-4">

                <label for="equip-search" class="mb-2 text-sm font-medium text-gray-900 w-full sr-only dark:text-white">Search</label>
                <form id="equipSearchForm" class="flex items-center space-x-4">
                    <div class="relative w-96">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                            <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                            </svg>
                        </div>
                        <input type="search" id="equipSearch" name="equipSearch" class="block w-full p-4 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search" />
                    </div>

                    <!-- Add Item Button -->
                    <button id="EquipExportBTN" class="bg-blue-500 text-white p-2 rounded hover:bg-blue-600">Export</button>
                    <button id="EquipSelectAllBTN" class="bg-blue-500 text-white p-2 rounded hover:bg-blue-600">Select All</button>
            </div>
        </div>

        <!-- Floating Card with Form (Initially Hidden) -->

        <!-- END of Floating Card with Form -->


        <!-- MAIN Table -->
        <div class="relative shadow-md sm:rounded-lg px-9 py-5">
            <table id="dynamicTable" class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-sm text-white dark:text-gray-400">
                    <tr>
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
                            Actions
                        </th>
                        <th scope="col" class="px-6 py-3">
                        </th>
                    </tr>
                </thead>
                <tbody id="tableBody">
                    <tr class="odd:bg-blue-100 odd:dark:bg-gray-900 even:bg-white even:dark:bg-gray-800 border-b dark:border-gray-700" data-id="" data-brand="">
                        <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white"></td>
                        <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white"></td>
                        <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white"></td>
                        <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white"></td>
                        <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">₱</td>
                        <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white"></td>
                        <td class="px-6 py-4">
                            <button id="viewEquipmentBTN" type="button">
                                <svg class="w-[27px] h-[27px] text-green-600 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-width="2" d="M21 12c0 1.2-4.03 6-9 6s-9-4.8-9-6c0-1.2 4.03-6 9-6s9 4.8 9 6Z" />
                                    <path stroke="currentColor" stroke-width="2" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                </svg>
                            </button>
                            <button id="editEquipmentBTN" type="button">
                                <svg class="w-[27px] h-[27px] text-blue-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                    <path fill-rule="evenodd" d="M11.32 6.176H5c-1.105 0-2 .949-2 2.118v10.588C3 20.052 3.895 21 5 21h11c1.105 0 2-.948 2-2.118v-7.75l-3.914 4.144A2.46 2.46 0 0 1 12.81 16l-2.681.568c-1.75.37-3.292-1.263-2.942-3.115l.536-2.839c.097-.512.335-.983.684-1.352l2.914-3.086Z" clip-rule="evenodd" />
                                    <path fill-rule="evenodd" d="M19.846 4.318a2.148 2.148 0 0 0-.437-.692 2.014 2.014 0 0 0-.654-.463 1.92 1.92 0 0 0-1.544 0 2.014 2.014 0 0 0-.654.463l-.546.578 2.852 3.02.546-.579a2.14 2.14 0 0 0 .437-.692 2.244 2.244 0 0 0 0-1.635ZM17.45 8.721 14.597 5.7 9.82 10.76a.54.54 0 0 0-.137.27l-.536 2.84c-.07.37.239.696.588.622l2.682-.567a.492.492 0 0 0 .255-.145l4.778-5.06Z" clip-rule="evenodd" />
                                </svg>
                            </button>
                        </td>
                        <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            <input id="EQUIPMENTCheckBox" type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                        </td>
                    </tr>
                    <!-- Dynamic rows will be inserted here -->
                </tbody>
            </table>
        </div>
        <!-- END OF MAIN Table -->


        <!-- Edit 1 Popup Card -->
        <div id="editEQUIPMENTMdl" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 hidden">
            <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-xl  overflow-y-auto">
                <!-- Flex container for heading and close button -->
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-2xl font-semibold">Edit Equipment</h2>
                    <button id="closeEQUIPMENTFormBTN" class="text-gray-500 hover:text-gray-700">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                <form id="editForm" action="" method="">

                    <div class="grid grid-cols-2 gap-2">

                        <input type="hidden" name="brand" value="">

                        <div>
                            <label for="EQUIPMENTBrandNameEDT" class="block text-sm font-semibold mb-1">Brand Name</label>
                            <input type="text" name="EQUIPMENTBrandNameEDT" id="EQUIPMENTBrandNameEDT" class="border border-gray-400 p-2 rounded w-full mb-2" placeholder="Brand Name">
                        </div>

                        <div>
                            <label for="EQUIPMENTNameEDT" class="block text-sm font-semibold mb-1">Equipment Name</label>
                            <input type="text" name="EQUIPMENTNameEDT" id="EQUIPMENTNameEDT" class="border border-gray-400 p-2 rounded w-full mb-2" placeholder="Equipment Name">
                        </div>

                        <div>
                            <label for="EQUIPMENTCategoryEDT" class="block text-sm font-semibold mb-1">Category</label>
                            <select name="EQUIPMENTCategoryEDT" id="EQUIPMENTCategoryEDT" class="border border-gray-400 p-2 rounded w-full mb-2">
                                <option value="default" disabled selected>Select a category</option>
                                <option value="textbook">Textbook</option>
                                <option value="office">Office Supplies</option>
                                <option value="electronics">Electronics</option>
                                <option value="other">Other</option>
                                <!-- Add more options as needed -->
                            </select>
                        </div>

                        <div id="otherEquipCategoryDiv" class="hidden">
                            <label for="otherEQUIPMENTCategoryEDT" class="block text-sm font-semibold mb-1">Other Category</label>
                            <input type="text" name="otherEQUIPMENTCategoryEDT" id="otherEQUIPMENTCategoryEDT" class="border border-gray-400 p-2 rounded w-full mb-2" placeholder="Enter category">
                        </div>

                        <div>
                            <label for="EQUIPMENTQuantityEDT" class="block text-sm font-semibold mb-1">Quantity</label>
                            <input type="number" name="EQUIPMENTQuantityEDT" id="EQUIPMENTQuantityEDT" min="1" class="border border-gray-400 p-2 rounded w-full mb-2" placeholder="Quantity" required>
                        </div>

                        <div>
                            <label for="EQUIPMENTSKUEDT" class="block text-sm font-semibold mb-1">SKU</label>
                            <input type="text" id="EQUIPMENTSKUEDT" class="border border-gray-400 p-2 rounded w-full mb-2" placeholder="SKU">
                        </div>


                        <div>
                            <label for="EQUIPMENTColorEDT" class="block text-sm font-semibold mb-1">Color</label>
                            <input type="text" name="EQUIPMENTColorEDT" id="EQUIPMENTColorEDT" class="border border-gray-400 p-2 rounded w-full mb-2" placeholder="Color" pattern="[A-Za-z ]*" title="Only characters are allowed">
                        </div>

                        <div>
                            <label for="EQUIPMENTTypeEDT" class="block text-sm font-semibold mb-1">Type</label>
                            <input type="text" name="EQUIPMENTTypeEDT" id="EQUIPMENTTypeEDT" class="border border-gray-400 p-2 rounded w-full mb-2" placeholder="Type" pattern="[A-Za-z ]*" title="Only characters are allowed">
                        </div>

                        <div>
                            <label for="EQUIPMENTUnitEDT" class="block text-sm font-semibold mb-1">Unit</label>
                            <input type="text" name="EQUIPMENTUnitEDT" id="EQUIPMENTUnitEDT" class="border border-gray-400 p-2 rounded w-full mb-2" placeholder="Unit" pattern="[A-Za-z ]*" title="Only characters are allowed">
                        </div>

                        <div>
                            <label for="EQUIPMENTUnitPriceEDT" class="block text-sm font-semibold mb-1">Unit Price</label>
                            <input type="number" name="EQUIPMENTUnitPriceEDT" id="EQUIPMENTUnitPriceEDT" class="border border-gray-400 p-2 rounded w-full mb-4" placeholder="Price">
                        </div>

                        <div>
                            <label for="EQUIPMENTClassificationEDT" class="block text-sm font-semibold mb-1">Classification</label>
                            <input type="text" name="EQUIPMENTClassificationEDT" id="EQUIPMENTClassificationEDT" class="border border-gray-400 p-2 rounded w-full mb-2" placeholder="Classification" pattern="[A-Za-z ]*" title="Only characters are allowed">
                        </div>
                    </div>

                    <div class="mt-4">
                        <label class="flex items-center space-x-2">
                            <input type="checkbox" id="lowStockAlert" name="lowStockAlert" class="rounded text-blue-500 focus:ring-blue-500">
                            <span class="text-sm font-semibold">Low stock alert</span>
                        </label>
                        <div id="lowStockThresholdDiv" class="mt-2 hidden">
                            <label for="lowStockThreshold" class="block text-sm font-semibold mb-1">Low stock threshold</label>
                            <input type="number" id="lowStockThreshold" name="lowStockThreshold" class="border border-gray-400 p-2 rounded w-64" placeholder="Enter threshold">
                        </div>
                    </div>

                    <div class="flex justify-end space-x-2">
                        <button type="button" id="saveEQUIPBTN" class="bg-green-500 hover:bg-green-600 text-white p-2 rounded">Save</button>
                        <!-- @if(isset($item)) -->
                        <button type="button" id="deleteEQUIPBTN" data-brand="{{$item->EquipmentBrandName}}" class="bg-red-500 hover:bg-red-600 text-white p-2 rounded">Delete</button>
                        <!-- @else -->
                        <button type="button" id="deleteEQUIPBTN" class="bg-red-500 hover:bg-red-600 text-white p-2 rounded" disabled>No Equipment to Delete</button>
                        <!-- @endif -->
                    </div>
                </form>
            </div>
        </div>
        <!-- END OF Edit 1 Popup Card -->


        <!-- View 1 Popup Card -->
        <div id="VwEquimentMdl" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 hidden">
            <div class="bg-white p-4 rounded-lg shadow-lg max-w-3xl w-full max-h-[90vh] overflow-y-auto"> <!-- Updated width and height -->
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-lg font-semibold px-7">View Full Information</h2>
                    <button id="closeViewEquipmentFormBTN" class="text-gray-500 hover:text-gray-700">
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

                    <div class="flex justify-end space-x-4 items-center ml-auto">
                        <!-- Search Form -->
                        <form id="equipSearchForm" class="flex items-center space-x-4">
                            <!-- Search Input -->
                            <div class="relative w-96">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                                    </svg>
                                </div>
                                <input type="search" id="equipSearch" name="equipSearch" class="block w-64 p-4 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search" />
                            </div>

                            <!-- Buttons -->

                            <button id="ViewEquipExportBTN" class="bg-blue-500 text-white p-2 rounded hover:bg-blue-600">Export</button>
                            <button id="ViewEquipCondemnedBTN" class="bg-blue-500 text-white p-2 rounded hover:bg-blue-600">Condemned</button>
                            <button id="ViewEquipSelectAllBTN" class="bg-blue-500 text-white p-2 rounded hover:bg-blue-600">Select All</button>
                        </form>
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
                                    <th scope="col" class="px-6 py-3">
                                    </th>
                                </tr>
                            </thead>
                            <tbody id="tableViewBody">
                                <tr class="odd:bg-blue-100 odd:dark:bg-gray-900 even:bg-white even:dark:bg-gray-800 border-b dark:border-gray-700" data-id="">
                                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">SDADSAD</td>
                                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">SADASDasd</td>
                                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        <button id="ViewEditEQUIPMENTBTN" data-id="" type="button">
                                            <svg class="w-[27px] h-[27px] text-blue-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                                <path fill-rule="evenodd" d="M11.32 6.176H5c-1.105 0-2 .949-2 2.118v10.588C3 20.052 3.895 21 5 21h11c1.105 0 2-.948 2-2.118v-7.75l-3.914 4.144A2.46 2.46 0 0 1 12.81 16l-2.681.568c-1.75.37-3.292-1.263-2.942-3.115l.536-2.839c.097-.512.335-.983.684-1.352l2.914-3.086Z" clip-rule="evenodd" />
                                                <path fill-rule="evenodd" d="M19.846 4.318a2.148 2.148 0 0 0-.437-.692 2.014 2.014 0 0 0-.654-.463 1.92 1.92 0 0 0-1.544 0 2.014 2.014 0 0 0-.654.463l-.546.578 2.852 3.02.546-.579a2.14 2.14 0 0 0 .437-.692 2.244 2.244 0 0 0 0-1.635ZM17.45 8.721 14.597 5.7 9.82 10.76a.54.54 0 0 0-.137.27l-.536 2.84c-.07.37.239.696.588.622l2.682-.567a.492.492 0 0 0 .255-.145l4.778-5.06Z" clip-rule="evenodd" />
                                            </svg>
                                        </button>
                                    </td>
                                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        <input id="ViewEQUIPMENTCheckBox" type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
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
        <div id="edtFullEquipmentpMdl" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 hidden">
            <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-md h-auto overflow-auto">
                <!-- Flex container for heading and close button -->
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-2xl font-semibold">Edit Equipment</h2>
                    <button id="closeEdtFullEquipmentMdl" class="text-gray-500 hover:text-gray-700">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                <form id="editFullEQForm" action="" method="POST">

                    <input type="hidden" name="id" id="fullequipmentId">

                    <label for="FullEQUIPMENTSerialNoEDT" class="block text-sm font-semibold mb-1">Serial Number</label>
                    <input type="text" name="FullEQUIPMENTSerialNoEDT" id="FullEQUIPMENTSerialNoEDT" class="border border-gray-400 p-2 rounded w-full mb-2" placeholder="Serial Number">

                    <label for="FullEQUIPMENTControlNoEDT" class="block text-sm font-semibold mb-1">Control Number</label>
                    <input type="text" name="FullEQUIPMENTControlNoEDT" id="FullEQUIPMENTControlNoEDT" class="border border-gray-400 p-2 rounded w-full mb-2" placeholder="Control Number">


                    <div class="flex justify-end space-x-2">
                        <button type="button" id="saveFullEQUIPBTN" class="bg-green-500 hover:bg-green-600 text-white p-2 rounded">Save</button>
                        <button type="button" id="deleteFullEQUIPBTN" class="bg-red-500 hover:bg-red-600 text-white p-2 rounded">Delete</button>
                    </div>
                </form>
            </div>
        </div>
        <!-- END OF Edit 2 Popup Card -->

        <!-- View Data Export Button Card-->
        <div id="dataIncludedModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
            <div class="bg-white rounded-lg shadow-lg p-6 w-96">
                <h2 class="text-lg font-semibold mb-4">Data Included</h2>

                <!-- Checklist Section -->
                <div id="checkboxGroup" class="grid grid-cols-2 gap-4">
                    <label class="flex items-center space-x-2">
                        <input type="checkbox" class="rounded text-blue-500 focus:ring-blue-500">
                        <span class="text-sm">Serial Number</span>
                    </label>
                    <label class="flex items-center space-x-2">
                        <input type="checkbox" class="rounded text-blue-500 focus:ring-blue-500">
                        <span class="text-sm">Type</span>
                    </label>
                    <label class="flex items-center space-x-2">
                        <input type="checkbox" class="rounded text-blue-500 focus:ring-blue-500">
                        <span class="text-sm">Control Number</span>
                    </label>
                    <label class="flex items-center space-x-2">
                        <input type="checkbox" class="rounded text-blue-500 focus:ring-blue-500">
                        <span class="text-sm">Unit</span>
                    </label>
                    <label class="flex items-center space-x-2">
                        <input type="checkbox" class="rounded text-blue-500 focus:ring-blue-500">
                        <span class="text-sm">Brand Name</span>
                    </label>
                    <label class="flex items-center space-x-2">
                        <input type="checkbox" class="rounded text-blue-500 focus:ring-blue-500">
                        <span class="text-sm">Unit Price</span>
                    </label>
                    <label class="flex items-center space-x-2">
                        <input type="checkbox" class="rounded text-blue-500 focus:ring-blue-500">
                        <span class="text-sm">Product Name</span>
                    </label>
                    <label class="flex items-center space-x-2">
                        <input type="checkbox" class="rounded text-blue-500 focus:ring-blue-500">
                        <span class="text-sm">Classification</span>
                    </label>
                    <label class="flex items-center space-x-2">
                        <input type="checkbox" class="rounded text-blue-500 focus:ring-blue-500">
                        <span class="text-sm">Category</span>
                    </label>
                    <label class="flex items-center space-x-2">
                        <input type="checkbox" class="rounded text-blue-500 focus:ring-blue-500">
                        <span class="text-sm">Date</span>
                    </label>
                    <label class="flex items-center space-x-2">
                        <input type="checkbox" class="rounded text-blue-500 focus:ring-blue-500">
                        <span class="text-sm">SKU</span>
                    </label>
                </div>

                <!-- Buttons -->
                <div class="flex justify-between mt-4">
                    <button id="VIEWselectAllBtn" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">Select All</button>
                    <button id="VIEWexportFileBtn" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded">Export File</button>
                    <button id="VIEWcancelBtn" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded">Cancel</button>
                </div>
            </div>
        </div>
        <!-- END OF View Data Export Button Card -->

        <!-- Condemned Pop Up Card -->
        <div id="CondemnedEquipmentPopupCard" class="hidden fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-50 z-50">
            <div class="bg-white p-6 rounded-lg shadow-lg w-80">

                <label for="remarks" class="block mb-2"><strong>Are you sure you want to condem the item?</strong></label>
                
                <div class="flex justify-center space-x-4">
                    <button id="submitCondemnedEquipPopupCard" class="bg-green-400 hover:bg-green-500 text-white py-2 px-4 rounded">Submit</button>
                    <button id="closeCondemnedEquipPopupCard" class="bg-red-400 hover:bg-red-500 text-white py-2 px-4 rounded">Cancel</button>
                </div>
            </div>
        </div>

        <!-- END OF View 2 Table Pop Up Card -->
    </div>
</section>
@endsection