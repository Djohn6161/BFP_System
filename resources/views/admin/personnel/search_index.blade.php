@extends('layouts.user-template')
@section('content')
    <div class="container-fluid">
        <nav aria-label="breadcrumb" class="p-2 fw-bolder">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="">Configurations</a></li>
                <li class="breadcrumb-item active" aria-current="page">Alarms</li>
            </ol>
        </nav>
        <div class="col-lg-12">
            <div class="row">
                <div class="col-lg-12 d-flex align-items-stretch">
                    <div class="card w-250">
                        <div class="card-body p-4">
                            <div class="d-flex justify-content-between align-items-center p-3 rounded bg-gradient-blue">
                                <h5 class="mb-0 text-light card-title fw-semibold">Personnel</h5>
                                @if ($user->privilege == 'admin_chief' || $user->privilege == 'admin_clerk')
                                    <button type="button" class="btn btn-light" data-bs-toggle="modal"
                                        data-bs-target="#addAlarmModal">
                                        <i class="ti ti-plus"></i>
                                        Create
                                    </button>
                                    <x-alarm.create :category="$active"></x-alarm.create>
                                @endif

                            </div>
                            <div class="table-responsive">
                                <table class="table mb-0 align-middle w-100" id="personnelTable">
                                    <thead class="text-dark fs-4">
                                        <tr>
                                            <th class="border-bottom-0">Name</th>
                                            <th class="border-bottom-0">Designation</th>
                                            <th class="border-bottom-0">Tertiaries</th>
                                            <th class="border-bottom-0">Courses</th>
                                            <th class="border-bottom-0">Highest Eligibility</th>
                                            <th class="border-bottom-0">Highest Training</th>
                                            <th class="border-bottom-0">Specialized Training</th>
                                            <th class="border-bottom-0">Unit Code</th>
                                            <th class="border-bottom-0">Unit Assignment</th>
                                            @if ($user->privilege == 'admin_chief' || $user->privilege == 'admin_clerk')
                                                <th class="border-bottom-0">Action</th>
                                            @endif
                                        </tr>
                                    </thead>
                                    <tbody class="table-group-divider">
                                        @foreach ($personnels as $personnel)
                                            <x-alarm.edit :list="$personnel"></x-alarm.edit>
                                            <tr>
                                                <td>{{ $personnel->rank->slug . ' ' . $personnel->first_name . ' ' . $personnel->last_name }}
                                                </td>
                                                @if (isset($personnel->designations))
                                                    <td>
                                                        @foreach ($personnel->designations as $designation)
                                                            {{ $designation->name . ', ' }}
                                                        @endforeach
                                                    </td>
                                                @else
                                                    <td></td>
                                                @endif
                                                @if (isset($personnel->tertiaries))
                                                    <td>
                                                        @foreach ($personnel->tertiaries as $tertiary)
                                                            {{ $tertiary->name . ', ' }}
                                                        @endforeach
                                                    </td>
                                                @else
                                                    <td></td>
                                                @endif
                                                @if (isset($personnel->courses))
                                                    <td>
                                                        @foreach ($personnel->courses as $course)
                                                            {{ $course->name . ', ' }}
                                                        @endforeach
                                                    </td>
                                                @else
                                                    <td></td>
                                                @endif
                                                <td>{{ $personnel->highest_eligibility }}</td>
                                                <td>{{ $personnel->highest_training }}</td>
                                                <td>{{ $personnel->specialized_training }}</td>
                                                <td>{{ $personnel->unit_code }}</td>
                                                <td>{{ $personnel->unit_assignment }}</td>

                                                @if ($user->privilege == 'admin_chief' || $user->privilege == 'admin_clerk')
                                                    <td class="w-25 py-2">
                                                        <div class="d-flex flex-row">
                                                            <div class="me-1">
                                                                @if (count($personnel->aforTransmitted ?? []) != 0 ||
                                                                        count($personnel->aforReceived ?? []) != 0 ||
                                                                        count($personnel->minimalReceived ?? []) != 0 ||
                                                                        (count($personnel->minimalLeader ?? []) != 0 ||
                                                                            count($personnel->alarmCommand ?? []) != 0 ||
                                                                            count($personnel->aforDuty ?? []) != 0))
                                                                    <button type="button" class="btn btn-danger me-2"
                                                                        data-bs-toggle="modal" disabled> <i
                                                                            class="ti ti-x"></i>
                                                                        Invalid</button>
                                                                @else
                                                                    <button type="button" class="btn btn-danger me-2"
                                                                        data-bs-toggle="modal"
                                                                        data-bs-target="#deleteModal"><i
                                                                            class="ti ti-trash"></i> Delete</button>
                                                                @endif
                                                                <a href="{{ route('admin.personnel.update.form', $personnel->id) }}"
                                                                    class="btn btn-success w-100">
                                                                    <i class="ti ti-pencil"></i>
                                                                    Update
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </td>
                                                @endif
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <x-personnel.delete :category="$active" :personnel="$personnel"> </x-personnel.delete>
        @endsection
