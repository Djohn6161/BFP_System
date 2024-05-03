
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>BFP - Login</title>
  
  <link rel="stylesheet" href="{{asset('/assets/libs/bootstrap/dist/css/bootstrap.min.css')}}">
  <script src="{{asset('/assets/libs/bootstrap/dist/js/bootstrap.bundle.js')}}"></script>
    <link rel="stylesheet" href="../assets/css/styles.min.css" />

</head>

<body style="background-image: url('../assets/images/backgrounds/bg1.png'); background-size: cover; background-position: center;">
  <!--  Body Wrapper -->
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">
    <div class="position-relative overflow-hidden  min-vh-100 d-flex align-items-center justify-content-center">
      <div class="d-flex align-items-center justify-content-center w-100">
        
          <div class="col-md-8 col-lg-6 col-xxl-3">
            <div class="card mb-0">
              <div class="card-body">
              <a href="" class="text-nowrap logo-img text-center d-block py-3 w-100">
    <img src="../assets/images/logos/bfp.gif" width="150" height="auto" alt="">
</a>
<h4 class="text-center"><b>Bureau of Fire Protection<br> Ligao City<b></h4>

<form method="POST" action="{{ route('login') }}">
    @csrf
    @if ($errors->any())
    <div class="alert alert-danger text-center py-2" role="">
        Invalid Credentials 
    </div>
                    @endif
                    
                  <div class="mb-3 ">

                    <label for="exampleInputEmail1" class="form-label" >Email</label>
                    <input  name="email" required value="{{old('email')}}" type="email" class="form-control " id="InputEmail1" aria-describedby="emailHelp">
                  </div>
                  <div class="mb-4">
                    <label for="exampleInputPassword1" class="form-label" >Password</label>
                    <input type="password" required class="form-control" id="InputPassword1" name="password">
                  </div>
                  <button type="submit" class="btn btn-dark w-100 py-8 fs-4 mb-4 rounded-2">Sign In</button>
                </form>
              </div>
            </div>
          </div>
       
      </div>
    </div>
  </div>
  <script src="../assets/libs/jquery/dist/jquery.min.js"></script>
  <script src="../assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>