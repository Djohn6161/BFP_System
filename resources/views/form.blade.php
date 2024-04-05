<style>
    .btn-reports {
        width 200px
    }
</style>
@extends('layouts.user-template')
@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-lg-9 shadow-lg rounded p-4">
                <div class="row">
                    <form>
                        <h1>Report Data</h1>
                        <div class="row">
                            <div class="col-lg-12 mb-3">
                                <label for="exampleInputEmail1" class="form-label">Type of Incident</label>
                                <select class="form-select" aria-label="Default select example">
                                    <option selected>Open this select menu</option>
                                    <option value="1">One</option>
                                    <option value="2">Two</option>
                                    <option value="3">Three</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6 mb-3 form-check ps-3">
                                <label class="form-label" for="exampleCheck1">Time of Departure</label>
                                <input type="datetime-local" class="form-control" id="exampleCheck1">
                            </div>
                            <div class="col-lg-6 mb-3 form-check">
                                <label class="form-label" for="exampleCheck1">Time of Arrival</label>
                                <input type="datetime-local" class="form-control" id="exampleCheck1">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-4 mb-3">
                                <label for="exampleInputEmail1" class="form-label">Truck deployed</label>
                                <select class="form-select" aria-label="Default select example">
                                    <option selected>Open this select menu</option>
                                    <option value="1">One</option>
                                    <option value="2">Two</option>
                                    <option value="3">Three</option>
                                </select>
                            </div>
                            <div class="col-lg-4 mb-3">
                                <label for="exampleInputEmail1" class="form-label">Rank and Name of driver</label>
                                <select class="form-select" aria-label="Default select example">
                                    <option selected>Open this select menu</option>
                                    <option value="1">One</option>
                                    <option value="2">Two</option>
                                    <option value="3">Three</option>
                                </select>
                            </div>
                            <div class="col-lg-4 mb-3">
                                <label for="exampleInputEmail1" class="form-label">Rank and Name of team leader</label>
                                <select class="form-select" aria-label="Default select example">
                                    <option selected>Open this select menu</option>
                                    <option value="1">One</option>
                                    <option value="2">Two</option>
                                    <option value="3">Three</option>
                                </select>
                            </div>
                        </div>
                        {{-- Crew --}}
                        <div class="row">
                            <div class="col-lg-9 mb-3">
                                <label for="exampleInputEmail1" class="form-label">No. of Crew</b></label>
                                <div class="d-flex align-items-center">
                                    <input type="number" class="form-control" id="crewNum" placeholder="Enter number of crew" value="1" min="1">                                    
                                    <p class="text-gray fst-italic ms-2 mb-0 text-nowrap">&#40;Specify the no. of Crew&#41;</p>
                                </div>
                            </div>
                        </div>
                        <label for="exampleInputEmail1" class="form-label">Ranks and Names of Crew</b></label>
                        <div class="row" id="crewDiv">
                            <div class="col-lg-6 mb-3">
                                <div class="d-flex align-items-center">
                                    <input type="text" class="form-control" placeholder="Enter crew name">
                                    <button class="btn btn-outline-danger remove-crew-input ms-1">X</button>
                                </div>
                            </div>
                        </div>

                        {{-- /Crew --}}

                        <div class="row">
                            <div class="col-lg-6 mb-3">
                                <label for="exampleInputEmail1" class="form-label">Barangay in <b>Ligao City</b></label>
                                <select class="form-select" aria-label="Default select example">
                                    <option selected>Open this select menu</option>
                                    <option value="1">One</option>
                                    <option value="2">Two</option>
                                    <option value="3">Three</option>
                                </select>
                            </div>
                            <div class="col-lg-6 mb-3">
                                <label for="exampleInputEmail1" class="form-label">Street</label>
                                <select class="form-select" aria-label="Default select example">
                                    <option selected>Open this select menu</option>
                                    <option value="1">One</option>
                                    <option value="2">Two</option>
                                    <option value="3">Three</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12 mb-3">
                                <label for="exampleInputEmail1" class="form-label">Other Locations</label>
                                <input type="text" placeholder="Outside Area of Responsibility" class="form-control" name="" id="">
                            </div>
                        </div>

                        {{-- Victims/Patient --}}
                        <div class="row">
                            <div class="col-lg-9 mb-3">
                                <label for="exampleInputEmail1" class="form-label">No. of Victims/Patient</b></label>
                                <div class="d-flex align-items-center">
                                    <input type="number" class="form-control" id="inputNumber" placeholder="Enter number of victims/patient" value="1" min="1">                                    
                                    <p class="text-gray fst-italic ms-2 mb-0 text-nowrap">&#40;Specify the no. of victims/patient&#41;</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row" id="outputDivs">
                            <div class="col-lg-6 mb-3">
                                <div class="d-flex align-items-center">
                                    <input type="text" class="form-control" placeholder="Enter victim/patient name">
                                    <button class="btn btn-outline-danger remove-crew-input ms-1">X</button>
                                </div>
                            </div>
                        </div>
                        {{-- /Victims/Patient --}}

                        <div class="row">
                            <div class="col-lg-12 mb-3">
                                <label for="exampleInputEmail1" class="form-label">Property involved</label>
                                <input type="text" placeholder="Enter the property involved" class="form-control" id="exampleInputEmail1">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12 mb-3">
                                <label for="exampleInputEmail1" class="form-label">Estimated cost of damages</label>
                                <input type="number" placeholder="ex. 1000" class="form-control" id="exampleInputEmail1">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6 mb-3 form-check ps-3">
                                <label class="form-label" for="exampleCheck1">Time of arrival to the station</label>
                                <input type="datetime-local" class="form-control" id="exampleCheck1">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12 mb-3 form-check ps-3">
                                <label class="form-label" for="exampleCheck1">Remarks</label>
                                <textarea class="form-control" name="" id=""></textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12 mb-3 form-check ps-3">
                                <label class="form-label" for="exampleCheck1">Photos</label>
                                <input type="file" class="form-control" id="exampleCheck1">
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
        $('#inputNumber').on('input', function() {
            var numInputs = $(this).val();
            let children = $('#outputDivs').children().length;
                console.log(numInputs < children);
                if(numInputs > children){
                    let add = numInputs - children;
                    console.log(numInputs - children);
                    for (var i = 0; i < add; i++) {
                        var newDiv = $('<div class="col-lg-6 mb-3"><div class="d-flex align-items-center"><input type="text" class="form-control" placeholder="Enter patient/victim name"><button class="btn btn-outline-danger remove-input ms-1">X</button></div></div>');
                        $('#outputDivs').append(newDiv);
                    }
                }else if (numInputs < children) {
                    // Remove excess divs if there are fewer inputs than existing divs
                    console.log("hi");
                    var remove = children - numInputs;
                    for (var i = 0; i < remove; i++) {
                        $('#outputDivs').children('.col-lg-6.mb-3').last().remove();
                    }
                } else{
                    if (!numInputs || isNaN(numInputs) || numInputs <= 0) {
                        return;
                    }
                    for (var i = 0; i < numInputs; i++) {
                    var newDiv = $('<div class="col-lg-6 mb-3"><div class="d-flex align-items-center"><input type="text" class="form-control" placeholder="Enter patient/victim name"><button class="btn btn-outline-danger remove-input ms-1">X</button></div></div>');
                    $('#outputDivs').append(newDiv);
                    }
                }
        });

        $(document).on('click', '.remove-input', function() {
            $(this).parent().parent().remove();
            $('#inputNumber').val($('#inputNumber').val() - 1);
        });

        $('#crewNum').on('input', function() {
            var numInputs = $(this).val();
            let children = $('#crewDiv').children().length;
                console.log(numInputs < children);
                if(numInputs > children){
                    let add = numInputs - children;
                    console.log(numInputs - children);
                    for (var i = 0; i < add; i++) {
                        var newDiv = $('<div class="col-lg-6 mb-3"><div class="d-flex align-items-center"><input type="text" class="form-control" placeholder="Enter crew name"><button class="btn btn-outline-danger remove-crew-input ms-1">X</button></div></div>');
                        $('#crewDiv').append(newDiv);
                    }
                }else if (numInputs < children) {
                    var remove = children - numInputs;
                    for (var i = 0; i < remove; i++) {
                        $('#crewDiv').children('.col-lg-6.mb-3').last().remove();
                    }
                } else{
                    if (!numInputs || isNaN(numInputs) || numInputs <= 0) {
                        return;
                    }
                    for (var i = 0; i < numInputs; i++) {
                    var newDiv = $('<div class="col-lg-6 mb-3"><div class="d-flex align-items-center"><input type="text" class="form-control" placeholder="Enter crew name"><button class="btn btn-outline-danger remove-crew-input ms-1">X</button></div></div>');
                    $('#crewDiv').append(newDiv);
                    }
                }
        });

        $(document).on('click', '.remove-crew-input', function() {
            $(this).parent().parent().remove();
            $('#crewNum').val($('#crewNum').val() - 1);
        });
    });
    </script>
    
@endsection

