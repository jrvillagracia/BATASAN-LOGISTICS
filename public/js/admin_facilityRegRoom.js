// ======================== ADD A FACILITY BUTTON FORM ============================= //
$(document).ready(function () {
    $('#RegRoomFormBtn').click(function () {
        console.log('Show Add Facility Button Clicked');
        $('#RegFormCard').removeClass('hidden');
    });
});

$(document).ready(function () {
    $('#RegCloseFormBtn').click(function () {
        console.log('Close Add Facility Button Clicked');
        $('#RegFormCard').addClass('hidden');
    });
});

$(document).ready(function () {
    $('#RegCancelFormBtn').click(function () {
        console.log('Close Add Facility Button Clicked');
        $('#RegFormCard').addClass('hidden');
    });
});

//ADD FACILITY REGULAR
$(document).ready(function () {
    $('#RegSubFormBtn').click(function (event) {
        event.preventDefault(); 

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        const buildingName = $('#RegBldName').val();
        const room = $('#RegRoom').val();
        const capacity = $('#RegCapacity').val();
        const facilityRoomDate = $('#RegRoomDate').val(); 
        
        // Check if all values are entered
        if (buildingName === '' || room === '' || capacity === '' || facilityRoomDate === '') {
            Swal.fire({
                icon: "error",
                title: "Oops...",
                text: "Please fill all fields!",
                showConfirmButton: true
            });
            return;
        }

        // Determine facilityRoomType based on the current page/form
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
            buildingName: buildingName,
            room: room,
            capacity: capacity,
            facilityRoomDate: facilityRoomDate,
            facilityRoomType: facilityRoomType,
        };

        // Confirmation dialog
        Swal.fire({
            title: 'Are you sure?',
            text: 'Do you want to submit this room information?',
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
                    url: '/rooms/store',
                    type: 'POST',  
                    data: formData,  
                    success: function (response) {
                        console.log(response);
                        $('#RegForm')[0].reset(); 
                        $('#RegFormCard').addClass('hidden');
                        
                        let status = (response.currentRoomCount >= capacity) ? 'Unavailable' : 'Available';

                        // Append the new row to the table
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
                            text: 'Room has been successfully added',
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
    });
});



// SELECT ALL BUTTOn
$(document).ready(function() {
    let isAllChecked = false;


    $('#RegfoundSectionselectAllBtn').click(function() {
        isAllChecked = !isAllChecked;
        $('#RegFacTable').find('input[type="checkbox"]').prop('checked', isAllChecked);

        if (isAllChecked) {
            $(this).text('Unselect All');
        } else {
            $(this).text('Select All');
        }
    });
});


// VIEW 
$(document).ready(function () {
    // Handle "View" button click
    $('.viewINSTpButton').click(function () {
        const roomId = $(this).data('id'); // Get the room ID
        const roomIndex = $(this).data('index'); // Get the room index
        console.log(`View Instructional Button Clicked: Room ID = ${roomId}, Index = ${roomIndex}`);

        // Show the specific popup card for the room
        $(`#ViewINSTPopupCard-${roomIndex}`).removeClass('hidden');
    });

    // Handle "Close" button click inside the popup
    $('.closeViewINSTPopupCard').click(function () {
        const roomIndex = $(this).data('id'); // Use data-id to target the index
        console.log(`Close "X" Button Clicked: Index = ${roomIndex}`);

        // Hide the specific popup card
        $(`#ViewINSTPopupCard-${roomIndex}`).addClass('hidden');
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
    $(document).on('click', '.editINSTButton', function (event) {
        event.preventDefault();
        console.log('Edit Room Button Clicked');

        // Get room ID from the clicked button's data-id attribute
        var roomId = $(this).data('id');
        var row = $(this).closest('tr'); // Closest row containing the button
        console.log('Editing Room with ID:', roomId);

        // Show the edit modal
        $('#RegEditFormCard').removeClass('hidden');

        // Populate the form with data from the selected row
        $('#RegEditForm').find('#RegEditBldName').val(row.find('td').eq(0).text().trim());
        $('#RegEditForm').find('#RegEditRoom').val(row.find('td').eq(1).text().trim());
        $('#RegEditForm').find('#RegEditCapacity').val(row.find('td').eq(2).text().trim()); // Adjusted index for capacity

        // Set the hidden input field with the room ID
        $('#RegEditForm').find('input[name="id"]').val(roomId);
    });

    // Handle the save button click
    $('.RegEditSaveFormBtn').on('click', function (e) {
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
                var formData = $('#RegEditForm').serialize();
                console.log('Form data:', formData);

                $.ajax({
                    url: '/room/edit',
                    method: 'POST',
                    data: formData,
                    success: function (response) {
                        Swal.fire("Saved!", "", "success").then(() => {
                            updateTableRow(response.room); // Update the table row with new data
                            $('#RegEditFormCard').addClass('hidden');
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

    $('#RegEditCloseFormBtn').click(function () {
        console.log('Close Add Facility Button Clicked');
        $('#RegEditFormCard').addClass('hidden');
    });


    $('#RegEditCancelFormBtn').click(function () {
        console.log('Close Add Facility Button Clicked');
        $('#RegEditFormCard').addClass('hidden');
    });
});


// MAIN TABLE DATATABLES
document.addEventListener("DOMContentLoaded", function () {
    // Check if the table exists and simple-datatables is loaded
    if (document.getElementById("RegFacTable") && typeof simpleDatatables !== 'undefined') {
        const dataTable = new simpleDatatables.DataTable("#RegFacTable", {
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

        document.getElementById("RegSearch").addEventListener("keyup", function () {
            let searchTerm = this.value;
            dataTable.search(searchTerm);
        });
    }
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
    document.getElementById("RegRoomDate").value = today;
});
