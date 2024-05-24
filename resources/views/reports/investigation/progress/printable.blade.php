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
        margin-top: -1rem;  /* Shifting the header upward in print */
        padding-bottom: 0;  /* Removing padding at the bottom */
    }
            @page {
                size: 8.5in 13in;  /* Setting the size to long bond paper */
                margin: 0.5in;  /* Margin around the page */
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
    <div style="margin: 30px;">
        <div style="display: flex; justify-content: space-between;">
            <a id="back-btn" style="padding: 10px 30px; border-radius: 30px;"
             href="{{ route('investigation.progress.index') }}" class="btn btn-primary">Back</a>
            <button id="download-btn" class="btn btn-primary" style="padding: 10px 30px; border-radius: 30px;"
                    onclick="download(this)">PRINT</button>
        </div>
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
                <td><b>{{ $progress->investigation->for }}</b></td>
            </tr>
            <tr>
                <th>SUBJECT</th>
                <td><b>{{ $progress->investigation->subject }}</b></td>
            </tr>
            <tr>
                <th>DATE</th>
                <td><b>{{ $progress->investigation->date }}</b></td>
            </tr>
        </table>
        <hr>

        <h4>AUTHORITY:</h4>
        <p>{!! $progress->authority !!}</p>
        <h4>MATTERS INVESTIGATED:</h4>
        <p>{!! $progress->matters_investigated !!}</p>
        <h4>FACTS OF THE CASE:</h4>
        <p>&emsp;&emsp;{!! $progress->facts_of_the_case !!}</p>
        <h4>DISPOSITION:</h4>
        <p>&emsp;&emsp;{!! $progress->disposition !!}</p>

            
        
    </main>
    
    <footer>
        <p></p>
    </footer>
    <script>
        var backBtn = document.getElementById("back-btn");
        var printBtn = document.getElementById("download-btn");
    
        function download() {
            // Hide both the "Back" button and the "PRINT" button
            backBtn.classList.add("d-none");
            printBtn.classList.add("d-none");
    
            // Print the page
            window.print();
        }
    
        window.addEventListener('afterprint', function() {
            // Show both the "Back" button and the "PRINT" button after printing
            backBtn.classList.remove("d-none");
            printBtn.classList.remove("d-none");
        });
    </script>
</body>

</html>
