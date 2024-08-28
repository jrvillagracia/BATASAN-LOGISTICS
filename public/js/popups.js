$(document).ready(function() {

    // $('#editEquipButton').on('click', function(e) {
    //     e.preventDefault(); // Prevent any default behavior
    //     $('#editEquipModal').removeClass('hidden');
    // });

    // 'X' Hide the modal when the close button is clicked
    // $('#closeEquipFormButton').on('click', function() {
    //     $('#editEquipModal').addClass('hidden');
    // });

    // Hide the modal if the user clicks outside of it (but not on the modal content)
    // $(window).on('click', function(e) {
    //     if ($(e.target).is('#editEquipModal')) {
    //         $('#editEquipModal').addClass('hidden');
    //     }
    // });

    // Prevent the modal from closing when clicking inside the modal content
    $('#editSuppModal .bg-white').on('click', function(e) {
        e.stopPropagation();
    });


    // Show the modal when the edit button is clicked
    // $('#editSuppButton').on('click', function(e) {
    //     e.preventDefault(); // Prevent any default behavior
    //     $('#editSuppModal').removeClass('hidden');
    // });

    
    // // 'X' Hide the modal when the close button is clicked
    // $('#closeSuppFormButton').on('click', function() {
    //     $('#editSuppModal').addClass('hidden');
    // });

    // Hide the modal if the user clicks outside of it (but not on the modal content)
    $(window).on('click', function(e) {
        if ($(e.target).is('#editSuppModal')) {
            $('#editSuppModal').addClass('hidden');
        }
    });

    // Prevent the modal from closing when clicking inside the modal content
    $('#editSuppModal .bg-white').on('click', function(e) {
        e.stopPropagation();
    });
});






// Supplies SAVE, CONDEMED, DELETE BUTTON
// $('#saveEquipButton').click(function(e) {
//     e.preventDefault(); // Prevent the default form submission

//     // Your AJAX request or other logic to save the item goes here
    
//     // On success (after your item is successfully saved)
//     Swal.fire({
//         title: "Are you sure all input data are correct?",
//         showDenyButton: true,
//         confirmButtonText: "Yes",
//         denyButtonText: "No"
//       }).then((result) => {
//         if (result.isConfirmed) {
//           Swal.fire("Saved!", "", "success");
//         } else if (result.isDenied) {
//           Swal.fire("Changes are not saved", "", "info");
//         }
//       });      
    
// });

// $('#condEquipButton').click(function(e) {
//     e.preventDefault(); // Prevent the default form submission

//     // Your AJAX request or other logic to save the item goes here
    
//     // On success (after your item is successfully saved)
//     Swal.fire({
//         title: 'Input Supplies Quantity you want to condemn',
//         html:
//           '<input id="SuppliesQuantity" type="number" class="swal2-input" style="width:100%;margin-bottom:20px;">',
//         showCancelButton: true,
//         confirmButtonText: 'Submit',
//         cancelButtonText: 'Cancel',
//         preConfirm: () => {
//           const SuppliesQuantity = Swal.getPopup().querySelector('#SuppliesQuantity').value;
//           if (!SuppliesQuantity) {
//             Swal.showValidationMessage(`Please enter a SuppliesQuantity`);
//           }
//           return { SuppliesQuantity: SuppliesQuantity };
//         }
//       }).then((result) => {
//         if (result.isConfirmed) {
//           Swal.fire(`Supplies Quantity: ${result.value.SuppliesQuantity}`, '', 'success');
//         }
//       });
      
// });



// $('#deleteEquipButton').click(function(e) {
//     e.preventDefault(); // Prevent the default form submission

//     // Your AJAX request or other logic to save the item goes here
    
//     // On success (after your item is successfully saved)
//     Swal.fire({
//         title: "Are you sure?",
//         text: "You want to delete the selected Equipment items?",
//         icon: "warning",
//         showCancelButton: true,
//         confirmButtonColor: "#3085d6",
//         cancelButtonColor: "#d33",
//         confirmButtonText: "Yes",
//         cancelButtonText: "No"
//       }).then((result) => {
//         if (result.isConfirmed) {
//           Swal.fire({
//             title: "Deleted!",
//             text: "Your Equipment Item has been deleted.",
//             icon: "success"
//           });
//         } 
//       });       
// });





// Supplies SAVE, CONDEMED, DELETE BUTTON
$('#saveSuppButton').click(function(e) {
    e.preventDefault(); // Prevent the default form submission

    // Your AJAX request or other logic to save the item goes here

    // On success (after your item is successfully saved)
    Swal.fire({
        title: "Are you sure all input data are correct?",
        showDenyButton: true,
        confirmButtonText: "Yes",
        denyButtonText: "No"
      }).then((result) => {
        if (result.isConfirmed) {
          Swal.fire("Saved!", "", "success");
        } else if (result.isDenied) {
          Swal.fire("Changes are not saved", "", "info");
        }
      });    
});


$('#condSuppButton').click(function(e) {
    e.preventDefault(); // Prevent the default form submission

    // Your AJAX request or other logic to save the item goes here
    
    // On success (after your item is successfully saved)
    Swal.fire({
        title: 'Input Supplies Quantity you want to condemn',
        html:
          '<input id="SuppliesQuantity" type="number" class="swal2-input" style="width:100%;margin-bottom:20px;">',
        showCancelButton: true,
        confirmButtonText: 'Submit',
        cancelButtonText: 'Cancel',
        preConfirm: () => {
          const SuppliesQuantity = Swal.getPopup().querySelector('#SuppliesQuantity').value;
          if (!SuppliesQuantity) {
            Swal.showValidationMessage(`Please enter a SuppliesQuantity`);
          }
          return { SuppliesQuantity: SuppliesQuantity };
        }
      }).then((result) => {
        if (result.isConfirmed) {
          Swal.fire(`Supplies Quantity: ${result.value.SuppliesQuantity}`, '', 'success');
        }
      });
});

$('#deleteSuppButton').click(function(e) {
    e.preventDefault(); // Prevent the default form submission

    // Your AJAX request or other logic to save the item goes here
    
    // On success (after your item is successfully saved)
    Swal.fire({
        title: "Are you sure?",
        text: "You want to delete the selected Supplies items?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes",
        cancelButtonText: "No"
      }).then((result) => {
        if (result.isConfirmed) {
          Swal.fire({
            title: "Deleted!",
            text: "Your Supplies Item has been deleted.",
            icon: "success"
          });
        } 
      });       
});