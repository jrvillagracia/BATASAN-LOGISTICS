//==================== VIEW =======================//
$(document).ready(function () {
    $('#COMREQMaintenanceEquipmentViewBTN').click(function () {
        console.log('View Equipment Button is Clicked.');
        $('#COMREQViewMainteInventoryPopupCard').removeClass('hidden');
    });


    $('#COMREQCloseViewMainteInventoryPopupCard').click(function () {
        event.preventDefault();
        console.log('Close "X" Equipment Button is Clicked.');
        $('#COMREQViewMainteInventoryPopupCard').addClass('hidden');
    });


    $('#closeViewComReqrMainteInventoryPopupCard').click(function () {
        event.preventDefault();
        console.log('Cancel View Equipment Button is Clicked.');
        $('#COMREQViewMainteInventoryPopupCard').addClass('hidden');
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





//================================== HISTORY MODULE =============================//
