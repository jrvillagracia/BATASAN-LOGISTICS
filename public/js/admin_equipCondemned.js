// VIEW CONDEMNED MODAL
$(document).ready(function () {
    $(document).on('click', '#viewCondEquipButton', function () {
        const button = $(this);
        const brandName = button.data('brand');

        // Show the modal
        $('#ViewCondEquipModal').removeClass('hidden');

        // Clear existing table data
        $('#ViewDynamicTable tbody').empty();

        // Make AJAX call to fetch equipment details
        $.ajax({
            url: '/equipment/details3',
            type: 'GET',
            data: { EquipmentBrandName: brandName },
            success: function (response) {
                console.log('Response:', response);

                if (response.equipmentDetails && response.equipmentDetails.length > 0) {
                    // Populate the table dynamically
                    response.equipmentDetails.forEach(equipment => {
                        console.log('EquipmentSerialNo:', equipment.EquipmentSerialNo);

                        const newRow = `
                        <tr class="odd:bg-blue-100 odd:dark:bg-gray-900 even:bg-white even:dark:bg-gray-800 border-b dark:border-gray-700"
                            data-id="${equipment.equipcondemId}"
                            data-brand="${equipment.EquipmentBrandName}"
                            data-serial="${equipment.EquipmentSerialNo}">
                            <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                <input type="checkbox"  name="ViewEQUIPMENTCheckBox" data-id="${equipment.equipcondemId}" class="ViewEQUIPMENTCheckBox w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">

                            </td>
                            <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">${equipment.EquipmentSerialNo}</td>
                            <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">${equipment.EquipmentControlNo}</td>
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

    $('#closeViewCondEquipModal').click(function() {
        event.preventDefault();
        console.log('Close View Form Button Clicked');
        $('#ViewCondEquipModal').addClass('hidden'); 
    });
});



// SELECT ALL BUTTON IN MAIN TABLE 
$(document).ready(function() {
    let isAllChecked = false;
    

    $('#EquipCondSelectAllBTN').click(function() {
        event.preventDefault();
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
    $('#ViewEquipCondSelectAllBTN').click(function() {
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
    $('#ViewEquipCondExportBTN').click(function (event) {
        event.preventDefault();
        console.log('View Exported Button is Clicked.');
        $('#CondEquipDataIncludedModal').removeClass('hidden');
    });

    // Select All button functionality
    $('#VIEWCondselectAllBtn').click(function () {
        $('#CondCheckboxGroup input[type="checkbox"]').prop('checked', true);
    });

    // Cancel button functionality
    $('#VIEWCondcancelBtn').click(function () {
        $('#CondEquipDataIncludedModal').addClass('hidden');
    });

    // Manual checkbox functionality (optional: log which checkbox is clicked)
    $('#CondCheckboxGroup input[type="checkbox"]').change(function () {
        console.log($(this).next('span').text() + ' checkbox state: ' + $(this).prop('checked'));
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
