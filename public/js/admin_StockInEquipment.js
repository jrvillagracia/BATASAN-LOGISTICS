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
    // Show the "Other Category" input when "Other" is selected
    $('#EquipmentCategory').on('change', function () {
        const category = $(this).val();
        if (category === 'other') {
            $('#otherEquipCategoryDiv').removeClass('hidden');
        } else {
            $('#otherEquipCategoryDiv').addClass('hidden');
        }
    });

    $('#EquipmentUnitPriceEdit').on('input', function() {
        var value = $(this).val().replace(/,/g, '');
        var formattedValue = parseFloat(value).toLocaleString('en-US'); 
        $(this).val(formattedValue);
    });


    // Save equipment
    $('#EquipmentSaveButton').on('click', function (e) {
        e.preventDefault();

        const brandName = $('#EquipmentBrandName').val().trim();
        const name = $('#EquipmentName').val().trim();
        const category = $('#EquipmentCategory').val();
        const otherCategory = $('#otherEquipCategory').val().trim();  // Get the value of "Other Category"
        const type = $('#EquipmentType').val();
        const color = $('#EquipmentColor').val().trim();
        const unit = $('#EquipmentUnit').val().trim();
        const quantity = $('#EquipmentQuantity').val().trim();
        const date = $('#EquipmentDate').val().trim();
        const uPrice = $('#EquipmentUnitPrice').val().trim();
        const classification = $('#EquipmentClassification').val();
        const sku = $('#EquipmentSKU').val().trim();

        // If "Other" is selected, use the value from the "Other Category" field
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
            quantity === '' || date === '' || uPrice === '' || classification === '' || sku === '' ) {
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
                $('#EquipFormCard').addClass('hidden');

                // AJAX request
                $.ajax({
                    url: '/equipment/store',
                    type: 'POST',
                    data: {
                        _token: $('#csrf-token').data('token'), // CSRF token
                        EquipmentBrandName: brandName,
                        EquipmentName: name,
                        EquipmentCategory: finalCategory, 
                        EquipmentType: type,
                        EquipmentColor: color,
                        EquipmentUnit: unit,
                        EquipmentQuantity: quantity,
                        EquipmentDate: date,
                        EquipmentUnitPrice: uPrice,
                        EquipmentClassification: classification,
                        EquipmentSKU: sku,
                    },
                    success: function (response) {
                        console.log('Success:', response);
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
            }
        });
    });
});


