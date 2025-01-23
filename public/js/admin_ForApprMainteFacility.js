// FUNCTION TO DISABLE THE PAST DATES/MONTHS
document.addEventListener("DOMContentLoaded", function () {
    // Get the current date
    const currentDate = new Date();

    // Format the date as M-D-Y
    const formatDate = (date) => {
        const dd = String(date.getDate()).padStart(2, '0');
        const mm = String(date.getMonth() + 1).padStart(2, '0'); // Months are zero-based
        const yyyy = date.getFullYear();
        return `${mm}-${dd}-${yyyy}`;
    };

    // Calculate max date (e.g., one year from today)
    const maxDate = new Date();
    maxDate.setFullYear(maxDate.getFullYear() + 1);

    // Initialize the input field with min and max dates
    const datepickerInput = document.getElementById("MainteFacilityDate");
    datepickerInput.setAttribute("datepicker-min-date", formatDate(currentDate));
    datepickerInput.setAttribute("datepicker-max-date", formatDate(maxDate));

    // Initialize the datepicker (assuming a library like Flowbite/Flatpickr is being used)
    datepickerInput.datepicker = new Datepicker(datepickerInput, {
        minDate: currentDate,
        maxDate: maxDate,
        autoselectToday: true,
    });
});



// ======================= ADD REQUEST ========================== //
$(document).ready(function () {

    // When the "Add Request" button is clicked
    $('#MainteFacilityREQFormButton').click(function (event) {
        event.preventDefault(); // Prevent form submission
        console.log('Add Request Button is Clicked.');

        // Show the form by removing the hidden class
        $('#MainteFacilityFormBtn').removeClass('hidden');

        // Get the current date and time
        const currentDate = new Date();
        const formattedDate = currentDate.toISOString().split('T')[0];
        const formattedTime = currentDate.toLocaleTimeString('en-US', {
            hour: '2-digit',
            minute: '2-digit',
            hour12: false
        });

        // Set the date and time inputs with the current date and time
        $('#MainteFacilityDate').val(formattedDate).attr('required', true);
        $('#MainteFacilityTime').val(formattedTime).attr('required', true);
    });

    // When the "Close" button is clicked
    $('#CloseMainteFacilityForm').click(function (event) {
        event.preventDefault();
        console.log('Close Button is Clicked.');
        $('#MainteFacilityFormBtn').addClass('hidden'); // Hide the form
    });

    // Validation function
    function validateForm() {
        let isValid = true;
        const requiredFields = [
            '#FacilityBuildingName',
            '#FacilityRoom',
            '#FacilityType',
            '#MainteFacilityReqUnit',
            '#MainteFacilityReqFOR',
            '#MainteFacilityTime',
            '#MainteFacilityDate'
        ];

        requiredFields.forEach(function (selector) {
            const field = $(selector);
            if (field.val() === '') {
                field.addClass('border-red-500'); // Highlight missing fields
                isValid = false;
            } else {
                field.removeClass('border-red-500'); // Remove highlight if valid
            }
        });

        if (!isValid) {
            Swal.fire({
                icon: 'warning',
                title: 'Incomplete Form',
                text: 'Please fill out all required fields before submitting.',
                confirmButtonText: 'OK',
                confirmButtonColor: '#d33'
            });
        }

        return isValid;
    }

    // When the "Submit" button is clicked
    $("#SubmitMainteFacilityForm").click(function (event) {
        event.preventDefault(); // Prevent the default button behavior

        // Validate the form before proceeding
        if (!validateForm()) {
            return; // Stop if validation fails
        }

        // Show the save loader
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
                    <p>Saving, please wait...</p>
                </div>
            </div>
        `);

        // Collect the form data
        const formData = {
            FacilityBuildingName: $('#FacilityBuildingName').val(),
            FacilityRoom: $('#FacilityRoom').val(),
            FacilityType: $('#FacilityType').val(),
            MainteFacilityReqUnit: $('#MainteFacilityReqUnit').val(),
            MainteFacilityReqFOR: $('#MainteFacilityReqFOR').val(),
            MainteFacilityTime: $('#MainteFacilityTime').val(),
            MainteFacilityDate: $('#MainteFacilityDate').val(),
            _token: $('meta[name="csrf-token"]').attr('content') // CSRF token for Laravel
        };

        // Send the form data via AJAX
        $.ajax({
            url: '/admin/mainteFacility/store',
            method: 'POST',
            data: formData,
            success: function (response) {
                console.log('Form submission successful:', response);

                // Simulate a loading delay before showing SweetAlert
                setTimeout(() => {
                    // Remove the save loader
                    $('#save-loader').remove();

                    // Show the SweetAlert success message
                    Swal.fire({
                        icon: 'success',
                        title: 'Submitted',
                        text: 'Request Successfully submitted',
                        confirmButtonText: 'OK',
                        confirmButtonColor: '#3085d6'
                    }).then(() => {
                        // Hide the form after successful submission
                        $("#MainteFacilityFormBtn").addClass("hidden");
                        // Optionally reset the form fields
                        $('#MainteFacilityREQForm')[0].reset();
                    });
                    location.reload();
                }, 1000); // Simulate loader for 1 second
            },
            error: function (xhr, status, error) {
                console.log(xhr.responseText);

                // Remove the save loader in case of error
                $('#save-loader').remove();

                // Show an error alert
                Swal.fire({
                    icon: 'error',
                    title: 'Submission Failed',
                    text: 'There was an error processing your request. Please try again.',
                    confirmButtonText: 'OK',
                    confirmButtonColor: '#d33'
                });
            }
        });
    });
});





// VIEW BUTTON CARD FORM  
$(document).ready(function () {
    // Open the modal when clicking the "View" button
    $('.MaintenanceFacilityViewBTN').click(function () {
        const mainteFacilityIndex = $(this).data('index');
        console.log('View Equipment Button is Clicked.');

        $(`#ViewMainteFacilityPopupCard--${mainteFacilityIndex}`).removeClass('hidden');
    });

    // Close the modal when clicking the "Cancel" button
    $('.cancelForApprMainteFacilityPopupCard').click(function () {
        const mainteFacilityIndex = $(this).data('index');
        console.log('Cancel View Equipment Button is Clicked.');

        $(`#ViewMainteFacilityPopupCard--${mainteFacilityIndex}`).addClass('hidden');
    });
});




