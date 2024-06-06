<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Continuous Header and Footer</title>

    <style>
        @page {
            size: 8.5in 13in;
            margin: .5in;
        }

        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            box-sizing: border-box;
        }

        .header,
        .footer {
            position: fixed;
            left: 0;
            width: 100%;
            background: white;
        }

        .header {
            top: 0;
            padding-bottom: 10px;
            /* Add space below header content */
        }

        .footer {
            bottom: 0;
            border-top: 1px solid #ccc;
        }

        .header-content,
        .footer-content {
            margin: 0 1in;
            text-align: center;
        }

        .content {
            margin-top: 2in;
            /* Adjust margin to account for header */
            margin-bottom: 1.5in;
            /* Adjust margin to account for footer */
        }

        @media print {
            body {
                margin: 0.5in;
            }

            .header,
            .footer {
                position: fixed;
                width: 100%;
            }

            .header {
                top: 0;
            }

            .footer {
                bottom: 0;
            }

            .content {
                margin-top: 1.5in;

                margin-bottom: .5in;


                .photo-container {
                    margin-top: 1.5in;
                }
                .last {
                    margin-top: 2in;
                }
            }



            .page-break {
                page-break-before: always;
            }
        }

        .header-top {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .logo {
            height: 80px;
        }

        .header-text {
            text-align: center;
        }

        .header-text text {
            font-size: 11px;
        }

        .header-text label {
            font-size: 13px;
            font-weight: bold;
        }

        body {
            font-family: Arial, sans-serif;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 5px 0;
        }

        th,
        td {
            border: 1px solid #000;
            text-align: left;
            font-size: 12px;
        }

        th {
            background-color: #f2f2f2;
        }

        label {
            font-weight: bold;
            font-size: 12px;
        }

        .row {
            display: flex;
            justify-content: space-between;
        }

        .column {
            flex: 1;
            margin: 0 10px;
        }

        .container {
            margin: 0 auto;
            padding: 0 20px;
        }

        .photo-container {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-wrap: wrap;
            margin-top: 20px;
            /* Adjust margin as needed */
        }

        .photo-container img {
            height: 350px;
            object-fit: cover;
            margin: 10px;
            page-break-inside: avoid;
        }
    </style>
</head>

<body>
    <div class="header">
        <div class="header-content">
            <div class="header-top">
                <img src="{{ asset('assets/images/logos/DILG-Logo.png') }}" alt="Left Logo" class="logo">
                <div class="header-text">
                    <div>
                        <text>Republic of the Philippines</text>
                    </div>
                    <div>
                        <label>Department of the Interior and Local Government</label>
                    </div>
                    <div>
                        <label style="color:royalblue">Bureau of Fire Protection</label>
                    </div>
                    <div>
                        <label>REGION V</label>
                    </div>
                    <div>
                        <text>2nd Flr. ANST Bldg., Capt. F. Aquende Drive</text>
                    </div>
                    <div>
                        <text>Albay District, Legazpi City</text>
                    </div>
                    <div>
                        <text>CP No. 09365474962</text>
                    </div>
                    <div>
                        <label>AFTER FIRE OPERATIONS REPORT</label>
                    </div>
                </div>
                <img src="{{ asset('assets/images/logos/EDITED FINAL.png') }}" alt="Right Logo" class="logo">
            </div>
        </div>
    </div>

    <div class="footer">
        <div class="footer-content" style="text-align: center;">
            BFP-QSF -FSOD-006 Rev.00 (06.26.18)-<span class="page-number"></span>
        </div>
    </div>

    <div class="content">

        <body style="margin: 0 auto; max-width: 1200px;">
            <div class="container">
                <section class="report-details">
                    <br>
                    <label for="1">Explicity stipulated are the details of the fire incident that transpired on
                        or about;</label>
                    <table>
                        <tr>
                            <td>
                                <label for="alarm-received">Alarm received (Time):</label>
                                <text id="alarm-received">{{ $operation->alarm_received }}</text>
                            </td>
                            <td rowspan="4">
                                <label for="location">Location:</label>
                                <text id="location">{{ $operation->full_location }}</text>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="caller">Caller/Reported/Transmitted by:</label>
                                <text id="caller">{{ $operation->transmitted_by }}</text>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="address">Office/Address of the Caller:</label>
                                <text id="address">{{ $operation->caller_address }}</text>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="personnel">Personnel on duty who received the alarm:</label>
                                <text
                                    id="personnel">{{ $operation->receivedBy->rank->slug . ' ' . $operation->receivedBy->first_name . ' ' . $operation->receivedBy->last_name }}</text>
                            </td>
                        </tr>
                    </table>
                </section>

                <section class="response-details">
                    <table>
                        <tr>
                            <th style="text-align: center;">ENGINE DISPATCHED</th>
                            <th style="text-align: center;">TIME DISPATCHED</th>
                            <th style="text-align: center;">TIME ARRIVED AT FIRE SCENE</th>
                            <th style="font-weight: normal white-space: nowrap; margin: 0; text-align: center;">RESPONSE TIME
                                <h6 style="font-weight: normal; margin: 0;">(TIME RECEIVED CALL - TIME ARRIVED AT FIRE
                                    SCENE) in minutes</h6>
                            </th>
                            <th style="text-align: center;">TIME RETURNED TO BASE</th>
                            <th style="text-align: center;">WATER TANK REFILLED (GAL)</th>
                            <th style="text-align: center;">GAS CONSUMED (L)</th>
                        </tr>
                        @foreach ($operation->responses as $response)
                            <tr>
                                <td style="text-align: center;">{{ $response->truck->name }}</td>
                                <td style="text-align: center;">{{ $response->time_dispatched }}</td>
                                <td style="text-align: center;">{{ $response->time_arrived_at_scene }}</td>
                                <td style="text-align: center;">{{ $response->response_duration }}</td>
                                <td style="text-align: center;">{{ $response->time_return_to_base }}</td>
                                <td style="text-align: center;">{{ $response->water_tank_refilled }}</td>
                                <td style="text-align: center;">{{ $response->gas_consumed }}</td>
                            </tr>
                        @endforeach
                    </table>
                </section>

                <div class="row">
                    <section class="alarm-status" style="width: 35%; float: left;">
                        <label>Alarm Status Upon Arrival</label>
                        <table>
                            <tr>
                                <td style="width: 20%; font-weight: normal; text-align: left;">{{ $operation->alarm_status_arrival }}</td>
                                <td style="width: 80%; font-weight: normal; text-align: left;">First Responder</td>
                            </tr>
                        </table>
                        <div>
                            <br>
                            <label style="font-weight: bold" for="fire-control">Time/Date Under Control:
                                <label style="font-weight: normal;">{{ $operation->td_under_control }}</label>
                            </label>
                            <br>
                            <label style="font-weight: bold" for="fire-out">Time/Date Declared Fire Out:
                                <text style="font-weight: normal">{{ $operation->td_declared_fireout }}</text>
                            </label>
                            <br>
                            <br>
                            <div>
                                <label for="occupancy">Type of Occupancy/</label>
                                <label for=""><text style="font-weight: normal" id="occupancy">(Please
                                        specify)</text></label>
                                <table>
                                    <tr>
                                        <td style="width: 20%;"></td>
                                        <td>{{ $operation->getOccupancy->type }} /
                                            {{ $operation->getOccupancy->specify }}</td>
                                    </tr>
                                </table>
                            </div>
                            <br>
                            <div>
                                <label for="distance">Approximate Distance of Fire Incident From Fire Station
                                    (Km):</label>
                                <br>
                                <label id="distance"
                                    style="display: block; text-align: center; font-weight: normal; margin: 0;">{{ $operation->getOccupancy->distance }}</label>
                                <div
                                    style="display: block; text-align: center; margin: 0; border-top: 1px solid black; margin-top: 5px; margin-bottom: 5px;">
                                </div>
                            </div>
                            <div>
                                <label for="distance">General Structure of the structure/s Involved:</label>
                                <br>
                                <label id="distance"
                                    style="display: block; text-align: center; font-weight: normal; margin: 0;">{{ $operation->getOccupancy->type }}</label>
                                <div
                                    style="display: block; text-align: center; margin: 0; border-top: 1px solid black; margin-top: 5px; margin-bottom: 5px;">
                                </div>
                            </div>

                            <div>
                                <label>Total Number of Casualty Reported:</label>
                                <table>
                                    <tr>
                                        <td style="text-align: center;"></td>
                                        <td style="text-align: center;"> Injured</td>
                                        <td style="text-align: center;"> Death</td>
                                    </tr>
                                    @foreach ($operation->casualties as $casualty)
                                        @if ($casualty->type == 'civilian')
                                            <tr>
                                                <td>Civilian</td>
                                                <td style="text-align: center;">{{ $casualty->injured }}</td>
                                                <td style="text-align: center;">{{ $casualty->death }}</td>
                                            </tr>
                                        @else
                                            <tr>
                                                <td>FireFighter</td>
                                                <td style="text-align: center;">{{ $casualty->injured }}</td>
                                                <td style="text-align: center;">{{ $casualty->death }}</td>
                                            </tr>
                                        @endif
                                    @endforeach
                                </table>
                            </div>

                            <div>
                                <label>Breathing Apparatus Used</label>
                                <table>
                                    <tr>
                                        <th style="text-align: center;">Nr.</th>
                                        <th style="text-align: center;">Type/Kind</th>
                                    </tr>
                                    @foreach ($operation->getBreathingApparatus as $equipment)
                                        <tr>
                                            <td style="text-align: center;">{{ $equipment->quantity }}</td>
                                            <td style="text-align: center;">{{ $equipment->type }}</td>
                                        </tr>
                                    @endforeach
                                </table>
                            </div>
                        </div>
                    </section>
                    <section class="time-declared" style="width: 55%; float: right; margin-left:10%">
                        <label>TIME ALARM STATUS DECLARED</label>
                        <table>
                            <tr>
                                <th></th>
                                <th>Time</th>
                                <th>Fund Commander</th>
                            </tr>
                            @foreach ($alarm_names as $name)
                                <tr>
                                    <td>{{ $name->name }}</td>
                                    <td>
                                        @foreach ($operation->declaredAlarms as $alarm)
                                            @if ($name->name == $alarm->alarm_name)
                                                {{ $alarm->time }}
                                            @endif
                                        @endforeach
                                    </td>
                                    <td>
                                        @foreach ($operation->declaredAlarms as $alarm)
                                            @if ($name->name == $alarm->alarm_name)
                                                {{ $alarm->getGroundCommander->rank->slug . ' ' . $alarm->getGroundCommander->first_name . ' ' . $alarm->getGroundCommander->last_name }}
                                            @endif
                                        @endforeach
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                        <label>Extinguising Agent Used:</label>
                        <table>
                            <tr>
                                <th style="text-align: center;">Qty</th>
                                <th style="text-align: center;">Type/Kind</th>
                            </tr>
                            @foreach ($operation->getExtinguishingAgent as $equipment)
                                <tr>
                                    <td style="text-align: center;">{{ $equipment->quantity }}</td>
                                    <td style="text-align: center;">{{ $equipment->type }}</td>
                                </tr>
                            @endforeach
                        </table>
                        <label>Rope and Ladder Used</label>
                        <table>
                            <tr>
                                <th style="text-align: center;">Type</th>
                                <th style="text-align: center;">Length</th>
                            </tr>
                            @foreach ($operation->getExtinguishingAgent as $equipment)
                                <tr>
                                    <td style="text-align: center;">{{ $equipment->type }}</td>
                                    <td style="text-align: center;">{{ $equipment->length }}</td>
                                </tr>
                            @endforeach
                        </table>
                        <label>Hose Line Used</label>
                        <table>
                            <tr>
                                <th style="text-align: center;">Nr</th>
                                <th style="text-align: center;">Type/Kind</th>
                                <th style="text-align: center;">Total (ft)</th>
                            </tr>
                            @foreach ($operation->getHoseLine as $equipment)
                                <tr>
                                    <td style="text-align: center;">{{ $equipment->no }}</td>
                                    <td style="text-align: center;">{{ $equipment->type }}</td>
                                    <td style="text-align: center;">{{ $equipment->length }}</td>
                                </tr>
                            @endforeach
                        </table>
                    </section>

                </div>
                <br>
                <section class="response-details">
                    <label>Duty Personnel at the Fire Scene</label>
                    <table>
                        <tr>
                            <th style="text-align: center;">Rank/Name</th>
                            <th style="text-align: center;">Designation</th>
                            <th style="text-align: center;">Remarks</th>

                        </tr>
                        @foreach ($operation->dutyPersonnels as $duty_personnel)
                            <tr>
                                @foreach ($personnels as $personnel)
                                    @if ($duty_personnel->personnels_id == $personnel->id)
                                        <td style="text-align: center;">
                                            {{ $personnel->rank->slug . ' ' . $personnel->first_name . ' ' . $personnel->last_name }}
                                        </td>
                                    @endif
                                @endforeach
                                <td style="text-align: center;">{{ $duty_personnel->designation }}</td>
                                <td style="text-align: center;">{{ $duty_personnel->remarks }}</td>
                            </tr>
                        @endforeach
                    </table>
                </section>
                <br>
                <section class="instruction-sketch">
                    <label>Instruction/Sketch of the Fire Operation (Should be Attached): </label>
                    <h6 style="font-weight: normal; margin: 0;"><i>(Indicate the data frame, legend, location, north
                            arrow scale)</i></h6>
                    <div class="page-break"></div>
                    <div class="container">
                        <div class="photo-container">
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
                                @foreach ($photos as $photo)
                                    <img style="height: 350px; object-fit: cover; margin: 15px;" class="w-100"
                                        src="{{ asset('/assets/images/operation_images/' . $photo) }}">
                                @endforeach
                            @endif
                        </div>
                    </div>

                </section>
                <section class="Details/Narrative">
                    <label>DETAILS/ NARRATIVE </label>
                    <label id="distance"
                    style="display: block;font-weight: normal; margin: 0;">{{ $operation->details }}</label>
                </section>
                <br>
                 <section class="PEDO">
                    <label>Problem/s Encountered During Operation </label>
                    <label id="distance"
                    style="display: block; font-weight: normal; margin: 0;">{{ $operation->problem_encounter }}</label>
                </section>
                <br>
                <section class="OR">
                    <label>OBSERVATION/RECCOMENDATION</label>
                    <label id="distance"
                    style="display: block; font-weight: normal; margin: 0;">{{ $operation->observation_recommendation }}</label>
                </section>
                <br>
                <div class="page-break"></div>
                <section class="last">
                    <label>Prepared by:</label>
                    <label id="distance"
                    style="display: block; font-weight: normal; margin: 0;">{{ $operation->prepared_by }}</label>
              <br>
              <br>

              
                    <label>Noted by:</label>
                    <label id="distance"
                    style="display: block; font-weight: normal; margin: 0;">{{ $operation->noted_by }}</label>
                </section>
            </div>
        </body>
    </div>

    <script>
        function updatePageNumbers() {
            var totalPages = Math.ceil(document.body.scrollHeight / window.innerHeight);
            var pageNumbers = document.querySelectorAll('.page-number');
    
            for (var i = 0; i < pageNumbers.length; i++) {
                pageNumbers[i].textContent = 'Page ' + (i + 1) + ' of ' + totalPages;
            }
        }
    
        window.onload = updatePageNumbers;
        window.onresize = updatePageNumbers;
    </script>
    
    
    
</body>

</html>
