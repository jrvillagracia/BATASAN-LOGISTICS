@extends('adminLayouts.admin_sidebarLayout')

@section('title', 'Equipment Condemned | BHNHS')

@section('content')

<section>
    <div class="flex items-center pb-8">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" strokeWidth="1.5" stroke="currentColor" class="w-9 h-9">
            <path strokeLinecap="round" strokeLinejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
        </svg>
        <h1 class="text-3xl font-bold ml-2">Inventory Equipment</h1>
    </div>

    <!-- Breadcrumb -->
    <nav class="flex px-5 py-3 text-gray-700 border border-gray-200 rounded-lg bg-gray-50" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
            <li class="inline-flex items-center">
                <a href="{{ route('admin_StockInEquipment') }}" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600 ">
                    Inventory
                </a>
            </li>
            <li>
                <div class="flex items-center">
                    <svg class="rtl:rotate-180 block w-3 h-3 mx-1 text-gray-400 " aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4" />
                    </svg>
                    <a href="#" class="ms-1 text-sm font-medium text-gray-700 hover:text-blue-600 md:ms-2 ">Condemned</a>
                </div>
            </li>
            <!-- Add additional breadcrumbs here -->
        </ol>
    </nav>

    <!-- Add additional content here -->
    <div class="bg-gray-100 h-auto rounded-lg ">

        <div class="flex justify-between items-center mt-4 px-9 py-2">
            <!-- Left-Aligned Buttons -->
            <div id="tabs-container" class="relative">
                <a href="{{ route('admin_StockInEquipment') }}" class="pageloader button border-b-2 py-2 px-4 transition-all duration-300 translate-x-2">Stock In</a>
                <a href="{{ route('admin_EQUIPMENT')}}" class="pageloader button border-b-2 py-2 px-4 transition-all duration-300 translate-x-2">Equipment</a>
                <a href="{{ route('admin_equipCondemned') }}" class="pageloader button border-b-2 border-blue-500 py-2 px-4 transition-all duration-300 translate-x-2">Condemned</a>
                {{-- <a href="{{ route('admin_equipHistory')}}" class="pageloader button border-b-2 py-2 px-4 transition-all duration-300 translate-x-2">History</a> --}}
                <a href="{{ route('admin_equipUsed')}}" class="pageloader button border-b-2 py-2 px-4 transition-all duration-300 translate-x-2">Used</a>
            </div>



            <!-- Search Bar -->
            <div class=" flex items-center space-x-4">

                <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 w-full sr-only dark:text-white">Search</label>
                <div class="relative w-96">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                        </svg>
                    </div>
                    <input type="search" id="default-search" class="block w-full p-4 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search" required />
                </div>

                <!-- Add Item Button -->
                <button id="EquipCondExportBTN" class="bg-blue-500 text-white p-2 rounded hover:bg-blue-600">Export</button>
                <button id="EquipCondSelectAllBTN" class="bg-blue-500 text-white p-2 rounded hover:bg-blue-600">Select All</button>
            </div>
        </div>

        <!-- Floating Card with Form (Initially Hidden) -->


        <!-- Table -->
        <div class="relative shadow-md sm:rounded-lg px-9 py-5">
            <table id="dynamicTable" class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400k">
                <thead class="text-sm text-white dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">

                        </th>
                        <th scope="col" class="px-6 py-3">
                            Brand Name
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Product Name
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
                            Facility
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Action
                        </th>
                    </tr>
                </thead>
                <tbody id="tableBody" class="">
                    @foreach($equipment as $item)
                    <tr class="odd:bg-blue-100  even:bg-white border-b " data-brand="{{$item->EquipmentBrandName}}" data-id="{{ $item->equipcondemId}}">
                        <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            <input id="EQUIPMENTCheckBox" type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 ">
                        </td>
                        <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap ">{{$item->EquipmentBrandName}}</td>
                        <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap ">{{$item->EquipmentName}}</td>
                        <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap ">{{$item->EquipmentCategory}}</td>
                        <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap ">{{$item->EquipmentQuantity}}</td>
                        <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap ">₱{{number_format($item->totalPrice, 2)}}</td>
                        <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap ">{{$item->EquipmentSKU}}</td>
                        <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap ">Offices</td>
                        <td class="px-6 py-4">
                            <button id="viewCondEquipButton" data-id="{{ $item->equipcondemId}}" data-brand="{{$item->EquipmentBrandName}}" type="button">
                                <svg class="w-[27px] h-[27px] text-green-600 " aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-width="2" d="M21 12c0 1.2-4.03 6-9 6s-9-4.8-9-6c0-1.2 4.03-6 9-6s9 4.8 9 6Z" />
                                    <path stroke="currentColor" stroke-width="2" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                </svg>
                            </button>
                        </td>
                    </tr>
                    @endforeach
                    <!-- Dynamic rows will be inserted here -->
                </tbody>
            </table>

            <!-- Edit Popup Card -->


            <!-- View Popup Card -->
            <div id="ViewCondEquipModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 hidden">
                <div class="bg-white p-4 rounded-lg shadow-lg max-w-3xl w-full max-h-[90vh] overflow-y-auto"> <!-- Updated width and height -->
                    <div class="flex justify-between items-center mb-4">
                        <h2 class="text-lg font-semibold px-7">View Full Information</h2>
                        <button id="closeViewCondEquipModal" class="text-gray-500 hover:text-gray-700">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>

                    @if($equipment->isNotEmpty())
                    <div class="relative shadow-md sm:rounded-lg px-9 py-5">
                        <div class="grid grid-cols-2 gap-1 px-4 text-sm text-gray-700 mb-4" id="equipmentDetails">
                            <div><strong>Brand Name:</strong>{{$item->EquipmentBrandName}}</div>
                            <div><strong>Color:</strong>{{$item->EquipmentColor}}</div>
                            <div><strong>Product Name:</strong>{{$item->EquipmentName}}</div>
                            <div><strong>Unit:</strong>{{$item->EquipmentUnit}}</div>
                            <div><strong>Category:</strong>{{$item->EquipmentCategory}}</div>
                            <div><strong>Unit Price:</strong>{{$item->EquipmentUnitPrice}}</div>
                            <div><strong>SKU:</strong>{{$item->EquipmentSKU}}</div>
                            <div><strong>Classification:</strong>{{$item->EquipmentClassification}}</div>
                            <div><strong>Type:</strong>{{$item->EquipmentType}}</div>
                            <div><strong>Date:</strong>{{$item->EquipmentDate}}</div>
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
                                    <input type="search" id="equipSearch" name="equipSearch" class="block w-64 p-4 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500  dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search" />
                                </div>

                                <!-- Buttons -->

                                <button id="ViewEquipCondExportBTN" class="bg-blue-500 text-white p-2 rounded hover:bg-blue-600">Export</button>
                                <button id="ViewEquipCondSelectAllBTN" class="bg-blue-500 text-white p-2 rounded hover:bg-blue-600">Select All</button>
                            </form>
                        </div>

                        <div class="overflow-x-auto"> <!-- Added for horizontal scrolling if needed -->
                            <table id="ViewDynamicTable" class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                <thead class="text-sm text-white dark:text-gray-400">
                                    <tr>
                                        <th scope="col" class="px-6 py-3">
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Serial Number
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Control Number
                                        </th>
                                    </tr>
                                </thead>
                                <tbody id="tableViewBody">
                                    @foreach($equipment as $item)
                                    <tr class="odd:bg-blue-100 even:bg-white  border-b " data-id="">
                                        <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap ">
                                            <input id="ViewEQUIPMENTCondCheckBox" type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 ">
                                        </td>
                                        <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap ">{{$item->EquipmentSerialNo}}</td>
                                        <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap ">{{$item->EquipmentControlNo}}</td>
                                    </tr>
                                    @endforeach
                                    <!-- Dynamic rows will be inserted here -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            @else
            <p class="text-center text-gray-500">No equipment details available.</p>
            <!-- END OF View 1 Popup Card -->
            @endif

            <!-- View Data Export Button Card-->
        <div id="CondEquipDataIncludedModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
            <div class="bg-white rounded-lg shadow-lg p-6 w-96">
                <h2 class="text-lg font-semibold mb-4">Data Included</h2>

                <!-- Checklist Section -->
                <div id="CondCheckboxGroup" class="grid grid-cols-2 gap-4">
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
                    <label class="flex items-center space-x-2">
                        <input type="checkbox" class="rounded text-blue-500 focus:ring-blue-500">
                        <span class="text-sm">User Name</span>
                    </label>
                    <label class="flex items-center space-x-2">
                        <input type="checkbox" class="rounded text-blue-500 focus:ring-blue-500">
                        <span class="text-sm">User ID</span>
                    </label>
                    <label class="flex items-center space-x-2">
                        <input type="checkbox" class="rounded text-blue-500 focus:ring-blue-500">
                        <span class="text-sm">Building Name</span>
                    </label>
                    <label class="flex items-center space-x-2">
                        <input type="checkbox" class="rounded text-blue-500 focus:ring-blue-500">
                        <span class="text-sm">Room</span>
                    </label>
                    <label class="flex items-center space-x-2">
                        <input type="checkbox" class="rounded text-blue-500 focus:ring-blue-500">
                        <span class="text-sm">Facility</span>
                    </label>
                    <label class="flex items-center space-x-2">
                        <input type="checkbox" class="rounded text-blue-500 focus:ring-blue-500">
                        <span class="text-sm">Date Used</span>
                    </label>
                </div>

                <!-- Buttons -->
                <div class="flex justify-between mt-4">
                    <button id="VIEWCondselectAllBtn" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">Select All</button>
                    <button id="VIEWCondexportFileBtn" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded">Export File</button>
                    <button id="VIEWCondcancelBtn" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded">Cancel</button>
                </div>
            </div>
        </div>
        <!-- END OF View Data Export Button Card -->
        </div>
    </div>
</section>
@endsection