// FUNCTION TO DISABLE THE PAST DATES/MONTHS
document.addEventListener("DOMContentLoaded", function () {
    // ... your existing formatDate function ...

    const currentDate = new Date();
    const maxDate = new Date();
    maxDate.setFullYear(maxDate.getFullYear() + 1);

    //Format both date and time
    const formattedDate = formatDate(currentDate);
    const formattedTime = currentDate.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' }); // Adjust format as needed

    const datepickerInput = document.getElementById("ReqSuppDate");

    //Set the value of the input field
    datepickerInput.value = `${formattedDate} ${formattedTime}`;

    datepickerInput.setAttribute("datepicker-min-date", formatDate(currentDate));
    datepickerInput.setAttribute("datepicker-max-date", formatDate(maxDate));


    // Initialize the datepicker (assuming a library is used)
    datepickerInput.datepicker = new Datepicker(datepickerInput, {
        minDate: currentDate,
        maxDate: maxDate,
        autoselectToday: true,
        // Add defaultDate if your library supports it:
        defaultDate: `${formattedDate} ${formattedTime}`, //Check your library documentation!
    });
});


// ======================== ADD A REQUEST BUTTON FORM ============================= //
$(document).ready(function () {
    // Show Request Supplies Form
    $('#ReqSupFormBtn').click(function (event) {
        event.preventDefault();
        console.log('Show Request Supplies Button Clicked');
        $('#ReqSupFormCard').removeClass('hidden');
    });

    // Set current date and time in the form fields
    const currentDate = new Date();
    const formattedDate = currentDate.toISOString().split('T')[0]; // YYYY-MM-DD format
    const formattedTime = currentDate.toTimeString().split(':').slice(0, 2).join(':'); // HH:mm format

    $('#ReqSuppDate').val(formattedDate);
    $('#ReqSuppTime').val(formattedTime);

    // Close Request Supplies Form
    $('#ReqSupCloseFormBtn, #ReqSupCancelFormBtn').click(function (event) {
        event.preventDefault();
        console.log('Close Request Supplies Button Clicked');
        $('#ReqSupFormCard').addClass('hidden');
    });

    // Submit Form and Reload Page
    $("#ReqSupSubmitFormBtn").click(function (event) {
        event.preventDefault(); // Prevent default form submission behavior

        // Collect form data
        let formData = {
            ReqSuppDate: $("#ReqSuppDate").val(),
            ReqSuppTime: $("#ReqSuppTime").val(),
            ReqSuppliesRequestOffice: $("#ReqSuppliesRequestOffice").val(),
            ReqSuppBldName: $("#ReqSuppBldName").val(),
            ReqSuppRoom: $("#ReqSuppRoom").val(),
            ReqSupRequestFOR: $("#ReqSupRequestFOR").val(),
            ReqSupCategoryName: $("#ReqSupCategoryName").val(),
            ReqSupType: $("#ReqSupType").val(),
            ReqSupUnit: $("#ReqSupUnit").val(),
            ReqSupQuantity: $("#ReqSupQuantity").val(),
        };

        $.ajax({
            url: "/requestSupplies/store", 
            type: "POST",
            data: formData,
            success: function (response) {
                if (response.status === "success") {
                    Swal.fire({
                        icon: "success",
                        title: "Submit",
                        text: "Successfully Added to the table",
                        confirmButtonText: "OK",
                        confirmButtonColor: "#3085d6",
                    }).then(() => {
                        location.reload(); 
                    });
                }
            },
            error: function (xhr) {
                console.log(xhr.responseText)
                Swal.fire({
                    icon: "error",
                    title: "Error",
                    text: "Failed to add item. Please try again.",
                });
            },
        });
    });

    // Step Navigation - Go to Step 2
    $('#RequestSuppGoToStep2').click(function () {
        const requiredFields = [
            '#ReqSuppliesRequestOffice',
            '#ReqSuppBldName',
            '#ReqSuppRoom',
            '#ReqSupRequestFOR',
        ];
        let isValid = true;
        requiredFields.forEach(field => {
            //Using trim() here is important to handle whitespace-only inputs
            if (!$(field).val()) { 
                isValid = false;
                $(field).addClass('border-red-500');
            } else {
                $(field).removeClass('border-red-500');
            }
        });
    
        if (isValid) {
        $('#RequestSuppStep1Content').addClass('hidden');
        $('#RequestSupStep2Content').removeClass('hidden');
        $('#RequestSuppStep1Icon').addClass('text-gray-500').removeClass('text-blue-600');
        $('#RequestSuppStep2Icon').addClass('text-blue-600').removeClass('text-gray-500');
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Validation Error',
                text: 'Please fill in all required fields in Step 1.',
                confirmButtonText: 'OK',
                confirmButtonColor: '#d33'
            });
        }
    });

    // Step Navigation - Go back to Step 1
    $('#RequestSupBackToStep1').click(function () {
        $('#RequestSupStep2Content').addClass('hidden');
        $('#RequestSuppStep1Content').removeClass('hidden');
        $('#RequestSuppStep2Icon').addClass('text-gray-500').removeClass('text-blue-600');
        $('#RequestSuppStep1Icon').addClass('text-blue-600').removeClass('text-gray-500');
    });

    // Add a new row to the inventory table
    $('#RequestSupAddRowBtn').click(function () {
        const newRow = `
            <tr class="RequestSup-Rows">
                <td class="p-2">
                    <select id="ReqSupCategoryName" name="ReqSupCategoryName" class="w-full px-2 py-1 border border-gray-400 rounded">
                        <option value="ReqSupCategoryName" disabled selected>Select Category</option>
                        <option value="Laptop">Laptop</option>
                        <option value="Printer">Printer</option>
                    </select>
                </td>
                <td class="p-2">
                    <select id="ReqSupType" name="ReqSupType" class="w-full px-2 py-1 border border-gray-400 rounded">
                        <option value="ReqSupType" disabled selected>Select Type</option>
                        <option value="64gb">64gb</option>
                        <option value="Nikon">Nikon</option>
                    </select>
                </td>
                <td class="p-2">
                    <select id="ReqSupUnit" name="ReqSupUnit" class="w-full px-2 py-1 border border-gray-400 rounded">
                        <option value="ReqSupUnit" disabled selected>Select Unit</option>
                        <option value="Box">Box</option>
                        <option value="Unit">Unit</option>
                    </select>
                </td>
                <td class="p-2 flex justify-center">
                    <input type="number" id="ReqSupQuantity" class="w-20 border rounded p-2" placeholder="">
                </td>
                <td class="p-2 text-center">
                    <button type="button" class="RequestSupDelete-row-btn text-red-500 hover:text-red-700">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </td>
            </tr>`;
        $('#RequestSup-TablBody').append(newRow);
    });

    // Delete a row from the inventory table
    $('#RequestSup-TablBody').on('click', '.RequestSupDelete-row-btn', function () {
        $(this).closest('tr').remove();
    });
});




