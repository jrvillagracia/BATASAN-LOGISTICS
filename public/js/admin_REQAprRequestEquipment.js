// VIEW BUTTON CARD FORM      
$(document).ready(function () {
    $('#ViewApprEquipBtn').click(function () {
        console.log('View Equipment Button is Clicked.');
        $('#ViewAprReqEquipPopupCard').removeClass('hidden');
    });

    $('#cancelAprReqEquipmentInventoryPopupCard').click(function () {
        console.log('Close "X" Equipment Button is Clicked.');
        $('#ViewAprReqEquipPopupCard').addClass('hidden');
    });
});


// SET ITEM BUTTON CARD
$(document).ready(function () {
    $('#SetItemEquipBtn').click(function () {
        console.log('View Equipment Button is Clicked.');
        $('#SetItemAprReqEquipPopupCard').removeClass('hidden');
    });

    $('#closeSetItemAprReqViewEquipPopupCard').click(function () {
        console.log('Close "X" Set Item Equipment Button is Clicked.');
        $('#SetItemAprReqEquipPopupCard').addClass('hidden');
    });

    $('#SetItemCancelBTN').click(function () {
        console.log('Close Cancel Set Item Button is Clicked.');
        $('#SetItemAprReqEquipPopupCard').addClass('hidden');
    });

    $("#SetItemSubmitBTN").click(function () {
        Swal.fire({
            icon: 'success',
            title: 'Submitted',
            text: 'Successfully Set Item!',
            confirmButtonText: 'OK',
            confirmButtonColor: '#3085d6'
        }).then(() => {
            $("#SetItemAprReqEquipPopupCard").addClass("hidden");
        });
    });


});




// ITEM NUM BUTTON
$(document).ready(function () {
    $('#SetItemEditBTN').click(function () {
        console.log('Item Num Equipment Button is Clicked.');
        $('#EditSetItemAprReqEquipPopupCard').removeClass('hidden');
    });

    $('#closeItemNumAprReqViewEquipPopupCard').click(function () {
        console.log('Close "X" Equipment Button is Clicked.');
        $('#EditSetItemAprReqEquipPopupCard').addClass('hidden');
    });


    $("#EditItemSaveBTN").click(function () {
        Swal.fire({
            icon: 'success',
            title: 'Submitted',
            text: 'Successfully Save Item Number!',
            confirmButtonText: 'OK',
            confirmButtonColor: '#3085d6'
        }).then(() => {
            $("#EditSetItemAprReqEquipPopupCard").addClass("hidden");
        });
    });

    $('#EditItemCancelBTN').click(function () {
        console.log('Close Cancel Item Num Button is Clicked.');
        $('#EditSetItemAprReqEquipPopupCard').addClass('hidden');
    });
});


//SET ITEM: EDIT CHECK BOXES BUTTON
$(document).ready(function() {
    // Function to update the checked count
    function updateCheckedCount() {
        var checkedCount = $('.row-checkbox:checked').length; // Count checked checkboxes
        var totalCount = $('.row-checkbox').length; // Total checkboxes

        // Update the text showing the checked count and total count
        $('#checkedCount').text(checkedCount);
        $('#totalCount').text(totalCount);
    }

    // Initially update the counts on page load
    updateCheckedCount();

    // Event listener for checkbox change
    $('.row-checkbox').on('change', function() {
        updateCheckedCount(); // Update count when any checkbox is toggled
    });
});

// CANCEL BUTTON FORM CARD
$(document).ready(function () {
    $("#CancelApprReqEquipBtn").click(function () {
        $("#CancelEquipPopupCard").removeClass("hidden");
    });
    
    $("#submitCancelEquipPopupCard").click(function () {
        event.preventDefault();
        Swal.fire({
            icon: 'success',
            title: 'Submitted',
            text: 'Your reason has been submitted',
            confirmButtonText: 'OK',
            confirmButtonColor: '#3085d6'
        }).then(() => {
            $("#CancelEquipPopupCard").addClass("hidden");
        });
    });


    $("#closeCancelEquipPopupCard").click(function () {
        $("#CancelEquipPopupCard").addClass("hidden");
    });

});


