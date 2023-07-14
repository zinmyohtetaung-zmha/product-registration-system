$(document).ready(function () {
    $('input[name="formSelector"]').on('change', function () {
        var selectedFormId = $(this).val();

        // Hide all forms
        $('.form').hide();

        // Show the selected form
        $('#' + selectedFormId).show();
    });


    $('#removeImage').click(function () {
        // Reset the value of the file input
        $('#uploadImage').val('');
        // Clear the image output
        $('#uploadPreview').attr('src', null);
    });


    $('#normalRegisterText').click(function () {
        $('#form2').hide();
        $('#form1').show();
        $('input[name="formSelector"][value="form1"]').prop('checked', true);
    });

    $('#excelRegisterText').click(function () {
        $('#form1').hide();
        $('#form2').show();
        $('input[name="formSelector"][value="form2"]').prop('checked', true);

    });

});


// $(document).ready(function () {
//     $('#redioText').on('change', function () {
//         var selectedFormId = $(this).val();

//         // Hide all forms
//         $('.form').hide();

//         // Show the selected form
//         $('#' + selectedFormId).show();
//     });


//     $('#removeImage').click(function () {
//         // Reset the value of the file input
//         $('#uploadImage').val('');
//         // Clear the image output
//         $('#uploadPreview').attr('src',null);
//     });

// });
