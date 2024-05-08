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
                    <a href="{{ route('operation.create.form') }}" class="btn btn-primary">Create</a>
                </div>
                <div class="col-lg-12 d-flex align-items-stretch">
                    <div class="card w-100">
                        <div class="card-body p-4">
                            <h5 class="card-title fw-semibold mb-4">Operation Reports</h5>
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
                                                        {{-- @foreach ($personnels as $personnel)
                                                            @if ($personnel->id == $operation->transmitted_by)
                                                                {{ $personnel->rank->slug }}
                                                                {{ $operation->transmittedBy->first_name }}
                                                                {{ $operation->transmittedBy->last_name }}
                                                            @endif
                                                        @endforeach --}}{{ $operation->transmitted_by }}
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
                                                    {{-- {{dd($operation->id) }}s --}}
                                                    <x-reports.operation.operation_view :operation=$operation></x-reports.operation.operation_view>
                                                    <button type="button" data-bs-toggle="modal"
                                                    data-bs-target="#viewOperationModal{{ $operation->id }}" class="btn btn-primary hide-menu w-100 mb-1">View</button>
                                                       
                                                    <a href="{{ route('operation.update.form', ['id' => $operation->id]) }}"
                                                        class="btn btn-success w-100 mb-1">Update</a>
                                                    <br>
                                                    <button type="button" href="#" data-bs-toggle="modal"
                                                        data-bs-target="#deleteModal{{ $operation->id }}"
                                                        class="btn btn-danger hide-menu w-100 mb-1">Delete</button>
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
            <x-reports.operation.delete :operation="$operation->id"> </x-reports.operation.delete>
        @endsection
