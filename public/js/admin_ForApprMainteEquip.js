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
    // Example serial numbers (replace this with dynamic data if needed)
    const serialNumbers = ['SN12345', 'SN23456', 'SN34567', 'SN45678', 'SN56789'];

    // Reference the dropdown
    const $serialDropdown = $('.js-serial-number');

    // Populate the dropdown with serial numbers
    serialNumbers.forEach(serial => {
        $serialDropdown.append(`<option value="${serial}">${serial}</option>`);
    });

    // Initialize Select2 for the searchable dropdown
    $serialDropdown.select2({
        placeholder: "Search Serial Number", // Placeholder text
        allowClear: true,                    // Allow clearing the selection
        width: '100%',                        // Set dropdown width
        height: '100%'
    });
});


// ======================= ADD REQUEST ========================== //
$(document).ready(function () {
    $('#MainteEquipmentREQFormButton').click(function () {
        event.preventDefault();
        console.log('Add Request Button is Clicked.');
        $('#MainteEquipmentFormBtn').removeClass('hidden');
    });

    $('#CloseMainteEquipForm').click(function () {
        console.log('Close Button is Clicked.');
        $('#MainteEquipmentFormBtn').addClass('hidden');
    });

    $('#closeAddReqMainteEquipInventoryPopupCard').click(function () {
        console.log('Close "X" Button is Clicked.');
        $('#MainteEquipmentFormBtn').addClass('hidden');
    });

    $("#SubmitMainteEquipForm").click(function () {
        Swal.fire({
            icon: 'success',
            title: 'Submitted',
            text: 'Your action has been successfully submitted',
            confirmButtonText: 'OK',
            confirmButtonColor: '#3085d6'
        }).then(() => {
            $("#MainteEquipmentFormBtn").addClass("hidden");
        });
    });

    // Go to Step 2
    $('#MainteEquipGoToStep2').click(function () {
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


     // Add a new inventory row to the table
    $('#MainteEquipAddRowBtn').click(function () {
        const newRow = `
            <tr class="MaintenanceEquip-Rows">
                <td class="  p-2">
                    <input type="text" class="w-full   rounded p-2" placeholder="Serial Number">
                </td>
                <td class="p-2">
                    <input type="text" class="w-full  rounded p-2" placeholder="Control Number">
                </td>
                <td class=" p-2 text-center">
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
        $('#MaintenanceEquip-TablBody').append(newRow);
    });

    $('#MaintenanceEquip-TablBody').on('click', '.MainteEquipDelete-row-btn', function () {
        $(this).closest('tr').remove();
    });

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
