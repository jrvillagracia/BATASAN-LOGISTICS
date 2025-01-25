// FUNCTION TO DISABLE THE PAST DATES/MONTHS
document.addEventListener("DOMContentLoaded", function () {
    // Get the current date
    const currentDate = new Date();

    // Format the date as MM/DD/YYYY
    const formatDate = (date) => {
        const dd = String(date.getDate()).padStart(2, '0');
        const mm = String(date.getMonth() + 1).padStart(2, '0'); // Months are zero-based
        const yyyy = date.getFullYear();
        return `${mm}/${dd}/${yyyy}`;
    };

    // Calculate max date (e.g., one year from today)
    const maxDate = new Date();
    maxDate.setFullYear(maxDate.getFullYear() + 1);

    // Initialize the input field with min and max dates
    const datepickerInput = document.getElementById("MainteEquipDate");
    datepickerInput.setAttribute("datepicker-min-date", formatDate(currentDate));
    datepickerInput.setAttribute("datepicker-max-date", formatDate(maxDate));

    // Initialize the datepicker (assuming a library like Flowbite/Flatpickr is being used)
    datepickerInput.datepicker = new Datepicker(datepickerInput, {
        minDate: currentDate,
        maxDate: maxDate,
        autoselectToday: true,
    });
});


// ======================= SEARCH SERIAL NUMBER FUNCTION IN ADD REQUEST ========================== //
$(document).ready(function () {
    let equipmentData = []; // Store fetched equipment data globally
    const selectedSerialNumbers = new Set(); // Track selected serial numbers

    // Fetch serial numbers and control numbers via AJAX
    function fetchEquipmentData() {
        $.ajax({
            url: '/get/equipments', // Adjust the URL to match your API endpoint
            method: 'GET',
            success: function (data) {
                equipmentData = data; // Store the data for reuse
                initializeDropdowns($('.js-serial-number')); // Initialize existing dropdowns
            },
            error: function () {
                alert('Failed to fetch equipment data!');
            }
        });
    }

    // Initialize dropdowns with fetched data
    function initializeDropdowns($dropdowns) {
        $dropdowns.each(function () {
            const $dropdown = $(this);
            populateDropdown($dropdown);
        });

        // Bind change event to update control numbers and disable selected serials in other dropdowns
        $dropdowns.off('change').on('change', function () {
            const selectedSerial = $(this).val();
            const equipment = equipmentData.find(e => e.EquipmentSerialNo === selectedSerial);
            if (equipment) {
                $(this).closest('tr').find('input[type="text"]').val(equipment.EquipmentControlNo);
                $('#equipmentStockId').val(equipment.equipmentStockId); // Set the equipmentStockId
            }

            // Update the selected serial number set
            if (selectedSerial) {
                selectedSerialNumbers.add(selectedSerial);
            }

            // Disable selected serials in other dropdowns
            disableSelectedSerials();
        });
    }

    // Populate a dropdown with equipment data
    function populateDropdown($dropdown) {
        $dropdown.empty().append('<option disabled selected>Select Serial Number</option>');
        equipmentData.forEach(function (equipment) {
            $dropdown.append(`<option value="${equipment.EquipmentSerialNo}">${equipment.EquipmentSerialNo}</option>`);
        });
    }

    // Disable selected serial numbers in all dropdowns
    function disableSelectedSerials() {
        $('.js-serial-number').each(function () {
            const $dropdown = $(this);
            const currentValue = $dropdown.val();

            $dropdown.find('option').each(function () {
                const $option = $(this);
                if (selectedSerialNumbers.has($option.val()) && $option.val() !== currentValue) {
                    $option.prop('disabled', true); // Disable the option
                } else {
                    $option.prop('disabled', false); // Enable the option
                }
            });
        });
    }

    // Fetch equipment data on page load
    fetchEquipmentData();

    // Add a new row dynamically
    $('#MainteEquipAddRowBtn').on('click', function () {
        const newRow = `
            <tr class="MaintenanceEquip-Rows">
                <td class="p-2">
                    <select class="js-serial-number w-full rounded p-2">
                        <!-- Options will be dynamically loaded -->
                    </select>
                </td>
                <td class="p-2">
                    <input type="text" class="w-full rounded p-2" placeholder="Control Number">
                </td>
                <td class="p-2 text-center">
                    <button id="viewMainteEquipReqBTN" type="button">
                        <svg class="w-[27px] h-[27px] text-green-600 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-width="2" d="M21 12c0 1.2-4.03 6-9 6s-9-4.8-9-6c0-1.2 4.03-6 9-6s9 4.8 9 6Z" />
                            <path stroke="currentColor" stroke-width="2" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                        </svg>
                    </button>
                    <button type="button" class="MainteEquipDelete-row-btn text-red-500 hover:text-red-700">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </td>
            </tr>`;

        // Append the new row to the table body
        $('#MaintenanceEquip-TablBody').append(newRow);

        // Initialize the dropdown in the newly added row
        const $newDropdown = $('#MaintenanceEquip-TablBody').find('.js-serial-number').last();
        populateDropdown($newDropdown);
        initializeDropdowns($newDropdown); // Apply equipment data and event listeners
        $newDropdown.select2({
            placeholder: "Search Serial Number",
            allowClear: true,
            width: '100%',
        });
    });

    // Delete a row
    $('#MaintenanceEquip-TablBody').on('click', '.MainteEquipDelete-row-btn', function () {
        const $row = $(this).closest('tr');
        const selectedValue = $row.find('.js-serial-number').val();

        // Remove the selected value from the tracking set
        if (selectedValue) {
            selectedSerialNumbers.delete(selectedValue);
        }

        // Remove the row
        $row.remove();

        // Update dropdown options to reflect the removal
        disableSelectedSerials();
    });
});




