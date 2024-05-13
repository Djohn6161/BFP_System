$(document).ready(function () {
    $(".truck-deployed").select2();
    $(".driver").select2();
    $(".team-leader").select2();
    $(".crew-name").select2();
    $(".barangay").select2();
    $(".caller").select2({tags: true});
    $(".designation-select").select2({dropdownParent: $("#addPersonnelModal")});
    $(".designation-select-edit").select2();
    $(".edit-designation-select").select2({
        tags: true,
    });
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
    $(".designation").select2({tags: true});
    $("#barangay-select").select2();
    new DataTable('#barangayTable');
});
