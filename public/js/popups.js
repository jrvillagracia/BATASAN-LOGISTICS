$(document).ready(function() {

    $('#editEquipButton').on('click', function(e) {
        e.preventDefault(); // Prevent any default behavior
        $('#editEquipModal').removeClass('hidden');
    });

    // Hide the modal when the close button is clicked
    $('#closeEquipFormButton').on('click', function() {
        $('#editEquipModal').addClass('hidden');
    });

    // Hide the modal if the user clicks outside of it (but not on the modal content)
    $(window).on('click', function(e) {
        if ($(e.target).is('#editEquipModal')) {
            $('#editEquipModal').addClass('hidden');
        }
    });

    // Prevent the modal from closing when clicking inside the modal content
    $('#editSuppModal .bg-white').on('click', function(e) {
        e.stopPropagation();
    });


    // Show the modal when the edit button is clicked
    $('#editSuppButton').on('click', function(e) {
        e.preventDefault(); // Prevent any default behavior
        $('#editSuppModal').removeClass('hidden');
    });

    // Hide the modal when the close button is clicked
    $('#closeSuppFormButton').on('click', function() {
        $('#editSuppModal').addClass('hidden');
    });

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


$('#saveEquipButton').click(function(e) {
    e.preventDefault(); // Prevent the default form submission

    // Your AJAX request or other logic to save the item goes here
    
    // On success (after your item is successfully saved)
    Swal.fire({
        icon: "success",
        title: "Item saved successfully!",
        showConfirmButton: false,
        timer: 1500
    });
    
});

$('#saveSuppButton').click(function(e) {
    e.preventDefault(); // Prevent the default form submission

    // Your AJAX request or other logic to save the item goes here

    // On success (after your item is successfully saved)
    Swal.fire({
        icon: "success",
        title: "Item saved successfully!",
        showConfirmButton: false,
        timer: 1500
    });
    
});