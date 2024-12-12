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
    const datepickerInput = document.getElementById("ReqSuppDate");
    datepickerInput.setAttribute("datepicker-min-date", formatDate(currentDate));
    datepickerInput.setAttribute("datepicker-max-date", formatDate(maxDate));

    // Initialize the datepicker (assuming a library like Flowbite/Flatpickr is being used)
    datepickerInput.datepicker = new Datepicker(datepickerInput, {
        minDate: currentDate,
        maxDate: maxDate,
        autoselectToday: true,
    });
});


// ======================== ADD A REQUEST BUTTON FORM ============================= //
$(document).ready(function () {
    $('#ReqSupFormBtn').click(function () {
        console.log('Show Request Supplies Button Clicked');
        $('#ReqSupFormCard').removeClass('hidden');
    });

    $('#ReqSupCloseFormBtn').click(function () {
        console.log('Close Request Supplies Button Clicked');
        $('#ReqSupFormCard').addClass('hidden');
    });

    $('#ReqSupCancelFormBtn').click(function () {
        console.log('Close Request Supplies Button Clicked');
        $('#ReqSupFormCard').addClass('hidden');
    });


    $("#ReqSupSubmitFormBtn").click(function () {
        Swal.fire({
            icon: 'success',
            title: 'Submit',
            text: 'Successfully Added to the table',
            confirmButtonText: 'OK',
            confirmButtonColor: '#3085d6'
        }).then(() => {
            $("#ReqSupFormCard").addClass("hidden");
        });
    });

    // Go to Step 2
    $('#RequestSuppGoToStep2').click(function () {
        $('#RequestSuppStep1Content').addClass('hidden');
        $('#RequestSupStep2Content').removeClass('hidden');
        $('#RequestSuppStep1Icon').addClass('text-gray-500').removeClass('text-blue-600');
        $('#RequestSuppStep2Icon').addClass('text-blue-600').removeClass('text-gray-500');
    });

    // Go back to Step 1
    $('#RequestSupBackToStep1').click(function () {
        $('#RequestSupStep2Content').addClass('hidden');
        $('#RequestSuppStep1Content').removeClass('hidden');
        $('#RequestSuppStep2Icon').addClass('text-gray-500').removeClass('text-blue-600');
        $('#RequestSuppStep1Icon').addClass('text-blue-600').removeClass('text-gray-500');
    });

    // Add a new inventory row to the table
    $('#RequestSupAddRowBtn').click(function () {
        const newRow = `
            <tr class="RequestSup-Rows">
                <td class="p-2">
                    <select id="ReqSupCategoryName" name="ReqSupCategoryName" class="w-full px-2 py-1 border border-gray-400 rounded">
                        <option value="ReqSupCategoryName" disabled selected>Select Category</option>
                        <!-- These options will depend on the selected building -->
                        <option value="Laptop" data-building="">Laptop</option>
                        <option value="Printer" data-building="">Printer</option>
                    </select>
                </td>
                <td class="p-2">
                    <select id="ReqSupType" name="ReqSupType" class="w-full px-2 py-1 border border-gray-400 rounded">
                        <option value="ReqSupType" disabled selected>Select Type</option>
                        <!-- These options will depend on the selected building -->
                        <option value="64gb" data-building="">64gb</option>
                        <option value="Nikon" data-building="">Nikon</option>
                    </select>
                </td>
                <td class="p-2">
                    <select id="ReqSupUnit" name="ReqSupUnit" class="w-full px-2 py-1 border border-gray-400 rounded">
                        <option value="ReqSupUnit" disabled selected>Select Unit</option>
                        <!-- These options will depend on the selected building -->
                        <option value="Box" data-building="">Box</option>
                        <option value="Unit" data-building="">Unit</option>
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

    $('#ViewReqSuppliesAddRowBTN').click(function () {
        console.log('Request Supplies Add Row Button is Clicked.');
        const ReqSuppliesNewRow = `
             <tr class="ViewRequestSup-Rows">
                <td class="p-2">
                    <select id="" name="" class="w-full px-2 py-1 border border-gray-400 rounded">
                        <option value="" disabled selected>Select Category</option>
                        <!-- These options will depend on the selected building -->
                        <option value="Laptop" data-building="">Laptop</option>
                        <option value="Printer" data-building="">Printer</option>
                    </select>
                </td>
                <td class="p-2">
                    <select id="" name="" class="w-full px-2 py-1 border border-gray-400 rounded">
                        <option value="" disabled selected>Select Type</option>
                        <!-- These options will depend on the selected building -->
                        <option value="64gb" data-building="">64gb</option>
                        <option value="Nikon" data-building="">Nikon</option>
                    </select>
                </td>
                <td class="p-2">
                    <select id="" name="" class="w-full px-2 py-1 border border-gray-400 rounded">
                        <option value="" disabled selected>Select Unit</option>
                        <!-- These options will depend on the selected building -->
                        <option value="Box" data-building="">Box</option>
                        <option value="Unit" data-building="">Unit</option>
                    </select>
                </td>
                <td class="p-2 flex justify-center">
                    <input type="number" class="w-20 border rounded p-2" placeholder="">
                </td>

               <td class="p-2 text-center">
                    <button type="button" class="ViewReqApprovalSup-DeleteBTN text-red-500 hover:text-red-700">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </td>
            </tr>`;
        $('#ViewRequestSup-TablBody').append(ReqSuppliesNewRow);
    });

    $('#ViewRequestSup-TablBody').on('click', '.ViewReqApprovalSup-DeleteBTN', function () {
        $(this).closest('tr').remove();
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

    // Hide the popup and show Cancel message when Cancel button is clicked
    $("#closeApprReqSupPopupCard").click(function () {
        Swal.fire({
            icon: 'error',
            title: 'Cancelled',
            text: 'Your action has been cancelled',
            confirmButtonText: 'OK',
            confirmButtonColor: '#D1191A'
        }).then(() => {
            $("#ApprReqSupPopupCard").addClass("hidden");
        });
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

    // Hide the popup and show Cancel message when Cancel button is clicked
    $("#closeDclnSupPopupCard").click(function () {
        Swal.fire({
            icon: 'error',
            title: 'Cancelled',
            text: 'Decline process has been cancelled',
            confirmButtonText: 'OK',
            confirmButtonColor: '#3085d6'
        }).then(() => {
            $("#DclnSupPopupCard").addClass("hidden");
        });
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
            const buildingDropdown = $("#ReqSupBldName");
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
            $("#ReqSupBldName").change(function () {
                const selectedBuilding = $(this).val();
                const roomDropdown = $("#ReqSupRoom");
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
