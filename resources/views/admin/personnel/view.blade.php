
@extends('layouts.user-template')
@section('content')
    <div class="container-fluid">
        <nav aria-label="breadcrumb" class="p-2 fw-bolder">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="">Configurations</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.personnel.index') }}">Personnel</a></li>
                <li class="breadcrumb-item active" aria-current="page">View Personnel</li>
            </ol>
        </nav>
        <div class="row justify-content-center">
            <div class="col-lg-11 p-4">
                <div class="row">
                    <div class="row border border-light-subtle shadow rounded p-4 mb-4 bg-white">
                        <div class="col d-flex justify-content-end mb-2">
                            @if ((count($personnel->aforTransmitted ?? []) != 0 || count($personnel->aforReceived ?? []) != 0 || count($personnel->minimalReceived ?? []) != 0) || (count($personnel->minimalLeader ?? []) != 0 || count($personnel->alarmCommand ?? []) != 0 || count($personnel->aforDuty ?? []) != 0))
                            <button type="button" class="btn btn-danger me-2" data-bs-toggle="modal"
                                disabled> <i class="ti ti-x"></i> Invalid</button>
                                @else
                                <button type="button" class="btn btn-danger me-2" data-bs-toggle="modal"
                                    data-bs-target="#deleteModal"><i class="ti ti-trash"></i> Delete</button>
                            @endif
                            <a href="{{ route('admin.personnel.update.form', $personnel->id) }}"
                                class="btn btn-primary">Update Information</a>
                        </div>
                        <h3 class="border-bottom border-4 border-secondary pb-2 mb-3">Personal Details</h3>
                        <div class="col-lg-4">
                            <div class="col-lg-12 mb-3">
                                <img id="personnel-picture" src="/assets/images/personnel_images/{{ $personnel->picture }}"
                                    class="object-fit-cover img-fluid" style="width: 300px; height: 400px;"
                                    alt="Personnel Picture">
                            </div>

                        </div>

                        <div class="col-lg-8">
                            <div class="row">
                                <div class="col-lg-4 mb-3">
                                    <label for="accountNumber" class="form-label">Account Number</label>
                                    <input type="text" placeholder="Enter account number" class="form-control"
                                        id="accountNumber" readonly value="{{ $personnel->account_number }}">
                                </div>
                                <div class="col-lg-4 mb-3">
                                    <label for="itemNumber" class="form-label">Item Number</label>
                                    <input type="text" class="form-control" id="itemNumber" readonly
                                        value="{{ $personnel->item_number }}">
                                </div>
                                <div class="col-lg-4 mb-3">
                                    <label for="rank" class="form-label">Rank</label>
                                    <select class="form-select" id="rank" name="rank" disabled>
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
                                <label class="form-label">Name</label>
                                <div class="row">
                                    <div class="col-lg-3">
                                        <input type="text" class="form-control" id="firstName" readonly
                                            value="{{ $personnel->first_name }}">
                                    </div>
                                    <div class="col-lg-3">
                                        <input type="text" placeholder="Middle Name" class="form-control" id="middleName"
                                            readonly value="{{ $personnel->middle_name }}">
                                    </div>
                                    <div class="col-lg-3">
                                        <input type="text" placeholder="Last Name" class="form-control" id="lastName"
                                            readonly value="{{ $personnel->last_name }}">
                                    </div>
                                    <div class="col-lg-3">
                                        <input type="text" placeholder="Suffix Name" class="form-control" id="suffixName"
                                            readonly value="{{ $personnel->extension }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6 mb-3">
                                    <label for="contactNumber" class="form-label">Contact Number</label>
                                    <input type="text" placeholder="Enter contact number" class="form-control"
                                        id="contactNumber" readonly value="{{ $personnel->contact_number }}">
                                </div>
                                <div class="col-lg-6 mb-3">
                                    <label for="dateOfBirth" class="form-label">Date of Birth</label>
                                    <input type="date" class="form-control" id="dateOfBirth" readonly
                                        value="{{ \Carbon\Carbon::parse($personnel->date_of_birth)->format('Y-m-d') }}">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4 mb-3">
                                    <label for="maritalStatus" class="form-label">Marital Status</label>
                                    <select class="form-select" id="maritalStatus" name="marital_status" disabled>
                                        <option value="" selected>Select marital status</option>
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
                                    <label for="gender" class="form-label">Gender</label>
                                    <select class="form-select" id="gender" name="gender" disabled>
                                        <option value="" selected>Select gender</option>
                                        @foreach ($genders as $gender)
                                            @if ($gender == $personnel->gender)
                                                <option value="{{ $gender }}" selected>{{ $gender }}</option>
                                            @else
                                                <option value="{{ $gender }}">{{ $gender }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-lg-4 mb-3">
                                    <label for="religion" class="form-label">Religion</label>
                                    <input type="text" class="form-control" id="religion" readonly
                                        value="{{ $personnel->religion }}">
                                </div>
                            </div>

                            <div class="col-lg-12 mb-3">
                                <label for="completeAddress" class="form-label">Complete Address</label>
                                <input type="text" placeholder="Enter complete address" class="form-control"
                                    id="completeAddress" readonly value="{{ $personnel->address }}">
                            </div>
                        </div>

                        <h3 class="border-bottom border-4 border-secondary pb-2 mb-3">Educational Details</h3>
                        <div class="col-lg-6 mb-3">
                            <label for="tertiaryCourses" class="form-label">Tertiary Course/s</label>
                            @foreach ($personnel->tertiaries as $tertiary)
                                <input type="text" placeholder="Enter tertiary course/s" class="form-control"
                                    id="tertiaryCourses" readonly value="{{ $tertiary->name }}">
                            @endforeach

                        </div>
                        <div class="col-lg-6 mb-3">
                            <label for="postGraduateCourses" class="form-label">Post Graduate Course/s</label>
                            @foreach ($personnel->courses as $course)
                                <input type="text" placeholder="Enter post graduate course/s" class="form-control" id="postGraduateCourses" readonly value="{{$course->name}}">
                            @endforeach

                        </div>
                        <div class="col-lg-6 mb-3">
                            <label for="highestEligibility" class="form-label">Highest Eligibility</label>
                            <input type="text" placeholder="Enter highest eligibility" class="form-control"
                                id="highestEligibility" readonly value="{{ $personnel->highest_eligibility }}">
                        </div>
                        <div class="col-lg-6 mb-3">
                            <label for="highestTraining" class="form-label">Highest Training</label>
                            <input type="text" placeholder="Enter highest training" class="form-control" id="highestTraining" readonly value="{{$personnel->highest_training}}">
                        </div>
                        <div class="col-lg-6 mb-3">
                            <label for="specializedTraining" class="form-label">Specialized Training</label>
                            <input type="text" placeholder="Enter specialized training" class="form-control" id="specializedTraining" readonly value="{{$personnel->specialized_training}}">
                        </div>
                        <h3 class="border-bottom border-4 border-secondary pb-2 mb-3">Government ID Number</h3>
                        <div class="col-lg-6 mb-3">
                            <label for="tin" class="form-label">TIN</label>
                            <input class="form-control" type="text" id="tin" placeholder="XXX-XXX-XXX"
                                readonly value="{{$personnel->tin}}">
                        </div>
                        <div class="col-lg-6 mb-3">
                            <label for="pagibig" class="form-label">PAGIBIG</label>
                            <input class="form-control" type="text" id="pagibig" placeholder="XXXX-XXXX-XXXX" readonly value="{{$personnel->pagibig}}">
                        </div>
                        <div class="col-lg-6 mb-3">
                            <label for="gsis" class="form-label">GSIS</label>
                            <input class="form-control" type="text" id="gsis" placeholder="XX-XX-XXXXXXX" readonly value="{{$personnel->gsis}}">
                        </div>
                        <div class="col-lg-6 mb-3">
                            <label for="philhealth" class="form-label">PHILHEALTH</label>
                            <input class="form-control" type="text" id="philhealth" placeholder="XX-XXXXXXXXX-X" readonly value="{{$personnel->philhealth}}">
                        </div>
                        <h3 class="border-bottom border-4 border-secondary pb-2 mb-3">Service Details</h3>
                        <div class="col-lg-6 mb-3">
                            <label for="dateEnteredOtherGovtService" class="form-label">Date Entered Other Government
                                Service</label>
                            <input type="date" class="form-control" id="dateEnteredOtherGovtService" readonly value="{{$personnel->date_entered_other_government_service}}">
                        </div>
                        <div class="col-lg-6 mb-3">
                            <label for="dateEnteredFireService" class="form-label">Date Entered Fire Service</label>
                            <input type="date" class="form-control" id="dateEnteredFireService" readonly value="{{$personnel->date_entered_fire_service}}">
                        </div>
                        <div class="col-lg-6 mb-3">
                            <label for="modeOfEntry" class="form-label">Mode of Entry</label>
                            <input type="text" placeholder="Enter mode of entry" class="form-control"
                                id="modeOfEntry" readonly value="{{$personnel->mode_of_entry}}">
                        </div>
                        <div class="col-lg-6 mb-3">
                            <label for="dateOfLastPromotion" class="form-label">Date of Last Promotion</label>
                            <input type="date" class="form-control" id="dateOfLastPromotion" readonly value="{{$personnel->last_date_promotion}}">
                        </div>
                        <div class="col-lg-4 mb-3">
                            <label for="appointmentStatus" class="form-label">Appointment Status</label>
                            <input type="text" placeholder="Enter appointment status" class="form-control" id="appointmentStatus" readonly value="{{$personnel->appointment_status}}">
                        </div>
                        <div class="col-lg-4 mb-3">
                            <label for="unitCode" class="form-label">Unit Code</label>
                            <input type="text" placeholder="Enter unit code" class="form-control" id="unitCode" readonly value="{{$personnel->unit_code}}">
                        </div>
                        <div class="col-lg-4 mb-3">
                            <label for="unitAssignment" class="form-label">Unit Assignment</label>
                            <input type="text" placeholder="Enter unit assignment" class="form-control" id="unitAssignment" readonly value="{{ $personnel->unit_assignment }}">
                        </div>
                        @foreach ($personnel->designations as $designation)
                            <div class="col-lg-12 mb-3">
                                <label for="designation" class="form-label">Designation</label>
                                <input type="text" placeholder="Enter designation" class="form-control"
                                    id="designation" value="{{ $designation->name }}" readonly>
                            </div>
                        @endforeach

                        <div class="col-lg-12 mb-3">
                            <label for="adminOperation" class="form-label">Admin/Operation Remarks</label>
                            <textarea type="text" placeholder="Enter remarks" class="form-control" id="remarks" readonly>{{$personnel->admin_operation_remarks}}</textarea>
                        </div>
                        <h3 class="border-bottom border-4 border-secondary pb-2 mb-3">Uploaded Personal File</h3>

                        <div class="file-item d-flex justify-content-between align-items-center mb-1">
                            @foreach ($files as $file)
                                @if ($file != '')
                                    <span>{{ $file }}</span>
                                    <a class="btn btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#filePreviewPersonnelModal"
                                        data-file="{{ $file }}">Preview</a>
                                @endif
                            @endforeach
                        </div>
                        <hr>
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
            $('#filePreviewPersonnelModal').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget);
                var file = button.data('file');

                var modal = $(this);
                var iframeSrc = "{{ asset('assets/images/personnel_files/') }}" + '/' + file;
                modal.find('iframe').attr('src', iframeSrc);
                // Update other modal fields similarly
            });
        });
    </script>
    <x-personnel.preview :category="$active"> </x-personnel.preview>
    <x-personnel.delete :category="$active" :personnel="$personnel->id"> </x-personnel.delete>
@endsection
