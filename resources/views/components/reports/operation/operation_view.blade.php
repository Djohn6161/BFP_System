<div class="modal fade" tabindex="-1" id="viewOperationModal{{ $operation->id }}">
    <div class="modal-dialog modal-xl modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bolder text-primary">AFTER FIRE OPERATION REPORT</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table class="table table-striped">
                    <tr>
                        <th>Alarm received (Time):</th>
                        <td class="text-break">{{ $operation->alarm_received }}</td>
                    </tr>
                    <tr>
                        <th>Caller/Reported/Transmitted by:</th>
                        <td class="text-break">{{ $operation->transmitted_by }}</td>
                    </tr>
                    <tr>
                        <th>Office/Address of the Caller:</th>
                        <td class="text-break">{{ $operation->caller_address }}</td>
                    </tr>
                    <tr>
                        <th>Personnel on duty who receive the alarm:</th>
                        <td class="text-break">
                            {{ $operation->receivedBy->rank->slug . ' ' . $operation->receivedBy->first_name . ' ' . $operation->receivedBy->last_name }}
                        </td>
                    </tr>
                    <tr>
                        <th>Location:</th>
                        <td class="text-break">{{ $operation->full_location }}</td>
                    </tr>
                </table>
                <br>
                <hr>

                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th class="text-center align-middle">ENGINE DISPATCHED</th>
                            <th class="text-center align-middle">TIME DISPATCHED</th>
                            <th class="text-center align-middle">TIME ARRIVED AT FIRE SCENE</th>
                            <th class="text-center align-middle">RESPONSE TIME (TIME RECEIVED CALL - TIME ARRIVED AT FIRE SCENE) in minutes</th>
                            <th class="text-center align-middle">TIME RETURNED TO BASE</th>
                            <th class="text-center align-middle">WATER TANK REFILLED (GAL)</th>
                            <th class="text-center align-middle">GAS COSUMED (L)</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($operation->responses as $response)
                            <tr>
                                <td class="text-break">
                                    {{ $response->truck->name }}
                                </td>
                                <td class="text-break">
                                    {{ $response->time_dispatched }}
                                </td>
                                <td class="text-break">
                                    {{ $response->time_arrived_at_scene }}
                                </td>
                                <td class="text-break">
                                    {{ $response->response_duration }}
                                </td>
                                <td class="text-break">
                                    {{ $response->time_return_to_base }}
                                </td>
                                <td class="text-break">
                                    {{ $response->water_tank_refilled }}
                                </td>
                                <td class="text-break">
                                    {{ $response->gas_consumed }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <br>
                <hr>
                <table class="table table-striped">
                    <tr>
                        <th>Alarm Status:</th>
                        <td class="text-break">{{ $operation->alarm_status_arrival }}</td>
                    </tr>
                    <tr>
                        <th>First Responder:</th>
                        <td class="text-break">{{ $operation->first_responder }}</td>
                    </tr>
                    <tr>
                        <th>Time/Date Under Control:</th>
                        <td class="text-break">
                            {{ \Carbon\Carbon::parse($operation->td_under_control)->format('F j, Y | g:i:s A') }}</td>
                    </tr>
                    <tr>
                        <th>Time/Date Declared Fire Out:</th>
                        <td class="text-break">
                            {{ \Carbon\Carbon::parse($operation->td_declared_fireout)->format('F j, Y | g:i:s A') }}
                        </td>
                    </tr>
                </table>
                <br>
                <hr>

                <h5 class="my-4 fw-bolder">Type of Occupancy (please specify):</h5>
                <div class="ps-5">
                    {{ $operation->getOccupancy->occupancy_name . ' - ' . $operation->getOccupancy->specify }}
                </div>
                <hr>
                <h5 class="my-4 fw-bolder">Approximate Distance of Fire Incident From Fire Station (Km):</h5>
                <div class="ps-5">
                    {{ $operation->getOccupancy->distance }}
                </div>

                <hr>
                <h5 class="my-4 fw-bolder">General Description of the structure/s involved:</h5>
                <div class="ps-5">
                    {{ $operation->getOccupancy->description }}
                </div>
                <hr>
                <br>

                <h5 class="my-4 fw-bolder">Total Number of Casualty Reported:</h5>
                <table class="table table-striped ">
                    <tr>
                        <th> </th>
                        <th>Injured</th>
                        <th>Death</th>
                    </tr>
                    @foreach ($operation->casualties as $casualty)
                        @if ($casualty->type == 'civilian')
                            <tr>
                                <th>Civilian</th>
                                <td>{{ $casualty->injured }}</td>
                                <td>{{ $casualty->death }}</td>
                            </tr>
                        @else
                            <tr>
                                <th>FireFighter</th>
                                <td>{{ $casualty->injured }}</td>
                                <td>{{ $casualty->death }}</td>
                            </tr>
                        @endif
                    @endforeach
                </table>
                <hr>
                <br>

                <h5 class="my-4 fw-bolder">Time Alarm Status Declared:</h5>
                <table class="table   table-striped">
                    <tr>
                        <th>Alarm Status</th>
                        <th>Time</th>
                        <th>Fund Commander</th>
                    </tr>
                    @foreach ($operation->declaredAlarms as $alarm)
                        <tr>
                            <td>{{ $alarm->alarm_name }}</td>
                            <td>{{ $alarm->time }}</td>
                            <td>{{ $alarm->getGroundCommander->rank->slug . ' ' . $alarm->getGroundCommander->first_name . ' ' . $alarm->getGroundCommander->last_name }}
                            </td>
                        </tr>
                    @endforeach
                </table>
                <hr>
                <br>

                <h5 class="my-4 fw-bolder">Breathing Apparatus Used:</h5>
                <table class="table table-striped ">
                    <tr>
                        <th>Qty.</th>
                        <th>Type/Kind</th>
                    </tr>
                    @foreach ($operation->getBreathingApparatus as $equipment)
                        <tr>
                            <td>{{ $equipment->quantity }}</td>
                            <td>{{ $equipment->type }}</td>
                        </tr>
                    @endforeach
                </table>
                <hr>
                <br>

                <h5 class="my-4 fw-bolder">Extinguishing Agent Used:</h5>
                <table class="table table-striped ">
                    <tr>
                        <th>Qty.</th>
                        <th>Type/Kind</th>
                    </tr>
                    @foreach ($operation->getExtinguishingAgent as $equipment)
                        <tr>
                            <td>{{ $equipment->quantity }}</td>
                            <td>{{ $equipment->type }}</td>
                        </tr>
                    @endforeach
                </table>
                <hr>
                <br>

                <h5 class="my-4 fw-bolder">Rope and Ladder Used:</h5>
                <table class="table table-striped ">
                    <tr>
                        <th>Type.</th>
                        <th>Length</th>
                    </tr>
                    @foreach ($operation->getRopeAndLadder as $equipment)
                        <tr>
                            <td>{{ $equipment->type }}</td>
                            <td>{{ $equipment->length }}</td>
                        </tr>
                    @endforeach
                </table>
                <hr>
                <br>

                <h5 class="my-4 fw-bolder">Hose line Used::</h5>
                <table class="table table-striped ">
                    <tr>
                        <th>Nr.</th>
                        <th> TYPE/KIND</th>
                        <th>TOTAL ft</th>
                    </tr>
                    @foreach ($operation->getRopeAndLadder as $equipment)
                        <tr>
                            <td>{{ $equipment->nr }}</td>
                            <td>{{ $equipment->type }}</td>
                            <td>{{ $equipment->length }}</td>
                        </tr>
                    @endforeach
                </table>
                <hr>
                <br>

                <h5 class="my-4 fw-bolder">Duty Personnrl at the Fire Scene:</h5>
                <table class="table table-striped">
                    <tr>
                        <th>Rank/Name</th>
                        <th>Designation</th>
                        <th>Remarks</th>
                    </tr>
                    <tr>
                        <td>DETAILS HERE</td>
                        <td>DETAILS HERE</td>
                        <td>DETAILS HERE</td>
                    </tr>
                </table>

                <h5 class="my-4 fw-bolder">Instruction/Sketch of the Fire Operation (Should Be
                    Attached):
                    <span class="d-block" style="color: grey; font-style:italic; font-size:15px;">(Indicate
                        the data
                        frame, legend, location, north arrow and scale)</span>
                </h5>
                <div class="ps-5 row">
                    <div class="col-sm-4">
                        <div class="card">
                            @if ($operation->sketch_of_fire_operation == null)
                                <div class="card-body p-1">
                                    <h3>No photos</h3>
                                </div>
                            @else
                                @php
                                    if ($operation->sketch_of_fire_operation != '') {
                                        $photos = explode(',', $operation->sketch_of_fire_operation);
                                    }
                                @endphp
                                <div class="card-body p-1">
                                    @foreach ($photos as $photo)
                                        <img style="height: 350px; object-fit: cover;" class="w-100"
                                            src="/assets/images/operation_images/{{ $photo }}"
                                            alt="Sample Image">
                                    @endforeach
                                </div>
                            @endif

                        </div>
                    </div>
                </div>
                <br>

                <hr>
                <h5 class="my-4 fw-bolder">Details(Narrative)</h5>
                <div class="ps-5">
                    {{ $operation->details }}
                </div>

                <hr>
                <h5 class="my-4 fw-bolder">Problem/s Rencountered during Operation:</h5>
                <div class="ps-5">
                    {{ $operation->problem_encounter }}
                </div>

                <hr>
                <h5 class="my-4 fw-bolder">Observation/Recommendation</h5>
                <div class="ps-5">
                    {{ $operation->observation_recommendation }}
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                {{-- <button type="button" class="btn btn-primary">Save changes</button> --}}
            </div>
        </div>
    </div>
</div>
<script>
    $('#viewOperationModal').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget);
        var operation = button.data('operation');
        var responses = button.data('responses');
        console.log(responses);

        // Intro
        $('#view_alarm_received').text(operation.alarm_received);
        $('#view_transmitted_by').text(operation.transmitted_by);
        $('#view_caller_address').text(operation.caller_address);
        $('#view_received_by').text(operation.recieved_by);
        $('#view_location').text(operation.full_location);
        $('#view_td_under_control').text(operation.td_under_control);
        $('#view_first_responder').text(operation.first_responder);
        $('#view_time_date_declared_fire_out').text(operation.td_declared_fireout);
        $('#view_details_narrative').text(operation.details);
        $('#view_problems_rencountered_during_operation').text(operation.problem_encounter);
        $('#view_observation_recommendation').text(operation.observation_recommendation);

        $('#view_alarm_received').text(operation.alarm_received);



    });
</script>
