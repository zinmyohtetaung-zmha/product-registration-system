$(document).ready(function () {
    // Get the modal
    var modal = document.getElementById("myModal");
    var categoryRemvoeModal = document.getElementById("categoryRemoveModal");



    // Get the button that opens the modal
    var btn = document.getElementById("myBtn");
    var categoryRemoveBtn = document.getElementById("categoryRemoveBtn");



    // Get the <span> element that closes the modal
    var span = document.getElementsByClassName("close")[0];
    var closeRemove = document.getElementsByClassName("closeRemove")[0];



    // When the user clicks the button, open the modal
    btn.onclick = function () {
        modal.style.display = "block";
    }

    categoryRemoveBtn.onclick = function () {
        categoryRemvoeModal.style.display = "block";
    }

    // When the user clicks on <span> (x), close the modal
    span.onclick = function () {
        modal.style.display = "none";
        $("#addCategoryRequire").text("");
        // $("#inputField").val("");
        $('#dialogCategoryInput').val('');


    }

    closeRemove.onclick = function () {
        categoryRemvoeModal.style.display = "none";
        $("#addCategoryRequire").text("");
    }

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function (event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }

});