<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PDF Operation</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        header {
            color: rgb(0, 0, 0);
            text-align: center;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        header img {
            max-height: 5.5rem;
            vertical-align: middle;
        }

        header div p {
            margin: 0;
        }

        main {
            padding: 20px;
        }

        footer {
            text-align: center;
            padding: 10px;
            background-color: #f5f5f5;
        }

        @media print {
            body {
                margin-top: .25in;
                margin-bottom: .25in;
                margin-left: .5in;
                margin-right: .5in;
            }

            header img {
                margin-top: -2rem;
            }
        }

        .a {
            width: 100%;
            border-collapse: collapse;
        }

        .a th,
        .a td {
            padding-top: 8px;
            padding-bottom: 8px;
            text-align: left;
            white-space: nowrap;
        }

        .a th {
            font-weight: bold;
            width: 15%;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .a td::before {
            content: ": ";
            margin-left: 5px;
        }

        .a td {
            width: 85%;
        }

        .b {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        .b td,
        .b th {
            border: 1px solid #dddddd;
            text-align: left;
            vertical-align: top;
            padding: 8px;
        }

        .paragraph {
            text-align: justify;
            text-indent: 40px;
        }

        .btn {
            display: inline-block;
            /* font-family: $btn-font-family; */
            font-weight: 400;
            line-height: 1.5;
            color: #212529;
            text-align: center;
            text-decoration: none;
            vertical-align: middle;
            cursor: pointer;
            user-select: none;
            background-color: transparent;
            border: 1px solid transparent;
        }

        .btn-primary {
            color: #fff;
            background-color: #0d6efd;
            border-color: #0d6efd;
        }

        .d-none {
            display: none !important;
        }
    </style>
</head>

<body>
    <div style="margin: 30px 30px 30px 30px; text-align:end" id="download-btn">
        <button class="btn btn-primary" style="padding: 10px 30px 10px 30px; border-radius: 30px"
            onclick="download(this)">PRINT</button>
    </div>
    <header>
        <div>
            <img src="{{ asset('assets/images/logos/DILG-Logo.png') }}" alt="Left Logo">
        </div>

        <div>
            <p><small>Republic of the Philippines</p></small>
            <p><small><b>Department of the Interior and Local Government</p></b></small>
            <p><b><small>Bureau of Fire Protection</b></p></small>
            <p>REGION V</p>
            <p> <small>2nd Flr. ANST Bldg., Capt. F. Aquende Drive</small></p>
            <p><small>Albay District, Legazpi City</small></p>
            <p><small>CP No. 09365474962</small></p>
            <p><b><small>AFTER FIRE OPERATIONS REPORT</b></p></small>
        </div>

        <div>

            <img src="{{ asset('assets/images/logos/EDITED FINAL.png') }}" alt="Right Logo">


        </div>


    </header>


    <h5 style="font-size: 12px;">
        <b>Explicity stipulated are the details of the fire incident that transpired on or about;</b>

    </h5>

    <style>
        /* CSS for table1 styles */
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        .underline-input {
            border: none;
            border-bottom: 1px solid black;
            /* You can adjust the color and thickness as needed */
            outline: none;
            /* Remove default focus outline */
            width: 400px;
            /* Adjust the width as needed */
            text-align: right;
            /* Align the text to the right */

        }
    </style>

    <!-- TABLE 1 -->
    <table border="1";>

        <!-- Row 1- Table 1-->
        <!-- Row 1 -->
        <tr>
            <td style="font-size: 12px;">Alarm received (Time): {{ $operation->alarm_received }}</td>
            <td style="font-size: 12px;">Location:{{ $operation->full_location }}</td>
        </tr>

        <!-- Row 2 -->
        <tr>
            <td style="font-size: 12px;"> Caller/Reported/Transmitted by: {{ $operation->transmitted_by }}</td>

        </tr>
        <!-- Row 3 -->
        <tr>
            <td style="font-size: 12px;">Office/Address of the Caller: {{ $operation->caller_address }}</td>

        </tr>
        <!-- Row 4 -->
        <tr>
            <td style="font-size: 12px;">Personnel on duty who received the alarm:
                {{ $operation->receivedBy->rank->slug . ' ' . $operation->receivedBy->first_name . ' ' . $operation->receivedBy->last_name }}
            </td>

        </tr>
    </table>







    <!-- TABLE 2 -->
    <p style="font-size: 12px;"> 2</p>

    <div>
        <table style="font-size: 6px;">

            <tr>
                <td style="text-align: center;"><b>ENGINE <br> DISPATCHED</b></td>
                <td style="text-align: center;"> <b>TIME <br> DISPATCHED </b></td>
                <td style="text-align: center;"><b>TIME ARRIVED AT <br> FIRE SCENE</b></td>
                <td style="text-align: center;"><b>RESPONSE TIME <br> (TIME RECEIVED CALL- TIME ARRIVED AT FIRE
                        SCENE) in minutes</b></td>
                <td style="text-align: center;"><b>TIME RETURNED TO THE BASE</b></td>
                <td style="text-align: center;"><b>WATER TANK REFILLED <br> (GAL)</b></td>
                <td style="text-align: center;"><b>GAS CONSUMED<br> (L)</b></td>
            </tr>

            <!-- Row 2 -->
            @foreach ($operation->responses as $response)
                <tr>
                    <td style="font-size: 13px;">{{ $response->truck->name }}</td>
                    <td style="font-size: 13px;">{{ $response->time_dispatched }}</td>
                    <td style="font-size: 13px;">{{ $response->time_arrived_at_scene }}</td>
                    <td style="font-size: 13px;">{{ $response->response_duration }}</td>
                    <td style="font-size: 13px;">{{ $response->time_return_to_base }}</td>
                    <td style="font-size: 13px;">{{ $response->water_tank_refilled }}</td>
                    <td style="font-size: 13px;">{{ $response->gas_consumed }}</td>
                </tr>
            @endforeach

            <!-- Row 3 -->
        </table>
    </div>

    <div class="container">
        <div class="table-wrapper">
            <table>

                <caption style="font-size: 13px;">

                    <!-- TABLE 3 -->
                    3 <b>Alarm Status Upon Arrival</b>
                </caption>

                <tr>
                    <td></td>
                    <td style="font-size:12px">
                        First Responder</td>
                </tr>
                <tr>
                    <td>{{ $operation->alarm_status_arrival }}</td>
                    <td style="font-size:12px">
                        <br><br>{{ $operation->first_responder }}
                    </td>
                </tr>
                <!-- <div class="container">
                <div class="table-wrapper">
                    <table>
                        <caption>Time / Date Under Control:</caption>
                        <caption>Time / Date Declared Fire Out:</caption>
                    </table>
                </div>
            </div> -->
            </table>
            <br>
            <br>

            <div style="text-align: left; font-size: 12px;">

                <caption> Time / Date Under Control: {{ $operation->td_under_control }}</caption>
                <br>
                <caption> Time / Date Declared Fire Out: {{ $operation->td_declared_fireout }}</caption>

                <p style="font-size: 12px;"> 4</p>
            </div>

            <!-- TABLE 4 -->
            <p style="font-size: 12px;">Type of Occupancy / (Please Specify)</p>

            <table>
                <tbody>
                    <tr>
                        <td width="30px"> {{ $operation->getOccupancy->occupancy_name }}</td>
                        <td style="border: none; font-size: 12px;"> {{ $operation->getOccupancy->type }} /
                            {{ $operation->getOccupancy->specify }}</td>
                    </tr>
                </tbody>
            </table>
            <table>
                <p style="font-size: 12px;"> 5</p>
                <p style="font-size: 12px;"> Distance of the Fire incident From Fire <br>Station (Km):</p>

                <input type="text" class="underline-input" placeholder=""
                    value="{{ $operation->getOccupancy->distance }}">

            </table>

            <table>
                <p style="font-size: 12px;"> 6</p>
                <p style="font-size: 12px;"> General Description of the structure/s involved: <br>
                    {{ $operation->getOccupancy->type }}
                </p>


                <input type="text" class="underline-input" placeholder=""
                    value="{{ $operation->getOccupancy->description }}">
                <input type="text" class="underline-input" placeholder="">
                <input type="text" class="underline-input" placeholder="">



                <!-- TABLE 5 -->
                <p style="font-size: 12px;"> 7</p>
                <caption style="text-align: left; font-size: 12px;">Total Number of Casualty Reported:</caption>

                <tr>
                    <td style="font-size: 12px;"></td>
                    <td style="font-size: 12px;"> Injured</td>
                    <td style="font-size: 12px;"> Death</td>

                </tr>
                @foreach ($operation->casualties as $casualty)
                    @if ($casualty->type == 'civilian')
                        <tr>
                            <td style="font-size: 12px;">Civilian</td>
                            <td style="font-size: 12px;">{{ $casualty->injured }}</td>
                            <td style="font-size: 12px;">{{ $casualty->death }}</td>
                        </tr>
                    @else
                        <tr>
                            <td style="font-size: 12px;">FireFighter</td>
                            <td style="font-size: 12px;">{{ $casualty->injured }}</td>
                            <td style="font-size: 12px;">{{ $casualty->death }}</td>
                        </tr>
                    @endif
                @endforeach


            </table>

            <!-- TABLE 6 -->
            <table>
                <p style="font-size: 12px;"> 8</p>
                <caption style="text-align: left; font-size: 12px;">Breathing Apparatus Used:</caption>

                <tr>
                    <td style="font-size: 12px;">Nr.</td>
                    <td style="font-size: 12px;">Type/Kind</td>
                </tr>
                @foreach ($operation->getBreathingApparatus as $equipment)
                    <tr>
                        <td style="font-size: 12px;">{{ $equipment->quantity }}</td>
                        <td style="font-size: 12px;">{{ $equipment->type }}</td>
                    </tr>
                @endforeach

            </table>
        </div>

        <!-- <div>
   <table>
    
    
</div> -->





        <!--general description-->

        <div class="table-wrapper">

            <table>

                <caption style="font-size: 12px;">
                    <b>TIME ALARM STATUS DECLARED</b>
                </caption>
                <tr>
                    <td style="font-size: 12px;"></td>

                    <td style="font-size: 12px;">Time </td>
                    <td style="font-size: 12px;">Fund Commander</td>

                </tr>
                @foreach ($alarm_names as $name)
                    <tr>
                        <td style="font-size: 12px;">
                            {{ $name->name }}
                        </td>
                        <td style="font-size: 12px;">
                            @foreach ($operation->declaredAlarms as $alarm)
                                @if ($name->name == $alarm->alarm_name)
                                    {{ $alarm->time }}
                                @endif
                            @endforeach
                        </td>
                        <td style="font-size: 12px;">
                            @foreach ($operation->declaredAlarms as $alarm)
                                {{-- {{dd($alarm)}} --}}
                                @if ($name->name == $alarm->alarm_name)
                                    {{ $alarm->getGroundCommander->rank->slug . ' ' . $alarm->getGroundCommander->first_name . ' ' . $alarm->getGroundCommander->last_name }}
                                @endif
                            @endforeach

                        </td>


                    </tr>
                @endforeach
            </table>
            <table>
                <br>

                {{-- @foreach ($operation->getBreathingApparatus as $equipment)
                    <tr>
                        <td>{{ $equipment->quantity }}</td>
                        <td>{{ $equipment->type }}</td>
                    </tr>
                @endforeach --}}

                <caption style="font-size: 12px;">
                    10 Extinguishing Agent Used: </caption>


                <tr>

                    <td style="font-size: 12px;">
                        QTY</td>
                    <td style="font-size: 12px;">
                        TYPE/KIND</td>

                </tr>
                @foreach ($operation->getExtinguishingAgent as $equipment)
                    <tr>
                        <td style="font-size: 12px;">{{ $equipment->quantity }}</td>
                        <td style="font-size: 12px;">{{ $equipment->type }}</td>
                    </tr>
                @endforeach
            </table>
            <br>
            <table>
                <caption style="font-size: 12px;">
                    11 Rope and Ladder Used:</caption>
                <thead>

                    <tr>
                        <td style="font-size: 12px; text-align:center;">
                            Type.</td>

                        <td style="font-size: 12px; text-align:center;">
                            Length</td>
                    </tr>

                </thead>
                <tbody>
                    @foreach ($operation->getRopeAndLadder as $equipment)
                        <tr>
                            <td style="font-size: 12px; text-align:center;">{{ $equipment->type }}</td>

                            <td style="font-size: 12px; text-align:center;">{{ $equipment->length }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <br>
            <table>
                <caption style="font-size: 12px;">
                    12 Hose line Used:</caption>
                <tr>

                    <td style="font-size: 12px; text-align:center;">
                        Nr.</td>

                    <td style="font-size: 12px; text-align:center;">
                        TYPE/KIND</td>

                    <td style="font-size: 12px; text-align:center;">
                        TOTAL ft.</td>

                </tr>
                @foreach ($operation->getHoseLine as $equipment)
                    <tr>
                        <td style="font-size: 12px; text-align: center;">{{ $equipment->nr }}</td>
                        <td style="font-size: 12px; text-align: center;">{{ $equipment->type }}</td>
                        <td style="font-size: 12px; text-align: center;">{{ $equipment->length }}</td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>


    <table border="1">
        <p style="font-size: 12px;"> 13</p>
        <caption style="font-size: 12px;">
            Duty Personnel at the Fire Scene</caption>
        <tr>

            <td style="font-size: 12px; text-align: center;">

                Rank/Name</td>

            <td style="font-size: 12px; text-align:center;">
                Designation</td>

            <td style="font-size: 12px; text-align:center">
                Remarks</td>

        </tr>
        @foreach ($operation->dutyPersonnels as $duty_personnel)
            <tr>
                @foreach ($personnels as $personnel)
                    @if ($duty_personnel->personnels_id == $personnel->id)
                        <td style="font-size: 12px; text-align:center">
                            {{ $personnel->rank->slug . ' ' . $personnel->first_name . ' ' . $personnel->last_name }}
                        </td>
                    @endif
                @endforeach
                <td style="font-size: 12px; text-align:center">{{ $duty_personnel->designation }}</td>
                <td style="font-size: 12px; text-align:center">{{ $duty_personnel->remarks }}</td>
            </tr>
        @endforeach
    </table>

    <div>
        <p style="font-size: 12px;"> 15</p>
        <caption style="font-size: 12px;">
            INSTRUCTION/SKETCH OF THE FIRE OPERATION
            <b>(SHOULD BE ATTACHED):</b>
            <br>
            <caption style="font-size: 12px;">
                (Indicate the data frame,legend,location, north arrow and scale)</caption>
        <tr>
            <br>
            <br>
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
                            src="{{ asset('/assets/images/operation_images/' . $photo) }}">
                    @endforeach
                </div>
            @endif
            </caption>
    </div>

    <div>
        <br>

    </div>
    <br>
    <br>
    <br>

    <div>
        <caption style="font-size: 11px;">
            DETAILS (NARRATIVE):</caption>

        <div>
            <input type="text" value="{{ $operation->details }}">

        </div>

        <div>
            <p style="font-size: 12px;"> 16</p>
            <caption style="font-size: 12px;"> Problem/s Encountered during Operation:</caption>
            <br>
            <input type="text" value="{{ $operation->problem_encounter }}">
        </div>

        <div>
            <p style="font-size: 12px;"> 17</p>
            <caption style="font-size: 12px"> OBSERVATIONS/RECOMENDATIONS:</caption>
            <br>
            <input type="text" value="{{ $operation->observation_recommendation }}">
            <br>
            <br>
        </div>


        <div>
            <caption style="font-size: 11px;"> Prepared by: </caption>
            <br>
            <input type="text" readonly value="{{ $operation->prepared_by }}">
        </div>
        <br>
        <div>
            <caption style="font-size: 11px;"> Noted by: </caption>
            <br>
            <input type="text" readonly value="{{ $operation->noted_by }}">
        </div>




        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>

        </b>
        <footer>
            <h6 style="font-size: 11px;"> &copy; BFP-QSF-FSOD-006 Rev.00 (06.26.18) page 1 of 3</h6>
        </footer>
        <script>
            var elementToHide = document.getElementById("download-btn");

            function download() {
                // Replace "elementId" with the ID of your element

                // Add the d-none class to the element
                elementToHide.classList.add("d-none");
                console.log('hello');
                window.print();
            }
            window.addEventListener('afterprint', function() {
                // Remove the d-none class after print dialog is closed
                elementToHide.classList.remove("d-none");
            });
        </script>
</body>

</html>
