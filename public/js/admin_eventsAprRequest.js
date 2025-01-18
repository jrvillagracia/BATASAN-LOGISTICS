// ======================== START FOR APPROVAL REQUEST MODULE ============================= //
// VIEW BUTTON CARD FORM      
// THIS IS VIEW BUTTON IS APPLICABLE TO FOR APPROVAL, APPROVE REQUEST, COMPLETED REQUEST
$(document).ready(function() {
    // Event View Button - View Event Details
    $(document).on('click', '.EventApprReqViewBTN', function(event) {
        event.preventDefault();
        console.log('View Event Button Clicked');

        // Get the event ID from the clicked button
        let eventId = $(this).data('id');

        if (eventId) {
            $.ajax({
                url: '/event/details',
                type: 'GET',
                data: { id: eventId },
                success: function(response) {
                    if (response.eventDetails) {
                        // Populate the modal with the event details
                        $('#getEventsDetails').html(`
                            <p><strong>Date:</strong> ${response.eventDetails.EventApprDate}</p>
                            <p><strong>Time:</strong> ${response.eventDetails.EventApprTime}</p>
                            <p><strong>Requesting Office/Unit:</strong> ${response.eventDetails.EventApprRequestOffice}</p>
                            <p><strong>Event Name:</strong> ${response.eventDetails.EventApprName}</p>
                            <p><strong>Event Date:</strong> ${response.eventDetails.StartEventApprDate}</p>
                            <p><strong>Event Time:</strong> ${response.eventDetails.StartEventApprTime}</p>
                            <p><strong>Event Location:</strong> ${response.eventDetails.EventApprLocation}</p>
                            <br><hr>
                        `);
                        // Show the modal
                        $('#ViewEventApprReqPopupCard').removeClass('hidden');
                    } else {
                        alert('Event details could not be loaded.');
                    }
                },
                error: function(xhr) {
                    alert('Error loading event details: ' + xhr.responseText);
                }
            });
        }
    });

    // Close View Modal
    $('#closeViewEventApprReqPopupCard').click(function() {
        $('#ViewEventApprReqPopupCard').addClass('hidden');
    });
});


// ======================== COMPLETED BUTTON ============================= //
$(document).ready(function () {
    // Event delegation for Completed button
    $(document).on('click', '.EventApprReqCompletedBTN', function () {
        console.log('Completed Event Button is Clicked.');
        $('#CompletedEventApprReqPopupCard').removeClass('hidden');
    });

    $(document).on('click', '#closeCompletedEventApprReqPopupCard', function (event) {
        event.preventDefault();
        console.log('Close Completed Button is Clicked.');
        $('#CompletedEventApprReqPopupCard').addClass('hidden');
    });

    $(document).on('click', '#submitCompletedEventApprReqPopupCard', function (event) {
        event.preventDefault();
        Swal.fire({
            icon: 'success',
            title: 'Submitted',
            text: 'Item Completed',
            confirmButtonText: 'OK',
            confirmButtonColor: '#3085d6'
        }).then(() => {
            $('#CompletedEventApprReqPopupCard').addClass('hidden');
        });
    });
});

// ======================== CANCEL BUTTON ============================= //
$(document).ready(function () {
    // Show the popup when the EventApprReqCancelBTN button is clicked
    $(".EventApprReqCancelBTN").click(function () {
        $("#CancelEventPopupCard").removeClass("hidden");

        // Store the event ID in the submit button's data attribute
        const eventId = $(this).data("id");
        $("#submitCancelEventPopupCard").data("id", eventId);
    });

    // Close popup and show cancellation message when Cancel button is clicked
    $("#closeCancelEventPopupCard").click(function (event) {
        event.preventDefault();
        Swal.fire({
            icon: 'error',
            title: 'Closed',
            text: 'This request has been closed',
            confirmButtonText: 'OK',
            confirmButtonColor: '#3085d6'
        }).then(() => {
            $("#CancelEventPopupCard").addClass("hidden");
        });
    });

    // AJAX request for submitting the cancel action
    $(".submitCancelEventPopupCard").click(function (event) {
        event.preventDefault();

        // Get the event ID stored in the submit button's data attribute
        const eventId = $(this).data("id");
        console.log("Submitting cancellation for Event ID:", eventId);

        // AJAX call to cancel the event
        $.ajax({
            url: "/cancel-event", // Laravel route for canceling the event
            method: "POST",
            data: {
                id: eventId,
                _token: $('meta[name="csrf-token"]').attr("content") // CSRF token
            },
            success: function (response) {
                console.log("Success response:", response);
                Swal.fire({
                    icon: 'success',
                    title: 'Submitted',
                    text: response.message,
                    confirmButtonText: 'OK',
                    confirmButtonColor: '#3085d6'
                }).then(() => {
                    $("#CancelEventPopupCard").addClass("hidden");
                    // Optionally, refresh the list or update the UI
                    location.reload();
                });
            },
            error: function (xhr) {
                console.error("Error response:", xhr.responseJSON);
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: xhr.responseJSON ? xhr.responseJSON.message : 'Something went wrong!',
                    confirmButtonText: 'OK',
                    confirmButtonColor: '#3085d6'
                });
            }
        });
    });
});




// ======================== DATATABLES ============================= //
// MAIN TABLE DATATABLES
document.addEventListener("DOMContentLoaded", function () {
    // Check if the table exists and simple-datatables is loaded
    if (document.getElementById("EventApproveReqTable") && typeof simpleDatatables !== 'undefined') {
        const dataTable = new simpleDatatables.DataTable("#EventApproveReqTable", {
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

        document.getElementById("eventApprReqSearch").addEventListener("keyup", function() {
            let searchTerm = this.value;
            dataTable.search(searchTerm);
        });
    }
});
// ======================== END OF DATATABLES ============================= //



// ======================== DATATABLES ============================= //
// SET ITEM TABLE DATATABLES
document.addEventListener("DOMContentLoaded", function () {
    // Check if the table exists and simple-datatables is loaded
    if (document.getElementById("SetItemTable") && typeof simpleDatatables !== 'undefined') {
        const dataTable = new simpleDatatables.DataTable("#SetItemTable", {
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

        // document.getElementById("eventApprReqSearch").addEventListener("keyup", function() {
        //     let searchTerm = this.value;
        //     dataTable.search(searchTerm);
        // });
    }
});
// ======================== END OF DATATABLES ============================= //



// ======================== DATATABLES ============================= //
// SET ITEM TABLE DATATABLES
document.addEventListener("DOMContentLoaded", function () {
    // Check if the table exists and simple-datatables is loaded
    if (document.getElementById("CompletedTable") && typeof simpleDatatables !== 'undefined') {
        const dataTable = new simpleDatatables.DataTable("#CompletedTable", {
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

        // document.getElementById("eventApprReqSearch").addEventListener("keyup", function() {
        //     let searchTerm = this.value;
        //     dataTable.search(searchTerm);
        // });
    }
});
// ======================== END OF DATATABLES ============================= //