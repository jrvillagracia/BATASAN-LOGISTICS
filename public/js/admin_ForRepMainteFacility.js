//==================== VIEW =======================//
$(document).ready(function () {
    $('.REPMaintenanceFacilitytViewBTN').click(function () {
        const facilityApproveIndex = $(this).data('index');
        console.log('View Facility Button is Clicked.');

        $(`#REPViewMainteFacilityPopupCard--${facilityApproveIndex}`).removeClass('hidden');
    });

    $('.cancelViewForReprMainteFacilityPopupCard').click(function (event) {
        event.preventDefault();
        const facilityApproveIndex = $(this).data('index')
        console.log('Cancel View Facility Button is Clicked.');
        $(`#REPViewMainteFacilityPopupCard--${facilityApproveIndex}`).addClass('hidden');
    });
});

//==================== SET JOB =======================//
$(document).ready(function () {
    $('.REPMaintenanceFacilitytSetBTN').click(function () {
        const facilitySetJobIndex =$(this).data('index');
        console.log('View Facility Button is Clicked.');
        $(`#REPSetMainteFacilityPopupCard--${facilitySetJobIndex}`).removeClass('hidden');
    });

    $('.cancelSetForReprMainteFacilityPopupCard').click(function (event) {
        event.preventDefault();
        const facilitySetJobIndex =$(this).data('index');
        console.log('Cancel View Facility Button is Clicked.');
        $(`#REPSetMainteFacilityPopupCard--${facilitySetJobIndex}`).addClass('hidden');
    });
});


//==================== COMPLETED =======================//
$(document).ready(function() {
    $(".REPMaintenanceFacilityCompBTN").click(function() {
        var facilityApproveId = $(this).data('id');
        $("#REPCompleteMntcFacilityPopCard").data("facilityApproveId", facilityApproveId).removeClass("hidden");
    });

    $("#cancelCompMainteFacPopupCard").click(function(event) {
        event.preventDefault();
        $("#REPCompleteMntcFacilityPopCard").addClass("hidden");
        $("#complete-loader").remove(); //remove loader if cancelled
    });

    // Handle the completion form submission
    $(".submitCompMainteFacPopupCard").click(function(event) {
        event.preventDefault();
        var facilityApproveId = $("#REPCompleteMntcFacilityPopCard").data("facilityApproveId");

        // Show the loader
        $("#REPCompleteMntcFacilityPopCard").append(`
            <div id="complete-loader" class="fixed inset-0 bg-gray-800 bg-opacity-50 flex flex-col items-center justify-center z-50">
                <section class="dots-container">
                    <div class="dot"></div>
                    <div class="dot"></div>
                    <div class="dot"></div>
                    <div class="dot"></div>
                    <div class="dot"></div>
                </section>
                <div class="dot-loader-dialog">
                    <p>Completing request, please wait...</p>
                </div>
            </div>
        `);

        $.ajax({
            url: '/admin/facilityApprove/complete', 
            method: 'POST',
            data: {
                facilityApproveId: facilityApproveId,
                _token: $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                $("#complete-loader").remove(); //remove loader after success
                Swal.fire({
                    icon: 'success',
                    title: 'Submitted',
                    text: response.message || 'Your action has been successfully submitted',
                    confirmButtonText: 'OK',
                    confirmButtonColor: '#3085d6'
                }).then(() => {
                    $("#REPCompleteMntcFacilityPopCard").addClass("hidden");
                    //remove the row from the table after success
                    $('tr[data-id="' + facilityApproveId + '"]').remove();
                });
            },
            error: function(xhr, status, error) {
                $("#complete-loader").remove(); //remove loader after error
                console.log(xhr.responseText);
                Swal.fire({
                    icon: 'error',
                    title: 'Submission Failed',
                    text: xhr.responseJSON?.message || 'There was an error processing your request. Please try again.',
                    confirmButtonText: 'OK',
                    confirmButtonColor: '#d33'
                });
            }
        });
    });
});


