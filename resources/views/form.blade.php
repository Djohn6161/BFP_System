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
                        <label for="exampleInputEmail1" class="form-label">Ranks and names of crew</label>
                        <button type="button" id="addCrewDivButton" class="btn btn-primary mb-2 ms-3">add</button>

                        <div class="row" id="crew">
                            <div class="col-lg-4 mb-3">
                                <div class="d-flex align-items-center">
                                    <input type="text" placeholder="Enter crew name" class="form-control" id="exampleCheck1">
                                </div>
                            </div>
                        </div>
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
                        <div class="row">
                            <div class="col-lg-6 mb-3">
                                <label for="exampleInputEmail1" class="form-label">No. of Victim / Patient</label>
                                <input type="number" class="form-control" id="exampleInputEmail1">
                            </div>
                        </div>
                        <label for="exampleInputEmail1" class="form-label">Name of victim/patient</label>
                        <button type="button" id="addVictimDivButton" class="btn btn-primary mb-2 ms-3">add</button>
                        <div class="row">
                            {{-- <h5>Ligao City</h5> --}}
                            <div class="row" id="victim">
                                <div class="col-lg-4 mb-3">
                                    <div class="d-flex align-items-center">
                                        <input type="text" placeholder="Enter victim/patient name" class="form-control" id="exampleCheck1">
                                    </div>
                                </div>
                            </div>
                        </div>
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
            $('#addCrewDivButton').click(function() {
                var newDiv = $('<div class="col-lg-4 mb-3"><div class="d-flex align-items-center"><input type="text" placeholder="Enter crew name" class="form-control" id="exampleCheck1"></div></div>');
                $('#crew').append(newDiv);
            });
            $('#addVictimDivButton').click(function() {
                var newDiv = $('<div class="col-lg-4 mb-3"><div class="d-flex align-items-center"><input type="text" placeholder="Enter victim/patient name" class="form-control" id="exampleCheck1"></div></div>');
                $('#victim').append(newDiv);
            });
        });
    </script>
    
@endsection
