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
                    <form action="{{route('report.store', ['category' => $category])}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        {{-- {{dd($report)}} --}}
                        <h1>New {{$category}}</h1>
                        <div class="row" >
                            <div class="col-lg-12 mb-3">
                                <label for="exampleInputEmail1" class="form-label">Name</label>
                                <input type="text" {{ $report != null ? "readonly" : ""}} placeholder="Enter Incident Name" class="form-control" id="name" name="name" value="{{old('name') ?? $report->name ?? '' }}">
                                @error('name')
                                <div class="text-danger ps-3" role="">
                                    {{ $message}}
                                </div>
                                @enderror
                                
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12 mb-3">
                                <label for="exampleInputEmail1" class="form-label">Type of Incident</label>
                                <input type="text" placeholder="Enter Incident Name" class="form-control" id="type" name="type" value="{{$type}}" readonly>
                                @error('type')
                                <div class="text-danger ps-3" role="">
                                    {{ $message}}
                                </div>
                                @enderror
                                
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6 mb-3 form-check ps-3">
                                <label class="form-label" for="exampleCheck1">Time of Departure</label>
                                <input name="time_of_departure" {{ $report != null ? "readonly" : ""}} type="datetime-local" class="form-control" id="exampleCheck1" value="{{old('time_of_departure') ?? $report->time_of_departure ?? '' }}">
                                @error('time_of_departure')
                                <div class="text-danger ps-3" role="">
                                    {{ $message}}
                                </div>
                                @enderror
                                
                            </div>
                            <div class="col-lg-6 mb-3 form-check">
                                <label class="form-label" for="exampleCheck1">Time of Arrival to Scene</label>
                                <input name="time_of_arrival_to_scene" {{ $report != null ? "readonly" : ""}} value="{{old('time_of_arrival_to_scene') ?? $report->time_of_arrival_to_scene ?? '' }}" type="datetime-local" class="form-control" id="exampleCheck1">
                                @error('time_of_arrival_to_scene')
                                <div class="text-danger ps-3" role="">
                                    {{ $message}}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-4 mb-3">
                                <label for="exampleInputEmail1" class="form-label">Truck deployed</label>
                                <select  name="trucks_id" class="form-select" aria-label="Default select example">
                                    <option selected>Select Truck</option>
                                    @foreach ($trucks as $truck)
                                        
                                        <option {{ $report != null ? "readonly" : ""}} value="{{$truck->id}}" {{ old('trucks_id') == $truck->id ? 'selected': ($report->trucks_id == $truck->id ? "selected" : '') }}>{{$truck->name}}</option>
                                    @endforeach
                                </select>
                                @error('trucks_id')
                                <div class="text-danger ps-3" role="">
                                    {{ $message}}
                                </div>
                                @enderror
                            </div>
                            <div class="col-lg-4 mb-3">
                                <label for="exampleInputEmail1" class="form-label">Rank and Name of driver</label>
                                <select class="form-select" aria-label="Default select example" name="drivers_id">
                                    <option selected>Select Driver</option>
                                    @foreach ($personnels as $driver)
                                        <option {{ old('drivers_id') == $driver->id ? 'selected': ($report->drivers_id == $driver->id ? "selected" : '') }} value="{{$driver->id}}">{{$driver->rank->slug . " " . $driver->last_name}}</option>
                                    @endforeach
                                </select>
                                @error('drivers_id')
                                <div class="text-danger ps-3" role="">
                                    {{ $message}}
                                </div>
                                @enderror
                            </div>
                            <div class="col-lg-4 mb-3">
                                <label for="exampleInputEmail1" class="form-label">Rank and Name of team leader</label>
                                <select class="form-select" aria-label="Default select example" name="team_leaders_id">
                                    <option selected>Select Team Leader</option>
                                    @foreach ($personnels as $teamLeader)
                                        <option {{ old('team_leaders_id') == $teamLeader->id ? 'selected': ($report->team_leaders_id == $teamLeader->id ? "selected" : '') }} value="{{$teamLeader->id}}">{{$teamLeader->rank->slug . " " . $teamLeader->last_name}}</option>
                                    @endforeach
                                </select>
                                @error('team_leaders_id')
                                <div class="text-danger ps-3" role="">
                                    {{ $message}}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <label for="exampleInputEmail1" class="form-label">Ranks and names of crew</label>
                        <button type="button" id="addCrewDivButton" class="btn btn-primary mb-2 ms-3">add</button>

                        <div class="row" id="crew">
                            <div class="col-lg-4 mb-3">
                                <div class="d-flex align-items-center">
                                    <input type="text" placeholder="Enter crew name" class="form-control" id="exampleCheck1[]" name="crewName[]">
                                   
                                </div>
                                @error('team_leaders_id')
                                <div class="text-danger ps-3" role="">
                                    {{$message}}
                                </div>
                                @enderror
                                
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6 mb-3">
                                <label for="exampleInputEmail1" class="form-label">Barangay in <b>Ligao City</b></label>
                                <select class="form-select" aria-label="Default select example" name="barangays_id">
                                    <option selected>Select Barangay</option>
                                    @foreach ($barangays as $barangay)
                                        <option {{ old('barangays_id') == $barangay->id ? 'selected': ($report->barangays_id == $barangay->id ? "selected" : '') }} value="{{$barangay->id}}">{{$barangay->name}}</option>
                                    @endforeach
                                </select>
                                @error('barangays_id')
                                <div class="text-danger ps-3" role="">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                            <div class="col-lg-6 mb-3">
                                <label for="exampleInputEmail1" class="form-label">Street</label>
                                <input type="text" placeholder="Enter Street name" class="form-control" id="street" value="{{old('street') ?? $report->street ?? '' }}" name="street">
                                @error('street')
                                <div class="text-danger ps-3" role="">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12 mb-3">
                                <label for="exampleInputEmail1" class="form-label">Other Locations</label>
                                <input type="text" placeholder="Outside Area of Responsibility" class="form-control" value="{{old('otherLocation') ?? $report->otherLocation ?? '' }}" name="otherLocation" id="otherLocation">
                                @error('otherLocation')
                                <div class="text-danger ps-3" role="">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6 mb-3">
                                <label for="exampleInputEmail1" class="form-label">No. of Victim / Patient</label>
                                <input type="number" class="form-control" id="number_of_victims" value="{{old('number_of_victims') ?? $report->number_of_victims ?? '' }}" name="number_of_victims">
                                @error('number_of_victims')
                                <div class="text-danger ps-3" role="">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <label for="exampleInputEmail1" class="form-label">Name of victim/patient</label>
                        <button type="button" id="addVictimDivButton" class="btn btn-primary mb-2 ms-3">add</button>
                        <div class="row">
                            {{-- <h5>Ligao City</h5> --}}
                            <div class="row" id="victim">
                                <div class="col-lg-4 mb-3">
                                    <div class="d-flex align-items-center">
                                        <input type="text" placeholder="Enter victim/patient name" class="form-control" id="name_of_victims[]" name="name_of_victims[]">
                                    </div>
                                    @error('name_of_victims')
                                        <div class="text-danger ps-3" role="">
                                            {{$message}}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12 mb-3">
                                <label for="exampleInputEmail1" class="form-label">Property involved</label>
                                <input type="text" placeholder="Enter the property involved" class="form-control" id="property_involved" name="property_involved">
                                @error('property_involved')
                                    <div class="text-danger ps-3" role="">
                                        {{$message}}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12 mb-3">
                                <label for="exampleInputEmail1" class="form-label">Estimated cost of damages</label>
                                <input type="number" placeholder="ex. 1000" class="form-control" id="estimate_cost_of_damages" value="{{old('estimate_cost_of_damages') ?? $report->estimate_cost_of_damages ?? '' }}" name="estimate_cost_of_damages">
                                @error('estimated_cost_of_damages')
                                    <div class="text-danger ps-3" role="">
                                        {{$message}}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6 mb-3 form-check ps-3">
                                <label class="form-label" for="exampleCheck1">Time of arrival to the station</label>
                                <input type="datetime-local" class="form-control" id="time_of_arrival_to_station" value="{{old('time_of_arrival_to_station') ?? $report->time_of_arrival_to_station ?? '' }}" name="time_of_arrival_to_station">
                                @error('time_of_arrival_to_station')
                                    <div class="text-danger ps-3" role="">
                                        {{$message}}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12 mb-3 form-check ps-3">
                                <label class="form-label" for="exampleCheck1">Remarks</label>
                                <textarea class="form-control" name="remarks" id="remarks">{{old('remarks') ?? $report->remarks ?? ''}}</textarea>
                                @error('remarks')
                                    <div class="text-danger ps-3" role="">
                                        {{$message}}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12 mb-3 form-check ps-3">
                                <label class="form-label" for="exampleCheck1" >Photos</label>
                                <input type="file" class="form-control" value="{{old('photos') ?? $report->photos ?? ''}}" id="photos" name="photos[]" multiple>
                                @error('photos')
                                    <div class="text-danger ps-3" role="">
                                        {{$message}}
                                    </div>
                                @enderror
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
                var newDiv = $('<div class="col-lg-4 mb-3"><div class="d-flex align-items-center"><input type="text" placeholder="Enter crew name" class="form-control" id="exampleCheck1[]" name="crewName[]"></div></div>');
                $('#crew').append(newDiv);
            });
            $('#addVictimDivButton').click(function() {
                var newDiv = $('<div class="col-lg-4 mb-3"><div class="d-flex align-items-center"><input type="text" placeholder="Enter victim/patient name" class="form-control" id="exampleCheck1" name="name_of_victims[]"></div></div>');
                $('#victim').append(newDiv);
            });
        });
    </script>
    
@endsection
