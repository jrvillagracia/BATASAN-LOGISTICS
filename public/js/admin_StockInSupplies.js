// Show the form when "Add Item" button is clicked
$(document).ready(function() {
    $('#SuppliesFormButton').click(function() {
        event.preventDefault();
        console.log('Show Supplies Form Button Clicked');
        $('#SuppliesFormCard').removeClass('hidden');
    });

    // Close the form when "Close" button is clicked
    $('#SuppliesCloseFormButton').click(function() {
        event.preventDefault();
        console.log('Close Form Button Clicked');
        $('#SuppliesFormCard').addClass('hidden'); // Hide the form card
    });

    $(window).on('click', function(e) {
        if ($(e.target).is('#SuppliesFormCard')) {
            $('#SuppliesFormCard').addClass('hidden');
        }
    });
});


// Function to add a new Supplies
$(document).ready(function() {
    // Show the "Other Category" input when "Other" is selected
    $('#SuppliesCategory').change(function() {
        if ($(this).val() === 'other') {
            $('#otherSuppCategoryDiv').removeClass('hidden');
        } else {
            $('#otherSuppCategoryDiv').addClass('hidden');
        }
    });

    // Save Supplies Data
    $('#SuppliesSaveButton').on('click', function (e) {
        e.preventDefault();
        console.log('Save Button Clicked');

        const brandName = $('#SuppliesBrandName').val().trim();
        const name = $('#SuppliesName').val();
        const category = $('#SuppliesCategory').val();
        const otherCategory = $('#otherSuppCategory').val().trim(); 
        const type = $('#SuppliesType').val();
        const color = $('#SuppliesColor').val().trim();
        const unit = $('#SuppliesUnit').val().trim();
        const quantity = $('#SuppliesQuantity').val();
        const date = $('#SuppliesDate').val();
        const uPrice = $('#SuppliesUnitPrice').val();
        const classification = $('#SuppliesClassification').val();
        const sku = $('#SuppliesSKU').val().trim();

        // If "Other" is selected but no custom category is entered, show error
        if (category === 'other' && otherCategory === '') {
            Swal.fire({
                icon: "error",
                title: "Oops...",
                text: "Please enter a category name for 'Other'!",
                showConfirmButton: true,
                confirmButtonColor: '#3085d6'
            });
            return;
        }

        // Use the entered "Other Category" if selected, otherwise use the selected category
        const finalCategory = category === 'other' ? otherCategory : category;

        // Check if all fields are filled
        if (brandName === '' || name === '' || finalCategory === '' || type === '' || color === '' || unit === '' || 
            quantity === '' || date === '' || uPrice === '' || classification === '' || sku === '') {
            Swal.fire({
                icon: "error",
                title: "Oops...",
                text: "Please fill all fields!",
                showConfirmButton: true,
                confirmButtonColor: '#3085d6'
            });
            return;
        }

        Swal.fire({
            icon: "question",
            title: "Confirmation",
            text: "Are you sure all the inputs are correct?",
            showCancelButton: true,
            confirmButtonText: "Yes, Save it!",
            cancelButtonText: "Cancel",
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33'
        }).then((result) => {
            if (result.isConfirmed) {
                // Hide the form immediately
                $('#SuppliesFormCard').addClass('hidden');


        // AJAX request to save the data
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
                    <p>Saving, please wait...</p>
                </div>
            </div>
        `);
        setTimeout(() => {
            // Remove the loader
            $('#save-loader').remove();


            $.ajax({
                url: '/supplies/store',  // Ensure the URL matches the route name
                type: 'POST',
                data: {
                    _token: $('input[name="_token"]').val(),  // Include the CSRF token
                    SuppliesBrandName: brandName,
                    SuppliesName: name,
                    SuppliesCategory: finalCategory,  // Use the final category (custom or selected)
                    SuppliesType: type,
                    SuppliesColor: color,
                    SuppliesUnit: unit,
                    SuppliesQuantity: quantity,
                    SuppliesDate: date,
                    SuppliesUnitPrice: uPrice,
                    SuppliesClassification: classification,
                    SuppliesSKU: sku,
                },
                success: function (response) {
                    Swal.fire({
                        icon: "success",
                        title: response.message,
                        showConfirmButton: true,
                        confirmButtonColor: '#3085d6'
                    }).then(() => {
                        location.reload();
                    });
                },
                error: function (xhr) {
                    Swal.fire({
                        icon: "error",
                        title: "Error",
                        text: xhr.responseText
                    });
                }
            });
        }, 1000);

    }});
});
});


// SUPPLIES EDIT MAIN TABLE FUNCTION 
$(document).ready(function() {
    var csrfToken = $('meta[name="csrf-token"]').attr('content') || $('#csrf-token').data('token');
    console.log('CSRF Token:', csrfToken);

    $.ajaxSetup({
        headers: {
            'X-CSRF-Token': csrfToken
        }
    });

    // Handle category selection changes
    $('#SuppliesCategoryEdit').on('change', function () {
        const category = $(this).val();
        if (category === 'other') {
            $('#otherSuppCategoryDivEdit').removeClass('hidden');
            const otherCategoryValue = $('#editForm').find('#otherSuppCategoryEdit').val();
            $('#otherSuppCategoryEdit').val(otherCategoryValue); // set the value
        } else {
            $('#otherSuppCategoryDivEdit').addClass('hidden');
            $('#otherSuppCategoryEdit').val(''); // Clear the input if not "other"
        }
    });

    // Format unit price with commas
    $('#SuppliesUnitPriceEdit').on('input', function () {
        var value = $(this).val().replace(/,/g, ''); // Remove existing commas
        var formattedValue = parseFloat(value).toLocaleString('en-US'); // Format with commas
        $(this).val(formattedValue);
    });


    // Event delegation for the edit button click
    $(document).on('click', '#editSuppButton', function(event) {
        event.preventDefault();
        console.log('Show Edit Supply Form Button Clicked');

        // Get the clicked row
        var row = $(this).closest('tr');
        var suppliesBrand = row.data('brand');
        var suppliesType = row.data('type');
        var suppliesUnit = row.data('unit');
        var suppliesUnitPrice = row.data('unit-price');
        var suppliesColor = row.data('color');
        var otherCategory = row.data('other-category');
        console.log('Edit button clicked for supplies Brand:', suppliesBrand);

        // Show the edit modal
        $('#editSuppModal').removeClass('hidden');

        // Populate the edit modal fields with data from the row
        $('#editForm').find('#SuppliesBrandNameEdit').val(row.find('td').eq(0).text().trim());
        $('#editForm').find('#SuppliesNameEdit').val(row.find('td').eq(1).text().trim());
        $('#editForm').find('#SuppliesCategoryEdit').val(row.find('td').eq(2).text().trim());
        $('#editForm').find('#SuppliesQuantityEdit').val(parseInt(row.find('td').eq(3).text().trim()));
        $('#editForm').find('#SuppliesSKUEdit').val(row.find('td').eq(5).text().trim());
        $('#editForm').find('#SuppliesClassificationEdit').val(row.find('td').eq(6).text().trim());
        // Set the hidden input field with the supplies brand

        $('#editForm').find('#SuppliesColorEdit').val(suppliesColor);
        $('#editForm').find('#SuppliesTypeEdit').val(suppliesType);
        $('#editForm').find('#SuppliesUnitEdit').val(suppliesUnit);
        $('#editForm').find('#SuppliesUnitPriceEdit').val(suppliesUnitPrice);        
        $('#editForm').find('input[name="brand"]').val(suppliesBrand);

        if (otherCategory === 'other') {
            // Show the "Other" category input and populate it
            $('#otherSuppCategoryDivEdit').removeClass('hidden');
            $('#editForm').find('#otherSuppCategoryEdit').val(otherCategory);
        } else {
            // Hide the "Other" category input
            $('#otherSuppCategoryDivEdit').addClass('hidden');
            $('#editForm').find('#otherSuppCategoryEdit').val('');
        }

    });

    // Handle saving the changes
    $('#saveSuppButton').on('click', function(e) {
        e.preventDefault();

        const category = $('#SuppliesCategoryEdit').val();
        const otherCategory = $('#otherSuppCategoryEdit').val().trim();

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
                    $('#editForm').find('#SuppliesCategoryEdit').val('other');
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
                    url: '/supplies/update-main', 
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
                            $('#editSuppModal').addClass('hidden');
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
            const categoryEdit = $('#SuppliesCategoryEdit').val().trim();
            const otherCategoryEdit = $('#otherSuppCategoryEdit').val().trim();
            const finalCategory = categoryEdit === 'other' ? otherCategoryEdit : categoryEdit;

            row.find('td').eq(0).text($('#SuppliesBrandNameEdit').val().trim()); 
            row.find('td').eq(1).text($('#SuppliesNameEdit').val().trim());
            row.find('td').eq(2).text(finalCategory);
            row.find('td').eq(3).text($('#SuppliesCategoryEdit').val().trim()); 
            row.find('td').eq(5).text($('#SuppliesSKUEdit').val().trim());
            row.find('td').eq(6).text($('#SuppliesClassificationEdit').val().trim());
            console.log('Row updated successfully');
        } else {
            console.log('Row not found for brand:', suppliesBrand);
        }
    }

    // Handle closing the edit modal
    $('#closeSuppFormButton').on('click', function() {
        $('#editSuppModal').addClass('hidden');
    });

    // Close modal when clicking outside of it
    $(window).on('click', function(e) {
        if ($(e.target).is('#editSuppModal')) {
            $('#editSuppModal').addClass('hidden');
        }
    });

    $(window).on('click', function(e) {
        if ($(e.target).is('#ViewSuppModal')) {
            $('#ViewSuppModal').addClass('hidden');
        }
    });
});



// SUPPLIES DELETE FUNCTION 
$(document).ready(function() {
    $('.deleteSuppButton').click(function() {
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
                        $('#editSuppModal').addClass('hidden');

                        // Optionally, remove the item from the UI
                        $('tr[data-brand="'+suppliesBrand+'"]').remove(); // Ensure rows are matched by brand
                    },
                    error: function(xhr) {
                        // Show error message
                        $('#save-loader').remove();
                        Swal.fire({
                            title: "Error!",
                            text: "There was an error deleting the item.",
                            icon: "error"
                        });
                        console.log(xhr.responseText); // Log error details for debugging
                    }
                });
            }
        });
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

        document.getElementById("suppliesSearch").addEventListener("keyup", function() {
            let searchTerm = this.value;
            dataTable.search(searchTerm);
        });
    }
});


// SECONDARY TABLE
document.addEventListener("DOMContentLoaded", function() {
    // Check if the table exists and simple-datatables is loaded
    if (document.getElementById("ViewDynamicTable") && typeof simpleDatatables !== 'undefined') {
        const dataTable = new simpleDatatables.DataTable("#ViewDynamicTable", {
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

        // document.getElementById("SuppliesSearch").addEventListener("keyup", function() {
        //     let searchTerm = this.value;
        //     dataTable.search(searchTerm);
        // });
    }
});


// VIEWING 1 CARD
$(document).ready(function() {
    // Bind click event for the view button
    $(document).on('click', '#viewSuppButton', function() {
        // Use closest 'tr' to find the correct row and get data attributes
        const row = $(this).closest('tr');
        var brandName = row.attr('data-brand');

        console.log('Brand Name:', brandName);
        // Show the modal for viewing details
        $('#ViewSuppModal').removeClass('hidden');

        // AJAX call to fetch supplies details by brand name
        $.ajax({
            url: '/supplies/details',
            type: 'GET',
            data: { SuppliesBrandName: brandName }, 
            success: function(response) {
                console.log('Response:', response);

                // Check if the response contains supplies details
                if (response.suppliesDetails && response.suppliesDetails.length > 0) {
                    // Iterate through the details and log or display them in your modal
                    response.suppliesDetails.forEach(supplies => {
                        console.log(`Supply Detail:`, supplies);
                        // Update modal fields or add elements dynamically as needed
                    });

                    const suppliesDetails = `
                    <p><strong>Brand Name:</strong> ${response.suppliesDetails[0].SuppliesBrandName || 'N/A'}</p>
                    <p><strong>Product Name:</strong> ${response.suppliesDetails[0].SuppliesName || 'N/A'}</p>
                    <p><strong>Category:</strong> ${response.suppliesDetails[0].SuppliesCategory || 'N/A'}</p>
                    <p><strong>SKU:</strong> ${response.suppliesDetails[0].SuppliesSKU || 'N/A'}</p>
                    <p><strong>Color:</strong> ${response.suppliesDetails[0].SuppliesColor || 'N/A'}</p>
                    <p><strong>Type:</strong> ${response.suppliesDetails[0].SuppliesType || 'N/A'}</p>
                    <p><strong>Unit:</strong> ${response.suppliesDetails[0].SuppliesUnit || 'N/A'}</p>
                    <p><strong>Unit Price:</strong> ₱${response.suppliesDetails[0].SuplliesUnitPrice ? Number(response.suppDetails[0].SuppliesUnitPrice).toFixed(2) : '0.00'}</p>
                    <p><strong>Classification:</strong> ${response.suppliesDetails[0].SuppliesClassification || 'N/A'}</p>
                    <p><strong>Date:</strong> ${response.suppliesDetails[0].SuppliesDate || 'N/A'}</p>
                `;

                $('#suppliesDetails').html(suppliesDetails);
                    
                } else {
                    alert('No supplies details found.');
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.error('AJAX Error:', textStatus, errorThrown);
                console.error('Response Text:', jqXHR.responseText);
                alert('Failed to load supplies details: ' + (jqXHR.status ? jqXHR.statusText : 'Unknown error'));
            }
        });
    });

    // Close modal when close button is clicked
    $(document).on('click', '#closeViewSuppFormButton', function() {
        $('#ViewSuppModal').addClass('hidden');
    });

    $(window).on('click', function(e) {
        if ($(e.target).is('#ViewSuppModal')) {
            $('#ViewSuppModal').addClass('hidden');
        }
    });
});




// VIEWING FULL INFORMATION SMALL CARD
$(document).ready(function() {
    // Bind click event for the view button
    $(document).on('click', '.viewSuppBTN', function(event) {
        event.preventDefault(); // Prevent default action
        console.log('Show View Supp Form Button Clicked');

        // Get the closest row to find the Supplies ID
        var row = $(this).closest('tr');
        var suppliesId = row.data('id'); 

        if (suppliesId) {
            console.log('Final Viewing button clicked for supplies ID:', suppliesId);

            // Make an AJAX call to fetch the details
            $.ajax({
                url: '/supplies/final-viewing', 
                type: 'GET',
                data: { id: suppliesId },
                success: function(response) {
                    // Populate the modal with the supplies details
                    let suppliesDetails = `
                        <p><strong>Serial Number:</strong> ${response.SuppliesSerialNo}</p>
                        <p><strong>Control Number:</strong> ${response.SuppliesControlNo}</p>
                        <p><strong>Brand Name:</strong> ${response.SuppliesBrandName}</p>
                        <p><strong>Product Name:</strong> ${response.SuppliesName}</p>
                        <p><strong>Category:</strong> ${response.SuppliesCategory}</p>
                        <p><strong>Type:</strong> ${response.SuppliesType}</p>
                        <p><strong>Color:</strong> ${response.SuppliesColor}</p>
                        <p><strong>Unit:</strong> ${response.SuppliesUnit}</p>
                        <p><strong>Unit Price:</strong> ₱${Number(response.SuppliesUnitPrice).toFixed(2)}</p>
                        <p><strong>Classification:</strong> ${response.SuppliesClassification}</p>
                        <p><strong>Date:</strong> ${response.SuppliesDate}</p>
                    `;
                    $('#SuppliesDetails').html(suppliesDetails); 
                    $('#ViewFullSuppModal').removeClass('hidden');
                },
                error: function(xhr) {
                    console.error('Error fetching supplies details:', xhr.responseJSON);
                }
            });
        } else {
            console.log('No supplies ID found.');
        }
    });

    // Hide the modal when the close button is clicked
    $('#closeViewFullSuppModal').click(function(event) {
        event.preventDefault(); // Prevent default action
        console.log('Close View Form Button Clicked');
        $('#ViewFullSuppModal').addClass('hidden'); 
    });

    // Hide modal on click outside
    $(window).on('click', function(e) {
        if ($(e.target).is('#ViewFullSuppModal')) {
            $('#ViewFullSuppModal').addClass('hidden');
        }
    });
});



// EDIT FUNCTION FOR VIEW TABLE
$(document).ready(function() {
    var csrfToken = $('meta[name="csrf-token"]').attr('content') || $('#csrf-token').data('token');
    console.log('CSRF Token:', csrfToken);

    $.ajaxSetup({
        headers: {
            'X-CSRF-Token': csrfToken
        }
    });

    $(document).on('click', '.editSuppBTN', function(event) {
        event.preventDefault();
        console.log('Edit Supplies Button Clicked');

        var row = $(this).closest('tr');
        var suppliesId = row.data('id'); // Ensure this is set in the HTML
        console.log('Editing supplies with ID:', suppliesId);

        // Show the edit modal
        $('#editFullSuppModal').removeClass('hidden');

        // Populate the edit modal fields with data from the row
        $('#editFullSuppForm').find('#FullSuppliesSerialNoEdit').val(row.find('td').eq(0).text().trim());
        $('#editFullSuppForm').find('#FullSuppliesControlNoEdit').val(row.find('td').eq(1).text().trim());
        $('#editFullSuppForm').find('#FullSuppliesTypeEdit').val(row.find('td').eq(2).text().trim());
        $('#editFullSuppForm').find('#FullSuppliesColorEdit').val(row.find('td').eq(3).text().trim());
        $('#editFullSuppForm').find('#FullSuppliesUnitEdit').val(row.find('td').eq(4).text().trim());
        $('#editFullSuppForm').find('#FullSuppliesUnitPriceEdit').val(row.find('td').eq(5).text().trim());
        $('#editFullSuppForm').find('#FullSuppliesClassificationEdit').val(row.find('td').eq(6).text().trim());
        $('#editFullSuppForm').find('#FullSuppliesDateEdit').val(row.find('td').eq(7).text().trim());

        // Set the hidden input field with the supplies ID for form submission
        $('#editFullSuppForm').find('input[name="id"]').val(suppliesId); // Use supplies ID instead of brand
    });

    // Handle saving the changes
    $('#saveFullSuppButton').on('click', function(e) {
        e.preventDefault();
    
        Swal.fire({
            title: "Are you sure all input data are correct?",
            showDenyButton: true,
            confirmButtonText: "Yes",
            denyButtonText: "No",
            confirmButtonColor: '#3085d6',
            denyButtonColor: '#d33'
        }).then((result) => {
            if (result.isConfirmed) {
                var formData = $('#editFullSuppForm').serialize();
                console.log('Form data to be submitted:', formData);
    
                var suppliesId = $('#editFullSuppForm').find('input[name="id"]').val(); // Ensure ID is set correctly
                console.log('Submitting data for supplies ID:', suppliesId);
                
                $.ajax({
                    url: '/supplies/update-view', // Change the URL to the supplies update endpoint
                    method: 'POST',
                    data: formData,
                    success: function(response) {
                        Swal.fire("Saved!", "", "success").then(() => {
                            updateTableRow(suppliesId); // Update the table row with new data
                            $('#editFullSuppModal').addClass('hidden'); // Close the modal after saving
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

    // Function to update the table row with new data based on ID
    function updateTableRow(suppliesId) {
        var row = $('#tableViewBody').find(`tr[data-id="${suppliesId}"]`); // Find the row by ID
        console.log('Updating row for ID:', suppliesId, row);

        if (row.length > 0) { 
            row.find('td').eq(0).text($('#FullSuppliesSerialNoEdit').val().trim());
            row.find('td').eq(1).text($('#FullSuppliesControlNoEdit').val().trim());
            row.find('td').eq(2).text($('#FullSuppliesTypeEdit').val().trim());
            row.find('td').eq(3).text($('#FullSuppliesColorEdit').val().trim());
            row.find('td').eq(4).text($('#FullSuppliesUnitEdit').val().trim());
            row.find('td').eq(5).text($('#FullSuppliesUnitPriceEdit').val().trim());
            row.find('td').eq(6).text($('#FullSuppliesClassificationEdit').val().trim());
            row.find('td').eq(7).text($('#FullSuppliesDateEdit').val().trim());
            console.log('Row updated successfully');
        } else {
            console.log('Row not found for ID:', suppliesId);
        }
    }

    // Handle closing the edit modal
    $('#closeFullSuppliesFormButton').on('click', function() {
        $('#editFullSuppModal').addClass('hidden');
    });

    // Close modal when clicking outside of it
    $(window).on('click', function(e) {
        if ($(e.target).is('#editFullSuppModal')) {
            $('#editFullSuppModal').addClass('hidden');
        }
    });

    $('#closeEditFullSuppModal').on('click', function() {
        $('#editFullSuppModal').addClass('hidden');
    });
});


// DELETE FUNCTION FOR SUPPLIES ITEM
$(document).ready(function(){
    $('#deleteFullSuppButton').click(function() { 
        // Retrieve the supplies ID from the modal input
        var suppliesId = $('#fullsuppliesId').val();
        var csrfToken = $('#csrf-token').data('token');
        console.log('Deleting supplies ID:', suppliesId);

        // Display confirmation dialog
        Swal.fire({
            title: "Are you sure?",
            text: "You want to delete the selected supplies item?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes",
            cancelButtonText: "No"
        }).then((result) => {
            if (result.isConfirmed) {
                // Perform AJAX request to delete the supplies item
                $.ajax({
                    url: '/supplies/delete-view', // Update the URL to match your delete route for supplies
                    type: 'POST',
                    data: {
                        id: suppliesId,
                        _token: csrfToken // Include CSRF token
                    },
                    success: function(response) {
                        Swal.fire({
                            title: "Deleted!",
                            text: response.message, // Use message from the server response
                            icon: "success",
                            confirmButtonColor: "#3085d6"
                        }).then(() => {
                            // Remove the deleted supplies row from the table
                            $('tr[data-id="'+suppliesId+'"]').remove(); // Ensure row removal is correct
                            $('#editFullSuppModal').addClass('hidden'); // Optionally close the modal
                        });
                    },
                    error: function(xhr) {
                        // Handle errors here
                        var errorMessage = xhr.responseJSON?.message || "There was an error deleting the supplies item.";
                        Swal.fire({
                            title: "Error!",
                            text: errorMessage,
                            icon: "error"
                        });
                        console.log(xhr.responseText);
                    }
                });
            }
        });
    });
});


//Stock In
$(document).ready(function () {
    $(document).on('click', '.editStockInSuppButton', function () {
        $("#StockInSuppliesPopupCard").removeClass("hidden");

        const brandName = $(this).closest('tr').data('brand'); 
        console.log("Selected brand:", brandName);
        
        $("#StockInSuppliesPopupCard").data('brand', brandName);
    });

    $("#closeStockInSuppPopupCard").click(function (event) {
        event.preventDefault();
        $("#StockInSuppliesPopupCard").addClass("hidden");
    });

    // Submit button
    $("#submitStockInSuppPopupCard").click(function (event) {
        event.preventDefault();

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
                    <p>Stocking In, please wait...</p>
                </div>
            </div>
        `);
        // Get the brandName stored in the popup card's data
        const brandName = $("#StockInSuppliesPopupCard").data('brand');
        if (!brandName) {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'No brand name found. Please contact the administrator.',
                confirmButtonText: 'OK',
                confirmButtonColor: '#d33'
            });
            return;
        }

        console.log("SuppBrand to be sent:", brandName);

        $.ajax({
            url: '/supplies/approved',
            method: 'POST',
            data: {
                id: brandName,
                _token: $('meta[name="csrf-token"]').attr('content') 
            },
            success: function (response) {
                $('#save-loader').remove();
                Swal.fire({
                    icon: 'success',
                    title: 'Approved',
                    text: 'Stock in successfully!',
                    confirmButtonText: 'OK',
                    confirmButtonColor: '#3085d6'
                }).then(() => {
                    $("#StockInSuppliesPopupCard").addClass("hidden");
                    location.reload();
                });
            },
            error: function (xhr) {
                $('#save-loader').remove();
                console.log("Error response:", xhr.responseText);
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: xhr.responseJSON.message, 
                    confirmButtonText: 'OK',
                    confirmButtonColor: '#d33'
                });
            }
        });
    });
});



