$(document).ready(function () {
    $('#itemIdField').on('keyup', function () {
        var searchValue = $(this).val();

        $('#searchResults').css('display', 'block');

        if (searchValue) {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: 'autocomplete',
                type: 'GET',
                dataType: 'json',
                data: {
                    term: searchValue
                },
                success: function (response) {
                    var autocompleteResults = '';

                    response.forEach(function (itemid) {
                        autocompleteResults += '<div class="idhover" id="' + itemid.item_id + '"><span class="autocomplete-text">' + itemid.item_id + '<span></div>';
                    });

                    $('#searchResults').html(autocompleteResults);

                    $('.idhover').click(function () {
                        var itemId = $(this).attr('id');

                        $('#itemIdField').val(itemId);
                        $('#searchResults').css('display', 'none');


                    });
                }

            });
        } else {
            $('#searchResults').html('');
        }
    });

    // $('#itemIdField').focusout(function() {
    //     $('#searchResults').css('display', 'none');
    // });
});