// ======================= ADD REQUEST ========================== //
$(document).ready(function () {
    // Handle the Add Request button click
    $('#MainteEquipmentREQFormButton').click(function (event) {
        event.preventDefault();
        console.log('Add Request Button is Clicked.');

        $('#MainteEquipmentFormBtn').removeClass('hidden');

        const currentDate = new Date();
        const formattedDate = currentDate.toISOString().split('T')[0];
        const formattedTime = currentDate.toLocaleTimeString('en-US', { hour: '2-digit', minute: '2-digit', hour12: false });

        $('#MainteEquipDate').val(formattedDate);
        $('#MainteEquipTime').val(formattedTime);
    });

    // Handle the Close button click
    $('#CloseMainteEquipForm').click(function () {
        console.log('Close Button is Clicked.');
        $('#MainteEquipmentFormBtn').addClass('hidden');
    });

    // Handle the "X" Close button click
    $('#closeAddReqMainteEquipInventoryPopupCard').click(function (event) {
        event.preventDefault();
        console.log('Close "X" Button is Clicked.');
        $('#MainteEquipmentFormBtn').addClass('hidden');
    });

    // Submit form via AJAX
    $('#SubmitMainteEquipForm').click(function (event) {
        event.preventDefault(); // Prevent default form submission

        console.log('Submit Button Clicked.');

        // Collect form data
        const formData = {
            mainteRepairId: $('#mainteRepairId').val(), // Ensure the input field exists
            MainteEquipDate: $('#MainteEquipDate').val(),
            MainteEquipTime: $('#MainteEquipTime').val(),
            MainteEquipReqUnit: $('#MainteEquipReqUnit').val(),
            MainteEquipReqFOR: $('#MainteEquipReqFOR').val(),
            equipmentStockId: $('#equipmentStockId').val() || '', // Ensure equipmentStockId is not null
            _token: $('meta[name="csrf-token"]').attr('content'), // CSRF token for security
        };

        // Validate that required fields are not empty
        let valid = true;
        if (!formData.MainteEquipDate || !formData.MainteEquipTime || !formData.MainteEquipReqUnit || !formData.MainteEquipReqFOR) {
            // Check if fields are empty and apply a red border to them
            if (!formData.MainteEquipReqUnit) {
                $('#MainteEquipReqUnit').css('border', '2px solid red');
                valid = false;
            }
            if (!formData.MainteEquipReqFOR) {
                $('#MainteEquipReqFOR').css('border', '2px solid red');
                valid = false;
            }
            if (!formData.MainteEquipDate) {
                $('#MainteEquipDate').css('border', '2px solid red');
                valid = false;
            }
            if (!formData.MainteEquipTime) {
                $('#MainteEquipTime').css('border', '2px solid red');
                valid = false;
            }
            return;
        }

        // AJAX request to store data if validation passes
        if (valid) {
            $.ajax({
                url: '/mainteEquipment/store', // Replace with your actual route URL
                method: 'POST',
                data: formData,
                success: function (response) {
                    if (response.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Submitted',
                            text: response.message,
                            confirmButtonText: 'OK',
                            confirmButtonColor: '#3085d6'
                        }).then(() => {
                            // Optionally clear the form or close the modal
                            $('#MainteEquipmentFormBtn').addClass('hidden');
                            $('#MaintenanceEquip-TablBody').empty(); // Clear the table rows if needed
                        });
                    }
                },
                error: function (xhr) {
                    console.log(xhr.responseText);
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'An error occurred while processing your request. Please try again.',
                        confirmButtonText: 'OK',
                        confirmButtonColor: '#d33'
                    });
                }
            });
        }
    });

    // Go to Step 2 with validation
    $('#MainteEquipGoToStep2').click(function () {
        // Get values of the fields
        var reqUnit = $('#MainteEquipReqUnit').val();
        var reqFOR = $('#MainteEquipReqFOR').val();

        // Validate that the fields are not empty
        if (reqUnit === '' || reqFOR === '') {
            // If any field is empty, show error message
            Swal.fire({
                icon: 'error',
                title: 'Missing Fields',
                text: 'Please fill out both "Requesting Office/Unit" and "Requesting for" fields before proceeding.',
                confirmButtonText: 'OK',
                confirmButtonColor: '#d33'
            });
            return;
        }

        // Proceed to the next step if validation passes
        $('#MainteEquipStep1Content').addClass('hidden');
        $('#MainteEquipStep2Content').removeClass('hidden');
        $('#MainteEquipStep1Icon').addClass('text-gray-500').removeClass('text-blue-600');
        $('#MainteEquipStep2Icon').addClass('text-blue-600').removeClass('text-gray-500');
    });

    // Go back to Step 1
    $('#MainteEquipBackToStep1').click(function () {
        $('#MainteEquipStep2Content').addClass('hidden');
        $('#MainteEquipStep1Content').removeClass('hidden');
        $('#MainteEquipStep2Icon').addClass('text-gray-500').removeClass('text-blue-600');
        $('#MainteEquipStep1Icon').addClass('text-blue-600').removeClass('text-gray-500');
    });
});