//==================== CANCEL =======================//
$(document).ready(function() {
    // Show the popup when the "Cancel" button is clicked
    $(".REPMaintenanceFacilityCancelBTN").click(function() {
        var facilityApproveId = $(this).data('id');
        $("#REPCancelMainteFacilityPopupCard").data("facilityApproveId", facilityApproveId).removeClass("hidden");
    });

    // Hide the popup and show Cancel message when Cancel button is clicked
    $("#cancelMainteFacPopupCard").click(function(event) {
        event.preventDefault();
        $("#REPCancelMainteFacilityPopupCard").addClass("hidden");
        $("#cancel-loader-rep").remove(); //remove loader if cancel
    });

    // Handle the cancellation form submission
    $(".submitMainteFacPopupCard").click(function(event) {
        event.preventDefault();

        // Retrieve facilityApproveId from the popup's data
        var facilityApproveId = $("#REPCancelMainteFacilityPopupCard").data("facilityApproveId");

        // Show the loader
        $("#REPCancelMainteFacilityPopupCard").append(`
            <div id="cancel-loader-rep" class="fixed inset-0 bg-gray-800 bg-opacity-50 flex flex-col items-center justify-center z-50">
                <section class="dots-container">
                    <div class="dot"></div>
                    <div class="dot"></div>
                    <div class="dot"></div>
                    <div class="dot"></div>
                    <div class="dot"></div>
                </section>
                <div class="dot-loader-dialog">
                    <p>Cancelling request, please wait...</p>
                </div>
            </div>
        `);

        $.ajax({
            url: '/admin/facilityApprove/cancel',
            method: 'POST',
            data: {
                facilityApproveId: facilityApproveId,
                _token: $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                $("#cancel-loader-rep").remove(); 
                Swal.fire({
                    icon: 'success',
                    title: 'Submitted',
                    text: response.message || 'Your action has been successfully submitted',
                    confirmButtonText: 'OK',
                    confirmButtonColor: '#3085d6'
                }).then(() => {
                    $("#REPCancelMainteFacilityPopupCard").addClass("hidden");
                    //remove the row from the table after success
                    $('tr[data-id="' + facilityApproveId + '"]').remove();
                });
            },
            error: function(xhr, status, error) {
                $("#cancel-loader-rep").remove(); //remove loader after error
                console.log(xhr.responseText);
                Swal.fire({
                    icon: 'error',
                    title: 'Submission Failed',
                    text: xhr.responseJSON?.message || 'There was an error processing your request. Please try again.',
                    confirmButtonText: 'OK',
                    confirmButtonColor: '#d33'
                });
            }
        });
    });
});



// ======================== DATATABLES ============================= //
// MAIN TABLE DATATABLES
document.addEventListener("DOMContentLoaded", function () {
    // Check if the table exists and simple-datatables is loaded
    if (document.getElementById("MainteFacilityTable") && typeof simpleDatatables !== 'undefined') {
        const dataTable = new simpleDatatables.DataTable("#MainteFacilityTable", {
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

        // document.getElementById("MainteFacilitySearch").addEventListener("keyup", function() {
        //     let searchTerm = this.value;
        //     dataTable.search(searchTerm);
        // });
    }
});


// Export to PDF
$(document).ready(function () {
    $('#printSetForRepMainteFacilityPopupCard').on('click', function (event) {
        // Prevent default button behavior
        event.preventDefault();

        const element = document.getElementById('set-item-FORRE-maintFaci-print-btn');

        // Add an additional HTML element dynamically (e.g., a footer)
        const additionalElement = $('<div id="dynamic-footer" class="text-center mt-4 text-sm text-gray-500">')
            .text('Generated by Logistics Management System © 2025');
        $(element).append(additionalElement);

        // Temporarily hide the buttons
        $('.set-item-FOR-REP-FACILITY-print-btn').addClass('hidden');
        $('.set-item-FOR-REP-FACILITY-cance-btn').addClass('hidden');

        const options = {
            margin: 0.5,
            filename: 'Maintenance Facility For Repair Request Slip.pdf',
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
                $('.set-item-FOR-REP-FACILITY-print-btn').removeClass('hidden');
                $('.set-item-FOR-REP-FACILITY-cance-btn').removeClass('hidden');
            });
    });
});