// VIEW 1 BUTTON CARD FORM  
jQuery(function() {
    $(document).on('click', '#viewSuppliesBTN', function() {
        const row = $(this).closest('tr');
        const brandName = row.attr('data-brand');

        // Show modal
        $('#VwSuppModal').removeClass('hidden');

        // Fetch data via AJAX
        $.ajax({
            url: '/supplies/details2',
            type: 'GET',
            data: { SuppliesBrandName: brandName },
            success: function(response) {
                if (response.suppliesDetails && response.suppliesDetails.length > 0) {
                    const suppliesDetails = response.suppliesDetails.map(supplies => `
                        <div><strong>Brand Name:</strong> ${supplies.SuppliesBrandName || 'N/A'}</div>
                        <div><strong>Color:</strong> ${supplies.SuppliesColor || 'N/A'}</div>
                        <div><strong>Product Name:</strong> ${supplies.SuppliesName || 'N/A'}</div>
                        <div><strong>Unit:</strong> ${supplies.SuppliesUnit || 'N/A'}</div>
                        <div><strong>Category:</strong> ${supplies.SuppliesCategory || 'N/A'}</div>
                        <div><strong>Unit Price:</strong> ₱${supplies.SuppliesUnitPrice ? Number(supplies.SuppliesUnitPrice).toFixed(2) : '0.00'}</div>
                        <div><strong>SKU:</strong> ${supplies.SuppliesSKU || 'N/A'}</div>
                        <div><strong>Classification:</strong> ${supplies.SuppliesClassification || 'N/A'}</div>
                        <div><strong>Type:</strong> ${supplies.SuppliesType || 'N/A'}</div>
                        <div><strong>Date:</strong> ${supplies.SuppliesDate || 'N/A'}</div>
                    `).join('');
                    $('#suppliesDetails').html(suppliesDetails);
                } else {
                    $('#suppliesDetails').html('<p>No supplies details found.</p>');
                }
            },
            error: function(xhr, status, error) {
                console.error("AJAX Error: ", error);
                $('#suppliesDetails').html('<p>Error loading supplies details.</p>');
            }
        });
    });

    // Close modal
    $(document).on('click', '#closeViewSuppFormBTN', function() {
        $('#VwSuppModal').addClass('hidden');
    });
});


