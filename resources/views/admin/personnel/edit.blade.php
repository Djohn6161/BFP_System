@extends('layouts.user-template')
@section('content')
    <div class="container-fluid">
        <nav aria-label="breadcrumb" class="p-2 fw-bolder">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="">Configurations</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.personnel.index') }}">Personnel</a></li>
                <li class="breadcrumb-item active" aria-current="page">Update Personnel Information</li>
            </ol>
        </nav>
        <div class="row justify-content-center">
            <div class="col-lg-11 p-4">
                <form action="{{ route('admin.personnel.update') }}" class="need_validation" novalidate method="POST" enctype="multipart/form-data" id="editPersonnelForm">
                    @csrf
                    <div class="row">
                        <div class="row border border-light-subtle shadow rounded p-4 mb-4 bg-white">
                            <h3 class="border-bottom border-4 border-secondary pb-2 mb-3">Personal Details</h3>
                            <div class="col-lg-4">
                                <div class="col-lg-12 mb-3">
                                    <img id="personnel-picture"
                                        src="/assets/images/personnel_images/{{ $personnel->picture }}"
                                        class="object-fit-cover img-fluid w-100" style="height: 340px;"
                                        alt="Personnel Picture">
                                    <div class="row px-2">
                                        <label for="photo-upload" class="btn btn-primary mt-2">Change Photo</label>
                                        <input type="hidden" name="operation_id" value="{{ $personnel->id }}">
                                        <input type="file" id="photo-upload" style="display: none;" accept="image/*"
                                            onchange="previewPhoto(event)" name="image">
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-8">
                                <div class="row">
                                    <div class="col-lg-4 mb-3">
                                        <label for="accountNumber" class="form-label">Account Number <span class="text-danger">*</span></label>
                                        <input type="hidden" name="personnel_id" value="{{ $personnel->id }}">
                                        <input type="text" placeholder="Enter account number" class="form-control"
                                            id="accountNumber" name="account_number" required
                                            value="{{ $personnel->account_number }}">
                                    </div>
                                    <div class="col-lg-4 mb-3">
                                        <label for="itemNumber" class="form-label">Item Number</label>
                                        <input type="text" placeholder="Enter item number" class="form-control"
                                            id="itemNumber" name="item_number" value="{{ $personnel->item_number }}">
                                    </div>
                                    <div class="col-lg-4 mb-3">
                                        <label for="rank" class="form-label">Rank</label>
                                        <select class="form-select rankSelectEdit" id="rank" name="rank">
                                            <option selected>Select Rank</option>
                                            @foreach ($ranks as $rank)
                                                @if ($rank->id == $personnel->ranks_id)
                                                    <option selected value="{{ $rank->id }}">{{ $rank->slug }} -
                                                        {{ $rank->name }}
                                                    </option>
                                                @else
                                                    <option value="{{ $rank->id }}">{{ $rank->slug }} -
                                                        {{ $rank->name }}
                                                    </option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-12 mb-3">
                                    <div class="row">
                                        <div class="col-lg-3">
                                            <label class="form-label">First Name <span class="text-danger">*</span></label>
                                            <input type="text" placeholder="First Name" class="form-control" required
                                                id="firstName" name="first_name" value="{{ $personnel->first_name }}">
                                        </div>
                                        <div class="col-lg-3">
                                            <label class="form-label">Middle Name</label>
                                            <input type="text" placeholder="Middle Name" class="form-control"
                                                id="middleName" name="middle_name" value="{{ $personnel->middle_name }}">
                                        </div>
                                        <div class="col-lg-3">
                                            <label class="form-label">Last Name <span class="text-danger">*</span></label>
                                            <input type="text" placeholder="Last Name" class="form-control" required
                                                id="lastName" name="last_name" value="{{ $personnel->last_name }}">
                                        </div>
                                        <div class="col-lg-3">
                                            <label class="form-label">Suffix Name</label>
                                            <input type="text" placeholder="Suffix Name" class="form-control"
                                                id="suffixName" name="extension" value="{{ $personnel->extension }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-4 mb-3">
                                        <label for="contactNumber" class="form-label">Contact Number</label>
                                        <input type="text" placeholder="Enter contact number" class="form-control"
                                            id="contactNumber" name="contact_number"
                                            value="{{ $personnel->contact_number }}">
                                    </div>
                                    <div class="col-lg-4 mb-3">
                                        <label for="contactNumber" class="form-label">Emergency Contact Number</label>
                                        <input type="text" placeholder="Enter contact number" class="form-control"
                                            id="contactNumber" name="emergency_contact_number"
                                            value="{{ $personnel->emergency_contact_number }}">
                                    </div>
                                    <div class="col-lg-4 mb-3">
                                        <label for="dateOfBirth" class="form-label">Date of Birth</label>
                                        <input type="date" class="form-control" id="dateOfBirth" name="date_of_birth"
                                            value="{{ $personnel->date_of_birth }}">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-4 mb-3">
                                        <label for="maritalStatus" class="form-label">Marital Status</label>
                                        <select class="form-select" id="maritalStatus" name="maritam_status">
                                            <option selected>Select marital status</option>
                                            @foreach ($maritals as $marital)
                                                @if ($marital == $personnel->marital_status)
                                                    <option selected value="{{ $marital }}" selected>
                                                        {{ ucwords($marital) }}
                                                    </option>
                                                @else
                                                    <option value="{{ $marital }}" selected>{{ ucwords($marital) }}
                                                    </option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-lg-4 mb-3">
                                        <label for="gender" class="form-label">Gender <span class="text-danger">*</span></label>
                                        <select class="form-select" id="gender" name="gender" required>
                                            <option value="">Select gender</option>
                                            @foreach ($genders as $gender)
                                                @if ($gender == $personnel->gender)
                                                    <option value="{{ $gender }}" selected>{{ $gender }}
                                                    </option>
                                                @else
                                                    <option value="{{ $gender }}">{{ $gender }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-lg-4 mb-3">
                                        <label for="religion" class="form-label">Religion <span class="text-danger">*</span></label>
                                        <input type="text" placeholder="Enter religion" class="form-control" required
                                            id="religion" name="religion" value="{{ $personnel->religion }}">
                                    </div>
                                </div>

                                <div class="col-lg-12 mb-3">
                                    <label for="completeAddress" class="form-label">Complete Address <span class="text-danger">*</span></label>
                                    <input type="text" placeholder="Enter complete address" class="form-control" required
                                        id="completeAddress" name="address" value="{{ $personnel->address }}">
                                </div>
                            </div>

                            <h3 class="border-bottom border-4 border-secondary pb-2 mb-3">Educational Details</h3>
                            <div class="col-lg-6 mb-3">
                                <div class="col-lg-12">
                                    <div class="row m-0 p-0">
                                        <div class="col-lg-12 m-0 p-0">
                                            <label for="tertiaryCourses" class="form-label ">Tertiary Course/s</label>
                                            <button type="button" class="btn btn-sm btn-primary ms-3"
                                                id="editTertiaryCourse">+ ADD</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="row m-0 p-0" id="editTertiaryCourseContainer">
                                    @foreach ($tertiaries as $tertiary)
                                        <div class="col-lg-12 px-0 mb-2">
                                            <div class="input-group mb-1">
                                                <input type="text" placeholder="Enter tertiary course/s"
                                                    class="form-control" id="tertiaryCourses" name="tertiary[]"
                                                    value="{{ $tertiary->name }}">
                                                <button type="button"
                                                    class="btn btn-outline-danger removeTertiaryInputEdit">x</button>
                                            </div>
                                        </div>
                                    @endforeach
                                    <!-- Input fields will be appended here -->
                                </div>
                            </div>
                            <div class="col-lg-6 mb-3">
                                <div class="col-lg-12">
                                    <div class="row m-0 p-0">
                                        <div class="col-lg-12 m-0 p-0">
                                            <label for="postGraduateCourses" class="form-label">Post Graduate
                                                Course/s</label>
                                            <button type="button" class="btn btn-sm btn-primary ms-3"
                                                id="editPostGraduateCourses">+ ADD</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="row m-0 p-0" id="editPostGraduateCoursesContainer">
                                    @foreach ($courses as $course)
                                        <div class="col-lg-12 px-0 mb-2">
                                            <div class="input-group mb-1">
                                                <input type="text" placeholder="Enter post graduate course/s"
                                                    class="form-control" id="postGraduateCourses" name="courses[]"
                                                    value="{{ $course->name }}">
                                                <button type="button"
                                                    class="btn btn-outline-danger removePostGraduateInputEdit">x</button>
                                            </div>
                                        </div>
                                    @endforeach
                                    <!-- Input fields will be appended here -->
                                </div>
                            </div>
                            <div class="col-lg-6 mb-3">
                                <label for="highestEligibility" class="form-label">Highest Eligibility <span class="text-danger">*</span></label>
                                <input type="text" placeholder="Enter highest eligibility" class="form-control" required
                                    id="highestEligibility" value="{{ $personnel->highest_eligibility }}"
                                    name="highest_eligibility">
                            </div>
                            <div class="col-lg-6 mb-3">
                                <label for="highestTraining" class="form-label">Highest Training <span class="text-danger">*</span></label>
                                <input type="text" placeholder="Enter highest training" class="form-control" required
                                    id="highestTraining" value="{{ $personnel->highest_training }}"
                                    name="highest_training">
                            </div>
                            <div class="col-lg-6 mb-3">
                                <label for="specializedTraining" class="form-label">Specialized Training <span class="text-danger">*</span></label>
                                <input type="text" placeholder="Enter specialized training" class="form-control" required
                                    id="specializedTraining" name="specialized_training"
                                    value="{{ $personnel->specialized_training }}">
                            </div>
                            <h3 class="border-bottom border-4 border-secondary pb-2 mb-3">Government ID Number</h3>
                            <div class="col-lg-6 mb-3">
                                <label for="tin" class="form-label">TIN <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" id="tin" placeholder="XXX-XXX-XXX" required
                                    name="tin" value="{{ $personnel->tin }}">
                            </div>
                            <div class="col-lg-6 mb-3">
                                <label for="pagibig" class="form-label">PAGIBIG <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" id="pagibig" name="pagibig" required
                                    value="{{ $personnel->pagibig }}">
                            </div>
                            <div class="col-lg-6 mb-3">
                                <label for="gsis" class="form-label">GSIS <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" id="gsis" placeholder="XX-XX-XXXXXXX" required
                                    name="gsis" value="{{ $personnel->gsis }}">
                            </div>
                            <div class="col-lg-6 mb-3">
                                <label for="philhealth" class="form-label">PHILHEALTH <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" id="philhealth" placeholder="XX-XXXXXXXXX-X" required
                                    name="philhealth" value="{{ $personnel->philhealth }}">
                            </div>

                            <h3 class="border-bottom border-4 border-secondary pb-2 mb-3">Service Details</h3>
                            <div class="col-lg-6 mb-3">
                                <label for="dateEnteredOtherGovtService" class="form-label">Date Entered Other Government
                                    Service</label>
                                <input type="date" class="form-control" id="dateEnteredOtherGovtService"
                                    name="date_entered_other_government_service"
                                    value="{{ $personnel->date_entered_other_government_service }}">
                            </div>
                            <div class="col-lg-6 mb-3">
                                <label for="dateEnteredFireService" class="form-label">Date Entered Fire Service</label>
                                <input type="date" class="form-control" id="dateEnteredFireService"
                                    name="date_entered_fire_service" value="{{ $personnel->date_entered_fire_service }}">
                            </div>
                            <div class="col-lg-6 mb-3">
                                <label for="modeOfEntry" class="form-label">Mode of Entry <span class="text-danger">*</span></label>
                                <input type="text" placeholder="Enter mode of entry" class="form-control" required
                                    id="modeOfEntry" name="mode_of_entry" value="{{ $personnel->mode_of_entry }}">
                            </div>
                            <div class="col-lg-6 mb-3">
                                <label for="dateOfLastPromotion" class="form-label">Date of Last Promotion</label>
                                <input type="date" class="form-control" id="dateOfLastPromotion"
                                    name="last_date_promotion" value="{{ $personnel->last_date_promotion }}">
                            </div>
                            <div class="col-lg-4 mb-3">
                                <label for="appointmentStatus" class="form-label">Appointment Status <span class="text-danger">*</span></label>
                                <input type="text" placeholder="Enter appointment status" class="form-control" required
                                    id="appointmentStatus" name="appointment_status"
                                    value="{{ $personnel->appointment_status }}">
                            </div>
                            <div class="col-lg-4 mb-3">
                                <label for="unitCode" class="form-label">Unit Code <span class="text-danger">*</span></label>
                                <input type="text" placeholder="Enter unit code" class="form-control" id="unitCode" required
                                    name="unit_code" value="{{ $personnel->unit_code }}">
                            </div>
                            <div class="col-lg-4 mb-3">
                                <label for="unitAssignment" class="form-label">Unit Assignment <span class="text-danger">*</span></label>
                                <input type="text" placeholder="Enter unit assignment" class="form-control" required
                                    id="unitAssignment" name="unit_assignment"
                                    value="{{ $personnel->unit_assignment }}">
                            </div>
                            <div class="col-lg-12 mb-3">
                                <div class="row m-0 p-0 designationContainer">
                                    <div class="col-lg-12 px-0">
                                        <div class="row m-0 p-0">
                                            <div class="col-lg-6 m-0 p-0">
                                                <label for="designation" class="form-label me-2">Designation</label>
                                                <button type="button"
                                                    class="btn btn-sm btn-primary mb-1 addPersonnelDesignationEdit">+
                                                    ADD</button>
                                            </div>
                                        </div>
                                    </div>
                                    @foreach ($old_designations as $old_designation)
                                        <div class="col-lg-6 mb-3 ps-0">
                                            <div class="d-flex align-items-center">
                                                <select class="form-control designation_select_edit"
                                                    id="designation[{{ $loop->index }}]" aria-label="designationSelect"
                                                    name="designations[]">
                                                    <option selected>Select designation</option>
                                                    @foreach ($designations as $designation)
                                                        @if ($old_designation->name == $designation->name)
                                                            <option selected value="{{ $designation->name }}">
                                                                {{ $designation->name }}
                                                            </option>
                                                        @else
                                                            <option value="{{ $designation->name }}">
                                                                {{ $designation->name }}
                                                            </option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                                <button type="button"
                                                    class=" ms-1 btn btn-outline-danger remove-edit-personnel-designation">x</button>
                                            </div>
                                        </div>
                                    @endforeach

                                </div>
                            </div>

                            <div class="col-lg-12 mb-3">
                                <label for="remarks" class="form-label">Admin/Operation Remarks <span class="text-danger">*</span></label>
                                <textarea type="text" placeholder="Enter remarks" class="form-control" id="remarks" required
                                    name="admin_operation_remarks">{{ $personnel->admin_operation_remarks }}</textarea>
                            </div>

                            <h3 class="border-bottom border-4 border-secondary pb-2 mb-3">Uploaded Personal File</h3>
                            <br>
                            <!-- File List Container -->
                            <div id="file-list-container mb-3">
                                @foreach ($files as $file)
                                    @if ($file != '')
                                        <div class="file-item d-flex justify-content-between mb-2 align-items-center">
                                            <span>
                                                <input type="hidden" name="default_files[]"
                                                    value="{{ $file }}">
                                                {{ $file }}
                                            </span>
                                            <button type="button" class="btn btn-danger"
                                                onclick="deleteFile(this)">Delete</button>
                                        </div>
                                    @else
                                        <p>No files uploaded</p>
                                    @endif
                                @endforeach

                            </div>
                            <h3 class="border-bottom border-4 border-secondary pb-2 mb-3">Added Personal File</h3>
                            <div id="file-list"></div>

                            <div>
                                <label for="file-input" class="form-label"></label>
                                <input class="form-control" type="file" id="file-input" style="display: none;"
                                    multiple name="files[]">
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
                            <button id="saveChangesBtn" class="btn btn-primary">Save Changes</button>
                        </div>
                    </div>
            </div>
            </form>
        </div>
    </div>
    </div>

    </div>
    <script>
        document.getElementById('editPersonnelForm').addEventListener('submit', function(event) {
            if (!this.checkValidity()) {
                event.preventDefault(); // Prevent form submission if validation fails.
                event.stopPropagation();
            }
            this.classList.add('was-validated'); // Add Bootstrap validation class.
        }, false);
        $(document).ready(function() {
            $("#editTertiaryCourse").click(function() {
                var inputField =
                    '<div class="col-lg-12 px-0 mb-3"> <div class="input-group"> <input type="text" placeholder="Enter tertiary course/s" class="form-control" id="tertiaryCourses" name="tertiary[]"> <button type="button" class="btn btn-outline-danger removeTertiaryInputEdit">x</button> </div> </div>';
                $("#editTertiaryCourseContainer").append(inputField);
            });

            // Remove dynamically added input field
            $(document).on('click', '.removeTertiaryInputEdit', function() {
                $(this).closest('.col-lg-12').remove();
            });

            $("#editPostGraduateCourses").click(function() {
                var inputField =
                    '<div class="col-lg-12 px-0 mb-3"> <div class="input-group"> <input type="text" placeholder="Enter post graduate course/s" class="form-control" id="postGraduateCourses" name="courses[]"> <button type="button" class="btn btn-outline-danger removePostGraduateInputEdit">x</button> </div> </div>';
                $("#editPostGraduateCoursesContainer").append(inputField);
            });

            // Remove dynamically added input field
            $(document).on('click', '.removePostGraduateInputEdit', function() {
                $(this).closest('.col-lg-12').remove();
            });

            $(document).on('click', '.addPersonnelDesignationEdit', function() {
                // console.log("hello");
                var inputField =
                    '<div class="col-lg-6 mb-3 ps-0"> <div class="d-flex align-items-center"> <select class="form-control designation-select-edit" aria-label="designationSelect" name="designations[]"> <option selected>Select designation</option> @foreach ($designations as $designation) <option value="{{ $designation->name }}">{{ $designation->name }}</option> @endforeach </select> <button type="button" class=" ms-1 btn btn-outline-danger remove-edit-personnel-designation">x</button> </div> </div>';
                // $(".designationContainer").append(inputField);
                $(this).closest('.designationContainer').append(inputField);

                // inputField.find('.designation').select2();
                $(".designation-select-edit").select2();
            });
            $(document).on('click', '.remove-edit-personnel-designation', function() {
                $(this).closest('.col-lg-6').remove();
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
            window.location.href = "{{ route('admin.personnel.view', $personnel->id) }}";
        }

        // Attach click event listener to the button
        document.getElementById("saveChangesBtn").addEventListener("click", function() {
            // saveDataAndRedirect();
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

        // uploaded personal file delete button
        function deleteFile(button) {
            var fileItem = button.parentNode;
            fileItem.parentNode.removeChild(fileItem);
        }
    </script>
@endsection
