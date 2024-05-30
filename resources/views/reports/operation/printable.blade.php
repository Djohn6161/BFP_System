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
                <img  src="{{ asset('assets/images/logos/EDITED FINAL.png') }}" alt="Logo" class="logo">
            </div>
        </header>
        <section class="report-details">
            <br>
            <br>
            <label for="1">Explicity stipulated are the details of the fire incident that transpired on or about;</label>

            <table> 
                <tr>
                    <td>
                        <label for="alarm-received">Alarm received (Time):</label>
                        <text id="alarm-received">1615H</text>
                    </td>
                    <td class="" rowspan="4">
                        <label for="location">Location:</label>
                        <text id="location">Sitio Cabarok Brgy Allang, Ligao City</text>
                    </td>
                </tr>
                <tr>
                    <td>
                        
                        <label for="caller">Caller/Reported/Transmitted by:</label>
                        <text id="caller">FO3 Joffre Amador Gonzales</text>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="address">Office/Address of the Caller:</label>
                        <text id="address">Guinobatan Albay</text>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="personnel">Personnel on duty who received the alarm:</label>
                        <text id="personnel">FO2 Joenel C Carias</text>
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
                        <h6 style="font-weight: normal; margin: 0;">(TIME RECEIVED CALL - TIME ARRIVED AT FIRE SCENE) in minutes</h6>
                    </th>
                    
                    
                    <th>TIME RETURNED TO BASE</th>
                    <th>WATER TANK REFILLED (GAL)</th>
                    <th>GAS CONSUMED (L)</th>
                </tr>
                <tr>
                    <td>Morita FT</td>
                    <td>1616H</td>
                    <td>1620H</td>
                    <td>1616H-1620H</td>
                    <td>1650H</td>
                    <td>0</td>
                    <td>10L</td>
                </tr>
            </table>
        </section>
        
        <div class="row">
            <section class="alarm-status" style="width: 35%; float: left;">
                <h4>Alarm Status Upon Arrival</h4>
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
                <div class="column">
                    <br>
                    <label for="fire-control">Time/Date Under Control:</label>
                    <br>
                    <label for="fire-out">Time/Date Declared Fire Out:</label>
                  
                </div>
            </section>
            
            <section class="time-declared" style="width: 55%; float: right; margin-left:10%">
                <h4>TIME ALARM STATUS DECLARED</h4>
                <table>
                    <tr>
                        <th></th>
                        <th>Time</th>
                        <th>Fund Commander</th>
                    </tr>
                    <tr>
                        <td>1ST ALARM</td>
                        <td>10:00am</td>
                        <td>SFO1 Valentine Arcilla</td>
                    </tr>
                    <tr>
                        <td>1ST ALARM</td>
                        <td>10:00am</td>
                        <td>SFO1 Valentine Arcilla</td>
                    </tr>
                    <tr>
                        <td>1ST ALARM</td>
                        <td>10:00am</td>
                        <td>SFO1 Valentine Arcilla</td>
                    </tr><tr>
                        <td>1ST ALARM</td>
                        <td>10:00am</td>
                        <td>SFO1 Valentine Arcilla</td>
                    </tr>
                </table>
            </section>
        </div>

        <section class="additional-info">
            
            <div class="row">
                <div class="column">
                    <label for="occupancy">Type of Occupancy:</label>
                    <span id="occupancy">Structural</span>
                </div>
                <div class="column">
                    <label for="distance">Approximate Distance of Fire Incident From Fire Station (Km):</label>
                    <span id="distance">4 Km</span>
                </div>
            </div>
        </section>
        
        <section class="casualty-report">
            <h4>Total Number of Casualty Reported:</h4>
            <div class="row">
                <div class="column">
                    <label for="civilian-injured">Civilian Injured:</label>
                    <span id="civilian-injured">0</span>
                </div>
                <div class="column">
                    <label for="civilian-death">Civilian Death:</label>
                    <span id="civilian-death">0</span>
                </div>
            </div>
            <div class="row">
                <div class="column">
                    <label for="firefighter-injured">Firefighter Injured:</label>
                    <span id="firefighter-injured">0</span>
                </div>
                <div class="column">
                    <label for="firefighter-death">Firefighter Death:</label>
                    <span id="firefighter-death">0</span>
                </div>
            </div>
        </section>
        
        <section class="equipment-used">
            <h4>Breathing Apparatus Used</h4>
            <table>
                <tr>
                    <th>Nr.</th>
                    <th>Type/Kind</th>
                </tr>
                <tr>
                    <td>0</td>
                    <td>0</td>
                </tr>
            </table>
            
            <h4>Rope and Ladder Used</h4>
            <table>
                <tr>
                    <th>Type</th>
                    <th>Length</th>
                </tr>
                <tr>
                    <td>0</td>
                    <td>0</td>
                </tr>
            </table>
            
            <h4>Hose line Used</h4>
            <table>
                <tr>
                    <th>Nr.</th>
                    <th>Type/Kind</th>
                    <th>Total ft</th>
                </tr>
                <tr>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                </tr>
            </table>
        </section>
        
        <section class="duty-personnel">
            <h4>Duty Personnel at the Fire Scene</h4>
            <table>
                <tr>
                    <th>Rank/Name</th>
                    <th>Designation</th>
                    <th>Remarks</th>
                </tr>
                <tr>
                    <td>FO2 Elmar Nimo</td>
                    <td>Driver Isuzu FT</td>
                    <td></td>
                </tr>
                <tr>
                    <td>SF03 Miguel D Jaudan</td>
                    <td>C,OPN</td>
                    <td>Ground commander</td>
                </tr>
                <tr>
                    <td>SFO1 Aldin Fulio</td>
                    <td>SHIFT in Charge T/L</td>
                    <td></td>
                </tr>
                <tr>
                    <td>FO3 Achilles Pavilando</td>
                    <td>Driver Isuzu FT</td>
                    <td></td>
                </tr>
                <tr>
                    <td>FO2 Dan Corullo</td>
                    <td>Nozzleman Isuzu FT</td>
                    <td></td>
                </tr>
                <tr>
                    <td>FO2 Romeo Contante</td>
                    <td>Linemen Morita FT</td>
                    <td></td>
                </tr>
                <tr>
                    <td>FO2 Romulo Avila</td>
                    <td>Driver Morita FT</td>
                    <td></td>
                </tr>
                <tr>
                    <td>FO3 Harold Navia</td>
                    <td>Nozzleman Jiante FT</td>
                    <td></td>
                </tr>
            </table>
        </section>
        
        <section class="details-narrative">
            <h4>DETAILS (NARRATIVE):</h4>
            <p>At about 13 1511H December 2023, FO1 Joni P Navarro, personnel of Ligao City Fire Station informed this station thru a phone call that there is a fire in progress at Purok 5, Brgy. Sta Cruz, Ligao City, Albay. Upon receiving call, duty RTDO of Ligao City Fire Station immediately relayed the information to the duty operation personnel of this station.</p>
            <p>Immediately Isuzu firetruck with duty operation personnel of Ligao City Fire Station lead by SF03 Miguel D Jaudan C,OPN, SFO1 Aldin M Fulio, Shift-in-Charge of SHift A responded to the scene. Upon arrival at the fire scene duty operation personnel immediately extinguished the fire, on or about 1931H of the same date SF03 ordered for backup and Morita FT immediately proceeded at the scene and about 1939H of the same date C,OPN advised for the Jiante FT to dispatch and immediately proceed to the area. No casualties and no other house were involved in the fire incident, SF03 Miguel D Jaudan Ground commander declared fire under control at about 1941H and 1943H declared fire out.</p>
            <p>The investigation conducted by the lead investigator revealed that the residential dwelling made of concrete walling and with Anahaw roofing with an area of 2sqm x 5sqm or 10 square meters owned by Jose Amante Obra married, 72 years old and name of occupant Jessica Don Peralta married 57 years old, was totally gutted by fire. Cause of fire was due to unattended burned damage. The fire originated at the right side corner at the back of servant's quarter located. Estimated fire damage amounting to One hundred twenty thousand only.</p>
        </section>
        
        <section class="problems-encountered">
            <h4>Problem/s Encountered during Operation:</h4>
            <p>None</p>
        </section>
        
        <section class="observations-recommendations">
            <h4>OBSERVATIONS/RECOMMENDATIONS:</h4>
            <p>None</p>
        </section>
    </div>
</body>
</html>

<style>

body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f4f4f4;
}

.logo {
    width: 100px;
    margin: 0 10px; /* Add margin to create space around the logo */
}

.header-text {
    text-align: center;
    flex: 1;
}

.container {
    max-width: 1200px;
    margin: 20px auto;
    background: #fff;
    padding: 20px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

.header-top {
    display: flex;
    align-items: center;
    justify-content: center; /* Center the items horizontally */
}

header h1, header h2, header h3, header h4, header h5 {
    margin: 5px 0;
}

section {
    margin-bottom: 20px;
}

section h4 {
    margin-bottom: 10px;
}

.row {
    display: flex;
    flex-wrap: wrap;
    margin-bottom: 10px;
}

.column {
    flex: 1;
    padding: 5px;
    min-width: 200px;
}

label {
    font-weight: bold;
}

table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 10px;
}

table, th, td {
    border: 1px solid #ddd;
    padding: 8px;
}

th {
    background: #f4f4f4;
}

@media print {
    body {
        margin: 1in; /* Normal margin for printing */
        background: #fff;
    }

    .container {
        box-shadow: none;
        margin: 0;
        padding: 0;
        max-width: none; /* Allow the container to expand to full page width */
    }

    /* Rest of your styles... */
}


</style>