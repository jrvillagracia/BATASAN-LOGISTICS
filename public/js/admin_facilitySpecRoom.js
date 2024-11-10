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
        event.preventDefault();  // Prevent default form submission

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        // Gather form data
        const buildingName = $('#SpecBldName').val();
        const room = $('#SpecRoom').val();
        const status = $('#facilityStatusSpec').val();
        const capacity = $('#SpecCapacity').val();
        const shift = $('#facilityShiftSpec').val();
        const roomType = $('#facilityRTSpec').val();

        // Check if all values are entered
        if (buildingName === '' || room === '' || status === '' || capacity === '' || shift === ''|| roomType === '') {
            Swal.fire({
                icon: "error",
                title: "Oops...",
                text: "Please fill all fields!",
                    showConfirmButton: true
            });
            return;
        }

        // Prepare data for AJAX request
        const formData = {
            _token: $('meta[name="csrf-token"]').attr('content'),  // Laravel CSRF token
            buildingName: buildingName,
            room: room,
            status: status,
            capacity: capacity,
            shift: shift,
            facilityRoomType: roomType  // Adjust this name to match your backend field
        };


        // AJAX request
        $.ajax({
            url: '/rooms/store',  // The correct way to include the Blade route
            type: 'POST',
            data: formData,
            success: function (response) {
                // Clear form
                $('#SpecForm')[0].reset();

                // Hide form card
                $('#SpecFormCard').addClass('hidden');

                // Show success message
                Swal.fire("Saved!", response.message, "success");

                // Optionally, you can append the new data to the table or update the UI
                $('#tableBody').append(
                    `<tr class="cursor-pointer table-row" data-index="${response.index}" data-id="${response.id}">
                        <td class="px-6 py-3">${response.buildingName}</td>
                        <td class="px-6 py-3">${response.room}</td>
                        <td class="px-6 py-3">${response.status}</td>
                        <td class="px-6 py-3">${response.capacity}</td>
                        <td class="px-6 py-4">${response.shift}</td>
                    </tr>`
                );
            },
            error: function (xhr, status, error) {
                // Handle error response
                console.error("Error details:", xhr.responseText);
                Swal.fire({
                    icon: "error",
                    title: "Oops...",
                    text: "Something went wrong!",
                    showConfirmButton: true
                });
            }
        });
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
    $('#viewLABButton').click(function () {
        console.log('View Laboratory Button is Clicked.');
        $('#ViewLABPopupCard').removeClass('hidden');
    });

    $('#closeViewLABPopupCard').click(function () {
        console.log('Close "X" Equipment Button is Clicked.');
        $('#ViewLABPopupCard').addClass('hidden');
    });
});



// EDIT
$(document).ready(function () {
    $('#editLABButton').click(function () {
        console.log('Show Add Facility Button Clicked');
        $('#SpecEditFormCard').removeClass('hidden');
    });


    $('#SpecEditCloseFormBtn').click(function () {
        console.log('Close Add Facility Button Clicked');
        $('#SpecEditFormCard').addClass('hidden');
    });


    $('#SpecEditCancelFormBtn').click(function () {
        console.log('Close Add Facility Button Clicked');
        $('#SpecEditFormCard').addClass('hidden');
    });

    $('#SpecEditSaveFormBtn').click(function () {
        Swal.fire({
            icon: 'success',
            title: 'Saved!',
            text: 'Your action has been successfully saved',
            confirmButtonText: 'OK',
            confirmButtonColor: '#3085d6'
        }).then(() => {
            $("#SpecEditFormCard").addClass("hidden");
        });
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