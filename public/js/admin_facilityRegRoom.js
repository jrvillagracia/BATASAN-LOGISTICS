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
        const schoolYear = $('#ReqSchoolYear').val();

        if (buildingName === '' || room === '' || capacity === '' || facilityRoomDate === '' || schoolYear ==='') {
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

        const formData = {
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

        setTimeout(() =>{
            $('#save-loader').remove();
            
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
                    $.ajax({
                        url: '/rooms/store',
                        type: 'POST',
                        data: formData,
                        success: function (response) {
                            console.log(response);
                            $('#RegForm')[0].reset();
                            $('#RegFormCard').addClass('hidden');
    
                            let status = (response.currentRoomCount >= capacity) ? 'Unavailable' : 'Available';
    
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
                            if (xhr.status === 422) {
                                Swal.fire({
                                    icon: "error",
                                    title: "Room Already Exists",
                                    text: xhr.responseJSON.message,
                                    showConfirmButton: true
                                });
                            } else {
                                Swal.fire({
                                    icon: "error",
                                    title: "Oops...",
                                    text: "Something went wrong!",
                                    showConfirmButton: true
                                });
                            }
                        }
                    });
                }
            });
        }, 1000);
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
        $('#RegEditForm').find('#RegEditBldName').val(row.find('td').eq(1).text().trim());
        $('#RegEditForm').find('#RegEditRoom').val(row.find('td').eq(2).text().trim());
        $('#RegEditForm').find('#RegEditCapacity').val(row.find('td').eq(4).text().trim()); // Adjusted index for capacity

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

// Filter table rows based on selected school year using DataTables
$(document).ready(function () {
    const dataTable = new simpleDatatables.DataTable("#RegFacTable");

    $('#ReqSchoolYear').change(function () {
        const selectedYear = $(this).val();

        console.log(`Selected Year: ${selectedYear}`); // Debugging: Log selected year

        dataTable.search(selectedYear);
    });
});


// Get School Year
$(document).ready(function () {
    function fetchSchoolYears() {
        const apiUrl = "https://bhnhs-sis-api-v1.onrender.com/api/v1/sis/schoolYear";

        $.ajax({
            url: apiUrl,
            method: "GET",
            success: function (response) {
                const $dropdown = $('#ReqSchoolYear');
                $dropdown.empty();
                $dropdown.append('<option value="" disabled>Select School Year</option>');
                $.each(response.foundSchoolYear, function (index, year) {
                    const isSelected = year.schoolYear === "2024-2025" ? "selected" : "";
                    $dropdown.append(
                        `<option value="${year.schoolYear}" ${isSelected}>${year.schoolYear}</option>`
                    );
                });
            },
            error: function () {
                $('#ReqSchoolYear').append('<option value="" disabled>No data available</option>');
            }
        });
    }

    fetchSchoolYears();

    // Filter table rows based on selected school year
    $('#ReqSchoolYear').change(function () {
        const selectedYear = $(this).val();

        console.log(`Selected Year: ${selectedYear}`); // Debugging: Log selected year

        $('#tableBody tr').each(function () {
            const rowYear = $(this).data('school-year');

            console.log(`Row Year: ${rowYear}`); // Debugging: Log row year

            if (rowYear === selectedYear) {
                $(this).show(); // Show rows that match the selected year
            } else {
                $(this).hide(); // Hide rows that do not match
            }
        });
    });
});



//Automatic Set Date
document.addEventListener("DOMContentLoaded", function () {
    function formatDateToMMDDYYYY(date) {
        const month = String(date.getMonth() + 1).padStart(2, '0');
        const day = String(date.getDate()).padStart(2, '0');
        const year = date.getFullYear();
        return `${month}/${day}/${year}`;
    }

    const today = formatDateToMMDDYYYY(new Date());
    document.getElementById("RegRoomDate").value = today;
});



// EXPORT PDF
$(document).ready(function () {
    const { jsPDF } = window.jspdf;

    // Handle "Select All" checkbox
    let isAllSelected = false; // Track whether all checkboxes are currently selected

    $('#RegRoomSelectAllBtn').on('click', function () {
        isAllSelected = !isAllSelected; // Toggle the selection state
    
        // Update all checkboxes based on the current state
        $('.row-checkbox').prop('checked', isAllSelected);
    
        // Change button text based on the selection state
        $(this).text(isAllSelected ? 'Deselect All' : 'Select All');
    });

    // Handle Export to PDF
    $('#RegRoomExportBtn').on('click', function () {
        const doc = new jsPDF();
        const totalPagesExp = '{total_pages_count_string}';

        // Add a header
        function header(doc) {
            doc.setFontSize(16);
            doc.setFont('helvetica', 'bold');
            doc.text('Facility: Instructional Report', 14, 15);
            doc.line(10, 20, 200, 20);
        }

        // Add a footer
        function footer(doc) {
            const pageCount = doc.internal.getNumberOfPages();
            const pageSize = doc.internal.pageSize;
            const pageHeight = pageSize.height || pageSize.getHeight();
            doc.setFontSize(10);
            doc.text(`Page ${pageCount} of ${totalPagesExp}`, 14, pageHeight - 10);
            doc.line(10, pageHeight - 15, 200, pageHeight - 15);
        }

        // Collect selected rows
        const selectedRows = [];
        $('#RegFacTable tbody tr').each(function () {
            if ($(this).find('.row-checkbox').is(':checked')) {
                const row = [];
                $(this).find('td:not(:first-child)').each(function () {
                    row.push($(this).text().trim());
                });
                selectedRows.push(row);
            }
        });

        // Alert if no rows selected
        if (selectedRows.length === 0) {
            alert('Please select at least one row to export.');
            return;
        }

        // Add selected rows to the PDF
        doc.autoTable({
            head: [['Building Name', 'Room', 'Status', 'Capacity', 'Shift Tyep', 'Assigned']],
            body: selectedRows,
            startY: 25,
            didDrawPage: (data) => {
                header(doc);
                footer(doc);
            },
            margin: { top: 30, bottom: 20 },
        });

        if (typeof doc.putTotalPages === 'function') {
            doc.putTotalPages(totalPagesExp);
        }

        doc.save('Facility: Instructional Report.pdf');
    });
});