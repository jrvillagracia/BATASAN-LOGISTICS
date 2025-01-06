// ======================== ADD A FACILITY BUTTON FORM ============================= //
$(document).ready(function () {
    $('#SpecRoomFormBtn').click(function () {
        console.log('Show Add Facility Button Clicked');
        $('#SpecFormCard').removeClass('hidden');
    });
});

$(document).ready(function () {
    $('#SpecCloseFormBtn').click(function () {
        console.log('Close Add Facility Button Clicked');
        $('#SpecFormCard').addClass('hidden');
    });
});

$(document).ready(function () {
    $('#SpecCancelFormBtn').click(function () {
        console.log('Close Add Facility Button Clicked');
        $('#SpecFormCard').addClass('hidden');
    });
});


// ADD FACILITY SPECIAL 
$(document).ready(function () {
    $('#SpecSubFormBtn').click(function (event) {
        event.preventDefault(); // Prevent default form submission

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        // Gather form data
        const buildingName = $('#SpecBldName').val();
        const room = $('#SpecRoom').val();
        const capacity = $('#SpecCapacity').val();
        const facilityRoomDate = $('#SpecRoomDate').val(); 
        const schoolYear =$('#SuppReqSchoolYear').val();

        // Check if all values are entered
        if (buildingName === '' || room === '' || capacity === '' || facilityRoomDate === ''|| schoolYear ==='') {
            Swal.fire({
                icon: "error",
                title: "Oops...",
                text: "Please fill all fields!",
                showConfirmButton: true
            });
            return;
        }

        let facilityRoomType = '';
        if (window.location.pathname.includes('admin_facilityRegRoom')) {
            facilityRoomType = 'Instructional';
        } else if (window.location.pathname.includes('admin_facilitySpecRoom')) {
            facilityRoomType = 'Laboratory';
        } else if (window.location.pathname.includes('admin_facilityOfficeRoom')) {
            facilityRoomType = 'Office';
        }

        // Prepare data for AJAX request
        const formData = {
            _token: $('meta[name="csrf-token"]').attr('content'), // Laravel CSRF token
            buildingName: buildingName,
            room: room,
            capacity: capacity,
            facilityRoomDate: facilityRoomDate,
            facilityRoomType: facilityRoomType,
            schoolYear:schoolYear,
        };

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


        // Confirmation message
        setTimeout(() =>{
            Swal.fire({
                title: 'Are you sure?',
                text: 'Do you want to submit this form?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, submit it!',
                cancelButtonText: 'No, cancel!',
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
            }).then((result) => {
                if (result.isConfirmed) {
                    // AJAX request
                    $.ajax({
                        url: '/rooms/lab/store', // The correct way to include the Blade route
                        type: 'POST',
                        data: formData,
                        success: function (response) {
                            $('#SpecForm')[0].reset();
                            $('#SpecFormCard').addClass('hidden');
    
                            let status = (response.currentRoomCount >= capacity) ? 'Unavailable' : 'Available';
    
                            // Optionally, you can append the new data to the table or update the UI
                            const newRow = `<tr class="cursor-pointer table-row" data-index="${response.id}" data-id="${response.id}">
                                               <td class="px-6 py-6 border-b border-gray-300">${response.buildingName}</td>
                                               <td class="px-6 py-6 border-b border-gray-300">${response.room}</td>
                                               <td class="px-6 py-6 border-b border-gray-300">${response.capacity}</td>
                                               <td class="px-6 py-6 border-b border-gray-300"></td>
                                               <td class="px-6 py-6 border-b border-gray-300"></td>
                                           </tr>`;
                            $('#tableBody').append(newRow);
    
                            Swal.fire({
                                icon: 'success',
                                title: 'Saved!',
                                text: 'Your action has been successfully submitted',
                                confirmButtonText: 'OK',
                                confirmButtonColor: '#3085d6'
                            }).then(() => {
                                location.reload();
                            });
                        },
                        error: function (xhr, status, error) {
                            console.log(xhr.responseText);
                            // Handle error response
                            Swal.fire({
                                icon: "error",
                                title: "Oops...",
                                text: "Something went wrong!",
                                showConfirmButton: true
                            });
                        }
                    });
                }
            });
        }, 1000);
    });
});



// SELECT ALL BUTTOn
$(document).ready(function() {
    let isAllChecked = false;

    $('#SpecRoomSelectAllBtn').click(function() {
        isAllChecked = !isAllChecked;
        $('#SpecFacTable').find('input[type="checkbox"]').prop('checked', isAllChecked);

        if (isAllChecked) {
            $(this).text('Unselect All');
        } else {
            $(this).text('Select All');
        }
    });
});



// VIEW 
$(document).ready(function () {
    $('.viewLABButton').click(function () {
        const roomId = $(this).data('id'); 
        const roomIndex = $(this).data('index');
        console.log(`View Laboratory Button Clicked: Room ID = ${roomId}, Index = ${roomIndex}`);
        
        $(`#ViewLABPopupCard-${roomIndex}`).removeClass('hidden');
    });

    $('.closeViewLABPopupCard').click(function () {
        const roomIndex = $(this).data('id');
        console.log(`Close "X" Button Clicked: Index = ${roomIndex}`);
        
        $(`#ViewLABPopupCard-${roomIndex}`).addClass('hidden');
    });
});



