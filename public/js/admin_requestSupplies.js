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
