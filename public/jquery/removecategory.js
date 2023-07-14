$(document).ready(function () {
    var deleteCategoryroute =  $('script[src$="removecategory.js"]').attr('data-url');

    // Show message on form load
    checkCategoryAvailability();

    ////*** minus button show remove category modla box */
    $('#removeCategoryButton').click(function () {

        //remove category with moddl box
        var selectedValue = $('#removeSelectBox').val();

        if(selectedValue === "notselect"){
            $('#notSeledctCategory').text('Not category selected!');
            return false;
        }

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: deleteCategoryroute,
            method: "POST",
            data: {
                "selectedValue": selectedValue,
            },

            success: function (response) {

                // Remove the selected option from the select box
                $('#inputState option[value="' + selectedValue + '"], #removeSelectBox option[value="' + selectedValue + '"]').remove();

                // Hide the remove dialog box
                $('#categoryRemoveModal').hide();
           
            },
            error: function (xhr, status, error) {
                console.log(error)
                // Show error message
                //  alert('Failed to delete category');
            },

        });

    });

    function checkCategoryAvailability() {
        var categoryCount = $('#removeSelectBox option').length;
        if (categoryCount === 1) {
            $("#noDeleteCategory").text("No deleteable category *");
            // $("#removeForm").hide();

        } 
    }

});