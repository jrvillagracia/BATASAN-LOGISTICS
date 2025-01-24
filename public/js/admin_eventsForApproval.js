// ======================== ADD EVENT BUTTON ============================= //
$(document).ready(function () {
    $('#EventFormButton').click(function (event) {
        event.preventDefault();
        console.log('Show Event Form Button Clicked');

        const currentDate = new Date();
        const formattedDate = currentDate.toLocaleDateString('en-US', { month: '2-digit', day: '2-digit', year: 'numeric' });
        const formattedTime = currentDate.toLocaleTimeString('en-US', { hour: '2-digit', minute: '2-digit', hour12: false });

        $('#EventApprDate').val(formattedDate);
        $('#EventApprTime').val(formattedTime);

        $('#EventFormCard').removeClass('hidden');
    });

    $('#EventCancelFormBtn, #EventCloseFormBtn').click(function (event) {
        event.preventDefault();
        $('#EventFormCard').addClass('hidden');
    });

    $("#EventSubmitFormBtn").click(function (event) {
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
            EventsActBldName: $('#EventsActBldName').val(),
            EventsActRoom: $('#EventsActRoom').val(),
            EventsActivityInventory: $('#EventsActivityInventory').val(),
            EventActCategoryName: $('#EventActCategoryName').val(),
            EventActType: $('#EventActType').val(),
            EventActUnit: $('#EventActUnit').val(),
            EventActQuantity: $('#EventActQuantity').val(),
            _token: $('meta[name="csrf-token"]').attr('content'),
        };

        // Check if the table is empty
        const isTableEmpty = $('#yourTableId tbody tr').length === 0;

        $.ajax({
            url: '/events/store',
            method: 'POST',
            data: eventData,
            success: function (response) {
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
            error: function (xhr) {
                console.log(xhr.responseText);
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

    // Go to Step 2
    $('#EventGoToStep2').click(function() {
        const requiredFields = [
            '#EventApprRequestOffice',
            '#EventApprRequestFor',
            '#EventApprName',
            '#StartEventApprDate',
            '#EndEventApprDate',
            '#StartEventApprTime',
            '#EndEventApprTime',
            '#EventsActBldName',
            '#EventsActRoom',
        ];
    
        let isValid = true;
        requiredFields.forEach(field => {
            //Using trim() here is important to handle whitespace-only inputs
            if (!$(field).val()) { 
                isValid = false;
                $(field).addClass('border-red-500');
            } else {
                $(field).removeClass('border-red-500');
            }
        });
    
        if (isValid) {
            $('#EventsActStep1Content').addClass('hidden');
            $('#EventsActStep2Content').removeClass('hidden');
            $('#EventsStep1Icon').addClass('text-gray-500').removeClass('text-blue-600');
            $('#EventsStep2Icon').addClass('text-blue-600').removeClass('text-gray-500');
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Validation Error',
                text: 'Please fill in all required fields in Step 1.',
                confirmButtonText: 'OK',
                confirmButtonColor: '#d33'
            });
        }
    });

    // Go back to Step 1
    $('#EventBackToStep1').click(function () {
        $('#EventsActStep2Content').addClass('hidden');
        $('#EventsActStep1Content').removeClass('hidden');
        $('#EventsStep2Icon').addClass('text-gray-500').removeClass('text-blue-600');
        $('#EventsStep1Icon').addClass('text-blue-600').removeClass('text-gray-500');
    });

    $('#EventAddRowBtn').click(function () {
        const newRow = `
            <tr class="Events-Rows">
                <td class="p-2">
                    <select id="EventsActivityInventory" name="EventsActivityInventory" class="w-full px-2 py-1 border border-gray-400 rounded">
                        <option value="EventsActivityInventory" disabled selected>Select Inventory</option>
                        <option value="Inventory" data-building="">Equipment</option>
                        <option value="Supplies" data-building="">Supplies</option>
                    </select>
                </td>
                <td class="p-2">
                    <select id="EventActCategoryName" name="EventActCategoryName" class="w-full px-2 py-1 border border-gray-400 rounded">
                        <option value="EventActCategoryName" disabled selected>Select Category</option>
                        <option value="Laptop" data-building="">Laptop</option>
                        <option value="Printer" data-building="">Printer</option>
                    </select>
                </td>
                <td class="p-2">
                    <select id="EventActType" name="EventActType" class="w-full px-2 py-1 border border-gray-400 rounded">
                        <option value="EventActType" disabled selected>Select Type</option>
                        <option value="64gb" data-building="">64gb</option>
                        <option value="Nikon" data-building="">Nikon</option>
                    </select>
                </td>
                <td class="p-2">
                    <select id="EventActUnit" name="EventActUnit" class="w-full px-2 py-1 border border-gray-400 rounded">
                        <option value="EventActUnit" disabled selected>Select Unit</option>
                        <option value="Box" data-building="">Box</option>
                        <option value="Unit" data-building="">Unit</option>
                    </select>
                </td>
                <td class="p-2">
                    <input type="number" id="EventActQuantity" class="w-20 border rounded p-2" placeholder="">
                </td>

                <td class="p-2 text-center">
                    <button type="button" class="EventActivitiesDelete-row-btn text-red-500 hover:text-red-700">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </td>
            </tr>`;
        $('#Events-TablBody').append(newRow);
    });

    // Delete an inventory row from the table
    $('#Events-TablBody').on('click', '.EventActivitiesDelete-row-btn', function () {
        $(this).closest('tr').remove();
    });
});




// ======================== END FOR ADD EVENT BUTTON ============================= //




// ======================== START FOR APPROVAL MODULE ============================= //
// VIEW BUTTON CARD FORM      
// THIS IS VIEW BUTTON IS APPLICABLE TO FOR APPROVAL, APPROVE REQUEST, COMPLETED REQUEST
$(document).ready(function () {
    $(document).on('click', '.EventViewBTN', function (event) {
        event.preventDefault();
        console.log('View Event Button Clicked');
        let eventId = $(this).data('id');
        console.log("Event ID:", eventId); // Debugging line

        if (eventId) {
            $.ajax({
                url: '/apr/event/details',
                type: 'GET',
                data: { id: eventId },
                success: function (response) {
                    if (response.eventDetails) {
                        $('#getEventsDetails').html(`
                            <p><strong>Date:</strong> ${response.eventDetails.EventApprDate}</p>
                            <p><strong>Time:</strong> ${response.eventDetails.EventApprTime}</p>
                            <p><strong>Requesting Office/Unit:</strong> ${response.eventDetails.EventApprRequestOffice}</p>
                            <p><strong>Event Name:</strong> ${response.eventDetails.EventApprName}</p>
                            <p><strong>Event Date:</strong> ${response.eventDetails.StartEventApprDate}</p>
                            <p><strong>Event Time:</strong> ${response.eventDetails.StartEventApprTime}</p>
                            <p><strong>Event Location:</strong> ${response.eventDetails.EventsActBldName}- ${response.eventDetails.EventsActRoom}</p>

                            <br><hr>
                        `);
                        $('#ViewEventApprPopupCard').removeClass('hidden');
                    } else {
                        alert('Event details could not be loaded.');
                    }
                },
                error: function (xhr) {
                    console.error("AJAX Error:", xhr.responseJSON); // Detailed error info
                    alert('Error loading event details: ' + xhr.responseText);
                }
            });
        }
    });

    $('#closeViewEventPopupCard').click(function () {
        $('#ViewEventApprPopupCard').addClass('hidden');
    });
});


// ======================== SET ITEM BUTTON ============================= //
$(document).ready(function () {
    // Event Set Item Button - Show Event Details and Table
    $(document).on('click', '.EventForApprvlSetItemBTN', function (event) {
        event.preventDefault();
        console.log('Set Item Button is Clicked.');

        // Get the event ID from the clicked button
        let eventId = $(this).data('id');
        console.log('Event ID:', eventId);

        if (eventId) {
            $.ajax({
                url: '/events_Apr_details',  // Updated URL
                type: 'GET',
                data: { id: eventId },
                success: function (response) {
                    if (response.eventDetails) {
                        // Show the modal
                        $('#SetItemEventForApprReqPopupCard').removeClass('hidden');

                        // Assuming the event details contain the table data in HTML format
                        $('#eventDetailsContainer').html(response.eventDetails);

                        // Ensure the table inside the modal is displayed
                        $('#eventDetailsTable').removeClass('hidden'); // Make sure the table is visible
                    } else {
                        alert('Event details could not be loaded.');
                    }
                },
                error: function (xhr) {
                    alert('Error loading event details: ' + xhr.responseText);
                }
            });
        }
    });

    // Close the popup modal when clicking the close button
    $(document).on('click', '.closeSetItemEventApprReqPopupCard', function (event) {
        event.preventDefault();
        console.log('Close View Button is Clicked.');
        $('#SetItemEventForApprReqPopupCard').addClass('hidden');
    });

    // Close the modal when clicking outside the popup area
    $(window).on('click', function (e) {
        if ($(e.target).is('#SetItemEventForApprReqPopupCard')) {
            $('#SetItemEventApprReqPopupCard').addClass('hidden');
        }
    });

    // Close the popup explicitly when clicking on the close button inside
    $(document).on('click', '#closeSetItemEventApprReqPopupCard', function () {
        $('#SetItemEventForApprReqPopupCard').addClass('hidden');
    });

    // Submit Set Item Event
    $(document).on('click', '#submitSetItemEventApprReqPopupCard', function () {
        event.preventDefault();
        Swal.fire({
            icon: 'success',
            title: 'Submitted',
            text: 'Item Set successfully submitted',
            confirmButtonText: 'OK',
            confirmButtonColor: '#3085d6'
        }).then(() => {
            $("#SetItemEventForApprReqPopupCard").addClass("hidden");
        });
    });
});



// ======================== SET ITEM BUTTON ============================= //
$(document).ready(function () {
    $('#EventForApprvlSetItemBTN').click(function (event) {
        event.preventDefault();
        $('#SetItemEventForApprReqPopupCard').removeClass('hidden');
    });

    $('#closeSetItemEventForApprReqPopupCard').click(function (event) {
        event.preventDefault();
        $('#SetItemEventForApprReqPopupCard').addClass('hidden');
    });


    $("#submitSetItemEventForApprReqPopupCard").click(function () {
        Swal.fire({
            icon: 'success',
            title: 'Submitted',
            text: 'Item Set successfully submitted',
            confirmButtonText: 'OK',
            confirmButtonColor: '#3085d6'
        }).then(() => {
            $("#SetItemEventForApprReqPopupCard").addClass("hidden");
        });
    });
});




// APPROVE BUTTON CARD FORM
// APPROVE BUTTON CARD FORM
$(document).ready(function() {
    // Event Approve Button - Show Approval Modal
    $(document).on('click', '.EventApproveBTN', function() {
        console.log('Approve Button Clicked - Showing Approval Modal');
        $(".ApprEventPopupCard").removeClass("hidden");
    });

    // Cancel Approval Modal
    $(".closeApprEventPopupCard").click(function(event) {
        event.preventDefault();
        $(".ApprEventPopupCard").addClass("hidden");
    });

    // Submit Approval
    $(".submitApprEventPopupCard").click(function() {
        var eventId = $(this).data('id');

        // Show the loader
        $('body').append(`
            <div id="save-loader" class="fixed inset-0 bg-gray-800 bg-opacity-50 flex flex-col items-center justify-center z-50">
                <section class="dots-container">
                    <div class="dot"></div>
                    <div class="dot"></div>
                    <div class="dot"></div>
                    <div class="dot"></div>
                    <div class="dot"></div>
                </section>
                <div class="dot-loader-dialog">
                    <p>Approving event, please wait...</p>
                </div>
            </div>
        `);

        $.ajax({
            url: '/events/approve',
            method: 'POST',
            data: {
                id: eventId,
                _token: $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                // Remove the loader after successful AJAX call
                $('#save-loader').remove();
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
                // Remove the loader even if there's an error
                $('#save-loader').remove();
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
(document).ready(function() {
    // Show the Decline Event Popup Card
    $(document).on("click", ".EventDeclineBTN", function() {
        var eventId = $(this).data('id');
        console.log("Decline button clicked for Event ID:", eventId);
        $("#DeclineEventPopupCard").data("eventId", eventId).removeClass("hidden");
    });

    // Cancel button logic
    $("#closeDeclineEventPopupCard").click(function(event) {
        event.preventDefault();
        $("#DeclineEventPopupCard").addClass("hidden");
        $("#decline-loader").remove(); //remove loader if cancel
    });

    // Submit button logic
    $(document).on("click", ".submitDeclineEventPopupCard", function() {
        var eventId = $("#DeclineEventPopupCard").data("eventId");

        // Show the loader
        $("#DeclineEventPopupCard").append(`
            <div id="decline-loader" class="fixed inset-0 bg-gray-800 bg-opacity-50 flex flex-col items-center justify-center z-50">
                <section class="dots-container">
                    <div class="dot"></div>
                    <div class="dot"></div>
                    <div class="dot"></div>
                    <div class="dot"></div>
                    <div class="dot"></div>
                </section>
                <div class="dot-loader-dialog">
                    <p>Declining event, please wait...</p>
                </div>
            </div>
        `);


        $.ajax({
            url: '/events/decline',
            method: 'POST',
            data: {
                id: eventId,
                _token: $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                $("#decline-loader").remove(); //remove loader after success
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
                $("#decline-loader").remove(); //remove loader after error
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

        document.getElementById("eventSearch").addEventListener("keyup", function () {
            let searchTerm = this.value;
            dataTable.search(searchTerm);
        });
    }
});


//Get Buildings and Room
$(document).ready(function () {
    // Fetch buildings and rooms via AJAX
    $.ajax({
        url: '/buildings-rooms',
        method: 'GET',
        success: function (data) {
            // Populate Building dropdown
            const buildingDropdown = $("#EventsActBldName");
            buildingDropdown.empty().append('<option disabled selected>Select Building</option>');

            const roomsByBuilding = {};

            data.forEach(function (room) {
                if (!roomsByBuilding[room.BldName]) {
                    roomsByBuilding[room.BldName] = [];
                    buildingDropdown.append(`<option value="${room.BldName}">${room.BldName}</option>`);
                }
                roomsByBuilding[room.BldName].push(room.Room);
            });

            // Filter Room dropdown based on selected building
            $("#EventsActBldName").change(function () {
                const selectedBuilding = $(this).val();
                const roomDropdown = $("#EventsActRoom");
                roomDropdown.empty().append('<option disabled selected>Select Room</option>');

                if (roomsByBuilding[selectedBuilding]) {
                    roomsByBuilding[selectedBuilding].forEach(function (room) {
                        roomDropdown.append(`<option value="${room}">Room ${room}</option>`);
                    });
                }
            });
        },
        error: function () {
            alert('Failed to fetch data!');
        }
    });
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


// Get the Department
$(document).ready(function () {
    // Make an AJAX request to the API
    $.ajax({
        url: 'https://bnhs-hr.onrender.com/api/all/departments',  // Adjust the URL to match your API endpoint
        method: 'GET',
        headers: {
            'x-api-key': 'Ru8NWgJalpjcZ1T53i10Z5Jp4xdQoKdU90dq8zLHC1ZrGMxwbl4XToKg0sb7JCv9',
        },
        success: function (data) {
            const departmentDropdown = $("#EventApprRequestOffice");
            departmentDropdown.empty().append('<option value="" disabled selected>Select Office/Unit</option>');

            // Loop through the API data and append each department as an option
            data.forEach(function(department) {
                departmentDropdown.append(`<option value="${department.name}">${department.name}</option>`);
            });
        },
        error: function (error) {
            console.error("Error fetching departments:", error);
            alert('Failed to load departments. Please try again later.');
        }
    });
});

// Get the Equipments and Supplies
$(document).ready(function () {
    // Fetch supplies and equipment via AJAX
    $.ajax({
        url: '/get/supplies/equipment',
        method: 'GET',
        success: function (data) {
            // Cache the data for later use
            const suppliesAndEquipmentData = data;

            // When inventory type changes
            $("#EventsActivityInventory").change(function () {
                const inventoryType = $(this).val();

                // Reset and disable subsequent dropdowns
                const categoryDropdown = $("#EventActCategoryName");
                categoryDropdown.empty().append('<option disabled selected>Select Category</option>').prop('disabled', true);

                const typeDropdown = $("#EventActType");
                typeDropdown.empty().append('<option disabled selected>Select Type</option>').prop('disabled', true);

                const unitDropdown = $("#EventActUnit");
                unitDropdown.empty().append('<option disabled selected>Select Unit</option>').prop('disabled', true);

                // Populate categories based on the selected inventory type
                if (inventoryType === 'Equipment') {
                    populateCategories(suppliesAndEquipmentData.equipment);
                } else if (inventoryType === 'Supplies') {
                    populateCategories(suppliesAndEquipmentData.supplies);
                }
            });

            // Function to populate categories
            function populateCategories(items) {
                const categoryDropdown = $("#EventActCategoryName");
                categoryDropdown.prop('disabled', false);

                // Get unique categories from the items
                const categories = [...new Set(items.map(item => item.EquipmentCategory || item.SuppliesCategory))];

                // Populate the category dropdown
                categories.forEach(function (category) {
                    categoryDropdown.append(`<option value="${category}">${category}</option>`);
                });

                // Handle category selection change
                categoryDropdown.change(function () {
                    const selectedCategory = $(this).val();

                    // Reset and disable type and unit dropdowns
                    const typeDropdown = $("#EventActType");
                    typeDropdown.empty().append('<option disabled selected>Select Type</option>').prop('disabled', true);

                    const unitDropdown = $("#EventActUnit");
                    unitDropdown.empty().append('<option disabled selected>Select Unit</option>').prop('disabled', true);

                    if (selectedCategory) {
                        populateTypes(items, selectedCategory);
                    }
                });
            }

            // Function to populate types
            function populateTypes(items, selectedCategory) {
                const typeDropdown = $("#EventActType");
                typeDropdown.prop('disabled', false);

                // Filter types based on the selected category
                const types = [...new Set(items.filter(item => 
                    (item.EquipmentCategory || item.SuppliesCategory) === selectedCategory
                ).map(item => item.EquipmentType || item.SuppliesType))];

                // Populate the type dropdown
                types.forEach(function (type) {
                    typeDropdown.append(`<option value="${type}">${type}</option>`);
                });

                // Handle type selection change
                typeDropdown.change(function () {
                    const selectedType = $(this).val();

                    // Reset and disable unit dropdown
                    const unitDropdown = $("#EventActUnit");
                    unitDropdown.empty().append('<option disabled selected>Select Unit</option>').prop('disabled', true);

                    if (selectedType) {
                        populateUnits(items, selectedCategory, selectedType);
                    }
                });
            }

            // Function to populate units
            function populateUnits(items, selectedCategory, selectedType) {
                const unitDropdown = $("#EventActUnit");
                unitDropdown.prop('disabled', false);

                // Filter units based on the selected category and type
                const units = [...new Set(items.filter(item => 
                    (item.EquipmentCategory || item.SuppliesCategory) === selectedCategory && 
                    (item.EquipmentType || item.SuppliesType) === selectedType
                ).map(item => item.EquipmentUnit || item.SuppliesUnit))];

                // Populate the unit dropdown
                units.forEach(function (unit) {
                    unitDropdown.append(`<option value="${unit}">${unit}</option>`);
                });
            }
        },
        error: function (xhr) {
            console.log(xhr.responseText);
            alert('Failed to fetch data!');
        }
    });
});






