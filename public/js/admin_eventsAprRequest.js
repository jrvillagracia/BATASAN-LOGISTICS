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
                            <br><hr><br>
                            <p class="mb-2"><strong>Required Equipment and Supplies</strong></p>
                            <p><strong>Product Name:</strong> ${response.eventDetails.EventApprProductName}</p>
                            <p><strong>Quantity:</strong> ${response.eventDetails.EventApprQuantity}</p>
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




// ======================== SET ITEM BUTTON ============================= //
$(document).ready(function () {
    $('.EventApprReqSetItemBTN').click(function () {
        console.log('View Event Button is Clicked.');
        $('#SetItemEventApprReqPopupCard').removeClass('hidden');
    });

    $('.closeSetItemEventApprReqPopupCard').click(function (event) {
        event.preventDefault();  // Prevent form submission or link navigation
        console.log('Close View Button is Clicked.');
        $('.SetItemEventApprReqPopupCard').addClass('hidden');
    });


    // Close the popup
    $('#closeSetItemEventApprReqPopupCard').click(function () {
        $('#SetItemEventApprReqPopupCard').addClass('hidden');
    });

    $(document).ready(function() {
        $("#submitSetItemEventApprReqPopupCard").click(function () {
            event.preventDefault();
            Swal.fire({
                icon: 'success',
                title: 'Submitted',
                text: 'Item Set successfully submitted',
                confirmButtonText: 'OK',
                confirmButtonColor: '#3085d6'
            }).then(() => {
                $("#SetItemEventApprReqPopupCard").addClass("hidden");
            });
        });
    });
});


// ======================== COMPLETED BUTTON ============================= //
$(document).ready(function () {
    $('#EventApprReqCompletedBTN').click(function () {
        console.log('Completed Event Button is Clicked.');
        $('#CompletedEventApprReqPopupCard').removeClass('hidden');

        // Get the eventId (you might need to modify this based on where the ID is stored)
        let eventId = 1; // Replace this with the actual event ID

        // AJAX call to fetch the merged items data
        $.ajax({
            url: `/events/${eventId}/merged-items`,
            method: 'GET',
            success: function (response) {
                if (response.error) {
                    console.error(response.error);
                    return;
                }

                let items = response.mergedItems;
                let tableBody = $('#tableViewBody');
                tableBody.empty(); // Clear existing rows

                // Loop through the items and append rows
                items.forEach(item => {
                    let row = `
                        <tr class="odd:bg-blue-100 odd:dark:bg-gray-900 even:bg-white even:dark:bg-gray-800 border-b dark:border-gray-700" data-id="${item.SKU}">
                            <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">${item.ProductName}</td>
                            <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">${item.BrandName}</td>
                            <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">${item.Type}</td>
                            <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">${item.Quantity}</td>
                            <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">${item.SKU}</td>
                            <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                <button id="addEquipBTN" type="button">
                                    <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#5f6368">
                                        <path d="M440-440H200v-80h240v-240h80v240h240v80H520v240h-80v-240Z" />
                                    </svg>
                                </button>
                            </td>
                        </tr>
                    `;
                    tableBody.append(row);
                });
            },
            error: function (xhr, status, error) {
                console.error('Error fetching event details:', error);
            }
        });
    });

    $('#closeCompletedEventApprReqPopupCard').click(function (event) {
        event.preventDefault();
        console.log('Close Completed Button is Clicked.');
        $('#CompletedEventApprReqPopupCard').addClass('hidden');
    });

    $('#submitCompletedEventApprReqPopupCard').click(function (event) {
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
    // Show the popup when the button is clicked
    $("#EventApprReqCancelBTN").click(function () {
        $("#CancelEventPopupCard").removeClass("hidden");
    });

    // Hide the popup and show Cancel message when Cancel button is clicked
    $("#closeCancelEventPopupCard").click(function () {
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

    // Hide the popup and show Submitted message when Submit button is clicked
    $("#submitCancelEventPopupCard").click(function () {
        event.preventDefault();
        Swal.fire({
            icon: 'success',
            title: 'Submitted',
            text: 'This request has been cancelled',
            confirmButtonText: 'OK',
            confirmButtonColor: '#3085d6'
        }).then(() => {
            $("#CancelEventPopupCard").addClass("hidden");
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