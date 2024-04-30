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
                <div class="row">
                    <div class="row border border-light-subtle shadow rounded p-4 mb-4">
                        <h3 class="border-bottom border-4 border-secondary pb-2 mb-3">Personal Details</h3>

                        <div class="col-lg-4">
                            <div class="col-lg-12 mb-3"> <!-- Photo column -->
                                <img id="personnel-picture" src="{{ asset('assets/images/backgrounds/sir sample.jpg') }}"
                                    class="object-fit-cover img-fluid w-100" style="height: 340px;" alt="Personnel Picture">
                                <div class="row px-2">
                                    <label for="photo-upload" class="btn btn-primary mt-2">Change Photo</label>
                                    <input type="file" id="photo-upload" style="display: none;" accept="image/*"
                                        onchange="previewPhoto(event)">
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-8">
                            <div class="row">
                                <div class="col-lg-6 mb-3">
                                    <label for="accountNumber" class="form-label">Account Number</label>
                                    <input type="text" placeholder="Enter account number" class="form-control"
                                        id="accountNumber">
                                </div>
                                <div class="col-lg-6 mb-3">
                                    <label for="itemNumber" class="form-label">Item Number</label>
                                    <input type="text" placeholder="Enter item number" class="form-control"
                                        id="itemNumber">
                                </div>
                            </div>

                            <div class="col-lg-12 mb-3">
                                <label class="form-label">Name</label>
                                <div class="row">
                                    <div class="col-lg-3">
                                        <input type="text" placeholder="First Name" class="form-control" id="firstName">
                                    </div>
                                    <div class="col-lg-3">
                                        <input type="text" placeholder="Middle Name" class="form-control"
                                            id="middleName">
                                    </div>
                                    <div class="col-lg-3">
                                        <input type="text" placeholder="Last Name" class="form-control" id="lastName">
                                    </div>
                                    <div class="col-lg-3">
                                        <input type="text" placeholder="Suffix Name" class="form-control"
                                            id="suffixName">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6 mb-3">
                                    <label for="contactNumber" class="form-label">Contact Number</label>
                                    <input type="text" placeholder="Enter contact number" class="form-control"
                                        id="contactNumber">
                                </div>
                                <div class="col-lg-6 mb-3">
                                    <label for="dateOfBirth" class="form-label">Date of Birth</label>
                                    <input type="date" class="form-control" id="dateOfBirth">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4 mb-3">
                                    <label for="maritalStatus" class="form-label">Marital Status</label>
                                    <select class="form-select" id="maritalStatus">
                                        <option selected>Select marital status</option>
                                        <option value="Single">Single</option>
                                        <option value="Married">Married</option>
                                        <option value="Divorced">Divorced</option>
                                        <option value="Widowed">Widowed</option>
                                    </select>
                                </div>
                                <div class="col-lg-4 mb-3">
                                    <label for="gender" class="form-label">Gender</label>
                                    <select class="form-select" id="gender">
                                        <option selected>Select gender</option>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                    </select>
                                </div>
                                <div class="col-lg-4 mb-3">
                                    <label for="religion" class="form-label">Religion</label>
                                    <input type="text" placeholder="Enter religion" class="form-control" id="religion">
                                </div>
                            </div>

                            <div class="col-lg-12 mb-3">
                                <label for="completeAddress" class="form-label">Complete Address</label>
                                <input type="text" placeholder="Enter complete address" class="form-control"
                                    id="completeAddress">
                            </div>


                        </div>



                        <h3 class="border-bottom border-4 border-secondary pb-2 mb-3">Educational Details</h3>
                        <div class="col-lg-6 mb-3">
                            <label for="tertiaryCourses" class="form-label">Tertiary Course/s</label>
                            <input type="text" placeholder="Enter tertiary course/s" class="form-control"
                                id="tertiaryCourses">
                        </div>
                        <div class="col-lg-6 mb-3">
                            <label for="postGraduateCourses" class="form-label">Post Graduate Course/s</label>
                            <input type="text" placeholder="Enter post graduate course/s" class="form-control"
                                id="postGraduateCourses">
                        </div>
                        <div class="col-lg-6 mb-3">
                            <label for="highestEligibility" class="form-label">Highest Eligibility</label>
                            <input type="text" placeholder="Enter highest eligibility" class="form-control"
                                id="highestEligibility">
                        </div>
                        <div class="col-lg-6 mb-3">
                            <label for="highestTraining" class="form-label">Highest Training</label>
                            <input type="text" placeholder="Enter highest training" class="form-control"
                                id="highestTraining">
                        </div>
                        <div class="col-lg-6 mb-3">
                            <label for="specializedTraining" class="form-label">Specialized Training</label>
                            <input type="text" placeholder="Enter specialized training" class="form-control"
                                id="specializedTraining">
                        </div>
                        <h3 class="border-bottom border-4 border-secondary pb-2 mb-3">Government Files </h3>
                        <div class="col-lg-6 mb-3">
                            <label for="tin" class="form-label">TIN</label>
                            <input class="form-control" type="file" id="tin" multiple>
                        </div>
                        <div class="col-lg-6 mb-3">

                            <label for="pagibig" class="form-label">PAGIBIG</label>
                            <input class="form-control" type="file" id="pagibig" multiple>
                        </div>
                        <div class="col-lg-6 mb-3">
                            <label for="gsis" class="form-label">GSIS</label>
                            <input class="form-control" type="file" id="gsis" multiple>
                        </div>
                        <div class="col-lg-6 mb-3">
                            <label for="philhealth" class="form-label">PHILHEALTH</label>
                            <input class="form-control" type="file" id="philhealth" multiple>
                        </div>

                        <h3 class="border-bottom border-4 border-secondary pb-2 mb-3">Service Details</h3>
                        <div class="col-lg-6 mb-3">
                            <label for="dateEnteredOtherGovtService" class="form-label">Date Entered Other Government
                                Service</label>
                            <input type="date" class="form-control" id="dateEnteredOtherGovtService">
                        </div>
                        <div class="col-lg-6 mb-3">
                            <label for="dateEnteredFireService" class="form-label">Date Entered Fire Service</label>
                            <input type="date" class="form-control" id="dateEnteredFireService">
                        </div>
                        <div class="col-lg-6 mb-3">
                            <label for="modeOfEntry" class="form-label">Mode of Entry</label>
                            <input type="text" placeholder="Enter mode of entry" class="form-control"
                                id="modeOfEntry">
                        </div>
                        <div class="col-lg-6 mb-3">
                            <label for="dateOfLastPromotion" class="form-label">Date of Last Promotion</label>
                            <input type="date" class="form-control" id="dateOfLastPromotion">
                        </div>
                        <div class="col-lg-4 mb-3">
                            <label for="appointmentStatus" class="form-label">Appointment Status</label>
                            <input type="text" placeholder="Enter appointment status" class="form-control"
                                id="appointmentStatus">
                        </div>
                        <div class="col-lg-4 mb-3">
                            <label for="unitCode" class="form-label">Unit Code</label>
                            <input type="text" placeholder="Enter unit code" class="form-control" id="unitCode">
                        </div>
                        <div class="col-lg-4 mb-3">
                            <label for="unitAssignment" class="form-label">Unit Assignment</label>
                            <input type="text" placeholder="Enter unit assignment" class="form-control"
                                id="unitAssignment">
                        </div>
                        <div class="col-lg-6 mb-3">
                            <label for="designation" class="form-label">Designation</label>
                            <input type="text" placeholder="Enter designation" class="form-control" id="designation">
                        </div>
                        <div class="col-lg-6 mb-3">
                            <label for="adminOperation" class="form-label">Admin/Operation</label>
                            <input type="text" placeholder="Enter admin/operation" class="form-control"
                                id="adminOperation">
                        </div>
                        <div class="col-lg-12 mb-3">
                            <label for="remarks" class="form-label">Remarks</label>
                            <textarea type="text" placeholder="Enter remarks" class="form-control" id="remarks"></textarea>
                        </div>

                    </div>
                    <div class="col d-flex justify-content-end mb-2">
                        <button id="saveChangesBtn" class="btn btn-primary">Save Changes</button>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <script>
        function previewPhoto(event) {
            var file = event.target.files[0];
            var reader = new FileReader();

            reader.onload = function(e) {
                var personnelPicture = document.getElementById('personnel-picture');
                personnelPicture.src = e.target.result;
                personnelPicture.alt = "Selected Image";
            }

            reader.readAsDataURL(file);
        }

        // Function to save data
        function saveDataAndRedirect() {
            // Perform saving data here (e.g., AJAX request)
            // After data is successfully saved, redirect to another page
            window.location.href = "{{ route('admin.personnel.view') }}";
        }

        // Attach click event listener to the button
        document.getElementById("saveChangesBtn").addEventListener("click", function() {
            saveDataAndRedirect();
        });
    </script>
@endsection
