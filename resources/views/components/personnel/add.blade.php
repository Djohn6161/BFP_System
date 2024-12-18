<!-- Modal -->
<div class="modal fade" data-bs-backdrop="static" id="addPersonnelModal" tabindex="-1"
    aria-labelledby="addPersonnelModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="addPersonnelModalLabel">Add Personnel</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body px-5">
                <form id="addPersonnelForm" class="row g-3" method="POST" action="{{ route('admin.personnel.store') }}"
                    enctype="multipart/form-data" class="needs-validation" novalidate>
                    @csrf
                    <div class="col-lg-4">
                        <div class="mb-3">
                            <img id="previewPersonnelImage" src="/assets/images/personnel_images/default.png"
                                class="object-fit-cover img-fluid w-100" style="height: 340px;" alt="Personnel Picture">
                            <div class="mt-2">
                                <label for="imagePersonnelInput" class="btn btn-primary w-100">
                                    Upload Photo <input type="file" id="imagePersonnelInput" style="display:none;"
                                        name="image">
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <div class="row g-3">
                            <div class="col-lg-4 mb-3">
                                <label for="accountNumber" class="form-label">Account Number <span
                                        class="text-danger">*</span></label>
                                <input type="text" placeholder="Enter account number"
                                    class="form-control {{ $errors->has('account_number') != '' ? 'is-invalid' : '' }}"
                                    name="account_number" value="{{ old('account_number') }}" required>
                                @error('account_number')
                                    <span class="text-danger alert" role="alert">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-lg-4 mb-3">
                                <label for="itemNumber" class="form-label">Item Number</label>
                                <input type="text" placeholder="Enter item number"
                                    class="form-control {{ $errors->has('item_number') != '' ? 'is-invalid' : '' }}"
                                    name="item_number">
                                @error('item_number')
                                    <span class="text-danger alert" role="alert">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-lg-4 mb-3">
                                <label for="rank" class="form-label">Rank</label>
                                <select style="width: 100%"
                                    class=" form-select rankSelect {{ $errors->has('rank') != '' ? 'is-invalid' : '' }}"
                                    id="rank" name="rank">
                                    <option value="" selected>Select Rank</option>
                                    @foreach ($ranks as $rank)
                                        <option value="{{ $rank->id }}">{{ $rank->slug }} - {{ $rank->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('rank')
                                    <span class="text-danger alert" role="alert">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <div class="row g-3">
                                <div class="col">
                                    <label class="form-label">First Name <span class="text-danger">*</span></label>
                                    <input type="text" placeholder="First Name"
                                        class="form-control {{ $errors->has('first_name') != '' ? 'is-invalid' : '' }}"
                                        name="first_name" required>
                                    @error('first_name')
                                        <span class="text-danger alert" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col">
                                    <label class="form-label">Middle Name</label>
                                    <input type="text" placeholder="Middle Name" class="form-control" id="middleName"
                                        name="middle_name">
                                </div>
                                <div class="col">
                                    <label class="form-label">Last Name <span class="text-danger">*</span></label>
                                    <input required type="text" placeholder="Last Name"
                                        class="form-control {{ $errors->has('first_name') != '' ? 'is-invalid' : '' }}""
                                        id=" lastName" name="last_name">
                                    @error('last_name')
                                        <span class="text-danger alert" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col">
                                    <label class="form-label">Suffix Name</label>
                                    <input type="text" placeholder="Suffix Name" class="form-control"
                                        id="suffixName" name="extension">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="row mb-3">
                                <div class="col-lg-4">
                                    <label for="contactNumber" class="form-label">Contact Number</label>
                                    <input type="text" placeholder="Enter contact number" class="form-control"
                                        id="contactNumber" name="contact_number">
                                </div>
                                <div class="col-lg-4">
                                    <label for="contactNumber" class="form-label">Emergency Contact Number</label>
                                    <input type="text" placeholder="Enter contact number" class="form-control"
                                        id="emergencyContactNumber" name="emergency_contact_number">
                                </div>
                                <div class="col-lg-4">
                                    <label for="dateOfBirth" class="form-label">Date of Birth</label>
                                    <input type="date" class="form-control" id="dateOfBirth"
                                        value="date_of_birth">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-lg-4">
                                    <label for="maritalStatus" class="form-label">Marital Status</label>
                                    <select class="form-select" id="maritalStatus" name="marital_status">
                                        <option value="" selected>Select marital status</option>
                                        @foreach ($maritals as $marital)
                                            <option value="{{ $marital }}">{{ ucwords($marital) }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-lg-4">
                                    <label for="gender" class="form-label">Gender <span
                                            class="text-danger">*</span></label>
                                    <select class="form-select" id="gender" name="gender" required>
                                        <option value="" selected>Select gender</option>
                                        @foreach ($genders as $gender)
                                            <option value="{{ $gender }}">{{ ucwords($gender) }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-lg-4">
                                    <label for="religion" class="form-label">Religion <span
                                            class="text-danger">*</span></label>
                                    <input type="text" placeholder="Enter religion" class="form-control"
                                        id="religion" name="religion" required>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="completeAddress" class="form-label">Complete Address <span
                                        class="text-danger">*</span></label>
                                <input type="text" placeholder="Enter complete address" class="form-control"
                                    id="completeAddress" name="address" required>
                            </div>
                        </div>

                    </div>
                    <div class="col-lg-12">
                        <h3 class="border-bottom border-4 border-secondary pb-2 mb-3">Educational Details</h3>
                        <div class="row mb-3">
                            <div class="col-lg-6 mb-3">
                                <div class="col-lg-12">
                                    <div class="row m-0 p-0">
                                        <div class="col-lg-6 m-0 p-0">
                                            <label for="tertiaryCourses" class="form-label">Tertiary Course/s</label>
                                            <button type="button" class="btn btn-sm btn-primary ms-3"
                                                id="addTertiaryCourse">+ ADD</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="row m-0 p-0" id="tertiaryCourseContainer">
                                    <div class="col-lg-12 px-0 mb-3">
                                        <div class="input-group">
                                            <input type="text" placeholder="Enter tertiary course/s"
                                                class="form-control" id="tertiaryCourses" name="tertiary[]">
                                            <button type="button"
                                                class="btn btn-outline-danger removeTertiaryInput">x</button>
                                        </div>
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
                                                id="addpostGraduateCourses">+ ADD</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="row m-0 p-0" id="postGraduateCoursesContainer">
                                    <div class="col-lg-12 px-0 mb-3">
                                        <div class="input-group">
                                            <input type="text" placeholder="Enter post graduate course/s"
                                                class="form-control" id="postGraduateCourses"
                                                name="postGraduateCourses[]">
                                            <button type="button"
                                                class="btn btn-outline-danger removePostGraduateInput">x</button>
                                        </div>
                                    </div>
                                    <!-- Input fields will be appended here -->
                                </div>
                            </div>
                            <div class="col-lg-6 mb-3">
                                <label for="highestEligibility" class="form-label">Highest Eligibility <span
                                        class="text-danger">*</span></label>
                                <input type="text" placeholder="Enter highest eligibility" class="form-control"
                                    id="highestEligibility" required name="highest_eligibility">
                            </div>
                            <div class="col-lg-6 mb-3">
                                <label for="highestTraining" class="form-label">Highest Training <span
                                        class="text-danger">*</span></label>
                                <input type="text" placeholder="Enter highest training" class="form-control"
                                    required id="highestTraining" name="highest_training">
                            </div>
                            <div class="col-lg-6 mb-3">
                                <label for="specializedTraining" class="form-label">Specialized Training <span
                                        class="text-danger">*</span></label>
                                <input type="text" placeholder="Enter specialized training" class="form-control"
                                    required id="specializedTraining" name="specialized_training">
                            </div>
                        </div>
                        <h3 class="border-bottom border-4 border-secondary pb-2 mb-3">Government Issued ID's </h3>
                        <div class="row mb-3">
                            <div class="col-lg-6 mb-3">
                                <label for="tin" class="form-label">TIN <span
                                        class="text-danger">*</span></label>
                                <input class="form-control government-id" type="text" required name="tin"
                                    placeholder="XXX-XXX-XXX">
                            </div>
                            <div class="col-lg-6 mb-3">
                                <label for="pagibig" class="form-label">PAGIBIG <span
                                        class="text-danger">*</span></label>
                                <input class="form-control government-id" type="text" required name="pagibig"
                                    placeholder="XXXX-XXXX-XXXX">
                            </div>
                            <div class="col-lg-6 mb-3">
                                <label for="gsis" class="form-label">GSIS <span
                                        class="text-danger">*</span></label>
                                <input class="form-control government-id" type="text" required name="gsis"
                                    placeholder="XX-XX-XXXXXXX">
                            </div>
                            <div class="col-lg-6 mb-3">
                                <label for="philhealth" class="form-label">PHILHEALTH <span
                                        class="text-danger">*</span></label>
                                <input class="form-control government-id" type="text" name="philhealth" required
                                    placeholder="XX-XXXXXXXXX-X">
                            </div>
                        </div>

                        <h3 class="border-bottom border-4 border-secondary pb-2 mb-3">Service Details</h3>
                        <div class="row mb-3">
                            <div class="col-lg-6 mb-3">
                                <label for="dateEnteredOtherGovtService" class="form-label">Date Entered Other
                                    Government
                                    Service</label>
                                <input type="date" class="form-control" id="dateEnteredOtherGovtService"
                                    name="date_entered_other_government_service">
                            </div>
                            <div class="col-lg-6 mb-3">
                                <label for="dateEnteredFireService" class="form-label">Date Entered Fire
                                    Service</label>
                                <input type="date" class="form-control" id="dateEnteredFireService"
                                    name="date_entered_fire_service">
                            </div>
                            <div class="col-lg-6 mb-3">
                                <label for="modeOfEntry" class="form-label">Mode of Entry <span
                                        class="text-danger">*</span></label>
                                <input type="text" placeholder="Enter mode of entry" class="form-control"
                                    id="modeOfEntry" required name="mode_of_entry">
                            </div>
                            <div class="col-lg-6 mb-3">
                                <label for="dateOfLastPromotion" class="form-label">Date of Last Promotion</label>
                                <input type="date" class="form-control" id="dateOfLastPromotion"
                                    name="last_date_promotion">
                            </div>
                            <div class="col-lg-4 mb-3">
                                <label for="appointmentStatus" class="form-label">Appointment Status <span
                                        class="text-danger">*</span></label>
                                <input type="text" placeholder="Enter appointment status" class="form-control"
                                    required id="appointmentStatus" name="appointment_status">
                            </div>
                            <div class="col-lg-4 mb-3">
                                <label for="unitCode" class="form-label">Unit Code <span
                                        class="text-danger">*</span></label>
                                <input type="text" placeholder="Enter unit code" class="form-control" required
                                    id="unitCode" name="unit_code">
                            </div>
                            <div class="col-lg-4 mb-3">
                                <label for="unitAssignment" class="form-label">Unit Assignment <span
                                        class="text-danger">*</span></label>
                                <input type="text" placeholder="Enter unit assignment" class="form-control"
                                    required id="unitAssignment" name="unit_assignment">
                            </div>
                            <div class="col-lg-12 mb-3">
                                <div class="row m-0 p-0 designationContainer">
                                    <div class="col-lg-12 px-0">
                                        <div class="row m-0 p-0">
                                            <div class="col-lg-6 m-0 p-0">
                                                <label for="designation" class="form-label me-2">Designation</label>
                                                <button type="button"
                                                    class="btn btn-sm btn-primary mb-1 addPersonnelDesignation">+
                                                    ADD</button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 mb-3 ps-0">
                                        <div class="d-flex align-items-center">
                                            <select style="width: 100%" class="form-control designation-select"
                                                id="designationSelect" aria-label="designationSelect"
                                                name="designations[]">
                                                <option selected>Select designation</option>
                                                @foreach ($designations as $designation)
                                                    <option value="{{ $designation->name }}">{{ $designation->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <button type="button"
                                                class=" ms-1 btn btn-outline-danger remove-personnel-designation">x</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 mb-3">
                                <label for="adminOperation" class="form-label">Admin/Operation Remarks <span
                                        class="text-danger">*</span> </label>
                                <textarea type="text" placeholder="Enter remarks" class="form-control" id="remarks" name="remarks" required> </textarea>
                            </div>
                            <h3 class="border-bottom border-4 border-secondary pb-2 mb-3">Uploaded Personal File</h3>
                            <div>
                                <label for="file-input" class="form-label"></label>
                                <input class="form-control" type="file" id="file-input" style="display: none;"
                                    multiple name="files[]">
                                <div class="d-flex justify-content-between">
                                    <button type="button" class="btn btn-primary"
                                        onclick="document.getElementById('file-input').click();">+ Choose File</button>
                                    <p id="file-count">No files selected</p>
                                </div>
                            </div>
                            <div id="file-list-container">
                                <div id="file-list"></div>
                            </div>
                        </div>

                        <!-- File List Container -->
                        <div id="file-list-container">
                            <div id="file-list"></div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save Personnel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    //personnel file upload
    document.getElementById('addPersonnelForm').addEventListener('submit', function(event) {
        if (!this.checkValidity()) {
            event.preventDefault(); // Prevent form submission if validation fails.
            event.stopPropagation();
        }
        this.classList.add('was-validated'); // Add Bootstrap validation class.
    }, false);
    $(document).ready(function() {
        $('#file-input').change(handleFileSelect);
        $(document).on('click', '.addPersonnelDesignation', function() {
            // console.log("hello");
            var inputField =
                '<div class="col-lg-6 mb-3 ps-0"> <div class="d-flex align-items-center"> <select class="form-control designation-select" aria-label="designationSelect" name="designations[]"> <option selected>Open this select menu</option> @foreach ($designations as $designation) <option value="{{ $designation->name }}">{{ $designation->name }}</option> @endforeach </select> <button type="button" class=" ms-1 btn btn-outline-danger remove-personnel-designation">x</button> </div> </div>';
            // $(".designationContainer").append(inputField);
            $(this).closest('.designationContainer').append(inputField);

            // inputField.find('.designation').select2();
            $(".designation-select").select2({
                dropdownParent: $("#addPersonnelModal")
            });
        });
        $(document).on('click', '.remove-personnel-designation', function() {
            $(this).closest('.col-lg-6').remove();
        });
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
            var listItem = $('<div class="file-item d-flex justify-content-between mb-2 align-items-center"></div>');

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

        function previewPhoto(event) {
            var file = event.target.files[0];
            var reader = new FileReader();

            reader.onload = function(e) {
                $('#personnel-picture').attr('src', e.target.result).attr('alt', 'Selected Image');
            }

            reader.readAsDataURL(file);
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
            }

            // Update file count after deletion
            var remainingFiles = fileList.find('.file-item').length;
            fileCountSpan.text(remainingFiles + ' file(s)');
        };
    }

    $("#addTertiaryCourse").click(function() {
        var inputField =
            '<div class="col-lg-12 px-0 mb-3"> <div class="input-group"> <input type="text" placeholder="Enter tertiary course/s" class="form-control" id="tertiaryCourses" name="tertiary[]"> <button type="button" class="btn btn-outline-danger removeTertiaryInput">x</button> </div> </div>';
        $("#tertiaryCourseContainer").append(inputField);
    });

    // Remove dynamically added input field
    $(document).on('click', '.removeTertiaryInput', function() {
        $(this).closest('.col-lg-12').remove();
    });

    $("#addpostGraduateCourses").click(function() {
        var inputField =
            '<div class="col-lg-12 px-0 mb-3"> <div class="input-group"> <input type="text" placeholder="Enter post graduate course/s" class="form-control" id="postGraduateCourses" name="postGraduateCourses[]"> <button type="button" class="btn btn-outline-danger removePostGraduateInput">x</button> </div> </div>';
        $("#postGraduateCoursesContainer").append(inputField);
    });

    // Remove dynamically added input field
    $(document).on('click', '.removePostGraduateInput', function() {
        $(this).closest('.col-lg-12').remove();
    });

    $('#imagePersonnelInput').change(function() {
        var file = this.files[0];
        if (file) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#previewPersonnelImage').attr('src', e.target.result);
            }
            reader.readAsDataURL(file);
        }
    });
</script>
