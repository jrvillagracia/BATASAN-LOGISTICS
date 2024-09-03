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

// FOR VALIDATION SWEETALERT2 AFTER FILLING UP THE FORM CARD
// Handle form submission and add data to the table
$(document).ready(function () {
    $('#ReqEquipSubmitFormBtn').click(function (event) {
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
                const department = $('#EquipmentDepartment').val();
                const date = $('#ReqEquipDate').val();
                const reason = $('#ReqEquipReason').val();
                const remarks = $('#ReqEquipRemarks').val();

                // Check if all values are entered
                if (!name || !department || !date || !reason || !remarks) {
                    Swal.fire("All fields are required!", "", "error");
                    return;
                }

                // Append new row to the table  // THIS IS FOR EXAMPLE ONLY TO CHECK IF SWEETALERT2 IS APPLIED
                $('#dynamicTable tbody').append(`
                    <tr>
                        <td class="py-6 px-3 border-b border-gray-300"></td>
                        <td class="py-6 px-3 border-b border-gray-300">${name}</td>
                        <td class="py-6 px-3 border-b border-gray-300">${department}</td>
                        <td class="py-6 px-3 border-b border-gray-300">${date}</td>
                        <td class="py-6 px-3 border-b border-gray-300">
                            <button id="ViewEquipBtn" type="button" class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded">View</button>
                            <button id="ApprEquipBtn" type="button" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded">Approve</button>
                            <button id="DclnEquipBtn" type="button" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded">Decline</button>
                        </td>
                    </tr>
                `);

                // Clear form
                $('#ReqEquipForm')[0].reset();

                // Hide form card
                $('#ReqEquipFormCard').addClass('hidden');

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
    $('#ViewEquipBtn').click(function (){
        console.log('View Equipment Button is Clicked.');
        $('#ViewEquipPopupCard').removeClass('hidden');
    });
});

$(document).ready(function () {
    $('#closeViewEquipPopupCard').click(function (){
        console.log('Close "X" Equipment Button is Clicked.');
    $('#ViewEquipPopupCard').addClass('hidden');
    });
});


// APPROVE BUTTON CARD FORM
$(document).ready(function () {
    $("#ApprEquipBtn").click(function () {
        $("#ApprEquipPopupCard").removeClass("hidden");
    });

    // Hide the popup and show Cancel message when Cancel button is clicked
    $("#closeApprEquipPopupCard").click(function () {
        Swal.fire({
            icon: 'error',
            title: 'Cancelled',
            text: 'Your action has been cancelled',
            confirmButtonText: 'OK',
        }).then(() => {
            $("#ApprEquipPopupCard").addClass("hidden");
        });
    });

    // Hide the popup and show Submitted message when Submit button is clicked
    $("#submitApprEquipPopupCard").click(function () {
        Swal.fire({
            icon: 'success',
            title: 'Submitted',
            text: 'Your action has been successfully submitted',
            confirmButtonText: 'OK',
        }).then(() => {
            $("#ApprEquipPopupCard").addClass("hidden");
        });
    });
});


// DECLINE BUTTON CARD FORM
$(document).ready(function () {
    // Show the popup when the button is clicked
    $("#DclnEquipBtn").click(function () {
        $("#DclnEquipPopupCard").removeClass("hidden");
    });

    // Hide the popup and show Cancel message when Cancel button is clicked
    $("#closeDclnEquipPopupCard").click(function () {
        Swal.fire({
            icon: 'error',
            title: 'Cancelled',
            text: 'Decline process has been cancelled',
            confirmButtonText: 'OK',
        }).then(() => {
            $("#DclnEquipPopupCard").addClass("hidden");
        });
    });

    // Hide the popup and show Submitted message when Submit button is clicked
    $("#submitDclnEquipPopupCard").click(function () {
        Swal.fire({
            icon: 'success',
            title: 'Submitted',
            text: 'Your reason has been submitted',
            confirmButtonText: 'OK',
        }).then(() => {
            $("#DclnEquipPopupCard").addClass("hidden");
        });
    });
});// ========================================== //







// ======================== FOR RELEASE MODULE ============================= //

// RELEASE BUTTON FORM CARD
$(document).ready(function () {
    // Show the popup when the button is clicked
    $("#RelEquipBtn").click(function () {
        $("#RelEquipPopupCard").removeClass("hidden");
    });

    // Hide the popup and show Cancel message when Cancel button is clicked
    $("#closeRelEquipPopupCard").click(function () {
        Swal.fire({
            icon: 'error',
            title: 'Cancelled',
            text: 'Release process has been cancelled',
            confirmButtonText: 'OK',
        }).then(() => {
            $("#RelEquipPopupCard").addClass("hidden");
        });
    });

    // Hide the popup and show Submitted message when Submit button is clicked
    $("#submitRelEquipPopupCard").click(function () {
        Swal.fire({
            icon: 'success',
            title: 'Submitted',
            text: 'The release process has been successfully submitted',
            confirmButtonText: 'OK',
        }).then(() => {
            $("#RelEquipPopupCard").addClass("hidden");
        });
    });
});


// REVOKE BUTTON FORM CARD
$(document).ready(function () {
    // Show the popup when the button is clicked
    $("#RevEquipBtn").click(function () {
        $("#RevEquipPopupCard").removeClass("hidden");
    });

    // Hide the popup and show Cancel message when Cancel button is clicked
    $("#closeRevEquipPopupCard").click(function () {
        Swal.fire({
            icon: 'error',
            title: 'Cancelled',
            text: 'Revoke Process is cancel',
            confirmButtonText: 'OK',
        }).then(() => {
            $("#RevEquipPopupCard").addClass("hidden");
        });
    });

    // Hide the popup and show Submitted message when Submit button is clicked
    $("#submitRevEquipPopupCard").click(function () {
        Swal.fire({
            icon: 'success',
            title: 'Submitted',
            text: 'Revoke Successfully',
            confirmButtonText: 'OK',
        }).then(() => {
            $("#RevEquipPopupCard").addClass("hidden");
        });
    });
});


// ======================== COMPLETED REQUEST ============================= //



// ======================== DATATABLES ============================= //
$(document).ready(function() {
    var table = $('#reqEquipTable').DataTable({
    });

    $('.dt-search').hide();

    // Custom search function
    $('#equipmentSearch').on('keyup', function() {
        console.log('Search input:', this.value); 
        table.search(this.value).draw(); 
    });
});
