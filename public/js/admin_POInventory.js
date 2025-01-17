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
    const datepickerInput = document.getElementById("ProductOrderDate");
    datepickerInput.setAttribute("datepicker-min-date", formatDate(currentDate));
    datepickerInput.setAttribute("datepicker-max-date", formatDate(maxDate));

    // Initialize the datepicker (assuming a library like Flowbite/Flatpickr is being used)
    datepickerInput.datepicker = new Datepicker(datepickerInput, {
        minDate: currentDate,
        maxDate: maxDate,
        autoselectToday: true,
    });
});

// ADD ORDER
$(document).ready(function () {
    // Show Product Order Form
    $('#ProductOrderBTN').click(function (event) {
        event.preventDefault();
        $('#ProductOrder1').removeClass('hidden');

        const currentDate = new Date();
        const formattedDate = currentDate.toLocaleDateString('en-CA');
        const formattedTime = currentDate.toLocaleTimeString('en-CA', { hour: '2-digit', minute: '2-digit' });

        $('#ProductOrderDate').val(formattedDate);
        $('#ProductOrderTime').val(formattedTime);

        $('#step1Content').removeClass('hidden');
    });

    // Close Product Order Form
    $('#ProductOrderCloseFormBtn').click(function () {
        $('#ProductOrder1').addClass('hidden');
    });

    // Go to Step 2
    $('#goToStep2').click(function () {
        $('#step1Content').addClass('hidden');
        $('#step2Content').removeClass('hidden');
        $('#step1').addClass('text-gray-500').removeClass('text-blue-600');
        $('#step2').addClass('text-blue-600').removeClass('text-gray-500');
    });

    // Go back to Step 1
    $('#backToStep1').click(function () {
        $('#step2Content').addClass('hidden');
        $('#step1Content').removeClass('hidden');
        $('#step2').addClass('text-gray-500').removeClass('text-blue-600');
        $('#step1').addClass('text-blue-600').removeClass('text-gray-500');
    });

    // Add a new inventory row to the table
    $('#addItemBtn').click(function () {
        const newRow = `
            <tr class="inventory-item">
                <td class="p-2">
                    <select class="w-full border rounded p-2">
                        <option value="">Select Inventory</option>
                        <option>Equipment</option>
                        <option>Supplies</option>
                    </select>
                </td>
                <td class="p-2">
                    <select class="w-full border rounded p-2">
                        <option value="">Select Category</option>
                        <option>Laptop</option>
                        <option>Printer</option>
                    </select>
                </td>
                <td class="p-2">
                    <select class="w-full border rounded p-2">
                        <option value="">Select Type</option>
                        <option>64GB</option>
                        <option>Steel</option>
                    </select>
                </td>
                <td class="p-2">
                    <select class="w-full border rounded p-2">
                        <option value="">Select Unit</option>
                        <option>Box</option>
                        <option>Unit</option>
                     </select>
                </td>
                <td class="p-2">
                    <input type="number" class="w-full border rounded p-2" placeholder="Enter Quantity">
                </td>
                <td class="p-2">
                    <button type="button" class="delete-row-btn text-red-500 hover:text-red-700">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </td>
            </tr>`;
        $('#inventory-items').append(newRow);
    });

    // Delete an inventory row from the table
    $('#inventory-items').on('click', '.delete-row-btn', function () {
        $(this).closest('tr').remove();
    });

    $("#ProductOrderSubmitBTN").click(function () {
        Swal.fire({
            icon: 'success',
            title: 'Submitted',
            text: 'Your action has been successfully submitted',
            confirmButtonText: 'OK',
            confirmButtonColor: '#3085d6'
        }).then(() => {
            $("#ProductOrder1").addClass("hidden");
        });
    });
});

