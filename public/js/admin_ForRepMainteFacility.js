//==================== VIEW =======================//
$(document).ready(function () {
    $('#REPMaintenanceFacilitytViewBTN').click(function () {
        console.log('View Facility Button is Clicked.');
        $('#REPViewMainteFacilityPopupCard').removeClass('hidden');
    });


    $('#REPCloseViewMainteFacilityPopupCard').click(function () {
        event.preventDefault();
        console.log('Close "X" Facility Button is Clicked.');
        $('#REPViewMainteFacilityPopupCard').addClass('hidden');
    });


    $('#cancelViewForReprMainteFacilityPopupCard').click(function () {
        event.preventDefault();
        console.log('Cancel View Facility Button is Clicked.');
        $('#REPViewMainteFacilityPopupCard').addClass('hidden');
    });
});

//==================== SET JOB =======================//
$(document).ready(function () {
    $('#REPMaintenanceFacilitytSetBTN').click(function () {
        console.log('View Facility Button is Clicked.');
        $('#REPSetMainteFacilityPopupCard').removeClass('hidden');
    });


    $('#REPCloseSetMainteFacilityPopupCard').click(function () {
        event.preventDefault();
        console.log('Close "X" Facility Button is Clicked.');
        $('#REPSetMainteFacilityPopupCard').addClass('hidden');
    });


    $('#cancelSetForReprMainteFacilityPopupCard').click(function () {
        event.preventDefault();
        console.log('Cancel View Facility Button is Clicked.');
        $('#REPSetMainteFacilityPopupCard').addClass('hidden');
    });
});


//==================== COMPLETED =======================//
$(document).ready(function () {
    $("#REPMaintenanceFacilityCompBTN").click(function () {
        $("#REPCompleteMntcFacilityPopCard").removeClass("hidden");
    });

    $("#cancelCompMainteFacPopupCard").click(function () {
        event.preventDefault();
        Swal.fire({
            icon: 'error',
            title: 'Cancelled',
            text: 'Your action has been cancelled',
            confirmButtonText: 'OK',
            confirmButtonColor: '#D1191A'
        }).then(() => {
            $("#REPCompleteMntcFacilityPopCard").addClass("hidden");
        });
        
    });

    // Hide the popup and show Submitted message when Submit button is clicked
    $("#submitCompMainteFacPopupCard").click(function () {
        event.preventDefault();
        Swal.fire({
            icon: 'success',
            title: 'Submitted',
            text: 'Your action has been successfully submitted',
            confirmButtonText: 'OK',
            confirmButtonColor: '#3085d6'
        }).then(() => {
            $("#REPCompleteMntcFacilityPopCard").addClass("hidden");
        });
    });
});


//==================== CANCEL =======================//
$(document).ready(function () {
    $("#REPMaintenanceFacilityCancelBTN").click(function () {
        $("#REPCancelMainteFacilityPopupCard").removeClass("hidden");
    });

    // Hide the popup and show Cancel message when Cancel button is clicked
    $("#cancelMainteFacPopupCard").click(function () {
        event.preventDefault();
        Swal.fire({
            icon: 'error',
            title: 'Cancelled',
            text: 'Your action has been cancelled',
            confirmButtonText: 'OK',
            confirmButtonColor: '#D1191A'
        }).then(() => {
            $("#REPCancelMainteFacilityPopupCard").addClass("hidden");
        });
        
    });

    // Hide the popup and show Submitted message when Submit button is clicked
    $("#submitMainteFacPopupCard").click(function () {
        event.preventDefault();
        Swal.fire({
            icon: 'success',
            title: 'Submitted',
            text: 'Your action has been successfully submitted',
            confirmButtonText: 'OK',
            confirmButtonColor: '#3085d6'
        }).then(() => {
            $("#REPCancelMainteFacilityPopupCard").addClass("hidden");
        });
    });
});



// ======================== DATATABLES ============================= //
// MAIN TABLE DATATABLES
document.addEventListener("DOMContentLoaded", function () {
    // Check if the table exists and simple-datatables is loaded
    if (document.getElementById("MainteFacilityTable") && typeof simpleDatatables !== 'undefined') {
        const dataTable = new simpleDatatables.DataTable("#MainteFacilityTable", {
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

        // document.getElementById("MainteFacilitySearch").addEventListener("keyup", function() {
        //     let searchTerm = this.value;
        //     dataTable.search(searchTerm);
        // });
    }
});