//==================== VIEW =======================//
$(document).ready(function () {
    $('#COMREQMaintenanceFacilitytViewBTN').click(function () {
        console.log('View Facility Button is Clicked.');
        $('#COMREQViewMainteFacilityPopupCard').removeClass('hidden');
    });


    $('#COMREQCloseViewMainteFacilityPopupCard').click(function () {
        event.preventDefault();
        console.log('Close "X" Facility Button is Clicked.');
        $('#COMREQViewMainteFacilityPopupCard').addClass('hidden');
    });


    $('#closeViewComReqrMainteFacilityPopupCard').click(function () {
        event.preventDefault();
        console.log('Cancel View Facility Button is Clicked.');
        $('#COMREQViewMainteFacilityPopupCard').addClass('hidden');
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





//================================== HISTORY MODULE =============================//
