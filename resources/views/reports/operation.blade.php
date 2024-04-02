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
                                <table class="table text-nowrap mb-0 align-middle">
                                    <thead class="text-dark fs-4">
                                        <tr>
                                            <th class="border-bottom-0">
                                                <h6 class="fw-semibold mb-0">Name</h6>
                                            </th>
                                            <th class="border-bottom-0">
                                                <h6 class="fw-semibold mb-0">Team Leader</h6>
                                            </th>
                                            <th class="border-bottom-0">
                                                <h6 class="fw-semibold mb-0">Type</h6>
                                            </th>
                                            <th class="border-bottom-0">
                                                <h6 class="fw-semibold mb-0">Driver</h6>
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
                                        @foreach ($reports as $report)
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
                                                    <p class="mb-0 fw-normal text-capitalize">
                                                        {{ $report->personRank($report->driver->ranks_id)->slug . ' ' . $report->driver->last_name }}
                                                    </p>
                                                </td>
                                                <td class="border-bottom-0">
                                                    <p class="mb-0 fw-normal">{{ $report->time_of_departure }}</p>
                                                </td>
                                                <td class="border-bottom-0">
                                                    <p class="mb-0 fw-normal">{{ $report->time_of_arrival_to_station }}</p>
                                                </td>
                                                <td class="border-bottom-0">
                                                    <a href="#" class="btn btn-primary w-100 mb-1">View</a>
                                                    <br>
                                                    <a href="#" class="btn btn-success w-100 mb-1">Update</a>
                                                    <br>
                                                    <a href="#" class="btn btn-danger w-100 mb-1">Delete</a>
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

            <!-- Add Modal -->
            <div class="modal fade" data-bs-backdrop="static" id="addResponseModal" tabindex="-1"
                aria-labelledby="addResponseModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            {{-- <h5 class="modal-title" id="addResponseModalLabel">Modal title</h5> --}}
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <!-- Input fields for adding content -->
                            <div class="mb-3 text-center">
                                <h3>You want to use existing report?</h3>
                            </div>
                        </div>
                        <div class="modal-footer d-flex justify-content-around">
                            <button type="button" class="btn btn-secondary btn-reports" id="yesBtn">Yes</button>
                            <button type="button" class="btn btn-danger btn-reports" id="noBtn">No</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Second Modal (Yes Modal) -->
            <div class="modal fade" id="yesModal" tabindex="-1" aria-labelledby="yesModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-xl">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body m-3 text-center">
                            <h3 class="mb-2">Investigation Reports</h3>
                            <div class="shadow rounded p-4">
                                <table class="table w-100 " id="myTable">
                                    <thead>
                                        <tr>
                                            <th>Category</th>
                                            <th>Departure</th>
                                            <th>Arrival to <br> the station</th>
                                            <th>Address</th>
                                            <th>Team Leader</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Tiger Nixon</td>
                                            <td>System Architect</td>
                                            <td>Edinburgh</td>
                                            <td>61</td>
                                            <td>2011-04-25</td>
                                            <td><a href="{{ route('report.create', ['id' => 1]) }}"
                                                    class="btn btn-primary">Apply</a></td>
                                        </tr>
                                        <tr>
                                            <td>Garrett Winters</td>
                                            <td>Accountant</td>
                                            <td>Tokyo</td>
                                            <td>63</td>
                                            <td>2011-07-25</td>
                                            <td><a href="{{ route('report.create', ['id' => 1]) }}"
                                                    class="btn btn-primary">Apply</a></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Third Modal (No Modal) -->
            <div class="modal fade" id="noModal" tabindex="-1" aria-labelledby="noModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h3 class="modal-title" id="noModalLabel">Choose which type of incident:</h3>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <button class="btn btn-lg btn-outline-primary d-block w-100 mb-2">Fire Incident</button>
                            <button class="btn btn-lg btn-outline-primary d-block w-100 mb-2">Vehicular Accident</button>
                            <button class="btn btn-lg btn-outline-primary d-block w-100">Non-Emergency Response</button>
                        </div>
                    </div>
                </div>
            </div>

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
