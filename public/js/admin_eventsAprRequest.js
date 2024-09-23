// ======================== START FOR APPROVAL MODULE ============================= //
// VIEW BUTTON CARD FORM      
// THIS IS VIEW BUTTON IS APPLICABLE TO FOR APPROVAL, APPROVE REQUEST, COMPLETED REQUEST
$(document).ready(function () {
    $('#EventApprReqViewBTN').click(function () {
        console.log('View Event Button is Clicked.');
        $('#ViewEventApprReqPopupCard').removeClass('hidden');
    });

    $('#closeViewEventApprReqPopupCard').click(function (event) {
        event.preventDefault();  // Prevent form submission or link navigation
        console.log('Close View Button is Clicked.');
        $('#ViewEventApprReqPopupCard').addClass('hidden');
    });
});
// ======================== END FOR APPROVAL MODULE ============================= //









// ======================== DATATABLES ============================= //
// MAIN TABLE DATATABLES
document.addEventListener("DOMContentLoaded", function () {
    // Check if the table exists and simple-datatables is loaded
    if (document.getElementById("EventApproveReqTable") && typeof simpleDatatables !== 'undefined') {
        const dataTable = new simpleDatatables.DataTable("#EventApproveReqTable", {
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

        document.getElementById("eventApprReqSearch").addEventListener("keyup", function() {
            let searchTerm = this.value;
            dataTable.search(searchTerm);
        });
    }
});
// ======================== END OF DATATABLES ============================= //