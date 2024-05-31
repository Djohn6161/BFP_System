<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>After Fire Operations Report</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body style="margin: 0 auto; max-width: 1200px;">
    <div class="container">
        <header>
            <div class="header-top">
                <img src="{{ asset('assets/images/logos/DILG-Logo.png') }}" alt="Logo" class="logo">
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
                <img src="{{ asset('assets/images/logos/EDITED FINAL.png') }}" alt="Logo" class="logo">
            </div>
        </header>
        <section class="report-details">

            <br>
            <label for="1">Explicity stipulated are the details of the fire incident that transpired on or
                about;</label>

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
                    <th>ENGINE DISPATCHED</th>
                    <th>TIME DISPATCHED</th>
                    <th>TIME ARRIVED AT FIRE SCENE</th>
                    <th style="font-weight: normal white-space: nowrap; margin: 0;">RESPONSE TIME
                        <h6 style="font-weight: normal; margin: 0;">(TIME RECEIVED CALL - TIME ARRIVED AT FIRE SCENE) in
                            minutes</h6>
                    </th>
                    <th>TIME RETURNED TO BASE</th>
                    <th>WATER TANK REFILLED (GAL)</th>
                    <th>GAS CONSUMED (L)</th>
                </tr>
                @foreach ($operation->responses as $response)
                    <tr>
                        <td>{{ $response->truck->name }}</td>
                        <td>{{ $response->time_dispatched }}</td>
                        <td>{{ $response->time_arrived_at_scene }}</td>
                        <td>{{ $response->response_duration }}</td>
                        <td>{{ $response->time_return_to_base }}</td>
                        <td>{{ $response->water_tank_refilled }}</td>
                        <td>{{ $response->gas_consumed }}</td>
                    </tr>
                @endforeach
            </table>
        </section>

        <div class="row">
            <section class="alarm-status" style="width: 35%; float: left;">
                <label>Alarm Status Upon Arrival</label>
                <table>
                    <tr>
                        <td style="width: 20%; font-weight: normal; text-align: left;"></td>
                        <td style="width: 80%; font-weight: normal; text-align: left;">First Responder</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>Augmenting Team</td>
                    </tr>
                </table>
                <div>
                    <br>
                    <label style="font-weight: bold" for="fire-control">Time/Date Under Control:
                        <text style="font-weight: normal;">{{ $operation->td_under_control }}</text>
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
                        <table style="border: none;">
                            <tr>
                                <td style="width: 10%; font-weight: normal; text-align: left; border: none;"></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td style="border: none;">
                                    {{ $operation->getOccupancy->type }} / {{ $operation->getOccupancy->specify }}
                                </td>
                            </tr>
                        </table>
                    </div>
                    <br>
                    <div>
                        <label for="distance">Approximate Distance of Fire Incident From Fire Station (Km):</label>
                        <br>

                        <label id="distance"
                            style="display: block; text-align: center; font-weight: normal; margin: 0;">{{ $operation->getOccupancy->distance }}</label>
                        <div
                            style="display: block; text-align: center; margin: 0; border-top: 1px solid black; margin-top: 5px; margin-bottom: 5px;">
                        </div>

                    </div>
                    <br>
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
                            </tr>

                        </table>
                    </div>

                    <div>

                        <section class="equipment-used">
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
                        </section>
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
            </section>
        </div>
    </div>
</body>

<style>
    body {
        font-family: Arial, sans-serif;
    }

    header {
        text-align: center;
        margin-bottom: 20px;
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

    table {
        width: 100%;
        border-collapse: collapse;
        margin: 5px 0;
    }

    th,
    td {
        border: 1px solid #000;
        
        text-align: left;
        font-size: 11px;
        /* Set default font size to 11px for all table text */
    }

    th {
        background-color: #f2f2f2;
        font-size: 11px;
        /* Set font size to 13px for headers */
    }

    label {
        font-weight: bold;
        font-size: 11px;
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

    .section-title {
        font-size: 18px;
        margin: 10px 0;
        font-weight: bold;
    }

    h4 {
        font-size: 16px;
        margin: 10px 0;
    }

    .additional-info,
    .casualty-report,
    .equipment-used,
    .damage-estimation,
    .responders {
        margin: 20px 0;
    }
</style>

</html>
