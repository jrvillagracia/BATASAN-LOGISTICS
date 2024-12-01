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
});




// VIEW BUTTON CARD FORM  
$(document).ready(function () {
    $('#MaintenanceEquipmentViewBTN').click(function () {
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
