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
                                <form method="POST" action="{{ route('admin.account.create') }}">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="inputName" class="form-label">Name</label>
                                        <input type="text" class="form-control" name="name">
                                    </div>
                                    <hr>
                                    <div class="mb-3">
                                        <label for="dropdownSelection" class="form-label">Privilege</label>
                                        <select class="form-select" name="privilege">
                                            <option value="">Select Privilege</option>
                                            <option value="OC">Operation</option>
                                            <option value="IC">Investigation</option>
                                        </select>
                                    </div>
                                    <hr>
                                    <div class="mb-3">
                                        <label for="inputEmail" class="form-label">Email</label>
                                        <input type="email" class="form-control" name="email">
                                    </div>
                                    <div class="mb-3">
                                        <label for="inputEmail" class="form-label">Password</label>
                                        <input type="password" class="form-control" name="password">
                                    </div>
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" data-bs-backdrop="static" id="editModal" tabindex="-1"
                aria-labelledby="addResponseModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                        </div>
                        <div class="modal-body">
                            <div>
                                <!-- Monthly Earnings -->
                                <form method="POST" action="{{ route('admin.account.update') }}">
                                    @csrf
                                    <div class="mb-3">
                                        <input type="text" class="form-control" hidden name="user_id" id="user_id">
                                        <label for="inputName" class="form-label">Name</label>
                                        <input type="text" class="form-control" name="name" id="name">
                                    </div>
                                    <hr>
                                    <div class="mb-3">
                                        <label for="dropdownSelection" class="form-label">Privilege</label>
                                        <select class="form-select" name="privilege" id="privilege">
                                            <option value="">Select Privilege</option>
                                            <option value="OC">Operation</option>
                                            <option value="IC">Investigation</option>
                                        </select>
                                    </div>
                                    <hr>
                                    <div class="mb-3">
                                        <label for="inputEmail" class="form-label">Email</label>
                                        <input type="email" class="form-control" name="email" id="email">
                                    </div>
                                    <div class="mb-3">
                                        <label for="inputEmail" class="form-label">New Password</label>
                                        <input type="password" class="form-control" name="password">
                                    </div>
                                    <div class="mb-3">
                                        <label for="inputEmail" class="form-label">Confirmation</label>
                                        <input type="password" class="form-control" name="confirmation">
                                    </div>
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Cancel</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="row">
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif


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
                                                    <a class="btn btn-success w-100 mb-1" data-bs-toggle="modal"
                                                        data-bs-target="#editModal"
                                                        data-user-id="{{ json_encode($user->id) }}"
                                                        data-name="{{ json_encode($user->name) }}"
                                                        data-privilege="{{ json_encode($user->privilege) }}"
                                                        data-email="{{ json_encode($user->email) }}">Update</a>
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
                $(document).ready(function() {

                    $('#editModal').on('show.bs.modal', function(event) {
                        var button = $(event.relatedTarget);
                        var user_id = button.data('user-id');
                        var name = button.data('name').replace(/"/g, '');
                        var privilege = button.data('privilege').replace(/"/g, '');
                        var email = button.data('email').replace(/"/g, '');
                        var modal = $(this);

                        modal.find('#user_id').val(user_id);
                        modal.find('#name').val(name);
                        modal.find('#privilege').val(privilege);
                        modal.find('#email').val(email);
                    });
                });

                function validateInput() {
                    var passwordInput = document.getElementById('password').value.trim();
                    var confirmationInput = document.getElementById('confirmation').value.trim();

                    if (passwordInput !== '' && confirmationInput !== '') {
                        console.log('Both password and confirmation have input.');
                        // Here you can perform any actions you need, such as enabling a submit button
                    } else {
                        console.log('Both password and confirmation have no input.');

                    }
                }
            </script>
        @endsection
