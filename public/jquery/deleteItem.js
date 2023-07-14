$(document).ready(function () {

    // var buttonId;
    $('.deleteBtn').click(function () {

        var id = $(this).attr('value');
        $('#deleteConfirm').attr('value', id);

        $('.deleteModalClass').css('display', 'block');

    });

    $('.closeBox').click(function () {
        // alert('hello');
        $('.deleteModalClass').css('display', 'none');
    });

    $('.deleteModalClass').click(function () {
        // alert('hello');
        $('.deleteModalClass').css('display', 'none');
    });

    href = "{{ route('delete.item', $row['id']) }}"


})
