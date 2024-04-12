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

            <div class="modal fade" data-bs-backdrop="static" id="addModal" tabindex="-1"
                aria-labelledby="addResponseModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                        </div>
                        <div class="modal-body">
                            <div>
                                <!-- Monthly Earnings -->
                                <form action="{{route('account.create')}}" method="POST">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="inputName" class="form-label">Name</label>
                                        <input type="text" class="form-control" name="name" required>
                                    </div>
                                    <hr>
                                    <div class="mb-3">
                                        <label for="dropdownSelection" class="form-label">Privilege</label>
                                        <select class="form-select" id="dropdownSelection" name="dropdownSelection">
                                            <option value="">Select Privilege</option>
                                            <option value="operation">Operation</option>
                                            <option value="investigation">Investigation</option>
                                        </select>
                                    </div>
                                    <hr>
                                    <div class="mb-3">
                                        <label for="inputEmail" class="form-label">Email</label>
                                        <input type="email" class="form-control" id="inputEmail" name="email" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="inputEmail" class="form-label">Password</label>
                                        <input type="password" class="form-control" id="inputEmail" name="email" required>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col d-flex justify-content-end mb-2">
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal">
                        <span>
                            <i class="ti ti-layout-dashboard"></i>
                        </span>
                        <span class="hide-menu">Add</span>
                    </button>
                </div>
                <div class="col-lg-12 d-flex align-items-stretch">
                    <div class="card w-100">
                        <div class="card-body p-4">
                            <h5 class="card-title fw-semibold mb-4 text-capitalize text-center">Accounts</h5>
                            <div class="table-responsive">
                                <table class="table text-nowrap mb-0 align-middle">
                                    <thead class="text-dark fs-4">
                                        <tr>
                                            <th class="border-bottom-0">
                                                <h6 class="fw-semibold mb-0">Name</h6>
                                            </th>
                                            <th class="border-bottom-0">
                                                <h6 class="fw-semibold mb-0">Type</h6>
                                            </th>
                                            <th class="border-bottom-0">
                                                <h6 class="fw-semibold mb-0">Privillege</h6>
                                            </th>
                                            <th class="border-bottom-0">
                                                <h6 class="fw-semibold mb-0">Action</h6>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($users as $user)
                                            <tr>
                                                <td class="border-bottom-0">
                                                    <h6 class="fw-semibold mb-0">{{ $user->name }}</h6>
                                                </td>
                                                <td class="border-bottom-0">
                                                    <h6 class="fw-semibold mb-0">{{ $user->type }}</h6>
                                                </td>
                                                <td class="border-bottom-0">
                                                    @if ($user->privilege == '0C')
                                                        <h6 class="fw-semibold mb-0">Operation</h6>
                                                    @else
                                                        <h6 class="fw-semibold mb-0">Investigation</h6>
                                                    @endif

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


            <script>
                // Wait for the document to load
                document.addEventListener("DOMContentLoaded", function() {
                    // Get the Yes and No buttons
                    // var yesBtn = document.getElementById('yesBtn');
                    // var noBtn = document.getElementById('noBtn');

                    // // Attach click event listeners to the buttons
                    // yesBtn.addEventListener('click', function() {
                    //     // Show the Yes modal
                    //     $('#yesModal').modal('show');
                    //     // Hide the current modal
                    //     $('#addResponseModal').modal('hide');
                    // });

                    // noBtn.addEventListener('click', function() {
                    //     // Show the No modal
                    //     $('#noModal').modal('show');
                    //     // Hide the current modal
                    //     $('#addResponseModal').modal('hide');
                    // });
                });
            </script>
        @endsection
