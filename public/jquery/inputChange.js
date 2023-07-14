$(document).ready(function () {
    $('#itemIdField').keyup(function () {
        var itemId = $(this).val();
        $('#pdfItemId').val(itemId);
        $('#excelItemId').val(itemId);

    });

    $('#itemCode').keyup(function () {
        var itemCode = $(this).val();
        $('#pdfItemCode').val(itemCode);
        $('#excelItemCode').val(itemCode);

    });

    $('#itemName').keyup(function () {
        var itemName = $(this).val();
        $('#pdfItemName').val(itemName);
        $('#excelItemName').val(itemName);

    });

    $('#category').change(function () {
        var selectedValue = $(this).val();
        $('#pdfCategory').val(selectedValue);
        $('#excelCategory').val(selectedValue);

    });



    var urlParams = new URLSearchParams(window.location.search);
    var itemId = urlParams.get('itemId');
    var itemCode = urlParams.get('itemCode');
    var itemName = urlParams.get('itemName');
    var category = urlParams.get('category');
    var paginationPage = urlParams.get('page');

    console.log(paginationPage);


    $('#itemIdField').val(itemId);
    $('#itemCode').val(itemCode);
    $('#itemName').val(itemName);
    $('#category').val(category);

    $('#pdfItemId').val(itemId);
    $('#pdfItemCode').val(itemCode);
    $('#pdfItemName').val(itemName);
    $('#pdfCategory').val(category);

    $('#excelItemId').val(itemId);
    $('#excelItemCode').val(itemCode);
    $('#excelItemName').val(itemName);
    $('#excelCategory').val(category);

    $('#paginationPage').val(paginationPage);

   
    


});