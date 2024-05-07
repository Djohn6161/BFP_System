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
                    enctype="multipart/form-data">
                    @csrf
                    <div class="col-lg-4">
                        <div class="mb-3">
                            <img id="previewPersonnelImage"
                                src="{{ asset('assets/images/personnel_images/default.png') }}"
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
                                <label for="accountNumber" class="form-label">Account Number</label>
                                <input type="text" placeholder="Enter account number" class="form-control"
                                    id="accountNumber" name="account_number">
                            </div>
                            <div class="col-lg-4 mb-3">
                                <label for="itemNumber" class="form-label">Item Number</label>
                                <input type="text" placeholder="Enter item number" class="form-control"
                                    id="itemNumber" name="item_number">
                            </div>
                            <div class="col-lg-4 mb-3">
                                <label for="rank" class="form-label">Rank</label>
                                <select class="form-select" id="rank" name="rank">
                                    <option selected>Select Rank</option>
                                    @foreach ($ranks as $rank)
                                        <option value="{{$rank->id}}">{{$rank->slug}} - {{$rank->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Name</label>
                            <div class="row g-3">
                                <div class="col">
                                    <input type="text" placeholder="First Name" class="form-control" id="firstName"
                                        name="first_name">
                                </div>
                                <div class="col">
                                    <input type="text" placeholder="Middle Name" class="form-control" id="middleName"
                                        name="middle_name">
                                </div>
                                <div class="col">
                                    <input type="text" placeholder="Last Name" class="form-control" id="lastName"
                                        name="last_name">
                                </div>
                                <div class="col">
                                    <input type="text" placeholder="Suffix Name" class="form-control" id="suffixName"
                                        name="extension">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="row mb-3">

                                <div class="col-lg-6">
                                    <label for="contactNumber" class="form-label">Contact Number</label>
                                    <input type="text" placeholder="Enter contact number" class="form-control"
                                        id="contactNumber" name="contact_number">
                                </div>
                                <div class="col-lg-6">
                                    <label for="dateOfBirth" class="form-label">Date of Birth</label>
                                    <input type="date" class="form-control" id="dateOfBirth" name="date_of_birth">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-lg-4">
                                    <label for="maritalStatus" class="form-label">Marital Status</label>
                                    <select class="form-select" id="maritalStatus" name="marital_status">
                                        <option value="" selected>Select marital status</option>
                                        @foreach ($maritals as $marital)
                                            <option value="{{ $marital }}">{{ucwords($marital)}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-lg-4">
                                    <label for="gender" class="form-label">Gender</label>
                                    <select class="form-select" id="gender" name="gender">
                                        <option value="" selected>Select gender</option>
                                        @foreach ($genders as $gender)
                                            <option value="{{ $gender }}">{{ucwords($gender)}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-lg-4">
                                    <label for="religion" class="form-label">Religion</label>
                                    <input type="text" placeholder="Enter religion" class="form-control"
                                        id="religion" name="religion">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="completeAddress" class="form-label">Complete Address</label>
                                <input type="text" placeholder="Enter complete address" class="form-control"
                                    id="completeAddress" name="address">
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
                                <label for="highestEligibility" class="form-label">Highest Eligibility</label>
                                <input type="text" placeholder="Enter highest eligibility" class="form-control"
                                    id="highestEligibility" name="highest_eligibility">
                            </div>
                            <div class="col-lg-6 mb-3">
                                <label for="highestTraining" class="form-label">Highest Training</label>
                                <input type="text" placeholder="Enter highest training" class="form-control"
                                    id="highestTraining" name="highest_training">
                            </div>
                            <div class="col-lg-6 mb-3">
                                <label for="specializedTraining" class="form-label">Specialized Training</label>
                                <input type="text" placeholder="Enter specialized training" class="form-control"
                                    id="specializedTraining" name="specialized_training">
                            </div>
                        </div>
                        <h3 class="border-bottom border-4 border-secondary pb-2 mb-3">Government Issued ID's </h3>
                        <div class="row mb-3">
                            <div class="col-lg-6 mb-3">
                                <label for="tin" class="form-label">TIN</label>
                                <input class="form-control government-id" type="text" id="tin"
                                    placeholder="XXX-XXX-XXX">
                            </div>
                            <div class="col-lg-6 mb-3">
                                <label for="pagibig" class="form-label">PAGIBIG</label>
                                <input class="form-control government-id" type="text" id="pagibig"
                                    placeholder="XXXX-XXXX-XXXX">
                            </div>
                            <div class="col-lg-6 mb-3">
                                <label for="gsis" class="form-label">GSIS</label>
                                <input class="form-control government-id" type="text" id="gsis"
                                    placeholder="XX-XX-XXXXXXX">
                            </div>
                            <div class="col-lg-6 mb-3">
                                <label for="philhealth" class="form-label">PHILHEALTH</label>
                                <input class="form-control government-id" type="text" id="philhealth"
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
                                <label for="modeOfEntry" class="form-label">Mode of Entry</label>
                                <input type="text" placeholder="Enter mode of entry" class="form-control"
                                    id="modeOfEntry" name="mode_of_entry">
                            </div>
                            <div class="col-lg-6 mb-3">
                                <label for="dateOfLastPromotion" class="form-label">Date of Last Promotion</label>
                                <input type="date" class="form-control" id="dateOfLastPromotion"
                                    name="last_date_promotion">
                            </div>
                            <div class="col-lg-6 mb-3">
                                <label for="appointmentStatus" class="form-label">Appointment Status</label>
                                <input type="text" placeholder="Enter appointment status" class="form-control"
                                    id="appointmentStatus" name="appointment_status">
                            </div>
                            <div class="col-lg-6 mb-3">
                                <label for="unitCode" class="form-label">Unit Code</label>
                                <input type="text" placeholder="Enter unit code" class="form-control"
                                    id="unitCode" name="unit_code">
                            </div>
                            <div class="col-lg-6 mb-3">
                                <label for="unitAssignment" class="form-label">Unit Assignment</label>
                                <input type="text" placeholder="Enter unit assignment" class="form-control"
                                    id="unitAssignment" name="unit_assignment">
                            </div>
                            <div class="col-lg-6 mb-3">
                                <label for="designation" class="form-label">Designation</label>
                                <input type="text" placeholder="Enter designation" class="form-control"
                                    id="designation" name="designation">
                            </div>
                            <div class="col-lg-12 mb-3">
                                <label for="adminOperation" class="form-label">Admin/Operation Remarks</label>
                                <textarea type="text" placeholder="Enter remarks" class="form-control" id="remarks" name="remarks"></textarea>
                            </div>
                            <h3 class="border-bottom border-4 border-secondary pb-2 mb-3">Uploaded Personal File</h3>
                            <div>
                                <label for="file-input" class="form-label"></label>
                                <input class="form-control" type="file" id="file-input" style="display: none;"
                                    multiple name="files[]">
                                <div class="d-flex justify-content-between">
                                    <button type="button" class="btn btn-primary" onclick="document.getElementById('file-input').click();">+ Choose File</button>
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
</div>

<script>
     //personnel file upload
     $(document).ready(function(){
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
                var listItem = $('<div class="file-item d-flex justify-content-between mb-2 align-items-center"></div>');

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

                // Update file count after deletion
                var remainingFiles = fileList.find('.file-item').length;
                fileCountSpan.text(remainingFiles + ' file(s)');
            };
        }
</script>
