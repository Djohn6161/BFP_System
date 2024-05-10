@extends('layouts.user-template')
@section('content')
    <div class="container-fluid">
        <div class="col d-flex justify-content-start mb-2">
            <a href="{{ route('operation.index') }}" class="btn btn-primary">Back</a>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-11 p-4">
                <div class="row">
                    <form method="POST" action="{{ route('operation.update') }}" enctype="multipart/form-data">
                        @csrf 
                        
                        <!-- Intro -->
                        <div class="row border border-light-subtle shadow rounded p-4 mb-4">
                            <h3 class="border-bottom border-4 border-secondary pb-2 mb-3">1</h3>
                            <div class="col-lg-6 mb-3">
                                <label for="alarmReceived" class="form-label">Alarm Received
                                    (Time)</label>
                                <input type="hidden" name="operation_id" value="{{ $operation->id }}">
                                <input type="text" placeholder="Eg. 2300h" class="form-control text-uppercase"
                                    name="alarm_received" value="{{ $operation->alarm_received }}">
                            </div>
                            <div class="col-lg-6 mb-3">
                                <label for="caller" class="form-label">Caller/Reported/Transmitted by:</label>
                                <input type="text" placeholder="Eg. Juan Cruz" class="form-control" name="transmitted_by"
                                    value="{{ $operation->transmitted_by }}">
                            </div>
                            <div class="col-lg-6 mb-3">
                                <label for="otherLocation" class="form-label">Office / Address of the Caller</label>
                                <input type="text" placeholder="Enter the office or address" class="form-control"
                                    name="caller_address" value="{{ $operation->caller_address }}">
                            </div>
                            <div class="col-lg-6 mb-3">
                                <label for="officeAddress" class="form-label">Personnel on duty
                                    who received the
                                    alarm</label>
                                <select class="form-select personnelReceive" aria-label="" name="received_by">
                                    <option value="" selected>Select personnel</option>
                                    @foreach ($personnels as $personnel)
                                        @if ($personnel->id == $operation->received_by)
                                            <option selected value="{{ $personnel->id }}">
                                                {{ $personnel->rank->slug . ' ' . $personnel->first_name }}
                                                {{ $personnel->last_name }}</option>
                                        @else
                                            <option value="{{ $personnel->id }}">
                                                {{ $personnel->rank->slug . ' ' . $personnel->first_name }}
                                                {{ $personnel->last_name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <hr>
                            <div class="col-lg-6 mb-3">
                                <label for="officeAddress" class="form-label">Barangay</label>
                                <select class="form-select barangayApor" aria-label="" name="barangay_name">
                                    <option value="" selected>Select barangay</option>
                                    @foreach ($barangays as $barangay)
                                        @if ($barangay->name == $operation->barangay_name)
                                            <option selected value="{{ $barangay->name }}">
                                                {{ $barangay->name }} - {{ $barangay->unit }}
                                            </option>
                                        @else
                                            <option value="{{ $barangay->name }}">
                                                {{ $barangay->name }} - {{ $barangay->unit }}
                                            </option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-lg-6 mb-3">
                                <label for="officeAddress" class="form-label">Zone/Street</label>
                                <input type="text" placeholder="Enter the zone/street" class="form-control"
                                    id="zone" name="zone" value="{{ $operation->zone }}">
                            </div>
                            <div class="col-lg-12 mb-3">
                                <label for="otherLocation" class="form-label">Other
                                    Location / Landmark</label>
                                <input type="text" placeholder="Enter other location" class="form-control"
                                    id="otherLocation" name="location" value="{{ $operation->location }}">
                            </div>
                        </div>

                        {{-- Response --}}
                        <div class="row border border-light-subtle shadow rounded p-4 mb-4">
                            <div class="row m-0 p-0" id="divApor">
                                <div class="row m-0 p-0 border-0" id="addApor">
                                    <h3 class="border-bottom border-4 border-secondary pb-2 mb-3">2
                                    </h3>
                                    @foreach ($responses as $response)
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
                                                        @if ($truck->id == $response->engine_dispatched)
                                                            <option selected value="{{ $truck->id }}">
                                                                {{ $truck->name }}
                                                            </option>
                                                        @else
                                                            <option value="{{ $truck->id }}">
                                                                {{ $truck->name }}
                                                            </option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-lg-3 mb-3">
                                                <label for="timeDispatched" class="form-label">Time
                                                    Dispatched</label>
                                                <input type="text" placeholder="Eg. 2300h"
                                                    class="form-control text-uppercase" id="timeDispatchedInput"
                                                    name="time_dispatched[]" value="{{ $response->time_dispatched }}">
                                            </div>
                                            <div class="col-lg-3 mb-3">
                                                <label for="timeArrivedFireScene" class="form-label">Time
                                                    Arrived at Fire Scene</label>
                                                <input type="text" placeholder="Eg. 2300h"
                                                    class="form-control text-uppercase" id="timeArrivedFireSceneInput"
                                                    name="time_arrived_at_scene[]"
                                                    value="{{ $response->time_arrived_at_scene }}">
                                            </div>
                                            <div class="col-lg-3 mb-3">
                                                <label for="responseTime" class="form-label">Response
                                                    Time</label>
                                                <input type="text" placeholder="Eg. 1900h - 2300h"
                                                    class="form-control text-uppercase" id="responseTimeInput"
                                                    name="response_duration[]"
                                                    value="{{ $response->response_duration }}">
                                            </div>
                                            <div class="col-lg-4 mb-3">
                                                <label for="timeReturned" class="form-label">Time Returned
                                                    to Base</label>
                                                <input type="text" placeholder="Eg. 1900h - 2300h"
                                                    class="form-control text-uppercase" id="timeReturnedInput"
                                                    name="time_return_to_base[]"
                                                    value="{{ $response->time_return_to_base }}">
                                            </div>
                                            <div class="col-lg-4 mb-3">
                                                <label for="waterTank" class="form-label">Water Tank
                                                    Refilled (GAL)</label>
                                                <input type="text" placeholder="Eg. 1900h - 2300h"
                                                    class="form-control text-uppercase" id="waterTankInput"
                                                    name="water_tank_refilled[]"
                                                    value="{{ $response->water_tank_refilled }}">
                                            </div>
                                            <div class="col-lg-4 mb-3">
                                                <label for="gasConsumed" class="form-label">Gas Consumed
                                                    (L)
                                                </label>
                                                <input type="text" placeholder="Eg. 24l"
                                                    class="form-control text-uppercase" id="gasConsumedInput"
                                                    name="gas_consumed[]" value="{{ $response->gas_consumed }}">
                                            </div>
                                            <hr>
                                        </div>
                                    @endforeach

                                </div>
                            </div>
                            <div class="row m-0 p-0">
                                <button type="button" id="addNewDivApor" class="btn btn-primary">+ Add New Fire Engine
                                    Response Details</button>
                            </div>
                        </div>

                        <!-- Alarm -->
                        <div class="row border border-light-subtle shadow rounded my-3 p-4">
                            <h3 class="border-bottom border-4 border-secondary pb-2 mb-3">3 and
                                9</h3>
                            <div class="col-lg-6">
                                <label for="alarmStatus" class="form-label">Alarm
                                    Status</label>
                                <select class="form-select alarmStatus" aria-label="" name="alarm_status_arrival">
                                    <option value="" selected>Select alarm status</option>
                                    @foreach ($alarm_list as $list)
                                        @if ($list->name == $operation->alarm_status_arrival)
                                            <option selected value="{{ $list->name }}" selected>{{ $list->name }}
                                            </option>
                                        @else
                                            <option value="{{ $list->name }}">{{ $list->name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-lg-6 mb-3">
                                <label for="firstResponder" class="form-label">First
                                    Responder</label>
                                <input type="text" placeholder="Enter responder" class="form-control"
                                    id="firstResponderInput" name="first_responder"
                                    value="{{ $operation->first_responder }}">
                            </div>
                            <div class="col-lg-6 mb-3">
                                <label for="underControl" class="form-label">Time / Date Under
                                    Control</label>
                                <input type="datetime-local" placeholder="" class="form-control"
                                    id="firstResponderInput" name="td_under_control"
                                    value="{{ $operation->td_under_control }}">
                            </div>
                            <div class="col-lg-6 mb-3">
                                <label for="fireOut" class="form-label">Time / Date Declared
                                    Fire Out</label>
                                <input type="datetime-local" placeholder="" class="form-control"
                                    id="firstResponderInput" name="td_declared_fireout"
                                    value="{{ $operation->td_under_control }}">
                            </div>
                            <hr>
                            <div class="row m-0 p-0" id="secondDivApor">
                                <div class="row m-0 p-0" id="secondAddApor">
                                    <h5>Time Alarm Status Declared</h5>
                                    @foreach ($declared_alarms as $declared)
                                        <div class="row second-remove-button-container m-0 p-0">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <h5></h5> <button type="button"
                                                    class="btn btn-outline-danger btn-sm float-end second-remove-section-btn">Remove</button>
                                            </div>
                                            <div class="col-lg-4 mb-3">
                                                <label for="timeAlarmStatusDeclared" class="form-label">Alarm
                                                    Status</label>
                                                <select class="form-select alarmApor" aria-label="" name="alarm_name[]">
                                                    <option value="" selected>Select alarm status</option>
                                                    @foreach ($alarm_list as $list)
                                                        @if ($list->name == $declared->alarm_name)
                                                            <option selected value="{{ $list->name }}" selected>
                                                                {{ $list->name }}
                                                            </option>
                                                        @else
                                                            <option value="{{ $list->name }}">{{ $list->name }}
                                                            </option>
                                                        @endif
                                                    @endforeach

                                                </select>
                                            </div>
                                            <div class="col-lg-4 mb-3">
                                                <label for="timeAlarmStatusDeclaredTime" class="form-label">Time</label>
                                                <input type="text" placeholder="Eg. 2300h"
                                                    class="form-control text-uppercase" id="timeAlarmStatusDeclaredTime"
                                                    name="alarm_time[]" value="{{ $declared->time }}">
                                            </div>
                                            <div class="col-lg-4 mb-3">
                                                <label for="fundCommander" class="form-label">Fund
                                                    Commander</label>
                                                <select class="form-select fundCommander" aria-label=""
                                                    name="fund_commander[]">
                                                    <option value="" selected>Select Fund Commanders</option>
                                                    @foreach ($personnels as $personnel)
                                                        @if ($personnel->id == $declared->ground_commander)
                                                            <option selected value="{{ $personnel->id }}">
                                                                {{ $personnel->rank->slug . ' ' . $personnel->first_name }}
                                                                {{ $personnel->last_name }}</option>
                                                        @else
                                                            <option value="{{ $personnel->id }}">
                                                                {{ $personnel->rank->slug . ' ' . $personnel->first_name }}
                                                                {{ $personnel->last_name }}</option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="row m-0 p-0">
                                <button type="button" id="addTimeAlarmStatusDeclared"
                                    class="btn btn-primary add-time-alarm-status-button">+ Add
                                    Time Alarm Status</button>
                            </div>
                        </div>

                        <!-- Occupancy -->
                        <div class="row border border-light-subtle shadow rounded my-3 p-4">
                            <h3 class="border-bottom border-4 border-secondary pb-2 mb-3">4-6
                            </h3>
                            <div class="col-lg-6 mb-3">
                                <label for="typeOfOccupancy" class="form-label">Type of
                                    Occupancy</label>
                                <select class="form-select typeOccupancy" aria-label="" name="occupancy_name">
                                    <option value="">Select type of occupancy</option>
                                    @foreach ($occupancy_names as $names)
                                        @if ($names->name == $occupancy->occupancy_name)
                                            <option selected value="{{ $names->name }}">{{ $names->name }}</option>
                                        @else
                                            <option value="{{ $names->name }}">{{ $names->name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-lg-6 mb-3">
                                <label for="specifyTypeOfOccupancy" class="form-label">Specify</label>
                                <input type="text" placeholder="Enter the office or address" class="form-control"
                                    name="occupancy_specify" value="{{ $occupancy->specify }}">
                            </div>
                            <hr>
                            <div class="col-lg-6 mb-3">
                                <label for="approxDistanceFireIncident" class="form-label">Approximate Distance of Fire
                                    Incident from Fire Station (Km)</label>
                                <input type="text" placeholder="eg. 1.5Km" class="form-control"
                                    name="distance_to_fire_incident" value="{{ $occupancy->distance }}">
                            </div>
                            <div class="col-lg-6 mb-3">
                                <label for="deneralDescriptionStructureInvolved" class="form-label">General Description of
                                    the structure/s involved</label>
                                <textarea type="text" placeholder="Enter description" class="form-control" name="structure_description"
                                    aria-valuemax="">{{ $occupancy->description }}</textarea>
                            </div>
                        </div>

                        <!-- Casualties -->
                        <div class="row border border-light-subtle shadow rounded my-3 p-4">
                            {{-- <h3 class="border-bottom border-4 border-secondary pb-2 mb-3">Total Number of Casualty Reported</h3> --}}
                            <h3 class="border-bottom border-4 border-secondary pb-2 mb-3">7
                            </h3>

                            @foreach ($casualties as $casualty)
                                @if ($casualty->type == 'civilian')
                                    <div class="col-lg-6">
                                        <div class="row">
                                            <h5>Civilian</h5>
                                            <div class="col-lg-6 mb-3">
                                                <label for="civilianInjured" class="form-label">Injured</label>
                                                <input type="number" placeholder="No. of injured" class="form-control"
                                                    name="civilian_injured" value="{{ $casualty->injured }}">
                                            </div>
                                            <div class="col-lg-6 mb-3">
                                                <label for="civilianDeath" class="form-label">Death</label>
                                                <input type="number" placeholder="No. of deaths" class="form-control"
                                                    name="civilian_deaths" value="{{ $casualty->death }}">
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <div class="col-lg-6">
                                        <div class="row">
                                            <h5>Firefighter</h5>
                                            <div class="col-lg-6 mb-3">
                                                <label for="firefighterInjured" class="form-label">Injured</label>
                                                <input type="number" placeholder="No. of injured" class="form-control"
                                                    name="firefighter_injured" value="{{ $casualty->injured }}">
                                            </div>
                                            <div class="col-lg-6 mb-3">
                                                <label for="firefighterDeath" class="form-label">Death</label>
                                                <input type="number" placeholder="No. of deaths" class="form-control"
                                                    name="firefighter_deaths" value="{{ $casualty->death }}">
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach

                        </div>

                        <!-- Material Used -->
                        <div class="row border border-light-subtle shadow rounded my-3 p-4">
                            {{-- <h3 class="border-bottom border-4 border-secondary pb-2 mb-3">Equipments Used</h3> --}}
                            <div class="row m-0 p-0" id="divBreathingApparatus">
                                <div class="row m-0 p-0 border-0" id="addBreathingApparatus">
                                    <h3 class="border-bottom border-4 border-secondary pb-2 mb-3">Breathing
                                        Apparatus Used
                                    </h3>
                                    @foreach ($used_equipments as $equipment)
                                        @if ($equipment->category == 'breathing apparatus')
                                            <div class="row breathing-remove-button-container m-0 p-0">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <h5></h5> <button type="button"
                                                        class="btn btn-outline-danger btn-sm float-end breathing-remove-section-btn">Remove</button>
                                                </div>
                                                <div class="col-lg-6 mb-3"> <label for="firefighterDeath"
                                                        class="form-label">No.</label> <input type="number"
                                                        placeholder="No." class="form-control" id="firstResponderInput"
                                                        name="no_breathing[]" value="{{ $equipment->quantity }}">
                                                </div>
                                                <div class="col-lg-6 mb-3"> <label for="firefighterDeath"
                                                        class="form-label">Type
                                                        / Kind</label> <input type="text" placeholder="Enter type"
                                                        class="form-control" id="firstResponderInput" name="breathing[]"
                                                        value="{{ $equipment->type }}">
                                                </div>
                                                <hr>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                            <div class="row m-0 p-0">
                                <button type="button" id="addNewBreathingApparatus" class="btn btn-primary">+ Add
                                    another breathing apparatus used</button>
                            </div>
                        </div>
                        <div class="row border border-light-subtle shadow rounded my-3 p-4">
                            {{-- <h3 class="border-bottom border-4 border-secondary pb-2 mb-3">Equipments Used</h3> --}}
                            <div class="row m-0 p-0" id="divExtinguishing">
                                <div class="row m-0 p-0" id="addExtinguishing">
                                    <h3 class="border-bottom border-4 border-secondary pb-2 mb-3">Extinguishing Agent
                                        Used
                                    </h3>
                                    @foreach ($used_equipments as $equipment)
                                        @if ($equipment->category == 'extinguishing agent')
                                            <div class="row extinguishing-remove-button-container m-0 p-0">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <h5></h5> <button type="button"
                                                        class="btn btn-outline-danger btn-sm float-end extinguishing-remove-section-btn">Remove</button>
                                                </div>
                                                <div class="col-lg-6 mb-3">
                                                    <label for="firefighterDeath" class="form-label">Quantity</label>
                                                    <input type="number" placeholder="Enter quantity"
                                                        class="form-control" id="firstResponderInput"
                                                        name="quantity_extinguishing[]"
                                                        value="{{ $equipment->quantity }}">
                                                </div>
                                                <div class="col-lg-6 mb-3">
                                                    <label for="firefighterDeath" class="form-label">Type /
                                                        Kind</label>
                                                    <input type="text" placeholder="Enter type" class="form-control"
                                                        id="firstResponderInput" name="extinguishing[]"
                                                        value="{{ $equipment->type }}">
                                                </div>
                                                <hr>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            </div>

                            <div class="row m-0 p-0">
                                <button type="button" id="addNewExtinguishingAgent" class="btn btn-primary">+ Add
                                    another extinguishing agent</button>
                            </div>
                        </div>
                        <div class="row border border-light-subtle shadow rounded my-3 p-4">
                            {{-- <h3 class="border-bottom border-4 border-secondary pb-2 mb-3">Equipments Used</h3> --}}
                            <div class="row m-0 p-0" id="divRopeLadder">
                                <div class="row m-0 p-0" id="addRopeLadder">
                                    <h3 class="border-bottom border-4 border-secondary pb-2 mb-3">Rope and Ladder Used</h3>
                                    @foreach ($used_equipments as $equipment)
                                        @if ($equipment->category == 'rope and ladder')
                                            <div class="row rope-ladder-remove-button-container m-0 p-0">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <h5></h5> <button type="button"
                                                        class="btn btn-outline-danger btn-sm float-end rope-ladder-remove-section-btn">Remove</button>
                                                </div>
                                                <div class="col-lg-6 mb-3">
                                                    <label for="firefighterDeath" class="form-label">Type</label>
                                                    <input type="text" placeholder="Enter type" class="form-control"
                                                        id="firstResponderInput" name="rope_ladder[]"
                                                        value="{{ $equipment->type }}">
                                                </div>
                                                <div class="col-lg-6 mb-3">
                                                    <label for="firefighterDeath" class="form-label">Length</label>
                                                    <input type="text" placeholder="Enter length" class="form-control"
                                                        id="firstResponderInput" name="rope_ladder_length[]"
                                                        value="{{ $equipment->length }}">
                                                </div>
                                                <hr>
                                            </div>
                                        @endif
                                    @endforeach

                                </div>
                            </div>
                            <div class="row m-0 p-0">
                                <button type="button" id="addNewRopeAndLadder" class="btn btn-primary">+ Add another
                                    rope and ladder used</button>
                            </div>
                        </div>
                        <div class="row border border-light-subtle shadow rounded my-3 p-4">
                            {{-- <h3 class="border-bottom border-4 border-secondary pb-2 mb-3">Equipments Used</h3> --}}

                            <div class="row m-0 p-0" id="divHoseLine">
                                <div class="row m-0 p-0" id="addHoseLine">
                                    <h3 class="border-bottom border-4 border-secondary pb-2 mb-3">Hose Line Used</h3>
                                    @foreach ($used_equipments as $equipment)
                                        @if ($equipment->category == 'hose line')
                                            <div class="row hose-line-remove-button-container m-0 p-0">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <h5></h5> <button type="button"
                                                        class="btn btn-outline-danger btn-sm float-end hose-line-remove-section-btn">Remove</button>
                                                </div>
                                                <div class="col-lg-4 mb-3">
                                                    <label for="firefighterDeath" class="form-label">No.</label>
                                                    <input type="number" placeholder="No." class="form-control"
                                                        id="firstResponderInput" name="no_hose[]"
                                                        value="{{ $equipment->quantity }}">
                                                </div>
                                                <div class="col-lg-4 mb-3">
                                                    <label for="firefighterDeath" class="form-label">Type /
                                                        Kind</label>
                                                    <input type="text" placeholder="Type / kind" class="form-control"
                                                        id="firstResponderInput" name="type_hose[]"
                                                        value="{{ $equipment->type }}">
                                                </div>
                                                <div class="col-lg-4 mb-3">
                                                    <label for="firefighterDeath" class="form-label">Total
                                                        ft.</label>
                                                    <input type="text" placeholder="Enter total feet"
                                                        class="form-control" id="firstResponderInput" name="hose_feet[]"
                                                        value="{{ $equipment->length }}">
                                                </div>
                                                <hr>
                                            </div>
                                        @endif
                                    @endforeach

                                </div>
                            </div>
                            <div class="row m-0 p-0">
                                <button type="button" id="addNewHoseLine" class="btn btn-primary">+ Add another hose
                                    line used</button>
                            </div>
                        </div>

                        <!-- Duty Personnel -->
                        <div class="row border border-light-subtle shadow rounded my-3 p-4">
                            {{-- <h3 class="border-bottom border-4 border-secondary pb-2 mb-3">Duty Personnel at the Fire Scene</h3> --}}
                            <h3 class="border-bottom border-4 border-secondary pb-2 mb-3">13
                            </h3>
                            <div class="row m-0 p-0" id="thirdDivApor">
                                <div class="row" id="thirdAddApor">
                                    <h3></h3>
                                    @foreach ($duty_personnels as $duty)
                                        <div class="row third-remove-button-container m-0 p-0">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <h5></h5> <button type="button"
                                                    class="btn btn-outline-danger btn-sm float-end third-remove-section-btn">Remove</button>
                                            </div>
                                            <div class="col-lg-6 mb-3">
                                                <label for="fundCommander" class="form-label">Rank /
                                                    Name</label>
                                                <select class="form-select rankName" aria-label=""
                                                    name="duty_personnel_id[]">
                                                    <option value="" selected>Select Fund Commander</option>
                                                    @foreach ($personnels as $personnel)
                                                        @if ($personnel->id == $duty->personnels_id)
                                                            <option selected value="{{ $personnel->id }}">
                                                                {{ $personnel->rank->slug . ' ' . $personnel->first_name }}
                                                                {{ $personnel->last_name }}</option>
                                                        @else
                                                            <option value="{{ $personnel->id }}">
                                                                {{ $personnel->rank->slug . ' ' . $personnel->first_name }}
                                                                {{ $personnel->last_name }}</option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-lg-6 mb-3">
                                                <label for="firefighterDeath" class="form-label">Designation</label>
                                                <input type="text" placeholder="Designation" class="form-control"
                                                    name="duty_designation[]" value="{{ $duty->designation }}">
                                            </div>
                                            <div class="col-lg-12 mb-3">
                                                <label for="firefighterDeath" class="form-label">Remarks</label>
                                                <textarea type="text" placeholder="Remarks" class="form-control" name="duty_remarks[]">{{ $duty->remarks }}</textarea>
                                            </div>
                                            <hr>
                                        </div>
                                    @endforeach

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
                        <div class="row border border-light-subtle shadow rounded my-3 p-4">
                            <h3 class="border-bottom border-4 border-secondary pb-2 mb-3">14</h3>
                            <label class="form-label" for="exampleCheck1">Photos</label>
                            <input type="file" class="form-control uncheable" id="photos"
                                name="sketch_of_fire_operation[]" multiple>
                            <div id="image-preview-container" class="mt-3"></div>
                            @foreach ($photos as $photo)
                                @if ($photo != '')
                                    <div class="mt-3">
                                        <div class="image-preview mb-1">
                                            <input type="hidden" name="default_photos[]" value="{{ $photo }}">
                                            <img class="img-thumbnail w-100" src="/assets/images/operation_images/{{ $photo }}">
                                        </div>
                                        <div
                                            class="d-flex justify-content-between align-items-center mb-2 border-bottom pb-2">
                                            <div class="file-info flex-grow-1 me-2 text-break">{{ $photo }}</div>
                                            <button type="button" class="btn btn-sm btn-danger remove-photo"
                                                id="remove-photo">Remove</button>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>

                        <!-- Details narrative -->
                        <div class="row border border-light-subtle shadow rounded my-3 p-4">
                            {{-- <h3 class="border-bottom border-4 border-secondary pb-2 mb-3">Details (Narrative)</h3> --}}
                            <h3 class="border-bottom border-4 border-secondary pb-2 mb-3">15
                            </h3>
                            <div class="col-lg-12 mb-3">
                                <label for="firefighterDeath" class="form-label">Details
                                    (Narrative)</label>
                                <textarea type="text" placeholder="" class="form-control" id="firstResponderInput" name="details">{{ $operation->details }}</textarea>
                            </div>
                        </div>

                        <!-- Problem encounterd -->
                        <div class="row border border-light-subtle shadow rounded my-3 p-4">
                            {{-- <h3 class="border-bottom border-4 border-secondary pb-2 mb-3">Problem/s Encountered During Operation</h3> --}}
                            <h3 class="border-bottom border-4 border-secondary pb-2 mb-3">16
                            </h3>
                            <div class="col-lg-12 mb-3">
                                <label for="firefighterDeath" class="form-label">Problems /
                                    Encountered during operation:</label>
                                <textarea type="text" placeholder="" class="form-control" id="firstResponderInput" name="problem_encounter">{{ $operation->problem_encounter }}</textarea>
                            </div>
                        </div>

                        <!-- Observation Recommendation -->
                        <div class="row border border-light-subtle shadow rounded my-3 p-4">
                            {{-- <h3 class="border-bottom border-4 border-secondary pb-2 mb-3">Observations/Recommendations</h3> --}}
                            <h3 class="border-bottom border-4 border-secondary pb-2 mb-3">17
                            </h3>
                            <div class="col-lg-12 mb-3">
                                <label for="firefighterDeath" class="form-label">Observation /
                                    Recommendation</label>
                                <textarea type="text" placeholder="" class="form-control" id="firstResponderInput"
                                    name="observation_recommendation">{{ $operation->observation_recommendation }}</textarea>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary">Submit</button>

                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#divApor').on('click', '.remove-section-btn', function() {
                // Find the parent div of the clicked remove button and remove it
                $(this).closest('.remove-button-container').remove();
            });

            $('#addNewDivApor').click(function() {
                var newDiv = $('#addApor').clone();
                var mnewDiv = $(
                    '<div class="row remove-button-container m-0 p-0"> <div class="d-flex justify-content-between align-items-center"> <h5></h5> <button type="button" class="btn btn-outline-danger btn-sm float-end remove-section-btn">Remove</button> </div> <div class="col-lg-3 mb-3"> <label for="vehicle" class="form-label">Engine Dispatched</label> <select class="form-select engineDispatched" aria-label="" name="engine_dispatched[]"> <option selected>Select vehicle</option> @foreach ($trucks as $truck) <option value="{{ $truck->id }}"> {{ $truck->name }} </option> @endforeach </select> </div> <div class="col-lg-3 mb-3"> <label for="timeDispatched" class="form-label">Time Dispatched</label> <input type="text" placeholder="Eg. 2300h" class="form-control text-uppercase" id="timeDispatchedInput" name="time_dispatched[]"> </div> <div class="col-lg-3 mb-3"> <label for="timeArrivedFireScene" class="form-label">Time Arrived at Fire Scene</label> <input type="text" placeholder="Eg. 2300h" class="form-control text-uppercase" id="timeArrivedFireSceneInput" name="time_arrived_at_scene[]"> </div> <div class="col-lg-3 mb-3"> <label for="responseTime" class="form-label">Response Time</label> <input type="text" placeholder="Eg. 1900h - 2300h" class="form-control text-uppercase" id="responseTimeInput" name="response_duration[]"> </div> <div class="col-lg-4 mb-3"> <label for="timeReturned" class="form-label">Time Returned to Base</label> <input type="text" placeholder="Eg. 1900h - 2300h" class="form-control text-uppercase" id="timeReturnedInput" name="time_return_to_base[]"> </div> <div class="col-lg-4 mb-3"> <label for="waterTank" class="form-label">Water Tank Refilled (GAL)</label> <input type="text" placeholder="Eg. 1900h - 2300h" class="form-control text-uppercase" id="waterTankInput" name="water_tank_refilled[]"> </div> <div class="col-lg-4 mb-3"> <label for="gasConsumed" class="form-label">Gas Consumed (L)</label> <input type="text" placeholder="Eg. 24l" class="form-control text-uppercase" id="gasConsumedInput" name="gas_consumed[]"> </div> <hr> </div>'
                );

                console.log(mnewDiv);
                $('#divApor').append(mnewDiv);
                // mnewDiv.find('#closeCrew').prop('disabled', false);

                // Re-initialize Select2 on the cloned select element
                mnewDiv.find('.engineDispatched').select2();
            });

            $('#secondDivApor').on('click', '.second-remove-section-btn', function() {
                // Find the parent div of the clicked remove button and remove it
                $(this).closest('.second-remove-button-container').remove();
            });

            $('#addTimeAlarmStatusDeclared').click(function() {
                var newDiv = $('#secondAddApor').clone();
                var mnewDiv = $(
                    '<div class="row second-remove-button-container m-0 p-0"> <div class="d-flex justify-content-between align-items-center"> <h5></h5> <button type="button" class="btn btn-outline-danger btn-sm float-end second-remove-section-btn">Remove</button> </div> <div class="col-lg-4 mb-3"> <label for="timeAlarmStatusDeclared" class="form-label">Alarm Status</label> <select class="form-select alarmApor" aria-label="" name="alarm_name[]"> <option value="" selected>Select alarm status</option> <option value="1st Alarm">1st Alarm</option><option value="2nd Alarm">2nd Alarm</option> <option value="3rd Alarm">3rd Alarm</option> <option value="4th Alarm">4th Alarm</option> <option value="5th Alarm">5th Alarm</option> <option value="Task Force Alpha">Task Force Alpha</option> <option value="Task Force Bravo">Task Force Bravo</option> <option value="Task Force Charlie">Task Force Charlie</option> <option value="Task Force Delta">Task Force Delta</option> <option value="Task Force Echo">Task Force Echo</option> <option value="Task Force Hotel">Task Force Hotel</option> <option value="Task Force India">Task Force India</option> <option value="General Alarm">General Alarm</option> </select> </div> <div class="col-lg-4 mb-3"> <label for="timeAlarmStatusDeclaredTime" class="form-label">Time</label> <input type="text" placeholder="Eg. 2300h" class="form-control text-uppercase" id="timeAlarmStatusDeclaredTime" name="alarm_time[]"> </div> <div class="col-lg-4 mb-3"> <label for="fundCommander" class="form-label">Fund Commander</label> <select class="form-select fundCommander" aria-label="" name="fund_commander[]"> <option selected>Select Fund Commanders</option> @foreach ($personnels as $personnel) <option value="{{ $personnel->id }}"> {{ $personnel->rank->slug . ' ' . $personnel->first_name }} {{ $personnel->last_name }}</option> @endforeach </select> </div><hr></div>'
                );

                console.log(mnewDiv);
                $('#secondDivApor').append(mnewDiv);
                // mnewDiv.find('#closeCrew').prop('disabled', false);

                // Re-initialize Select2 on the cloned select element
                mnewDiv.find('.alarmApor').select2();
            });

            $('#thirdDivApor').on('click', '.third-remove-section-btn', function() {
                // Find the parent div of the clicked remove button and remove it
                $(this).closest('.third-remove-button-container').remove();
            });

            $('#addNewDutyPersonnelAtFireScene').click(function() {
                var newDiv = $('#thirdAddApor').clone();
                var mnewDiv = $(
                    '<div class="row third-remove-button-container m-0 p-0"> <div class="d-flex justify-content-between align-items-center"> <h5></h5> <button type="button" class="btn btn-outline-danger btn-sm float-end third-remove-section-btn">Remove</button> </div> <div class="col-lg-6 mb-3"> <label for="fundCommander" class="form-label">Rank / Name</label> <select class="form-select rankName" aria-label="" name="duty_personnel_id[]"> <option value="" selected>Select Fund Commander</option> @foreach ($personnels as $personnel) <option value="{{ $personnel->id }}"> {{ $personnel->rank->slug . ' ' . $personnel->first_name }} {{ $personnel->last_name }}</option> @endforeach </select> </div> <div class="col-lg-6 mb-3"> <label for="firefighterDeath" class="form-label">Designation</label> <input type="text" placeholder="Designation" class="form-control" name="duty_designation[]"> </div> <div class="col-lg-12 mb-3"> <label for="firefighterDeath" class="form-label">Remarks</label> <textarea type="text" placeholder="Remarks" class="form-control" name="duty_remarks[]"></textarea> </div> <hr> </div>'
                );

                console.log(mnewDiv);
                $('#thirdDivApor').append(mnewDiv);
                // mnewDiv.find('#closeCrew').prop('disabled', false);

                // Re-initialize Select2 on the cloned select element
                mnewDiv.find('.rankName').select2();
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
                // mnewDiv.find('#closeCrew').prop('disabled', false);

                // Re-initialize Select2 on the cloned select element
                // mnewDiv.find('.rankName').select2();
            });

            $('.remove-photo').on('click', function() {
                // Find the parent div with class "mt-3" and remove it
                $(this).closest('.mt-3').remove();
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
                                '<img class="img-thumbnail w-100" src="' + e.target.result +
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
                                '<button type="button" class="btn btn-sm btn-danger remove-photo">Remove</button>'
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
                // mnewDiv.find('#closeCrew').prop('disabled', false);

                // Re-initialize Select2 on the cloned select element
                // mnewDiv.find('.rankName').select2();
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
                // mnewDiv.find('#closeCrew').prop('disabled', false);

                // Re-initialize Select2 on the cloned select element
                // mnewDiv.find('.rankName').select2();
            });

            $('#divHoseLine').on('click', '.hose-line-remove-section-btn', function() {
                // Find the parent div of the clicked remove button and remove it
                $(this).closest('.hose-line-remove-button-container').remove();
            });

            $('#addNewHoseLine').click(function() {
                var newDiv = $('#addHoseLine').clone();
                var mnewDiv = $(
                    '<div class="row hose-line-remove-button-container m-0 p-0"> <div class="d-flex justify-content-between align-items-center"> <h5></h5> <button type="button" class="btn btn-outline-danger btn-sm float-end hose-line-remove-section-btn">Remove</button> </div> <div class="col-lg-4 mb-3"> <label for="firefighterDeath" class="form-label">No.</label> <input type="number" placeholder="No." class="form-control" id="firstResponderInput" name="no_hose[]"> </div> <div class="col-lg-4 mb-3"> <label for="firefighterDeath" class="form-label">Type / Kind</label> <input type="text" placeholder="Type / kind" class="form-control" id="firstResponderInput" name="type_hose[]"> </div> <div class="col-lg-4 mb-3"> <label for="firefighterDeath" class="form-label">Total ft.</label> <input type="text" placeholder="Enter total feet" class="form-control" id="firstResponderInput" name="hose_feet[]"> </div> <hr> </div>'
                );

                console.log(mnewDiv);
                $('#divHoseLine').append(mnewDiv);
                // mnewDiv.find('#closeCrew').prop('disabled', false);

                // Re-initialize Select2 on the cloned select element
                // mnewDiv.find('.rankName').select2();
            });
        });
    </script>
@endsection
