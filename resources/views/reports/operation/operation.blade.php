<style>
    .btn-reports {
        width: 200px
    }
</style>
@extends('layouts.user-template')
@section('content')
    {{-- <div class="container-fluid">
        <!--  Row 1 -->

        <div class="col-lg-12">
            <!-- Monthly Earnings -->

            <div class="row">
                <div class="col d-flex justify-content-end mb-2">
                    <button href="{{ route('operation.create.form') }}" class="btn btn-primary">
                        <i class="ti ti-plus"></i>
                        Create
                       
                    </button>
                </div>
                <div class="col-lg-12 d-flex align-items-stretch">
                    <div class="card w-100">
                        <div class="card-body p-4">
                            <h5 class="card-title fw-semibold mb-4">Operation Reports</h5> --}}
    <div class="container-fluid">
        <div class="col-lg-12">
            <div class="row">
                <div class="col-lg-12 d-flex align-items-stretch">
                    <div class="card w-100">
                        <div class="card-body p-4">
                            <div class="d-flex justify-content-between align-items-center p-3 rounded bg-gradient-blue">
                                <h5 class="mb-0 text-light card-title fw-semibold">Operation Reports</h5>
                                <button type="button" class="btn btn-light" href="{{ route('operation.create.form') }}">
                                    <i class="ti ti-plus"></i>
                                    Create
                                </button>
                                <x-truck.create :category="$active"></x-truck.create>
                            </div>
                            <div class="table-responsive">
                                <table class="table mb-0 align-middle w-100" id="operationTable">
                                    <thead class="text-dark fs-4">
                                        <tr>
                                            <th class="border-bottom-0" style="max-width:10%">
                                                <h6 class="fw-semibold mb-0">Alarm Received</h6>
                                            </th>
                                            <th class="border-bottom-0">
                                                <h6 class="fw-semibold mb-0">Transmitted By</h6>
                                            </th>
                                            <th class="border-bottom-0">
                                                <h6 class="fw-semibold mb-0">Location</h6>
                                            </th>
                                            <th class="border-bottom-0">
                                                <h6 class="fw-semibold mb-0">Time/Date Under Control</h6>
                                            </th>
                                            <th class="border-bottom-0">
                                                <h6 class="fw-semibold mb-0">Time/Date Declared Fireout</h6>
                                            </th>
                                            <th class="border-bottom-0">
                                                <h6 class="fw-semibold mb-0">Action</h6>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($operations as $operation)
                                            <tr>
                                                <td class="border-bottom-0">
                                                    <h6 class="fw-semibold mb-0">{{ $operation->alarm_received }}</h6>
                                                </td>
                                                <td class="border-bottom-0">
                                                    <h6 class="fw-semibold mb-0 text-capitalize">
                                                        {{ $operation->transmitted_by }}
                                                    </h6>
                                                </td>
                                                <td class="border-bottom-0">
                                                    <p class="mb-0 fw-normal">{{ $operation->full_location }}</p>
                                                </td>
                                                <td class="border-bottom-0">
                                                    <p class="mb-0 fw-normal">
                                                        {{ \Carbon\Carbon::parse($operation->td_declared_fireout)->format('F j, Y | g:i:s A') }}
                                                    </p>
                                                </td>
                                                <td class="border-bottom-0">
                                                    <p class="mb-0 fw-normal">
                                                        {{ \Carbon\Carbon::parse($operation->td_declared_fireout)->format('F j, Y | g:i:s A') }}
                                                    </p>
                                                </td>
                                                <td class="border-bottom-0">
                                                    <button type="button" data-bs-toggle="modal"
                                                        data-bs-target="#viewOperationModal{{ $operation->id }}"
                                                        data-operation="{{ json_encode($operation) }}"
                                                        data-responses="{{ json_encode($operation->responses) }}"
                                                        class="btn btn-primary hide-menu w-100 mb-1">View
                                                        <i class="ti ti-eye"></i>
                                                    </button>
                                                    <x-reports.operation.operation_view :operation="$operation"
                                                        :responses="$responses"></x-reports.operation.operation_view>
                                                    <button
                                                        href="{{ route('operation.update.form', ['id' => $operation->id]) }}"
                                                        class="btn btn-success w-100 mb-1">Update
                                                        <i class="ti ti-pencil"></i>
                                                    </button>
                                                    <br>
                                                    <button type="button" data-bs-toggle="modal"
                                                        data-bs-target="#deleteModal{{ $operation->id }}"
                                                        class="btn btn-danger hide-menu w-100 mb-1">Delete
                                                        <i class="ti ti-trash"></i>
                                                    </button>
                                                    <x-reports.operation.delete :operation="$operation">
                                                    </x-reports.operation.delete>
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
        @endsection
