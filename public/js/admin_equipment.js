// Show the form when "Add Item" button is clicked
$(document).ready(function() {
    $('#EquipFormButton').click(function() {
        event.preventDefault();
        console.log('Show Equip Form Button Clicked');
        $('#EquipFormCard').removeClass('hidden'); 
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

        const controlNo = $('#EquipmentControlNo').val().trim();
        const brandName = $('#EquipmentBrandName').val().trim();
        const name = $('#EquipmentName').val().trim();
        const category = $('#EquipmentCategory').val();
        const type = $('#EquipmentType').val();
        const color = $('#EquipmentColor').val().trim();
        const unit = $('#EquipmentUnit').val().trim();
        const quantity = $('#EquipmentQuantity').val().trim();
        const date = $('#EquipmentDate').val().trim();
        const uPrice = $('#EquipmentUnitPrice').val().trim();
        const classification = $('#EquipmentClassification').val();
        const sku = $('#EquipmentSKU').val().trim();
        const serialNo = $('#EquipmentSerialNo').val().trim();

        // Check if all fields are filled
        if (controlNo === '' || brandName === '' || name === '' || category === '' || type === '' || color === '' || unit === '' || 
            quantity === '' || date === '' || uPrice === '' || classification === '' || sku === '' || serialNo === '') {
            Swal.fire({
                icon: "error",
                title: "Oops...",
                text: "Please fill all fields!",
                showConfirmButton: true,
                confirmButtonColor: '#3085d6'
            });
            return;
        }

        // Hide the form immediately after clicking the save button
        $('#EquipFormCard').addClass('hidden');

        // AJAX request to save the data
        $.ajax({
            url: '/equipment/store',  // Ensure this URL is correct
            type: 'POST',
            data: {
                _token: $('input[name="_token"]').val(),  // CSRF token
                EquipmentControlNo: controlNo,
                EquipmentBrandName: brandName,
                EquipmentName: name,
                EquipmentCategory: category,
                EquipmentType: type,
                EquipmentColor: color,
                EquipmentUnit: unit,
                EquipmentQuantity: quantity,
                EquipmentDate: date,
                EquipmentUnitPrice: uPrice,
                EquipmentClassification: classification,
                EquipmentSKU: sku,
                EquipmentSerialNo: serialNo
            },
            success: function(response) {
                Swal.fire({
                    icon: "success",
                    title: response.message,
                    showConfirmButton: true,
                    confirmButtonColor: '#3085d6'
                }).then(() => {
                    console.log('Equipment Quantity:', quantity);
                    // Add the new equipment to the table
                    $('#tableBody').append(`
                        <tr class="cursor-pointer table-row border-b border-gray-300" data-id="${response.equipmentId}">
                            <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">${brandName}</td>
                            <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">${name}</td>
                            <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">${category}</td>
                            <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">${quantity}</td>
                            <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">${uPrice}</td>
                            <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">${sku}</td>
                            <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                <button id="viewEquipButton" type="button">
                                    <svg class="w-[27px] h-[27px] text-green-600 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                        <path stroke="currentColor" stroke-width="2" d="M21 12c0 1.2-4.03 6-9 6s-9-4.8-9-6c0-1.2 4.03-6 9-6s9 4.8 9 6Z" />
                                        <path stroke="currentColor" stroke-width="2" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                    </svg>
                                </button>
                                <button id="editEquipButton" type="button">
                                    <svg class="w-[27px] h-[27px] text-blue-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                        <path fill-rule="evenodd" d="M11.32 6.176H5c-1.105 0-2 .949-2 2.118v10.588C3 20.052 3.895 21 5 21h11c1.105 0 2-.948 2-2.118v-7.75l-3.914 4.144A2.46 2.46 0 0 1 12.81 16l-2.681.568c-1.75.37-3.292-1.263-2.942-3.115l.536-2.839c.097-.512.335-.983.684-1.352l2.914-3.086Z" clip-rule="evenodd" />
                                        <path fill-rule="evenodd" d="M19.846 4.318a2.148 2.148 0 0 0-.437-.692 2.014 2.014 0 0 0-.654-.463 1.92 1.92 0 0 0-1.544 0 2.014 2.014 0 0 0-.654.463l-.546.578 2.852 3.02.546-.579a2.14 2.14 0 0 0 .437-.692 2.244 2.244 0 0 0 0-1.635ZM17.45 8.721 14.597 5.7 9.82 10.76a.54.54 0 0 0-.137.27l-.536 2.84c-.07.37.239.696.588.622l2.682-.567a.492.492 0 0 0 .255-.145l4.778-5.06Z" clip-rule="evenodd" />
                                    </svg>
                                </button>
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
        $('#editForm').find('#EquipmentBrandNameEdit').val(row.find('td').eq(0).text().trim());
        $('#editForm').find('#EquipmentNameEdit').val(row.find('td').eq(1).text().trim());
        $('#editForm').find('#EquipmentCategoryEdit').val(row.find('td').eq(3).text().trim());
        $('#editForm').find('#EquipmentSKUEdit').val(row.find('td').eq(6).text().trim());

        // Set the hidden input field with the equipment ID
        $('#editForm').find('input[name="id"]').val(equipId);
    }

    // Function to update the table row with new data
    function updateTableRow(equipId) {
        var row = $('#tableBody').find(`tr[data-id="${equipId}"]`);
        console.log('Updating row:', row);

        row.find('td').eq(0).text($('#EquipmentBrandNameEdit').val());
        row.find('td').eq(1).text($('#EquipmentNameEdit').val());
        row.find('td').eq(3).text($('#EquipmentCategoryEdit').val());
        row.find('td').eq(6).text($('#EquipmentSKUEdit').val());
    }

    // Handle saving the changes
    $('#saveEquipButton').on('click', function(e) {
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
    $('#dynamicTable tbody').on('click', '#editEquipButton', function() {
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


$(document).ready(function() {
    $('#EquipmentCategory').change(function() {
        if ($(this).val() === 'other') {
            $('#otherEquipCategoryDiv').removeClass('hidden');
        } else {
            $('#otherEquipCategoryDiv').addClass('hidden');
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
                            icon: "success",
                            confirmButtonColor: "#3085d6"
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

        // document.getElementById("equipmentSearch").addEventListener("keyup", function() {
        //     let searchTerm = this.value;
        //     dataTable.search(searchTerm);
        // });
    }
});



// FOR ANIMATION 

// $(document).ready(function() {
//     // Open the form card with animation
//     $('#EquipFormButton').on('click', function() {
//         $('#EquipFormCard').removeClass('hidden').css({
//             'top': '-10%', // Start position
//             'opacity': 0
//         }).animate({
//             'top': '0',
//             'opacity': 1
//         }, 300); // Adjust duration as needed
//     });

//     // Close the form card with animation
//     $('#EquipCloseFormButton').on('click', function() {
//         $('#EquipFormCard').animate({
//             'top': '-100%',
//             'opacity': 0
//         }, 500, function() {
//             $(this).addClass('hidden');
//         }); // Adjust duration as needed
//     });
// });


// VIEWING CARD
$(document).ready(function() {
    $('#viewEquipButton').click(function() {
        event.preventDefault();
        console.log('Show View Equip Form Button Clicked');
        $('#ViewEquipModal').removeClass('hidden'); 
    });


    // Hide the form card when the close button is clicked
    $('#closeViewEquipFormButton').click(function() {
        event.preventDefault();
        console.log('Close View Form Button Clicked');
        $('#ViewEquipModal').addClass('hidden'); 
    });
});


// VIEWING FULL INFORMATION SMALL CARD
$(document).ready(function() {
    $('#viewEquipBTN').click(function() {
        event.preventDefault();
        console.log('Show View Equip Form Button Clicked');
        $('#ViewFullEquipModal').removeClass('hidden'); 
    });


    // Hide the form card when the close button is clicked
    $('#closeViewFullEquipModal').click(function() {
        event.preventDefault();
        console.log('Close View Form Button Clicked');
        $('#ViewFullEquipModal').addClass('hidden'); 
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
        var equipId = row.data('id');
        console.log('Edit button clicked for equipment ID:', equipId);

        $('#editFullEquipModal').removeClass('hidden');
        $('#editFullEquipForm').find('#FullEquipmentSerialNoEdit').val(row.find('td').eq(0).text().trim());
        $('#editFullEquipForm').find('#FullEquipmentControlNoEdit').val(row.find('td').eq(1).text().trim());
        $('#editFullEquipForm').find('#FullEquipmentTypeEdit').val(row.find('td').eq(2).text().trim());
        $('#editFullEquipForm').find('#FullEquipmentColorEdit').val(row.find('td').eq(3).text().trim());
        $('#editFullEquipForm').find('#FullEquipmentUnitEdit').val(row.find('td').eq(4).text().trim());
        $('#editFullEquipForm').find('#FullEquipmentUnitPriceEdit').val(row.find('td').eq(5).text().trim());
        $('#editFullEquipForm').find('#FullEquipmentClassificationEdit').val(row.find('td').eq(6).text().trim());
        $('#editFullEquipForm').find('#FullEquipmentDateEdit').val(row.find('td').eq(7).text().trim());

        // Set the hidden input field with the equipment ID
        $('#editFullEquipForm').find('input[name="id"]').val(equipId);
    }

    // Function to update the table row with new data
    function updateTableRow(equipId) {
        var row = $('#tableViewBody').find(`tr[data-id="${equipId}"]`);
        console.log('Updating row:', row);

        row.find('td').eq(0).text($('#EquipmentSerialNoEdit').val());
        row.find('td').eq(1).text($('#EquipmentControlNoEdit').val());
        row.find('td').eq(0).text($('#EquipmentTypeEdit').val());
        row.find('td').eq(0).text($('#EquipmentColorEdit').val());
        row.find('td').eq(0).text($('#EquipmentUnitEdit').val());
        row.find('td').eq(0).text($('#EquipmentUnitPriceEdit').val());
        row.find('td').eq(0).text($('#EquipmentClassificationEdit').val());
        row.find('td').eq(0).text($('#EquipmentDateEdit').val());
    }

    // Handle saving the changes
    $('#saveFullEquipButton').on('click', function(e) {
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
                var formData = $('#editFullEquipForm').serialize();
                console.log('Form data:', formData);

                $.ajax({
                    url: $('#editFullEquipForm').attr('action'),
                    method: 'POST',
                    data: formData,
                    success: function() {
                        Swal.fire("Saved!", "", "success").then(() => {
                            var equipId = $('#editFullEquipForm').find('input[name="id"]').val();
                            updateTableRow(equipId); // Update the table row with new data
                            $('#editFullEquipModal').addClass('hidden');
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
    $('#ViewDynamicTable tbody').on('click', '#editEquipBTN', function() {
        var row = $(this).closest('tr');
        openEditModal(row);
    });

    // Handle closing the edit modal
    $('#closeEditFullEquipModal').on('click', function() {
        $('#editFullEquipModal').addClass('hidden');
    });

    // Close modal when clicking outside of it
    $(window).on('click', function(e) {
        if ($(e.target).is('#editFullEquipModal')) {
            $('#editFullEquipModal').addClass('hidden');
        }
    });
});


// ADD BUTTON TO FULL INFORMATION CARD
$(document).ready(function() {
    $('#addEquipBTN').click(function() {
        event.preventDefault();
        console.log('Show Equip Form Button Clicked');
        $('#AddEquipFormCard').removeClass('hidden'); 
    });


    // Hide the form card when the close button is clicked
    $('#AddEquipCloseFormButton').click(function() {
        event.preventDefault();
        console.log('Close Form Button Clicked');
        $('#AddEquipFormCard').addClass('hidden'); 
    });
});







