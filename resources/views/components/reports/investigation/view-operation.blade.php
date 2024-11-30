{{-- View Final Operation Modal --}}
<div class="modal fade" id="viewOperationModal{{ $investigation->investigation_id }}" tabindex="-1"
    aria-labelledby="viewFinalOperationModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header pt-4 px-4 pb-1">
                <h3 class="modal-title fw-bolder text-primary">AFTER FIRE OPERATION REPORT</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <hr>
            <div class="modal-body px-4 pb-4 pt-0">
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
                        <th>Originator:</th>
                        <td class="text-break">{{ $operation->originator }}</td>
                    </tr>
                    <tr>
                        <th>Office/Address of the Caller:</th>
                        <td class="text-break">{{ $operation->caller_address }}</td>
                    </tr>
                    <tr>
                        <th>Personnel on duty who receive the alarm:</th>
                        <td class="text-break">
                            {{ ($operation?->receivedBy?->rank?->slug ?? "Unknown") . ' ' . $operation?->receivedBy?->first_name ?? "Unknown" . ' ' . ($operation?->receivedBy?->last_name ?? "Unknown") }}
                        </td>
                    </tr>
                    <tr>
                        <th>Location:</th>
                        <td class="text-break">{{ $operation->full_location }}</td>
                    </tr>
                    <tr>
                        <th>Blotter Number:</th>
                        <td class="text-break">{{ $operation->blotter_number }}</td>
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
                            <th class="text-center align-middle">RESPONSE TIME (TIME RECEIVED CALL - TIME ARRIVED AT
                                FIRE SCENE) in minutes</th>
                            <th class="text-center align-middle">TIME RETURNED TO BASE</th>
                            <th class="text-center align-middle">WATER TANK REFILLED (GAL)</th>
                            <th class="text-center align-middle">GAS COSUMED (L)</th>
                        </tr>
                    </thead>
                    <tbody>
                        @unless (count($operation->responses) != 0)

                            @foreach ($operation->responses as $response)
                                <tr>
                                    <td class="text-break">
                                        {{ ($response->truck?->name ?? "Unknown") }}
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
                            <tr>
                                <td colspan="7">
                                    <div class="alert alert-secondary">
                                        No Responses
                                    </div>
                                </td>
                            </tr>
                        @endunless
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
                    {{ ($operation->getOccupancy?->occupancy_name ?? "Unknown") . ' - ' . ($operation->getOccupancy?->type ?? "Unknown") . ' / ' . ($operation->getOccupancy?->specify ?? "Unknown") }}
                </div>
                <hr>
                <h5 class="my-4 fw-bolder">Approximate Distance of Fire Incident From Fire Station (Km):</h5>
                <div class="ps-5">
                    {{ ($operation->getOccupancy?->distance ?? "Unknown") }}
                </div>

                <hr>
                <h5 class="my-4 fw-bolder">General Description of the structure/s involved:</h5>
                <div class="ps-5">
                    {{ ($operation->getOccupancy?->description ?? "Unknown") }}
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
                            <td>{{ ($alarm->getGroundCommander?->rank?->slug ?? "Unknown") . ' ' . ($alarm->getGroundCommander?->first_name ?? "Unknown") . ' ' . ($alarm->getGroundCommander?->last_name ?? "Unknown") }}
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
                    @foreach ($operation->dutyPersonnels as $duty_personnel)
                        <tr>
                            @foreach ($personnels as $personnel)
                                @if ($duty_personnel->personnels_id == $personnel->id)
                                    <td>{{ ($personnel->rank?->slug ?? "Unknown") . ' ' . $personnel->first_name . ' ' . $personnel->last_name }}
                                    </td>
                                @endif
                            @endforeach
                            <td>{{ $duty_personnel->designation }}</td>
                            <td>{{ $duty_personnel->remarks }}</td>
                        </tr>
                    @endforeach
                </table>

                <h5 class="my-4 fw-bolder">Instruction/Sketch of the Fire Operation (Should Be
                    Attached):
                    <span class="d-block" style="color: grey; font-style:italic; font-size:15px;">(Indicate
                        the data
                        frame, legend, location, north arrow and scale)</span>
                </h5>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="">
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

                                <div class="row">
                                    @foreach ($photos as $photo)
                                        <div class="col-lg-4">
                                            <div class="card-body p-1">
                                                <img style="height: 350px; object-fit: cover;" class="w-100"
                                                    src="{{ asset('/assets/images/operation_images/' . $photo) }}">
                                            </div>
                                        </div>
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

                <hr>
                <h5 class="my-4 fw-bolder">Prepared By:</h5>
                <div class="ps-5">
                    {{ $operation->prepared_by }}
                </div>

                <hr>
                <h5 class="my-4 fw-bolder">Noted By:</h5>
                <div class="ps-5">
                    {{ $operation->noted_by }}
                </div>
            </div>
            {{-- {{dd($act)}} --}}
            <div class="modal-footer">
                @if ($act == 'minimal')
                    <button type="button" class="btn btn-secondary" data-bs-toggle="modal"
                        data-bs-target="#viewMinimalModal{{ $investigation->id }}"><span><i
                                class="ti ti-arrow-back"></i></span><span> Go Back</span></button>
                @elseif($act == 'spot')
                    <button type="button" class="btn btn-secondary" data-bs-toggle="modal"
                        data-bs-target="#viewSpotModal{{ $investigation->id }}"><span><i
                                class="ti ti-arrow-back"></i></span><span> Go Back</span></button>
                @elseif($act == 'progress')
                    <button type="button" class="btn btn-secondary" data-bs-toggle="modal"
                        data-bs-target="#viewProgressModal{{ $investigation->id }}"><span><i
                                class="ti ti-arrow-back"></i></span><span> Go Back</span></button>
                @elseif($act == 'final')
                    <button type="button" class="btn btn-secondary" data-bs-toggle="modal"
                        data-bs-target="#viewFinalModal{{ $investigation->id }}"><span><i
                                class="ti ti-arrow-back"></i></span><span> Go Back</span></button>
                @endif

                {{-- <a href="#" type="button" class="btn btn-warning"><i class="ti ti-printer"></i>Print</a> --}}
            </div>
        </div>

    </div>
</div>
