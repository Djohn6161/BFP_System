$(document).ready(function () {
    // FOR REMOVING THE IMAGE
    // $(".remove-button").on("click", function () {
    //     $(this).closest(".col-md-4").remove();
    // });
    
    
    // Function to handle input event on the time input field
    $('#alarmReceivedInput').on('input', function() {
        // Get the current value of the input field
        var inputValue = $(this).val();
        
        // Remove any colons (":") from the input value
        var cleanedValue = inputValue.replace(':', '');

        // Update the input field value with the cleaned value
        $(this).val(cleanedValue);
    });
});

window.addEventListener('load', function() {
    const loader = document.querySelector('.loader');
    loader.classList.add('fade-out');
    
    // Optionally, remove the loader from the DOM after the transition ends
    loader.addEventListener('transitionend', function() {
        loader.style.display = 'none';
    });
});

