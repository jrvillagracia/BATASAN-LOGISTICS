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
});


// Function to add a new Supplies
$(document).ready(function() {
    $('#SuppliesSaveButton').on('click', function () {
        console.log('Save Button Clicked');

        const controlNo = $('#SuppliesControlNo').val().trim();
        const brandName = $('#SuppliesBrandName').val().trim();
        const name = $('#SuppliesName').val();
        const category = $('#SuppliesCategory').val();
        const type = $('#SuppliesType').val();
        const color = $('#SuppliesColor').val().trim();
        const unit = $('#SuppliesUnit').val().trim();
        const quantity = $('#SuppliesQuantity').val();
        const date = $('#SuppliesDate').val();
        const uPrice = $('#SuppliesUnitPrice').val();
        const classification = $('#SuppliesClassification').val();
        const sku = $('#SuppliesSKU').val().trim();
        const serialNo = $('#SuppliesSerialNo').val().trim();

        if (controlNo === '' || brandName === '' || name === '' || category === '' || type === '' || color === '' || unit === '' || 
            quantity === '' || date === '' || uPrice === '' || classification === '' || sku === '' || serialNo === '') {
            Swal.fire({
                icon: "error",
                title: "Oops...",
                showConfirmButton: true,
                text: "Please fill all fields!",
                confirmButtonColor: '#3085d6'

            });
            return;
        }

        // AJAX request to save the data
        $.ajax({
            url: '/supplies/store',  // Ensure the URL matches the route name
            type: 'POST',
            data: {
                _token: $('input[name="_token"]').val(),  // Include the CSRF token
                SuppliesControlNo: controlNo,
                SuppliesBrandName: brandName,
                SuppliesName: name,
                SuppliesCategory: category,
                SuppliesType: type,
                SuppliesColor: color,
                SuppliesUnit: unit,
                SuppliesQuantity: quantity,
                SuppliesDate: date,
                SuppliesUnitPrice: uPrice,
                SuppliesClassification: classification,
                SuppliesSKU: sku,
                SuppliesSerialNo: serialNo
            },
            success: function (response) {
                Swal.fire({
                    icon: "success",
                    title: response.message,
                    showConfirmButton: true
                }).then(() => {

                    $('#tableBody').append(`
                        <tr class="cursor-pointer table-row " data-id="${response.suppliesId}">
                            <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">${brandName}</td>
                            <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">${name}</td>
                            <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">${category}</td>
                            <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">${quantity}</td>
                            <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">${uPrice}</td>
                            <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">${sku}</td>
                            <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                 <button id="viewSuppButton" type="button">
                                    <svg class="w-[27px] h-[27px] text-green-600 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                        <path stroke="currentColor" stroke-width="2" d="M21 12c0 1.2-4.03 6-9 6s-9-4.8-9-6c0-1.2 4.03-6 9-6s9 4.8 9 6Z" />
                                        <path stroke="currentColor" stroke-width="2" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                    </svg>
                                </button>
                                <button id="editSupppButton" type="button">
                                    <svg class="w-[27px] h-[27px] text-blue-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                        <path fill-rule="evenodd" d="M11.32 6.176H5c-1.105 0-2 .949-2 2.118v10.588C3 20.052 3.895 21 5 21h11c1.105 0 2-.948 2-2.118v-7.75l-3.914 4.144A2.46 2.46 0 0 1 12.81 16l-2.681.568c-1.75.37-3.292-1.263-2.942-3.115l.536-2.839c.097-.512.335-.983.684-1.352l2.914-3.086Z" clip-rule="evenodd" />
                                        <path fill-rule="evenodd" d="M19.846 4.318a2.148 2.148 0 0 0-.437-.692 2.014 2.014 0 0 0-.654-.463 1.92 1.92 0 0 0-1.544 0 2.014 2.014 0 0 0-.654.463l-.546.578 2.852 3.02.546-.579a2.14 2.14 0 0 0 .437-.692 2.244 2.244 0 0 0 0-1.635ZM17.45 8.721 14.597 5.7 9.82 10.76a.54.54 0 0 0-.137.27l-.536 2.84c-.07.37.239.696.588.622l2.682-.567a.492.492 0 0 0 .255-.145l4.778-5.06Z" clip-rule="evenodd" />
                                    </svg>
                                </button>
                            </td>
                        </tr>
                    `);
                    // Clear input fields
                    $('#SuppliesFormCard').addClass('hidden');
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
    });

    $(window).on('click', function(e) {
        if ($(e.target).is('#SuppliesFormCard')) {
            $('#SuppliesFormCard').addClass('hidden');
        }
    });
});

// SUPPLIES EDIT FUNCTION 
$(document).ready(function() {
    var csrfToken = $('meta[name="csrf-token"]').attr('content') || $('#csrf-token').data('token');
    console.log('CSRF Token:', csrfToken);

    $.ajaxSetup({
        headers: {
            'X-CSRF-Token': csrfToken
        }
    });

    // Function to open the edit modal and populate the form with row data
    function openEditSuppModal(row) {
        var suppId = row.data('id');
        console.log('Edit button clicked for supplies ID:', suppId);

        $('#editSuppModal').removeClass('hidden');
        $('#editForm').find('#SuppliesBrandNameEdit').val(row.find('td').eq(0).text().trim());
        $('#editForm').find('#SuppliesNameEdit').val(row.find('td').eq(1).text().trim());
        $('#editForm').find('#SuppliesCategoryEdit').val(row.find('td').eq(3).text().trim());
        $('#editForm').find('#SuppliesSKUEdit').val(row.find('td').eq(6).text().trim());

        // Set the hidden input field with the supplies ID
        $('#editForm').find('input[name="id"]').val(suppId);
    }

    function updateTableRow(SuppId) {
        var row = $('#tableBody').find(`tr[data-id="${SuppId}"]`);
        console.log('Updating row:', row);

        row.find('td').eq(0).text($('#SuppliesNameEdit').val());
        row.find('td').eq(1).text($('#SuppliesCategoryEdit').val());
        row.find('td').eq(3).text($('#SuppliesBrandNameEdit').val());
        row.find('td').eq(6).text($('#SuppliesSKUEdit').val());
    }

    // Handle saving the changes
    $('#saveSuppButton').on('click', function(e) {
        e.preventDefault();

        Swal.fire({
            title: "Are you sure all input data are correct?",
            showDenyButton: true,
            confirmButtonText: "Yes",
            denyButtonText: "No"
        }).then((result) => {
            if (result.isConfirmed) {
                var formData = $('#editForm').serialize();
                console.log('Form data:', formData);

                $.ajax({
                    url: $('#editForm').attr('action'),
                    method: 'POST',
                    data: formData,
                    success: function() {
                        Swal.fire("Saved!", "", "success").then(() => {
                            var suppId = $('#editForm').find('input[name="id"]').val();
                            updateTableRow(suppId); // Call the function to update the table row
                            $('#editSuppModal').addClass('hidden');
                        });
                    },
                    error: function(xhr, status, error) {
                        var errorMessage = xhr.responseJSON.message || error;
                        console.log('Error:', errorMessage);
                        console.log("Error Status: ", xhr.status);
                        console.log("Error Response: ", xhr.responseText);
                        console.log("Error Details: ", error);
                        Swal.fire("Error!", "Failed to update supplies: " + errorMessage, "error");
                    }
                });
            } else if (result.isDenied) {
                Swal.fire("Changes are not saved", "", "info");
            }
        });
    });

    // Handle clicking the edit button for supplies
    $('#dynamicTable tbody').on('click', '#editSuppButton', function(e) {
        e.preventDefault();
        var row = $(this).closest('tr');
        openEditSuppModal(row);
    });

    // Handle closing the edit modal
    $('#closeSuppFormButton').on('click', function() {
        $('#editSuppModal').addClass('hidden');
    });

    $(window).on('click', function(e) {
        if ($(e.target).is('#editSuppModal')) {
            $('#editSuppModal').addClass('hidden');
        }
    });
});


$(document).ready(function() {
    $('#SuppliesCategory').change(function() {
        if ($(this).val() === 'other') {
            $('#otherSuppCategoryDiv').removeClass('hidden');
        } else {
            $('#otherSuppCategoryDiv').addClass('hidden');
        }
    });
});



// SUPPLIES DELETE FUNCTION 
$(document).ready(function(){
    $('#deleteSuppButton').click(function() {
        var suppliesId = $('#suppliesId').val();
        var csrfToken = $('#csrf-token').data('token'); 

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
                        id: suppliesId,
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
                        $('tr[data-id="'+suppliesId+'"]').remove();
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


// VIEWING CARD
$(document).ready(function() {
    $('#viewSuppButton').click(function() {
        event.preventDefault();
        console.log('Show View Supplies Form Button Clicked');
        $('#ViewSuppModal').removeClass('hidden'); 
    });


    // Hide the form card when the close button is clicked
    $('#closeViewSuppFormButton').click(function() {
        event.preventDefault();
        console.log('Close View Form Button Clicked');
        $('#ViewSuppModal').addClass('hidden'); 
    });
});

// VIEWING FULL INFORMATION SMALL CARD
$(document).ready(function() {
    $('#viewSuppBTN').click(function() {
        event.preventDefault();
        console.log('Show View Supp Form Button Clicked');
        $('#ViewFullSuppModal').removeClass('hidden'); 
    });


    // Hide the form card when the close button is clicked
    $('#closeViewFullSuppModal').click(function() {
        event.preventDefault();
        console.log('Close View Form Button Clicked');
        $('#ViewFullSuppModal').addClass('hidden'); 
    });
});


// EDIT FULL INFORMATION SMALL CARD
$(document).ready(function() {
    var csrfToken = $('meta[name="csrf-token"]').attr('content') || $('#csrf-token').data('token');
    console.log('CSRF Token:', csrfToken);

    $.ajaxSetup({
        headers: {
            'X-CSRF-Token': csrfToken
        }
    });

    // Function to open the edit modal and populate the form with row data
    function openEditModal(row) {
        var SuppId = row.data('id');
        console.log('Edit button clicked for supplies ID:', SuppId);

        $('#editFullSuppModal').removeClass('hidden');
        $('#editFullSuppForm').find('#FullSuppliesSerialNoEdit').val(row.find('td').eq(0).text().trim());
        $('#editFullSuppForm').find('#FullSuppliesControlNoEdit').val(row.find('td').eq(1).text().trim());
        $('#editFullSuppForm').find('#FullSuppliesTypeEdit').val(row.find('td').eq(2).text().trim());
        $('#editFullSuppForm').find('#FullSuppliesColorEdit').val(row.find('td').eq(3).text().trim());
        $('#editFullSuppForm').find('#FullSuppliesUnitEdit').val(row.find('td').eq(4).text().trim());
        $('#editFullSuppForm').find('#FullSuppliesUnitPriceEdit').val(row.find('td').eq(5).text().trim());
        $('#editFullSuppForm').find('#FullSuppliesClassificationEdit').val(row.find('td').eq(6).text().trim());
        $('#editFullSuppForm').find('#FullSuppliesDateEdit').val(row.find('td').eq(7).text().trim());

        // Set the hidden input field with the Supplies ID
        $('#editFullSuppForm').find('input[name="id"]').val(SuppId);
    }

    // Function to update the table row with new data
    function updateTableRow(SuppId) {
        var row = $('#tableViewBody').find(`tr[data-id="${SuppId}"]`);
        console.log('Updating row:', row);

        row.find('td').eq(0).text($('#SuppliesSerialNoEdit').val());
        row.find('td').eq(1).text($('#SuppliesControlNoEdit').val());
        row.find('td').eq(0).text($('#SuppliesTypeEdit').val());
        row.find('td').eq(0).text($('#SuppliesColorEdit').val());
        row.find('td').eq(0).text($('#SuppliesUnitEdit').val());
        row.find('td').eq(0).text($('#SuppliesUnitPriceEdit').val());
        row.find('td').eq(0).text($('#SuppliesClassificationEdit').val());
        row.find('td').eq(0).text($('#SuppliesDateEdit').val());
    }

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
                console.log('Form data:', formData);

                $.ajax({
                    url: $('#editFullSuppForm').attr('action'),
                    method: 'POST',
                    data: formData,
                    success: function() {
                        Swal.fire("Saved!", "", "success").then(() => {
                            var SuppId = $('#editFullSuppForm').find('input[name="id"]').val();
                            updateTableRow(SuppId); // Update the table row with new data
                            $('#editFullSuppModal').addClass('hidden');
                        });
                    },
                    error: function(xhr, status, error) {
                        var errorMessage = xhr.responseJSON.message || error;
                        console.log('Error:', errorMessage);
                        Swal.fire("Error!", "Failed to update Supplies: " + errorMessage, "error");
                    }
                });
            } else if (result.isDenied) {
                Swal.fire("Changes are not saved", "", "info");
            }
        });
    });

    // Handle clicking the edit button
    $('#ViewDynamicTable tbody').on('click', '#editSuppBTN', function() {
        var row = $(this).closest('tr');
        openEditModal(row);
    });

    // Handle closing the edit modal
    $('#closeEditFullSuppModal').on('click', function() {
        $('#editFullSuppModal').addClass('hidden');
    });

    // Close modal when clicking outside of it
    $(window).on('click', function(e) {
        if ($(e.target).is('#editFullSuppModal')) {
            $('#editFullSuppModal').addClass('hidden');
        }
    });
});

// ADD BUTTON TO FULL INFORMATION CARD
$(document).ready(function() {
    $('#addSuppBTN').click(function() {
        event.preventDefault();
        console.log('Show Supp Form Button Clicked');
        $('#AddSuppFormCard').removeClass('hidden'); 
    });


    // Hide the form card when the close button is clicked
    $('#AddSuppCloseFormButton').click(function() {
        event.preventDefault();
        console.log('Close Form Button Clicked');
        $('#AddSuppFormCard').addClass('hidden'); 
    });
});