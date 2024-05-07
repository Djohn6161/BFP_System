<style>
    .btn-reports {
        width: 200px
    }
</style>
@extends('layouts.user-template')
@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-lg-11 p-4">
                <form method="POST" action="{{ route('profile.update') }}">
                    @csrf
                    <div class="row">
                        <div class="row border border-light-subtle shadow rounded p-4 mb-4">
                            <h3 class="border-bottom border-4 border-secondary pb-2 mb-3">My Profile</h3>
                            <div class="col-lg-4">
                                <div class="col-lg-12 mb-3"> <!-- Photo column -->
                                    <img id="personnel-picture" src="/assets/images/personnel_images/"
                                        class="object-fit-cover img-fluid w-100" style="height: 340px;"
                                        alt="Personnel Picture">
                                    <div class="row px-2">
                                        <label for="photo-upload" class="btn btn-primary mt-2">Change Photo</label>
                                        <input type="file" id="photo-upload" style="display: none;" accept="image/*"
                                            onchange="previewPhoto(event)" name="image">
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-8">
                                <div class="row">
                                    <div class="col-lg-4 mb-3">
                                        <label for="accountNumber" class="form-label">Account Number</label>
                                        <input type="hidden" name="personnel_id" value="">
                                        <input type="text" placeholder="Enter account number" class="form-control"
                                            id="accountNumber" name="account_number" value="">
                                    </div>
                                    <div class="col-lg-4 mb-3">
                                        <label for="itemNumber" class="form-label">Item Number</label>
                                        <input type="text" placeholder="Enter item number" class="form-control"
                                            id="itemNumber" name="item_number" value="">
                                    </div>
                                    <div class="col-lg-4 mb-3">
                                        <label for="rank" class="form-label">Rank</label>
                                        <select class="form-select" id="rank" name="rank">
                                            <option selected>Select Rank</option>

                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-12 mb-3">
                                    <input type="text" class="form-control" hidden name="user_id" id="user_id"
                                    value="{{ $user->id }}">
                                <label for="inputName" class="form-label">Name</label>
                                <input type="text" class="form-control" name="name" id="name"
                                    value="{{ $user->name }}">
                                </div>
                                <div class="row">
                                    <div class="col-lg-4 mb-3">
                                        <label for="dateOfBirth" class="form-label">User Type</label>
                                        <input type="text" class="form-control" name="type" id="type"
                                            value="{{ $user->type }}">
                                    </div>
                                    <div class="col-lg-4 mb-3">
                                        <label for="inputEmail" class="form-label">Email</label>
                                        <input type="email" class="form-control" name="email" id="email"
                                            value="{{ $user->email }}">
                                    </div>
                                    <div class="col-lg-4 mb-3">
                                        <label for="dateOfBirth" class="form-label">Date of Birth</label>
                                        <input type="date" class="form-control" id="dateOfBirth" name="date_of_birth"
                                            value="">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-4 mb-3">
                                        <label for="maritalStatus" class="form-label">Marital Status</label>
                                        <select class="form-select" id="maritalStatus">
                                            <option selected>Select marital status</option>

                                        </select>
                                    </div>
                                    <div class="col-lg-4 mb-3">
                                        <label for="gender" class="form-label">Gender</label>
                                        <select class="form-select" id="gender" name="gender">
                                            <option value="">Select gender</option>

                                        </select>
                                    </div>
                                    <div class="col-lg-4 mb-3">
                                        <label for="religion" class="form-label">Religion</label>
                                        <input type="text" placeholder="Enter religion" class="form-control"
                                            id="religion" name="religion" value="">
                                    </div>
                                </div>

                                <div class="col-lg-12 mb-3">
                                    <label for="completeAddress" class="form-label">Complete Address</label>
                                    <input type="text" placeholder="Enter complete address" class="form-control"
                                        id="completeAddress" name="address" value="">
                                </div>
                            </div>

                            <h3 class="border-bottom border-4 border-secondary pb-2 mb-3">Educational Details</h3>
                            <div class="col-lg-6 mb-3">
                                <div class="col-lg-12">
                                    <div class="row m-0 p-0">
                                        <div class="col-lg-6 m-0 p-0">
                                            <label for="tertiaryCourses" class="form-label ">Tertiary Course/s</label>
                                            <button type="button" class="btn btn-sm btn-primary ms-3"
                                                id="editTertiaryCourse">+ ADD</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="row m-0 p-0" id="editTertiaryCourseContainer">
                                    <div class="col-lg-12 px-0 mb-3">
                                    </div>
                                    <!-- Input fields will be appended here -->
                                </div>
                            </div>
                            <div class="col-lg-6 mb-3">
                                <div class="col-lg-12">
                                    <div class="row m-0 p-0">
                                        <div class="col-lg-6 m-0 p-0">
                                            <label for="postGraduateCourses" class="form-label">Post Graduate
                                                Course/s</label>
                                            <button type="button" class="btn btn-sm btn-primary ms-3"
                                                id="editPostGraduateCourses">+ ADD</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="row m-0 p-0" id="editPostGraduateCoursesContainer">
                                    <div class="col-lg-12 px-0 mb-3">
                                    </div> <!-- Input fields will be appended here -->
                                </div>
                            </div>
                            <div class="col-lg-6 mb-3">
                                <label for="highestEligibility" class="form-label">Highest Eligibility</label>
                                <input type="text" placeholder="Enter highest eligibility" class="form-control"
                                    id="highestEligibility" value="" name="highest_eligibility">
                            </div>
                            <div class="col-lg-6 mb-3">
                                <label for="highestTraining" class="form-label">Highest Training</label>
                                <input type="text" placeholder="Enter highest training" class="form-control"
                                    id="highestTraining" value="" name="highest_training">
                            </div>
                            <div class="col-lg-6 mb-3">
                                <label for="specializedTraining" class="form-label">Specialized Training</label>
                                <input type="text" placeholder="Enter specialized training" class="form-control"
                                    id="specializedTraining" name="specialized_training" value="">
                            </div>
                            <h3 class="border-bottom border-4 border-secondary pb-2 mb-3">Government ID Number</h3>
                            <div class="col-lg-6 mb-3">
                                <label for="tin" class="form-label">TIN</label>
                                <input class="form-control" type="text" id="tin" placeholder="XXX-XXX-XXX"
                                    name="tin" value="">
                            </div>
                            <div class="col-lg-6 mb-3">
                                <label for="pagibig" class="form-label">PAGIBIG</label>
                                <input class="form-control" type="text" id="pagibig" placeholder="XXXX-XXXX-XXXX"
                                    name="pagibig" value="">
                            </div>
                            <div class="col-lg-6 mb-3">
                                <label for="gsis" class="form-label">GSIS</label>
                                <input class="form-control" type="text" id="gsis" placeholder="XX-XX-XXXXXXX"
                                    name="gsis" value="">
                            </div>
                            <div class="col-lg-6 mb-3">
                                <label for="philhealth" class="form-label">PHILHEALTH</label>
                                <input class="form-control" type="text" id="philhealth" placeholder="XX-XXXXXXXXX-X"
                                    name="philhealth" value="">
                            </div>

                            <h3 class="border-bottom border-4 border-secondary pb-2 mb-3">Service Details</h3>
                            <div class="col-lg-6 mb-3">
                                <label for="dateEnteredOtherGovtService" class="form-label">Date Entered Other Government
                                    Service</label>
                                <input type="date" class="form-control" id="dateEnteredOtherGovtService"
                                    name="date_entered_other_government_service" value="">
                            </div>
                            <div class="col-lg-6 mb-3">
                                <label for="dateEnteredFireService" class="form-label">Date Entered Fire Service</label>
                                <input type="date" class="form-control" id="dateEnteredFireService"
                                    name="date_entered_fire_service" value="">
                            </div>
                            <div class="col-lg-6 mb-3">
                                <label for="modeOfEntry" class="form-label">Mode of Entry</label>
                                <input type="text" placeholder="Enter mode of entry" class="form-control"
                                    id="modeOfEntry" name="mode_of_entry" value="">
                            </div>
                            <div class="col-lg-6 mb-3">
                                <label for="dateOfLastPromotion" class="form-label">Date of Last Promotion</label>
                                <input type="date" class="form-control" id="dateOfLastPromotion"
                                    name="last_date_promotion" value="">
                            </div>
                            <div class="col-lg-6 mb-3">
                                <label for="appointmentStatus" class="form-label">Appointment Status</label>
                                <input type="text" placeholder="Enter appointment status" class="form-control"
                                    id="appointmentStatus" name="appointment_status" value="">
                            </div>
                            <div class="col-lg-6 mb-3">
                                <label for="unitCode" class="form-label">Unit Code</label>
                                <input type="text" placeholder="Enter unit code" class="form-control" id="unitCode"
                                    name="unit_code" value="">
                            </div>
                            <div class="col-lg-6 mb-3">
                                <label for="unitAssignment" class="form-label">Unit Assignment</label>
                                <input type="text" placeholder="Enter unit assignment" class="form-control"
                                    id="unitAssignment" name="unit_assignment" value="">
                            </div>
                            <div class="col-lg-6 mb-3">
                                <label for="designation" class="form-label">Designation</label>
                                <input type="text" placeholder="Enter designation" class="form-control"
                                    id="designation" name="designation" value="">
                            </div>

                            <div class="col-lg-12 mb-3">
                                <label for="remarks" class="form-label">Admin/Operation Remarks</label>
                                <textarea type="text" placeholder="Enter remarks" class="form-control" id="remarks"
                                    name="admin_operation_remarks"></textarea>
                            </div>


                            <h3 class="border-bottom border-4 border-secondary pb-2 mb-3">Added Personal File</h3>
                            <div id="file-list"></div>

                            <div>
                                <label for="file-input" class="form-label"></label>
                                <input class="form-control" type="file" id="file-input" style="display: none;"
                                    multiple>
                                <button class="btn btn-primary" type="button"
                                    onclick="document.getElementById('file-input').click();">+
                                    Choose File</button>
                                <p id="file-count">No files selected</p>
                            </div>
                        </div>
                        <!-- File List Container -->
                        <div id="file-list-container">
                            <div id="file-list"></div>
                        </div>
                        <div class="col d-flex justify-content-end mb-2">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button id="saveChangesBtn" class="btn btn-primary">Update Profile</button>
                            
                        </div>
                       
                    </div>
            </div>
            </form>
        </div>
    </div>
    </div>

    </div>
    <script>
        $(document).ready(function() {
            $("#editTertiaryCourse").click(function() {
                var inputField =
                    '<div class="col-lg-12 px-0 mb-3"> <div class="input-group"> <input type="text" placeholder="Enter tertiary course/s" class="form-control" id="tertiaryCourses"> <button type="button" class="btn btn-outline-danger removeTertiaryInputEdit">x</button> </div> </div>';
                $("#editTertiaryCourseContainer").append(inputField);
            });

            // Remove dynamically added input field
            $(document).on('click', '.removeTertiaryInputEdit', function() {
                $(this).closest('.col-lg-12').remove();
            });

            $("#editPostGraduateCourses").click(function() {
                var inputField =
                    '<div class="col-lg-12 px-0 mb-3"> <div class="input-group"> <input type="text" placeholder="Enter post graduate course/s" class="form-control" id="postGraduateCourses"> <button type="button" class="btn btn-outline-danger removePostGraduateInputEdit">x</button> </div> </div>';
                $("#editPostGraduateCoursesContainer").append(inputField);
            });

            // Remove dynamically added input field
            $(document).on('click', '.removePostGraduateInputEdit', function() {
                $(this).closest('.col-lg-12').remove();
            });
        });

        // Function to preview photo using jQuery
        function previewPhoto(event) {
            var file = event.target.files[0];
            var reader = new FileReader();

            reader.onload = function(e) {
                $('#personnel-picture').attr('src', e.target.result).attr('alt', 'Selected Image');
            }

            reader.readAsDataURL(file);
        }

        // Function to save data and redirect using jQuery
        function saveDataAndRedirect() {
            // Perform saving data here (e.g., AJAX request)
            // After data is successfully saved, redirect to another page
            window.location.href = "";
        }

        // Attach click event listener to the button
        document.getElementById("saveChangesBtn").addEventListener("click", function() {
            saveDataAndRedirect();
        });

        document.addEventListener('DOMContentLoaded', function() {
            const tinInput = document.getElementById('tin');
            const pagibigInput = document.getElementById('pagibig');
            const gsisInput = document.getElementById('gsis');
            const philhealthInput = document.getElementById('philhealth');

            const restrictToNumbers = function(inputElement) {
                inputElement.addEventListener('input', function(event) {
                    const inputValue = event.target.value;
                    const cleanedValue = inputValue.replace(/[^0-9\-]/g,
                        ''); // Remove any characters that are not numbers or hyphens
                    event.target.value = cleanedValue;
                });
            };

            restrictToNumbers(tinInput);
            restrictToNumbers(pagibigInput);
            restrictToNumbers(gsisInput);
            restrictToNumbers(philhealthInput);

            const formatGovernmentID = function(inputElement, format) {
                inputElement.addEventListener('input', function(event) {
                    const inputValue = event.target.value;
                    const cleanedValue = inputValue.replace(/[^0-9]/g,
                        ''); // Remove any characters that are not numbers
                    let formattedValue = '';
                    if (format === 'TIN') {
                        formattedValue = cleanedValue.replace(/(\d{3})(\d{3})(\d{3})/, '$1-$2-$3');
                    } else if (format === 'PAGIBIG') {
                        formattedValue = cleanedValue.replace(/(\d{4})(\d{4})(\d{4})/, '$1-$2-$3');
                    } else if (format === 'GSIS') {
                        formattedValue = cleanedValue.replace(/(\d{2})(\d{2})(\d{7})/, '$1-$2-$3');
                    } else if (format === 'PHILHEALTH') {
                        formattedValue = cleanedValue.replace(/(\d{2})(\d{9})(\d{1})/, '$1-$2-$3');
                    }
                    event.target.value = formattedValue;
                });
            };

            formatGovernmentID(tinInput, 'TIN');
            formatGovernmentID(pagibigInput, 'PAGIBIG');
            formatGovernmentID(gsisInput, 'GSIS');
            formatGovernmentID(philhealthInput, 'PHILHEALTH');
        });

        //personnel file upload
        $(document).ready(function() {
            $('#file-input').change(handleFileSelect);
        });

        function handleFileSelect(event) {
            var fileList = $('#file-list');
            fileList.html('');

            var files = event.target.files;

            // Update file count
            var fileCountSpan = $('#file-count');
            fileCountSpan.text(files.length + ' file(s)');

            for (var i = 0; i < files.length; i++) {
                var file = files[i];
                var listItem = $(
                    '<div class="file-item d-flex justify-content-between mb-2 align-items-center"></div>');

                var fileName = $('<span></span>').text(file.name);
                listItem.append(fileName);

                var deleteButton = $('<button class="btn btn-danger">Delete</button>');
                deleteButton.on('click', createDeleteHandler(file, fileCountSpan));
                listItem.append(deleteButton);

                fileList.append(listItem);
            }
        }

        function createDeleteHandler(file, fileCountSpan) {
            return function() {
                var fileList = $('#file-list');
                var fileItems = fileList.find('.file-item');
                for (var i = 0; i < fileItems.length; i++) {
                    if ($(fileItems[i]).find('span').text() === file.name) {
                        $(fileItems[i]).remove();
                        break;
                    }
                }

                // Update file count after deletion
                var remainingFiles = fileList.find('.file-item').length;
                fileCountSpan.text(remainingFiles + ' file(s)');
            };
        }
    </script>
@endsection
