// FOR VALIDATION SWEETALERT2 AFTER FILLING UP THE FORM CARD
// Handle form submission and add data to the table


// ========================================== //




// ======================== FOR APPROVAL MODULE ============================= //
// VIEW BUTTON CARD FORM      // THIS IS VIEW BUTTON IS APPLICABLE TO FOR APPROVAL, REPAIR, COMPLETED REQUEST
$(document).ready(function () {
    $('#MaintenanceViewBTN').click(function () {
        console.log('View Equipment Button is Clicked.');
        $('#ViewMainteInventoryPopupCard').removeClass('hidden');
    });
});

$(document).ready(function () {
    $('#closeViewMainteInventoryPopupCard').click(function () {
        console.log('Close "X" Equipment Button is Clicked.');
        $('#ViewMainteInventoryPopupCard').addClass('hidden');
    });
});


// APPROVE BUTTON CARD FORM
$(document).ready(function () {
    $("#MaintenanceApproveBTN").click(function () {
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


// DAMAGE BUTTON CARD FORM
$(document).ready(function () {
    // Show the popup when the button is clicked
    $("#MaintenanceDamageBTN").click(function () {
        $("#DmgMainteInventoryPopupCard").removeClass("hidden");
    });

    // Hide the popup and show Cancel message when Cancel button is clicked
    $("#closeDmgMainteInventoryPopupCard").click(function () {
        Swal.fire({
            icon: 'error',
            title: 'Cancelled',
            text: 'Decline process has been cancelled',
            confirmButtonText: 'OK',
            confirmButtonColor: '#3085d6'
        }).then(() => {
            $("#DmgMainteInventoryPopupCard").addClass("hidden");
        });
    });

    // Hide the popup and show Submitted message when Submit button is clicked
    $("#submitDmgMainteInventoryPopupCard").click(function () {
        Swal.fire({
            icon: 'success',
            title: 'Submitted',
            text: 'Your reason has been submitted',
            confirmButtonText: 'OK',
            confirmButtonColor: '#3085d6'
        }).then(() => {
            $("#DmgMainteInventoryPopupCard").addClass("hidden");
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

        // document.getElementById("equipmentSearch").addEventListener("keyup", function() {
        //     let searchTerm = this.value;
        //     dataTable.search(searchTerm);
        // });
    }
});
