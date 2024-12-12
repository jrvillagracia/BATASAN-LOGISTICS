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
    const datepickerInput = document.getElementById("ReqEquipDate");
    datepickerInput.setAttribute("datepicker-min-date", formatDate(currentDate));
    datepickerInput.setAttribute("datepicker-max-date", formatDate(maxDate));

    // Initialize the datepicker (assuming a library like Flowbite/Flatpickr is being used)
    datepickerInput.datepicker = new Datepicker(datepickerInput, {
        minDate: currentDate,
        maxDate: maxDate,
        autoselectToday: true,
    });
});


// ADD FORM BUTTON
$(document).ready(function () {
    $('#ReqEquipFormBtn').click(function () {
        console.log('Show Request Equipment Button Clicked');
        $('#ReqEquipFormCard').removeClass('hidden');
    });

    $('#ReqEquipCloseFormBtn').click(function () {
        console.log('Close Request Equipment Button Clicked');
        $('#ReqEquipFormCard').addClass('hidden');
    });

    $('#ReqEquipCancelFormBtn').click(function () {
        console.log('Close Request Equipment Button Clicked');
        $('#ReqEquipFormCard').addClass('hidden');
    });

    $("#ReqEquipSubmitFormBtn").click(function () {
        Swal.fire({
            icon: 'success',
            title: 'Submit',
            text: 'Successfully Added to the table',
            confirmButtonText: 'OK',
            confirmButtonColor: '#3085d6'
        }).then(() => {
            $("#ReqEquipFormCard").addClass("hidden");
        });
    });

    // Go to Step 2
    $('#RequestEquipGoToStep2').click(function () {
        $('#RequestEquipStep1Content').addClass('hidden');
        $('#RequestEquipStep2Content').removeClass('hidden');
        $('#RequestEquipStep1Icon').addClass('text-gray-500').removeClass('text-blue-600');
        $('#RequestEquipStep2Icon').addClass('text-blue-600').removeClass('text-gray-500');
    });

    // Go back to Step 1
    $('#RequestEquipBackToStep1').click(function () {
        $('#RequestEquipStep2Content').addClass('hidden');
        $('#RequestEquipStep1Content').removeClass('hidden');
        $('#RequestEquipStep2Icon').addClass('text-gray-500').removeClass('text-blue-600');
        $('#RequestEquipStep1Icon').addClass('text-blue-600').removeClass('text-gray-500');
    });

    // Add a new inventory row to the table
    $('#RequestEquipAddRowBtn').click(function () {
        const newRow = `
            <tr class="RequestEquip-Rows">
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
                    <button type="button" class="RequestEquipDelete-row-btn text-red-500 hover:text-red-700">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </td>
            </tr>`;
        $('#RequestEquip-TablBody').append(newRow);
    });

    $('#RequestEquip-TablBody').on('click', '.RequestEquipDelete-row-btn', function () {
        $(this).closest('tr').remove();
    });
});







// ======================== FOR APPROVAL MODULE ============================= //
// VIEW BUTTON CARD FORM      
$(document).ready(function () {
    $('#ViewEquipBtn').click(function () {
        console.log('View Equipment Button is Clicked.');
        $('#ViewReqEquipPopupCard').removeClass('hidden');
    });

    $('#closeReqViewEquipPopupCard').click(function () {
        console.log('Close "X" Equipment Button is Clicked.');
        $('#ViewReqEquipPopupCard').addClass('hidden');
    });

    $('#cancelReqEquipmentInventoryPopupCard').click(function () {
        console.log('Close "X" Equipment Button is Clicked.');
        $('#ViewReqEquipPopupCard').addClass('hidden');
    });

    $('#ViewReqEquipmentAddRowBTN').click(function () {
        console.log('Request Equipment Add Row Button is Clicked.');
        const ReqEquipNewRow = `
             <tr class="ViewRequestEquip-Rows">
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
                    <button type="button" class="ViewReqApprovalEquip-DeleteBTN text-red-500 hover:text-red-700">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </td>
            </tr>`;
        $('#ViewRequestEquip-TablBody').append(ReqEquipNewRow);
    });

    $('#ViewRequestEquip-TablBody').on('click', '.ViewReqApprovalEquip-DeleteBTN', function () {
        $(this).closest('tr').remove();
    });


    $("#saveEquipmentInventoryPopupCard").click(function () {
        Swal.fire({
            icon: 'success',
            title: 'Submitted',
            text: 'Your action has been successfully submitted',
            confirmButtonText: 'OK',
            confirmButtonColor: '#3085d6'
        }).then(() => {
            $("#ViewReqEquipPopupCard").addClass("hidden");
        });
    });

});


$(document).ready(function () {


});


// // APPROVE BUTTON CARD FORM
$(document).ready(function () {
    $("#ApprEquipBtn").click(function () {
        $("#ApprReqEquipPopupCard").removeClass("hidden");
    });

    // Hide the popup and show Cancel message when Cancel button is clicked
    $("#closeApprReqEquipPopupCard").click(function () {
        Swal.fire({
            icon: 'error',
            title: 'Cancelled',
            text: 'Your action has been cancelled',
            confirmButtonText: 'OK',
            confirmButtonColor: '#D1191A'
        }).then(() => {
            $("#ApprReqEquipPopupCard").addClass("hidden");
        });
    });

    // Hide the popup and show Submitted message when Submit button is clicked
    $("#submitApprReqEquipPopupCard").click(function () {
        Swal.fire({
            icon: 'success',
            title: 'Submitted',
            text: 'Your action has been successfully submitted',
            confirmButtonText: 'OK',
            confirmButtonColor: '#3085d6'
        }).then(() => {
            $("#ApprReqEquipPopupCard").addClass("hidden");
        });
    });
});