// ======================== FOR APPROVAL MODULE ============================= //
// VIEW BUTTON CARD FORM 
$(document).ready(function () {
    $('#ViewSupBtn').click(function () {
        console.log('View Supplies Button is Clicked.');
        $('#ViewReqSuppliesPopupCard').removeClass('hidden');
    });

    $('#closeReqViewSuppliesPopupCard').click(function () {
        console.log('Close "X" Supplies Button is Clicked.');
        $('#ViewReqSuppliesPopupCard').addClass('hidden');
    });

    $('#cancelReqSuppliesInventoryPopupCard').click(function () {
        console.log('Cancel Supplies Button is Clicked.');
        $('#ViewReqSuppliesPopupCard').addClass('hidden');
    });

    

    $("#saveReqSuppliesInventoryPopupCard").click(function () {
        Swal.fire({
            icon: 'success',
            title: 'Submitted',
            text: 'Your action has been successfully submitted',
            confirmButtonText: 'OK',
            confirmButtonColor: '#3085d6'
        }).then(() => {
            $("#ViewReqSuppliesPopupCard").addClass("hidden");
        });
    });
});



// APPROVE BUTTON CARD FORM
$(document).ready(function () {
    $("#ApprSupBtn").click(function () {
        $("#ApprReqSupPopupCard").removeClass("hidden");
    });

    $("#closeApprReqSupPopupCard").click(function () {
        $("#ApprReqSupPopupCard").addClass("hidden");
    });

    // Hide the popup and show Submitted message when Submit button is clicked
    $("#submitApprReqSupPopupCard").click(function () {
        Swal.fire({
            icon: 'success',
            title: 'Submitted',
            text: 'Your action has been successfully submitted',
            confirmButtonText: 'OK',
            confirmButtonColor: '#3085d6'
        }).then(() => {
            $("#ApprReqSupPopupCard").addClass("hidden");
        });
    });
});


