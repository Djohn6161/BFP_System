$(document).ready(function () {
    $(".truck-deployed").select2();
    $(".driver").select2();
    $(".team-leader").select2();
    $(".crew-name").select2();
    $(".barangay").select2();
    $(".caller").select2({tags: true});
    //operation designation
    $(".designationSelect").select2();
    $(".designationSelectEdit").select2({tags: true});

    // personnel select2
    $(".designation_select_edit").select2();
    $(".designation-select").select2({dropdownParent: $("#addPersonnelModal")});
    $(".rankSelect").select2({dropdownParent: $("#addPersonnelModal")});
    $(".rankSelectEdit").select2();
    $(".edit-designation-select").select2({
        tags: true,
    });
    $(".officeAddressCaller").select2();
    $(".personnelReceive").select2();
    $(".barangayApor").select2();
    $(".zoneApor").select2();
    $(".engineDispatched").select2({
        tags: true,
    });
    $(".alarmStatus").select2();
    $(".alarmApor").select2();
    $(".fundCommander").select2();
    $(".typeOccupancy").select2({tags: true});
    $(".specify").select2();
    $(".rankName").select2();
    $(".designation").select2({tags: true});
    $(".designationSelect").select2({tags: true});
    $("#barangay-select").select2();
    $("#userschoice").select2({dropdownParent: $("#generatePasscodeModal")});
    
    new DataTable('#barangayTable');
});
