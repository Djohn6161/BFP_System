$(document).ready(function () {
    $(".truck-deployed").select2();
    $(".driver").select2();
    $(".team-leader").select2();
    $(".crew-name").select2();
    $(".barangay").select2();
    $(".caller").select2({tags: true});
    $(".officeAddressCaller").select2();
    $(".personnelReceive").select2();
    $(".barangayApor").select2();
    $(".zoneApor").select2();
    $(".engineDispatched").select2();
    $(".alarmStatus").select2();
    $(".alarmApor").select2();
    $(".fundCommander").select2();
    $(".typeOccupancy").select2();
    $(".specify").select2();
    $(".rankName").select2();
    $(".form-select").select2();


    

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
    $("#barangay-select").select2();
});
