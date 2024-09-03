// ======================== ADD A REQUEST BUTTON FORM ============================= //
$(document).ready(function () {
    $('#ReqSupFormBtn').click(function () {
        console.log('Show Request Supplies Button Clicked');
        $('#ReqSupFormCard').removeClass('hidden');
    });
});

$(document).ready(function () {
    $('#ReqSupCloseFormBtn').click(function () {
        console.log('Close Request Supplies Button Clicked');
        $('#ReqSupFormCard').addClass('hidden');
    });
});

$(document).ready(function () {
    $('#ReqSupCancelFormBtn').click(function () {
        console.log('Close Request Supplies Button Clicked');
        $('#ReqSupFormCard').addClass('hidden');
    });
});

// FOR VALIDATION SWEETALERT2 AFTER FILLING UP THE FORM CARD
// Handle form submission and add data to the table
$(document).ready(function () {
    $('#ReqSupSubmitFormBtn').click(function (event) {
        event.preventDefault();  // Prevent default form submission

        Swal.fire({
            title: "Are you sure all input data are correct?",
            showDenyButton: true,
            confirmButtonText: "Yes",
            denyButtonText: "No"
        }).then((result) => {
            if (result.isConfirmed) {
                // Get form values
                const name = $('#name').val();
                const department = $('#SuppliesDepartment').val();
                const date = $('#ReqSupDate').val();
                const reason = $('#ReqSupReason').val();
                const remarks = $('#ReqSupRemarks').val();

                // Check if all values are entered
                if (!name || !department || !date || !reason || !remarks) {
                    Swal.fire("All fields are required!", "", "error");
                    return;
                }

                // Append new row to the table  // THIS IS FOR EXAMPLE ONLY TO CHECK IF SWEETALERT2 IS APPLIED
                $('#dynamicTable tbody').append(`
                    <tr>
                        <td class="py-6 px-3 border-b border-gray-300"></td>
                        <td class="py-6 px- border-b border-gray-3003">${name}</td>
                        <td class="py-6 px-3 border-b border-gray-300">${department}</td>
                        <td class="py-6 px-3 border-b border-gray-300">${date}</td>
                        <td class="py-6 px-3 border-b border-gray-300">
                            <button id="ViewSupBtn" type="button" class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded">View</button>
                            <button id="ApprSupBtn" type="button" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded">Approve</button>
                            <button id="DclnSupBtn" type="button" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded">Decline</button>
                        </td>
                    </tr>
                `);

                // Clear form
                $('#ReqSupForm')[0].reset();

                // Hide form card
                $('#ReqSupFormCard').addClass('hidden');

                Swal.fire("Saved!", "", "success");
            } else if (result.isDenied) {
                Swal.fire("Changes are not saved", "", "info");
            }
        });
    });
});

// ========================================== //





// ======================== FOR APPROVAL MODULE ============================= //
// VIEW BUTTON CARD FORM      // THIS IS VIEW BUTTON IS APPLICABLE TO FOR APPROVAL, RELEASE, COMPLETED REQUEST
$(document).ready(function () {
    $('#ViewSupBtn').click(function () {
        console.log('View Supplies Button is Clicked.');
        $('#ViewSupPopupCard').removeClass('hidden');
    });
});

$(document).ready(function () {
    $('#closeViewSupPopupCard').click(function () {
        console.log('Close "X" Supplies Button is Clicked.');
        $('#ViewSupPopupCard').addClass('hidden');
    });
});

// APPROVE BUTTON CARD FORM
$(document).ready(function () {
    $("#ApprSupBtn").click(function () {
        $("#ApprSupPopupCard").removeClass("hidden");
    });

    // Hide the popup and show Cancel message when Cancel button is clicked
    $("#closeApprSupPopupCard").click(function () {
        Swal.fire({
            icon: 'error',
            title: 'Cancelled',
            text: 'Your action has been cancelled',
            confirmButtonText: 'OK',
        }).then(() => {
            $("#ApprSupPopupCard").addClass("hidden");
        });
    });

    // Hide the popup and show Submitted message when Submit button is clicked
    $("#submitApprSupPopupCard").click(function () {
        Swal.fire({
            icon: 'success',
            title: 'Submitted',
            text: 'Your action has been successfully submitted',
            confirmButtonText: 'OK',
        }).then(() => {
            $("#ApprSupPopupCard").addClass("hidden");
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
        }).then(() => {
            $("#DclnSupPopupCard").addClass("hidden");
        });
    });
});
// ========================================== //






// ======================== FOR RELEASE MODULE ============================= //

// RELEASE BUTTON FORM CARD
$(document).ready(function () {
    // Show the popup when the button is clicked
    $("#RelSupBtn").click(function () {
        $("#RelSupPopupCard").removeClass("hidden");
    });

    // Hide the popup and show Cancel message when Cancel button is clicked
    $("#closeRelSupPopupCard").click(function () {
        Swal.fire({
            icon: 'error',
            title: 'Cancelled',
            text: 'Release process has been cancelled',
            confirmButtonText: 'OK',
        }).then(() => {
            $("#RelSupPopupCard").addClass("hidden");
        });
    });

    // Hide the popup and show Submitted message when Submit button is clicked
    $("#submitRelSupPopupCard").click(function () {
        Swal.fire({
            icon: 'success',
            title: 'Submitted',
            text: 'The release process has been successfully submitted',
            confirmButtonText: 'OK',
        }).then(() => {
            $("#RelSupPopupCard").addClass("hidden");
        });
    });
});


// REVOKE BUTTON FORM CARD
$(document).ready(function () {
    // Show the popup when the button is clicked
    $("#RevSupBtn").click(function () {
        $("#RevSupPopupCard").removeClass("hidden");
    });

    // Hide the popup and show Cancel message when Cancel button is clicked
    $("#closeRevSupPopupCard").click(function () {
        Swal.fire({
            icon: 'error',
            title: 'Cancelled',
            text: 'Revoke Process is cancel',
            confirmButtonText: 'OK',
        }).then(() => {
            $("#RevSupPopupCard").addClass("hidden");
        });
    });

    // Hide the popup and show Submitted message when Submit button is clicked
    $("#submitRevSupPopupCard").click(function () {
        Swal.fire({
            icon: 'success',
            title: 'Submitted',
            text: 'Revoke Successfully',
            confirmButtonText: 'OK',
        }).then(() => {
            $("#RevSupPopupCard").addClass("hidden");
        });
    });
});




// ======================== COMPLETED REQUEST ============================= //


// ======================== DATATABLES ============================= //
$(document).ready(function() {
    var table = $('#reqSuppTable').DataTable({
    });

    $('.dt-search').hide();

    // Custom search function
    $('#SuppliesSearch').on('keyup', function() {
        console.log('Search input:', this.value); 
        table.search(this.value).draw(); 
    });
});
