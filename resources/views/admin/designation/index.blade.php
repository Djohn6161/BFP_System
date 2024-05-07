@extends('layouts.user-template')

@section('content')
    <div class="container-fluid">
        <!-- Row 1 -->
        <div class="col-lg-12">
            <!-- Monthly Earnings -->
            <div class="row">
                <div class="col d-flex justify-content-end mb-2">
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addDesignationModal">
                        <span>
                            <i class="ti ti-layout-dashboard"></i>
                        </span>
                        <span class="hide-menu">Add Designation</span>
                    </button>

                </div>
                <div class="col-lg-12">
                    <div class="card w-100">
                        <div class="card-body p-4">

                            <!-- Display Total Personnel -->
                            <h5 class="fw-semibold mb-4">BFP - Designations
                                <span class=" ms-3 badge rounded-pill bg-secondary"></span>
                            </h5>

                            <!-- Accordion for Designations -->
                            <div class="accordion accordion-flush" id="accordionDesignationPersonnel">
                                <table class="table mb-0 align-middle w-100" id="designationTable">
                                    <thead class="text-dark fs-4">
                                        <tr>
                                            <th>Name</th>
                                            {{-- <th>Class</th> --}}
                                            <th>Section</th>
                                            <th>Unit</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($designations as $designation)
                                        {{-- <x-designation.edit :designation="$designation"> </x-designation.edit>
                                        <x-designation.delete :designation="$designation"> </x-designation.delete> --}}
                                            <tr>
                                                <td>{{ $designation->name }}</td>
                                                {{-- <td>{{ $designation->class }}</td> --}}
                                                {{-- <td>{{ substr(App\Models\Designation::find($designation->section)->name, 0, 3) ?? 'Unspecified' }}</td> --}}
                                                <td>{{ App\Models\Designation::find($designation->section) != null ? substr(App\Models\Designation::find($designation->section)->name, 3) :   'N/A'}}</td>
                                                <td>{{ App\Models\Designation::find($designation->unit) != null ? substr(App\Models\Designation::find($designation->unit)->name, 3) :   'N/A'}}</td>
                                            </tr>
                                                
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- <x-designation.create :category="$active"> </x-designation.create> --}}
@endsection