$('#EquipmentSerialNo, #ControlNo').on('change', function () {
    const serialNo = $('#EquipmentSerialNo').val();
    const controlNo = $('#EquipmentControlNo').val();

    if (serialNo && controlNo) {
        $.ajax({
            url: '/getEquipmentDetails',
            method: 'GET',
            data: { SerialNo: serialNo, ControlNo: controlNo },
            success: function (response) {
                if (response.success) {
                    // Populate the form fields with the response data
                    $('#equipmentStockId').val(response.equipmentStockId);
                    $('#EquipmentBrandName').val(response.EquipmentBrandName);
                    $('#EquipmentName').val(response.EquipmentName);
                    $('#EquipmentCategory').val(response.EquipmentCategory);
                    $('#EquipmentType').val(response.EquipmentType);
                    $('#EquipmentColor').val(response.EquipmentColor);
                    $('#EquipmentUnit').val(response.EquipmentUnit);
                    $('#EquipmentQuantity').val(response.EquipmentQuantity);
                    $('#EquipmentUnitPrice').val(response.EquipmentUnitPrice);
                    $('#EquipmentDepartment').val(response.EquipmentDepartment);
                    $('#EquipmentClassification').val(response.EquipmentClassification);
                    $('#EquipmentSKU').val(response.EquipmentSKU);
                    $('#EquipmentSerialNo').val(response.EquipmentSerialNo);
                    // Add more fields as needed
                } else {
                    // Handle case when no equipment found
                    alert('No equipment found with the provided Serial Number and Control Number.');
                }
            },
            error: function () {
                alert('Error fetching equipment information.');
            }
        });
    }
});




// VIEWING BUTTON IN MAINTENANCE REQUEST
$(document).ready(function () {
    $('#viewMainteEquipReqBTN').click(function () {
        console.log('View Equipment Button is Clicked.');
        $('#View-Mainte-Equip-InventoryPopupCard').removeClass('hidden');
    });

    $('#closeView-Mainte-Equip-InventoryPopupCard').click(function () {
        console.log('Close View Equipment Button is Clicked.');
        $('#View-Mainte-Equip-InventoryPopupCard').addClass('hidden');
    });
});


// VIEW BUTTON CARD FORM  
$(document).ready(function () {
    $('#MaintenanceEquipmentViewBTN').click(function () {
        console.log('View Equipment Button is Clicked.');
        $('#ViewMainteInventoryPopupCard').removeClass('hidden');
    });
});


$(document).ready(function () {
    $('#cancelForApprMainteInventoryPopupCard').click(function () {
        console.log('Cancel View Equipment Button is Clicked.');
        $('#ViewMainteInventoryPopupCard').addClass('hidden');
    });
});


