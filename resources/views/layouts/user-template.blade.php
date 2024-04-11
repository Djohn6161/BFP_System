<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BFP</title>
    <link rel="shortcut icon" type="image/png" href="{{ asset('assets/images/logos/logo.jpg') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/styles.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/mystyle.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/DataTables/datatables.css') }}">
    <script src="{{ asset('assets/libs/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/DataTables/datatables.js') }}"></script>
</head>

<body>
    <!--  Body Wrapper -->
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed">
        @include('partials.sidebar')
        <!--  Main wrapper -->
        <div class="body-wrapper">
            <!-- Logout Modal -->
            <div class="modal fade" data-bs-backdrop="static" id="logoutModal" tabindex="-1"
                aria-labelledby="addResponseModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                        </div>
                        <div class="modal-body">
                            <!-- Input fields for adding content -->
                            <div class="mb-3 text-center">
                                <h3>You want to logout?</h3>
                            </div>
                        </div>
                        <div class="modal-footer d-flex justify-content-around">
                            {{-- <button type="button" class="btn btn-secondary btn-reports" id="yesBtn">Yes</button> --}}
                            <a href="{{ route('user.logout') }}" class="btn btn-secondary btn-reports">Yes</a>
                            <button type="button" class="btn btn-danger btn-reports" data-bs-dismiss="modal"
                                aria-label="Close">No</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" data-bs-backdrop="static" id="profileModal" tabindex="-1"
                aria-labelledby="addResponseModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                        </div>
                        <div class="modal-body">
                            form method="POST" action="{{ route('admin.account.update') }}">
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
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        </form>
                        </div>
                        <div class="modal-footer d-flex justify-content-around">
                            {{-- <button type="button" class="btn btn-secondary btn-reports" id="yesBtn">Yes</button> --}}
                            <a href="{{ route('user.logout') }}" class="btn btn-secondary btn-reports">Yes</a>
                            <button type="button" class="btn btn-danger btn-reports" data-bs-dismiss="modal"
                                aria-label="Close">No</button>
                        </div>
                    </div>
                </div>
            </div>
            @include('partials.header')
            <!--  Header End -->
            @yield('content')
            {{-- @include('partials.footer') --}}

        </div>
    </div>
    <script src="{{ asset('assets/js/sidebarmenu.js') }}"></script>
    <script src="{{ asset('assets/js/app.min.js') }}"></script>
    {{-- <script src="{{asset('assets/libs/apexcharts/dist/apexcharts.min.js')}}"></script>
    <script src="{{asset('assets/libs/simplebar/dist/simplebar.js')}}"></script>
    <script src="{{asset('assets/js/dashboard.js')}}"></script> --}}
    <script src="{{ asset('assets/js/datatables.js') }}"></script>
    <script>
        $(document).ready(function() {

            $('#editModal').on('show.bs.modal',  function(event) {
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
            // $('#passwordModal').on('show.bs.modal', function(event) {
            //     var button = $(event.relatedTarget);
            //     var user_id = button.data('user-id');
            //     var modal = $(this);
            //     modal.find('#password_id').val(user_id);
            // });
            // $('#deleteModal').on('show.bs.modal', function(event) {
            //     var button = $(event.relatedTarget);
            //     var user_id = button.data('user-id');
            //     var modal = $(this);
            //     modal.find('#account_id').val(user_id);
            // });
        });
    </script>
</body>

</html>
