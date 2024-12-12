// VIEW 1 BUTTON CARD FORM  
$(document).ready(function () {
    $('#viewSuppliesBTN').click(function () {
        console.log('View Supplies Button is Clicked.');
        $('#VwSuppMdl').removeClass('hidden');
    });
});

$(document).ready(function () {
    $('#closeViewSuppFormBTN').click(function () {
        console.log('Close "X" Supplies Button is Clicked.');
        $('#VwSuppMdl').addClass('hidden');
    });
});


// EDIT 1 BUTTON
$(document).ready(function () {
    $('#editSuppliesBTN').click(function () {
        event.preventDefault();
        console.log('View Supplies Button is Clicked.');
        $('#editSUPPLIESMdl').removeClass('hidden');
    });

    $('#closeSUPPLIESFormBTN').click(function () {
        event.preventDefault();
        console.log('Close "X" Supplies Button is Clicked.');
        $('#editSUPPLIESMdl').addClass('hidden');
    });
});

// SELECT ALL BUTTON IN MAIN TABLE 
$(document).ready(function() {
    let isAllChecked = false;
    
    $('#SuppSelectAllBTN').click(function() {
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
    $('#ViewSuppSelectAllBTN').click(function() {
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
    $('#ViewSuppExportBTN').click(function (event) {
        event.preventDefault();
        console.log('View Exported Button is Clicked.');
        $('#dataIncludedModal').removeClass('hidden');
    });

    // Select All button functionality
    $('#VIEWselectAllBtn').click(function () {
        $('#checkboxGroup input[type="checkbox"]').prop('checked', true);
    });

    // Cancel button functionality
    $('#VIEWcancelBtn').click(function () {
        $('#dataIncludedModal').addClass('hidden');
    });

    // Manual checkbox functionality (optional: log which checkbox is clicked)
    $('#checkboxGroup input[type="checkbox"]').change(function () {
        console.log($(this).next('span').text() + ' checkbox state: ' + $(this).prop('checked'));
    });
});


// CONDEM VALIDATION
$(document).ready(function () {
    $("#ViewSuppCondemnedBTN").click(function () {
        event.preventDefault();
        $("#CondemnedSuppliesPopupCard").removeClass("hidden");
    });

    // Hide the popup and show Cancel message when Cancel button is clicked
    $("#closeCondemnedSuppPopupCard").click(function () {
        event.preventDefault();
        Swal.fire({
            icon: 'error',
            title: 'Cancelled',
            text: 'Your action has been cancelled',
            confirmButtonText: 'OK',
            confirmButtonColor: '#D1191A'
        }).then(() => {
            $("#CondemnedSuppliesPopupCard").addClass("hidden");
        });
    });

    // Hide the popup and show Submitted message when Submit button is clicked
    $("#submitCondemnedSuppPopupCard").click(function () {
        event.preventDefault();
        Swal.fire({
            icon: 'success',
            title: 'Submitted',
            text: 'Your action has been successfully submitted',
            confirmButtonText: 'OK',
            confirmButtonColor: '#3085d6'
        }).then(() => {
            $("#CondemnedSuppliesPopupCard").addClass("hidden");
        });
    });
});

// EDIT 2 BUTTON
$(document).ready(function () {
    $('#ViewEditSUPPLIESBTN').click(function () {
        event.preventDefault();
        console.log('Edit Form Button is Clicked.');
        $('#editFullSuppliesMdl').removeClass('hidden');
    });

    $('#closeEditFullSuppliesMdl').click(function () {
        console.log('Close Button is Clicked.');
        $('#editFullSuppliesMdl').addClass('hidden');
    });

    $("#saveFullSUPPBTN").click(function () {
        Swal.fire({
            icon: 'success',
            title: 'Submitted',
            text: 'Your action has been successfully submitted',
            confirmButtonText: 'OK',
            confirmButtonColor: '#3085d6'
        }).then(() => {
            $("#editFullSuppliesMdl").addClass("hidden");
        });
    });

    $("#deleteFullSUPPBTN").click(function () {
        Swal.fire({
            title: "Are you sure you want to delete this Supplies?",
            showDenyButton: true,
            confirmButtonText: "Yes",
            denyButtonText: "No",
            confirmButtonColor: '#3085d6',
            denyButtonColor: '#d33'
        }).then((result) => {
            if (result.isConfirmed) {
                // User clicked "Yes" - proceed with deletion logic
                $("#editFullSuppliesMdl").addClass("hidden");
                // Add your deletion logic here (e.g., an AJAX request)
                console.log("Supplies deleted!");
            } else if (result.isDenied) {
                // User clicked "No" - you can add any other logic here if needed
                console.log("Deletion canceled!");
            }
        });
    });    
});




// MAIN TABLE DATATABLES
document.addEventListener("DOMContentLoaded", function () {
    // Check if the table exists and simple-datatables is loaded
    if (document.getElementById("dynamicTable") && typeof simpleDatatables !== 'undefined') {
        const dataTable = new simpleDatatables.DataTable("#dynamicTable", {
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

        document.getElementById("suppliesSearch").addEventListener("keyup", function () {
            let searchTerm = this.value;
            dataTable.search(searchTerm);
        });
    }
});
