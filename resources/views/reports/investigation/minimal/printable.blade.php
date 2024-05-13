<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PDF Minimal</title>
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
            max-height: 6rem;
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
            header {
                margin-top: -1rem;
                /* Shifting the header upward in print */
                padding-bottom: 0;
                /* Removing padding at the bottom */
            }

            @page {
                size: 8.5in 13in;
                /* Setting the size to long bond paper */
                margin: 0.5in;
                /* Margin around the page */
            }

            body {
                margin-top: .25in;
                margin-bottom: .25in;
                margin-left: .5in;
                margin-right: .5in;
            }

            header img {
                margin-top: -4rem;
            }
        }

        .a {
            width: 100%;
            border-collapse: collapse;
        }

        .a th,
        td {
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

        .my-table {
            width: 100%;
            /* Full width of the container */

            border-collapse: collapse;
            /* Removes extra spacing */
        }

        .my-table th,
        .my-table td {
            padding: 10px;
            /* Consistent padding */
            text-align: left;
            /* Left-align text */
            border: 1px solid #000;
            /* Border around cells */
        }

        .my-table th {
            font-weight: bold;
            /* Bold text for table headers */
        }

        .photo {
            /* Centers vertically */
            min-height: 500px;
            /* Adjust as needed */
            font-size: larger;
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

        /* Container */
        .container {
            margin-right: auto;
            margin-left: auto;
            padding-right: 15px;
            padding-left: 15px;
        }

        /* Row */
        .row {
            display: flex;
            flex-wrap: wrap;
            margin-right: -15px;
            margin-left: -15px;
        }

        /* Column */
        .col {
            flex-basis: 0;
            flex-grow: 1;
            max-width: 100%;
            padding-right: 15px;
            padding-left: 15px;
        }

        .col-1 {
            flex: 0 0 8.333333%;
            max-width: 8.333333%;
        }

        .col-2 {
            flex: 0 0 16.666667%;
            max-width: 16.666667%;
        }

        /* Add more col classes for different widths */

        /* Add padding utility classes */
        .p-1 {
            padding: 0.25rem;
        }

        .p-2 {
            padding: 0.5rem;
        }

        /* Add margin utility classes */
        .m-1 {
            margin: 0.25rem;
        }

        .m-2 {
            margin: 0.5rem;
        }

        /* Add border utility classes */
        .border {
            border: 1px solid #dee2e6;
        }

        /* Add rounded corners utility classes */
        .rounded {
            border-radius: 0.25rem;
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
            <p>Republic of the Philippines</p>
            <p>Department of the Interiorand Local Government</p>
            <p><b>BUREAU OF FIRE PROTECTION</b></p>
            <p>National Headquarters</p>
            <p>Agham Road, Brgy.Bagong Pag-asa, Diliman, Quezon City</p>
            <p><small>Ligao City Fire Station</small></p>
            <p><small>Ligao City Albay</small></p>
            <p><small>Hotline No.:09991234567</small></p>
            <p><small>Email Address: ligaocityfs@yahoo.com</small></p>
        </div>
        <div>
            <img src="{{ asset('assets/images/logos/EDITED FINAL.png') }}" alt="Right Logo">
        </div>
    </header>

    <main>
        <p><b>MEMORANDUM</b></p>
        <table class="a">
            <tr>
                <th>FOR</th>
                <td><b>{{ $minimal->investigation->for }}</b></td>
            </tr>
            <tr>
                <th>SUBJECT</th>
                <td><b>{{ $minimal->investigation->subject }}</b></td>
            </tr>
            <tr>
                <th>DATE</th>
                <td><b>{{ $minimal->investigation->date }}</b></td>
            </tr>
        </table>
        <hr>

        <h4>AUTHORITY:</h4>
        <p>1. This pertains to the fire incident docked as at
            {{ $minimal->incident_location . ' ' . $minimal->involved_property }} fire with Case Number
            {{ $minimal->dt_reported }}</p>
        <p>2. In this connection, provided here under are the pertinent facts of the case, to with:</p>
    </main>
    <table class="my-table">

        <tr>
            <th colspan="2"><b><strong>DETAILS</strong></b></th>
        </tr>
        <tr>
            <th>Date and Time of Actual Occurence</th>
            <td>{{ $minimal->dt_actual_occurence }}</td>
        </tr>
        <tr>
            <th>Date and Time Reported</th>
            <td>{{ $minimal->dt_reported }}</td>
        </tr>
        <tr>
            <th>Incident Location</th>
            <td>{{ $minimal->incident_location }}</td>
        </tr>
        <tr>
            <th>Involved Property/Establishment</th>
            <td>{{ $minimal->involved_property }}</td>
        </tr>
        <tr>
            <th>Property Data</th>
            <td>Owned by: {{ $minimal->property_data }}</td>
        </tr>
        <tr>
            <th colspan="2">RESPONSE AND SUPPRESSION DATA</th>

        </tr>
        <tr>
            <th>Receiver</th>
            <td></td>
        </tr>
        <tr>
            <th>Caller Information</th>
            <td>Complete name: {{ $minimal->caller_name }} <br>Address: {{ $minimal->caller_address }}
                <br>Telephone Number: {{ $minimal->caller_number }}
            </td>
        </tr>
        <tr>
            <th>Notification Originator</th>
            <td>{{ $minimal->notification_originator }}</td>
        </tr>
        <tr>
            <th>First Responding Unit</th>
            <td><b>{{ $minimal->respondingEngine->name }}</b> and Crew,
                <b>{{ $minimal->respondingLeader->rank->slug . ' ' . $minimal->respondingLeader->last_name . ' ' . $minimal->respondingLeader->first_name }}</b>
                Team Leader
            </td>
        </tr>
        <tr>
            <th>Time of Arrival on Scene</th>
            <td>{{ $minimal->time_arrival_on_scene }}</td>
        </tr>
        <tr>
            <th>Alarm Status-Time</th>
            <td>{{ $minimal->alarm->name }}</td>
        </tr>
        <tr>
            <th>Time Fire Out</th>
            <td>{{ $minimal->Time_Fire_out }}</td>
        </tr>
        <tr>
            <th colspan="2">INVOLVED PARTIES</th>

        </tr>
        <tr>
            <th>Owner of property/establishment</th>
            <td>{{ $minimal->property_owner }}</td>
        </tr>
        <tr>
            <th>Occupant of propertyy/establishment</th>
            <td>{{ $minimal->property_occupant != '' ? $minimal->property_occupant : 'N/A' }}</td>
        </tr>
    </table>
    <br>
    <br>
    <p><b>3. DETAILS OF INVESTIGATION</b> <br> <br>
        &emsp;&emsp;&emsp;{!! $minimal->details !!}</p>
    <p><b>FINDINGS:</b> <br> <br>
        &emsp;&emsp;&emsp;{!! $minimal->findings !!}</p>
    <p><b>RECOMMENDATION:</b> <br> <br>
        &emsp;&emsp;&emsp;{!! $minimal->recommendation !!}</p>

    <br>

    <div class="photo">
        <p><b>PHOTOGRAPH OF THE FIRE SCENE</b></p>

        @if ($minimal->photos != '' || $minimal->photos != null)
            @php
                if ($minimal->photos != '') {
                    $photos = explode(', ', $minimal->photos);
                }
            @endphp
            <div class="ps-5 row">
                @foreach ($photos as $photo)
                    <div class="col-sm-4">
                        <div class="card">
                            <div class="card-body p-1">
                                <a href="{{ asset('storage/minimal/' . $photo) }}" data-toggle="lightbox"
                                    data-gallery="example-gallery">
                                    <img style="height: 350px; object-fit: cover;" class="w-100"
                                        src="{{ asset('storage/minimal/' . $photo) }}" alt="Sample Image">
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

        @endif
    </div>

    <footer>
        <p></p>
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