$(window).on('click', function (e) {
    if ($(e.target).is('#EquipFormCard')) {
        $('#EquipFormCard').addClass('hidden');
    }
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

    // Handle category selection changes
    $('#EquipmentCategoryEdit').on('change', function () {
        const category = $(this).val();
        if (category === 'other') {
            $('#otherEquipCategoryDivEdit').removeClass('hidden');
            const otherCategoryValue = $('#editForm').find('#otherEquipCategoryEdit').val();
            $('#otherEquipCategoryEdit').val(otherCategoryValue); // set the value
        } else {
            $('#otherEquipCategoryDivEdit').addClass('hidden');
            $('#otherEquipCategoryEdit').val(''); // Clear the input if not "other"
        }
    });

    // Format unit price with commas
    $('#EquipmentUnitPriceEdit').on('input', function () {
        var value = $(this).val().replace(/,/g, ''); // Remove existing commas
        var formattedValue = parseFloat(value).toLocaleString('en-US'); // Format with commas
        $(this).val(formattedValue);
    });

    // Event delegation for the edit button click
    $(document).on('click', '#editEquipButton', function (event) {
        event.preventDefault();
        console.log('Show Edit Equip Form Button Clicked');

        var row = $(this).closest('tr');
        var equipBrand = row.data('brand');
        var equipType = row.data('type');
        var equipUnit = row.data('unit');
        var equipUnitPrice = row.data('unit-price');
        var equipColor = row.data('color');
        var otherCategory = row.data('other-category');
        var equipName = row.data('oldname');
        console.log('Edit button clicked for equipment Brand:', equipBrand);

        $('#editEquipModal').removeClass('hidden');

        // Populate modal fields with row data
        $('#editForm').find('#EquipmentBrandNameEdit').val(row.find('td').eq(1).text().trim());
        $('#editForm').find('#EquipmentNameEdit').val(row.find('td').eq(2).text().trim());
        $('#editForm').find('#EquipmentCategoryEdit').val(row.find('td').eq(3).text().trim());
        $('#editForm').find('#EquipmentQuantityEdit').val(parseInt(row.find('td').eq(4).text().trim()));
        $('#editForm').find('#EquipmentSKUEdit').val(row.find('td').eq(6).text().trim());
        $('#editForm').find('#EquipmentClassificationEdit').val(row.find('td').eq(7).text().trim());

        $('#editForm').find('#EquipmentColorEdit').val(equipColor);
        $('#editForm').find('#EquipmentTypeEdit').val(equipType);
        $('#editForm').find('#EquipmentUnitEdit').val(equipUnit);
        $('#editForm').find('#EquipmentUnitPriceEdit').val(equipUnitPrice);

        $('#editForm').find('input[name="brand"]').val(equipBrand);
        $('#editForm').find('input[name="oldname"]').val(equipName);

        if (otherCategory === 'other') {
            $('#otherEquipCategoryDivEdit').removeClass('hidden');
            $('#editForm').find('#otherEquipCategoryEdit').val(otherCategory);
        } else {
            $('#otherEquipCategoryDivEdit').addClass('hidden');
            $('#editForm').find('#otherEquipCategoryEdit').val('');
        }
    });

    // Handle saving changes
    $('#saveEquipButton').on('click', function (e) {
        e.preventDefault();

        const category = $('#EquipmentCategoryEdit').val();
        const otherCategory = $('#otherEquipCategoryEdit').val().trim();

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
                    $('#editForm').find('#EquipmentCategoryEdit').val('other');
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

                var equipBrand = $('#editForm').find('input[name="brand"]').val();
                console.log('Equipment Brand to be sent:', equipBrand);


                $.ajax({
                    url: '/equipment/update-main',
                    method: 'POST',
                    data: formData,
                    success: function () {
                        Swal.fire("Saved!", "", "success").then(() => {
                            updateTableRow(equipBrand);
                            $('#editEquipModal').addClass('hidden');
                            location.reload();
                        });
                    },
                    error: function (xhr, status, error) {
                        var errorMessage = xhr.responseJSON.message || error;
                        console.log(xhr.responseText);
                        Swal.fire("Error!", "Failed to update equipment: " + errorMessage, "error");
                    }
                });
            } else if (result.isDenied) {
                Swal.fire("Changes are not saved", "", "info");
            }
        });
    });

    // Update table row
    function updateTableRow(equipBrand, equipName) {
        var row = $('#tableBody').find(`tr[data-brand="${equipBrand}"]`);
        var row = $('#tableBody').find(`tr[data-oldname="${equipName}"]`);

        if (row.length > 0) {
            const categoryEdit = $('#EquipmentCategoryEdit').val().trim();
            const otherCategoryEdit = $('#otherEquipCategoryEdit').val().trim();
            const finalCategory = categoryEdit === 'other' ? otherCategoryEdit : categoryEdit;

            row.find('td').eq(1).text($('#EquipmentBrandNameEdit').val().trim());
            row.find('td').eq(2).text($('#EquipmentNameEdit').val().trim());
            row.find('td').eq(3).text(finalCategory);
            row.find('td').eq(6).text($('#EquipmentSKUEdit').val().trim());
            row.find('td').eq(7).text($('#EquipmentClassificationEdit').val().trim());

            row.data('color', $('#EquipmentColorEdit').val().trim());
            row.data('type', $('#EquipmentTypeEdit').val().trim());
            row.data('unit', $('#EquipmentUnitEdit').val().trim());
            row.data('unit-price', $('#EquipmentUnitPriceEdit').val().trim());
            row.data('category', categoryEdit);
            row.data('other-category', otherCategoryEdit);

            console.log('Row updated successfully');
        } else {
            console.log('Row not found for brand:', equipBrand);
        }
    }

    // Close edit modal
    $('#closeEquipFormButton').on('click', function () {
        $('#editEquipModal').addClass('hidden');
    });

    $(window).on('click', function (e) {
        if ($(e.target).is('#editEquipModal')) {
            $('#editEquipModal').addClass('hidden');
        }
    });
});