// EDIT
$(document).ready(function () {
    var csrfToken = $('meta[name="csrf-token"]').attr('content') || $('#csrf-token').data('token');
    console.log('CSRF Token:', csrfToken);

    $.ajaxSetup({
        headers: {
            'X-CSRF-Token': csrfToken
        }
    });

    // Event delegation for the edit button click
    $(document).on('click', '.editLABButton', function (event) {
        event.preventDefault();
        console.log('Edit Room Button Clicked');

        // Get room ID from the clicked button's data-id attribute
        var roomId = $(this).data('id');
        var row = $(this).closest('tr'); // Closest row containing the button
        console.log('Editing Room with ID:', roomId);

        // Show the edit modal
        $('#SpecEditFormCard').removeClass('hidden');

        // Populate the form with data from the selected row
        $('#SpecEditForm').find('#SpecEditBldName').val(row.find('td').eq(0).text().trim());
        $('#SpecEditForm').find('#SpecEditRoom').val(row.find('td').eq(1).text().trim());
        $('#SpecEditForm').find('#SpecEditCapacity').val(row.find('td').eq(2).text().trim()); // Adjusted index for capacity

        // Set the hidden input field with the room ID
        $('#SpecEditRoomId').val(roomId);
    });

    // Handle the save button click
    $('.SpecEditSaveFormBtn').on('click', function (e) {
        e.preventDefault();

        Swal.fire({
            title: "Are you sure all input data are correct?",
            showDenyButton: true,
            confirmButtonText: "Yes",
            denyButtonText: "No",
            confirmButtonColor: '#3085d6',
            denyButtonColor: '#d33'
        }).then((result) => {
            if (result.isConfirmed) {
                var formData = $('#SpecEditForm').serialize();
                console.log('Form data:', formData);

                $.ajax({
                    url: '/room/lab/edit',
                    method: 'POST',
                    data: formData,
                    success: function (response) {
                        Swal.fire("Saved!", "", "success").then(() => {
                            updateTableRow(response.room); // Update the table row with new data
                            $('#SpecEditFormCard').addClass('hidden');
                            location.reload();
                        });
                    },
                    error: function (xhr, status, error) {
                        var errorMessage = xhr.responseJSON?.message || error;
                        console.log('Error:', errorMessage);
                        Swal.fire("Error!", "Failed to update room: " + errorMessage, "error");
                    }
                });
            } else if (result.isDenied) {
                Swal.fire("Changes are not saved", "", "info");
            }
        });
    });

    // Function to update the table row with new data
    function updateTableRow(room) {
        var row = $(`tr[data-id="${room.id}"]`); // Locate the row using data-id
        if (row.length > 0) {
            row.find('td').eq(0).text(room.BuildingName); // Update building name
            row.find('td').eq(1).text(room.Room);         // Update room name
            row.find('td').eq(2).text(room.capacity);     // Update capacity
            console.log('Row updated successfully');
        } else {
            console.warn('Row not found for room ID:', room.id);
        }
    }

    $('#SpecEditCloseFormBtn').click(function () {
        console.log('Close Add Facility Button Clicked');
        $('#SpecEditFormCard').addClass('hidden');
    });


    $('#SpecEditCancelFormBtn').click(function () {
        console.log('Close Add Facility Button Clicked');
        $('#SpecEditFormCard').addClass('hidden');
    });
});



// MAIN TABLE DATATABLES
document.addEventListener("DOMContentLoaded", function() {
    // Check if the table exists and simple-datatables is loaded
    if (document.getElementById("SpecFacTable") && typeof simpleDatatables !== 'undefined') {
        const dataTable = new simpleDatatables.DataTable("#SpecFacTable", {
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

        document.getElementById("SpecSearch").addEventListener("keyup", function() {
            let searchTerm = this.value;
            dataTable.search(searchTerm);
        });
    }
});

//Get School Year
$(document).ready(function () {
    function fetchSchoolYears() {
        // Define the API URL
        const apiUrl = "https://bhnhs-sis-api-v1.onrender.com/api/v1/sis/schoolYear";

        // Make an AJAX GET request to the API
        $.ajax({
            url: apiUrl,
            method: "GET",
            success: function (response) {

                const $dropdown = $('#SuppReqSchoolYear');
                $dropdown.empty();

                $dropdown.append('<option value="" disabled>Select School Year</option>');

                $.each(response.foundSchoolYear, function (index, year) {
                    const isSelected = year.schoolYear === "2024-2025" ? "selected" : "";
                    $dropdown.append(
                        `<option value="${year.schoolYear}" ${isSelected}>${year.schoolYear}</option>`
                    );
                });
            },
            error: function (xhr, status, error) {
                console.error("Failed to fetch school years:", error);
                // Handle error scenario
                $('#SuppReqSchoolYear').append('<option value="" disabled>No data available</option>');
            }
        });
    }

    // Call the function to fetch school years on page load
    fetchSchoolYears();


    // Event listener for the dropdown change event
    $('#SuppReqSchoolYear').change(function () {
        const selectedOption = $(this).find('option:selected');
        const selectedValue = selectedOption.val(); // Get the value (schoolYearId)

        // Log the selected option
        console.log(`Selected School Year: ${selectedValue}`);
    });
});


//Automatic Set Date
document.addEventListener("DOMContentLoaded", function() {
    function formatDateToMMDDYYYY(date) {
        const month = String(date.getMonth() + 1).padStart(2, '0'); 
        const day = String(date.getDate()).padStart(2, '0');
        const year = date.getFullYear();
        return `${month}/${day}/${year}`;
    }

    const today = formatDateToMMDDYYYY(new Date());
    document.getElementById("SpecRoomDate").value = today;
});
