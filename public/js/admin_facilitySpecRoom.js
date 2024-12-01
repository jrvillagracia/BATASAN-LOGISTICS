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
        const capacity = $('#SpecCapacity').val();
        const facilityRoomDate = $('#SpecRoomDate').val(); 

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
            _token: $('meta[name="csrf-token"]').attr('content'),  // Laravel CSRF token
            buildingName: buildingName,
            room: room,
            capacity: capacity,
            facilityRoomDate: facilityRoomDate,
            facilityRoomType: facilityRoomType,  // Adjust this name to match your backend field
        };


        // AJAX request
        $.ajax({
            url: '/rooms/lab/store',  // The correct way to include the Blade route
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
