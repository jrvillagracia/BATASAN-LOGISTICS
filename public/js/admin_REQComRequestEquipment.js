// VIEW BUTTON CARD FORM      
$(document).ready(function () {
    $('#COMReqViewEquipBtn').click(function () {
        console.log('View Equipment Button is Clicked.');
        $('#COMReqEquipPopupCard').removeClass('hidden');
    });

    $('#closeCOMReqViewEquipPopupCard').click(function () {
        event.preventDefault();
        console.log('Close "X" Equipment Button is Clicked.');
        $('#COMReqEquipPopupCard').addClass('hidden');
    });

    $('#COMReqCancelBTN').click(function () {
        event.preventDefault();
        console.log('Cancel View Button is Clicked.');
        $('#COMReqEquipPopupCard').addClass('hidden');
    });
});



// SEE MORE BUTTON
$(document).ready(function () {
    $('#COMReqSeeMoretBTN').click(function () {
        event.preventDefault();
        console.log('View Equipment Button is Clicked.');
        $('#COMReqSeeMorequipPopupCard').removeClass('hidden');
    });

    $('#closeCOMReqSeeMoreEquipPopupCard').click(function () {
        event.preventDefault();
        console.log('Close "X" Equipment Button is Clicked.');
        $('#COMReqSeeMorequipPopupCard').addClass('hidden');
    });

    $('#COMReqSeeMoreCloseBTN').click(function () {
        event.preventDefault();
        console.log('Cancel View Button is Clicked.');
        $('#COMReqSeeMorequipPopupCard').addClass('hidden');
    });
});















// ======================== DATATABLES ============================= //
// MAIN TABLE DATATABLES
document.addEventListener("DOMContentLoaded", function () {
    // Check if the table exists and simple-datatables is loaded
    if (document.getElementById("reqEquipTable") && typeof simpleDatatables !== 'undefined') {
        const dataTable = new simpleDatatables.DataTable("#reqEquipTable", {
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

// SET ITEM TABLE DATATABLES
document.addEventListener("DOMContentLoaded", function () {
    // Check if the table exists and simple-datatables is loaded
    if (document.getElementById("reqCOMREQEquipTable") && typeof simpleDatatables !== 'undefined') {
        const dataTable = new simpleDatatables.DataTable("#reqCOMREQEquipTable", {
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