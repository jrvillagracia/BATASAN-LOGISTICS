

$(document).ready(function () {
    let itemsPerPage = 5;
    let currentPage = 1;
    let items = [];

    // Show the form when "Add Item" button is clicked
    $('#showFormButton').click(function() {
        console.log('Show Form Button Clicked');
        $('#itemFormCard').removeClass('hidden'); // Show the form card
    });

    // Close the form when "Close" button is clicked
    $('#closeFormButton').click(function() {
        console.log('Close Form Button Clicked');
        $('#itemFormCard').addClass('hidden'); // Hide the form card
    });


    // Function to render the table rows based on the current page
    function renderTable() {

        // console.log('Rendering Table');
        // const start = (currentPage - 1) * itemsPerPage;
        // const end = start + itemsPerPage;
        // const visibleItems = items.slice(start, end);

        // $('#tableBody').empty();
        // visibleItems.forEach((item, index) => {
        //     const row = `
        //         <tr class="cursor-pointer table-row " data-index="${start + index}" data-id="{{$item->id}}">
        //             <td class="px-6 py-3">${item.name}</td>
        //             <td class="px-6 py-3">${item.category}</td>
        //             <td class="px-6 py-3">${item.quantity}</td>
        //             <td class="px-6 py-3">${item.date}</td>
        //             <td class="px-6 py-3">${item.price}</td>
        //             <td class="px-6 py-3">${item.department}</td>
        //             <td class="px-6 py-3">${item.sku}</td>
        //         </tr>
        //     `;
        //     $('#tableBody').append(row);
        // });

        // renderPagination();
    }

    // $(document).ready(function() {

    //     $('.button').on('click', function() {
    //         $('.button').removeClass('border-blue-500 translate-x-2');
    //         $(this).addClass('border-blue-500 translate-x-2');
    //     });
    // });

    // Function to update pagination
    function renderPagination() {
        // console.log('Rendering Pagination');
        // const totalItems = items.length;
        // const totalPages = Math.ceil(totalItems / itemsPerPage);

        // $('#pagination').empty();

        // if (totalPages > 1) {
        //     for (let i = 1; i <= totalPages; i++) {
        //         $('#pagination').append(`
        //             <li>
        //                 <a href="#" data-page="${i}" class="pagination-link flex items-center justify-center px-3 h-8 ${i === currentPage ? 'text-blue-600 bg-blue-50' : 'text-gray-500 bg-white'} border border-gray-300 hover:bg-gray-100 hover:text-gray-700">${i}</a>
        //             </li>
        //         `);
        //     }

        //     // Bind click event after adding pagination links
        //     $(document).on('click', '.pagination-link', function (e) {
        //         e.preventDefault();
        //         currentPage = $(this).data('page');
        //         renderTable()
        //     });
        // }

        // $('#currentPage').text(currentPage);
        // $('#totalPages').text(totalPages);
    }

    // Function to add a new item
    $('#saveButton').on('click', function () {
        console.log('Save Button Clicked');
        const name = $('#productName').val().trim();
        const category = $('#productCategory').val().trim();
        const quantity = $('#productQuantity').val().trim();
        const date = $('#productDate').val().trim();
        const price = $('#productPrice').val().trim();
        const department = $('#productDepartment').val().trim();
        const sku = $('#productSKU').val().trim();
        const itemCategory = $(this).data('id');

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
            url: `/${itemCategory}/store`,
            type: 'POST',
            data: {
                _token: $('input[name="_token"]').val(),
                productName: name,
                productCategory: category,
                productQuantity: quantity,
                productDate: date,
                productPrice: price,
                productDepartment: department,
                productSKU: sku
            },
            success: function (response) {
                Swal.fire({
                    icon: "success",
                    title: response.message,
                    showConfirmButton: true
                }).then(() => {
                    // Clear input fields
                    $('#equipmentForm')[0].reset();
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

    $('#closeFormButton').on('click', function () {
        $('#itemFormCard').addClass('hidden');
    });

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

//FUNCTION FOR REGISTER VALIDATION 
$(document).ready(function() {
    // Regular expressions for validation
    var idPattern = /^(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&#])[A-Za-z\d@$!%*?&#]{8,}$/;
    var passwordPattern = /^(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&#])[A-Za-z\d@$!%*?&#]{8,}$/;

    function validateForm() {
        var isValid = true;

        // Get field values
        var employeeId = $('#employee_id').val();
        var email = $('#email').val();
        var password = $('#password').val();

        // Clear previous errors
        $('#employeeIdError').text('');
        $('#emailError').text('');
        $('#passwordError').text('');

        // Direct validation for Employee ID
        if (!idPattern.test(employeeId)) {
            $('#employeeIdError').text('Employee ID must be at least 8 characters long and include an uppercase letter, a number, and a special character.');
            isValid = false;
        }

        // Direct validation for Password
        if (!passwordPattern.test(password)) {
            $('#passwordError').text('Password must be at least 8 characters long and include an uppercase letter, a number, and a special character.');
            isValid = false;
        }

        return isValid;
    }

    $('#registerForm').on('submit', function(event) {
        event.preventDefault(); // Prevent default form submission

        if (validateForm()) {
            var employeeId = $('#employee_id').val();
            var email = $('#email').val();
            var password = $('#password').val();

            // AJAX request to validate employee_id and email
            $.ajax({
                url: '/register/check',
                method: "POST",
                data: {
                    employee_id: employeeId,
                    email: email,
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    var errors = [];

                    if (response.exists.employee_id) {
                        errors.push('Employee ID is already registered.');
                        $('#employee_id').focus();
                    }
                    if (response.exists.email) {
                        errors.push('Email is already registered.');
                        if (!response.exists.employee_id) {
                            $('#email').focus();
                        }
                    }

                    if (errors.length > 0) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: errors.join(' '),
                        });
                    } else {
                        // Submit the form data via AJAX if validation passes
                        $.ajax({
                            url: '/register',
                            method: "POST",
                            data: {
                                employee_id: employeeId,
                                email: email,
                                password: password,
                                _token: $('meta[name="csrf-token"]').attr('content')
                            },
                            success: function(response) {
                                // Handle successful registration
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Registered Successfully',
                                    showConfirmButton: false,
                                    timer: 1500
                                }).then(function() {
                                    window.location.href = '/employee/login';
                                });
                            },
                            error: function(xhr) {
                                console.log(xhr.responseText);
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Oops...',
                                    text: 'There was an error during registration. Please try again.',
                                });
                            }
                        });
                    }
                },
                error: function(xhr) {
                    console.log(xhr.responseText);
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'There was an error checking availability. Please try again.',
                    });
                }
            });
        }
    });
});



// FUNCTION FOR LOGIN VALIDATION 
$(document).ready(function() {
    $('#loginForm').on('submit', function(e) {
        e.preventDefault();

        // Capture the form input values
        var employee_id = $('#employee_id').val();
        var password = $('#password').val();
        var token = $('meta[name="csrf-token"]').attr('content');

        $.ajax({
            url: '/login/check',
            type: 'POST',
            data: {
                employee_id: employee_id,
                password: password,
                _token: token
            },
            success: function(response) {
                if (response.success) {
                    // Show SweetAlert for successful login
                    Swal.fire({
                        icon: 'success',
                        title: 'Login Successful',
                        text: 'You will be redirected to the dashboard shortly.',
                        timer: 2000, // 2 seconds timer before redirection
                        showConfirmButton: false
                    }).then(function() {
                        window.location.href = '/admin/dashboard';
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: response.message
                    });
                }
            },
            error: function(xhr) {
                console.log(xhr.responseText);
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Invalid Credentials'
                });
            }
        });
    });
});

