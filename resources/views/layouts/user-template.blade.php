<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BFP - {{ $active ?? auth()->user()->type }}</title>
    <link rel="shortcut icon" type="image/png" href="{{ asset('assets/images/logos/logo.jpg') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/styles.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/mystyle.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/DataTables/datatables.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/quill/quill.snow.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/select2/dist/css/select2.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/quill/quill.snow.css') }}">
    <script src="{{ asset('assets/libs/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/quill/quill.js') }}"></script>
    <script src="{{ asset('assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/DataTables/datatables.js') }}"></script>
    <script src="{{ asset('assets/select2/dist/js/select2.js') }}"></script>
    <script src="{{ asset('assets/quill/quill.js') }}"></script>
</head>

<body>
    <div class="loader bg-gradient-blue">
        <img src="{{ asset('assets/images/logos/BFP_Ligao_logo.png') }}" width="170" alt="">
    </div>
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
                        <div class="modal-body text-center">
                            <div class="modal-icon">
                                <img src="/assets/images/icons/logout.gif" alt="Warning Icon">
                            </div>
                            <h3 class="modal-title">Are you sure you want to logout? </h3>
                            <p class="mb-0">This action cannot be undone.</p>
                        </div>
                        <div class="modal-footer justify-content-flex-center">
                            <button type="button" class="btn btn-light w-50" data-bs-dismiss="modal">Cancel</button>
                            <a href="{{ route('user.logout') }}" type="button" class="btn btn-primary w-50">Yes, Logout</a>
                        </div>
                    </div>
                </div>
            </div>


            <div class="modal fade" data-bs-backdrop="static" id="userPasswordModal" tabindex="-1"
                aria-labelledby="addResponseModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                        </div>
                        <div class="modal-body">
                            <form method="POST" action="{{ route('profile.password.update') }}">
                                @csrf
                                <div class="mb-3">
                                    <label for="inputEmail" class="form-label">Current Password</label>
                                    <input type="password" class="form-control" name="current_password">
                                </div>
                                <div class="mb-3">
                                    <input type="hidden" name="password_id" id="password_id">
                                    <label for="inputEmail" class="form-label">New Password</label>
                                    <input type="password" class="form-control" name="password">
                                </div>
                                <div class="mb-3">
                                    <label for="inputEmail" class="form-label">Confirmation</label>
                                    <input type="password" class="form-control" name="confirmation">
                                </div>
                                <button type="submit" class="btn btn-primary">Update</button>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            </form>
                        </div>
                        <div class="modal-footer">
                        </div>
                    </div>
                </div>
            </div>



            @include('partials.header')
            <x-flash-message></x-flash-message>
            <!--  Header End -->
            @yield('content')
            @include('partials.footer')
            {{-- Footer End --}}
        </div>
    </div>
    <script src="{{ asset('assets/js/loader.js') }}"></script>
    <script src="{{ asset('assets/js/sidebarmenu.js') }}"></script>
    <script src="{{ asset('assets/js/app.min.js') }}"></script>
    <script src="{{ asset('assets/js/datatables.js') }}"></script>
    <script src="{{ asset('assets/select2/dist/scripts/script.js') }}"></script>
    <script src="{{ asset('assets/js/lightbox.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('form').submit(function(e) {
                // disable the submit button 
                $('button[type="submit"]').attr('disabled', true);
                // submit the form
                return true;
            });
        });
    </script>
</body>

</html>
