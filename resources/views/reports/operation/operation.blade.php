@extends('layouts.user-template')
@section('content')
    <div class="container-fluid">
        <nav aria-label="breadcrumb" class="p-2 fw-bolder">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="">Reports</a></li>
                <li class="breadcrumb-item active" aria-current="page">Operation Reports</li>
            </ol>
        </nav>
        <div class="col-lg-12">
            <div class="row">
                <div class="col-lg-12 d-flex align-items-stretch">
                    <div class="card w-100">
                        <div class="card-body p-4">
                            <div class="d-flex justify-content-between align-items-center p-3 rounded bg-gradient-blue">
                                <h5 class="mb-0 text-light card-title fw-semibold">Operation Reports</h5>
                                @if ($user->privilege == 'OC' || $user->privilege == 'All')
                                    <div class="d-flex column-gap-2">
                                        {{-- <button type="button" class="btn btn-outline-light" data-bs-toggle="modal"
                                            data-bs-target="#exportOperation">
                                            <i class="ti ti-file-export"></i>
                                            Export
                                        </button> --}}  
                                        <x-reports.export></x-reports.export>
                                        <a class="btn btn-light" href="{{ route('operation.create.form') }}">
                                            <i class="ti ti-plus"></i>
                                            Create
                                        </a>
                                    </div>
                                @endif
                            </div>
                            <div class="table-responsive">
                                <table class="table mb-0 align-middle w-100" id="operationTable">
                                    <thead class="text-dark fs-4">
                                        <tr>
                                            <th>
                                                <h6 class="fw-semibold mb-0">#</h6>
                                            </th>
                                            <th style="max-width:10%">
                                                <h6 class="fw-semibold mb-0">Alarm Received</h6>
                                            </th>
                                            <th>
                                                <h6 class="fw-semibold mb-0">Transmitted By</h6>
                                            </th>
                                            <th>
                                                <h6 class="fw-semibold mb-0">Location</h6>
                                            </th>
                                            <th>
                                                <h6 class="fw-semibold mb-0">Time/Date Under Control</h6>
                                            </th>
                                            <th>
                                                <h6 class="fw-semibold mb-0">Time/Date Declared Fireout</h6>
                                            </th>
                                            <th>
                                                <h6 class="fw-semibold mb-0">Status</h6>
                                            </th>
                                            <th>
                                                <h6 class="fw-semibold mb-0">Action</h6>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        {{-- {{dd($operations)}} --}}
                                        @php
                                            $sortedOperations = $operations->sortByDesc(function($operation) {
                                                return \Carbon\Carbon::parse($operation->updated_at);
                                            });
                                        @endphp

                                        @foreach ($sortedOperations as $operation)
                                            <tr>
                                                <td>
                                                    <h6 class="fw-semibold mb-0">{{ $loop->index + 1 }}</h6>
                                                </td>
                                                <td>
                                                    <h6 class="fw-semibold mb-0">{{ $operation->alarm_received }}</h6>
                                                </td>
                                                <td>
                                                    <h6 class="fw-semibold mb-0 text-capitalize">
                                                        {{ $operation->transmitted_by }}
                                                    </h6>
                                                </td>
                                                <td>
                                                    <p class="mb-0 fw-normal">{{ $operation->full_location }}</p>
                                                </td>
                                                <td>
                                                    <p class="mb-0 fw-normal">
                                                        {{ \Carbon\Carbon::parse($operation->td_under_control)->format('F j, Y | g:i:s A') }}
                                                    </p>
                                                </td>
                                                <td>
                                                    <p class="mb-0 fw-normal">
                                                        {{ \Carbon\Carbon::parse($operation->td_declared_fireout)->format('F j, Y | g:i:s A') }}
                                                    </p>
                                                </td>

                                                <td>
                                                    @php
                                                        if ($operation->minimal) {
                                                            echo 'Minimal';
                                                        }
                                                        if ($operation->spot) {
                                                            echo ',Spot';
                                                            if ($operation->spot->progress) {
                                                                echo ',Progress';
                                                            }
                                                            if ($operation->spot->final) {
                                                                echo ',Final';
                                                            }
                                                        }
                                                    @endphp
                                                </td>
                                                <td>
                                                    <button type="button" data-bs-toggle="modal"
                                                        data-bs-target="#viewOperationModal{{ $operation->id }}"
                                                        data-operation="{{ json_encode($operation) }}"
                                                        data-responses="{{ json_encode($operation->responses) }}"
                                                        class="btn btn-primary hide-menu w-100 mb-1">
                                                        <i class="ti ti-eye"></i> View
                                                    </button>
                                                    <x-reports.operation.operation_view :operation="$operation" :responses="$responses"
                                                        :personnels="$personnels"></x-reports.operation.operation_view>
                                                    @if ($user->privilege == 'OC' || $user->privilege == 'All')
                                                        <a href="{{ route('operation.update.form', ['id' => $operation->id]) }}"
                                                            class="btn btn-success w-100 mb-1">
                                                            <i class="ti ti-pencil"></i> Update
                                                        </a>
                                                        <br>
                                                        <button type="button" data-bs-toggle="modal"
                                                            data-bs-target="#deleteModal{{ $operation->id }}"
                                                            class="btn btn-danger hide-menu w-100 mb-1">
                                                            <i class="ti ti-trash"></i> Delete
                                                        </button>
                                                        <x-reports.operation.delete
                                                            :operation="$operation"></x-reports.operation.delete>
                                                    @endif
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
