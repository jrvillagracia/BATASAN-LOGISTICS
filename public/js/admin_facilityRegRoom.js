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
        event.preventDefault();  // Prevent default form submission

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        const buildingName = $('#RegBldName').val();
        const room = $('#RegRoom').val();
        const shift = $('#facilityShiftReg').val();
        const status = $('#facilityStatusReg').val();
        const capacity = $('#RegCapacity').val();
        const roomType = $('#facilityRoomType').val();

        // Check if all values are entered
        if (buildingName === '' || room === '' || shift === '' || status === '' || capacity === '' || roomType === '') {
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
            buildingName: buildingName,
            room: room,
            status: status,
            capacity: capacity,
            shift: shift,
            facilityRoomType: roomType
        };

        // AJAX request
        $.ajax({
            url: '/rooms/store',
            type: 'POST',  // Request type
            data: formData,  // Data to be sent to the server
            success: function (response) {
                // Clear form
                $('#RegForm')[0].reset();

                // Hide form card
                $('#RegFormCard').addClass('hidden');

                // Show success message
                // Swal.fire("Saved!", "", "success");

                Swal.fire({
                    icon: 'success',
                    title: 'Saved!',
                    text: 'Your action has been successfully submitted',
                    confirmButtonText: 'OK',
                    confirmButtonColor: '#3085d6'
                });

                // Optionally, you can append the new data to the table or reload the table
                $('#tableBody').append(
                    `<tr class="cursor-pointer table-row" data-index="${response.id}" data-id="${response.id}">
                        <td class="px-6 py-6 border-b border-gray-300">${response.buildingName}</td>
                        <td class="px-6 py-6 border-b border-gray-300">${response.room}</td>
                        <td class="px-6 py-6 border-b border-gray-300">${response.status}</td>
                        <td class="px-6 py-6 border-b border-gray-300">${response.capacity}</td>
                        <td class="px-6 py-6 border-b border-gray-300">${response.shift}</td>
                        <td class="px-6 py-6 border-b border-gray-300"></td>
                    </tr>`
                );
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
    });
});


// SELECT ALL BUTTOn
$(document).ready(function() {
    let isAllChecked = false;


    $('#RegRoomSelectAllBtn').click(function() {
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
    $('#viewINSTpButton').click(function () {
        console.log('View Instructional Button is Clicked.');
        $('#ViewINSTPopupCard').removeClass('hidden');
    });

    $('#closeViewINSTPopupCard').click(function () {
        console.log('Close "X" Equipment Button is Clicked.');
        $('#ViewINSTPopupCard').addClass('hidden');
    });
});


// EDIT
$(document).ready(function () {
    $('#editINSTButton').click(function () {
        console.log('Show Add Facility Button Clicked');
        $('#RegEditFormCard').removeClass('hidden');
    });


    $('#RegEditCloseFormBtn').click(function () {
        console.log('Close Add Facility Button Clicked');
        $('#RegEditFormCard').addClass('hidden');
    });


    $('#RegEditCancelFormBtn').click(function () {
        console.log('Close Add Facility Button Clicked');
        $('#RegEditFormCard').addClass('hidden');
    });

    $('#RegEditSaveFormBtn').click(function () {
        Swal.fire({
            icon: 'success',
            title: 'Saved!',
            text: 'Your action has been successfully saved',
            confirmButtonText: 'OK',
            confirmButtonColor: '#3085d6'
        }).then(() => {
            $("#RegEditFormCard").addClass("hidden");
        });
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
