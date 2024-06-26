
@extends('layouts.user-template')
@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-lg-11 p-4">
                <div class="row">
                    <form>
                        <div class="row border border-light-subtle shadow rounded p-4 mb-4">
                            <h3 class="border-bottom border-4 border-secondary pb-2 mb-3">1</h3>
                            <div class="col-lg-6 mb-3">
                                <label for="alarmReceived" class="form-label">Alarm Received (Time)</label>
                                <input type="text" placeholder="Eg. 2300h" class="form-control text-uppercase"
                                    id="alarmReceivedInput">
                            </div>

                            <div class="col-lg-6 mb-3">
                                <label for="caller" class="form-label">Caller/Reported/Transmitted by:</label>
                                <select class="form-select caller" aria-label="">
                                    <option selected>Select caller</option>
                                    <option value="1">One</option>
                                    <option value="2">Two</option>
                                    <option value="3">Three</option>
                                </select>
                            </div>
                            <div class="col-lg-6 mb-3">
                                <label for="officeAddress" class="form-label">Office / Address of the Caller</label>
                                <select class="form-select officeAddressCaller" aria-label="">
                                    <option selected>Select the office or address</option>
                                    <option value="1">One</option>
                                    <option value="2">Two</option>
                                    <option value="3">Three</option>
                                </select>
                            </div>
                            <div class="col-lg-6 mb-3">
                                <label for="officeAddress" class="form-label">Personnel on duty who received the
                                    alarm</label>
                                <select class="form-select personnelReceive" aria-label="">
                                    <option selected>Select personnel</option>
                                    <option value="1">One</option>
                                    <option value="2">Two</option>
                                    <option value="3">Three</option>
                                </select>
                            </div>

                            <hr>
                            {{-- <h5>Location</h5> --}}
                            <div class="col-lg-6 mb-3">
                                <label for="officeAddress" class="form-label">Barangay</label>
                                <select class="form-select barangayApor" aria-label="">
                                    <option selected>Select barangay</option>
                                    <option value="1">One</option>
                                    <option value="2">Two</option>
                                    <option value="3">Three</option>
                                </select>
                            </div>
                            <div class="col-lg-6 mb-3">
                                <label for="officeAddress" class="form-label">Zone</label>
                                <select class="form-select zoneApor" aria-label="">
                                    <option selected>Select zone</option>
                                    <option value="1">One</option>
                                    <option value="2">Two</option>
                                    <option value="3">Three</option>
                                </select>
                            </div>
                            <div class="col-lg-12 mb-3">
                                <label for="otherLocation" class="form-label">Other Location</label>
                                <input type="text" placeholder="Enter other location" class="form-control"
                                    id="otherLocation">
                            </div>
                        </div>

                        <div class="row border border-light-subtle shadow rounded p-4 mb-4">
                            <div class="row m-0 p-0 second-div border-0">
                                {{-- <h3 class="border-bottom border-4 border-secondary pb-2 mb-3">Fire Engine Response Details</h3> --}}
                                <h3 class="border-bottom border-4 border-secondary pb-2 mb-3">2</h3>
                                <div class="col-lg-3 mb-3">
                                    <label for="vehicle" class="form-label">Engine Dispatched</label>
                                    <select class="form-select engineDispatched" aria-label="">
                                        <option selected>Select vehicle</option>
                                        <option value="1">One</option>
                                        <option value="2">Two</option>
                                        <option value="3">Three</option>
                                    </select>
                                </div>
                                <div class="col-lg-3 mb-3">
                                    <label for="timeDispatched" class="form-label">Time Dispatched</label>
                                    <input type="text" placeholder="Eg. 2300h" class="form-control text-uppercase"
                                        id="timeDispatchedInput">
                                </div>
                                <div class="col-lg-3 mb-3">
                                    <label for="timeArrivedFireScene" class="form-label">Time Arrived at Fire Scene</label>
                                    <input type="text" placeholder="Eg. 2300h" class="form-control text-uppercase"
                                        id="timeArrivedFireSceneInput">
                                </div>
                                <div class="col-lg-3 mb-3">
                                    <label for="responseTime" class="form-label">Response Time</label>
                                    <input type="text" placeholder="Eg. 1900h - 2300h"
                                        class="form-control text-uppercase" id="responseTimeInput">
                                </div>
                                <div class="col-lg-4 mb-3">
                                    <label for="timeReturned" class="form-label">Time Returned to Base</label>
                                    <input type="text" placeholder="Eg. 1900h - 2300h"
                                        class="form-control text-uppercase" id="timeReturnedInput">
                                </div>
                                <div class="col-lg-4 mb-3">
                                    <label for="waterTank" class="form-label">Water Tank Refilled (GAL)</label>
                                    <input type="text" placeholder="Eg. 1900h - 2300h"
                                        class="form-control text-uppercase" id="waterTankInput">
                                </div>
                                <div class="col-lg-4 mb-3">
                                    <label for="gasConsumed" class="form-label">Gas Consumed (L)</label>
                                    <input type="text" placeholder="Eg. 24l" class="form-control text-uppercase"
                                        id="gasConsumedInput">
                                </div>
                            </div>
                            <hr>
                            <div class="row m-0 p-0">
                                <button type="button" id="addNewDivApor" class="btn btn-primary">+ Add New Fire Engine
                                    Response Details</button>
                            </div>
                        </div>

                        <div class="row border border-light-subtle shadow rounded my-3 p-4">
                            {{-- <h3 class="border-bottom border-4 border-secondary pb-2 mb-3">Fire Alarm Status and Response Details</h3> --}}
                            <h3 class="border-bottom border-4 border-secondary pb-2 mb-3">3 and 9</h3>
                            <div class="col-lg-6">
                                <label for="alarmStatus" class="form-label">Alarm Status</label>
                                <select class="form-select alarmStatus" aria-label="">
                                    <option selected>Select alarm status</option>
                                    <option value="1">1st Alarm</option>
                                    <option value="2">2nd Alarm</option>
                                    <option value="3">3rd Alarm</option>
                                    <option value="4">4th Alarm</option>
                                    <option value="5">5th Alarm</option>
                                    <option value="6">Task Force Alpha</option>
                                    <option value="6">Task Force Bravo</option>
                                    <option value="6">Task Force Charlie</option>
                                    <option value="6">Task Force Delta</option>
                                    <option value="6">Task Force Echo</option>
                                    <option value="6">Task Force Hotel</option>
                                    <option value="6">Task Force India</option>
                                    <option value="8">General Alarm</option>
                                </select>
                            </div>
                            <div class="col-lg-6 mb-3">
                                <label for="firstResponder" class="form-label">First Responder</label>
                                <input type="text" placeholder="Enter responder" class="form-control"
                                    id="firstResponderInput">
                            </div>
                            <div class="col-lg-6 mb-3">
                                <label for="underControl" class="form-label">Time / Date Under Control</label>
                                <input type="datetime-local" placeholder="" class="form-control"
                                    id="firstResponderInput">
                            </div>
                            <div class="col-lg-6 mb-3">
                                <label for="fireOut" class="form-label">Time / Date Declared Fire Out</label>
                                <input type="datetime-local" placeholder="" class="form-control"
                                    id="firstResponderInput">
                            </div>
                            <hr>
                            <div class="row time-alarm-status-declared-div m-0 p-0">
                                <h5>Time Alarm Status Declared</h5>
                                <div class="col-lg-4 mb-3">
                                    <label for="timeAlarmStatusDeclared" class="form-label">Alarm Status</label>
                                    <select class="form-select alarmApor" aria-label="">
                                        <option selected>Select alarm status</option>
                                        <option value="1">One</option>
                                        <option value="2">Two</option>
                                        <option value="3">Three</option>
                                    </select>
                                </div>
                                <div class="col-lg-4 mb-3">
                                    <label for="timeAlarmStatusDeclaredTime" class="form-label">Time</label>
                                    <input type="text" placeholder="Eg. 2300h" class="form-control text-uppercase"
                                        id="timeAlarmStatusDeclaredTime">
                                </div>
                                <div class="col-lg-4 mb-3">
                                    <label for="fundCommander" class="form-label">Fund Commander</label>
                                    <select class="form-select fundCommander" aria-label="">
                                        <option selected>Select Fund Commander</option>
                                        <option value="1">One</option>
                                        <option value="2">Two</option>
                                        <option value="3">Three</option>
                                    </select>
                                </div>

                            </div>
                            <hr>
                            <div class="row m-0 p-0">
                                <button type="button" id="addTimeAlarmStatusDeclared"
                                    class="btn btn-primary add-time-alarm-status-button">+ Add
                                    Time Alarm Status</button>
                            </div>
                        </div>

                        <div class="row border border-light-subtle shadow rounded my-3 p-4">
                            <h3 class="border-bottom border-4 border-secondary pb-2 mb-3">4-6</h3>
                            <div class="col-lg-6 mb-3">
                                <label for="typeOfOccupancy" class="form-label">Type of Occupancy</label>
                                <select class="form-select typeOccupancy" aria-label="">
                                    <option selected>Select type of occupancy</option>
                                    <option value="1">Structural</option>
                                    <option value="2">Non-Structural</option>
                                    <option value="3">Vehicular</option>
                                </select>
                            </div>
                            <div class="col-lg-6 mb-3">
                                <label for="specifyTypeOfOccupancy" class="form-label">Specify</label>
                                <select class="form-select specify" aria-label="">
                                    <option selected>Please specify</option>
                                    <option value="1">One</option>
                                    <option value="2">Two</option>
                                    <option value="3">Three</option>
                                </select>
                            </div>
                            <hr>
                            <div class="col-lg-6 mb-3">
                                <label for="approxDistanceFireIncident" class="form-label">Approximate Distance of Fire
                                    Incident from Fire Station (Km)</label>
                                <input type="text" placeholder="eg. 1.5Km" class="form-control"
                                    id="firstResponderInput">
                            </div>
                            <div class="col-lg-6 mb-3">
                                <label for="deneralDescriptionStructureInvolved" class="form-label">General Description of
                                    the structure/s involved</label>
                                <textarea type="text" placeholder="Enter description" class="form-control" id="firstResponderInput"></textarea>
                            </div>
                        </div>

                        <div class="row border border-light-subtle shadow rounded my-3 p-4">
                            {{-- <h3 class="border-bottom border-4 border-secondary pb-2 mb-3">Total Number of Casualty Reported</h3> --}}
                            <h3 class="border-bottom border-4 border-secondary pb-2 mb-3">7</h3>
                            <div class="col-lg-6">
                                <div class="row">
                                    <h5>Civilian</h5>
                                    <div class="col-lg-6 mb-3">
                                        <label for="civilianInjured" class="form-label">Injured</label>
                                        <input type="number" placeholder="No. of injured" class="form-control"
                                            id="firstResponderInput">
                                    </div>
                                    <div class="col-lg-6 mb-3">
                                        <label for="civilianDeath" class="form-label">Death</label>
                                        <input type="number" placeholder="No. of deaths" class="form-control"
                                            id="firstResponderInput">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="row">
                                    <h5>Firefighter</h5>
                                    <div class="col-lg-6 mb-3">
                                        <label for="firefighterInjured" class="form-label">Injured</label>
                                        <input type="number" placeholder="No. of injured" class="form-control"
                                            id="firstResponderInput">
                                    </div>
                                    <div class="col-lg-6 mb-3">
                                        <label for="firefighterDeath" class="form-label">Death</label>
                                        <input type="number" placeholder="No. of deaths" class="form-control"
                                            id="firstResponderInput">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row border border-light-subtle shadow rounded my-3 p-4">
                            <h3 class="border-bottom border-4 border-secondary pb-2 mb-3">8, 10-12</h3>
                            <h5>Breathing Apparatus Used</h5>
                            <div class="col-lg-6 mb-3">
                                <label for="firefighterDeath" class="form-label">No.</label>
                                <input type="number" placeholder="No.s" class="form-control"
                                    id="firstResponderInput">
                            </div>
                            <div class="col-lg-6 mb-3">
                                <label for="firefighterDeath" class="form-label">Type / Kind</label>
                                <input type="text" placeholder="Enter type" class="form-control"
                                    id="firstResponderInput">
                            </div>
                            <h5>Extinguishing Agent Used</h5>
                            <div class="col-lg-6 mb-3">
                                <label for="firefighterDeath" class="form-label">Quantity</label>
                                <input type="number" placeholder="Enter quantity" class="form-control"
                                    id="firstResponderInput">
                            </div>
                            <div class="col-lg-6 mb-3">
                                <label for="firefighterDeath" class="form-label">Type / Kind</label>
                                <input type="text" placeholder="Enter type" class="form-control"
                                    id="firstResponderInput">
                            </div>
                            <h5>Rope and Ladder Used</h5>
                            <div class="col-lg-6 mb-3">
                                <label for="firefighterDeath" class="form-label">Type</label>
                                <input type="text" placeholder="Enter type" class="form-control"
                                    id="firstResponderInput">
                            </div>
                            <div class="col-lg-6 mb-3">
                                <label for="firefighterDeath" class="form-label">Length</label>
                                <input type="number" placeholder="Enter length" class="form-control"
                                    id="firstResponderInput">
                            </div>
                            <h5>Hose Line Used</h5>
                            <div class="col-lg-4 mb-3">
                                <label for="firefighterDeath" class="form-label">No.</label>
                                <input type="number" placeholder="No." class="form-control"
                                    id="firstResponderInput">
                            </div>
                            <div class="col-lg-4 mb-3">
                                <label for="firefighterDeath" class="form-label">Type / Kind</label>
                                <input type="text" placeholder="Type / kind" class="form-control"
                                    id="firstResponderInput">
                            </div>
                            <div class="col-lg-4 mb-3">
                                <label for="firefighterDeath" class="form-label">Total ft.</label>
                                <input type="number" placeholder="Enter total feet" class="form-control"
                                    id="firstResponderInput">
                            </div>
                        </div>

                        <div class="row border border-light-subtle shadow rounded my-3 p-4">
                            <h3 class="border-bottom border-4 border-secondary pb-2 mb-3">13</h3>
                            <div class="row m-0 p-0 duty-personnel-at-fire-scene">
                                <h3></h3>
                                <div class="col-lg-6 mb-3">
                                    <label for="fundCommander" class="form-label">Rank / Name</label>
                                    <select class="form-select rankName" aria-label="">
                                        <option selected>Select Fund Commander</option>
                                        <option value="1">One</option>
                                        <option value="2">Two</option>
                                        <option value="3">Three</option>
                                    </select>
                                </div>
                                <div class="col-lg-6 mb-3">
                                    <label for="firefighterDeath" class="form-label">Designation</label>
                                    <input type="text" placeholder="No. of deaths" class="form-control"
                                        id="firstResponderInput">
                                </div>
                                <div class="col-lg-12 mb-3">
                                    <label for="firefighterDeath" class="form-label">Remarks</label>
                                    <textarea type="text" placeholder="No. of deaths" class="form-control"
                                        id="firstResponderInput"></textarea>
                                </div>
                            </div>
                            <hr>
                            
                            <div class="row m-0 p-0">
                                <button type="button" id="addNewDutyPersonnelAtFireScene" class="btn btn-primary">+ Add another duty personnel</button>
                            </div>
                        </div>

                        <div class="row border border-light-subtle shadow rounded my-3 p-4">
                            <h3 class="border-bottom border-4 border-secondary pb-2 mb-3">14</h3>
                            <label class="form-label" for="exampleCheck1">Photos</label>
                            <input type="file" class="form-control uncheable" value="" id="photos" name="photos">
                            
                            <div id="preview-container"></div>  
                        </div>
                                              
                        <div class="row border border-light-subtle shadow rounded my-3 p-4">
                            <h3 class="border-bottom border-4 border-secondary pb-2 mb-3">15</h3>
                            <div class="col-lg-12 mb-3">
                                <label for="firefighterDeath" class="form-label">Remarks</label>
                                <textarea type="text" placeholder="" class="form-control"
                                    id="firstResponderInput"></textarea>
                            </div>
                        </div>

                        <div class="row border border-light-subtle shadow rounded my-3 p-4">
                            <h3 class="border-bottom border-4 border-secondary pb-2 mb-3">16</h3>
                            <div class="col-lg-12 mb-3">
                                <label for="firefighterDeath" class="form-label">Remarks</label>
                                <textarea type="text" placeholder="" class="form-control"
                                    id="firstResponderInput"></textarea>
                            </div>
                        </div>

                        <div class="row border border-light-subtle shadow rounded my-3 p-4">
                            <h3 class="border-bottom border-4 border-secondary pb-2 mb-3">17</h3>
                            <div class="col-lg-12 mb-3">
                                <label for="firefighterDeath" class="form-label">Remarks</label>
                                <textarea type="text" placeholder="" class="form-control"
                                    id="firstResponderInput"></textarea>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary">Submit</button>

                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('#addNewDivApor').click(function() {
                // Clone the first row (assuming it's the row you want to duplicate)
                var newRow = $('.second-div:first').clone();

                // Reset input values in the cloned row (if needed)
                newRow.find('input').val('');

                // Update the header text to reflect "New Fire Engine Response Details"
                var newHeaderText = "";
                var newHeader = $('<h3></h3>').text(newHeaderText);

                // Create a flex container for the header and button
                var flexContainer = $(
                    '<div class="d-flex justify-content-between align-items-center"></div>');
                flexContainer.append(newHeader); // Append the new header to the flex container

                // Create and append the removal ('X') button
                var removeButton = $(
                    '<button type="button" class="btn btn-outline-danger btn-sm">x</button>');
                removeButton.click(function() {
                    var rowToRemove = $(this).closest('.second-div');
                    var hrToRemove = rowToRemove.prev('hr'); // Find the previous <hr> element

                    // Remove both the row and the preceding <hr> element
                    rowToRemove.remove();
                    hrToRemove.remove();
                });
                flexContainer.append(removeButton); // Append the remove button to the flex container

                // Replace the existing header with the flex container
                newRow.find('h3').replaceWith(flexContainer);

                // Insert the cloned row before the button
                $(this).parent().before(newRow);

                // Add <hr> tag after each cloned row for visual separation
                $(this).parent().before('<hr>'); // Insert <hr> after the newly added row
            });

            $('#addTimeAlarmStatusDeclared').click(function() {
                // Clone the first row (assuming it's the row you want to duplicate)
                var newRow = $('.time-alarm-status-declared-div:first').clone();

                // Reset input values in the cloned row (if needed)
                newRow.find('input').val('');

                // Update the header text to reflect ""
                var newHeaderText = "";
                var newHeader = $('<h3></h3>').text(newHeaderText);

                // Create a flex container for the header and button
                var flexContainer = $(
                    '<div class="d-flex justify-content-between align-items-center"></div>');
                flexContainer.append(newHeader); // Append the new header to the flex container

                // Create and append the removal ('X') button
                var removeButton = $(
                    '<button type="button" class="btn btn-outline-danger btn-sm">x</button>');
                removeButton.click(function() {
                    var rowToRemove = $(this).closest('.time-alarm-status-declared-div');
                    var hrToRemove = rowToRemove.prev('hr'); // Find the previous <hr> element

                    // Remove both the row and the preceding <hr> element
                    rowToRemove.remove();
                    hrToRemove.remove();
                });
                flexContainer.append(removeButton); // Append the remove button to the flex container

                // Replace the existing header with the flex container
                newRow.find('h5').replaceWith(flexContainer);

                // Insert the cloned row before the button
                $(this).parent().before(newRow);

                // Add <hr> tag after each cloned row for visual separation
                $(this).parent().before('<hr>'); // Insert <hr> after the newly added row
            });
            $('#addNewDutyPersonnelAtFireScene').click(function() {
                // Clone the first row (assuming it's the row you want to duplicate)
                var newRow = $('.duty-personnel-at-fire-scene:first').clone();

                // Reset input values in the cloned row (if needed)
                newRow.find('input').val('');

                // Update the header text to reflect "New Fire Engine Response Details"
                var newHeaderText = "";
                var newHeader = $('<h3></h3>').text(newHeaderText);

                // Create a flex container for the header and button
                var flexContainer = $(
                    '<div class="d-flex justify-content-between align-items-center"></div>');
                flexContainer.append(newHeader); // Append the new header to the flex container

                // Create and append the removal ('X') button
                var removeButton = $(
                    '<button type="button" class="btn btn-outline-danger btn-sm">x</button>');
                removeButton.click(function() {
                    var rowToRemove = $(this).closest('.duty-personnel-at-fire-scene');
                    var hrToRemove = rowToRemove.prev('hr'); // Find the previous <hr> element

                    // Remove both the row and the preceding <hr> element
                    rowToRemove.remove();
                    hrToRemove.remove();
                });
                flexContainer.append(removeButton); // Append the remove button to the flex container

                // Replace the existing header with the flex container
                newRow.find('h3').replaceWith(flexContainer);

                // Insert the cloned row before the button
                $(this).parent().before(newRow);

                // Add <hr> tag after each cloned row for visual separation
                $(this).parent().before('<hr>'); // Insert <hr> after the newly added row
            });
            // Target the file input
            $('#photos').on('change', function() {
                // Get the selected files
                var files = $(this)[0].files;

                // Clear any existing previews
                $('#preview-container').empty();

                // Loop through each selected file
                for (var i = 0; i < files.length; i++) {
                    var file = files[i];
                    var reader = new FileReader();

                    // Closure to capture the file information
                    reader.onload = (function(file) {
                        return function(e) {
                            // Create a new image element
                            var imgElement = $('<img class="img-fluid m-2 object-fit-cover rounded shadow">').addClass('preview-image').attr('src', e.target.result);

                            // Append the image to the preview container
                            $('#preview-container').append(imgElement);
                        };
                    })(file);

                    // Read the file as a data URL
                    reader.readAsDataURL(file);
                }
            });

            $(".caller").select2();
        });
    </script>
@endsection
