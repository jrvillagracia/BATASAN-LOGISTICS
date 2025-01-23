// VIEW 1 BUTTON CARD FORM  
$(document).ready(function () {
    $(document).on('click', '#viewEquipmentBTN', function (event){
        event.preventDefault();
        const button = $(this);
        const brandName = button.data('brand');

        // Show the modal
        $('#VwEquimentMdl').removeClass('hidden');

        // Clear existing table data
        $('#ViewDynamicTable tbody').empty();

        // Make AJAX call to fetch equipment details
        $.ajax({
            url: '/equipment/details2',
            type: 'GET',
            data: { EquipmentBrandName: brandName },
            success: function (response) {
                console.log('Response:', response);

                if (response.equipmentDetails && response.equipmentDetails.length > 0) {
                    // Populate the table dynamically
                    response.equipmentDetails.forEach(equipment => {
                        console.log('EquipmentSerialNo:', equipment.EquipmentSerialNo);

                        const newRow = `
                        <tr class="odd:bg-blue-100  even:bg-white border-b "
                            data-id="${equipment.equipmentStockId}"
                            data-brand="${equipment.EquipmentBrandName}"
                            data-serial="${equipment.EquipmentSerialNo}">
                            <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap ">
                                <input type="checkbox"  name="ViewEQUIPMENTCheckBox" data-id="${equipment.equipmentStockId}" class="ViewEQUIPMENTCheckBox w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 ">

                            </td>
                            <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap ">${equipment.EquipmentSerialNo}</td>
                            <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap ">${equipment.EquipmentControlNo}</td>
                        </tr>`;
                        $('#ViewDynamicTable tbody').append(newRow);
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

                    // Append the details to the modal content
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
});



$(document).ready(function () {
    $('#closeViewEquipmentFormBTN').click(function () {
        console.log('Close "X" Equipment Button is Clicked.');
        $('#VwEquimentMdl').addClass('hidden');
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

    // Handle category selection changes
    $('#EQUIPMENTCategoryEDT').on('change', function () {
        const category = $(this).val();
        if (category === 'other') {
            $('#otherEquipCategoryDiv').removeClass('hidden');
            const otherCategoryValue = $('#otherEQUIPMENTCategoryEDT').val();
            $('#otherEQUIPMENTCategoryEDT').val(otherCategoryValue); // set the value
        } else {
            $('#otherEquipCategoryDiv').addClass('hidden');
            $('#otherEQUIPMENTCategoryEDT').val(''); // Clear the input if not "other"
        }
    });

    // Format unit price with commas
    $('#EQUIPMENTUnitPriceEDT').on('input', function () {
        var value = $(this).val().replace(/,/g, ''); // Remove existing commas
        var formattedValue = parseFloat(value).toLocaleString('en-US'); // Format with commas
        $(this).val(formattedValue);
    });

    // Event delegation for the edit button click
    $(document).on('click', '#editEquipmentBTN', function (event) {
        event.preventDefault();
        console.log('Show Edit Equip Form Button Clicked');

        var row = $(this).closest('tr');
        var equipBrand = row.data('brand');
        var equipType = row.data('type');
        var equipUnit = row.data('unit');
        var equipUnitPrice = row.data('unit-price');
        var equipColor = row.data('color');
        var equipClassification = row.data('classification');
        var otherCategory = row.find('td').eq(3).text().trim();
        console.log('Edit button clicked for equipment Brand:', equipBrand);

        $('#editEQUIPMENTMdl').removeClass('hidden');
        $('#saveEQUIPBTN').data('oldbrandName',row.find('td').eq(0).text().trim());
        $('#saveEQUIPBTN').data('oldName',row.find('td').eq(1).text().trim());
        
        // Populate modal fields with row data
        $("#EQUIPMENTBrandNameEDT").val(row.find('td').eq(0).text().trim());
        $("#EQUIPMENTNameEDT").val(row.find('td').eq(1).text().trim());
        $("#EQUIPMENTCategoryEDT").val(row.find('td').eq(2).text().trim());
        $("#EQUIPMENTQuantityEDT").val(row.find('td').eq(3).text().trim());
        $("#EQUIPMENTSKUEDT").val(row.find('td').eq(5).text().trim());

        $('#EQUIPMENTClassificationEDT').val(equipClassification);
        $('#EQUIPMENTColorEDT').val(equipColor);
        $('#EQUIPMENTTypeEDT').val(equipType);
        $('#EQUIPMENTUnitEDT').val(equipUnit);
        $('#EQUIPMENTUnitPriceEDT').val(equipUnitPrice);

        $('input[name="brand"]').val(equipBrand);

        if (otherCategory === 'other') {
            $('#otherEquipCategoryDiv').removeClass('hidden');
            $('#otherEQUIPMENTCategoryEDT').val(otherCategory);
        } else {
            $('#otherEquipCategoryDiv').addClass('hidden');
            $('#otherEQUIPMENTCategoryEDT').val('');
        }
    });

    // Handle saving changes
    $('#saveEQUIPBTN').on('click', function (e) {
        e.preventDefault();

        const oldbrandName = $(this).data('oldbrandName');
        const oldName = $(this).data('oldName');
        const category = $('#EQUIPMENTCategoryEDT').val();
        const otherCategory = $('#otherEQUIPMENTCategoryEDT').val().trim();
        const brandName = $('#EQUIPMENTBrandNameEDT').val().trim();
        const name = $('#EQUIPMENTNameEDT').val().trim();
        const quantity = $('#EQUIPMENTQuantityEDT').val().trim();
        const sku = $('#EQUIPMENTSKUEDT').val().trim();
        const classification = $('#EQUIPMENTClassificationEDT').val().trim();
        const color = $('#EQUIPMENTColorEDT').val().trim();
        const type = $('#EQUIPMENTTypeEDT').val().trim();
        const unit = $('#EQUIPMENTUnitEDT').val().trim();
        const unitprice = $('#EQUIPMENTUnitPriceEDT').val().trim();

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
                    $('#EQUIPMENTCategoryEDT').val('other');
                }

                console.log('oldbrandName:', oldbrandName )
                console.log('oldName:', oldName )

                $.ajax({
                    url: '/update/main-table',
                    method: 'POST',
                    data: {
                        _token: $('#csrf-token').data('token'),
                        oldbrandName: oldbrandName,
                        oldName: oldName,
                        EQUIPMENTBrandNameEDT: brandName,
                        EQUIPMENTNameEDT: name,
                        EQUIPMENTCategoryEDT: category,
                        EQUIPMENTQuantityEDT: quantity,
                        EQUIPMENTSKUEDT: sku,
                        EQUIPMENTClassificationEDT: classification,
                        EQUIPMENTColorEDT: color,
                        EQUIPMENTTypeEDT: type,
                        EQUIPMENTUnitEDT: unit,
                        EQUIPMENTUnitPriceEDT: unitprice,
                        otherEQUIPMENTCategoryEDT: otherCategory // Add this line
                    },
                    success: function () {
                        Swal.fire("Saved!", "", "success").then(() => {
                            updateTableRow(equipBrand);
                            $('#editEQUIPMENTMdl').addClass('hidden');
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
    function updateTableRow(equipBrand) {
        var row = $('#tableBody').find(`tr[data-brand="${equipBrand}"]`);

        if (row.length > 0) {
            const categoryEdit = $('#EQUIPMENTCategoryEDT').val().trim();
            const otherCategoryEdit = $('#otherEQUIPMENTCategoryEDT').val().trim();
            const finalCategory = categoryEdit === 'other' ? otherCategoryEdit : categoryEdit;

            row.find('td').eq(0).text($('#EQUIPMENTBrandNameEDT').val().trim());
            row.find('td').eq(1).text($('#EQUIPMENTNameEDT').val().trim());
            row.find('td').eq(2).text(finalCategory);
            row.find('td').eq(3).text($('#EQUIPMENTQuantityEDT').val().trim());
            row.find('td').eq(5).text($('#EQUIPMENTSKUEDT').val().trim());

            row.data('classification', $('#EQUIPMENTClassificationEDT').val().trim());
            row.data('color', $('#EQUIPMENTColorEDT').val().trim());
            row.data('type', $('#EQUIPMENTTypeEDT').val().trim());
            row.data('unit', $('#EQUIPMENTUnitEDT').val().trim());
            row.data('unit-price', $('#EQUIPMENTUnitPriceEDT').val().trim());
            row.data('category', categoryEdit);
            row.data('other-category', otherCategoryEdit);

            console.log('Row updated successfully');
        } else {
            console.log('Row not found for brand:', equipBrand);
        }
    }

    // Close edit modal
    $('#closeEQUIPMENTFormBTN').on('click', function (e) {
        e.preventDefault();
        $('#editEQUIPMENTMdl').addClass('hidden');
    });

    $(window).on('click', function (e) {
        if ($(e.target).is('#editEQUIPMENTMdl')) {
            $('#editEQUIPMENTMdl').addClass('hidden');
        }
    });
});

// DELETE EQUIPMENT
$(document).on('click', '#deleteEQUIPBTN', function (event) {
    event.preventDefault();

    // Get the brand name from the clicked delete button
    var equipBrand = $(this).data('brand');

    console.log('Deleting equipment with brand name:', equipBrand);

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
                url: '/equipment/delete-stock', 
                method: 'POST',
                data: {
                    brand: equipBrand,
                    _token: $('meta[name="csrf-token"]').attr('content') 
                },
                success: function (response) {
                    Swal.fire("Deleted!", response.message, "success").then(() => {
                        $('tr[data-brand="' + equipBrand + '"]').remove();
                    })
                },
                error: function (xhr) {
                    var errorMessage = xhr.responseJSON && xhr.responseJSON.message ?
                        xhr.responseJSON.message : 'Failed to delete equipment';
                    console.log(xhr.responseText);
                    Swal.fire("Error!", errorMessage, "error");
                }
            });
        }
    });
});

// LOW STOCK CHECKBOX INSIDE THE EDIT 1 FORM
$(document).ready(function () {
    // Toggle visibility of the threshold input based on checkbox state
    $('#lowStockAlert').change(function () {
        if ($(this).is(':checked')) {
            $('#lowStockThresholdDiv').removeClass('hidden'); // Show input
        } else {
            $('#lowStockThresholdDiv').addClass('hidden'); // Hide input
        }
    });
});

// SELECT ALL BUTTON IN MAIN TABLE 
$(document).ready(function() {
    let isAllChecked = false;
    

    $('#EquipSelectAllBTN').click(function() {
        isAllChecked = !isAllChecked;
        $('#dynamicTable').find('input[type="checkbox"]').prop('checked', isAllChecked);

        if (isAllChecked) {
            $(this).text('Unselect All');
        } else {
            $(this).text('Select All');
        }
    });
});


// SELECT ALL BUTTON IN VIEW TABLE 
$(document).ready(function() {
    let isAllChecked = false;
    $('#ViewEquipSelectAllBTN').click(function() {
        event.preventDefault();
        isAllChecked = !isAllChecked;
        $('#ViewDynamicTable').find('input[type="checkbox"]').prop('checked', isAllChecked);

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
    $('#ViewEquipExportBTN').click(function (event) {
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

// CONDEM VALIDATION
$(document).ready(function () {
    // Condemn button click handler
    $("#ViewEquipCondemnedBTN").click(function (event) {
        event.preventDefault();

        // Collect checked items' equipmentSerialNo or equipmentControlNo
        let selectedItems = [];
        $("input[name='ViewEQUIPMENTCheckBox']:checked").each(function () {
            let equipmentStockId = $(this).data("id"); // Get equipment stock ID
            if (equipmentStockId) {
                selectedItems.push(equipmentStockId);
                console.log("Selected equipment: " + equipmentStockId); // Log the selected items
            }
        });

        // If no items are selected, show an error message
        if (selectedItems.length === 0) {
            Swal.fire({
                icon: 'error',
                title: 'No Items Selected',
                text: 'Please select at least one item to condemn.',
                confirmButtonText: 'OK',
                confirmButtonColor: '#D1191A',
            });
            return;
        }

        // Proceed with the AJAX call to condemn the selected items
        $.ajax({
            url: "/condemn-equipment",
            type: "POST",
            data: {
                equipment_ids: selectedItems,
                _token: $("#csrf-token").data("token"),
            },
            success: function (response) {
                Swal.fire({
                    icon: 'success',
                    title: 'Submitted',
                    text: response.message,
                    confirmButtonText: 'OK',
                    confirmButtonColor: '#3085d6',
                }).then(() => {
                    location.reload(); // Refresh the UI to reflect changes
                });
            },
            error: function (xhr) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: xhr.responseJSON.message || 'An error occurred.',
                    confirmButtonText: 'OK',
                    confirmButtonColor: '#D1191A',
                });
            },
        });
    });
});



// EDIT 2 BUTTON
$(document).ready(function () {
    $('#ViewEditEQUIPMENTBTN').click(function () {
        event.preventDefault();
        console.log('Edit Form Button is Clicked.');
        $('#edtFullEquipmentpMdl').removeClass('hidden');
    });

    $('#closeEdtFullEquipmentMdl').click(function () {
        console.log('Close Button is Clicked.');
        $('#edtFullEquipmentpMdl').addClass('hidden');
    });

    $("#saveFullEQUIPBTN").click(function () {
        Swal.fire({
            icon: 'success',
            title: 'Submitted',
            text: 'Your action has been successfully submitted',
            confirmButtonText: 'OK',
            confirmButtonColor: '#3085d6'
        }).then(() => {
            $("#edtFullEquipmentpMdl").addClass("hidden");
        });
    });

    $("#deleteFullEQUIPBTN").click(function () {
        Swal.fire({
            title: "Are you sure you want to delete this equipment?",
            showDenyButton: true,
            confirmButtonText: "Yes",
            denyButtonText: "No",
            confirmButtonColor: '#3085d6',
            denyButtonColor: '#d33'
        }).then((result) => {
            if (result.isConfirmed) {
                // User clicked "Yes" - proceed with deletion logic
                $("#edtFullEquipmentpMdl").addClass("hidden");
                // Add your deletion logic here (e.g., an AJAX request)
                console.log("Equipment deleted!");
            } else if (result.isDenied) {
                // User clicked "No" - you can add any other logic here if needed
                console.log("Deletion canceled!");
            }
        });
    });    
});

// Export Button
$(document).ready(function() {
    $('#EquipExportBTN').on('click', function(event) {
        event.preventDefault(); // Prevent default action (e.g., form submission)

        // Trigger the Excel export by navigating to the export route
        window.location.href = '/export-equipment';
    });
});