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
                    <form action="{{route('investigation.minimal.store')}}" method="POST" id="minimalCreate">
                      @csrf
                        <div class="row border border-light-subtle shadow rounded p-4 mb-4">
                            {{-- <h3 class="border-bottom border-4 border-secondary pb-2 mb-3">Fire Incident Response Details</h3> --}}
                            <h3 class="border-bottom border-4 border-warning pb-2 mb-3">MEMORANDUM</h3>
                            {{-- <h5>Details</h5> --}}
                            <div class="col-lg-12 mb-12 pb-2 mb-3">
                                <label for="dateTime" class="form-label">FOR:</label>
                                <input type="text" placeholder="Eg. pedro villa" class="form-control text-uppercase" id="dateTime" name="for" >
                            </div>
 
                            <div class="col-lg-12 mb-12 pb-2 mb-3">
                                <label for="reported" class="form-label">SUBJECT:</label>
                                <input type="text" placeholder="Eg. fire incident report " class="form-control text-uppercase" name="subject" id="reported" >

                            </div>
                            <div class="col-lg-12 mb-12 pb-2 mb-3">
                                <label for="province" class="form-label">DATE:</label>
                                <input type="text" placeholder=" Eg. march 02, 2013" class="form-control" id="province" name="date" >
                            </div>
                        </div>

                        <div class="row border border-light-subtle shadow rounded p-4 mb-4">
                            {{-- <h3 class="border-bottom border-4 border-secondary pb-2 mb-3">Fire Incident Response Details</h3> --}}
                            <h3 class="border-bottom border-4 border-warning pb-2 mb-3">DETAILS</h3>
                            {{-- <h5>Details</h5> --}}
                            <div class="col-lg-6 mb-3">
                                <label for="dateTime" class="form-label">Date and Time of Actual Occurrence</label>
                                <input type="text" placeholder="Eg. 06 March 2024 2300h" class="form-control" id="dateTime" name="dt_actual_occurence" >
                            </div>

                            <div class="col-lg-6 mb-3">
                                <label for="reported" class="form-label">Date and Time Reported</label>
                                <input type="text" placeholder="Eg. 06 March 2024 2300h" class="form-control" id="reported" name="dt_reported" >

                            </div>
                            <div class="col-lg-6 mb-4">
                              <label for="barangay-select" class="form-label">Barangay</label>
                              <select class="form-select" id="barangay-select" name="barangay" >
                                  <option value="" disabled selected>-- Select a Barangay --</option>
                                  @foreach ($barangay as $barangay)
                                    <option value="{{$barangay->name}}">{{$barangay->name}}</option>
                                  @endforeach
                                  <!-- Add more barangay options as needed -->
                              </select>
                          </div>

                          <!-- Corrected "Zone/Street" -->
                          <div class="col-lg-6 mb-4">
                              <label for="zone-street" class="form-label">Zone/Street</label>
                              <input type="text" placeholder="Eg. Zone 4" class="form-control" id="zone-street" name="zone"
                                  >
                          </div>

                          <!-- Corrected "Other Location/Landmark" -->
                          <div class="col-lg-12 mb-4">
                              <label for="landmark" class="form-label">Other Location/Landmark</label>
                              <input type="text" placeholder="Eg. LCC Mall" class="form-control" id="landmark" name="landmark"
                                  >
                          </div>
                            <div class="col-lg-6 mb-3">
                                <label for="officeAddress" class="form-label">Involved Property/Establishment</label>
                                <input type="text" placeholder=" Eg. Vacant Lot " class="form-control" id="province" name="involved_property" >
                            </div>
                            <div class="col-lg-6 mb-3">
                                <label for="officeAddress" class="form-label">Property Data</label>
                                <input type="text" placeholder=" Eg. Juan Dela Cruz" class="form-control" id="province" name="property_data" >
                            </div>
                        </div>

                        <div class="row border border-light-subtle shadow rounded p-4 mb-4">
                            <div class="row m-0 p-0 second-div border-0">
                                <h3 class="border-bottom border-4 border-warning pb-2 mb-3">RESPONSE AND SUPPRESSION DATA</h3>
                                <div class="col-lg-12 mb-3">
                                  <label for="" class="form-label">Receiver</label>
                                  <select class="form-select alarmStatus" aria-label=""  name="receiver">
                                      <option selected>Select Personnel</option>
                                      @foreach ($personnels as $personnel)
                                        <option value="{{$personnel->id}}">{{$personnel->rank->slug . " " .$personnel->first_name . " " . $personnel->last_name}}</option>
                                      @endforeach
                                  </select>
                              </div>
                                <h5 class="  pb-1 mb-3">Caller Information</h5>
                                <div class="col-lg-4 mb-3">
                                    <label for="name" class="form-label">Complete Name</label>
                                    <input type="text" placeholder="Eg. SPO1 joseph d. Santos" class="form-control" name="caller_name"
                                        id="name" >
                                </div>
                                
                                <div class="col-lg-4 mb-3">
                                    <label for="address" class="form-label">Address</label>
                                    <input type="text" placeholder="Eg. Guinobatan Albay" class="form-control" name="caller_address"
                                        id="address" >
                                </div>
                                <div class="col-lg-4 mb-3">
                                    <label for="telephone" class="form-label">Telephone</label>
                                    <input type="number" placeholder="Eg. 09xxxxxxxxx" name="caller_number"
                                        class="form-control" id="telephone" >
                                </div>
                                <div class="col-lg-12 mb-12 p-2 mb-3">
                                    <label for="chief" class="form-label">Notification Originator</label>
                                    <input type="text" placeholder="Eg. Chief Operation" name="notification_originator"
                                    class="form-control" id="chief" >
                                </div>
                                <h5 class="  pb-1 mb-3">First Responding Unit</h5>
                                <div class="col-lg-6 mb-3">
                                    <label for="timeReturned" class="form-label">Truck Deployed</label>
                                    <select class="form-select alarmStatus" aria-label="" name="first_responding_engine">
                                        <option selected>Select truck</option>
                                        @foreach ($engines as $truck)
                                          <option value="{{$truck->id}}">{{$truck->name}}</option>
                                        @endforeach
                                        
                                        <option value="2">Truck 2</option>
                                        <option value="3">Truck 3</option>
                                    </select>
                                </div>
                                <div class="col-lg-6 mb-3">
                                    <label for="waterTank" class="form-label">Team Leader</label>
                                    <select class="form-select alarmStatus" aria-label="" name="first_responding_leader" >
                                        <option selected>Select Team Leader</option>
                                        @foreach ($personnels as $personnel)
                                          <option value="{{$personnel->id}}">{{$personnel->rank->slug . " " .$personnel->first_name . " " . $personnel->last_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-lg-4 mb-3">
                                    <label for="timeReturned" class="form-label">Time Arrival on Scene</label>
                                    <input type="text" placeholder="Eg. 1900h" name="time_arrival_on_scene"
                                        class="form-control" id="timeReturnedInput" >
                                </div>
                                <div class="col-lg-4 mb-3">
                                    <label for="waterTank" class="form-label">Alarm Status</label>
                                    <select class="form-select alarmStatus" aria-label="" name="alarm_status_time" >
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
                                    <input type="text" placeholder="Eg. 0200H" class="form-control" name="time_fire_out"
                                        id="gasConsumedInput">
                                </div>
                            </div>
                        </div>

                        <div class="row border border-light-subtle shadow rounded my-3 p-4">
                            {{-- <h3 class="border-bottom border-4 border-secondary pb-2 mb-3">Fire Alarm Status and Response Details</h3> --}}
                            <h3 class="border-bottom border-4 border-warning pb-2 mb-3">INVOLVED PARTIES</h3>
                            
                            <div class="row time-alarm-status-declared-div m-0 p-0">
                                <div class="col-lg-6 mb-6">
                                    <label for="timeAlarmStatusDeclared" class="form-label">Owner of Property/Establishment</label>
                                    <input type="text" placeholder="Eg. Mr. Tomas Hilario" class="form-control" name="property_owner"
                                        id="timeAlarmStatusDeclaredTime" >
                                </div>
                                <div class="col-lg-6 mb-6">
                                    <label for="timeAlarmStatusDeclaredTime" class="form-label">Occupant of Property/Establishment</label>
                                    <input type="text" placeholder="Eg. James Padilla" class="form-control" name="property_occupant"
                                        id="timeAlarmStatusDeclaredTime">
                                </div>
                            </div>
                        </div>

                        <div class="row border border-light-subtle shadow rounded p-4 mb-4">
                            {{-- <h3 class="border-bottom border-4 border-secondary pb-2 mb-3">Fire Incident Response Details</h3> --}}
                            <h3 class="border-bottom border-4 border-warning pb-2 mb-3">DETAILS OF INVESTIGATION:</h3>
                            {{-- <h5>Details</h5> --}}
                            <div class="col-lg-12 mb-12 pb-5 mb-3">
                                <label for="dateTime" class="form-label"></label>
                                <div>
                                    <div id="toolbar1">
                                        <span class="ql-formats">
                                            <select class="ql-font"></select>
                                            <select class="ql-size"></select>
                                          </span>
                                          <span class="ql-formats">
                                            <button class="ql-bold"></button>
                                            <button class="ql-italic"></button>
                                            <button class="ql-underline"></button>
                                            <button class="ql-strike"></button>
                                          </span>
                                          <span class="ql-formats">
                                            <select class="ql-color"></select>
                                            <select class="ql-background"></select>
                                          </span>
                                          <span class="ql-formats">
                                            <button class="ql-script" value="sub"></button>
                                            <button class="ql-script" value="super"></button>
                                          </span>
                                          <span class="ql-formats">
                                            <button class="ql-header" value="1"></button>
                                            <button class="ql-header" value="2"></button>
                                            <button class="ql-blockquote"></button>
                                            <button class="ql-code-block"></button>
                                          </span>
                                          <span class="ql-formats">
                                            <button class="ql-list" value="ordered"></button>
                                            <button class="ql-list" value="bullet"></button>
                                            <button class="ql-indent" value="-1"></button>
                                            <button class="ql-indent" value="+1"></button>
                                          </span>
                                          <span class="ql-formats">
                                            <button class="ql-direction" value="rtl"></button>
                                            <select class="ql-align"></select>
                                          </span>
                                          <span class="ql-formats">
                                            <button class="ql-link"></button>
                                            <button class="ql-image"></button>
                                            <button class="ql-video"></button>
                                            <button class="ql-formula"></button>
                                          </span>
                                          <span class="ql-formats">
                                            <button class="ql-clean"></button>
                                          </span>
                                    </div>
                                    <div id="first">  
                                     
                                    </div>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="details" id="details">
                        <div class="row border border-light-subtle shadow rounded p-4 mb-4">
                            {{-- <h3 class="border-bottom border-4 border-secondary pb-2 mb-3">Fire Incident Response Details</h3> --}}
                            <h3 class="border-bottom border-4 border-warning pb-2 mb-3">FINDINGS:</h3>
                            {{-- <h5>Details</h5> --}}
                            <div class="col-lg-12 mb-12 pb-5 mb-3">
                                <label for="date" class="form-label"></label>
                                <div>
                                    <div id="toolbar2">
                                        <span class="ql-formats">
                                            <select class="ql-font"></select>
                                            <select class="ql-size"></select>
                                          </span>
                                          <span class="ql-formats">
                                            <button class="ql-bold"></button>
                                            <button class="ql-italic"></button>
                                            <button class="ql-underline"></button>
                                            <button class="ql-strike"></button>
                                          </span>
                                          <span class="ql-formats">
                                            <select class="ql-color"></select>
                                            <select class="ql-background"></select>
                                          </span>
                                          <span class="ql-formats">
                                            <button class="ql-script" value="sub"></button>
                                            <button class="ql-script" value="super"></button>
                                          </span>
                                          <span class="ql-formats">
                                            <button class="ql-header" value="1"></button>
                                            <button class="ql-header" value="2"></button>
                                            <button class="ql-blockquote"></button>
                                            <button class="ql-code-block"></button>
                                          </span>
                                          <span class="ql-formats">
                                            <button class="ql-list" value="ordered"></button>
                                            <button class="ql-list" value="bullet"></button>
                                            <button class="ql-indent" value="-1"></button>
                                            <button class="ql-indent" value="+1"></button>
                                          </span>
                                          <span class="ql-formats">
                                            <button class="ql-direction" value="rtl"></button>
                                            <select class="ql-align"></select>
                                          </span>
                                          <span class="ql-formats">
                                            <button class="ql-link"></button>
                                            <button class="ql-image"></button>
                                            <button class="ql-video"></button>
                                            <button class="ql-formula"></button>
                                          </span>
                                          <span class="ql-formats">
                                            <button class="ql-clean"></button>
                                          </span>
                                    </div>
                                    <div id="second">
                                     
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row border border-light-subtle shadow rounded p-4 mb-4">
                            {{-- <h3 class="border-bottom border-4 border-secondary pb-2 mb-3">Fire Incident Response Details</h3> --}}
                            <h3 class="border-bottom border-4 border-warning pb-2 mb-3">RECOMMENDATION:</h3>
                            {{-- <h5>Details</h5> --}}
                            <div class="col-lg-12 mb-12 pb-5 mb-3">
                                <label for="date" class="form-label"></label>
                                <div>
                                    <div id="toolbar3">
                                        <span class="ql-formats">
                                            <select class="ql-font"></select>
                                            <select class="ql-size"></select>
                                          </span>
                                          <span class="ql-formats">
                                            <button class="ql-bold"></button>
                                            <button class="ql-italic"></button>
                                            <button class="ql-underline"></button>
                                            <button class="ql-strike"></button>
                                          </span>
                                          <span class="ql-formats">
                                            <select class="ql-color"></select>
                                            <select class="ql-background"></select>
                                          </span>
                                          <span class="ql-formats">
                                            <button class="ql-script" value="sub"></button>
                                            <button class="ql-script" value="super"></button>
                                          </span>
                                          <span class="ql-formats">
                                            <button class="ql-header" value="1"></button>
                                            <button class="ql-header" value="2"></button>
                                            <button class="ql-blockquote"></button>
                                            <button class="ql-code-block"></button>
                                          </span>
                                          <span class="ql-formats">
                                            <button class="ql-list" value="ordered"></button>
                                            <button class="ql-list" value="bullet"></button>
                                            <button class="ql-indent" value="-1"></button>
                                            <button class="ql-indent" value="+1"></button>
                                          </span>
                                          <span class="ql-formats">
                                            <button class="ql-direction" value="rtl"></button>
                                            <select class="ql-align"></select>
                                          </span>
                                          <span class="ql-formats">
                                            <button class="ql-link"></button>
                                            <button class="ql-image"></button>
                                            <button class="ql-video"></button>
                                            <button class="ql-formula"></button>
                                          </span>
                                          <span class="ql-formats">
                                            <button class="ql-clean"></button>
                                          </span>
                                    </div>
                                    <div id="third">
                                     
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row border border-light-subtle shadow rounded p-4 mb-4">
                            {{-- <h3 class="border-bottom border-4 border-secondary pb-2 mb-3">Fire Incident Response Details</h3> --}}
                            <h3 class="border-bottom border-4 border-warning pb-2 mb-3">PHOTOGRAPH OF ETHE FIRE SCENE</h3>
                            {{-- <h5>Details</h5> --}}
                            <div class="col-lg-12 mb-12 pb-2 mb-3">
                                <label for="dateTime" class="form-label"></label>
                                <input type="file" placeholder="Eg. pedro villa" class="form-control text-uppercase" id="photos" >
                                <div id="preview-container"></div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary" id="submit">Submit</button>

                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
      $(document).ready(function(){
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
                            var imgElement = $(
                                '<img class="img-fluid m-2 object-fit-cover rounded shadow">'
                            ).addClass('preview-image').attr('src', e.target.result);

                            // Append the image to the preview container
                            $('#preview-container').append(imgElement);
                        };
                    })(file);

                    // Read the file as a data URL
                    reader.readAsDataURL(file);
                }
            });
      });
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
    var hiddenInput = document.getElementById('editorContent');
    
    $("#submit").click(function() {
      $("#details").val = $("#first").text(); 
      console.log($("#details").val);
      $("#minimalCreate").submit();
    });
    </script>

<script>
    const quillFirst = new Quill('#first', {
        modules: {
        toolbar: '#toolbar1',
        },
      theme: 'snow',            
      placeholder: 'Compose an epic...',
    });

    
  </script>
  <script>
    const quillSecond = new Quill('#second', {
      theme: 'snow',
      modules: {
        toolbar: '#toolbar2',
        },
            
      placeholder: 'Compose an epic...',  
    });
  </script>
   <script>
    const quillThird = new Quill('#third', {
      theme: 'snow',
      modules: {
        toolbar: '#toolbar3',
        },
            
      placeholder: 'Compose an epic...',  
    });
  </script>
@endsection
