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


// SELECT ALL BUTTON IN MAIN TABLE 
$(document).ready(function() {
    let isAllChecked = false;
    

    $('#EquipCondSelectAllBTN').click(function() {
        event.preventDefault();
        isAllChecked = !isAllChecked;
        $('#dynamicTable').find('input[type="checkbox"]').prop('checked', isAllChecked);

        if (isAllChecked) {
            $(this).text('Unselect All');
        } else {
            $(this).text('Select All');
        }
    });
});


// SELECT ALL BUTTON IN VIEW TABLE 
$(document).ready(function() {
    let isAllChecked = false;
    $('#ViewEquipCondSelectAllBTN').click(function() {
        event.preventDefault();
        isAllChecked = !isAllChecked;
        $('#ViewDynamicTable').find('input[type="checkbox"]').prop('checked', isAllChecked);

        if (isAllChecked) {
            $(this).text('Unselect All');
        } else {
            $(this).text('Select All');
        }
    });
});

// VIEW DATA EXPORT CHECKBOXES BUTTON CARD
$(document).ready(function () {
    // Show the modal when "View Equip Export" button is clicked
    $('#ViewEquipCondExportBTN').click(function (event) {
        event.preventDefault();
        console.log('View Exported Button is Clicked.');
        $('#CondEquipDataIncludedModal').removeClass('hidden');
    });

    // Select All button functionality
    $('#VIEWCondselectAllBtn').click(function () {
        $('#CondCheckboxGroup input[type="checkbox"]').prop('checked', true);
    });

    // Cancel button functionality
    $('#VIEWCondcancelBtn').click(function () {
        $('#CondEquipDataIncludedModal').addClass('hidden');
    });

    // Manual checkbox functionality (optional: log which checkbox is clicked)
    $('#CondCheckboxGroup input[type="checkbox"]').change(function () {
        console.log($(this).next('span').text() + ' checkbox state: ' + $(this).prop('checked'));
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
