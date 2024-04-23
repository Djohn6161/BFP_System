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
                                <input type="text" placeholder="Eg. pedro villa" class="form-control text-uppercase"
                                    id="dateTime" required>
                            </div>

                            <div class="col-lg-12 mb-12 pb-2 mb-3">
                                <label for="reported" class="form-label">SUBJECT:</label>
                                <input type="text" placeholder="Eg. fire incident report "
                                    class="form-control text-uppercase" id="reported" required>

                            </div>
                            <div class="col-lg-12 mb-12 pb-2 mb-3">
                                <label for="province" class="form-label">DATE:</label>
                                <input type="text" placeholder=" Eg. march 02, 2013" class="form-control" id="province"
                                    required>
                            </div>
                        </div>

                        <div class="row border border-light-subtle shadow rounded p-5 mb-4">
                            {{-- <h3 class="border-bottom border-4 border-secondary pb-2 mb-3">Fire Incident Response Details</h3> --}}
                            <h3 class="border-bottom border-4 border-warning pb-2 mb-3">DETAILS</h3>
                            <h5><i>Date Time and Place of Occurence</i></h5>
                            {{-- <h5>Details</h5> --}}
                            <!-- Corrected "Date of Occurrence" -->
                            <div class="col-lg-6 mb-3">
                                <label for="date-of-occurrence" class="form-label">Date of Occurrence</label>
                                <input type="date" class="form-control" id="date-of-occurrence" required>
                            </div>

                            <!-- Corrected "Time of Occurrence" -->
                            <div class="col-lg-6 mb-3">
                                <label for="time-of-occurrence" class="form-label">Time of Occurrence</label>
                                <input type="text" placeholder="Eg. 2300H" class="form-control" id="time-of-occurrence"
                                    required>
                            </div>

                            <hr>

                            <!-- Corrected "Barangay" -->
                            <h5><i>Place of Occurrence</i></h5>
                            <div class="col-lg-6 mb-4">
                                <label for="barangay-select" class="form-label">Barangay</label>
                                <select class="form-select" id="barangay-select" required>
                                    <option value="" disabled selected>-- Select a Barangay --</option>
                                    <option value="barangay_1">Barangay 1</option>
                                    <option value="barangay_2">Barangay 2</option>
                                    <option value="barangay_3">Barangay 3</option>
                                    <!-- Add more barangay options as needed -->
                                </select>
                            </div>

                            <!-- Corrected "Zone/Street" -->
                            <div class="col-lg-6 mb-4">
                                <label for="zone-street" class="form-label">Zone/Street</label>
                                <input type="text" placeholder="Eg. Zone 4" class="form-control" id="zone-street"
                                    required>
                            </div>

                            <!-- Corrected "Other Location/Landmark" -->
                            <div class="col-lg-12 mb-4">
                                <label for="landmark" class="form-label">Other Location/Landmark</label>
                                <input type="text" placeholder="Eg. LCC Mall" class="form-control" id="landmark"
                                    required>
                            </div>

                            <hr>

                            <!-- Corrected "Involved" -->
                            <div class="col-lg-6 mb-4">
                                <label for="involved" class="form-label">Involved</label>
                                <input type="text" placeholder="Eg. Residential House" class="form-control"
                                    id="involved" required>
                            </div>

                            <!-- Corrected "Name of Establishment" -->
                            <div class="col-lg-6 mb-4">
                                <label for="establishment" class="form-label">Name of Establishment</label>
                                <input type="text" placeholder="Eg. Residential House" class="form-control"
                                    id="establishment" required>
                            </div>

                            <!-- Corrected "Owner" -->
                            <div class="col-lg-6 mb-4">
                                <label for="owner" class="form-label">Owner</label>
                                <input type="text" placeholder="Eg. John Doe" class="form-control" id="owner"
                                    required>
                            </div>

                            <!-- Corrected "Occupant" -->
                            <div class="col-lg-6 mb-4">
                                <label for="occupant" class="form-label">Occupant</label>
                                <input type="text" placeholder="Eg. Jane Doe" class="form-control" id="occupant"
                                    required>
                            </div>

                            <hr>

                            <!-- Corrected "Casualty" -->
                            <h5><i>Casualty</i></h5>
                            <div class="col-lg-6 mb-4">
                                <label for="fatality" class="form-label">Fatality</label>
                                <input type="number" placeholder="Eg. 1" class="form-control" id="fatality" required>
                            </div>

                            <div class="col-lg-6 mb-4">
                                <label for="injured" class="form-label">Injured</label>
                                <input type="number" placeholder="Eg. 3" class="form-control" id="injured" required>
                            </div>

                            <hr>

                            <!-- Corrected "Estimated Damage" -->
                            <div class="col-lg-3 mb-4">
                                <label for="estimated-damage" class="form-label">Estimated Damage</label>
                                <input type="number" placeholder="Eg. 50000" class="form-control" id="estimated-damage"
                                    required>
                            </div>

                            <!-- Corrected "Time Fire Started" -->
                            <div class="col-lg-3 mb-4">
                                <label for="time-fire-started" class="form-label">Time Fire Started</label>
                                <input type="text" placeholder="Eg. 2100H" class="form-control"
                                    id="time-fire-started" required>
                            </div>

                            <!-- Corrected "Time Fire Out" -->
                            <div class="col-lg-3 mb-4">
                                <label for="time-fire-out" class="form-label">Time of Fire Out</label>
                                <input type="text" placeholder="Eg. 2300H" class="form-control" id="time-fire-out"
                                    required>
                            </div>

                            <!-- Corrected "Alarm" -->
                            <div class="col-lg-3 mb-4">
                                <label for="alarm" class="form-label">Alarm</label>
                                <select class="form-select spotAlarmSelect" id="alarm" required>
                                    <option value="" disabled selected>-- Select an Alarm --</option>
                                    <option value="alarm_1">Alarm 1</option>
                                    <option value="alarm_2">Alarm 2</option>
                                    <option value="alarm_3">Alarm 3</option>
                                    <!-- Add more alarm options as needed -->
                                </select>
                            </div>
                            <div class="mb-5">
                                <label for="dateTime" class="form-label">Details of Investigation</label>
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
                                    <div id="detailsOfInvestigation">

                                    </div>

                                </div>

                            </div>
                            <div class="mb-5"></div>
                            <div class="mb-5 mt-4">
                                <label for="dateTime" class="form-label">Disposition</label>
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
                                    <div id="disposition">

                                    </div>

                                </div>

                            </div>
                            <div class="mb-5"></div>
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
            $('.spotAlarmSelect').select2();
        });
    </script>
    <script>
        const quillThird = new Quill('#detailsOfInvestigation', {
            theme: 'snow',
            modules: {
                syntax: true,
                toolbar: '#toolbar1',
            },

            placeholder: 'Compose an epic...',
        });
    </script>
    <script>
        const quillFourth = new Quill('#disposition', {
            theme: 'snow',
            modules: {
                syntax: true,
                toolbar: '#toolbar2',
            },

            placeholder: 'Compose an epic...',
        });
    </script>
@endsection