// VIEW 
$(document).ready(function () {
    $("#POViewBTN").click(function () {
        $("#ViewProductOrderPopupCard").removeClass("hidden");
    });

    $("#closeViewProductOrderPopupCard").click(function () {
        $("#ViewProductOrderPopupCard").addClass('hidden');
    });

    
    $("#ViewAddRowBTN").click(function () {
        console.log('Add Row button clicked');
        const newViewRow = `
            <tr class="ViewProductOrder-Rows">
                <td class="p-2">
                    <select id="" name="" class="w-full px-2 py-1 border border-gray-400 rounded">
                        <option value="" disabled selected>Select Inventory</option>
                        <!-- These options will depend on the selected building -->
                        <option value="Equipment" data-building="">Equipment</option>
                        <option value="Supplies" data-building="">Supplies</option>
                    </select>
                </td>
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
                    <button type="button" class="ViewProductOrder-DeleteBTN text-red-500 hover:text-red-700">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </td>
            </tr>`;
        $('#ViewProductOrder-TablBody').append(newViewRow);
    });

    // Delete Row Functionality
    $('#ViewProductOrder-TablBody').on('click', '.ViewProductOrder-DeleteBTN', function () {
        $(this).closest('tr').remove();
    });
});



// // APPROVE BUTTON CARD FORM
$(document).ready(function () {
    $("#POApprBTN").click(function () {
        $("#ApprProductInventoryPopupCard").removeClass("hidden");
    });

    // Hide the popup and show Cancel message when Cancel button is clicked
    $("#closeApprProductInventoryPopupCard").click(function () {
        Swal.fire({
            icon: 'error',
            title: 'Cancelled',
            text: 'Your action has been cancelled',
            confirmButtonText: 'OK',
            confirmButtonColor: '#D1191A'
        }).then(() => {
            $("#ApprProductInventoryPopupCard").addClass("hidden");
        });
    });

    // Hide the popup and show Submitted message when Submit button is clicked
    $("#submitApprProductInventoryPopupCard").click(function () {
        Swal.fire({
            icon: 'success',
            title: 'Submitted',
            text: 'Your action has been successfully submitted',
            confirmButtonText: 'OK',
            confirmButtonColor: '#3085d6'
        }).then(() => {
            $("#ApprProductInventoryPopupCard").addClass("hidden");
        });
    });
});


// DECLINE BUTTON CARD FORM
$(document).ready(function () {
    $("#PODclnBTN").click(function () {
        $("#DclnProductInventoryPopupCard").removeClass("hidden");
    });

  
    $("#closeDclnProductInventoryPopupCard").click(function () {
        Swal.fire({
            icon: 'error',
            title: 'Cancelled',
            text: 'Decline process has been cancelled',
            confirmButtonText: 'OK',
            confirmButtonColor: '#3085d6'
        }).then(() => {
            $("#DclnProductInventoryPopupCard").addClass("hidden");
        });
    });


    $("#submitDclnProductInventoryPopupCard").click(function () {
        Swal.fire({
            icon: 'success',
            title: 'Submitted',
            text: 'Your reason has been submitted',
            confirmButtonText: 'OK',
            confirmButtonColor: '#3085d6'
        }).then(() => {
            $("#DclnProductInventoryPopupCard").addClass("hidden");
        });
    });
});
// ========================================== //





// ======================== DATATABLES ============================= //
// MAIN TABLE DATATABLES
document.addEventListener("DOMContentLoaded", function () {
    // Check if the table exists and simple-datatables is loaded
    if (document.getElementById("POTable") && typeof simpleDatatables !== 'undefined') {
        const dataTable = new simpleDatatables.DataTable("#POTable", {
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

        // document.getElementById("equipmentSearch").addEventListener("keyup", function() {
        //     let searchTerm = this.value;
        //     dataTable.search(searchTerm);
        // });
    }
});


// VIEW Table
document.addEventListener("DOMContentLoaded", function () {
    // Check if the table exists and simple-datatables is loaded
    if (document.getElementById("POViewTable") && typeof simpleDatatables !== 'undefined') {
        const dataTable = new simpleDatatables.DataTable("#POViewTable", {
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

        // document.getElementById("equipmentSearch").addEventListener("keyup", function() {
        //     let searchTerm = this.value;
        //     dataTable.search(searchTerm);
        // });
    }
});