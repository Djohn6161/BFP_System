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
    <link rel="stylesheet" href="{{ asset('assets/select2/dist/css/select2.css') }}">
    <script src="{{ asset('assets/libs/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/DataTables/datatables.js') }}"></script>
    <script src="{{ asset('assets/select2/dist/js/select2.js') }}"></script>
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
            @include('partials.header')
            <!--  Header End -->
            @yield('content')
            {{-- @include('partials.footer') --}}

        </div>
    </div>
    <script src="{{ asset('assets/js/sidebarmenu.js') }}"></script>
    <script src="{{ asset('assets/js/app.min.js') }}"></script>
    <script src="{{ asset('assets/js/datatables.js') }}"></script>
    <script src="{{ asset('assets/select2/dist/scripts/script.js') }}"></script>
    <script src="{{ asset('assets/js/lightbox.js') }}"></script>
</body>

</html>