// APPROVE BUTTON CARD FORM
$(document).ready(function () {
    $(".MaintenanceFacilityApproveBTN").click(function () {
        // Get the facility id from the data-id attribute of the clicked row
        var mainteFacilityId = $(this).closest('tr').data('id');
        $("#submitApprMainteFacilityPopupCard").data('mainteFacilityId', mainteFacilityId);
        $("#ApprMainteFacilityPopupCard").removeClass("hidden");
    });

    // Hide the popup and show Cancel message when Cancel button is clicked
    $("#closeApprMainteFacilityPopupCard").click(function (event) {
        event.preventDefault();
        $("#ApprMainteFacilityPopupCard").addClass("hidden");
    });

    // Hide the popup and show Submitted message when Submit button is clicked
    $("#submitApprMainteFacilityPopupCard").click(function (event) {
        event.preventDefault();
        
        var mainteFacilityId = $(this).data('mainteFacilityId');
        
        $.ajax({
            url: '/mainteFacility/approve',
            method: 'POST',
            data: {
                mainteFacilityId: mainteFacilityId,
                _token: $('meta[name="csrf-token"]').attr('content')
            },
            success: function (response) {
                Swal.fire({
                    icon: 'success',
                    title: 'Submitted',
                    text: 'Your action has been successfully submitted',
                    confirmButtonText: 'OK',
                    confirmButtonColor: '#3085d6'
                }).then(() => {
                    $("#ApprMainteFacilityPopupCard").addClass("hidden");
                });
            },
            error: function (xhr, status, error) {
                console.log(xhr.responseText);
                Swal.fire({
                    icon: 'error',
                    title: 'Submission Failed',
                    text: 'There was an error processing your request. Please try again.',
                    confirmButtonText: 'OK',
                    confirmButtonColor: '#d33'
                });
            }
        });
    });
});



