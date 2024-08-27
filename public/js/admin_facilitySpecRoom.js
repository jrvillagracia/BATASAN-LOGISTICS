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

