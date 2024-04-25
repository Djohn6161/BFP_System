<style>
    /* Styling for table cells in editing mode */
    .editing td {
        background-color: #ffffff;
        border: 1px solid #4d90fe;
        transition: background-color 0.3s, border-color 0.3s;
    }

    .editing td:focus {
        background-color: #f5f9ff;
        border-color: #4d90fe;
        outline: none;
    }
</style>

<!-- Modal -->
<div class="modal fade" data-bs-backdrop="static" id="viewPersonnelModal" tabindex="-1" aria-labelledby="viewPersonnelModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="viewPersonnelModalLabel">Personal Information</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <!-- Alert -->
                    <div class="alert alert-success d-none position-absolute top-0 end-0 z-5 w-40" role="alert" id="successAlert">
                        Information saved successfully.
                    </div>
                    <div class="row">
                        <div class="col-md-4 d-flex justify-content-center align-items-center" id="photoSection">
                            <img src="{{ asset('assets/images/logos/Tin.jpg') }}" class="object-fit-cover p-2 g-col-6 img-fluid" style="width: 300px; height: 400px;" alt="Personnel Picture">
                        </div>
                        <div class="col-md-8" id="content">
                            <table class="table table-bordered" id="infoTable">
                                <tbody id="infoTable">
                                    <tr>
                                        <th scope="row">Department</th>
                                        <td contenteditable="false">IT Department</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Rank</th>
                                        <td contenteditable="false">Sergeant</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Name</th>
                                        <td contenteditable="false">Don John Daryl Curativo</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Date of Birth</th>
                                        <td contenteditable="false" type="date">January 10, 2000</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Gender</th>
                                        <td contenteditable="false">Male</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Address</th>
                                        <td contenteditable="false">Santiago Old Nabua, Camarines Sur</td>
                                    </tr>
                                    <!-- Additional Fields -->
                                    <tr>
                                        <th scope="row">Account Number</th>
                                        <td contenteditable="false"></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Item Number</th>
                                        <td contenteditable="false"></td>
                                    </tr>
                                    <!-- Add more fields as needed -->
                                </tbody>
                            </table>
                            <form id="editForm" class="d-none"></form>
                        </div>
                        <button type="button" class="btn btn-primary" id="uploadPhotoButton">Upload Photo</button>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" id="closeButton" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="editButton">Edit Information</button>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        function replaceTableWithForm() {
            $('#infoTable').addClass('d-none');
            $('#editForm').removeClass('d-none');
            $('#uploadPhotoButton').removeClass('d-none');

            var departmentOptions = ['IT Department', 'FSES'];
            var genderOptions = ['Male', 'Female'];
            var rankOptions = ['Private', 'Corporal'];
            var departmentSelectOptions = '';
            $.each(departmentOptions, function(index, option) {
                departmentSelectOptions += `<option value="${option}">${option}</option>`;
            });

            var genderSelectOptions = '';
            $.each(genderOptions, function(index, option) {
                genderSelectOptions += `<option value="${option}">${option}</option>`;
            });

            var rankSelectOptions = '';
            $.each(rankOptions, function(index, option) {
                rankSelectOptions += `<option value="${option}">${option}</option>`;
            });

            var formFields = '';
            $('#infoTable tbody tr').each(function(index, row) {
                var label = $(row).find('th').text();
                var value = $(row).find('td').text();
                if (label === 'Rank') {
                    formFields += `
                        <div class="row mb-3">
                            <label for="${label.toLowerCase().replace(/\s/g, '_')}" class="col-sm-2 col-form-label">${label}</label>
                            <div class="col-sm-10">
                                <select class="form-select" id="${label.toLowerCase().replace(/\s/g, '_')}">
                                    ${rankSelectOptions}
                                </select>
                            </div>
                        </div>
                    `;
                } else if (label === 'Date of Birth') {
                    formFields += `
                        <div class="row mb-3">
                            <label for="${label.toLowerCase().replace(/\s/g, '_')}" class="col-sm-2 col-form-label">${label}</label>
                            <div class="col-sm-10">
                                <input type="date" class="form-control" id="${label.toLowerCase().replace(/\s/g, '_')}" value="${value}">
                            </div>
                        </div>
                    `;
                } else if (label === 'Department') {
                    formFields += `
                        <div class="row mb-3">
                            <label for="${label.toLowerCase().replace(/\s/g, '_')}" class="col-sm-2 col-form-label">${label}</label>
                            <div class="col-sm-10">
                                <select class="form-select" id="${label.toLowerCase().replace(/\s/g, '_')}">
                                    ${departmentSelectOptions}
                                </select>
                            </div>
                        </div>
                    `;
                } else if (label === 'Gender') {
                    formFields += `
                        <div class="row mb-3">
                            <label for="${label.toLowerCase().replace(/\s/g, '_')}" class="col-sm-2 col-form-label">${label}</label>
                            <div class="col-sm-10">
                                <select class="form-select" id="${label.toLowerCase().replace(/\s/g, '_')}">
                                    ${genderSelectOptions}
                                </select>
                            </div>
                        </div>
                    `;
                } else {
                    formFields += `
                        <div class="row mb-3">
                            <label for="${label.toLowerCase().replace(/\s/g, '_')}" class="col-sm-2 col-form-label">${label}</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="${label.toLowerCase().replace(/\s/g, '_')}" value="${value}">
                            </div>
                        </div>
                    `;
                }
            });

            $('#editForm').html(formFields);

            $('#editButton').text('Save Changes').removeClass('btn-primary').addClass('btn-success').attr('id',
                'saveChangesButton').attr('type', 'submit');

            $('#closeButton').text('Cancel').removeAttr('data-bs-dismiss').attr('id', 'cancelButton').attr(
                'type', 'button').off('click').on('click', function() {
                $('#editForm').addClass('d-none');
                $('#infoTable').removeClass('d-none');

                $('#saveChangesButton').text('Edit Information').removeClass('btn-success').addClass(
                    'btn-primary').attr('id', 'editButton').attr('type', 'button');

                var closeButton = $('<button>').attr('type', 'button').addClass('btn btn-secondary')
                    .attr('data-bs-dismiss', 'modal').attr('id', 'closeButton').text('Close');
                $('#cancelButton').replaceWith(closeButton);

                $('#uploadPhotoButton').addClass('d-none'); // Hide the Upload Photo button when canceling
            });
        }

        $('#editButton').on('click', function() {
            replaceTableWithForm();
        });

        var saveChangesButton = $('#saveChangesButton');
        if (saveChangesButton.length) {
            saveChangesButton.on('click', function() {
                $('#successAlert').removeClass('d-none');
            });
        }
    });
</script>
