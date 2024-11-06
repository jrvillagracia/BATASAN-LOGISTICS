// VIEW CONDEMNED MODAL
$(document).ready(function() {
    $('#viewCondEquipButton').click(function() {
        event.preventDefault();
        console.log('Show View Equip Form Button Clicked');
        $('#ViewCondEquipModal').removeClass('hidden'); 
    });


    // Hide the form card when the close button is clicked
    $('#closeViewCondEquipModal').click(function() {
        event.preventDefault();
        console.log('Close View Form Button Clicked');
        $('#ViewCondEquipModal').addClass('hidden'); 
    });
});


// MAIN TABLE DATATABLES
document.addEventListener("DOMContentLoaded", function() {
    // Check if the table exists and simple-datatables is loaded
    if (document.getElementById("dynamicTable") && typeof simpleDatatables !== 'undefined') {
        const dataTable = new simpleDatatables.DataTable("#dynamicTable", {
            searchable: false,
            perPageSelect: [5, 10, 20, 50],
            perPage: 5,
            firstLast: true,
            nextPrev: true,
            sortable: true,

            labels:{
                info: "Showing <strong>{start}</strong> - <strong>{end}</strong> of <strong>{rows}</strong>",
            }
        });

        document.getElementById("equipmentSearch").addEventListener("keyup", function() {
            let searchTerm = this.value;
            dataTable.search(searchTerm);
        });
    }
});
