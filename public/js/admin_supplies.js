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

        const name = $('#SuppliesName').val();
        const category = $('#SuppliesCategory').val();
        const quantity = $('#SuppliesQuantity').val();
        const date = $('#SuppliesDate').val();
        const price = $('#SuppliesPrice').val();
        const department = $('#SuppliesDepartment').val();
        const sku = $('#SuppliesSKU').val();

        if (name === '' || category === '' || quantity === '' || date === '' || price === '' || department === '' || sku === '') {
            Swal.fire({
                icon: "error",
                title: "Oops...",
                showConfirmButton: true,
                text: "Please fill all fields!"
            });
            return;
        }

        // AJAX request to save the data
        $.ajax({
            url: '/supplies/store',  // Ensure the URL matches the route name
            type: 'POST',
            data: {
                _token: $('input[name="_token"]').val(),  // Include the CSRF token
                SuppliesName: name,
                SuppliesCategory: category,
                SuppliesQuantity: quantity,
                SuppliesDate: date,
                SuppliesPrice: price,
                SuppliesDepartment: department,
                SuppliesSKU: sku
            },
            success: function (response) {
                Swal.fire({
                    icon: "success",
                    title: response.message,
                    showConfirmButton: true
                }).then(() => {

                    $('#tableBody').append(`
                        <tr class="cursor-pointer table-row " data-id="${response.suppliesId}">
                            <td class="px-6 py-3">${name}</td>
                            <td class="px-6 py-3">${category}</td>
                            <td class="px-6 py-3">${quantity}</td>
                            <td class="px-6 py-3">${date}</td>
                            <td class="px-6 py-3">${price}</td>
                            <td class="px-6 py-3">${department}</td>
                            <td class="px-6 py-3">${sku}</td>
                            <td class="px-6 py-3">
                                 <button id="editSuppButton" type="button" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">Edit</button>
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
        $('#editForm').find('#SuppliesNameEdit').val(row.find('td').eq(0).text().trim());
        $('#editForm').find('#SuppliesCategoryEdit').val(row.find('td').eq(1).text().trim());
        $('#editForm').find('#SuppliesQuantityEdit').val(row.find('td').eq(2).text().trim());
        $('#editForm').find('#SuppliesDateEdit').val(row.find('td').eq(3).text().trim());
        $('#editForm').find('#SuppliesPriceEdit').val(row.find('td').eq(4).text().replace('₱', '').trim());
        $('#editForm').find('#SuppliesDepartmentEdit').val(row.find('td').eq(5).text().trim());
        $('#editForm').find('#SuppliesSKUEdit').val(row.find('td').eq(6).text().trim());

        // Set the hidden input field with the supplies ID
        $('#editForm').find('input[name="id"]').val(suppId);
    }

    function updateTableRow(equipId) {
        var row = $('#tableBody').find(`tr[data-id="${equipId}"]`);
        console.log('Updating row:', row);

        row.find('td').eq(0).text($('#SuppliesNameEdit').val());
        row.find('td').eq(1).text($('#SuppliesCategoryEdit').val());
        row.find('td').eq(2).text($('#SuppliesQuantityEdit').val());
        row.find('td').eq(3).text($('#SuppliesDateEdit').val());
        row.find('td').eq(4).text($('#SuppliesPriceEdit').val());
        row.find('td').eq(5).text($('#SuppliesDepartmentEdit').val());
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
                        Swal.fire("Error!", "Failed to update supplies: " + errorMessage, "error");
                    }
                });
            } else if (result.isDenied) {
                Swal.fire("Changes are not saved", "", "info");
            }
        });
    });

    // Handle clicking the edit button for supplies
    $('#tableBody').on('click', '#editSuppButton', function(e) {
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
                            icon: "success"
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

// FUNCTION FOR SEARCH
$(document).ready(function() {
    var table = $('#dynamicTable').DataTable({
 
    });

    $('.dt-search').hide();

    // Custom search function
    $('#suppliesSearch').on('keyup', function() {
        console.log('Search input:', this.value); 
        table.search(this.value).draw(); 
    });
});