// DECLINE BUTTON CARD FORM
$(document).ready(function () {
    // Show the popup when the button is clicked
    $("#DclnSupBtn").click(function () {
        $("#DclnSupPopupCard").removeClass("hidden");
    });

    $("#closeDclnSupPopupCard").click(function () {
        $("#DclnSupPopupCard").addClass("hidden");
    });

    // Hide the popup and show Submitted message when Submit button is clicked
    $("#submitDclnSupPopupCard").click(function () {
        Swal.fire({
            icon: 'success',
            title: 'Submitted',
            text: 'Your reason has been submitted',
            confirmButtonText: 'OK',
            confirmButtonColor: '#3085d6'
        }).then(() => {
            $("#DclnSupPopupCard").addClass("hidden");
        });
    });
});
// ========================================== //


// SET ITEM BUTTON CARD
$(document).ready(function () {
    $('#SetItemSupBtn').click(function () {
        console.log('View Equipment Button is Clicked.');
        $('#SetItemReqSupPopupCard').removeClass('hidden');
    });

    $('#closeSetItemReqViewSupPopupCard').click(function () {
        console.log('Close "X" Set Item Equipment Button is Clicked.');
        $('#SetItemReqSupPopupCard').addClass('hidden');
    });

    $('#SetItemCancelSupBTN').click(function () {
        console.log('Close Cancel Set Item Button is Clicked.');
        $('#SetItemReqSupPopupCard').addClass('hidden');
    });

    $("#SetItemSubmitSupBTN").click(function () {
        Swal.fire({
            icon: 'success',
            title: 'Submitted',
            text: 'Successfully Set Item!',
            confirmButtonText: 'OK',
            confirmButtonColor: '#3085d6'
        }).then(() => {
            $("#SetItemReqSupPopupCard").addClass("hidden");
        });
    });
});


// ======================== DATATABLES ============================= //
// MAIN TABLE DATATABLES
document.addEventListener("DOMContentLoaded", function () {
    // Check if the table exists and simple-datatables is loaded
    if (document.getElementById("reqSuppTable") && typeof simpleDatatables !== 'undefined') {
        const dataTable = new simpleDatatables.DataTable("#reqSuppTable", {
            searchable: false,
            perPageSelect: [5, 10, 20, 50],
            perPage: 5,
            firstLast: true,
            nextPrev: true,
            sortable: true,

            labels: {
                info: "Showing <strong>{start}</strong> - <strong>{end}</strong> of <strong>{rows}</strong>",
            }
        });

        // document.getElementById("SuppliesSearch").addEventListener("keyup", function() {
        //     let searchTerm = this.value;
        //     dataTable.search(searchTerm);
        // });
    }
});


//Get the Building and Room
$(document).ready(function () {
    // Fetch buildings and rooms via AJAX
    $.ajax({
        url: '/buildings-rooms',
        method: 'GET',
        success: function (data) {
            // Populate Building dropdown
            const buildingDropdown = $("#ReqSuppBldName");
            buildingDropdown.empty().append('<option disabled selected>Select Building</option>');

            const roomsByBuilding = {};

            data.forEach(function (room) {
                if (!roomsByBuilding[room.BldName]) {
                    roomsByBuilding[room.BldName] = [];
                    buildingDropdown.append(`<option value="${room.BldName}">${room.BldName}</option>`);
                }
                roomsByBuilding[room.BldName].push(room.Room);
            });

            // Filter Room dropdown based on selected building
            $("#ReqSuppBldName").change(function () {
                const selectedBuilding = $(this).val();
                const roomDropdown = $("#ReqSuppRoom");
                roomDropdown.empty().append('<option disabled selected>Select Room</option>');

                if (roomsByBuilding[selectedBuilding]) {
                    roomsByBuilding[selectedBuilding].forEach(function (room) {
                        roomDropdown.append(`<option value="${room}">Room ${room}</option>`);
                    });
                }
            });
        },
        error: function () {
            alert('Failed to fetch data!');
        }
    });
});

