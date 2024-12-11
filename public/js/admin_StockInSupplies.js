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
                    showConfirmButton: true
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
    }
});
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
            $('#otherEquipCategoryDivEdit').removeClass('hidden');
            $('#editForm').find('#otherEquipCategoryEdit').val(otherCategory);
        } else {
            // Hide the "Other" category input
            $('#otherEquipCategoryDivEdit').addClass('hidden');
            $('#editForm').find('#otherEquipCategoryEdit').val('');
        }

    });

    // Handle saving the changes
    $('#saveSuppButton').on('click', function(e) {
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
                var formData = $('#editForm').serialize();
                console.log('Form data:', formData);
    
                // Ensure brand is being set correctly
                var suppliesBrand = $('#editForm').find('input[name="brand"]').val(); 
                console.log('Supplies Brand to be sent:', suppliesBrand); 
                
                $.ajax({
                    url: '/supplies/update-main', 
                    method: 'POST',
                    data: formData,
                    success: function() {
                        Swal.fire("Saved!", "", "success").then(() => {
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
            row.find('td').eq(0).text($('#SuppliesBrandNameEdit').val().trim()); 
            row.find('td').eq(1).text($('#SuppliesNameEdit').val().trim());
            row.find('td').eq(2).text($('#SuppliesCategoryEdit').val().trim()); 
            row.find('td').eq(3).text($('#SuppliesSKUEdit').val().trim());
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
    $('#deleteSuppButton').click(function() {
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
                $.ajax({
                    url: '/supplies/delete',  
                    type: 'POST',
                    data: {
                        brand: suppliesBrand, // Use the brand name for deletion
                        _token: csrfToken  
                    },
                    success: function(response) {
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
        const suppliesId = row.attr('data-id');

        console.log('Brand Name:', brandName);
        console.log('Supplies ID:', suppliesId); 
        console.log(row);

        // Show the modal for viewing/editing details
        $('#ViewSuppModal').removeClass('hidden');
        $('#ViewDynamicTable tbody').empty();

        // AJAX call to fetch supplies details by brand name
        $.ajax({
            url: '/supplies/details', // Update URL if necessary
            type: 'GET',
            data: { SuppliesBrandName: brandName }, 
            success: function(response) {
                console.log('Response:', response);

                // Check if the response contains supplies details
                if (response.suppliesDetails && response.suppliesDetails.length > 0) {
                    response.suppliesDetails.forEach(supplies => {
                        const newRow = `
                            <tr class="odd:bg-blue-100 odd:dark:bg-gray-900 even:bg-white even:dark:bg-gray-800 border-b dark:border-gray-700" data-id="${supplies.id}" data-brand="${supplies.SuppliesBrandName}">
                                <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">${supplies.SuppliesSerialNo}</td>
                                <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">${supplies.SuppliesControlNo}</td>
                                <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    <button class="editSuppBTN" data-form-type="second" type="button">
                                        <svg class="w-[27px] h-[27px] text-blue-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                            <path fill-rule="evenodd" d="M11.32 6.176H5c-1.105 0-2 .949-2 2.118v10.588C3 20.052 3.895 21 5 21h11c1.105 0 2-.948 2-2.118v-7.75l-3.914 4.144A2.46 2.46 0 0 1 12.81 16l-2.681.568c-1.75.37-3.292-1.263-2.942-3.115l.536-2.839c.097-.512.335-.983.684-1.352l2.914-3.086Z" clip-rule="evenodd" />
                                            <path fill-rule="evenodd" d="M19.846 4.318a2.148 2.148 0 0 0-.437-.692 2.014 2.014 0 0 0-.654-.463 1.92 1.92 0 0 0-1.544 0 2.014 2.014 0 0 0-.654.463l-.546.578 2.852 3.02.546-.579a2.14 2.14 0 0 0 .437-.692 2.244 2.244 0 0 0 0-1.635ZM17.45 8.721 14.597 5.7 9.82 10.76a.54.54 0 0 0-.137.27l-.536 2.84c-.07.37.239.696.588.622l2.682-.567a.492.492 0 0 0 .255-.145l4.778-5.06Z" clip-rule="evenodd" />
                                        </svg>
                                    </button>
                                </td>
                                <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    <input id="StockInSuppCheckBox" type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                </td>
                            </tr>
                        `;

                        // Append the new row to the table
                        $('#ViewDynamicTable tbody').append(newRow);
                    });
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
        if ($(e.target).is('#ViewSupppModal')) {
            $('#ViewSupppModal').addClass('hidden');
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

    // Submit button
    $("#submitStockInSuppPopupCard").click(function (event) {
        event.preventDefault();

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

        console.log("equipBrand to be sent:", brandName);

        $.ajax({
            url: '/supplies/approved',
            method: 'POST',
            data: {
                id: brandName,
                _token: $('meta[name="csrf-token"]').attr('content') 
            },
            success: function (response) {
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

