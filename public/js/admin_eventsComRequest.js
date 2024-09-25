// ======================== START FOR COMPLETED REQUEST MODULE ============================= //
// VIEW BUTTON CARD FORM      
// THIS IS VIEW BUTTON IS APPLICABLE TO FOR APPROVAL, APPROVE REQUEST, COMPLETED REQUEST
$(document).ready(function () {
    $('#EventComRequestViewBTN').click(function () {
        console.log('View Event Button is Clicked.');
        $('#EventViewComRequestPopupCard').removeClass('hidden');
    });

    $('#closeViewEventComRequestPopupCard').click(function (event) {
        event.preventDefault();  // Prevent form submission or link navigation
        console.log('Close View Button is Clicked.');
        $('#EventViewComRequestPopupCard').addClass('hidden');
    });

    $(document).ready(function() {
        $("#submitViewEventComRequestPopupCard").click(function () {
            event.preventDefault();
            Swal.fire({
                icon: 'success',
                title: 'Submitted',
                text: 'Item Set successfully submitted',
                confirmButtonText: 'OK',
                confirmButtonColor: '#3085d6'
            }).then(() => {
                $("#EventViewComRequestPopupCard").addClass("hidden");
            });
        });
    });
});










// ======================== DATATABLES ============================= //
// MAIN TABLE DATATABLES
document.addEventListener("DOMContentLoaded", function () {
    // Check if the table exists and simple-datatables is loaded
    if (document.getElementById("EventComRequestTable") && typeof simpleDatatables !== 'undefined') {
        const dataTable = new simpleDatatables.DataTable("#EventComRequestTable", {
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

        document.getElementById("eventComRequestSearch").addEventListener("keyup", function() {
            let searchTerm = this.value;
            dataTable.search(searchTerm);
        });
    }
});
// ======================== END OF DATATABLES ============================= //






// ======================== DATATABLES ============================= //
// VIEW TABLE DATATABLES
document.addEventListener("DOMContentLoaded", function () {
    // Check if the table exists and simple-datatables is loaded
    if (document.getElementById("ViewCompletedReqTable") && typeof simpleDatatables !== 'undefined') {
        const dataTable = new simpleDatatables.DataTable("#ViewCompletedReqTable", {
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

        // document.getElementById("eventComRequestSearch").addEventListener("keyup", function() {
        //     let searchTerm = this.value;
        //     dataTable.search(searchTerm);
        // });
    }
});
// ======================== END OF DATATABLES ============================= //
