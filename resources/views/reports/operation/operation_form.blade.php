@extends('layouts.user-template')
@section('content')
    <div class="container-fluid">
        <div class="container-fluid">
            <nav aria-label="breadcrumb" class="p-2">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="">Reports</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('operation.index') }}">Operation Reports</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Create Operation Reports</li>
                    {{-- <li class="breadcrumb-item active" aria-current="page">Operation Reports</li> --}}
                </ol>
            </nav>
            <div class="row justify-content-center">
                <div class="col-lg-11 p-4">
                    <div class="row">
                        <form method="POST" action="{{ route('operation.create') }}" enctype="multipart/form-data"
                            class="needs-validation" novalidate>
                            @csrf

                            <div class="row mb-3">
                                <div class="col d-flex justify-content-start px-0">
                                    <a href="{{ route('operation.index') }}" class="btn btn-primary">
                                        <span>
                                            <i class="ti ti-arrow-back"></i>
                                        </span>
                                        <span>Go Back</span>
                                    </a>
                                </div>
                            </div>

                            <div class="row border border-light-subtle shadow rounded p-4 mb-4 bg-white">
                                <h3 class="border-bottom border-4 border-secondary pb-2 mb-3">Operation Information</h3>
                                <div class="col-lg-6 mb-3">
                                    <label for="alarmReceived" class="form-label">Alarm Received
                                        (Time)</label>
                                    <input type="text" placeholder="Eg. 2300h"
                                        class="form-control text-uppercase {{ $errors->has('alarm_received') != '' ? 'is-invalid' : '' }}"
                                        name="alarm_received" value="{{ old('alarm_received') }}">
                                    @error('alarm_received')
                                        <span class="text-danger alert" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-lg-6 mb-3">
                                    <label for="caller" class="form-label">Originator</label>
                                    <input type="text" placeholder="Eg. Juan Cruz" class="form-control" name="originator"
                                        value="{{ old('originator') }}">
                                </div>
                                <div class="col-lg-6 mb-3">
                                    <label for="caller" class="form-label">Caller/Reported/Transmitted by</label>
                                    <input type="text" placeholder="Eg. Juan Cruz"
                                        class="form-control {{ $errors->has('transmitted_by') != '' ? 'is-invalid' : '' }}"
                                        name="transmitted_by" value="{{ old('transmitted_by') }}">
                                    @error('transmitted_by')
                                        <span class="text-danger alert" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-lg-6 mb-3">
                                    <label for="otherLocation" class="form-label">Office / Address of the Caller</label>
                                    <input type="text" placeholder="Enter the office or address"
                                        class="form-control {{ $errors->has('caller_address') != '' ? 'is-invalid' : '' }}"
                                        name="caller_address" value="{{ old('caller_address') }}">
                                    @error('caller_address')
                                        <span class="text-danger alert" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-lg-6 mb-3">
                                    <label for="officeAddress" class="form-label">Personnel on duty
                                        who received the
                                        alarm</label>
                                    <select
                                        class="form-select personnelReceive {{ $errors->has('received_by') != '' ? 'is-invalid' : '' }}""
                                        name="received_by">
                                        <option value="" selected>Select personnel</option>
                                        @foreach ($personnels as $personnel)
                                            <option value="{{ $personnel->id }}" {{ old('received_by') == $personnel->id ? 'selected' : '' }}>
                                                {{ ($personnel->rank?->slug ?? "Unknown") . ' ' . $personnel->first_name }}
                                                {{ $personnel->last_name }}</option>
                                        @endforeach
                                    </select>
                                    @error('received_by')
                                        <span class="text-danger alert" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-lg-6 mb-3">
                                    <label for="caller" class="form-label">Blotter Number <i>( Format:
                                            {{ $station->blotterNumberTemp }} )</i></label>
                                    <input type="text" class="form-control" placeholder="Enter Blotter Number"
                                        value="{{ old('blotter_number') ?? $station->blotterNumberTemp }}"
                                        name="blotter_number">
                                    @error('blotter_number')
                                        <span class="text-danger alert" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>
                                <hr>
                                <div class="col-lg-6 mb-3">
                                    <label for="officeAddress" class="form-label">Barangay</label>
                                    <select class="form-select barangayApor" aria-label="" name="barangay_name">
                                        <option value="" selected>Select barangay</option>
                                        @foreach ($barangays as $barangay)
                                            <option value="{{ $barangay->name }}" {{ old('barangay_name') == $barangay->name ? 'selected' : '' }}>
                                                {{ $barangay->name }} - {{ $barangay->unit }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-lg-6 mb-3">
                                    <label for="officeAddress" class="form-label">Zone/Street</label>
                                    <input type="text" placeholder="Enter the zone/street" class="form-control"
                                        id="zone" name="zone" value="{{ old('zone') }}">
                                </div>
                                <div class="col-lg-12 mb-3">
                                    <label for="otherLocation" class="form-label">Other
                                        Location / Landmark</label>
                                    <input type="text" placeholder="Enter other location" class="form-control"
                                        id="otherLocation" name="location" value="{{ old('location') }}">
                                </div>
                            </div>
                            <div class="row border border-light-subtle shadow rounded p-4 mb-4 bg-white">
                                <div class="row m-0 p-0" id="divApor">
                                    <div class="row m-0 p-0 border-0" id="addApor">
                                        <h3 class="border-bottom border-4 border-secondary pb-2 mb-3">Engine Dispatched
                                        </h3>
                                        @foreach (old('engine_dispatched', ['']) as $index => $engine)
                                            <div class="row remove-button-container m-0 p-0">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <h5></h5> <button type="button"
                                                        class="btn btn-outline-danger btn-sm float-end remove-section-btn">Remove</button>
                                                </div>
                                                <div class="col-lg-3 mb-3">
                                                    <label for="vehicle" class="form-label">Engine
                                                        Dispatched</label>
                                                    <select class="form-select engineDispatched" aria-label=""
                                                        name="engine_dispatched[]">
                                                        <option value="">Select vehicle</option>
                                                        @foreach ($trucks as $truck)
                                                            <option value="{{ $truck->name }}"
                                                                {{ $truck->name == $engine ? 'selected' : '' }}>
                                                                {{ $truck->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-lg-3 mb-3">
                                                    <label for="timeDispatched" class="form-label">Time
                                                        Dispatched</label>
                                                    <input type="text" placeholder="Eg. 2300h"
                                                        class="form-control text-uppercase" id="timeDispatchedInput"
                                                        name="time_dispatched[]"
                                                        value="{{ old('time_dispatched.' . $index . '') }}">
                                                </div>
                                                <div class="col-lg-3 mb-3">
                                                    <label for="timeArrivedFireScene" class="form-label">Time
                                                        Arrived at Fire Scene</label>
                                                    <input type="text" placeholder="Eg. 2300h"
                                                        class="form-control text-uppercase" id="timeArrivedFireSceneInput"
                                                        name="time_arrived_at_scene[]"
                                                        value="{{ old('time_arrived_at_scene.' . $index . '') }}">
                                                </div>
                                                <div class="col-lg-3 mb-3">
                                                    <label for="responseTime" class="form-label">Response
                                                        Time</label>
                                                    <input type="text" placeholder="Eg. 1900h - 2300h"
                                                        class="form-control text-uppercase" id="responseTimeInput"
                                                        name="response_duration[]"
                                                        value="{{ old('response_duration.' . $index . '') }}">
                                                </div>
                                                <div class="col-lg-4 mb-3">
                                                    <label for="timeReturned" class="form-label">Time Returned
                                                        to Base</label>
                                                    <input type="text" placeholder="Eg. 1900h - 2300h"
                                                        class="form-control text-uppercase" id="timeReturnedInput"
                                                        name="time_return_to_base[]"
                                                        value="{{ old('time_return_to_base.' . $index . '') }}">
                                                </div>
                                                <div class="col-lg-4 mb-3">
                                                    <label for="waterTank" class="form-label">Water Tank
                                                        Refilled (GAL)</label>
                                                    <input type="text" placeholder="Eg. 100 GAL"
                                                        class="form-control text-uppercase" id="waterTankInput"
                                                        name="water_tank_refilled[]"
                                                        value="{{ old('water_tank_refilled.' . $index . '') }}">
                                                </div>
                                                <div class="col-lg-4 mb-3">
                                                    <label for="gasConsumed" class="form-label">Gas Consumed
                                                        (L)
                                                    </label>
                                                    <input type="text" placeholder="Eg. 24l"
                                                        class="form-control text-uppercase" id="gasConsumedInput"
                                                        name="gas_consumed[]"
                                                        value="{{ old('gas_consumed.' . $index . '') }}">
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    {{-- <hr> --}}
                                </div>
                                <div class="row m-0 p-0">
                                    <button type="button" id="addNewDivApor" class="btn btn-primary">+ Add New Fire
                                        Engine
                                        Response Details</button>
                                </div>
                            </div>

                            <!-- Alarm -->
                            <div class="row border border-light-subtle shadow rounded my-3 p-4 bg-white">
                                {{-- <h3 class="border-bottom border-4 border-secondary pb-2 mb-3">3 and
                                9</h3> --}}
                                <h3 class="border-bottom border-4 border-secondary pb-2 mb-3">Alarm Declared</h3>
                                <div class="col-lg-6">
                                    <label for="alarmStatus" class="form-label">Alarm
                                        Status</label>
                                    <select class="form-select alarmStatus" aria-label="" name="alarm_status_arrival">
                                        <option value="" selected>Select alarm status</option>
                                        @foreach ($alarm_list as $list)
                                            <option value="{{ $list->name }}"
                                                {{ $list->name == old('alarm_status_arrival') ? 'selected' : '' }}>
                                                {{ $list->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-lg-6 mb-3">
                                    <label for="firstResponder" class="form-label">First
                                        Responder</label>
                                    <input type="text" placeholder="Enter responder" class="form-control"
                                        id="firstResponderInput" name="first_responder"
                                        value="{{ old('first_responder') }}">
                                </div>
                                <div class="col-lg-6 mb-3">
                                    <label for="underControl" class="form-label">Time / Date Under
                                        Control</label>
                                    <input type="datetime-local" placeholder="" class="form-control"
                                        id="firstResponderInput" name="td_under_control"
                                        value="{{ old('td_under_control') }}">
                                </div>
                                <div class="col-lg-6 mb-3">
                                    <label for="fireOut" class="form-label">Time / Date Declared
                                        Fire Out</label>
                                    <input type="datetime-local" placeholder="" class="form-control"
                                        id="firstResponderInput" name="td_declared_fireout"
                                        value="{{ old('td_declared_fireout') }}">
                                </div>
                                <hr>
                                <div class="row m-0 p-0" id="secondDivApor">
                                    <div class="row m-0 p-0" id="secondAddApor">
                                        <h5>Time Alarm Status Declared</h5>
                                        @foreach (old('alarm_name', ['']) as $index => $alarm_name)
                                            <div class="row second-remove-button-container m-0 p-0">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <h5></h5>
                                                    <button type="button"
                                                        class="btn btn-outline-danger btn-sm float-end second-remove-section-btn">Remove</button>
                                                </div>
                                                <div class="col-lg-4 mb-3">
                                                    <label for="timeAlarmStatusDeclared" class="form-label">Alarm
                                                        Status</label>
                                                    <select class="form-select alarmApor" aria-label=""
                                                        name="alarm_name[]">
                                                        <option value="" selected>Select alarm status</option>
                                                        @foreach ($alarm_list as $list)
                                                            <option value="{{ $list->name }}"
                                                                {{ $list->name == old('alarm_name.' . $index) ? 'selected' : '' }}>
                                                                {{ $list->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-lg-4 mb-3">
                                                    <label for="timeAlarmStatusDeclaredTime"
                                                        class="form-label">Time</label>
                                                    <input type="text" placeholder="Eg. 2300h"
                                                        class="form-control text-uppercase"
                                                        id="timeAlarmStatusDeclaredTime" name="alarm_time[]"
                                                        value="{{ old('alarm_time.' . $index, '') }}">
                                                </div>
                                                <div class="col-lg-4 mb-3">
                                                    <label for="fundCommander" class="form-label">Ground Commander</label>
                                                    <select class="form-select fundCommander" aria-label=""
                                                        name="fund_commander[]">
                                                        <option value="" selected>Select Ground Commander</option>
                                                        @foreach ($personnels as $personnel)
                                                            <option value="{{ $personnel->id }}"
                                                                {{ old('fund_commander.' . $index) == $personnel->id ? 'selected' : '' }}>
                                                                {{ ($personnel->rank?->slug ?? "Unknown") . ' ' . $personnel->first_name . ' ' . $personnel->last_name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    <hr>
                                </div>
                                <div class="row m-0 p-0">
                                    <button type="button" id="addTimeAlarmStatusDeclared"
                                        class="btn btn-primary add-time-alarm-status-button">+ Add
                                        Time Alarm Status</button>
                                </div>
                            </div>

                            <!-- Occupancy -->
                            <div class="row border border-light-subtle shadow rounded my-3 p-4 bg-white">
                                {{-- <h3 class="border-bottom border-4 border-secondary pb-2 mb-3">4-6
                            </h3> --}}
                                <h3 class="border-bottom border-4 border-secondary pb-2 mb-3">Occupancies
                                </h3>
                                <div class="col-lg-6 mb-2">
                                    <label for="typeOfOccupancy" class="form-label">Occupancy Type</label>
                                    <select class="form-select typeOccupancy" aria-label="" name="occupancy_name">
                                        <option value="" selected>Select occupancy name</option>
                                        @foreach ($occupancy_names as $names)
                                            <option value="{{ $names->name }}"
                                                {{ $names->name == old('occupancy_name') ? 'selected' : '' }}>
                                                {{ $names->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-lg-6 mb-2">
                                    <label for="specifyTypeOfOccupancy" class="form-label">Specify</label>
                                    <input type="text" placeholder="Enter the office or address" class="form-control"
                                        name="occupancy_specify" value="{{ old('occupancy_specify') }}">
                                </div>
                                <div class="col-lg-12 mb-3">
                                    <label class="form-label"></label>
                                    <div class="d-flex">
                                        @foreach ($occupancy_types as $type)
                                            <div class="col-lg-4 mb-3 form-check me-5">
                                                <input class="form-check-input" type="radio" name="occupancy_type"
                                                    id="occupancy{{ $type }}" value="{{ $type }}"
                                                    {{ $type == old('occupancy_type') ? 'checked' : '' }}>
                                                <label class="form-check-label"
                                                    for="occupancy{{ $type }}">{{ $type }}</label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                <hr>
                                <div class="col-lg-6 mb-3">
                                    <label for="approxDistanceFireIncident" class="form-label">Approximate Distance of
                                        Fire
                                        Incident from Fire Station (Km)</label>
                                    <input type="text" placeholder="eg. 1.5Km" class="form-control"
                                        name="distance_to_fire_incident" value="{{ old('distance_to_fire_incident') }}">
                                </div>
                                <div class="col-lg-6 mb-3">
                                    <label for="deneralDescriptionStructureInvolved" class="form-label">General
                                        Description of
                                        the structure/s involved</label>
                                    <textarea type="text" placeholder="Enter description" class="form-control" name="structure_description">{{ old('structure_description') }}</textarea>
                                </div>
                            </div>

                            <!-- Casualties -->
                            <div class="row border border-light-subtle shadow rounded my-3 p-4 bg-white">
                                <h3 class="border-bottom border-4 border-secondary pb-2 mb-3">Total Number of Casualty
                                    Reported</h3>
                                <div class="col-lg-6">
                                    <div class="row">
                                        <h5>Civilian</h5>
                                        <div class="col-lg-6 mb-3">
                                            <label for="civilianInjured" class="form-label">Injured</label>
                                            <input type="number" placeholder="No. of injured" class="form-control"
                                                name="civilian_injured" value="{{ old('civilian_injured') }}">
                                        </div>
                                        <div class="col-lg-6 mb-3">
                                            <label for="civilianDeath" class="form-label">Death</label>
                                            <input type="number" placeholder="No. of deaths" class="form-control"
                                                name="civillian_deaths" value="{{ old('civillian_deaths') }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="row">
                                        <h5>Firefighter</h5>
                                        <div class="col-lg-6 mb-3">
                                            <label for="firefighterInjured" class="form-label">Injured</label>
                                            <input type="number" placeholder="No. of injured" class="form-control"
                                                name="firefighter_injured" value="{{ old('firefighter_injured') }}">
                                        </div>
                                        <div class="col-lg-6 mb-3">
                                            <label for="firefighterDeath" class="form-label">Death</label>
                                            <input type="number" placeholder="No. of deaths" class="form-control"
                                                name="firefighter_deaths" value="{{ old('firefighter_deaths') }}">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Material Used -->
                            <div class="row border border-light-subtle shadow rounded my-3 p-4 bg-white">
                                {{-- <h3 class="border-bottom border-4 border-secondary pb-2 mb-3">Equipments Used</h3> --}}
                                <div class="row m-0 p-0" id="divBreathingApparatus">
                                    <div class="row m-0 p-0 border-0" id="addBreathingApparatus">
                                        <h3 class="border-bottom border-4 border-secondary pb-2 mb-3">Breathing Apparatus
                                            Used
                                        </h3>
                                        @foreach (old('breathing', ['']) as $index => $breathing)
                                            <div class="row breathing-remove-button-container m-0 p-0">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <h5></h5>
                                                    <button type="button"
                                                        class="btn btn-outline-danger btn-sm float-end breathing-remove-section-btn">
                                                        Remove</button>
                                                </div>
                                                <div class="col-lg-6 mb-3"> <label for="firefighterDeath"
                                                        class="form-label">No.</label> <input type="number"
                                                        placeholder="No." class="form-control" id="firstResponderInput"
                                                        name="no_breathing[]"
                                                        value="{{ old('no_breathing.' . $index, '') }}">
                                                </div>
                                                <div class="col-lg-6 mb-3"> <label for="firefighterDeath"
                                                        class="form-label">Type
                                                        / Kind</label> <input type="text" placeholder="Enter type"
                                                        class="form-control" id="firstResponderInput" name="breathing[]"
                                                        value="{{ $breathing }}">
                                                </div>
                                                <hr>
                                            </div>
                                            {{-- <hr> --}}
                                        @endforeach
                                    </div>
                                </div>
                                {{-- <hr> --}}
                                <div class="row m-0 p-0">
                                    <button type="button" id="addNewBreathingApparatus" class="btn btn-primary">+ Add
                                        another breathing apparatus used</button>
                                </div>
                            </div>
                            <div class="row border border-light-subtle shadow rounded my-3 p-4 bg-white">
                                {{-- <h3 class="border-bottom border-4 border-secondary pb-2 mb-3">Equipments Used</h3> --}}
                                <div class="row m-0 p-0" id="divExtinguishing">
                                    <div class="row m-0 p-0" id="addExtinguishing">
                                        <h3 class="border-bottom border-4 border-secondary pb-2 mb-3">Extinguishing Agent
                                            Used
                                        </h3>

                                        @foreach (old('extinguishing', ['']) as $index => $extinguishing)
                                            <div class="row extinguishing-remove-button-container m-0 p-0">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <h5></h5>
                                                    <button type="button"
                                                        class="btn btn-outline-danger btn-sm float-end extinguishing-remove-section-btn">Remove</button>
                                                </div>
                                                <div class="col-lg-6 mb-3">
                                                    <label for="firefighterDeath" class="form-label">Quantity</label>
                                                    <input type="number" placeholder="Enter quantity"
                                                        class="form-control" id="firstResponderInput"
                                                        name="quantity_extinguishing[]"
                                                        value="{{ old('quantity_extinguishing.' . $index, '') }}">
                                                </div>
                                                <div class="col-lg-6 mb-3">
                                                    <label for="firefighterDeath" class="form-label">Type /
                                                        Kind</label>
                                                    <input type="text" placeholder="Enter type" class="form-control"
                                                        id="firstResponderInput" name="extinguishing[]"
                                                        value="{{ $extinguishing }}">
                                                </div>
                                                <hr>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                {{-- <hr> --}}
                                <div class="row m-0 p-0">
                                    <button type="button" id="addNewExtinguishingAgent" class="btn btn-primary">+ Add
                                        another extinguishing agent</button>
                                </div>
                            </div>
                            <div class="row border border-light-subtle shadow rounded my-3 p-4 bg-white">
                                {{-- <h3 class="border-bottom border-4 border-secondary pb-2 mb-3">Equipments Used</h3> --}}
                                <div class="row m-0 p-0" id="divRopeLadder">
                                    <div class="row m-0 p-0" id="addRopeLadder">
                                        <h3 class="border-bottom border-4 border-secondary pb-2 mb-3">Rope and Ladder Used
                                        </h3>
                                        @foreach (old('rope_ladder', ['']) as $index => $rope_ladder)
                                            <div class="row rope-ladder-remove-button-container m-0 p-0">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <h5></h5>
                                                    <button type="button"
                                                        class="btn btn-outline-danger btn-sm float-end rope-ladder-remove-section-btn">Remove</button>
                                                </div>
                                                <div class="col-lg-6 mb-3">
                                                    <label for="firefighterDeath" class="form-label">Type</label>
                                                    <input type="text" placeholder="Enter type" class="form-control"
                                                        id="firstResponderInput" name="rope_ladder[]"
                                                        value="{{ $rope_ladder }}">
                                                </div>
                                                <div class="col-lg-6 mb-3">
                                                    <label for="firefighterDeath" class="form-label">Length</label>
                                                    <input type="text" placeholder="Enter length" class="form-control"
                                                        id="firstResponderInput" name="rope_ladder_length[]"
                                                        value="{{ old('rope_ladder_length.' . $index) }}">
                                                </div>
                                                <hr>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                {{-- <hr> --}}
                                <div class="row m-0 p-0">
                                    <button type="button" id="addNewRopeAndLadder" class="btn btn-primary">+ Add another
                                        rope and ladder used</button>
                                </div>
                            </div>
                            <div class="row border border-light-subtle shadow rounded my-3 p-4 bg-white">
                                {{-- <h3 class="border-bottom border-4 border-secondary pb-2 mb-3">Equipments Used</h3> --}}
                                <div class="row m-0 p-0" id="divHoseLine">
                                    <div class="row m-0 p-0" id="addHoseLine">
                                        <h3 class="border-bottom border-4 border-secondary pb-2 mb-3">Hose Line Used</h3>
                                        @foreach (old('type_hose', ['']) as $index => $type_hose)
                                            <div class="row hose-line-remove-button-container m-0 p-0">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <h5></h5>
                                                    <button type="button"
                                                        class="btn btn-outline-danger btn-sm float-end hose-line-remove-section-btn">Remove</button>
                                                </div>
                                                <div class="col-lg-4 mb-3">
                                                    <label for="firefighterDeath" class="form-label">Nr.</label>
                                                    <input type="number" placeholder="No." class="form-control"
                                                        id="firstResponderInput" name="no_hose[]"
                                                        value="{{ old('no_hose.' . $index) }}">
                                                </div>
                                                <div class="col-lg-4 mb-3">
                                                    <label for="firefighterDeath" class="form-label">Type /
                                                        Kind</label>
                                                    <input type="text" placeholder="Type / kind" class="form-control"
                                                        id="firstResponderInput" name="type_hose[]"
                                                        value="{{ $type_hose }}">
                                                </div>
                                                <div class="col-lg-4 mb-3">
                                                    <label for="firefighterDeath" class="form-label">Total
                                                        ft.</label>
                                                    <input type="text" placeholder="Enter total feet"
                                                        class="form-control" id="firstResponderInput" name="hose_feet[]"
                                                        value="{{ old('hose_feet.' . $index) }}">
                                                </div>
                                                <hr>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="row m-0 p-0">
                                    <button type="button" id="addNewHoseLine" class="btn btn-primary">+ Add another hose
                                        line used</button>
                                </div>
                            </div>

                            <!-- Duty Personnel -->
                            <div class="row border border-light-subtle shadow rounded my-3 p-4 bg-white">
                                <h3 class="border-bottom border-4 border-secondary pb-2 mb-3">Duty Personnel at the Fire
                                    Scene</h3>
                                <div class="row m-0 p-0" id="thirdDivApor">
                                    <div class="row m-0 p-0" id="thirdAddApor">
                                        @foreach (old('duty_personnel_id', ['']) as $index => $duty_personnel_id)
                                            <div class="row third-remove-button-container m-0 p-0">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <h5></h5> <button type="button"
                                                        class="btn btn-outline-danger btn-sm float-end third-remove-section-btn">Remove</button>
                                                </div>
                                                <div class="col-lg-6 mb-3"> <label for="fundCommander"
                                                        class="form-label">Rank /
                                                        Name</label> <select class="form-select rankName" aria-label=""
                                                        name="duty_personnel_id[]">
                                                        <option value="" selected>Select Ground Commander</option>
                                                        @foreach ($personnels as $personnel)
                                                            <option value="{{ $personnel->id }}"
                                                                {{ $duty_personnel_id == $personnel->id ? 'selected' : '' }}>
                                                                {{ ($personnel->rank?->slug ?? "Unknown") . ' ' . $personnel->first_name . ' ' . $personnel->last_name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class="col-lg-6 mb-3"> <label for="fundCommander"
                                                        class="form-label">Designation</label> <select
                                                        class="form-select designationSelect" aria-label=""
                                                        name="duty_designation[]">
                                                        <option value="" selected>Select designation</option>
                                                        @foreach ($designations as $designation)
                                                            <option value="{{ $designation->name }}"
                                                                {{ old('duty_designation.' . $index) == $designation->name ? 'selected' : '' }}>
                                                                {{ $designation->name }}
                                                            </option>
                                                        @endforeach
                                                    </select> </div>
                                                <div class="col-lg-12 mb-3"> <label for="firefighterDeath"
                                                        class="form-label">Remarks</label>
                                                    <textarea type="text" placeholder="Remarks" class="form-control" name="duty_remarks[]">{{ old('duty_remarks.' . $index) }}</textarea>
                                                </div>
                                            </div>
                                        @endforeach
                                        <hr>
                                    </div>
                                </div>
                                <div class="row m-0 p-0">
                                    <button type="button" id="addNewDutyPersonnelAtFireScene" class="btn btn-primary">+
                                        Add
                                        another duty
                                        personnel</button>
                                </div>
                            </div>

                            <!-- Photos -->
                            <div class="row border border-light-subtle shadow rounded my-3 p-4 bg-white">
                                {{-- <h3 class="border-bottom border-4 border-secondary pb-2 mb-3">14</h3> --}}
                                <h3 class="border-bottom border-4 border-secondary pb-2 mb-3">Sketch of Fire Operation</h3>
                                <label class="form-label" for="exampleCheck1">Photos</label>
                                <input type="file" class="form-control uncheable" id="photos"
                                    name="sketch_of_fire_operation[]" multiple>
                                <div id="image-preview-container" class="mt-3"></div>
                            </div>

                            <!-- Details narrative -->
                            <input type="hidden" name="details" id="details">
                            <div class="row border border-light-subtle shadow rounded p-4 mb-4 bg-white">
                                <h3 class="border-bottom border-4 border-secondary pb-2 mb-3">Details</h3>
                                {{-- <h3 class="border-bottom border-4 border-secondary pb-2 mb-3">15</h3> --}}
                                <label for="firefighterDeath" class="form-label">Details (Narrative)</label>
                                <div class="col-lg-12 mb-6 pb-5 mb-3">
                                    <label for="dateTime" class="form-label"></label>
                                    <div style="height: 150px;">
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
                                            {!! old('details') !!}
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Problem encounterd -->
                            <input type="hidden" name="problem_encounter" id="problem_encounter">

                            <div class="row border border-light-subtle shadow rounded my-4 p-4 bg-white">
                                <h3 class="border-bottom border-4 border-secondary pb-2 mb-3">Problem/s Encountered During
                                    Operation</h3>
                                {{-- <h3 class="border-bottom border-4 border-secondary pb-2 mb-3">16</h3> --}}
                                <label for="firefighterDeath" class="form-label">Problems / Encountered during
                                    operation:</label>
                                <div class="col-lg-12 mb-6 pb-5 mb-3">
                                    <label for="dateTime" class="form-label"></label>
                                    <div style="height: 150px;">
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
                                            {!! old('problem_encounter') !!}
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Observation Recommendation -->
                            <input type="hidden" name="observation_recommendation" id="observation_recommendation">
                            <div class="row border border-light-subtle shadow rounded my-3 p-4 bg-white">
                                <h3 class="border-bottom border-4 border-secondary pb-2 mb-3">Observations/Recommendations
                                </h3>
                                {{-- <h3 class="border-bottom border-4 border-secondary pb-2 mb-3">17 </h3> --}}
                                <label for="firefighterDeath" class="form-label">Observation / Recommendation</label>
                                <div class="col-lg-12 mb-6 pb-5 mb-3">
                                    <div style="height: 150px;">
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
                                            {!! old('observation_recommendation') !!}
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row border border-light-subtle shadow rounded p-4 mb-4 bg-white">
                                {{-- <h3 class="border-bottom border-4 border-secondary pb-2 mb-3">1</h3> --}}
                                <div class="col-lg-6 mb-3">
                                    <label for="alarmReceived" class="form-label">Prepared By:</label>
                                    <select class="form-select rankName" aria-label="" name="prepared_by">
                                        <option value="" selected>Select personnel</option>
                                        @foreach ($personnels as $personnel)
                                            <option
                                                value="{{ ($personnel->rank?->slug ?? 'Unknown') . ' ' . $personnel->first_name . ' ' . ucfirst(substr($personnel->middle_name, 0, 1)) . ' ' . $personnel->last_name }}"
                                                {{ old('prepared_by') == ($personnel->rank?->slug ?? "Unknown") . ' ' . $personnel->first_name . ' ' . ucfirst(substr($personnel->middle_name, 0, 1)) . ' ' . $personnel->last_name ? 'selected' : '' }}>
                                                {{ ($personnel->rank?->slug ?? 'Unknown') . ' ' . $personnel->first_name . ' ' . ucfirst(substr($personnel->middle_name, 0, 1)) . ' ' . $personnel->last_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-lg-6 mb-3">
                                    <label for="caller" class="form-label">Noted By:</label>
                                    <select class="form-select rankName" aria-label="" name="noted_by">
                                        <option value="" selected>Select personnel</option>
                                        @foreach ($personnels as $personnel)
                                            <option
                                                value="{{ ($personnel->rank?->slug ?? 'Unknown') . ' ' . $personnel->first_name . ' ' . ucfirst(substr($personnel->middle_name, 0, 1)) . ' ' . $personnel->last_name }}"
                                                {{ old('noted_by') == ($personnel->rank?->slug ?? "Unknown") . ' ' . $personnel->first_name . ' ' . ucfirst(substr($personnel->middle_name, 0, 1)) . ' ' . $personnel->last_name ? 'selected' : '' }}>
                                                {{ ($personnel->rank?->slug ?? "Unknown") . ' ' . $personnel->first_name . ' ' . ucfirst(substr($personnel->middle_name, 0, 1)) . ' ' . $personnel->last_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col d-flex justify-content-end px-0">
                                    <button type="submit" id="submit" class="btn btn-success">
                                        <span>
                                            <i class="ti ti-send"></i>
                                        </span>
                                        <span>Submit</span>
                                    </button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>

        <script>
            var parentCounter = 0;
            var childCounter = 0;
            $(document).ready(function() {


                $("#submit").click(function() {
                    $('#details').val(quillFirst.getText().trim());
                    $('#problem_encounter').val(quillSecond.getText().trim());
                    $('#observation_recommendation').val(quillThird.getText().trim());
                });

                // Remove dynamically added input field
                $(document).on('click', '.removeInput', function() {
                    $(this).closest('.col-lg-6').remove();
                });
                $('#divApor').on('click', '.remove-section-btn', function() {
                    // Find the parent div of the clicked remove button and remove it
                    $(this).closest('.remove-button-container').remove();
                });

                $('#addNewDivApor').click(function() {
                    var newDiv = $('#addApor').clone();
                    var mnewDiv = $(
                        '<div class="row remove-button-container m-0 p-0"> <div class="d-flex justify-content-between align-items-center"> <h5></h5> <button type="button" class="btn btn-outline-danger btn-sm float-end remove-section-btn">Remove</button> </div> <div class="col-lg-3 mb-3"> <label for="vehicle" class="form-label">Engine Dispatched</label> <select class="form-select engineDispatched" aria-label="" name="engine_dispatched[]"> <option selected>Select vehicle</option> @foreach ($trucks as $truck) <option value="{{ $truck->name }}"> {{ $truck->name }} </option> @endforeach </select> </div> <div class="col-lg-3 mb-3"> <label for="timeDispatched" class="form-label">Time Dispatched</label> <input type="text" placeholder="Eg. 2300h" class="form-control text-uppercase" id="timeDispatchedInput" name="time_dispatched[]"> </div> <div class="col-lg-3 mb-3"> <label for="timeArrivedFireScene" class="form-label">Time Arrived at Fire Scene</label> <input type="text" placeholder="Eg. 2300h" class="form-control text-uppercase" id="timeArrivedFireSceneInput" name="time_arrived_at_scene[]"> </div> <div class="col-lg-3 mb-3"> <label for="responseTime" class="form-label">Response Time</label> <input type="text" placeholder="Eg. 1900h - 2300h" class="form-control text-uppercase" id="responseTimeInput" name="response_duration[]"> </div> <div class="col-lg-4 mb-3"> <label for="timeReturned" class="form-label">Time Returned to Base</label> <input type="text" placeholder="Eg. 1900h - 2300h" class="form-control text-uppercase" id="timeReturnedInput" name="time_return_to_base[]"> </div> <div class="col-lg-4 mb-3"> <label for="waterTank" class="form-label">Water Tank Refilled (GAL)</label> <input type="text" placeholder="Eg. 1900h - 2300h" class="form-control text-uppercase" id="waterTankInput" name="water_tank_refilled[]"> </div> <div class="col-lg-4 mb-3"> <label for="gasConsumed" class="form-label">Gas Consumed (L)</label> <input type="text" placeholder="Eg. 24l" class="form-control text-uppercase" id="gasConsumedInput" name="gas_consumed[]"> </div> <hr> </div>'
                    );

                    console.log(mnewDiv);
                    $('#divApor').append(mnewDiv);
                    // mnewDiv.find('#closeCrew').prop('disabled', false);

                    // Re-initialize Select2 on the cloned select element
                    mnewDiv.find('.engineDispatched').select2({tags: true});
                });


                $('#secondDivApor').on('click', '.second-remove-section-btn', function() {
                    // Find the parent div of the clicked remove button and remove it
                    $(this).closest('.second-remove-button-container').remove();
                });

                $('#addTimeAlarmStatusDeclared').click(function() {
                    var newDiv = $('#secondAddApor').clone();
                    var mnewDiv = $(
                        '<div class="row second-remove-button-container m-0 p-0"> <div class="d-flex justify-content-between align-items-center"> <h5></h5> <button type="button" class="btn btn-outline-danger btn-sm float-end second-remove-section-btn">Remove</button> </div> <div class="col-lg-4 mb-3"> <label for="timeAlarmStatusDeclared" class="form-label">Alarm Status</label> <select class="form-select alarmApor" aria-label="" name="alarm_name[]"> <option value="" selected>Select alarm status</option> <option value="1st Alarm">1st Alarm</option><option value="2nd Alarm">2nd Alarm</option> <option value="3rd Alarm">3rd Alarm</option> <option value="4th Alarm">4th Alarm</option> <option value="5th Alarm">5th Alarm</option> <option value="Task Force Alpha">Task Force Alpha</option> <option value="Task Force Bravo">Task Force Bravo</option> <option value="Task Force Charlie">Task Force Charlie</option> <option value="Task Force Delta">Task Force Delta</option> <option value="Task Force Echo">Task Force Echo</option> <option value="Task Force Hotel">Task Force Hotel</option> <option value="Task Force India">Task Force India</option> <option value="General Alarm">General Alarm</option> </select> </div> <div class="col-lg-4 mb-3"> <label for="timeAlarmStatusDeclaredTime" class="form-label">Time</label> <input type="text" placeholder="Eg. 2300h" class="form-control text-uppercase" id="timeAlarmStatusDeclaredTime" name="alarm_time[]"> </div> <div class="col-lg-4 mb-3"> <label for="fundCommander" class="form-label">Ground Commander</label> <select class="form-select fundCommander" aria-label="" name="fund_commander[]"> <option selected>Select Ground Commanders</option> @foreach ($personnels as $personnel) <option value="{{ $personnel->id }}"> {{ ($personnel->rank?->slug ?? "Unknown") . ' ' . $personnel->first_name }} {{ $personnel->last_name }}</option> @endforeach </select> </div><hr></div>'
                    );

                    console.log(mnewDiv);
                    $('#secondDivApor').append(mnewDiv);
                    // mnewDiv.find('#closeCrew').prop('disabled', false);

                    // Re-initialize Select2 on the cloned select element
                    mnewDiv.find('.alarmApor').select2();
                    mnewDiv.find('.fundCommander').select2();
                });

                $('#thirdDivApor').on('click', '.third-remove-section-btn', function() {
                    // Find the parent div of the clicked remove button and remove it
                    $(this).closest('.third-remove-button-container').remove();
                });

                $('#addNewDutyPersonnelAtFireScene').click(function() {
                    parentCounter++;
                    childCounter = 0;
                    console.log(parentCounter, childCounter);
                    var newDiv = $('#thirdAddApor').clone();
                    var mnewDiv = $(
                        '<div class="row third-remove-button-container m-0 p-0"> <div class="d-flex justify-content-between align-items-center"> <h5></h5> <button type="button" class="btn btn-outline-danger btn-sm float-end third-remove-section-btn">Remove</button> </div> <div class="col-lg-6 mb-3"> <label for="dutyPersonnel" class="form-label">Rank / Name</label> <select class="form-select rankName" aria-label="" name="duty_personnel_id[]"> <option value="" selected>Select Duty Personnel</option> @foreach ($personnels as $personnel) <option value="{{ $personnel->id }}"> {{ ($personnel->rank?->slug ?? "Unknown") . ' ' . $personnel->first_name }} {{ $personnel->last_name }}</option> @endforeach </select> </div> <div class="col-lg-6 mb-3"> <label for="dutyPersonnel" class="form-label">Designation</label> <select class="form-select designationSelect" aria-label="" name="duty_designations[]"> <option value="" selected>Select designation</option> @foreach ($designations as $designation) <option value="{{ $designation->name }}"> {{ $designation->name }}</option> @endforeach </select> </div> <div class="col-lg-12 mb-3"> <label for="firefighterDeath" class="form-label">Remarks</label> <textarea type="text" placeholder="Remarks" class="form-control" name="duty_remarks[]"></textarea> </div> <hr> </div>'
                    );

                    console.log(mnewDiv);
                    $('#thirdDivApor').append(mnewDiv);
                    // mnewDiv.find('#closeCrew').prop('disabled', false);

                    // Re-initialize Select2 on the cloned select element
                    mnewDiv.find('.rankName').select2();
                    mnewDiv.find('.designationSelect').select2({tags: true});
                });

                $(document).on('click', '.remove-designation', function() {
                    $(this).closest('.col-lg-6').remove();
                });

                $('#photos').on('change', function() {
                    var files = $(this)[0].files; // Get the files selected
                    var container = $('#image-preview-container'); // Get the preview container

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
                                var imgPreview = $(
                                    '<div class="image-preview mb-1">' +
                                    '<img class="img-thumbnail" src="' + e.target.result +
                                    '" alt="' + file.name + '">' +
                                    '</div>'
                                );

                                // Append image preview to the container
                                container.append(imgPreview);

                                // Create filename container with flex layout
                                var fileInfoContainer = $(
                                    '<div class="d-flex justify-content-between align-items-center mb-2 border-bottom pb-2"></div>'
                                );

                                // Filename element
                                var fileInfo = $(
                                    '<div class="file-info flex-grow-1 me-2 text-break">' + file
                                    .name + '</div>');

                                // Remove button
                                var removeBtn = $(
                                    '<button type="button" class="btn btn-sm btn-danger">Remove</button>'
                                );

                                // Append filename and remove button to container
                                fileInfoContainer.append(fileInfo);
                                fileInfoContainer.append(removeBtn);

                                // Append the filename container to the preview container
                                container.append(fileInfoContainer);

                                // Remove button click event
                                removeBtn.click(function() {
                                    imgPreview.remove(); // Remove the image preview
                                    $(this).closest('.d-flex')
                                        .remove(); // Remove the flex container
                                    $('#photos').val(
                                        ''); // Clear the file input (if needed)
                                });
                            };
                        })(file);

                        // Read in the image file as a data URL
                        reader.readAsDataURL(file);
                    }
                });

                $('#divBreathingApparatus').on('click', '.breathing-remove-section-btn', function() {
                    // Find the parent div of the clicked remove button and remove it
                    $(this).closest('.breathing-remove-button-container').remove();
                });

                $('#addNewBreathingApparatus').click(function() {
                    var newDiv = $('#addBreathingApparatus').clone();
                    var mnewDiv = $(
                        '<div class="row breathing-remove-button-container m-0 p-0"> <div class="d-flex justify-content-between align-items-center"> <h5></h5> <button type="button" class="btn btn-outline-danger btn-sm float-end breathing-remove-section-btn">Remove</button> </div> <div class="col-lg-6 mb-3"> <label for="firefighterDeath" class="form-label">No.</label> <input type="number" placeholder="No." class="form-control" id="firstResponderInput" name="no_breathing[]"> </div> <div class="col-lg-6 mb-3"> <label for="firefighterDeath" class="form-label">Type / Kind</label> <input type="text" placeholder="Enter type" class="form-control" id="firstResponderInput" name="breathing[]"> </div> <hr> </div>'
                    );

                    console.log(mnewDiv);
                    $('#divBreathingApparatus').append(mnewDiv);
                });

                $('#divExtinguishing').on('click', '.extinguishing-remove-section-btn', function() {
                    // Find the parent div of the clicked remove button and remove it
                    $(this).closest('.extinguishing-remove-button-container').remove();
                });

                $('#addNewExtinguishingAgent').click(function() {
                    var newDiv = $('#addExtinguishing').clone();
                    var mnewDiv = $(
                        '<div class="row extinguishing-remove-button-container m-0 p-0"> <div class="d-flex justify-content-between align-items-center"> <h5></h5> <button type="button" class="btn btn-outline-danger btn-sm float-end extinguishing-remove-section-btn">Remove</button> </div> <div class="col-lg-6 mb-3"> <label for="firefighterDeath" class="form-label">Quantity</label> <input type="number" placeholder="Enter quantity" class="form-control" id="firstResponderInput" name="quantity_extinguishing[]"> </div> <div class="col-lg-6 mb-3"> <label for="firefighterDeath" class="form-label">Type / Kind</label> <input type="text" placeholder="Enter type" class="form-control" id="firstResponderInput" name="extinguishing[]"> </div> </div>'
                    );

                    console.log(mnewDiv);
                    $('#divExtinguishing').append(mnewDiv);
                });

                $('#divRopeLadder').on('click', '.rope-ladder-remove-section-btn', function() {
                    // Find the parent div of the clicked remove button and remove it
                    $(this).closest('.rope-ladder-remove-button-container').remove();
                });

                $('#addNewRopeAndLadder').click(function() {
                    var newDiv = $('#addRopeLadder').clone();
                    var mnewDiv = $(
                        '<div class="row rope-ladder-remove-button-container m-0 p-0"> <div class="d-flex justify-content-between align-items-center"> <h5></h5> <button type="button" class="btn btn-outline-danger btn-sm float-end rope-ladder-remove-section-btn">Remove</button> </div> <div class="col-lg-6 mb-3"> <label for="firefighterDeath" class="form-label">Type</label> <input type="text" placeholder="Enter type" class="form-control" id="firstResponderInput" name="rope_ladder[]"> </div> <div class="col-lg-6 mb-3"> <label for="firefighterDeath" class="form-label">Length</label> <input type="text" placeholder="Enter length" class="form-control" id="firstResponderInput" name="rope_ladder_length[]"> </div> <hr> </div>'
                    );

                    console.log(mnewDiv);
                    $('#divRopeLadder').append(mnewDiv);
                });

                $('#divHoseLine').on('click', '.hose-line-remove-section-btn', function() {
                    // Find the parent div of the clicked remove button and remove it
                    $(this).closest('.hose-line-remove-button-container').remove();
                });

                $('#addNewHoseLine').click(function() {
                    var newDiv = $('#addHoseLine').clone();
                    var mnewDiv = $(
                        '<div class="row hose-line-remove-button-container m-0 p-0"> <div class="d-flex justify-content-between align-items-center"> <h5></h5> <button type="button" class="btn btn-outline-danger btn-sm float-end hose-line-remove-section-btn">Remove</button> </div> <div class="col-lg-4 mb-3"> <label for="firefighterDeath" class="form-label">Nr.</label> <input type="number" placeholder="No." class="form-control" id="firstResponderInput" name="no_hose[]"> </div> <div class="col-lg-4 mb-3"> <label for="firefighterDeath" class="form-label">Type / Kind</label> <input type="text" placeholder="Type / kind" class="form-control" id="firstResponderInput" name="type_hose[]"> </div> <div class="col-lg-4 mb-3"> <label for="firefighterDeath" class="form-label">Total ft.</label> <input type="text" placeholder="Enter total feet" class="form-control" id="firstResponderInput" name="hose_feet[]"> </div> <hr> </div>'
                    );

                    console.log(mnewDiv);
                    $('#divHoseLine').append(mnewDiv);
                });
            });


            const quillFirst = new Quill('#first', {
                modules: {
                    toolbar: '#toolbar1',
                },
                theme: 'snow',
                placeholder: 'Compose an epic...',
            });

            const quillSecond = new Quill('#second', {
                modules: {
                    toolbar: '#toolbar2',
                },
                theme: 'snow',
                placeholder: 'Compose an epic...',
            });

            const quillThird = new Quill('#third', {
                modules: {
                    toolbar: '#toolbar3',
                },
                theme: 'snow',
                placeholder: 'Compose an epic...',
            });
            
            const forms = document.querySelectorAll('.needs-validation');
            Array.from(forms).forEach(function (form) {
                form.addEventListener('submit', function (event) {
                    if (!form.checkValidity()) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        </script>
    @endsection
