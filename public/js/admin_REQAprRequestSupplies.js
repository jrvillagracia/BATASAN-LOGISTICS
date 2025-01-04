// VIEW BUTTON CARD FORM 
$(document).ready(function () {
    $('#ViewApprSupBtn').click(function () {
        console.log('View Supplies Button is Clicked.');
        $('#ViewAprReqSupPopupCard').removeClass('hidden');
    });

    $('#cancelAprReqSuppliesInventoryPopupCard').click(function () {
        event.preventDefault();
        console.log('Cancel Supplies Button is Clicked.');
        $('#ViewAprReqSupPopupCard').addClass('hidden');
    });
});




// COMPLETE BUTTON FORM CARD
$(document).ready(function () {
    $('#CompleteApprReqSupBtn').click(function () {
        event.preventDefault();
        console.log('View Equipment Button is Clicked.');
        $('#CompleteAprReqSupPopupCard').removeClass('hidden');
    });

    $('#closeCompleteAprReqViewSupPopupCard').click(function () {
        event.preventDefault();
        console.log('Close "X" Set Item Equipment Button is Clicked.');
        $('#CompleteAprReqSupPopupCard').addClass('hidden');
    });

    $('#CompleteSupCancelBTN').click(function () {
        event.preventDefault();
        console.log('Close Cancel Set Item Button is Clicked.');
        $('#CompleteAprReqSupPopupCard').addClass('hidden');
    });

    $("#CompleteSupSubmitBTN").click(function () {
        event.preventDefault();
        Swal.fire({
            icon: 'success',
            title: 'Submitted',
            text: 'Successfully Submit Complete Item',
            confirmButtonText: 'OK',
            confirmButtonColor: '#3085d6'
        }).then(() => {
            $("#CompleteAprReqSupPopupCard").addClass("hidden");
        });
    });
});

// CANCEL BUTTON FORM CARD
$(document).ready(function () {
    $("#CancelApprReqSupBtn").click(function () {
        $("#CancelSupPopupCard").removeClass("hidden");
    });
    
    $("#submitCancelSupPopupCard").click(function () {
        event.preventDefault();
        Swal.fire({
            icon: 'success',
            title: 'Submitted',
            text: 'Your reason has been submitted',
            confirmButtonText: 'OK',
            confirmButtonColor: '#3085d6'
        }).then(() => {
            $("#CancelSupPopupCard").addClass("hidden");
        });
    });


    $("#closeCancelSupPopupCard").click(function () {
        event.preventDefault();
        Swal.fire({
            icon: 'error',
            title: 'Cancelled',
            text: 'Decline process has been cancelled',
            confirmButtonText: 'OK',
            confirmButtonColor: '#3085d6'
        }).then(() => {
            $("#CancelSupPopupCard").addClass("hidden");
        });
    });
});

// COMPLETE BUTTON FORM CARD
$(document).ready(function () {
    $('#CompleteApprReqSupBtn').click(function () {
        event.preventDefault();
        console.log('View Equipment Button is Clicked.');
        $('#CompleteAprReqSupPopupCard').removeClass('hidden');
    });

    $('#closeCompleteAprReqViewSupPopupCard').click(function () {
        event.preventDefault();
        console.log('Close "X" Set Item Equipment Button is Clicked.');
        $('#CompleteAprReqSupPopupCard').addClass('hidden');
    });

    $('#CompleteSupCancelBTN').click(function () {
        event.preventDefault();
        console.log('Close Cancel Set Item Button is Clicked.');
        $('#CompleteAprReqSupPopupCard').addClass('hidden');
    });

    $("#CompleteSupSubmitBTN").click(function () {
        event.preventDefault();
        Swal.fire({
            icon: 'success',
            title: 'Submitted',
            text: 'Successfully Submit Complete Item',
            confirmButtonText: 'OK',
            confirmButtonColor: '#3085d6'
        }).then(() => {
            $("#CompleteAprReqSupPopupCard").addClass("hidden");
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
    $('.CompleteSup-row-checkbox').on('change', function() {
        updateCheckedCount(); // Update count when any checkbox is toggled
    });
});


// ======================== DATATABLES ============================= //
// MAIN TABLE DATATABLES
document.addEventListener("DOMContentLoaded", function () {
    // Check if the table exists and simple-datatables is loaded
    if (document.getElementById("reqSuppTable") && typeof simpleDatatables !== 'undefined') {
        const dataTable = new simpleDatatables.DataTable("#reqSuppTable", {
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

        // document.getElementById("SuppliesSearch").addEventListener("keyup", function() {
        //     let searchTerm = this.value;
        //     dataTable.search(searchTerm);
        // });
    }
});



// Export to PDF
$(document).ready(function () {
    $('#printAprReqSuppliesInventoryPopupCard').on('click', function (event) {
        // Prevent default button behavior
        event.preventDefault();

        const element = document.getElementById('view-APR-REQ-requesSupplies-pdf-content');

        // Add an additional HTML element dynamically (e.g., a footer)
        const additionalElement = $('<div id="dynamic-footer" class="text-center mt-4 text-sm text-gray-500">')
            .text('Generated by Logistics Management System © 2025');
        $(element).append(additionalElement);

        // Temporarily hide the buttons
        $('.view-APR-REQ-requestSupplies-print-btn').addClass('hidden');
        $('.cancel-APR-REQ-requestSupplies-cancel-btn').addClass('hidden');

        const options = {
            margin: 0.5,
            filename: 'Request Supplies Slip.pdf',
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
                $('.view-APR-REQ-requestSupplies-print-btn').removeClass('hidden');
                $('.cancel-APR-REQ-requestSupplies-cancel-btn').removeClass('hidden');
            });
    });
});