// APPROVE BUTTON CARD FORM
$(document).ready(function () {
    $("#MaintenanceEquipmentApproveBTN").click(function () {
        $("#ApprMainteInventoryPopupCard").removeClass("hidden");
    });

    // Hide the popup and show Cancel message when Cancel button is clicked
    $("#closeApprMainteInventoryPopupCard").click(function () {
        Swal.fire({
            icon: 'error',
            title: 'Cancelled',
            text: 'Your action has been cancelled',
            confirmButtonText: 'OK',
            confirmButtonColor: '#D1191A'
        }).then(() => {
            $("#ApprMainteInventoryPopupCard").addClass("hidden");
        });
    });

    // Hide the popup and show Submitted message when Submit button is clicked
    $("#submitApprMainteInventoryPopupCard").click(function () {
        Swal.fire({
            icon: 'success',
            title: 'Submitted',
            text: 'Your action has been successfully submitted',
            confirmButtonText: 'OK',
            confirmButtonColor: '#3085d6'
        }).then(() => {
            $("#ApprMainteInventoryPopupCard").addClass("hidden");
        });
    });
});


// DECLINE BUTTON CARD FORM
$(document).ready(function () {
    // Show the popup when the button is clicked
    $("#MaintenanceEquipmentDeclineBTN").click(function () {
        $("#DclnMainteInventoryPopupCard").removeClass("hidden");
    });

    // Hide the popup and show Cancel message when Cancel button is clicked
    $("#closeDclnMainteInventoryPopupCard").click(function () {
        Swal.fire({
            icon: 'error',
            title: 'Cancelled',
            text: 'Decline process has been cancelled',
            confirmButtonText: 'OK',
            confirmButtonColor: '#3085d6'
        }).then(() => {
            $("#DclnMainteInventoryPopupCard").addClass("hidden");
        });
    });

    // Hide the popup and show Submitted message when Submit button is clicked
    $("#submitDclnMainteInventoryPopupCard").click(function () {
        Swal.fire({
            icon: 'success',
            title: 'Submitted',
            text: 'Your reason has been submitted',
            confirmButtonText: 'OK',
            confirmButtonColor: '#3085d6'
        }).then(() => {
            $("#DclnMainteInventoryPopupCard").addClass("hidden");
        });
    });
});// ========================================== //









// ======================== DATATABLES ============================= //
// MAIN TABLE DATATABLES
document.addEventListener("DOMContentLoaded", function () {
    // Check if the table exists and simple-datatables is loaded
    if (document.getElementById("MainteInventoryTable") && typeof simpleDatatables !== 'undefined') {
        const dataTable = new simpleDatatables.DataTable("#MainteInventoryTable", {
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

        // document.getElementById("MainteEquipmentSearch").addEventListener("keyup", function() {
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
            const buildingDropdown = $("#FacilityBuildingName");
            buildingDropdown.empty().append('<option disabled selected>Select Building</option>');

            const roomsByBuilding = {};

            data.forEach(function (room) {
                if (!roomsByBuilding[room.BldName]) {
                    roomsByBuilding[room.BldName] = [];
                    buildingDropdown.append(`<option value="${room.BldName}">${room.BldName}</option>`);
                }
                roomsByBuilding[room.BldName].push(room);
            });

            // Filter facilityRoomType dropdown based on selected building
            $("#FacilityBuildingName").change(function () {
                const selectedBuilding = $(this).val();
                const facilityTypeDropdown = $("#FacilityType");
                const roomDropdown = $("#FacilityRoom");

                // Reset the FacilityRoomType dropdown
                facilityTypeDropdown.empty().append('<option disabled selected>Select Facility Type</option>');
                roomDropdown.empty().append('<option disabled selected>Select Room</option>');

                // If a building is selected, populate FacilityRoomType dropdown
                if (selectedBuilding && roomsByBuilding[selectedBuilding]) {
                    const facilityTypes = new Set();

                    roomsByBuilding[selectedBuilding].forEach(function (roomData) {
                        facilityTypes.add(roomData.facilityRoomType);
                    });

                    // Add facility types to dropdown
                    facilityTypes.forEach(function (facilityType) {
                        facilityTypeDropdown.append(`<option value="${facilityType}">${facilityType}</option>`);
                    });
                }
            });

            // Filter Room dropdown based on selected building and facility type
            $("#FacilityBuildingName, #FacilityRoomType").change(function () {
                const selectedBuilding = $("#FacilityBuildingName").val();
                const selectedFacilityType = $("#FacilityRoomType").val();
                const roomDropdown = $("#FacilityRoom");

                roomDropdown.empty().append('<option disabled selected>Select Room</option>');

                if (selectedBuilding && roomsByBuilding[selectedBuilding]) {
                    roomsByBuilding[selectedBuilding].forEach(function (roomData) {
                        // Only show rooms that match the selected facility type (if any)
                        if (!selectedFacilityType || roomData.facilityRoomType === selectedFacilityType) {
                            roomDropdown.append(`<option value="${roomData.Room}">Room ${roomData.Room}</option>`);
                        }
                    });
                }
            });

        },
        error: function () {
            alert('Failed to fetch data!');
        }
    });
});



