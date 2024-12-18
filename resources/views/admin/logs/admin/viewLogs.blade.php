@extends('layouts.user-template')
@section('content')         
    <div class="container-fluid">
        <nav aria-label="breadcrumb" class="p-2 fw-bolder">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="">Activities</a></li>
                <li class="breadcrumb-item"><a href="">Logs</a></li>
                <li class="breadcrumb-item active" aria-current="page">Admin Logs</li>
            </ol>
        </nav>
        <div class="col-lg-12">
            <div class="row">
                <div class="col-lg-12 d-flex align-items-stretch">
                    <div class="card w-100">
                        <div class="card-body p-4">
                            <div class="d-flex justify-content-between align-items-center p-3 rounded bg-gradient-blue">
                                <h5 class="mb-0 text-light card-title fw-semibold">Admin Logs</h5>
                                
                            </div>

                            <div class="table-responsive">
                                <table class="table table-hover table-striped" id="myTable">
                                    <thead class="text-dark">
                                        <tr>
                                            <th class="text-center">Date and Time</th>
                                            <th>ID - User</th>
                                            <th>Type</th>
                                            <th class="text-center">Changes Made</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody class="table-group-divider">

                                        @php
                                        $sortedLogs = $logs->sortByDesc(function (
                                            $log,
                                        ) {
                                            return \Carbon\Carbon::parse($log->updated_at);
                                        });
                                    @endphp

                                    @foreach ($sortedLogs as $log)

                                        {{-- @foreach ($logs as $log) --}}
                                            {{-- {{dd($log->user)}} --}}

                                            <tr class="text-dark">
                                                <td class="text-center">{{ $log->updated_at }}</td>
                                                <td>{{ $log->user->id . " - " . $log->user->name }}</td>
                                                <td class="text-capitalize fw-bolder">{{ $log->type }}</td>
                                                <td>
                                                @if ($log->action == 'Delete')
                                                    <div class="text-light rounded-pill bg-danger p-2 text-center ">{{ $log->action }}</div>
                                                    @elseif($log->action == 'Update')
                                                    <div class="text-light rounded-pill bg-success p-2 text-center ">{{ $log->action }}</div>
                                                    @elseif($log->action == 'Store')
                                                    <div class="text-light rounded-pill bg-primary p-2 text-center ">{{ $log->action }}</div>
                                                    @else
                                                    <div class="rounded-pill p-2 text-center ">{{ $log->action }}</div>
                                                @endif
                                                </td>
                                                <td>
                                                    <button type="button" data-bs-toggle="modal"
                                                    data-bs-target="#viewConfigurationLogs{{ $log->id }}"
                                                    class="btn btn-primary hide-menu w-100 mb-1"><i
                                                        class="ti ti-eye"></i> View Details</button>
                                                        <x-logs.view-configuration :log="$log"></x-logs.view-configuration>
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
