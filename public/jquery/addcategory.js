$(document).ready(function () {
    checkCategoryAvailability();

    //add category modal
    $('#dialogSaveButton').click(function () {
        var categoryName = $('#dialogCategoryInput').val();
        var trimCategoryName = categoryName.trim().toLowerCase();

        var addCategoryroute =  $('script[src$="addcategory.js"]').attr('data-url');

        if (categoryName == "") {
            $("#addCategoryRequire").text("* Category Name is required!");
            return false;
        }

        var duplicateFound = false;
        var selectBoxOptions = document.getElementById("inputState").options;
        for (var i = 0; i < selectBoxOptions.length; i++) {
            if (selectBoxOptions[i].text.trim().toLowerCase() == trimCategoryName) {

                duplicateFound = true;
                break; // Exit the loop early if a duplicate is found
            }
        }

        if (duplicateFound) {
            $("#addCategoryRequire").text("* Category Name is already exist!");
            return;
        }

        // Perform AJAX request to save the category
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: addCategoryroute,
            method: "POST",
            data: {
                "categoryName": categoryName
            },

            success: function (response) {
                // Add the new category option to the select box

                
                response.forEach(function (opt) {
                    $('#removeOption').remove();
                });

                response.forEach(function (opt) {

                    var option = $('<option selected value="' + opt.id + '" id="removeOption">').text(opt.category_name);
                    $('#inputState').append(option);

                    // Hide the dialog box and clear the input
                    $('#myModal').hide();
                    $('#dialogCategoryInput').val('');

                    $('#addCategorysuccess').text('Add category successfully!');

                });

                var latestChildValue = $('#inputState :last-child').val();
                var latestChildText = $('#inputState :last-child').html();

                var optionRemove = $('<option>').text(latestChildText).val(latestChildValue);
                $('#removeSelectBox').append(optionRemove);


                $("#addCategoryRequire").text("");

                $("#noDeleteCategory").text("Choose delete category!");

                // return true;

                // Show success message
                // alert('Category saved successfully');
            },
            error: function (xhr, status, error) {
                // Show error message
                alert('Failed to save category');
                console.log(error)
            }

        });
    });


    function checkCategoryAvailability() {
        var categoryCount = $('#inputState option').length;
        if (categoryCount === 1) {
            $("#registerCategory").text("No category, Please! add.");
            // $("#removeForm").hide();

        }
    }


});

