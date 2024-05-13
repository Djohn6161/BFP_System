<style>
    .btn-reports {
        width: 200px
    }
</style>
@extends('layouts.user-template')
@section('content')
    <div class="container-fluid">
        <div class="col-lg-12">
            <div class="row">
                <div class="col-lg-12 d-flex align-items-stretch">
                    <div class="card w-100">
                        <div class="card-body p-4">
                            <div class="d-flex justify-content-between align-items-center p-3 rounded bg-gradient-blue">
                                <h5 class="mb-0 text-light card-title fw-semibold">Occupancy
                                    Names</h5>
                                <button type="button" class="btn btn-light" data-bs-toggle="modal"
                                    data-bs-target="#addOccupancyModal">
                                    <i class="ti ti-plus"></i>
                                    Create
                                </button>
                                <x-occupancy.create :category="$active"></x-occupancy.create>
                            </div>

                            <div class="table-responsive">
                                <table class="table mb-0 align-middle w-100" id="barangayTable">
                                    <thead class="text-dark fs-4">
                                        <tr>
                                            <th class="border-bottom-0" style="max-width:10%">
                                                Occupancy Name
                                            </th>
                                            <th class="border-bottom-0" style="max-width:10%">
                                                Actions
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody class="table-group-divider">
                                        @foreach ($occupancy_names as $occupancyName)
                                            <x-occupancy.edit :occupancyName=$occupancyName></x-occupancy.edit>
                                            <x-occupancy.delete :occupancyName=$occupancyName></x-occupancy.delete>

                                            {{-- <x-reports.view-modal :report=$investigation></x-reports.view-modal> --}}
                                            {{-- <x-reports.update :report=$investigation></x-reports.update> --}}
                                            <tr>
                                                {{-- {{dd($occupancies)}} --}}
                                                <td class="border-bottom-0">
                                                    {{ $occupancyName->name }}
                                                </td>

                                                <td class="w-25 py-2">
                                                    <div class="d-flex flex-row">
                                                        <div class="me-1">
                                                            <button class="btn btn-success w-100 mb-1"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#updateOccupancyModal{{ $occupancyName->id }}">
                                                                Update
                                                                <i class="ti ti-pencil"></i>
                                                            </button>
                                                        </div>
                                                        <div class="me-1">
                                                            <button class="btn btn-danger w-100 mb-1" data-bs-toggle="modal"
                                                                data-bs-target="#deleteOccupancyModal{{ $occupancyName->id }}">
                                                                Delete
                                                                <i class="ti ti-trash"></i>
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
