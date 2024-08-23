// Show the form when "Add Item" button is clicked
$(document).ready(function() {
    // Show the form card when the button is clicked
    $('#EquipFormButton').click(function() {
        console.log('Show Equip Form Button Clicked');
        $('#EquipFormCard').removeClass('hidden'); // Show the form card
    });

    // Hide the form card when the close button is clicked
    $('#EquipCloseFormButton').click(function() {
        console.log('Close Form Button Clicked');
        $('#EquipFormCard').addClass('hidden'); // Hide the form card
    });
});


// Function to add a new Equipment
$(document).ready(function() {
    $('#EquipmentSaveButton').on('click', function () {
        console.log('Save Button Clicked');

        const name = $('#EquipmentName').val().trim();
        const category = $('#EquipmentCategory').val();
        const quantity = $('#EquipmentQuantity').val().trim();
        const date = $('#EquipmentDate').val().trim();
        const price = $('#EquipmentPrice').val().trim();
        const department = $('#EquipmentDepartment').val();
        const sku = $('#EquipmentSKU').val().trim();

        if (name === '' || category === '' || quantity === '' || date === '' || price === '' || department === '' || sku === '') {
            Swal.fire({
                icon: "error",
                title: "Oops...",
                text: "Please fill all fields!",
                showConfirmButton: true
            });
            return;
        }

        // AJAX request to save the data
        $.ajax({
            url: '/equipment/store',  // Corrected URL
            type: 'POST',
            data: {
                _token: $('input[name="_token"]').val(),  // CSRF token
                EquipmentName: name,
                EquipmentCategory: category,
                EquipmentQuantity: quantity,
                EquipmentDate: date,
                EquipmentPrice: price,
                EquipmentDepartment: department,
                EquipmentSKU: sku
            },
            success: function (response) {
                Swal.fire({
                    icon: "success",
                    title: response.message,
                    showConfirmButton: true
                }).then(() => {
                    // Clear input fields and hide the form
                    $('#EquipmentForm')[0].reset();
                    $('#EquipFormCard').addClass('hidden');
                });
            },
            error: function (xhr) {
                Swal.fire({
                    icon: "error",
                    title: "Error",
                    text: xhr.responseText
                });
            }
        });
    });
});


$('#EquipCloseFormButton').on('click', function () {
    $('#EquipFormCard').addClass('hidden');
});



