$(document).ready(function () {
    // Function to add a new item
    // $('#saveButton').on('click', function () {
    //     console.log('Save Button Clicked');
    //     const name = $('#productName').val().trim();
    //     const category = $('#productCategory').val().trim();
    //     const quantity = $('#productQuantity').val().trim();
    //     const date = $('#productDate').val().trim();
    //     const price = $('#productPrice').val().trim();
    //     const department = $('#productDepartment').val().trim();
    //     const sku = $('#productSKU').val().trim();

    //     if (name === '' || category === '' || quantity === '' || date === '' || price === '' || department === '' || sku === '') {
    //         Swal.fire({
    //             icon: "error",
    //             title: "Oops...",
    //             showConfirmButton: true,
    //             text: "Please fill all fields!"
    //         });
    //         return;
    //     }

    //     // AJAX request to save the data
    //     $.ajax({
    //         url: `/${itemCategory}/store`,
    //         type: 'POST',
    //         data: {
    //             _token: $('input[name="_token"]').val(),
    //             productName: name,
    //             productCategory: category,
    //             productQuantity: quantity,
    //             productDate: date,
    //             productPrice: price,
    //             productDepartment: department,
    //             productSKU: sku
    //         },
    //         success: function (response) {
    //             Swal.fire({
    //                 icon: "success",
    //                 title: response.message,
    //                 showConfirmButton: true
    //             }).then(() => {
    //                 // Clear input fields
    //                 $('#equipmentForm')[0].reset();
    //                 $('#suppliesForm')[0].reset();
    //                 $('#itemFormCard').addClass('hidden');
    //             });
    //         },
    //         error: function (xhr) {
    //             Swal.fire({
    //                 icon: "error",
    //                 title: "Error",
    //                 text: xhr.responseText
    //             });
    //         }
    //     });
    // });

    // $('#closeFormButton').on('click', function () {
    //     $('#itemFormCard').addClass('hidden');
    // });

    // Function to open the popup with item details
    // $('#dynamicTable').on('click', 'tr', function () {
    //     const index = $(this).data('index');
    //     const item = items[index];
    //     console.log('Row Clicked', item);

    //     $('#popupTitle').text(item.name);
    //     $('#popupCategory').text('Category: ' + item.category);
    //     $('#popupQuantity').text('Quantity: ' + item.quantity);
    //     $('#popupDate').text('Date: ' + item.date);
    //     $('#popupPrice').text('Price: $' + item.price);
    //     $('#popupDepartment').text('Department: ' + item.department);
    //     $('#popupSKU').text('SKU: ' + item.sku);
    //     $('#popup').removeClass('hidden');
    // });

    // // Function to close the popup
    // $('#closePopup').click(function () {
    //     console.log('Close Popup Clicked');
    //     $('#popup').addClass('hidden');
    // });
});

// SIDEBAR 

$(document).ready(function() {
    $("#burger").click(function() {
        console.log('Burger Button Clicked');
        $("#sidebar").toggleClass("w-80 w-20");
        $(".sidebar-text").toggleClass("hidden");
        $("#main-content").toggleClass("ml-80 ml-20"); // UPDATED
        $(".school-text").toggleClass("hidden");
    });
});


// DROPDOWN IN INVENTORY
$(document).ready(function() {
    $('.dropdownButton').on('click', function() {
        console.log('Dropdown Button Clicked');
        $(this).next('#dropdownContent').toggleClass('hidden');
        $(this).find('#dropdownIcon').toggleClass('rotate-180');
    });
});

// DELETE BUTTON 
// $(document).on('click', '.deleteButton', function () {
//     const itemId = $(this).closest('tr').data('id'); 
//     const itemCategory = $(this).data('id'); 

//     let url;
//     if (itemCategory === 'deleteEquipment') {
//         url = 'equipment/destroy';
//     } else if (itemCategory === 'deleteSupplies') {
//         url = 'equipment/destroy';
//     } else {
//         console.error('Unknown item category');
//         alert('Unknown item category.');
//         return;
//     }

//     $.ajax({
//         url: url,
//         type: 'POST',
//         data: {
//             _token: '{{ csrf_token() }}',
//             itemID: itemId 
//         },
//         success: function (response) {
//             if (response.success) {
//                 // Remove the item from the table
//                 $('tr[data-id="' + itemId + '"]').remove(); 
//                 alert('Item deleted successfully');
//             } else {
//                 alert('Item not found');
//             }
//         },
//         error: function (xhr) {
//             console.log(xhr.responseText);
//             alert('An error occurred while deleting the item.');
//         }
//     });
// });
