<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PDF Final</title>
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
                <td><b>{{ $final->investigation->for }}</b></td>
            </tr>
            <tr>
                <th>SUBJECT</th>
                <td><b>{{ $final->investigation->subject }}</b></td>
            </tr>
            <tr>
                <th>DATE</th>
                <td><b>{{ $final->investigation->date }}</b></td>
            </tr>
        </table>
        <hr>
        <br>
        <div>
            <table class="b">
                <tr>
                    <th>FINAL INVESTIGATION REPORT (F.I.R.)</th>
                    <th>INVESTIGATION AND INTELLIGENCE UNIT {{ $final->intelligence_unit }}</th> <!--input details -->
                </tr>
                <tr>
                    <th>01. PLACE OF FIRE: <p style="text-align: center">{{ $final->place_of_fire }}</p>
                    </th> <!--input details -->
                    <th>02. TIME AND DATE OF ALARM: <p style="text-align: center">{{ $final->td_alarm }}</p>
                    </th> <!--input details -->
                </tr>
                <tr>
                    <th>03. ESTABLISHMENT BURNED: <br> <p style="text-align: left">{{ $final->establishment_burned }}</p> <br>05. DAMAGE PROPERTY: <p style="text-align: left">{{'₱ ' . number_format($final->damage_to_property, 0, '.', ',') }}</p></th> <!--input details -->
                    <th rowspan="1">04. FIRE VICTIM/S:
                        @unless (count($final->investigation->victims) == 0)
                            @foreach ($final->investigation->victims as $victim)
                            <p style="text-align: center">{{ $victim->name }}</p>
                            @endforeach
                            @else
                            <p style="text-align: center">Negative</p>
                        @endunless
                            
                        </th> <!--input details -->
                    </tr>
                    <tr>
                        <th colspan="2">06. ORIGIN OF FIRE:
                            {!! $final->origin_of_fire !!}    
                        </th> <!--input details -->
                    </tr>
                    <tr>
                        <th colspan="2">07. CAUSE OF FIRE:
                            {!! $final->cause_of_fire !!}    
                        </th> <!--input details -->
                    </tr>
                </table>
            </div>

            <br>
            <div class="paragraph">
                <p style="font-weight: bold; margin-left: -40px;">08. SUBSTANTIATING DOCUMENTS:</p>
                <p> {!! $final->substantiating_documents !!}</p>

                <br>
                <p style="font-weight: bold; margin-left: -40px;">FACTS OF THE CASE:</p>
                <p>{!! $final->facts_of_the_case !!}</p>

                <br>
                <p style="font-weight: bold; margin-left: -40px;">DISCUSSION:</p>
                <p>{!! $final->discussion !!}
                </p>

                <br>
                <p style="font-weight: bold; margin-left: -40px;">FINDINGS:</p>
                <p>{!! $final->findings !!}
                </p>

                <br>
                <p style="font-weight: bold; margin-left: -40px;">RECOMMENDATION:</p>
                <p>{!! $final->recommendation !!}
                </p>

                {{-- <p style="font-weight: bold; text-align: right;">Sincerely,<br>
                    <span style="font-weight: normal;">[Your Name]</span>
                </p>

                <span style="font-weight: bold; text-align: left; margin-left: 10px;">Noted By:<br>
                    <span style="font-weight: normal;">[Your Name]</span>
                </span> --}}
            </div>
        </main>
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
