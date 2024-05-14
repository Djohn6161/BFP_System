<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SPOTP PDF</title>
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
            max-height: 5rem;
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

        /* Common table styles */
        .memorandum-table {
            width: 100%;
            border-collapse: collapse;
        }

        .memorandum-table th,
        .memorandum-table td {
            padding: 8px;
            text-align: left;
            padding-left: 0;
            padding-right: 0;
        }

        .memorandum-table th {
            background-color: #f2f2f2;
            width: 20%;
            vertical-align: top;
        }

        .memorandum-table td {
            width: 80%;
        }


        .details-table {
            width: 100%;
            border-collapse: collapse;
        }

        .details-table th,
        .details-table td {
            padding: 8px;
            text-align: left;
            padding-left: 0;
            padding-right: 0;
            padding-top: 2px;
            padding-bottom: 2px;
        }

        .details-table th {
            background-color: #f2f2f2;
            width: 20%;
            vertical-align: top;
        }

        .details-table td {
            width: 80%;
        }

        .details-table th,
        .memorandum-table th {
            position: relative;
        }

        .details-table th::after,
        .memorandum-table th::after {
            font-weight: bold;
            content: ":";
            margin-left: 5px;
            margin-right: 5px;
            position: absolute;
            right: 0;
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
    <p><b>MEMORANDUM</b></p>

    <table class="memorandum-table">
        <tr>
            <th>FOR</th>
            <td>
                {{$spot->investigation->for}}
            </td>
        </tr>
        <tr>
            <th>SUBJECT</th>
            <td>{{$spot->investigation->subject}}</td>
        </tr>
        <tr>
            <th>DATE</th>
            <td>{{$spot->investigation->date}}</td>
        </tr>
    </table>

    <hr>

    <table class="details-table">
        <tr>
            <th colspan="2">DTPO</th>
            <td colspan="4">{{$spot->date_occurence}}</td>
        </tr>
        <tr>
            <th colspan="2">INVOLVED</th>
            <td colspan="2">{{$spot->involved}}</td>
        </tr>
        <tr>
            <th colspan="2">NAME OF ESTABLISHMENT</th>
            <td colspan="2">{{$spot->name_of_establishment ?? "N/A"}}</td>
        </tr>
        <tr>
            <th colspan="2">OWNER</th>
            <td colspan="2">{{{$spot->owner}}}</td>
        </tr>
        <tr>
            <th colspan="2">OCCUPANT</th>
            <td colspan="2">{{$spot->occupant}}</td>
        </tr>
        <tr>
            <th rowspan="2">CASUALTY</th>
            <th>Fatality</th>
            <td>{{ $spot->fatality != 0 ? $spot->fatality : 'Negative' }}</td>
        </tr>
        <tr>
            <th>Injured</th>
            <td>{{ $spot->injured != 0 ? $spot->injured : 'Negative' }}</td>
        </tr>
        <tr>
            <th colspan="2">ESTIMATED DAMAGE</th>
            <td colspan="2">{{'₱ ' . number_format($spot->estimate_damage, 0, '.', ',') }}</td>
        </tr>
        <tr>
            <th colspan="2">TIME FIRE STARTED</th>
            <td colspan="2">{{ $spot->time_fire_start }}</td>
        </tr>
        <tr>
            <th colspan="2">TIME OF FIRE OUT</th>
            <td colspan="2">{{ $spot->time_fire_out }}</td>
        </tr>
        <tr>
            <th colspan="2">ALARM</th>
            <td colspan="2">{{ $spot->alarmed->name }}</td>
        </tr>
        <!-- <tr>
            <th colspan="2">DETAILS OF INVESTIGATION</th>
            <td colspan="2"></td>
        </tr> -->
    </table>

    <br>

    <table class="details-table">
        <thead>
            <th style="text-align: left;">DETAILS OF INVESTIGATION :</th>
        </thead>
        <tbody>
            <td>
                {!! $spot->details !!}
            </td>
        </tbody>
    </table>

    <br>

    <table class="details-table">
        <thead>
            <th style="text-align: left;">DISPOSITION :</th>
        </thead>
        <tbody>
            <td>
                {!! $spot->disposition !!}
            </td>
        </tbody>
    </table>
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
