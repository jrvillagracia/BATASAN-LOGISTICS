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
                Swal.fire("Saved!", "", "success");

                // Optionally, you can append the new data to the table or reload the table
                $('#tableBody').append(
                    `<tr class="cursor-pointer table-row" data-index="${response.id}" data-id="${response.id}">
                        <td class="px-6 py-3">${response.buildingName}</td>
                        <td class="px-6 py-3">${response.room}</td>
                        <td class="px-6 py-3">${response.status}</td>
                        <td class="px-6 py-3">${response.capacity}</td>
                        <td class="px-6 py-4">${response.shift}</td>
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


