// VIEW BUTTON CARD FORM      
$(document).ready(function () {
    $('#COMReqViewSupBtn').click(function () {
        console.log('View Equipment Button is Clicked.');
        $('#COMReqSupPopupCard').removeClass('hidden');
    });

    $('#closeCOMReqViewSupPopupCard').click(function () {
        console.log('Close "X" Equipment Button is Clicked.');
        $('#COMReqSupPopupCard').addClass('hidden');
    });

    $('#COMReqSupCancelBTN').click(function () {
        console.log('Cancel View Button is Clicked.');
        $('#COMReqSupPopupCard').addClass('hidden');
    });
});



// SEE MORE BUTTON
$(document).ready(function () {
    $('#COMReqSupSeeMoretBTN').click(function () {
        console.log('View Equipment Button is Clicked.');
        $('#COMReqSeeMoreSupPopupCard').removeClass('hidden');
    });

    $('#closeCOMReqSeeMoreSupPopupCard').click(function () {
        console.log('Close "X" Equipment Button is Clicked.');
        $('#COMReqSeeMoreSupPopupCard').addClass('hidden');
    });

    $('#COMReqSupSeeMoreCloseBTN').click(function () {
        console.log('Cancel View Button is Clicked.');
        $('#COMReqSeeMoreSupPopupCard').addClass('hidden');
    });
});








// ======================== DATATABLES ============================= //
// MAIN TABLE DATATABLES
document.addEventListener("DOMContentLoaded", function () {
    // Check if the table exists and simple-datatables is loaded
    if (document.getElementById("reqSuppTable") && typeof simpleDatatables !== 'undefined') {
        const dataTable = new simpleDatatables.DataTable("#reqSuppTable", {
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

        // document.getElementById("SuppliesSearch").addEventListener("keyup", function() {
        //     let searchTerm = this.value;
        //     dataTable.search(searchTerm);
        // });
    }
});

// COMPLETE REQUEST DATABLES
document.addEventListener("DOMContentLoaded", function () {
    // Check if the table exists and simple-datatables is loaded
    if (document.getElementById("reqCOMREQSupTable") && typeof simpleDatatables !== 'undefined') {
        const dataTable = new simpleDatatables.DataTable("#reqCOMREQSupTable", {
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