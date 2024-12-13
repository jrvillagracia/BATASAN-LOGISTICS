// VIEW 1 BUTTON CARD FORM  
$(document).ready(function () {
    $(document).on('click', '#viewEquipmentBTN', function () {
        const button = $(this);
        const brandName = button.data('brand');

        $('#VwEquimentMdl').removeClass('hidden');
        $('#ViewDynamicTable tbody').empty();

        $.ajax({
            url: '/equipment/details2',
            type: 'GET',
            data: { EquipmentBrandName: brandName },
            success: function (response) {
                console.log('Response:', response);

                if (response.equipmentDetails && response.equipmentDetails.length > 0) {
                    response.equipmentDetails.forEach(equipment => {
                        console.log('equipment.EquipmentSerialNo:', equipment.EquipmentSerialNo);

                        const newRow = `
                        <tr class="odd:bg-blue-100 odd:dark:bg-gray-900 even:bg-white even:dark:bg-gray-800 border-b dark:border-gray-700"
                            data-id="${equipment.id}"
                            data-brand="${equipment.EquipmentBrandName}"
                            data-serial="${equipment.EquipmentSerialNo}">
                            <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                <input id="ViewEQUIPMENTCheckBox" type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                            </td>
                            <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">${equipment.EquipmentSerialNo}</td>
                            <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">${equipment.EquipmentControlNo}</td>
                        </tr>`;
                        $('#ViewDynamicTable tbody').append(newRow);
                    });
                } else {
                    console.log('No equipment details found.');
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

// EDIT 1 BUTTON
$(document).ready(function () {
    $('#editEquipmentBTN').click(function () {
        console.log('View Equipment Button is Clicked.');
        $('#editEQUIPMENTMdl').removeClass('hidden');
    });

    $('#closeEQUIPMENTFormBTN').click(function () {
        console.log('Close "X" Equipment Button is Clicked.');
        $('#editEQUIPMENTMdl').addClass('hidden');
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
    $("#ViewEquipCondemnedBTN").click(function () {
        event.preventDefault();
        $("#CondemnedEquipmentPopupCard").removeClass("hidden");
    });

    // Hide the popup and show Cancel message when Cancel button is clicked
    $("#closeCondemnedEquipPopupCard").click(function () {
        event.preventDefault();
        Swal.fire({
            icon: 'error',
            title: 'Cancelled',
            text: 'Your action has been cancelled',
            confirmButtonText: 'OK',
            confirmButtonColor: '#D1191A'
        }).then(() => {
            $("#CondemnedEquipmentPopupCard").addClass("hidden");
        });
    });

    // Hide the popup and show Submitted message when Submit button is clicked
    $("#submitCondemnedEquipPopupCard").click(function () {
        event.preventDefault();
        Swal.fire({
            icon: 'success',
            title: 'Submitted',
            text: 'Your action has been successfully submitted',
            confirmButtonText: 'OK',
            confirmButtonColor: '#3085d6'
        }).then(() => {
            $("#CondemnedEquipmentPopupCard").addClass("hidden");
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