// DECLINE BUTTON CARD FORM
$(document).ready(function () {
    $("#DclnEquipBtn").click(function () {
        $("#DclnEquipPopupCard").removeClass("hidden");
    });

  
    $("#closeDclnEquipPopupCard").click(function () {
        Swal.fire({
            icon: 'error',
            title: 'Cancelled',
            text: 'Decline process has been cancelled',
            confirmButtonText: 'OK',
            confirmButtonColor: '#3085d6'
        }).then(() => {
            $("#DclnEquipPopupCard").addClass("hidden");
        });
    });


    $("#submitDclnEquipPopupCard").click(function () {
        Swal.fire({
            icon: 'success',
            title: 'Submitted',
            text: 'Your reason has been submitted',
            confirmButtonText: 'OK',
            confirmButtonColor: '#3085d6'
        }).then(() => {
            $("#DclnEquipPopupCard").addClass("hidden");
        });
    });
});
// ========================================== //

// SET ITEM BUTTON CARD
$(document).ready(function () {
    $('#SetItemEquipBtn').click(function () {
        console.log('View Equipment Button is Clicked.');
        $('#SetItemReqEquipPopupCard').removeClass('hidden');
    });

    $('#closeSetItemReqViewEquipPopupCard').click(function () {
        console.log('Close "X" Set Item Equipment Button is Clicked.');
        $('#SetItemReqEquipPopupCard').addClass('hidden');
    });

    $('#SetItemCancelBTN').click(function () {
        console.log('Close Cancel Set Item Button is Clicked.');
        $('#SetItemReqEquipPopupCard').addClass('hidden');
    });

    $("#SetItemSubmitBTN").click(function () {
        Swal.fire({
            icon: 'success',
            title: 'Submitted',
            text: 'Successfully Set Item!',
            confirmButtonText: 'OK',
            confirmButtonColor: '#3085d6'
        }).then(() => {
            $("#SetItemReqEquipPopupCard").addClass("hidden");
        });
    });
});

// ITEM NUM BUTTON
$(document).ready(function () {
    $('#SetItemEditBTN').click(function () {
        console.log('Item Num Equipment Button is Clicked.');
        $('#EditSetItemReqEquipPopupCard').removeClass('hidden');
    });

    $('#closeItemNumReqViewEquipPopupCard').click(function () {
        console.log('Close "X" Equipment Button is Clicked.');
        $('#EditSetItemReqEquipPopupCard').addClass('hidden');
    });


    $("#EditItemSaveBTN").click(function () {
        Swal.fire({
            icon: 'success',
            title: 'Submitted',
            text: 'Successfully Save Item Number!',
            confirmButtonText: 'OK',
            confirmButtonColor: '#3085d6'
        }).then(() => {
            $("#EditSetItemReqEquipPopupCard").addClass("hidden");
        });
    });

    $('#EditItemCancelBTN').click(function () {
        console.log('Close Cancel Item Num Button is Clicked.');
        $('#EditSetItemReqEquipPopupCard').addClass('hidden');
    });
});

//SET ITEM: EDIT CHECK BOXES BUTTON
$(document).ready(function() {
    // Function to update the checked count
    function updateCheckedCount() {
        var checkedCount = $('.row-checkbox:checked').length; // Count checked checkboxes
        var totalCount = $('.row-checkbox').length; // Total checkboxes

        // Update the text showing the checked count and total count
        $('#checkedCount').text(checkedCount);
        $('#totalCount').text(totalCount);
    }

    // Initially update the counts on page load
    updateCheckedCount();

    // Event listener for checkbox change
    $('.row-checkbox').on('change', function() {
        updateCheckedCount(); // Update count when any checkbox is toggled
    });
});


// $(document).ready(function () {
//     // When a building is selected, filter the room dropdown
//     $('#buildingName').change(function () {
//       const selectedBuilding = $(this).val();
//       $('#room option').each(function () {
//         const roomBuilding = $(this).data('building');
//         if (roomBuilding === selectedBuilding || $(this).val() === "") {
//           $(this).show();
//         } else {
//           $(this).hide();
//         }
//       });
//       // Reset room selection
//       $('#room').val('');
//     });
//   });


// ======================== DATATABLES ============================= //
// MAIN TABLE DATATABLES
document.addEventListener("DOMContentLoaded", function () {
    // Check if the table exists and simple-datatables is loaded
    if (document.getElementById("reqEquipTable") && typeof simpleDatatables !== 'undefined') {
        const dataTable = new simpleDatatables.DataTable("#reqEquipTable", {
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

// SET ITEM TABLE DATATABLES
document.addEventListener("DOMContentLoaded", function () {
    // Check if the table exists and simple-datatables is loaded
    if (document.getElementById("reqSETITEMSupTable") && typeof simpleDatatables !== 'undefined') {
        const dataTable = new simpleDatatables.DataTable("#reqSETITEMSupTable", {
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


//Get Building and Rooms
$(document).ready(function () {
    // Fetch buildings and rooms via AJAX
    $.ajax({
        url: '/buildings-rooms',
        method: 'GET',
        success: function (data) {
            // Populate Building dropdown
            const buildingDropdown = $("#ReqEquipBldName");
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
            $("#ReqEquipBldName").change(function () {
                const selectedBuilding = $(this).val();
                const roomDropdown = $("#ReqEquipRoom");
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
