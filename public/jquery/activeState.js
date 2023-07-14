$(document).ready(function () {

    // var buttonId;
    $('.activeBtn').click(function () {

        var selctValue = $(this).attr('value');
        $('#changeState').val(selctValue);
        // var selctValue = $(this).val();
        // alert(selctValue);

        console.log(selctValue);


        var buttonId = $(this).find('.activeInactiveBtn').attr('id');

        $('.myActivInactiveModalClass').css('display', 'block');

        $('#changeState').click(function () {
            var selctValue = $(this).val();

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: `item-lists/deleted-at`,
                method: "PUT",
                data: {
                    selctValue: selctValue,
                },


                success: function (response) {

                    if (response.success == true) {
                        $('.alert-success').show(); 
                        location.reload();

                    } else if(response.success == false){
                        $('.alert-danger').show();
                        location.reload();
                    }else{
                        $('.alert-danger').show();
                        location.reload();
                    }


                }
            });


            // alert(value);
            // alert('hello');
        });


    });

    $('.closeBox').click(function () {
        // alert('hello');
        $('.myActivInactiveModalClass').css('display', 'none');
    });

    $('.myActivInactiveModalClass').click(function () {
        // alert('hello');
        $('.myActivInactiveModalClass').css('display', 'none');
    });


})
