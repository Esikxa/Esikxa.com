jQuery(function () {
    'use strict';

    $('#set-client').on('change', function () {
        var action = $(this).data('action');
        var selectedValue = $(this).val();
        if (selectedValue != '') {
            $.ajax({
                url: action,
                type: 'GET',
                data: { clientId: selectedValue },
                success: function (response) {
                    if (response.code == 1) {
                        Swal.fire({
                            title: 'Success',
                            text: response.message,
                            icon: 'success',
                            timer: 3000,
                            showConfirmButton: false,
                        });
                        setTimeout(function () {
                            location.reload();
                        }, 3000);
                    } else {
                        Swal.fire({
                            title: 'Error',
                            text: response.message,
                            icon: 'error',
                            timer: 3000,
                            showConfirmButton: false,
                        });
                        setTimeout(function () {
                            location.reload();
                        }, 3000);
                    }
                },
                error: function (xhr, status, error) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops!',
                        text: 'Something went wrong. Failed to set client session.'
                    });
                }
            });
        }
    })
});