// Show the form when "Add Item" button is clicked
$(document).ready(function() {
    $('#SuppliesFormButton').click(function() {
        console.log('Show Supplies Form Button Clicked');
        $('#SuppliesFormCard').removeClass('hidden'); // Show the form card
    });

    // Close the form when "Close" button is clicked
    $('#SuppliesCloseFormButton').click(function() {
        console.log('Close Form Button Clicked');
        $('#SuppliesFormCard').addClass('hidden'); // Hide the form card
    });
});



// Function to add a new Supplies
$(document).ready(function() {
    console.log("admin_supplies.js loaded");
    $('#SuppliesSaveButton').on('click', function () {
        console.log('Save Button Clicked');

        const name = $('#SuppliesName').val().trim();
        const category = $('#SuppliesCategory').val();
        const quantity = $('#SuppliesQuantity').val().trim();
        const date = $('#SuppliesDate').val().trim();
        const price = $('#SuppliesPrice').val().trim();
        const department = $('#SuppliesDepartment').val();
        const sku = $('#SuppliesSKU').val().trim();

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
            url: '/supplies/store',  // Ensure the URL matches the route name
            type: 'POST',
            data: {
                _token: $('input[name="_token"]').val(),  // Include the CSRF token
                SuppliesName: name,
                SuppliesCategory: category,
                SuppliesQuantity: quantity,
                SuppliesDate: date,
                SuppliesPrice: price,
                SuppliesDepartment: department,
                SuppliesSKU: sku
            },
            success: function (response) {
                Swal.fire({
                    icon: "success",
                    title: response.message,
                    showConfirmButton: true
                }).then(() => {
                    // Clear input fields
                    $('#SuppliesForm')[0].reset();
                    $('#SuppliesFormCard').addClass('hidden');
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


$('#SuppliesCloseFormButton').on('click', function () {
    $('#SuppliesFormCard').addClass('hidden');
});