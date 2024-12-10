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
                <a href="{{ route('admin_StockInEquipment') }}" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600 dark:text-gray-400 dark:hover:text-white">
                    Inventory
                </a>
            </li>
            <li>
                <div class="flex items-center">
                    <svg class="rtl:rotate-180 block w-3 h-3 mx-1 text-gray-400 " aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4" />
                    </svg>
                    <a href="#" class="ms-1 text-sm font-medium text-gray-700 hover:text-blue-600 md:ms-2 dark:text-gray-400 dark:hover:text-white">Stock In</a>
                </div>
            </li>

        </ol>
    </nav>

    <!-- Add additional content here -->
    <div class="bg-gray-100 h-auto rounded-lg ">

        <div class="flex justify-between items-center mt-4 px-9 py-2">
            <!-- Left-Aligned Buttons -->
            <div>
                <a href="{{ route('admin_StockInEquipment') }}" class="button border-b-2 border-blue-500 py-2 px-4 transition-all duration-300 translate-x-2">Stock In</a>
                <a href="{{ route('admin_EQUIPMENT')}}" class="button border-b-2  py-2 px-4 transition-all duration-300 translate-x-2">Equipment</a>
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

                <form id="EquipmentForm" action="{{ route('equipment.store') }}" method="POST">
                    @csrf
                    <!-- Grid for Input Fields -->
                    <div class="grid grid-cols-2 gap-2">
                        <!-- First column label/input -->
                        <!--<input type="hidden" name="equipmentId" id="equipmentId" value="{{ $item->id ?? ''}}">-->
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
                            <label for="datepicker-format" class="block text-sm font-semibold mb-2">Date:</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                                    </svg>
                                </div>
                                <input id="EquipmentDate" name="EquipmentDate" readonly datepicker datepicker-min-date="06/04/2024" datepicker-max-date="05/05/2025" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Select date">
                            </div>
                        </div>

                        <div>
                            <label for="EquipmentUnitPrice" class="block text-sm font-semibold mb-1">Unit Price</label>
                            <input type="number" name="EquipmentUnitPrice" id="EquipmentUnitPrice" class="border border-gray-400 p-2 rounded w-full mb-4" placeholder="Price">
                        </div>

                        <div>
                            <label for="EquipmentClassification" class="block text-sm font-semibold mb-1">Classification</label>
                            <input type="text" name="EquipmentClassification" id="EquipmentClassification" class="border border-gray-400 p-2 rounded w-full mb-2" placeholder="Classification" >
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
                    @foreach($equipment as $item)
                    <tr class="odd:bg-blue-100 odd:dark:bg-gray-900 even:bg-white even:dark:bg-gray-800 border-b dark:border-gray-700" data-id="{{$item->equipmentId}}" data-brand="{{$item->EquipmentBrandName}}"
                        data-type="{{$item->EquipmentType}}" 
                        data-unit="{{$item->EquipmentUnit}}" 
                        data-color="{{$item->EquipmentColor}}"
                        data-category="{{$item->EquipmentCategory}}" 
                        data-other-category="{{$item->OtherCategory ?? ''}}"
                        data-unit-price="{{$item->EquipmentUnitPrice}}">
                        <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">{{$item->EquipmentStatus}}</td>
                        <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">{{$item->EquipmentBrandName}}</td>
                        <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">{{$item->EquipmentName}}</td>
                        <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">{{$item->EquipmentCategory}}</td>
                        <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">{{$item->EquipmentQuantity}}</td>
                        <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">₱{{number_format($item->totalPrice, 2)}}</td>
                        <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">{{$item->EquipmentSKU}}</td>
                        <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">{{$item->EquipmentClassification}}</td>
                        <td class="px-6 py-4">
                            <button id="viewEquipButton" data-id="{{ $item->equipmentId }}" data-brand="{{$item->EquipmentBrandName}}" type="button">
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
                            <button class="editStockInButton"  data-id="{{ $item->equipmentId }}" type="button">
                                <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#000000">
                                    <path d="M200-520q-33 0-56.5-23.5T120-600v-160q0-33 23.5-56.5T200-840h560q33 0 56.5 23.5T840-760v160q0 33-23.5 56.5T760-520H200Zm0 400q-33 0-56.5-23.5T120-200v-160q0-33 23.5-56.5T200-440h560q33 0 56.5 23.5T840-360v160q0 33-23.5 56.5T760-120H200Z" />
                                </svg>
                            </button>
                        </td>
                    </tr>
                    @endforeach
                    <!-- Dynamic rows will be inserted here -->
                </tbody>
            </table>
        </div>
        <!-- END OF MAIN Table -->

        <!-- Stock IN Form Card -->
        <div id="StockInEquipmentPopupCard" class="hidden fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-50 z-50">
            <div class="bg-white p-6 rounded-lg shadow-lg w-80">

                <label for="remarks" class="block mb-2"><strong>Are you sure you want to stock in?</strong></label>
                

                <div class="flex justify-center space-x-4">
                    <button id="submitStockInEquipPopupCard" class="bg-green-400 hover:bg-green-500 text-white py-2 px-4 rounded">Submit</button>
                    <button id="closeStockInEquipPopupCard" class="bg-red-400 hover:bg-red-500 text-white py-2 px-4 rounded">Cancel</button>
                </div>
            </div>
        </div>
        <!-- END OF Stock In Form Card -->


        <!-- Edit 1 Popup Card -->
         @foreach($equipment as $item)
        <div id="editEquipModal" data-brand="{{$item->EquipmentBrandName}}" class=" editEquipModal fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 hidden">
            <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-xl  overflow-y-auto">
                <!-- Flex container for heading and close button -->
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-2xl font-semibold">Edit Equipment</h2>
                    <button id="closeEquipFormButton" class="text-gray-500 hover:text-gray-700">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                <form id="editForm" data-brand="{{$item->EquipmentBrandName}}" action="{{ route('equipment.updateMain') }}" method="POST">

                    <div class="grid grid-cols-2 gap-2">

                        <input type="hidden" name="brand" id="brandField" value="">

                        <div>
                            <label for="EquipmentBrandName" class="block text-sm font-semibold mb-1">Brand Name</label>
                            <input type="text" name="EquipmentBrandNameEdit" id="EquipmentBrandNameEdit" class="border border-gray-400 p-2 rounded w-full mb-2" placeholder="Brand Name">
                        </div>

                        <div>
                            <label for="EquipmentName" class="block text-sm font-semibold mb-1">Equipment Name</label>
                            <input type="text" name="EquipmentNameEdit" id="EquipmentNameEdit" class="border border-gray-400 p-2 rounded w-full mb-2" placeholder="Equipment Name">
                        </div>

                        <div>
                            <label for="EquipmentCategory" class="block text-sm font-semibold mb-1">Category</label>
                            <select name="EquipmentCategoryEdit" id="EquipmentCategoryEdit" class="border border-gray-400 p-2 rounded w-full mb-2">
                                <option value="default" disabled selected>Select a category</option>
                                <option value="textbook">Textbook</option>
                                <option value="office">Office Supplies</option>
                                <option value="electronics">Electronics</option>
                                <option value="other">Other</option>
                                <!-- Add more options as needed -->
                            </select>
                        </div>

                        <div id="otherEquipCategoryDivEdit" class="hidden">
                            <label for="otherEquipCategoryEdit" class="block text-sm font-semibold mb-1">Other Category</label>
                            <input type="text" name="otherEquipCategoryEdit" id="otherEquipCategoryEdit" class="border border-gray-400 p-2 rounded w-full mb-2" placeholder="Enter category">
                        </div>

                        <div>
                            <label for="EquipmentQuantityEdit" class="block text-sm font-semibold mb-1">Quantity</label>
                            <input type="number" name="EquipmentQuantityEdit" id="EquipmentQuantityEdit" min="1" class="border border-gray-400 p-2 rounded w-full mb-2" placeholder="Quantity" required>
                        </div>

                        <div>
                            <label for="EquipmentSKUEdit" class="block text-sm font-semibold mb-1">SKU</label>
                            <input type="text" name="EquipmentSKUEdit" id="EquipmentSKUEdit" class="border border-gray-400 p-2 rounded w-full mb-2" placeholder="SKU">
                        </div>


                        <div>
                            <label for="EquipmentColorEdit" class="block text-sm font-semibold mb-1">Color</label>
                            <input type="text" name="EquipmentColorEdit" id="EquipmentColorEdit" class="border border-gray-400 p-2 rounded w-full mb-2" placeholder="Color" pattern="[A-Za-z ]*" title="Only characters are allowed">
                        </div>

                        <div>
                            <label for="EquipmentTypeEdit" class="block text-sm font-semibold mb-1">Type</label>
                            <input type="text" name="EquipmentTypeEdit" id="EquipmentTypeEdit" class="border border-gray-400 p-2 rounded w-full mb-2" placeholder="Type" pattern="[A-Za-z ]*" title="Only characters are allowed">
                        </div>

                        <div>
                            <label for="EquipmentUnitEdit" class="block text-sm font-semibold mb-1">Unit</label>
                            <input type="text" name="EquipmentUnitEdit" id="EquipmentUnitEdit" class="border border-gray-400 p-2 rounded w-full mb-2" placeholder="Unit" pattern="[A-Za-z ]*" title="Only characters are allowed">
                        </div>

                        <div>
                            <label for="EquipmentUnitPriceEdit" class="block text-sm font-semibold mb-1">Unit Price</label>
                            <input type="number" name="EquipmentUnitPriceEdit" id="EquipmentUnitPriceEdit" class="border border-gray-400 p-2 rounded w-full mb-4" placeholder="Price" max="5000" step="any" >
                        </div>

                        <div>
                            <label for="EquipmentClassificationEdit" class="block text-sm font-semibold mb-1">Classification</label>
                            <input type="text" name="EquipmentClassificationEdit" id="EquipmentClassificationEdit" class="border border-gray-400 p-2 rounded w-full mb-2" placeholder="Classification" pattern="[A-Za-z ]*" title="Only characters are allowed">
                        </div>
                    </div>

                    <div class="flex justify-end space-x-2">
                        <button type="button" id="saveEquipButton" class="bg-green-500 hover:bg-green-600 text-white p-2 rounded">Save</button>
                       
                        <button type="button" id="deleteEquipButton" data-brand="{{$item->EquipmentBrandName}}" class="bg-red-500 hover:bg-red-600 text-white p-2 rounded">Delete</button>
                        
                    </div>
                </form>
            </div>
        </div>
        @endforeach
        <!-- END OF Edit 1 Popup Card -->


        <!-- View 1 Popup Card -->
        <div id="ViewEquipModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 hidden">
            <div class="bg-white p-4 rounded-lg shadow-lg w-full max-w-4xl h-auto overflow-auto">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-lg font-semibold px-7">View Full Information</h2>
                    <button id="closeViewEquipFormButton" class="text-gray-500 hover:text-gray-700">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                @if(isset($item))
                <div class="grid grid-cols-2 gap-4 ml-6 text-sm w-full" id="equipmentDetails">
                    <div>
                        <p class="mb-2"><strong>Brand Name:</strong>{{$item->EquipmentBrandName}}</p>
                        <p class="mb-2"><strong>Product Name:</strong>{{$item->EquipmentName}}</p>
                        <p class="mb-2"><strong>Category:</strong>{{$item->EquipmentCategory}}</p>
                        <p class="mb-2"><strong>SKU:</strong>{{$item->EquipmentSKU}}</p>
                        <p class="mb-2"><strong>Color:</strong>{{$item->EquipmentColor}}</p>
                        <p class="mb-2"><strong>Type:</strong>{{$item->EquipmentType}}</p>
                    </div>

                    <div>
                        <p class="mb-2"><strong>Unit:</strong>{{$item->EquipmentUnit}}</p>
                        <p class="mb-2"><strong>Unit Price:</strong>{{$item->EquipmentUnitPrice}}</p>
                        <p class="mb-2"><strong>Classification:</strong>{{$item->EquipmentClassification}}</p>
                        <p class="mb-2"><strong>Date:</strong>{{$item->EquipmentDate}}</p>
                    </div>
                </div>
                @endif
                @if($equipment->isEmpty())
                <p class="text-center text-gray-500">No equipment details available.</p>
                @else
                <div class="relative shadow-md sm:rounded-lg px-9 py-5 max-h-96 overflow-y-auto">
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
                        <tbody id="tableViewBodyEquipment">
                            @foreach($equipment as $item)
                            <tr class="odd:bg-blue-100 odd:dark:bg-gray-900 even:bg-white even:dark:bg-gray-800 border-b dark:border-gray-700" 
                                data-id="{{$item->equipmentId}}"
                                data-brand="{{$item->EquipmentBrandName}}"
                                data-serial="{{$item->EquipmentSerialNo}}">
                                <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">{{$item->EquipmentSerialNo}}</td>
                                <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">{{$item->EquipmentControlNo}}</td>
                                <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    <button class="editEquipBTN" data-id="{{ $item->equipmentId}}" type="button">
                                        <svg class="w-[27px] h-[27px] text-blue-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                            <path fill-rule="evenodd" d="M11.32 6.176H5c-1.105 0-2 .949-2 2.118v10.588C3 20.052 3.895 21 5 21h11c1.105 0 2-.948 2-2.118v-7.75l-3.914 4.144A2.46 2.46 0 0 1 12.81 16l-2.681.568c-1.75.37-3.292-1.263-2.942-3.115l.536-2.839c.097-.512.335-.983.684-1.352l2.914-3.086Z" clip-rule="evenodd" />
                                            <path fill-rule="evenodd" d="M19.846 4.318a2.148 2.148 0 0 0-.437-.692 2.014 2.014 0 0 0-.654-.463 1.92 1.92 0 0 0-1.544 0 2.014 2.014 0 0 0-.654.463l-.546.578 2.852 3.02.546-.579a2.14 2.14 0 0 0 .437-.692 2.244 2.244 0 0 0 0-1.635ZM17.45 8.721 14.597 5.7 9.82 10.76a.54.54 0 0 0-.137.27l-.536 2.84c-.07.37.239.696.588.622l2.682-.567a.492.492 0 0 0 .255-.145l4.778-5.06Z" clip-rule="evenodd" />
                                        </svg>
                                    </button>
                                </td>
                                <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    <input id="StockInCheckBox" type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                </td>
                            </tr>
                            @endforeach
                            <!-- Dynamic rows will be inserted here -->
                        </tbody>
                    </table>
                </div>
                @endif
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

                    <input type="hidden" name="equipmentId" id="equipmentId">

                    <label for="EquipmentSerialNo" class="block text-sm font-semibold mb-1">Serial Number</label>
                    <input type="text" name="EquipmentSerialNo" id="EquipmentSerialNo" class="border border-gray-400 p-2 rounded w-full mb-2" placeholder="Serial Number">
        
                    <label for="FullEquipmentControlNoEdit" class="block text-sm font-semibold mb-1">Control Number</label>
                    <input type="text" name="FullEquipmentControlNoEdit" id="FullEquipmentControlNoEdit" class="border border-gray-400 p-2 rounded w-full mb-2" placeholder="Control Number">

                    <div class="flex justify-end space-x-2">
                        <button type="button" id="saveFullEquipButton" class="bg-green-500 hover:bg-green-600 text-white p-2 rounded">Save</button>
                        <button type="button" id="deleteFullEquipButton" class="bg-red-500 hover:bg-red-600 text-white p-2 rounded">Delete</button>
                    </div>
                </form>
            </div>
        </div>
        <!-- END OF Edit 2 Popup Card -->


        <!-- Add Pop Up Card -->


        <!-- END OF Add Pop Up Card -->

        <!-- View 2 Table Pop Up Card -->
        @foreach($equipment as $item)
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
                    <p><strong>Serial Number:</strong>{{$item->EquipmentSerialNo}}</p>
                    <p><strong>Control Number:</strong>{{$item->EquipmentControlNo}}</p>
                    <p><strong>Brand Name:</strong>{{$item->EquipmentBrandName}}</p>
                    <p><strong>Product Name:</strong>{{$item->EquipmentName}}</p>
                    <p><strong>Category:</strong>{{$item->EquipmentCategory}}</p>
                    <p><strong>Type:</strong>{{$item->EquipmentType}}</p>
                    <p><strong>Color:</strong>{{$item->EquipmentColor}}</p>
                    <p><strong>Unit:</strong>{{$item->EquipmentUnit}}</p>
                    <p><strong>Unit Price:</strong>₱{{$item->EquipmentUnitPrice}}</p>
                    <p><strong>Classification:</strong>{{$item->EquipmentClassification}}</p>
                    <p><strong>Date:</strong>{{$item->EquipmentDate}}</p>
                </div>

            </div>
        </div>
        @endforeach
        <!-- END OF View 2 Table Pop Up Card -->
    </div>
</section>
@endsection