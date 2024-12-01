//==================== VIEW =======================//
$(document).ready(function () {
    $('#REPMaintenanceEquipmentViewBTN').click(function () {
        console.log('View Equipment Button is Clicked.');
        $('#REPViewMainteInventoryPopupCard').removeClass('hidden');
    });


    $('#REPCloseViewMainteInventoryPopupCard').click(function () {
        event.preventDefault();
        console.log('Close "X" Equipment Button is Clicked.');
        $('#REPViewMainteInventoryPopupCard').addClass('hidden');
    });


    $('#cancelViewForReprMainteInventoryPopupCard').click(function () {
        event.preventDefault();
        console.log('Cancel View Equipment Button is Clicked.');
        $('#REPViewMainteInventoryPopupCard').addClass('hidden');
    });
});

//==================== SET JOB =======================//
$(document).ready(function () {
    $('#REPMaintenanceEquipmentSetBTN').click(function () {
        console.log('View Equipment Button is Clicked.');
        $('#REPSetMainteInventoryPopupCard').removeClass('hidden');
    });


    $('#REPCloseSetMainteInventoryPopupCard').click(function () {
        event.preventDefault();
        console.log('Close "X" Equipment Button is Clicked.');
        $('#REPSetMainteInventoryPopupCard').addClass('hidden');
    });


    $('#cancelSetForReprMainteInventoryPopupCard').click(function () {
        event.preventDefault();
        console.log('Cancel View Equipment Button is Clicked.');
        $('#REPSetMainteInventoryPopupCard').addClass('hidden');
    });
});


//==================== COMPLETED =======================//
$(document).ready(function () {
    $("#REPMaintenanceEquipmentCompleteBTN").click(function () {
        $("#CompMainteInventoryPopupCard").removeClass("hidden");
    });

    // Hide the popup and show Cancel message when Cancel button is clicked
    $("#cancelCompMainteInventoryPopupCard").click(function () {
        event.preventDefault();
        Swal.fire({
            icon: 'error',
            title: 'Cancelled',
            text: 'Your action has been cancelled',
            confirmButtonText: 'OK',
            confirmButtonColor: '#D1191A'
        }).then(() => {
            $("#CompMainteInventoryPopupCard").addClass("hidden");
        });
        
    });

    // Hide the popup and show Submitted message when Submit button is clicked
    $("#submitCompMainteInventoryPopupCard").click(function () {
        event.preventDefault();
        Swal.fire({
            icon: 'success',
            title: 'Submitted',
            text: 'Your action has been successfully submitted',
            confirmButtonText: 'OK',
            confirmButtonColor: '#3085d6'
        }).then(() => {
            $("#CompMainteInventoryPopupCard").addClass("hidden");
        });
    });
});

//==================== CANCEL =======================//
$(document).ready(function () {
    $("#REPMaintenanceEquipmentCancelBTN").click(function () {
        $("#CancelMainteInventoryPopupCard").removeClass("hidden");
    });

    // Hide the popup and show Cancel message when Cancel button is clicked
    $("#cancelMainteInventoryPopupCard").click(function () {
        event.preventDefault();
        Swal.fire({
            icon: 'error',
            title: 'Cancelled',
            text: 'Your action has been cancelled',
            confirmButtonText: 'OK',
            confirmButtonColor: '#D1191A'
        }).then(() => {
            $("#CancelMainteInventoryPopupCard").addClass("hidden");
        });
        
    });

    // Hide the popup and show Submitted message when Submit button is clicked
    $("#submitMainteInventoryPopupCard").click(function () {
        event.preventDefault();
        Swal.fire({
            icon: 'success',
            title: 'Submitted',
            text: 'Your action has been successfully submitted',
            confirmButtonText: 'OK',
            confirmButtonColor: '#3085d6'
        }).then(() => {
            $("#CancelMainteInventoryPopupCard").addClass("hidden");
        });
    });
});



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