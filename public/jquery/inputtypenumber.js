// Get the input element
var myNumberInput = document.getElementById("myNumber");

// Add an event listener to the input element
myNumberInput.addEventListener("input", function () {
    // If the input value is negative, set it to zero
    if (myNumberInput.value < 0) {
        myNumberInput.value = 0;
    }
});