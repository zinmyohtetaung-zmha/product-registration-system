$(document).ready(function () {

    // var buttonId;
    $('.inactiveBtn').click(function () {

        var selctValue = $(this).attr('value');

        $('.myInactiveModalClass').css('display', 'block');

        $('#inactiveChangeState').click(function () {

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: `item-lists/deleted-at/inactive/${selctValue}`,
                method: "PUT",
                data: {
                    // "btnVlue": btnVlue
                },

                success: function (response) {

                    if (response.success == true) {
                        $('.alert-success').show();
                        location.reload();

                    } else if (response.success == false) {
                        $('.alert-danger').show();
                        location.reload();
                    } else {
                        $('.alert-danger').show();
                        location.reload();
                    }

                }
            });


        });


    });

    $('.closeBox').click(function () {
        // alert('hello');
        $('.myInactiveModalClass').css('display', 'none');
    });

    $('.myInactiveModalClass').click(function () {
        // alert('hello');
        $('.myInactiveModalClass').css('display', 'none');
    });


})
