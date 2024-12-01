// ======================== ADD EVENT BUTTON ============================= //
$(document).ready(function() {
    $('#EventFormButton').click(function(event) {
        event.preventDefault();
        console.log('Show Event Form Button Clicked');

        const currentDate = new Date();
        const formattedDate = currentDate.toLocaleDateString('en-US', { month: '2-digit', day: '2-digit', year: 'numeric' });
        const formattedTime = currentDate.toLocaleTimeString('en-US', { hour: '2-digit', minute: '2-digit', hour12: false });

        $('#EventApprDate').val(formattedDate);
        $('#EventApprTime').val(formattedTime);

        $('#EventFormCard').removeClass('hidden'); 
    });

    $('#EventCancelFormBtn, #EventCloseFormBtn').click(function(event) {
        event.preventDefault();
        $('#EventFormCard').addClass('hidden'); 
    });

    $("#EventSubmitFormBtn").click(function(event) {
        event.preventDefault(); 

        const eventData = {
            EventApprTime: $('#EventApprTime').val(),
            EventApprDate: $('#EventApprDate').val(),
            EventApprRequestOffice: $('#EventApprRequestOffice').val(),
            EventApprRequestFor: $('#EventApprRequestFor').val(),
            EventApprName: $('#EventApprName').val(),
            StartEventApprDate: $('#StartEventApprDate').val(),
            EndEventApprDate: $('#EndEventApprDate').val(),
            StartEventApprTime: $('#StartEventApprTime').val(),
            EndEventApprTime: $('#EndEventApprTime').val(),
            EventApprLocation: $('#EventApprLocation').val(),
            EventApprProductName: $('#EventApprProductName').val(),
            EventApprQuantity: $('#EventApprQuantity').val(),
            _token: $('meta[name="csrf-token"]').attr('content'),
        };

        // Check if the table is empty
        const isTableEmpty = $('#tableBody').length === 0;

        $.ajax({
            url: '/events/store',
            method: 'POST',
            data: eventData,
            success: function(response) {
                Swal.fire({
                    icon: 'success',
                    title: 'Submitted',
                    text: 'Your inputs have been successfully submitted',
                    confirmButtonText: 'OK',
                    confirmButtonColor: '#3085d6'
                }).then(() => {
                    $("#EventFormCard").addClass("hidden"); 
                    if (isTableEmpty) {
                        // Reload the page if the table was initially empty
                        location.reload();
                    } else {
                        // If table has entries, add the new row without reloading
                        $('#yourTableId tbody').append(`<tr><td>${response.newDataField}</td></tr>`);
                    }
                });
            },
            error: function(xhr) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Please fix the errors and try again.',
                    confirmButtonText: 'OK',
                    confirmButtonColor: '#d33'
                });
            }
        });
    });
});



// ======================== END FOR ADD EVENT BUTTON ============================= //




// ======================== START FOR APPROVAL MODULE ============================= //
// VIEW BUTTON CARD FORM      
// THIS IS VIEW BUTTON IS APPLICABLE TO FOR APPROVAL, APPROVE REQUEST, COMPLETED REQUEST
$(document).ready(function() {
    $(document).on('click', '.EventViewBTN', function(event) {
        event.preventDefault();
        console.log('View Event Button Clicked');
        let eventId = $(this).data('id');
        console.log("Event ID:", eventId); // Debugging line
        
        if (eventId) {
            $.ajax({
                url: '/apr/event/details',
                type: 'GET',
                data: { id: eventId },
                success: function(response) {
                    if (response.eventDetails) {
                        $('#getEventsDetails').html(`
                            <p><strong>Date:</strong> ${response.eventDetails.EventApprDate}</p>
                            <p><strong>Time:</strong> ${response.eventDetails.EventApprTime}</p>
                            <p><strong>Requesting Office/Unit:</strong> ${response.eventDetails.EventApprRequestOffice}</p>
                            <p><strong>Event Name:</strong> ${response.eventDetails.EventApprName}</p>
                            <p><strong>Event Date:</strong> ${response.eventDetails.StartEventApprDate}</p>
                            <p><strong>Event Time:</strong> ${response.eventDetails.StartEventApprTime}</p>
                            <p><strong>Event Location:</strong> ${response.eventDetails.EventApprLocation}</p>
                            <br><hr><br>
                            <p class="mb-2"><strong>Required Equipment and Supplies</strong></p>
                            <p><strong>Product Name:</strong> ${response.eventDetails.EventApprProductName}</p>
                            <p><strong>Quantity:</strong> ${response.eventDetails.EventApprQuantity}</p>
                        `);
                        $('#ViewEventApprPopupCard').removeClass('hidden');
                    } else {
                        alert('Event details could not be loaded.');
                    }
                },
                error: function(xhr) {
                    console.error("AJAX Error:", xhr.responseJSON); // Detailed error info
                    alert('Error loading event details: ' + xhr.responseText);
                }
            });
        }
    });

    $('#closeViewEventPopupCard').click(function() {
        $('#ViewEventApprPopupCard').addClass('hidden');
    });
});