//Auto Populate the Date
document.addEventListener("DOMContentLoaded", function() {
    function formatDateToMMDDYYYY(date) {
        const month = String(date.getMonth() + 1).padStart(2, '0'); 
        const day = String(date.getDate()).padStart(2, '0');
        const year = date.getFullYear();
        return `${month}/${day}/${year}`;
    }

    const today = formatDateToMMDDYYYY(new Date());
    document.getElementById("SuppliesDate").value = today;
});


// LOW STOCK CHECKBOX INSIDE THE ADD FORM
$(document).ready(function () {
    // Toggle visibility of the threshold input based on checkbox state
    $('#lowSuppliesStockAlert').change(function () {
        if ($(this).is(':checked')) {
            $('#lowSuppliesStockThresholdDiv').removeClass('hidden'); // Show input
        } else {
            $('#lowSuppliesStockThresholdDiv').addClass('hidden'); // Hide input
        }
    });
});

// LOW STOCK CHECKBOX INSIDE THE EDIT 1 FORM
$(document).ready(function () {
    // Toggle visibility of the threshold input based on checkbox state
    $('#lowEditSuppliesStockAlert').change(function () {
        if ($(this).is(':checked')) {
            $('#lowEditSuppliesStockThresholdDiv').removeClass('hidden'); // Show input
        } else {
            $('#lowEditSuppliesStockThresholdDiv').addClass('hidden'); // Hide input
        }
    });
});
