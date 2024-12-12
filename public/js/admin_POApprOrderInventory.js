// VIEW 
$(document).ready(function () {
    $("#POApprOrderViewBTN").click(function () {
        $("#ViewApprOrderPOPopupCard").removeClass("hidden");
    });

    $("#closeViewApprOrderPOPopupCard").click(function () {
        event.preventDefault();
        $("#ViewApprOrderPOPopupCard").addClass('hidden');
    });
});

// APPROVE BUTTON CARD FORM
$(document).ready(function () {
    $("#POApprOrderCompleteBTN").click(function () {
        $("#ApprOrderProductInventoryPopupCard").removeClass("hidden");
    });

    // Hide the popup and show Cancel message when Cancel button is clicked
    $("#closeApprOrderProductInventoryPopupCard").click(function () {
        event.preventDefault();
        Swal.fire({
            icon: 'error',
            title: 'Cancelled',
            text: 'Your action has been cancelled',
            confirmButtonText: 'OK',
            confirmButtonColor: '#D1191A'
        }).then(() => {
            $("#ApprOrderProductInventoryPopupCard").addClass("hidden");
        });
    });

    // Hide the popup and show Submitted message when Submit button is clicked
    $("#submitApprOrderProductInventoryPopupCard").click(function () {
        event.preventDefault();
        Swal.fire({
            icon: 'success',
            title: 'Submitted',
            text: 'Your action has been successfully submitted',
            confirmButtonText: 'OK',
            confirmButtonColor: '#3085d6'
        }).then(() => {
            $("#ApprOrderProductInventoryPopupCard").addClass("hidden");
        });
    });
});

// ======================== DATATABLES ============================= //
// MAIN TABLE DATATABLES
document.addEventListener("DOMContentLoaded", function () {
    // Check if the table exists and simple-datatables is loaded
    if (document.getElementById("POTable") && typeof simpleDatatables !== 'undefined') {
        const dataTable = new simpleDatatables.DataTable("#POTable", {
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


// VIEW Table
document.addEventListener("DOMContentLoaded", function () {
    // Check if the table exists and simple-datatables is loaded
    if (document.getElementById("POViewTable") && typeof simpleDatatables !== 'undefined') {
        const dataTable = new simpleDatatables.DataTable("#POViewTable", {
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