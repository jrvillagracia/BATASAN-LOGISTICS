//==================== VIEW =======================//
$(document).ready(function () {
    $('#REPMaintenanceEquipmentViewBTN').click(function () {
        console.log('View Equipment Button is Clicked.');
        $('#REPViewMainteInventoryPopupCard').removeClass('hidden');
    });

    $('#cancelViewForReprMainteInventoryPopupCard').click(function () {
        event.preventDefault();
        console.log('Cancel View Equipment Button is Clicked.');
        $('#REPViewMainteInventoryPopupCard').addClass('hidden');
    });
});

//==================== SET JOB =======================//
$(document).ready(function () {
    $('#REPMaintenanceEquipmentSetBTN').click(function () {
        console.log('View Equipment Button is Clicked.');
        $('#REPSetMainteInventoryPopupCard').removeClass('hidden');
    });


    $('#REPCloseSetMainteInventoryPopupCard').click(function () {
        event.preventDefault();
        console.log('Close "X" Equipment Button is Clicked.');
        $('#REPSetMainteInventoryPopupCard').addClass('hidden');
    });


    $('#cancelSetForReprMainteInventoryPopupCard').click(function () {
        event.preventDefault();
        console.log('Cancel View Equipment Button is Clicked.');
        $('#REPSetMainteInventoryPopupCard').addClass('hidden');
    });
});


//==================== COMPLETED =======================//
$(document).ready(function () {
    $("#REPMaintenanceEquipmentCompleteBTN").click(function () {
        $("#CompMainteInventoryPopupCard").removeClass("hidden");
    });

    // Hide the popup and show Cancel message when Cancel button is clicked
    $("#cancelCompMainteInventoryPopupCard").click(function () {
        event.preventDefault();
        Swal.fire({
            icon: 'error',
            title: 'Cancelled',
            text: 'Your action has been cancelled',
            confirmButtonText: 'OK',
            confirmButtonColor: '#D1191A'
        }).then(() => {
            $("#CompMainteInventoryPopupCard").addClass("hidden");
        });
        
    });

    // Hide the popup and show Submitted message when Submit button is clicked
    $("#submitCompMainteInventoryPopupCard").click(function () {
        event.preventDefault();
        Swal.fire({
            icon: 'success',
            title: 'Submitted',
            text: 'Your action has been successfully submitted',
            confirmButtonText: 'OK',
            confirmButtonColor: '#3085d6'
        }).then(() => {
            $("#CompMainteInventoryPopupCard").addClass("hidden");
        });
    });
});

//==================== CANCEL =======================//
$(document).ready(function () {
    $("#REPMaintenanceEquipmentCancelBTN").click(function () {
        $("#CancelMainteInventoryPopupCard").removeClass("hidden");
    });

    // Hide the popup and show Cancel message when Cancel button is clicked
    $("#cancelMainteInventoryPopupCard").click(function () {
        event.preventDefault();
        Swal.fire({
            icon: 'error',
            title: 'Cancelled',
            text: 'Your action has been cancelled',
            confirmButtonText: 'OK',
            confirmButtonColor: '#D1191A'
        }).then(() => {
            $("#CancelMainteInventoryPopupCard").addClass("hidden");
        });
        
    });

    // Hide the popup and show Submitted message when Submit button is clicked
    $("#submitMainteInventoryPopupCard").click(function () {
        event.preventDefault();
        Swal.fire({
            icon: 'success',
            title: 'Submitted',
            text: 'Your action has been successfully submitted',
            confirmButtonText: 'OK',
            confirmButtonColor: '#3085d6'
        }).then(() => {
            $("#CancelMainteInventoryPopupCard").addClass("hidden");
        });
    });
});



// ======================== DATATABLES ============================= //
// MAIN TABLE DATATABLES
document.addEventListener("DOMContentLoaded", function () {
    // Check if the table exists and simple-datatables is loaded
    if (document.getElementById("MainteInventoryTable") && typeof simpleDatatables !== 'undefined') {
        const dataTable = new simpleDatatables.DataTable("#MainteInventoryTable", {
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

        // document.getElementById("MainteEquipmentSearch").addEventListener("keyup", function() {
        //     let searchTerm = this.value;
        //     dataTable.search(searchTerm);
        // });
    }
});


// Export to PDF
$(document).ready(function () {
    $('#printSetForRepMainteInventoryPopupCard').on('click', function (event) {
        // Prevent default button behavior
        event.preventDefault();

        const element = document.getElementById('set-item-FOREPmaintequip-pdf-content');

        // Add an additional HTML element dynamically (e.g., a footer)
        const additionalElement = $('<div id="dynamic-footer" class="text-center mt-4 text-sm text-gray-500">')
            .text('Generated by Logistics Management System © 2025');
        $(element).append(additionalElement);

        // Temporarily hide the buttons
        $('.set-item-print-btn').addClass('hidden');
        $('.set-item-cancel-btn').addClass('hidden');

        const options = {
            margin: 0.5,
            filename: 'Maintenance For Repair Request Slip.pdf',
            image: { type: 'jpeg', quality: 0.98 },
            html2canvas: {
                scale: 2, // Increase the scale for better quality
                useCORS: true, // Fix for CORS-related rendering issues
            },
            jsPDF: { unit: 'in', format: 'letter', orientation: 'portrait' } // Set portrait orientation
        };

        html2pdf()
            .set(options)
            .from(element)
            .save()
            .then(() => {
                // Remove the dynamically added HTML element after PDF generation
                $('#dynamic-footer').remove();

                // Show the buttons again after PDF generation
                $('.set-item-print-btn').removeClass('hidden');
                $('.set-item-cancel-btn').removeClass('hidden');
            });
    });
});
