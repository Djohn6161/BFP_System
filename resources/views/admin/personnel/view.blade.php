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
                        <div class="col d-flex justify-content-end mb-2">
                            <button type="button" class="btn btn-danger me-2" data-bs-toggle="modal" data-bs-target="#deleteModal">Delete</button>
                            <a href="{{ route('admin.personnel.edit') }}" class="btn btn-primary">Update Information</a>
                        </div>
                        <h3 class="border-bottom border-4 border-secondary pb-2 mb-3">Personal Details</h3>
                        <div class="col-lg-4">
                            <div class="col-lg-12 mb-3">
                                <img id="personnel-picture" src="/assets/images/backgrounds/{{$personnel->picture}}"
                                    class="object-fit-cover img-fluid" style="width: 300px; height: 400px;"
                                    alt="Personnel Picture">
                            </div>

                        </div>

                        <div class="col-lg-8">
                            <div class="row">
                                <div class="col-lg-6 mb-3">
                                    <label for="accountNumber" class="form-label">Account Number</label>
                                    <input type="text" placeholder="Enter account number" class="form-control"
                                        id="accountNumber" readonly value="{{$personnel->account_number}}">
                                </div>
                                <div class="col-lg-6 mb-3">
                                    <label for="itemNumber" class="form-label">Item Number</label>
                                    <input type="text" class="form-control"
                                        id="itemNumber" readonly value="{{$personnel->item_number}}">
                                </div>
                            </div>

                            <div class="col-lg-12 mb-3">
                                <label class="form-label">Name</label>
                                <div class="row">
                                    <div class="col-lg-3">
                                        <input type="text" class="form-control" id="firstName"
                                            readonly value="{{$personnel->first_name}}">
                                    </div>
                                    <div class="col-lg-3">
                                        <input type="text" placeholder="Middle Name" class="form-control" id="middleName"
                                            readonly value="{{$personnel->middle_name}}">
                                    </div>
                                    <div class="col-lg-3">
                                        <input type="text" placeholder="Last Name" class="form-control" id="lastName"
                                            readonly value="{{$personnel->last_name}}">
                                    </div>
                                    <div class="col-lg-3">
                                        <input type="text" placeholder="Suffix Name" class="form-control" id="suffixName"
                                            readonly value="{{$personnel->extension}}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6 mb-3">
                                    <label for="contactNumber" class="form-label">Contact Number</label>
                                    <input type="text" placeholder="Enter contact number" class="form-control"
                                        id="contactNumber" readonly value="{{$personnel->contact_number}}">
                                </div>
                                <div class="col-lg-6 mb-3">
                                    <label for="dateOfBirth" class="form-label">Date of Birth</label>
                                    <input type="date" class="form-control" id="dateOfBirth" readonly value="{{$personnel->date_of_birth}}">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4 mb-3">
                                    <label for="maritalStatus" class="form-label">Marital Status</label>
                                    <input class="form-select" id="maritalStatus" readonly value="{{$personnel->maritam_status}}">

                                    </input>
                                </div>
                                <div class="col-lg-4 mb-3">
                                    <label for="gender" class="form-label">Gender</label>
                                    <input class="form-select" id="gender" readonly value="{{$personnel->gender}}">
                                    </input>
                                </div>
                                <div class="col-lg-4 mb-3">
                                    <label for="religion" class="form-label">Religion</label>
                                    <input type="text" class="form-control" id="religion"
                                        readonly value="{{$personnel->religion}}">
                                </div>
                            </div>

                            <div class="col-lg-12 mb-3">
                                <label for="completeAddress" class="form-label">Complete Address</label>
                                <input type="text" placeholder="Enter complete address" class="form-control"
                                    id="completeAddress" readonly value="{{$personnel->address}}">
                            </div>


                        </div>



                        <h3 class="border-bottom border-4 border-secondary pb-2 mb-3">Educational Details</h3>
                        <div class="col-lg-6 mb-3">
                            <label for="tertiaryCourses" class="form-label">Tertiary Course/s</label>
                            <input type="text" placeholder="Enter tertiary course/s" class="form-control"
                                id="tertiaryCourses" readonly>
                        </div>
                        <div class="col-lg-6 mb-3">
                            <label for="postGraduateCourses" class="form-label">Post Graduate Course/s</label>
                            <input type="text" placeholder="Enter post graduate course/s" class="form-control"
                                id="postGraduateCourses" readonly>
                        </div>
                        <div class="col-lg-6 mb-3">
                            <label for="highestEligibility" class="form-label">Highest Eligibility</label>
                            <input type="text" placeholder="Enter highest eligibility" class="form-control"
                                id="highestEligibility" readonly>
                        </div>
                        <div class="col-lg-6 mb-3">
                            <label for="highestTraining" class="form-label">Highest Training</label>
                            <input type="text" placeholder="Enter highest training" class="form-control"
                                id="highestTraining" readonly>
                        </div>
                        <div class="col-lg-6 mb-3">
                            <label for="specializedTraining" class="form-label">Specialized Training</label>
                            <input type="text" placeholder="Enter specialized training" class="form-control"
                                id="specializedTraining" readonly>
                        </div>
                        <h3 class="border-bottom border-4 border-secondary pb-2 mb-3">Government Files </h3>
                        <div class="col-lg-6 mb-3">
                            <label for="tin" class="form-label">TIN</label>
                            <div class="d-flex">
                                <input type="text" class="form-control me-2" id="tin_filename" readonly>
                                <button class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#filePreviewPersonnelModal">Preview</button>
                            </div>
                        </div>

                        <div class="col-lg-6 mb-3">
                            <label for="pagibig" class="form-label">PAGIBIG</label>
                            <div class="d-flex">
                                <input type="text" class="form-control me-2" id="pagibig_filename" readonly>
                                <button class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#filePreviewPersonnelModal">Preview</button>
                            </div>
                        </div>
                        <div class="col-lg-6 mb-3">
                            <label for="gsis" class="form-label">GSIS</label>
                            <div class="d-flex">
                                <input type="text" class="form-control me-2" id="gsis_filename" readonly>
                                <button class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#filePreviewPersonnelModal">Preview</button>
                            </div>

                        </div>
                        <div class="col-lg-6 mb-3">
                            <label for="philhealth" class="form-label">PHILHEALTH</label>
                            <div class="d-flex">
                                <input type="text" class="form-control me-2" id="philhealth_filename" readonly>
                                <button class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#filePreviewPersonnelModal">Preview</button>
                            </div>
                        </div>

                        <h3 class="border-bottom border-4 border-secondary pb-2 mb-3">Service Details</h3>
                        <div class="col-lg-6 mb-3">
                            <label for="dateEnteredOtherGovtService" class="form-label">Date Entered Other Government
                                Service</label>
                            <input type="date" class="form-control" id="dateEnteredOtherGovtService" readonly>
                        </div>
                        <div class="col-lg-6 mb-3">
                            <label for="dateEnteredFireService" class="form-label">Date Entered Fire Service</label>
                            <input type="date" class="form-control" id="dateEnteredFireService" readonly>
                        </div>
                        <div class="col-lg-6 mb-3">
                            <label for="modeOfEntry" class="form-label">Mode of Entry</label>
                            <input type="text" placeholder="Enter mode of entry" class="form-control"
                                id="modeOfEntry" readonly>
                        </div>
                        <div class="col-lg-6 mb-3">
                            <label for="dateOfLastPromotion" class="form-label">Date of Last Promotion</label>
                            <input type="date" class="form-control" id="dateOfLastPromotion" readonly>
                        </div>
                        <div class="col-lg-4 mb-3">
                            <label for="appointmentStatus" class="form-label">Appointment Status</label>
                            <input type="text" placeholder="Enter appointment status" class="form-control"
                                id="appointmentStatus" readonly>
                        </div>
                        <div class="col-lg-4 mb-3">
                            <label for="unitCode" class="form-label">Unit Code</label>
                            <input type="text" placeholder="Enter unit code" class="form-control" id="unitCode"
                                readonly>
                        </div>
                        <div class="col-lg-4 mb-3">
                            <label for="unitAssignment" class="form-label">Unit Assignment</label>
                            <input type="text" placeholder="Enter unit assignment" class="form-control"
                                id="unitAssignment" readonly>
                        </div>
                        <div class="col-lg-6 mb-3">
                            <label for="designation" class="form-label">Designation</label>
                            <input type="text" placeholder="Enter designation" class="form-control" id="designation"
                                readonly>
                        </div>
                        <div class="col-lg-6 mb-3">
                            <label for="adminOperation" class="form-label">Admin/Operation</label>
                            <input type="text" placeholder="Enter admin/operation" class="form-control"
                                id="adminOperation" readonly>
                        </div>
                        <div class="col-lg-12 mb-3">
                            <label for="remarks" class="form-label">Remarks</label>
                            <textarea type="text" placeholder="Enter remarks" class="form-control" id="remarks"
                                readonly></textarea>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('#pagibig').change(function() {
                var filename = $(this).val().split('\\').pop(); // Get only the filename
                if (filename) {
                    $('#pagibig_filename').val(filename);
                } else {
                    $('#pagibig_filename').val("No file selected");
                }
            });
        });
    </script>
    <x-personnel.preview :category="$active"> </x-personnel.preview>
    <x-personnel.delete :category="$active"> </x-personnel.delete>
@endsection