//Automatic Set Date
document.addEventListener("DOMContentLoaded", function () {
    function formatDateToMMDDYYYY(date) {
        const month = String(date.getMonth() + 1).padStart(2, '0');
        const day = String(date.getDate()).padStart(2, '0');
        const year = date.getFullYear();
        return `${month}/${day}/${year}`;
    }

    const today = formatDateToMMDDYYYY(new Date());
    document.getElementById("MainteEquipDate").value = today;
});


//==================== VIEW =======================//
$(document).ready(function () {
    $('#COMREQMaintenanceFacilitytViewBTN').click(function () {
        console.log('View Facility Button is Clicked.');
        $('#COMREQViewMainteFacilityPopupCard').removeClass('hidden');
    });

    $('#closeViewComReqrMainteFacilityPopupCard').click(function () {
        event.preventDefault();
        console.log('Cancel View Facility Button is Clicked.');
        $('#COMREQViewMainteFacilityPopupCard').addClass('hidden');
    });
});


// ======================== DATATABLES ============================= //
// MAIN TABLE DATATABLES
document.addEventListener("DOMContentLoaded", function () {
    // Check if the table exists and simple-datatables is loaded
    if (document.getElementById("MainteFacilityTable") && typeof simpleDatatables !== 'undefined') {
        const dataTable = new simpleDatatables.DataTable("#MainteFacilityTable", {
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

        // document.getElementById("MainteFacilitySearch").addEventListener("keyup", function() {
        //     let searchTerm = this.value;
        //     dataTable.search(searchTerm);
        // });
    }
});





//================================== HISTORY MODULE =============================//



// Export to PDF
$(document).ready(function () {
    $('#printForApprMainteInventoryPopupCard').on('click', function (event) {
        // Prevent default button behavior
        event.preventDefault();

        const element = document.getElementById('view-maintequip-pdf-content');

        // Add an additional HTML element dynamically (e.g., a footer)
        const additionalElement = $('<div id="dynamic-footer" class="text-center mt-4 text-sm text-gray-500">')
            .text('Generated by Logistics Management System © 2025');
        $(element).append(additionalElement);

        // Temporarily hide the buttons
        $('.print-btn').addClass('hidden');
        $('.cancel-btn').addClass('hidden');

        const options = {
            margin: 0.5,
            filename: 'Maintenance Equipment Request Slip.pdf',
            image: { type: 'jpeg', quality: 0.98 },
            html2canvas: {
                scale: 2, // Increase the scale for better quality
                useCORS: true, // Fix for CORS-related rendering issues
            },
            jsPDF: { unit: 'in', format: 'letter', orientation: 'portrait' } // Set portrait orientation
        };

        html2pdf()
            .set(options)
            .from(element)
            .save()
            .then(() => {
                // Remove the dynamically added HTML element after PDF generation
                $('#dynamic-footer').remove();

                // Show the buttons again after PDF generation
                $('.print-btn').removeClass('hidden');
                $('.cancel-btn').removeClass('hidden');
            });
    });
});


//================================== GET DEPARTMENT =============================//
$(document).ready(function () {
    // Make an AJAX request to the API
    $.ajax({
        url: 'https://bnhs-hr.onrender.com/api/all/departments',  // Adjust the URL to match your API endpoint
        method: 'GET',
        headers: {
            'x-api-key': 'Ru8NWgJalpjcZ1T53i10Z5Jp4xdQoKdU90dq8zLHC1ZrGMxwbl4XToKg0sb7JCv9',
        },
        success: function (data) {
            const departmentDropdown = $("#MainteEquipReqUnit");
            departmentDropdown.empty().append('<option value="" disabled selected>Select Office/Unit</option>');

            // Loop through the API data and append each department as an option
            data.forEach(function(department) {
                departmentDropdown.append(`<option value="${department.id}">${department.name}</option>`);
            });
        },
        error: function (error) {
            console.error("Error fetching departments:", error);
            alert('Failed to load departments. Please try again later.');
        }
    });
});
