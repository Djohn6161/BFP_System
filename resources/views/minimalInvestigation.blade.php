<style>
    .btn-reports {
        width 200px
    }

    .second-div {
        border: 1px solid #e5e5e5;
        padding: 15px;
        margin-bottom: 20px;
    }

    .d-flex {
        display: flex;
    }

    .justify-content-between {
        justify-content: space-between;
    }

    .align-items-center {
        align-items: center;
    }

    /* .preview-image {
        max-width: 200px;
        height: auto;
        margin: 10px;
    } */

</style>
@extends('layouts.user-template')
@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-lg-11 p-4">
                <div class="row">
                    <form>
                        <div class="row border border-light-subtle shadow rounded p-4 mb-4">
                            {{-- <h3 class="border-bottom border-4 border-secondary pb-2 mb-3">Fire Incident Response Details</h3> --}}
                            <h3 class="border-bottom border-4 border-warning pb-2 mb-3">MEMORANDUM</h3>
                            {{-- <h5>Details</h5> --}}
                            <div class="col-lg-12 mb-12 pb-2 mb-3">
                                <label for="dateTime" class="form-label">FOR:</label>
                                <input type="text" placeholder="Eg. pedro villa" class="form-control text-uppercase" id="dateTime" required>
                            </div>
 
                            <div class="col-lg-12 mb-12 pb-2 mb-3">
                                <label for="reported" class="form-label">SUBJECT:</label>
                                <input type="text" placeholder="Eg. fire incident report " class="form-control text-uppercase" id="reported" required>

                            </div>
                            <div class="col-lg-12 mb-12 pb-2 mb-3">
                                <label for="province" class="form-label">DATE:</label>
                                <input type="text" placeholder=" Eg. march 02, 2013" class="form-control" id="province" required>
                            </div>
                        </div>

                        <div class="row border border-light-subtle shadow rounded p-4 mb-4">
                            {{-- <h3 class="border-bottom border-4 border-secondary pb-2 mb-3">Fire Incident Response Details</h3> --}}
                            <h3 class="border-bottom border-4 border-warning pb-2 mb-3"></h3>
                            {{-- <h5>Details</h5> --}}
                            <div class="col-lg-12 mb-12 pb-5 mb-3">
                                <label for="dateTime" class="form-label"></label>
                                <div>
                                    <div id="editor"></div>
                                </div>
                            </div>
                        </div>

                        <div class="row border border-light-subtle shadow rounded p-4 mb-4">
                            {{-- <h3 class="border-bottom border-4 border-secondary pb-2 mb-3">Fire Incident Response Details</h3> --}}
                            <h3 class="border-bottom border-4 border-warning pb-2 mb-3">DETAILS</h3>
                            {{-- <h5>Details</h5> --}}
                            <div class="col-lg-6 mb-3">
                                <label for="dateTime" class="form-label">Date and Time of Actual Occurrence</label>
                                <input type="text" placeholder="Eg. 06 March 2024 2300h" class="form-control" id="dateTime" required>
                            </div>

                            <div class="col-lg-6 mb-3">
                                <label for="reported" class="form-label">Date and Time Reported</label>
                                <input type="text" placeholder="Eg. 06 March 2024 2300h" class="form-control" id="reported" required>

                            </div>
                            <div class="col-lg-3 mb-4">
                                <label for="province" class="form-label">Province</label>
                                <input type="text" placeholder=" Eg. Albay" class="form-control" id="province" required>
                            </div>
                            <div class="col-lg-3 mb-4">
                                <label for="municipality" class="form-label">Municipality</label>
                                    <input type="text" placeholder=" Eg. Ligao" class="form-control" id="municipality" required>
                            </div>
                            <div class="col-lg-3 mb-4">
                                <label for="barangay" class="form-label">Barangay</label>
                                    <input type="text" placeholder=" Eg. Sta. Cruz" class="form-control" id="barangay" required>
                            </div>
                            <div class="col-lg-3 mb-4">
                                <label for="other" class="form-label">Other Location</label>
                                    <input type="text" placeholder=" Eg. Camarines Sur" class="form-control" id="other" required>
                            </div>
                            <div class="col-lg-6 mb-3">
                                <label for="officeAddress" class="form-label">Involved Property/Establishment</label>
                                <input type="text" placeholder=" Eg. Vacant Lot " class="form-control" id="province" required>
                            </div>
                            <div class="col-lg-6 mb-3">
                                <label for="officeAddress" class="form-label">Property Data</label>
                                <input type="text" placeholder=" Eg. Juan Dela Cruz" class="form-control" id="province" required>
                            </div>
                        </div>

                        <div class="row border border-light-subtle shadow rounded p-4 mb-4">
                            <div class="row m-0 p-0 second-div border-0">
                                <h3 class="border-bottom border-4 border-warning pb-2 mb-3">RESPONSE AND SUPPRESSION DATA</h3>
                                <h5 class="  pb-1 mb-3">Receiver</h5>
                                <div class="col-lg-4 mb-3">
                                    <label for="name" class="form-label">Complete Name</label>
                                    <input type="text" placeholder="Eg. SPO1 joseph d. Santos" class="form-control"
                                        id="name" required>
                                </div>
                                <div class="col-lg-4 mb-3">
                                    <label for="address" class="form-label">Address</label>
                                    <input type="text" placeholder="Eg. Guinobatan Albay" class="form-control"
                                        id="address" required>
                                </div>
                                <div class="col-lg-4 mb-3">
                                    <label for="telephone" class="form-label">Telephone</label>
                                    <input type="number" placeholder="Eg. 09xxxxxxxxx"
                                        class="form-control" id="telephone" required>
                                </div>
                                <div class="col-lg-12 mb-12 p-2 mb-3">
                                    <label for="chief" class="form-label">Notification Originator</label>
                                    <input type="text" placeholder="Eg. Chief Operation"
                                    class="form-control" id="chief" required>
                                </div>
                                <h5 class="  pb-1 mb-3">First Responding Unit</h5>
                                <div class="col-lg-6 mb-3">
                                    <label for="timeReturned" class="form-label">Truck Deployed</label>
                                    <select class="form-select alarmStatus" aria-label="" required>
                                        <option selected>Select truck</option>
                                        <option value="1">Truck 1</option>
                                        <option value="2">Truck 2</option>
                                        <option value="3">Truck 3</option>
                                    </select>
                                </div>
                                <div class="col-lg-6 mb-3">
                                    <label for="waterTank" class="form-label">Team Leader</label>
                                    <select class="form-select alarmStatus" aria-label="" required>
                                        <option selected>Select Team Leader</option>
                                        <option value="1">Team Leader 1</option>
                                        <option value="2">Team Leader 2</option>
                                        <option value="3">Team Leader 3</option>
                                    </select>
                                </div>
                                <div class="col-lg-4 mb-3">
                                    <label for="timeReturned" class="form-label">Time Arrival on Scene</label>
                                    <input type="text" placeholder="Eg. 1900h"
                                        class="form-control" id="timeReturnedInput" required>
                                </div>
                                <div class="col-lg-4 mb-3">
                                    <label for="waterTank" class="form-label">Alarm Status</label>
                                    <select class="form-select alarmStatus" aria-label="" required>
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
                                <div class="col-lg-4 mb-3">
                                    <label for="gasConsumed" class="form-label">Time Fire Out</label>
                                    <input type="text" placeholder="Eg. 0200H" class="form-control"
                                        id="gasConsumedInput"required>
                                </div>
                            </div>
                        </div>

                        <div class="row border border-light-subtle shadow rounded my-3 p-4">
                            {{-- <h3 class="border-bottom border-4 border-secondary pb-2 mb-3">Fire Alarm Status and Response Details</h3> --}}
                            <h3 class="border-bottom border-4 border-warning pb-2 mb-3">INVOLVED PARTIES</h3>
                            
                            <div class="row time-alarm-status-declared-div m-0 p-0">
                                <div class="col-lg-6 mb-6">
                                    <label for="timeAlarmStatusDeclared" class="form-label">Owner of Property/Establishment</label>
                                    <input type="text" placeholder="Eg. Mr. Tomas Hilario" class="form-control"
                                        id="timeAlarmStatusDeclaredTime" required>
                                </div>
                                <div class="col-lg-6 mb-6">
                                    <label for="timeAlarmStatusDeclaredTime" class="form-label">Occupant of Property/Establishment</label>
                                    <input type="text" placeholder="Eg. James Padilla" class="form-control"
                                        id="timeAlarmStatusDeclaredTime">
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>

                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        // Get the input element
    var input = document.getElementById('telephone');

// Listen for input events
input.addEventListener('input', function() {
    // Remove any non-numeric characters
    this.value = this.value.replace(/\D/g, '');

    // Limit the input to exactly 11 digits
    if (this.value.length > 11) {
        this.value = this.value.slice(0, 11);
    }
});
    </script>

<script>
    const quill = new Quill('#editor', {
      theme: 'snow',
      placeholder: 'Compose an epic...',
      
      
    });
    
    
  </script>
@endsection
