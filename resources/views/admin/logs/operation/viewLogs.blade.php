@extends('layouts.user-template')
@section('content')
    <div class="container-fluid">
    

        <div class="col-lg-12">


            <div class="row">
                <div class="col d-flex justify-content-end mb-2">
                </div>
                <div class="col-lg-12 d-flex align-items-stretch">
                    <div class="card w-100">
                        <div class="card-body p-4">
                            <h5 class="card-title fw-semibold mb-4">Operation Logs</h5>
                           
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead class="text-dark">
                                        <tr>
                                            <th>Date</th>
                                            <th>Time</th>
                                            <th>Information</th>
                                            <th>Type of Report</th>
                                            <th>User</th>
                                            <th>Action/Changes Made</th>
                                        </tr>
                                    </thead>
                                    <tbody class="table-group-divider">
                                        <tr>
                                            <td>01-05-2024</td>
                                            <td>9:00am</td>
                                            <td>Inda</td>
                                            <td>Minimal</td>
                                            <td>Admin</td>
                                            <td>Update Minimal Report</td>
                                        </tr>
                                        <!-- Add more rows as needed -->
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endsection
