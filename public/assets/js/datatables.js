$('#myTable').DataTable();

$("#minimalModalTable").DataTable();
$("#spotModalTable").DataTable();
$("#progressModalTable").DataTable();
$("#finalModalTable").DataTable();
$("#operationTable").DataTable();
$("#alarmTable").DataTable();
$("#investigationTable").DataTable();
$("#trashOperationTable").DataTable();
$("#trashInvestigationTable").DataTable();
$("#allInvestigation").DataTable();
$("#spotInvestigationTable").DataTable();
$("#minimalInvestigationTable").DataTable({
    // "scrollY": "500px",
    "order": [[2, "asc"]]
  });
$("#progressInvestigationTable").DataTable({
  "ordering": false,
});
$("#finalInvestigationTable").DataTable({
  "ordering": false,
});
$("#rankTable").DataTable({
  "ordering": false,
});
$("#adminAccount").DataTable({
  "ordering": false,
});
$("#barangayTable").DataTable({
  "ordering": false,
});
$("#trucksTable").DataTable({
  "ordering": false,
});
$("#invesLog").DataTable();
