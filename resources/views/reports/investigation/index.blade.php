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
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                        data-bs-target="#chooseInvestigation">Create</button>
                    <x-reports.create-investigation :spots=$spots></x-reports.create-investigation>
                </div>
                <div class="col-lg-12 d-flex align-items-stretch">
                    <div class="card w-100">
                        <div class="card-body p-4">
                            <h5 class="card-title fw-semibold mb-4 text-capitalize">
                                {{ $active != 'investigation' ? $active : 'All' }} Investigation Reports</h5>
                            <div class="table-responsive">
                                <table class="table mb-0 align-middle w-100" id="allInvestigation">
                                    <thead class="text-dark fs-4">
                                        <tr>
                                            <th class="border-bottom-0" style="max-width:10%">
                                                <h6 class="fw-semibold mb-0">For</h6>
                                            </th>
                                            <th class="border-bottom-0">
                                                <h6 class="fw-semibold mb-0">Subject</h6>
                                            </th>
                                            <th class="border-bottom-0">
                                                <h6 class="fw-semibold mb-0">Date</h6>
                                            </th>
                                            <th class="border-bottom-0">
                                                <h6 class="fw-semibold mb-0">Action</h6>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                        @foreach ($investigations as $investigation)
                                            
                                            {{-- <x-reports.update :report=$investigation></x-reports.update> --}}
                                            <tr>
                                                {{-- {{dd($investigation)}} --}}
                                                <td class="border-bottom-0">
                                                    <h6 class="fw-semibold mb-0">{{ $investigation->for }}</h6>
                                                </td>
                                                <td class="border-bottom-0">
                                                    <p class="mb-0 fw-normal">{{ $investigation->subject }}</p>
                                                </td>
                                                <td class="border-bottom-0">
                                                    <p class="mb-0 fw-normal">
                                                        {{ \Carbon\Carbon::parse($investigation->date)->format('F j, Y') }}
                                                    </p>
                                                </td>
                                                <td class="border-bottom-0">
                                                    <a href=""
                                                        class="btn btn-success w-100 mb-1">Update</a>
                                                    <br>
                                                    <a href="#" data-bs-toggle="modal"
                                                        data-bs-target="#deleteModal{{ $investigation->id }}"
                                                        class="btn btn-danger hide-menu w-100 mb-1">Delete</a>
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
            @include('partials.investigationScript')
        @endsection
