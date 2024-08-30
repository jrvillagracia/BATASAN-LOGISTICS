// Show the form when "Add Item" button is clicked
$(document).ready(function() {
    $('#EquipFormButton').click(function() {
        event.preventDefault();
        console.log('Show Equip Form Button Clicked');
        $('#EquipFormCard').removeClass('hidden'); 
    });

    $('#closeSuppFormButton').on('click', function() {
        $('#editSuppModal').addClass('hidden');
    });

    // Hide the form card when the close button is clicked
    $('#EquipCloseFormButton').click(function() {
        event.preventDefault();
        console.log('Close Form Button Clicked');
        $('#EquipFormCard').addClass('hidden'); 
    });
});


// Function to add a new Equipment
$(document).ready(function() {
    // Handle saving a new equipment
    $('#EquipmentSaveButton').on('click', function() {
        console.log('Save Button Clicked');

        const name = $('#EquipmentName').val().trim();
        const category = $('#EquipmentCategory').val();
        const quantity = $('#EquipmentQuantity').val().trim();
        const date = $('#EquipmentDate').val().trim();
        const price = $('#EquipmentPrice').val().trim();
        const department = $('#EquipmentDepartment').val();
        const sku = $('#EquipmentSKU').val().trim();

        // Check if all fields are filled
        if (name === '' || category === '' || quantity === '' || date === '' || price === '' || department === '' || sku === '') {
            Swal.fire({
                icon: "error",
                title: "Oops...",
                text: "Please fill all fields!",
                showConfirmButton: true
            });
            return;
        }

        // AJAX request to save the data
        $.ajax({
            url: '/equipment/store',  // Ensure this URL is correct
            type: 'POST',
            data: {
                _token: $('input[name="_token"]').val(),  // CSRF token
                EquipmentName: name,
                EquipmentCategory: category,
                EquipmentQuantity: quantity,
                EquipmentDate: date,
                EquipmentPrice: price,
                EquipmentDepartment: department,
                EquipmentSKU: sku
            },
            success: function(response) {
                Swal.fire({
                    icon: "success",
                    title: response.message,
                    showConfirmButton: true
                }).then(() => {
                    console.log('Equipment Quantity:', quantity);
                    // Add the new equipment to the table
                    $('#tableBody').append(`
                        <tr class="cursor-pointer table-row " data-id="${response.equipmentId}">
                            <td class="px-6 py-3">${name}</td>
                            <td class="px-6 py-3">${category}</td>
                            <td class="px-6 py-3">${quantity}</td>
                            <td class="px-6 py-3">${date}</td>
                            <td class="px-6 py-3">${price}</td>
                            <td class="px-6 py-3">${department}</td>
                            <td class="px-6 py-3">${sku}</td>
                            <td class="px-6 py-3">
                                 <button id="editEquipButton" type="button" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">Edit</button>
                            </td>
                        </tr>
                    `);

                    // Clear input fields and hide the form
                    $('#EquipFormCard').addClass('hidden');  // Hide the form
                });
            },
            error: function(xhr) {
                Swal.fire({
                    icon: "error",
                    title: "Error",
                    text: xhr.responseText
                });
            }
        });
    });

    $(window).on('click', function(e) {
        if ($(e.target).is('#EquipFormCard')) {
            $('#EquipFormCard').addClass('hidden');
        }
    });
});


// EQUIPMENT EDIT FUNCTION
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
        var equipId = row.data('id');
        console.log('Edit button clicked for equipment ID:', equipId);

        $('#editEquipModal').removeClass('hidden');
        $('#editForm').find('#EquipmentNameEdit').val(row.find('td').eq(0).text().trim());
        $('#editForm').find('#EquipmentCategoryEdit').val(row.find('td').eq(1).text().trim());
        $('#editForm').find('#EquipmentQuantityEdit').val(row.find('td').eq(2).text().trim());
        $('#editForm').find('#EquipmentDateEdit').val(row.find('td').eq(3).text().trim());
        $('#editForm').find('#EquipmentPriceEdit').val(row.find('td').eq(4).text().replace('₱', '').trim());
        $('#editForm').find('#EquipmentDepartmentEdit').val(row.find('td').eq(5).text().trim());
        $('#editForm').find('#EquipmentSKUEdit').val(row.find('td').eq(6).text().trim());

        // Set the hidden input field with the equipment ID
        $('#editForm').find('input[name="id"]').val(equipId);
    }

    // Function to update the table row with new data
    function updateTableRow(equipId) {
        var row = $('#tableBody').find(`tr[data-id="${equipId}"]`);
        console.log('Updating row:', row);

        row.find('td').eq(0).text($('#EquipmentNameEdit').val());
        row.find('td').eq(1).text($('#EquipmentCategoryEdit').val());
        row.find('td').eq(2).text($('#EquipmentQuantityEdit').val());
        row.find('td').eq(3).text($('#EquipmentDateEdit').val());
        row.find('td').eq(4).text($('#EquipmentPriceEdit').val());
        row.find('td').eq(5).text($('#EquipmentDepartmentEdit').val());
        row.find('td').eq(6).text($('#EquipmentSKUEdit').val());
    }

    // Handle saving the changes
    $('#saveEquipButton').on('click', function(e) {
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
                            var equipId = $('#editForm').find('input[name="id"]').val();
                            updateTableRow(equipId); // Update the table row with new data
                            $('#editEquipModal').addClass('hidden');
                        });
                    },
                    error: function(xhr, status, error) {
                        var errorMessage = xhr.responseJSON.message || error;
                        console.log('Error:', errorMessage);
                        Swal.fire("Error!", "Failed to update equipment: " + errorMessage, "error");
                    }
                });
            } else if (result.isDenied) {
                Swal.fire("Changes are not saved", "", "info");
            }
        });
    });

    // Handle clicking the edit button
    $('#tableBody').on('click', '#editEquipButton', function(e) {
        e.preventDefault();
        var row = $(this).closest('tr');
        openEditModal(row);
    });

    // Handle closing the edit modal
    $('#closeEquipFormButton').on('click', function() {
        $('#editEquipModal').addClass('hidden');
    });

    // Close modal when clicking outside of it
    $(window).on('click', function(e) {
        if ($(e.target).is('#editEquipModal')) {
            $('#editEquipModal').addClass('hidden');
        }
    });
});


//DELETE EQUIPMENT
$(document).ready(function(){
    $('#deleteEquipButton').click(function() {
        var equipmentId = $('#equipmentId').val();
        var csrfToken = $('#csrf-token').data('token'); 

        Swal.fire({
            title: "Are you sure?",
            text: "You want to delete the selected Equipment item?",
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
                    url: '/equipment/delete',  
                    type: 'POST',
                    data: {
                        id: equipmentId,
                        _token: csrfToken  
                    },
                    success: function(response) {

                        Swal.fire({
                            title: "Deleted!",
                            text: "The equipment item has been deleted.",
                            icon: "success"
                        });

                        // Close the modal
                        $('#editEquipModal').addClass('hidden');

                        // Optionally, remove the item from the UI
                        $('tr[data-id="'+equipmentId+'"]').remove();
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
    $('#equipmentSearch').on('keyup', function() {
        console.log('Search input:', this.value); 
        table.search(this.value).draw(); 
    });
});



