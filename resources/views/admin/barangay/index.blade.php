<style>
    .btn-reports {
        width: 200px
    }
</style>
@extends('layouts.user-template')
@section('content')
    {{-- <div class="container-fluid">
        <div class="col-lg-12">
            <div class="row">
                <div class="col d-flex justify-content-end mb-2">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                        data-bs-target="#addBarangayModal">
                        <i class="ti ti-plus"></i>
                        
                        Create
                    </button>
                    <x-barangay.create :category="$active"></x-barangay.create>
                </div>
                <div class="col-lg-12 d-flex align-items-stretch">
                    <div class="card w-100">
                        <div class="card-body p-4">
                            <h5 class="card-title fw-semibold mb-4 p-3 rounded bg-gradient-blue text-light">Barangay</h5> --}}

    <div class="container-fluid">
        <div class="col-lg-12">
            <div class="row">
                <div class="col-lg-12 d-flex align-items-stretch">
                    <div class="card w-100">
                        <div class="card-body p-4">
                            <div class="d-flex justify-content-between align-items-center p-3 rounded bg-gradient-blue">
                                <h5 class="mb-0 text-light card-title fw-semibold">
                                    Barangay
                                </h5>
                                <button type="button" class="btn btn-light" data-bs-toggle="modal"
                                    data-bs-target="#addBarangayModal">
                                    <i class="ti ti-plus"></i>
                                    Create
                                </button>
                                <x-barangay.create :category="$active"></x-barangay.create>
                            </div>

                            <div class="table-responsive">
                                <table class="table mb-0 align-middle w-100" id="barangayTable">
                                    <thead class="text-dark fs-4">
                                        <tr>
                                            <th class="border-bottom-0">Name</th>
                                            <th class="border-bottom-0">Unit</th>
                                            <th class="border-bottom-0 text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody class="table-group-divider">
                                        @foreach ($barangays as $barangay)
                                            <x-barangay.edit :barangay=$barangay></x-barangay.edit>
                                            <x-barangay.delete :barangay=$barangay></x-barangay.delete>

                                            {{-- <x-reports.view-modal :report=$investigation></x-reports.view-modal> --}}
                                            {{-- <x-reports.update :report=$investigation></x-reports.update> --}}
                                            <tr>
                                                {{-- {{dd($occupancies)}} --}}
                                                <td>
                                                    {{ $barangay->name }}
                                                </td>
                                                <td>
                                                    {{ $barangay->unit }}
                                                </td>

                                                <td class="w-25 py-2">
                                                    <div class="d-flex flex-row">
                                                        <div class="me-1">
                                                            <button class="btn btn-success w-100"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#editBarangayModal{{ $barangay->id }}">
                                                                <i class="ti ti-pencil"></i>
                                                                Update
                                                         
                                                            </button>
                                                        </div>
                                                        <div class="me-1">
                                                            <button class="btn btn-danger w-100" data-bs-toggle="modal"
                                                                data-bs-target="#deleteBarangayModal{{ $barangay->id }}">
                                                                <i class="ti ti-trash"></i>
                                                                Delete
                                                               
                                                            </button>
                                                        </div>
                                                    </div>
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
            {{-- @include('partials.investigationScript') --}}
        @endsection
