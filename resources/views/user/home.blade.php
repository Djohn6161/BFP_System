@extends('layouts.user-template')
@section('content')
<div class="container-fluid">
    <!--  Row 1 -->
    <div class="col-lg-12 ">
      <!-- Monthly Earnings -->
      <div class="row">
          <div class="col text-center">
            <img src="../assets/images/logos/BFP_Ligao_logo.png" width="170" alt="">
              <h1>Welcome to my vlog!</h1>
          </div>
          
      </div>
      <div class="row justify-content-center mt-3">
          <div class="col-auto">
              <a href="{{route('user.Response.index')}}" type="button" class="btn btn-lg btn-secondary me-2 btn-width">Response</a>
          </div>
          <div class="col-auto">
              <a href="{{route('user.nonResponse.index')}}" type="button" class="btn btn-lg btn-outline-secondary btn-width">Non-Response</a>
          </div>
      </div>
  </div>
  
@endsection
