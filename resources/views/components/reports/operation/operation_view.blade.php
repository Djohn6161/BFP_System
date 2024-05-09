<div class="modal fade" tabindex="-1" id="viewOperationModal{{ $operation->id }}">
    <div class="modal-dialog modal-xl modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bolder text-primary">AFTER FIRE OPERATION REPORT</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row p-2">
                    <div class="col-sm-2 text-dark">For:</div>
                    {{-- <div class="col-sm-10"><b>{{ $investigation->investigation->for }}</b></div> --}}
                </div>
                <div class="row p-2">
                    <div class="col-sm-2 text-dark">Subject:</div>
                    {{-- <div class="col-sm-10"><b>{{ $investigation->investigation->subject }}</b></div> --}}
                </div>
                <div class="row p-2">
                    <div class="col-sm-2 text-dark">Date:</div>
                    {{-- <div class="col-sm-10"><b>{{ $investigation->investigation->date }}</b></div> --}}
                </div>
                <hr>
                <table class="table table-striped">
                    <tr>
                        <th>Alarm received (Time):</th>
                        <td class="text-break">  DETAILS HERE</td>
                    </tr>
                    <tr>
                        <th>Caller/Reported/Transmitted by:</th>
                        <td class="text-break">{{ $operation->transmitted_by }}</td>
                    </tr>
                    <tr>
                        <th>Office/Address of the Caller:</th>
                        <td class="text-break">  DETAILS HERE</td>
                    </tr>
                    <tr>
                        <th>Personnel on duty who receive the alarm:</th>
                        <td class="text-break">{{ $operation->received_by }}</td>
                    </tr>
                    <tr>
                        <th>Location:</th>
                        <td class="text-break">  DETAILS HERE</td>
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
                        <tr>
                            <td class="text-break">
                                DETAILS DHJGKJKJVKLCH
                            </td>
                            <td class="text-break">
                                DETAILS DHJGKJKJVKLCH
                            </td>
                            <td class="text-break">
                                DETAILS DHJGKJKJVKLCH
                            </td>
                            <td class="text-break">
                                DETAILS DHJGKJKJVKLCH
                            </td>
                            <td class="text-break">
                                DETAILS DHJGKJKJVKLCH
                            </td>
                            <td class="text-break">
                                DETAILS DHJGKJKJVKLCH
                            </td>
                            <td class="text-break">
                                DETAILS DHJGKJKJVKLCH
                            </td>
                        </tr>
                    </tbody>
                </table>
                <br>
                <hr>
                <table class="table   table-striped">
                    <tr>
                        <th>Alarm Status:</th>
                        <td class="text-break">  DETAILS HERE</td>
                    </tr>
                    <tr>
                        <th>First Responder:</th>
                        <td class="text-break" id="view_first_responder"> DETAILS HERE</td>
                    </tr>
                    <tr>
                        <th>Time/Date Under Control:</th>
                        <td class="text-break">DETAILS HERE</td>
                    </tr>
                    <tr>
                        <th>Time/Date Declared Fire Out:</th>
                        <td class="text-break" id="view_time_date_declared_fire_out">DETAILS HERE</td>
                    </tr>
                </table>
                <br>

                <hr> 
                <h5 class="my-4 fw-bolder">Type of Occupancy (please specify):</h5>
                <div class="ps-5">
                    DETAILS HERE
                </div>

                <hr>
                <h5 class="my-4 fw-bolder">Approximate Distance of Fire Incident From Fire Station (Km):</h5>
                <div class="ps-5">
                    DETAILS HERE
                </div>

                <hr>
                <h5 class="my-4 fw-bolder">General Description of the structure/s involved:</h5>
                <div class="ps-5">
                    DETAILS HERE
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
                    <tr>
                        <th>Civilian</th>
                        <td>DETAILS HERE</td>
                        <td>DETAILS HERE</td>
                    </tr>
                    <tr>
                        <th>FireFighter</th>
                        <td>DETAILS HERE</td>
                        <td>DETAILS HERE</td>
                    </tr>
                </table>

                <hr>
                <br>
                <h5 class="my-4 fw-bolder">Breathing Apparatus Used:</h5>
                 <table class="table table-striped ">
                    <tr>
                        <th>Nr.</th>
                        <th>Type/Kind</th>

                    </tr>
                    <tr>
                        <td>DETAILS HERE</td>
                        <td>DETAILS HERE</td>
                    </tr>
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
                    <tr>
                        <td>DETAILS HERE</td>
                        <td>DETAILS HERE</td>
                        <td>DETAILS HERE</td>
                    </tr>
                    <tr>
                        <td>DETAILS HERE</td>
                        <td>DETAILS HERE</td>
                        <td>DETAILS HERE</td>
                    </tr>
                </table>

                  <hr>
                  <br>
                  <h5 class="my-4 fw-bolder">Extinguishing Agent Used:</h5>
                   <table class="table table-striped ">
                      <tr>
                        <th>QTY.</th>
                        <th>Type/Kind</th>

                  <hr>
                  <br>
                  <h5 class="my-4 fw-bolder">Rope and Ladder Used:</h5>
                   <table class="table table-striped">
                      <tr>
                        <th>Type</th>
                        <th>Lenght</th>

                  <hr>
                  <br>
                  <h5 class="my-4 fw-bolder">Hose line Used:</h5>
                   <table class="table table-striped">
                      <tr>
                        <th>Nr.</th>
                        <th> TYPE/KIND</th>
                        <th>TOTAL ft</th>
                      </tr>
                      <tr>
                        <td>DETAILS HERE</td>
                        <td>DETAILS HERE</td>
                        <td>DETAILS HERE</td>
                      </tr>
                    </table>

                  <hr>
                  <br>
                  <h5 class="my-4 fw-bolder">Duty Personnel at the Fire Scene:</h5>
                  <table class="table  table-striped">
                    <tr>
                        <th>Rank/Name</th></th>
                        <th>Designation</th>
                        <th>Remarks</th>
                      </tr>
                      <tr>
                        <td>DETAILS HERE</td>
                        <td>DETAILS HERE</td>
                        <td>DETAILS HERE</td>
                    </tr>
                </table>

                <hr>
                <h5 class="my-4 fw-bolder">Instruction/Sketch of the Fire Operation (Should Be Attached): 
                    <span class="d-block" style="color: grey; font-style:italic; font-size:15px;">(Indicate the data frame, legend, location, north arrow and scale)</span>
                </h5>
                <div class="ps-5">
                    Photo Here
                </div>
                <br>

                <hr>
                <h5 class="my-4 fw-bolder">Details(Narrative)</h5>
                <div class="ps-5">
                    DETAILS HERE
                </div>

                <hr>
                <h5 class="my-4 fw-bolder">Problem/s Rencountered during Operation:</h5>
                <div class="ps-5">
                    DETAILS HERE
                </div>

                <hr>
                <h5 class="my-4 fw-bolder">Observation/Recommendation</h5>
                <div class="ps-5">
                    DETAILS HERE
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
