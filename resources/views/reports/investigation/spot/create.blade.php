<style>
    .btn-reports {
        width 200px
    }

    .second-div {
        border: 1px solid #e5e5e5;
        padding: 15px;
        margin-bottom: 20px;
    }

    .d-flex {
        display: flex;
    }

    .justify-content-between {
        justify-content: space-between;
    }

    .align-items-center {
        align-items: center;
    }

    /* .preview-image {
        max-width: 200px;
        height: auto;
        margin: 10px;
    } */
</style>
@extends('layouts.user-template')
@section('content')
    <div class="container-fluid">
        <nav aria-label="breadcrumb" class="p-2 fw-bolder">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="">Reports</a></li>
                <li class="breadcrumb-item"><a href="{{ route('investigation.index') }}"> All Investigation Reports</a></li>
                <li class="breadcrumb-item"> <a href="{{ route('investigation.spot.index') }}">Spots Investigation
                        Reports</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit Spots Investigation Reports</li>
            </ol>
        </nav>
        <div class="row justify-content-center">
            <div class="col-lg-11 p-2">
                <div class="row">
                    <form action="{{ route('investigation.spot.store') }}" class="needs-validation" novalidate method="POST">
                        @csrf
                        <input type="hidden" name="afor_id" value="{{ $afor->id }}" id="afor_id{{ $afor->id }}">
                        <div class="row mb-3">
                            <div class="col d-flex justify-content-start px-0">
                                <a href="{{ route('investigation.spot.index') }}" class="btn btn-primary">
                                    <span>
                                        <i class="ti ti-arrow-back"></i>
                                    </span>
                                    <span>Go Back</span>
                                </a>
                            </div>
                        </div>
                        <x-reports.investigation.memo-investigate
                            :station=$station></x-reports.investigation.memo-investigate>

                        <div class="row border border-light-subtle shadow rounded p-4 mb-4 bg-white">
                            {{-- <h3 class="border-bottom border-4 border-secondary pb-2 mb-3">Fire Incident Response Details</h3> --}}
                            <h3 class="border-bottom border-4 border-warning pb-2 mb-3">DETAILS</h3>
                            <h5><i>Date Time and Place of Occurence</i></h5>
                            {{-- <h5>Details</h5> --}}
                            <!-- Corrected "Date of Occurrence" -->
                            {{-- {{dd($afor)}} --}}
                            <div class="col-lg-6 mb-3">
                                <label for="date_occurence" class="form-label">Date of Occurrence</label>
                                <input type="date" id="date_occurence" name="date_occurence"
                                    class="form-control {{ $errors->has('date_occurence') != '' ? 'is-invalid' : '' }}"
                                    value="{{ old('date_occurence') }}" required>
                                @error('date_occurence')
                                    <span class="text-danger alert" role="alert">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Corrected "Time of Occurrence" -->
                            <div class="col-lg-6 mb-3">
                                <label for="time_occurence" class="form-label">Time of Occurrence</label>
                                <input type="text" placeholder="Eg. 2300H" id="time_occurence" name="time_occurence"
                                    class="form-control {{ $errors->has('time_occurence') != '' ? 'is-invalid' : '' }}"
                                    value="{{ old('time_occurence') ?? ($afor->alarm_received ?? '') }}" required>
                                @error('time_occurence')
                                    <span class="text-danger alert" role="alert">{{ $message }}</span>
                                @enderror
                            </div>

                            <hr>

                            <!-- Corrected "Barangay" -->
                            <h5><i>Place of Occurrence</i></h5>
                            <div class="col-lg-6 mb-4">
                                <label for="barangay-select" class="form-label">Barangay</label>
                                <select class="form-select" id="barangay-select" name="barangay" required>
                                    <option value="">-- Select a Barangay --</option>
                                    @foreach ($barangay as $barangay)
                                        <option
                                            {{ old('barangay') ?? ($afor->barangay_name ?? '') == $barangay->name ? 'selected' : '' }}
                                            value="{{ $barangay->name }}">
                                            {{ $barangay->name }} </option>
                                    @endforeach

                                </select>
                                @error('barangay')
                                    <span class="text-danger alert" role="alert">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Corrected "Zone/Street" -->
                            <div class="col-lg-6 mb-4">
                                <label for="zone_street" class="form-label">Zone/Street</label>
                                <input type="text" placeholder="Eg. Zone 4" id="zone_street" name="zone_street"
                                    class="form-control {{ $errors->has('zone_street') != '' ? 'is-invalid' : '' }}"
                                    value="{{ old('zone_street') ?? ($afor->zone ?? '') }}" required>
                                @error('zone_street')
                                    <span class="text-danger alert" role="alert">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Corrected "Other Location/Landmark" -->
                            <div class="col-lg-12 mb-4">
                                <label for="landmark" class="form-label">Other Location/Landmark</label>
                                <input type="text" placeholder="Eg. LCC Mall" id="landmark" name="landmark"
                                    class="form-control {{ $errors->has('landmark') != '' ? 'is-invalid' : '' }}"
                                    value="{{ old('landmark') ?? ($afor->location ?? '') }}" required>
                                @error('landmark')
                                    <span class="text-danger alert" role="alert">{{ $message }}</span>
                                @enderror
                            </div>

                            <hr>

                            <!-- Corrected "Involved" -->
                            <div class="col-lg-6 mb-4">
                                <label for="involved" class="form-label">Involved</label>
                                <input type="text" placeholder="Eg. Residential House" id="involved" name="involved"
                                    class="form-control {{ $errors->has('involved') != '' ? 'is-invalid' : '' }}"
                                    value="{{ old('involved') }}" required>
                                @error('involved')
                                    <span class="text-danger alert" role="alert">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Corrected "Name of Establishment" -->
                            <div class="col-lg-6 mb-4">
                                <label for="name_of_establishment" class="form-label">Name of Establishment</label>
                                <input type="text" placeholder="Eg. Residential House" id="name_of_establishment"
                                    name="name_of_establishment"
                                    class="form-control {{ $errors->has('name_of_establishment') != '' ? 'is-invalid' : '' }}"
                                    value="{{ old('name_of_establishment') }}" required>
                                @error('name_of_establishment')
                                    <span class="text-danger alert" role="alert">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Corrected "Owner" -->
                            <div class="col-lg-6 mb-4">
                                <label for="owner" class="form-label">Owner</label>
                                <input type="text" placeholder="Eg. John Doe" id="owner" name="owner"
                                    class="form-control {{ $errors->has('owner') != '' ? 'is-invalid' : '' }}"
                                    value="{{ old('owner') }}" required>
                                @error('owner')
                                    <span class="text-danger alert" role="alert">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Corrected "Occupant" -->
                            <div class="col-lg-6 mb-4">
                                <label for="occupant" class="form-label">Occupant</label>
                                <input type="text" placeholder="Eg. Jane Doe" id="occupant" name="occupant"
                                    class="form-control {{ $errors->has('occupant') != '' ? 'is-invalid' : '' }}"
                                    value="{{ old('occupant') }}" required>
                                @error('occupant')
                                    <span class="text-danger alert" role="alert">{{ $message }}</span>
                                @enderror
                            </div>

                            <hr>
                            <!-- Corrected "Casualty" -->
                            <h5><i>Casualty</i></h5>
                            <div class="col-lg-6 mb-4">
                                <label for="fatality" class="form-label">Fatality</label>
                                <input type="number" placeholder="Eg. 1" id="fatality" name="fatality"
                                    class="form-control {{ $errors->has('fatality') != '' ? 'is-invalid' : '' }}"
                                    value="{{ old('fatality') ?? ($afor->casualties->sum('death') ?? '') }}" required
                                    min="0">
                                @error('fatality')
                                    <span class="text-danger alert" role="alert">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-lg-6 mb-4">
                                <label for="injured" class="form-label">Injured</label>
                                <input type="number" placeholder="Eg. 3" id="injured" name="injured"
                                    class="form-control {{ $errors->has('injured') != '' ? 'is-invalid' : '' }}"
                                    value="{{ old('injured') ?? ($afor->casualties->sum('injured') ?? '') }}" required
                                    min="0">
                                @error('injured')
                                    <span class="text-danger alert" role="alert">{{ $message }}</span>
                                @enderror
                            </div>

                            <hr>

                            <!-- Corrected "Estimated Damage" -->
                            <div class="col-lg-3 mb-4">
                                <label for="estimate-damage" class="form-label">Estimated Damage</label>
                                <input type="number" placeholder="Eg. 50000" id="estimate-damage"
                                    name="estimate_damage"
                                    class="form-control {{ $errors->has('estimate_damage') != '' ? 'is-invalid' : '' }}"
                                    value="{{ old('estimate_damage') }}" required>
                                @error('estimate_damage')
                                    <span class="text-danger alert" role="alert">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Corrected "Time Fire Started" -->
                            <div class="col-lg-3 mb-4">
                                <label for="time-fire-started" class="form-label">Time Fire Started</label>
                                <input type="text" placeholder="Eg. 2100H" id="time-fire-started"
                                    name="time_fire_start"
                                    class="form-control {{ $errors->has('time_fire_start') != '' ? 'is-invalid' : '' }}"
                                    value="{{ old('time_fire_start') }}" required>
                                @error('time_fire_start')
                                    <span class="text-danger alert" role="alert">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Corrected "Time Fire Out" -->
                            <div class="col-lg-3 mb-4">
                                <label for="time-fire-out" class="form-label">Time Fire Out</label>
                                <input type="text" placeholder="Eg. 2300H" class="form-control" id="time-fire-out"
                                    name="time_fire_out"
                                    class="form-control {{ $errors->has('time_fire_out') != '' ? 'is-invalid' : '' }}"
                                    value="{{ old('time_fire_out') ?? ($afor->td_declared_fireout ?? ' ') }}" required>
                                @error('time_fire_out')
                                    <span class="text-danger alert" role="alert">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Corrected "Alarm" -->
                            <div class="col-lg-3 mb-4">
                                <label for="alarm" class="form-label">First Alarm Status</label>
                                <select name="alarm" class="form-select spotAlarmSelect" id="alarm" required>
                                    <option value="">-- Select an Alarm --</option>
                                    @foreach ($alarms as $item)
                                        <option @if (old('alarm_status_time') == $item->id || ($afor->alarm_status_arrival ?? ' ') == $item->name) selected @endif
                                            value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                                @error('alarm')
                                    <span class="text-danger alert" role="alert">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="row border border-light-subtle shadow rounded p-4 mb-4 bg-white">
                            <h3 class="border-bottom border-4 border-warning pb-2 mb-3">DETAILS OF INVESTIGATION:</h3>
                            {{-- <h5>Details</h5> --}}
                            <div class="col-lg-12 mb-12 pb-5 mb-5">
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
                                    <div id="detailsOfInvestigation">
                                        {!! old('details') !!}

                                    </div>

                                </div>
                                <input type="hidden" id="detail" name="details">
                            </div>
                        </div>
                        <div class="row border border-light-subtle shadow rounded p-4 mb-4 bg-white">
                            <h3 class="border-bottom border-4 border-warning pb-2 mb-3">Disposition:</h3>
                            {{-- <h5>Details</h5> --}}
                            <div class="col-lg-12 mb-12 pb-5 mb-5">
                                <label for="dateTime" class="form-label"></label>
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
                                    <div id="disposition">
                                        {!! old('disposition') !!}
                                    </div>
                                    <input type="hidden" id="dispo" name="disposition">
                                </div>
                            </div>
                        </div>
                        <button id="submit" type="submit" class="btn btn-primary float-end">Submit</button>
                    </form>
                </div>
            </div>
        </div>
        <script>
            $(document).ready(function() {
                $('.spotAlarmSelect').select2();
            });
        </script>
        <script>
            const quillThird = new Quill('#detailsOfInvestigation', {
                theme: 'snow',
                modules: {
                    toolbar: '#toolbar1',
                },

                placeholder: 'Compose an epic...',
            });
        </script>
        <script>
            const quillFourth = new Quill('#disposition', {
                theme: 'snow',
                modules: {
                    toolbar: '#toolbar2',
                },

                placeholder: 'Compose an epic...',
            });
            $("#submit").click(function() {
                $("#detail").val(quillThird.root.innerHTML);
                $("#dispo").val(quillFourth.root.innerHTML);
            });
        </script>
    @endsection
