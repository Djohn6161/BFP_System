<!-- Update Operation  -->
<div class="modal fade" data-bs-backdrop="static" id="updateModal{{ $report->id }}" tabindex="-1"
    aria-labelledby="updateModalLabel{{ $report->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateModalLabel{{ $report->id }}">Update Report</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form name="updateReport"
                    action="{{ route('report.update', ['id' => $report->id, 'category' => $category]) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    {{-- {{dd($report)}} --}}
                    <h1>New {{ $category }}</h1>
                    <div class="row">
                        <div class="col-lg-12 mb-3">
                            <label for="exampleInputEmail1" class="name{{$report->id}}">Name</label>
                            <input type="text" {{ $report != null ? '' : '' }} placeholder="Enter Incident Name"
                                class="form-control " id="name{{$report->id}}" name="name"
                                value="{{ old('name') ?? ($report->name ?? '') }}">
                            @error('name')
                                <div class="text-danger ps-3" role="">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 mb-3">
                            <label for="exampleInputEmail1" class="type{{$report->id}}">Type of Incident</label>

                            <input type="text" placeholder="Enter Incident Name" class="form-control " id="type{{$report->id}}"
                                name="type" value="{{ old('type') ?? ($report->type ?? '') }}">
                            @error('type')
                                <div class="text-danger ps-3" role="">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 mb-3 form-check ps-3">
                            <label class="form-label" for="exampleCheck1">Time of Departure</label>
                            <input name="time_of_departure" {{ $report != null ? '' : '' }} type="datetime-local"
                                class="form-control " id="exampleCheck1"
                                value="{{ old('time_of_departure') ?? ($report->time_of_departure ?? '') }}">
                            @error('time_of_departure')
                                <div class="text-danger ps-3" role="">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>
                        <div class="col-lg-6 mb-3 form-check">
                            <label class="form-label" for="exampleCheck1">Time of Arrival to Scene</label>
                            <input name="time_of_arrival_to_scene" {{ $report != null ? '' : '' }}
                                value="{{ old('time_of_arrival_to_scene') ?? ($report->time_of_arrival_to_scene ?? '') }}"
                                type="datetime-local" class="form-control " id="exampleCheck1">
                            @error('time_of_arrival_to_scene')
                                <div class="text-danger ps-3" role="">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4 mb-3">
                            <label for="exampleInputEmail1" class="form-label">Truck deployed</label>
                            <br>
                            <select name="trucks_id" class="form-select" style="width:100%" id="updateTruck{{$report->id}}"
                                aria-label="Default select example">
                                <option value="" selected>Select Truck</option>
                                @foreach ($trucks as $truck)
                                    <option {{ $report != null ? '' : '' }} value="{{ $truck->id }}"
                                        {{ old('trucks_id') == $truck->id ? 'selected' : (($report->trucks_id ?? '') == $truck->id ? 'selected' : '') }}>
                                        {{ $truck->name }}</option>
                                @endforeach
                            </select>
                            @error('trucks_id')
                                <div class="text-danger ps-3" role="">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-lg-4 mb-3">
                            <label for="exampleInputEmail1" class="form-label">Rank and Name of driver</label>
                            <br>
                            <select class="form-select" aria-label="Default select example" name="drivers_id" style="width:100%" id="updateDriver{{$report->id}}" >
                                <option selected value="">Select Driver</option>
                                @foreach ($personnels as $driver)
                                    <option
                                        {{ old('drivers_id') == $driver->id ? 'selected' : (($report->drivers_id ?? '') == $driver->id ? 'selected' : '') }}
                                        value="{{ $driver->id }}">
                                        {{ $driver->rank->slug . ' ' . $driver->last_name }}</option>
                                @endforeach
                            </select>
                            @error('drivers_id')
                                <div class="text-danger ps-3" role="">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-lg-4 mb-3">
                            <label for="exampleInputEmail1" class="form-label">Rank and Name of team leader</label>
                            <br>
                            <select class="form-select" aria-label="Default select example" style="width:100%" id="updateTeamLeader{{$report->id}}" 
                                name="team_leaders_id">
                                <option selected value="">Select Team Leader</option>
                                @foreach ($personnels as $teamLeader)
                                    <option
                                        {{ old('team_leaders_id') == $teamLeader->id ? 'selected' : (($report->team_leaders_id ?? '') == $teamLeader->id ? 'selected' : '') }}
                                        value="{{ $teamLeader->id }}">
                                        {{ $teamLeader->rank->slug . ' ' . $teamLeader->last_name }}</option>
                                @endforeach
                            </select>
                            @error('team_leaders_id')
                                <div class="text-danger ps-3" role="">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <label for="exampleInputEmail1" class="form-label">Ranks and names of crew</label>
                    <button type="button" id="addCrewDivButton" class="btn btn-primary mb-2 ms-3">add</button>

                    <div class="row" id="crew">
                            @foreach ($report->crews as $percrew)
                                <div class="col-lg-4 mb-3 " id="addCrew">
                                    <div class="d-flex align-items-center">

                                        <select class="form-select crew{{$report->id}}" aria-label="Default select example"
                                            name="personnels_id[]" style="width: 100%" id="">
                                            <option selected value="">Select Your Crew</option>
                                            @foreach ($personnels as $crew)
                                                <option class="text-capitalize"
                                                    {{ $percrew->personnel_id == $crew->id ? 'selected' : '' }}
                                                    value="{{ $crew->id }}">
                                                    {{ $crew->rank->slug . ' ' . ucwords($crew->last_name) . ', ' . ucwords($crew->first_name) }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <button id="closeCrew"
                                            class="btn btn-outline-danger remove-crew-input ms-1">X</button>
                                    </div>
                                </div>
                                
                                
                            @endforeach

                    </div>
                    @error('crewName')
                        <div class="text-danger ps-3" role="">
                            {{ $message }}
                        </div>
                    @enderror
                    <div class="row">
                        <div class="col-lg-6 mb-3">
                            <label for="exampleInputEmail1" class="form-label">Barangay in <b>Ligao City</b></label>
                            <br>
                            <select class="form-select" aria-label="Default select example" id="updateBarangay{{$report->id}}" style="width: 100%"
                                name="barangays_id">
                                <option selected value="1">Select Barangay</option>
                                @foreach ($barangays as $barangay)
                                    <option
                                        {{ old('barangays_id') == $barangay->id ? 'selected' : (($report->barangays_id ?? '') == $barangay->id ? 'selected' : '') }}
                                        value="{{ $barangay->id }}">{{ $barangay->name }}</option>
                                @endforeach
                            </select>
                            @error('barangays_id')
                                <div class="text-danger ps-3" role="">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-lg-6 mb-3">
                            <label for="exampleInputEmail1" class="form-label ">Street</label>
                            <input type="text" placeholder="Enter Street name" class="form-control "
                                id="street" value="{{ old('street') ?? ($report->street ?? '') }}"
                                name="street">
                            @error('street')
                                <div class="text-danger ps-3" role="">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 mb-3">
                            <label for="exampleInputEmail1" class="form-label">Other Locations</label>
                            <input type="text" placeholder="Outside Area of Responsibility" class="form-control "
                                value="{{ old('otherLocation') ?? ($report->otherLocation ?? '') }}"
                                name="otherLocation" id="otherLocation">
                            @error('otherLocation')
                                <div class="text-danger ps-3" role="">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 mb-3">
                            <label for="exampleInputEmail1" class="form-label">No. of Victim / Patient</label>
                            {{-- <input type="number" class="form-control" id="number_of_victims" value="{{old('number_of_victims') ?? $report->number_of_victims ?? '' }}" name="number_of_victims"> --}}
                            <div class="d-flex align-items-center">
                                <input type="number" class="form-control " id="inputNumber"
                                    value="{{ old('number_of_victims') ?? count($report->victims ?? []) }}"
                                    name="number_of_victims" placeholder="Enter number of victims/patient">
                                <p class="text-gray fst-italic ms-2 mb-0 text-nowrap">&#40;Specify the no. of
                                    victims/patient&#41;</p>
                            </div>
                            @error('number_of_victims')
                                <div class="text-danger ps-3" role="">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    {{-- {{dd(count($report->victims))}} --}}
                    <div class="row" id="outputDivs">
                        @if ($report ?? false)
                            @foreach ($report->victims as $victim)
                                <div class="col-lg-6 mb-3">
                                    <div class="d-flex align-items-center">
                                        <input type="text" id="name_of_victims[]" name="name_of_victims[]"
                                            value="{{ $victim->name }}" class="form-control "
                                            placeholder="Enter victim/patient name">
                                        <button class="btn btn-outline-danger remove-crew-input ms-1 ">X</button>
                                    </div>
                                </div>
                            @endforeach
                        @endif

                    </div>
                    {{-- <label for="exampleInputEmail1" class="form-label">Name of victim/patient</label>
                    <button type="button" id="addVictimDivButton" class="btn btn-primary mb-2 ms-3">add</button>
                    <div class="row">
                        {{-- <h5>Ligao City</h5> --}}
                    <div class="row" id="victim">
                        <div class="col-lg-4 mb-3">
                            <div class="d-flex align-items-center">
                                {{-- <input type="text" placeholder="Enter victim/patient name" class="form-control"
                            id="name_of_victims[]" name="name_of_victims[]"> --}}
                            </div>
                            @error('name_of_victims')
                                <div class="text-danger ps-3" role="">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 mb-3">
                            <label for="exampleInputEmail1" class="form-label">Property involved</label>
                            <input type="text" placeholder="Enter the property involved" class="form-control"
                                id="property_involved" name="property_involved">
                            @error('property_involved')
                                <div class="text-danger ps-3" role="">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 mb-3">
                            <label for="exampleInputEmail1" class="form-label">Estimated cost of damages</label>
                            <input type="number" placeholder="ex. 1000" class="form-control"
                                id="estimate_cost_of_damages"
                                value="{{ old('estimate_cost_of_damages') ?? ($report->estimate_cost_of_damages ?? '') }}"
                                name="estimate_cost_of_damages">
                            @error('estimated_cost_of_damages')
                                <div class="text-danger ps-3" role="">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 mb-3 form-check ps-3">
                            <label class="form-label" for="exampleCheck1">Time of arrival to the station</label>
                            <input type="datetime-local" class="form-control " id="time_of_arrival_to_station"
                                value="{{ old('time_of_arrival_to_station') ?? ($report->time_of_arrival_to_station ?? '') }}"
                                name="time_of_arrival_to_station">
                            @error('time_of_arrival_to_station')
                                <div class="text-danger ps-3" role="">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 mb-3 form-check ps-3">
                            <label class="form-label" for="exampleCheck1">Remarks</label>
                            <textarea class="form-control" name="remarks" id="remarks">{{ old('remarks') ?? ($report->remarks ?? '') }}</textarea>
                            @error('remarks')
                                <div class="text-danger ps-3" role="">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 mb-3 form-check ps-3">
                            <label class="form-label" for="exampleCheck1">Photos</label>
                            <input type="file" class="form-control uncheable"
                                value="{{ old('photos') ?? ($report->photos ?? '') }}" id="photos"
                                name="photos[]" multiple>
                            @error('photos')
                                <div class="text-danger ps-3" role="">
                                    {{ $message }}
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

<!-- Delete Confirmation Modal -->
<div class="modal fade" data-bs-backdrop="static" id="deleteModal{{ $report->id }}" tabindex="-1"
    aria-labelledby="deleteModalLabel{{ $report->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered text-center">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="deleteModalLabel">Confirm Deletion</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h5>Are you sure you want to delete this report?</h5>
            </div>
            <div class="modal-footer d-flex justify-content-around">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Yes</button>
                <button type="button" id="confirmDeleteBtn" class="btn btn-danger"
                    data-bs-dismiss="modal">No</button>
            </div>
        </div>
    </div>
</div>
