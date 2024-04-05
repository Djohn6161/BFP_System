@extends('layouts.user-template')
@section('content')
<div class="container-fluid">
    <!--  Row 1 -->
    <div class="col-lg-12 ">
      <!-- Monthly Earnings -->
      <div class="row">
          <div class="col text-center">
            <img src="../assets/images/logos/BFP_Ligao_logo.png" width="170" alt="">
              <h1>NOOOOOOOOOOOOOOOOOOOO</h1>
          </div>
          
      </div>
      <div class="row justify-content-center mt-3">
          <div class="col-auto">
              <a href="{{route('operation.index')}}" type="button" class="btn btn-lg btn-secondary me-2 btn-width">Operation</a>
          </div>
          <div class="col-auto">
              <a href="{{route('investigation.index')}}" type="button" class="btn btn-lg btn-outline-secondary btn-width">Investigation</a>
          </div>
      </div>
  </div>
  
@endsection