// EDIT 1 BUTTON CARD FORM
jQuery(function() {
    var csrfToken = $('meta[name="csrf-token"]').attr('content') || $('#csrf-token').data('token');
    console.log('CSRF Token:', csrfToken);

    $.ajaxSetup({
        headers: {
            'X-CSRF-Token': csrfToken
        }
    });

    // Handle category selection changes
    $('#SUPPLIESCategoryEDT').on('change', function () {
        const category = $(this).val();
        if (category === 'other') {
            $('#otherSUPPLIESCategoryEDT').removeClass('hidden');
            const otherCategoryValue = $('#editForm').find('#otherSUPPLIESCategoryEDT').val();
            $('#otherSUPPLIESCategoryEDT').val(otherCategoryValue); // set the value
        } else {
            $('#otherSuppCategoryDiv').addClass('hidden');
            $('#otherSUPPLIESCategoryEDT').val(''); // Clear the input if not "other"
        }
    });

    // Format unit price with commas
    $('#SUPPLIESUnitPriceEDT').on('input', function () {
        var value = $(this).val().replace(/,/g, ''); // Remove existing commas
        var formattedValue = parseFloat(value).toLocaleString('en-US'); // Format with commas
        $(this).val(formattedValue);
    });


    // Event delegation for the edit button click
    $(document).on('click', '#editSuppliesBTN', function(event) {
        event.preventDefault();
        console.log('Show Edit Supply Form Button Clicked');

        // Get the clicked row
        var row = $(this).closest('tr');
        var suppliesBrand = row.data('brand');
        var suppliesType = row.data('type');
        var suppliesUnit = row.data('unit');
        var suppliesUnitPrice = row.data('unit-price');
        var suppliesColor = row.data('color');
        var suppliesClassification = row.data('classification');
        var otherCategory = row.data('other-category');
        console.log('Edit button clicked for supplies Brand:', suppliesBrand);

        // Show the edit modal
        $('#editSUPPLIESMdl').removeClass('hidden');

        // Populate the edit modal fields with data from the row
        $("#SUPPLIESBrandNameEDT").val(row.find('td').eq(1).text().trim());
        $("#SUPPLIESNameEDT").val(row.find('td').eq(2).text().trim());
        $("#SUPPLIESCategoryEDT").val(row.find('td').eq(3).text().trim());
        $("#SUPPLIESQuantityEDT").val(parseInt(row.find('td').eq(4).text().trim()));
        $("#SUPPLIESSKUEDT").val(row.find('td').eq(6).text().trim());

        // Set the hidden input field with the supplies brand
        $("#SUPPLIESClassificationEDT").val(suppliesClassification);
        $("#SUPPLIESColorEDT").val(suppliesColor);
        $("#SUPPLIESTypeEDT").val(suppliesType);
        $("#SUPPLIESUnitEDT").val(suppliesUnit);
        $("#SUPPLIESUnitPriceEDT").val(suppliesUnitPrice);        
        $('input[name="brand"]').val(suppliesBrand);

        if (otherCategory === 'other') {
            // Show the "Other" category input and populate it
            $('#otherSuppCategoryDivEdit').removeClass('hidden');
            $('#editForm').find('#otherSuppCategoryEdit').val(otherCategory);
        } else {
            // Hide the "Other" category input
            $('#otherSuppCategoryDiv').addClass('hidden');
            $('#editForm').find('#otherSUPPLIESCategoryEDT').val('');
        }

    });

    // Handle saving the changes
    $('#saveSUPPBTN').on('click', function(e) {
        e.preventDefault();

        const category = $('#SUPPLIESCategoryEDT').val();
        const otherCategory = $('#otherSUPPLIESCategoryEDT').val().trim();

        Swal.fire({
            title: "Are you sure all input data are correct?",
            showDenyButton: true,
            confirmButtonText: "Yes",
            denyButtonText: "No",
            confirmButtonColor: '#3085d6',
            denyButtonColor: '#d33'
        }).then((result) => {
            if (result.isConfirmed) {
                if (category === 'other' && otherCategory === '') {
                    Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: "Please enter a category name for 'Other'!",
                        showConfirmButton: true,
                        confirmButtonColor: '#3085d6'
                    });
                    return; // Stop further execution
                }

                if (category === 'other') {
                    $('#editForm').find('#SUPPLIESCategoryEDT').val('other');
                }

                var formData = $('#editForm').serialize();
                console.log('Form data:', formData);
    
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
                            <p>Saving...</p>
                        </div>
                    </div>
                `);

                // Ensure brand is being set correctly
                var suppliesBrand = $('#editForm').find('input[name="brand"]').val(); 
                console.log('Supplies Brand to be sent:', suppliesBrand); 

                $.ajax({
                    url: '/suppliesStock/update', 
                    method: 'POST',
                    data: formData,
                    success: function() {
                        $('#save-loader').remove();
                        Swal.fire({
                            title: "Saved!",
                            text: "",
                            icon: "success",
                            confirmButtonText: "OK",
                            confirmButtonColor: "#3085d6" // Set the color of the confirmation button
                        }).then(() => {
                            updateTableRow(suppliesBrand); // Update the table row with new data
                            $('#editSUPPLIESMdl').addClass('hidden');
                        });
                    },
                    error: function(xhr, status, error) {
                        var errorMessage = xhr.responseJSON.message || error;
                        console.log('Error:', errorMessage);
                        Swal.fire("Error!", "Failed to update supplies: " + errorMessage, "error");
                    }
                });
            } else if (result.isDenied) {
                Swal.fire("Changes are not saved", "", "info");
            }
            
        });
    });

    // Function to update the table row with new data based on brand
    function updateTableRow(suppliesBrand) {
        var row = $('#tableBody').find(`tr[data-brand="${suppliesBrand}"]`); 
        console.log('Updating row:', row);

        if (row.length > 0) { 
            const categoryEdit = $('#SUPPLIESCategoryEDT').val().trim();
            const otherCategoryEdit = $('#otherSUPPLIESCategoryEDT').val().trim();
            const finalCategory = categoryEdit === 'other' ? otherCategoryEdit : categoryEdit;

            row.find('td').eq(0).text($('#SUPPLIESBrandNameEDT').val().trim()); 
            row.find('td').eq(1).text($('#SUPPLIESNameEDT').val().trim());
            row.find('td').eq(2).text(finalCategory);
            row.find('td').eq(3).text($('#SUPPLIESCategoryEDT').val().trim()); 
            row.find('td').eq(5).text($('#SUPPLIESSKUEDT').val().trim());
            console.log('Row updated successfully');
        } else {
            console.log('Row not found for brand:', suppliesBrand);
        }
    }

    // Handle closing the edit modal
    $('#closeSUPPLIESFormBTN').on('click', function() {
        $('#editSUPPLIESMdl').addClass('hidden');
    });

    // Close modal when clicking outside of it
    $(window).on('click', function(e) {
        if ($(e.target).is('#editSUPPLIESMdl')) {
            $('#editSUPPLIESMdl').addClass('hidden');
        }
    });

    $(window).on('click', function(e) {
        if ($(e.target).is('#ViewSuppModal')) {
            $('#ViewSuppModal').addClass('hidden');
        }
    });
});

// SELECT ALL BUTTON IN MAIN TABLE 
$(document).ready(function() {
    let isAllChecked = false;
    
    $('#SuppSelectAllBTN').click(function(event) {
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
jQuery(function () {
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
                    url: '/suppliesStock/delete',  
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
