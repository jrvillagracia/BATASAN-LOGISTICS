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
});

$(document).ready(function () {
    $('#ReqEquipCloseFormBtn').click(function () {
        console.log('Close Request Equipment Button Clicked');
        $('#ReqEquipFormCard').addClass('hidden');
    });
});

$(document).ready(function () {
    $('#ReqEquipCancelFormBtn').click(function () {
        console.log('Close Request Equipment Button Clicked');
        $('#ReqEquipFormCard').addClass('hidden');
    });
});

$(document).ready(function () {
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
