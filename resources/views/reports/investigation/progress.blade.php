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
                {{-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    Launch demo modal
                  </button> --}}
                <div class="col-lg-12 d-flex align-items-stretch">
                    <div class="card w-100">
                        <div class="card-body p-4">
                            <h5 class="card-title fw-semibold mb-4 text-capitalize">
                                {{ $active != 'investigation' ? $active : 'All' }} Investigation Reports</h5>
                            <div class="table-responsive">
                                <table class="table mb-0 align-middle w-100" id="progressInvestigationTable">
                                    <thead class="text-dark fs-4">
                                        <tr>
                                            <th style="max-width:10%">
                                                <h6 class="fw-semibold mb-0">For</h6>
                                            </th>
                                            <th>
                                                <h6 class="fw-semibold mb-0">Subject</h6>
                                            </th>
                                            <th>
                                                <h6 class="fw-semibold mb-0">Date</h6>
                                            </th>
                                            <th>
                                                <h6 class="fw-semibold mb-0">Action</h6>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($investigations as $investigation)
                                            <tr>
                                                {{-- {{dd($investigation)}} --}}
                                                <td>
                                                    <h6 class="fw-semibold mb-0">{{ $investigation->investigation->for }}</h6>
                                                </td>
                                                <td>
                                                    <p class="mb-0 fw-normal">{{ $investigation->investigation->subject }}</p>
                                                </td>
                                                <td>
                                                    <p class="mb-0 fw-normal">
                                                        {{ \Carbon\Carbon::parse($investigation->investigation->date)->format('F j, Y') }}
                                                    </p>
                                                </td>
                                                <td>
                                                    <button type="button" data-bs-toggle="modal"
                                                    data-bs-target="#viewProgressModal{{ $investigation->id }}" class="btn btn-primary hide-menu w-100 mb-1"><i class="ti ti-eye"></i> View</button>
                                                    <x-reports.Investigation.view-progress :investigation=$investigation></x-reports.Investigation.view-progress>

                                                    <a href="{{route('investigation.progress.edit', ['progress' => $investigation->id])}}"
                                                        class="btn btn-success w-100 mb-1"><i class="ti ti-pencil"></i> Update</a>
                                                    <br>
                                                    <button type="button" data-bs-toggle="modal"
                                                        data-bs-target="#deleteModal{{ $investigation->id }}"
                                                        class="btn btn-danger hide-menu w-100 mb-1"><i class="ti ti-trash"></i> Delete</button>
                                                        <x-reports.investigation.investigation-delete :type="'progress'" :investigation=$investigation></x-reports.investigation.investigation-delete>

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
