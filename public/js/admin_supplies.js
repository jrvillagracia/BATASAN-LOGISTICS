// Show the form when "Add Item" button is clicked
$(document).ready(function() {
    $('#SupplyFormButton').click(function() {
        console.log('Show Supply Form Button Clicked');
        $('#SupplyFormCard').removeClass('hidden'); // Show the form card
    });

    // Close the form when "Close" button is clicked
    $('#SupplyCloseFormButton').click(function() {
        console.log('Close Form Button Clicked');
        $('#SupplyFormCard').addClass('hidden'); // Hide the form card
    });
});



// Function to add a new item
$('#SupplySaveButton').on('click', function () {
    console.log('Save Button Clicked');
    const name = $('#SupplyName').val().trim();
    const category = $('#SupplyCategory').val().trim();
    const quantity = $('#SupplyQuantity').val().trim();
    const date = $('#SupplyDate').val().trim();
    const price = $('#SupplyPrice').val().trim();
    const department = $('#SupplyDepartment').val().trim();
    const sku = $('#SupplySKU').val().trim();

    if (name === '' || category === '' || quantity === '' || date === '' || price === '' || department === '' || sku === '') {
        Swal.fire({
            icon: "error",
            title: "Oops...",
            showConfirmButton: true,
            text: "Please fill all fields!"
        });
        return;
    }

    // AJAX request to save the data
    $.ajax({
        // url: `/${itemCategory}/store`,
        type: 'POST',
        data: {
            _token: $('input[name="_token"]').val(),
            SupplyName: name,
            SupplyCategory: category,
            SupplyQuantity: quantity,
            SupplyDate: date,
            SupplyPrice: price,
            SupplyDepartment: department,
            SupplySKU: sku
        },
        success: function (response) {
            Swal.fire({
                icon: "success",
                title: response.message,
                showConfirmButton: true
            }).then(() => {
                // Clear input fields
                $('#SupplyForm')[0].reset();
                $('#suppliesForm')[0].reset();
                $('#itemFormCard').addClass('hidden');
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

$('#SupplyCloseFormButton').on('click', function () {
    $('#SupplyFormCard').addClass('hidden');
});