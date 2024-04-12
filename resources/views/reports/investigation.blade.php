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
                                            <x-reports.view-modal :report=$report></x-reports.view-modal>
                                            <x-reports.update :report=$report :category=$active :trucks=$trucks
                                                :personnels=$personnels :barangays=$barangays></x-reports.update>
                                            <script>
                                                $('#updateTruck{{ $report->id }}').select2({
                                                    dropdownParent: $('#updateModal{{ $report->id }}')
                                                });
                                                $('#updateDriver{{ $report->id }}').select2({
                                                    dropdownParent: $('#updateModal{{ $report->id }}')
                                                });
                                                $('#updateTeamLeader{{ $report->id }}').select2({
                                                    dropdownParent: $('#updateModal{{ $report->id }}')
                                                });
                                                $('#updateBarangay{{ $report->id }}').select2({
                                                    dropdownParent: $('#updateModal{{ $report->id }}')
                                                });
                                                $('.crew{{ $report->id }}').select2({
                                                        dropdownParent: $('#updateModal{{ $report->id }}')
                                                    });
                                            </script>
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
                                                    <a href="#" data-bs-toggle="modal"
                                                        data-bs-target="#viewModal{{ $report->id }}"
                                                        class="btn btn-primary w-100 mb-1">View</a>
                                                    <br>
                                                    <a href="#" data-bs-toggle="modal"
                                                        data-bs-target="#updateModal{{ $report->id }}"
                                                        class="btn btn-success w-100 mb-1">Update</a>
                                                    <br>
                                                    <a href="#" data-bs-toggle="modal"
                                                        data-bs-target="#deleteModal{{ $report->id }}"
                                                        class="btn btn-danger hide-menu w-100 mb-1">Delete</a>
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
            <x-reports.chosen :category=$active> </x-reports.chosen>


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
                $(document).ready(function() {

                    // @if ($report ?? false)
                    //     $('select').prop('disabled', true);
                    //     $('#addCrewDivButton').prop('disabled', true);
                    //     $('.unchangeable').prop('disabled', true);
                    //     $('#addReport').on('submit', function() {
                    //         $('select').prop('disabled', false);
                    //         $('.unchangeable').prop('disabled', false);
                    //     });
                    // @endif

                    $('#addCrewDivButton').click(function() {
                        var newDiv = $('#addCrew').clone();

                        console.log(newDiv);
                        $('#crew').append(newDiv);
                        newDiv.find('#closeCrew').prop('disabled', false);
                    });
                    // $('#addVictimDivButton').click(function() {
                    //     var newDiv = $('<div class="col-lg-4 mb-3"><div class="d-flex align-items-center"><input type="text" placeholder="Enter victim/patient name" class="form-control" id="exampleCheck1" name="name_of_victims[]"></div></div>');
                    //     $('#victim').append(newDiv);
                    // });
                    $('#inputNumber').on('input', function() {
                        var numInputs = $(this).val();
                        let children = $('#outputDivs').children().length;
                        console.log(numInputs < children);
                        if (numInputs > children) {
                            let add = numInputs - children;
                            console.log(numInputs - children);
                            for (var i = 0; i < add; i++) {
                                var newDiv = $(
                                    '<div class="col-lg-6 mb-3"><div class="d-flex align-items-center"><input type="text" name="name_of_victims[]" class="form-control" placeholder="Enter patient/victim name"><button class="btn btn-outline-danger remove-input ms-1">X</button></div></div>'
                                );
                                $('#outputDivs').append(newDiv);
                            }
                        } else if (numInputs < children) {
                            // Remove excess divs if there are fewer inputs than existing divs
                            console.log("hi");
                            var remove = children - numInputs;
                            for (var i = 0; i < remove; i++) {
                                $('#outputDivs').children('.col-lg-6.mb-3').last().remove();
                            }
                        } else {
                            if (!numInputs || isNaN(numInputs) || numInputs <= 0) {
                                return;
                            }
                            for (var i = 0; i < numInputs; i++) {
                                var newDiv = $(
                                    '<div class="col-lg-6 mb-3"><div class="d-flex align-items-center"><input type="text" name="name_of_victims[]" class="form-control" placeholder="Enter patient/victim name"><button class="btn btn-outline-danger remove-input ms-1">X</button></div></div>'
                                );
                                $('#outputDivs').append(newDiv);
                            }
                        }
                    });

                    $(document).on('click', '.remove-input', function() {
                        $(this).parent().parent().remove();
                        $('#inputNumber').val($('#inputNumber').val() - 1);
                    });
                    $(document).on('click', '.remove-crew-input', function() {
                        $(this).parent().parent().remove();
                        // $('#crewNum').val($('#crewNum').val() - 1);
                    });
                });
            </script>
        @endsection
