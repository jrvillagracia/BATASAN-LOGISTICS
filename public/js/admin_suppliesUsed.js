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

        document.getElementById("suppliesSearch").addEventListener("keyup", function() {
            let searchTerm = this.value;
            dataTable.search(searchTerm);
        });
    }
});

// SELECT ALL BUTTON IN MAIN TABLE 
$(document).ready(function() {
    let isAllChecked = false;
    

    $('#SuppUsedSelectAllBTN').click(function() {
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



// VIEWING CARD
$(document).ready(function() {
    $('#viewSuppUsedButton').click(function() {
        event.preventDefault();
        console.log('Show View Supplies Form Button Clicked');
        $('#ViewSuppUsedModal').removeClass('hidden'); 
    });


    // Hide the form card when the close button is clicked
    $('#closeViewSuppUsedFormButton').click(function() {
        event.preventDefault();
        console.log('Close View Form Button Clicked');
        $('#ViewSuppUsedModal').addClass('hidden'); 
    });
});

// SELECT ALL BUTTON IN VIEW TABLE 
$(document).ready(function() {
    let isAllChecked = false;
    $('#ViewSuppUsedSelectAllBTN').click(function() {
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
    $('#ViewSuppUsedExportBTN').click(function (event) {
        event.preventDefault();
        console.log('View Exported Button is Clicked.');
        $('#UsedSuppDataIncludedModal').removeClass('hidden');
    });

    // Select All button functionality
    $('#VIEWUsedSuppSelectAllBtn').click(function () {
        $('#UsedSuppCheckboxGroup input[type="checkbox"]').prop('checked', true);
    });

    // Cancel button functionality
    $('#VIEWUsedSuppCancelBtn').click(function () {
        $('#UsedSuppDataIncludedModal').addClass('hidden');
    });

    // Manual checkbox functionality (optional: log which checkbox is clicked)
    $('#UsedSuppCheckboxGroup input[type="checkbox"]').change(function () {
        console.log($(this).next('span').text() + ' checkbox state: ' + $(this).prop('checked'));
    });
});