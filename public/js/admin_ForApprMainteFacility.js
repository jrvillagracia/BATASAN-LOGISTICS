// ======================= ADD REQUEST ========================== //
$(document).ready(function () {
    $('#MainteFacilityREQFormButton').click(function () {
        event.preventDefault();
        console.log('Add Request Button is Clicked.');
        $('#MainteFacilityFormBtn').removeClass('hidden');
    });

    $('#CloseMainteFacilityForm').click(function () {
        console.log('Close Button is Clicked.');
        $('#MainteFacilityFormBtn').addClass('hidden');
    });

    $("#SubmitMainteFacilityForm").click(function () {
        event.preventDefault();
        Swal.fire({
            icon: 'success',
            title: 'Submitted',
            text: 'Your action has been successfully submitted',
            confirmButtonText: 'OK',
            confirmButtonColor: '#3085d6'
        }).then(() => {
            $("#MainteFacilityFormBtn").addClass("hidden");
        });
    });
});




// VIEW BUTTON CARD FORM  
$(document).ready(function () {
    $('#MaintenanceFacilityViewBTN').click(function () {
        console.log('View Equipment Button is Clicked.');
        $('#ViewMainteFacilityPopupCard').removeClass('hidden');
    });
});

$(document).ready(function () {
    $('#closeViewMainteFacilityPopupCard').click(function () {
        console.log('Close "X" Equipment Button is Clicked.');
        $('#ViewMainteFacilityPopupCard').addClass('hidden');
    });
});

$(document).ready(function () {
    $('#cancelForApprMainteFacilityPopupCard').click(function () {
        console.log('Cancel View Equipment Button is Clicked.');
        $('#ViewMainteFacilityPopupCard').addClass('hidden');
    });
});


// APPROVE BUTTON CARD FORM
$(document).ready(function () {
    $("#MaintenanceFacilityApproveBTN").click(function () {
        $("#ApprMainteFacilityPopupCard").removeClass("hidden");
    });

    // Hide the popup and show Cancel message when Cancel button is clicked
    $("#closeApprMainteFacilityPopupCard").click(function () {
        event.preventDefault();
        Swal.fire({
            icon: 'error',
            title: 'Cancelled',
            text: 'Your action has been cancelled',
            confirmButtonText: 'OK',
            confirmButtonColor: '#D1191A'
        }).then(() => {
            $("#ApprMainteFacilityPopupCard").addClass("hidden");
        });
    });

    // Hide the popup and show Submitted message when Submit button is clicked
    $("#submitApprMainteFacilityPopupCard").click(function () {
        event.preventDefault();
        Swal.fire({
            icon: 'success',
            title: 'Submitted',
            text: 'Your action has been successfully submitted',
            confirmButtonText: 'OK',
            confirmButtonColor: '#3085d6'
        }).then(() => {
            $("#ApprMainteFacilityPopupCard").addClass("hidden");
        });
    });
});


// DECLINE BUTTON CARD FORM
$(document).ready(function () {
    // Show the popup when the button is clicked
    $("#MaintenanceFacilityDeclineBTN").click(function () {
        $("#DclnMainteFacilityPopupCard").removeClass("hidden");
    });

    // Hide the popup and show Cancel message when Cancel button is clicked
    $("#closeDclnMainteFacilityPopupCard").click(function () {
        event.preventDefault();
        Swal.fire({
            icon: 'error',
            title: 'Cancelled',
            text: 'Decline process has been cancelled',
            confirmButtonText: 'OK',
            confirmButtonColor: '#3085d6'
        }).then(() => {
            $("#DclnMainteFacilityPopupCard").addClass("hidden");
        });
    });

    // Hide the popup and show Submitted message when Submit button is clicked
    $("#submitDclnMainteFacilityPopupCard").click(function () {
        event.preventDefault();
        Swal.fire({
            icon: 'success',
            title: 'Submitted',
            text: 'Your reason has been submitted',
            confirmButtonText: 'OK',
            confirmButtonColor: '#3085d6'
        }).then(() => {
            $("#DclnMainteFacilityPopupCard").addClass("hidden");
        });
    });
});// ========================================== //









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

        // document.getElementById("MainteFacilitytSearch").addEventListener("keyup", function() {
        //     let searchTerm = this.value;
        //     dataTable.search(searchTerm);
        // });
    }
});
