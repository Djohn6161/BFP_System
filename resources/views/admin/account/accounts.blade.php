<style>
    .btn-reports {
        width: 200px;
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
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addAccountModal">
                        <span>
                            <i class="ti ti-layout-dashboard"></i>
                        </span>
                        <span class="hide-menu">Create Account</span>
                    </button>
                </div>
                <div class="col-lg-12 d-flex align-items-stretch">
                    <div class="card w-100">
                        <div class="card-body p-4">
                            <h5 class="card-title fw-semibold mb-4">Accounts</h5>
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
                                                <h6 class="fw-semibold mb-0">Privilege</h6>
                                            </th>
                                            <th class="border-bottom-0">
                                                <h6 class="fw-semibold mb-0">Email</h6>
                                            </th>
                                            <th class="border-bottom-0">
                                                <h6 class="fw-semibold mb-0">Password</h6>
                                            </th>
                                            <th class="border-bottom-0">
                                                <h6 class="fw-semibold mb-0">Action</h6>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="border-bottom-0">
                                                <h6 class="mb-0 fw-normal">Cristine Haber</h6>
                                            </td>
                                            <td class="border-bottom-0">
                                                <h6 class="mb-0 fw-normal">Admin</h6>
                                            </td>
                                            <td class="border-bottom-0">
                                                <h6 class="mb-0 fw-normal">Edit</h6>
                                            </td>
                                            <td class="border-bottom-0">
                                                <h6 class="mb-0 fw-normal">haber650@gmail.com</h6>
                                            </td>
                                            <td class="border-bottom-0">
                                                <h6 class="mb-0 fw-normal">joker123</h6>
                                            </td>
                                            <td class="border-bottom-0">
                                                <a href="" class="btn btn-success w-100 mb-1" data-bs-toggle="modal" data-bs-target="#editAccountModal">Edit</a>
                                                
                                                <br>
                                                <a href="#" class="btn btn-danger w-100 mb-1" data-bs-toggle="modal" data-bs-target="#deleteAccountModal">Delete</a>
                                            </td>
                                        </tr>
                                        <!-- Add more static data rows as needed -->
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Removed custom blade components -->
        </div>
    </div>
    <x-account.create :category=$active > </x-account.create>
    <x-account.edit :category=$active > </x-account.edit>
    <x-account.delete :category=$active > </x-account.delete>
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
