<style>
    .btn-reports {
        width: 200px;
    }
</style>

@extends('layouts.user-template')

@section('content')
    {{-- <div class="container-fluid">
        <!--  Row 1 -->

        <div class="col-lg-12">
            <div class="row">
                <div class="col d-flex justify-content-end mb-2">
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addAccountModal">
                        <span>
                            <i class="ti ti-plus"></i>
                        </span>
                        <span class="hide-menu">Create Account</span>
                    </button>
                </div>
                <div class="col-lg-12 d-flex align-items-stretch">
                    <div class="card w-100">
                        <div class="card-body p-4">
                            <h5 class="card-title fw-semibold mb-4">Accounts</h5> --}}

    <div class="container-fluid">
        <div class="col-lg-12">
            <div class="row">
                <div class="col-lg-12 d-flex align-items-stretch">
                    <div class="card w-100">
                        <div class="card-body p-4">
                            <div class="d-flex justify-content-between align-items-center p-3 rounded bg-gradient-blue">
                                <h5 class="mb-0 text-light card-title fw-semibold">Accounts</h5>
                                <button type="button" class="btn btn-light" data-bs-toggle="modal"
                                    data-bs-target="#addAccountModal">
                                    <i class="ti ti-plus"></i>
                                    Create Account
                                </button>
                                <x-truck.create :category="$active"></x-truck.create>
                            </div>
                            <div class="table-responsive">
                                <table class="table text-nowrap mb-0 align-middle" id="adminAccount">
                                    <thead class="text-dark fs-4">
                                        <tr>
                                            <th class="border-bottom-0">
                                                <h6 class="fw-semibold mb-0">Name</h6>
                                            </th>
                                            <th class="border-bottom-0">
                                                <h6 class="fw-semibold mb-0">Email</h6>
                                            </th>
                                            <th class="border-bottom-0">
                                                <h6 class="fw-semibold mb-0">Action</h6>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($accounts as $account)
                                            <tr>
                                                <td class="border-bottom-0">
                                                    <h6 class="mb-0 fw-normal">{{ $account->name }}</h6>
                                                </td>
                                                <td class="border-bottom-0">
                                                    <h6 class="mb-0 fw-normal">{{ $account->email }}</h6>
                                                </td>
                                                <td class="border-bottom-0 w-25 py-2">
                                                    <div class="d-flex flex-row">
                                                        <div class="me-1">
                                                            <button class="btn btn-success mb-1" data-bs-toggle="modal"
                                                                data-bs-target="#editAccountModal"
                                                                data-user="{{ json_encode($account) }}"
                                                                data-type="{{ $type }}">
                                                                Edit Profile
                                                                <i class="ti ti-pencil"></i>
                                                            </button>
                                                        </div>
                                                        <div class="me-1">
                                                            <button class="btn btn-primary mb-1" data-bs-toggle="modal"
                                                                data-bs-target="#updatePasswordModal"
                                                                data-account-id="{{ $account->id }}">
                                                                Change Password
                                                                <i class="ti ti-key"></i>
                                                            </button>
                                                        </div>

                                                        <div class="me-1">
                                                            <button href="#" class="btn btn-danger mb-1"
                                                                data-bs-toggle="modal" data-bs-target="#deleteAccountModal"
                                                                data-account-id="{{ $account->id }}">
                                                                Delete
                                                                <i class="ti ti-trash"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                            </div>
                            </td>
                            </tr>
                            @endforeach

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
    <x-account.create :category="$active" :type="$type"> </x-account.create>
    <x-account.edit :category="$active" :type="$type"> </x-account.edit>
    <x-account.edit_password :category="$active" :type="$type"> </x-account.edit_password>
    <x-account.delete :category="$active" :type="$type"> </x-account.delete>
    {{-- <script>
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
    </script> --}}
@endsection
