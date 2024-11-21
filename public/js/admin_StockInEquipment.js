// Show the form when "Add Item" button is clicked
$(document).ready(function () {
    $('#EquipFormButton').click(function () {
        event.preventDefault();
        console.log('Show Equip Form Button Clicked');
        $('#EquipFormCard').removeClass('hidden');
    });


    // Hide the form card when the close button is clicked
    $('#EquipCloseFormButton').click(function () {
        event.preventDefault();
        console.log('Close Form Button Clicked');
        $('#EquipFormCard').addClass('hidden');
    });
});


// Function to add a new Equipment
$(document).ready(function () {
    $('#EquipmentSaveButton').on('click', function (e) {
        e.preventDefault();
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

        // Check if all fields are filled (same as before)
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

        // Hide the form immediately
        $('#EquipFormCard').addClass('hidden');

        // AJAX request
        $.ajax({
            url: '/equipment/store',
            type: 'POST',
            data: {
                _token: $('#csrf-token').data('token'),  // CSRF token
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
            success: function (response) {
                console.log('Success:', response);
                Swal.fire({
                    icon: "success",
                    title: response.message,
                    showConfirmButton: true,
                    confirmButtonColor: '#3085d6'
                }).then(() => {
                    // Append the new row with the same structure as provided
                    const newRow = `
                        <tr class="odd:bg-blue-100 odd:dark:bg-gray-900 even:bg-white even:dark:bg-gray-800 border-b dark:border-gray-700" data-id="${response.equipmentId}">
                            <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">${brandName}</td>
                            <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">${name}</td>
                            <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">${category}</td>
                            <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">${quantity}</td>
                            <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">₱${parseFloat(uPrice).toFixed(2)}</td>
                            <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">${sku}</td>
                            <td class="px-6 py-4">
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
                    `;
                    $('#dynamicTable').append(newRow);

                    // Clear input fields
                    $('#EquipFormCard').find('input[type="text"], input[type="number"], input[type="date"], select').val('');
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
});

$(window).on('click', function (e) {
    if ($(e.target).is('#EquipFormCard')) {
        $('#EquipFormCard').addClass('hidden');
    }
});

$(document).ready(function () {
    $('#EquipmentCategory').change(function () {
        if ($(this).val() === 'other') {
            $('#otherEquipCategoryDiv').removeClass('hidden');
        } else {
            $('#otherEquipCategoryDiv').addClass('hidden');
        }
    });
});

$(document).ready(function () {
    $('#EquipmentCategoryEdit').change(function () {
        if ($(this).val() === 'other') {
            $('#otherEquipCategoryDiv').removeClass('hidden');
        } else {
            $('#otherEquipCategoryDiv').addClass('hidden');
        }
    });
});



// EQUIPMENT EDIT FUNCTION
$(document).ready(function () {
    var csrfToken = $('meta[name="csrf-token"]').attr('content') || $('#csrf-token').data('token');
    console.log('CSRF Token:', csrfToken);

    $.ajaxSetup({
        headers: {
            'X-CSRF-Token': csrfToken
        }
    });

    // Event delegation for the edit button click
    $(document).on('click', '#editEquipButton', function (event) {
        event.preventDefault();
        console.log('Show Edit Equip Form Button Clicked');

        // Get the clicked row
        var row = $(this).closest('tr');
        var equipBrand = row.data('brand'); // Retrieve the equipment brand from the row's data-brand attribute
        console.log('Edit button clicked for equipment Brand:', equipBrand);

        // Show the edit modal
        $('#editEquipModal').removeClass('hidden');

        // Populate the edit modal fields with data from the row
        $('#editForm').find('#EquipmentBrandNameEdit').val(row.find('td').eq(0).text().trim());
        $('#editForm').find('#EquipmentNameEdit').val(row.find('td').eq(1).text().trim());
        $('#editForm').find('#EquipmentCategoryEdit').val(row.find('td').eq(3).text().trim());
        $('#editForm').find('#EquipmentSKUEdit').val(row.find('td').eq(6).text().trim());

        // Set the hidden input field with the equipment brand
        $('#editForm').find('input[name="brand"]').val(equipBrand);
    });

    // Handle saving the changes
    $('#saveEquipButton').on('click', function (e) {
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
                var equipBrand = $('#editForm').find('input[name="brand"]').val(); // Ensure brand is correctly set
                console.log('Equipment Brand to be sent:', equipBrand); // Log to check brand value

                $.ajax({
                    url: '/equipment/update-main',
                    method: 'POST',
                    data: formData,
                    success: function () {
                        Swal.fire("Saved!", "", "success").then(() => {
                            updateTableRow(equipBrand); // Update the table row with new data
                            $('#editEquipModal').addClass('hidden');
                        });
                    },
                    error: function (xhr, status, error) {
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

    // Function to update the table row with new data based on brand
    function updateTableRow(equipBrand) {
        var row = $('#tableBody').find(`tr[data-brand="${equipBrand}"]`); // Find the row by brand
        console.log('Updating row:', row);

        if (row.length > 0) { // Check if the row exists
            row.find('td').eq(0).text($('#EquipmentBrandNameEdit').val().trim()); // Update brand name
            row.find('td').eq(1).text($('#EquipmentNameEdit').val().trim()); // Update equipment name
            row.find('td').eq(3).text($('#EquipmentCategoryEdit').val().trim()); // Update category
            row.find('td').eq(6).text($('#EquipmentSKUEdit').val().trim()); // Update SKU
            console.log('Row updated successfully');
        } else {
            console.log('Row not found for brand:', equipBrand);
        }
    }

    // Handle closing the edit modal
    $('#closeEquipFormButton').on('click', function () {
        $('#editEquipModal').addClass('hidden');
    });

    // Close modal when clicking outside of it
    $(window).on('click', function (e) {
        if ($(e.target).is('#editEquipModal')) {
            $('#editEquipModal').addClass('hidden');
        }
    });
});




// DELETE EQUIPMENT
$(document).on('click', '#deleteEquipButton', function (event) {
    event.preventDefault();

    // Get the brand name from the clicked delete button
    var equipBrand = $(this).data('brand');

    Swal.fire({
        title: "Are you sure you want to delete this equipment?",
        showDenyButton: true,
        confirmButtonText: "Yes",
        denyButtonText: "No",
        confirmButtonColor: '#3085d6',
        denyButtonColor: '#d33'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: '/equipment/delete', // Ensure this route matches your Laravel route
                method: 'POST',
                data: {
                    brand: equipBrand,
                    _token: $('meta[name="csrf-token"]').attr('content') // Include CSRF token
                },
                success: function (response) {
                    Swal.fire("Deleted!", response.message, "success").then(() => {
                        $('#editEquipModal').addClass('hidden');
                        $(`tr[data-brand="${equipBrand}"]`).remove();
                    });
                },
                error: function (xhr) {
                    var errorMessage = xhr.responseJSON && xhr.responseJSON.message ?
                        xhr.responseJSON.message : 'Failed to delete equipment';
                    console.log('Error:', errorMessage);
                    Swal.fire("Error!", errorMessage, "error");
                }
            });
        } else if (result.isDenied) {
            Swal.fire("Deletion canceled", "", "info");
        }
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

        document.getElementById("equipmentSearch").addEventListener("keyup", function () {
            let searchTerm = this.value;
            dataTable.search(searchTerm);
        });
    }
});



// SECONDARY TABLE
document.addEventListener("DOMContentLoaded", function () {
    // Check if the table exists and simple-datatables is loaded
    if (document.getElementById("ViewDynamicTable") && typeof simpleDatatables !== 'undefined') {
        const dataTable = new simpleDatatables.DataTable("#ViewDynamicTable", {
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


// VIEWING FULL INFORMATION CARD
$(document).ready(function () {
    // Bind click event for the edit button (or any button intended to view details)
    $(document).on('click', '#viewEquipButton', function () {
        // Use closest 'tr' to find the correct row and get data attributes
        const row = $(this).closest('tr');
        var brandName = row.attr('data-brand');
        const equipmentId = row.attr('data-id');


        console.log('Brand Name:', brandName);
        console.log('Equipment ID:', equipmentId);
        console.log(row);

        // Show the modal for viewing/editing details
        $('#ViewEquipModal').removeClass('hidden');
        $('#ViewDynamicTable tbody').empty();

        // AJAX call to fetch equipment details by brand name
        $.ajax({
            url: '/equipment/details',
            type: 'GET',
            data: { EquipmentBrandName: brandName },
            success: function (response) {
                console.log('Response:', response);

                // Check if the response contains equipment details
                if (response.equipmentDetails && response.equipmentDetails.length > 0) {
                    response.equipmentDetails.forEach(equipment => {
                        const newRow = `
                            <tr class="odd:bg-blue-100 odd:dark:bg-gray-900 even:bg-white even:dark:bg-gray-800 border-b dark:border-gray-700" data-id="${equipment.id}" data-brand="${equipment.EquipmentBrandName}">
                                <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">${equipment.EquipmentSerialNo}</td>
                                <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">${equipment.EquipmentControlNo}</td>
                                <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    <button class="viewEquipBTN" type="button">
                                        <svg class="w-[27px] h-[27px] text-green-600 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                            <path stroke="currentColor" stroke-width="2" d="M21 12c0 1.2-4.03 6-9 6s-9-4.8-9-6c0-1.2 4.03-6 9-6s9 4.8 9 6Z" />
                                            <path stroke="currentColor" stroke-width="2" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                        </svg>
                                    </button>
                                    <button class="editEquipBTN" data-form-type="second" type="button">
                                        <svg class="w-[27px] h-[27px] text-blue-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                            <path fill-rule="evenodd" d="M11.32 6.176H5c-1.105 0-2 .949-2 2.118v10.588C3 20.052 3.895 21 5 21h11c1.105 0 2-.948 2-2.118v-7.75l-3.914 4.144A2.46 2.46 0 0 1 12.81 16l-2.681.568c-1.75.37-3.292-1.263-2.942-3.115l.536-2.839c.097-.512.335-.983.684-1.352l2.914-3.086Z" clip-rule="evenodd" />
                                            <path fill-rule="evenodd" d="M19.846 4.318a2.148 2.148 0 0 0-.437-.692 2.014 2.014 0 0 0-.654-.463 1.92 1.92 0 0 0-1.544 0 2.014 2.014 0 0 0-.654.463l-.546.578 2.852 3.02.546-.579a2.14 2.14 0 0 0 .437-.692 2.244 2.244 0 0 0 0-1.635ZM17.45 8.721 14.597 5.7 9.82 10.76a.54.54 0 0 0-.137.27l-.536 2.84c-.07.37.239.696.588.622l2.682-.567a.492.492 0 0 0 .255-.145l4.778-5.06Z" clip-rule="evenodd" />
                                        </svg>
                                    </button>
                                </td>
                                <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    <input id="StockInCheckBox" type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                </td>
                                
                            </tr>
                        `;

                        // Append the new row to the table
                        $('#ViewDynamicTable tbody').append(newRow);
                    });
                } else {
                    alert('No equipment details found.');
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.error('AJAX Error:', textStatus, errorThrown);
                console.error('Response Text:', jqXHR.responseText);
                alert('Failed to load equipment details: ' + (jqXHR.status ? jqXHR.statusText : 'Unknown error'));
            }
        });
    });


    // Close modal when close button is clicked
    $(document).on('click', '#closeViewEquipFormButton', function () {
        $('#ViewEquipModal').addClass('hidden');
    });

    $(window).on('click', function (e) {
        if ($(e.target).is('#ViewEquipModal')) {
            $('#ViewEquipModal').addClass('hidden');
        }
    });
});



// VIEWING FULL INFORMATION SMALL CARD
$(document).ready(function () {
    // Listen for clicks on any row's view button
    $(document).on('click', '.viewEquipBTN', function (event) {
        event.preventDefault();
        console.log('Show View Full Equip Form Button Clicked');

        // Get the clicked row
        var row = $(this).closest('tr');
        var equipId = row.data('id'); // Ensure your table row has data-id attribute

        if (equipId) {
            console.log('Final Viewing button clicked for equipment ID:', equipId);

            // Make an AJAX call to fetch the details
            $.ajax({
                url: '/equipment/final-viewing',
                type: 'GET',
                data: { id: equipId },
                success: function (response) {
                    // Populate the modal with the equipment details
                    let equipmentDetails = `
                        <p><strong>Serial Number:</strong> ${response.EquipmentSerialNo}</p>
                        <p><strong>Control Number:</strong> ${response.EquipmentControlNo}</p>
                        <p><strong>Brand Name:</strong> ${response.EquipmentBrandName}</p>
                        <p><strong>Product Name:</strong> ${response.EquipmentName}</p>
                        <p><strong>Category:</strong> ${response.EquipmentCategory}</p>
                        <p><strong>Type:</strong> ${response.EquipmentType}</p>
                        <p><strong>Color:</strong> ${response.EquipmentColor}</p>
                        <p><strong>Unit:</strong> ${response.EquipmentUnit}</p>
                        <p><strong>Unit Price:</strong> ₱${Number(response.EquipmentUnitPrice).toFixed(2)}</p>
                        <p><strong>Classification:</strong> ${response.EquipmentClassification}</p>
                        <p><strong>Date:</strong> ${response.EquipmentDate}</p>
                    `;
                    $('#equipmentDetails').html(equipmentDetails);
                    $('#ViewFullEquipModal').removeClass('hidden'); // Show the modal
                },
                error: function (xhr) {
                    console.error('Error fetching equipment details:', xhr.responseJSON);
                }
            });
        } else {
            console.log('No equipment ID found.');
        }
    });

    // Hide the modal when the close button is clicked
    $('#closeViewFullEquipModal').click(function (event) {
        event.preventDefault();
        $('#ViewFullEquipModal').addClass('hidden');
    });

    // Hide modal on click outside
    $(window).on('click', function (e) {
        if ($(e.target).is('#ViewFullEquipModal')) {
            $('#ViewFullEquipModal').addClass('hidden');
        }
    });
});


//EDIT FUNCTION FOR VIEW TABLE
$(document).ready(function () {
    var csrfToken = $('meta[name="csrf-token"]').attr('content') || $('#csrf-token').data('token');
    console.log('CSRF Token:', csrfToken);

    $.ajaxSetup({
        headers: {
            'X-CSRF-Token': csrfToken
        }
    });

    $(document).on('click', '.editEquipBTN', function (event) {
        event.preventDefault();
        console.log('Edit Equipment Button Clicked');

        var row = $(this).closest('tr');
        var equipId = row.data('id');
        console.log('Editing equipment with ID:', equipId);

        // Show the edit modal
        $('#editFullEquipModal').removeClass('hidden');

        // Populate the edit modal fields with data from the row
        $('#editFullEquipForm').find('#FullEquipmentSerialNoEdit').val(row.find('td').eq(0).text().trim());
        $('#editFullEquipForm').find('#FullEquipmentControlNoEdit').val(row.find('td').eq(1).text().trim());
        $('#editFullEquipForm').find('#FullEquipmentTypeEdit').val(row.find('td').eq(2).text().trim());
        $('#editFullEquipForm').find('#FullEquipmentColorEdit').val(row.find('td').eq(3).text().trim());
        $('#editFullEquipForm').find('#FullEquipmentUnitEdit').val(row.find('td').eq(4).text().trim());
        $('#editFullEquipForm').find('#FullEquipmentUnitPriceEdit').val(row.find('td').eq(5).text().trim());
        $('#editFullEquipForm').find('#FullEquipmentClassificationEdit').val(row.find('td').eq(6).text().trim());
        $('#editFullEquipForm').find('#FullEquipmentDateEdit').val(row.find('td').eq(7).text().trim());

        // Set the hidden input field with the equipment ID for form submission
        $('#editFullEquipForm').find('input[name="id"]').val(equipId); // Use equipment ID instead of brand
    });

    // Handle saving the changes
    $('#saveFullEquipButton').on('click', function (e) {
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
                console.log('Form data to be submitted:', formData);

                var equipId = $('#editFullEquipForm').find('input[name="id"]').val(); // Ensure ID is set correctly
                console.log('Submitting data for equipment ID:', equipId);

                $.ajax({
                    url: '/equipment/update-view',
                    method: 'POST',
                    data: formData,
                    success: function () {
                        Swal.fire("Saved!", "", "success").then(() => {
                            updateTableRow(equipId); // Update the table row with new data
                            $('#editFullEquipModal').addClass('hidden'); // Close the modal after saving
                        });
                    },
                    error: function (xhr, status, error) {
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

    // Function to update the table row with new data based on ID
    function updateTableRow(equipId) {
        var row = $('#tableViewBody').find(`tr[data-id="${equipId}"]`); // Find the row by ID
        console.log('Updating row for ID:', equipId, row);

        if (row.length > 0) {
            row.find('td').eq(0).text($('#FullEquipmentSerialNoEdit').val().trim());
            row.find('td').eq(1).text($('#FullEquipmentControlNoEdit').val().trim());
            row.find('td').eq(2).text($('#FullEquipmentTypeEdit').val().trim());
            row.find('td').eq(3).text($('#FullEquipmentColorEdit').val().trim());
            row.find('td').eq(4).text($('#FullEquipmentUnitEdit').val().trim());
            row.find('td').eq(5).text($('#FullEquipmentUnitPriceEdit').val().trim());
            row.find('td').eq(6).text($('#FullEquipmentClassificationEdit').val().trim());
            row.find('td').eq(7).text($('#FullEquipmentDateEdit').val().trim());
            console.log('Row updated successfully');
        } else {
            console.log('Row not found for ID:', equipId);
        }
    }

    // Handle closing the edit modal
    $('#closeFullEquipFormButton').on('click', function () {
        $('#editFullEquipModal').addClass('hidden');
    });

    // Close modal when clicking outside of it
    $(window).on('click', function (e) {
        if ($(e.target).is('#editFullEquipModal')) {
            $('#editFullEquipModal').addClass('hidden');
        }
    });
});




//DELETE FUNCTION FOR 2ND EDIT SMALL CARD ! 
$(document).ready(function () {
    $('#deleteFullEquipButton').click(function () {
        // Retrieve the equipment ID from the modal input
        var equipmentId = $('#fullequipmentId').val(); // Ensure this input exists and has the correct value
        var csrfToken = $('#csrf-token').data('token');
        console.log('Deleting equipment ID:', equipmentId);

        // Display confirmation dialog
        Swal.fire({
            title: "Are you sure?",
            text: "You want to delete the selected full equipment item?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes",
            cancelButtonText: "No"
        }).then((result) => {
            if (result.isConfirmed) {
                // Perform AJAX request to delete the equipment
                $.ajax({
                    url: '/equipment/delete-view',
                    type: 'POST',
                    data: {
                        id: equipmentId,
                        _token: csrfToken // Include CSRF token
                    },
                    success: function (response) {
                        Swal.fire({
                            title: "Deleted!",
                            text: response.message, // Use message from the server response
                            icon: "success",
                            confirmButtonColor: "#3085d6"
                        }).then(() => {
                            // Remove the deleted equipment row from the table
                            $('tr[data-id="' + equipmentId + '"]').remove(); // Ensure row removal is correct
                            $('#editFullEquipModal').addClass('hidden'); // Optionally close the modal
                        });
                    },
                    error: function (xhr) {
                        // Handle errors here
                        var errorMessage = xhr.responseJSON?.message || "There was an error deleting the full equipment item.";
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

    $(document).on('click', '#closeEditFullEquipModal', function () {
        $('#editFullEquipModal').addClass('hidden');
    });

});


$(document).ready(function () {
    $("#editStockInButton").click(function () {
        $("#StockInEquipmentPopupCard").removeClass("hidden");
    });

    // Hide the popup and show Cancel message when Cancel button is clicked
    $("#closeStockInEquipPopupCard").click(function () {
        event.preventDefault();
        Swal.fire({
            icon: 'error',
            title: 'Cancelled',
            text: 'Your action has been cancelled',
            confirmButtonText: 'OK',
            confirmButtonColor: '#D1191A'
        }).then(() => {
            $("#StockInEquipmentPopupCard").addClass("hidden");
        });
    });

    // Hide the popup and show Submitted message when Submit button is clicked
    $("#submitStockInEquipPopupCard").click(function () {
        event.preventDefault();
        Swal.fire({
            icon: 'success',
            title: 'Submitted',
            text: 'Your action has been successfully submitted',
            confirmButtonText: 'OK',
            confirmButtonColor: '#3085d6'
        }).then(() => {
            $("#StockInEquipmentPopupCard").addClass("hidden");
        });
    });
});




// ADD BUTTON TO FULL INFORMATION CARD











