@extends('layouts.user-template')
@section('content')
    {{-- <div class="container-fluid">
    

        <div class="col-lg-12">


            <div class="row">
                <div class="col d-flex justify-content-end mb-2">
                </div>
                <div class="col-lg-12 d-flex align-items-stretch">
                    <div class="card w-100">
                        <div class="card-body p-4">
                            <h5 class="card-title fw-semibold mb-4">Afor Logs</h5> --}}
                            
    <div class="container-fluid">
        <div class="col-lg-12">
            <div class="row">
                <div class="col-lg-12 d-flex align-items-stretch">
                    <div class="card w-100">
                        <div class="card-body p-4">
                            <div class="d-flex justify-content-between align-items-center p-3 rounded bg-gradient-blue">
                                <h5 class="mb-0 text-light card-title fw-semibold">Afor Logs</h5>
                                
                            </div>

                            <div class="table-responsive">
                                <table class="table table-hover table-striped" id="myTable">
                                    <thead class="text-dark">
                                        <tr>
                                            <th>Date and Time</th>
                                            <th>ID - User</th>
                                            <th>Alarm Received</th>
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
                                            {{-- {{dd($log->user)}} --}}

                                            <tr class="text-dark">
                                                <td>{{ $log->updated_at }}</td>
                                                <td>{{ $log->user->id . " - " . $log->user->name }}</td>
                                                <td>{{ $log->afor != null ?     $log->afor->alarm_received : 'Unavailable' }}
                                                </td>
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
                                                    data-bs-target="#viewOperationLogs{{ $log->id }}"
                                                    class="btn btn-primary hide-menu w-100 mb-1"><i
                                                        class="ti ti-eye"></i> View Details</button>
                                                        <x-logs.view-operation :log="$log"></x-logs.view-operation>
                                                </td>
                                        </tr>
                                        @endforeach


                                        <!-- Add more rows as needed -->
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endsection
