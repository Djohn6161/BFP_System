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
                                        @foreach ($investigation as $report)
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
