// ======================== START FOR APPROVAL REQUEST MODULE ============================= //
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



// ======================== SET ITEM BUTTON ============================= //
$(document).ready(function () {
    $('#EventApprReqSetItemBTN').click(function () {
        console.log('View Event Button is Clicked.');
        $('#SetItemEventApprReqPopupCard').removeClass('hidden');
    });

    $('#closeSetItemEventApprReqPopupCard').click(function (event) {
        event.preventDefault();  // Prevent form submission or link navigation
        console.log('Close View Button is Clicked.');
        $('#SetItemEventApprReqPopupCard').addClass('hidden');
    });


    $(document).ready(function() {
        $("#submitSetItemEventApprReqPopupCard").click(function () {
            event.preventDefault();
            Swal.fire({
                icon: 'success',
                title: 'Submitted',
                text: 'Item Set successfully submitted',
                confirmButtonText: 'OK',
                confirmButtonColor: '#3085d6'
            }).then(() => {
                $("#SetItemEventApprReqPopupCard").addClass("hidden");
            });
        });
    });
});


// ======================== COMPLETED BUTTON ============================= //
$(document).ready(function () {
    $('#EventApprReqCompletedBTN').click(function () {
        console.log('Completed Event Button is Clicked.');
        $('#CompletedEventApprReqPopupCard').removeClass('hidden');
    });

    $('#closeCompletedEventApprReqPopupCard').click(function (event) {
        event.preventDefault();  // Prevent form submission or link navigation
        console.log('Close Completed Button is Clicked.');
        $('#CompletedEventApprReqPopupCard').addClass('hidden');
    });

    $(document).ready(function() {
        $("#submitCompletedEventApprReqPopupCard").click(function () {
            event.preventDefault();
            Swal.fire({
                icon: 'success',
                title: 'Submitted',
                text: 'Item Completed',
                confirmButtonText: 'OK',
                confirmButtonColor: '#3085d6'
            }).then(() => {
                $("#CompletedEventApprReqPopupCard").addClass("hidden");
            });
        });
    });
});




// ======================== CANCEL BUTTON ============================= //
$(document).ready(function () {
    // Show the popup when the button is clicked
    $("#EventApprReqCancelBTN").click(function () {
        $("#CancelEventPopupCard").removeClass("hidden");
    });

    // Hide the popup and show Cancel message when Cancel button is clicked
    $("#closeCancelEventPopupCard").click(function () {
        event.preventDefault();
        Swal.fire({
            icon: 'error',
            title: 'Closed',
            text: 'This request has been closed',
            confirmButtonText: 'OK',
            confirmButtonColor: '#3085d6'
        }).then(() => {
            $("#CancelEventPopupCard").addClass("hidden");
        });
    });

    // Hide the popup and show Submitted message when Submit button is clicked
    $("#submitCancelEventPopupCard").click(function () {
        event.preventDefault();
        Swal.fire({
            icon: 'success',
            title: 'Submitted',
            text: 'This request has been cancelled',
            confirmButtonText: 'OK',
            confirmButtonColor: '#3085d6'
        }).then(() => {
            $("#CancelEventPopupCard").addClass("hidden");
        });
    });
});






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



// ======================== DATATABLES ============================= //
// SET ITEM TABLE DATATABLES
document.addEventListener("DOMContentLoaded", function () {
    // Check if the table exists and simple-datatables is loaded
    if (document.getElementById("SetItemTable") && typeof simpleDatatables !== 'undefined') {
        const dataTable = new simpleDatatables.DataTable("#SetItemTable", {
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

        // document.getElementById("eventApprReqSearch").addEventListener("keyup", function() {
        //     let searchTerm = this.value;
        //     dataTable.search(searchTerm);
        // });
    }
});
// ======================== END OF DATATABLES ============================= //



// ======================== DATATABLES ============================= //
// SET ITEM TABLE DATATABLES
document.addEventListener("DOMContentLoaded", function () {
    // Check if the table exists and simple-datatables is loaded
    if (document.getElementById("CompletedTable") && typeof simpleDatatables !== 'undefined') {
        const dataTable = new simpleDatatables.DataTable("#CompletedTable", {
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

        // document.getElementById("eventApprReqSearch").addEventListener("keyup", function() {
        //     let searchTerm = this.value;
        //     dataTable.search(searchTerm);
        // });
    }
});
// ======================== END OF DATATABLES ============================= //