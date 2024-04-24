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