//Get Departments
$(document).ready(function () {
    // Make an AJAX request to the API
    $.ajax({
        url: 'https://bnhs-hr.onrender.com/api/all/departments', 
        method: 'GET',
        headers: {
            'x-api-key': 'Ru8NWgJalpjcZ1T53i10Z5Jp4xdQoKdU90dq8zLHC1ZrGMxwbl4XToKg0sb7JCv9',
        },
        success: function (data) {
            const departmentDropdown = $("#ReqSuppliesRequestOffice");
            departmentDropdown.empty().append('<option value="" disabled selected>Select Office/Unit</option>');

            // Loop through the API data and append each department as an option
            data.forEach(function(department) {
                departmentDropdown.append(`<option value="${department.name}">${department.name}</option>`);
            });
        },
        error: function (error) {
            console.error("Error fetching departments:", error);
            alert('Failed to load departments. Please try again later.');
        }
    });
});


// Get Supplies
$(document).ready(function () {
    $.ajax({
        url: '/get/supplies',
        type: 'GET',
        success: function (data) {
            populateCategories(data);
        },
        error: function (xhr) {
            console.log(xhr.responseText);
            alert('Failed to fetch data!');
        }
    });

    // Function to populate categories
    function populateCategories(items) {
        const categoryDropdown = $("#ReqSupCategoryName"); // Changed selector
        categoryDropdown.prop('disabled', false);

        // Get unique categories from the items
        const categories = [...new Set(items.map(item => item.SuppliesCategory))];

        // Populate the category dropdown
        categories.forEach(function (category) {
            categoryDropdown.append(`<option value="${category}">${category}</option>`);
        });

        // Handle category selection change
        categoryDropdown.change(function () {
            const selectedCategory = $(this).val();

            // Reset and disable type and unit dropdowns
            const typeDropdown = $("#ReqSupType"); // Changed selector
            typeDropdown.empty().append('<option disabled selected>Select Type</option>').prop('disabled', true);

            const unitDropdown = $("#ReqSupUnit"); // Changed selector
            unitDropdown.empty().append('<option disabled selected>Select Unit</option>').prop('disabled', true);

            if (selectedCategory) {
                populateTypes(items, selectedCategory);
            }
        });
    }

    // Function to populate types
    function populateTypes(items, selectedCategory) {
        const typeDropdown = $("#ReqSupType"); // Changed selector
        typeDropdown.prop('disabled', false);

        // Filter types based on the selected category
        const types = [...new Set(items.filter(item => item.SuppliesCategory === selectedCategory).map(item => item.SuppliesType))];

        // Populate the type dropdown
        types.forEach(function (type) {
            typeDropdown.append(`<option value="${type}">${type}</option>`);
        });

        // Handle type selection change
        typeDropdown.change(function () {
            const selectedType = $(this).val();

            // Reset and disable unit dropdown
            const unitDropdown = $("#ReqSupUnit"); // Changed selector
            unitDropdown.empty().append('<option disabled selected>Select Unit</option>').prop('disabled', true);

            if (selectedType) {
                populateUnits(items, selectedCategory, selectedType);
            }
        });
    }

    // Function to populate units
    function populateUnits(items, selectedCategory, selectedType) {
        const unitDropdown = $("#ReqSupUnit"); // Changed selector
        unitDropdown.prop('disabled', false);

        // Filter units based on the selected category and type
        const units = [...new Set(items.filter(item => 
            item.SuppliesCategory === selectedCategory && item.SuppliesType === selectedType
        ).map(item => item.SuppliesUnit))];

        // Populate the unit dropdown
        units.forEach(function (unit) {
            unitDropdown.append(`<option value="${unit}">${unit}</option>`);
        });
    }
});