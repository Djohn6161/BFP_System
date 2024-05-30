
@extends('layouts.user-template')
@section('content')

    <div class="container-fluid">
        <div class="col-lg-12">
            <div class="row">
                <div class="col-lg-12 d-flex align-items-stretch">
                    <div class="card w-100">
                        <div class="card-body p-4">
                            <div class="d-flex justify-content-between align-items-center p-3 rounded bg-gradient-blue">
                                <h5 class="mb-0 text-light card-title fw-semibold">
                                    Alarms</h5>
                                <button type="button" class="btn btn-light" data-bs-toggle="modal"
                                    data-bs-target="#addAlarmModal">
                                    <i class="ti ti-plus"></i>
                                    Create
                                </button>
                                <x-alarm.create :category="$active"></x-alarm.create>

                            </div>
                            <div class="table-responsive">
                                <table class="table mb-0 align-middle w-100" id="alarmTable">
                                    <thead class="text-dark fs-4 ">
                                        <tr>
                                            <th class="border-bottom-0">ID</th>
                                            <th class="border-bottom-0">Alarm Name</th>
                                            <th class="border-bottom-0">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody class="table-group-divider">
                                        @foreach ($alarm_list as $list)
                                            <x-alarm.edit :list="$list"></x-alarm.edit>

                                            <tr>
                                                <td>{{ $list->id }}</td>
                                                <td>{{ $list->name }}</td>

                                                <td class="w-25 py-2">
                                                    <div class="d-flex flex-row">
                                                        <div class="me-1">
                                                            <button class="btn btn-success w-100" data-bs-toggle="modal"
                                                                data-bs-target="#editAlarmModal{{ $list->id }}">
                                                                <i class="ti ti-pencil"></i>
                                                                Update

                                                            </button>
                                                        </div>
                                                        <div class="me-1">
                                                            {{-- {{ dd(count($list->spots)) }} --}}
                                                            @if (count($list->minimals ?? []) != 0 || count($list->spots ?? []) != 0)
                                                                <button disabled class="btn btn-secondary w-100" data-bs-toggle="modal">
                                                                    <i class="ti ti-x"></i>
                                                                    Invalid
                                                                </button>
                                                            @else
                                                                <button class="btn btn-danger w-100" data-bs-toggle="modal"
                                                                    data-bs-target="#deleteAlarmModalll{{ $list->id }}">
                                                                    <i class="ti ti-trash"></i>
                                                                    Delete

                                                                </button>
                                                                <x-alarm.delete :list="$list"></x-alarm.delete>
                                                            @endif
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
        @endsection
