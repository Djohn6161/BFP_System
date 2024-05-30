<style>
    .btn-reports {
        width: 200px
    }
</style>
@extends('layouts.user-template')
@section('content')
    <div class="container-fluid">
        <nav aria-label="breadcrumb" class="p-2 fw-bolder">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="">Reports</a></li>
                <li class="breadcrumb-item"><a href="{{ route('investigation.index') }}"> All Investigation Reports</a></li>
                <li class="breadcrumb-item active" aria-current="page">Spots Investigation Reports</li>
            </ol>
        </nav>
        <div class="col-lg-12">
            <div class="row">
                <div class="col-lg-12 d-flex align-items-stretch">
                    <div class="card w-100">
                        <div class="card-body p-4">
                            <div class="d-flex justify-content-between align-items-center p-3 rounded bg-gradient-blue">
                                <h5 class="mb-0 text-light card-title fw-semibold text-capitalize">
                                    {{ $active != 'investigation' ? $active : 'All' }} Investigation Reports
                                </h5>
                                @if ($user->privilege == 'IC' || $user->privilege == 'All')
                                <div class="d-flex column-gap-2">
                                    <button type="button" class="btn btn-outline-light" data-bs-toggle="modal"
                                        data-bs-target="#exportInvestigation">
                                        <i class="ti ti-file-export"></i>
                                        Export
                                    </button>
                                <x-reports.export></x-reports.export>
                                    <button type="button" class="btn btn-light" data-bs-toggle="modal"
                                        data-bs-target="#chooseInvestigation">
                                        <i class="ti ti-plus"></i>
                                        Create
                                    </button>
                                    <x-reports.create-investigation :spots=$spots :afors=$afors ></x-reports.create-investigation>
                                </div>
                                @endif
                            </div>
                            <div class="table-responsive">
                                <table class="table mb-0 align-middle w-100" id="spotInvestigationTable">
                                    <thead class="text-dark fs-4">
                                        <tr>
                                            <th>
                                                <h6 class="fw-semibold mb-0">ID</h6>
                                            </th>
                                            <th style="max-width:10%">
                                                <h6 class="fw-semibold mb-0">For</h6>
                                            </th>
                                            <th>
                                                <h6 class="fw-semibold mb-0">Subject</h6>
                                            </th>
                                            <th>
                                                <h6 class="fw-semibold mb-0">Status</h6>
                                            </th>
                                            <th>
                                                <h6 class="fw-semibold mb-0">Date</h6>
                                            </th>
                                            <th>
                                                <h6 class="fw-semibold mb-0">Action</h6>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                        $sortedInvestigations = $investigations->sortByDesc(function($investigation) {
                                            return \Carbon\Carbon::parse($investigation->investigation->date);
                                        });
                                    @endphp
                            
                                    @foreach ($sortedInvestigations as $investigation)
                                            {{-- <x-reports.update :report=$investigation></x-reports.update> --}}
                                            <tr>
                                                {{-- {{dd($investigation)}} --}}
                                                <td>
                                                    <h6 class="fw-semibold mb-0">{{ $investigation->investigation->id }}
                                                    </h6>
                                                </td>
                                                <td>
                                                    <h6 class="fw-semibold mb-0">{{ $investigation->investigation->for }}
                                                    </h6>
                                                </td>
                                                <td>
                                                    <p class="mb-0 fw-normal">{{ $investigation->investigation->subject }}
                                                    </p>
                                                </td>
                                                <td>
                                                    <p class="mb-0 fw-normal">
                                                        @if ($investigation->afor)
                                                            Operation <br>
                                                        @endif
                                                        @if ($investigation->progress)
                                                            Progress <br>
                                                        @endif
                                                        @if ($investigation->final)
                                                            Final <br>
                                                        @endif
                                                    </p>
                                                </td>
                                                <td>
                                                    <p class="mb-0 fw-normal">
                                                        {{ \Carbon\Carbon::parse($investigation->investigation->date)->format('F j, Y') }}
                                                    </p>
                                                </td>
                                                <td>
                                                    <button type="button" data-bs-toggle="modal"
                                                        data-bs-target="#viewSpotModal{{ $investigation->id }}"
                                                        class="btn btn-primary hide-menu w-100 mb-1"><i
                                                            class="ti ti-eye"></i> View</button>
                                                    <x-reports.Investigation.view-spot :personnels=$personnels :responses="$responses"
                                                        :investigation=$investigation></x-reports.Investigation.view-spot>
                                                    @if ($user->privilege == 'IC' || $user->privilege == 'All')
                                                        <a href="{{ route('investigation.spot.edit', ['spot' => $investigation->id]) }}"
                                                            class="btn btn-success w-100 mb-1"><i class="ti ti-pencil"></i>
                                                            Update</a>
                                                        <br>
                                                        <button type="button" data-bs-toggle="modal"
                                                            data-bs-target="#deleteModal{{ $investigation->id }}"
                                                            class="btn btn-danger hide-menu w-100 mb-1"><i
                                                                class="ti ti-trash"></i> Delete</button>
                                                        <x-reports.investigation.investigation-delete :type="'spot'"
                                                            :investigation=$investigation></x-reports.investigation.investigation-delete>
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
            @include('partials.investigationScript')
        @endsection
