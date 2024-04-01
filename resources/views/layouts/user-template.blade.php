<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BFP</title>
    <link rel="shortcut icon" type="image/png" href="../assets/images/logos/logo.jpg" />
    <link rel="stylesheet" href="../assets/css/styles.min.css" />
</head>

<body>
    User
    <br>
    <a href="{{ route('user.logout') }}">Logout</a>
    <!--  Body Wrapper -->
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed">
        @include('partials.sidebar')
        <!--  Main wrapper -->
        <div class="body-wrapper">
            @include('partials.header')
            <!--  Header End -->
            @yield('content')
            @include('partials.footer')

        </div>
    </div>
    <script src="../assets/libs/jquery/dist/jquery.min.js"></script>
    <script src="../assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/sidebarmenu.js"></script>
    <script src="../assets/js/app.min.js"></script>
    <script src="../assets/libs/apexcharts/dist/apexcharts.min.js"></script>
    <script src="../assets/libs/simplebar/dist/simplebar.js"></script>
    <script src="../assets/js/dashboard.js"></script>

</body>

</html>
