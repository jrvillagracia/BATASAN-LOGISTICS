// ======================== ADD EVENT BUTTON ============================= //
$(document).ready(function() {
    $('#EventFormButton').click(function() {
        event.preventDefault();
        console.log('Show Event Form Button Clicked');
        $('#EventFormCard').removeClass('hidden'); 
    });


    // Hide the form card when the close button is clicked
    $('#EventCancelFormBtn').click(function() {
        event.preventDefault();
        console.log('Close Form Button Clicked');
        $('#EventFormCard').addClass('hidden'); 
    });

    $('#EventCloseFormBtn').click(function() {
        event.preventDefault();
        console.log('Close X Button Clicked');
        $('#EventFormCard').addClass('hidden'); 
    });

    $(document).ready(function() {
        $("#EventSubmitFormBtn").click(function () {
            Swal.fire({
                icon: 'success',
                title: 'Submitted',
                text: 'Your inputs has been successfully submitted',
                confirmButtonText: 'OK',
                confirmButtonColor: '#3085d6'
            }).then(() => {
                $("#EventFormCard").addClass("hidden");
            });
        });
    });
});

// ======================== END FOR ADD EVENT BUTTON ============================= //




// ======================== START FOR APPROVAL MODULE ============================= //
// VIEW BUTTON CARD FORM      
// THIS IS VIEW BUTTON IS APPLICABLE TO FOR APPROVAL, APPROVE REQUEST, COMPLETED REQUEST
$(document).ready(function () {
    $('#EventViewBTN').click(function () {
        console.log('View Event Button is Clicked.');
        $('#ViewEventApprPopupCard').removeClass('hidden');
    });
});

$(document).ready(function () {
    $('#closeViewEventPopupCard').click(function () {
        console.log('Close View Button is Clicked.');
        $('#ViewEventApprPopupCard').addClass('hidden');
    });
});


// APPROVE BUTTON CARD FORM
$(document).ready(function () {
    $("#EventApproveBTN").click(function () {
        $("#ApprEventPopupCard").removeClass("hidden");
    });

    // Hide the popup and show Cancel message when Cancel button is clicked
    $("#closeApprEventPopupCard").click(function () {
        Swal.fire({
            icon: 'error',
            title: 'Cancelled',
            text: 'Your action has been cancelled',
            confirmButtonText: 'OK',
            confirmButtonColor: '#D1191A'
        }).then(() => {
            $("#ApprEventPopupCard").addClass("hidden");
        });
    });

    // Hide the popup and show Submitted message when Submit button is clicked
    $("#submitApprEventPopupCard").click(function () {
        Swal.fire({
            icon: 'success',
            title: 'Submitted',
            text: 'Your action has been successfully submitted',
            confirmButtonText: 'OK',
            confirmButtonColor: '#3085d6'
        }).then(() => {
            $("#ApprEventPopupCard").addClass("hidden");
        });
    });
});


// DECLINE BUTTON CARD FORM
$(document).ready(function () {
    // Show the popup when the button is clicked
    $("#EventDeclineBTN").click(function () {
        $("#DeclineEventPopupCard").removeClass("hidden");
    });

    // Hide the popup and show Cancel message when Cancel button is clicked
    $("#closeDeclineEventPopupCard").click(function () {
        Swal.fire({
            icon: 'error',
            title: 'Cancelled',
            text: 'Decline process has been cancelled',
            confirmButtonText: 'OK',
            confirmButtonColor: '#3085d6'
        }).then(() => {
            $("#DeclineEventPopupCard").addClass("hidden");
        });
    });

    // Hide the popup and show Submitted message when Submit button is clicked
    $("#submitDeclineEventPopupCard").click(function () {
        Swal.fire({
            icon: 'success',
            title: 'Submitted',
            text: 'Your reason has been submitted',
            confirmButtonText: 'OK',
            confirmButtonColor: '#3085d6'
        }).then(() => {
            $("#DeclineEventPopupCard").addClass("hidden");
        });
    });
});


// ======================== END FOR APPROVAL MODULE ============================= //





// ======================== START OF APPROVE REQUEST MODULE ============================= //




// ======================== END OF APPROVE REQUEST MODULE ============================= //






// ======================== COMPLETED REQUEST MODULE ============================= //





// ======================== END OF COMPLETED REQUEST MODULE ============================= //




// ======================== DATATABLES ============================= //
// MAIN TABLE DATATABLES
document.addEventListener("DOMContentLoaded", function () {
    // Check if the table exists and simple-datatables is loaded
    if (document.getElementById("EventApproveTable") && typeof simpleDatatables !== 'undefined') {
        const dataTable = new simpleDatatables.DataTable("#EventApproveTable", {
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

        document.getElementById("eventSearch").addEventListener("keyup", function() {
            let searchTerm = this.value;
            dataTable.search(searchTerm);
        });
    }
});
// ======================== END OF DATATABLES ============================= //





// GUMAGANA PERO MAY SIRA 
// $(document).ready(function () {
//     // Ensure jsPDF is initialized
//     window.jsPDF = window.jspdf.jsPDF;

//     $("#printApprEventPopupCard").click(function () {
//         window.html2canvas = html2canvas; // Ensure html2canvas is loaded

//         // Temporarily show the hidden popup
//         $("#ViewEventApprPopupCard").removeClass("hidden");

//         // Temporarily modify the card's background and styles to ensure proper capture
//         var originalStyles = $("#ViewEventApprPopupCard").attr("style");
//         $("#ViewEventApprPopupCard").css({
//             "background": "white", // Ensure white background
//             "box-shadow": "none", // Remove shadow
//             "color": "black" // Ensure the text color is black
//         });

//         var doc = new jsPDF();

//         // Get the HTML content of the popup
//         doc.html(document.querySelector("#ViewEventApprPopupCard"), {
//             callback: function (doc) {
//                 // Save the generated PDF
//                 doc.save("event-request-slip.pdf");

//                 // Restore original styles after PDF generation
//                 $("#ViewEventApprPopupCard").attr("style", originalStyles);

//                 // Hide the popup again
//                 $("#ViewEventApprPopupCard").addClass("hidden");
//             },
//             x: 15,
//             y: 15,
//             width: 170, // Adjust width based on content
//             html2canvas: {
//                 scale: 2, // Improve quality by increasing the scale
//                 useCORS: true, // Allow cross-origin for external resources
//                 backgroundColor: "#ffffff" // Force white background
//             }
//         });
//     });

//     // Close popup when the close button is clicked
//     $("#closeViewEventApprPopupCard").click(function () {
//         $("#ViewEventApprPopupCard").addClass("hidden");
//     });

//     // Cancel button functionality (optional)
//     $("#cancelApprEventPopupCard").click(function () {
//         $("#ViewEventApprPopupCard").addClass("hidden");
//     });
// });

