// ======================== ADD A FACILITY BUTTON FORM ============================= //
$(document).ready(function () {
    $('#OfficeRoomFormBtn').click(function () {
        console.log('Show Add Facility Button Clicked');
        $('#OfficeFormCard').removeClass('hidden');
    });
});

$(document).ready(function () {
    $('#OfficeCloseFormBtn').click(function () {
        console.log('Close Add Facility Button Clicked');
        $('#OfficeFormCard').addClass('hidden');
    });
});

$(document).ready(function () {
    $('#OfficeCancelFormBtn').click(function () {
        console.log('Close Add Facility Button Clicked');
        $('#OfficeFormCard').addClass('hidden');
    });
});

// ADD FACILITY OFFICE 






// SELECT ALL BUTTOn
$(document).ready(function() {
    let isAllChecked = false;
    

    $('#OfficeRoomSelectAllBtn').click(function() {
        isAllChecked = !isAllChecked;
        $('#OfficeFacTable').find('input[type="checkbox"]').prop('checked', isAllChecked);

        if (isAllChecked) {
            $(this).text('Unselect All');
        } else {
            $(this).text('Select All');
        }
    });
});




// VIEW 
$(document).ready(function () {
    $('#viewOFFICEButton').click(function () {
        console.log('View Laboratory Button is Clicked.');
        $('#ViewOFFICEPopupCard').removeClass('hidden');
    });

    $('#closeViewOFFICEPopupCard').click(function () {
        console.log('Close "X" Equipment Button is Clicked.');
        $('#ViewOFFICEPopupCard').addClass('hidden');
    });
});


// EDIT
$(document).ready(function () {
    $('#editOFFICEButton').click(function () {
        console.log('Show Add Facility Button Clicked');
        $('#OfficeEditFormCard').removeClass('hidden');
    });


    $('#OfficeEditCloseFormBtn').click(function () {
        console.log('Close Add Facility Button Clicked');
        $('#OfficeEditFormCard').addClass('hidden');
    });


    $('#OfficeEditCancelFormBtn').click(function () {
        console.log('Close Add Facility Button Clicked');
        $('#OfficeEditFormCard').addClass('hidden');
    });

    $('#OfficeEditSaveFormBtn').click(function () {
        Swal.fire({
            icon: 'success',
            title: 'Saved!',
            text: 'Your action has been successfully saved',
            confirmButtonText: 'OK',
            confirmButtonColor: '#3085d6'
        }).then(() => {
            $("#OfficeEditFormCard").addClass("hidden");
        });
    });
});




// MAIN TABLE DATATABLES
document.addEventListener("DOMContentLoaded", function() {
    // Check if the table exists and simple-datatables is loaded
    if (document.getElementById("OfficeFacTable") && typeof simpleDatatables !== 'undefined') {
        const dataTable = new simpleDatatables.DataTable("#OfficeFacTable", {
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

        document.getElementById("OfficeSearch").addEventListener("keyup", function() {
            let searchTerm = this.value;
            dataTable.search(searchTerm);
        });
    }
});