// DELETE EQUIPMENT
$(document).on('click', '#deleteEquipButton', function (event) {
    event.preventDefault();

    // Get the equipment name from the clicked delete button
    var equipName = $(this).data('equipname');

    console.log('Deleting equipment with name:', equipName);

    Swal.fire({
        title: "Are you sure you want to delete all equipment with this name?",
        showDenyButton: true,
        confirmButtonText: "Yes",
        denyButtonText: "No",
        confirmButtonColor: '#3085d6',
        denyButtonColor: '#d33'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: '/equipment/delete',
                method: 'POST',
                data: {
                    EquipmentName: equipName, // Send EquipmentName
                    _token: $('meta[name="csrf-token"]').attr('content') // CSRF token
                },
                success: function (response) {
                    Swal.fire("Deleted!", response.success, "success").then(() => {
                        // Remove rows with matching EquipmentName
                        $('tr[data-equipname="' + equipName + '"]').remove();
                    });
                },
                error: function (xhr) {
                    var errorMessage = xhr.responseJSON && xhr.responseJSON.error ?
                        xhr.responseJSON.error : 'Failed to delete equipment';
                    console.log(xhr.responseText);
                    Swal.fire("Error!", errorMessage, "error");
                }
            });
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
        const button = $(this);
        const brandName = button.data('brand');
        console.log('Brand Name:', brandName);

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
                        
                        if (!equipment.EquipmentSerialNo) {
                            equipment.EquipmentSerialNo = "Pending";
                        }

                        console.log('equipment.EquipmentSerialNo' , equipment.EquipmentSerialNo)
                        const newRow = `

                            <tr class="odd:bg-blue-100 odd:dark:bg-gray-900 even:bg-white even:dark:bg-gray-800 border-b dark:border-gray-700" data-id="${equipment.equipmentId}" data-brand="${equipment.EquipmentBrandName}">
                                <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">${equipment.EquipmentSerialNo}</td>
                                <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">${equipment.EquipmentControlNo}</td>
                                <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
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
                        $('#ViewDynamicTable tbody').attr('id','tableViewBodyEquipment')
                    });

                    // Populate the modal with detailed equipment information
                    const equipmentDetails = `
                        <p><strong>Brand Name:</strong> ${response.equipmentDetails[0].EquipmentBrandName || 'N/A'}</p>
                        <p><strong>Product Name:</strong> ${response.equipmentDetails[0].EquipmentName || 'N/A'}</p>
                        <p><strong>Category:</strong> ${response.equipmentDetails[0].EquipmentCategory || 'N/A'}</p>
                        <p><strong>SKU:</strong> ${response.equipmentDetails[0].EquipmentSKU || 'N/A'}</p>
                        <p><strong>Color:</strong> ${response.equipmentDetails[0].EquipmentColor || 'N/A'}</p>
                        <p><strong>Type:</strong> ${response.equipmentDetails[0].EquipmentType || 'N/A'}</p>
                        <p><strong>Unit:</strong> ${response.equipmentDetails[0].EquipmentUnit || 'N/A'}</p>
                        <p><strong>Unit Price:</strong> ₱${response.equipmentDetails[0].EquipmentUnitPrice ? Number(response.equipmentDetails[0].EquipmentUnitPrice).toFixed(2) : '0.00'}</p>
                        <p><strong>Classification:</strong> ${response.equipmentDetails[0].EquipmentClassification || 'N/A'}</p>
                        <p><strong>Date:</strong> ${response.equipmentDetails[0].EquipmentDate || 'N/A'}</p>
                    `;

                    $('#equipmentDetails').html(equipmentDetails);
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

        if (!equipId) {
        console.log('Equip ID is undefined or null. Row data:', row);
            } else {
                console.log('Equipment ID:', equipId);
            }

       
        $('#editFullEquipModal').removeClass('hidden');
        $('#editFullEquipForm').find('#FullEquipmentControlNoEdit').val(row.find('td').eq(1).text().trim());
        $('#editFullEquipForm').find('input[name="equipmentId"]').val(equipId);
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

                var equipId = $('#editFullEquipForm').find('input[name="equipmentId"]').val(); // Ensure ID is set correctly
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
                        console.log(xhr.responseText);
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
        var row = $('#tableViewBodyEquipment').find(`tr[data-id="${equipId}"]`);
        console.log('Updating row for ID:', equipId, row);
    
        if (row.length > 0) {
            row.find('td').eq(0).text($('#EquipmentSerialNo').val().trim()); 
            row.find('td').eq(1).text($('#FullEquipmentControlNoEdit').val().trim()); 
    
            console.log(' SAMPLE ', $('#EquipmentSerialNo').val().trim());
            console.log('Row updated successfully');
        } else {
            console.log('Row not found for ID:', equipId);
        }
    }

    // Handle closing the edit modal when the close button is clicked
    $('#closeEditFullEquipModal').on('click', function () {
        $('#editFullEquipModal').addClass('hidden');
    });

    // Close modal when clicking outside of it (but not on the modal content)
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
        var equipmentId = $('#equipmentId').val();
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
                        equipmentId: equipmentId,
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
});



//Stock In 
$(document).ready(function () {
    $(document).on('click', '.editStockInButton', function () {
        $("#StockInEquipmentPopupCard").removeClass("hidden");

        const brandName = $(this).closest('tr').data('brand'); 
        console.log("Selected brand:", brandName);
        
        $("#StockInEquipmentPopupCard").data('brand', brandName);
    });

    $("#closeStockInEquipPopupCard").click(function (event) {
        event.preventDefault();
        $("#StockInEquipmentPopupCard").addClass("hidden");
    });

    // Submit button
    $("#submitStockInEquipPopupCard").click(function (event) {
        event.preventDefault();

        // Get the brandName stored in the popup card's data
        const brandName = $("#StockInEquipmentPopupCard").data('brand');
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
            url: '/equipment/approved',
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
                    $("#StockInEquipmentPopupCard").addClass("hidden");
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


// Auto Populate the Date
document.addEventListener("DOMContentLoaded", function() {
    function formatDateToMMDDYYYY(date) {
        const month = String(date.getMonth() + 1).padStart(2, '0'); 
        const day = String(date.getDate()).padStart(2, '0');
        const year = date.getFullYear();
        return `${month}/${day}/${year}`;
    }

    const today = formatDateToMMDDYYYY(new Date());
    document.getElementById("EquipmentDate").value = today;
});











