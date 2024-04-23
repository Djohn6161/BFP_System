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

            <div class="row">
                <div class="col d-flex justify-content-end mb-2">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#chooseInvestigation">Create</button>
                    <x-reports.create-investigation></x-reports.create-investigation>
                </div>
                {{-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    Launch demo modal
                  </button> --}}
                <x-reports.investigation.table :investigations=$investigations :active=$active></x-reports.investigation.table>
            </div>
            <script>
                function progress(btn){
                     // Show the Yes modal
                     $('#spotTable').modal('show');
                                    // Hide the current modal
                     $('#chooseInvestigation').modal('hide');
                }
            </script>
        @endsection

