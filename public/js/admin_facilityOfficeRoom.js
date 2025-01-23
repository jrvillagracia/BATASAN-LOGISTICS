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


// EXPORT TO PDF
$(document).ready(function () {
    const { jsPDF } = window.jspdf;

    // Handle "Select All" checkbox
    let isAllSelected = false; // Track whether all checkboxes are currently selected

    $('#OfficeRoomSelectAllBtn').on('click', function () {
        isAllSelected = !isAllSelected; // Toggle the selection state
    
        // Update all checkboxes based on the current state
        $('.row-checkbox').prop('checked', isAllSelected);
    
        // Change button text based on the selection state
        $(this).text(isAllSelected ? 'Deselect All' : 'Select All');
    });

    // Handle Export to PDF
    $('#OfficeRoomExportBtn').on('click', function () {
        const doc = new jsPDF();
        const totalPagesExp = '{total_pages_count_string}';

        // Add a header
        function header(doc) {
            doc.setFontSize(16);
            doc.setFont('helvetica', 'bold');
            doc.text('Facility: Office Report', 14, 15);
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
        $('#OfficeFacTable tbody tr').each(function () {
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

        doc.save('Facility: Office Report.pdf');
    });
});