// APPROVE BUTTON CARD FORM
$(document).ready(function () {
    // Event Approve Button - Show Approval Modal
    $(document).on('click', '.EventApproveBTN', function() {
        console.log('Approve Button Clicked - Showing Approval Modal');
        $(".ApprEventPopupCard").removeClass("hidden");
    });

    // Cancel Approval Modal
    $(".closeApprEventPopupCard").click(function() {
        Swal.fire({
            icon: 'error',
            title: 'Cancelled',
            text: 'Your action has been cancelled',
            confirmButtonText: 'OK',
            confirmButtonColor: '#D1191A'
        }).then(() => {
            $(".ApprEventPopupCard").addClass("hidden");
        });
    });

    // Submit Approval
    $(".submitApprEventPopupCard").click(function() {
        var eventId = $(this).data('id');
        $.ajax({
            url: '/events/approve', 
            method: 'POST',
            data: {
                id: eventId,
                _token: $('meta[name="csrf-token"]').attr('content') 
            },
            success: function(response) {
                Swal.fire({
                    icon: 'success',
                    title: 'Approved',
                    text: 'Event approved and moved to approved requests.',
                    confirmButtonText: 'OK',
                    confirmButtonColor: '#3085d6'
                }).then(() => {
                    $(".ApprEventPopupCard").addClass("hidden");
                    location.reload();
                });
            },
            error: function(xhr) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'There was an error approving the event. Please try again.',
                    confirmButtonText: 'OK',
                    confirmButtonColor: '#d33'
                });
            }
        });
    });
});


// DECLINE BUTTON CARD FORM
$(document).ready(function () {
    // Show the Decline Event Popup Card
    $(document).on("click", ".EventDeclineBTN", function () {
        var eventId = $(this).data('id');  // Get event ID from button
        console.log("Decline button clicked for Event ID:", eventId);
        
        // Store the eventId in a hidden input or data attribute in the modal if needed
        $("#DeclineEventPopupCard").data("eventId", eventId).removeClass("hidden");
    });

    // Cancel button logic
    $("#closeDeclineEventPopupCard").click(function () {
        Swal.fire({
            icon: 'error',
            title: 'Cancelled',
            text: 'Decline process has been cancelled',
            confirmButtonText: 'OK',
            confirmButtonColor: '#3085d6'
        }).then(() => {
            $("#DeclineEventPopupCard").addClass("hidden");
        });
    });

    // Submit button logic
    $(document).on("click", ".submitDeclineEventPopupCard", function () {
        // Retrieve the event ID from the modal's data attribute
        var eventId = $("#DeclineEventPopupCard").data("eventId");

        $.ajax({
            url: '/events/decline',
            method: 'POST',
            data: {
                id: eventId,
                _token: $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                Swal.fire({
                    icon: 'success',
                    title: 'Submitted',
                    text: 'Your reason has been submitted',
                    confirmButtonText: 'OK',
                    confirmButtonColor: '#3085d6'
                }).then(() => {
                    $("#DeclineEventPopupCard").addClass("hidden");
                    location.reload();
                });
            },
            error: function(xhr) {
                console.error('Decline failed:', xhr.responseText);
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'There was an error processing your request.',
                    confirmButtonText: 'OK',
                    confirmButtonColor: '#d33'
                });
            }
        });
    });
});




// ======================== END FOR APPROVAL MODULE ============================= //





// ======================== START OF APPROVE REQUEST MODULE ============================= //




// ======================== END OF APPROVE REQUEST MODULE ============================= //






// ======================== COMPLETED REQUEST MODULE ============================= //





// ======================== END OF COMPLETED REQUEST MODULE ============================= //




// ======================== DATATABLES ============================= //
// MAIN TABLE DATATABLES
document.addEventListener("DOMContentLoaded", function () {
    // Check if the table exists and simple-datatables is loaded
    if (document.getElementById("EventApproveTable") && typeof simpleDatatables !== 'undefined') {
        const dataTable = new simpleDatatables.DataTable("#EventApproveTable", {
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

        document.getElementById("eventSearch").addEventListener("keyup", function() {
            let searchTerm = this.value;
            dataTable.search(searchTerm);
        });
    }
});
// ======================== END OF DATATABLES ============================= //





// GUMAGANA PERO MAY SIRA 
// $(document).ready(function () {
//     // Ensure jsPDF is initialized
//     window.jsPDF = window.jspdf.jsPDF;

//     $("#printApprEventPopupCard").click(function () {
//         window.html2canvas = html2canvas; // Ensure html2canvas is loaded

//         // Temporarily show the hidden popup
//         $("#ViewEventApprPopupCard").removeClass("hidden");

//         // Temporarily modify the card's background and styles to ensure proper capture
//         var originalStyles = $("#ViewEventApprPopupCard").attr("style");
//         $("#ViewEventApprPopupCard").css({
//             "background": "white", // Ensure white background
//             "box-shadow": "none", // Remove shadow
//             "color": "black" // Ensure the text color is black
//         });

//         var doc = new jsPDF();

//         // Get the HTML content of the popup
//         doc.html(document.querySelector("#ViewEventApprPopupCard"), {
//             callback: function (doc) {
//                 // Save the generated PDF
//                 doc.save("event-request-slip.pdf");

//                 // Restore original styles after PDF generation
//                 $("#ViewEventApprPopupCard").attr("style", originalStyles);

//                 // Hide the popup again
//                 $("#ViewEventApprPopupCard").addClass("hidden");
//             },
//             x: 15,
//             y: 15,
//             width: 170, // Adjust width based on content
//             html2canvas: {
//                 scale: 2, // Improve quality by increasing the scale
//                 useCORS: true, // Allow cross-origin for external resources
//                 backgroundColor: "#ffffff" // Force white background
//             }
//         });
//     });

//     // Close popup when the close button is clicked
//     $("#closeViewEventApprPopupCard").click(function () {
//         $("#ViewEventApprPopupCard").addClass("hidden");
//     });

//     // Cancel button functionality (optional)
//     $("#cancelApprEventPopupCard").click(function () {
//         $("#ViewEventApprPopupCard").addClass("hidden");
//     });
// });
