<style>
    .btn-reports {
        width: 200px
    }
</style>
@extends('layouts.user-template')
@section('content')
    <div class="container-fluid">
        <!--  Row 1 -->

        <div class="col-lg-12">
            <!-- Monthly Earnings -->

            <div class="row">
                <div class="col d-flex justify-content-end mb-2">
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addResponseModal">
                        <span>
                            <i class="ti ti-layout-dashboard"></i>
                        </span>
                        <span class="hide-menu">Add</span>
                    </button>
                </div>
                <div class="col-lg-12 d-flex align-items-stretch">
                    <div class="card w-100">
                        <div class="card-body p-4">
                            <h5 class="card-title fw-semibold mb-4">Investigation Reports</h5>
                            <div class="table-responsive">
                                <table class="table mb-0 align-middle ">
                                    <thead class="text-dark fs-4">
                                        <tr>
                                            <th class="border-bottom-0" style="max-width:10%">
                                                <h6 class="fw-semibold mb-0">Name</h6>
                                            </th>
                                            <th class="border-bottom-0">
                                                <h6 class="fw-semibold mb-0">Team Leader</h6>
                                            </th>
                                            <th class="border-bottom-0">
                                                <h6 class="fw-semibold mb-0">Type</h6>
                                            </th>
                                            <th class="border-bottom-0">
                                                <h6 class="fw-semibold mb-0">Departure From Station</h6>
                                            </th>
                                            <th class="border-bottom-0">
                                                <h6 class="fw-semibold mb-0">Arrival to Station</h6>
                                            </th>
                                            <th class="border-bottom-0">
                                                <h6 class="fw-semibold mb-0">Action</h6>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($investigation as $report)
                                        <x-reports.update :report=$report></x-reports.update>
                                        <x-reports.view-modal :report=$report></x-reports.view-modal>
                                            <tr>
                                                <td class="border-bottom-0">
                                                    <h6 class="fw-semibold mb-0">{{ $report->name }}</h6>
                                                </td>
                                                <td class="border-bottom-0">
                                                    <h6 class="fw-semibold mb-0 text-capitalize">
                                                        {{ $report->personRank($report->teamLeader->ranks_id)->slug . ' ' . $report->teamLeader->last_name }}
                                                    </h6>
                                                </td>
                                                <td class="border-bottom-0">
                                                    <p class="mb-0 fw-normal">{{ $report->type }}</p>
                                                </td>
                                                <td class="border-bottom-0">
                                                    <p class="mb-0 fw-normal">{{ $report->time_of_departure }}</p>
                                                </td>
                                                <td class="border-bottom-0">
                                                    <p class="mb-0 fw-normal">{{ $report->time_of_arrival_to_station }}</p>
                                                </td>
                                                <td class="border-bottom-0">
                                                    <a href="#" data-bs-toggle="modal" data-bs-target="#viewModal{{$report->id}}" class="btn btn-primary w-100 mb-1">View</a>
                                                    <br>
                                                    <a href="#" data-bs-toggle="modal" data-bs-target="#updateModal{{ $report->id }}" class="btn btn-success w-100 mb-1">Update</a>
                                                    <br>
                                                    <a href="#" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $report->id }}" class="btn btn-danger hide-menu w-100 mb-1">Delete</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <!-- Update Investigation  -->
            <div class="modal fade" data-bs-backdrop="static" id="updateModal{{ $report->id }}" tabindex="-1" aria-labelledby="updateModalLabel{{ $report->id }}" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-xl">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="updateModalLabel{{ $report->id }}">Update Report</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="" method="POST">
                                @csrf
                                @method('PUT')
                                <h1 class="text-capitalize">New {{ $active }}</h1>
                        <div class="row">
                            <div class="col-lg-12 mb-3">
                                <label for="exampleInputEmail1" class="form-label">Name</label>
                                <input type="text"
                                    placeholder="Enter Incident Name" class="form-control" id="name" name="name"
                                    value="{{ old('name') ?? ($report->name ?? '') }}">

                            </div>
                        </div>
                        <div class="col-lg-12 mb-3">
                            <label for="exampleInputEmail1" class="form-label">Rank and Name of team leader</label>
                            <select class="form-select team-leader" aria-label="Default select example" name="team_leaders_id">
                                <option value="{{ $report->teamLeader->id }}"> {{ $report->personRank($report->teamLeader->ranks_id)->slug . ' ' . $report->teamLeader->last_name }}</option>

                            </select>
                        </div>
                        <div class="row">
                            <div class="col-lg-6 mb-3">
                                <label for="exampleInputEmail1" class="form-label">Type of Incident</label>
                                <input type="text" placeholder="Type" class="form-control" id="type"
                                    name="type" value="{{ $report->type }}">
                            </div>
                        
                        
                            <div class="col-lg-6 mb-3">
                                <label for="exampleInputEmail1" class="form-label">Driver</label>
                                <select class="form-select driver" aria-label="Default select example" name="drivers_id">
                                    <option selected value="">Select Driver</option>
                    
                                        <option value="">{{ $report->personRank($report->driver->ranks_id)->slug . ' ' . $report->driver->last_name }}</option>

                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6 mb-3 form-check ps-3">
                                <label class="form-label" for="exampleCheck1">Departure from Station</label>
                                <input name="time_of_departure" 
                                    type="datetime-local" class="form-control" id="exampleCheck1"
                                    value="{{ old('time_of_departure') ?? ($report->time_of_departure ?? '') }}">

                            </div>
                            <div class="col-lg-6 mb-3 form-check ps-3">
                                <label class="form-label" for="exampleCheck1">Arrival to Station</label>
                                <input name="time_of_arrival_to_scene" 
                                    value="{{ old('time_of_arrival_to_scene') ?? ($report->time_of_arrival_to_scene ?? '') }}"
                                    type="datetime-local" class="form-control" id="exampleCheck1">
                            </div>
                        </div>
                       
                        
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-success">Update</button>
                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Delete Confirmation Modal -->
            <div class="modal fade" data-bs-backdrop="static" id="deleteModal{{ $report->id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $report->id }}" aria-hidden="true">
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
                            <button type="button" id="confirmDeleteBtn" class="btn btn-danger" data-bs-dismiss="modal">No</button>
                        </div>
                    </div>
                </div>
            </div>

            <x-reports.chooseReport :reports=$operation :category="'Operation'"> </x-reports.chooseReport>
            <x-reports.chosen :category=$active > </x-reports.chosen>


            <script>
                // Wait for the document to load
                document.addEventListener("DOMContentLoaded", function() {
                    // Get the Yes and No buttons
                    var yesBtn = document.getElementById('yesBtn');
                    var noBtn = document.getElementById('noBtn');

                    // Attach click event listeners to the buttons
                    yesBtn.addEventListener('click', function() {
                        // Show the Yes modal
                        $('#yesModal').modal('show');
                        // Hide the current modal
                        $('#addResponseModal').modal('hide');
                    });

                    noBtn.addEventListener('click', function() {
                        // Show the No modal
                        $('#noModal').modal('show');
                        // Hide the current modal
                        $('#addResponseModal').modal('hide');
                    });
                });
            </script>
        @endsection