// COMPLETE BUTTON FORM CARD
$(document).ready(function () {
    $('#CompleteApprReqEquipBtn').click(function () {
        console.log('View Equipment Button is Clicked.');
        $('#CompleteAprReqEquipPopupCard').removeClass('hidden');
    });

    $('#closeCompleteAprReqViewEquipPopupCard').click(function () {
        console.log('Close "X" Set Item Equipment Button is Clicked.');
        $('#CompleteAprReqEquipPopupCard').addClass('hidden');
    });

    $('#CompleteCancelBTN').click(function () {
        console.log('Close Cancel Set Item Button is Clicked.');
        $('#CompleteAprReqEquipPopupCard').addClass('hidden');
    });

    $("#CompleteSubmitBTN").click(function () {
        Swal.fire({
            icon: 'success',
            title: 'Submitted',
            text: 'Successfully Submit Complete Item',
            confirmButtonText: 'OK',
            confirmButtonColor: '#3085d6'
        }).then(() => {
            $("#CompleteAprReqEquipPopupCard").addClass("hidden");
        });
    });
});


// COMPLETE BUTTON: CHECK BOXES BUTTON
$(document).ready(function() {
    // Function to update the checked count
    function updateCheckedCount() {
        var CompleteCheckedCount = $('.Complete-row-checkbox:checked').length; // Count checked checkboxes
        var CompleteTotalCount = $('.Complete-row-checkbox').length; // Total checkboxes

        // Update the text showing the checked count and total count
        $('#CompleteCheckedCount').text(CompleteCheckedCount);
        $('#CompleteTotalCount').text(CompleteTotalCount);
    }

    // Initially update the counts on page load
    updateCheckedCount();

    // Event listener for checkbox change
    $('.Complete-row-checkbox').on('change', function() {
        updateCheckedCount(); // Update count when any checkbox is toggled
    });
});







// ======================== DATATABLES ============================= //
// MAIN TABLE DATATABLES
document.addEventListener("DOMContentLoaded", function () {
    // Check if the table exists and simple-datatables is loaded
    if (document.getElementById("reqEquipTable") && typeof simpleDatatables !== 'undefined') {
        const dataTable = new simpleDatatables.DataTable("#reqEquipTable", {
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

// SET ITEM TABLE DATATABLES
document.addEventListener("DOMContentLoaded", function () {
    // Check if the table exists and simple-datatables is loaded
    if (document.getElementById("reqSETITEMEquipTable") && typeof simpleDatatables !== 'undefined') {
        const dataTable = new simpleDatatables.DataTable("#reqSETITEMEquipTable", {
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


// COMPLETE DATABLES
document.addEventListener("DOMContentLoaded", function () {
    // Check if the table exists and simple-datatables is loaded
    if (document.getElementById("reqCOMPLETEEquipTable") && typeof simpleDatatables !== 'undefined') {
        const dataTable = new simpleDatatables.DataTable("#reqCOMPLETEEquipTable", {
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



// Export to PDF
$(document).ready(function () {
    $('#printAprReqEquipmentInventoryPopupCard').on('click', function (event) {
        // Prevent default button behavior
        event.preventDefault();

        const element = document.getElementById('view-APR-REQ-requestEquipment-pdf-content');

        // Add an additional HTML element dynamically (e.g., a footer)
        const additionalElement = $('<div id="dynamic-footer" class="text-center mt-4 text-sm text-gray-500">')
            .text('Generated by Logistics Management System © 2025');
        $(element).append(additionalElement);

        // Temporarily hide the buttons
        $('.view-APR-REQ-requestEquipment-print-btn').addClass('hidden');
        $('.cancel-APR-REQ-requestEquipment-cancel-btn').addClass('hidden');

        const options = {
            margin: 0.5,
            filename: 'Request Equipment Slip.pdf',
            image: { type: 'jpeg', quality: 0.98 },
            html2canvas: {
                scale: 2, // Increase the scale for better quality
                useCORS: true, // Fix for CORS-related rendering issues
            },
            jsPDF: { unit: 'in', format: 'letter', orientation: 'landscape' } 
        };

        html2pdf()
            .set(options)
            .from(element)
            .save()
            .then(() => {
                // Remove the dynamically added HTML element after PDF generation
                $('#dynamic-footer').remove();

                // Show the buttons again after PDF generation
                $('.view-APR-REQ-requestEquipment-print-btn').removeClass('hidden');
                $('.cancel-APR-REQ-requestEquipment-cancel-btn').removeClass('hidden');
            });
    });
});