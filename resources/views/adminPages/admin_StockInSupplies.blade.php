@extends('adminLayouts.admin_sidebarLayout')

@section('title', 'Inventory Supplies | BHNHS')

@section('content')

<section>
    <div class="flex items-center pb-8">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" strokeWidth="1.5" stroke="currentColor" class="w-7 h-7">
            <path strokeLinecap="round" strokeLinejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
        </svg>
        <h1 class="text-3xl font-bold ml-2">Inventory Supplies</h1>
    </div>

    <!-- Breadcrumbs -->
    <nav class="flex px-5 py-3 text-gray-700 border border-gray-200 rounded-lg bg-gray-50 dark:bg-gray-800 dark:border-gray-700" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
            <li class="inline-flex items-center">
                <a href="{{ route('admin_StockInSupplies') }}" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600 dark:text-gray-400 dark:hover:text-white">
                    Inventory
                </a>
            </li>
            <li>
                <div class="flex items-center">
                    <svg class="rtl:rotate-180 block w-3 h-3 mx-1 text-gray-400 " aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4" />
                    </svg>
                    <a href="#" class="ms-1 text-sm font-medium text-gray-700 hover:text-blue-600 md:ms-2 dark:text-gray-400 dark:hover:text-white">Supplies</a>
                </div>
            </li>

        </ol>
    </nav>

    <!-- Add additional content here -->
    <div class="bg-gray-100 h-auto rounded-lg ">

        <div class="flex justify-between items-center mt-4 px-9 py-2">
            <!-- Left-Aligned Buttons -->
            <div>
                <a href="{{ route('admin_StockInSupplies') }}" class="pageloader button border-b-2 border-blue-500 py-2 px-4 transition-all duration-300 translate-x-2">Stock In</a>
                <a href="{{ route('admin_supplies')}}" class="pageloader button border-b-2 py-2 px-4 transition-all duration-300 translate-x-2">Supplies</a>
                <a href="{{ route('admin_suppliesHistory')}}" class="pageloader button border-b-2 py-2 px-4 transition-all duration-300 translate-x-2">History</a>
                <a href="{{ route('admin_suppliesUsed')}}" class="pageloader button border-b-2 py-2 px-4 transition-all duration-300 translate-x-2">Used</a>
            </div>

            <!-- Date Picker -->


            <!-- Search Bar -->
            <div class="flex items-center space-x-4">

                <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 w-full sr-only dark:text-white">Search</label>
                <form id="suppliesSearchForm" class="flex items-center space-x-4">
                    <div class="relative w-96">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                            <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                            </svg>
                        </div>
                        <input type="search" id="suppliesSearch" name="suppliesSearch" class="block w-full p-4 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search" />
                    </div>

                    <!-- Add Item Button-->
                    <button id="SuppliesFormButton" class="bg-blue-500 text-white p-2 rounded hover:bg-blue-600">Add Item</button>
            </div>
        </div>

        <!-- Floating Card with Form (Initially Hidden) -->
        <div id="SuppliesFormCard" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
            <div class="bg-white p-4 rounded-lg shadow-lg max-w-xl w-full">
                <h2 class="text-xl font-bold mb-4">Add New Supplies</h2>

                <form action="{{ route('supplies.store') }}" method="POST">
                    @csrf
                    <!-- Input Fields -->
                    <div class="grid grid-cols-2 gap-2">

                        <div>
                            <label for="SuppliesBrandName" class="block text-sm font-semibold mb-1">Brand Name</label>
                            <input type="text" name="SuppliesBrandName" id="SuppliesBrandName" class="border border-gray-400 p-2 rounded w-full mb-2" placeholder="Brand Name">
                        </div>

                        <div>
                            <label for="SuppliesName" class="block text-sm font-semibold mb-1">Supplies Name</label>
                            <input type="text" name="SuppliesName" id="SuppliesName" class="border border-gray-400 p-2 rounded w-full mb-2" placeholder="Supplies Name">
                        </div>

                        <div>
                            <label for="SuppliesCategory" class="block text-sm font-semibold mb-1">Category</label>
                            <select name="SuppliesCategory" id="SuppliesCategory" class="border p-2 rounded w-full mb-2 border-gray-400">
                                <option value="" disabled selected>Select a category</option>
                                <option value="textbook">Textbook</option>
                                <option value="office">Office Supplies</option>
                                <option value="electronics">Electronics</option>
                                <option value="other">Other</option>
                                <!-- Add more options as needed -->
                            </select>
                        </div>

                        <div id="otherSuppCategoryDiv" class="hidden">
                            <label for="otherCategory" class="block text-sm font-semibold mb-1">Other Category</label>
                            <input type="text" name="otherCategory" id="otherSuppCategory" class="border border-gray-400 p-2 rounded w-full mb-2" placeholder="Enter category">
                        </div>

                        <div>
                            <label for="SuppliesType" class="block text-sm font-semibold mb-1">Type</label>
                            <input type="text" name="SuppliesType" id="SuppliesType" class="border border-gray-400 p-2 rounded w-full mb-2" placeholder="Type" pattern="[A-Za-z ]*" title="Only characters are allowed">
                        </div>

                        <div>
                            <label for="SuppliesColor" class="block text-sm font-semibold mb-1">Color</label>
                            <input type="text" name="SuppliesColor" id="SuppliesColor" class="border border-gray-400 p-2 rounded w-full mb-2" placeholder="Color" pattern="[A-Za-z ]*" title="Only characters are allowed">
                        </div>

                        <div>
                            <label for="SuppliesUnit" class="block text-sm font-semibold mb-1">Unit</label>
                            <input type="text" name="SuppliesUnit" id="SuppliesUnit" class="border border-gray-400 p-2 rounded w-full mb-2" placeholder="Unit" pattern="[A-Za-z ]*" title="Only characters are allowed">
                        </div>

                        <div>
                            <label for="SuppliesUnitPrice" class="block text-sm font-semibold mb-1">Unit Price</label>
                            <input type="number" name="SuppliesUnitPrice" id="SuppliesUnitPrice" class="border border-gray-400 p-2 rounded w-full mb-4" placeholder="Price">
                        </div>

                        <div>
                            <label for="SuppliesQuantity" class="block text-sm font-semibold mb-1">Quantity</label>
                            <input type="number" name="SuppliesQuantity" id="SuppliesQuantity" class="border p-2 rounded w-full mb-2 border-gray-400" placeholder="Quantity">
                        </div>


                        <div>
                            <label for="datepicker-format" class="block text-sm font-semibold mb-2">Date:</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                                    </svg>
                                </div>
                                <input id="SuppliesDate" name="SuppliesDate" readonly datepicker datepicker-min-date="06/04/2024" datepicker-max-date="05/05/2025" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Select date">
                            </div>
                        </div>

                        <div>
                            <label for="SuppliesClassification" class="block text-sm font-semibold mb-1">Classification</label>
                            <input type="text" name="SuppliesClassification" id="SuppliesClassification" class="border p-2 rounded w-full mb-4 border-gray-400" placeholder="Classification">
                        </div>


                        <div>
                            <label for="SuppliesSKU" class="block text-sm font-semibold mb-1">SKU</label>
                            <input type="text" id="SuppliesSKU" class="border p-2 rounded w-full mb-2 border-gray-400" placeholder="SKU">
                        </div>
                    </div>

                    <div>
                        <label class="flex items-center space-x-2">
                            <input type="checkbox" id="lowSuppliesStockAlert" name="lowSuppliesStockAlert" class="rounded text-blue-500 focus:ring-blue-500">
                            <span class="text-sm font-semibold">Low stock alert</span>
                        </label>
                        <div id="lowSuppliesStockThresholdDiv" class="mt-2 hidden">
                            <label for="lowSuppliesStockThreshold" class="block text-sm font-semibold mb-1">Low stock threshold</label>
                            <input type="number" id="lowSuppliesStockThreshold" name="lowSuppliesStockThreshold" class="border border-gray-400 p-2 rounded w-64" placeholder="Enter threshold">
                        </div>
                    </div>

                    <!-- Save and Close Buttons -->
                    <div class="flex justify-end space-x-2">
                        <button id="SuppliesCloseFormButton" class="bg-red-500 hover:bg-red-600 text-white p-2 rounded">Close</button>
                        <button id="SuppliesSaveButton" type="button" data-id="supplies" class="bg-green-500 hover:bg-green-600 text-white p-2 rounded">Save</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Table -->
        <div class="relative shadow-md sm:rounded-lg px-9 py-5 ">
            <table id="dynamicTable" class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-sm text-white dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            Brand Name
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Supplies Name
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
                    @foreach($supplies as $item)
                    <tr class="odd:bg-blue-100 odd:dark:bg-gray-900 even:bg-white even:dark:bg-gray-800 border-b dark:border-gray-700" data-id="{{$item->suppliesId}}" data-brand="{{$item->SuppliesBrandName}}"
                        data-type="{{$item->SuppliesType}}"
                        data-unit="{{$item->SuppliesUnit}}"
                        data-color="{{$item->SuppliesColor}}"
                        data-category="{{$item->SuppliesCategory}}"
                        data-other-category="{{$item->OtherCategory ?? ''}}"
                        data-unit-price="{{$item->SuppliesUnitPrice}}">
                        <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">{{$item->SuppliesBrandName}}</td>
                        <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">{{$item->SuppliesName}}</td>
                        <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">{{$item->SuppliesCategory}}</td>
                        <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">{{$item->SuppliesQuantity}}</td>
                        <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">₱{{number_format($item->totalPrice,2)}}</td>
                        <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">{{$item->SuppliesSKU}}</td>
                        <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">{{$item->SuppliesClassification}}</td>
                        <td class="px-6 py-4 border-b border-gray-300">
                            <button id="viewSuppButton" type="button">
                                <svg class="w-[27px] h-[27px] text-green-600 hover:text-green-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-width="2" d="M21 12c0 1.2-4.03 6-9 6s-9-4.8-9-6c0-1.2 4.03-6 9-6s9 4.8 9 6Z" />
                                    <path stroke="currentColor" stroke-width="2" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                </svg>
                            </button>
                            <button id="editSuppButton" type="button">
                                <svg class="w-[27px] h-[27px] text-blue-600  hover:text-blue-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                    <path fill-rule="evenodd" d="M11.32 6.176H5c-1.105 0-2 .949-2 2.118v10.588C3 20.052 3.895 21 5 21h11c1.105 0 2-.948 2-2.118v-7.75l-3.914 4.144A2.46 2.46 0 0 1 12.81 16l-2.681.568c-1.75.37-3.292-1.263-2.942-3.115l.536-2.839c.097-.512.335-.983.684-1.352l2.914-3.086Z" clip-rule="evenodd" />
                                    <path fill-rule="evenodd" d="M19.846 4.318a2.148 2.148 0 0 0-.437-.692 2.014 2.014 0 0 0-.654-.463 1.92 1.92 0 0 0-1.544 0 2.014 2.014 0 0 0-.654.463l-.546.578 2.852 3.02.546-.579a2.14 2.14 0 0 0 .437-.692 2.244 2.244 0 0 0 0-1.635ZM17.45 8.721 14.597 5.7 9.82 10.76a.54.54 0 0 0-.137.27l-.536 2.84c-.07.37.239.696.588.622l2.682-.567a.492.492 0 0 0 .255-.145l4.778-5.06Z" clip-rule="evenodd" />
                                </svg>
                            </button>
                            <button class="editStockInSuppButton" data-id="{{ $item->suppliesId }}" type="button">
                                <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#000000">
                                    <path d="M200-520q-33 0-56.5-23.5T120-600v-160q0-33 23.5-56.5T200-840h560q33 0 56.5 23.5T840-760v160q0 33-23.5 56.5T760-520H200Zm0 400q-33 0-56.5-23.5T120-200v-160q0-33 23.5-56.5T200-440h560q33 0 56.5 23.5T840-360v160q0 33-23.5 56.5T760-120H200Z" />
                                </svg>
                            </button>
                            <button class="deleteSuppButton" data-brand="{{$item->SuppliesBrandName}}" type="button">
                                <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#Ff0000">
                                    <path d="M280-120q-33 0-56.5-23.5T200-200v-520h-40v-80h200v-40h240v40h200v80h-40v520q0 33-23.5 56.5T680-120H280Zm400-600H280v520h400v-520ZM360-280h80v-360h-80v360Zm160 0h80v-360h-80v360ZM280-720v520-520Z" />
                                </svg>
                            </button>
                        </td>
                    </tr>
                    @endforeach
                    <!-- Dynamic rows will be inserted here -->
                </tbody>
            </table>

            <!-- Stock IN Form Card -->
            <div id="StockInSuppliesPopupCard" class="hidden fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-50 z-50">
                <div class="bg-white p-6 rounded-lg shadow-lg w-80">

                    <label for="remarks" class="block mb-2"><strong>Are you sure you want to stock in?</strong></label>


                    <div class="flex justify-center space-x-4">
                        <button id="submitStockInSuppPopupCard" class="bg-green-400 hover:bg-green-500 text-white py-2 px-4 rounded">Submit</button>
                        <button id="closeStockInSuppPopupCard" class="bg-red-400 hover:bg-red-500 text-white py-2 px-4 rounded">Cancel</button>
                    </div>
                </div>
            </div>
            <!-- END OF Stock In Form Card -->

            <!-- Edit 1 Popup Card -->
            <div id="editSuppModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
                <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-xl  overflow-y-auto">
                    <!-- Flex container for heading and close button -->
                    <div class="flex justify-between items-center mb-4">
                        <h2 class="text-2xl font-semibold">Edit Supplies</h2>
                        <button id="closeSuppFormButton" class="text-gray-500 hover:text-gray-700">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                    <form id="editForm" action="" method="POST">


                        <div class="grid grid-cols-2 gap-2">

                            <input type="hidden" name="brand" value="">


                            <div>
                                <label for="SuppliesBrandNameEdit" class="block text-sm font-semibold mb-1">Brand Name</label>
                                <input type="text" name="SuppliesBrandNameEdit" id="SuppliesBrandNameEdit" class="border border-gray-400 p-2 rounded w-full mb-2" placeholder="Brand Name">
                            </div>

                            <div>
                                <label for="SuppliesName" class="block text-sm font-semibold mb-1">Supplies Name</la>
                                    <input type="text" name="SuppliesNameEdit" id="SuppliesNameEdit" class="border border-gray-400 p-2 rounded w-full mb-2" placeholder="Supplies Name">
                            </div>


                            <div>
                                <label for="SuppliesCategoryEdit" class="block text-sm font-semibold mb-1">Category</label>
                                <select name="SuppliesCategoryEdit" id="SuppliesCategoryEdit" class="border p-2 rounded w-full mb-2 border-gray-400">
                                    <option value="" disabled selected>Select a category</option>
                                    <option value="textbook">Textbook</option>
                                    <option value="office">Office Supplies</option>
                                    <option value="electronics">Electronics</option>
                                    <option value="other">Other</option>
                                    <!-- Add more options as needed -->
                                </select>
                            </div>


                            <div id="otherSuppCategoryDiv" class="hidden">
                                <label for="otherCategoryEdit" class="block text-sm font-semibold mb-1">Other Category</label>
                                <input type="text" name="otherCategoryEdit" id="otherSuppCategoryEdit" class="border border-gray-400 p-2 rounded w-full mb-2" placeholder="Enter category">
                            </div>

                            <div>
                                <label for="SuppliesQuantityEdit" class="block text-sm font-semibold mb-1">Quantity</label>
                                <input type="number" name="SuppliesQuantityEdit" id="SuppliesQuantityEdit" class="border p-2 rounded w-full mb-2 border-gray-400" placeholder="Quantity">
                            </div>

                            <div>
                                <label for="SuppliesSKUEdit" class="block text-sm font-semibold mb-1">SKU</la>
                                    <input type="text" name="SuppliesSKUEdit" id="SuppliesSKUEdit" class="border p-2 rounded w-full mb-2 border-gray-400" placeholder="SKU">
                            </div>

                            <div>
                                <label for="SuppliesColorEdit" class="block text-sm font-semibold mb-1">Color</label>
                                <input type="text" name="SuppliesColorEdit" id="SuppliesColorEdit" class="border border-gray-400 p-2 rounded w-full mb-2" placeholder="Color" pattern="[A-Za-z ]*" title="Only characters are allowed">
                            </div>

                            <div>
                                <label for="SuppliesTypeEdit" class="block text-sm font-semibold mb-1">Type</label>
                                <input type="text" name="SuppliesTypeEdit" id="SuppliesTypeEdit" class="border border-gray-400 p-2 rounded w-full mb-2" placeholder="Type" pattern="[A-Za-z ]*" title="Only characters are allowed">
                            </div>

                            <div>
                                <label for="SuppliesUnitEdit" class="block text-sm font-semibold mb-1">Unit</label>
                                <input type="text" name="SuppliesUnitEdit" id="SuppliesUnitEdit" class="border border-gray-400 p-2 rounded w-full mb-2" placeholder="Unit" pattern="[A-Za-z ]*" title="Only characters are allowed">
                            </div>

                            <div>
                                <label for="SuppliesUnitPriceEdit" class="block text-sm font-semibold mb-1">Unit Price</label>
                                <input type="number" name="SuppliesUnitPriceEdit" id="SuppliesUnitPriceEdit" class="border p-2 rounded w-full mb-4 border-gray-400" placeholder="Price">
                            </div>

                            <div>
                                <label for="SuppliesClassificationEdit" class="block text-sm font-semibold mb-1">Classification</label>
                                <input type="text" name="SuppliesClassificationEdit" id="SuppliesClassificationEdit" class="border p-2 rounded w-full mb-4 border-gray-400" placeholder="Classification">
                            </div>


                        </div>

                        <div>
                        <label class="flex items-center space-x-2">
                            <input type="checkbox" id="lowEditSuppliesStockAlert" name="lowEditSuppliesStockAlert" class="rounded text-blue-500 focus:ring-blue-500">
                            <span class="text-sm font-semibold">Low stock alert</span>
                        </label>
                        <div id="lowEditSuppliesStockThresholdDiv" class="mt-2 hidden">
                            <label for="lowEditSuppliesStockThreshold" class="block text-sm font-semibold mb-1">Low stock threshold</label>
                            <input type="number" id="lowEditSuppliesStockThreshold" name="lowEditSuppliesStockThreshold" class="border border-gray-400 p-2 rounded w-64" placeholder="Enter threshold">
                        </div>
                    </div>


                        <div class="flex justify-end space-x-2">
                            <button type="button" id="saveSuppButton" class="bg-green-500 hover:bg-green-600 text-white p-2 rounded">Save</button>


                        </div>
                    </form>
                </div>
            </div>

            <!-- View 1 Popup Card -->
            <div id="ViewSuppModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 hidden">
                <div class="bg-white p-4 rounded-lg shadow-lg w-full max-w-4xl h-auto">
                    <div class="flex justify-between items-center mb-4">
                        <h2 class="text-lg font-semibold px-7">View Full Information</h2>
                        <button id="closeViewSuppFormButton" class="text-gray-500 hover:text-gray-700">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>

                    @if(isset($item))
                    <div class="grid grid-cols-2 gap-4 ml-6 text-sm w-full">
                        <div>
                            <p class="mb-2"><strong>Brand Name:</strong>{{$item->SuppliesBrandName}}</p>
                            <p class="mb-2"><strong>Product Name:</strong>{{$item->SuppliesName}}</p>
                            <p class="mb-2"><strong>Category:</strong>{{$item->SuppliesCategory}}</p>
                            <p class="mb-2"><strong>SKU:</strong>{{$item->SuppliesSKU}}</p>
                            <p class="mb-2"><strong>Color:</strong>{{$item->SuppliesColor}}</p>
                            <p class="mb-2"><strong>Type:</strong>{{$item->SuppliesType}}</p>
                        </div>

                        <div>
                            <p class="mb-2"><strong>Unit:</strong>{{$item->SuppliesUnit}}</p>
                            <p class="mb-2"><strong>Unit Price:</strong>{{$item->SuppliesUnitPrice}}</p>
                            <p class="mb-2"><strong>Classification:</strong>{{$item->SuppliesClassification}}</p>
                            <p class="mb-2"><strong>Date:</strong>{{$item->SuppliesDate}}</p>
                        </div>
                    </div>
                    @endif

                </div>
            </div>
            <!-- END OF View 1 Popup Card -->

            <!-- Edit 2 Popup Card -->
            <div id="editFullSuppModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 hidden">
                <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-1xl overflow-y-auto">
                    <!-- Flex container for heading and close button -->
                    <div class="flex justify-between items-center mb-4">
                        <h2 class="text-2xl font-semibold">Edit Supplies</h2>
                        <button id="closeEditFullSuppModal" class="text-gray-500 hover:text-gray-700">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                    <form id="editFullSuppForm" action="" method="POST">

                        <input type="hidden" name="id" id="fullsuppliesId">

                        <label for="FullSuppliesSerialNoEdit" class="block text-sm font-semibold mb-1">Serial Number</label>
                        <input type="text" name="FullSuppliesSerialNoEdit" id="FullSuppliesSerialNoEdit" class="border border-gray-400 p-2 rounded w-full mb-2" placeholder="Serial Number">

                        <label for="FullSuppliesControlNoEdit" class="block text-sm font-semibold mb-1">Control Number</label>
                        <input type="text" name="FullSuppliesControlNoEdit" id="FullSuppliesControlNoEdit" class="border border-gray-400 p-2 rounded w-full mb-2" placeholder="Control Number">


                        <div class="flex justify-end space-x-2">
                            <button type="button" id="saveFullSuppButton" class="bg-green-500 hover:bg-green-600 text-white p-2 rounded">Save</button>
                            <button type="button" id="deleteFullSuppButton" class="bg-red-500 hover:bg-red-600 text-white p-2 rounded">Delete</button>
                        </div>
                    </form>
                </div>
            </div>
            <!-- END OF Edit 2 Popup Card -->

            <!-- Add Pop Up Card -->

            <!-- END OF Add Pop Up Card -->

            <!-- View 2 Table Pop Up Card -->
            @foreach($supplies as $item)
            <div id="ViewFullSuppModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 hidden" data-id="{{$item->id}}">
                <div class="bg-white p-4 rounded-lg shadow-lg max-w-md w-full">
                    <div class="flex justify-between items-center mb-4">
                        <h2 class="text-lg font-semibold">Final Viewing</h2>
                        <button id="closeViewFullSuppModal" class="text-gray-500 hover:text-gray-700">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                    <div class="text-sm text-gray-700 mb-4" id=SuppliesDetails>>
                        <p><strong>Serial Number:</strong>{{$item->SuppliesSerialNo}}</p>
                        <p><strong>Control Number:</strong>{{$item->SuppliesControlNo}}</p>
                        <p><strong>Brand Name:</strong>{{$item->SuppliesBrandName}}</p>
                        <p><strong>Product Name:</strong>{{$item->SuppliesName}}</p>
                        <p><strong>Category:</strong>{{$item->SuppliesCategory}}</p>
                        <p><strong>Type:</strong>{{$item->SuppliesType}}</p>
                        <p><strong>Color:</strong>{{$item->SuppliesColor}}</p>
                        <p><strong>Unit:</strong>{{$item->SuppliesUnit}}</p>
                        <p><strong>Unit Price:</strong>₱{{number_format($item->SuppliesUnitPrice, 2)}}</p>
                        <p><strong>Classification:</strong>{{$item->SuppliesClassification}}</p>
                        <p><strong>Date:</strong>{{$item->SuppliesDate}}</p>
                    </div>

                </div>
            </div>
            @endforeach
            <!-- END OF View 2 Table Pop Up Card -->
        </div>
    </div>
    <!-- Popup Card -->
</section>
@endsection