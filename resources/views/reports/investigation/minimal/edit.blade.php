@extends('layouts.user-template')
@section('content')
    <div class="container-fluid">
        <nav aria-label="breadcrumb" class="p-2 fw-bolder">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="">Reports</a></li>
                <li class="breadcrumb-item"><a href="{{ route('investigation.index') }}"> All Investigation Reports</a></li>
                <li class="breadcrumb-item"> <a href="{{ route('investigation.minimal.index') }}">Minimal Investigation
                        Reports</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit Minimal Investigation Reports</li>
            </ol>
        </nav>
        <div class="row justify-content-center">
            <div class="col-lg-11 p-4">
                <div class="row">
                    <form action="{{ route('investigation.minimal.update', ['minimal' => $minimal->id]) }}"
                        class="needs-validation" novalidate method="POST" id="minimalCreate" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="row mb-3">
                            <div class="col d-flex justify-content-start px-0">
                                <a href="{{ route('investigation.minimal.index') }}" class="btn btn-primary">
                                    <span>
                                        <i class="ti ti-arrow-back"></i>
                                    </span>
                                    <span>Go Back</span>
                                </a>
                            </div>
                        </div>

                        <x-reports.investigation.memo-investigate :spot=$minimal
                            :station=$station></x-reports.investigation.memo-investigate>


                        <div class="row border border-light-subtle shadow rounded p-4 mb-4 bg-white">
                            {{-- <h3 class="border-bottom border-4 border-secondary pb-2 mb-3">Fire Incident Response Details</h3> --}}
                            <h3 class="border-bottom border-4 border-warning pb-2 mb-3">DETAILS</h3>
                            {{-- <h5>Details</h5> --}}
                            <div class="col-lg-6 mb-3">
                                <label for="dateTime" class="form-label">Date and Time of Actual Occurrence</label>
                                <input type="text" placeholder="Eg. 06 March 2024 2300h" id="dt_actual_occurence"
                                    name="dt_actual_occurence"
                                    class="form-control {{ $errors->has('dt_actual_occurence') != '' ? 'is-invalid' : '' }}"
                                    value="{{ old('dt_actual_occurence') ?? $minimal->dt_actual_occurence }}" required>
                                @error('dt_actual_occurence')
                                    <span class="text-danger alert" role="alert">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-lg-6 mb-3">
                                <label for="reported" class="form-label">Date and Time Reported</label>
                                <input type="text" placeholder="Eg. 06 March 2024 2300h" id="reported"
                                    name="dt_reported"
                                    class="form-control {{ $errors->has('dt_reported') != '' ? 'is-invalid' : '' }}"
                                    value="{{ old('dt_reported') ?? $minimal->dt_reported }}" required>
                                @error('dt_reported')
                                    <span class="text-danger alert" role="alert">{{ $message }}</span>
                                @enderror

                            </div>
                            <div class="col-lg-6 mb-4">
                                <label for="barangay-select" class="form-label">Barangay</label>
                                {{-- {{ old('barangay') != null ? dd(old('barangay')) : " "}} --}}
                                <select class="form-select " id="barangay-select" name="barangay"
                                    value="{{ old('dt_reported') }}">
                                    <option value="">-- Select a Barangay --</option>
                                    @foreach ($barangay as $barangay)
                                        <option
                                            {{ old('barangay') ?? ($minimal->barangay ?? '') == $barangay->name ? 'selected' : '' }}
                                            value="{{ $barangay->name }}">{{ $barangay->name }}</option>
                                    @endforeach
                                    <!-- Add more barangay options as needed -->
                                </select>
                                @error('barangay')
                                    <span class="text-danger alert" role="alert">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Corrected "Zone/Street" -->
                            <div class="col-lg-6 mb-4">
                                <label for="zone-street" class="form-label">Zone/Street</label>
                                <input type="text" placeholder="Eg. Zone 4" id="zone-street"
                                    name="zone"class="form-control {{ $errors->has('zone') != '' ? 'is-invalid' : '' }}"
                                    value="{{ old('zone') ?? $minimal->street }}" required>
                                @error('zone')
                                    <span class="text-danger alert" role="alert">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Corrected "Other Location/Landmark" -->
                            <div class="col-lg-12 mb-4">
                                <label for="landmark" class="form-label">Other Location/Landmark</label>
                                <input type="text" placeholder="Eg. LCC Mall" id="landmark" name="landmark"
                                    class="form-control {{ $errors->has('landmark') != '' ? 'is-invalid' : '' }}"
                                    value="{{ old('landmark') ?? $location }}" required>
                                @error('landmark')
                                    <span class="text-danger alert" role="alert">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-lg-6 mb-3">
                                <label for="officeAddress" class="form-label">Involved Property/Establishment</label>
                                <input type="text" placeholder=" Eg. Vacant Lot " id="involved_property"
                                    name="involved_property"
                                    class="form-control {{ $errors->has('involved_property') != '' ? 'is-invalid' : '' }}"
                                    value="{{ old('involved_property') ?? $minimal->involved_property }}" required>
                                @error('involved_property')
                                    <span class="text-danger alert" role="alert">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-lg-6 mb-3">
                                <label for="officeAddress" class="form-label">Property Data</label>
                                <input type="text" placeholder=" Eg. Juan Dela Cruz" id="province" name="property_data"
                                    class="form-control {{ $errors->has('property_data') != '' ? 'is-invalid' : '' }}"
                                    value="{{ old('property_data') ?? $minimal->property_data }}" required>
                                @error('property_data')
                                    <span class="text-danger alert" role="alert">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="row border border-light-subtle shadow rounded p-4 mb-4 bg-white">
                            <div class="row m-0 p-0 second-div border-0">
                                <h3 class="border-bottom border-4 border-warning pb-2 mb-3">RESPONSE AND SUPPRESSION DATA
                                </h3>
                                <div class="col-lg-12 mb-3">
                                    <label for="" class="form-label">Receiver</label>
                                    <select class="form-select alarmStatus" aria-label="" name="receiver">
                                        <option value="">Select Personnel</option>
                                        @foreach ($personnels as $personnel)
                                            <option
                                                {{ old('receiver') ?? ($minimal->receiver ?? '') == $personnel->id ? 'selected' : '' }}
                                                value="{{ $personnel->id }}">
                                                {{ $personnel->rank->slug . ' ' . $personnel->first_name . ' ' . $personnel->last_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('receiver')
                                        <span class="text-danger alert" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>
                                <h5 class="  pb-1 mb-3">Caller Information</h5>
                                <div class="col-lg-4 mb-3">
                                    <label for="name" class="form-label">Complete Name</label>
                                    <input type="text" placeholder="Eg. SPO1 joseph d. Santos" name="caller_name"
                                        id="caller_name"
                                        class="form-control {{ $errors->has('caller_name') != '' ? 'is-invalid' : '' }}"
                                        value="{{ old('caller_name') ?? $minimal->caller_name }}" required>
                                    @error('caller_name')
                                        <span class="text-danger alert" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-lg-4 mb-3">
                                    <label for="address" class="form-label">Address</label>
                                    <input type="text" placeholder="Eg. Guinobatan Albay" name="caller_address"
                                        id="caller_address"
                                        class="form-control {{ $errors->has('caller_address') != '' ? 'is-invalid' : '' }}"
                                        value="{{ old('caller_address') ?? $minimal->caller_address }}" required>
                                    @error('caller_address')
                                        <span class="text-danger alert" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-lg-4 mb-3">
                                    <label for="telephone" class="form-label">Telephone</label>
                                    <input type="text" placeholder="Eg. 09xxxxxxxxx" name="caller_number"
                                        id="telephone"
                                        class="form-control {{ $errors->has('caller_number') != '' ? 'is-invalid' : '' }}"
                                        value="{{ old('caller_number') ?? $minimal->caller_number }}" required>
                                    @error('caller_number')
                                        <span class="text-danger alert" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-lg-12 mb-12 p-2 mb-3">
                                    <label for="chief" class="form-label">Notification Originator</label>
                                    <input type="text" placeholder="Eg. Chief Operation"
                                        name="notification_originator" id="chief"
                                        class="form-control {{ $errors->has('notification_originator') != '' ? 'is-invalid' : '' }}"
                                        value="{{ old('notification_originator') ?? $minimal->notification_originator }}"
                                        required>
                                    @error('notification_originator')
                                        <span class="text-danger alert" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>
                                <h5 class="  pb-1 mb-3">First Responding Unit</h5>
                                <div class="col-lg-6 mb-3">
                                    <label for="timeReturned" class="form-label">Truck Deployed</label>
                                    <select class="form-select alarmStatus" aria-label=""
                                        name="first_responding_engine">
                                        <option value="">Select truck</option>
                                        @foreach ($engines as $truck)
                                            <option
                                                {{ old('first_responding_engine') ?? ($minimal->first_responding_engine ?? '') == $truck->id ? 'selected' : '' }}
                                                value="{{ $truck->id }}">{{ $truck->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('first_responding_engine')
                                        <span class="text-danger alert" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-lg-6 mb-3">
                                    <label for="waterTank" class="form-label">Team Leader</label>
                                    <select class="form-select alarmStatus" aria-label=""
                                        name="first_responding_leader">
                                        <option value="">Select Team Leader</option>
                                        @foreach ($personnels as $personnel)
                                            <option
                                                {{ old('first_responding_leader') ?? ($minimal->first_responding_leader ?? '') == $personnel->id ? 'selected' : '' }}
                                                value="{{ $personnel->id }}">
                                                {{ $personnel->rank->slug . ' ' . $personnel->first_name . ' ' . $personnel->last_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('first_responding_leader')
                                        <span class="text-danger alert" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-lg-4 mb-3">
                                    <label for="timeReturned" class="form-label">Time Arrival on Scene</label>
                                    <input type="text" placeholder="Eg. 1900h" name="time_arrival_on_scene"
                                        id="timeReturnedInput"
                                        class="form-control {{ $errors->has('time_arrival_on_scene') != '' ? 'is-invalid' : '' }}"
                                        value="{{ old('time_arrival_on_scene') ?? $minimal->time_arrival_on_scene }}"
                                        required>
                                    @error('time_arrival_on_scene')
                                        <span class="text-danger alert" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-lg-4 mb-3">
                                    <label for="waterTank" class="form-label">Alarm Status</label>
                                    <select class="form-select alarmStatus" aria-label="" name="alarm_status_time">
                                        <option value="">Select alarm status</option>
                                        @foreach ($alarm as $item)
                                            <option
                                                {{ old('alarm_status_time') ?? ($minimal->alarm_status_time ?? '') == $item->id ? 'selected' : '' }}
                                                value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach

                                    </select>
                                    @error('alarm_status_time')
                                        <span class="text-danger alert" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-lg-4 mb-3">
                                    <label for="timeFireOut" class="form-label">Time Fire Out</label>
                                    <input type="text" placeholder="Eg. 0200H" name="Time_Fire_out" id="timeFireOut"
                                        class="form-control {{ $errors->has('Time_Fire_out') != '' ? 'is-invalid' : '' }}"
                                        value="{{ old('Time_Fire_out') ?? $minimal->Time_Fire_out }}" required>
                                    @error('Time_Fire_out')
                                        <span class="text-danger alert" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row border border-light-subtle shadow rounded my-3 p-4 bg-white">
                            {{-- <h3 class="border-bottom border-4 border-secondary pb-2 mb-3">Fire Alarm Status and Response Details</h3> --}}
                            <h3 class="border-bottom border-4 border-warning pb-2 mb-3">INVOLVED PARTIES</h3>

                            <div class="row time-alarm-status-declared-div m-0 p-0">
                                <div class="col-lg-6 mb-6">
                                    <label for="property_owner" class="form-label">Owner of Property/Establishment</label>
                                    <input type="text" placeholder="Eg. Mr. Tomas Hilario" name="property_owner"
                                        id="property_owner"
                                        class="form-control {{ $errors->has('property_owner') != '' ? 'is-invalid' : '' }}"
                                        value="{{ old('property_owner') ?? $minimal->property_owner }}" required>
                                    @error('property_owner')
                                        <span class="text-danger alert" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-lg-6 mb-6">
                                    <label for="property_occupant" class="form-label">Occupant of
                                        Property/Establishment</label>
                                    <input type="text" placeholder="Eg. James Padilla" name="property_occupant"
                                        id="property_occupant"
                                        class="form-control {{ $errors->has('property_occupant') != '' ? 'is-invalid' : '' }}"
                                        value="{{ old('property_occupant') ?? $minimal->property_occupant }}" required>
                                    @error('property_occupant')
                                        <span class="text-danger alert" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row border border-light-subtle shadow rounded p-4 mb-4 bg-white">
                            {{-- <h3 class="border-bottom border-4 border-secondary pb-2 mb-3">Fire Incident Response Details</h3> --}}
                            <h3 class="border-bottom border-4 border-warning pb-2 mb-3">DETAILS OF INVESTIGATION:</h3>
                            {{-- <h5>Details</h5> --}}
                            <div class="col-lg-12 mb-12 pb-5 mb-3">
                                <label for="dateTime" class="form-label"></label>
                                <div>
                                    <div id="toolbar1">
                                        <span class="ql-formats">
                                            <select class="ql-font"></select>
                                            <select class="ql-size"></select>
                                        </span>
                                        <span class="ql-formats">
                                            <button class="ql-bold"></button>
                                            <button class="ql-italic"></button>
                                            <button class="ql-underline"></button>
                                            <button class="ql-strike"></button>
                                        </span>
                                        <span class="ql-formats">
                                            <select class="ql-color"></select>
                                            <select class="ql-background"></select>
                                        </span>
                                        <span class="ql-formats">
                                            <button class="ql-script" value="sub"></button>
                                            <button class="ql-script" value="super"></button>
                                        </span>
                                        <span class="ql-formats">
                                            <button class="ql-header" value="1"></button>
                                            <button class="ql-header" value="2"></button>
                                            <button class="ql-blockquote"></button>
                                            <button class="ql-code-block"></button>
                                        </span>
                                        <span class="ql-formats">
                                            <button class="ql-list" value="ordered"></button>
                                            <button class="ql-list" value="bullet"></button>
                                            <button class="ql-indent" value="-1"></button>
                                            <button class="ql-indent" value="+1"></button>
                                        </span>
                                        <span class="ql-formats">
                                            <button class="ql-direction" value="rtl"></button>
                                            <select class="ql-align"></select>
                                        </span>
                                        <span class="ql-formats">
                                            <button class="ql-link"></button>
                                            <button class="ql-image"></button>
                                            <button class="ql-video"></button>
                                            <button class="ql-formula"></button>
                                        </span>
                                        <span class="ql-formats">
                                            <button class="ql-clean"></button>
                                        </span>
                                    </div>
                                    <div id="first">
                                        {{-- {{dd($minimal)}} --}}
                                        {!! old('details') ?? $minimal->details !!}
                                    </div>

                                </div>

                            </div>
                            @error('details')
                                <span class="text-danger alert" role="alert">{{ $message }}</span>
                            @enderror
                        </div>
                        <input type="hidden" name="details" id="details">

                        <div class="row border border-light-subtle shadow rounded p-4 mb-4 bg-white">
                            {{-- <h3 class="border-bottom border-4 border-secondary pb-2 mb-3">Fire Incident Response Details</h3> --}}
                            <h3 class="border-bottom border-4 border-warning pb-2 mb-3">FINDINGS:</h3>
                            {{-- <h5>Details</h5> --}}
                            <div class="col-lg-12 mb-12 pb-5 mb-3">
                                <label for="date" class="form-label"></label>
                                <div>
                                    <div id="toolbar2">
                                        <span class="ql-formats">
                                            <select class="ql-font"></select>
                                            <select class="ql-size"></select>
                                        </span>
                                        <span class="ql-formats">
                                            <button class="ql-bold"></button>
                                            <button class="ql-italic"></button>
                                            <button class="ql-underline"></button>
                                            <button class="ql-strike"></button>
                                        </span>
                                        <span class="ql-formats">
                                            <select class="ql-color"></select>
                                            <select class="ql-background"></select>
                                        </span>
                                        <span class="ql-formats">
                                            <button class="ql-script" value="sub"></button>
                                            <button class="ql-script" value="super"></button>
                                        </span>
                                        <span class="ql-formats">
                                            <button class="ql-header" value="1"></button>
                                            <button class="ql-header" value="2"></button>
                                            <button class="ql-blockquote"></button>
                                            <button class="ql-code-block"></button>
                                        </span>
                                        <span class="ql-formats">
                                            <button class="ql-list" value="ordered"></button>
                                            <button class="ql-list" value="bullet"></button>
                                            <button class="ql-indent" value="-1"></button>
                                            <button class="ql-indent" value="+1"></button>
                                        </span>
                                        <span class="ql-formats">
                                            <button class="ql-direction" value="rtl"></button>
                                            <select class="ql-align"></select>
                                        </span>
                                        <span class="ql-formats">
                                            <button class="ql-link"></button>
                                            <button class="ql-image"></button>
                                            <button class="ql-video"></button>
                                            <button class="ql-formula"></button>
                                        </span>
                                        <span class="ql-formats">
                                            <button class="ql-clean"></button>
                                        </span>
                                    </div>
                                    <div id="second">
                                        {!! old('findings') ?? $minimal->findings !!}
                                    </div>
                                </div>
                            </div>
                            @error('findings')
                                <span class="text-danger alert" role="alert">{{ $message }}</span>
                            @enderror
                        </div>
                        <input type="hidden" name="findings" id="findings">
                        <div class="row border border-light-subtle shadow rounded p-4 mb-4 bg-white">
                            {{-- <h3 class="border-bottom border-4 border-secondary pb-2 mb-3">Fire Incident Response Details</h3> --}}
                            <h3 class="border-bottom border-4 border-warning pb-2 mb-3">RECOMMENDATION:</h3>
                            {{-- <h5>Details</h5> --}}
                            <div class="col-lg-12 mb-12 pb-5 mb-3">
                                <label for="date" class="form-label"></label>
                                <div>
                                    <div id="toolbar3">
                                        <span class="ql-formats">
                                            <select class="ql-font"></select>
                                            <select class="ql-size"></select>
                                        </span>
                                        <span class="ql-formats">
                                            <button class="ql-bold"></button>
                                            <button class="ql-italic"></button>
                                            <button class="ql-underline"></button>
                                            <button class="ql-strike"></button>
                                        </span>
                                        <span class="ql-formats">
                                            <select class="ql-color"></select>
                                            <select class="ql-background"></select>
                                        </span>
                                        <span class="ql-formats">
                                            <button class="ql-script" value="sub"></button>
                                            <button class="ql-script" value="super"></button>
                                        </span>
                                        <span class="ql-formats">
                                            <button class="ql-header" value="1"></button>
                                            <button class="ql-header" value="2"></button>
                                            <button class="ql-blockquote"></button>
                                            <button class="ql-code-block"></button>
                                        </span>
                                        <span class="ql-formats">
                                            <button class="ql-list" value="ordered"></button>
                                            <button class="ql-list" value="bullet"></button>
                                            <button class="ql-indent" value="-1"></button>
                                            <button class="ql-indent" value="+1"></button>
                                        </span>
                                        <span class="ql-formats">
                                            <button class="ql-direction" value="rtl"></button>
                                            <select class="ql-align"></select>
                                        </span>
                                        <span class="ql-formats">
                                            <button class="ql-link"></button>
                                            <button class="ql-image"></button>
                                            <button class="ql-video"></button>
                                            <button class="ql-formula"></button>
                                        </span>
                                        <span class="ql-formats">
                                            <button class="ql-clean"></button>
                                        </span>
                                    </div>
                                    <div id="third">
                                        {!! old('recommendation') ?? $minimal->recommendation !!}
                                    </div>
                                </div>
                            </div>
                            @error('recommendation')
                                <span class="text-danger alert" role="alert">{{ $message }}</span>
                            @enderror
                        </div>
                        <input type="hidden" name="recommendation" id="recommendation">
                        <div class="row border border-light-subtle shadow rounded my-3 p-4 bg-white">
                            <h3 class="border-bottom border-4 border-warning pb-2 mb-3">Photos</h3>
                            {{-- <label class="form-label" for="exampleCheck1">Photos</label> --}}

                            {{-- {{dd($minimal->photos)}} --}}
                            @unless (count($photos) == 0)
                                <h5 class="text-dark text-bold text-center border-bottom border-2 pb-2 border-secondary">
                                    Current
                                    Photos</h5>

                                {{-- {{ dd('hi') }} --}}
                                @foreach ($photos as $photo)
                                    <div class="image-preview mb-1 col-sm-4" id="photo{{ $loop->index }}">
                                        <img style="height: 350px; object-fit: cover;" class="img-thumbnail w-100"
                                            src="{{ asset('storage/minimal/' . $photo) }}" alt="sample Image">
                                        <div class="d-flex justify-content-end align-items-center mb-2 border-bottom pb-2">
                                            <button data-id="photo{{ $loop->index }}" type="button"
                                                class="btn btn-sm btn-danger float-end"
                                                onclick="removePic(this)">Remove</button>
                                        </div>
                                        <input type="hidden" name="curPhoto[]" value="{{ $photo }}">
                                    </div>
                                @endforeach
                            @endunless
                            <h5 class="text-dark text-bold text-center border-bottom border-2 pb-2 border-secondary mt-5">
                                Add New
                                Photos</h5>

                            <input type="file" class="form-control uncheable" id="photos" name="photos[]"
                                multiple>
                            <div id="photo" class="mt-3 row">
                            </div>
                        </div>
                        @error('photos')
                            <span class="text-danger alert" role="alert">{{ $message }}</span>
                        @enderror

                </div>
                <div class="row">
                    <div class="col d-flex justify-content-end px-0">
                        @if ($user->privilege == 'investigation_admin_chief')
                            <button type="submit" id="submit" class="btn btn-success">
                                <span>
                                    <i class="ti ti-send"></i>
                                </span>
                                <span>Submit</span>
                            </button>
                        @else
                            <button data-bs-toggle="modal" data-bs-target="#passUpdateModal" type="button" id="submit" class="btn btn-success">
                                <span>
                                    <i class="ti ti-send"></i>
                                </span>
                                <span>Submit</span>
                            </button>
                            <x-reports.investigation.passcode></x-reports.investigation.passcode>
                        @endif

                    </div>
                </div>

                </form>
            </div>
        </div>
    </div>
    </div>
    <script>
        $(document).ready(function() {
            var input = document.getElementById('telephone');

            // Listen for input events
            input.addEventListener('input', function() {
                // Remove any non-numeric characters
                this.value = this.value.replace(/\D/g, '');

                // Limit the input to exactly 11 digits
                if (this.value.length > 11) {
                    this.value = this.value.slice(0, 11);
                }
            });
            var hiddenInput = document.getElementById('editorContent');

            $("#submit").click(function() {
                $("#details").val($("#first").text());
                $("#findings").val($("#second").html());
                $("#recommendation").val($("#third").html());
            });
            const quillFirst = new Quill('#first', {
                modules: {
                    toolbar: '#toolbar1',
                },
                theme: 'snow',
                placeholder: 'Compose an epic...',
            });
            const quillSecond = new Quill('#second', {
                theme: 'snow',
                modules: {
                    toolbar: '#toolbar2',
                },

                placeholder: 'Compose an epic...',
            });
            const quillThird = new Quill('#third', {
                theme: 'snow',
                modules: {
                    toolbar: '#toolbar3',
                },

                placeholder: 'Compose an epic...',
            });
            // console.log($("#details").val());
            $("#submit").click(function() {
                $("#details").val(quillFirst.root.innerHTML);
                $("#findings").val(quillSecond.root.innerHTML);
                $("#recommendation").val(quillThird.root.innerHTML);
            });

            $('#photos').on('change', function() {
                var files = $(this)[0].files; // Get the files selected
                var container = $('#photo'); // Get the preview container

                // Clear previous previews
                container.empty();

                // Loop through each file
                for (var i = 0; i < files.length; i++) {
                    var file = files[i];
                    var reader = new FileReader();

                    // Closure to capture the file information.
                    reader.onload = (function(file) {
                        return function(e) {
                            // Create image preview
                            var mainContainer = $(
                                '<div class="image-preview mb-1  col-sm-4"></div>')
                            var imgPreview = $(
                                '<img style="height: 350px; object-fit: cover;" class="img-thumbnail w-100" src="' +
                                e.target
                                .result +
                                '" alt="' + file.name + '">'
                            );
                            mainContainer.append(imgPreview);

                            // Append image preview to the container
                            // container.append(imgPreview);

                            // Create filename container with flex layout
                            var fileInfoContainer = $(
                                '<div class="d-flex justify-content-between align-items-center mb-2 border-bottom pb-2"></div>'
                            );

                            // Filename element
                            var fileInfo = $(
                                '<div class="file-info flex-grow-1 me-2 text-break">' + file
                                .name + '</div>');

                            // Remove button
                            // var removeBtn = $(
                            //     '<button type="button" class="btn btn-sm btn-danger">Remove</button>'
                            // );

                            // Append filename and remove button to container
                            fileInfoContainer.append(fileInfo);
                            // fileInfoContainer.append(removeBtn);
                            mainContainer.append(fileInfoContainer);
                            // Append the filename container to the preview container
                            container.append(mainContainer);
                        };
                    })(file);

                    // Read in the image file as a data URL
                    reader.readAsDataURL(file);
                }
            });
        });

        function removePic(btn) {
            const photo = $("#" + $(btn).data('id'));
            photo.remove();
            console.log(photo);
        }
    </script>
@endsection
