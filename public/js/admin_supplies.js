// VIEW 1 BUTTON CARD FORM  
$(document).ready(function () {
    $('.viewSuppliesssBTN').click(function () {
        console.log('View Supplies Button is Clicked.');
        $('#VwSuppModal').removeClass('hidden');
    });

    $('#closeViewSuppFormBTN').click(function () {
        console.log('Close "X" Supplies Button is Clicked.');
        $('#VwSuppModal').addClass('hidden');

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




// DELETE FUNCTION
$(document).ready(function() {
    $('.deleteSUPPBTN').click(function() {
        var suppliesBrand = $(this).data('brand');
        var csrfToken = $('#csrf-token').data('token');

        // Check if suppliesBrand is retrieved correctly
        console.log('Supplies Brand to delete:', suppliesBrand);

        Swal.fire({
            title: "Are you sure?",
            text: "You want to delete the selected Supplies item?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes",
            cancelButtonText: "No"
        }).then((result) => {
            if (result.isConfirmed) {
                // Send AJAX request to the server to delete the item
                $('body').append(`
                    <div id="save-loader" class="fixed inset-0 bg-gray-800 bg-opacity-50 flex flex-col items-center justify-center z-50">
                        <section class="dots-container">
                            <div class="dot"></div>
                            <div class="dot"></div>
                            <div class="dot"></div>
                            <div class="dot"></div>
                            <div class="dot"></div>
                        </section>
                        <div class="dot-loader-dialog">
                            <p>Deleting...</p>
                        </div>
                    </div>
                `);
                $.ajax({
                    url: '/supplies/delete',  
                    type: 'POST',
                    data: {
                        brand: suppliesBrand, // Use the brand name for deletion
                        _token: csrfToken  
                    },
                    success: function(response) {
                        $('#save-loader').remove();
                        Swal.fire({
                            title: "Deleted!",
                            text: "The supplies item has been deleted.",
                            icon: "success",
                            confirmButtonColor: "#3085d6"
                        });

                        // Close the modal
                        $('#editSUPPLIESMdl').addClass('hidden');

                        // Optionally, remove the item from the UI
                        $('tr[data-brand="'+suppliesBrand+'"]').remove(); // Ensure rows are matched by brand
                    },
                    error: function(xhr) {
                        // Show error message
                        $('#save-loader').remove();
                        Swal.fire({
                            title: "Error!",
                            text: "There was an error deleting the item.",
                            icon: "error",
                            confirmButtonColor: "#3085d6"
                        });
                        console.log(xhr.responseText); // Log error details for debugging
                    }
                });
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

// LOW STOCK CHECKBOX INSIDE THE EDIT 1 FORM
$(document).ready(function () {
    // Toggle visibility of the threshold input based on checkbox state
    $('#lowEditSupplies2StockAlert').change(function () {
        if ($(this).is(':checked')) {
            $('#lowEditSupplies2StockThresholdDiv').removeClass('hidden'); // Show input
        } else {
            $('#lowEditSupplies2StockThresholdDiv').addClass('hidden'); // Hide input
        }
    });
});