// DECLINE BUTTON CARD FORM
$(document).ready(function () {
    // Show the popup when the "Decline" button is clicked
    $(".MaintenanceFacilityDeclineBTN").click(function () {
        var mainteFacilityId = $(this).data('id'); // Get the facility ID from the data attribute
        console.log('Decline Button Clicked for Facility ID:', mainteFacilityId);

        // Set the facility ID in the hidden input field
        $("#DclnMainteFacilityPopupCard").data("mainteFacilityId", mainteFacilityId);

        // Show the decline popup
        $("#DclnMainteFacilityPopupCard").removeClass("hidden");
    });

    // Hide the popup and show Cancel message when the "Cancel" button is clicked
    $("#closeDclnMainteFacilityPopupCard").click(function (event) {
        event.preventDefault();
        $("#DclnMainteFacilityPopupCard").addClass("hidden");
    });

    // Handle the decline form submission
    $(".submitDclnMainteFacilityPopupCard").click(function (event) {
        event.preventDefault();

        var mainteFacilityId = $("#DclnMainteFacilityPopupCard").data("mainteFacilityId");

        $.ajax({
            url: '/admin/mainteFacility/decline',
            method: 'POST',
            headers: {
                'Accept': 'application/json',
            },
            data: {
                mainteFacilityId: mainteFacilityId,
                _token: $('meta[name="csrf-token"]').attr('content')
            },
            success: function (response) {
                Swal.fire({
                    icon: 'success',
                    title: 'Submitted',
                    text: response.message, // Server response message
                    confirmButtonText: 'OK',
                    confirmButtonColor: '#3085d6'
                }).then(() => {
                    $("#DclnMainteFacilityPopupCard").addClass("hidden");

                    // Remove the declined facility row from the table
                    $('tr[data-id="'+ mainteFacilityId+'"]').remove();

                    // Log the mainteFacilityId to the console
                    console.log('Facility ID passed to the other table:', mainteFacilityId);
                });
            },
            error: function (xhr, status, error) {
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

        // document.getElementById("MainteFacilitytSearch").addEventListener("keyup", function() {
        //     let searchTerm = this.value;
        //     dataTable.search(searchTerm);
        // });
    }
});


//Get the Building and Room
$(document).ready(function () {
    // Fetch buildings and rooms via AJAX
    $.ajax({
        url: '/buildings-rooms',
        method: 'GET',
        success: function (data) {
            // Initialize the dropdown for building selection
            const buildingDropdown = $("#FacilityBuildingName");
            buildingDropdown.empty().append('<option disabled selected>Select Building</option>');
            
            const roomsByBuilding = {};

            // Populate the building dropdown and group rooms by building
            data.forEach(function (room) {
                if (!roomsByBuilding[room.BldName]) {
                    roomsByBuilding[room.BldName] = [];
                    buildingDropdown.append(`<option value="${room.BldName}">${room.BldName}</option>`);
                }
                roomsByBuilding[room.BldName].push(room.Room);
            });

            // When a building is selected, populate the rooms based on the selected building
            $("#FacilityBuildingName").change(function () {
                const selectedBuilding = $(this).val();
                const roomDropdown = $("#FacilityRoom");
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




// Export to PDF
$(document).ready(function () {
    $('#printForApprMainteFacilityPopupCard').on('click', function (event) {
        // Prevent default button behavior
        event.preventDefault();

        const element = document.getElementById('view-maintFacility-pdf-content');

        // Add an additional HTML element dynamically (e.g., a footer)
        const additionalElement = $('<div id="dynamic-footer" class="text-center mt-4 text-sm text-gray-500">')
            .text('Generated by Logistics Management System © 2025');
        $(element).append(additionalElement);

        // Temporarily hide the buttons
        $('.view-MainteFaci-print-btn').addClass('hidden');
        $('.view-MainteFaci-cancel-btn').addClass('hidden');

        const options = {
            margin: 0.5,
            filename: 'Maintenance Facility Request Slip.pdf',
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
                $('.view-MainteFaci-print-btn').removeClass('hidden');
                $('.view-MainteFaci-cancel-btn').removeClass('hidden');
            });
    });
});


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
            const departmentDropdown = $("#MainteFacilityReqUnit");
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


