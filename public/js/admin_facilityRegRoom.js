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
        const status = $('#facilityStatusReg').val();
        const capacity = $('#RegCapacity').val();
        const facilityRoomDate = $('#RegRoomDate').val(); // Get the date value
        

        // Check if all values are entered
        if (buildingName === '' || room === '' || status === '' || capacity === '' || facilityRoomDate === '') {
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
            status: status,
            capacity: capacity,
            facilityRoomDate: facilityRoomDate,
            facilityRoomType: facilityRoomType,
        };

        // AJAX request
        $.ajax({
            url: '/rooms/store',
            type: 'POST',  // Request type
            data: formData,  // Data to be sent to the server
            success: function (response) {
                console.log(response); // Log the response
                $('#RegForm')[0].reset(); // Reset form
                $('#RegFormCard').addClass('hidden'); // Hide the form card

                // Append the new row to the table
                const newRow = `<tr class="cursor-pointer table-row" data-index="${response.id}" data-id="${response.id}">
                                   <td class="px-6 py-6 border-b border-gray-300">${response.buildingName}</td>
                                   <td class="px-6 py-6 border-b border-gray-300">${response.room}</td>
                                   <td class="px-6 py-6 border-b border-gray-300">${response.status}</td>
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



// Return data from SIS 
$.ajax({
    url: 'http://your-laravel-app-url/api/rooms',  // Ensure you're calling the correct route
    type: 'GET',
    dataType: 'json',
    success: function(response) {
        try {
            console.log('Full response:', response.rooms);  // Log the rooms data to see the structure

            if (response && response.rooms && Array.isArray(response.rooms)) {
                $('#tableBody').empty();

                response.rooms.forEach(function(room) {
                    console.log('Room:', room);  // Log each room to check its structure

                    const newRow = `<tr class="odd:bg-blue-100 odd:dark:bg-gray-900 even:bg-white even:dark:bg-gray-800 border-b dark:border-gray-700" data-index="${room.id}" data-id="${room.id}">
                                       <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">${room.buildingName || 'N/A'}</td>
                                       <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">${room.room || 'N/A'}</td>
                                       <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">${room.facilityStatus || 'N/A'}</td>
                                       <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">${room.capacity || 'N/A'}</td>
                                       <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">${room.session || 'N/A'}</td>
                                       <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">${room.sectionName || 'N/A'} - Grade ${room.gradeLevel || 'N/A'}</td>
                                       <td class="px-6 py-4">
                                            <button id="viewINSTpButton" type="button">
                                                <svg class="w-[27px] h-[27px] text-green-600 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                                    <path stroke="currentColor" stroke-width="2" d="M21 12c0 1.2-4.03 6-9 6s-9-4.8-9-6c0-1.2 4.03-6 9-6s9 4.8 9 6Z" />
                                                    <path stroke="currentColor" stroke-width="2" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                                </svg>
                                            </button>

                                            <button id="editINSTButton" type="button">
                                                <svg class="w-[27px] h-[27px] text-blue-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                                    <path fill-rule="evenodd" d="M11.32 6.176H5c-1.105 0-2 .949-2 2.118v10.588C3 20.052 3.895 21 5 21h11c1.105 0 2-.948 2-2.118v-7.75l-3.914 4.144A2.46 2.46 0 0 1 12.81 16l-2.681.568c-1.75.37-3.292-1.263-2.942-3.115l.536-2.839c.097-.512.335-.983.684-1.352l2.914-3.086Z" clip-rule="evenodd" />
                                                    <path fill-rule="evenodd" d="M19.846 4.318a2.148 2.148 0 0 0-.437-.692 2.014 2.014 0 0 0-.654-.463 1.92 1.92 0 0 0-1.544 0 2.014 2.014 0 0 0-.654.463l-.546.578 2.852 3.02.546-.579a2.14 2.14 0 0 0 .437-.692 2.244 2.244 0 0 0 0-1.635ZM17.45 8.721 14.597 5.7 9.82 10.76a.54.54 0 0 0-.137.27l-.536 2.84c-.07.37.239.696.588.622l2.682-.567a.492.492 0 0 0 .255-.145l4.778-5.06Z" clip-rule="evenodd" />
                                                </svg>
                                            </button>
                                        </td>
                                   <td class="px-6 py-4">
                                        <div class="flex items-center">
                                            <input id="RegRoomCheckBox" type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                            <label for="checkbox-all-search" class="sr-only">checkbox</label>
                                        </div>
                                    </td>
                               </tr>`;

                    $('#tableBody').append(newRow);
                });
            } else {
                console.log('No rooms found:', response);
            }
        } catch (e) {
            console.error('Error processing response:', e);
        }
    },
    error: function(error) {
        console.error('Error:', error);
    }
});








