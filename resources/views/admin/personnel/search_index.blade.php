@extends('layouts.user-template')
@section('content')
    <div class="container-fluid">
        <nav aria-label="breadcrumb" class="p-2 fw-bolder">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="">Configurations</a></li>
                <li class="breadcrumb-item active" aria-current="page">Personnel Search</li>
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
                                    <thead class="text-dark fs-4 ">
                                        <tr>
                                            <th class="border-bottom-0 text-center">Name</th>
                                            <th class="border-bottom-0 text-center">Designation</th>
                                            <th class="border-bottom-0 text-center">Tertiary Courses</th>
                                            <th class="border-bottom-0 text-center">Post Graduate Course</th>
                                            <th class="border-bottom-0 text-center">Highest Eligibility</th>
                                            <th class="border-bottom-0 text-center">Highest Training</th>
                                            <th class="border-bottom-0 text-center">Specialized Training</th>
                                            <th class="border-bottom-0 text-center">Unit Code</th>
                                            <th class="border-bottom-0 text-center">Unit Assignment</th>
                                            @if ($user->privilege == 'admin_chief' || $user->privilege == 'admin_clerk')
                                                <th class="border-bottom-0 text-center"  style="width: 10%">Action</th>
                                            @endif
                                        </tr>
                                    </thead>
                                    <tbody class="table-group-divider">
                                        @foreach ($personnels as $personnel)
                                            <x-alarm.edit :list="$personnel"></x-alarm.edit>
                                            <tr>
                                                <td>{{ ($personnel->rank?->slug ?? "Unknown") . ' ' . $personnel->first_name . ' ' . $personnel->last_name }}
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
                                                    <td class="py-2">
                                                        <div class="d-flex flex-row">
                                                            <div class="me-1">
                                                                <button type="button" class="btn btn-danger me-2 d-flex align-items-center justify-content-center"
                                                                    data-bs-toggle="modal" data-bs-target="#deleteModal"><i
                                                                        class="ti ti-trash"></i> Delete</button>
                                                                <a href="{{ route('admin.personnel.update.form', $personnel->id) }}"
                                                                    class="btn btn-success d-flex align-items-center justify-content-center">
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
            @if ($personnel ?? false)
                {{-- {{dd($personnel)}} --}}
                <x-personnel.delete :category="$active" :personnel="$personnel"> </x-personnel.delete>
            @endif
        @endsection
