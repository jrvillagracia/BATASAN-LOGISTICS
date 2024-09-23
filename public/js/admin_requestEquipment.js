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
                $('#reqEquipTable tbody').append(`
                    <tr>
                        <td class="py-6 px-3 border-b border-gray-300"></td>
                        <td class="py-6 px-3 border-b border-gray-300"></td>
                        <td class="py-6 px-3 border-b border-gray-300"></td>
                        <td class="py-6 px-3 border-b border-gray-300"></td>
                        <td class="py-6 px-3 border-b border-gray-300">
                            <button id="ViewEquipBtn" type="button">
                                <svg class="w-[27px] h-[27px] text-green-600 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-width="2" d="M21 12c0 1.2-4.03 6-9 6s-9-4.8-9-6c0-1.2 4.03-6 9-6s9 4.8 9 6Z" />
                                        <path stroke="currentColor" stroke-width="2" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                </svg>
                            </button>
                            <button id="ApprEquipBtn" type="button">
                                <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#0000FF">
                                    <path d="M382-240 154-468l57-57 171 171 367-367 57 57-424 424Z"/>
                                </svg>
                            </button>
                            <button id="DclnEquipBtn" type="button">
                                <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#D1191A"><path d="M200-440v-80h560v80H200Z"/>
                                </svg>
                            </button>
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
    $('#ViewEquipBtn').click(function () {
        console.log('View Equipment Button is Clicked.');
        $('#ViewEquipPopupCard').removeClass('hidden');
    });
});

$(document).ready(function () {
    $('#closeViewEquipPopupCard').click(function () {
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
            confirmButtonColor: '#D1191A'
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
            confirmButtonColor: '#3085d6'
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
            confirmButtonColor: '#3085d6'
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
            confirmButtonColor: '#3085d6'
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
            confirmButtonColor: '#3085d6'
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
            confirmButtonColor: '#3085d6'
        }).then(() => {
            $("#RevEquipPopupCard").addClass("hidden");
        });
    });
});


// ======================== COMPLETED REQUEST ============================= //



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
